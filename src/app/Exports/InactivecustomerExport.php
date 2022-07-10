<?php

namespace App\Exports;

use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InactivecustomerExport implements FromCollection, WithHeadings
{
    protected $customer_data;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function __construct($data)
    {
        $this->customer_data = $data;
    }
    public function collection()
    {
        $filer_data = $this->customer_data;
        $cust_data = array();
        $our_cust=array();
        foreach ($filer_data as $key => $value) {
            $getWallet = DB::table('customers AS C')
                ->addSelect(DB::raw('SUM(amount_allow-amount_used) AS sum_of_wallet'))
                ->leftJoin('customer_wallet AS CW', 'CW.customer_id', '=', 'C.id')
                ->where('C.contact', $value->contact)->first();
            if (!empty($getWallet)) {
                $cust_Wallet = $getWallet->sum_of_wallet;
            } else {
                $cust_Wallet = 0;
            }
            // fetch gift points
            $getPoints = DB::table('customers AS C')
                ->addSelect(DB::raw('SUM(points_allow-used_points) AS sum_of_points'))
                ->leftJoin('customer_points AS CP', 'CP.customer_id', '=', 'C.id')
                ->where('C.contact', $value->contact)->first();
            if (!empty($getPoints)) {
                $cust_Points = $getPoints->sum_of_points;
            }
            $cust_data['Name'] = $value->name;
            $cust_data['Email'] = $value->email;
            $cust_data['Contact'] = $value->contact;
            $cust_data['Total Revenue'] = $value->total_revenue;
            $cust_data['Total Visit'] = $value->total_visit;
            $cust_data['Last visit date'] = $value->last_visit_date;
            // $cust_data['Cust Wallet'] = $cust_Wallet;
            // $cust_data['Cust Points'] = $cust_Points;
            array_push($our_cust,$cust_data);
        }
        return collect($our_cust);
    }

    public function headings(): array
    {
        $export = [];
        return [
            'Name', 'Email',  'Contact',  'Total Revenue', 'Total Visit', 'Last visit date', 
        ];
    }
}
