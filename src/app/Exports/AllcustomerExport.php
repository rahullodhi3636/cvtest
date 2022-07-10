<?php

namespace App\Exports;

use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AllcustomerExport implements FromCollection, WithHeadings
{
    // protected $customer_data;
    /**
     * @return \Illuminate\Support\Collection
     */
    // public function __construct($data)
    // {
    //     $this->customer_data = $data;
    // }
    public function collection()
    {
        $our_cust = DB::table('customers AS C')
            ->select('id','name','contact')
            ->get();
        return $our_cust;
    }

    public function headings(): array
    {
        $export = [];
        return ['Cust_id', 'Name',  'Contact' ];
    }
}
