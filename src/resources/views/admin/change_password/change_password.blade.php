@extends('layouts.adminmaster')
@section('title', 'Change Password')
@section('content')

<div class="right-details-box">
            <div class="home_brics_row">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dash_boxcontainner white_boxlist">
                            <div class="upper_basic_heading">
                                <span class="white_dash_head_txt">Change Password <a href="{{ url('home') }}" class="btn margin0 btn-sm btn-mdb-color single-table-btn float-right waves-effect waves-light" ><i class="mdi mdi-arrow-left mr-1"></i>Back</a> </span>
                            </div>
                            <div class="panel-body dash_table_containner">
                            @if($message=Session::get('success'))
                            <div class="alert alert-success">
                              <p>{{ $message }}</p>
                            </div>
                            @endif
                            @if($message=Session::get('error'))
                            <div class="alert alert-success">
                              <p>{{ $message }}</p>
                            </div>
                            @endif
                            <!--  -->
                            <div class="col-md-12">
                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('change_password.store') }}" method = "post" enctype="multipart/form-data">
                                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Old Password <span class="required">*</span>
                                  </label>
                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="password"  id="old_password" name="old_password" value="{{ old('old_password') }}" placeholder="Enter old password"  class="form-control col-md-7 col-xs-12">
                                    <span class="text text-danger"> @if ($errors->has('old_password')){{ $errors->first('old_password') }} @endif</span>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">New Password <span class="required">*</span>
                                  </label>
                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="password"  id="new_password" name="new_password" value="{{ old('new_password') }}" placeholder="Enter new password"  class="form-control col-md-7 col-xs-12">
                                    <span class="text text-danger"> @if ($errors->has('new_password')){{ $errors->first('new_password') }} @endif</span>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Confirm Password <span class="required">*</span>
                                  </label>
                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="password"  id="confirm_password" name="confirm_password" value="{{ old('confirm_password') }}" placeholder="Enter confirm password"  class="form-control col-md-7 col-xs-12">
                                    <span class="text text-danger"> @if ($errors->has('confirm_password')){{ $errors->first('confirm_password') }} @endif</span>
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