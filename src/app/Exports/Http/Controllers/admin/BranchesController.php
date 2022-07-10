<?php

namespace App\Http\Controllers\admin;

use App\Model\admin\Branches;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class BranchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $branches = Branches::all();
        return view('admin.branches.branches_list', compact('branches'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin.branches.branches_create');
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
                'name'=>'required|unique:branches',
                'address'=>'required',
                'phone'=>'required',
                'status'=>'required'
            ]);
            
            

            $branches = new branches([
                'admin_id' => Auth::user()->id,
                'name' => $request->get('name'),
                'address' => $request->get('address'),
                'phone' => $request->get('phone'),
                'status' => $request->get('status')
            ]);
        
            
            $branches->save();
            return redirect('admin/branches')->with('success', 'Branch saved!');
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
        $branches = branches::find($id);
        return view('admin.branches.branches_edit')->with(['branches'=>$branches]); 
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
                //'name'=>'required|unique:branches,id,'.$id,
                'name'=>'required',
                'address'=>'required',
                'phone'=>'required',
                'status'=>'required'
       ]);

        $branches = branches::find($id);
        $branches->name =  $request->get('name');
        $branches->address =  $request->get('address');
        $branches->phone =  $request->get('phone');
        $branches->status = $request->get('status');
        $branches->save();

        return redirect('admin/branches')->with('success', 'Branch updated!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $branches = branches::find($id);
        $branches->delete();
        return redirect('/admin/branches')->with('success', 'Branch deleted!');
    }
}