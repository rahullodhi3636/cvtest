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
                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('firm.update', $firm->id) }}" method = "post" enctype="multipart/form-data">
                                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                                <input type="hidden" name="_method" value="patch" />
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Firm Name <span class="required">*</span>
                                  </label>
                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="text"  id="name" name="name" value="{{ old('name',$firm->firm_name) }}" placeholder="Enter firm name"  class="form-control col-md-7 col-xs-12">
                                    <span class="text text-danger"> @if ($errors->has('name')){{ $errors->first('name') }} @endif</span>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Firm Location <span class="required">*</span>
                                  </label>
                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="text"  id="name" name="location" value="{{ old('location',$firm->firm_location) }}" placeholder="Enter firm location"  class="form-control col-md-7 col-xs-12">
                                    <span class="text text-danger"> @if ($errors->has('location')){{ $errors->first('location') }} @endif</span>
                                  </div>
                                </div>


                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Contact Number<span class="required">*</span>
                                  </label>
                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="number"  id="phone" name="phone" value="{{ old('phone',$firm->firm_number) }}" placeholder="Enter contact number"  class="form-control col-md-7 col-xs-12">
                                    <span class="text text-danger"> @if ($errors->has('phone')){{ $errors->first('phone') }} @endif</span>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Select Services <span class="required">*</span>
                                  </label>
                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                    <select required class="form-control selectpicker col-md-7 col-xs-12" name="services[]" id="services" data-live-search="true" data-hide-disabled="true" data-actions-box="true" multiple>
                                      <!-- <option value="">Select</option> -->
                                      @php
                                        if(!empty($firm->services)){
                                          $servicearray = json_decode($firm->services);
                                        }else{
                                          $servicearray = "";
                                        }
                                      @endphp
                                      @foreach ($services as $service)
                                       <?php
                                         if (in_array($service->id, $servicearray)) {
                                          $selected = "selected";
                                         }else{
                                          $selected = "";
                                         }
                                            
                                       ?>
                                       <option value="{{ $service->id }}" {{$selected}}>{{ $service->name }}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Status <span class="required">*</span>
                                  </label>
                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                    <select name="status" class="form-control col-md-7 col-xs-12" id="status">
                                        <option value="1" {{ old('status',$firm->status) == '1'? 'selected' : '' }} >Active</option>
                                        <option value="0" {{ old('status',$firm->status) == '0' ? 'selected' : '' }}>Deactive</option>
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