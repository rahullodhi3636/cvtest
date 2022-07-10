<?php  
namespace App\Http\Controllers\admin;

use App\Model\admin\Enquiry;
use App\Model\admin\Firm;
use App\Model\admin\Remark;
use App\Model\admin\Packages;
use App\Model\admin\Enquiry_categories;
use App\Model\admin\Location;
use App\Model\admin\Designation;
use App\User;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
	public function index()
	{
		$location = Location::all();
        return view('admin.location.location_list', compact('location'));
	}

    public function firmService()
    {
        $services = DB::select('select * from services where status = :status', ['status' => 1]);
        return view('admin.firm.addFirmService', ['services' => $services]);
    }

	public function create(){
        $services = DB::select('select * from services where status = :status', ['status' => 1]);
        return view('admin.firm.firm_create', compact('services'));
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
            $data['html'] = '';
            $this->validate($request, [
                'name'=>'required|unique:locations,name',
               
                // 'services' => 'required',
                'status'=>'required'
            ]);
            
            /*if ($validator->fails())
            {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()

                ), 400); // 400 being the HTTP code for an invalid request.
            }*/

            $branches = new location([
                'name' => $request->get('name'),
               
                'status' => $request->get('status')
            ]);
        
            
            $branches->save();
            $id = $branches->id;
            if (!empty($id)) {
                $location = Location::all();
                if (!empty($location)) {
                    foreach ($location as $loca) {
                        $data['html'] .= '<tr>
                            <td>'.$loca->name.'</td>
                           
                            
                            <td>
                              <table >
                                <tr>
                                  <th style="padding: 0">
                                    <a href="javascript:void(0)" onclick="getLocation('.$loca->id.')" class="btn-primary btn-sm waves-effect waves-light text-light material-tooltip-main" data-toggle="tooltip" data-html="true" title="Edit">
                                      <i class="fa fa-edit"></i>
                                    </a>
                                  </th>
                                  <th style="padding: 0">
                                    <form action="'.route('location.destroy', $loca->id).'" method="post">
                                      <input type="hidden" name="_method" value="delete" />
                                      <input type = "hidden" name = "_token" value = "'.csrf_token().'">
                                      <button class="btn-danger btn-sm waves-effect waves-light material-tooltip-main" type="submit" style="border:0 !important" data-toggle="tooltip" data-html="true" title="Delete"><i class="fa fa-close"></i></button>
                                    </form>
                                  </th>
                                </tr>
                              </table>
                            </td>
                          </tr>';
                    }
                }else{
                    $data['html'] = '';
                }
            }else{
                $data['html'] = '';
            }
            echo json_encode($data);
            // return redirect('admin/firm')->with('success', 'Firm saved!');
    }

    public function edit($id)
    {
        $Firm = Firm::find($id);
        $services = DB::select('select * from services where status = :status', ['status' => 1]);
        return view('admin.firm.firm_edit')->with(['firm'=>$Firm,'services'=>$services]); 
    }

    public function getLocation(Request $request)
    {
        $id = $request->locaid;
        $data = DB::table('locations')->where('id',$id)->first();
        echo json_encode($data);
    }

    public function updateLocation(Request $request)
    {
        $data['html'] = '';
        $this->validate($request, [
            'editname'=>'required',
           
           
            'editstatus'=>'required'
        ]);
        $id = $request->editfirmid;
        $firm = location::find($id);
        $firm->name =  $request->get('editname');
      
      
        $firm->status = $request->get('editstatus');
        $firm->save();
        $locations = Location::all();
        if (!empty($locations)) {
            foreach ($locations as $loca) {
                $data['html'] .= '<tr>
                    <td>'.$loca->name.'</td>
                    
                  
                   
                    <td>
                      <table >
                        <tr>
                          <th style="padding: 0">
                            <a href="javascript:void(0)" onclick="getLocation('.$loca->id.')" class="btn-primary btn-sm waves-effect waves-light text-light material-tooltip-main" data-toggle="tooltip" data-html="true" title="Edit">
                              <i class="fa fa-edit"></i>
                            </a>
                          </th>
                          <th style="padding: 0">
                            <form action="'.route('location.destroy', $loca->id).'" method="post">
                              <input type="hidden" name="_method" value="delete" />
                              <input type = "hidden" name = "_token" value = "'.csrf_token().'">
                              <button class="btn-danger btn-sm waves-effect waves-light material-tooltip-main" type="submit" style="border:0 !important" data-toggle="tooltip" data-html="true" title="Delete"><i class="fa fa-close"></i></button>
                            </form>
                          </th>
                        </tr>
                      </table>
                    </td>
                  </tr>';
            }
        }else{
            $data['html'] = '';
        }
        echo json_encode($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //    $this->validate($request, [
    //         'name'=>'required',
    //         'location'=>'required',
    //         'phone'=>'required',
    //         'services' => 'required',
    //         'status'=>'required'
    //     ]);

    //     $firm = firm::find($id);
    //     $firm->firm_name =  $request->get('name');
    //     $firm->firm_location =  $request->get('location');
    //     $firm->services =  json_encode($request->get('services'));
    //     $firm->firm_number =  $request->get('phone');
    //     $firm->status = $request->get('status');
    //     $firm->save();

    //     return redirect('admin/firm')->with('success', 'Firm updated!');
    // }

    public function destroy($id)
    {
        $location_data = Location::find($id);
        $location_data->delete();
        return redirect('/admin/location')->with('success', 'Location deleted!');
    }
}
?>