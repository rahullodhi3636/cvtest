<?php

namespace App\Http\Controllers\admin;
use DB;
use App\Model\admin\Packages;
use App\Model\admin\Firm;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class PackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $services = DB::select('select * from services where status = :status', ['status' => 1]);
        $firms = Firm::all();
        // $packages = Packages::all();
        $packages = DB::table('packages AS P')->select('P.*','F.firm_name')->leftJoin('firms AS F','F.id','=','P.firm_id')->get();
        foreach ($packages as $value) {
            /*$branchid = $value->firm_id;
            $branchName = Packages::branchName($branchid);*/
            //dd($branchName);
            $services_obj = json_decode($value->package_services);
            /*dd($services_obj);*/
            $serviceArray = [];
            $totalArray = [];
            if (!empty($services_obj)) {
                foreach ($services_obj as $servicevalue) {
                    // print_r($servicevalue->service)
                    // dd($servicevalue->service);
                    $serviceid = $servicevalue->service;
                    if (!empty($serviceid)) {
                        // dd(Packages::serviceName($serviceid));
                        $serviceArray[]=Packages::serviceName($serviceid);
                        $totalArray[] = $servicevalue->total;
                    }
                }
            }
            $value->serviceName = implode(',', $serviceArray);

            $value->totalTime = implode(',', $totalArray);
            /*$value->branchName = $branchName;*/
        }
        
        return view('admin.packages.packages_list', compact('packages','firms','services'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $services = DB::select('select * from services where status = :status', ['status' => 1]);
        $branches = DB::select('select * from branches where status = :status', ['status' => 1]);
        return view('admin.packages.packages_create', ['services' => $services,'branches' => $branches]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
        $data['html'] = '';
        $data['count'] = 0;
        $this->validate($request, [
            'title'=>'required',
            'firm'=>'required',
            'price'=>'required',
            // 'duration'=>'required',
            'packagetype'=>'required',
            'validityType'=>'required',
            'validity'=>'required',
            'members'=>'required',
            // 'status'=>'required'
        ]);
        
        $firm = $request->get('firm');
        $services = $request->get('services');
        $total = $request->get('total');
        // print_r($_POST); 

        $jsonArray = array();
        foreach (array_combine( $services, $total ) as $name => $value) {
            $jsonArray[] = array('service' => $name, 'total' => $value);
        }

        $json = json_encode($jsonArray);
        $insert = new packages([
            'firm_id' => $firm,
            'package_services' => $json,
            'package_title' => $request->get('title'),
            'package_price' => $request->get('price'),
            'package_validity_type' => $request->get('validityType'),
            'package_duration' => $request->get('validity'),
            'package_type' => $request->get('packagetype'),
            'total_member' => $request->get('members'),
            'create_date' => date("Y-m-d"),
            'package_satus' => 1
        ]);
        $insert->save(); 
        $id = $insert->package_id;
        if (!empty($id)) {
            $packages = DB::table('packages AS P')->select('P.*','F.firm_name')->leftJoin('firms AS F','F.id','=','P.firm_id')->get();
            foreach ($packages as $value) {
                $services_obj = json_decode($value->package_services);
                /*dd($services_obj);*/
                $serviceArray = [];
                $totalArray = [];
                if (!empty($services_obj)) {
                    foreach ($services_obj as $servicevalue) {
                        // print_r($servicevalue->service)
                        // dd($servicevalue->service);
                        $serviceid = $servicevalue->service;
                        if (!empty($serviceid)) {
                            // dd(Packages::serviceName($serviceid));
                            $serviceArray[]=Packages::serviceName($serviceid);
                            $totalArray[] = $servicevalue->total;
                        }
                    }
                }
                $value->serviceName = implode(',', $serviceArray);

                $value->totalTime = implode(',', $totalArray);
                /*$value->branchName = $branchName;*/
            }

            if (!empty($packages)) {
                $data['count'] = count($packages);
                foreach ($packages as $cat) {
                    $data['html'] .= '<tr>
                              <td>'.$cat->package_title.'</td>
                              <td>'.$cat->firm_name.'</td>
                              <td>'.$cat->serviceName.'</td>
                              <td>'.$cat->totalTime.'</td>
                              <td>';
                                if($cat->package_satus ==1)         
                                  $data['html'] .= 'Active';        
                                else
                                  $data['html'] .= 'Deactive';
                              $data['html'] .= '</td>
                              <td>
                                <table >
                                  <tr>
                                    <th style="padding: 0">
                                  <a href="javascript:void(0)" onclick="getPackage('.$cat->package_id.')" class="theme-btn" data-toggle="tooltip" data-html="true" title="Edit">
                                    <i class="fa fa-edit"></i>
                                  </a>
                                  <!-- <a href="" class="btn btn-primary">Edit</a> -->
                                </th>
                                <th style="padding: 0">
                                  <button class="theme-btn" onclick="deletePackage('.$cat->package_id.')" type="button" style="border:0 !important" data-toggle="tooltip" data-html="true" title="Delete"><i class="fa fa-close"></i></button>
                                </th>
                                  </tr>
                                </table>
                              </td>
                            </tr>';
                }
            }else{
                $data['html'] = '';
                $data['count'] = 0;
            }
        }else{
            $data['html'] = '';
            $data['count'] = 0;
        }

        echo json_encode($data);
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

    public function getPackageById(Request $request)
    {
        $id = $request->packageid;
        $services = DB::select('select * from services where status = :status', ['status' => 1]);
        $firms = Firm::all();
        // $packages = Packages::all();
        $package = DB::table('packages AS P')->select('P.*','F.firm_name')->leftJoin('firms AS F','F.id','=','P.firm_id')->where('package_id',$id)->first();
        echo view('admin.packages.packages_edit',compact('services','firms','package'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        // $packages = packages::find($id);
        

        // dd($packages);
        // print_r($packages); dd();
        $services = DB::select('select * from services where status = :status', ['status' => 1]);
        $branches = DB::select('select * from branches where status = :status', ['status' => 1]);
        return view('admin.packages.packages_edit')->with(['packages'=>$packages,'services' => $services,'branches' => $branches]); 
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
        // echo $id; die();
        $this->validate($request, [
            'title'=>'required',
            'branches'=>'required',
            'services'=>'required',
            'price'=>'required',
            'duration'=>'required',
            'packagetype'=>'required',
            'members'=>'required',
            'status'=>'required'
        ]);

        $branches = $request->get('branches');
        $services = $request->get('services');
        $total = $request->get('total');
        // print_r($_POST); 

        $jsonArray = array();
        foreach (array_combine( $services, $total ) as $name => $value) {
            $jsonArray[] = array('service' => $name, 'total' => $value);
        }

        $json = json_encode($jsonArray);
        if (!empty($branches)) {
            foreach ($branches as $branch) {
                /*$findpackages = Packages::getPackageByBranch($id,$branch);
                if (!empty($findpackages)) {
                    $packages = Packages::find($id);
                    $packages->package_title =  $request->get('title');
                    $packages->branch_id =  $branch;
                    $packages->package_services =  $json;
                    $packages->package_price = $request->get('price');
                    $packages->package_duration = $request->get('duration');
                    $packages->package_type = $request->get('packagetype');
                    $packages->total_member = $request->get('members');
                    $packages->package_satus = $request->get('status');
                    $packages->save();
                }else{
                    $packages = new packages([
                        'branch_id' => $branch,
                        'package_services' => $json,
                        'package_title' => $request->get('title'),
                        'package_price' => $request->get('price'),
                        'package_duration' => $request->get('duration'),
                        'package_type' => $request->get('packagetype'),
                        'total_member' => $request->get('members'),
                        'create_date' => date("Y-m-d"),
                        'package_satus' => $request->get('status')
                    ]);
                    $packages->save();
                }*/
                $packages = packages::find($id);
                $packages->package_title =  $request->get('title');
                $packages->branch_id =  $branch;
                $packages->package_services =  $json;
                $packages->package_price = $request->get('price');
                $packages->package_duration = $request->get('duration');
                $packages->package_type = $request->get('packagetype');
                $packages->total_member = $request->get('members');
                $packages->package_satus = $request->get('status');
                $packages->save();
            }
        }
        return redirect('admin/packages')->with('success', 'Package updated!');
    }

    public function updatePackage(Request $request)
    {
        // echo print_r($_POST); die();
        $data['html'] = '';
        $data['count'] = 0;
        $this->validate($request, [
            'edittitle'=>'required',
            'editfirm'=>'required',
            'editservices'=>'required',
            'editprice'=>'required',
            'editvalidity'=>'required',
            'editvalidityType'=>'required',
            'editpackagetype'=>'required',
            'editmembers'=>'required',
        ]);

        $services = $request->get('editservices');
        $total = $request->get('edittotal');
        // print_r($_POST); 

        $jsonArray = array();
        foreach (array_combine( $services, $total ) as $name => $value) {
            $jsonArray[] = array('service' => $name, 'total' => $value);
        }

        $json = json_encode($jsonArray);
        $packages = packages::find($request->get('editpackageid'));
        $packages->package_title =  $request->get('edittitle');
        $packages->firm_id =  $request->get('editfirm');
        $packages->package_services =  $json;
        $packages->package_price = $request->get('editprice');
        $packages->package_validity_type = $request->get('editvalidityType');
        $packages->package_duration = $request->get('editvalidity');
        $packages->package_type = $request->get('editpackagetype');
        $packages->total_member = $request->get('editmembers');
        /*$packages->package_satus = $request->get('status');*/
        $packages->save();
        $packages = DB::table('packages AS P')->select('P.*','F.firm_name')->leftJoin('firms AS F','F.id','=','P.firm_id')->get();
        foreach ($packages as $value) {
            $services_obj = json_decode($value->package_services);
            /*dd($services_obj);*/
            $serviceArray = [];
            $totalArray = [];
            if (!empty($services_obj)) {
                foreach ($services_obj as $servicevalue) {
                    // print_r($servicevalue->service)
                    // dd($servicevalue->service);
                    $serviceid = $servicevalue->service;
                    if (!empty($serviceid)) {
                        // dd(Packages::serviceName($serviceid));
                        $serviceArray[]=Packages::serviceName($serviceid);
                        $totalArray[] = $servicevalue->total;
                    }
                }
            }
            $value->serviceName = implode(',', $serviceArray);

            $value->totalTime = implode(',', $totalArray);
            /*$value->branchName = $branchName;*/
        }

        if (!empty($packages)) {
            $data['count'] = count($packages);
            foreach ($packages as $cat) {
                $data['html'] .= '<tr>
                          <td>'.$cat->package_title.'</td>
                          <td>'.$cat->firm_name.'</td>
                          <td>'.$cat->serviceName.'</td>
                          <td>'.$cat->totalTime.'</td>
                          <td>';
                            if($cat->package_satus ==1)         
                              $data['html'] .= 'Active';        
                            else
                              $data['html'] .= 'Deactive';
                          $data['html'] .= '</td>
                          <td>
                            <table >
                              <tr>
                                <th style="padding: 0">
                                  <a href="javascript:void(0)" onclick="getPackage('.$cat->package_id.')" class="theme-btn" data-toggle="tooltip" data-html="true" title="Edit">
                                    <i class="fa fa-edit"></i>
                                  </a>
                                  <!-- <a href="" class="btn btn-primary">Edit</a> -->
                                </th>
                                <th style="padding: 0">
                                  <button class="theme-btn" onclick="deletePackage('.$cat->package_id.')" type="button" style="border:0 !important" data-toggle="tooltip" data-html="true" title="Delete"><i class="fa fa-close"></i></button>
                                </th>
                              </tr>
                            </table>
                          </td>
                        </tr>';
            }
        }else{
            $data['html'] = '';
            $data['count'] = 0;
        }
        echo json_encode($data);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $packages = packages::find($id);
        $packages->delete();
        return redirect('/admin/packages')->with('success', 'Package deleted!');
    }

    public function deletePackage(Request $request)
    {
        $data['html'] = '';
        $data['count'] = 0;
        $delete = packages::find($request->packageid);
        $delete->delete();
        $packages = DB::table('packages AS P')->select('P.*','F.firm_name')->leftJoin('firms AS F','F.id','=','P.firm_id')->get();
        foreach ($packages as $value) {
            $services_obj = json_decode($value->package_services);
            /*dd($services_obj);*/
            $serviceArray = [];
            $totalArray = [];
            if (!empty($services_obj)) {
                foreach ($services_obj as $servicevalue) {
                    // print_r($servicevalue->service)
                    // dd($servicevalue->service);
                    $serviceid = $servicevalue->service;
                    if (!empty($serviceid)) {
                        // dd(Packages::serviceName($serviceid));
                        $serviceArray[]=Packages::serviceName($serviceid);
                        $totalArray[] = $servicevalue->total;
                    }
                }
            }
            $value->serviceName = implode(',', $serviceArray);

            $value->totalTime = implode(',', $totalArray);
            /*$value->branchName = $branchName;*/
        }

        if (!empty($packages)) {
            $data['count'] = count($packages);
            foreach ($packages as $cat) {
                $data['html'] .= '<tr>
                          <td>'.$cat->package_title.'</td>
                          <td>'.$cat->firm_name.'</td>
                          <td>'.$cat->serviceName.'</td>
                          <td>'.$cat->totalTime.'</td>
                          <td>';
                            if($cat->package_satus ==1)         
                              $data['html'] .= 'Active';        
                            else
                              $data['html'] .= 'Deactive';
                          $data['html'] .= '</td>
                          <td>
                            <table >
                              <tr>
                                <th style="padding: 0">
                                  <a href="javascript:void(0)" onclick="getPackage('.$cat->package_id.')" class="theme-btn" data-toggle="tooltip" data-html="true" title="Edit">
                                    <i class="fa fa-edit"></i>
                                  </a>
                                  <!-- <a href="" class="btn btn-primary">Edit</a> -->
                                </th>
                                <th style="padding: 0">
                                  <button class="theme-btn" onclick="deletePackage('.$cat->package_id.')" type="button" style="border:0 !important" data-toggle="tooltip" data-html="true" title="Delete"><i class="fa fa-close"></i></button>
                                </th>
                              </tr>
                            </table>
                          </td>
                        </tr>';
            }
        }else{
            $data['html'] = '';
            $data['count'] = 0;
        }

        echo json_encode($data);
    }
}