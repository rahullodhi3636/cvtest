<?php

namespace App\Http\Controllers\admin;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Model\admin\Customer;
use App\Model\admin\CustomerSittingPack;
use App\Model\admin\CustomersittingPackPayment;
use App\Model\admin\sittingPack;
use App\Model\admin\sittingPackService;
use App\Model\admin\sittingPackMakeupService;
use App\Model\admin\Staff;
use DB;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SittingPackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $sittingPacks = sittingPack::all();
            return view('admin.sitting_pack.index', compact('sittingPacks'));
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
            // $combos = Combo::all();
            $service_group = DB::table('service_group')->where('parent_id', 0)->get();
            return view('admin.sitting_pack.create', compact('service_group'));
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
        // print_r($request->all()); die;
        // echo "<pre>";print_r($_POST); die;
        try {
            $sittingDivCount = $request->sittingDivCount;
            $MakeUpDivCount = $request->MakeUpDivCount;
            $sitting_Pack = new sittingPack([
                'pack_name' => $request->pack_name,
                'total_members' => $request->total_members,
                'grand_total' => $request->grand_total,
                'pack_final_price' => $request->pack_final_price,
            ]);
            $sitting_Pack->save();
            $sitting_Packid = $sitting_Pack->id;
            if (!empty($sitting_Packid)) {
                if ($sittingDivCount != 0) {
                    for ($i = 1; $i <= $sittingDivCount; $i++) {
                        $serviceQuantity = $_POST['sit' . $i . 'serviceQuantity'];
                        $servicesSgst = $_POST['sit' . $i . 'servicesSgst'];
                        $servicesCgst = $_POST['sit' . $i . 'servicesCgst'];
                        $servicePrice = $_POST['sit' . $i . 'servicePrice'];
                        $serviceTotal = $_POST['sit' . $i . 'serviceTotal'];
                        $serviceBrand = $_POST['sit' . $i . 'brand'];
                        $serviceServices = $_POST['sit' . $i . 'services'];
                        $service_row_count = count($serviceQuantity);
                        for ($j = 0; $j < $service_row_count; $j++) {
                            $sitting_Pack_service = new sittingPackService([
                                'sittingpack_id' => $sitting_Packid,
                                'sitting_round' => $i,
                                'service_id' => $serviceBrand[$j],
                                'brand_id' => $serviceServices[$j],
                                'quantity' => $serviceQuantity[$j],
                                'price' => $servicePrice[$j],
                                'cgst' => $servicesCgst[$j],
                                'sgst' => $servicesSgst[$j],
                                'total_price' => $serviceTotal[$j],
                            ]);
                            $sitting_Pack_service->save();
                        }
                    }
                }
                if($MakeUpDivCount!=0){
                    for ($k = 1; $k <= $MakeUpDivCount; $k++) {
                        $makeupserviceQuantity = $_POST['makeup' . $k . 'serviceQuantity'];
                        $makeupservicesSgst = $_POST['makeup' . $k . 'servicesSgst'];
                        $makeupservicesCgst = $_POST['makeup' . $k . 'servicesCgst'];
                        $makeupservicePrice = $_POST['makeup' . $k . 'servicePrice'];
                        $makeupserviceTotal = $_POST['makeup' . $k . 'serviceTotal'];
                        $makeupserviceBrand = $_POST['makeup' . $k . 'brand'];
                        $makeupserviceServices = $_POST['makeup' . $k . 'services'];
                        $makeupservice_row_count = count($makeupserviceQuantity);
                        for ($m = 0; $m < $makeupservice_row_count; $m++) {
                            $sittingPack_MakeupService=new sittingPackMakeupService([
                                'sittingpack_id' => $sitting_Packid,
                                'makeup_round' => $k,
                                'service_id' => $makeupserviceBrand[$m],
                                'brand_id' => $makeupserviceServices[$m],
                                'quantity' => $makeupserviceQuantity[$m],
                                'price' => $makeupservicePrice[$m],
                                'cgst' => $makeupservicesCgst[$m],
                                'sgst' => $makeupservicesSgst[$m],
                                'total_price' => $makeupserviceTotal[$m],
                            ]);
                            $sittingPack_MakeupService->save();
                        }
                    }
                }
            }
            return redirect('admin/SittingPack/create')->with('success', 'Sitting Pack added successfully');
        } catch (\Exception $e) {
            // echo json_encode(['msg' => false]);
            return back()->with('msg', 'something went wrong');
        }
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
        try {
            $sitting_Pack = sittingPack::where('id', $id)->first();
            $service_group = DB::table('service_group')->where('parent_id', 0)->get();
            return view('admin.sitting_pack.edit', compact('service_group', 'sitting_Pack'));
        } catch (\Exception $e) {
            // echo json_encode(['msg' => false]);
            return back()->with('msg', 'something went wrong');
        }
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
        // echo "<pre>";
        // print_r($request->all());
        // die;
        try {
            $sittingDivCount = $request->sittingDivCount;
            $sittingPack_Service = sittingPackService::where('sittingpack_id', $id)->delete();
            $sitting_Pack = sittingPack::where('id', $id)->first();
            $sittingpack->pack_name = $request->pack_name;
            $sittingpack->total_members = $request->total_members;
            $sittingpack->grand_total = $request->grand_total;
            $sittingpack->pack_final_price = $request->pack_final_price;
            $sitting_Pack->save();
            $sitting_Packid = $id;
            if (!empty($sitting_Packid)) {
                if ($sittingDivCount != 0) {
                    for ($i = 1; $i <= $sittingDivCount; $i++) {
                        $serviceQuantity = $_POST['sit' . $i . 'serviceQuantity'];
                        $servicesSgst = $_POST['sit' . $i . 'servicesSgst'];
                        $servicesCgst = $_POST['sit' . $i . 'servicesCgst'];
                        $servicePrice = $_POST['sit' . $i . 'servicePrice'];
                        $serviceTotal = $_POST['sit' . $i . 'serviceTotal'];
                        $serviceBrand = $_POST['sit' . $i . 'brand'];
                        $serviceServices = $_POST['sit' . $i . 'services'];
                        $service_row_count = count($serviceQuantity);
                        for ($j = 0; $j < $service_row_count; $j++) {
                            $sitting_Pack_service = new sittingPackService([
                                'sittingpack_id' => $sitting_Packid,
                                'sitting_round' => $i,
                                'service_id' => $serviceBrand[$j],
                                'brand_id' => $serviceServices[$j],
                                'quantity' => $serviceQuantity[$j],
                                'price' => $servicePrice[$j],
                                'cgst' => $servicesCgst[$j],
                                'sgst' => $servicesSgst[$j],
                                'total_price' => $serviceTotal[$j],
                            ]);
                            $sitting_Pack_service->save();
                        }
                    }
                }
            }
            return redirect('admin/SittingPack/create')->with('success', 'Sitting Pack updated successfully');
        } catch (\Exception $e) {
            // echo json_encode(['msg' => false]);
            return back()->with('msg', 'something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $sittingPack_Service = sittingPackService::where('sittingpack_id', $id)->delete();
        $sitting_Pack = sittingPack::where('id', $id)->delete();
        return redirect('admin/SittingPack')->with('success', 'Sitting Pack Deleted successfully');
    }

    // public function all_sitting_pack()
    // {
    //     try {
    //         $data['html'] = '';
    //         // $data['html'] = "<tr><td colspan=7 class='text-center'>No data available</td></tr>";
    //         $sittingpackid = "";
    //         $sittingpacks = sittingPack::all();
    //         foreach ($sittingpacks as $key => $sittingpack) {
    //             $sittingpackid = $sittingpack->id;
    //             $pack_services = DB::table('sittingpack')
    //                 ->select('SB.brand_name as sbname', 'PS.*')
    //                 ->leftJoin('sittingpack_service AS PS', 'PS.sittingpack_id', '=', 'sittingpack.id')
    //                 ->leftJoin('service_brands AS SB', 'SB.service_brand_id', '=', 'PS.service_id')
    //                 ->where('PS.sittingpack_id', $sittingpackid)
    //                 ->get();
    //             $sittingpack_servc = '';
    //             $sitting_count = 0;
    //             foreach ($pack_services as $service) {
    //                 if ($sitting_count != $service->sitting_count) {
    //                     $sitting_count += 1;
    //                 }
    //                 $sittingpack_servc = $service->sbname . ' , ' . $sittingpack_servc;
    //             }
    //             $pack_servc_data = json_encode($sittingpack_servc);
    //             $data['html'] .= "<tr>
    //                                 <td>" . ($key + 1) . "</td>
    //                                 <td>" . $sittingpack->pack_name . "</td>
    //                                 <td>" . $sitting_round . "</td>
    //                                 <td>" . $pack_servc_data . "</td>
    //                                 <td> <i class='fa fa-inr'></i>  " . $sittingpack->grand_total . "</td>
    //                                 <td><i class='fa fa-inr'></i> " . $sittingpack->pack_final_price . "</td>
    //                                 <td> <button type='button' class='btn btn-warning mb-1' onclick='assigntocustomer($sittingpack->id)'><i class='fa fa-tasks'></i></button> </td>
    //                             </tr>";
    //         }
    //         // echo json_encode($data);
    //         // $pack_services = DB::table('sittingpack')
    //         // ->select('SB.brand_name as sbname', 'PS.*')
    //         // ->leftJoin('sittingpack_service AS PS', 'PS.sittingpack_id', '=', 'sittingpack.id')
    //         // ->leftJoin('service_brands AS SB', 'SB.service_brand_id', '=', 'PS.service_id')
    //         // ->where('PS.sittingpack_id', $sittingpackid);
    //         // // ->get();
    //         // echo $pack_services->toSql();
    //         // echo json_encode($services);
    //         echo json_encode(['msg' => true, 'data' => $data]);
    //     } catch (\Exception $e) {
    //         echo json_encode(['msg' => false]);
    //     }
    // }

    public function getSittingPack(Request $request)
    {
        // try {
            $sittingpackid = $request->sit_pk_id;
            $sitting_pack_data = sittingPack::where('id', $sittingpackid)->first();
            $pack_services = DB::table('sittingpack')
                ->select('SB.brand_name as sbname', 'PS.*', 'sittingpack.*')
                ->leftJoin('sittingpack_service AS PS', 'PS.sittingpack_id', '=', 'sittingpack.id')
                ->leftJoin('service_brands AS SB', 'SB.service_brand_id', '=', 'PS.service_id')
                ->where('PS.sittingpack_id', $sittingpackid)
                ->get();
            // $round = 1;
            $service = 1;
            $rowdata = "";
            $staffs = Staff::where('admin', 0)->get();
            $service_round[] = array();
            foreach ($pack_services as $key => $pack_value) {
                $round = $pack_value->sitting_round;
                $service_round[$round][$service]['round'] = $pack_value->sitting_round;
                $service_round[$round][$service]['sbname'] = $pack_value->sbname;
                $service_round[$round][$service]['brand_id'] = $pack_value->service_id;
                $service_round[$round][$service]['service_id'] = $pack_value->brand_id;
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
            foreach ($service_round as $roundkey => $rounds) {
                $servicerowdata = '';
                $i = 0;
                foreach ($rounds as $insidekey => $round_value) {
                    $servicerowdata .= '<div class="row servicerow" id="packserviceDiv'.$insidekey.'"><div class="col-lg-3 col-md-12 col-12"> <div class="form-group"><label>Service</label> <div class="input-group mb-3"> <div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-heart-o"></i></span> </div>  <input class="form-control" name="sitpack_serviceName[]" id="serviceName' . $insidekey . '" value="' . $round_value['sbname'] . '" required> </div> </div> </div>  <div class="col-md-12 col-12 col-lg-2"><div class="form-group"><label>Staff</label><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-heart-o"></i></span></div><select name="sitpack_packageStaff[]" class="form-control"><option value="">Select</option>';
                    if (!empty($staffs)) {
                        foreach ($staffs as $staff) {
                            $servicerowdata .= '<option value="' . $staff->id . '">' . $staff->name . '</option>';
                        }
                    }
                    $servicerowdata .= '</select></div></div></div> <div class="col-md-12 col-12 col-lg-1"><div class="form-group"><label>Qty.</label><input name="sitpack_'.$roundkey.'serviceQuantity[]" type="text" class="form-control" placeholder="" value="' . $round_value['quantity'] . '" readonly></div></div> <div class="col-lg-2 col-md-6 col-12"> <div class="form-group"> <label>Price <i class="fa fa-inr"></i></label> <input name="sitpack_' . $roundkey . 'services[]"  type="hidden" value="' . $round_value['service_id'] . '" id="services_' . $insidekey . '"/> <input name="sitpack_'.$roundkey.'brand[]" value="' . $round_value['brand_id'] . '" type="hidden" id="brand_' . $insidekey . '"/> <input name="packservicesSgst[]" value="' . $round_value['sgst'] . '" type="hidden" id="servicesSgst' . $insidekey . '" class="sgstCount"><input name="packservicesCgst[]" type="hidden" id="servicesCgst' . $insidekey . '" value="' . $round_value['cgst'] . '" class="cgstCount"><input name="sitpack_'.$roundkey.'servicePriceTotal[]" type="hidden" value="' . $round_value['price'] . '" id="servicePriceTotal' . $insidekey . '" class="countTotal"> <input name="packservicePrice[]" type="text" class="form-control" value="' . $round_value['price'] . '" id="servicePrice' . $insidekey . '"> </div> </div> <div class="col-lg-2 col-md-6 col-12">  <div class="form-group"> <label>Total <i class="fa fa-inr"></i></label> <input name="sitpack_'.$roundkey.'serviceTotal[]" value="' . $round_value['total_price'] . '" type="text" class="form-control totalprice" placeholder="" id="serviceTotal' . $insidekey . '">  </div> </div> <div class="col-lg-1 col-md-6 col-12"> <div class="form-group"> <label style="display: block; visibility: hidden;">Delete </label> <a href="javascript:void(0)" class="btn btn-danger" onclick="deletepackServiceRow('.$insidekey.')"><i class="fa fa-trash-o mt-2"></i></a></div> </div></div>';
                }
                $rowdata .= '<div class="col-lg-12 col-md-12 col-12" id="insidepackhead'.$roundkey.'">
                            <div class="row">
                                <div class="col-lg-4 col-md-12 col-12"
                                    <h6> Sitting' . ($roundkey) . '</h6>
                                    <a onclick="addPackServiceRow('.$roundkey.', insidepackdiv'.$roundkey.')" href="javascript:void(0)" class="theme-btn">
                                    <i class="fa fa-plus"></i>Services
                                    </a>

                                    <input name="sittingPayment[]" type="hidden" readonly class="form-control Installment" placeholder="Enter Sitting Installment" id="sittingPayment' . $roundkey . '" required >
                                    <input name="sittingDate[]" type="hidden" readonly class="form-control Installment" placeholder="Enter Sitting Date" id="sittingDate' . $roundkey . '" required >
                                    <input name="sittingTime[]" type="hidden" readonly class="form-control Installment" placeholder="Enter Sitting Time" id="sittingTime' . $roundkey . '" required >
                                </div>
                            </div>
                        <div class="divider serviceDivider">  </div>  </div>
                        <div class="col-lg-12 col-md-12 col-12" id="insidepackdiv'.$roundkey.'"> ' . $servicerowdata . '</div>';
            }

            $pack_makeupservices = DB::table('sittingpack')
                ->select('SB.brand_name as sbname', 'PMS.*', 'sittingpack.*')
                ->leftJoin('sittingpack_makeupservice AS PMS', 'PMS.sittingpack_id', '=', 'sittingpack.id')
                ->leftJoin('service_brands AS SB', 'SB.service_brand_id', '=', 'PMS.service_id')
                ->where('PMS.sittingpack_id', $sittingpackid)
                ->get();
            $makeupservice = 1;
            $makeuprowdata = "";
            $makeupservice_round[] = array();
            foreach ($pack_makeupservices as $makeupkey => $packmakeup_value) {
                $makeupround = $packmakeup_value->makeup_round;
                $makeupservice_round[$makeupround][$makeupservice]['round'] = $packmakeup_value->makeup_round;
                $makeupservice_round[$makeupround][$makeupservice]['sbname'] = $packmakeup_value->sbname;
                $makeupservice_round[$makeupround][$makeupservice]['brand_id'] = $packmakeup_value->service_id;
                $makeupservice_round[$makeupround][$makeupservice]['service_id'] = $packmakeup_value->brand_id;
                $makeupservice_round[$makeupround][$makeupservice]['quantity'] = $packmakeup_value->quantity;
                $makeupservice_round[$makeupround][$makeupservice]['price'] = $packmakeup_value->price;
                $makeupservice_round[$makeupround][$makeupservice]['cgst'] = $packmakeup_value->cgst;
                $makeupservice_round[$makeupround][$makeupservice]['sgst'] = $packmakeup_value->sgst;
                $makeupservice_round[$makeupround][$makeupservice]['total_price'] = $packmakeup_value->total_price;
                $makeupservice += 1;
            }
            $makeupservice_round = array_filter($makeupservice_round);
            foreach ($makeupservice_round as $makeup_roundkey => $makeup_rounds) {
                $makeup_servicerowdata = '';
                $i = 0;
                foreach ($makeup_rounds as $makeup_insidekey => $makeup_round_value) {
                    $makeup_servicerowdata .= '<div class="row servicerow" id="makeupserviceDiv'.$makeup_insidekey.'"><div class="col-lg-3 col-md-12 col-12"> <div class="form-group"><label>Service</label> <div class="input-group mb-3"> <div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-heart-o"></i></span> </div>  <input class="form-control" name="makeupserviceName[]" id="serviceName' . $makeup_insidekey . '" value="' . $makeup_round_value['sbname'] . '" required> </div> </div> </div>  <div class="col-md-12 col-12 col-lg-2"><div class="form-group"><label>Staff</label><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-heart-o"></i></span></div><select name="makeup_Staff[]" class="form-control"><option value="">Select</option>';
                    if (!empty($staffs)) {
                        foreach ($staffs as $staff) {
                            $makeup_servicerowdata .= '<option value="' . $staff->id . '">' . $staff->name . '</option>';
                        }
                    }
                    $makeup_servicerowdata .= '</select></div></div></div> <div class="col-md-12 col-12 col-lg-1"><div class="form-group"><label>Qty.</label><input name="makeup_'.$makeup_roundkey.'serviceQuantity[]" type="text" class="form-control" placeholder="" value="' . $makeup_round_value['quantity'] . '" readonly></div></div> <div class="col-lg-2 col-md-6 col-12"> <div class="form-group"> <label>Price <i class="fa fa-inr"></i></label> <input name="makeup_'.$makeup_roundkey.'services[]"  type="hidden" value="' . $makeup_round_value['service_id'] . '" id="services_' . $makeup_insidekey . '"/> <input name="makeup_'.$makeup_roundkey.'brand[]" value="' . $makeup_round_value['brand_id'] . '" type="hidden" id="brand_' . $makeup_insidekey . '"/> <input name="makeupservicesSgst[]" value="' . $makeup_round_value['sgst'] . '" type="hidden" id="servicesSgst' . $makeup_insidekey . '" class="sgstCount"><input name="makeupservicesCgst[]" type="hidden" id="servicesCgst' . $makeup_insidekey . '" value="' . $makeup_round_value['cgst'] . '" class="cgstCount"><input name="makeupservicePriceTotal[]" type="hidden" value="' . $makeup_round_value['price'] . '" id="servicePriceTotal' . $makeup_insidekey . '" class="countTotal"> <input name="makeupservicePrice[]" type="text" class="form-control" value="' . $makeup_round_value['price'] . '" id="servicePrice' . $makeup_insidekey . '"> </div> </div> <div class="col-lg-2 col-md-6 col-12">  <div class="form-group"> <label>Total <i class="fa fa-inr"></i></label> <input name="makeup_' . $makeup_insidekey . 'serviceTotal[]" value="' . $makeup_round_value['total_price'] . '" type="text" class="form-control totalprice" placeholder="" id="serviceTotal' . $makeup_insidekey . '">  </div> </div> <div class="col-lg-1 col-md-6 col-12"> <div class="form-group"> <label style="display: block; visibility: hidden;">Totalsss</label> <a href="javascript:void(0)" class="btn btn-danger" onclick="deleteMakeupServiceRow('.$makeup_insidekey.')"> <i class="fa fa-trash-o mt-2"></i></a> </div> </div></div>';
                }
                $makeuprowdata .= '<div class="col-lg-12 col-md-12 col-12">
                            <div class="row">
                                <div class="col-lg-4 col-md-12 col-12"
                                    <h6> MakeUp' . ($makeup_roundkey) . '</h6>

                                    <a onclick="DeletePackMakeupRound('.$makeup_roundkey.', insidemakeupdiv'.$makeup_roundkey.')" href="javascript:void(0)" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>Remove
                                    </a>
                                    <input name="makeupPayment[]" type="hidden" readonly class="form-control Installment" placeholder="Enter Makeup Installment" id="makeupPayment' . $makeup_roundkey . '" required >
                                    <input name="makeupDate[]" type="hidden" readonly class="form-control Installment" placeholder="Enter Makeup Date" id="makeupDate' . $makeup_roundkey . '" required >
                                    <input name="makeupTime[]" type="hidden" readonly class="form-control Installment" placeholder="Enter Makeup Time" id="makeupTime' . $makeup_roundkey . '" required >
                                </div>
                            </div>
                        <div class="divider serviceDivider">  </div>  </div>
                        <div class="col-lg-12 col-md-12 col-12" id="insidemakeupdiv'.$makeup_roundkey.'"> ' . $makeup_servicerowdata . '</div>';
            }


            echo json_encode(['msg' => true, 'data' => $rowdata,'makeupdata' => $makeuprowdata, 'sitting_pack_data' => $sitting_pack_data]);
        // } catch (\Exception $e) {
        //     echo json_encode(['msg' => false]);
        // }
    }

    public function beforeAssignSittingPackdata(Request $request)
    {
        try {
            $sit_pk_id = $request->sit_pk_id;
            $sitting_pack = sittingPack::where('id', $sit_pk_id)->first();
            echo json_encode(['msg' => true, 'data' => $sitting_pack]);
        } catch (\Exception $e) {
            echo json_encode(['msg' => false]);
        }
    }

    public function assignSitPackToCustomer(Request $request)
    {
        try {
            $customer_mobile = $request->customer_mobile;
            $cust_data = Customer::where('contact', $customer_mobile)->first();
            $Customer_Sitting_Pack = CustomerSittingPack::where([
                ['sittingpack_id', '=', $request->sitting_pack_id],
                ['customer_id', '=', $cust_data->id],
            ])->get();
            if ($Customer_Sitting_Pack->isEmpty()) {

                $Customer_Sitting_Pack = new CustomerSittingPack();
                $Customer_Sitting_Pack->sittingpack_id = $request->sitting_pack_id;
                $Customer_Sitting_Pack->customer_id = $cust_data->id;
                $Customer_Sitting_Pack->expire_date = date('Y-m-d H:i:s', strtotime($request->expiry_date));
                if (isset($request->member_name)) {
                    $Customer_Sitting_Pack->member_name = json_encode(implode(',', $request->member_name));
                }
                if (isset($request->member_name)) {
                    $Customer_Sitting_Pack->member_mobile = json_encode(implode(',', $request->member_mobile));
                }
                $Customer_Sitting_Pack->member_otp = rand(1000, 9999);
                $Customer_Sitting_Pack->save();
            } else {

                $Customer_Sitting_Pack[0]->expire_date = date('Y-m-d H:i:s', strtotime($request->expiry_date));
                if (isset($request->member_name)) {
                    $Customer_Sitting_Pack[0]->member_name = json_encode(implode(',', $request->member_name));
                }
                if (isset($request->member_name)) {
                    $Customer_Sitting_Pack[0]->member_mobile = json_encode(implode(',', $request->member_mobile));
                }
                $Customer_Sitting_Pack[0]->member_otp = rand(1000, 9999);
                $Customer_Sitting_Pack[0]->save();

            }
            echo json_encode(['msg' => true]);
            // Session::flash('success', 'Sitting Pack assigned to customer successfully');
            // return redirect('quick_sale');
        } catch (\Exception $e) {
            echo json_encode(['msg' => false]);
            // Session::flash('danger', 'Sitting Pack not assigned to customer');
            // return redirect('quick_sale');
        }
    }

    public function customer_sitting_pack(Request $request)
    {
        try {
            $data['html'] = '';
            $customer_mobile = $request->customer_mobile;
            $cust_data = Customer::where('contact', $customer_mobile)->first();
            $cust_id = $cust_data->id;
            $Cust_sitting_packs = CustomerSittingPack::where('customer_id', $cust_id)->get();

            foreach ($Cust_sitting_packs as $key => $cust_sit_pack) {
                $sittingpackid = $cust_sit_pack->sittingpack_id;
                $sittingPayment = $cust_sit_pack->sittingPayment;
                $pack_services = DB::table('sittingpack')->where('id', $sittingpackid)->get();
                $sitting_round = 0;
                foreach ($pack_services as $sitkey => $service) {
                    $today = date('d-m-Y', time());
                    $exp = date('d-m-Y', strtotime($cust_sit_pack->expire_date));
                    $expDate = date_create($exp);
                    $todayDate = date_create($today);
                    $diff = date_diff($todayDate, $expDate);
                    $status = "<a target='_blank' class='btn btn-primary mb-1' href='".url('mypackinvoice').'/'.$cust_sit_pack->invoice_id."'>View</a>";
                    if ($diff->format("%R%a") > 0) {
                        $status .= "<button type='button' class='btn btn-info mb-1' id='btn_sitpackotp$sittingpackid' onclick='sittingpackotp($sittingpackid)'>OTP</button><button type='button' id='btn_sitpack$sittingpackid' class='btn btn-warning mr-1' style='display:none;' onclick='getassignedsittingpackDetails($sittingpackid)'>Assign</button><button type='button' id='btn_adminpswdsitpack$sittingpackid' class='btn btn-warning mr-1' style='display:none;' onclick='check_pswd_for_pack($sittingpackid)'>Password before pack</button>";
                    } else {
                        $status .= "<button type='button' class='btn btn-info mb-1'  onclick='update_expiry($cust_sit_pack->id)'>Update Expiry</button><button type='button' class='btn btn-danger mb-1'>Expired</button>";
                    }
                    $data['html'] .= "<tr>
                                <td>" . ($sitkey + 1) . "</td>
                                <td>" . $service->pack_name . "</td>
                                <td>" . date('d/M/Y', strtotime($cust_sit_pack->expire_date)) . "</td>
                                <td> <i class='fa fa-inr'></i>  " . $cust_sit_pack->packageAdvancePayment . "</td>
                                <td> <i class='fa fa-inr'></i>  " . $service->grand_total . "</td>
                                <td><i class='fa fa-inr'></i> " . $service->pack_final_price . "</td>
                                <td>" . $status . " </td>
                            </tr>";
                    // }
                    // $sitting_round = $service->sitting_round;
                }

            }
            echo json_encode(['msg' => true, 'data' => $data]);

        } catch (\Exception $e) {
            echo json_encode(['msg' => false]);
        }
    }

    public function save_expiry_date(Request $request){
        $sitting_id = $request->sitting_id;
        $expiry_date = $request->expiry_date;
        $sitting_pack = CustomerSittingPack::find($sitting_id);
        $sitting_pack->expire_date = date('Y-m-d H:i:s',strtotime($expiry_date));
        if($sitting_pack->save()){
            echo json_encode(['msg' => true]);
        }else{
            echo json_encode(['msg' => false]);
        }
    }

    public function get_custpack_service(Request $request)
    {
        try {
            $sitting_pack_id = $request->sitting_pack_id;
            $customer_mobile = $request->customer_mobile;
            $cust_data = Customer::where('contact', $customer_mobile)->first();
            $cust_id = $cust_data->id;
            $Customersitting_Pack_Payment = CustomersittingPackPayment::where([
                ['sittingpack_id', '=', $sitting_pack_id],
                ['customer_id', '=', $cust_id],
                ['sittingStatus', '=', 'UnPaid'],
            ])->first();
            $curr_sitting_round = $Customersitting_Pack_Payment->sitting_round;
            $services = DB::table('sittingpack')
                ->select('SB.*', 'CS.sittingpack_id', 'CS.price', 'CS.quantity', 'CS.total_price', 'F.id As firmid', 'F.firm_name', 'sittingpack.pack_final_price')
                ->leftJoin('sittingpack_service AS CS', 'CS.sittingpack_id', '=', 'sittingpack.id')
                ->leftJoin('service_brands AS SB', 'SB.service_brand_id', '=', 'CS.service_id')
                ->leftJoin('services AS SE', 'SE.id', '=', 'SB.service_id')
                ->leftJoin('service_group AS SG', 'SE.group_id', '=', 'SG.id')
                ->leftJoin('firms AS F', 'SG.firm_id', '=', 'F.id')
                ->where('CS.sittingpack_id', $sitting_pack_id)
                ->where('CS.sitting_round', $curr_sitting_round)
            // echo $services->toSql();
            // echo json_encode($services->toSql());
                ->get();

            echo json_encode(['msg' => true, 'data' => $services, 'CSP_Payment' => $Customersitting_Pack_Payment]);
        } catch (\Exception $e) {
            echo json_encode(['msg' => false]);
        }
    }

    public function getSittingPack_MemberContacts(Request $request)
    {
        try {
            $customer_mobile = $request->customer_mobile;
            $cust_data = Customer::where('contact', $customer_mobile)->first();
            $cust_id = $cust_data->id;
            $customer_sitting_pack_id = $request->customer_sitting_pack_id;
            $Customer_Sitting_Pack = CustomerSittingPack::where([
                ['sittingpack_id', '=', $customer_sitting_pack_id],
                ['customer_id', '=', $cust_id],
            ])->first();
            echo json_encode(['msg' => true, 'data' => $Customer_Sitting_Pack, 'cust_data' => $cust_data]);
        } catch (\Exception $e) {
            echo json_encode(['msg' => false]);
        }
    }

    public function sendOtpSitPack(Request $request)
    {
        try {
            $number = $request->number;
            $otp = rand(1000, 9999);
            $checkcode = DB::table('customer_sitting_pack')->select('*')->where('member_mobile', 'like', '%' . $number . '%')->count();
            if ($checkcode != 0) {
                $user_data = CustomerSittingPack::where('member_mobile', 'LIKE', "%$number%")->get();
                $user_data[0]->member_otp = $otp;
                $user_data[0]->save();
            } else {
                DB::update('update user_otp set otp = ? WHERE contact = ?', [$otp, $number]);
            }
            // $message = 'Your OTP is ' . $otp . '.VND Ventures Pvt. Ltd.';
            $message='Hi ' . $number . ' ! Please share ' . $otp . 'OTP to redeem your CV Salon Package.';
            Helper::sendMobileSMS($number, $message);
            echo json_encode(['msg' => true, 'otp' => $otp]);
        } catch (\Exception $e) {
            echo json_encode(['msg' => false]);
        }
    }

    public function sitpackOtpVerify(Request $request)
    {
        try {
            $this->validate($request, [
                'otp' => 'required',
                'contact' => 'required',
            ]);
            $number = $request->contact;
            $user = DB::table('customer_sitting_pack')->where('member_mobile', 'like', '%' . $number . '%')->where('member_otp', $request->otp)->first();
            if (!empty($user)) {
                echo json_encode(['msg' => true]);
            } else {
                $user = DB::table('user_otp')->where('contact', $request->contact)->where('otp', $request->otp)->first();
                echo json_encode(['msg' => true]);
            }
        } catch (\Exception $e) {
            echo json_encode(['msg' => false]);
        }
    }

    public function getSittingInstallments(Request $request)
    {
        try {
            $sittingpackid = $request->sit_pk_id;
            $sitting_pack_data = sittingPack::where('id', $sittingpackid)->first();
            $pack_services = DB::table('sittingpack')
                ->leftJoin('sittingpack_service AS PS', 'PS.sittingpack_id', '=', 'sittingpack.id')
                ->where('PS.sittingpack_id', $sittingpackid)
                ->get();
            $round = 0;
            $service_round = array();
            foreach ($pack_services as $key => $pack_value) {
                if ($round != $pack_value->sitting_round) {
                    $service_round[$round] = $pack_value->sitting_round;
                }
                $round = $pack_value->sitting_round;
            }
            $pack_makeup_services = DB::table('sittingpack')
                ->leftJoin('sittingpack_makeupservice AS PMS', 'PMS.sittingpack_id', '=', 'sittingpack.id')
                ->where('PMS.sittingpack_id', $sittingpackid)
                ->get();
            $makeup_round = 0;
            $makeup_service_round = array();
            foreach ($pack_makeup_services as $makeup_key => $pack_makeup_value) {
                if ($makeup_round != $pack_makeup_value->makeup_round) {
                    $makeup_service_round[$makeup_round] = $pack_makeup_value->makeup_round;
                }
                $makeup_round = $pack_makeup_value->makeup_round;
            }
            // echo json_encode($services->toSql());
            echo json_encode(['msg' => true, 'data' => $service_round,'makeup_data' => $makeup_service_round, 'pack_final_price' => $pack_services[0]->pack_final_price]);
        } catch (\Exception $e) {
            echo json_encode(['msg' => false]);
        }
    }

    public function showCalender(Request $request)
    {
        try {
            $event_list = [];
                // $startDate = date("Y-m-d", strtotime("2021-06-27"));
                // $endDate = date("Y-m-d", strtotime("2021-08-08"));
                // echo $startDate;
                // echo $endDate;
                // $event_data = DB::table('customer_sittingpack_payment')
                // ->leftJoin('sittingpack', 'customer_sittingpack_payment.sittingpack_id', '=', 'sittingpack.id')
                // ->where(\DB::raw("STR_TO_DATE(sitting_date, '%d-%m-%Y')"), '>=', $startDate)
                // ->where(\DB::raw("STR_TO_DATE(sitting_date, '%d-%m-%Y')"), '<=', $endDate)
                // // echo json_encode($event_data->toSql());
                // ->get();
                // print_r($event_data);
                // die;
            if ($request->ajax()) {
                $startDate = date("Y-m-d", strtotime($request->start));
                $endDate = date("Y-m-d", strtotime($request->end));
                $event_data = DB::table('customer_sittingpack_payment')
                    ->leftJoin('customers AS C', 'C.id', '=', 'customer_sittingpack_payment.customer_id')
                    ->leftJoin('customer_sitting_pack AS CSP', 'CSP.id', '=', 'customer_sittingpack_payment.CSP_id')
                    ->leftJoin('sittingpack', 'customer_sittingpack_payment.sittingpack_id', '=', 'sittingpack.id')
                    ->where(\DB::raw("STR_TO_DATE(sitting_date, '%d-%m-%Y')"), '>=', $startDate)
                    ->where(\DB::raw("STR_TO_DATE(sitting_date, '%d-%m-%Y')"), '<=', $endDate)
                    ->get();
                foreach ($event_data as $key => $value) {
                    $event_list[$key]['id'] = $key;
                    $event_list[$key]['title'] = $value->pack_name."\n".$value->name;
                    $event_list[$key]['start'] = date("Y-m-d", strtotime($value->sitting_date));
                    $event_list[$key]['description'] = $value->invoice_id;
                }
                return response()->json($event_list);
            }

            return view('admin.sitting_pack.calendar');
        } catch (\Exception $e) {
            // echo json_encode(['msg' => false]);
            return back()->with('msg', 'something went wrong');
        }
    }

    public function sitpackPswdVerify(Request $request)
    {
        // $curr_user_id = Auth::user()->id;
        $user_pswd= $request->pswd;
        try {
            // $sitting_pack_data = sittingPack::where('id', $sittingpackid)->first();
            $user_data = DB::table('users')
                    ->where('department', 1)
                    ->first();
            if (Hash::check($user_pswd, $user_data->password)) {
                echo json_encode(['msg' => true]);
            }
            else{
                echo json_encode(['msg' => false]);
            }
        } catch (\Exception $e) {
            echo json_encode(['msg' => false]);
        }
    }
}
