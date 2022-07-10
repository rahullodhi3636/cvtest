<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Model\admin\Customer;
use App\Model\admin\CustomerWallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\CustomerWallet  $customerWallet
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerWallet $customerWallet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CustomerWallet  $customerWallet
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerWallet $customerWallet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CustomerWallet  $customerWallet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerWallet $customerWallet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CustomerWallet  $customerWallet
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerWallet $customerWallet)
    {
        //
    }

    public function add_customer_wallet(Request $request)
    {
        $this->validate($request, [
            'amount_allow' => 'required',
            'customer_id' => 'required',
        ]);
        try {
            $Customer_Wallet = new CustomerWallet();
            $Customer_Wallet->amount_allow = $request->amount_allow;
            $Customer_Wallet->customer_id = $request->customer_id;
            $Customer_Wallet->amount_used = $request->amount_used;
            $Customer_Wallet->invoice_id = $request->invoice_id;
            $Customer_Wallet->created_at = date('Y/m/d H:i:s');
            $Customer_Wallet->save();
            echo json_encode(['msg' => true]);
        } catch (\Exception $e) {
            echo json_encode(['msg' => false]);
        }
    }

    public function getwalletofCustomer($id)
    {
        try {
            $customer = Customer::select('customers.name', 'CW.*')
                        ->leftJoin('customer_wallet AS CW','CW.customer_id','=','customers.id')
                        ->where('CW.customer_id',$id)
                        ->get();
            return view('customer.wallet_details',compact('customer'));
        } catch (\Exception $e) {
            return Redirect::back();
            //  echo json_encode(['msg' => false]);
        }
    }
}
