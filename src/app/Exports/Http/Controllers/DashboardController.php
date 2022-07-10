<?php

namespace App\Http\Controllers;

use App\Dashboard;
use App\Model\admin\Customer;
use App\Model\admin\Enquiry;
use App\Model\admin\Firm;
use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $firmid = $request->firm_id;
        // $start_date = $request->start_date;
        // $end_date = $request->end_date;
        // $firmid=2;
        // $start_date='2021-08-04';
        // $end_date='2021-08-04';
        // $from = date('Y-m-d 00:00:00', strtotime($start_date));
        // $to = date('Y-m-d 23:59:59', strtotime($end_date));
        // // echo $firmid
        // $total_sales=0;
        // if (!empty($firmid)) {
        //     $getFirmDetail = DB::table('firms')->where('id', $firmid)->first();
        //     // print_r($getFirmDetail);
        //     // die;
        //     if (!empty($getFirmDetail)) {
        //         $services = json_decode($getFirmDetail->services);
        //         foreach ($services as $id) {
        //             $getReport = DB::table('invoice as INV')
        //             ->select(DB::raw('SUM(all_total) AS total_sales'))
        //             ->leftJoin('invoice_service as IS', 'INV.invoice_id', '=', 'IS.invoice_id')
        //             ->leftJoin('service_brands as SB', 'SB.service_brand_id', '=', 'IS.service_id')
        //             ->distinct();
        //             if (!empty($request->start_date) && $request->start_date != '' && !is_null($request->start_date) && !empty($request->end_date) && $request->end_date != '' && !is_null($request->end_date)) {
        //                 $getReport->where('INV.invoice_date', '>=', $from);
        //                 $getReport->where('INV.invoice_date', '<=', $to);
        //             }
        //             $getReport->where('SB.service_id', $id);
        //             $reports = $getReport->get();
        //             // print_r($reports);
        //         }
        //     }
        // }
        // if (!empty($reports)) {
        // $total_sales=$reports[0]->total_sales;
        // }
        // $firms = Firm::all();
        $today_total=0;
        $today = date('Y-m-d 00:00:00');
        $todayend = date('Y-m-d 23:59:59');
        $todays_cust = DB::table('invoice as INV')
                    ->leftJoin('customers as C', 'C.id', '=', 'INV.user_id')
                    ->where('INV.invoice_date','=',$today)->get();
        foreach ($todays_cust as $key => $todays_cst) {
            $today_total=$today_total+$todays_cst->all_total;
        }
        $enquiries = Enquiry::where('status', '=', 'new')->get();
        $today_birthdays = Customer::where('dob', '=', date('Y-m-d'))->get();
        $today_anniversaries = Customer::where('anniversary_date', '=', date('Y-m-d'))->get();
        $feedback = DB::table('feedback as f')
                    ->select('f.comment','f.rating','C.name as customer_name','C.contact as customer_contact')
                    ->leftJoin('customers as C', 'C.id', '=', 'f.customer_id')
                    ->orderBy('f.feedback_id', 'DESC')
                    ->take('5')->get();

                    //->where('.invoice_date','=',$today)->get();

        $check_ins =  DB::table('customers')
                    ->leftJoin('invoice', 'invoice.user_id', '=', 'customers.id')
                    ->where('invoice.checkin', 1)
                    ->where('invoice.updated_at','>',$today)
                    ->where('invoice.updated_at','<',$todayend)
                    ->get();
        return view('admin.dashboard.myboard', compact('todays_cust', 'today_birthdays', 'today_anniversaries', 'check_ins', 'enquiries','today_total','feedback'));
    }

    public function login()
    {
        return view('admin.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
}
