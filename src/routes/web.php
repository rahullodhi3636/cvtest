<?php
use Carbon\Carbon;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

// Route::get('feedback', 'FeedbackController');
Route::get('my_invoice/{id}', 'FeedbackController@myinvoice')->name('myinvoice');
Route::get('feedback/{customer_id}', 'FeedbackController@index');
Route::get('parallel_screen', 'FrontController@parallel_screen');
Route::post('parallel_popupdata', 'FrontController@parallel_popupdata');
Route::resource('feedback', 'FeedbackController');
Route::get('/', function () {
    return view('auth.login');
});
Route::get('/clearcache', function () {
	\Illuminate\Support\Facades\Artisan::call('config:cache');
	\Illuminate\Support\Facades\Artisan::call('cache:clear');
	\Illuminate\Support\Facades\Artisan::call('route:clear');
	\Illuminate\Support\Facades\Artisan::call('config:clear');
	return ['success'=>true,'message'=>'Cleared'];
	});
//Route::get('/signup/{name?}', 'FrontController@signup');
Route::post('registerCustomer', 'FrontController@registerCustomer');


Route::group(['middleware' => 'usersession'], function () {

});

Auth::routes();
Route::group(['middleware' => ['web','auth']],function(){
	Route::get('/home',function(){
		if(Auth::user()->admin==0){
			// Auth::logout();
            /*return redirect('/login');*/
            // $users['today_birthday'] = \App\Model\admin\Customer::where('dob',date('m-d'))->get();
            // $users['total_customer'] = \App\Model\admin\Customer::count();
            // $users['today_collection'] = \App\Model\admin\Collection::where('transaction_date',date('Y-m-d'))->count();
			// $users['total_enquery'] = \App\Model\admin\Enquiry::count();
			// $users['total_package'] = \App\Model\admin\Packages::where('package_satus','1')->count();
			// $users['total_services'] = \App\Model\admin\Services::where('status','1')->count();
			// $users['customer'] = \App\Model\admin\Customer::orderBy('id','DESC')->take(5)->get();
			// $users['enquiry'] = \App\Model\admin\Enquiry::orderBy('id','DESC')->take(5)->get();
            // return view('staff.dashboard',$users);
        }
        // elseif(Auth::user()->admin==1){
		// 	$users['today_collection'] = \App\Model\admin\Collection::where('transaction_date',date('Y-m-d'))->count();
		// 	$users['total_customer'] = \App\Model\admin\Customer::count();
		// 	$users['total_enquery'] = \App\Model\admin\Enquiry::count();
		// 	$users['total_package'] = \App\Model\admin\Packages::where('package_satus','1')->count();
		// 	$users['total_services'] = \App\Model\admin\Services::where('status','1')->count();
		// 	$users['customer'] = \App\Model\admin\Customer::orderBy('id','DESC')->take(5)->get();
		// 	// $users['today_birthday'] = \App\Model\admin\Customer::where('dob',date('m-d'))->get();
		// 	// $users['today_birthday'] = \App\Model\admin\Customer::whereDate('dob', '=', Carbon::today()->toDateString())->toSql();
		// 	// dd($users['today_birthday']); die();
		// 	$users['enquiry'] = \App\Model\admin\Enquiry::orderBy('id','DESC')->take(5)->get();

		// 	return view('admin.dashboard',$users);
		// }
	 });



Route::resource('admin/change_password', 'admin\ChangepasswordController');
Route::resource('admin/reports', 'admin\TransactionReportController');
Route::post('admin/showReport', 'admin\TransactionReportController@showReport')->name('showReport');
Route::resource('admin/addtocart', 'admin\AddtocartController');
Route::resource('admin/totalsales', 'admin\TotalsalesController');
Route::resource('admin/brand', 'admin\BrandController');
Route::post('admin/deleteitem', 'admin\AddtocartController@deleteitem')->name('deleteitem');
Route::post('admin/checkout', 'admin\AddtocartController@checkout')->name('checkout');
Route::post('admin/makePayment', 'admin\AddtocartController@makePayment')->name('makePayment');
Route::post('admin/cancelcheckout', 'admin\AddtocartController@cancelcheckout')->name('cancelcheckout');
Route::post('admin/checkoutnow', 'admin\AddtocartController@checkoutnow')->name('checkoutnow');
Route::get('admin/invoice', 'admin\AddtocartController@invoice')->name('invoice');
Route::get('admin/invoice/{id}', 'admin\AddtocartController@invoice')->name('invoice');
Route::get('admin/viewhistory', 'admin\AddtocartController@viewhistory')->name('viewhistory');
Route::get('admin/viewhistory/{id}', 'admin\AddtocartController@viewhistory')->name('viewhistory');
Route::get('admin/makePaymentForm', 'admin\AddtocartController@makePaymentForm')->name('makePaymentForm');
Route::get('admin/makePaymentForm/{id}', 'admin\AddtocartController@makePaymentForm')->name('makePaymentForm');
Route::resource('admin/membership', 'admin\MembershipController');
Route::post('getMembership', 'admin\MembershipController@getMembership');
Route::post('updateMembership', 'admin\MembershipController@updateMembership');
Route::post('deleteMemberShip', 'admin\MembershipController@deleteMemberShip');

Route::resource('admin/branches', 'admin\BranchesController');
Route::resource('admin/products', 'admin\ProductController');
Route::any('admin/product_type', 'admin\ProductController@product_type');
Route::any('addproductstype', 'admin\ProductController@addproductstype');
Route::post('getProductById', 'admin\ProductController@getProductById');
Route::post('updateProduct', 'admin\ProductController@updateProduct');
Route::post('deleteProductById', 'admin\ProductController@deleteProductById');
Route::resource('admin/services', 'admin\ServicesController');
Route::get('admin/services_new', 'admin\ServicesController@index_new');
Route::get('admin/subService/{id}/{fid}', 'admin\ServicesController@subService');
Route::get('admin/addBrand/{sid}/{id}', 'admin\ServicesController@addBrand');
Route::get('admin/addBrandRand/{sid}/{id}/{bid}', 'admin\ServicesController@addBrandRand');
Route::post('admin/SaveRange_By_brand', 'admin\ServicesController@SaveRange_By_brand');
Route::post('admin/editRange_By_brand', 'admin\ServicesController@editRange_By_brand');
Route::post('admin/addBrandform', 'admin\ServicesController@addBrandform');
Route::post('addServiceGroup', 'admin\ServicesController@addServiceGroup');
Route::post('addServiceSubCategory', 'admin\ServicesController@addServiceSubCategory');
Route::post('getGroup', 'admin\ServicesController@getGroup');
Route::post('getGroupBrand', 'admin\ServicesController@getGroupBrand');
Route::post('getGroupRang', 'admin\ServicesController@getGroupRang');
Route::post('updateServiceSubCat', 'admin\ServicesController@updateServiceSubCat');
Route::post('updateGroup', 'admin\ServicesController@updateGroup');
Route::post('editServiceSubCat', 'admin\ServicesController@editServiceSubCat');
Route::post('showFirmService', 'admin\ServicesController@showFirmService');
Route::post('showGroupService', 'admin\ServicesController@showGroupService');
Route::post('showServiceBrands', 'admin\ServicesController@showServiceBrands');
Route::post('showServiceBrandsPrice', 'admin\ServicesController@showServiceBrandsPrice');
Route::post('editService', 'admin\ServicesController@editService');
Route::post('updateService', 'admin\ServicesController@updateService');
Route::post('deleteBrand', 'admin\ServicesController@deleteBrand');
Route::post('deletebrandRange', 'admin\ServicesController@deletebrandRange');
Route::post('deleteService', 'admin\ServicesController@deleteService');
Route::get('mainservicesmodal', 'admin\ServicesController@mainservicesmodal') ;
Route::get('admin/mainservices', 'admin\ServicesController@mainservices')->name('mainservices');
Route::get('admin/mainservices/{id}', 'admin\ServicesController@mainservices')->name('mainservices');
Route::get('admin/product', 'admin\ServicesController@products')->name('product');
Route::get('admin/product/{id}', 'admin\ServicesController@products')->name('product');
Route::get('admin/editproduct', 'admin\ServicesController@editproduct')->name('editproduct');
Route::get('admin/editproduct/{id}', 'admin\ServicesController@editproduct')->name('editproduct');
Route::get('admin/createproduct', 'admin\ServicesController@createproduct')->name('createproduct');
Route::get('admin/createproduct/{id}', 'admin\ServicesController@createproduct')->name('createproduct');
Route::post('admin/addproduct', 'admin\ServicesController@addproduct')->name('addproduct');
Route::post('admin/deleteproduct', 'admin\ServicesController@deleteproduct')->name('deleteproduct');
Route::post('admin/updateproduct', 'admin\ServicesController@updateproduct')->name('updateproduct');
Route::resource('admin/enquiry', 'admin\EnquiryController');
Route::resource('admin/enquiry_categories', 'admin\Enquiry_categoriesController');
Route::resource('admin/packages', 'admin\PackagesController');
Route::post('deletePackage', 'admin\PackagesController@deletePackage');
Route::post('getPackageById', 'admin\PackagesController@getPackageById');
Route::post('updatePackage', 'admin\PackagesController@updatePackage');
// Route::resource('customers', 'customer\SearchCustomer');
Route::get('quicksaleByFirm/{id}', 'QuickSaleController@quicksaleByFirm');
Route::resource('quick_sale', 'QuickSaleController');
Route::post('showHistoryVisit', 'QuickSaleController@showHistoryVisit');
Route::post('pushsms', 'QuickSaleController@pushsms');
Route::post('checkaccount', 'QuickSaleController@checkaccount');
Route::post('updateaccount', 'QuickSaleController@updateaccount');
Route::post('getlastid', 'QuickSaleController@getlastid');
Route::post('addaccount', 'QuickSaleController@addaccount');
Route::post('viewservices', 'QuickSaleController@viewservices');
Route::post('getServicePrice', 'QuickSaleController@getServicePrice');
Route::post('getServiceByGroup', 'QuickSaleController@getServiceByGroup');
Route::post('getProductPrice', 'QuickSaleController@getProductPrice');
Route::post('quicksaleInvoice', 'QuickSaleController@quicksaleInvoice');
Route::post('check_estimate', 'QuickSaleController@check_estimate');
Route::post('getUnpaidAmount', 'QuickSaleController@getUnpaidAmount');
Route::get('myinvoice/{id}', 'QuickSaleController@myinvoice')->name('myinvoice');
Route::get('myinvoice_withoutAmount/{id}', 'QuickSaleController@myinvoice_withoutAmount');
Route::get('myinvoiceNew/{id}', 'QuickSaleController@myinvoiceNew');
Route::get('load_location', 'QuickSaleController@load_location');
Route::get('load_designation', 'QuickSaleController@load_designation');
Route::any('qs_saveRemark', 'QuickSaleController@qs_saveRemark');
Route::post('quicksalepopupdata', 'QuickSaleController@quicksalepopupdata');
Route::post('save_invoice', 'QuickSaleController@save_invoice');
// Route::get('QuickSaleControllerstore', 'QuickSaleController@store');
Route::resource('admin/sms', 'admin\Smsmanagementcontroller');
Route::resource('admin/scan', 'admin\ScanrfidController');
Route::resource('admin/firm', 'admin\FirmController');
Route::post('getFirm', 'admin\FirmController@getFirm');
Route::post('updateFirm', 'admin\FirmController@updateFirm');
// Route::resource('search', 'customer\SearchCustomer@search_profile')->name('search_profile');
Route::resource('customers', 'customer\Customers');
Route::post('sendotp', 'customer\Customers@sendotp');
Route::post('resendotp', 'customer\Customers@resendotp');
Route::post('checkotp', 'customer\Customers@checkotp');
Route::post('checkvalid', 'customer\Customers@checkvalid');
// Route::resource('signup', 'customer\Customers@signup');
// Route::resource('signup/{id}', 'customer\Customers@signup');
Route::post('filterCustomer', 'customer\Customers@filterCustomer');
Route::post('getCustomerByLatter', 'customer\Customers@getCustomerByLatter');
Route::post('deleteCustomer', 'customer\Customers@deleteCustomer');
Route::post('findResponce', 'QuickSaleController@findResponce');
Route::resource('admin/customer', 'admin\CustomerController');
Route::resource('admin/staff', 'admin\StaffController');
Route::resource('admin/collection', 'admin\CollectionController');
Route::post('getservices', 'admin\CustomerController@getservices');
Route::post('addremark', 'admin\EnquiryController@addremark');
Route::post('viewremark', 'admin\EnquiryController@viewremark');
Route::post('search_profile', 'customer\SearchCustomer@search_profile')->name('search_profile');
Route::get('customer/getproducts', 'customer\SearchCustomer@getproducts')->name('getproducts');
Route::get('customer/getproducts/{id}', 'customer\SearchCustomer@getproducts')->name('getproducts');
Route::get('customer/viewhistory', 'customer\SearchCustomer@viewhistory')->name('viewhistory');
Route::get('customer/viewhistory/{id}', 'customer\SearchCustomer@viewhistory')->name('viewhistory');
Route::get('customer/delete_transaction', 'customer\SearchCustomer@delete_transaction')->name('delete_transaction');
Route::get('customer/delete_transaction/{id}', 'customer\SearchCustomer@delete_transaction')->name('delete_transaction');
Route::get('customer/delete_transaction/{id}/{cust_id}', 'customer\SearchCustomer@delete_transaction')->name('delete_transaction');
Route::post('edit_profile', 'customer\SearchCustomer@edit_profile')->name('edit_profile');
Route::post('getbrand', 'customer\SearchCustomer@getbrand')->name('getbrand');
Route::post('add_reward', 'customer\SearchCustomer@add_reward')->name('add_reward');
Route::post('otpverify', 'customer\SearchCustomer@otpverify')->name('otpverify');
Route::post('ordernow', 'customer\SearchCustomer@ordernow')->name('ordernow');
Route::post('/cart-add', 'admin\CartController@add')->name('cart.add');
Route::get('/cart-checkout', 'admin\CartController@cart')->name('cart.checkout');
Route::post('/cart-clear', 'admin\CartController@clear')->name('cart.clear');
Route::post('/cart-remove', 'admin\CartController@remove')->name('cart.remove');
// Route::get('genratecode', 'customer\SearchCustomer@genratecode')->name('genratecode');
/*Route::post('genratecode/{table}', 'customer\SearchCustomer@genratecode')->name('genratecode');
Route::post('genratecode/{table}/{column}', 'customer\SearchCustomer@genratecode')->name('genratecode');
Route::post('genratecode/{table}/{column}/{digit}', 'customer\SearchCustomer@genratecode')->name('genratecode');*/
Route::post('uploadUserImage', 'customer\SearchCustomer@uploadUserImage')->name('uploadUserImage');
Route::post('useservice', 'customer\SearchCustomer@useservice')->name('useservice');
Route::get('getOrder', 'customer\SearchCustomer@getOrder')->name('getOrder');
Route::get('getOrder/{packageid}', 'customer\SearchCustomer@getOrder')->name('getOrder');
Route::get('checkusedservice', 'customer\SearchCustomer@checkusedservice')->name('checkusedservice');
Route::get('checkusedservice/{package_service_id}', 'customer\SearchCustomer@checkusedservice')->name('checkusedservice');
Route::get('packageservice', 'customer\SearchCustomer@packageservice')->name('packageservice');
Route::get('packageservice/{packageid}', 'customer\SearchCustomer@packageservice')->name('packageservice');
Route::get('packageservice/{packageid}/{customerid}', 'customer\SearchCustomer@packageservice')->name('packageservice');
Route::get('usepackageservice', 'customer\SearchCustomer@usepackageservice')->name('usepackageservice');
Route::get('usepackageservice/{packageid}', 'customer\SearchCustomer@usepackageservice')->name('usepackageservice');
Route::get('usepackageservice/{packageid}/{customerid}', 'customer\SearchCustomer@usepackageservice')->name('usepackageservice');
Route::get('getServiceDetails', 'customer\SearchCustomer@getServiceDetails')->name('getServiceDetails');
Route::get('getServiceDetails/{packageid}', 'customer\SearchCustomer@getServiceDetails')->name('getServiceDetails');
Route::get('getServiceDetails/{packageid}/{customerid}', 'customer\SearchCustomer@getServiceDetails')->name('getServiceDetails');
Route::get('getServiceDetails/{packageid}/{customerid}/{serviceid}', 'customer\SearchCustomer@getServiceDetails')->name('getServiceDetails');
Route::get('getService', 'customer\SearchCustomer@getService')->name('getService');
Route::get('getService/{serviceid}', 'customer\SearchCustomer@getService')->name('getService');

// Location
Route::resource('admin/location', 'admin\LocationController');
Route::post('getLocation', 'admin\LocationController@getLocation');
Route::post('updateLocation', 'admin\LocationController@updateLocation');

// Designation
Route::resource('admin/designation', 'admin\DesignationController');
Route::post('getDesignation', 'admin\DesignationController@getDesignation');
Route::post('updateDesignation', 'admin\DesignationController@updateDesignation');

//Reports
Route::resource('admin/report', 'admin\ReportController');

Route::post('getBillsByFirm', 'admin\ReportController@getBillsByFirm');
Route::post('get_invoice_details', 'admin\ReportController@getInvoiceDetails');
//Rk service_dashboard
Route::post('getservicesbyfirm', 'admin\ServicesController@getallservices');
Route::post('get_category', 'admin\ServicesController@get_category');
Route::post('get_brands', 'admin\ServicesController@get_brands');
Route::post('get_mainservices', 'admin\ServicesController@get_mainservices');
Route::any('admin/service_dashboard', 'admin\ReportController@service_dashboard');
});
// Export to excel
Route::post('/reportExportExcel','admin\ReportController@exportExcel');
Route::post('/reportserviceExportExcel','admin\ReportController@exportserviceExcel');
Route::get('/DownloadFile','admin\ReportController@DownloadFile')->name('downloadFile');
//Points
Route::resource('admin/point', 'admin\PointsController');
Route::post('getPoint', 'admin\PointsController@getPoint');
Route::post('updatePoint', 'admin\PointsController@updatePoint');
Route::post('getpointsByAmount', 'admin\PointsController@getpointsByAmount');
Route::post('otp_verify_points', 'admin\PointsController@otp_verify_points')->name('otp_verify_points');
Route::get('getpointsofCustomer/{id}', 'admin\PointsController@getpointsofCustomer')->name('getpointsofCustomer');
//wallet
Route::resource('admin/wallet', 'admin\WalletController');
Route::post('add_customer_wallet', 'admin\WalletController@add_customer_wallet');
Route::get('getwalletofCustomer/{id}', 'admin\WalletController@getwalletofCustomer')->name('getwalletofCustomer');

