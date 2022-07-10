@extends('layouts.adminmaster')
@section('title', 'Enquiry')
@section('content')

<div class="right-details-box">
            <div class="home_brics_row">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dash_boxcontainner white_boxlist">
                            <div class="upper_basic_heading">
                                <span class="white_dash_head_txt">Add Customer <a href="{{ url('admin/customer') }}" class="btn margin0 btn-sm btn-mdb-color single-table-btn float-right waves-effect waves-light" ><i class="mdi mdi-arrow-left mr-1"></i>Back</a> </span>
                            </div>
                            <div class="panel-body dash_table_containner">
                            @if($message=Session::get('success'))
                            <div class="alert alert-success">
                              <p>{{ $message }}</p>
                            </div>
                            @endif
                            <div class="col-md-12">
                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('customer.store') }}" method = "post" enctype="multipart/form-data">
                                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                                
                                <div class="row">

                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label class="control-label" for="image">User Image  </label>
                                        <input type="file"  name="image">
                                        <span class="text text-danger"> @if ($errors->has('image')){{ $errors->first('image') }} @endif</span>
                                    </div>
                                  </div>

                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label class="control-label" for="customer_id">User Id   </label>
                                        <input type="text"  id="customer_id" name="customer_id" value="{{ old('customer_id',$last_id) }}" placeholder="Enter User Id"  class="form-control" autocomplete="off" readonly="true">
                                        <span class="text text-danger"> @if ($errors->has('customer_id')){{ $errors->first('customer_id') }} @endif</span>
                                    </div>
                                  </div>

                                  <!-- <div class="col-md-4">
                                  <div class="form-group">
                                    <label class="control-label" for="package_id">Packages <span class="required">*</span> </label>
                                        <select name="package_id" class="form-control" onchange="getservices(this.value);">
                                            <option value="">--select--</option>
                                            @if(!empty($packages))
                                              @foreach($packages as $Key => $value)
                                                <option value="{{ $value->package_id }}"  {{ old('package_id') == $value->package_id ? 'selected' : '' }}>{{ $value->package_title }}</option>
                                              @endforeach 
                                            @endif
                                        </select>
                                      <span class="text text-danger"> @if ($errors->has('package_id')){{ $errors->first('package_id') }} @endif</span>
                                  </div>
                                  </div> -->

                                  <div class="col-md-4">
                                  <div class="form-group">
                                    <label class="control-label" for="cust_type">Customer Type </label>
                                        <select name="cust_type" class="form-control">
                                            <option value="">--select--</option>
                                            <option value="VIP"  {{ old('cust_type') == 'VIP' ? 'selected' : '' }}>VIP</option>
                                            <option value="NON VIP"  {{ old('cust_type') == 'NON VIP' ? 'selected' : '' }}>NON VIP</option>
                                        </select>
                                      <span class="text text-danger"> @if ($errors->has('cust_type')){{ $errors->first('cust_type') }} @endif</span>
                                  </div>
                                  </div>

                                </div>

                                <div class="row">

                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label class="control-label" for="name">Name <span class="required">*</span> </label>
                                        <input type="text"  id="name" name="name" value="{{ old('name') }}" placeholder="Enter name"  class="form-control" autocomplete="off">
                                        <span class="text text-danger"> @if ($errors->has('name')){{ $errors->first('name') }} @endif</span>
                                    </div>
                                  </div>

                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label class="control-label" for="name">Location   </label>
                                        <input type="text"  id="location" name="location" value="{{ old('location') }}" placeholder="Enter location"  class="form-control" autocomplete="off">
                                        <span class="text text-danger"> @if ($errors->has('location')){{ $errors->first('location') }} @endif</span>
                                    </div>
                                  </div>

                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label class="control-label" for="contact">Contact <span class="required">*</span> </label>
                                        <input type="text"  id="contact" name="contact" value="{{ old('contact') }}" placeholder="Enter contact"  class="form-control" autocomplete="off">
                                        <span class="text text-danger"> @if ($errors->has('contact')){{ $errors->first('contact') }} @endif</span>
                                    </div>
                                  </div>
                                  
                                </div>

                                <div class="row">

                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label class="control-label" for="other_contact">Other Contact </label>
                                        <input type="text"  id="other_contact" name="other_contact" value="{{ old('other_contact') }}" placeholder="Enter other contact"  class="form-control" autocomplete="off">
                                        <span class="text text-danger"> @if ($errors->has('other_contact')){{ $errors->first('other_contact') }} @endif</span>
                                    </div>
                                  </div>

                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label class="control-label" for="email">Email </label>
                                        <input type="text"  id="email" name="email" value="{{ old('email') }}" placeholder="Enter email"  class="form-control" autocomplete="off">
                                        <span class="text text-danger"> @if ($errors->has('email')){{ $errors->first('email') }} @endif</span>
                                    </div>
                                  </div>

                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label class="control-label" for="contact">Dob </label>
                                        <input type="text"  id="dob" name="dob" value="{{ old('dob') }}" placeholder="Enter dob"  class="form-control datepicker" data-date-format="yyyy-mm-dd" autocomplete="off">
                                        <span class="text text-danger"> @if ($errors->has('dob')){{ $errors->first('dob') }} @endif</span>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label class="control-label" for="contact">Gender </label>
                                        <select class="form-control" name="gender" id="gender">
                                          <option value="">Select</option>
                                          <option value="Male">Male</option>
                                          <option value="Female">Female</option>
                                          <option value="Other">Other</option>
                                        </select>
                                        <span class="text text-danger"> @if ($errors->has('gender')){{ $errors->first('gender') }} @endif</span>
                                    </div>
                                  </div>

                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label class="control-label" for="referral_code">Designation  </label>
                                        <input type="text"  id="designation" name="designation" value="" placeholder="Enter designation"  class="form-control" autocomplete="off">
                                        <span class="text text-danger"> @if ($errors->has('designation')){{ $errors->first('designation') }} @endif</span>
                                    </div>
                                  </div>

                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label class="control-label" for="referral_code">Referral Code  </label>
                                        <input type="text"  id="referral_code" name="referral_code" value="{{ old('referral_code',$last_id) }}" placeholder="Enter referral code"  class="form-control" autocomplete="off">
                                        <span class="text text-danger"> @if ($errors->has('referral_code')){{ $errors->first('referral_code') }} @endif</span>
                                    </div>
                                  </div>
                                   @if($message=Session::get('referred_by'))
                                   {{$message}}
                                   @endif
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label class="control-label" for="referred_by">Referred By  </label>
                                        <input type="text"  id="referred_by" name="referred_by" value="{{ old('referred_by') }}" placeholder="Enter Referred By"  class="form-control" autocomplete="off">
                                        <span class="text text-danger"> @if ($errors->has('referred_by')){{ $errors->first('referred_by') }} @endif</span>
                                    </div>
                                  </div>

                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label class="control-label" for="reward_points">Reward Points  </label>
                                        <input type="text"  id="reward_points" name="reward_points" value="{{ old('reward_points') }}" placeholder="Enter reward points"  class="form-control" autocomplete="off">
                                        <span class="text text-danger"> @if ($errors->has('reward_points')){{ $errors->first('reward_points') }} @endif</span>
                                    </div>
                                  </div>

                                </div>

                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label" for="anniversary_date">Anniversary Date</label>
                                        <input type="text"  id="anniversary_date" name="anniversary_date" value="{{ old('anniversary_date') }}" placeholder="Enter anniversary date"  class="form-control datepicker" data-date-format="yyyy-mm-dd" autocomplete="off">
                                        <span class="text text-danger"> @if ($errors->has('anniversary_date')){{ $errors->first('anniversary_date') }} @endif</span>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label" for="rf_id">RF-ID Code   </label>
                                        <input type="text"  id="rf_id" name="rf_id" value="{{ old('rf_id',$last_id) }}" placeholder="Enter rf id"  class="form-control" autocomplete="off">
                                        <span class="text text-danger"> @if ($errors->has('rf_id')){{ $errors->first('rf_id') }} @endif</span>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                 
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label class="control-label" for="remark">Remark</label>
                                      <textarea id="remark" name="remark" placeholder="Enter remark"  class="form-control">{{ old('remark') }}</textarea>
                                      <span class="text text-danger"> @if ($errors->has('remark')){{ $errors->first('remark') }} @endif</span>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-12">
                                  <div class="form-group">
                                     <button type="submit" class="btn btn-success">Save</button>
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
        </div>

  <link rel="stylesheet" href="{{asset('backend/js/bootstrap.min.css')}}">
  <script type="text/javascript" src="{{asset('backend/js/jquery-3.4.1.min.js')}}"></script>
  <script src="{{asset('backend/popup/bootstrap.min.js')}}"></script>

  <!-- Trigger the modal with a button -->
  <button type="button" id="service_modal" class="btn btn-info btn-lg" data-toggle="modal" data-target="#serviceModal" style="display: none">Open Modal</button>

  <!-- Modal -->
  <div class="modal fade" id="serviceModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Services</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
          <div class="show_services"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  



<script src="{{ asset('backend/calendar/jquery.js')}}"></script> 
<script src="{{ asset('backend/calendar/jquery-ui.js')}}"></script> 
<link href="{{ asset('backend/calendar/bootstrap.css')}}" rel="stylesheet">
<link href="{{ asset('backend/calendar/jquery-ui.css')}}" rel="stylesheet">   

<script type="text/javascript">
    $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });

    /*function getservices(package_id){
          if(package_id!=''){
            var dataString = 'package_id='+package_id;
            $.ajax({
            type: "POST",
            url: '{{ url("getservices")}}',
            data: dataString,
            cache: false,
            dataType: "json",
            success: function(result){
              $('#service_modal').trigger('click');
              console.log(result);
                 var list = '<table class="table table-stripped">';
                     list += '<tr><th>Service</th><th>Price</th></tr>'             
                  $.each(result, function (i, item) {
                    list +='<tr><td>'+result[i].service+'</td><td>'+result[i].total+'</td></tr>';
                  });//end each
                  
                  list += '</table>';

                  $('.show_services').html(list);
              
              }//end sucess
            });//end ajax
          }else{
            $('.show_services').html('No any services found');
          }
    }*/
</script>

@endsection

