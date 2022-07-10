<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Model\admin\Enquiry;
use App\Model\admin\Enquiry_categories;
use App\Model\admin\Packages;
use App\Model\admin\Remark;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $enquiry = Enquiry::all();
        return view('admin.enquiry.enquiry_list', compact('enquiry'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $packages = Packages::all();
        $categories = Enquiry_categories::where('is_active', '1')->get();
        return view('admin.enquiry.enquiry_create', compact('packages', 'categories'));
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
            'name' => 'required',
            'contact' => 'required',
            'enq_for' => 'required',
        ]);
        $enquiry = new enquiry([
            'sid' => Auth::user()->id,
            'name' => $request->name,
            'date' => date('Y-m-d'),
            'contact' => $request->contact,
            'enq_for' => $request->enq_for,
            'description' => $request->description,
            'status' => 'new',
        ]);
        $enquiry->save();
        echo json_encode(['msg' => true]);
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
        $enquiry = enquiry::find($id);
        $packages = Packages::all();
        $categories = Enquiry_categories::where('is_active', '1')->get();
        return view('admin.enquiry.enquiry_edit')->with(['enquiry' => $enquiry, 'packages' => $packages, 'categories' => $categories]);
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
            'name' => 'required',
            'contact' => 'required',
            'package_id' => 'required',
            'remark' => 'required',
            'category_id' => 'required',
        ]);

        $enquiry = enquiry::find($id);
        $enquiry->name = $request->get('name');
        $enquiry->address = $request->get('address');
        $enquiry->email = $request->get('email');
        $enquiry->contact = $request->get('contact');
        $enquiry->package_id = $request->get('package_id');
        $enquiry->contact = $request->get('contact');
        $enquiry->remark = $request->get('remark');
        $enquiry->category_id = $request->get('category_id');
        $enquiry->save();

        return redirect('admin/enquiry')->with('success', 'Enquiry updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $enquiry = enquiry::find($id);
        $enquiry->delete();
        return redirect('/admin/enquiry')->with('success', 'Enquiry deleted!');
    }

    public function addremark(Request $request)
    {

        $remark = new Remark([
            'sid' => Auth::user()->id,
            'c_id' => $request->get('cid'),
            'remark' => $request->get('remark'),
            'status_id' => $request->get('status'),
            'date' => date('Y-m-d', strtotime($request->get('date'))),
        ]);

        $remark->save();
        $row = array();
        if ($remark->id) {
            $row['status'] = 1;
            $row['msg'] = '<div class="alert alert-success">Remark Added successfully</div>';
        } else {
            $row['status'] = 0;
            $row['msg'] = '<div class="alert alert-danger">Remark Not added</div>';
        }
        echo json_encode($row);
    }

    public function viewremark(Request $request)
    {
        $id = $request->get('id');
        $remark = Remark::where(['is_del' => 0, 'c_id' => $id])->orderBy('date', 'DESC')->get();
        echo json_encode($remark);
    }

    public function status_update(Request $request)
    {
        $enquiry = enquiry::where('id', $request->enq_id)->first();
        $enquiry->status = $request->Status;
        $enquiry->save();
        echo json_encode(['msg' => true]);
    }

    public function enquiry_details(Request $request){
        try {
            $enq_id = $request->enq_id;
            $enq_data = enquiry::where('id', $enq_id)->first();
            echo json_encode(['msg' => true, 'data' => $enq_data]);
        } catch (\Exception $e) {
            echo json_encode(['msg' => false]);
        }
    }

    public function update_details(Request $request)
    {
        try {
            $enq_data = enquiry::find($request->enq_id);
            // $enq_data->name = $request->name;
            // $enq_data->contact = $request->contact;
            // $enq_data->enq_for = $request->enq_for;
            $enq_data->description = $request->description;
            $enq_data->save();
            echo json_encode(['msg' => true, 'data' => $enq_data]);
        } catch (\Exception $e) {
            echo json_encode(['msg' => false]);
        }
    }

}
