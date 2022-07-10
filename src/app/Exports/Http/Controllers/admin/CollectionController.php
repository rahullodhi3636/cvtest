<?php

namespace App\Http\Controllers\admin;

use App\Model\admin\Customer;
// use App\Model\admin\Collection;
use App\Model\admin\Packages;
use App\Model\admin\Services;
use App\Model\admin\Enquiry_categories;
use App\User;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
      $transaction = DB::table('transaction')->leftJoin('customers', 'customers.id', '=', 'transaction.customer_id')->leftJoin('packages','packages.package_id','=','transaction.package_id')->get();
      /*$servicetransaction = DB::table('service_transaction')->select('services.name as service_name','customers.*,service_transaction.payment_mode,service_transaction.transaction_amount,service_transaction.transaction_amount')->leftJoin('customers', 'customers.id', '=', 'service_transaction.customer_id')->leftJoin('services','services.id','=','service_transaction.service_id')->get();*/
      $servicetransaction = DB::table('service_transaction')->select('service_transaction.*','customers.name as customer_name','services.name as service_name')->leftJoin('customers', 'customers.id', '=', 'service_transaction.customer_id')->leftJoin('services','services.id','=','service_transaction.service_id')->get();
      //dd($servicetransaction); die();
      // $customer = Collection::all();
      return view('admin.transaction.collectionlist')->with(['transaction'=>$transaction,'servicetransaction'=>$servicetransaction]);
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
           $customer_code = $this->genratecode('customers','customer_code',6);
           
            $this->validate($request, 
              [
                'name'=>'required',
                'contact'=>'required',
                // 'package_id'=>'required',
                'cust_type'=>'required',
                // 'referred_by' => 'exists:customers,referral_code'
                // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
              ],
              [
                'name.required' => 'Enter customer name',
                'contact.required' => 'Enter customer contact',
                'cust_type.required' => 'Select customer type',
                // 'referred_by.required' => 'Please enter refferal code',
                'referred_by.exists' => 'Please enter valid refferal code'
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
                    'referred_by' => $request->get('referred_by'),
                    'reward_points' => $request->get('reward_points'),
                    'anniversary_date' => $anniversary_date,
                    'customer_code' => $customer_code,
                    'rf_id' => $request->get('rf_id'),
                    'remark' => $request->get('remark'),
                    'customer_status' => 1,
                ]);
                $customer->save();
                return redirect('admin/customer')->with('success', 'Customer saved!');
              }else{
                $this->validate($request, 
                  [
                    'referred_by' => 'required'
                  ],
                  [
                    'referred_by.required' => 'Please enter valid refferal code'
                  ]
                );
                /*$packages = Packages::all();
                $categories = Enquiry_categories::where('is_active','1')->get();
                $last_record = Customer::orderBy('id', 'desc')->first();
                if($last_record!=''){
                    $last_id = 1+$last_record->id;
                }else{
                    $last_id = 1;
                }*/
                // return back()->withErrors(['referred_by','Please enter valid refferal code']);
                // return view('admin.customer.customer_create',compact('packages','categories','last_id'));
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
                  'referred_by' => "",
                  'reward_points' => $request->get('reward_points'),
                  'anniversary_date' => $anniversary_date,
                  'customer_code' => $customer_code,
                  'rf_id' => $request->get('rf_id'),
                  'remark' => $request->get('remark'),
                  'customer_status' => 1,
              ]);
              $customer->save();
              return redirect('admin/customer')->with('success', 'Customer saved!');
            }

            /*$customer = new customer([
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
                'referred_by' => $request->get('referred_by'),
                'reward_points' => $request->get('reward_points'),
                'anniversary_date' => $anniversary_date,
                'customer_code' => $customer_code,
                'rf_id' => $request->get('rf_id'),
                'remark' => $request->get('remark'),
                'customer_status' => 1,
            ]);*/
        
            
            
            
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