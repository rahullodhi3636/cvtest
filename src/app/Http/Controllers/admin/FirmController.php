<?php
namespace App\Http\Controllers\admin;

use App\Model\admin\Enquiry;
use App\Model\admin\Firm;
use App\Model\admin\Remark;
use App\Model\admin\Packages;
use App\Model\admin\Enquiry_categories;
use App\User;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FirmController extends Controller
{
	public function index()
	{
		$firms = Firm::all();
        return view('admin.firm.firm_list', compact('firms'));
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

            $data['html'] = '';
            $this->validate($request, [
                'name'=>'required|unique:firms,firm_name',
                'location'=>'required',
                'phone'=>'required',
                'cgst'=>'required',
                'sgst'=>'required',
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

            $branches = new firm([
                'firm_name' => $request->get('name'),
                'firm_location' => $request->get('location'),
                'firm_number' => $request->get('phone'),
                'cgst' => $request->get('cgst'),
                'sgst' => $request->get('sgst'),
                'gst_status' => $request->get('gst_status'),
                'gst_discount' => $request->get('gst_discount'),
                'composition' => $request->get('composition'),
                'composition_status' => $request->get('composition_status'),
                'status' => $request->get('status')
            ]);


            $branches->save();
            $id = $branches->id;
            if (!empty($id)) {
                $firms = Firm::all();
                if (!empty($firms)) {
                    foreach ($firms as $firm) {
                        $data['html'] .= '<tr>
                            <td>'.$firm->firm_name.'</td>
                            <td>'.$firm->firm_number.'</td>
                            <td>
                                '.$firm->firm_location.'
                            </td>
                            <td>
                              <a href="'.url('admin/totalsales').'" class="btn-success btn-sm waves-effect waves-light text-light material-tooltip-main" data-toggle="tooltip" data-html="true" title="Total sales">
                                <i class="mdi mdi-eye"></i>
                              </a>
                            </td>
                            <td>
                              <table >
                                <tr>
                                  <th style="padding: 0">
                                    <a href="javascript:void(0)" onclick="getFirm('.$firm->id.')" class="btn-primary btn-sm waves-effect waves-light text-light material-tooltip-main" data-toggle="tooltip" data-html="true" title="Edit">
                                      <i class="fa fa-edit"></i>
                                    </a>
                                  </th>
                                  <th style="padding: 0">
                                    <form action="'.route('firm.destroy', $firm->id).'" method="post">
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
        return view('admin.firm.firm_edit')->with(['firm'=>$Firm]);
    }

    public function getFirm(Request $request)
    {
        $id = $request->firmid;
        $data = DB::table('firms')->where('id',$id)->first();
        echo json_encode($data);
    }

    public function updateFirm(Request $request)
    {
        $data['html'] = '';
        $this->validate($request, [
            'editname'=>'required',
            'editlocation'=>'required',
            'editphone'=>'required',
            'cgst'=>'required',
            'sgst'=>'required',
            'editstatus'=>'required'
        ]);
        $id = $request->editfirmid;
        $firm = firm::find($id);
        $firm->firm_name =  $request->get('editname');
        $firm->firm_location =  $request->get('editlocation');
        $firm->firm_number =  $request->get('editphone');
        $firm->status = $request->get('editstatus');
        $firm->cgst = $request->get('cgst');
        $firm->sgst = $request->get('sgst');
        $firm->gst_status = $request->get('gst_status');
        $firm->gst_discount = $request->get('gst_discount');
        $firm->composition = $request->get('composition');
        $firm->composition_status = $request->get('composition_status');
        $firm->save();
        $firms = Firm::all();
        if (!empty($firms)) {
            foreach ($firms as $firm) {
                $data['html'] .= '<tr>
                    <td>'.$firm->firm_name.'</td>
                    <td>'.$firm->firm_number.'</td>
                    <td>
                        '.$firm->firm_location.'
                    </td>
                    <td>
                      <a href="'.url('admin/totalsales').'" class="btn-success btn-sm waves-effect waves-light text-light material-tooltip-main" data-toggle="tooltip" data-html="true" title="Total sales">
                        <i class="mdi mdi-eye"></i>
                      </a>
                    </td>
                    <td>
                      <table >
                        <tr>
                          <th style="padding: 0">
                            <a href="javascript:void(0)" onclick="getFirm('.$firm->id.')" class="btn-primary btn-sm waves-effect waves-light text-light material-tooltip-main" data-toggle="tooltip" data-html="true" title="Edit">
                              <i class="fa fa-edit"></i>
                            </a>
                          </th>
                          <th style="padding: 0">
                            <form action="'.route('firm.destroy', $firm->id).'" method="post">
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
    public function update(Request $request, $id)
    {

       if ($request->file('image') != null) {
         // dd($request->file('image'));
         $firm = firm::find($id);
         $qrcode = $id . '.' . $request->image->getClientOriginalExtension();
         $request->image->move(public_path('images/firms_qrcode'), $qrcode);
         $firm->qr_code = $qrcode;
         if($firm->save()){
            return redirect('admin/firm')->with('success', 'Qrcode updated!');
         }else{
            return redirect('admin/firm')->with('error', 'Firm updated!');
         }
       }else{
            return redirect('admin/firm')->with('error', 'Qr  code image not found');
       }


    }

    public function destroy($id)
    {
        $firm = firm::find($id);
        $firm->delete();
        return redirect('/admin/firm')->with('success', 'Firm deleted!');
    }
}
?>
