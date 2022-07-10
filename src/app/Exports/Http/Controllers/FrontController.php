<?php

namespace App\Http\Controllers;

use App\Front;
use App\User;
use DB;
use App\Model\admin\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index()
    {
       return view('front.mainfront');
    }

    public function signup($hashcode='')
    {
      $last_record = Customer::orderBy('id', 'desc')->first();
      if($last_record!=''){
          $last_id = 1+$last_record->id;
      }else{
          $last_id = 1;
      }
      return view('auth.signup',compact('hashcode','last_id'));
    }

    public function registerCustomer(Request $request)
    {
      $customer_code = $this->genratecode('customers','customer_code',6);
      $this->validate($request, 
        [
          'name'=>'required',
          'email'=>'required|unique:customers,email',
          'contact'=>'required|unique:customers,contact',
          'gender'=>'required',
          'dob'=>'required',
          'location'=>'required',
          'password'=>'required',
          'confirmpassword'=>'required',
        ],
        [
          'name.required' => 'Enter name',
          'email.required' => 'Enter email',
          'contact.required' => 'Enter contact',
          'gender.required' => 'Select gender',
          'dob.required' => 'Enter date of birth',
          'location.required' => 'Enter location',
          'password.required' => 'Enter password',
          'confirmpassword.required' => 'Enter confirm password',
        ]
      );
      $reffer_hashcode = $request->get('reffer_hashcode');
      $getCustomerDetail = DB::table('customers')->where('referral_hash_code',$reffer_hashcode)->first();
      if (!empty($getCustomerDetail)) {
        if(request('dob')!=''){
            $dob = date('Y-m-d',strtotime($request->get('dob')));
        }else{
            $dob = null;
        }
        $hashcode = md5($request->get('last_id'));
        $customer = new customer([
              'admin_id' => 1,
              'customer_id' => $request->get('last_id'),
              'cust_type' => 'VIP',
              'name' => $request->get('name'),
              'location' => $request->get('location'),
              'contact' => $request->get('contact'),
              'other_contact' => $request->get('contact'),
              'email' => $request->get('email'),
              'dob' => $dob,
              'referral_code' => $request->get('last_id'),
              'referral_hash_code' => $hashcode,
              'referred_by' => $getCustomerDetail->id,
              'reward_points' => '100',
              // 'anniversary_date' => $anniversary_date,
              'customer_code' => $customer_code,
              'rf_id' => $request->get('last_id'),
              // 'remark' => $request->get('remark'),
              'gender' => $request->get('gender'),
              'designation' => $request->get('designation'),
              'total_visit' => 0,
              'total_revenue' => 0,
              'customer_status' => 1,
          ]);
            $customer->save();
             $id = $customer->id;
            if (!empty($id)) {
              $username = urlencode('cvsalon');
              $sendername = urlencode('CVslon');
              $refferCustomer = customer::find($getCustomerDetail->id);
              if (!empty($refferCustomer)) {
                $msg = urlencode("Dear ".$refferCustomer->name.", ".$request->get('name')." Reffered By you. You get 50 reward points"); 
                $total_reffer = $refferCustomer->total_reffer + 1;
                $total_rewards = $refferCustomer->reward_points + 50;
                $refferCustomer->total_reffer =  $total_reffer;
                $refferCustomer->reward_points =  $total_rewards;
                $refferCustomer->save();

                /*file_get_contents("http://sms.hspsms.com/sendSMS?username=".$username."&message=".$msg."&sendername=".$sendername."&smstype=TRANS&numbers=".$refferCustomer->contact."&apikey=9d0e9d96-143f-4141-ab1a-e32d648bd098");*/

              //  file_get_contents("http://arise.arisesmsworld.com/submitsms.jsp?user=SEYEIT&key=55524d5999XX&mobile=".$refferCustomer->contact."&message=".$msg."&senderid=HAPPST&accusage=1");
                file_get_contents("http://sms.hspsms.com/sendSMS?username=cvsalon&message=".$msg."&sendername=CVslon&smstype=TRANS&numbers=".$refferCustomer->contact."&apikey=9d0e9d96-143f-4141-ab1a-e32d648bd098");
              }
              if($request->get('contact') != "" && $request->get('contact') != NULL){
                $message = urlencode('Dear User, You have successfully registered ...');
                $message2 = urlencode('Dear User, You can share and earn reward points. Your refferal link is '.url('customers/signup/'.$hashcode));
                $message3 = urlencode('Dear User, Congratulations you get 100 Reward Points');
                // other parametes might also contain spaces ...
                
                //etc
                /*file_get_contents("http://sms.hspsms.com/sendSMS?username=".$username."&message=".$message."&sendername=".$sendername."&smstype=TRANS&numbers=".$request->get('contact')."&apikey=9d0e9d96-143f-4141-ab1a-e32d648bd098");*/

              //  file_get_contents("http://arise.arisesmsworld.com/submitsms.jsp?user=SEYEIT&key=55524d5999XX&mobile=".$request->get('contact')."&message=".$message."&senderid=HAPPST&accusage=1");
               // file_get_contents("http://arise.arisesmsworld.com/submitsms.jsp?user=SEYEIT&key=55524d5999XX&mobile=".$request->get('contact')."&message=".$message2."&senderid=HAPPST&accusage=1");
              //  file_get_contents("http://arise.arisesmsworld.com/submitsms.jsp?user=SEYEIT&key=55524d5999XX&mobile=".$request->get('contact')."&message=".$message3."&senderid=HAPPST&accusage=1");
                
               file_get_contents("http://sms.hspsms.com/sendSMS?username=cvsalon&message=".$message."&sendername=CVslon&smstype=TRANS&numbers=".$request->get('contact')."&apikey=9d0e9d96-143f-4141-ab1a-e32d648bd098");
               file_get_contents("http://sms.hspsms.com/sendSMS?username=cvsalon&message=".$message2."&sendername=CVslon&smstype=TRANS&numbers=".$request->get('contact')."&apikey=9d0e9d96-143f-4141-ab1a-e32d648bd098");
               file_get_contents("http://sms.hspsms.com/sendSMS?username=cvsalon&message=".$message3."&sendername=CVslon&smstype=TRANS&numbers=".$request->get('contact')."&apikey=9d0e9d96-143f-4141-ab1a-e32d648bd098");
 
                
                /*file_get_contents("http://sms.hspsms.com/sendSMS?username=".$username."&message=".$message2."&sendername=".$sendername."&smstype=TRANS&numbers=".$request->get('contact')."&apikey=9d0e9d96-143f-4141-ab1a-e32d648bd098");
                
                file_get_contents("http://sms.hspsms.com/sendSMS?username=".$username."&message=".$message3."&sendername=".$sendername."&smstype=TRANS&numbers=".$request->get('contact')."&apikey=9d0e9d96-143f-4141-ab1a-e32d648bd098");*/
              }
            }
          return redirect('/')->with('success', 'Customer saved!');
      }
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

    public function mallbranding()
    {
       $branding = Front::brandings();
       return view('front.mallbranding',['branding'=>$branding]);
       //return view('afront.user.userfront',['manageusers'=>$manageusers,'user_detail'=>$user_detail,'active_tab'=>$active_tab,'company_type'=>$company_type,'nature_of_business'=>$nature_of_business]);
    }

    public function about(){
      return view('front.about');
    }
     public function services(){
      return view('front.services');
    }
    public function events(){
      return view('front.events');
    }
    public function posts(){
      return view('front.posts');
    }

    public function clients(){
      return view('front.clients');
    }


    public function careers(){
      return view('front.careers');
    }


    public function contacts(){
      return view('front.contacts');
    }



}
