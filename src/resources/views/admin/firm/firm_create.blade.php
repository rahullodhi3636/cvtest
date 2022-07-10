@extends('layouts.adminmaster')
@section('title', 'Firm')
@section('content')

<div class="right-details-box">
            <div class="home_brics_row">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dash_boxcontainner white_boxlist">
                            <div class="upper_basic_heading">
                                <span class="white_dash_head_txt">Add Firm <a href="{{ url('admin/firm') }}" class="btn margin0 btn-sm btn-mdb-color single-table-btn float-right waves-effect waves-light" ><i class="mdi mdi-arrow-left mr-1"></i>Back</a> </span>
                            </div>
                            <div class="panel-body dash_table_containner">
                            @if($message=Session::get('success'))
                            <div class="alert alert-success">
                              <p>{{ $message }}</p>
                            </div>
                            @endif
                            <div class="col-md-12">
                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('firm.store') }}" method = "post" enctype="multipart/form-data">
                                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Firm Name <span class="required">*</span>
                                  </label>
                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="text"  id="name" name="name" value="{{ old('name') }}" placeholder="Enter firm name"  class="form-control col-md-7 col-xs-12">
                                    <span class="text text-danger"> @if ($errors->has('name')){{ $errors->first('name') }} @endif</span>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Firm Location <span class="required">*</span>
                                  </label>
                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="text"  id="name" name="location" value="{{ old('location') }}" placeholder="Enter firm location"  class="form-control col-md-7 col-xs-12">
                                    <span class="text text-danger"> @if ($errors->has('location')){{ $errors->first('location') }} @endif</span>
                                  </div>
                                </div>


                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Contact Number<span class="required">*</span>
                                  </label>
                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="number"  id="phone" name="phone" value="{{ old('phone') }}" placeholder="Enter contact number"  class="form-control col-md-7 col-xs-12">
                                    <span class="text text-danger"> @if ($errors->has('phone')){{ $errors->first('phone') }} @endif</span>
                                  </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cgst">CGST %<span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                      <input type="number"  id="cgst" name="cgst" value="{{ old('cgst') }}" placeholder="Enter cgst percent"  class="form-control col-md-7 col-xs-12">
                                      <span class="text text-danger"> @if ($errors->has('cgst')){{ $errors->first('cgst') }} @endif</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">SGST %<span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                      <input type="number"  id="sgst" name="sgst" value="{{ old('sgst') }}" placeholder="Enter sgst percent"  class="form-control col-md-7 col-xs-12">
                                      <span class="text text-danger"> @if ($errors->has('sgst')){{ $errors->first('sgst') }} @endif</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gst_status">GST Status <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                      <select required class="form-control selectpicker col-md-7 col-xs-12" name="gst_status" id="gst_status">
                                        <option value="0">In-active</option>
                                        <option value="1">Active</option>
                                      </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gst_discount">GST Discount <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                      <select required class="form-control selectpicker col-md-7 col-xs-12" name="gst_discount" id="gst_discount">
                                        <option value="0">Add GST without discount</option>
                                        <option value="1">Add GST with same discount</option>
                                      </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Select Services <span class="required">*</span>
                                  </label>
                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                    <select required class="form-control selectpicker col-md-7 col-xs-12" name="services[]" id="services" data-live-search="true" data-hide-disabled="true" data-actions-box="true" multiple>
                                      <!-- <option value="">Select</option> -->
                                      @foreach ($services as $service)
                                       <option value="{{ $service->id }}">{{ $service->name }}</option>
                                      @endforeach
                                    </select>
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
