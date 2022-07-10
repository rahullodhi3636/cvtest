<?php  
namespace App\Http\Controllers\admin;
use App\Model\admin\Brand;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
	public function index($value='')
	{
		$getBrands = DB::table('product_brands')->get();
		return view('admin.brand.brandlist')->with(['brands'=>$getBrands]);
	}

	public function create(){
        $services = DB::table('services')->get();
        return view('admin.brand.brandcreate',compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
        // print_r($_POST); die();
     	$this->validate($request, [
            'service'=>'required',
            'brand_name'=>'required|unique:product_brands',
            'description'=>'required',
            'status'=>'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $input['image'] = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('images/brand/'), $input['image']);

        $brand = new brand([            
            'service_id' => $request->get('service'),
            'brand_name' => $request->get('brand_name'),
            'brand_description' => $request->get('description'),
            'status' => $request->get('status'),
            'brand_icon' => $input['image'],
        ]);
    
        
        $brand->save();
        return redirect('admin/brand')->with('success', 'Brand saved!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $services = DB::table('services')->get();
        $brand = brand::find($id);
        return view('admin.brand.brandedit')->with(['brand'=>$brand,'services'=>$services]); 
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
       $this->validate($request, [
                'service'=>'required',
                'brand_name'=>'required',
                'description'=>'required',
                'status'=>'required',
       ]);
        if($request->file('image')!=null){
            $input['image'] = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/brand/'), $input['image']);
            $brand = brand::find($id);
            $brand->service_id =  $request->get('service');
            $brand->brand_name =  $request->get('brand_name');
            $brand->brand_description =  $request->get('description');
            $brand->status = $request->get('status');
            $brand->brand_icon = $input['image'];
            $brand->save();
        }else{
            $brand = brand::find($id);
            $brand->service_id =  $request->get('service');
            $brand->brand_name =  $request->get('brand_name');
            $brand->brand_description =  $request->get('description');
            $brand->status = $request->get('status');
            $brand->save();
        }
        

        return redirect('admin/brand')->with('success', 'Brand updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = brand::find($id);
        $brand->delete();
        return redirect('/admin/brand')->with('success', 'Brand deleted!');
    }
}
?>