<?php

namespace App\Http\Controllers\admin;

use App\Exports\InvoiceExport;
use App\Exports\InvoiceserviceExport;
use App\Http\Controllers\Controller;
use App\Model\admin\Customer;
use App\Model\admin\Firm;
use DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Model\admin\CustomerWallet;
use App\Model\admin\CustomerPoint;
use App\Model\Invoice;
use App\Model\InvoiceServiceModel;
use App\Model\InvoiceProductModel;
use App\Model\InvoicePackageModel;
use App\Model\InvoicePackageServiceModel;
use App\Model\InvoiceRemainingModel;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $firms = Firm::all();
            return view('admin.reports.index', compact('firms'));

        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function service_dashboard()
    {
        try {
            $firms = Firm::all();
            return view('admin.reports.service_dashboard', compact('firms'));

        } catch (\Throwable $th) {
            //throw $th;
        }
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getInvoiceDetails(Request $request)
    {
        // echo json_encode($request->all());
        // return "";
        $data['invoice'] = "";
        $data['services'] = "";
        $invoiceid = $request->invoice_id;
        $invoicedata = DB::table('invoice AS I')
            ->select('C.*', 'I.*', 'I.remark AS iremark')->leftJoin('customers AS C', 'C.id', '=', 'I.user_id')
            ->where('I.invoice_id', $invoiceid)
            ->first();
        $data['invoice'] = $invoicedata;
        $services = DB::table('invoice_service AS IS')
            ->select('SE.name AS service_name', 'SU.name AS service_staff_name', 'PB.brand_name', 'SB.brand_name as sbname', 'IS.*', 'F.firm_name')
            ->leftJoin('services AS SE', 'SE.id', '=', 'IS.service_id')
            ->leftJoin('service_group AS SG', 'SE.group_id', '=', 'SG.id')
            ->leftJoin('firms AS F', 'SG.firm_id', '=', 'F.id')
            ->leftJoin('users AS SU', 'SU.id', '=', 'IS.staff_id')
            ->leftJoin('service_brands AS SB', 'SB.service_brand_id', '=', 'IS.service_id')
            ->leftJoin('product_brands AS PB', 'PB.id', '=', 'IS.brand_id')
            ->where('IS.invoice_id', $invoiceid)
            ->get();
        foreach ($services as $key => $service) {
            $data['services'] .= "<tr>
                                <td>" . ($key + 1) . "</td>
                                <td>" . $service->brand_name . "</td>
                                <td>" . $service->sbname . "</td>
                                <td> <i class='fa fa-inr'></i> " . $service->price . "</td>
                            </tr>";
        }
        // print_r($invoicedata);
        echo json_encode($data);
    }

    public function getBillsByFirm(Request $request)
    {
        try {

            $firmid = $request->firm_id;
            $service_id = $request->service_id;
            $category_id = $request->category_id;
            $brand_id = $request->brand_id;
            $main_service_id = $request->main_service_id;
            $start_date = $request->start_date;
            $end_date = $request->end_date;
            $is_estimate = $request->is_estimate;
            $data['html'] = "";
            $data['subtotal'] = 0;
            $from = date('Y-m-d 00:00:00', strtotime($start_date));
            $to = date('Y-m-d 23:59:59', strtotime($end_date));
            if (!empty($firmid)) {
                $getFirmDetail = DB::table('firms')->where('id', $firmid)->first(); //add also service id on that filter




                //echo json_encode($getFirmDetail);
                // if($firmid!=0 && $service_id!=0){
                //     $getFirmDetail = DB::table('firms')->where('id', $firmid)->first(); //add also service id on that filter
                // }

                //add firmid and service_id filter on firms table
                //add category_id filter for get all brands
                //add main service id filter on invoice_service table for get
                //in invoice_service table service_id = main_service_id
                //in invoice_service table brand_id = brand_id
                //In service brand table
                // 1. service_id = parent service id of service group table
                // 2. sub_cate_id = sub_service_id  of service group table and category id of quicksale form
                // 3. brand_id = brand id of quickssale form
                // 4. id = main services of quicksale form



                DB::enableQueryLog(); // Enable query log
                $getReport = DB::table('invoice_service as IS')
                            ->select('INV.invoice_id', 'INV.all_total', 'INV.invoice_series', 'INV.invoice_date','IS.total_price as total_price','IS.service_id as service_id', 'C.name as customer_name','SB.brand_name as main_service_name')
                            ->leftJoin('invoice as INV', 'INV.invoice_id', '=', 'IS.invoice_id')
                            ->leftJoin('service_brands as SB', 'SB.service_brand_id', '=', 'IS.service_id')
                            ->leftJoin('customers as C', 'C.id', '=', 'INV.user_id');
                            if (!empty($request->start_date) && $request->start_date != '' && !is_null($request->start_date) && !empty($request->end_date) && $request->end_date != '' && !is_null($request->end_date)) {
                                    $getReport->where('INV.invoice_date', '>=', $from);
                                    $getReport->where('INV.invoice_date', '<=', $to);
                            }


                        if($request->service_id!='' && $request->category_id==0 && $request->brand_id=='' && $request->main_service_id==0){
                                $category_ids = DB::table('service_group')->where('parent_id', $request->service_id)->pluck('id');
                                if(count($category_ids)>0){
                                    $main_service_ids = DB::table('service_brands')->whereIn('sub_cate_id',$category_ids)->pluck('service_brand_id');
                                    if(count($main_service_ids)>0){
                                        $getReport->whereIn('SB.service_brand_id', $main_service_ids);
                                    }
                                }
                        }elseif($request->service_id!=0 && $request->category_id!=0 && $request->brand_id!=0 && $request->main_service_id==0){
                            $category_ids = DB::table('service_group')->where('parent_id', $request->service_id)->pluck('id');
                            if(count($category_ids)>0){
                                $main_service_ids = DB::table('service_brands')->whereIn('sub_cate_id',$category_ids)->pluck('service_brand_id');
                                if(count($main_service_ids)>0){
                                    $getReport->whereIn('SB.service_brand_id', $main_service_ids);
                                    $getReport->where('SB.brand_id', $brand_id);
                                }
                            }
                        }elseif($main_service_id!=0){
                            $getReport->where('SB.service_brand_id', $main_service_id);
                         }





                        $getReport->where('INV.is_estimate',$is_estimate);
                        $getReport->where('INV.firm_id', $firmid);
                        // echo '<pre>';
                        // print_r(DB::getQueryLog());
                        // echo '</pre>';
                        // exit();
                        $reports = $getReport->get();
                        $st_review = array();
                        $invoice_data = array();
                        foreach ($reports as $key => $report) {
                            $st_review[$report->main_service_name][] =  $report->total_price;
                            $data['subtotal'] += $report->total_price;
                            $invoice_data[$report->invoice_id]['invoice_id'] = $report->invoice_id;
                            $invoice_data[$report->invoice_id]['invoice_series'] = $report->invoice_series;
                            $invoice_data[$report->invoice_id]['customer_name'] = $report->customer_name;
                            $invoice_data[$report->invoice_id]['total_price'] = $report->total_price;
                            $invoice_data[$report->invoice_id]['invoice_date'] = $report->invoice_date;
                            $invoice_data[$report->invoice_id]['all_total'] = $report->all_total;

                        }

                        if(count($invoice_data)>0){
                            $rrr = 1;
                            foreach ($invoice_data as $rkey => $rvalue) {
                                $inv_id = $rvalue['invoice_id'];
                                $invoice_date = $rvalue['invoice_date'];
                                $invoice_series = $rvalue['invoice_series'];
                            $data['html'] .= "<tr>
                                            <td>" .$rrr . "</td>
                                            <td>" . $invoice_series . "</td>
                                            <td>" . $rvalue['customer_name'] . "</td>
                                            <td> <i class='fa fa-inr'></i> " .$rvalue['all_total']. "</td>
                                            <td>" . date('d-M-Y', strtotime($invoice_date)) . "</td>
                                            <td><button type='button' class='btn btn-info' onclick='getInvoiceDetails(".$inv_id.")'><i class='fa fa-eye'></i></button>
                                            <button type='button' class='btn btn-danger' onclick='deleteInvoice(".$inv_id.")'><i class='fa fa-trash'></i></button></td>
                                         </tr>";
                                $rrr++;
                            }
                        }

                        $ss = array(['Services','Total amount (Rs)']);
                        if(count($st_review)>0){
                            foreach ($st_review as $key => $svalue) {
                                $total = 0;
                                if(count($svalue)>0){
                                    $total = array_sum($svalue);
                                }
                                $ss[] = array($key,$total);
                            }
                        }
                        $data['st'] = $ss;
            } else {
                $data['html'] = "";
                $data['subtotal'] = 0;
            }
            echo json_encode($data);

        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function exportExcel(Request $request)
    {
        // print_r($request->all());
        // dd('hy');
        $firmid = $request->firm_id;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $is_estimate = $request->is_estimate;
        Excel::store(new InvoiceExport($firmid, $start_date, $end_date,$is_estimate), 'InvoiceReport.xls');
        return response()->json([
            'result' => 'true',
            'url' => storage_path('app/InvoiceReport.xls'),
        ]);
    }


    public function exportserviceExcel(Request $request)
    {
        // print_r($request->all());
        // dd('hy');
        $firmid = $request->firm_id;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $service_id = ($request->service_id)?$request->service_id:0;
        $category_id = ($request->category_id)?$request->category_id:0;
        $brand_id = ($request->brand_id)?$request->brand_id:0;
        $main_service_id = ($request->main_service_id)?$request->main_service_id:0;
        $is_estimate = ($request->is_estimate)?$request->is_estimate:0;
        Excel::store(new InvoiceserviceExport($firmid, $start_date, $end_date,$service_id,$category_id,$brand_id,$main_service_id,$is_estimate), 'InvoiceReport.xls');
        return response()->json([
            'result' => 'true',
            'url' => storage_path('app/InvoiceReport.xls'),
        ]);
    }

    public function DownloadFile()
    {
        $file = storage_path('app/InvoiceReport.xls');
        return response()->download($file);
    }

    public function deleteInvoice(Request $request)
    {
        try {
            $invoiceid= $request->invoice_id;
            $Invoice = Invoice::where('invoice_id', '=', $invoiceid)->first();
            if($Invoice){
                $grand_total = $Invoice->grand_total;
                $user_id = $Invoice->user_id;
                $customer = Customer::where("id",$user_id)->first();
                if($customer){
                    if($customer->total_revenue>0){
                        $customer->total_revenue = $customer->total_revenue - $grand_total;
                        $customer->save();
                    }
                }
            }

            $Customer_Wallet = CustomerWallet::where('invoice_id', '=', $invoiceid)->delete();
            $Customer_Point = CustomerPoint::where('invoice_id', '=', $invoiceid)->delete();
            $Invoice_Remaining = InvoiceRemainingModel::where('invoice_id', '=', $invoiceid)->delete();
            $Invoice_Service = InvoiceServiceModel::where('invoice_id', '=', $invoiceid)->delete();
            $Invoice_Product = InvoiceProductModel::where('invoice_id', '=', $invoiceid)->delete();
            $Invoice_Package = InvoicePackageModel::where('invoice_id', '=', $invoiceid)->get();
            if(!$Invoice_Package->isEmpty()){
                $invoice_package_id=$Invoice_Package[0]->invoice_package_id;
                $Invoice_PackageService = InvoicePackageServiceModel::where('invoice_package_id', '=', $invoice_package_id)->delete();
            }
            $Invoice_Package = InvoicePackageModel::where('invoice_id', '=', $invoiceid)->delete();

            $Invoice = Invoice::where('invoice_id', '=', $invoiceid)->delete();
            echo json_encode(['msg' => true,'data'=>$Invoice]);
        } catch (\Exception $e) {
            echo json_encode(['msg' => false]);
        }
    }
}
