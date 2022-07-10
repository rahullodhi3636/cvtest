<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Model\admin\Coupon;
use App\Model\admin\CouponService;
use App\Model\admin\Customer;
use App\Model\admin\CustomerCoupon;
use DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CsvImport;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $Coupon_data = Coupon::all();
            return view('admin.coupon.index', compact('Coupon_data'));
        } catch (\Exception $e) {
            // echo json_encode(['msg' => false]);
            return back()->with('msg', 'something went wrong');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $service_group = DB::table('service_group')->where('parent_id', 0)->get();
            return view('admin.coupon.create', compact('service_group'));
        } catch (\Exception $e) {
            // echo json_encode(['msg' => false]);
            return back()->with('msg', 'something went wrong');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // echo $from = date('Y-m-d', strtotime($request->start_date));
        // print_r($request->all());
        // die;
        // echo "<pre>";
        // print_r($_POST);die;
        // try {
        $serviceRowCount = $request->serviceRowCount;
        $serviceQuantity = $request->serviceQuantity;
        $servicesSgst = $request->servicesSgst;
        $servicesCgst = $request->servicesCgst;
        $servicePrice = $request->servicePrice;
        $serviceTotal = $request->serviceTotal;
        $coupon_data = new Coupon([
            'coupon_title' => $request->Coupon_name,
            'coupon_type' => $request->coupon_type,
            'coupon_discount' => isset($request->coupon_discount) ? ($request->coupon_discount) : 0,
            'coupon_total' => $request->Coupon_total,
            'coupon_price' => $request->Coupon_price,
            'coupon_prefix' => $request->coupon_prefix,
            'coupon_validity' => $request->Coupon_validity,
            'start_date'=>date('Y-m-d', strtotime($request->start_date)),
            'expire_date'=>date('Y-m-d', strtotime($request->expire_date)),
            'allow_count' => $request->allow_count,
            'min_amount' => $request->min_amount,
            'created' => date('Y-m-d H:i:s'),
        ]);
        $coupon_data->save();
        $coupon_id = $coupon_data->id;
        if (!empty($coupon_id)) {
            if ($serviceRowCount != 0) {
                for ($i = 0; $i < $serviceRowCount - 1; $i++) {
                    $coupon_service = new CouponService([
                        'coupon_id' => $coupon_id,
                        'service_id' => $_POST['brand_' . $i],
                        'brand_id' => $_POST['services_' . $i],
                        'quantity' => $serviceQuantity[$i],
                        'price' => $servicePrice[$i],
                        'cgst' => $servicesCgst[$i],
                        'sgst' => $servicesSgst[$i],
                        'total_price' => $serviceTotal[$i],
                    ]);
                    $coupon_service->save();
                }
            }
        }
        return redirect('admin/coupon/create')->with('success', 'coupon added successfully');
        // } catch (\Exception $e) {
        //     // echo json_encode(['msg' => false]);
        //     return back()->with('msg', 'something went wrong');
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon_data = Coupon::where('id', $id)->first();
        if ($coupon_data->coupon_type=='Services') {
            $coupon_service = CouponService::where('coupon_id', $id)->delete();
        }
        $coupon_datas = Coupon::where('id', $id)->delete();
        return redirect('admin/coupon')->with('success', 'Coupon Deleted successfully');
    }

    public function assign_coupon_to_cust(Request $request)
    {
        try {
            $customer_id = $request->customer_id;
            $coupon_id = $request->coupon_id;
            $coupon_code = $customer_id . rand(100, 999) . $coupon_id;
            $Coupon_data = Coupon::where('id', $coupon_id)->first();
            // $validity = $Coupon_data->coupon_validity;
            // $Valid_date = date('d-m-Y', strtotime('+' . $validity . 'days'));
            // $Validity_date = date_create($Valid_date);
            $customer_coupon = new CustomerCoupon([
                'coupon_id' => $coupon_id,
                'customer_id' => $customer_id,
                'coupon_code' => $Coupon_data->coupon_prefix.$coupon_code,
                'coupon_used_count' => 0,
                'start_date' => $Coupon_data->start_date,
                'expire_date' => $Coupon_data->expire_date,
                'status' => 0,
            ]);
            $customer_coupon->save();
            echo json_encode(['msg' => true, 'data' => $customer_coupon]);
        } catch (\Exception $e) {
            echo json_encode(['msg' => false]);
        }
    }

    public function get_custAllCoupon(Request $request)
    {
        try {
            $data['html'] = '';
            $customer_id = $request->customer_id;
            $cust_coupon_datas = DB::table('customer_coupon AS CC')
                ->leftJoin('coupon', 'CC.coupon_id', '=', 'coupon.id')
                ->where('CC.customer_id', $customer_id)
                ->get();
            foreach ($cust_coupon_datas as $key => $value) {
                $data['html'] .= "<tr>
                                    <td>" . ($key + 1) . "</td>
                                    <td>" . $value->coupon_title . "</td>

                                    <td>" . $value->coupon_code . "</td>
                                    <td>" . date('d/M/Y', strtotime($value->start_date)) . "</td>
                                    <td>" . date('d/M/Y', strtotime($value->expire_date)) . "</td>
                                    <td> <button type='button' class='btn btn-info mb-1'>Send Offer</button> </td>
                                </tr>";
            }
            echo json_encode(['msg' => true, 'data' => $data]);
        } catch (\Exception $e) {
            echo json_encode(['msg' => false]);
        }
    }

    public function cust_coupon_bycode(Request $request)
    {
        // try {
        $customer_mobile = $request->customer_number;
        $coupon_code = $request->coupon_code;
        $cust_data = Customer::where('contact', $customer_mobile)->first();
        $cust_id = $cust_data->id;
        $CustomerCoupon = CustomerCoupon::join('coupon', 'coupon.id', '=', 'customer_coupon.coupon_id')
            ->where([['customer_id', '=', $cust_id], ['coupon_code', '=', $coupon_code], ['status', '=', 0]])->first();
        if (!empty($CustomerCoupon)) {
            if (date('Y-m-d H:i:s') <= date('Y-m-d H:i:s', strtotime($CustomerCoupon->expire_date))) {
                if (($CustomerCoupon->coupon_used_count) < ($CustomerCoupon->allow_count)) {
                    echo json_encode(['msg' => true, 'data' => $CustomerCoupon]);
                } else {
                    echo json_encode(['msg' => true, 'data' => 'used count exceed']);
                }
                if ($CustomerCoupon->coupon_type == 'Services') {
                    $cust_coupon_datas = DB::table('coupon')
                        ->leftJoin('customer_coupon as ccp', 'ccp.coupon_id', '=', 'coupon.id')
                        ->leftJoin('coupon_service as CS', 'CS.coupon_id', '=', 'coupon.id')
                        ->leftJoin('service_brands AS SB', 'SB.service_brand_id', '=', 'CS.service_id')
                        ->leftJoin('services AS SE', 'SE.id', '=', 'SB.service_id')
                        ->where('ccp.coupon_code', $coupon_code)
                        ->get();
                    echo json_encode(['msg' => true, 'data' => $cust_coupon_datas]);
                }
            } else {
                echo json_encode(['msg' => true, 'data' => 'coupon expire']);
            }
        } else {
            echo json_encode(['msg' => 'not allowed']);
        }
        // } catch (\Exception $e) {
        //     echo json_encode(['msg' => false]);
        // }
    }

    public function assign_coupon_all(Request $request)
    {
        // print_r($request->customer_ids);
        // die;
        try {
            // $customer_ids = $request->customer_ids;
            $customer_ids = explode(",", $request->customer_ids);
            foreach ($customer_ids as $key => $customer_id) {
                $coupon_id = $request->coupon_id;
                $Coupon_data = Coupon::where('id', $coupon_id)->first();
                // $validity = $Coupon_data->coupon_validity;
                // $Valid_date = date('d-m-Y', strtotime('+' . $validity . 'days'));
                // $Validity_date = date_create($Valid_date);
                $coupon_code = $customer_id . rand(100, 999) . $coupon_id;
                $customer_coupon = new CustomerCoupon([
                    'coupon_id' => $coupon_id,
                    'customer_id' => $customer_id,
                    'coupon_code' => $Coupon_data->coupon_prefix.$coupon_code,
                    'coupon_used_count' => 0,
                    'start_date' => $Coupon_data->start_date,
                    'expire_date' => $Coupon_data->expire_date,
                    'status' => 0,
                ]);
                $customer_coupon->save();
            }
            echo json_encode(['msg' => true, 'data' => $customer_coupon]);
        } catch (\Exception $e) {
            echo json_encode(['msg' => false]);
        }
    }

    public function assign_coupon_toImport(Request $request)
    {
        try {
            $data = Excel::toArray(new CsvImport, $request->file('importfile'));
            foreach ($data as $key => $value) {
                foreach ($value as $inside_key => $inside_value) {
                    // print_r($inside_value);
                    if ($inside_key != 0) {
                        $customer_ids[] = ['id' => $inside_value[0]];
                    }
                }
            }
            foreach ($customer_ids as $key => $customer_id) {
                $coupon_id = $request->import_coupon_id;
                $Coupon_data = Coupon::where('id', $coupon_id)->first();
                $validity = $Coupon_data->coupon_validity;
                $Valid_date = date('d-m-Y', strtotime('+' . $validity . 'days'));
                $Validity_date = date_create($Valid_date);
                $coupon_code = $customer_id['id'] . rand(100, 999) . $coupon_id;
                $customer_coupon = new CustomerCoupon([
                    'coupon_id' => $coupon_id,
                    'customer_id' => $customer_id['id'],
                    'coupon_code' => $Coupon_data->coupon_prefix.$coupon_code,
                    'coupon_used_count' => 0,
                    'start_date' => $Coupon_data->start_date,
                    'expire_date' => $Coupon_data->expire_date,
                    'status' => 0,
                ]);
                $customer_coupon->save();
            }
            echo json_encode(['msg' => true, 'data' => $customer_coupon]);
        } catch (\Exception $e) {
            echo json_encode(['msg' => false]);
        }
    }
}
