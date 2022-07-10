<?php
	namespace App\Http\Controllers\admin;
	use App\Model\admin\Customer;
	use App\Model\admin\Collection;
	use App\Model\admin\Packages;
	use App\Model\admin\Services;
	use App\Model\admin\Enquiry_categories;
	use App\User;
	use DB;
	use Illuminate\Http\Request;
	use App\Http\Controllers\Controller;
	use Illuminate\Support\Facades\Auth;
	class ScanrfidController extends Controller
	{
	  	public function index()
	  	{
	  		return view('staff.dashboard');
	  	}
	}  
?>