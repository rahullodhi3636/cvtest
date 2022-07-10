<?php

namespace App\Http\Controllers\admin;

use App\Model\admin\Enquiry_categories;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class Enquiry_categoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $enquiry_categories = Enquiry_categories::all();
        return view('admin.enquiry_categories.enquiry_categories_list', compact('enquiry_categories'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin.enquiry_categories.enquiry_categories_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       

         

            $this->validate($request, [
                'category'=>'required|unique:enquiry_categories',
            ]);
            
            

            $enquiry_categories = new enquiry_categories([
                'admin_id' => Auth::user()->id,
                'category' => $request->get('category'),
                'created_at' => date('Y-m-d'),
                'is_active' => $request->get('is_active')
            ]);
        
            
            $enquiry_categories->save();
            return redirect('admin/enquiry_categories')->with('success', 'Category saved!');
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
        $enquiry_categories = enquiry_categories::find($id);
        return view('admin.enquiry_categories.enquiry_categories_edit')->with(['enquiry_categories'=>$enquiry_categories]); 
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
                'category'=>'required|unique:enquiry_categories,id,'.$id
       ]);

        $enquiry_categories = enquiry_categories::find($id);
        $enquiry_categories->category =  $request->get('category');
        $enquiry_categories->is_active = $request->get('is_active');
        $enquiry_categories->save();

        return redirect('admin/enquiry_categories')->with('success', 'Category updated!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $enquiry_categories = enquiry_categories::find($id);
        $enquiry_categories->delete();
        return redirect('/admin/enquiry_categories')->with('success', 'Category deleted!');
    }
}