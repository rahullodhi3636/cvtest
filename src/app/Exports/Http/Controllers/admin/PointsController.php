<?php

namespace App\Http\Controllers\admin;
use App\Model\admin\Customer;
use App\Http\Controllers\Controller;
use App\Model\admin\CustomerPoint;
use App\Model\admin\Point;
use DB;
use Illuminate\Http\Request;

class PointsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $points = Point::all();
            return view('admin.points.index', compact('points'));

        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data['html'] = '';
        $point = new Point([
            'invoice_amt' => $request->get('invoice_amt'),
            'point_amt' => $request->get('point_amt'),
        ]);
        $point->save();
        $id = $point->id;
        if (!empty($id)) {
            $points = Point::all();
            if (!empty($points)) {
                foreach ($points as $point) {
                    $data['html'] .= '<tr>
                        <td>' . $point->invoice_amt . '</td>
                        <td>' . $point->point_amt . '</td>
                        <td>
                          <table >
                            <tr>
                              <th style="padding: 0">
                                <a href="javascript:void(0)" onclick="getPoint(' . $point->id . ')" class="btn-primary btn-sm waves-effect waves-light text-light material-tooltip-main" data-toggle="tooltip" data-html="true" title="Edit">
                                  <i class="fa fa-edit"></i>
                                </a>
                              </th>
                              <th style="padding: 0">
                                <form action="' . route('point.destroy', $point->id) . '" method="post">
                                  <input type="hidden" name="_method" value="delete" />
                                  <input type = "hidden" name = "_token" value = "' . csrf_token() . '">
                                  <button class="btn-danger btn-sm waves-effect waves-light material-tooltip-main" type="submit" style="border:0 !important" data-toggle="tooltip" data-html="true" title="Delete"><i class="fa fa-close"></i></button>
                                </form>
                              </th>
                            </tr>
                          </table>
                        </td>
                      </tr>';
                }
            } else {
                $data['html'] = '';
            }
        } else {
            $data['html'] = '';
        }
        echo json_encode($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function show(Point $point)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function edit(Point $point)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $point = Point::find($id);
        $point->delete();
        return redirect('/admin/point')->with('success', 'Point deleted!');
    }

    public function getPoint(Request $request)
    {
        $id = $request->pointid;
        $data = DB::table('points')->where('id', $id)->first();
        echo json_encode($data);
    }

    public function updatePoint(Request $request){
        $data['html'] = '';
        $id = $request->editpointid;
        $point = Point::find($id);
        $point->invoice_amt = $request->get('invoice_amt');
        $point->point_amt = $request->get('point_amt');
        $point->save();
        $id = $point->id;
        if (!empty($id)) {
            $points = Point::all();
            if (!empty($points)) {
                foreach ($points as $point) {
                    $data['html'] .= '<tr>
                        <td>' . $point->invoice_amt . '</td>
                        <td>' . $point->point_amt . '</td>
                        <td>
                          <table >
                            <tr>
                              <th style="padding: 0">
                                <a href="javascript:void(0)" onclick="getPoint(' . $point->id . ')" class="btn-primary btn-sm waves-effect waves-light text-light material-tooltip-main" data-toggle="tooltip" data-html="true" title="Edit">
                                  <i class="fa fa-edit"></i>
                                </a>
                              </th>
                              <th style="padding: 0">
                                <form action="' . route('point.destroy', $point->id) . '" method="post">
                                  <input type="hidden" name="_method" value="delete" />
                                  <input type = "hidden" name = "_token" value = "' . csrf_token() . '">
                                  <button class="btn-danger btn-sm waves-effect waves-light material-tooltip-main" type="submit" style="border:0 !important" data-toggle="tooltip" data-html="true" title="Delete"><i class="fa fa-close"></i></button>
                                </form>
                              </th>
                            </tr>
                          </table>
                        </td>
                      </tr>';
                }
            } else {
                $data['html'] = '';
            }
        } else {
            $data['html'] = '';
        }
        echo json_encode($data);
    }

    function getpointsByAmount(Request $request)
    {
      $total_amt= $request->total_amt;
      $result = DB::table('points')
            ->select('*', DB::raw("ABS(invoice_amt - $total_amt) AS allow_point"))  
            ->orderBy('allow_point')
            ->first();
      echo json_encode($result);
    }

    public function otp_verify_points(Request $request)
    {
      $this->validate($request, [
          'otp'=>'required',
          'contact'=>'required',
      ]);
      $user = DB::table('user_otp')->where('contact', $request->contact)->where('otp',$request->otp)->first();
      if (!empty($user)) {
        echo json_encode(['msg'=> true]);
      }else{
        echo json_encode(['msg'=> false]);
      }
    }

    public function getpointsofCustomer($id)
    {
      $customer = Customer::select('customers.name', 'CP.*')
					->leftJoin('customer_points AS CP','CP.customer_id','=','customers.id')
          ->where('CP.customer_id',$id)
					->get();
      return view('customer.point_details',compact('customer'));
    }

    public function getPointDetails(Request $request)
    {
        try {
            $invoiceid = $request->invoice_id;
            $Customer_Point = CustomerPoint::where('invoice_id', '=', $invoiceid)->first();
            echo json_encode(['msg' => true, 'data' => $Customer_Point]);
        } catch (\Exception $e) {
            echo json_encode(['msg' => false]);
        }
    }

    public function updateCustomerPointDetails(Request $request)
    {
        try {
          $points_id = $request->points_id;
          $Customer_Point = CustomerPoint::where('id', '=', $points_id)->first();
          $Customer_Point->used_points=$request->used_points;
          $Customer_Point->save();
        } catch (\Exception $e) {
            echo json_encode(['msg' => false]);
        }
    }
}
