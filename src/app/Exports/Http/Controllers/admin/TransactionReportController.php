<?php
namespace App\Http\Controllers\admin;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransactionReportController extends Controller
{
	public function index()
	{
		$firms = DB::table('firms')->get();
		return view('admin.transaction_report.reportlist',compact('firms'));
	}

	public function showReport(Request $request)
	{
		$data['html'] = "";
		$data['subtotal'] = 0;
		$firmid = $request->get('firm');
		$from = date('Y-m-d 00:00:00',strtotime($request->get('from')));
		$to = date('Y-m-d 23:59:59',strtotime($request->get('to')));
		if (!empty($firmid)) {
			$getFirmDetail = DB::table('firms')->where('id',$firmid)->first();
			if (!empty($getFirmDetail)) {
				$services = json_decode($getFirmDetail->services);
				foreach ($services as $id) {

					$getReport = DB::table('invoice_trsansaction_details as ITD')->select('ITD.*','S.name as service_name','SP.product_name','PB.brand_name','C.name as customer_name')->leftJoin('service_products as SP','ITD.product_id','=','SP.product_id')->leftJoin('product_brands as PB','PB.id','=','SP.brand_id')->leftJoin('services as S','PB.service_id','=','S.id')->leftJoin('invoice_transactions as IT','IT.invoice_transaction_id','=','ITD.invoice_transaction_id')->leftJoin('customers as C','C.id','=','IT.customer_id');
					// echo $getReport->toSql();
					// die();
					// echo $getReport->toSql();
					if (!empty($request->get('from')) && $request->get('from') != '' && !is_null($request->get('from')) && !empty($request->get('to')) && $request->get('to') != '' && !is_null($request->get('to'))) {
						$getReport->where('ITD.date_of_service','>=',$from);
						$getReport->where('ITD.date_of_service','<=',$to);
					}

					$getReport->where('S.id',$id);
					$reports = $getReport->get();
					/*echo $getReport->toSql();
					die();*/
					/*if (!empty($getReport)) {*/
						foreach ($reports as $report) {
							$data['subtotal'] += $report->price * $report->quantity;
							$data['html'] .= "<tr>
										<td>".$report->customer_name."</td>
										<td>".$report->service_name."</td>
										<td>".$report->brand_name."</td>
										<td>".$report->product_name."</td>
										<td>".$report->price."</td>
										<td>".$report->quantity."</td>
										<td>".$report->price * $report->quantity."</td>
										<td>".date('d-M-Y',strtotime($report->date_of_service))."</td>
									 </tr>";
						}
					/*}else{
						$data['html'] = "";
						$data['subtotal'] = 0;
					}*/
				}	
			}else{
				$data['html'] = "";
				$data['subtotal'] = 0;
			}
		}else{
			$data['html'] = "";
			$data['subtotal'] = 0;
		}

		echo json_encode($data);
	}
}  
?>