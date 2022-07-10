<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Model\admin\Combo;
use App\Model\admin\ComboService;
use DB;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function view_combo()
    {
        try {
            $combos = Combo::all();
            return view('admin.combo.index', compact('combos'));
        } catch (\Exception $e) {
            // echo json_encode(['msg' => false]);
            return back()->with('msg', 'something went wrong');
        }
    }

    public function add_combo()
    {
        try {
            $service_group = DB::table('service_group')->where('parent_id', 0)->get();
            // $products = DB::table('products')->get();
            // $firms = DB::table('firms')->get();
            // $staffs = Staff::where('admin',0)->get();
            // $packages = DB::table('packages')->get();
            return view('admin.combo.create', compact('service_group'));
        } catch (\Exception $e) {
            // echo json_encode(['msg' => false]);
            return back()->with('msg', 'something went wrong');
        }
    }

    public function addcombo_service(Request $request)
    {
        // print_r($request->all());
        // dd('hy'); 
        try {
            $serviceRowCount = $request->serviceRowCount;
            $serviceQuantity = $request->serviceQuantity;
            $servicesSgst = $request->servicesSgst;
            $servicesCgst = $request->servicesCgst;
            $servicePrice = $request->servicePrice;
            $serviceTotal = $request->serviceTotal;
            $combo = new Combo([
                'combo_name' => $request->combo_name,
                'combo_total' => $request->grand_total,
                'combo_price' => $request->combo_price,
                'created_at' => date('Y-m-d'),
            ]);
            $combo->save();
            $comboid = $combo->id;
            if (!empty($comboid)) {
                if ($serviceRowCount != 0) {
                    for ($i = 0; $i < $serviceRowCount - 1; $i++) {
                        $combo_service = new ComboService([
                            'combo_id' => $comboid,
                            'service_id' => $_POST['brand_' . $i],
                            'brand_id' => $_POST['services_' . $i],
                            'quantity' => $serviceQuantity[$i],
                            'price' => $servicePrice[$i],
                            'cgst' => $servicesCgst[$i],
                            'sgst' => $servicesSgst[$i],
                            'total_price' => $serviceTotal[$i],
                        ]);
                        $combo_service->save();
                    }
                }
            }
            return redirect('addCombo')->with('success', 'combo added successfully');

        } catch (\Exception $e) {
            // echo json_encode(['msg' => false]);
            return back()->with('msg', 'something went wrong');
        }
    }

    public function all_combo_service()
    {
        try {
            $data['html'] = "";
            $comboid = "";
            $combos = Combo::all();
            // $services = DB::table('combo')
            // ->select('SB.brand_name as sbname', 'CS.*')
            // ->leftJoin('combo_service AS CS', 'CS.combo_id', '=', 'combo.id')
            // ->leftJoin('service_brands AS SB', 'SB.service_brand_id', '=', 'CS.service_id')
            // ->whereIn('IS.invoice_id', $comboid)
            // ->get();
            foreach ($combos as $key => $combo) {
                $comboid = $combo->id;
                $services = DB::table('combo')
                    ->select('SB.brand_name as sbname', 'CS.*')
                    ->leftJoin('combo_service AS CS', 'CS.combo_id', '=', 'combo.id')
                    ->leftJoin('service_brands AS SB', 'SB.service_brand_id', '=', 'CS.service_id')
                    ->where('CS.combo_id', $comboid)
                    ->get();
                    $combo_servc = '';
                foreach ($services as $service) {
                    $combo_servc = $service->sbname.' , '.$combo_servc;
                }
               $combo_servc_data=json_encode($combo_servc);
                $data['html'] .= "<tr>
                                    <td>" . ($key + 1) . "</td>
                                    <td>" . $combo->combo_name . "</td>
                                    <td>" . $combo_servc_data . "</td>
                                    <td>" . $combo->combo_price . "</td>
                                    <td> <button type='button' class='btn btn-info' onclick='getComboDetails($combo->id)'><i class='fa fa-eye'></i></button></td>
                                </tr>";
            }
            // echo json_encode($data);
            // $services = DB::table('combo')
            // ->select('SB.brand_name as sbname', 'CS.*')
            // ->leftJoin('combo_service AS CS', 'CS.combo_id', '=', 'combo.id')
            // ->leftJoin('service_brands AS SB', 'SB.service_brand_id', '=', 'CS.service_id')
            // ->whereIn('CS.combo_id', $comboid)
            // ->get();
            // // echo $getReport->toSql();
            // echo json_encode($services);
            echo json_encode(['msg' => true, 'data' => $data]);
        } catch (\Exception $e) {
            echo json_encode(['msg' => false]);
        }
    }

    public function get_combo_service(Request $request){
        try {
            $comboid=$request->combo_id;
            $services = DB::table('combo')
                    ->select('SB.*', 'CS.price', 'CS.quantity','CS.total_price','F.id As firmid','F.firm_name','combo.combo_price')
                    ->leftJoin('combo_service AS CS', 'CS.combo_id', '=', 'combo.id')
                    ->leftJoin('service_brands AS SB', 'SB.service_brand_id', '=', 'CS.service_id')
                    ->leftJoin('services AS SE', 'SE.id', '=', 'SB.service_id')
                    ->leftJoin('service_group AS SG', 'SE.group_id', '=', 'SG.id')
                    ->leftJoin('firms AS F', 'SG.firm_id', '=', 'F.id')                    
                    ->where('CS.combo_id', $comboid)
                    // // echo $services->toSql();
                    ->get();
                    // echo json_encode($services->toSql());
            echo json_encode(['msg' => true, 'data' => $services]);
        } catch (\Exception $e) {
            echo json_encode(['msg' => false]);
        }
    }
}
