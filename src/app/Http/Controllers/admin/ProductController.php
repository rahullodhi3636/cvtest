<?php  
namespace App\Http\Controllers\admin;

use App\Model\admin\Products;
use App\Model\admin\Product_type;
use App\Model\admin\Firm;
use App\User;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
	public function index()
	{
		$products = DB::table('products AS P')->select('P.*','F.firm_name')->leftJoin('firms AS F','F.id','=','P.firm_id')->get();
		$firms = Firm::all();
		return view('admin.products.productlist', compact('products','firms'));
	}

  public function product_type()
	{
		$products = DB::table('product_type AS P')->select('P.*','F.firm_name')->leftJoin('firms AS F','F.id','=','P.firm_id')->get();
		$firms = Firm::all();
		return view('admin.products.producttype', compact('products','firms'));
	}

	public function store(Request $request)
	{
		$data['html'] = '';
		$data['count'] = '';
		$this->validate($request, [
            'firm'=>'required',
            'product_name'=>'required|unique:products',
            'product_price'=>'required',
            'product_quantity'=>'required',
        ]);

        $productinsert = new Products([
            'firm_id' => $request->get('firm'),
            'product_name' => $request->get('product_name'),
            'product_price' => $request->get('product_price'),
            'special_price' => $request->get('special_price'),
            'product_quantity' => $request->get('product_quantity'),
            'status' => 1,
        ]);
        $productinsert->save();
        $id = $productinsert->id;
        if (!empty($id)) {
        	$products = DB::table('products AS P')->select('P.*','F.firm_name')->leftJoin('firms AS F','F.id','=','P.firm_id')->get();
        	if (!empty($products)) {
        		$data['count'] .= count($products);
        		foreach ($products as $cat) {
        			$data['html'] .= '<tr>
                        <td>'.$cat->product_name.'</td>
                        <td>'.$cat->firm_name.'</td>
                        <td>'.$cat->product_price.'</td>
                        <td>'.$cat->product_quantity.'</td>
                        <td>';
                            if($cat->status ==1){         
                                $data['html'] .= 'In-stock';        
                            }else{
                                $data['html'] .= 'Out-stock';
                            }
                        $data['html'] .= '</td>
                        <td>
                          <table >
                            <tr>
                              <th style="padding: 0">
                                <a href="javascript:void(0)" onclick="getProductById('.$cat->id.')" class="btn-primary btn-sm waves-effect waves-light text-light material-tooltip-main" data-toggle="tooltip" data-html="true" title="Edit">
                                  <i class="fa fa-edit"></i>
                                </a>
                              </th>
                              <th style="padding: 0">
                                <button onclick="deleteProduct('.$cat->id.')" class="btn-danger btn-sm waves-effect waves-light material-tooltip-main" type="button" style="border:0 !important" data-toggle="tooltip" data-html="true" title="Delete"><i class="fa fa-close"></i></button>
                              </th>
                            </tr>
                          </table>
                        </td>
                      </tr>';
        		}
        	}else{
        		$data['count'] = '';
        		$data['html'] = '';
        	}
        }else{
        	$data['count'] = '';
        	$data['html'] = '';
        }
        echo json_encode($data);
	}

  public function addproductstype(Request $request)
	{
		$data['html'] = '';
		$data['count'] = '';
		$this->validate($request, [
            'firm'=>'required',
            'product_name'=>'required|unique:products',
        ]);

        $productinsert = new Product_type([
            'firm_id' => $request->get('firm'),
            'type_name' => $request->get('product_name'),
            'status' => 1,
        ]);
        $productinsert->save();
        $id = $productinsert->id;
        if (!empty($id)) {
        	$products = DB::table('product_type AS P')->select('P.*','F.firm_name')->leftJoin('firms AS F','F.id','=','P.firm_id')->get();
        	if (!empty($products)) {
        		$data['count'] .= count($products);
        		foreach ($products as $cat) {
        			$data['html'] .= '<tr>
                        <td>'.$cat->type_name.'</td>
                        <td>'.$cat->firm_name.'</td>
                       
                        <td>';
                            if($cat->status ==1){         
                                $data['html'] .= 'In-stock';        
                            }else{
                                $data['html'] .= 'Out-stock';
                            }
                        $data['html'] .= '</td>
                        <td>
                          <table >
                            <tr>
                              <th style="padding: 0">
                                <a href="javascript:void(0)" onclick="getProductById('.$cat->id.')" class="btn-primary btn-sm waves-effect waves-light text-light material-tooltip-main" data-toggle="tooltip" data-html="true" title="Edit">
                                  <i class="fa fa-edit"></i>
                                </a>
                              </th>
                              <th style="padding: 0">
                                <button onclick="deleteProduct('.$cat->id.')" class="btn-danger btn-sm waves-effect waves-light material-tooltip-main" type="button" style="border:0 !important" data-toggle="tooltip" data-html="true" title="Delete"><i class="fa fa-close"></i></button>
                              </th>
                            </tr>
                          </table>
                        </td>
                      </tr>';
        		}
        	}else{
        		$data['count'] = '';
        		$data['html'] = '';
        	}
        }else{
        	$data['count'] = '';
        	$data['html'] = '';
        }
        echo json_encode($data);
	}

	public function getProductById(Request $request)
	{
		$productid = $request->productid;
		$product = DB::table('products')->where('id',$productid)->first();
        echo json_encode($product);
	}

	public function updateProduct(Request $request)
	{
		$data['html'] = '';
		$data['count'] = '';
		$this->validate($request, [
            'editfirm'=>'required',
            'editproduct_name'=>'required',
            'editproduct_price'=>'required',
            'editproduct_quantity'=>'required',
        ]);

        $update = Products::find($request->editproductid);
        $update->firm_id =  $request->editfirm;
        $update->product_name =  $request->editproduct_name;
        $update->product_price =  $request->editproduct_price;
        $update->special_price =  $request->editspecial_price;
        $update->product_quantity =  $request->editproduct_quantity;
        $update->save();
        $products = DB::table('products AS P')->select('P.*','F.firm_name')->leftJoin('firms AS F','F.id','=','P.firm_id')->get();
    	if (!empty($products)) {
    		$data['count'] .= count($products);
    		foreach ($products as $cat) {
    			$data['html'] .= '<tr>
                    <td>'.$cat->product_name.'</td>
                    <td>'.$cat->firm_name.'</td>
                    <td>'.$cat->product_price.'</td>
                    <td>'.$cat->product_quantity.'</td>
                    <td>';
                        if($cat->status ==1){         
                            $data['html'] .= 'In-stock';        
                        }else{
                            $data['html'] .= 'Out-stock';
                        }
                    $data['html'] .= '</td>
                    <td>
                      <table >
                        <tr>
                          <th style="padding: 0">
                            <a href="javascript:void(0)" onclick="getProductById('.$cat->id.')" class="btn-primary btn-sm waves-effect waves-light text-light material-tooltip-main" data-toggle="tooltip" data-html="true" title="Edit">
                              <i class="fa fa-edit"></i>
                            </a>
                          </th>
                          <th style="padding: 0">
                            <button onclick="deleteProduct('.$cat->id.')" class="btn-danger btn-sm waves-effect waves-light material-tooltip-main" type="button" style="border:0 !important" data-toggle="tooltip" data-html="true" title="Delete"><i class="fa fa-close"></i></button>
                          </th>
                        </tr>
                      </table>
                    </td>
                  </tr>';
    		}
    	}else{
    		$data['count'] = '';
    		$data['html'] = '';
    	}

    	echo json_encode($data);
	}

	public function deleteProductById(Request $request)
	{
		$data['html'] = '';
		$data['count'] = '';
		$delete = Products::find($request->productid);
        $delete->delete();
        $products = DB::table('products AS P')->select('P.*','F.firm_name')->leftJoin('firms AS F','F.id','=','P.firm_id')->get();
    	if (!empty($products)) {
    		$data['count'] .= count($products);
    		foreach ($products as $cat) {
    			$data['html'] .= '<tr>
                    <td>'.$cat->product_name.'</td>
                    <td>'.$cat->firm_name.'</td>
                    <td>'.$cat->product_price.'</td>
                    <td>'.$cat->product_quantity.'</td>
                    <td>';
                        if($cat->status ==1){         
                            $data['html'] .= 'In-stock';        
                        }else{
                            $data['html'] .= 'Out-stock';
                        }
                    $data['html'] .= '</td>
                    <td>
                      <table >
                        <tr>
                          <th style="padding: 0">
                            <a href="javascript:void(0)" onclick="getProductById('.$cat->id.')" class="btn-primary btn-sm waves-effect waves-light text-light material-tooltip-main" data-toggle="tooltip" data-html="true" title="Edit">
                              <i class="fa fa-edit"></i>
                            </a>
                          </th>
                          <th style="padding: 0">
                            <button onclick="deleteProduct('.$cat->id.')" class="btn-danger btn-sm waves-effect waves-light material-tooltip-main" type="button" style="border:0 !important" data-toggle="tooltip" data-html="true" title="Delete"><i class="fa fa-close"></i></button>
                          </th>
                        </tr>
                      </table>
                    </td>
                  </tr>';
    		}
    	}else{
    		$data['count'] = '';
    		$data['html'] = '';
    	}

    	echo json_encode($data);
	}


}
?>