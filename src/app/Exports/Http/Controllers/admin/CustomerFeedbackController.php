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
class CustomerFeedbackController extends Controller
{
	public function index()
	{
		$customerFeedback = DB::table('feedback')->select('customers.*','feedback.*','feedback.created_at as feedback_date')->leftJoin('customers', 'customers.id', '=', 'feedback.customer_id')->get();
		return view('admin/customerfeedback.feedbacklist')->with(['feedback'=>$customerFeedback]);
	}
}