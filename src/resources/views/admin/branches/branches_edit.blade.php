@extends('layouts.adminmaster')
@section('title', 'Hotels')
@section('content')
<div class="right-details-box">
            <div class="home_brics_row">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dash_boxcontainner white_boxlist">
                            <div class="upper_basic_heading">
                                <span class="white_dash_head_txt">Add Branches <a href="{{ url('admin/branches') }}" class="btn margin0 btn-sm btn-mdb-color single-table-btn float-right waves-effect waves-light" ><i class="mdi mdi-arrow-left mr-1"></i>Back</a> </span>
                            </div>
                            <div class="panel-body dash_table_containner">
                            @if($message=Session::get('success'))
                            <div class="alert alert-success">
                              <p>{{ $message }}</p>
                            </div>
                            @endif
                            <div class="col-md-12">
                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('branches.update', $branches->id) }}" method = "post" enctype="multipart/form-data">
                                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                                <input type="hidden" name="_method" value="patch" />
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                                  </label>
                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="text"  id="name" name="name" value="{{ old('name',$branches->name) }}" placeholder="Enter name"  class="form-control col-md-7 col-xs-12">
                                    <span class="text text-danger"> @if ($errors->has('name')){{ $errors->first('name') }} @endif</span>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Address <span class="required">*</span>
                                  </label>
                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                    <textarea id="address" name="address" placeholder="Enter address"  class="form-control col-md-7 col-xs-12">{{ old('address',$branches->address) }}</textarea>
                                    <span class="text text-danger"> @if ($errors->has('address')){{ $errors->first('address') }} @endif</span>
                                  </div>
                                </div>


                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Phone <span class="required">*</span>
                                  </label>
                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="number"  id="phone" name="phone" value="{{ old('phone',$branches->phone) }}" placeholder="Enter mobile no"  class="form-control col-md-7 col-xs-12">
                                    <span class="text text-danger"> @if ($errors->has('phone')){{ $errors->first('phone') }} @endif</span>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Status <span class="required">*</span>
                                  </label>
                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                    <select name="status" class="form-control col-md-7 col-xs-12" id="status">
                                        <option value="1" {{ old('status',$branches->status) == '1'? 'selected' : '' }} >Active</option>
                                        <option value="0" {{ old('status',$branches->status) == '0' ? 'selected' : '' }}>Deactive</option>
                                    </select>
                                    <span class="text text-danger"> @if ($errors->has('status')){{ $errors->first('status') }} @endif</span>
                                  </div>
                                </div>
                            
                              
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                  <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
                                    <button type="submit" class="btn btn-success">Update</button>
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
@section('script')
@endsection