<?php

namespace App\Http\Controllers\admin;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Model\admin\Customer;
use App\Model\admin\Offer;
use App\Model\admin\CustomerMemberService;
use App\Model\admin\CustomerMemberSystem;
use App\Model\admin\MemberSystem;
use App\Model\admin\MemberSystemService;
use App\Model\admin\CustomerWallet;
use App\Model\admin\CustomerOffer;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MemberSystemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Member_Systems = MemberSystem::all();

        return view('admin.membersystem.index', compact('Member_Systems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $service_group = DB::table('service_group')->where('parent_id', 0)->get();
        return view('admin.membersystem.create', compact('service_group'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // print_r($request->all());
        // die;
        try {
            $serviceRowCount = $request->serviceRowCount;
            $servicesSgst = $request->servicesSgst;
            $servicesCgst = $request->servicesCgst;
            $servicePrice = $request->servicePrice;
            $serviceTotal = $request->serviceTotal;
            $serviceFreeCount = $request->serviceFreeCount;
            $servicePerMonth = $request->servicePerMonth;
            $serviceValidAfter = $request->serviceValidAfter;
            if (!isset($request->discount_type)) {
                $discount_type = "free";
            } else {
                $discount_type = $request->discount_type;
            }
            if (!isset($request->membership_discount)) {
                $membership_discount = "0";
            } else {
                $membership_discount = $request->membership_discount;
            }
            $Member_System = new MemberSystem();
            $Member_System->membership_name = $request->membership_name;
            $Member_System->membership_type = $request->membership_type;
            $Member_System->discount_type = $discount_type;
            $Member_System->minimum_req_amt = $request->minimum_req_amt;
            $Member_System->membership_discount = $membership_discount;
            $Member_System->membership_validity = $request->membership_validity;
            $Member_System->membership_price = $request->membership_price;
            $Member_System->created = date('Y-m-d');
            $Member_System->save();
            $Member_System_id = $Member_System->id;
            if (!empty($Member_System_id) && ($request->membership_type == "Free")) {
                if ($serviceRowCount != 0) {
                    for ($i = 0; $i < $serviceRowCount - 1; $i++) {
                        $Member_System_service = new MemberSystemService([
                            'member_sys_id' => $Member_System_id,
                            'service_id' => $_POST['brand_' . $i],
                            'brand_id' => $_POST['services_' . $i],
                            'price' => $servicePrice[$i],
                            'cgst' => $servicesCgst[$i],
                            'sgst' => $servicesSgst[$i],
                            'total_price' => $serviceTotal[$i],
                            'free_count' => $serviceFreeCount[$i],
                            'per_month_count' => $servicePerMonth[$i],
                            'valid_after_days' => $serviceValidAfter[$i],
                            'created' => $Member_System->created,
                        ]);
                        $Member_System_service->save();
                    }
                }
            }
            Session::flash('success', 'Member ship Plan added successfully');
            return redirect('admin/MemberSystem/create');
        } catch (\Exception $e) {
            // echo json_encode(['msg' => false]);
            return back()->with('msg', 'something went wrong');
        }
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
    public function destroy(Request $request, $id)
    {
        $member_system_data = MemberSystem::where('id', $id)->first();
        if ($member_system_data->membership_type=='Free') {
            $member_sys_service = MemberSystemService::where('member_sys_id', $id)->delete();
        }
        $member_system = MemberSystem::where('id', $id)->delete();
        return redirect('admin/MemberSystem')->with('success', 'MemberSystem Deleted successfully');
    }

    public function all_member_plan()
    {
        try {
            $data['html'] = '';
            $Member_Systems = MemberSystem::all();
            foreach ($Member_Systems as $key => $Member_Sysplan) {
                $data['html'] .= "<tr>
                                <td>" . ($key + 1) . "</td>
                                <td>" . $Member_Sysplan->membership_name . "</td>
                                <td>" . $Member_Sysplan->membership_type . "</td>
                                <td> <i class='fa fa-inr'></i>" . $Member_Sysplan->membership_price . "</td>
                                <td>" . $Member_Sysplan->membership_validity . "days </td>
                                <td> <button type='button' class='btn btn-warning mb-1' onclick='assignplan_tocustomer($Member_Sysplan->id)'><i class='fa fa-tasks'></i></button> </td>
                            </tr>";
            }
            echo json_encode(['msg' => true, 'data' => $data]);
        } catch (\Exception $e) {
            echo json_encode(['msg' => false]);
        }
    }

    public function beforeAssignMemberPlandata(Request $request)
    {
        try {
            $mem_plan_id = $request->mem_plan_id;
            $member_plan = MemberSystem::where('id', $mem_plan_id)->first();
            echo json_encode(['msg' => true, 'data' => $member_plan]);
        } catch (\Exception $e) {
            echo json_encode(['msg' => false]);
        }
    }

    public function assignMemberPlan_ToCustomer(Request $request)
    {

        try {
            $customer_mobile = $request->customer_mobile;
            $cust_data = Customer::where('contact', $customer_mobile)->first();
            $asigned_service = CustomerMemberSystem::where('member_sys_id',$request->member_plan_id)
                                ->where("customer_id",$cust_data->id)
                                ->first();




            if($asigned_service!=''){
                $expire_date = date('Y-m-d',strtotime($asigned_service->expire_date));
                $today = date('Y-m-d');
                if($expire_date>=$today){
                    Session::flash('danger', 'This member plan already assigned to customer');
                    return redirect('quick_sale');
                }
            }


            if($request->coupon_code!=''){
                $CustomerOffer = CustomerOffer::where([['offer_code', '=', $request->coupon_code], ['status', '=', 0]])->first();
                    if ($CustomerOffer) {
                        $today = date('Y-m-d');
                        $startdate = date('Y-m-d',strtotime($CustomerOffer->start_date));
                        $expire_date = date('Y-m-d',strtotime($CustomerOffer->expire_date));
                            $offer_id = $CustomerOffer->offer_id;
                            $Offer_data = Offer::where('id', $offer_id)->first();
                            $offer_type = $Offer_data->offer_type;
                            if ($offer_type == "2") {
                                if($startdate>$today){
                                    Session::flash('danger', "Your coupon will apply from ".date('d-m-Y',strtotime($startdate)));
                                    return redirect('quick_sale');
                                }elseif($expire_date<$today){
                                    Session::flash('danger', "Your coupon have expired");
                                    return redirect('quick_sale');
                                }else{
                                    $offer = CustomerOffer::find($CustomerOffer->id);
                                    $offer->status = 1;
                                    $offer->used_by = $cust_data->id;
                                    $offer->offer_used_count = $offer->offer_used_count+1;
                                    $offer->save();

                                    $offers = Offer::find($offer_id);
                                    $offer_price = 0;
                                    if($offers){
                                    $offer_price = $offers->offer_price;
                                    }

                                    if($offer_price!=0){
                                        $wcustomer = new CustomerWallet();
                                        $wcustomer->amount_allow = $offer_price;
                                        $wcustomer->customer_id = $offer->customer_id;
                                        $wcustomer->amount_used = 0;
                                        $wcustomer->invoice_id = 0;
                                        $wcustomer->remark = 'from refferal code '.$offer->offer_code;
                                        $wcustomer->created_at = date('Y-m-d');
                                        if($wcustomer->save()){
                                            $whoappliedname = $cust_data->name;
                                            $whorefered = Customer::where('id', $offer->customer_id)->first();
                                            $whoreferedname = '';
                                            if($whorefered){
                                                  $whoreferedname = $whorefered->name;
                                            }

                                            $wbalance = Customer::getcusomertotalwalletbalance($offer->customer_id);
                                            $message= 'Hello '.$whoreferedname.' your friend '.$whoappliedname.' have taken membership at CV Salon, Thanks for referring her. We have added '.$offer_price.' to your wallet balance your updated wallet balance is '.$wbalance.' you can use it in your next service with CV Salon.';
                                            Helper::sendMobileSMS($whorefered->contact, $message);
                                        }

                                    }
                                }
                            } else {
                                Session::flash('danger', "Invalid code for refferal");
                                return redirect('quick_sale');
                            }
                    }
            }


            $Customer_MemberPlan = new CustomerMemberSystem();
            $Customer_MemberPlan->member_sys_id = $request->member_plan_id;
            $Customer_MemberPlan->customer_id = $cust_data->id;
            $Customer_MemberPlan->start_date = date('Y-m-d H:i:s', strtotime($request->plan_start_date));
            $Customer_MemberPlan->expire_date = date('Y-m-d H:i:s', strtotime($request->plan_expiry_date));
            if (isset($request->member_name)) {
                $Customer_MemberPlan->member_name = json_encode(implode(',', $request->member_name));
            }
            if (isset($request->member_mobile)) {
                $Customer_MemberPlan->member_mobile = json_encode(implode(',', $request->member_mobile));
            }
            $Customer_MemberPlan->member_otp = rand(1000, 9999);
            $Customer_MemberPlan->status = 0;
            $Customer_MemberPlan->save();

            $Member_System_Service_data = MemberSystemService::where('member_sys_id', $request->member_plan_id)->get();
            if (!$Member_System_Service_data->isEmpty()) {
                foreach ($Member_System_Service_data as $key => $Member_System_Service) {
                    $CustomerMember_Service = new CustomerMemberService();
                    $CustomerMember_Service->member_sys_id = $request->member_plan_id;
                    $CustomerMember_Service->customer_id = $cust_data->id;
                    $CustomerMember_Service->member_mobile = $customer_mobile;
                    $CustomerMember_Service->service_id = $Member_System_Service->service_id;
                    $CustomerMember_Service->service_free_count = 0;
                    $CustomerMember_Service->service_per_month_count = 0;
                    $CustomerMember_Service->service_valid_after_days = $Member_System_Service->valid_after_days;
                    $CustomerMember_Service->save();
                }
            }

            $otp=rand(10000,99999);
            // $message= 'Hi ! We`re so excited to have you in Chinnie & Vinnie Salon Membership. Please share ' . $otp . ' OTP to register yourself with us.';
            $message= 'Hi ! We are so excited to have you in Chinnie & Vinnie Salon Membership. Please share ' . $otp . ' to register yourself with us.';
            Helper::sendMobileSMS($customer_mobile, $message);
            Session::flash('success', 'Member Plan assigned to customer successfully');
            return redirect('quick_sale');
        } catch (\Exception $e) {
            echo json_encode(['msg' => false]);
            Session::flash('error', 'Something went wrong');
            return redirect('quick_sale');
        }
    }
    public function customer_membersys_plan_old(Request $request)
    {
        try {
        $data['html'] = '';
        $customer_mobile = $request->customer_mobile;
        $cust_data = Customer::where('contact', $customer_mobile)->first();
        $cust_id = $cust_data->id;
        $Cust_member_plan = CustomerMemberSystem::where('customer_id', $cust_id)->get();
        foreach ($Cust_member_plan as $key => $cust_member_plan) {
            $member_sys_id = $cust_member_plan->member_sys_id;
            $membersystem_datas = DB::table('membersystem')
                ->leftJoin('membersystem_service AS MSS', 'MSS.member_sys_id', '=', 'membersystem.id')
                ->leftJoin('service_brands AS SB', 'SB.service_brand_id', '=', 'MSS.service_id')
                ->leftJoin('services AS SE', 'SE.id', '=', 'SB.service_id')
                ->where('membersystem.id', $member_sys_id)
                ->get();
            // print_r($membersystem_datas);
            // die;

            foreach ($membersystem_datas as $membersystem_data) {

                $today = date('d-m-Y', time());
                $exp = date('d-m-Y', strtotime($cust_member_plan->expire_date));
                $expDate = date_create($exp);
                $todayDate = date_create($today);
                $diff = date_diff($todayDate, $expDate);
                if ($diff->format("%R%a") > 0) {
                    $status = "<button type='button' class='btn btn-info mb-1' id='CustMemberplanOtp' onclick='MemberplanOtp($member_sys_id)'>Plan OTP</button> <button type='button' class='btn btn-warning mb-1' id='CustMemberplanassign' style='display:none;' onclick='MemberplanAssign($member_sys_id)'>Assign</button>";
                } else {
                    $status = "<button type='button' class='btn btn-danger mb-1'>Expired</button>";
                }

                $valid_after = $membersystem_data->valid_after_days;
                if (!isset($valid_after)) {
                    $valid_after=0;
                } else {
                    $Valid_date = date('d-m-Y', strtotime($cust_member_plan->start_date.'+' . $valid_after . 'days'));
                    $Validity_date = date_create($Valid_date);
                    $active_diff = date_diff($todayDate, $Validity_date);
                    if ($active_diff->format("%R%a") > 0) {
                        $status = "<button type='button' class='btn btn-danger mb-1'>Inactive</button>";
                    }
                }
                // print_r($membersystem_data);
                $Cust_member_service = CustomerMemberService::where('service_id', $membersystem_data->service_brand_id)->first();
                // print_r($Cust_member_service);die;
                if (($membersystem_data->free_count) <= ($Cust_member_service->service_free_count)) {
                    $status = "<button type='button' class='btn btn-danger mb-1'>Free Count Over</button>";
                }
                if ((int)($membersystem_data->per_month_count) <= (int)($Cust_member_service->service_per_month_count)) {
                    $status = "<button type='button' class='btn btn-danger mb-1'>Per Month Count Over</button>";
                }
                $data['html'] .= "<tr>
                                        <td>" . ($key + 1) . "</td>
                                        <td>" . $membersystem_data->membership_name . "</td>
                                        <td>" . $membersystem_data->membership_type . "</td>
                                        <td>" . $membersystem_data->brand_name . "<br> <span class='text-danger'> Valid After-- $Valid_date </span></td>
                                        <td> <i class='fa fa-inr'></i>" . $membersystem_data->membership_price . "</td>
                                        <td>" . date('d/M/Y', strtotime($cust_member_plan->expire_date)) . "</td>
                                        <td>" . $status . " </td>
                                    </tr>";

            }
        }
        echo json_encode(['msg' => true, 'data' => $data,'dd'=>$Cust_member_plan]);
        } catch (\Exception $e) {
            echo json_encode(['msg' => false]);
        }
    }

    public function customer_membersys_plan(Request $request)
    {
        try {
        $data['html'] = '';
        $customer_mobile = $request->customer_mobile;
        $cust_data = Customer::where('contact', $customer_mobile)->first();
        $cust_id = $cust_data->id;
        $today_date = date('Y-m-d H:i:s');

        $Cust_member_plan = CustomerMemberSystem::where('customer_id', $cust_id)->where('expire_date','>',$today_date)->get();
        $btn_count=0;
        foreach ($Cust_member_plan as $key => $cust_member_plan) {
            $member_sys_id = $cust_member_plan->member_sys_id;

            $member_system_data = DB::table('membersystem')->where('membersystem.id', $member_sys_id)->first();

            if ($member_system_data->membership_type=='Free') {
                $membersystem_datas = DB::table('membersystem')
                ->select('membersystem.*','MSS.*','SB.*','SE.*','MSS.service_id as mss_service_id')
                ->leftJoin('membersystem_service AS MSS', 'MSS.member_sys_id', '=', 'membersystem.id')
                ->leftJoin('service_brands AS SB', 'SB.service_brand_id', '=', 'MSS.service_id')
                ->leftJoin('services AS SE', 'SE.id', '=', 'SB.service_id')
                ->where('membersystem.id', $member_sys_id)
                ->get();

            foreach ($membersystem_datas as $inside_key => $membersystem_data)
                {   $btn_count = $btn_count + 1;
                    $today = date('d-m-Y', time());
                    $exp = date('d-m-Y', strtotime($cust_member_plan->expire_date));
                    $expDate = date_create($exp);
                    $todayDate = date_create($today);
                    $diff = date_diff($todayDate, $expDate);
                    $status = "";
                    if ($diff->format("%R%a") > 0) {
                        $status = "<button type='button' class='btn btn-info mb-1' id='CustMemberplanOtp$btn_count' onclick='MemberplanOtp($member_sys_id, $btn_count)'>Plan OTP</button> <button type='button' class='btn btn-warning mb-1' id='CustMemberplanassign$btn_count' style='display:none;' onclick='MemberplanAssign($member_sys_id,$btn_count,$membersystem_data->brand_id,$membersystem_data->mss_service_id)'>Assign</button>";
                    } else {
                        $status = "<button type='button' class='btn btn-danger mb-1'>Expired</button>";
                    }

                    $valid_after = $membersystem_data->valid_after_days;
                    if (!isset($valid_after)) {
                        $valid_after=0;
                    } else {
                        $Valid_date = date('d-m-Y', strtotime($cust_member_plan->start_date.'+' . $valid_after . 'days'));
                        $Validity_date = date_create($Valid_date);
                        $active_diff = date_diff($todayDate, $Validity_date);
                        if ($active_diff->format("%R%a") > 0) {
                            $status = "<button type='button' class='btn btn-danger mb-1'>Inactive</button>";
                        }
                    }
                    // print_r($membersystem_data);
                    $Cust_member_service = CustomerMemberService::where('service_id', $membersystem_data->service_brand_id)->first();
                    //print_r($Cust_member_service->service_free_count);die;
                    if(isset($Cust_member_service->service_free_count)){
                        if ($membersystem_data->free_count <= $Cust_member_service->service_free_count) {
                            $status = "<button type='button' class='btn btn-danger mb-1'>Free Count Over</button>";
                        }
                    }
                    if(isset($Cust_member_service->service_per_month_count)){
                        if ((int)($membersystem_data->per_month_count) <= (int)($Cust_member_service->service_per_month_count)) {
                            $status = "<button type='button' class='btn btn-danger mb-1'>Per Month Count Over</button>";
                        }
                    }

                    $data['html'] .= "<tr>
                                        <td>" . ($key + 1) . "</td>
                                        <td>" . $membersystem_data->membership_name . "</td>
                                        <td>" . $membersystem_data->membership_type . "</td>
                                        <td>" . $membersystem_data->brand_name . "<br> <span class='text-danger'> Valid After-- $Valid_date </span></td>
                                        <td> <i class='fa fa-inr'></i>" . $membersystem_data->membership_price . "</td>
                                        <td>" . date('d/M/Y', strtotime($cust_member_plan->expire_date)) . "</td>
                                        <td>" . $status . " </td>
                                    </tr>";
                }
            }
            else {
                $btn_count = $btn_count + 1;
                $today = date('d-m-Y', time());
                $exp = date('d-m-Y', strtotime($cust_member_plan->expire_date));
                $expDate = date_create($exp);
                $todayDate = date_create($today);
                $diff = date_diff($todayDate, $expDate);
                if ($diff->format("%R%a") > 0) {
                    $status = "<button type='button' class='btn btn-info mb-1' id='CustMemberplanOtp$btn_count' onclick='MemberplanOtp($member_sys_id,$btn_count)'>Plan OTP</button> <button type='button' class='btn btn-warning mb-1' id='CustMemberplanassign$btn_count' style='display:none;' onclick='MemberplanAssign($member_sys_id,$btn_count,$membersystem_data->brand_id,$membersystem_data->mss_service_id)'>Assign</button>";
                } else {
                    $status = "<button type='button' class='btn btn-danger mb-1'>Expired</button>";
                }

                $data['html'] .= "<tr>
                                    <td>" . ($key + 1) . "</td>
                                    <td>" . $member_system_data->membership_name . "</td>
                                    <td>" . $member_system_data->membership_type . "</td>
                                    <td> <span class='text-danger'> Minimum Req Amt </span> <br> <i class='fa fa-inr'></i>".$member_system_data->minimum_req_amt. "</td>
                                    <td> <i class='fa fa-inr'></i>" . $member_system_data->membership_price . "</td>
                                    <td>" . date('d/M/Y', strtotime($cust_member_plan->expire_date)) . "</td>
                                    <td>" . $status . " </td>
                                </tr>";
            }
        }
        echo json_encode(['msg' => true, 'data' => $data]);
        } catch (\Exception $e) {
            echo json_encode(['msg' => false]);
        }
    }

    public function customer_membersys_plan_expired(Request $request)
    {
        try {
        $data['html'] = '';
        $customer_mobile = $request->customer_mobile;
        $cust_data = Customer::where('contact', $customer_mobile)->first();
        $cust_id = $cust_data->id;
        $today_date = date('Y-m-d H:i:s');
        $Cust_member_plan = CustomerMemberSystem::where('customer_id', $cust_id)->where('expire_date','<',$today_date)->get();
        $btn_count=0;
        foreach ($Cust_member_plan as $key => $cust_member_plan) {
            $member_sys_id = $cust_member_plan->member_sys_id;

            $member_system_data = DB::table('membersystem')->where('membersystem.id', $member_sys_id)->first();

            if ($member_system_data->membership_type=='Free') {
                $membersystem_datas = DB::table('membersystem')
                ->select('membersystem.*','MSS.*','SB.*','SE.*','MSS.service_id as mss_service_id')
                ->leftJoin('membersystem_service AS MSS', 'MSS.member_sys_id', '=', 'membersystem.id')
                ->leftJoin('service_brands AS SB', 'SB.service_brand_id', '=', 'MSS.service_id')
                ->leftJoin('services AS SE', 'SE.id', '=', 'SB.service_id')
                ->where('membersystem.id', $member_sys_id)
                ->get();

            foreach ($membersystem_datas as $inside_key => $membersystem_data)
                {   $btn_count = $btn_count + 1;
                    $today = date('d-m-Y', time());
                    $exp = date('d-m-Y', strtotime($cust_member_plan->expire_date));
                    $expDate = date_create($exp);
                    $todayDate = date_create($today);
                    $diff = date_diff($todayDate, $expDate);
                    $status = "";
                    if ($diff->format("%R%a") > 0) {
                        $status = "<button type='button' class='btn btn-info mb-1' id='CustMemberplanOtp$btn_count' onclick='MemberplanOtp($member_sys_id, $btn_count)'>Plan OTP</button> <button type='button' class='btn btn-warning mb-1' id='CustMemberplanassign$btn_count' style='display:none;' onclick='MemberplanAssign($member_sys_id,$btn_count,$membersystem_data->brand_id,$membersystem_data->mss_service_id)'>Assign</button>";
                    } else {
                        $status = "<button type='button' class='btn btn-danger mb-1'>Expired</button>";
                    }

                    $valid_after = $membersystem_data->valid_after_days;
                    if (!isset($valid_after)) {
                        $valid_after=0;
                    } else {
                        $Valid_date = date('d-m-Y', strtotime($cust_member_plan->start_date.'+' . $valid_after . 'days'));
                        $Validity_date = date_create($Valid_date);
                        $active_diff = date_diff($todayDate, $Validity_date);
                        if ($active_diff->format("%R%a") > 0) {
                            $status = "<button type='button' class='btn btn-danger mb-1'>Inactive</button>";
                        }
                    }
                    // print_r($membersystem_data);
                    $Cust_member_service = CustomerMemberService::where('service_id', $membersystem_data->service_brand_id)->first();
                    //print_r($Cust_member_service->service_free_count);die;
                    if(isset($Cust_member_service->service_free_count)){
                        if ($membersystem_data->free_count <= $Cust_member_service->service_free_count) {
                            $status = "<button type='button' class='btn btn-danger mb-1'>Free Count Over</button>";
                        }
                    }
                    if(isset($Cust_member_service->service_per_month_count)){
                        if ((int)($membersystem_data->per_month_count) <= (int)($Cust_member_service->service_per_month_count)) {
                            $status = "<button type='button' class='btn btn-danger mb-1'>Per Month Count Over</button>";
                        }
                    }

                    $data['html'] .= "<tr>
                                        <td>" . ($key + 1) . "</td>
                                        <td>" . $membersystem_data->membership_name . "</td>
                                        <td>" . $membersystem_data->membership_type . "</td>
                                        <td>" . $membersystem_data->brand_name . "<br> <span class='text-danger'> Valid After-- $Valid_date </span></td>
                                        <td> <i class='fa fa-inr'></i>" . $membersystem_data->membership_price . "</td>
                                        <td>" . date('d/M/Y', strtotime($cust_member_plan->expire_date)) . "</td>
                                        <td>" . $status . " </td>
                                    </tr>";
                }
            }
            else {
                $btn_count = $btn_count + 1;
                $today = date('d-m-Y', time());
                $exp = date('d-m-Y', strtotime($cust_member_plan->expire_date));
                $expDate = date_create($exp);
                $todayDate = date_create($today);
                $diff = date_diff($todayDate, $expDate);
                if ($diff->format("%R%a") > 0) {
                    $status = "<button type='button' class='btn btn-info mb-1' id='CustMemberplanOtp$btn_count' onclick='MemberplanOtp($member_sys_id,$btn_count)'>Plan OTP</button> <button type='button' class='btn btn-warning mb-1' id='CustMemberplanassign$btn_count' style='display:none;' onclick='MemberplanAssign($member_sys_id,$btn_count,$membersystem_data->brand_id,$membersystem_data->mss_service_id)'>Assign</button>";
                } else {
                    $status = "<button type='button' class='btn btn-danger mb-1'>Expired</button>";
                }

                $data['html'] .= "<tr>
                                    <td>" . ($key + 1) . "</td>
                                    <td>" . $member_system_data->membership_name . "</td>
                                    <td>" . $member_system_data->membership_type . "</td>
                                    <td> <span class='text-danger'> Minimum Req Amt </span> <br> <i class='fa fa-inr'></i>".$member_system_data->minimum_req_amt. "</td>
                                    <td> <i class='fa fa-inr'></i>" . $member_system_data->membership_price . "</td>
                                    <td>" . date('d/M/Y', strtotime($cust_member_plan->expire_date)) . "</td>
                                    <td>" . $status . " </td>
                                </tr>";
            }
        }
        echo json_encode(['msg' => true, 'data' => $data]);
        } catch (\Exception $e) {
            echo json_encode(['msg' => false]);
        }
    }

    public function getCustPlan_MemberContacts(Request $request)
    {
        try {
            $customer_mobile = $request->customer_mobile;
            $cust_data = Customer::where('contact', $customer_mobile)->first();
            $cust_id = $cust_data->id;
            $customer_member_plan_id = $request->cust_plan_id;
            $Customer_Member_System = CustomerMemberSystem::where([
                ['member_sys_id', '=', $customer_member_plan_id],
                ['customer_id', '=', $cust_id],
            ])->first();
            echo json_encode(['msg' => true, 'data' => $Customer_Member_System, 'cust_data' => $cust_data]);
        } catch (\Exception $e) {
            echo json_encode(['msg' => false]);
        }
    }

    public function sendOtpMemberPlan(Request $request)
    {
        try {
            $number = $request->number;
            $getcustdata = DB::table('customers AS C')->where('C.contact', $number)->first();
            $otp = rand(1000, 9999);
            $checkcode = DB::table('customer_member_system')->select('*')->where('member_mobile', 'like', '%' . $number . '%')->count();
            if ($checkcode != 0) {
                $user_data = CustomerMemberSystem::where('member_mobile', 'LIKE', "%$number%")->get();
                $user_data[0]->member_otp = $otp;
                $user_data[0]->save();
            } else {
                DB::update('update user_otp set otp = ? WHERE contact = ?', [$otp, $number]);
            }
            // $message = 'Your OTP is ' . $otp . '.VND Ventures Pvt. Ltd.';
            $message ='Hi ' . $getcustdata->name . ' ! Please share ' . $otp . ' OTP to use your membership card at CV Salon.';
            Helper::sendMobileSMS($number, $message);
            echo json_encode(['msg' => true, 'otp' => $otp]);
        } catch (\Exception $e) {
            echo json_encode(['msg' => false]);
        }
    }

    public function MemberPlanOtpVerify(Request $request)
    {
        try {
            $this->validate($request, [
                'otp' => 'required',
                'contact' => 'required',
            ]);
            $number = $request->contact;
            $user = DB::table('customer_member_system')->where('member_mobile', 'like', '%' . $number . '%')->where('member_otp', $request->otp)->first();
            if (!empty($user)) {
                echo json_encode(['msg' => true]);
            } else {
                $user = DB::table('user_otp')->where('contact', $request->contact)->where('otp', $request->otp)->first();
                echo json_encode(['msg' => true]);
            }
        } catch (\Exception $e) {
            echo json_encode(['msg' => false]);
        }
    }

    public function get_custplan_details(Request $request)
    {
        // try {
            $member_plan_id = $request->member_plan_id;
            $member_service_id = $request->service_id;
            $member_brand_id = $request->brand_id;

            $member_system_data = DB::table('membersystem')->where('membersystem.id', $member_plan_id)->first();

            if ($member_system_data->membership_type=='Free') {
                $services = DB::table('membersystem')
                ->select('SB.*', 'MSS.member_sys_id', 'MSS.price', 'MSS.total_price', 'F.id As firmid', 'F.firm_name', 'membersystem.discount_type', 'membersystem.membership_discount', 'membersystem.membership_price', 'membersystem.membership_type', 'membersystem.membership_discount', 'MSS.free_count', 'MSS.per_month_count', 'MSS.valid_after_days','membersystem.minimum_req_amt')
                ->leftJoin('membersystem_service AS MSS', 'MSS.member_sys_id', '=', 'membersystem.id')
                ->leftJoin('service_brands AS SB', 'SB.service_brand_id', '=', 'MSS.service_id')
                ->leftJoin('services AS SE', 'SE.id', '=', 'SB.service_id')
                ->leftJoin('service_group AS SG', 'SE.group_id', '=', 'SG.id')
                ->leftJoin('firms AS F', 'SG.firm_id', '=', 'F.id')
                ->where('MSS.member_sys_id', $member_plan_id)
                ->where('MSS.brand_id', $member_brand_id)
                ->where('MSS.service_id', $member_service_id)
                ->get();

            }
            else {
                $services = DB::table('membersystem')->where('membersystem.id', $member_plan_id)
                ->get();
            }

            // echo $services->toSql();
            // echo json_encode($services->toSql());
            echo json_encode(['msg' => true, 'data' => $services]);
        // } catch (\Exception $e) {
        //     echo json_encode(['msg' => false]);
        // }
    }

}
