<?php
namespace App\Http\Controllers;

// use App\Model\admin\Customer;
use App\Http\Controllers\Controller;
use App\Model\Feedback;
use App\Model\FeedbackByStaff;
// use App\Model\admin\Packages;
// use App\Model\admin\Services;
// use App\Model\admin\Enquiry_categories;
// use App\User;
use App\Helper;
use DB;
use Illuminate\Http\Request;

// use Illuminate\Support\Facades\Auth;
class FeedbackController extends Controller
{
    public function index($id = null)
    {
        // dd($id);
        // $id = request('customer_id');
        return view('feedback/feedback')->with('custid', $id);
    }



    public function store(Request $request)
    {

        $this->validate($request,
            [
                'rating2' => 'required',
                // 'comment' => 'required',
            ],
            [
                'rating2.required' => 'Select star for rating',
                // 'comment.required' => 'Enter your comment',
            ]
        );
        $customer_id = $request->get('custid');
        $comment= $request->comment;
        $feedback = new feedback([
            'customer_id' => $customer_id,
            'rating' => $request->get('rating2'),
            'comment' => isset($comment)? $comment:'-',
            'status' => 1,
        ]);
        $feedback->save();
        $sms = "";
        $getcustdata = DB::table('customers AS C')->where('C.id', $customer_id)->first();
        if ($request->get('rating2') == 1 || $request->get('rating2') == 2) {
            $sms = DB::table('sms_template')->select('template_message')->where('id', '=', 5)->first();
            $getownerdata = DB::table('users')->where('admin', 1)->first();
            $template_msg= $getcustdata->name.'('.$getcustdata->contact.')'.' customer provided rating below 2 - Description was ' . $request->comment . ' , ' . $getownerdata->name . ' please contact immediately to resolve the issue team CV Salon.';
            Helper::sendMobileSMS($getownerdata->phone_no, $template_msg);
        } else if ($request->get('rating2') == 3 || $request->get('rating2') == 4 || $request->get('rating2') == 5){
            $sms = DB::table('sms_template')->select('template_message')->where('id', '=', 4)->first();
        } else {
            $sms = DB::table('sms_template')->select('template_message')->where('id', '=', 3)->first();
        }
        // dd($sms);

        Helper::sendMobileSMS($getcustdata->contact, $sms->template_message);
        return redirect('feedback')->with('success', $sms->template_message);
    }

    public function ShowAll(Request $request)
    {
        // $feedback = DB::table('feedback as f')
        // ->select('f.comment','f.rating','C.name as customer_name','C.contact as customer_contact')
        // ->leftJoin('customers as C', 'C.id', '=', 'f.customer_id')
        // ->orderBy('f.feedback_id', 'DESC')
        // ->paginate();
        return view('feedback/list');
    }

    public function getFeedbackByRatings(Request $request)
    {

        // echo json_encode(['request' => $request->all()]);
        // exit();
        $rating = $request->rating;
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $data['html'] = "";
        $data['subtotal'] = 0;
        $from = "";
        $to = "";
        if($start_date!=''){
           $from = date('Y-m-d 00:00:00', strtotime($start_date));
        }
        if($end_date!=''){
          $to = date('Y-m-d 23:59:59', strtotime($end_date));
        }


        $getReport = DB::table('feedback as FDB')
            ->select('FDB.*', 'C.name as customer_name','C.contact as mobile_no')
            ->leftJoin('customers as C', 'C.id', '=', 'FDB.customer_id');
        if($rating!=0){
            $getReport->where('FDB.rating', '=', $rating);
        }
        if ($from!='' && $to!='') {
            $getReport->where('FDB.created_at', '>=', $from);
            $getReport->where('FDB.created_at', '<=', $to);
        }
        $getReport->orderBy('FDB.feedback_id','DESC');
        $reports = $getReport->get();
        echo json_encode(['msg' => true, 'data' => $reports]);
    }

