<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\admin\Customer;
use App\Model\admin\CustomerCoupon;
use App\Model\admin\CustomerMemberService;
use App\Model\admin\CustomerPoint;
use App\Model\admin\CustomerSittingPack;
use App\Model\admin\CustomersittingPackMakeupPayment;
use App\Model\admin\CustomersittingPackPayment;
use App\Model\admin\CustomerWallet;
use App\Model\admin\CustomerOffer;
use App\Model\admin\Packages;
use App\Model\admin\Promotional;
use App\Model\admin\ServiceBrand;
use App\Model\admin\ServiceOtherBrand;
use App\Model\admin\Services;
use App\Model\admin\CSPServices;
use App\Model\admin\CSPMakeupServices;
use App\Model\admin\sittingPack;
use App\Model\admin\Staff;
use App\Model\Invoice;
use App\Model\InvoicePackageModel;
use App\Model\InvoicePackageServiceModel;
use App\Model\InvoiceProductModel;
use App\Model\InvoiceRemainingModel;
use App\Model\InvoiceServiceModel;
use App\User;
use DB;
use App\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class QuickSaleController extends Controller
{
    public function index_old()
    {
        // $services = Services::all();
        $firms = DB::table('firms')->get();
        // $staffs = Staff::where('admin',0)->get();
        // $packages = Packages::all();
        // return view('customer.quicksale',compact('services','staffs','products','packages'));
        return view('customer.firms', compact('firms'));
    }

    public function index()
    {
        // $data['service_dropdown'] = '<select class="form-control selectpicker">';
        $service_group = DB::table('service_group')->where('parent_id', 0)->get();
        $sitting_packs = sittingPack::all();
        /*if (!empty($service_group)) {
        foreach ($service_group as $group) {
        $data['service_dropdown'] .= '<optgroup label="'.$group->group_name.'">';
        $services = DB::table('services')->where('group_id',$group->id)->get();
        if (!empty($services)) {
        foreach ($services as $service) {
        $data['service_dropdown'] .= '<option value="'.$service->id.'">'.$service->name.'</option>';
        }
        }
        $data['service_dropdown'] .= '</optgroup>';
        }
        }
        $data['service_dropdown'] .= '</select>';
        echo $data['service_dropdown']; die;*/
        $products = DB::table('products')->get();
        $firms = DB::table('firms')->get();
        $staffs = Staff::where('admin', 0)->get();
        $packages = DB::table('packages')->get();
        $designations = DB::table('designations')->get();
        $locations = DB::table('locations')->get();
        $points = DB::table('points')->get();
        return view('customer.quicksale', compact('service_group', 'staffs', 'products', 'packages', 'firms', 'locations', 'designations', 'points', 'sitting_packs'));
    }

    public function showHistoryVisit()
    {
        $customerid = $_POST['customerid'];
        $history = DB::table('invoice')->where('user_id', $customerid)->get();
        $count = 1;
        foreach ($history as $htry) { ?>
            <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo $htry->subtotal; ?></td>
                <td><?php echo $htry->grand_total; ?></td>
                <td><?php echo $htry->paid_amount; ?></td>
                <td><?php echo $htry->payment_mode; ?></td>
                <td><?php echo date('d-m-Y', strtotime($htry->invoice_date)); ?></td>
                <td><a href="myinvoice/<?php echo $htry->invoice_id; ?>" class="outline-btn" target="_blank">Bill</a></td>
            </tr>
        <?php }
    }

    public function load_location()
    {
        $locations = DB::table('locations')->get();
        ?>
        <option value="">Select Location</option>

        <?php
        foreach ($locations as $loca) { ?>
            <option value="<?php echo $loca->id; ?>"><?php echo $loca->name; ?></option>
        <?php }
    }
    public function load_designation()
    {
        $designations = DB::table('designations')->get();
        ?>
        <option value="">Select Designations</option>

        <?php
        foreach ($designations as $loca) { ?>
            <option value="<?php echo $loca->id; ?>"><?php echo $loca->name; ?></option>
<?php }
    }

    public function checkaccount(Request $request)
    {
        DB::enableQueryLog();
        $number = $request->number;
        // fetch wallet data
        $getWallet = DB::table('customers AS C')
            ->addSelect(DB::raw('SUM(amount_allow-amount_used) AS sum_of_wallet'))
            ->leftJoin('customer_wallet AS CW', 'CW.customer_id', '=', 'C.id')
            ->where('C.contact', $number)->first();
        $cust_Wallet = json_encode($getWallet->sum_of_wallet);

        // fetch gift points
        $getPoints = DB::table('customers AS C')
            ->addSelect(DB::raw('SUM(points_allow-used_points) AS sum_of_points'))
            ->leftJoin('customer_points AS CP', 'CP.customer_id', '=', 'C.id')
            ->where('C.contact', $number)->first();
        $cust_Points = json_encode($getPoints->sum_of_points);

        $getSittingPack = DB::table('customers AS C')
            ->addSelect(DB::raw('COUNT(CP.customer_id) AS sum_of_sittingPack'))
            ->leftJoin('customer_sitting_pack AS CP', 'CP.customer_id', '=', 'C.id')
            ->where('C.contact', $number)->first();
        $cust_sittingPack = json_encode($getSittingPack->sum_of_sittingPack);

        // fetch customer data
        $getUser = DB::table('customers AS C')
            ->leftJoin('invoice AS I', 'I.user_id', '=', 'C.id')
            ->where('C.contact', $number);
        $getUser = $getUser->select('*')->addSelect(DB::raw("$cust_Points as sum_of_points"))
            ->addSelect(DB::raw("$cust_Wallet as sum_of_wallet"))
            ->addSelect(DB::raw("$cust_sittingPack as sum_of_sittingPack"))
            ->first();
        // echo $this->db->last_query(); die;
        echo json_encode($getUser);
    }

    public function updateaccount(Request $request)
    {
        $this->validate($request, [
            'editmobile' => 'required',
            'editname' => 'required',
            'editdob' => 'required',
            'editemail' => 'required',
            'editanniversary' => 'required',
            'editlocation' => 'required',
        ]);

        if (request('editanniversary') != '') {
            $anniversary_date = date('Y-m-d', strtotime($request->get('editanniversary')));
        } else {
            $anniversary_date = null;
        }

        if (request('editdob') != '') {
            $dob = date('Y-m-d', strtotime($request->get('editdob')));
        } else {
            $dob = null;
        }

        $id = $request->get('editid');

        $customer = customer::find($id);
        $customer->name = $request->get('editname');
        $customer->location = $request->get('editlocation');
        $customer->contact = $request->get('editmobile');
        $customer->email = $request->get('editemail');
        $customer->dob = $dob;
        $customer->anniversary_date = $anniversary_date;
        $customer->save();
        echo json_encode($customer);
    }

    public function getlastid(Request $request)
    {
        $data['last_id'] = "";
        $last_record = Customer::orderBy('id', 'desc')->first();
        if ($last_record != '') {
            $last_id = 1 + $last_record->id;
        } else {
            $last_id = 1;
        }
        $data['last_id'] = $last_id;
        echo json_encode($data);
    }

    public function genratecode($tablename, $columnname, $digit)
    {
        $code = $this->generate($digit);
        $checkcode = DB::table($tablename)->select('*')->where($columnname, '=', $code)->count();
        if ($checkcode > 0) {
            $code = $this->genratecode($tablename, $columnname, $digit);
        }
        return $code;
    }

    public function generate($digit)
    {
        $characters = '123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $digit; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function viewservices(Request $request)
    {
        $this->validate(
            $request,
            [
                'packageid' => 'required',
            ],
            [
                'packageid.required' => 'Select package id',
            ]
        );

        $getPackage = Packages::find($request->packageid);
        if (!empty($getPackage)) {
            $staffs = Staff::where('admin', 0)->get();
            $rowArray[] = "";
            $rowdata = "";
            $packageServ = json_decode($getPackage->package_services);
            $i = 0;
            foreach ($packageServ as $key => $value) {
                $getService = Services::find($value->service);
                $rowdata .= '<div class="dynamic_row col-sm-12"><div class="row"><div class="col-md-12 col-12 col-lg-3"><div class="form-group"><label>Service</label><select name="packageService[]" class="form-control"><option value="' . $getService->id . '">' . $getService->name . '</option></select></div></div><div class="col-md-12 col-12 col-lg-3"><div class="form-group"><label>Staff</label><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-heart-o"></i></span></div><select required name="packageStaff' . $i++ . '" class="form-control"><option value="">Select</option>';
                if (!empty($staffs)) {
                    foreach ($staffs as $staff) {
                        $rowdata .= '<option value="' . $staff->id . '">' . $staff->name . '</option>';
                    }
                }
                $rowdata .= '</select></div></div></div><div class="col-md-12 col-12 col-lg-1"><div class="form-group"><label>Qty.</label><input name="packageQuantiy[]" type="text" class="form-control" placeholder="" value="1" readonly></div></div><div class="col-md-12 col-12 col-lg-2"><div class="form-group"><label>Total</label><input readonly type="text" class="form-control" placeholder="" value="0.00"></div></div><div class="form-group"><label style="display: block; visibility: hidden;">Total</label><input type="checkbox" name="checkPackageService[]" checked value="1"></div></div></div></div>';
            }
            $data['hi'] = $rowdata;
            $data['package'] = $getPackage;
            echo json_encode($data);
        }
    }

    public function getServicePrice(Request $request)
    {
        $data = array();
        $getService = ServiceBrand::find($request->service_id);
        if (!empty($getService)) {
            $data['result'] = $getService;
        } else {
            $data['result'] = "Failed";
        }
        echo json_encode($data);
    }

    public function getServicePrice_old(Request $request)
    {
        $data = array();
        $getService = Services::find($request->service_id);
        if (!empty($getService)) {
            $data['result'] = $getService;
        } else {
            $data['result'] = "Failed";
        }
        echo json_encode($data);
    }

    public function getServiceByGroup(Request $request)
    {
        // $data = array();
        $data = '';
        $getService = DB::table('services')->where('group_id', $request->groupid)->get();
        // print_r($getService); die;
        if (!empty($getService)) {
            foreach ($getService as $service) {
                $data .= '<optgroup label="' . $service->name . '">';
                $getServiceBrand = DB::table('service_brands')->where('service_id', $service->id)->get();
                // print_r($getServiceBrand);
                if (!empty($getServiceBrand)) {
                    foreach ($getServiceBrand as $brand) {
                        $data .= '<option value="' . $brand->service_brand_id . '">' . $brand->brand_name . '</option>';
                    }
                }
                $data .= '</optgroup>';
            }
        } else {
            $data = "Failed";
        }
        echo $data;
    }

    public function getProductPrice(Request $request)
    {
        $data = array();
        $products = DB::table('products')->where('id', $request->product_id)->first();
        if (!empty($products)) {
            $data['result'] = $products;
        } else {
            $data['result'] = "Failed";
        }
        echo json_encode($data);
    }

    public function quicksaleInvoice(Request $request)
    {
        // echo "<pre>";
        // print_r($_POST);
        // die;
        $customer_id = $request->customer_id;
        $searchnumber = $request->searchnumber;
        if (!isset($request->discountByValue)) {
            $discountByValue = 0;
        } else {
            $discountByValue = $request->discountByValue;
        }
        if (!isset($request->discountByPercent)) {
            $discountByPercent = 0;
        } else {
            $discountByPercent = $request->discountByPercent;
        }

        // $discountByPercent = $request->discountByPercent;
        $subtotalamount = $request->subtotalamount;
        $totalinputSgst = $request->totalinputSgst;
        $totalinputCgst = $request->totalinputCgst;
        $totalgrandTotal = $request->totalgrandTotal;
        $payLater = $request->payLater;
        $totaltax = $request->totaltax;
        $billingdate = $request->billingdate;
        $invoice_type = $request->invoice_type;
        if ($invoice_type == "Send via SMS") {
            $invoice_type = 1;
        } else if ($invoice_type == "Bill with amount") {
            $invoice_type = 2;
        } else if ($invoice_type == "Bill without amount") {
            $invoice_type = 3;
        } else {
            $invoice_type = 0;
        }
        // $services = $request->services;
        $serviceRowCount = $request->serviceRowCount;
        $serviceStaff = $request->serviceStaff;
        $serviceQuantity = $request->serviceQuantity;
        $servicesSgst = $request->servicesSgst;
        $servicesCgst = $request->servicesCgst;
        $servicePriceTotal = $request->servicePriceTotal;
        $servicePrice = $request->servicePrice;
        $serviceDisc = $request->serviceDisc;
        $serviceTotal = $request->serviceTotal;

        $products = $request->products;
        $productRowCount = $request->productRowCount;
        $productStaff = $request->productStaff;
        $productQty = $request->productQty;
        $productSgst = $request->productSgst;
        $productCgst = $request->productCgst;
        $productPriceTotal = $request->productPriceTotal;
        $productPrice = $request->productPrice;
        $productDisc = $request->productDisc;
        $productTotal = $request->productTotal;

        $package = $request->package;
        $packageRowCount = $request->packageRowCount;
        $pacakgePrice = $request->pacakgePrice;
        $packageSgst = $request->packageSgst;
        $packageCgst = $request->packageCgst;
        $packagePriceTotal = $request->packagePriceTotal;
        $packageDisc = $request->packageDisc;
        $packageTotal = $request->packageTotal;
        $packageService = $request->packageService;
        $packageStaff = $request->packageStaff;
        $packageQuantiy = $request->packageQuantiy;
        $checkPackageService = $request->checkPackageService;

        $sitpackageRowCount = $request->sitpackageRowCount;
        $sittingPayment = $request->sittingPayment;
        $sittingDate = $request->sittingDate;
        $sittingTime = $request->sittingTime;
        $makeupPayment = $request->makeupPayment;
        $makeupDate = $request->makeupDate;
        $makeupTime = $request->makeupTime;
        $packageAdvancePayment = $request->packageAdvancePayment;

        $remark = $request->remark;
        if ($payLater != 0) {
            $paid_amount = 0;
        } else {
            $paid_amount = $totalgrandTotal;
        }
        $matchCase = ['user_id' => $customer_id, 'all_total' => $totalgrandTotal, 'invoice_date' => date('Y-m-d'), 'paid_amount' => $paid_amount];
        $existing_invoice = Invoice::where($matchCase)->get();
        // print_r($existing_invoice);
        //     dd('hy');
        if ($existing_invoice->isEmpty()) {
            $invoice = new Invoice([
                'user_id' => $customer_id,
                'subtotal' => $subtotalamount,
                'cgst' => $totalinputCgst,
                'sgst' => $totalinputSgst,
                'payment_mode' => "Cash",
                'total_discont_percent' => $discountByPercent,
                'total_discount_value' => $discountByValue,
                'grand_total' => $totalgrandTotal,
                'all_total' => $totalgrandTotal,
                'paid_amount' => $paid_amount,
                'payable_amount' => $payLater,
                'remark' => $remark,
                'invoice_type' => $invoice_type,
                'invoice_date' => date('Y-m-d'),
                'payment_status' => 1,
                'status' => 1,
                'checkin' => 1,
            ]);
            $invoice->save();
            $invoiceid = $invoice->invoice_id;

            if (!empty($invoiceid)) {
                // $customer_point= CustomerPoint::where('customer_id',$customer_id)->get();
                // if($customer_point->isEmpty()){
                $customer_point = new CustomerPoint;
                $customer_point->customer_id = $customer_id;
                $customer_point->invoice_id = $invoiceid;
                $customer_point->points_allow = $request->totalredeempoint;
                $customer_point->used_points = $request->gift_points;
                $customer_point->save();

                $Customer_Wallet = new CustomerWallet();
                $Customer_Wallet->amount_allow = 0;
                $Customer_Wallet->customer_id = $customer_id;
                $Customer_Wallet->remark='From Invoice';
                if (isset($request->cust_wallet)) {
                    $Customer_Wallet->amount_used = $request->cust_wallet;
                } else {
                    $Customer_Wallet->amount_used = 0;
                }

                $Customer_Wallet->invoice_id = $invoiceid;
                $Customer_Wallet->created_at = date('Y/m/d H:i:s');
                $Customer_Wallet->save();


                if (Session::has('frnd_wallet_value')){
                    $frnd_wallet_value=Session::pull('frnd_wallet_value');
                    $frnd_id=Session::pull('frnd_id');
                    $frnd_wallet_remark=Session::pull('frnd_wallet_remark');
                    $frnd_offer_id=Session::pull('frnd_off_id');

                    //add amount to friend wallet
                    $Customer_Wallet = new CustomerWallet();
                    $Customer_Wallet->amount_allow = $frnd_wallet_value;
                    $Customer_Wallet->customer_id = $frnd_id;
                    $Customer_Wallet->amount_used = 0;
                    $Customer_Wallet->invoice_id = 0;
                    $Customer_Wallet->remark=$frnd_wallet_remark;
                    $Customer_Wallet->created_at = date('Y/m/d H:i:s');
                    $Customer_Wallet->save();

                    //update Customeroffer by used client
                    $Customer_Offer = CustomerOffer::where('offer_id','=',$frnd_offer_id)->first();
                    $Customer_Offer->used_by = $cust_data->id;
                    $Customer_Offer->save();
                }

                if ((int) $request->cust_coupon_id > 0) {
                    $CustomerCoupon_data = CustomerCoupon::join('coupon','coupon.id','=','customer_coupon.coupon_id')->where([
                        ['coupon_id', '=', $request->cust_coupon_id],
                        ['customer_id', '=', $customer_id],
                    ])->get();
                    if (!$CustomerCoupon_data->isEmpty()) {
                        foreach ($CustomerCoupon_data as $key => $CustomerCoupon_value) {
                            $CustomerCoupon_value->coupon_used_count += 1;
                            if ($CustomerCoupon_value->coupon_used_count>=$CustomerCoupon_value->allow_count) {
                                $CustomerCoupon_value->status = 1;
                            }
                            $CustomerCoupon_value->save();
                        }
                    }
                }
                if ($payLater != 0) {
                    $remaining = new InvoiceRemainingModel([
                        'invoice_id' => $invoiceid,
                        'user_id' => $customer_id,
                        'paid_amount' => 0,
                        'remaining_amount' => $payLater,
                        'payment_mode' => 'NA',
                        'status' => 0,
                    ]);
                    $remaining->save();
                }
                if ($serviceRowCount != 0) {
                    for ($i = 0; $i < $serviceRowCount - 1; $i++) {
                        $invoiceservice = new InvoiceServiceModel([
                            'invoice_id' => $invoiceid,
                            'service_id' => $_POST['brand_' . $i],
                            'brand_id' => $_POST['services_' . $i],
                            'staff_id' => $_POST['serviceStaff' . $i],
                            'quantity' => $serviceQuantity[$i],
                            'price' => $servicePrice[$i],
                            'discount' => $serviceDisc[$i],
                            'cgst' => $servicesCgst[$i],
                            'sgst' => $servicesSgst[$i],
                            'total_price' => $serviceTotal[$i],
                            'other_service_id' => $request->other_service_invoice_id,
                            'service_status' => 1,
                        ]);
                        $invoiceservice->save();
                        if ((int) $request->cust_member_sys_id > 0) {
                            $Customer_Member_Service_data = CustomerMemberService::where([
                                ['member_sys_id', '=', $request->cust_member_sys_id],
                                ['customer_id', '=', $customer_id],
                                ['service_id', '=', $_POST['brand_' . $i]],
                            ])->get();

                            if (!$Customer_Member_Service_data->isEmpty()) {
                                foreach ($Customer_Member_Service_data as $key => $Customer_Member_Service) {
                                    $cust_service_last_used = $Customer_Member_Service->service_last_used;
                                    $Customer_Member_Service->service_free_count += 1;
                                    if (!empty($cust_service_last_used)) {
                                        $lastdateValue = date('Y/m/d H:i:s', strtotime($cust_service_last_used));
                                        $lastdateValuetime = strtotime($lastdateValue);
                                        $lastdateValuemonth = date("F", $lastdateValuetime);
                                        $currdateValue = date('Y/m/d H:i:s');
                                        $currdateValuetime = strtotime($currdateValue);
                                        $currdateValuemonth = date("F", $currdateValuetime);
                                        if ($lastdateValuemonth == $currdateValuemonth) {
                                            $Customer_Member_Service->service_per_month_count += 1;
                                        }
                                    } else {
                                        $Customer_Member_Service->service_per_month_count = 1;
                                    }
                                    $Customer_Member_Service->service_last_used = date('Y/m/d H:i:s');
                                    $Customer_Member_Service->save();
                                }
                            }
                        }
                    }
                }

                // die();

                if ($productRowCount != 0) {
                    for ($i = 0; $i < $productRowCount; $i++) {
                        $invoiceproduct = new InvoiceProductModel([
                            'invoice_id' => $invoiceid,
                            'product_id' => $_POST['products_' . $i],
                            'staff_id' => $_POST['productStaff' . $i],
                            'quantity' => $productQty[$i],
                            'price' => $productPrice[$i],
                            'discount' => $productDisc[$i],
                            'cgst' => $productCgst[$i],
                            'sgst' => $productSgst[$i],
                            'total_price' => $productTotal[$i],
                            'product_status' => 1,
                        ]);
                        $invoiceproduct->save();
                    }
                }

                if ($packageRowCount != 0) {
                    for ($i = 0; $i < $packageRowCount; $i++) {
                        $invoicepackage = new InvoicePackageModel([
                            'invoice_id' => $invoiceid,
                            'package_id' => $_POST['package_' . $i],
                            // 'staff_id' => $productStaff.$i,
                            // 'quantity' => 1,
                            'price' => $pacakgePrice[$i],
                            'discount' => 0,
                            'cgst' => 0,
                            'sgst' => 0,
                            'total_price' => $packageTotal[$i],
                            'package_status' => 1,
                        ]);
                        $invoicepackage->save();
                        $invoicepackageid = $invoicepackage->invoice_package_id;
                        if (!empty($invoicepackageid)) {
                            for ($i = 0; $i < count($packageService); $i++) {
                                if (!isset($checkPackageService[$i])) {
                                    $checkPackageService[$i] = 0;
                                }
                                $invoicepackageservice = new InvoicePackageServiceModel([
                                    'invoice_package_id' => $invoicepackageid,
                                    'service_id' => $packageService[$i],
                                    'quantity' => $packageQuantiy[$i],
                                    'total' => 0,
                                    'use_status' => $checkPackageService[$i],
                                ]);
                                $invoicepackageservice->save();
                            }
                        }
                    }
                }

                if ($sitpackageRowCount != 0) {
                    $sitpackid = $_POST['package_0'];
                    $alternative_phone = isset($request->cust_sitpack_alternate) ? $request->cust_sitpack_alternate : '0';
                    $full_address = isset($request->cust_sitpack_fulladdress) ? $request->cust_sitpack_fulladdress : 'NA';
                    $CustomerSittingPack_data = CustomerSittingPack::where([
                        ['sittingpack_id', '=', $sitpackid],
                        ['customer_id', '=', $customer_id],
                        ['invoice_id', '=', $invoiceid],
                    ])->get();
                    if ($CustomerSittingPack_data->isEmpty()) {
                        $Customer_Sitting_Pack = new CustomerSittingPack();
                        $Customer_Sitting_Pack->sittingpack_id = $sitpackid;
                        $Customer_Sitting_Pack->customer_id = $customer_id;
                        $Customer_Sitting_Pack->invoice_id = $invoiceid;
                        $Customer_Sitting_Pack->alternative_phone = $alternative_phone;
                        $Customer_Sitting_Pack->sitpack_final_price = $pacakgePrice[0];
                        $Customer_Sitting_Pack->full_address = $full_address;
                        $Customer_Sitting_Pack->packageAdvancePayment = $packageAdvancePayment[0];
                        $Customer_Sitting_Pack->expire_date = date('Y-m-d H:i:s', strtotime('+7days'));
                        $Customer_Sitting_Pack->member_otp = rand(1000, 9999);
                        $Customer_Sitting_Pack->save();
                        $CSP_id = $Customer_Sitting_Pack->id;
                    } else {
                        // $CustomerSittingPack_data[0]->invoice_id = $invoiceid;
                        $CustomerSittingPack_data[0]->alternative_phone = $alternative_phone;
                        $CustomerSittingPack_data[0]->full_address = $full_address;
                        $CustomerSittingPack_data[0]->packageAdvancePayment = $packageAdvancePayment[0];
                        $CustomerSittingPack_data[0]->save();
                        $CSP_id = $CustomerSittingPack_data[0]->id;
                    }
                    for ($j = 0; $j < count($sittingPayment); $j++) {
                        $CustomersittingPack_Payment = new CustomersittingPackPayment();
                        $CustomersittingPack_Payment->CSP_id = $CSP_id;
                        $CustomersittingPack_Payment->sittingpack_id = $sitpackid;
                        $CustomersittingPack_Payment->customer_id = $request->customer_id;
                        $CustomersittingPack_Payment->invoice_id = 0;
                        $CustomersittingPack_Payment->sitting_round = ($j + 1);
                        $CustomersittingPack_Payment->sittingPayment = $sittingPayment[$j];
                        $CustomersittingPack_Payment->sitting_date = $sittingDate[$j];
                        $CustomersittingPack_Payment->sitting_time = $sittingTime[$j];
                        $CustomersittingPack_Payment->sittingStatus = "UnPaid";
                        $CustomersittingPack_Payment->save();
                        $round = ($j + 1);
                        $round_services = $_POST['sitpack_' . $round . 'services'];
                        for ($l = 0; $l < count($round_services); $l++) {
                            $CSP_Services = new CSPServices();
                            $CSP_Services->CSP_id = $CSP_id;
                            $CSP_Services->sittingpack_id = $sitpackid;
                            $CSP_Services->sitpack_round = ($j + 1);
                            $CSP_Services->customer_id = $request->customer_id;
                            $CSP_Services->invoice_id = 0;
                            $CSP_Services->brand_id = $_POST['sitpack_' . $round . 'services'][$l];
                            $CSP_Services->service_id = $_POST['sitpack_' . $round . 'brand'][$l];
                            $CSP_Services->total_price = $_POST['sitpack_' . $round . 'serviceTotal'][$l];
                            $CSP_Services->quantity = $_POST['sitpack_' . $round . 'serviceQuantity'][$l];
                            $CSP_Services->save();
                        }
                    }
                    for ($k = 0; $k < count($makeupPayment); $k++) {
                        $Customer_sittingPack_Makeup_Payment = new CustomersittingPackMakeupPayment();
                        $Customer_sittingPack_Makeup_Payment->CSP_id = $CSP_id;
                        $Customer_sittingPack_Makeup_Payment->sittingpack_id = $sitpackid;
                        $Customer_sittingPack_Makeup_Payment->customer_id = $request->customer_id;
                        $Customer_sittingPack_Makeup_Payment->invoice_id = 0;
                        $Customer_sittingPack_Makeup_Payment->makeup_round = ($k + 1);
                        $Customer_sittingPack_Makeup_Payment->makeupPayment = $makeupPayment[$k];
                        $Customer_sittingPack_Makeup_Payment->makeupDate = $makeupDate[$k];
                        $Customer_sittingPack_Makeup_Payment->makeupTime = $makeupTime[$k];
                        $Customer_sittingPack_Makeup_Payment->makeupStatus = "UnPaid";
                        $Customer_sittingPack_Makeup_Payment->save();
                        // CSPMakeupServices
                        $mkpround = ($k + 1);
                        $round_services = $_POST['makeup_' . $mkpround . 'services'];
                        for ($m = 0; $m < count($round_services); $m++) {
                            $CSP_MakeupServices = new CSPMakeupServices();
                            $CSP_MakeupServices->CSP_id = $CSP_id;
                            $CSP_MakeupServices->sittingpack_id = $sitpackid;
                            $CSP_MakeupServices->makeup_round = ($k + 1);
                            $CSP_MakeupServices->customer_id = $request->customer_id;
                            $CSP_MakeupServices->invoice_id = 0;
                            $CSP_MakeupServices->brand_id = $_POST['makeup_' . $mkpround . 'services'][$m];
                            $CSP_MakeupServices->service_id = $_POST['makeup_' . $mkpround . 'brand'][$m];
                            $CSP_MakeupServices->total_price = $_POST['makeup_' . $mkpround . 'serviceTotal'][$m];
                            $CSP_MakeupServices->quantity = $_POST['makeup_' . $mkpround . 'serviceQuantity'][$m];
                            $CSP_MakeupServices->save();
                        }
                    }
                    $cust_sitpack_id = $request->cust_sitpack_id;
                    $cust_sitpackround_id = $request->cust_sitpackround_id;
                    if ($cust_sitpack_id != 0) {
                        $CSP_Installment = CustomersittingPackPayment::where([
                            ['sittingpack_id', '=', $cust_sitpack_id],
                            ['customer_id', '=', $customer_id],
                            ['sitting_round', '=', $cust_sitpackround_id],
                        ])->first();
                        $CSP_Installment->invoice_id = $invoiceid;
                        $CSP_Installment->sittingStatus = "Paid";
                        $CSP_Installment->save();
                    }
                }

                $customer = customer::find($customer_id);
                $total_visit = $customer->total_visit + 1;
                $total_revenue = $customer->total_revenue + $totalgrandTotal;
                $last_visit_date = date('Y-m-d');
                $customer->total_visit = $total_visit;
                if ($payLater != 0) {
                    $customer->total_revenue = $total_revenue;
                }
                $customer->last_visit_date = $last_visit_date;
                $customer->save();
                if ($invoice_type == 1) {
                    //$text = 'Hi ' . $customer->name . ', your bill is ready to review. The amount due is ' . $totalgrandTotal . ' if paid by ' . date('d-M-Y');
                    //$message = urlencode($text);
                    // other parametes might also contain spaces ...
                    //$username = urlencode('cvsalon');
                    //$sendername = urlencode('CVslon');
                    //etc
                    // file_get_contents("http://sms.hspsms.com/sendSMS?username=cvsalon&message=" . $message . "&sendername=CVslon&smstype=TRANS&numbers=" . $customer->contact . "&apikey=9d0e9d96-143f-4141-ab1a-e32d648bd098");
                    if ($sitpackageRowCount != 0) {
                        $message = 'http://chinnievinnie.in/cvsalon/mypackinvoice/'. $invoiceid;
                    }else {
                        $message = 'http://chinnievinnie.in/cvsalon/myinvoice/'. $invoiceid;
                    }
                    Helper::sendMobileSMS($customer->contact, $message);
                    return redirect()->back()->with('success', 'Sms send');
                } elseif ($invoice_type == 3) {
                    return redirect()->to('myinvoice_withoutAmount/' . $invoiceid);
                } else {
                    if ($sitpackageRowCount != 0) {
                        $link='http://chinnievinnie.in/cvsalon/mypackinvoice/'. $invoiceid;
                        $package_msg='Hi ! Thanks for taking Chinnie and Vinnie package you can click the link below to view your package details '.$link;
                        Helper::sendMobileSMS($customer->contact, $package_msg);
                        return redirect()->to('mypackinvoice/' . $invoiceid);
                    } else {
                        return redirect()->to('myinvoice/' . $invoiceid);
                    }
                }
            }
        } else {
            // echo "hy";
            $invoiceid = $existing_invoice[0]->invoice_id;

            if ($invoice_type == 1) {
                $customer = customer::find($customer_id);
                $text = 'Hi ' . $customer->name . ', your bill is ready to review. The amount due is ' . $totalgrandTotal . ' if paid by ' . date('d-M-Y');
                $message = urlencode($text);
                // other parametes might also contain spaces ...
                $username = urlencode('cvsalon');
                $sendername = urlencode('CVslon');
                //etc
                file_get_contents("http://sms.hspsms.com/sendSMS?username=cvsalon&message=" . $message . "&sendername=CVslon&smstype=TRANS&numbers=" . $customer->contact . "&apikey=9d0e9d96-143f-4141-ab1a-e32d648bd098");

                // file_get_contents("http://arise.arisesmsworld.com/submitsms.jsp?user=SEYEIT&key=55524d5999XX&mobile=".$customer->contact."&message=".$message."&senderid=HAPPST&accusage=1");
                // file_get_contents("http://sms.hspsms.com/sendSMS?username=".$username."&message=".$message."&sendername=".$sendername."&smstype=TRANS&numbers=".$customer->contact."&apikey=9d0e9d96-143f-4141-ab1a-e32d648bd098");
                return redirect()->back()->with('success', 'Sms send');
            } elseif ($invoice_type == 3) {
                return redirect()->to('myinvoice_withoutAmount/' . $invoiceid);
            } else {
                if ($sitpackageRowCount != 0) {
                    return redirect()->to('mypackinvoice/' . $invoiceid);
                } else {
                    return redirect()->to('myinvoice/' . $invoiceid);
                }
            }
        }
    }

    public function pushsms(Request $request)
    {
        $offer_title = $request->offer_title;
        $offer_sms = $request->offer_sms;
        $end_date = date('Y-m-d', strtotime($request->end_date));
        $message = $offer_title . "\r\n" . $offer_sms . "\r\n" . date('d-M-Y', strtotime($request->end_date)) . "
	    	";
        $customers = Customer::all();
        if (!empty($customers)) {
            foreach ($customers as $customer) {
                $contact = $customer->contact;
                $id = $customer->id;
                $promotional = new Promotional([
                    'offer_title' => $offer_title,
                    'contact_number' => $contact,
                    'offer_sms' => $message,
                    'status' => 1,
                ]);
                $promotional->save();
                $id = $promotional->id;
                if (!empty($id)) {
                    //file_get_contents("http://arise.arisesmsworld.com/submitsms.jsp?user=SEYEIT&key=55524d5999XX&mobile=".$contact."&message=".urlencode($message)."&senderid=HAPPST&accusage=1");
                    file_get_contents("http://sms.hspsms.com/sendSMS?username=cvsalon&message=" . urlencode($message) . "&sendername=CVslon&smstype=TRANS&numbers=" . $contact . "&apikey=9d0e9d96-143f-4141-ab1a-e32d648bd098");
                }
            }
        }
        echo "Done";
    }

    public function mypackinvoice($invoiceid)
    {
        $invoicedata = DB::table('invoice AS I')
            ->select('C.*', 'I.*', 'I.remark AS iremark')->leftJoin('customers AS C', 'C.id', '=', 'I.user_id')
            ->where('I.invoice_id', $invoiceid)
            ->first();
        // print_r($invoicedata);
        return view('customer.mypackinvoice', compact('invoicedata'));
    }

    public function invoice_search(Request $request){
        try {
            $invoice_id=$request->invoice_id;
            $invoice_data = DB::table('invoice')->where('invoice_id', $invoice_id)->get();
            echo json_encode(['msg' => true, 'data' => $invoice_data]);
        } catch (\Exception $e) {
            echo json_encode(['msg' => false]);
            // return back()->with('msg', 'something went wrong');
        }
    }

    public function myinvoice($invoiceid)
    {
        /*$invoicedata = DB::table('invoice AS I')
        ->select('I.*','P.package_title','IP.price AS package_price','IP.discount AS package_discount','IP.cgst AS package_cgst','IP.sgst AS package_sgst','IP.total_price AS package_total','SP.product_name','U.name AS product_staff_name','IPR.quantity AS product_quantity','IPR.price AS product_price','IPR.discount AS product_discount','IPR.cgst AS product_cgst','IPR.sgst AS product_sgst','IPR.total_price AS product_total','SE.name AS service_name','SU.name AS service_staff_name','IS.quantity AS service_quantity','IS.price AS service_price','IS.discount AS service_discount','IS.cgst AS service_cgst','IS.sgst AS service_sgst','IS.total_price AS service_total','C.name AS customer_name','C.email AS customer_email','C.contact AS customer_contact','C.location AS customer_location')
        ->leftJoin('invoice_package AS IP','IP.invoice_id','=','I.invoice_id')
        ->leftJoin('packages AS P','P.package_id','=','IP.package_id')
        ->leftJoin('invoice_product AS IPR','IPR.invoice_id','=','I.invoice_id')
        ->leftJoin('users AS U','U.id','=','IPR.staff_id')
        ->leftJoin('service_products AS SP','SP.product_id','=','IPR.product_id')
        ->leftJoin('invoice_service AS IS','IS.invoice_id','=','I.invoice_id')
        ->leftJoin('services AS SE','SE.id','=','IS.service_id')
        ->leftJoin('users AS SU','SU.id','=','IS.staff_id')
        ->leftJoin('customers AS C','C.id','=','I.user_id')
        ->where('I.invoice_id',$invoiceid)
        ->get();*/
        /*$invoicedata = DB::table('invoice AS I')
        ->leftJoin('customers AS C','C.id','=','I.user_id')
        ->where('I.invoice_id',$invoiceid)
        ->first();*/
        $invoicedata = DB::table('invoice AS I')
            ->select('C.*', 'I.*', 'I.remark AS iremark')->leftJoin('customers AS C', 'C.id', '=', 'I.user_id')
            ->where('I.invoice_id', $invoiceid)
            ->first();
        // print_r($invoicedata);
        return view('customer.newinvoice2', compact('invoicedata'));
    }
    public function myinvoice_withoutAmount($invoiceid)
    {
        $invoicedata = DB::table('invoice AS I')
            ->select('C.*', 'I.*', 'I.remark AS iremark')->leftJoin('customers AS C', 'C.id', '=', 'I.user_id')
            ->where('I.invoice_id', $invoiceid)
            ->first();
        // print_r($invoicedata);
        return view('customer.myinvoice_withoutAmount', compact('invoicedata'));
    }

    public function cust_all_invoices($cust_id)
    {
        $invoicedata = DB::table('invoice AS I')
            ->select('C.*', 'I.*', 'I.remark AS iremark')->leftJoin('customers AS C', 'C.id', '=', 'I.user_id')
            ->where('I.user_id', $cust_id)
            ->orderBy('I.invoice_id', 'DESC')
            ->get();
        return view('customer.all_invoices', compact('invoicedata'));
    }
    public function myinvoiceNew($invoiceid)
    {
        /*$invoicedata = DB::table('invoice AS I')
        ->select('I.*','P.package_title','IP.price AS package_price','IP.discount AS package_discount','IP.cgst AS package_cgst','IP.sgst AS package_sgst','IP.total_price AS package_total','SP.product_name','U.name AS product_staff_name','IPR.quantity AS product_quantity','IPR.price AS product_price','IPR.discount AS product_discount','IPR.cgst AS product_cgst','IPR.sgst AS product_sgst','IPR.total_price AS product_total','SE.name AS service_name','SU.name AS service_staff_name','IS.quantity AS service_quantity','IS.price AS service_price','IS.discount AS service_discount','IS.cgst AS service_cgst','IS.sgst AS service_sgst','IS.total_price AS service_total','C.name AS customer_name','C.email AS customer_email','C.contact AS customer_contact','C.location AS customer_location')
        ->leftJoin('invoice_package AS IP','IP.invoice_id','=','I.invoice_id')
        ->leftJoin('packages AS P','P.package_id','=','IP.package_id')
        ->leftJoin('invoice_product AS IPR','IPR.invoice_id','=','I.invoice_id')
        ->leftJoin('users AS U','U.id','=','IPR.staff_id')
        ->leftJoin('service_products AS SP','SP.product_id','=','IPR.product_id')
        ->leftJoin('invoice_service AS IS','IS.invoice_id','=','I.invoice_id')
        ->leftJoin('services AS SE','SE.id','=','IS.service_id')
        ->leftJoin('users AS SU','SU.id','=','IS.staff_id')
        ->leftJoin('customers AS C','C.id','=','I.user_id')
        ->where('I.invoice_id',$invoiceid)
        ->get();*/
        /*$invoicedata = DB::table('invoice AS I')
        ->leftJoin('customers AS C','C.id','=','I.user_id')
        ->where('I.invoice_id',$invoiceid)
        ->first();*/
        $invoicedata = DB::table('invoice AS I')
            ->select('C.*', 'I.*', 'I.remark AS iremark')->leftJoin('customers AS C', 'C.id', '=', 'I.user_id')
            ->where('I.invoice_id', $invoiceid)
            ->first();
        // print_r($invoicedata);
        return view('customer.newinvoice2', compact('invoicedata'));
    }

    public function getUnpaidAmount(Request $request)
    {
        $data['html'] = '';
        $invoice_id = $request->invoice_id;
        $getDetails = DB::table('invoice')->where('invoice_id', $invoice_id)->first();
        if (!empty($getDetails)) {
            $data['html'] .= '<td>' . $getDetails->invoice_id . '</td><td>' . date('d-M-Y', strtotime($getDetails->invoice_date)) . '</td><td> <i class="fa fa-inr"></i> ' . $getDetails->payable_amount . '</td><td> <i class="fa fa-inr"></i> ' . $getDetails->payable_amount . '</td><td><button type="button" onclick="paidRemainingAmount()" class="theme-btn">Pay</button></td>';
        }
        echo json_encode($data);
    }

    public function findResponce(Request $request)
    {
        $resp = [];
        //$search_query = mysqli_real_escape_string($conn,$request->search_query);
        $getCustomer = DB::table('customers')->where('contact', 'LIKE', "%{$request->search_query}%")->get();
        if (!empty($getCustomer)) {
            foreach ($getCustomer as $data) {
                $resp['contact'][] = $data->contact;
                $resp['id'][] = $data->id;
                $resp['name'][] = $data->name;
                $resp['verify_otp'][] = $data->verify_otp;
                $resp['is_verified'][] = $data->is_verified;
            }
        }

        // $query = mysqli_query($conn, $sql);
        /*while($data = mysqli_fetch_array($query))
        {
        $resp[] = $data['contact'];
        }*/
        echo json_encode($resp);
    }

    public function store(Request $request)
    {
        // print_r($_POST); die;
        // dd('asjdfljasdlf');
        $customer_code = $this->genratecode('customers', 'customer_code', 6);

        $this->validate(
            $request,
            [
                'name' => 'required|unique:customers,name',
                'contact' => 'required',
                // 'gender'=>'required',
                /*'gender'=>'required',*/
                // 'package_id'=>'required',
                // 'cust_type'=>'required',
                // 'referred_by' => 'nullable|exists:customers,referral_code'
                // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'name.required' => 'Enter customer name',
                'contact.required' => 'Enter customer contact',
                // 'gender.required' => 'Select gender',
                // 'cust_type.required' => 'Select customer type',
                // 'referred_by.required' => 'Please enter refferal code',
                // 'referred_by.exists' => 'Please enter valid refferal code'
            ]
        );
        if ($request->file('image') != null) {
            // dd($request->file('image'));
            $input['image'] = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/customer'), $input['image']);
        } else {
            $input['image'] = "";
        }

        if (request('anniversary_date') != '') {
            $anniversary_date = date('Y-m-d', strtotime($request->get('anniversary_date')));
        } else {
            $anniversary_date = null;
        }

        if (request('dob') != '') {
            $dob = date('Y-m-d', strtotime($request->get('dob')));
        } else {
            $dob = null;
        }

        $hashcode = md5($request->get('referral_code'));
        if (!empty($request->get('referred_by'))) {
            $refferuser = DB::table('customers')->where('referral_code', $request->get('referred_by'))->first();
            if (!empty($refferuser)) {
                $customer = new customer([
                    'admin_id' => Auth::user()->id,
                    'customer_id' => $request->get('customer_id'),
                    'cust_type' => $request->get('cust_type'),
                    'name' => $request->get('name'),
                    'customer_image' => $input['image'],
                    'location' => $request->get('location'),
                    'contact' => $request->get('contact'),
                    'other_contact' => $request->get('other_contact'),
                    'email' => $request->get('email'),
                    'dob' => $dob,
                    'referral_code' => $request->get('referral_code'),
                    'referral_hash_code' => $hashcode,
                    'referred_by' => $request->get('referred_by'),
                    'reward_points' => $request->get('reward_points'),
                    'anniversary_date' => $anniversary_date,
                    'customer_code' => $customer_code,
                    'rf_id' => $request->get('rf_id'),
                    'remark' => $request->get('remark'),
                    'gender' => $request->get('gender'),
                    'designation' => $request->get('designation'),
                    'total_visit' => 0,
                    'total_revenue' => 0,
                    'customer_status' => 1,
                ]);
                $customer->save();
                if ($request->get('contact') != "" && $request->get('contact') != null) {
                    $message = urlencode('Dear User, You have successfully registered ...');
                    $message2 = urlencode('Dear User, You can share and earn reward points. Your refferal link is ' . url('signup/' . $hashcode));
                    // other parametes might also contain spaces ...
                    $username = urlencode('cvsalon');
                    $sendername = urlencode('CVslon');

                    //file_get_contents("http://arise.arisesmsworld.com/submitsms.jsp?user=SEYEIT&key=55524d5999XX&mobile=".$request->get('contact')."&message=".$message."&senderid=HAPPST&accusage=1");
                    file_get_contents("http://sms.hspsms.com/sendSMS?username=cvsalon&message=" . $message . "&sendername=CVslon&smstype=TRANS&numbers=" . $request->get('contact') . "&apikey=9d0e9d96-143f-4141-ab1a-e32d648bd098");

                    file_get_contents("http://sms.hspsms.com/sendSMS?username=cvsalon&message=" . $message2 . "&sendername=CVslon&smstype=TRANS&numbers=" . $request->get('contact') . "&apikey=9d0e9d96-143f-4141-ab1a-e32d648bd098");
                    // file_get_contents("http://arise.arisesmsworld.com/submitsms.jsp?user=SEYEIT&key=55524d5999XX&mobile=".$request->get('contact')."&message=".$message2."&senderid=HAPPST&accusage=1");

                }
                return redirect('admin/customer')->with('success', 'Customer saved!');
            }
        } else {
            $customer = new customer([
                'admin_id' => Auth::user()->id,
                'customer_id' => $request->get('customer_id'),
                'cust_type' => $request->get('cust_type'),
                'name' => $request->get('name'),
                'customer_image' => $input['image'],
                'location' => $request->get('location'),
                'contact' => $request->get('contact'),
                'other_contact' => $request->get('other_contact'),
                'email' => $request->get('email'),
                'dob' => $dob,
                'referral_code' => $request->get('referral_code'),
                'referral_hash_code' => $hashcode,
                'referred_by' => "",
                'reward_points' => $request->get('reward_points'),
                'anniversary_date' => $anniversary_date,
                'customer_code' => $customer_code,
                'rf_id' => $request->get('rf_id'),
                'remark' => $request->get('remark'),
                'gender' => $request->get('gender'),
                'designation' => $request->get('designation'),
                'total_visit' => 0,
                'total_revenue' => 0,
                'customer_status' => 1,
            ]);
            $customer->save();
            if ($request->get('contact') != "" && $request->get('contact') != null) {
                $message = urlencode('Dear User, You have successfully registered ...');
                $message2 = urlencode('Dear User, You can share and earn reward points. Your refferal link is ' . url('signup/' . $hashcode));
                // other parametes might also contain spaces ...
                $username = urlencode('cvsalon');
                $sendername = urlencode('CVslon');
                $to = $request->get('contact');

                file_get_contents("http://sms.hspsms.com/sendSMS?username=cvsalon&message=" . $message . "&sendername=CVslon&smstype=TRANS&numbers=" . $request->get('contact') . "&apikey=9d0e9d96-143f-4141-ab1a-e32d648bd098");

                //  file_get_contents("http://arise.arisesmsworld.com/submitsms.jsp?user=SEYEIT&key=55524d5999XX&mobile=".$request->get('contact')."&message=".$message."&senderid=HAPPST&accusage=1");

                file_get_contents("http://sms.hspsms.com/sendSMS?username=cvsalon&message=" . $message . "&sendername=CVslon&smstype=TRANS&numbers=" . $request->get('contact') . "&apikey=9d0e9d96-143f-4141-ab1a-e32d648bd098");

                //  file_get_contents("http://arise.arisesmsworld.com/submitsms.jsp?user=SEYEIT&key=55524d5999XX&mobile=".$request->get('contact')."&message=".$message2."&senderid=HAPPST&accusage=1");

            }
            return redirect('QuickSaleController')->with('success', 'Customer saved!');
        }
    }

    public function addaccount(Request $request)
    {
        // print_r($_POST); die;
        $customer_code = $this->genratecode('customers', 'customer_code', 6);
        $this->validate(
            $request,
            [
                'name' => 'required',
                'contact' => 'required',
                'cust_type' => 'required',
            ],
            [
                'name.required' => 'Enter customer name',
                'contact.required' => 'Enter customer contact',
                'cust_type.required' => 'Select customer type',
            ]
        );

        if (request('anniversary_date') != '') {
            $anniversary_date = date('Y-m-d', strtotime($request->get('anniversary_date')));
        } else {
            $anniversary_date = null;
        }
        if ($request->file('image') != null) {
            // dd($request->file('image'));
            $input['image'] = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/customer'), $input['image']);
        } else {
            $input['image'] = "";
        }

        if (request('dob') != '') {
            $dob = date('Y-m-d', strtotime($request->get('dob')));
        } else {
            $dob = null;
        }
        $otp = rand(0, 9999);
        $customer = new customer([
            'admin_id' => Auth::user()->id,
            'customer_image' => $input['image'],
            'customer_id' => $request->get('customer_id'),
            'cust_type' => $request->get('cust_type'),
            'name' => $request->get('name'),
            'location' => $request->get('location'),
            'contact' => $request->get('contact'),
            'other_contact' => $request->get('other_contact'),
            'email' => $request->get('email'),
            'dob' => $dob,
            'gender' => $request->get('gender'),
            'designation' => $request->get('designation'),
            'anniversary_date' => $anniversary_date,
            'customer_code' => $customer_code,
            'rf_id' => $request->get('rf_id'),
            'remarks' => $request->get('remark'),
            'total_visit' => 0,
            'total_revenue' => 0,
            'verify_otp' => $request->get('otps'),
            // 'last_visit_date' => '',
            'customer_status' => 1,
        ]);
        $customer->save();
        if (!empty($customer->id)) {
            $username = urlencode('cvsalon');
            $sendername = urlencode('CVslon');
            $cust = customer::find($customer->id);
            $message = urlencode('Please verify otp. Your otp is ' . $otp . '.');
            file_get_contents("http://sms.hspsms.com/sendSMS?username=" . $username . "&message=" . $message . "&sendername=" . $sendername . "&smstype=TRANS&numbers=" . $cust->contact . "&apikey=9d0e9d96-143f-4141-ab1a-e32d648bd098");
            echo json_encode($customer->id);
        } else {
            $status = "Failed";
            echo json_encode($status);
        }
        /*if($request->get('contact') != "" && $request->get('contact') != NULL){
    $message = urlencode('Dear User, You have successfully registered ...');
    // other parametes might also contain spaces ...
    $username = urlencode('cvsalon');
    $sendername = urlencode('CVslon');
    //etc
    file_get_contents("http://sms.hspsms.com/sendSMS?username=".$username."&message=".$message."&sendername=".$sendername."&smstype=TRANS&numbers=".$request->get('contact')."&apikey=9d0e9d96-143f-4141-ab1a-e32d648bd098");
    }
    return redirect('admin/customer')->with('success', 'Customer saved!');*/
    }

    public function qs_saveRemark(Request $request)
    {

        $customer_id = $request->customer_id;

        $customer = customer::find($customer_id);

        $customer->remarks = $request->remark;

        $customer->save();
    }

    public function addOtherService(Request $request)
    {
        try {
            $Service_Other_Brand = new ServiceOtherBrand();
            $Service_Other_Brand->service_id = $request->other_service_id;
            $Service_Other_Brand->sub_cate_id = 0;
            $Service_Other_Brand->brand_id = 0;
            $Service_Other_Brand->brand_name = $request->other_brand_name;
            $Service_Other_Brand->service_price = $request->other_service_price;
            $Service_Other_Brand->special_price = $request->other_service_price;
            $Service_Other_Brand->service_duration = $request->other_service_duration;
            $Service_Other_Brand->service_description = $request->other_service_description;
            $Service_Other_Brand->service_brand_status = 1;
            $Service_Other_Brand->save();
            $other_service_brand_id = $Service_Other_Brand->id;
            $Service_OtherBrand_Data = ServiceOtherBrand::where('id', $other_service_brand_id)->first();
            echo json_encode(['msg' => true, 'data' => $Service_OtherBrand_Data]);
        } catch (\Exception $e) {
            echo json_encode(['msg' => false]);
        }
    }

    public function recent_invoice($id)
    {
        $recent_invoices = Invoice::where('user_id', $id)->orderBy('invoice_id', 'desc')->take(5)->get();
        return view('customer.recent_invoice', compact('recent_invoices'));
    }
}

?>