Route::post('delete_invoice', 'admin\ReportController@deleteInvoice');
Route::post('get_point_details', 'admin\PointsController@getPointDetails');
Route::post('update_customerpoint_details', 'admin\PointsController@updateCustomerPointDetails')->name('update_customerpoint_details');

// combo
Route::get('admin/combo', 'admin\SettingController@view_combo')->name('view_combo');
Route::get('addCombo', 'admin\SettingController@add_combo')->name('add_combo');
Route::post('admin/addComboService', 'admin\SettingController@addcombo_service')->name('addcomboservice');
Route::get('getAllCombo', 'admin\SettingController@all_combo_service')->name('allcomboservice');
Route::post('getComboService', 'admin\SettingController@get_combo_service')->name('getcomboservice');

// sitting-Package
Route::resource('admin/SittingPack', 'admin\SittingPackController');
// Route::get('getAllSittingPack', 'admin\SittingPackController@all_sitting_pack')->name('allsittingpack');
Route::post('getSittingPack', 'admin\SittingPackController@getSittingPack');
Route::post('beforeAssignSittingPackdata', 'admin\SittingPackController@beforeAssignSittingPackdata')->name('beforeAssignSittingPackdata');
Route::post('assignSitPackToCustomer', 'admin\SittingPackController@assignSitPackToCustomer')->name('assignSitPackToCustomer');
Route::post('getCustomerSittingPack', 'admin\SittingPackController@customer_sitting_pack')->name('getCustomerSittingPack');
Route::post('save_expiry_date', 'admin\SittingPackController@save_expiry_date')->name('save_expiry_date');
Route::post('getCustSitPackService', 'admin\SittingPackController@get_custpack_service')->name('getCustSitPackService');
Route::post('getSittingPackMemberContacts', 'admin\SittingPackController@getSittingPack_MemberContacts')->name('getSittingPackMemberContacts');
Route::post('send_otp_sit_pack', 'admin\SittingPackController@sendOtpSitPack');
Route::post('sitpack_otp_verify', 'admin\SittingPackController@sitpackOtpVerify');
Route::post('getSittingInstallments', 'admin\SittingPackController@getSittingInstallments');