    public function add_StaffFeedback(Request $request)
    {
        // print_r($request->all());
        // die;

        $latest_invoice = DB::table('invoice')->select('invoice_id')->where('user_id', '=',$request->customer_id)->orderBy('invoice_id','DESC')->first();
        if($latest_invoice){
            $invoice_id = $latest_invoice->invoice_id;
        }else{
            $invoice_id = 0;
        }

        $Feedback_ByStaff = new FeedbackByStaff();
        $Feedback_ByStaff->staff_id = $request->staff_id;
        $Feedback_ByStaff->customer_id = $request->customer_id;
        $Feedback_ByStaff->rating = isset($request->rating)?($request->rating):0 ;
        $Feedback_ByStaff->comment = isset($request->staff_comment)?($request->staff_comment):'';
        $Feedback_ByStaff->cust_rating = isset($request->cust_rating)?($request->cust_rating):0;
        $Feedback_ByStaff->cust_comment = isset($request->cust_comment)?($request->cust_comment):'';
        $Feedback_ByStaff->invoice_id = $invoice_id;
        $Feedback_ByStaff->status = 1 ;
        $Feedback_ByStaff->save();
        $getcustdata = DB::table('customers AS C')->where('C.id', $request->customer_id)->first();
        if ($request->cust_rating == 1 || $request->cust_rating == 2) {
            $sms = DB::table('sms_template')->select('template_message')->where('id', '=', 5)->first();
            $getownerdata = DB::table('users')->where('admin', 1)->first();
            $template_msg= $getcustdata->name.'('.$getcustdata->contact.')'.' customer provided rating below 2 - Description was ' . $request->cust_comment . ' , ' . $getownerdata->name . ' please contact immediately to resolve the issue team CV Salon.';
            Helper::sendMobileSMS($getownerdata->phone_no, $template_msg);
        } else if ($request->cust_rating == 3 || $request->cust_rating == 4) {
            $sms = DB::table('sms_template')->select('template_message')->where('id', '=', 4)->first();
        } else {
            $sms = DB::table('sms_template')->select('template_message')->where('id', '=', 3)->first();
        }
        // dd($sms);
        Helper::sendMobileSMS($getcustdata->contact, $sms->template_message);
		echo json_encode(['msg' => true]);
    }

    public function myinvoice($invoiceid)
    {
        /*$invoicedata = DB::table('invoice AS I')
        ->select('I.*','P.package_title','IP.price AS package_price','IP.discount AS package_discount','IP.cgst AS package_cgst','IP.sgst AS package_sgst','IP.total_price AS package_total','SP.product_name','U.name AS product_staff_name','IPR.quantity AS product_quantity','IPR.price AS product_price','IPR.discount AS product_discount','IPR.cgst AS product_cgst','IPR.sgst AS product_sgst','IPR.total_price AS product_total','SE.name AS service_name','SU.name AS service_staff_name','IS.quantity AS service_quantity','IS.price AS service_price','IS.discount AS service_discount','IS.cgst AS service_cgst','IS.sgst AS service_sgst','IS.total_price AS service_total','C.name AS customer_name','C.email AS customer_email','C.contact AS customer_contact','C.location AS customer_location')
        ->leftJoin('invoice_package AS IP','IP.invoice_id','=','I.invoice_id')
        ->leftJoin('packages AS P','P.package_id','=','IP.package_id')
        ->leftJoin('invoice_product AS IPR','IPR.invoice_id','=','I.invoice_id')
        ->leftJoin('users AS U','U.id','=','IPR.staff_id')
        ->leftJoin('service_products AS SP','SP.product_id','=','IPR.product_id')
        ->leftJoin('invoice_service AS IS','IS.invoice_id','=','I.invoice_id')
        ->leftJoin('services AS SE','SE.id','=','IS.service_id')
        ->leftJoin('users AS SU','SU.id','=','IS.staff_id')
        ->leftJoin('customers AS C','C.id','=','I.user_id')
        ->where('I.invoice_id',$invoiceid)
        ->get();*/
        /*$invoicedata = DB::table('invoice AS I')
        ->leftJoin('customers AS C','C.id','=','I.user_id')
        ->where('I.invoice_id',$invoiceid)
        ->first();*/
        $invoicedata = DB::table('invoice AS I')
            ->select('C.*', 'I.*', 'I.remark AS iremark')->leftJoin('customers AS C', 'C.id', '=', 'I.user_id')
            ->where('I.invoice_id', $invoiceid)
            ->first();
        // print_r($invoicedata);
        return view('customer.newinvoice2', compact('invoicedata'));
    }
}
