<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\admin\Offer;
use App\Model\admin\Customer;
use App\Model\admin\CustomerOffer;
use DB;
use Illuminate\Http\Request;

class ReferralController extends Controller
{
    public function index($id = null)
    {
        return view('referals/newref')->with('custid', $id);
    }

    public function store(Request $request)
    {
        $last_record = Customer::orderBy('id', 'desc')->first();
        if ($last_record != '') {
            $last_id = 1 + $last_record->id;
        } else {
            $last_id = 1;
        }
        $refer_by = $request->get('referred_by');
        $customer_code = $this->genratecode('customers', 'customer_code', 6);
        $this->validate($request,
            [
                'name' => 'required|unique:customers,name',
                'contact' => 'required',
            ],
            [
                'name.required' => 'Enter customer name',
                'contact.required' => 'Enter customer contact',
            ]
        );
        if ($request->file('image') != null) {
            $input['image'] = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/customer'), $input['image']);
        } else {
            $input['image'] = "";
        }
        if (request('anniversary_date') != '') {
            $anniversary_date = date('Y-m-d', strtotime($request->get('anniversary_date')));
        } else {
            $anniversary_date = null;
        }
        if (request('dob') != '') {
            $dob = date('Y-m-d', strtotime($request->get('dob')));
        } else {
            $dob = null;
        }
        $hashcode = md5($request->get('referral_code'));
        if (!empty($request->get('referred_by'))) {
            $refferuser = DB::table('customers')->where('referral_code', $request->get('referred_by'))->first();
            if (!empty($refferuser)) {
                $customer = new customer([
                    'admin_id' => 1,
                    'customer_id' => $last_id,
                    'cust_type' => $request->get('cust_type'),
                    'name' => $request->get('name'),
                    'customer_image' => $input['image'],
                    'location' => $request->get('location'),
                    'contact' => $request->get('contact'),
                    'other_contact' => $request->get('other_contact'),
                    'email' => $request->get('email'),
                    'dob' => $dob,
                    'referral_code' => $last_id,
                    'referral_hash_code' => $hashcode,
                    'referred_by' => $request->get('referred_by'),
                    'anniversary_date' => $anniversary_date,
                    'customer_code' => $customer_code,
                    'rf_id' => $last_id,
                    'remarks' => $request->get('remark'),
                    'gender' => $request->get('gender'),
                    'designation' => $request->get('designation'),
                    'total_visit' => 0,
                    'total_revenue' => 0,
                    'customer_status' => 1,
                ]);
                $customer->save();
            }
            if (!empty($customer)) {
                $customer_id = $customer->id;
                $Offer_data = Offer::where([['offer_title','=','newuser'],['offer_party','=','referred']])->first();
                $validity = $Offer_data->offer_validity;
                $Offer_id = $Offer_data->id;
                $Valid_date = date('d-m-Y', strtotime('+' . $validity . 'days'));
                $Validity_date = date_create($Valid_date);
                $offer_code = $this->genratecode('customer_offer', 'offer_code', 6);
                $customer_Offer = new CustomerOffer([
                    'offer_id' => $Offer_id,
                    'customer_id' => $customer_id,
                    'offer_code' => $offer_code,
                    'start_date' => date('Y-m-d H:i:s'),
                    'expire_date' => $Validity_date,
                    'status' => 0,
                ]);
                $customer_Offer->save();
            }
            if($refer_by!=""){
                $customer_id1 = $refferuser->id;
                $Offer_data1 = Offer::where([['offer_title','=','newuser'],['offer_party','=','referring']])->first();
                $validity1 = $Offer_data1->offer_validity;
                $Offer_id1 = $Offer_data1->id;
                $Valid_date1 = date('d-m-Y', strtotime('+' . $validity1 . 'days'));
                $Validity_date1 = date_create($Valid_date1);
                $offer_code = $this->genratecode('customer_offer', 'offer_code', 6);
                $customer_Offer1 = new CustomerOffer([
                    'offer_id' => $Offer_id1,
                    'customer_id' => $customer_id1,
                    'offer_code' => $offer_code,
                    'offer_used_count'=>0,
                    'used_by'=>0,
                    'start_date' => date('Y-m-d H:i:s'),
                    'expire_date' => $Validity_date1,
                    'status' => 0,
                ]);
                $customer_Offer1->save();
            }
            return redirect('referring_customer/' . $refer_by)->with('success', 'Dear User, You have successfully registered');
        }
		return redirect('referring_customer/' . $refer_by)->with('danger', 'OOPS ! Something went wrong');
    }

    public function genratecode($tablename, $columnname, $digit)
    {
        $code = $this->generate($digit);
        $checkcode = DB::table($tablename)->select('*')->where($columnname, '=', $code)->count();
        if ($checkcode > 0) {
            $code = $this->genratecode($tablename, $columnname, $digit);
        }
        return $code;
    }

    public function generate($digit)
    {
        $characters = '123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $digit; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
