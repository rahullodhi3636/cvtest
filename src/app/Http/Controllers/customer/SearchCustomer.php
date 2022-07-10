<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Model\admin\Customer;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchCustomer extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        echo "Hii";
        // return view('admin.customer.customer_list');
    }

    public function search_profile(Request $request)
    {
        $this->validate($request,
            [
                'rfid' => 'required',
                // 'rfid'=>'required|exists:customers,rf_id',
            ],
            [
                'rfid.required' => 'Please enter RFID',
                // 'rfid.exists' => 'Please enter valid RFID'
            ]
        );
        /*dd($request->get('rfid'));*/
        $user = DB::table('customers')->where('rf_id', $request->get('rfid'))->orWhere('contact', $request->get('rfid'))->leftJoin('customer_package', 'customers.id', '=', 'customer_package.customer_id')->leftJoin('packages', 'packages.package_id', '=', 'customer_package.package_id')->first();
        // print_r($user->id); die();
        if (!empty($user)) {
            $last_record = Customer::orderBy('id', 'desc')->first();
            if ($last_record != '') {
                $last_id = 1 + $last_record->id;
            } else {
                $last_id = 1;
            }
            /*$customer_packages = DB::table('customers')->where('rf_id', $request->get('rfid'))->orWhere('contact', $request->get('rfid'))->leftJoin('customer_package', 'customers.id', '=', 'customer_package.customer_id')->leftJoin('packages','packages.package_id','=','customer_package.package_id')->get();*/
            $cartitem = DB::table('add_to_cart')->where('customer_id', $user->id)->get();
            $subtotal = DB::table('add_to_cart')->where('customer_id', $user->id)->sum('item_price');
            $count = DB::table('add_to_cart')->where('customer_id', $user->id)->count();
            $myPackage = DB::table('customer_package')->leftJoin('package_members', 'package_members.customer_package_id', '=', 'customer_package.customer_package_id')->leftJoin('packages', 'packages.package_id', '=', 'customer_package.package_id')->where('package_members.customer_id', $user->id)->get();
            // echo "<pre>"; print_r($myPackage); echo "</pre>"; die();
            $packages = DB::table('packages')->get();
            $allservices = DB::table('services')->get();
            /*$transaction = DB::table('transaction')->leftJoin('packages','packages.package_id','=','transaction.package_id')->where('transaction.customer_id',$user->customer_id)->toSql();
            print_r($transaction); die();*/
            /*$sevicetransaction = DB::table('service_transaction')->where('service_transaction.customer_id',$user->customer_id)->leftJoin('services','services.id','=','service_transaction.service_id')->get();*/
            /*$packageServices = DB::table('customer_package')*/
            return view('customer.profile')->with(['customer' => $user, 'customer_packages' => $myPackage, 'packages' => $packages, 'allservices' => $allservices, 'last_id' => $last_id, 'cartitem' => $cartitem, 'subtotal' => $subtotal, 'count' => $count]);
        } else {
            return back()->with('success', 'Please enter valid RFID or Number');
        }

    }

    public function useservice(Request $request)
    {
        // print_r($_)
        $this->validate($request, [
            'checkservice' => 'required',
        ]);
        if ($request->get('checkservice') == 1) {
            $data = array(
                'package_service_id' => $request->get('packageserviceid'),
                'package_member_id' => $request->get('cust_id'),
                'count' => $request->get('checkservice'),
                'use_date' => date('Y-m-d H:i:s'),
                'status' => 1,
            );
            $useserviceinsertid = DB::table('use_customer_package_services')->insertGetId($data);
            if ($useserviceinsertid) {
                $remaining = $request->get('remainservice') - 1;
                DB::table('customer_package_service')->where('package_service_id', $request->get('packageserviceid'))->update(array('remaining_services' => $remaining));
                echo "Done";
            }
        } else {
            echo "Failed";
        }
    }

    public function getServiceDetails($packageid = '', $customerid = '', $serviceid = '')
    {
        $data = "";
        $packageServices = DB::table('customer_package')->leftJoin('customer_package_service', 'customer_package_service.customer_package_id', '=', 'customer_package.customer_package_id')->leftJoin('services', 'services.id', '=', 'customer_package_service.service_id')->leftJoin('package_members', 'package_members.customer_package_id', '=', 'customer_package.customer_package_id')->where('package_members.customer_id', $customerid)->where('customer_package.package_id', $packageid)->where('customer_package_service.service_id', $serviceid)->first();
        if (!empty($packageServices)) {
            if ($packageServices->remaining_services != 0) {
                $data .= '<input type="hidden" name="packageserviceid" id="packageserviceid" value="' . $packageServices->package_service_id . '"><div class="form-group"><lable>Total Services</lable><input type="text" readonly class="form-control" name="totalservice" id="totalservice" value="' . $packageServices->total_services . '"></div><div class="form-group"><lable>Remaining Services</lable><input type="text" readonly class="form-control" name="remainservice" id="remainservice" value="' . $packageServices->remaining_services . '"></div><div class="form-group"><lable>Do you want use this service?</lable><input type="checkbox" name="checkservice" value="1" id="checkservice"></div>';
            } else {
                $data = "";
            }
        } else {
            $data = "";
        }
        echo json_encode($data);
    }

    public function usepackageservice($packageid = '', $customerid = '')
    {
        $data = '';
        if (!empty($packageid) && !empty($customerid)) {
            $packageServices = DB::table('customer_package')->leftJoin('customer_package_service', 'customer_package_service.customer_package_id', '=', 'customer_package.customer_package_id')->leftJoin('services', 'services.id', '=', 'customer_package_service.service_id')->leftJoin('package_members', 'package_members.customer_package_id', '=', 'customer_package.customer_package_id')->where('package_members.customer_id', $customerid)->where('customer_package.package_id', $packageid)->get();
            if (!empty($packageServices)) {
                /*$data .= '<input type="hidden" name="cust_id" id="cust_id" value="'.$customerid.'"><input type="hidden" name="pack_id" id="pack_id" value="'.$packageid.'">';*/
                $data .= '<option value="">Select</option>';
                foreach ($packageServices as $value) {
                    $data .= '<option value="' . $value->service_id . '">' . $value->name . '</option>';
                }
            } else {
                $data = '';
            }
        }
        echo json_encode($data);
    }

    public function packageservice($packageid = '', $customerid = '')
    {
        $data = '';
        if (!empty($packageid) && !empty($customerid)) {
            $packageServices = DB::table('customer_package')->leftJoin('customer_package_service', 'customer_package_service.customer_package_id', '=', 'customer_package.customer_package_id')->leftJoin('services', 'services.id', '=', 'customer_package_service.service_id')->leftJoin('package_members', 'package_members.customer_package_id', '=', 'customer_package.customer_package_id')->where('package_members.customer_id', $customerid)->where('package_id', $packageid)->get();
            if (!empty($packageServices)) {
                foreach ($packageServices as $value) {
                    $data .= '<tr><td class="text-center">' . $value->name . '</td><td class="text-center">' . $value->total_services . '</td><td class="text-center">' . $value->remaining_services . '</td><td class="text-center"><a onclick="checkusedservice(' . $value->package_service_id . ')" class="btn-floating btn-sm btn-success"><i style="color: #000;" class="mdi mdi-eye-outline"></i></a></td><tr>';
                }
            } else {
                $data = '';
            }
        }
        echo json_encode($data);
    }

    public function uploadUserImage(Request $request)
    {

        // print_r($_POST); die();
        /*$base64_image = "data:image/jpeg;base64, blahblahablah";
        if (preg_match('/^data:image\/(\w+);base64,/', $base64_image)) {
        $data = substr($base64_image, strpos($base64_image, ',') + 1);

        $data = base64_decode($data);
        Storage::disk('local')->put("test.png", $data);
        dd("stored");
        }*/
        /*$img = $_POST['image'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file = public_path('images/') . uniqid() . '.png';*/
        $img = $_POST['image'];
        $folderPath = public_path('images/customer/');

        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);
        $file = uniqid() . '.png';
        $fileName = $folderPath . $file;
        $success = file_put_contents($fileName, $image_base64);
        if ($success) {
            DB::table('customers')->where('id', $request->get('customerid'))->update(array('customer_image' => $file));
        }
        print $success ? "Done" : 'Unable to save the file.';
    }

    public function checkusedservice($package_service_id = '')
    {
        $data = '';
        if (!empty($package_service_id)) {
            $check = DB::table('use_customer_package_services')->leftJoin('customers', 'customers.id', '=', 'use_customer_package_services.package_member_id')->where('package_service_id', '=', $package_service_id)->get();
            if (!empty($check)) {
                $i = 1;
                foreach ($check as $value) {
                    $data .= '<tr><td class="text-center">' . $i++ . '</td><td class="text-center">' . $value->name . '</td><td class="text-center">' . $value->rf_id . '</td><td class="text-center">' . $value->count . '</td><td class="text-center">' . date('d-m-Y H:i A', strtotime($value->use_date)) . '</td><<tr>';
                }
            } else {
                $data .= '<tr><td colspan="3">No result found</td></tr>';
            }
        }
        echo json_encode($data);
    }

    public function edit_profile(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'contact' => 'required',
        ]);

        /*if(request('anniversary_date')!=''){
        $anniversary_date = date('Y-m-d',strtotime($request->get('anniversary_date')));
        }else{
        $anniversary_date = null;
        }*/

        if (request('dob') != '') {
            $dob = date('Y-m-d', strtotime($request->get('dob')));
        } else {
            $dob = null;
        }

        $customer = customer::find($request->get('id'));
        $customer->name = $request->get('name');
        $customer->location = $request->get('location');
        $customer->contact = $request->get('contact');
        $customer->email = $request->get('email');
        $customer->remark = $request->get('remark');
        $customer->dob = $dob;
        $customer->save();
        echo "Done";
    }

    public function otpverify(Request $request)
    {
        $this->validate($request, [
            'otp' => 'required',
        ]);

        $user = DB::table('customers')->where('id', $request->get('custid'))->where('reward_otp', $request->get('otp'))->first();
        if (!empty($user)) {
            $addpoint = $request->get('point');
            $rewardpoint = $user->reward_points;
            $addremove = $request->get('addremove');
            if ($addremove == 1) {
                $message = urlencode('Congratulations ' . $user->name . ' reward points credited with ' . $addpoint);
                $updatePoints = $rewardpoint + $addpoint;
            } else {
                $message = urlencode('Dear ' . $user->name . ' reward points deduct with ' . $addpoint);
                $updatePoints = $rewardpoint - $addpoint;
            }
            $otp = 0;
            $customer = customer::find($request->get('custid'));
            $customer->reward_points = $updatePoints;
            $customer->reward_otp = $otp;
            $customer->save();
            /*echo "Done";*/
            $this->sendSMS($user->contact, $message);
        } else {
            echo "Error";
        }
    }

    public function add_reward(Request $request)
    {
        $this->validate($request, [
            'point' => 'required',
        ]);

        $user = DB::table('customers')->where('id', $request->get('custid'))->first();
        if (!empty($user)) {
            $addpoint = $request->get('point');
            /*$rewardpoint = $user->reward_points;
            $updatePoints = $rewardpoint+$addpoint;*/
            $otp = mt_rand(100000, 999999);
            $customer = customer::find($request->get('custid'));
            // $customer->reward_points = $updatePoints;
            $customer->reward_otp = $otp;
            $customer->save();
            $message = urlencode('Dear User, Your otp for reward point of ' . $addpoint . ' is ' . $otp);
            $this->sendSMS($user->contact, $message);
            // other parametes might also contain spaces ...
            /*$username = urlencode('cvsalon');
        $sendername = urlencode('CVslon');
        //etc
        file_get_contents("http://sms.hspsms.com/sendSMS?username=".$username."&message=".$message."&sendername=".$sendername."&smstype=TRANS&numbers=".$user->contact."&apikey=9d0e9d96-143f-4141-ab1a-e32d648bd098");*/

        }

    }

    public function sendSms($to, $message)
    {

        $username = urlencode('cvsalon');
        $sendername = urlencode('CVslon');
        $url = "http://sms.hspsms.com/sendSMS?username=" . $username . "&message=" . $message . "&sendername=" . $sendername . "&smstype=TRANS&numbers=" . $to . "&apikey=9d0e9d96-143f-4141-ab1a-e32d648bd098";
        $ch = curl_init();
        //curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        echo "Done";
        // echo $output;
        //return $output;

    }

    public function getOrder($packageid = '')
    {
        $packages = DB::table('packages')->where('package_id', $packageid)->first();
        echo json_encode($packages);
    }

    public function ordernow(Request $request)
    {
        //dd($request);
        $this->validate($request, [
            'pay_mode' => 'required',
        ]);

        if ($request->get('package_id') != 0) {
            $expireDate = date('Y-m-d', strtotime('+ ' . $request->get('duration') . ' days'));
            /*echo $expireDate; die();*/
            $data = array(
                'customer_id' => 0,
                'member_in_package' => 1,
                'package_id' => $request->get('package_id'),
                'purchase_date' => date('Y-m-d H:i:s'),
                'expire_date' => $expireDate,
                'status' => 1,
            );

            $insertid = DB::table('customer_package')->insertGetId($data);
            if (!empty($insertid)) {
                $addMember = array(
                    'customer_id' => $request->get('id'),
                    'customer_package_id' => $insertid,
                    'status' => 1,
                );
                $addPackageMember = DB::table('package_members')->insertGetId($addMember);
                if (!empty($addPackageMember)) {
                    $package = DB::table('packages')->where('package_id', $request->get('package_id'))->first();
                    $serviceJson = json_decode($package->package_services);
                    foreach ($serviceJson as $value) {
                        $serviceid = $value->service;
                        $serviceData = array(
                            'customer_package_id' => $insertid,
                            'service_id' => $serviceid,
                            'total_services' => $value->total,
                            'remaining_services' => $value->total,
                            'status' => 1,
                        );
                        $serviceinsertid = DB::table('customer_package_service')->insertGetId($serviceData);
                    }
                    $transactiondata = array(
                        'customer_id' => $request->id,
                        'package_id' => $request->package_id,
                        'payment_mode' => $request->pay_mode,
                        'transaction_amount' => $request->price,
                        'transaction_date' => date('Y-m-d H:i:s'),
                        'status' => 1,
                    );
                    $transactioninsertid = DB::table('transaction')->insertGetId($transactiondata);
                    if (!empty($transactioninsertid)) {
                        echo "Done";
                    }
                }
            }
        } else {
            $serviceid = $request->get('serviceid');
            /*$checkService = DB::table('customer_package_service')->join('customer_package','customer_package.customer_package_id = customer_package_service.customer_package_id')->where('customer_package_service.service_id',$serviceid)->where('customer_package.customer_id',$request->id)->first();*/
            $checkService = DB::table('customer_package_service')->where('customer_package_service.service_id', $serviceid)->where('customer_package.customer_id', $request->id)->where('customer_package.package_id', 0)->leftJoin('customer_package', 'customer_package.customer_package_id', '=', 'customer_package_service.customer_package_id')->first();
            if (!empty($checkService)) {
                $oldtotalService = $checkService->total_services;
                $oldremainService = $checkService->remaining_services;
                $purchase_date = date('Y-m-d H:i:s');
                $customerpackageid = $checkService->customer_package_id;
                DB::table('customer_package')->where('customer_package_id', $customerpackageid)->update(array('updated_at' => $purchase_date));
                $packageserviceid = $checkService->package_service_id;
                $updateTotalService = $oldtotalService + 1;
                $updateRemainService = $oldremainService + 1;
                $serviceData = array(
                    'total_services' => $updateTotalService,
                    'remaining_services' => $updateRemainService,
                    // 'purchase_date' => $purchase_date,
                    'status' => 1,
                );
                DB::table('customer_package_service')->where('package_service_id', $packageserviceid)->update($serviceData);
                $transactiondata = array(
                    'customer_id' => $request->id,
                    'service_id' => $request->serviceid,
                    'payment_mode' => $request->pay_mode,
                    'transaction_amount' => $request->price,
                    'transaction_date' => date('Y-m-d H:i:s'),
                    'status' => 1,
                );
                $transactioninsertid = DB::table('service_transaction')->insertGetId($transactiondata);
                if (!empty($transactioninsertid)) {
                    echo "Done";
                }
            } else {
                $expireDate = date('Y-m-d', strtotime('+ ' . $request->get('duration') . ' days'));
                /*echo $expireDate; die();*/
                $data = array(
                    'customer_id' => $request->get('id'),
                    'package_id' => $request->get('package_id'),
                    'purchase_date' => date('Y-m-d H:i:s'),
                    'expire_date' => $expireDate,
                    'status' => 1,
                );

                $insertid = DB::table('customer_package')->insertGetId($data);
                if (!empty($insertid)) {
                    $serviceData = array(
                        'customer_package_id' => $insertid,
                        'service_id' => $serviceid,
                        'total_services' => 1,
                        'remaining_services' => 1,
                        'status' => 1,
                    );
                    $serviceinsertid = DB::table('customer_package_service')->insertGetId($serviceData);
                    if (!empty($serviceinsertid)) {
                        $transactiondata = array(
                            'customer_id' => $request->id,
                            'service_id' => $request->serviceid,
                            'payment_mode' => $request->pay_mode,
                            'transaction_amount' => $request->price,
                            'transaction_date' => date('Y-m-d H:i:s'),
                            'status' => 1,
                        );
                        $transactioninsertid = DB::table('service_transaction')->insertGetId($transactiondata);
                        if (!empty($transactioninsertid)) {
                            $user = DB::table('customers')->select('contact')->where('id', '=', $request->id)->first();
                            $sms = DB::table('sms_template')->select('template_message')->where('id', '=', 6)->first();
                            $message = urlencode($sms->template_message);
                            $this->sendSMS($user->contact, $message);
                            /*echo "Done";*/
                        }
                    }
                }
            }
        }
    }

    public function getService($serviceid = '')
    {
        $services = DB::table('services')->where('id', $serviceid)->first();
        echo json_encode($services);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //print_r($_POST); die();
        $customer_code = $this->genratecode('customers', 'customer_code', 6);

        $this->validate($request,
            [
                'name' => 'required',
                'contact' => 'required',
                'cust_type' => 'required',
                'referred_by' => 'nullable|exists:customers,referral_code',
            ],
            [
                'name.required' => 'Enter customer name',
                'contact.required' => 'Enter customer contact',
                'cust_type.required' => 'Select customer type',
                'referred_by.exists' => 'Please enter valid refferal code',
            ]
        );
        /*if ($request->file('image')!=null) {
        $input['image'] = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('images/customer'), $input['image']);
        }else{
        $input['image'] = "";
        }*/
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
        if (!empty($request->get('referred_by'))) {
            $refferuser = DB::table('customers')->where('referral_code', $request->get('referred_by'))->first();
            if (!empty($refferuser)) {
                $customer = new customer([
                    'admin_id' => Auth::user()->id,
                    'customer_id' => $request->get('customer_id'),
                    'sub_member_of' => $request->get('custid'),
                    'cust_type' => $request->get('cust_type'),
                    'name' => $request->get('name'),
                    // 'customer_image' => $input['image'],
                    'location' => $request->get('location'),
                    'contact' => $request->get('contact'),
                    'other_contact' => $request->get('other_contact'),
                    'email' => $request->get('email'),
                    'dob' => $dob,
                    'referral_code' => $request->get('referral_code'),
                    'referred_by' => $request->get('referred_by'),
                    'reward_points' => $request->get('reward_points'),
                    'anniversary_date' => $anniversary_date,
                    'customer_code' => $customer_code,
                    'rf_id' => $request->get('rf_id'),
                    'remark' => $request->get('remark'),
                    'customer_status' => 1,
                ]);
                $customer->save();
                if ($request->get('contact') != "" && $request->get('contact') != null) {
                    $message = urlencode('Dear User, You have successfully registered ...');
                    // other parametes might also contain spaces ...
                    $username = urlencode('cvsalon');
                    $sendername = urlencode('CVslon');
                    //etc
                    file_get_contents("http://arise.arisesmsworld.com/submitsms.jsp?user=SEYEIT&key=55524d5999XX&mobile=" . $request->get('contact') . "&message=" . $message . "&senderid=HAPPST&accusage=1");
                    /*file_get_contents("http://sms.hspsms.com/sendSMS?username=".$username."&message=".$message."&sendername=".$sendername."&smstype=TRANS&numbers=".$request->get('contact')."&apikey=9d0e9d96-143f-4141-ab1a-e32d648bd098");*/
                }
                return redirect('admin/customer')->with('success', 'Customer saved!');
            }
        } else {
            $customer = new customer([
                'admin_id' => Auth::user()->id,
                'customer_id' => $request->get('customer_id'),
                'sub_member_of' => $request->get('custid'),
                'cust_type' => $request->get('cust_type'),
                'name' => $request->get('name'),
                // 'customer_image' => $input['image'],
                'location' => $request->get('location'),
                'contact' => $request->get('contact'),
                'other_contact' => $request->get('other_contact'),
                'email' => $request->get('email'),
                'dob' => $dob,
                'referral_code' => $request->get('referral_code'),
                'referred_by' => "",
                'reward_points' => $request->get('reward_points'),
                'anniversary_date' => $anniversary_date,
                'customer_code' => $customer_code,
                'rf_id' => $request->get('rf_id'),
                'remark' => $request->get('remark'),
                'customer_status' => 1,
            ]);
            $customer->save();
            //Get last inserted id
            $lastInsertedId = $customer->id;
            if (!empty($lastInsertedId)) {
                $getPackageDetails = DB::table('customer_package')->leftJoin('packages', 'packages.package_id', '=', 'customer_package.package_id')->where('customer_package.customer_package_id', $request->get('custpackid'))->first();
                if (!empty($getPackageDetails)) {
                    $total_member = $getPackageDetails->total_member;
                    $member_in_package = $getPackageDetails->member_in_package;
                    if ($total_member != $member_in_package) {
                        $addMember = array(
                            'customer_id' => $lastInsertedId,
                            'customer_package_id' => $request->get('custpackid'),
                            'status' => 1,
                        );
                        $addPackageMember = DB::table('package_members')->insertGetId($addMember);
                        if (!empty($addPackageMember)) {
                            $updateMember = $member_in_package + 1;
                            DB::table('customer_package')->where('customer_package_id', $request->get('custpackid'))->update(array('member_in_package' => $updateMember));
                        }
                    }
                }

            }
            if ($request->get('contact') != "" && $request->get('contact') != null) {
                $message = urlencode('Dear User, You have successfully registered ...');
                // other parametes might also contain spaces ...
                $username = urlencode('cvsalon');
                $sendername = urlencode('CVslon');
                //etc
                file_get_contents("http://arise.arisesmsworld.com/submitsms.jsp?user=SEYEIT&key=55524d5999XX&mobile=" . $request->get('contact') . "&message=" . $message . "&senderid=HAPPST&accusage=1");
                // file_get_contents("http://sms.hspsms.com/sendSMS?username=".$username."&message=".$message."&sendername=".$sendername."&smstype=TRANS&numbers=".$request->get('contact')."&apikey=9d0e9d96-143f-4141-ab1a-e32d648bd098");
            }
            echo "Done";
            // return redirect('admin/customer')->with('success', 'Customer saved!');
        }
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function getservices()
    {

    }

    public function delete_transaction($id, $cust_id)
    {
        $data = "";
        if (!empty($id) && !empty($cust_id)) {
            DB::table('service_transaction')->where('service_transaction_id', '=', $id)->delete();
            $sevicetransaction = DB::table('service_transaction')->where('service_transaction.customer_id', $cust_id)->leftJoin('services', 'services.id', '=', 'service_transaction.service_id')->get();
            if (!empty($sevicetransaction)) {
                foreach ($sevicetransaction as $servicetrans) {
                    $data .= '<tr>
                <td>' . $servicetrans->name . '</td>
                <td>' . $servicetrans->service_price . ' Rs</td>
                <td>' . date('d-m-Y', strtotime($servicetrans->transaction_date)) . '</td>
                <td>
                  <a href="javascript:void(0)" onclick="deleteTransaction(' . $servicetrans->service_transaction_id . ',' . $servicetrans->customer_id . ')" class="btn-danger btn-sm waves-effect waves-light material-tooltip-main" style="border:0 !important" data-toggle="tooltip" data-html="true" title="Delete">
                      <i class="mdi mdi-delete"></i>
                  </a>
                </td>
              </tr>';
                }
            }
        } else {
            $data .= "";
        }
        echo $data;
    }

    public function delete_transaction2(Request $request)
    {

        $id = $request->id;
        if (!empty($id)) {
            DB::table('service_transaction')->where('service_transaction_id', '=', $id)->delete();
            return redirect('/admin/firm')->with('success', 'Transaction deleted!');
        }
    }

    public function getproducts($bid)
    {
        $data = "<option value=''>Select</option>";
        $products = DB::table('service_products')->where('brand_id', $bid)->get();
        if (!empty($products)) {
            foreach ($products as $value) {
                $data .= "<option value='" . $value->product_id . "'>" . $value->product_name . "</option>";
            }
        } else {
            $data = "<option value=''>Select</option>";
        }
        echo $data;
    }

    public function getbrand(Request $request)
    {
        $data = "<option value=''>Select</option>";
        $brands = DB::table('product_brands')->where('service_id', $request->get('id'))->get();
        if (!empty($brands)) {
            foreach ($brands as $value) {
                $data .= "<option value='" . $value->id . "'>" . $value->brand_name . "</option>";
            }
        } else {
            $data = "<option value=''>Select</option>";
        }
        echo $data;
    }

    public function checkin_customer()
    {
        $customer = DB::table('customers')
        ->where('customers.checkin', 1)
        ->get();
        return view('customer.checkin_cust', compact('customer'));
    }

    public function recent_checkin()
    {
        $last_record = Customer::orderBy('id', 'desc')->first();
        if ($last_record != '') {
            $last_id = 1 + $last_record->id;
        } else {
            $last_id = 1;
        }
        return view('customer.recent_checked',compact('last_id'));
    }

    public function recent_all_checkin()
    {
        $checkin_customer = DB::table('customers')
        // ->leftJoin('invoice', 'invoice.user_id', '=', 'customers.id')
        ->where('customers.checkin', 1)->orderBy('updated_at','DESC')->get();
        echo json_encode(['msg' => true, 'data' => $checkin_customer]);
    }



}
