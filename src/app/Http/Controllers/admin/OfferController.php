<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Model\admin\Customer;
use App\Model\admin\CustomerOffer;
use App\Model\admin\Offer;
use App\Model\Invoice;
use App\Model\Referralused;
use App\Model\admin\OfferService;
use App\Model\admin\MemberSystem;
use App\Model\admin\CustomerWallet;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Helper;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $Offer_data = Offer::all();
            return view('admin.offer.index', compact('Offer_data'));
        } catch (\Exception $e) {
            // echo json_encode(['msg' => false]);
            return back()->with('msg', 'something went wrong');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $Member_Systems = MemberSystem::all();
            $service_group = DB::table('service_group')->where('parent_id', 0)->get();
            return view('admin.offer.create', compact('service_group','Member_Systems'));
        } catch (\Exception $e) {
            // echo json_encode(['msg' => false]);
            return back()->with('msg', 'something went wrong');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //try {
            $serviceRowCount = $request->serviceRowCount;
            $servicesSgst = $request->servicesSgst;
            $servicesCgst = $request->servicesCgst;
            $servicePrice = $request->servicePrice;
            $serviceTotal = $request->serviceTotal;
            $serviceQuantity = $request->serviceQuantity;

            $offr = new Offer();
            $offr->offer_title = $request->Offer_name;
            $offr->offer_type = $request->Offer_type;

            if($request->Offer_type==1){
                $offr->reffered_benefits = 'service';
                $offr->referring_benefits = 'wallet';
            }else if($request->Offer_type==2){
                $offr->reffered_benefits = '';
                $offr->referring_benefits = 'wallet';
                $offr->membership_id = $request->membership_id;
            }

            //$offr->description = $request->description;
            $offr->offer_from = date('Y-m-d',strtotime($request->offer_from));
            $offr->offer_to = date('Y-m-d',strtotime($request->offer_to));
            //$offr->offer_validity = $request->Offer_validity;
            $offr->offer_price = $request->Offer_price;
            $offr->code_prefix = $request->code_prefix;
            $offr->created = date('Y-m-d');
            $offr->save();
            $offr_id = $offr->id;
            if (!empty($offr_id) && ($request->Offer_type == 1)) {
                if ($serviceRowCount != 0) {
                    for ($i = 0; $i < $serviceRowCount - 1; $i++) {
                        $offr_service = new OfferService([
                            'offer_id' => $offr_id,
                            'service_id' => $_POST['brand_' . $i],
                            'brand_id' => $_POST['services_' . $i],
                            'quantity' => $serviceQuantity[$i],
                            'price' => $servicePrice[$i],
                            'cgst' => $servicesCgst[$i],
                            'sgst' => $servicesSgst[$i],
                            'total_price' => $serviceTotal[$i],
                            'created' => $offr->created,
                        ]);
                        $offr_service->save();
                    }
                }
            }
            Session::flash('success', 'Offer added successfully');
            return redirect('admin/offers/create');
        // } catch (\Exception $e) {
        //     return back()->with('msg', 'something went wrong');
        // }
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
        //try {
            $Member_Systems = MemberSystem::all();
            $offer = Offer::with('services')->where('id',$id)->first();

            $service_group = DB::table('service_group')->where('parent_id', 0)->get();

            $service = DB::table('service_brands')->where('service_brand_status', 1)->get();

            return view('admin.offer.edit', compact('service_group','offer','service','Member_Systems'));
        // } catch (\Exception $e) {
        //     return back()->with('msg', 'something went wrong');
        // }
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
        $serviceRowCount = $request->serviceRowCount;
        $servicesSgst = $request->servicesSgst;
        $servicesCgst = $request->servicesCgst;
        $servicePrice = $request->servicePrice;
        $serviceTotal = $request->serviceTotal;
        $serviceQuantity = $request->serviceQuantity;

        $offr = Offer::find($id);
        $offr->offer_title = $request->Offer_name;
        $offr->offer_type = $request->Offer_type;

        if($request->Offer_type==1){
            $offr->reffered_benefits = 'service';
            $offr->referring_benefits = 'wallet';
        }else if($request->Offer_type==2){
            $offr->reffered_benefits = '';
            $offr->referring_benefits = 'wallet';
            $offr->membership_id = $request->membership_id;
        }

        // $offr->description = $request->description;
        // $offr->offer_validity = $request->Offer_validity;
        $offr->offer_from = date('Y-m-d',strtotime($request->offer_from));
        $offr->offer_to = date('Y-m-d',strtotime($request->offer_to));
        $offr->offer_price = $request->Offer_price;
        $offr->code_prefix = $request->code_prefix;
        $offr->created = date('Y-m-d');
        $offr->save();
        $offr_id = $offr->id;
        if (!empty($offr_id) && ($request->Offer_type == 1)) {
            if ($serviceRowCount != 0) {
                for ($i = 0; $i < $serviceRowCount - 1; $i++) {
                    $offr_service = new OfferService([
                        'offer_id' => $offr_id,
                        'service_id' => $_POST['brand_' . $i],
                        'brand_id' => $_POST['services_' . $i],
                        'quantity' => $serviceQuantity[$i],
                        'price' => $servicePrice[$i],
                        'cgst' => $servicesCgst[$i],
                        'sgst' => $servicesSgst[$i],
                        'total_price' => $serviceTotal[$i],
                        'created' => $offr->created,
                    ]);
                    $offr_service->save();
                }
            }
        }
        Session::flash('success', 'Offer Updated');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Offer_Service = OfferService::where('offer_id', $id)->delete();
        $Offr = Offer::where('id', $id)->delete();
        return redirect('admin/offers')->with('success', 'Offers Deleted successfully');
    }

    public function dashboard()
    {
        try {
            $total_offers = Offer::count();
            $referring_offers = Offer::where('offer_party', 'referring')->count();
            $referred_offers = Offer::where('offer_party', 'referred')->count();
            $Un_used_offers = CustomerOffer::where('status', '0')->count();
            $Customer_data = Customer::all();
            return view('admin.offer.dashboard', compact('total_offers', 'referring_offers', 'referred_offers', 'Un_used_offers', 'Customer_data'));
        } catch (\Exception $e) {
            // echo json_encode(['msg' => false]);
            return redirect('admin/offers')->with('danger', 'something went wrong');
        }
    }

    // public function assign_Offer_to_cust(Request $request)
    // {
    //     try {
    //         $customer_id = $request->customer_id;
    //         $Offer_id = $request->Offer_id;
    //         $Offer_data = Offer::where('id', $Offer_id)->first();
    //         $validity = $Offer_data->Offer_validity;
    //         $Valid_date = date('d-m-Y', strtotime('+' . $validity . 'days'));
    //         $Validity_date = date_create($Valid_date);
    //         $customer_Offer = new CustomerOffer([
    //             'Offer_id' => $Offer_id,
    //             'customer_id' => $customer_id,
    //             'start_date' => date('Y-m-d H:i:s'),
    //             'expire_date' => $Validity_date,
    //             'status' => 0,
    //         ]);
    //         $customer_Offer->save();
    //         echo json_encode(['msg' => true, 'data' => $customer_Offer]);
    //     } catch (\Exception $e) {
    //         echo json_encode(['msg' => false]);
    //     }
    // }

    public function get_custAllOffer(Request $request)
    {
        try {
            $data['html'] = '';
            $customer_id = $request->customer_id;
            $cust_Offer_datas = DB::table('customer_offer AS CC')
                ->leftJoin('offers', 'CC.offer_id', '=', 'offers.id')
                ->where('CC.customer_id', $customer_id)
                ->get();
            foreach ($cust_Offer_datas as $key => $value) {
                $data['html'] .= "<tr>
                                    <td>" . ($key + 1) . "</td>
                                    <td>" . $value->offer_title . "</td>
                                    <td> <i class='fa fa-inr'></i>" . $value->offer_price . "</td>
                                    <td>" . $value->offer_code . "</td>
                                    <td>" . date('d/M/Y', strtotime($value->start_date)) . "</td>
                                    <td>" . date('d/M/Y', strtotime($value->expire_date)) . "</td>
                                    <td> <button type='button' class='btn btn-info mb-1' onclick='send_sms_to_customer(".$value->offer_id.",".$request->customer_id.");'>Send SMS</button> </td>
                                </tr>";
            }
            echo json_encode(['msg' => true, 'data' => $data]);
        } catch (\Exception $e) {
            echo json_encode(['msg' => false]);
        }
    }

    public function sendoffersmstocustomer(Request $request){
        try {
            $offer_id = $request->offer_id;
            $customer_id = $request->customer_id;
            $cd = DB::table('customers')
            ->leftJoin('customer_offer', 'customer_offer.customer_id', '=', 'customers.id')
            ->leftJoin('offers', 'customer_offer.offer_id', '=', 'offers.id')
            ->where('customers.customer_id', $customer_id)
            ->where('offers.id', $offer_id)
            ->first();
            if($cd){
                $message = "Hey ".$cd->name." your unique referrel code for ".$cd->offer_title." is ".$cd->offer_code." please share this to your friends ";
                //$message = "Hi ! We are so excited to have you in Chinnie & Vinnie Salon. Please share 1254 to register yourself with us.";
                $dd = Helper::sendMobileSMS($cd->contact, $message);
                echo json_encode(['msg' => true,'dd'=>$dd]);
            }else{
                echo json_encode(['msg' => false]);
            }

        } catch (\Exception $e) {
            echo json_encode(['msg' => false]);
        }
    }

    public function cust_referral_offer_bycode(Request $request)
    {


        //try {
                    $customer_mobile = $request->customer_number;
                    $offer_code = $request->offer_code;
                    $cust_data = Customer::where('contact', $customer_mobile)->first();

                    $cust_id = $cust_data->id;
                    $CustomerOffer = CustomerOffer::where([['offer_code', '=', $offer_code],['customer_id', '!=', $cust_id]])->first();
                    if ($CustomerOffer) {
                            $existfreeservice = Referralused::checkfreeservice($cust_id);
                            if($existfreeservice==''){
                                $today = date('Y-m-d');
                                $startdate = date('Y-m-d',strtotime($CustomerOffer->start_date));
                                $expire_date = date('Y-m-d',strtotime($CustomerOffer->expire_date));
                                $offer_id = $CustomerOffer->offer_id;
                                $Offer_data = Offer::where('id', $offer_id)->first();
                                $offer_type = $Offer_data->offer_type;
                                if ($offer_type == "1") {
                                    if($startdate>$today){
                                        echo json_encode(["status" => false,"message"=>"Your coupon will apply from ".date('d-m-Y',strtotime($startdate))]);
                                    }elseif($expire_date<$today){
                                        echo json_encode(["status" => false,"message"=>"Your coupon have expired"]);
                                    }else{
                                        $cust_Offer_datas = DB::table('offers')
                                        ->leftJoin('offer_services as CS', 'CS.offer_id', '=', 'offers.id')
                                        ->leftJoin('service_brands AS SB', 'SB.service_brand_id', '=', 'CS.service_id')
                                        ->leftJoin('services AS SE', 'SE.id', '=', 'SB.service_id')
                                        ->where('offers.id', $offer_id)
                                        ->get();
                                        echo json_encode(["status" => true,"customer_offer_id"=>$CustomerOffer->id, "data" => $cust_Offer_datas]);
                                    }
                                } else {
                                    echo json_encode(["status" => false,"message"=>"Invalid code for refferal"]);
                                }
                            }else{
                                $referred_date = date('Y-m-d H:i:s',strtotime($existfreeservice->used_date));
                                $message = "This customer has already taken free services.Referred by ".$existfreeservice->referred_customer_name.'and you had used it on '.$referred_date.' and coupon code is '.$existfreeservice->offer_code;
                                echo json_encode(["status" => false,"message"=>$message]);
                            }

                    } else{
                        echo json_encode(["status" => false,"message"=>"Invalid code"]);
                    }
        // } catch (\Exception $e) {
        //     echo json_encode(['msg' => false]);
        // }
    }

    public function cust_frnd_referral_offer_bycode(Request $request)
    {
        // try {
        $customer_mobile = $request->customer_number;
        $offer_code = $request->offer_code;
        $cust_data = Customer::where('contact', $customer_mobile)->first();
        $cust_id = $cust_data->id;
        $CustomerOffer = CustomerOffer::where([
            ['used_by', '!=', $cust_id], ['offer_code', '=', $offer_code], ['status', '=', 0],
        ])->get();
        // print_r($CustomerOffer);
        // die;
        if (!$CustomerOffer->isEmpty()) {
            $offer_id = $CustomerOffer[0]->offer_id;
            $Offer_data = Offer::where('id', $offer_id)->first();
            $offer_type = $Offer_data->offer_type;

            $today = date('d-m-Y', time());
            $exp = date('d-m-Y', strtotime($CustomerOffer[0]->expire_date));
            $expDate = date_create($exp);
            $todayDate = date_create($today);
            $diff = date_diff($todayDate, $expDate);
            if ($diff->format("%R%a") > 0) {
                if ($offer_type == 'Add_to_Wallet') {
                    Session::put('frnd_wallet_value', $Offer_data->offer_price);
                    Session::put('frnd_id', $CustomerOffer[0]->customer_id);
                    Session::put('frnd_wallet_remark', 'From Offer_code_'.$CustomerOffer[0]->offer_code);
                    Session::put('frnd_off_id', $CustomerOffer[0]->offer_id);
                    // $Customer_Wallet = new CustomerWallet();
                    // $Customer_Wallet->amount_allow = $Offer_data->offer_price;
                    // $Customer_Wallet->customer_id = $CustomerOffer[0]->customer_id;
                    // $Customer_Wallet->amount_used = 0;
                    // $Customer_Wallet->invoice_id = 0;
                    // $Customer_Wallet->remark='From Offer_code_'.$CustomerOffer[0]->offer_code;
                    // $Customer_Wallet->created_at = date('Y/m/d H:i:s');
                    // $Customer_Wallet->save();
                    echo json_encode(['msg' => true, 'data' => $Offer_data]);
                }
            } else {
                echo json_encode(['msg' => 'Expired']);
            }
        } else {
            echo json_encode(['msg' => 'Not allowed offer']);
        }
        // } catch (\Exception $e) {
        //     echo json_encode(['msg' => false]);
        // }
    }

    public function assign_ref_offer_all(Request $request)
    {
        //try {
            $customer_ids = explode(",", $request->customer_ids);
            foreach ($customer_ids as $key => $customer_id) {
                $ref_off_id = $request->ref_off_id;
                $Offer_data = Offer::where('id', $ref_off_id)->first();
                $customer = Customer::find($customer_id);
                $customer_name = $customer->name;
                $customer_subname = (substr($customer_name, 0, 3))?substr($customer_name, 0, 3):substr($customer_name, 0, 2);
                $offer_code = $customer_subname . rand(1000, 9999);
                $customer_offer = new CustomerOffer([
                    'offer_id' => $ref_off_id,
                    'customer_id' => $customer_id,
                    'offer_code' => ($Offer_data->code_prefix!='')?$Offer_data->code_prefix.$offer_code:$offer_code,
                    'offer_used_count' => 0,
                    'used_by' => 0,
                    'start_date' => date('Y-m-d',strtotime($Offer_data->offer_from)),
                    'expire_date' => date('Y-m-d',strtotime($Offer_data->offer_to)),
                    'status' => 0,
                ]);
                $customer_offer->save();
            }
            echo json_encode(['msg' => true]);
    }

    public function delete_offer_service(Request $request){
        OfferService::where('id', $request->service_id)->delete();
        echo json_encode(['stauts'=>1,'msg'=>'service deleted']);
    }
}
