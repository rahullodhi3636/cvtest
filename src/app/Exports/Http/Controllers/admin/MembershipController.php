<?php  
namespace App\Http\Controllers\admin;
use DB;
use App\Model\admin\Membership;
use App\User;
use App\Model\admin\Firm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MembershipController extends Controller
{
	public function index()
	{
		$memberships = DB::table('membership AS M')->select('M.*','F.firm_name')->leftJoin('firms AS F','F.id','=','M.firm_id')->get();
		$firms = Firm::all();
		return view('admin.membership.membershiplist', compact('memberships','firms'));
	}

	public function store(Request $request)
	{
		// print_r($_POST); die;
		$data['html'] = '';
		$data['count'] = '';
        $this->validate($request, [
            'firm'=>'required',
            'title'=>'required|unique:membership,membership_title',
            'price'=>'required',
            'validity'=>'required',
        ]);
        $insert = new Membership([
            'firm_id' => $request->get('firm'),
            'membership_title' => $request->get('title'),
            'membership_price' => $request->get('price'),
            'service_discount_type' => $request->get('service_discount_type'),
            'service_discount' => $request->get('service_discount'),
            'product_discount_type' => $request->get('product_discount_type'),
            'product_discount' => $request->get('product_discount'),
            'membership_validity' => $request->get('validity'),
            'tax_applicable' => 1,
            'status' => 1,
        ]);
        $insert->save();
        $id = $insert->id;
        if(!empty($id)){
        	$memberships = DB::table('membership AS M')->select('M.*','F.firm_name')->leftJoin('firms AS F','F.id','=','M.firm_id')->get();
        	if (!empty($memberships)) {
        		$data['count'] = count($memberships);
        		foreach ($memberships as $membership) {
        			$data['html'] .= '<tr>
                              <td>'.$membership->membership_title.'</td>
                              <td>'.$membership->firm_name.'</td>
                              <td>'.$membership->membership_price.'</td>
                              <td>'.$membership->membership_validity.'</td>
                              <td>
                                <table >
                                  <tr>
                                    <th style="padding: 0">
                                      <a href="javascript:void(0)" onclick="getMembership('.$membership->id.')" class="theme-btn" data-toggle="tooltip" data-html="true" title="Edit">
                                        <i class="fa fa-edit"></i>
                                      </a>
                                      <!-- <a href="" class="btn btn-primary">Edit</a> -->
                                    </th>
                                    <th style="padding: 0">
                                      <button onclick="deleteMemberShip('.$membership->id.')" class="theme-btn" type="button" style="border:0 !important" data-toggle="tooltip" data-html="true" title="Delete"><i class="fa fa-close"></i></button>
                                    </th>
                                  </tr>
                                </table>
                              </td>
                            </tr>';
        		}
        	}else{
        		$data['html'] = '';
        		$data['count'] = '';
        	}
        }else{
        	$data['html'] = '';
        	$data['count'] = '';
        }
        echo json_encode($data);
	}

	public function getMembership(Request $request)
	{
		$id = $request->membershipid;
        $membership = DB::table('membership')->where('id',$id)->first();
        echo json_encode($membership);
	}

	public function updateMembership(Request $request)
	{
		$data['html'] = '';
		$data['count'] = '';
        $this->validate($request, [
            'editfirm'=>'required',
            'edittitle'=>'required',
            'editprice'=>'required',
            'editvalidity'=>'required',
        ]);

        $update = Membership::find($request->membershipid);
        $update->firm_id =  $request->editfirm;
        $update->membership_title =  $request->edittitle;
        $update->membership_price =  $request->editprice;
        $update->service_discount_type =  $request->editservice_discount_type;
        $update->service_discount =  $request->editservice_discount;
        $update->product_discount_type =  $request->editproduct_discount_type;
        $update->product_discount =  $request->editproduct_discount;
        $update->membership_validity =  $request->editvalidity;
        $update->save();

        $memberships = DB::table('membership AS M')->select('M.*','F.firm_name')->leftJoin('firms AS F','F.id','=','M.firm_id')->get();
    	if (!empty($memberships)) {
    		$data['count'] = count($memberships);
    		foreach ($memberships as $membership) {
    			$data['html'] .= '<tr>
                          <td>'.$membership->membership_title.'</td>
                          <td>'.$membership->firm_name.'</td>
                          <td>'.$membership->membership_price.'</td>
                          <td>'.$membership->membership_validity.'</td>
                          <td>
                            <table >
                              <tr>
                                <th style="padding: 0">
                                  <a href="javascript:void(0)" onclick="getMembership('.$membership->id.')" class="theme-btn" data-toggle="tooltip" data-html="true" title="Edit">
                                    <i class="fa fa-edit"></i>
                                  </a>
                                  <!-- <a href="" class="btn btn-primary">Edit</a> -->
                                </th>
                                <th style="padding: 0">
                                  <button onclick="deleteMemberShip('.$membership->id.')" class="theme-btn" type="button" style="border:0 !important" data-toggle="tooltip" data-html="true" title="Delete"><i class="fa fa-close"></i></button>
                                </th>
                              </tr>
                            </table>
                          </td>
                        </tr>';
    		}
    	}else{
    		$data['html'] = '';
    		$data['count'] = '';
    	}

    	echo json_encode($data);
	}

	public function deleteMemberShip(Request $request)
	{
		$data['html'] = '';
    	$data['count'] = '';
		$delete = Membership::find($request->membershipid);
        $delete->delete();
        $memberships = DB::table('membership AS M')->select('M.*','F.firm_name')->leftJoin('firms AS F','F.id','=','M.firm_id')->get();
    	if (!empty($memberships)) {
    		$data['count'] = count($memberships);
    		foreach ($memberships as $membership) {
    			$data['html'] .= '<tr>
                          <td>'.$membership->membership_title.'</td>
                          <td>'.$membership->firm_name.'</td>
                          <td>'.$membership->membership_price.'</td>
                          <td>'.$membership->membership_validity.'</td>
                          <td>
                            <table >
                              <tr>
                                <th style="padding: 0">
                                  <a href="javascript:void(0)" onclick="getMembership('.$membership->id.')" class="theme-btn" data-toggle="tooltip" data-html="true" title="Edit">
                                    <i class="fa fa-edit"></i>
                                  </a>
                                  <!-- <a href="" class="btn btn-primary">Edit</a> -->
                                </th>
                                <th style="padding: 0">
                                  <button onclick="deleteMemberShip('.$membership->id.')" class="theme-btn" type="button" style="border:0 !important" data-toggle="tooltip" data-html="true" title="Delete"><i class="fa fa-close"></i></button>
                                </th>
                              </tr>
                            </table>
                          </td>
                        </tr>';
    		}
    	}else{
    		$data['html'] = '';
    		$data['count'] = '';
    	}
    	echo json_encode($data);
	}
}
?>