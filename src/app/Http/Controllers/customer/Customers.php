<?php
namespace App\Http\Controllers\customer;

use App\Exports\CustomerExport;
use App\Exports\InactivecustomerExport;
use App\Exports\AllcustomerExport;
use App\Exports\AssignedCouponExport;
use App\Exports\AssignedRefExport;
use App\Helper;
use App\Http\Controllers\Controller;
use App\Model\admin\Coupon;
use App\Model\admin\Offer;
use App\Model\admin\Customer;
use App\Model\admin\CustomerCoupon;
use App\Model\admin\CustomerOffer;
use App\Model\admin\Designation;
use App\Model\admin\Location;
use App\Model\admin\MemberSystem;
use App\Model\admin\sittingPack;
use App\Model\admin\CustomerSittingPack;
use App\Model\admin\CustomersittingPackPayment;
use App\Model\admin\sittingPackMakeupService;
use App\Model\admin\sittingPackService;
use DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class Customers extends Controller
{

    public function index()
    {


        $last_record = Customer::orderBy('id', 'desc')->first();
        if ($last_record != '') {
            $last_id = 1 + $last_record->id;
        } else {
            $last_id = 1;
        }

        $churn_date= date('Y-m-d', strtotime("-90 days"));
        $churn_coustomer_count= Customer::where('last_visit_date','<=',$churn_date)->count();

        $defected_date= date('Y-m-d', strtotime("-180 days"));
        $defected_coustomer_count= Customer::where('last_visit_date','<=',$defected_date)->count();

        // $churn_date= date('Y-m-d', strtotime("-90 days"));
        $active_coustomer_count= Customer::where('last_visit_date','>=',$defected_date)->count();

        // echo $defected_coustomer_count;
        // die;

        // die;

        $customer = Customer::select('customers.id', 'customers.name', 'customers.email', 'customers.contact', 'customers.total_revenue','customers.avg_revenue', 'customers.total_visit', 'customers.last_visit_date', DB::raw('SUM(points_allow-used_points) AS sum_of_points'))
            ->leftJoin('customer_points AS CP', 'CP.customer_id', '=', 'customers.id')
            ->groupBy('customers.id', 'customers.name', 'customers.email', 'customers.contact', 'customers.total_revenue', 'customers.total_visit', 'customers.last_visit_date','customers.avg_revenue')
            ->paginate(20);

        $location = Location::all();
        $designation = Designation::all();
        $coupons = Coupon::all();
        $ref_offs = Offer::all();
        $Member_Systems = MemberSystem::all();
        $sittingPacks = sittingPack::all();
        $this->exportCustomerExcel($customer);
        return view('customer.customers', compact('customer','churn_coustomer_count','defected_coustomer_count','active_coustomer_count', 'last_id', 'location', 'designation', 'coupons','ref_offs', 'Member_Systems', 'sittingPacks'));
    }

    public function All_inactive_Customer($active_days){
        $last_active_date= date('Y-m-d', strtotime("-".$active_days." days"));
        $churn_coustomers= Customer::where('last_visit_date','<=',$last_active_date)->get();
        return view('customer.inactive_chrum', compact('churn_coustomers'));
    }

    public function filterCustomer(Request $request)
    {
        // print_r($request->all());
        // die;
        // $searchType = $request->searchType;
        $cid = array();



        $data['html'] = '';
        $getCustomer = DB::table('customers');
        if (!empty($request->visitFrom) && isset($request->visitFrom)) {
            $visitFrom = str_replace('/', '-', $request->visitFrom);
            $visitFrom = date('Y-m-d', strtotime($visitFrom));
            $getCustomer->where('created_at', '>=', $visitFrom);
        }
        if (!empty($request->visitTo) && isset($request->visitTo)) {
            $visitTo = str_replace('/', '-', $request->visitTo);
            $visitTo = date('Y-m-d', strtotime($visitTo));
            $getCustomer->where('created_at', '<=', $visitTo);
        }
        if (!empty($request->visitCountFrom) && isset($request->visitCountFrom)) {
            $visitCountFrom = $request->visitCountFrom;
            $getCustomer->where('total_visit', '>=', $visitCountFrom);
        }
        if (!empty($request->visitCountTo) && isset($request->visitCountTo)) {
            $visitCountTo = $request->visitCountTo;
            $getCustomer->where('total_visit', '<=', $visitCountTo);
        }
        if (!empty($request->amountFilter) && isset($request->amountFilter)) {
            $amountFilter = $request->amountFilter;

            $getCustomer->where('avg_revenue', '>=', $amountFilter);
        }
        if (!empty($request->locationfltr) && isset($request->locationfltr)) {
            $locationfltr = $request->locationfltr;
            $getCustomer->where('location', '=', $locationfltr);
        }
        if (!empty($request->designationfltr) && isset($request->designationfltr)) {
            $designationfltr = $request->designationfltr;
            $getCustomer->where('designation', '=', $designationfltr);
        }
        if (!empty($request->mobile) && isset($request->mobile)) {
            $mobile = $request->mobile;
            $getCustomer->where('contact', '=', $mobile);
        }

        if (!empty($request->assign_offer) && isset($request->assign_offer)) {
            $assign_offer = $request->assign_offer;
            $customer = CustomerOffer::pluck('customer_id');
            $c_customer = CustomerCoupon::pluck('customer_id');
            if(count($customer)>0){
                if($assign_offer==1){
                    $getCustomer->whereNotIn('id', $customer);
                }elseif($assign_offer==2){
                    $getCustomer->whereIn('id', $customer);
                }
            }

            if(count($c_customer)>0){
                if($assign_offer==3){
                    $getCustomer->whereNotIn('id', $c_customer);
                }elseif($assign_offer==4){
                    $getCustomer->whereIn('id', $c_customer);
                }
            }

        }

        $search = $getCustomer->get();


        if (!empty($search)) {
            $this->exportCustomerExcel($search);
            foreach ($search as $value) {
                $getWallet = DB::table('customers AS C')
                    ->addSelect(DB::raw('SUM(amount_allow-amount_used) AS sum_of_wallet'))
                    ->leftJoin('customer_wallet AS CW', 'CW.customer_id', '=', 'C.id')
                    ->where('C.contact', $value->contact)->first();
                if (!empty($getWallet)) {
                    $cust_Wallet = $getWallet->sum_of_wallet;
                } else {
                    $cust_Wallet = 0;
                }

                // fetch gift points
                $getPoints = DB::table('customers AS C')
                    ->addSelect(DB::raw('SUM(points_allow-used_points) AS sum_of_points'))
                    ->leftJoin('customer_points AS CP', 'CP.customer_id', '=', 'C.id')
                    ->where('C.contact', $value->contact)->first();
                if (!empty($getPoints)) {
                    $cust_Points = $getPoints->sum_of_points;
                }
                $data['html'] .= '<tr>
	                                <td>' . $value->name . '</td>
	                                <td>' . $value->email . ' <br> ' . $value->contact . '</td>
	                                <td>' . $value->total_revenue . '</td>
	                                <td>' . $value->avg_revenue . '</td>';
                                    $data['html'] .='<td>';
                                    $data['html'] .= "<a target='_blank' href='".route("cust_all_invoices",$value->id)."'>".$value->total_visit."</a>";
                                    $data['html'] .= '</td>';
                if ($value->last_visit_date != 0) {
                    $data['html'] .= '<td>' . date('d-M-Y', strtotime($value->last_visit_date)) . '</td>';
                } else {
                    $data['html'] .= '<td>---</td>';
                }

                $data['html'] .= '<td><a onclick="showcustcoupons(' . $value->id . ')" href="javascript:void(0)">Show Coupon </a></td>
                                <td><a onclick="showcust_referrel_offer(' . $value->id . ')" href="javascript:void(0)">Show Ref Offer</a></td>
									<td>' . $cust_Points . '</td>
									<td>' . $cust_Wallet . '</td>
	                                <td>
	                                  <div class="form-group form-check">
	                                    <input name="customer_id[]" class="form-check-input deletecheckbox" type="checkbox" value="' . $value->id . '">
	                                  </div>
	                                </td>
									<td>
										<div class="form-group form-check">
											<button type="button" class="theme-btn" onclick="get_cust_data(' . $value->contact . ')"><i class="fa fa-pencil-square-o"></i></button>
                                            <a class="theme-btn mt-1" href="'.route('cust_all_invoices',$value->id).'" style="padding: 6px 9px 5px 9px">All Invoice</a>
										</div>
									</td>
	                            </tr>';
            }
        } else {
            $data['html'] .= '<tr>
                                <td colspan="6" class="text-center">No result found</td>
                            </tr>';
        }

        echo json_encode($data);
    }

    public function filterSitpackCustomer(Request $request)
    {
        $data['html'] = '';
        if (!empty($request->SittingPackfltr) && isset($request->SittingPackfltr)) {
            $SittingPackfltr = str_replace('/', '-', $request->SittingPackfltr);
            $getAllPacks = DB::table('customer_sitting_pack')
                ->select('customer_sitting_pack.id as CSP_id','customer_sitting_pack.*','customers.*')
                ->leftJoin('customers', 'customer_sitting_pack.customer_id', '=', 'customers.id')
                ->where('sittingpack_id', '=', $SittingPackfltr)->get();
            // print_r($getAllPacks);
            // die;
            foreach ($getAllPacks as $packvalue) {
                if (!empty($getAllPacks)) {
                    $this->exportCustomerExcel($getAllPacks);
                    $getWallet = DB::table('customers AS C')
                        ->addSelect(DB::raw('SUM(amount_allow-amount_used) AS sum_of_wallet'))
                        ->leftJoin('customer_wallet AS CW', 'CW.customer_id', '=', 'C.id')
                        ->where('C.contact', $packvalue->contact)->first();
                    if (!empty($getWallet)) {
                        $cust_Wallet = $getWallet->sum_of_wallet;
                    } else {
                        $cust_Wallet = 0;
                    }
                    // fetch gift points
                    $getPoints = DB::table('customers AS C')
                        ->addSelect(DB::raw('SUM(points_allow-used_points) AS sum_of_points'))
                        ->leftJoin('customer_points AS CP', 'CP.customer_id', '=', 'C.id')
                        ->where('C.contact', $packvalue->contact)->first();
                    if (!empty($getPoints)) {
                        $cust_Points = $getPoints->sum_of_points;
                    }
                    $data['html'] .= '<tr>
	                                <td>' . $packvalue->name . '</td>
	                                <td>' . $packvalue->email . ' <br> ' . $packvalue->contact . '</td>
	                                <td>' . $packvalue->total_revenue . '</td>
	                                <td>' . $packvalue->avg_revenue . '</td>
	                                <td>' . $packvalue->total_visit . '</td>';
                    if ($packvalue->last_visit_date != 0) {
                        $data['html'] .= '<td>' . date('d-M-Y', strtotime($packvalue->last_visit_date)) . '</td>';
                    } else {
                        $data['html'] .= '<td>---</td>';
                    }

                    $data['html'] .= '<td><a onclick="showcustcoupons(' . $packvalue->id . ')" href="javascript:void(0)">Show Coupon</a></td>
                                        <td><a onclick="showcust_referrel_offer(' . $packvalue->id . ')" href="javascript:void(0)">Show Ref Offer</a></td>
									<td>' . $cust_Points . '</td>
									<td>' . $cust_Wallet . '</td>
	                                <td>
	                                  <div class="form-group form-check">
	                                    <input name="customer_id[]" class="form-check-input deletecheckbox" type="checkbox" value="' . $packvalue->id . '">
	                                  </div>
	                                </td>
									<td>
										<div class="form-group form-check">
											<button type="button" class="theme-btn" onclick="get_cust_data(' . $packvalue->contact . ')" style="padding: 6px 9px 5px 9px"><i class="fa fa-pencil-square-o"></i></button>
                                            <a class="theme-btn mt-1" href="'.route('cust_all_invoices',$packvalue->id).'" style="padding: 6px 9px 5px 9px">All Invoice</a>
                                            <button type="button" class="theme-btn mt-2" onclick="get_cust_sitpack(' . $packvalue->CSP_id . ')"><i class="fa fa-eye"></i></button>
										</div>
									</td>
	                            </tr>';

                } else {
                    $data['html'] .= '<tr>
                                <td colspan="6" class="text-center">No result found</td>
                            </tr>';
                }
            }
        }
        echo json_encode($data);
    }

    public function filterMembersysCustomer(Request $request)
    {
        $data['html'] = '';
        if (!empty($request->membersysfltr) && isset($request->membersysfltr)) {
            $membersysfltr = str_replace('/', '-', $request->membersysfltr);
            $getAllPlan = DB::table('customer_member_system')
                ->select('customer_member_system.id as CMS_id','customer_member_system.*','customers.*')
                ->leftJoin('customers', 'customer_member_system.customer_id', '=', 'customers.id')
                ->where('member_sys_id', '=', $membersysfltr)->get();
                // print_r($getAllPlan);
                // die;
            foreach ($getAllPlan as $packvalue) {
                if (!empty($getAllPlan)) {
                    $this->exportCustomerExcel($getAllPlan);
                    $getWallet = DB::table('customers AS C')
                        ->addSelect(DB::raw('SUM(amount_allow-amount_used) AS sum_of_wallet'))
                        ->leftJoin('customer_wallet AS CW', 'CW.customer_id', '=', 'C.id')
                        ->where('C.contact', $packvalue->contact)->first();
                    if (!empty($getWallet)) {
                        $cust_Wallet = $getWallet->sum_of_wallet;
                    } else {
                        $cust_Wallet = 0;
                    }
                    // fetch gift points
                    $getPoints = DB::table('customers AS C')
                        ->addSelect(DB::raw('SUM(points_allow-used_points) AS sum_of_points'))
                        ->leftJoin('customer_points AS CP', 'CP.customer_id', '=', 'C.id')
                        ->where('C.contact', $packvalue->contact)->first();
                    if (!empty($getPoints)) {
                        $cust_Points = $getPoints->sum_of_points;
                    }
                    $data['html'] .= '<tr>
	                                <td>' . $packvalue->name . '</td>
	                                <td>' . $packvalue->email . ' <br> ' . $packvalue->contact . '</td>
	                                <td>' . $packvalue->total_revenue . '</td>
                                    <td>' . $packvalue->avg_revenue . '</td>';
                                    $data['html'] .='<td>';
                                    $data['html'] .= "<a target='_blank' href='".route("cust_all_invoices",$packvalue->id)."'>".$packvalue->total_visit."</a>";
                                    $data['html'] .= '</td>';
                    if ($packvalue->last_visit_date != 0) {
                        $data['html'] .= '<td>' . date('d-M-Y', strtotime($packvalue->last_visit_date)) . '</td>';
                    } else {
                        $data['html'] .= '<td>---</td>';
                    }

                    $data['html'] .= '<td><a onclick="showcustcoupons(' . $packvalue->id . ')" href="javascript:void(0)">Show Coupon</a></td>
                                        <td><a onclick="showcust_referrel_offer(' . $packvalue->id . ')" href="javascript:void(0)">Show Ref Offer</a></td>
									<td>' . $cust_Points . '</td>
									<td>' . $cust_Wallet . '</td>
	                                <td>
	                                  <div class="form-group form-check">
	                                    <input name="customer_id[]" class="form-check-input deletecheckbox" type="checkbox" value="' . $packvalue->id . '">
	                                  </div>
	                                </td>
									<td>
										<div class="form-group form-check">
											<button type="button" class="theme-btn" onclick="get_cust_data(' . $packvalue->contact . ')" style="padding: 6px 9px 5px 9px"><i class="fa fa-pencil-square-o"></i></button>
                                            <button type="button" class="theme-btn mt-2" onclick="get_cust_memsys(' . $packvalue->CMS_id . ')"><i class="fa fa-eye"></i></button>
										</div>
									</td>
	                            </tr>';

                } else {
                    $data['html'] .= '<tr>
                                <td colspan="6" class="text-center">No result found</td>
                            </tr>';
                }
            }
        }
        echo json_encode($data);
    }

    public function exportCustomerExcel($data)
    {
        Excel::store(new CustomerExport($data),  'CustomerReport.xls');
    }

    public function DownloadCustExcelFile()
    {
        $file = storage_path('app/CustomerReport.xls');
        return response()->download($file);
    }

    public function downloadInactiveCustExcelFile($active_days)
    {
        $last_active_date= date('Y-m-d', strtotime("-".$active_days." days"));
        $churn_coustomers= Customer::where('last_visit_date','<=',$last_active_date)->get();
        Excel::store(new InactivecustomerExport($churn_coustomers),  'InactiveCustomerReport.xls');
        $file = storage_path('app/InactiveCustomerReport.xls');
        return response()->download($file);
    }

    public function downloadAssignedCouponCustExcelFile(Request $request)
    {



        $coupon_name = $request->coupon_name;

        if(in_array('all',$coupon_name)){
            $getAllPacks = DB::table('customer_coupon')
            ->select('customer_coupon.id as CSP_id','customer_coupon.*','customers.*')
            ->leftJoin('customers', 'customer_coupon.customer_id', '=', 'customers.id')
            ->get();
        }else{
            $getAllPacks = DB::table('customer_coupon')
            ->select('customer_coupon.id as CSP_id','customer_coupon.*','customers.*')
            ->leftJoin('customers', 'customer_coupon.customer_id', '=', 'customers.id')
            ->whereIn('coupon_id',$coupon_name)
            ->get();
        }

        Excel::store(new AssignedCouponExport($getAllPacks),  'AssignedCouponReport.xls');
        $file = storage_path('app/AssignedCouponReport.xls');
        return response()->download($file);
    }

    public function downloadAssignedrefCustExcelFile(Request $request)
    {


        $offer_name = $request->offer_name;

        if(in_array('all',$offer_name)){
            $getAllPacks = DB::table('customer_offer')
            ->select('customer_offer.id as CSP_id','customer_offer.*','customers.*')
            ->leftJoin('customers', 'customer_offer.customer_id', '=', 'customers.id')
            ->get();
        }else{
            $getAllPacks = DB::table('customer_offer')
            ->select('customer_offer.id as CSP_id','customer_offer.*','customers.*')
            ->leftJoin('customers', 'customer_offer.customer_id', '=', 'customers.id')
            ->whereIn('offer_id',$offer_name)
            ->get();
        }

        Excel::store(new AssignedRefExport($getAllPacks),  'AssignedrefReport.xls');
        $file = storage_path('app/AssignedrefReport.xls');
        return response()->download($file);
    }

    public function getCustomerByLatter(Request $request)
    {

        $latter = $request->latter;
        $data['html'] = '';
        $data['customerCount'] = 0;
        if (!empty($latter) && $latter != 'All') {
            $getCustomer = DB::table('customers')->where('name', 'LIKE', "%{$latter}%")->get();
            if (!empty($getCustomer)) {
                $this->exportCustomerExcel($getCustomer);
                $data['customerCount'] = count($getCustomer);
                foreach ($getCustomer as $value) {
                    $getWallet = DB::table('customers AS C')
                        ->addSelect(DB::raw('SUM(amount_allow-amount_used) AS sum_of_wallet'))
                        ->leftJoin('customer_wallet AS CW', 'CW.customer_id', '=', 'C.id')
                        ->where('C.contact', $value->contact)->first();
                    if (!empty($getWallet)) {
                        $cust_Wallet = $getWallet->sum_of_wallet;
                    } else {
                        $cust_Wallet = 0;
                    }

                    // fetch gift points
                    $getPoints = DB::table('customers AS C')
                        ->addSelect(DB::raw('SUM(points_allow-used_points) AS sum_of_points'))
                        ->leftJoin('customer_points AS CP', 'CP.customer_id', '=', 'C.id')
                        ->where('C.contact', $value->contact)->first();
                    if (!empty($getPoints)) {
                        $cust_Points = $getPoints->sum_of_points;
                    }
                    $data['html'] .= '<tr>
		                                <td>' . $value->name . '</td>
		                                <td>' . $value->email . ' <br> ' . $value->contact . '</td>
		                                <td>' . $value->total_revenue . '</td>
		                                <td>' . $value->avg_revenue . '</td>';
                                        $data['html'] .='<td>';
                                        $data['html'] .= "<a target='_blank' href='".route("cust_all_invoices",$value->id)."'>".$value->total_visit."</a>";
                                        $data['html'] .= '</td>';
                    if ($value->last_visit_date != 0) {
                        $data['html'] .= '<td>' . date('d-M-Y', strtotime($value->last_visit_date)) . '</td>';
                    } else {
                        $data['html'] .= '<td>---</td>';
                    }

                    $data['html'] .= '<td><a onclick="showcustcoupons(' . $value->id . ')" href="javascript:void(0)">Show Coupon</a></td>
                                    <td><a onclick="showcust_referrel_offer(' . $value->id . ')" href="javascript:void(0)">Show Ref Offer</a></td>
										<td>' . $cust_Points . '</td>
										<td>' . $cust_Wallet . '</td>
		                                <td>
		                                  <div class="form-group form-check">
		                                    <input name="customer_id[]" class="form-check-input deletecheckbox" type="checkbox" value="' . $value->id . '">
		                                  </div>
		                                </td>
										<td>
											<div class="form-group form-check">
												<button type="button" class="theme-btn" onclick="get_cust_data(' . $value->contact . ')" style="padding: 6px 9px 5px 9px"><i class="fa fa-pencil-square-o"></i></button>
                                                <a class="theme-btn mt-1" href="'.route('cust_all_invoices',$value->id).'" style="padding: 6px 9px 5px 9px">All Invoice</a>
											</div>
										</td>
		                            </tr>';
                }
            } else {
                $data['customerCount'] = 0;
                $data['html'] .= '<tr>
	                                <td colspan="6" class="text-center">No result found</td>
	                            </tr>';
            }
        } else {
            $getCustomer = DB::table('customers')->get();
            if (!empty($getCustomer)) {
                $this->exportCustomerExcel($getCustomer);
                $data['customerCount'] = count($getCustomer);
                foreach ($getCustomer as $value) {
                    $getWallet = DB::table('customers AS C')
                        ->addSelect(DB::raw('SUM(amount_allow-amount_used) AS sum_of_wallet'))
                        ->leftJoin('customer_wallet AS CW', 'CW.customer_id', '=', 'C.id')
                        ->where('C.contact', $value->contact)->first();
                    if (!empty($getWallet)) {
                        $cust_Wallet = $getWallet->sum_of_wallet;
                    } else {
                        $cust_Wallet = 0;
                    }

                    // fetch gift points
                    $getPoints = DB::table('customers AS C')
                        ->addSelect(DB::raw('SUM(points_allow-used_points) AS sum_of_points'))
                        ->leftJoin('customer_points AS CP', 'CP.customer_id', '=', 'C.id')
                        ->where('C.contact', $value->contact)->first();
                    if (!empty($getPoints)) {
                        $cust_Points = $getPoints->sum_of_points;
                    }
                    $data['html'] .= '<tr>
		                                <td>' . $value->name . '</td>
		                                <td>' . $value->email . ' <br> ' . $value->contact . '</td>
		                                <td>' . $value->total_revenue . '</td>
		                                <td>' . $value->avg_revenue . '</td>';
                                        $data['html'] .='<td>';
                                        $data['html'] .= "<a target='_blank' href='".route("cust_all_invoices",$value->id)."'>".$value->total_visit."</a>";
                                        $data['html'] .= '</td>';
                    if ($value->last_visit_date != 0) {
                        $data['html'] .= '<td>' . date('d-M-Y', strtotime($value->last_visit_date)) . '</td>';
                    } else {
                        $data['html'] .= '<td>---</td>';
                    }

                    $data['html'] .= '<td><a onclick="showcustcoupons(' . $value->id . ')" href="javascript:void(0)">Show Coupon</a></td>
                    <td><a onclick="showcust_referrel_offer(' . $value->id . ')" href="javascript:void(0)">Show Ref Offer</a></td>
										<td>' . $cust_Points . '</td>
										<td>' . $cust_Wallet . '</td>
		                                <td>
		                                  <div class="form-group form-check">
		                                    <input name="customer_id[]" class="form-check-input deletecheckbox" type="checkbox" value="' . $value->id . '">
		                                  </div>
		                                </td>
										<td>
											<div class="form-group form-check">
												<button type="button" class="theme-btn" onclick="get_cust_data(' . $value->contact . ')" style="padding: 6px 9px 5px 9px"><i class="fa fa-pencil-square-o"></i></button>
                                                <a class="theme-btn mt-1" href="'.route('cust_all_invoices',$value->id).'" style="padding: 6px 9px 5px 9px">All Invoice</a>
											</div>
										</td>
		                            </tr>';
                }
            } else {
                $data['customerCount'] = 0;
                $data['html'] .= '<tr>
	                                <td colspan="6" class="text-center">No result found</td>
	                            </tr>';
            }
        }
        echo json_encode($data);
    }

    public function getCustomerByNameMobile(Request $request)
    {
        $filter_param = $request->filter_param;
        $data['html'] = '';
        $data['customerCount'] = 0;
        if (!empty($filter_param)) {
            $getCustomer = DB::table('customers')->where('name', 'LIKE', "%{$filter_param}%")->orWhere('contact', 'LIKE', "%{$filter_param}%")->get();
            if (!empty($getCustomer)) {
                $this->exportCustomerExcel($getCustomer);
                $data['customerCount'] = count($getCustomer);
                foreach ($getCustomer as $value) {
                    // fetch wallet data
                    $getWallet = DB::table('customers AS C')
                        ->addSelect(DB::raw('SUM(amount_allow-amount_used) AS sum_of_wallet'))
                        ->leftJoin('customer_wallet AS CW', 'CW.customer_id', '=', 'C.id')
                        ->where('C.contact', $value->contact)->first();
                    if (!empty($getWallet)) {
                        $cust_Wallet = $getWallet->sum_of_wallet;
                    } else {
                        $cust_Wallet = 0;
                    }

                    // fetch gift points
                    $getPoints = DB::table('customers AS C')
                        ->addSelect(DB::raw('SUM(points_allow-used_points) AS sum_of_points'))
                        ->leftJoin('customer_points AS CP', 'CP.customer_id', '=', 'C.id')
                        ->where('C.contact', $value->contact)->first();
                    if (!empty($getPoints)) {
                        $cust_Points = $getPoints->sum_of_points;
                    }


                    $data['html'] .= '<tr>
		                                <td>' . $value->name . '</td>
		                                <td>' . $value->email . ' <br> ' . $value->contact . '</td>
		                                <td>' . $value->total_revenue . '</td>
		                                <td>' . $value->avg_revenue . '</td>';
                                        $data['html'] .='<td>';
                                        $data['html'] .= "<a target='_blank' href='".route("cust_all_invoices",$value->id)."'>".$value->total_visit."</a>";
                                        $data['html'] .= '</td>';
                    if ($value->last_visit_date != 0) {
                        $data['html'] .= '<td>' . date('d-M-Y', strtotime($value->last_visit_date)) . '</td>';
                    } else {
                        $data['html'] .= '<td>---</td>';
                    }

                    $data['html'] .= '  <td><a onclick="showcustcoupons(' . $value->id . ')" href="javascript:void(0)">Show Coupon</a></td>
                    <td><a onclick="showcust_referrel_offer(' . $value->id . ')" href="javascript:void(0)">Show Ref Offer</a></td>
										<td>' . $cust_Points . '</td>
										<td>' . $cust_Wallet . '</td>
		                                <td>
		                                  <div class="form-group form-check">
		                                    <input name="customer_id[]" class="form-check-input deletecheckbox" type="checkbox" value="' . $value->id . '">
		                                  </div>
		                                </td>
										<td>
											<div class="form-group form-check">
												<button type="button" class="theme-btn" onclick="get_cust_data(' . $value->contact . ')" style="padding: 6px 9px 5px 9px"><i class="fa fa-pencil-square-o"></i></button>
                                                <a class="theme-btn mt-1" href="'.route('cust_all_invoices',$value->id).'" style="padding: 6px 9px 5px 9px">All Invoice</a>
											</div>
										</td>
		                            </tr>';
                }
            } else {
                $data['customerCount'] = 0;
                $data['html'] .= '<tr>
	                                <td colspan="6" class="text-center">No result found</td>
	                            </tr>';
            }
        }
        echo json_encode($data);
    }

    public function deleteCustomer(Request $request)
    {
        $data['html'] = '';
        $data['customerCount'] = 0;
        $ids = $request->id;
        foreach ($ids as $id) {
            $customer = customer::find($id);
            $customer->delete();
        }
        $getCustomer = DB::table('customers')->get();
        if (!empty($getCustomer)) {
            $data['customerCount'] = count($getCustomer);
            foreach ($getCustomer as $value) {
                $data['html'] .= '<tr>
	                                <td>' . $value->name . '</td>
	                                <td>' . $value->email . ' <br> ' . $value->contact . '</td>
	                                <td>' . $value->total_revenue . '</td>
	                                <td>' . $value->avg_revenue . '</td>';
                                    $data['html'] .='<td>';
                                    $data['html'] .= "<a target='_blank' href='".route("cust_all_invoices",$value->id)."'>".$value->total_visit."</a>";
                                    $data['html'] .= '</td>';
                if ($value->last_visit_date != 0) {
                    $data['html'] .= '<td>' . date('d-M-Y', strtotime($value->last_visit_date)) . '</td>';
                } else {
                    $data['html'] .= '<td>---</td>';
                }

                $data['html'] .= '
	                                <td>
	                                  <div class="form-group form-check">
	                                    <input name="customer_id[]" class="form-check-input deletecheckbox" type="checkbox" value="' . $value->id . '">
	                                  </div>
	                                </td>
	                            </tr>';
            }
        } else {
            $data['customerCount'] = 0;
            $data['html'] .= '<tr>
                                <td colspan="6" class="text-center">No result found</td>
                            </tr>';
        }
        echo json_encode($data);
    }


    public function resendotp(Request $request){
        $number = $request->number;
        $customer = Customer::where('contact',$number)->orderBy('id','Desc')->first();
        if($customer!=''){
            $otp = $customer->verify_otp;
            $message='Hi ! We are so excited to have you in Chinnie & Vinnie Salon. Please share ' . $otp . ' to register yourself with us.';
            Helper::sendMobileSMS($number, $message);
            $status = 1;
        }else{
            $status = 0;
        }

        echo  $status;
    }

    public function sendotp(Request $request)
    {
        // print_r($request->all());
        // die;
        $number = $request->number;
        $getcustdata = DB::table('customers AS C')->where('C.contact', $number)->first();
        $usedfor= $request->usedfor;
        $deduct_amt= $request->deduct_amt;
        $pending_amt= $request->pending_amt;
        $wallet_amount=$request->wallet_amount;
        $more_gift_points=$request->more_gift_points;
        $deduct_point=$request->deduct_point;
        $pending_point=$request->pending_point;
        $otp = $this->generate(4);
        $message = urlencode($otp . " OTP for registration ");
        $checkcode = DB::table('user_otp')->select('*')->where('contact', '=', $number)->count();
        if ($checkcode == 0) {

            DB::insert('insert into user_otp (contact, otp) VALUES (?, ?)', [$number, $otp]);
        } else {

            DB::update('update user_otp set otp = ? WHERE contact = ?', [$otp, $number]);
        }
       if ($usedfor=='giftpoint') {
        $message='Hi ' . $getcustdata->name . ' ! Please share ' . $otp . ' OTP to redeem your CV Salon Points.';
        Helper::sendMobileSMS($number, $message);
        // echo $message;
       }
       elseif ($usedfor=='walletotp') {
        $message='Hi ' . $getcustdata->name . ' ! Please share ' . $otp . ' OTP to redeem your CV Salon wallet balance.';
       }
       elseif (isset($deduct_amt)) {
        $message='Hi ' . $getcustdata->name . ' ! Rs ' . $deduct_amt . ' wallet balance have been deducted from your CV Salon account, Your total remaining wallet balance is ' . $pending_amt . ' You can redeem your remaining wallet balance in your next bill. Please call 07614923091-Immediately if not used by you.';
       }
       elseif (isset($deduct_point)) {
           $message='Hi ' . $getcustdata->name . ' ! ' . $deduct_point . ' points have been deducted from your CV Salon account, Your total remaining points are ' . $pending_point . ' You can redeem your remaining points in your next bill. Please call 07614923091-Immediately if not used by you.';
       }
       elseif ($usedfor=='addwallet') {
            $getWallet = DB::table('customers AS C')
            ->addSelect(DB::raw('SUM(amount_allow-amount_used) AS sum_of_wallet'))
            ->leftJoin('customer_wallet AS CW', 'CW.customer_id', '=', 'C.id')
            ->where('C.contact', $number)->first();
            $cust_Wallet = json_encode($getWallet->sum_of_wallet);
           $message='Hi ' . $getcustdata->name . ' ! Rs ' . $wallet_amount . ' wallet balance have been added to your CV Salon account, Your total wallet balance is ' . $cust_Wallet . ' You can redeem your remaining wallet balance in your next bill.';
       }
       elseif ($usedfor=='add_gift_points') {
        $getPoints = DB::table('customers AS C')
        ->addSelect(DB::raw('SUM(points_allow-used_points) AS sum_of_points'))
        ->leftJoin('customer_points AS CP', 'CP.customer_id', '=', 'C.id')
        ->where('C.contact', $number)->first();
        $cust_Points = json_encode($getPoints->sum_of_points);
        // $cust_Points1= ((float)$cust_Points + (float)$more_gift_points);
        $message='Hi ' . $getcustdata->name . ' ! ' . $more_gift_points . ' points have been added to your CV Salon account, Your total points are ' . $cust_Points . ' You can redeem your remaining points in your next bill.';
       }
       elseif ($usedfor=='new_cust') {
        // $message='Hi ! We`re so excited to have you in Chinnie & Vinnie Salon. Please share ' . $otp . ' to register yourself with us.';
        $message='Hi ! We are so excited to have you in Chinnie & Vinnie Salon. Please share ' . $otp . ' to register yourself with us.';
       }
        // $message = 'Your OTP is ' . $otp . '.VND Ventures Pvt. Ltd.';
        Helper::sendMobileSMS($number, $message);
        echo $otp;
    }

    public function checkotp(Request $request)
    {

        $number = $request->number;
        $otp = $request->otp;
        $checkcode = DB::table('user_otp')->select('*')->where('contact', '=', $number)->where('otp', '=', $otp)->count();
        if ($checkcode > 0) {
            echo 'yes';
        } else {
            echo 'no';
        }
    }

    public function checkvalid(Request $request)
    {
        $number = $request->number;
        $otp = $request->otp;
        $checkcode = DB::table('user_otp')->select('*')->where('contact', '=', $number)->where('otp', '=', $otp)->count();
        $checknumber = DB::table('customers')->select('*')->where('contact', '=', $number)->count();
        $row = array();
        if($checknumber>0){
             $row['status'] = 0;
             $row['msg'] = "This mobile number already exist";
        }else if ($checkcode > 0) {
            $row['status'] = 1;
            $row['msg'] = "otp is correct";
        } else {
            $row['status'] = 1;
            $row['msg'] = "This otp is not correct";
        }
        echo json_encode($row);
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

    public function get_filter_details($id){
        // $Cust_sitting_packs = CustomerSittingPack::where('id', $id)->get();
        $Cust_sitting_packs= DB::table('customer_sitting_pack')
                            ->leftJoin('customer_sittingpack_payment AS CSTP', 'CSTP.sittingpack_id', '=', 'customer_sitting_pack.sittingpack_id')
                            ->where('customer_sitting_pack.id', $id)
                            ->get();
        $pack_data = DB::table('sittingpack')
                ->select('SB.brand_name as sbname', 'CS.*', 'sittingpack.*')
                ->leftJoin('sittingpack_service AS CS', 'CS.sittingpack_id', '=', 'sittingpack.id')
                ->leftJoin('service_brands AS SB', 'SB.service_brand_id', '=', 'CS.service_id')
                ->where('CS.sittingpack_id', $Cust_sitting_packs[0]->sittingpack_id)->get();
        // print_r($pack_data);
        // print_r($Cust_sitting_packs);
        // die;
        $service = 1;
        $service_round[] = array();
        foreach ($pack_data as $key => $pack_value) {
            $round = $pack_value->sitting_round;
            $service_round[$round][$service]['round'] = $pack_value->sitting_round;
            $service_round[$round][$service]['sbname'] = $pack_value->sbname;
            $service_round[$round][$service]['brand_id'] = $pack_value->brand_id;
            $service_round[$round][$service]['service_id'] = $pack_value->service_id;
            $service_round[$round][$service]['quantity'] = $pack_value->quantity;
            $service_round[$round][$service]['price'] = $pack_value->price;
            $service_round[$round][$service]['cgst'] = $pack_value->cgst;
            $service_round[$round][$service]['sgst'] = $pack_value->sgst;
            $service_round[$round][$service]['total_price'] = $pack_value->total_price;
            $service += 1;
            // $round=$round+1;
            // $round = $pack_value->sitting_round;
        }
        // print_r(array_filter($service_round));
        // die;
        $service_round = array_filter($service_round);
        return view('customer.filter_detail',compact('pack_data','Cust_sitting_packs','service_round'));
    }

    public function newcheckin(Request $request)
    {
      // print_r($_POST); die;
      // dd('asjdfljasdlf');
       $customer_code = $this->genratecode('customers','customer_code',6);
        $this->validate($request,
          [
            'name'=>'required|unique:customers,name',
            'contact'=>'required',
          ],
          [
            'name.required' => 'Enter customer name',
            'contact.required' => 'Enter customer contact',
          ]
        );
        if ($request->file('image')!=null) {
          $input['image'] = time().'.'.$request->image->getClientOriginalExtension();
          $request->image->move(public_path('images/customer'), $input['image']);
        }else{
          $input['image'] = "";
        }

        if(request('anniversary_date')!=''){
            $anniversary_date = date('Y-m-d',strtotime($request->get('anniversary_date')));
        }else{
            $anniversary_date = null;
        }

        if(request('dob')!=''){
            $dob = date('Y-m-d',strtotime($request->get('dob')));
        }else{
            $dob = null;
        }

        $hashcode = md5($request->get('referral_code'));
        if (!empty($request->get('referred_by'))) {
          $refferuser = DB::table('customers')->where('referral_code', $request->get('referred_by'))->first();
          if(!empty($refferuser)){
            $customer = new customer([
                'admin_id' => 1,
                'customer_id' => $request->get('customer_id'),
                'cust_type' => $request->get('cust_type'),
                'name' => $request->get('name'),
                'customer_image' => $input['image'],
                'location' => $request->get('location'),
                'contact' => $request->get('contact'),
                'other_contact' => $request->get('other_contact'),
                'email' => $request->get('email'),
                'dob' => $dob,
                'referral_code' => $request->get('referral_code'),
                'referral_hash_code' => $hashcode,
                'referred_by' => $request->get('referred_by'),
                'reward_points' => $request->get('reward_points'),
                'anniversary_date' => $anniversary_date,
                'customer_code' => $customer_code,
                'rf_id' => $request->get('rf_id'),
                'remarks' => $request->get('remark'),
                'gender' => $request->get('gender'),
                'designation' => $request->get('designation'),
                'total_visit' => 0,
                'total_revenue' => 0,
                'customer_status' => 1,
                'checkin' => 0,
            ]);
            $customer->save();
            echo json_encode(['msg' => true, 'data' => $customer]);
          }
        }else{
          $customer = new customer([
              'admin_id' => 1,
              'customer_id' => $request->get('customer_id'),
              'cust_type' => $request->get('cust_type'),
              'name' => $request->get('name'),
              'customer_image' => $input['image'],
              'location' => $request->get('location'),
              'contact' => $request->get('contact'),
              'other_contact' => $request->get('other_contact'),
              'email' => $request->get('email'),
              'dob' => $dob,
              'referral_code' => $request->get('referral_code'),
              'referral_hash_code' => $hashcode,
              'referred_by' => "",
              'reward_points' => $request->get('reward_points'),
              'anniversary_date' => $anniversary_date,
              'customer_code' => $customer_code,
              'rf_id' => $request->get('rf_id'),
              'remarks' => $request->get('remark'),
              'gender' => $request->get('gender'),
              'designation' => $request->get('designation'),
              'total_visit' => 0,
              'total_revenue' => 0,
              'customer_status' => 1,
              'checkin' => 0,
          ]);
          $customer->save();
          echo json_encode(['msg' => true, 'data' => $customer]);
        }
    }

    public function genratecode($tablename,$columnname,$digit){
        $code = $this->generate($digit);
        $checkcode =  DB::table($tablename)->select('*')->where($columnname,'=',$code)->count();
        if($checkcode>0){
           $code = $this->genratecode($tablename,$columnname,$digit);
        }
        return $code;
      }

      public function activecheckinstatusupdate(Request $request){
        $cust_id = $request->cust_id;
        $checkcode = DB::table('customers AS C')->select('checkin')->where('C.id', $request->cust_id)->first();
        if($checkcode){
            DB::update('update customers set checkin = 1 WHERE id = ?',[$cust_id]);
        }
        echo json_encode(['msg' => true]);
    }

    public function checkinstatusupdate(Request $request){
        $cust_id = $request->cust_id;
        if (isset($cust_id)) {
            DB::update('update customers set checkin = 0 WHERE id = ?',[$cust_id]);
            $getcustdata = DB::table('customers AS C')->where('C.id', $cust_id)->first();
            $number=$getcustdata->contact;
            $link= 'http://chinnievinnie.in/cvsalon/feedback/'.$cust_id;
            $message= 'Hi ' . $getcustdata->name . ' ! Thanks for taking services from Chinnie and Vinnie salon, Hope you enjoyed the services, Please click the link below to share your valuable feedback with us. '.$link;
            Helper::sendMobileSMS($number, $message);
        }
        echo json_encode(['msg' => true]);
    }

    public function checkoutall(Request $request){
        $checkcode =  DB::table('customers')->select('name','id','contact')->where('checkin','=',1)->get();
        foreach ($checkcode as $key => $check_cust) {
            DB::update('update customers set checkin = 0 WHERE id = ?',[$check_cust->id]);
            $number=$check_cust->contact;
            $link= 'http://chinnievinnie.in/cvsalon/feedback/'.$check_cust->id;
            // $message='Hi ' . $getcustdata->name . ' ! Please share ' . $otp . ' OTP to redeem your CV Salon Points.';
            $message= 'Hi ' . $check_cust->name . ' ! Thanks for taking services from Chinnie and Vinnie salon, Hope you enjoyed the services, Please click the link below to share your valuable feedback with us. '.$link;
            Helper::sendMobileSMS($number, $message);
        }
        echo 1;
    }

    public function DownloadAllCustomer()
    {
        return Excel::download(new AllcustomerExport, 'list.xlsx');
    }


    public function filter_Unassigned_ref_offr_Customer(Request $request)
    {
        $data['html'] = '';
        $customer_ids=array();
        if (!empty($request->ref_ofr_fltr) && isset($request->ref_ofr_fltr)) {
            $ref_ofr_fltr = str_replace('/', '-', $request->ref_ofr_fltr);
            $get_assgn_cust = DB::table('customer_offer')->select('customer_offer.customer_id')
                            ->where('offer_id', '=', $ref_ofr_fltr)->get();
            // print_r($get_assgn_cust);
            if (!empty($get_assgn_cust)) {
                foreach ($get_assgn_cust as $key => $value) {
                    $customer_ids[] = $value->customer_id;
                }
                $getAllPacks = DB::table('customers')->select('customers.*')
                ->whereNotIn('id', $customer_ids)->take(100)->get();
            }
            else {
                $getAllPacks = DB::table('customers')->select('customers.*')->take(100)->get();
            }
            foreach ($getAllPacks as $packvalue) {
                if (!empty($getAllPacks)) {
                    $this->exportCustomerExcel($getAllPacks);
                    $getWallet = DB::table('customers AS C')
                        ->addSelect(DB::raw('SUM(amount_allow-amount_used) AS sum_of_wallet'))
                        ->leftJoin('customer_wallet AS CW', 'CW.customer_id', '=', 'C.id')
                        ->where('C.contact', $packvalue->contact)->first();
                    if (!empty($getWallet)) {
                        $cust_Wallet = $getWallet->sum_of_wallet;
                    } else {
                        $cust_Wallet = 0;
                    }
                    // fetch gift points
                    $getPoints = DB::table('customers AS C')
                        ->addSelect(DB::raw('SUM(points_allow-used_points) AS sum_of_points'))
                        ->leftJoin('customer_points AS CP', 'CP.customer_id', '=', 'C.id')
                        ->where('C.contact', $packvalue->contact)->first();
                    if (!empty($getPoints)) {
                        $cust_Points = $getPoints->sum_of_points;
                    }
                    else {
                        $cust_Points = 0;
                    }
                    $data['html'] .= '<tr>
	                                <td>' . $packvalue->name . '</td>
	                                <td>' . $packvalue->email . ' <br> ' . $packvalue->contact . '</td>
	                                <td>' . $packvalue->total_revenue . '</td>
	                                <td>' . $packvalue->avg_revenue . '</td>';
                                    $data['html'] .='<td>';
                                    $data['html'] .= "<a target='_blank' href='".route("cust_all_invoices",$packvalue->id)."'>".$packvalue->total_visit."</a>";
                                    $data['html'] .= '</td>';
                    if ($packvalue->last_visit_date != 0) {
                        $data['html'] .= '<td>' . date('d-M-Y', strtotime($packvalue->last_visit_date)) . '</td>';
                    } else {
                        $data['html'] .= '<td>---</td>';
                    }

                    $data['html'] .= '<td><a onclick="showcustcoupons(' . $packvalue->id . ')" href="javascript:void(0)">Show Coupon</a></td>
                                        <td><a onclick="showcust_referrel_offer(' . $packvalue->id . ')" href="javascript:void(0)">Show Ref Offer</a></td>
									<td>' . $cust_Points . '</td>
									<td>' . $cust_Wallet . '</td>
	                                <td>
	                                  <div class="form-group form-check">
	                                    <input name="customer_id[]" class="form-check-input deletecheckbox" type="checkbox" value="' . $packvalue->id . '">
	                                  </div>
	                                </td>
									<td>
										<div class="form-group form-check">
											<button type="button" class="theme-btn" onclick="get_cust_data(' . $packvalue->contact . ')" style="padding: 6px 9px 5px 9px"><i class="fa fa-pencil-square-o"></i></button>
                                            <a class="theme-btn mt-1" href="'.route('cust_all_invoices',$packvalue->id).'" style="padding: 6px 9px 5px 9px">All Invoice</a>
										</div>
									</td>
	                            </tr>';

                } else {
                    $data['html'] .= '<tr>
                                <td colspan="6" class="text-center">No result found</td>
                            </tr>';
                }
            }
        }
        echo json_encode($data);
    }

    //----------------------ENd Class
}
