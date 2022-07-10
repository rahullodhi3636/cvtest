<?php

namespace App\Http\Controllers\admin;

use App\Model\admin\Manageusers;
use App\Front;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use Carbon\Carbon;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;



class ManageusersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function importExportView()
    {
       return view('admin.manageusers.manageusers_import');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import(Request $request) 
    {
        $this->validate($request, [
                'file' => 'required'
        ]);

        Excel::import(new UsersImport,request()->file('file')); 
         return redirect('admin/manageusers')->with(['success' => 'Imported Successfully']);
    }

    public function index()
    {
        $manageusers = Manageusers::getall();
        $method = 'manageusers';
        return view('admin.manageusers.manageusers_list', compact('manageusers','method'));
    }

    public function active()
    {
        $manageusers = Manageusers::getall_active();
        $method = 'active-manageusers';
        return view('admin.manageusers.manageusers_list', compact('manageusers','method'));
    }

    public function deactive()
    {   
        $manageusers = Manageusers::getall_deactive();
        $method = 'deactive-manageusers';
        return view('admin.manageusers.manageusers_list', compact('manageusers','method'));
    }


    public function admin_manageusers()
    {   
        $manageusers = Manageusers::getall_admin_manageusers();
        $method = 'admin-manageusers';
        return view('admin.manageusers.manageusers_list', compact('manageusers','method'));
    }

    public function non_core_manageusers()
    {   
        $manageusers = Manageusers::getall_non_core_manageusers();
        $method = 'non-core-manageusers';
        return view('admin.manageusers.manageusers_list', compact('manageusers','method'));
    }

    public function core_integra_manageusers()
    {   
        $manageusers = Manageusers::getall_core_integra_manageusers();
        $method = 'core-integra-manageusers';
        return view('admin.manageusers.manageusers_list', compact('manageusers','method'));
    }

    public function core_sub_manageusers()
    {   
        $manageusers = Manageusers::getall_core_sub_manageusers();
        $method = 'core-sub-manageusers';
        return view('admin.manageusers.manageusers_list', compact('manageusers','method'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
    {
        return view('admin.manageusers.manageusers_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
            $front = new Front();

            $this->validate($request, [
                    'name'=>'required',
                    'lname'=>'required',
                    'parent_name'=>'required',
                    'mobile_no'=>'required|unique:users|numeric',
                    'dob'=>'required',
                    'aadharcard_number'=>'required|unique:users|numeric|min:12',
                    'email' => 'required|string|email|unique:users',
                    'password'=>'required',
                    'user_type'=>'required',
                    'image' => 'image|mimes:jpeg,png,jpg'
            ]);
            
            if($request->hasFile('image')){
                  $imageName = time().'.'.request()->image->getClientOriginalExtension();
                  request()->image->move(public_path('images/users'), $imageName);
                }else{
                  $imageName = '';
                }
                $admin = 0;
                if($request->user_type==0){
                    $admin = 1;
                }

                $manageusers = new Manageusers([
                                "name" => $request->name,
                                "email" =>  $request->email,
                                "remember_token" =>  $request->_token,
                                "password" => Hash::make($request->password),
                                "user_type" => $request->user_type,
                                "admin" => $admin,
                                "lname" => $request->lname,
                                "parent_name" => $request->parent_name,
                                "email" => $request->email,
                                "phone_no" => $request->phone_no,
                                "mobile_no" => $request->mobile_no,
                                "aadharcard_number" => $request->aadharcard_number,
                                "image" => $imageName,
                                "dob" => date('Y-m-d',strtotime($request->dob)),
                                "status" => $request->status,
                                "updated_at" => date('Y-m-d H:i:s'),
                                "created_at" => date('Y-m-d H:i:s'),
                             ]);

                $insert = $manageusers->save();

                $register_other = array(
                    "user_id" => $manageusers->id,
                    "updated_at" => date('Y-m-d H:i:s')
                );

                $front->insert_register($register_other);

                if($insert){
                    return redirect('admin/manageusers')->with(['success' => 'Registration successfully']);
                }else{
                    return redirect('admin/manageusers/create')->with('error', 'Registration Not done');
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
        $manageusers = Manageusers::find($id);
        
        $user_detail = Front::user_detail($id);
        $active_tab = 'tab1';
        $company_type = Front::company_type();
        $nature_of_business = Front::nature_of_business();
        return view('admin.manageusers.manageusers_edit',['manageusers'=>$manageusers,'user_detail'=>$user_detail,'active_tab'=>$active_tab,'company_type'=>$company_type,'nature_of_business'=>$nature_of_business]);
    }


    public function personal_info($id)
    {
        $manageusers = Manageusers::find($id);
        
        $user_detail = Front::user_detail($id);
        $active_tab = 'tab2';
        $company_type = Front::company_type();
        $nature_of_business = Front::nature_of_business();
        return view('admin.manageusers.manageusers_edit',['manageusers'=>$manageusers,'user_detail'=>$user_detail,'active_tab'=>$active_tab,'company_type'=>$company_type,'nature_of_business'=>$nature_of_business]);
    }

    public function dependent_info($id)
    {
        $manageusers = Manageusers::find($id);
        
        $user_detail = Front::user_detail($id);
        $active_tab = 'tab3';
        $company_type = Front::company_type();
        $nature_of_business = Front::nature_of_business();
        return view('admin.manageusers.manageusers_edit',['manageusers'=>$manageusers,'user_detail'=>$user_detail,'active_tab'=>$active_tab,'company_type'=>$company_type,'nature_of_business'=>$nature_of_business]);
    }

    public function company_info($id)
    {
        $manageusers = Manageusers::find($id);
        
        $user_detail = Front::user_detail($id);
        $active_tab = 'tab4';
        $company_type = Front::company_type();
        $nature_of_business = Front::nature_of_business();
        return view('admin.manageusers.manageusers_edit',['manageusers'=>$manageusers,'user_detail'=>$user_detail,'active_tab'=>$active_tab,'company_type'=>$company_type,'nature_of_business'=>$nature_of_business]);
    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function basic_info(Request $request)
    {   
       
        $Manageusers = new Manageusers();
        $id = $request->user_id;

       
        $this->validate($request, [
                    'name'=>'required',
                    'lname'=>'required',
                    'parent_name'=>'required',
                    'mobile_no'=>'required|numeric|unique:users,id,'.$id,
                    'dob'=>'required',
                    'aadharcard_number'=>'required|numeric|min:12|unique:users,id,'.$id,
                    'email' => 'required|string|email|unique:users,id,'.$id,
                    'user_type'=>'required',
                    'image' => 'nullable|image|mimes:jpeg,png,jpg'
        ]);         
        
        $admin = 0;
                if($request->user_type==0){
                    $admin = 1;
        }

        $register = array(
                                "name" => $request->name,
                                "email" =>  $request->email,
                                "remember_token" =>  $request->_token,
                                "user_type" => $request->user_type,
                                "admin" => $admin,
                                "lname" => $request->lname,
                                "parent_name" => $request->parent_name,
                                "email" => $request->email,
                                "phone_no" => $request->phone_no,
                                "mobile_no" => $request->mobile_no,
                                "status"=> $request->status,
                                "aadharcard_number" => $request->aadharcard_number,
                                "dob" => date('Y-m-d',strtotime($request->dob)),
                                "updated_at" => date('Y-m-d H:i:s'),
            );

        
        
        if($request->hasFile('image')){
                  $imageName = time().'.'.request()->image->getClientOriginalExtension();
                  request()->image->move(public_path('images/users'), $imageName);
                  $register['image'] = $imageName;
        }
         
        $insert = $Manageusers->update_user($register,$id);
        
        if($insert){
                    return redirect('admin/personal_info/'.$id.'/edit')->with('success', 'Updated successfully!');
                }else{
                    return redirect('admin/manageusers')->with('error', 'Registration Not done');
        }
    }


    public function save_personal_info(Request $request){
                $Manageusers = new Manageusers();
                $user_id = $request->user_id;

                $this->validate($request, [
                        'user_id'=>'required',
                        'aadharcard_number'=>'required|numeric|min:12|unique:users,id,'.$user_id,
                ]);


                $register = array(
                                "aadharcard_number" => $request->aadharcard_number,
                                "dob" => date('Y-m-d',strtotime($request->dob)),
                                "updated_at" => date('Y-m-d H:i:s'),
                            );

                $insert = $Manageusers->update_user($register,$user_id);

                $gender = ($request->gender)?($request->gender):'';
                $merital_status = ($request->merital_status)?($request->merital_status):0;
                $diasability = ($request->diasability)?($request->diasability):0;
                $same_address = ($request->same_address)?($request->same_address):0;


                $register_other = array(
                                "gender" => $gender,
                                "user_id" => $user_id,
                                "merital_status" => $merital_status,
                                "diasability" => $diasability,
                                "same_address" => $same_address,
                                "current_address" => $request->current_address,
                                "street_address" => $request->street_address,
                                "state" => $request->state,
                                "city" => $request->city,
                                "pincode" => $request->pincode,
                                "permanent_address" => $request->permanent_address,
                                "pstreet_address" => $request->pstreet_address,
                                "pstate" => $request->pstate,
                                "pcity" => $request->pcity,
                                "ppincode" => $request->ppincode,
                                "pancard_no" => $request->pancard_no,
                                "esic_card_no" => $request->esic_card_no,
                                "updated_at" => date('Y-m-d H:i:s'),
                            );

                if($request->hasFile('pancard_image')){
                      $pancard_image = time().'_pi'.'.'.request()->pancard_image->getClientOriginalExtension();
                      request()->pancard_image->move(public_path('images/users'), $pancard_image);
                      $register_other['pancard_image'] = $pancard_image;
                }

                if($request->hasFile('aadharcard_image')){
                      $aadharcard_image = time().'_ai'.'.'.request()->aadharcard_image->getClientOriginalExtension();
                      request()->aadharcard_image->move(public_path('images/users'), $aadharcard_image);
                      $register_other['aadharcard_image'] = $aadharcard_image;
                }

                if($request->hasFile('esic_card_image')){
                      $esic_card_image = time().'_eci'.'.'.request()->esic_card_image->getClientOriginalExtension();
                      request()->esic_card_image->move(public_path('images/users'), $esic_card_image);
                      $register_other['esic_card_image'] = $esic_card_image;
                }


                $insert_register = $Manageusers->update_register($register_other,$user_id);
                

                if($insert_register){
                    return redirect('admin/dependent_info/'.$user_id.'/edit')->with('success', 'Updated successfully!');
                }else{
                    return redirect('admin/personal_info/'.$user_id.'/edit')->with('error', 'Not updated!');
                }
    }


    public function save_dependent_info(Request $request){
                $Manageusers = new Manageusers();
                $user_id = $request->user_id;

                $this->validate($request, [
                        'user_id'=>'required',
                ]);

                $user_id = $request->user_id;
                $register_other = array(
                                "relation" => json_encode($request->relation),
                                "updated_at" => date('Y-m-d H:i:s'),
                            );
                $insert_register = $Manageusers->update_register($register_other,$user_id);

                if($insert_register){
                     return redirect('admin/company_info/'.$user_id.'/edit')->with('success', 'Updated successfully!');
                    
                }else{
                     return redirect('admin/dependent_info/'.$user_id.'/edit')->with('error', 'Not updated!');
                }
    } 


    public function save_company_info(Request $request){
                $Manageusers = new Manageusers();
                $user_id = $request->user_id;

                $this->validate($request, [
                        'user_id'=>'required',
                ]);


                
                $register_other = array(
                                "joining_date" => date('Y-m-d',strtotime($request->joining_date)),
                                "company_name" => $request->company_name,
                                "esi_code" => $request->esi_code,
                                "sub_code" => $request->sub_code,
                                "company_type" => $request->company_type,
                                "business_nature" => $request->business_nature,
                                "no_of_employee" => $request->no_of_employee,
                                "cstreet_address" => $request->cstreet_address,
                                "c_state" => $request->c_state,
                                "c_city" => $request->c_city,
                                "c_pincode" => $request->c_pincode,
                                "updated_at" => date('Y-m-d H:i:s'),
                            );

                $insert_register = $Manageusers->update_register($register_other,$user_id);
                
                if($insert_register){
                    return redirect('admin/company_info/'.$user_id.'/edit')->with('success', 'Updated successfully!');
                }else{
                    return redirect('admin/company_info/'.$user_id.'/edit')->with('success', 'Updated successfully!');
                }
    }


    public function bulk_action(Request $request)
    {  

       
       $bulk_action = $request->get('bulk_action');
       $method = $request->get('method');
       $bulk_action_id = $request->get('bulk_action_id');
       $bulk_action_id = explode(',',$bulk_action_id);

       if($bulk_action=='active' || $bulk_action=='deactive'){
          
          if($bulk_action=='active'){
            $status = 1;
          }elseif($bulk_action=='deactive'){
            $status = 0;
          }

          $update_data = array(
             'status' => $status,
          );

          
          $update = Manageusers::update_status($bulk_action_id,$update_data);

          if($update){
            return redirect('/admin/'.$method)->with('success', 'Users updated!');
          }else{
            return redirect('/admin/'.$method)->with('success', 'Users Not updated!');
          }
       }else if($bulk_action=='delete'){
            foreach ($bulk_action_id as $key => $value) {
                $users = Manageusers::find($value);
                
                if($users->image!=''){
                    $imagepath = public_path('images/users/'.$users->image);
                    if(file_exists($imagepath)){
                       unlink($imagepath);
                    }
                }

                $this->destroy_registration($value);
                $users->delete();
            }
            return redirect('/admin/'.$method)->with('success', 'Users updated!');
       }
       
    }


    public function change_usertype(Request $request){  

           $user_type = $request->get('user_type');
           $method = $request->get('method');
           $user_id = $request->get('user_id');
           
           $admin = 0;
           if($request->get('user_type')==0){
             $admin = 1;
           }

           $update_data = array(
             'user_type' => $user_type,
             'admin' => $admin,
             "updated_at" => date('Y-m-d H:i:s')
           );

          
           $update = Manageusers::update_user($update_data,$user_id);

           if($update){
             return redirect('/admin/'.$method)->with('success', 'Users updated!');
           }else{
             return redirect('/admin/'.$method)->with('success', 'Users Not updated!');
           }
       
    }


    public function change_status(Request $request){  
           
           $change_status = $request->get('change_status');
           $method = $request->get('method');
           $user_id = $request->get('user_id');
        
           

           $update_data = array(
             'status' => $request->get('change_status'),
             "updated_at" => date('Y-m-d H:i:s')
           );

          
           $update = Manageusers::update_user($update_data,$user_id);

           if($update){
             return redirect('/admin/'.$method)->with('success', 'Users updated!');
           }else{
             return redirect('/admin/'.$method)->with('success', 'Users Not updated!');
           }
       
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $manageusers = Manageusers::find($id);
        
        
        $manageusers->delete();        
        return redirect('admin/manageusers')->with('success', 'Users deleted!');
    }

    public function destroy_registration($id){
        $manageusers = Manageusers::find_registration($id);
       
        if($manageusers->pancard_image!=''){
              $pancard_imagepath = public_path('images/users/'.$manageusers->pancard_image);
                    if(file_exists($pancard_imagepath)){
                       unlink($pancard_imagepath);
                }
         }

        if($manageusers->aadharcard_image!=''){
              $aadharcard_imagepath = public_path('images/users/'.$manageusers->aadharcard_image);
                    if(file_exists($aadharcard_imagepath)){
                       unlink($aadharcard_imagepath);
                }
         }

         if($manageusers->esic_card_image!=''){
              $esic_card_imagepath = public_path('images/users/'.$manageusers->esic_card_image);
                    if(file_exists($esic_card_imagepath)){
                       unlink($esic_card_imagepath);
                }
         }

         $delete_registration = Manageusers::delete_registration($id);

         return $delete_registration;

    }
}