<?php  
namespace App\Http\Controllers\admin;
use App\Model\admin\Customer;
use App\Model\admin\Sms_management;
use App\Model\admin\Packages;
use App\Model\admin\Services;
use App\Model\admin\Enquiry_categories;
use App\User;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Smsmanagementcontroller extends Controller
{
	public function index()
	{
		$sms = DB::table('sms_template')->get();
		return view('admin.sms_management.smslist')->with(['sms' => $sms]);
	}

	public function create()
	{
		return view('admin.sms_management.smscreate');
	}

	public function store(Request $request)
	{
		$this->validate($request,
			[
				'name' => 'required',
				'message' => 'required',
				'status' => 'required',
			],
			[
				'name.required' => 'Enter template name',
				'message.required' => 'Enter template message',
				'status.required' => 'Select template status',
			]
		);

		$Sms_management = new Sms_management([
			'template_name' => $request->get('name'),
			'template_message' => $request->get('message'),
			'template_status' => $request->get('status'),
		]);
		$Sms_management->save();
		return redirect('admin/sms')->with('success','Template saved');
	}

	public function edit($id)
	{
		$sms = Sms_management::find($id);
		return view('admin.sms_management.smsupdate')->with(['sms'=>$sms]);
	}

	public function update(Request $request, $id)
	{
		$this->validate($request,
			[
				'name' => 'required',
				'message' => 'required',
				'status' => 'required',
			],
			[
				'name.required' => 'Enter template name',
				'message.required' => 'Enter template message',
				'status.required' => 'Select template status',
			]
		);

		$sms = Sms_management::find($id);
		$sms->template_name = $request->get('name');
		$sms->template_message = $request->get('message');
		$sms->template_status = $request->get('status');
		$sms->save();
		return redirect('admin/sms')->with('success','Template updated');
	}

	public function destroy($id)
	{
		$sms = Sms_management::find($id);
		$sms->delete();
		return redirect('admin/sms')->with('success','Template deleted');
	}
}

?>