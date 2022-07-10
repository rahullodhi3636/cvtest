<?php

namespace App\Exports;

use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InvoiceExport implements FromCollection, WithHeadings
{

    protected $firm_id;
    protected $start_date;
    protected $end_date;
    protected $is_estimate;

    public function __construct($firm_id, $start_date, $end_date,$is_estimate)
    {
        $this->firm_id = $firm_id;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->is_estimate = $is_estimate;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // $firm_id = '';
        $from = date('Y-m-d 00:00:00', strtotime($this->start_date));
        $to = date('Y-m-d 23:59:59', strtotime($this->end_date));
        $getFirmDetail = DB::table('firms')->where('id', $this->firm_id)->first();
        $services = json_decode($getFirmDetail->services);
        $firm_name = $getFirmDetail->firm_name;
        foreach ($services as $id) {
            $getReport = DB::table('invoice as INV')
                ->select(DB::raw("'$firm_name'"), 'INV.invoice_id', DB::raw('CAST(invoice_date AS DATE)'), 'all_total')
                ->leftJoin('invoice_service as IS', 'INV.invoice_id', '=', 'IS.invoice_id')
                ->leftJoin('service_brands as SB', 'SB.service_brand_id', '=', 'IS.service_id')
                ->distinct();
            if (!empty($this->start_date) && $this->start_date != '' && !is_null($this->start_date) && !empty($this->end_date) && $this->end_date != '' && !is_null($this->end_date)) {
                $getReport->where('INV.invoice_date', '>=', $from);
                $getReport->where('INV.invoice_date', '<=', $to);
            }
            $getReport->where('SB.service_id', $id);
            $getReport->where('INV.is_estimate',$this->is_estimate);
            $reports = $getReport->get()->toArray();

            $count = count($reports)+1;
            array_push($reports, [
                'FirmName' => '',
                'Invoice No'=>'',
                'Invoice Date' =>'',
                'Invoice Amount' => ''
            ]);
            array_push($reports,['','', 'Grand Total' , '=SUM(D2:D'.$count.')']);
            return collect($reports);
        }
    }

    public function headings(): array
    {
        $export = [];
        return ["FirmName", "Invoice No", "Invoice Date", "Invoice Amount"];
    }
}
