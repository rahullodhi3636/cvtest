@extends('layouts.adminmaster')
@section('title', 'Manageusers')
@section('content')

    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Manageusers</h3>
              </div>

            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add <small>users</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li> <a href="{{ route('manageusers.index') }}" title="Back"><i class="fa fa-arrow-left"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />

                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('manageusers.store') }}" method = "post" enctype="multipart/form-data">
                      <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                      
                      <div class="col-md-3 text-center">
                        <div class="">
                          <img src="{{asset('frontend/images/default-pic.png')}}" class="img-circle" style="width:100px">
                          <div class="form-group ">
                            <input type="file" name="image" class="pull-right">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-9">
                        
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label  for="name">First Name <span class="required">*</span></label>
                              <input type="text"  id="name" name="name" value="{{ old('name') }}" class="form-control">
                              <span class="text text-danger"> @if ($errors->has('name')){{ $errors->first('name') }} @endif</span>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="lname">Last Name <span class="required">*</span></label>
                              <input type="text"  id="lname" name="lname" value="{{ old('lname') }}"  class="form-control">
                              <span class="text text-danger"> @if ($errors->has('lname')){{ $errors->first('lname') }} @endif</span>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label  for="parent_name">Father's/Husband's name <span class="required">*</span></label>
                              <input type="text"  id="parent_name" name="parent_name" value="{{ old('parent_name') }}"  class="form-control">
                              <span class="text text-danger"> @if ($errors->has('parent_name')){{ $errors->first('parent_name') }} @endif</span>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="email">Email <span class="required">*</span></label>
                              <input type="text"  id="email" name="email" value="{{ old('email') }}" class="form-control">
                              <span class="text text-danger"> @if ($errors->has('email')){{ $errors->first('email') }} @endif</span>
                            </div>
                          </div>
                        </div>


                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label  for="phone_no">Phone no.</label>
                              <input type="text"  id="phone_no" name="phone_no" value="{{ old('phone_no') }}" class="form-control">
                              <span class="text text-danger"> @if ($errors->has('phone_no')){{ $errors->first('phone_no') }} @endif</span>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="mobile_no">Mobile no.<span class="required">*</span></label>
                              <input type="text"  id="mobile_no" name="mobile_no" value="{{ old('mobile_no') }}"  class="form-control">
                              <span class="text text-danger"> @if ($errors->has('mobile_no')){{ $errors->first('mobile_no') }} @endif</span>
                            </div>
                          </div>
                        </div>


                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label  for="dob">Date of birth<span class="required">*</span></label>
                              <input type="text"  id="dob" name="dob" value="{{ old('dob') }}"  class="form-control datepicker">
                              <span class="text text-danger"> @if ($errors->has('dob')){{ $errors->first('dob') }} @endif</span>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="aadharcard_number">Aadhar card number<span class="required">*</span></label>
                              <input type="text"  id="aadharcard_number" name="aadharcard_number" value="{{ old('aadharcard_number') }}" class="form-control">
                              <span class="text text-danger"> @if ($errors->has('aadharcard_number')){{ $errors->first('aadharcard_number') }} @endif</span>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label  for="password">Password*<span class="required">*</span></label>
                              <input type="text"  id="password" name="password" value="{{ old('password') }}"  class="form-control">
                              <span class="text text-danger"> @if ($errors->has('password')){{ $errors->first('password') }} @endif</span>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                                <label for="aadharcard_number">User Type<span class="required">*</span></label>
                               <select name="user_type" class="form-control" id="user_type">
                                   <option value="">--select--</option>
                                   <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Core-Integra Member</option>
                                   <option value="2" {{ old('status') == '2' ? 'selected' : '' }}>Core-Integra Sub-Member</option>
                                   <option value="3" {{ old('status') == '3' ? 'selected' : '' }}>Non Core-Integra member</option>
                                   <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Admin</option>
                               </select>
                              <span class="text text-danger"> @if ($errors->has('user_type')){{ $errors->first('user_type') }} @endif</span>
                            </div>
                          </div>
                        </div>


                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label  for="password">Staus<span class="required">*</span></label>
                              <select name="status" class="form-control" id="status">
                                   <option value="1" {{ old('status') == '1' ? 'selected' : '' }} >Active</option>
                                   <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Deactive</option>
                              </select>
                              <span class="text text-danger"> @if ($errors->has('status')){{ $errors->first('status') }} @endif</span>
                            </div>
                          </div>
                        </div>
                        
                        <div class="ln_solid"></div>
                          <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                              <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                          </div>


                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

@endsection