//member-System
Route::resource('admin/MemberSystem', 'admin\MemberSystemController');
Route::get('getAllmembersys', 'admin\MemberSystemController@all_member_plan');
Route::post('beforeAssignMemberPlandata', 'admin\MemberSystemController@beforeAssignMemberPlandata')->name('beforeAssignMemberPlandata');
Route::post('assignMemberPlanToCustomer', 'admin\MemberSystemController@assignMemberPlan_ToCustomer')->name('assignMemberPlanToCustomer');
Route::post('assignMemberPlan_ToCustomer_by_ajex', 'admin\MemberSystemController@assignMemberPlan_ToCustomer_by_ajex')->name('assignMemberPlan_ToCustomer_by_ajex');
Route::post('getCustomer_membersysplan', 'admin\MemberSystemController@customer_membersys_plan')->name('getCustomer_membersys_plan');
Route::post('getCustomer_membersysplan_expired', 'admin\MemberSystemController@customer_membersys_plan_expired')->name('getCustomer_membersysplan_expired');
Route::post('getCustPlanMemberContacts', 'admin\MemberSystemController@getCustPlan_MemberContacts');
Route::post('send_otp_member_plan', 'admin\MemberSystemController@sendOtpMemberPlan');
Route::post('memberplan_otp_verify', 'admin\MemberSystemController@MemberPlanOtpVerify');
Route::post('memberplan_assign', 'admin\MemberSystemController@get_custplan_details');

