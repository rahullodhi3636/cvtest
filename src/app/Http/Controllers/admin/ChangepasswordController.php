<?php  
	namespace App\Http\Controllers\admin;

	use App\Model\admin\Customer;
	use App\Model\admin\Changepassword;
	use App\Model\admin\Packages;
	use App\Model\admin\Services;
	use App\Model\admin\Enquiry_categories;
	use App\User;
	use DB;
	use Illuminate\Http\Request;
	use App\Http\Controllers\Controller;
	use Illuminate\Support\Facades\Auth;
	use Illuminate\Support\Facades\Hash;
	class ChangepasswordController extends Controller
	{
		public function index($value='')
		{
			return view('admin.change_password.change_password');
		}

		public function store(Request $request){
			$this->validate($request, [
		        'old_password'     => 'required',
		        'new_password'     => 'required|min:6',
		        'confirm_password' => 'required|same:new_password',
		    ]);
		    $data = $request->all();
 
		    $user = User::find(auth()->user()->id);
		    if(!Hash::check($data['old_password'], $user->password)){
		         return back()
		                    ->with('error','The specified password does not match the database password');
		    }else{
		       DB::table('users')->where('id', $user->id)->update(array('password' => Hash::make($request->get('new_password'))));
		        return back()->with('success', 'Password Changed!');
		    }
			/*DB::table('customer_package_service')->where('package_service_id', $request->get('packageserviceid'))->update(array('remaining_services' => $remaining));*/
		}
	}
?>