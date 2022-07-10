<?php
namespace App\Http\Controllers\admin;

use App\Model\admin\Addtocart;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class AddtocartController extends Controller
{
	public function create()
	{
		# code...
	}

	public function store(Request $request)
	{
		$data['subtotal'] = "";
        $data['html'] = "";
        $data['count'] = "";
        $product_id = $request->get('products');
        if (!empty($product_id)) {
        	$product = DB::table('service_products')->where('product_id',$product_id)->first();
        	$cartitemdetails = DB::table('add_to_cart')->where('customer_id', $request->get('customer_id'))->where('item_id',$product_id)->first();
			if (empty($cartitemdetails)) {
				$addtocart = new addtocart([
					'item_id' => $product->product_id,
					'item_name' => $product->product_name,
					'item_price' => $product->price,
					'item_quantity' => 1,
					'customer_id' => $request->get('customer_id'),
					'status' => 0,
				]);
				$addtocart->save();
				$lastInsertedId = $addtocart->id;
				if (!empty($lastInsertedId)) {
					$cartitem = DB::table('add_to_cart')->where('customer_id', $request->get('customer_id'))->get();
					// $subtotal = DB::table('add_to_cart')->where('customer_id', $request->get('customer_id'))->sum('item_price');
					$subtotal = 0;
					// $subtotal = DB::table('add_to_cart')->where('customer_id', $request->get('customer_id'))->sum('item_price');
					foreach ($cartitem as $value) {
						$subtotal += $value->item_price * $value->item_quantity;
					}
					$data['subtotal'] = $subtotal;
		        	$count = DB::table('add_to_cart')->where('customer_id', $request->get('customer_id'))->count();
		        	$data['count'] = $count;
					
				}
			}else{
				$quantity = $cartitemdetails->item_quantity+1;
				DB::table('add_to_cart')->where('id', $cartitemdetails->id)->update(array('item_quantity' => $quantity));
				$cartitem = DB::table('add_to_cart')->where('customer_id', $request->get('customer_id'))->get();
				$subtotal = 0;
				// $subtotal = DB::table('add_to_cart')->where('customer_id', $request->get('customer_id'))->sum('item_price');
				foreach ($cartitem as $value) {
					$subtotal += $value->item_price * $value->item_quantity;
				}
				$data['subtotal'] = $subtotal;
	        	$count = DB::table('add_to_cart')->where('customer_id', $request->get('customer_id'))->count();
	        	$data['count'] = $count;
			}
			if (!empty($cartitem)) {
				foreach ($cartitem as $product){
	               $data['html'] .= '<div class="cart-items-row">
	                            <div class="cart-product_img">
	                                <img src="https://localhost/salon/backend/images/logo-cstestseries3.png">
	                            </div>
	                            <div class="cart-items-details">
	                                <div class="row">
	                                    <div class="col-sm-8">
	                                        <!-- <div class="cartproduct-discount">
	                                            66
	                                             % OFF
	                                        </div> -->
	                                    </div>
	                                    <div class="col-sm-4 float-right">
	                                        <form id="remove_item_'.$product->id.'" action="'.route("cart.remove").'" method="POST" class="">
	                                            <input type = "hidden" name = "_token" value = "'.csrf_token().'">
	                                            <input name="id" type="hidden" value="'.$product->id.'">
	                                            <input name="cid" type="hidden" value="'.$product->customer_id.'">
	                                            <button type="button" onclick="removeItem('.$product->id.');" class="close">×</button>
	                                        </form>                                    
	                                    </div>
	                                </div>
	                                <div class="row">
	                                    <div class="col-sm-12">
	                                        <div class="cartproduct-name" title="'.$product->item_name.'">
	                                            '.$product->item_name.'
	                                        </div>
	                                        <div class="cartproduct-items">
	                                            <span class="cartnew-price"> '.$product->item_price.'
	                                            </span>
	                                            <span class=""> x <strong class="badge badge-warning badge-xs">'.$product->item_quantity.'</strong>
	                                            </span>
	                                            <div class="carttotel-price float-right badge badge-xs badge-info" style="border-radius: 7%">
	                                                ₹ '.$product->item_price * $product->item_quantity.'
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>';
	            }
			}else{
	            $data['html'] .= '<div class="cart-items-row">
	                        <div class="cart-product_img">
	                            <!-- <img src="https://localhost/salon/backend/images/logo-cstestseries3.png"> -->
	                        </div>
	                        <div class="cart-items-details">
	                            <div class="row">
	                                <div class="col-sm-8">
	                                    
	                                </div>
	                                <div class="col-sm-4 float-right">
	                                                                  
	                                </div>
	                            </div>
	                            <div class="row">
	                                <div class="col-sm-12">
	                                    
	                                    <div class="cartproduct-items">
	                                        <span class="cartnew-price"> Cart Empty
	                                        </span>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>';
	        }
        }
		echo json_encode($data);
	}

	/*public function store(Request $request)
	{
		$data['subtotal'] = "";
        $data['html'] = "";
        $data['count'] = "";
		$cartitemdetails = DB::table('add_to_cart')->where('customer_id', $request->get('customer_id'))->where('item_id',$request->get('id'))->first();
		if (empty($cartitemdetails)) {
			$addtocart = new addtocart([
				'item_id' => $request->get('id'),
				'item_name' => $request->get('name'),
				'item_price' => $request->get('price'),
				'item_quantity' => 1,
				'customer_id' => $request->get('customer_id'),
				'status' => 0,
			]);
			$addtocart->save();
			$lastInsertedId = $addtocart->id;
			if (!empty($lastInsertedId)) {
				$cartitem = DB::table('add_to_cart')->where('customer_id', $request->get('customer_id'))->get();
				// $subtotal = DB::table('add_to_cart')->where('customer_id', $request->get('customer_id'))->sum('item_price');
				$subtotal = 0;
				// $subtotal = DB::table('add_to_cart')->where('customer_id', $request->get('customer_id'))->sum('item_price');
				foreach ($cartitem as $value) {
					$subtotal += $value->item_price * $value->item_quantity;
				}
				$data['subtotal'] = $subtotal;
	        	$count = DB::table('add_to_cart')->where('customer_id', $request->get('customer_id'))->count();
	        	$data['count'] = $count;
				
			}
		}else{
			$quantity = $cartitemdetails->item_quantity+1;
			DB::table('add_to_cart')->where('id', $cartitemdetails->id)->update(array('item_quantity' => $quantity));
			$cartitem = DB::table('add_to_cart')->where('customer_id', $request->get('customer_id'))->get();
			$subtotal = 0;
			// $subtotal = DB::table('add_to_cart')->where('customer_id', $request->get('customer_id'))->sum('item_price');
			foreach ($cartitem as $value) {
				$subtotal += $value->item_price * $value->item_quantity;
			}
			$data['subtotal'] = $subtotal;
        	$count = DB::table('add_to_cart')->where('customer_id', $request->get('customer_id'))->count();
        	$data['count'] = $count;
		}
		if (!empty($cartitem)) {
					foreach ($cartitem as $product){
		               $data['html'] .= '<div class="cart-items-row">
		                            <div class="cart-product_img">
		                                <img src="https://localhost/salon/backend/images/logo-cstestseries3.png">
		                            </div>
		                            <div class="cart-items-details">
		                                <div class="row">
		                                    <div class="col-sm-8">
		                                        <!-- <div class="cartproduct-discount">
		                                            66
		                                             % OFF
		                                        </div> -->
		                                    </div>
		                                    <div class="col-sm-4 float-right">
		                                        <form id="remove_item_'.$product->id.'" action="'.route("cart.remove").'" method="POST" class="">
		                                            <input type = "hidden" name = "_token" value = "'.csrf_token().'">
		                                            <input name="id" type="hidden" value="'.$product->id.'">
		                                            <input name="cid" type="hidden" value="'.$product->customer_id.'">
		                                            <button type="button" onclick="removeItem('.$product->id.');" class="close">×</button>
		                                        </form>                                    
		                                    </div>
		                                </div>
		                                <div class="row">
		                                    <div class="col-sm-12">
		                                        <div class="cartproduct-name" title="'.$product->item_name.'">
		                                            '.$product->item_name.'
		                                        </div>
		                                        <div class="cartproduct-items">
		                                            <span class="cartnew-price"> '.$product->item_price.'
		                                            </span>
		                                            <span class=""> x <strong class="badge badge-warning badge-xs">'.$product->item_quantity.'</strong>
		                                            </span>
		                                            <div class="carttotel-price float-right badge badge-xs badge-info" style="border-radius: 7%">
		                                                ₹ '.$product->item_price * $product->item_quantity.'
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>';
		            }
				}else{
		            $data['html'] .= '<div class="cart-items-row">
		                        <div class="cart-product_img">
		                            <!-- <img src="https://localhost/salon/backend/images/logo-cstestseries3.png"> -->
		                        </div>
		                        <div class="cart-items-details">
		                            <div class="row">
		                                <div class="col-sm-8">
		                                    
		                                </div>
		                                <div class="col-sm-4 float-right">
		                                                                  
		                                </div>
		                            </div>
		                            <div class="row">
		                                <div class="col-sm-12">
		                                    
		                                    <div class="cartproduct-items">
		                                        <span class="cartnew-price"> Cart Empty
		                                        </span>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                    </div>';
		        }
		echo json_encode($data);
	}*/

	public function edit($id)
	{
		# code...
	}

	public function update(Request $request, $id)
	{
		# code...
	}

	public function deleteitem(Request $request)
	{
		$data['subtotal'] = "";
        $data['html'] = "";
        $data['count'] = "";
		$id = $request->get('id');
		$cid = $request->get('cid');
		$addtocart = addtocart::find($id);
        $addtocart->delete();
        $cartitem = DB::table('add_to_cart')->where('customer_id', $cid)->get();
		// $subtotal = DB::table('add_to_cart')->where('customer_id', $cid)->sum('item_price');
		$subtotal = 0;
		// $subtotal = DB::table('add_to_cart')->where('customer_id', $request->get('customer_id'))->sum('item_price');
		foreach ($cartitem as $value) {
			$subtotal += $value->item_price * $value->item_quantity;
		}
		$data['subtotal'] = $subtotal;
    	$count = DB::table('add_to_cart')->where('customer_id', $cid)->count();
    	$data['count'] = $count;
		if (!empty($cartitem)) {
			foreach ($cartitem as $product){
               $data['html'] .= '<div class="cart-items-row">
                            <div class="cart-product_img">
                                <img src="https://localhost/salon/backend/images/logo-cstestseries3.png">
                            </div>
                            <div class="cart-items-details">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <!-- <div class="cartproduct-discount">
                                            66
                                             % OFF
                                        </div> -->
                                    </div>
                                    <div class="col-sm-4 float-right">
                                        <form id="remove_item_'.$product->id.'" action="'.route("cart.remove").'" method="POST" class="">
                                            <input type = "hidden" name = "_token" value = "'.csrf_token().'">
                                            <input name="id" type="hidden" value="'.$product->id.'">
                                            <input name="cid" type="hidden" value="'.$product->customer_id.'">
                                            <button type="button" onclick="removeItem('.$product->id.');" class="close">×</button>
                                        </form>                                    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="cartproduct-name" title="'.$product->item_name.'">
                                            '.$product->item_name.'
                                        </div>
                                        <div class="cartproduct-items">
                                            <span class="cartnew-price"> '.$product->item_price.'
                                            </span>
                                            <span class=""> x <strong class="badge badge-warning badge-xs">'.$product->item_quantity.'</strong>
                                            </span>
                                            <div class="carttotel-price float-right badge badge-xs badge-info" style="border-radius: 7%">
                                                ₹ '.$product->item_price * $product->item_quantity.'
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
            }
		}else{
            $data['html'] .= '<div class="cart-items-row">
                        <div class="cart-product_img">
                            <!-- <img src="https://localhost/salon/backend/images/logo-cstestseries3.png"> -->
                        </div>
                        <div class="cart-items-details">
                            <div class="row">
                                <div class="col-sm-8">
                                    
                                </div>
                                <div class="col-sm-4 float-right">
                                                                  
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    
                                    <div class="cartproduct-items">
                                        <span class="cartnew-price"> Cart Empty
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
        }
        echo json_encode($data);
	}

	public function checkout(Request $request)
	{
		$customerid = $request->get('customerid');
		$getCustomer = DB::table('customers')->where('id',$customerid)->first();
		$cartitem = DB::table('add_to_cart')->where('customer_id', $customerid)->get();
		// $subtotal = DB::table('add_to_cart')->where('customer_id', $cid)->sum('item_price');
		$subtotal = 0;
		// $subtotal = DB::table('add_to_cart')->where('customer_id', $request->get('customer_id'))->sum('item_price');
		foreach ($cartitem as $value) {
			$subtotal += $value->item_price * $value->item_quantity;
		}
		$data['html'] = '<div class="modal-header">
				                <p class="heading lead py-0" id="headcount">
				                    Checkout
				                </p>
				                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				                    <span aria-hidden="true" class="white-text">×</span>
				                </button>
				            </div>
				            <form id="checknowform" method="post">
				            <div class="cart-modalbody">
				                <div class="cart-items-container" id="cart-item-body">
				            		<input type = "hidden" name = "_token" value = "'.csrf_token().'">
				            		<input type="hidden" name="customer_id" value="'.$customerid.'">
				            		<div class="form-group">
				            			<lable>Transaction Amount</lable>
				            			<input readonly type="text" class="form-control" name="totalamount" id="totalamount" value="'.$subtotal.'">
				            		</div>
				            		<div class="form-group">
				            		 	<input type="hidden" name="rewardpoints" id="rewardpoints" value="'.$getCustomer->reward_points.'">
				            			<lable>Use reward point (Avalaible reward points : '.$getCustomer->reward_points.')</lable>
				            			<input type="number" class="form-control" name="rewardpoint" id="rewardpoint" onkeyup="checkreward(this.value)" placeholder="Enter reward point">
				            		</div>
				            		<div class="form-group">
				            			<lable>Paid Amount</lable>
				            			<input type="number" class="form-control" name="paidamount" id="paidamount" onkeyup="checkamount(this.value)" placeholder="Enter paid amount">
				            		</div>
				            		<div class="form-group" style="display:none" id="remaindiv">
				            			<lable>Remaining Amount</lable>
				            			<input readonly type="number" class="form-control" name="remainamount" id="remainamount" placeholder="remaining amount">
				            		</div>
				            		<div class="form-group" style="display:none" id="duediv">
				            			<lable>Due Date</lable>
				            			<input type="date" class="form-control datepicker hasDatepicker" name="duedate" placeholder="Enter due date" data-date-format="yyyy-mm-dd" autocomplete="off">
				            		</div>
				            		<div class="form-group">
				            			<lable>Payment Mode</lable>
				            			<select class="form-control" name="pay_mode">
				            				<option>Select</option>
				            				<option>Cash</option>
				            				<option>Paytm</option>
				            				<option>Phonepe</option>
				            				<option>Google pay</option>
				            			</select>
				            		</div>
				            		<div class="form-group">
				            			<lable>Total Pay Amount</lable>
				            			<input readonly type="number" class="form-control" name="payamount" id="payamount" placeholder="payable amount" value="'.$subtotal.'">
				            		</div>
				                </div>
				            </div>
				            </form>
				            <div class="card-footer">
				            	<small class="cartpromo"></small>
				                <button id="checkoutbtn" type="button" onclick="checkoutnow()" class="btn btn-info btn-block waves-effect waves-light">Checkout</button>
				                <form id="cancel_form" action="" method="POST" class="">
                                    <input type = "hidden" name = "_token" value = "'.csrf_token().'">
                                    <input name="cid" type="hidden" value="'.$customerid.'">
				                	<a href="javascript:void(0)" onclick="cancelcheckout('.$customerid.')" class="btn btn-warning btn-block waves-effect waves-light">Cancel</a>
				                </form>
				            </div>
				        ';
		echo json_encode($data);
	}

	public function cancelcheckout(Request $request)
	{
		$data['subtotal'] = "";
        $data['html'] = "";
        $data['count'] = "";
		$cid = $request->get('cid');
		$cartitem = DB::table('add_to_cart')->where('customer_id', $cid)->get();
		// $subtotal = DB::table('add_to_cart')->where('customer_id', $cid)->sum('item_price');
		$subtotal = 0;
		// $subtotal = DB::table('add_to_cart')->where('customer_id', $request->get('customer_id'))->sum('item_price');
		foreach ($cartitem as $value) {
			$subtotal += $value->item_price * $value->item_quantity;
		}
		$data['subtotal'] = $subtotal;
    	$count = DB::table('add_to_cart')->where('customer_id', $cid)->count();
    	$data['count'] = $count;
		if (!empty($cartitem)) {
			foreach ($cartitem as $product){
               $data['html'] .= '<div class="cart-items-row">
                            <div class="cart-product_img">
                                <img src="https://localhost/salon/backend/images/logo-cstestseries3.png">
                            </div>
                            <div class="cart-items-details">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <!-- <div class="cartproduct-discount">
                                            66
                                             % OFF
                                        </div> -->
                                    </div>
                                    <div class="col-sm-4 float-right">
                                        <form id="remove_item_'.$product->id.'" action="'.route("cart.remove").'" method="POST" class="">
                                            <input type = "hidden" name = "_token" value = "'.csrf_token().'">
                                            <input name="id" type="hidden" value="'.$product->id.'">
                                            <input name="cid" type="hidden" value="'.$product->customer_id.'">
                                            <button type="button" onclick="removeItem('.$product->id.');" class="close">×</button>
                                        </form>                                    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="cartproduct-name" title="'.$product->item_name.'">
                                            '.$product->item_name.'
                                        </div>
                                        <div class="cartproduct-items">
                                            <span class="cartnew-price"> '.$product->item_price.'
                                            </span>
                                            <span class=""> x <strong class="badge badge-warning badge-xs">'.$product->item_quantity.'</strong>
                                            </span>
                                            <div class="carttotel-price float-right badge badge-xs badge-info" style="border-radius: 7%">
                                                ₹ '.$product->item_price * $product->item_quantity.'
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
            }
		}else{
            $data['html'] .= '<div class="cart-items-row">
                        <div class="cart-product_img">
                            <!-- <img src="https://localhost/salon/backend/images/logo-cstestseries3.png"> -->
                        </div>
                        <div class="cart-items-details">
                            <div class="row">
                                <div class="col-sm-8">
                                    
                                </div>
                                <div class="col-sm-4 float-right">
                                                                  
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    
                                    <div class="cartproduct-items">
                                        <span class="cartnew-price"> Cart Empty
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
        }
        echo json_encode($data);
	}

	public function checkoutnow(Request $request)
	{
		// print_r($_POST); die();
		$customerid = $request->get('customer_id');
		$totalamount = $request->get('totalamount');
		$paidamount = $request->get('paidamount');
		$payamount = $request->get('payamount');
		$rewardpoint = $request->get('rewardpoint');
		$remainingamount = $request->get('remainamount');
		if ($remainingamount == 0) {
			$status = 1;
		}else{
			$status = 0;
		}
		$pay_mode = $request->get('pay_mode');
		if (!empty($customerid) && !empty($paidamount) && !empty($pay_mode)) {
			$data = array(
	          'customer_id' => $customerid,
	          'payment_mode' => $pay_mode,
	          'transaction_amount' => $totalamount,
	          'reward_point' => $rewardpoint,
	          'total_pay_amount' => $payamount,
	          'remaining_amount' => $remainingamount,
	          'transaction_date' => date('Y-m-d H:i:s'),
	          'transaction_status' => $status,
	        );
	        $transactionid = DB::table('invoice_transactions')->insertGetId($data);
	        if (!empty($transactionid)) {
	        	$getCustomer = DB::table('customers')->where('id',$customerid)->first();
	        	if (!empty($getCustomer)) {
	        		$reward_point = $getCustomer->reward_points;
	        		$updateRewardPoint = $reward_point - $rewardpoint;
	        		DB::table('customers')->where('id', $customerid)->update(array('reward_points' => $updateRewardPoint));
	        	}
	        	$paiddata = array(
					'invoice_transaction_id' => $transactionid,
					'pay_amount' => $payamount,
					'paid_amount' => $paidamount,
					'remaining_amount' => $remainingamount,
					'paid_date' => date('Y-m-d H:i:s'),
					'due_date' => NULL,
					'status' => 1,
				);
				$paidtransactionremainid = DB::table('transaction_history')->insertGetId($paiddata);
	        	if ($remainingamount != 0) {
	        		$remaindata = array(
						'invoice_transaction_id' => $transactionid,
						'pay_amount' => $remainingamount,
						'paid_amount' => 0,
						'remaining_amount' => $remainingamount,
						'paid_date' => NULL,
						'due_date' => date('Y-m-d H:i:s',strtotime($request->get('duedate'))),
						'status' => $status,
					);
					$transactionremainid = DB::table('transaction_history')->insertGetId($remaindata);
	        	}
	        	$cartitem = DB::table('add_to_cart')->where('customer_id', $customerid)->get();
				foreach ($cartitem as $value) {
					$servicedata = array(
						'invoice_transaction_id' => $transactionid,
						'product_id' => $value->item_id,
						'quantity' => $value->item_quantity,
						'price' => $value->item_price,
						'date_of_service' => date('Y-m-d H:i:s'),
						'status' => 1,
					);
					$transactiondetailsid = DB::table('invoice_trsansaction_details')->insertGetId($servicedata);
					if (!empty($transactiondetailsid)) {
						DB::table('add_to_cart')->where('id', '=', $value->id)->delete();
					}
				}
				$status = "Done";
	        }else{
	        	$status = "Failed";
	        }
		}else{
			$status = "Failed";
		}
		echo json_encode($status);
	}

	public function invoice($id)
	{
		$invoicetrans = DB::table('invoice_transactions')->leftJoin('customers','customers.id','=','invoice_transactions.customer_id')->where('invoice_transactions.invoice_transaction_id', $id)->first();
		$usedservice = DB::table('invoice_trsansaction_details')->leftJoin('invoice_transactions','invoice_transactions.invoice_transaction_id','=','invoice_trsansaction_details.invoice_transaction_id')->leftJoin('service_products','service_products.product_id','=','invoice_trsansaction_details.product_id')->where('invoice_trsansaction_details.invoice_transaction_id', $id)->get();
		// print_r($usedservice);
        
		return view('customer.invoice')->with(['invoicetrans'=>$invoicetrans,'usedservice'=>$usedservice]);
	}


	public function viewhistory($id)
	{
		$data = "";
		if (!empty($id)) {
			$history = DB::table('transaction_history')->where('invoice_transaction_id',$id)->get();
			if (!empty($history)) {
				foreach ($history as $value) {
					if ($value->due_date != NULL && !empty($value->due_date)) {
						$duedate = date('d-M-Y',strtotime($value->due_date));
					}else{
						$duedate = "NA";
					}
					if ($value->paid_date != NULL && !empty($value->paid_date)) {
						$paiddate = date('d-M-Y',strtotime($value->paid_date));
					}else{
						$paiddate = "NA";
					}
					if ($value->status == 1) {
						$td = "<td><a href='javascript:void(0)' type='button' class='btn btn-success waves-effect waves-light btn-sm'>Print invoice</a></td>";
					}else{
						$td = "<td><a onclick='payRemainAmount(".$value->transaction_history_id.")' href='javascript:void(0)' type='button' class='btn btn-danger waves-effect waves-light btn-sm'>Paid</a></td>";
					}
					$data .= "<tr><td>".$value->pay_amount."</td><td>".$value->paid_amount."</td><td>".$value->remaining_amount."</td><td>".$paiddate."</td><td>".$duedate."</td>".$td."</tr>";
				}
			}else{
				$data .= "";
			}
		}
		echo $data;
	}

	public function makePaymentForm($id)
	{
		$data = array();
		$transaction = DB::table('transaction_history')->where('transaction_history_id',$id)->first();
		if (!empty($transaction)) {
			$data['pay_amount'] = $transaction->pay_amount;
		}

		echo json_encode($data);
	}

	public function makePayment(Request $request)
	{
		$transactionid = $request->get('transactionid');
		$totalamount = $request->get('totalamount');
		$paidamount = $request->get('paidamount');
		$remainamount = $request->get('remainamount');
		$duedate = $request->get('duedate');
		$pay_mode = $request->get('pay_mode');
		$payamount = $request->get('payamount');
		$getData = DB::table('transaction_history')->where('transaction_history_id',$transactionid)->first();
		if (!empty($getData)) {
			$invoice_transaction_id = $getData->invoice_transaction_id;
			DB::table('invoice_transactions')->where('invoice_transaction_id',$invoice_transaction_id)->update(array('remaining_amount' => $remainamount));
			DB::table('transaction_history')->where('transaction_history_id',$transactionid)->update(array('status' => 1,'paid_amount'=>$paidamount,'due_date'=>NULL,'remaining_amount'=>$remainamount,'paid_date'=>date('Y-m-d H:i:s')));
			if ($remainamount != 0) {
        		$remaindata = array(
					'invoice_transaction_id' => $invoice_transaction_id,
					'pay_amount' => $remainamount,
					'paid_amount' => 0,
					'remaining_amount' => $remainamount,
					'due_date' => date('Y-m-d H:i:s',strtotime($request->get('duedate'))),
					'status' => 0,
				);
				$transactionremainid = DB::table('transaction_history')->insertGetId($remaindata);
        	}
        	echo "Done";
		}else{
			echo "Fail";
		}
	}
}  
?>