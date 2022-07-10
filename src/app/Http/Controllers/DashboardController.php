<?php

namespace App\Http\Controllers;

use App\Dashboard;
use App\Model\admin\Customer;
use App\Model\admin\Enquiry;
use App\Model\admin\Firm;
use Illuminate\Http\Request;
use DB;
use Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $firm_id = ($request->firm_name)?$request->firm_name:0;
        $user = Auth::user();
        $user_role = $user->admin;
        $today_total=0;
        $today = date('Y-m-d 00:00:00');
        $todayend = date('Y-m-d 23:59:59');

        $condition = "INV.invoice_date='".$today."'";
        if($firm_id!=0){
            $condition.=" and INV.firm_id=".$firm_id;
        }

        $todays_cust = DB::table('invoice as INV')
                    ->select('INV.*','C.*','INV.created_at as inv_time')
                    ->leftJoin('customers as C', 'C.id', '=', 'INV.user_id')
                    ->whereRaw($condition)->paginate(15);
        foreach ($todays_cust as $key => $todays_cst) {
            $today_total=$today_total+$todays_cst->all_total;
        }



        $ttotal = DB::table('invoice as INV')->leftJoin('customers as C', 'C.id', '=', 'INV.user_id')
                 ->whereRaw($condition)->sum('all_total');


        $enquiries = Enquiry::where('status', '=', 'new')->get();
        $today_birthdays = Customer::where('dob', '=', date('Y-m-d'))->get();
        $today_anniversaries = Customer::where('anniversary_date', '=', date('Y-m-d'))->get();
        $feedback = DB::table('feedback as f')
                    ->select('f.comment','f.rating','C.name as customer_name','C.contact as customer_contact')
                    ->leftJoin('customers as C', 'C.id', '=', 'f.customer_id')
                    ->orderBy('f.feedback_id', 'DESC')
                    ->take('5')->get();

                    //->where('.invoice_date','=',$today)->get();

        $condition2 = "invoice.checkin=1";
        if($firm_id!=0){
            $condition2.=" and invoice.firm_id=".$firm_id;
        }
        $check_ins =  DB::table('customers')
                    ->leftJoin('invoice', 'invoice.user_id', '=', 'customers.id')
                    ->whereRaw($condition2)
                    ->where('invoice.updated_at','>',$today)
                    ->where('invoice.updated_at','<',$todayend)
                    ->get();
        $firms = Firm::all();
        return view('admin.dashboard.myboard', compact('user_role','ttotal','todays_cust', 'today_birthdays', 'today_anniversaries', 'check_ins', 'enquiries','today_total','feedback','firms','firm_id'));
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
