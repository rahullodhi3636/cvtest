<?php

namespace App\Http\Controllers\admin;

use Cart;
use App\Model\admin\Services;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request){
        $data['subtotal'] = "";
        $data['html'] = "";
        $data['count'] = "";
        $service = Services::find($request->id);

        Cart::add($service->id, $service->name, $service->service_price, 1, array());
        $data['subtotal'] = Cart::getSubTotal();
        $data['count'] = Cart::getContent()->count();
        if(!Cart::isEmpty()){
            foreach (Cart::getContent() as $product){
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
                                            <button type="button" onclick="removeItem('.$product->id.');" class="close">×</button>
                                        </form>                                    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="cartproduct-name" title="'.$product->name.'">
                                            '.$product->name.'
                                        </div>
                                        <div class="cartproduct-items">
                                            <span class="cartnew-price"> '.$product->price.'
                                            </span>
                                            <span class=""> x <strong class="badge badge-warning badge-xs">'.$product->quantity.'</strong>
                                            </span>
                                            <div class="carttotel-price float-right badge badge-xs badge-info" style="border-radius: 7%">
                                                ₹ '.$product->price * $product->quantity.'
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

    public function cart(){
        $params = [
            'title' => 'Shopping Cart Checkout',
        ];

        return view('admin/cart/cart')->with($params);
    }

    public static function remove(Request $request)
    {
        $data['subtotal'] = "";
        $data['html'] = "";
        $data['count'] = "";
        $id = $request->id;
        if(!empty($id)){
            // $data = "";
            Cart::remove($id);
            $data['subtotal'] = Cart::getSubTotal();
            $data['count'] = Cart::getContent()->count();
            if(!Cart::isEmpty()){
                foreach (Cart::getContent() as $product){
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
                                                <button type="button" onclick="removeItem('.$product->id.');" class="close">×</button>
                                            </form>                                    
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="cartproduct-name" title="'.$product->name.'">
                                                '.$product->name.'
                                            </div>
                                            <div class="cartproduct-items">
                                                <span class="cartnew-price"> '.$product->price.'
                                                </span>
                                                <span class=""> x <strong class="badge badge-warning badge-xs">'.$product->quantity.'</strong>
                                                </span>
                                                <div class="carttotel-price float-right badge badge-xs badge-info" style="border-radius: 7%">
                                                    ₹ '.$product->price * $product->quantity.'
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

    public function clear(){
        Cart::clear();

        return back()->with('success',"The shopping cart has successfully beed added to the shopping cart!");;
    }
}