<?php

namespace App\Http\Controllers\admin;

use App\Model\admin\ServiceGroup;
use App\Model\admin\ServiceBrand;
use App\Model\admin\Services;
use App\Model\admin\Brand;
use App\Model\admin\Firm;
use App\User;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $staff = DB::table('users')->where('admin','!=',1)->get();
        $firms = Firm::all();
        //$groups = DB::table('service_group')->where('parent_id',0)->get()->toArray();
        $groups = DB::table('service_group')->select('service_group.*','firms.firm_name')->leftJoin('firms','service_group.firm_id','=','firms.id')->where('service_group.parent_id',0)->get()->toArray();
        foreach ($groups as $key => $value) {
            $subcat = DB::table('service_group')->where('parent_id',$value->id)->get()->toArray();
            $groups[$key]->sub_count = count($subcat);
        }
        // echo "<pre>"; print_r($groups); die();
        // $services = Services::all();
        return view('admin.services.services_list', compact('groups','firms','staff'));
    }
    public function index_new()
    {
        $staff = DB::table('users')->where('admin','!=',1)->get();
        $firms = Firm::all();
        //$groups = DB::table('service_group')->where('parent_id',0)->get()->toArray();
        $groups = DB::table('service_group')->select('service_group.*','firms.firm_name')
                 ->leftJoin('firms','service_group.firm_id','=','firms.id')
                 ->where('service_group.parent_id',0)
                 ->get()
                 ->toArray();
        foreach ($groups as $key => $value) {
            $subcat = DB::table('service_group')->where('parent_id',$value->id)->get()->toArray();
            $groups[$key]->sub_count = count($subcat);
        }
        //echo "<pre>"; print_r($groups); die();
        // $services = Services::all();
        return view('admin.services.services_list_new', compact('groups','firms','staff'));
    }


    public function subService($id,$firm_id)
    {
        $subcat = DB::table('service_group')->where('parent_id',$id)->get();
        $parent_id=$id;


        return view('admin.services.subService', compact('subcat','parent_id','firm_id'));
    }
    public function addBrand($serviceid,$subid)
    {
        $service= DB::table('service_group')->where('id',$serviceid)->first()->group_name;
        $category= DB::table('service_group')->where('id',$subid)->first()->group_name;
        $subcat = DB::table('product_brands')->where('sub_category_id',$subid)->get();
        return view('admin.services.addBrand', compact('subcat','serviceid','subid','service','category'));
    }
    public function addBrandRand($serviceid,$subid,$brandid)
    {
        $service= DB::table('service_group')->where('id',$serviceid)->first()->group_name;
        $category= DB::table('service_group')->where('id',$subid)->first()->group_name;
        $brands= DB::table('product_brands')->where('id',$brandid)->first()->brand_name;
        $subcat = DB::table('service_brands')->where('brand_id',$brandid)->get();
        return view('admin.services.range', compact('subcat','serviceid','subid','brandid','service','category','brands'));
    }



    public function addBrandform(Request $request)
    {
        $brandid=$request->brandid;


        if($brandid){
            $brandupdate = Brand::find($brandid);

            $brandupdate->brand_name=$request->brand_name;
            $brandupdate->brand_description=$request->brand_description;
            $brandupdate->save();
            $id = $brandid;
        if (!empty($id)) {
            echo "Done";
        }else{
            echo "Failed";
        }
        }else{
            $brand = new Brand;
        $brand->service_id=$request->serviceid;
        $brand->sub_category_id=$request->subServiceid;
        $brand->brand_name=$request->brand_name;
        $brand->brand_description=$request->brand_description;

        $brand->save();
        $id = $brand->id;
        if (!empty($id)) {
            echo "Done";
        }else{
            echo "Failed";
        }
        }

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin.services.services_create');
    }

    public function addServiceGroup(Request $request)
    {
        $data['html'] = '';
        $this->validate($request, [
            'firm'=>'required',
            'name'=>'required|unique:service_group,group_name',
        ]);

        $servicegroup = new ServiceGroup();
        $servicegroup->firm_id = $request->get('firm');
        $servicegroup->group_name = $request->get('name');
        $servicegroup->parent_id = 0;
        $servicegroup->status = 1;
        $servicegroup->save();
        $id = $servicegroup->id;
        if (!empty($id)) {
            $groups = ServiceGroup::all();
            if (!empty($groups)) {
                foreach ($groups as $group) {
                    $data['html'] .= '<div class="card">
                                        <div class="card-header" id="heading'.$group->id.'">
                                            <h2 class="mb-0">
                                                <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapse'.$group->id.'"><i class="fa fa-plus"></i> '.$group->group_name.'</button>
                                                <button type="button" onclick="getGroup('.$group->id.')" class="btn btn-primary text-right">edit</button>
                                            </h2>
                                        </div>
                                        <div id="collapse'.$group->id.'" class="collapse" aria-labelledby="heading'.$group->id.'" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <p>HTML stands for HyperText Markup Language. HTML is the standard markup language for describing the structure of web pages. <a href="https://www.tutorialrepublic.com/html-tutorial/" target="_blank">Learn more.</a></p>
                                            </div>
                                        </div>
                                    </div>';
                }
            }else{
                $data['html'] = '';
            }
        }else{
            $data['html'] = '';
        }
        echo json_encode($data);
    }

    public function addServiceSubCategory(Request $request)
    {
        $servicegroup = new ServiceGroup;
        $servicegroup->parent_id = $request->subcatGroupid;
        $servicegroup->firm_id = $request->subcatFirmid;
        $servicegroup->group_name = $request->subcat_name;
        $servicegroup->status =1;
        $servicegroup->save();
        $id = $servicegroup->id;
        if (!empty($id)) {
            echo "Done";
        }else{
            echo "Failed";
        }
    }

    public function getGroup(Request $request)
    {
        $id = $request->groupid;
        $servicegroup = DB::table('service_group')->where('id',$id)->first();
        echo json_encode($servicegroup);

    }
    public function getGroupBrand(Request $request)
    {
        $id = $request->groupid;
        $brandgroup = DB::table('product_brands')->where('id',$id)->first();
        echo json_encode($brandgroup);

    }
    public function getGroupRang(Request $request)
    {
        $id = $request->groupid;
        $service_brands = DB::table('service_brands')->where('service_brand_id',$id)->first();
        echo json_encode($service_brands);

    }

    public function updateServiceSubCat(Request $request)
    {
        $this->validate($request, [
            'editsubcat_name'=>'required',
        ]);

        $servicegroup = ServiceGroup::find($request->editsubcatgroupid);
        $servicegroup->group_name =  $request->editsubcat_name;
        $servicegroup->save();
        echo "Done";
    }

    public function updateGroup(Request $request)
    {

        $data['html'] = '';
        $this->validate($request, [
            // 'editfirm'=>'required',
            //'editname'=>'required',
            'editname'=>'required|unique:service_group,group_name,'.$request->editgroupid,
        ]);


        $servicegroup = ServiceGroup::find($request->editgroupid);
        $servicegroup->firm_id =  $request->editfirm;
        $servicegroup->group_name =  $request->editname;
        $servicegroup->save();
        $groups = ServiceGroup::all();
        if (!empty($groups)) {
            foreach ($groups as $group) {
                $data['html'] .= '<div class="card">
                                    <div class="card-header" id="heading'.$group->id.'">
                                        <h2 class="mb-0">
                                            <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapse'.$group->id.'"><i class="fa fa-plus"></i> '.$group->group_name.'</button>
                                            <button type="button" onclick="getGroup('.$group->id.')" class="btn btn-primary text-right">edit</button>
                                        </h2>
                                    </div>
                                    <div id="collapse'.$group->id.'" class="collapse" aria-labelledby="heading'.$group->id.'" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <p>HTML stands for HyperText Markup Language. HTML is the standard markup language for describing the structure of web pages. <a href="https://www.tutorialrepublic.com/html-tutorial/" target="_blank">Learn more.</a></p>
                                        </div>
                                    </div>
                                </div>';
            }
        }else{
            $data['html'] = '';
        }
        echo json_encode($data);
    }

    public function SaveRange_By_brand(Request $request)
    {

            if (!empty($request->brandname)) {
                $serviceidss = $request->serviceidss;
                $cateid = $request->cateid;
                $brandid = $request->brandid;
                $brandname = $request->brandname;
                $serviceprice = $request->serviceprice;
                $specialserviceprice = $request->specialserviceprice;
                $service_duration = $request->brandDuration;
                $service_description = $request->service_description;
                for ($i=0; $i < count($brandname); $i++) {
                    if ($brandname[$i]!='') {
                        # code...

                    $brand = new ServiceBrand([
                        'service_id' => $serviceidss,
                        'sub_cate_id' => $cateid,
                        'brand_id' => $brandid,
                        'brand_name' => $brandname[$i],
                        'service_price' => $serviceprice[$i],
                        'special_price' => $specialserviceprice[$i],
                        'service_duration' => $service_duration[$i],
                        'service_description' => $service_description[$i],
                        'service_brand_status' => 1,
                    ]);
                    $brand->save();
                    }
                }
            }
            echo "Done";

    }
    public function editRange_By_brand(Request $request)
    {

            // if (!empty($request->brandname)) {
                // DB::enableQueryLog();
                $brandname = $request->brandnam;
                $serviceprice = $request->serviceprice;
                $specialserviceprice = $request->specialserviceprice;
                $service_duration = $request->brandDuration;
                $service_description = $request->service_description;

               $id=  $request->rangid;

                    $brand = ([

                        'brand_name' => $brandname,
                        'service_price' => $serviceprice,
                        'special_price' => $specialserviceprice,
                        'service_duration' => $service_duration,
                        'service_description' => $service_description,
                        'service_brand_status' => 1
                    ]);
                    $brand=ServiceBrand::where('service_brand_id',$id)->update($brand);

                    // dd(DB::getQueryLog());
            // }

            echo "Done";

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // print_r($_POST); die();

        // echo public_path(); die();
        $this->validate($request, [
            'service_name'=>'required|unique:services,name',
            'service_duration'=>'required',
            // 'service_description'=>'required',
            // 'service_price'=>'required',
            // 'status'=>'required',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if($request->file('image')!=null){
            $input['image'] = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $input['image']);
        }else{
            $input['image'] = '';
        }
        if (!empty($request->get('tag_staff'))) {
            $staff = json_encode($request->get('tag_staff'));
        }else{
            $staff = '';
        }
        $services = new services([
            /*'admin_id' => Auth::user()->id,*/
            'name' => $request->get('service_name'),
            'group_id' => $request->get('service_groupid'),
            /*'service_price' => $request->get('service_price'),
            'special_price' => $request->get('service_special_price'),*/
            'staff' => $staff,
            /*'description' => $request->get('service_description'),*/
            'duration' => $request->get('service_duration'),
            'status' => 1,
            'service_icon' => $input['image'],
        ]);
        $services->save();
        $id = $services->id;
        if (!empty($id)) {
            if (!empty($request->brandname)) {
                $brandname = $request->brandname;
                $serviceprice = $request->serviceprice;
                $specialserviceprice = $request->specialserviceprice;
                $service_duration = $request->brandDuration;
                $service_description = $request->service_description;
                for ($i=0; $i < count($brandname); $i++) {
                    if ($brandname[$i]!='') {
                        # code...

                    $brand = new ServiceBrand([
                        'service_id' => $id,
                        'brand_name' => $brandname[$i],
                        'service_price' => $serviceprice[$i],
                        'special_price' => $specialserviceprice[$i],
                        'service_duration' => $service_duration[$i],
                        'service_description' => $service_description[$i],
                        'service_brand_status' => 1,
                    ]);
                    $brand->save();
                    }
                }
            }
            echo "Done";
        }else{
            echo "Failed";
        }
        // return redirect('admin/services')->with('success', 'Service saved!');
    }

    public function editService(Request $request)
    {
        $serviceid = $request->serviceid;
        $services = services::find($serviceid);
        /*$services = DB::table('services AS S')->select('SB.*','S.name')->leftJoin('service_brands AS SB','SB.service_id','=','S.id')->get();*/
        $staff = DB::table('users')->where('admin','!=',1)->get();
        echo view('admin.services.services_edit',compact('services','staff'));
    }

    public function showServiceBrandsPrice(Request $request)
    {
       $brand_id= $request->brand_id;
       $services = ServiceBrand::getservicebrand($brand_id);
    //    print_r($services); die;
       echo json_encode($services);
    }

    public function showServiceBrandsPriceForMakeup(Request $request)
    {
         $brand_id= $request->brand_id;
       $services = ServiceBrand::find($brand_id);
    //    print_r($services); die;
       echo json_encode($services);
    }

    public function showServiceBrands(Request $request)
    {
        // print_r($_POST);onchange="showServiceBrandsPrice(this.value)"
        $data['html'] = "";
        if (!empty($request->service_id)) {
            $getService = DB::table("service_brands AS S")->where("S.brand_id",$request->service_id)->get();
            if (!empty($getService)) {
                $data['html'] .= '<div class="form-group">
                                        <label>Select Main Service</label>
                                        <select  multiple="multiple" class="form-control" name="groupServiess_'.$request->totalcount.'[]" id="groupServiess_'.$request->totalcount.'">
                                            <option value="">Select</option>';
                foreach ($getService as $service) {
                    $data['html'] .= '<option value="'.$service->service_brand_id.'">'.$service->brand_name.'  - ₹'.$service->service_price.'</option>';
                }
                $data['html'] .= '</select>
                                </div>';
            }
        }
        echo json_encode($data);
    }

    public function showServiceBrandsForMakeup(Request $request)
    {
        // print_r($_POST);onchange="showServiceBrandsPrice(this.value)"
        $data['html'] = "";
        if (!empty($request->service_id)) {
            $getService = DB::table("service_brands AS S")->where("S.brand_id",$request->service_id)->get();
            if (!empty($getService)) {
                $data['html'] .= '<div class="form-group">
                                        <label>Select Main Service</label>
                                        <select  multiple="multiple" class="form-control" name="makeupgroupServiess_'.$request->totalcount.'[]" id="makeupgroupServiess_'.$request->totalcount.'">
                                            <option value="">Select</option>';
                foreach ($getService as $service) {
                    $data['html'] .= '<option value="'.$service->service_brand_id.'">'.$service->brand_name.'  - ₹'.$service->service_price.'</option>';
                }
                $data['html'] .= '</select>
                                </div>';
            }
        }
        echo json_encode($data);
    }

    public function showGroupService(Request $request)
    {
        // print_r($_POST);parentId
        $data['html'] = "";
        if (!empty($request->groupid)) {
            // $getService = DB::table("services AS S")->where("S.group_id",$request->groupid)->get();
            $getService = DB::table("product_brands AS S")->where("S.service_id",$request->parentId)->where("S.sub_category_id",$request->groupid)->get();
            if (!empty($getService)) {
                $data['html'] .= '<div class="form-group">
                                        <label>Select Brand</label>
                                        <select onchange="showServiceBrands(this.value)" class="form-control" name="groupServie_'.$request->totalcount.'" id="groupServie_'.$request->totalcount.'">
                                            <option value="">Select</option>';
                foreach ($getService as $service) {
                    $data['html'] .= '<option value="'.$service->id.'">'.$service->brand_name.'</option>';
                }
                $data['html'] .= '<option value="0">Other</option>';
                $data['html'] .= '</select>
                                </div>';
            }
        }
        echo json_encode($data);
    }

    public function shownewpackGroupService(Request $request)
    {
        // print_r($_POST);parentId
        $data['html'] = "";
        if (!empty($request->groupid)) {
            // $getService = DB::table("services AS S")->where("S.group_id",$request->groupid)->get();
            $getService = DB::table("product_brands AS S")->where("S.service_id",$request->parentId)->where("S.sub_category_id",$request->groupid)->get();
            if (!empty($getService)) {
                $data['html'] .= '<div class="form-group">
                                        <label>Select Brand</label>
                                        <select onchange="shownewpackServiceBrands(this.value,'.$request->totalcount.')" class="form-control" name="groupServie_'.$request->totalcount.'" id="groupServie_'.$request->totalcount.'">
                                            <option value="">Select</option>';
                foreach ($getService as $service) {
                    $data['html'] .= '<option value="'.$service->id.'">'.$service->brand_name.'</option>';
                }
                $data['html'] .= '<option value="0">Other</option>';
                $data['html'] .= '</select>
                                </div>';
            }
        }
        echo json_encode($data);
    }

    public function shownewmakeupGroupService(Request $request)
    {
        // print_r($_POST);parentId
        $data['html'] = "";
        if (!empty($request->groupid)) {
            // $getService = DB::table("services AS S")->where("S.group_id",$request->groupid)->get();
            $getService = DB::table("product_brands AS S")->where("S.service_id",$request->parentId)->where("S.sub_category_id",$request->groupid)->get();
            if (!empty($getService)) {
                $data['html'] .= '<div class="form-group">
                                        <label>Select Brand</label>
                                        <select onchange="shownewmakeupServiceBrands(this.value,'.$request->totalcount.')" class="form-control" name="groupServie_'.$request->totalcount.'" id="groupServie_'.$request->totalcount.'">
                                            <option value="">Select</option>';
                foreach ($getService as $service) {
                    $data['html'] .= '<option value="'.$service->id.'">'.$service->brand_name.'</option>';
                }
                $data['html'] .= '<option value="0">Other</option>';
                $data['html'] .= '</select>
                                </div>';
            }
        }
        echo json_encode($data);
    }

    public function showGroupServiceForMakeup(Request $request)
    {
        // print_r($_POST);parentId
        $data['html'] = "";
        if (!empty($request->groupid)) {
            // $getService = DB::table("services AS S")->where("S.group_id",$request->groupid)->get();
            $getService = DB::table("product_brands AS S")->where("S.service_id",$request->parentId)->where("S.sub_category_id",$request->groupid)->get();
            if (!empty($getService)) {
                $data['html'] .= '<div class="form-group">
                                        <label>Select Brand</label>
                                        <select onchange="showServiceBrandsForMakeup(this.value)" class="form-control" name="makeupgroupServie_'.$request->totalcount.'" id="makeupgroupServie_'.$request->totalcount.'">
                                            <option value="">Select</option>';
                foreach ($getService as $service) {
                    $data['html'] .= '<option value="'.$service->id.'">'.$service->brand_name.'</option>';
                }
                $data['html'] .= '</select>
                                </div>';
            }
        }
        echo json_encode($data);
    }

    public function showFirmService(Request $request)
    {
        // print_r($_POST);
        $data['html'] = "";
        if (!empty($request->groupid)) {
            /*$getService = DB::table("service_group AS SG")->select('S.*')->leftJoin("services AS S","S.group_id","=","SG.id")->where("SG.firm_id",$request->firmid)->where("S.group_id",$request->groupid)->get();*/
            //$getService = DB::table("service_group AS SG")->where("SG.firm_id",$request->firmid)->where("SG.parent_id",$request->groupid)->get();
            $getService = DB::table("service_group AS SG")->where("SG.parent_id",$request->groupid)->get();
            if (!empty($getService)) {
                $data['html'] .= '<div class="form-group">
                                        <label>Select Category</label>
                                        <select onchange="showGroupService(this.value,'.$request->groupid.')" class="form-control" name="firmServie_'.$request->totalcount.'" id="firmServie_'.$request->totalcount.'">
                                            <option value="">Select</option>';
                foreach ($getService as $service) {
                    $data['html'] .= '<option value="'.$service->id.'">'.$service->group_name.'</option>';
                }
                $data['html'] .= '</select>
                                </div>';
            }
        }
        echo json_encode($data);
    }


    public function getservicesbyfirm(Request $request)
    {
        // print_r($_POST);
        $data['html'] = "";
        if (!empty($request->firm_id)) {
            /*$getService = DB::table("service_group AS SG")->select('S.*')->leftJoin("services AS S","S.group_id","=","SG.id")->where("SG.firm_id",$request->firmid)->where("S.group_id",$request->groupid)->get();*/
            //$getService = DB::table("service_group AS SG")->where("SG.firm_id",$request->firmid)->where("SG.parent_id",$request->groupid)->get();
            $getService = DB::table("service_group AS SG")->where("SG.firm_id",$request->firm_id)->where('parent_id',0)->get();
            if (!empty($getService)) {
                $data['html'] .= '<select onchange="get_category(this.value);" class="form-control" name="service_id" id="service_id">
                                            <option value="">Select</option>';
                foreach ($getService as $service) {
                    $data['html'] .= '<option value="'.$service->id.'">'.$service->group_name.'</option>';
                }
                $data['html'] .= '</select>';
            }
        }
        echo json_encode($data);
    }

    public function getallservices(Request $request)
    {
        // print_r($_POST);
        $data['html'] = "";

            /*$getService = DB::table("service_group AS SG")->select('S.*')->leftJoin("services AS S","S.group_id","=","SG.id")->where("SG.firm_id",$request->firmid)->where("S.group_id",$request->groupid)->get();*/
            //$getService = DB::table("service_group AS SG")->where("SG.firm_id",$request->firmid)->where("SG.parent_id",$request->groupid)->get();
            $getService = DB::table("service_group AS SG")->where('parent_id',0)->get();
            if (!empty($getService)) {
                $data['html'] .= '<select onchange="get_category(this.value);" class="form-control" name="service_id" id="service_id">
                                            <option value="">Select</option>';
                foreach ($getService as $service) {
                    $data['html'] .= '<option value="'.$service->id.'">'.$service->group_name.'</option>';
                }
                $data['html'] .= '</select>';
            }

        echo json_encode($data);
    }

    public function get_category(Request $request)
    {
        // print_r($_POST);
        $data['html'] = "";
        if (!empty($request->service_id)) {
            $getService = DB::table("service_group AS SG")->where("SG.parent_id",$request->service_id)->get();
            if (!empty($getService)) {
                $data['html'] .= '<div class="form-group">
                                        <label>Select Category</label>
                                        <select class="form-control" name="category_id"  id="category_id" onchange="get_brands(this.value);">
                                            <option value="">Select</option>';
                foreach ($getService as $service) {
                    $data['html'] .= '<option value="'.$service->id.'">'.$service->group_name.'</option>';
                }
                $data['html'] .= '</select>
                                </div>';
            }
        }
        echo json_encode($data);
    }


    public function get_brands(Request $request)
    {
        // print_r($_POST);parentId
        $data['html'] = "";
        if (!empty($request->category_id)) {
            // $getService = DB::table("services AS S")->where("S.group_id",$request->groupid)->get();
            $getService = DB::table("product_brands AS S")->where("S.sub_category_id",$request->category_id)->get();
            if (!empty($getService)) {
                $data['html'] .= '<div class="form-group">
                                        <label>Select Brand</label>
                                        <select class="form-control" name="brand_id" id="brand_id" onchange="get_mainservices(this.value);">
                                            <option value="">Select</option>';
                foreach ($getService as $service) {
                    $data['html'] .= '<option value="'.$service->id.'">'.$service->brand_name.'</option>';
                }
                $data['html'] .= '<option value="0">Other</option>';
                $data['html'] .= '</select>
                                </div>';
            }
        }
        echo json_encode($data);
    }


    public function get_mainservices(Request $request)
    {
        // print_r($_POST);onchange="showServiceBrandsPrice(this.value)"
        $data['html'] = "";
        if (!empty($request->brand_id)) {
            $getService = DB::table("service_brands AS S")->where("S.brand_id",$request->brand_id)->get();
            if (!empty($getService)) {
                $data['html'] .= '<div class="form-group">
                                        <label>Select Main Service</label>
                                        <select class="form-control" name="main_service_id" id="main_service_id">
                                            <option value="">Select</option>';
                foreach ($getService as $service) {
                    $data['html'] .= '<option value="'.$service->service_brand_id.'">'.$service->brand_name.'  - ₹'.$service->service_price.'</option>';
                }
                $data['html'] .= '</select>
                                </div>';
            }
        }
        echo json_encode($data);
    }



    public function shownewpackFirmService(Request $request)
    {
        // print_r($_POST);
        $data['html'] = "";
        if (!empty($request->groupid)) {
            /*$getService = DB::table("service_group AS SG")->select('S.*')->leftJoin("services AS S","S.group_id","=","SG.id")->where("SG.firm_id",$request->firmid)->where("S.group_id",$request->groupid)->get();*/
            //$getService = DB::table("service_group AS SG")->where("SG.firm_id",$request->firmid)->where("SG.parent_id",$request->groupid)->get();
            $getService = DB::table("service_group AS SG")->where("SG.parent_id",$request->groupid)->get();
            if (!empty($getService)) {
                $data['html'] .= '<div class="form-group">
                                        <label>Select Category</label>
                                        <select onchange="shownewpackGroupService(this.value,'.$request->groupid.', '.$request->totalcount .')" class="form-control" name="firmServie_'.$request->totalcount.'" id="firmServie_'.$request->totalcount.'">
                                            <option value="">Select</option>';
                foreach ($getService as $service) {
                    $data['html'] .= '<option value="'.$service->id.'">'.$service->group_name.'</option>';
                }
                $data['html'] .= '</select>
                                </div>';
            }
        }
        echo json_encode($data);
    }

    public function shownewmakeupFirmService(Request $request)
    {
        // print_r($_POST);
        $data['html'] = "";
        if (!empty($request->groupid)) {
            /*$getService = DB::table("service_group AS SG")->select('S.*')->leftJoin("services AS S","S.group_id","=","SG.id")->where("SG.firm_id",$request->firmid)->where("S.group_id",$request->groupid)->get();*/
            //$getService = DB::table("service_group AS SG")->where("SG.firm_id",$request->firmid)->where("SG.parent_id",$request->groupid)->get();
            $getService = DB::table("service_group AS SG")->where("SG.parent_id",$request->groupid)->get();
            if (!empty($getService)) {
                $data['html'] .= '<div class="form-group">
                                        <label>Select Category</label>
                                        <select onchange="shownewmakeupGroupService(this.value,'.$request->groupid.', '.$request->totalcount .')" class="form-control" name="firmServie_'.$request->totalcount.'" id="firmServie_'.$request->totalcount.'">
                                            <option value="">Select</option>';
                foreach ($getService as $service) {
                    $data['html'] .= '<option value="'.$service->id.'">'.$service->group_name.'</option>';
                }
                $data['html'] .= '</select>
                                </div>';
            }
        }
        echo json_encode($data);
    }

    public function showFirmServiceForMakeup(Request $request)
    {
        // print_r($_POST);
        $data['html'] = "";
        if (!empty($request->groupid)) {
            $getService = DB::table("service_group AS SG")->where("SG.parent_id",$request->groupid)->get();
            if (!empty($getService)) {
                $data['html'] .= '<div class="form-group">
                                        <label>Select Category</label>
                                        <select onchange="showGroupServiceFormakeup(this.value,'.$request->groupid.')" class="form-control" name="makeupfirmServie_'.$request->totalcount.'" id="makeupfirmServie_'.$request->totalcount.'">
                                            <option value="">Select</option>';
                foreach ($getService as $service) {
                    $data['html'] .= '<option value="'.$service->id.'">'.$service->group_name.'</option>';
                }
                $data['html'] .= '</select>
                                </div>';
            }
        }
        echo json_encode($data);
    }

    public function editServiceSubCat(Request $request)
    {
    $id = $request->groupid;
        $servicegroup = DB::table('service_group')->where('id',$id)->first();
        echo json_encode($servicegroup);
    }

    public function updateService(Request $request)
    {
        // echo "<pre>"; print_r($_POST); die();
        $this->validate($request, [
                'editservice_name'=>'required',
                'editservice_duration'=>'required',
                // 'editservice_price'=>'required',
                // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if (!empty($request->get('edittag_staff'))) {
            $staff = json_encode($request->get('edittag_staff'));
        }else{
            $staff = '';
        }
        $services = services::find($request->get('editservice_id'));
        $services->name =  $request->get('editservice_name');
        // $services->description =  $request->get('editservice_description');
        $services->duration =  $request->get('editservice_duration');
        /*$services->service_price = $request->get('editservice_price');
        $services->special_price = $request->get('editservice_special_price');*/
        $services->staff = $staff;
        $services->save();
        $brandid = $request->brandid;
        if (isset($brandid)) {
            $i=0;
            $brandname = $request->editbrandname;
            $serviceprice = $request->editserviceprice;
            $specialserviceprice = $request->editspecialserviceprice;
            $service_duration = $request->editbrandDuration;
            $service_description = $request->editservice_description;
            foreach ($brandid as $brand_id) {
                if ($brand_id == 0) {
                    /*for ($i=0; $i < count($brandname); $i++) { */
                    $brand = new ServiceBrand([
                        'service_id' => $request->get('editservice_id'),
                        'brand_name' => $brandname[$i],
                        'service_price' => $serviceprice[$i],
                        'special_price' => $specialserviceprice[$i],
                        'service_duration' => $service_duration[$i],
                        'service_description' => $service_description[$i],
                        'service_brand_status' => 1,
                    ]);
                    $brand->save();
                    /*}*/
                }else{
                    $brand = ServiceBrand::find($brand_id);
                    $brand->brand_name =  $brandname[$i];
                    $brand->service_price =  $serviceprice[$i];
                    $brand->special_price =  $specialserviceprice[$i];
                    $brand->service_duration = $service_duration[$i];
                    $brand->service_description = $service_description[$i];
                    $brand->save();
                }
                $i++;
            }
        }
        return redirect('admin/services')->with('success', 'Service updated!');
    }

    public function deleteBrand(Request $request)
    {
        $brand = Brand::find($request->service_brand_id);
        $brand->delete();
        echo "Done";
    }
    public function deletebrandRange(Request $request)
    {

        DB::table('service_brands')->where('service_brand_id',$request->service_brand_id)->delete();

        echo "Done";
    }

     public function deleteService(Request $request)
    {
        DB::table('service_group')->where('id',$request->service_id)->delete();

        DB::table('service_brands')->where('service_id',$request->service_id)->delete();
        echo "Done";
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
        $services = services::find($id);
        return view('admin.services.services_edit')->with(['services'=>$services]);
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
            'description'=>'required',
            'status'=>'required',
            'price'=>'required',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if($request->file('image')!=null){
            $input['image'] = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $input['image']);
            $services = services::find($id);
            $services->name =  $request->get('name');
            $services->description =  $request->get('description');
            $services->status = $request->get('status');
            $services->service_price = $request->get('price');
            $services->service_icon = $input['image'];
            $services->save();
        }else{
            $services = services::find($id);
            $services->name =  $request->get('name');
            $services->description =  $request->get('description');
            $services->status = $request->get('status');
            $services->service_price = $request->get('price');
            $services->save();
        }


        return redirect('admin/services')->with('success', 'Service updated!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $services = services::find($id);
        $services->delete();
        return redirect('/admin/services')->with('success', 'Service deleted!');
    }

    public function products($id)
    {

        $products = DB::table('service_products')->select('service_products.*','product_brands.id','product_brands.brand_name')->leftJoin('product_brands','product_brands.id','=','service_products.brand_id')->where('service_products.service_id', $id)->get();
        return view('admin.services.productlist', compact('products','id'));
    }

    public function createproduct($sid)
    {
        $brand = DB::table('product_brands')->where('service_id',$sid)->get();
        return view('admin.services.createproduct',compact('brand','sid'));
    }

    public function addproduct(Request $request)
    {
        $this->validate($request, [
            'name'=>'required',
            'price'=>'required',
            'brand'=>'required',
        ]);
        $data = array(
          'brand_id' => $request->get('brand'),
          'service_id' => $request->get('sid'),
          'product_name' => $request->get('name'),
          'price' => $request->get('price'),
          'product_description' => $request->get('description'),
          'create_date' => date('Y-m-d H:i:s'),
          'status' => 1,
        );
        $insertid = DB::table('service_products')->insertGetId($data);
        if (!empty($insertid)) {
            return redirect('/admin/product/'.$request->get('sid'))->with('success', 'Product saved!');
        }
    }

    public function editproduct($pid)
    {
        $product = DB::table('service_products')->where('product_id',$pid)->first();
        $brand = DB::table('product_brands')->get();
        return view('admin.services.editproduct',compact('brand','pid','product'));
    }

    public function updateproduct(Request $request)
    {
        $this->validate($request, [
            'name'=>'required',
            'price'=>'required',
            'brand'=>'required',
        ]);
        $data = array(
          'brand_id' => $request->get('brand'),
          'product_name' => $request->get('name'),
          'price' => $request->get('price'),
          'product_description' => $request->get('description'),
          'status' => $request->get('status'),
        );
        DB::table('service_products')->where('product_id', $request->get('pid'))->update($data);
        return redirect('/admin/product/'.$request->get('sid'))->with('success', 'Product updated!');
    }

    public function deleteproduct(Request $request)
    {
        DB::table('service_products')->where('product_id', '=', $request->get('pid'))->delete();
        return redirect('/admin/product/'.$request->get('sid'))->with('success', 'Product deleted!');
    }

    public function mainservices($id)
    {
        // echo $id; die();
        $staff = DB::table('users')->where('admin','!=',1)->get();
        $firms = Firm::all();
        $subcategoryid = $id;
        $services = DB::table('services')->where('group_id',$subcategoryid)->get();
        $groups = DB::table('service_group')->where('parent_id',0)->get()->toArray();

        foreach ($groups as $key => $value) {
            $subcat = DB::table('service_group')->where('parent_id',$value->id)->get()->toArray();
            $groups[$key]->sub_count = count($subcat);
        }
        // echo "<pre>"; print_r($services);
        return view('admin.services.main_services_list', compact('services','subcategoryid','staff','firms','groups'));
    }

    public function mainservicesmodal(Request $request)
    {
         $id = $request->id;
        $staff = DB::table('users')->where('admin','!=',1)->get();
        $firms = Firm::all();
        $subcategoryid = $id;
        $services = DB::table('services')->where('group_id',$subcategoryid)->get();
        $groups = DB::table('service_group')->where('parent_id',0)->get()->toArray();

        foreach ($groups as $key => $value) {
            $subcat = DB::table('service_group')->where('parent_id',$value->id)->get()->toArray();
            $groups[$key]->sub_count = count($subcat);
        }
        return view('admin.services.mainservicelistmodal', compact('services','subcategoryid','staff','firms','groups'));
    }
}
