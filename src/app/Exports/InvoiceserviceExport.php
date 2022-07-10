<?php

namespace App\Exports;

use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InvoiceserviceExport implements FromCollection, WithHeadings
{

    protected $firm_id;
    protected $start_date;
    protected $end_date;
    protected $service_id;
    protected $category_id;
    protected $brand_id;
    protected $main_service_id;
    protected $is_estimate;

    public function __construct($firm_id, $start_date, $end_date,$service_id,$category_id,$brand_id,$main_service_id,$is_estimate)
    {
        $this->firm_id = $firm_id;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->service_id = $service_id;
        $this->category_id = $category_id;
        $this->brand_id = $brand_id;
        $this->main_service_id = $main_service_id;
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
        $getFirmDetail = 0;


        $getFirmDetail = DB::table('firms')->where('id', $this->firm_id)->first(); //add also service id on that filter



        //$services = json_decode($getFirmDetail->services);
        $firm_name = $getFirmDetail->firm_name;


            $getReport = DB::table('invoice_service as IS')
                             ->select(DB::raw("'$firm_name'"), 'INV.invoice_series', DB::raw('CAST(invoice_date AS DATE)'),'C.name as customer_name','C.contact', 'all_total')
                            ->leftJoin('invoice as INV', 'INV.invoice_id', '=', 'IS.invoice_id')
                            ->leftJoin('service_brands as SB', 'SB.service_brand_id', '=', 'IS.service_id')
                            ->leftJoin('customers as C', 'C.id', '=', 'INV.user_id')
                            ->distinct();
                            if (!empty($this->start_date) && $this->start_date != '' && !is_null($this->start_date) && !empty($this->end_date) && $this->end_date != '' && !is_null($this->end_date)) {
                                    $getReport->where('INV.invoice_date', '>=', $from);
                                    $getReport->where('INV.invoice_date', '<=', $to);
                            }


                        if($this->service_id!='' && $this->category_id==0 && $this->brand_id=='' && $this->main_service_id==0){
                                $category_ids = DB::table('service_group')->where('parent_id', $this->service_id)->pluck('id');
                                if(count($category_ids)>0){
                                    $main_service_ids = DB::table('service_brands')->whereIn('sub_cate_id',$category_ids)->pluck('service_brand_id');
                                    if(count($main_service_ids)>0){
                                        $getReport->whereIn('SB.service_brand_id', $main_service_ids);
                                    }
                                }
                        }elseif($this->service_id!=0 && $this->category_id!=0 && $this->brand_id!=0 && $this->main_service_id==0){
                            $category_ids = DB::table('service_group')->where('parent_id', $this->service_id)->pluck('id');
                            if(count($category_ids)>0){
                                $main_service_ids = DB::table('service_brands')->whereIn('sub_cate_id',$category_ids)->pluck('service_brand_id');
                                if(count($main_service_ids)>0){
                                    $getReport->whereIn('SB.service_brand_id', $main_service_ids);
                                    $getReport->where('SB.brand_id', $this->brand_id);
                                }
                            }
                        }elseif($this->main_service_id!=0){
                            $getReport->where('SB.service_brand_id', $this->main_service_id);
                         }





                        $getReport->where('INV.is_estimate',$this->is_estimate);
                        $getReport->where('INV.firm_id', $this->firm_id);



            $reports = $getReport->get()->toArray();



            $total = 0;
            if(count($reports)>0){
                foreach ($reports as $rvalue) {
                    $total += $rvalue->all_total;
                }
            }

           // $count = count($reports)+1;
            array_push($reports, [
                'FirmName' => '',
                'Invoice Series'=>'',
                'Invoice Date' =>'',
                'Customer Name' =>'',
                'Contact' =>'',
                'Invoice Amount' => '',
            ]);
            array_push($reports,['','', '','','Grand Total' , $total]);
            return collect($reports);
        //}
    }

    public function headings(): array
    {
        $export = [];
        return ["FirmName", "Invoice No", "Invoice Date","Customer Name","Contact", "Invoice Amount"];
    }
}