//Coupon mgmt
Route::resource('admin/coupon', 'admin\CouponController');
Route::post('assign_coupon', 'admin\CouponController@assign_coupon_to_cust');
Route::post('get_custAllCoupon', 'admin\CouponController@get_custAllCoupon');
Route::post('cust_coupon_bycode', 'admin\CouponController@cust_coupon_bycode');

// Other service in quick sale
Route::post('add_other_service', 'QuickSaleController@addOtherService');
Route::get('mypackinvoice/{id}', 'QuickSaleController@mypackinvoice')->name('mypackinvoice');
Route::post('deleteinvoicebyid', 'QuickSaleController@deleteinvoicebyid')->name('deleteinvoicebyid');

// sitting makeup
Route::post('showFirmServiceForMakeup', 'admin\ServicesController@showFirmServiceForMakeup');
Route::post('showGroupServiceForMakeup', 'admin\ServicesController@showGroupServiceForMakeup');
Route::post('showServiceBrandsForMakeup', 'admin\ServicesController@showServiceBrandsForMakeup');
Route::post('showServiceBrandsPriceForMakeup', 'admin\ServicesController@showServiceBrandsPriceForMakeup');

//calender
Route::get('admin/calender', 'admin\SittingPackController@showCalender')->name('calender');

//campaign
Route::post('getCustomerByNameMobile', 'customer\Customers@getCustomerByNameMobile');
Route::get('/DownloadCustExcelFile','customer\Customers@DownloadCustExcelFile')->name('downloadCustExcelFile');
Route::post('filterSitpackCustomer', 'customer\Customers@filterSitpackCustomer');
Route::post('filterMembersysCustomer', 'customer\Customers@filterMembersysCustomer');
Route::get('get_filter_details/{id}', 'customer\Customers@get_filter_details')->name('get_filter_details');

