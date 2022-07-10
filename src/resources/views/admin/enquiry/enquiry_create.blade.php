@extends('layouts.adminmaster')
@section('title', 'Enquiry')
@section('content')

<div class="right-details-box">
            <div class="home_brics_row">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dash_boxcontainner white_boxlist">
                            <div class="upper_basic_heading">
                                <span class="white_dash_head_txt">Add Enquiry <a href="{{ url('admin/enquiry') }}" class="btn margin0 btn-sm btn-mdb-color single-table-btn float-right waves-effect waves-light" ><i class="mdi mdi-arrow-left mr-1"></i>Back</a> </span>
                            </div>
                            <div class="panel-body dash_table_containner">
                            @if($message=Session::get('success'))
                            <div class="alert alert-success">
                              <p>{{ $message }}</p>
                            </div>
                            @endif
                            <div class="col-md-12">
                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('enquiry.store') }}" method = "post" enctype="multipart/form-data">
                                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                                  </label>
                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="text"  id="name" name="name" value="{{ old('name') }}" placeholder="Enter name"  class="form-control col-md-7 col-xs-12">
                                    <span class="text text-danger"> @if ($errors->has('name')){{ $errors->first('name') }} @endif</span>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email
                                  </label>
                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="email"  id="email" name="email" value="{{ old('email') }}" placeholder="Enter email"  class="form-control col-md-7 col-xs-12">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">contact <span class="required">*</span>
                                  </label>
                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="number"  id="contact" name="contact" value="{{ old('contact') }}" placeholder="Enter contact no"  class="form-control col-md-7 col-xs-12">
                                    <span class="text text-danger"> @if ($errors->has('contact')){{ $errors->first('contact') }} @endif</span>
                                  </div>
                                </div>


                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Address <span class="required">*</span>
                                  </label>
                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                    <textarea id="address" name="address" placeholder="Enter address"  class="form-control col-md-7 col-xs-12">{{ old('address') }}</textarea>
                                    <span class="text text-danger"> @if ($errors->has('address')){{ $errors->first('address') }} @endif</span>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_id">Categories <span class="required">*</span>
                                  </label>
                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                    <select name="category_id" class="form-control col-md-7 col-xs-12">
                                         <option value="">--category--</option>
                                         @if(!empty($categories))
                                           @foreach($categories as $Key => $value)
                                             <option value="{{ $value->id }}"  {{ old('category_id') == $value->id ? 'selected' : '' }}>{{ $value->category }}</option>
                                           @endforeach 
                                         @endif
                                    </select>
                                    
                                    <span class="text text-danger"> @if ($errors->has('category_id')){{ $errors->first('category_id') }} @endif</span>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="package_id">Packages <span class="required">*</span>
                                  </label>
                                  <div class="col-md-12 col-sm-12 col-xs-12"">
                                    <select name="package_id" class="form-control col-md-7 col-xs-12">
                                         <option value="">--select--</option>
                                         @if(!empty($packages))
                                           @foreach($packages as $Key => $value)
                                             <option value="{{ $value->package_id }}"  {{ old('package_id') == $value->id ? 'selected' : '' }}>{{ $value->package_title }}</option>
                                           @endforeach 
                                         @endif
                                    </select>
                                    
                                    <span class="text text-danger"> @if ($errors->has('package_id')){{ $errors->first('package_id') }} @endif</span>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="remark">Remark <span class="required">*</span>
                                  </label>
                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                    <textarea id="address" name="remark" placeholder="Enter Remark"  class="form-control col-md-7 col-xs-12">{{ old('remark') }}</textarea>
                                    <span class="text text-danger"> @if ($errors->has('address')){{ $errors->first('address') }} @endif</span>
                                  </div>
                                </div>

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                  <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
                                    <button type="submit" class="btn btn-success">Save</button>
                                  </div>
                                </div>

                              </form>
                            </div>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection