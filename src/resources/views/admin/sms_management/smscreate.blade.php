@extends('layouts.adminmaster')
@section('title', 'Sms Management')
@section('content')

<div class="right-details-box">
            <div class="home_brics_row">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dash_boxcontainner white_boxlist">
                            <div class="upper_basic_heading">
                                <span class="white_dash_head_txt">Add SMS Template <a href="{{ url('admin/sms') }}" class="btn margin0 btn-sm btn-mdb-color single-table-btn float-right waves-effect waves-light" ><i class="mdi mdi-arrow-left mr-1"></i>Back</a> </span>
                            </div>
                            <div class="panel-body dash_table_containner">
                            @if($message=Session::get('success'))
                            <div class="alert alert-success">
                              <p>{{ $message }}</p>
                            </div>
                            @endif
                            <div class="col-md-12">
                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('sms.store') }}" method = "post" enctype="multipart/form-data">
                                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Template Name <span class="required">*</span>
                                  </label>
                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="text"  id="name" name="name" value="{{ old('name') }}" placeholder="Enter template name"  class="form-control col-md-7 col-xs-12">
                                    <span class="text text-danger"> @if ($errors->has('name')){{ $errors->first('name') }} @endif</span>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Template Message <span class="required">*</span>
                                  </label>
                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                    <textarea id="message" name="message" placeholder="Enter template message"  class="form-control col-md-7 col-xs-12">{{ old('message') }}</textarea>
                                    <span class="text text-danger"> @if ($errors->has('message')){{ $errors->first('message') }} @endif</span>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Status <span class="required">*</span>
                                  </label>
                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                    <select name="status" class="form-control col-md-7 col-xs-12" id="status">
                                        <option value="1" {{ old('status') == '1'? 'selected' : '' }} >Active</option>
                                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Deactive</option>
                                    </select>
                                    <span class="text text-danger"> @if ($errors->has('status')){{ $errors->first('status') }} @endif</span>
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