//referral module
Route::get('referring_customer/{customer_id}', 'ReferralController@index');
Route::resource('referral', 'ReferralController');
Route::resource('admin/offers', 'admin\OfferController');
Route::post('admin/delete_offer_service', 'admin\OfferController@delete_offer_service');
Route::get('offer_dashboard', 'admin\OfferController@dashboard')->name('offers.dashboard');
Route::post('cust_referral_offer_bycode', 'admin\OfferController@cust_referral_offer_bycode');

//staff role module
Route::resource('admin/staff', 'admin\StaffController');
Route::get('staff_roles/{id}', 'admin\StaffController@roles')->name('staff.roles');
Route::get('staff_role_permission/{id}', 'admin\StaffController@role_permission')->name('staff.permission');
Route::post('staff_role_updated', 'admin\StaffController@role_updated')->name('staff.role_update');
Route::get('admin/checkin', 'customer\SearchCustomer@checkin_customer');
Route::get('recent_checkin', 'customer\SearchCustomer@recent_checkin');
Route::post('newcheckin', 'customer\Customers@newcheckin')->name('newcheckin');
Route::post('activecheckinstatusupdate', 'customer\Customers@activecheckinstatusupdate')->name('activecheckinstatusupdate');
Route::post('checkinstatusupdate', 'customer\Customers@checkinstatusupdate')->name('checkinstatusupdate');
Route::get('recent_invoice/{id}', 'QuickSaleController@recent_invoice')->name('recent_invoice');

