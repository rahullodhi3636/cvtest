@extends('layouts.adminmaster')
@section('title', 'Brand')
@section('content')
<div class="right-details-box">
            <div class="home_brics_row">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dash_boxcontainner white_boxlist">
                            <div class="upper_basic_heading">
                                <span class="white_dash_head_txt">Edit Brand <a href="{{ url('admin/brand') }}" class="btn margin0 btn-sm btn-mdb-color single-table-btn float-right waves-effect waves-light" ><i class="mdi mdi-arrow-left mr-1"></i>Back</a> </span>
                            </div>
                            <div class="panel-body dash_table_containner">
                            @if($message=Session::get('success'))
                            <div class="alert alert-success">
                              <p>{{ $message }}</p>
                            </div>
                            @endif
                            <div class="col-md-12">
                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('brand.update', $brand->id) }}" method = "post" enctype="multipart/form-data">
                                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                                <input type="hidden" name="_method" value="patch" />
                                <div class="form-group">
                                  <img src="{{url('images/brand/')}}/{{$brand->brand_icon}}" width="100px">
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">
                                    Brand icon <span class="required">*</span>
                                  </label>
                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="file" name="image" class="form-control col-md-7 col-xs-12">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Select Service <span class="required">*</span>
                                  </label>
                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                    <select class="form-control col-md-7 col-xs-12" name="service" id="service">
                                        <option value="">Select</option>
                                        <?php if (!empty($services)): ?>
                                          <?php foreach ($services as $value): ?>
                                            <option <?php if($value->id == $brand->service_id) echo "selected"; else echo ""; ?> value="{{$value->id}}">{{$value->name}}</option>
                                          <?php endforeach ?>
                                        <?php endif ?>
                                      </select>
                                      <span>@if ($errors->has('name')){{ $errors->first('name') }} @endif</span>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                                  </label>
                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="text"  id="brand_name" name="brand_name" value="{{ old('name',$brand->brand_name) }}" placeholder="Enter name"  class="form-control col-md-7 col-xs-12">
                                    <span class="text text-danger"> @if ($errors->has('name')){{ $errors->first('name') }} @endif</span>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description <span class="required">*</span>
                                  </label>
                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                    <textarea id="description" name="description" placeholder="Enter description"  class="form-control col-md-7 col-xs-12">{{ old('description',$brand->brand_description) }}</textarea>
                                    <span class="text text-danger"> @if ($errors->has('description')){{ $errors->first('description') }} @endif</span>
                                  </div>
                                </div>


                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Status <span class="required">*</span>
                                  </label>
                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                    <select name="status" class="form-control col-md-7 col-xs-12" id="status">
                                        <option value="1" {{ old('status',$brand->status) == '1'? 'selected' : '' }} >Active</option>
                                        <option value="0" {{ old('status',$brand->status) == '0' ? 'selected' : '' }}>Deactive</option>
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