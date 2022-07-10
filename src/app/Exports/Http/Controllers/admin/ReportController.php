<?php

namespace App\Http\Controllers\admin;

use App\Exports\InvoiceExport;
use App\Http\Controllers\Controller;
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
            //echo json_encode($request->all());
            $firmid = $request->firm_id;
            $service_id = $request->service_id;
            $category_id = $request->category_id;
            $brand_id = $request->brand_id;
            $main_service_id = $request->main_service_id;
            $start_date = $request->start_date;
            $end_date = $request->end_date;
            $data['html'] = "";
            $data['subtotal'] = 0;
            $from = date('Y-m-d 00:00:00', strtotime($start_date));
            $to = date('Y-m-d 23:59:59', strtotime($end_date));
            if (!empty($firmid)) {

                if($firmid!=0){
                    $getFirmDetail = DB::table('firms')->where('id', $firmid)->first(); //add also service id on that filter
                }

                // if($firmid!=0 && $service_id!=0){
                //     $getFirmDetail = DB::table('firms')->where('id', $firmid)->first(); //add also service id on that filter
                // }

                //add firmid and service_id filter on firms table
                //add category_id filter for get all brands
                //add main service id filter on invoice_service table for get
                //in invoice table service_id = main_service_id
                //in invoice table brand_id = brand_id

                $getReport = DB::table('invoice as INV')
                            ->select('INV.invoice_id', 'all_total', 'invoice_date', 'C.name as customer_name')
                            ->leftJoin('invoice_service as IS', 'INV.invoice_id', '=', 'IS.invoice_id')
                            ->leftJoin('service_brands as SB', 'SB.service_brand_id', '=', 'IS.service_id')
                            ->leftJoin('customers as C', 'C.id', '=', 'INV.user_id')
                            ->distinct();
                        if (!empty($request->start_date) && $request->start_date != '' && !is_null($request->start_date) && !empty($request->end_date) && $request->end_date != '' && !is_null($request->end_date)) {
                            $getReport->where('INV.invoice_date', '>=', $from);
                            $getReport->where('INV.invoice_date', '<=', $to);
                        }


                        if ($getFirmDetail){
                                if($getFirmDetail->services!=''){
                                    $services = json_decode($getFirmDetail->services);
                                    $getReport->whereIn('SB.service_id', $services);
                                }
                        }


                        if ($main_service_id!=0){
                           $getReport->where('IS.service_id', $service_id);
                        }

                        if ($brand_id!=0){
                            $getReport->where('IS.brand_id', $brand_id);
                         }


                        //echo $getReport->toSql();
                        //die();
                        $reports = $getReport->get();
                        foreach ($reports as $key => $report) {
                            $data['subtotal'] += $report->all_total;
                            $data['html'] .= "<tr>
                                            <td>" . ($key + 1) . "</td>
                                            <td>" . $report->invoice_id . "</td>
                                            <td>" . $report->customer_name . "</td>
                                            <td> <i class='fa fa-inr'></i> " . $report->all_total . "</td>
                                            <td>" . date('d-M-Y', strtotime($report->invoice_date)) . "</td>
                                            <td><button type='button' class='btn btn-info' onclick='getInvoiceDetails($report->invoice_id)'><i class='fa fa-eye'></i></button>
                                            <button type='button' class='btn btn-danger' onclick='deleteInvoice($report->invoice_id)'><i class='fa fa-trash'></i></button></td>
                                         </tr>";
                        }


                // else {
                //     $data['html'] = "";
                //     $data['subtotal'] = 0;
                // }
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
        $service_id = $request->service_id;
        $category_id = $request->category_id;
        $brand_id = $request->brand_id;
        $main_service_id = $request->main_service_id;
        Excel::store(new InvoiceExport($firmid, $start_date, $end_date), 'InvoiceReport.xls');
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
            echo json_encode(['msg' => true]);
        } catch (\Exception $e) {
            echo json_encode(['msg' => false]);
        }
    }
}
