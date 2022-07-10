<?php

namespace App\Exports;

use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AssignedRefExport implements FromCollection, WithHeadings
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

            $cust_data['Name'] = $value->name;
            $cust_data['Email'] = $value->email;
            $cust_data['Contact'] = $value->contact;
            $cust_data['Offer Code'] = $value->offer_code;
            // $cust_data['Total Visit'] = $value->total_visit;
            // $cust_data['Last visit date'] = $value->last_visit_date;
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
            'Name', 'Email',  'Contact',  'Coupon Code',
        ];
    }
}