//dashboard module
Route::get('new_dashboard', 'DashboardController@index')->name('dashboard');
Route::post('enquiry_status_update', 'admin\EnquiryController@status_update');

// feedback module
Route::get('admin/feedback', 'FeedbackController@ShowAll');
Route::post('getFeedbackByRatings', 'FeedbackController@getFeedbackByRatings');
Route::post('add_StaffFeedback', 'FeedbackController@add_StaffFeedback');

// quick sale sitpackediting
Route::post('shownewpackFirmService', 'admin\ServicesController@shownewpackFirmService');
Route::post('shownewpackGroupService', 'admin\ServicesController@shownewpackGroupService');
Route::post('shownewpackServiceBrands', 'admin\ServicesController@shownewpackServiceBrands');

// Route::post('getmakeupServiceByGroup', 'QuickSaleController@getmakeupServiceByGroup');
Route::post('shownewmakeupFirmService', 'admin\ServicesController@shownewmakeupFirmService');
Route::post('shownewmakeupGroupService', 'admin\ServicesController@shownewmakeupGroupService');
Route::post('showmakeupServiceBrandsPrice', 'admin\ServicesController@showmakeupServiceBrandsPrice');

Route::post('assign_coupon_all', 'admin\CouponController@assign_coupon_all');
Route::get('/DownloadAllCustomer','customer\Customers@DownloadAllCustomer')->name('downloadAllCustomer');
Route::post('assign_coupon_toImport', 'admin\CouponController@assign_coupon_toImport');
Route::get('recent_all_checkin', 'customer\SearchCustomer@recent_all_checkin');
Route::get('checkoutall', 'customer\Customers@checkoutall')->name('checkoutall');

