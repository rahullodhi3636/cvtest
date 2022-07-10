<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Model\admin\Modules;
use App\Model\admin\Packages;
use App\Model\admin\Permissions;
use App\Model\admin\Role;
use App\Model\admin\Services;
use App\Model\admin\Staff;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $staff_list = DB::table('users')->select('users.*', 'roles.role_name')->leftJoin('roles', 'roles.role_id', '=', 'users.department')->get();
        return view('admin.staff.index', compact('staff_list'));
        // $staff = Staff::all();
        // $staff = DB::table('users')->select('users.*','branches.name as branch_name','branches.id as branchid')->leftJoin('branches', 'branches.id', '=', 'users.branch_id')->get();
        // return view('admin.staff.staff_list', compact('staff'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = DB::table('branches')->where('status', '=', '1')->get();
        $roles = Role::all();
        return view('admin.staff.create', compact('branches', 'roles'));
        // $packages = Packages::all();
        // $categories = Enquiry_categories::where('is_active','1')->get();
        // $last_record = Customer::orderBy('id', 'desc')->first();
        // if($last_record!=''){
        //     $last_id = 1+$last_record->id;
        // }else{
        //     $last_id = 1;
        // }

        // return view('admin.staff.staff_create',compact('packages','categories','last_id','branches'));
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
        $this->validate($request,
            [
                'name' => 'required',
                'contact' => 'required',
                'branch' => 'required',
                'email' => 'required',
                'password' => 'required',
                'department' => 'required',

            ],
            [
                'name.required' => 'Enter user name',
                'contact.required' => 'Enter user contact',
                'branch.required' => 'Select branch',
                'email.required' => 'Enter email',
                'password.required' => 'Enter password',
                'department.required' => 'Select Department',
            ]
        );
        if ($request->file('image') != null) {
            // dd($request->file('image'));
            $input['image'] = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/staff'), $input['image']);
        } else {
            $input['image'] = "";
        }
        $register_by = 'app';
        $staff = new staff([
            'name' => $request->get('name'),
            'branch_id' => $request->get('branch'),
            'image' => $input['image'],
            'phone_no' => $request->get('contact'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'register_by' => $register_by,
            'status' => '1',
            'department' => $request->get('department'),
        ]);
        $staff->save();
        return redirect('admin/staff')->with('success', 'Staff saved!');
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
        // $customer = customer::find($id);
        // $staff = staff::find($id);
        /*$packages = Packages::all();*/
        $roles = Role::all();
        $branches = DB::table('branches')->where('status', '=', '1')->get();
        $staff = DB::table('users')->select('users.*', 'branches.name as branch_name', 'branches.id as branchid')->leftJoin('branches', 'branches.id', '=', 'users.branch_id')->where("users.id", $id)->first();
        return view('admin.staff.edit')->with(['staff' => $staff, 'branches' => $branches, 'roles' => $roles]);
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
        $this->validate($request,
            [
                'name' => 'required',
                'contact' => 'required',
                'branch' => 'required',
                'email' => 'required',
                'password' => 'required',
                'department' => 'required',

            ],
            [
                'name.required' => 'Enter user name',
                'contact.required' => 'Enter user contact',
                'branch.required' => 'Select branch',
                'email.required' => 'Enter email',
                'password.required' => 'Enter password',
                'department.required' => 'Select Department',
            ]
        );

        $staff = staff::find($id);
        $staff->name = $request->get('name');
        $staff->branch_id = $request->get('branch');
        $staff->department = $request->get('department');
        if ($request->file('image') != null) {
            $input['image'] = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/staff'), $input['image']);
            $staff->image = $input['image'];
        }
        $staff->phone_no = $request->get('contact');
        $staff->email = $request->get('email');
        $staff->save();

        return redirect('admin/staff')->with('success', 'Customer updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = staff::find($id);
        $customer->delete();
        return redirect('/admin/staff')->with('success', 'Staff deleted!');
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

    public function getservices()
    {
        $id = request('package_id');
        $packages = Packages::find($id);
        $services = array();
        if (!empty($packages)) {
            if ($packages->package_services != '') {
                $servic = json_decode($packages->package_services);
                foreach ($servic as $key => $value) {
                    $ser = Services::where('id', $value->service)->first();
                    $content['service'] = (!empty($ser)) ? $ser->name : '';
                    $content['total'] = $value->total;
                    $services[] = $content;
                }
            }
        }
        echo json_encode($services);
    }

    public function roles($id)
    {
        $roles = Role::all();
        return view('admin.staff.role_list', compact('roles'));
    }

    public function role_permission($id)
    {
        $allowed_modules = DB::table('modules')
            ->leftJoin('roles_permission AS PS', 'PS.module_id', '=', 'modules.module_id')
            ->where('PS.role_id', $id)
            ->where('PS.status', '1')
            ->get();
        $modules = Modules::all();
        return view('admin.staff.permission_list', compact('modules', 'allowed_modules'));
    }

    public function role_updated(Request $request)
    {
        // print_r($request->all());
        // die;
        try {
            $module_permision = $request->module_permision;
            $role_id = $request->role_id;
            $module_ids = $request->module_id;
            foreach ($module_ids as $module_key => $module_value) {
                // echo "<br>" . $module_value;
                // $old_permssn = Permissions::where([['module_id', '=', $module_value], ['role_id', '=', $role_id]])->first();
                if (in_array($module_value, $module_permision)) {
                    // echo "<br>allow module" . $module_value;
                    // echo $modules;
                    $permssn = Permissions::where([['module_id', '=', $module_value], ['role_id', '=', $role_id]])->first();
                    if (empty($permssn)) {
                        $permssn = new Permissions();
                        $permssn->role_id = $role_id;
                        $permssn->module_id = $module_value;
                        $permssn->can_view = 1;
                        $permssn->can_add = 1;
                        $permssn->can_edit = 1;
                        $permssn->can_delete = 1;
                        $permssn->status = 1;
                        $permssn->save();
                    } else {
                        $permssn->status = 1;
                        $permssn->save();
                    }
                } else {
                    $old_permssn = Permissions::where([['module_id', '=', $module_value], ['role_id', '=', $role_id]])->first();
                    if (!empty($old_permssn)) {
                        $old_permssn->status = 0;
                        $old_permssn->save();
                    }
                }
            }
            return redirect('staff_role_permission/' . $role_id)->with('success', 'Role Permissins updated!');
        } catch (\Throwable $th) {
            return redirect('staff_role_permission/' . $role_id)->with('msg', 'Role Permissins not updated!');
        }
    }

}
