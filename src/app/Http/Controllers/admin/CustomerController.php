<?php

namespace App\Http\Controllers\admin;

use App\Model\admin\Customer;
use App\Model\admin\Collection;
use App\Model\admin\Packages;
use App\Model\admin\Services;
use App\Model\admin\Enquiry_categories;
use App\User;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
      $customer = Customer::all();
      return view('admin.customer.customer_list', compact('customer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $packages = Packages::all();
        $categories = Enquiry_categories::where('is_active','1')->get();
        $last_record = Customer::orderBy('id', 'desc')->first();
        if($last_record!=''){
            $last_id = 1+$last_record->id;
        }else{
            $last_id = 1;
        }
        return view('admin.customer.customer_create',compact('packages','categories','last_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // print_r($_POST); die;
      // dd('asjdfljasdlf');
       $customer_code = $this->genratecode('customers','customer_code',6);

        $this->validate($request,
          [
            'name'=>'required',
            'contact'=>'required|unique:customers,contact',
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
        if ($request->file('image')!=null) {
          // dd($request->file('image'));
          $input['image'] = time().'.'.$request->image->getClientOriginalExtension();
          $request->image->move(public_path('images/customer'), $input['image']);
        }else{
          $input['image'] = "";
        }

        if(request('anniversary_date')!=''){
            $anniversary_date = date('Y-m-d',strtotime($request->get('anniversary_date')));
        }else{
            $anniversary_date = null;
        }

        if(request('dob')!=''){
            $dob = date('Y-m-d',strtotime($request->get('dob')));
        }else{
            $dob = null;
        }

        $hashcode = md5($request->get('referral_code'));
        if (!empty($request->get('referred_by'))) {
          $refferuser = DB::table('customers')->where('referral_code', $request->get('referred_by'))->first();
          if(!empty($refferuser)){
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
                'remarks' => $request->get('remark'),
                'gender' => $request->get('gender'),
                'designation' => $request->get('designation'),
                'total_visit' => 0,
                'total_revenue' => 0,
                'customer_status' => 1,
            ]);
            $customer->save();
              if($request->get('contact') != "" && $request->get('contact') != NULL){
                $message = urlencode('Dear User, You have successfully registered ...');
                $message2 = urlencode('Dear User, You can share and earn reward points. Your refferal link is '.url('signup/'.$hashcode));
                // other parametes might also contain spaces ...
                $username = urlencode('cvsalon');
                $sendername = urlencode('CVslon');
                //etc
                file_get_contents("http://arise.arisesmsworld.com/submitsms.jsp?user=SEYEIT&key=55524d5999XX&mobile=".$request->get('contact')."&message=".$message."&senderid=HAPPST&accusage=1");
                // file_get_contents("http://sms.hspsms.com/sendSMS?username=".$username."&message=".$message."&sendername=".$sendername."&smstype=TRANS&numbers=".$request->get('contact')."&apikey=9d0e9d96-143f-4141-ab1a-e32d648bd098");
                // other parametes might also contain spaces ...
                /*$username2 = urlencode('cvsalon');
                $sendername2 = urlencode('CVslon');*/
                //etc
                file_get_contents("http://arise.arisesmsworld.com/submitsms.jsp?user=SEYEIT&key=55524d5999XX&mobile=".$request->get('contact')."&message=".$message2."&senderid=HAPPST&accusage=1");
                //file_get_contents("http://sms.hspsms.com/sendSMS?username=".$username."&message=".$message2."&sendername=".$sendername."&smstype=TRANS&numbers=".$request->get('contact')."&apikey=9d0e9d96-143f-4141-ab1a-e32d648bd098");
              }
            return redirect('admin/customer')->with('success', 'Customer saved!');
          }
        }else{
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
              'remarks' => $request->get('remark'),
              'gender' => $request->get('gender'),
              'designation' => $request->get('designation'),
              'total_visit' => 0,
              'total_revenue' => 0,
              'customer_status' => 1,
          ]);
          $customer->save();
          if($request->get('contact') != "" && $request->get('contact') != NULL){
            $message = urlencode('Dear User, You have successfully registered ...');
            $message2 = urlencode('Dear User, You can share and earn reward points. Your refferal link is '.url('signup/'.$hashcode));
            // other parametes might also contain spaces ...
            $username = urlencode('cvsalon');
            $sendername = urlencode('CVslon');
            $to = $request->get('contact');
            /*sendSMS($to,$message);
            sendSMS($to,$message2);*/
            //etc
            file_get_contents("http://arise.arisesmsworld.com/submitsms.jsp?user=SEYEIT&key=55524d5999XX&mobile=".$request->get('contact')."&message=".$message."&senderid=HAPPST&accusage=1");
            // file_get_contents("http://sms.hspsms.com/sendSMS?username=".$username."&message=".$message."&sendername=".$sendername."&smstype=TRANS&numbers=".$request->get('contact')."&apikey=9d0e9d96-143f-4141-ab1a-e32d648bd098");
            // other parametes might also contain spaces ...
            /*$username2 = urlencode('cvsalon');
            $sendername2 = urlencode('CVslon');*/
            //etc
            file_get_contents("http://arise.arisesmsworld.com/submitsms.jsp?user=SEYEIT&key=55524d5999XX&mobile=".$request->get('contact')."&message=".$message2."&senderid=HAPPST&accusage=1");
             // file_get_contents("http://sms.hspsms.com/sendSMS?username=".$username."&message=".$message2."&sendername=".$sendername."&smstype=TRANS&numbers=".$request->get('contact')."&apikey=9d0e9d96-143f-4141-ab1a-e32d648bd098");
          }
          return redirect('customers')->with('success', 'Customer saved!');
        }
    }


    /*function sendSMS($to, $message) {
        $content = 'username=' . rawurlencode('cvsalon') .
                '&password=' . rawurlencode('') .
                '&sender=' . rawurlencode('CVslon') .
                '&to=' . rawurlencode($to) .
                '&message=' . rawurlencode($message) .
                '&reqid=' . rawurlencode(1) .
                '&format={json|text}' .
                '&route_id=' . rawurlencode('113');
        $ch = curl_init('http://login.heightsconsultancy.com/API/WebSMS/Http/v1.0a/index.php'? . $content);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }*/

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
        $customer = customer::find($id);
        $packages = Packages::all();
        $categories = Enquiry_categories::where('is_active','1')->get();
        return view('admin.customer.customer_edit')->with(['customer'=>$customer,'packages'=>$packages,'categories'=>$categories]);
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
        $this->validate($request, [
            'name'=>'required',
            'contact'=>'required',
            // 'package_id'=>'required',
            'cust_type'=>'required'
        ]);

        if(request('anniversary_date')!=''){
            $anniversary_date = date('Y-m-d',strtotime($request->get('anniversary_date')));
        }else{
            $anniversary_date = null;
        }

        if(request('dob')!=''){
            $dob = date('Y-m-d',strtotime($request->get('dob')));
        }else{
            $dob = null;
        }



        $customer = customer::find($id);
        $customer->customer_id =  $request->get('customer_id');
        // $customer->package_id =  $request->get('package_id');
        $customer->cust_type =  $request->get('cust_type');
        $customer->name = $request->get('name');
        if ($request->file('image')!=null) {
          $input['image'] = time().'.'.$request->image->getClientOriginalExtension();
          $request->image->move(public_path('images/customer'), $input['image']);
          $customer->customer_image = $input['image'];
        }
        $customer->location = $request->get('location');
        $customer->contact = $request->get('contact');
        $customer->other_contact = $request->get('other_contact');
        $customer->email = $request->get('email');
        $customer->dob = $dob;
        $customer->referral_code = $request->get('referral_code');
        $customer->referred_by = $request->get('referred_by');
        $customer->reward_points = $request->get('reward_points');
        $customer->anniversary_date = $anniversary_date;
        $customer->rf_id = $request->get('rf_id');
        $customer->remark = $request->get('remark');
        $customer->customer_status = 1;
        $customer->save();

        return redirect('admin/customer')->with('success', 'Customer updated!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = customer::find($id);
        $customer->delete();
        return redirect('/admin/customer')->with('success', 'Customer deleted!');
    }

    public function genratecode($tablename,$columnname,$digit){
      $code = $this->generate($digit);
      $checkcode =  DB::table($tablename)->select('*')->where($columnname,'=',$code)->count();
      if($checkcode>0){
         $code = $this->genratecode($tablename,$columnname,$digit);
      }
      return $code;
    }

    public function generate($digit){
      $characters = '123456789';
      $charactersLength = strlen($characters);
      $randomString = '';
          for ($i = 0; $i < $digit; $i++) {
              $randomString .= $characters[rand(0, $charactersLength - 1)];
          }
      return $randomString;
    }

    public function getservices()
    {
      $id = request('package_id');
      $packages = Packages::find($id);
      $services = array();
      if(!empty($packages)){
          if($packages->package_services!=''){
              $servic = json_decode($packages->package_services);
              foreach ($servic as $key => $value) {
                  $ser = Services::where('id',$value->service)->first();
                  $content['service'] = (!empty($ser))?$ser->name:'';
                  $content['total'] = $value->total;
                  $services[] = $content;
              }
          }
      }
      echo json_encode($services);
    }

}