Route::post('assign_ref_offer_all', 'admin\OfferController@assign_ref_offer_all');
Route::post('cust_frnd_referral_offer_bycode', 'admin\OfferController@cust_frnd_referral_offer_bycode');

//customers all invoices
Route::get('cust_all_invoices/{id}', 'QuickSaleController@cust_all_invoices')->name('cust_all_invoices');
Route::post('sitpack_pswd_verify', 'admin\SittingPackController@sitpackPswdVerify');
Route::post('invoice_search', 'QuickSaleController@invoice_search')->name('invoice_search');

Route::get('All_inactive_Customer/{days}', 'customer\Customers@All_inactive_Customer')->name('All_inactive_Customer');
Route::get('/downloadInactiveCustExcelFile/{days}','customer\Customers@downloadInactiveCustExcelFile')->name('downloadInactiveCustExcelFile');

Route::post('enquiry_details', 'admin\EnquiryController@enquiry_details');
Route::post('update_details', 'admin\EnquiryController@update_details')->name('update_details');

Route::post('get_custAll_referrel_offer', 'admin\OfferController@get_custAllOffer');
Route::post('sendoffersmstocustomer', 'admin\OfferController@sendoffersmstocustomer');
Route::post('filter_Unassigned_ref_offr_Customer', 'customer\Customers@filter_Unassigned_ref_offr_Customer');
Route::post('/downloadAssignedCouponCustExcelFile','customer\Customers@downloadAssignedCouponCustExcelFile')->name('downloadAssignedCouponCustExcelFile');
Route::post('/downloadAssignedrefCustExcelFile','customer\Customers@downloadAssignedrefCustExcelFile')->name('downloadAssignedrefCustExcelFile');
