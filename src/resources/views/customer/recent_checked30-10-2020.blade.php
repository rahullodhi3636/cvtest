@extends('layouts.newlayout.app')
@section('content')
 <div class="main">
    <div class="main-content">
      <div class="container-fluid">
         <div class="boxbody">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="card-header">
                    <h5 class="card-title">Recent Check In Customer</h5>
                    </div>
                </div><!--./col-lg-6-->
            </div><!--./row-->
            <div class="card-body">
            <form id="quicksaleForm" class="formvisit mt-2">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-12">
                        <div class="form-group">
                        <label>Moblie</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text">+91</span></div>
                            <input required type="number" id="searchnumber" name="searchnumber" class="form-control" placeholder="1234567890">
                        </div>
                        </div><!--./form-group-->
                    </div><!--./col-lg-8-->
                    <div class="col-lg-2 col-md-12 col-12 mt-4">
                        <button type="button" class="theme-btn mt-2" onclick="getCustomerDetails()">Show</button>
                    </div>
                    <div class="col-lg-2 col-md-12 col12 mt-4">
                        <button type="button" id="new_cust_checked" class="theme-btn mt-2" style="display:none;" onclick="addnewcheckin()">Add New </button>
                    </div>
                </div>
            </form>
                <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="th-sm">Sr No</th>
                            <th class="th-sm">Customer Name</th>
                            <th class="th-sm">Customer Email</th>
                            <th class="th-sm">Action
                            
                            </th>
                        </tr>
                    </thead>
                    <tbody id="customerbody">
                    </tbody>
                </table>
            </div>
         </div><!--./boxbody-->
       </div><!--./container-fluid-->
      <footer>Copyright © 2020 Chinnie & Vinnie Jabalpur Salon. All rights reserved.</footer>
     </div><!--./main-content-->

   </div><!--./main-->

    <!-- The Modal -->
    <div class="modal" id="addLocation">
          <div class="modal-dialog modal-mld">
            <form id="addfirmform" method="post">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Add Location</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                <!-- Modal body -->
                <div class="modal-body formvisit">
                  <div class="row">
                    <div class="col-lg-6 col-md-12 col-12">
                      <div class="form-group">
                        <label>Location</label>
                        <input type="text" name="name" id="location" value="{{ old('name') }}" placeholder="Enter firm name"  class="form-control">
                      </div>
                    </div><!--./col-lg-4-->


                    <div class="col-lg-6 col-md-12 col-12">
                       <div class="form-group">
                          <label>Status</label>
                          <select name="status" id="status" class="form-control col-md-7 col-xs-12" id="status">
                              <option value="1" {{ old('status') == '1'? 'selected' : '' }} >Active</option>
                              <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Deactive</option>
                          </select>
                        </div>
                    </div><!--./col-lg-4-->
                  </div><!--./row-->
                </div>
                <div class="modal-footer">
                  <button type="button" class="outline-btn" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="theme-btn">Save</button>
                </div>
              </div>
            </form>
          </div>
        </div><!--#/addcustomer-->

   <div class="modal" id="addcustomer">
      <div class="modal-dialog modal-lg">
        <form id="addnewcheckingform" enctype="multipart/form-data">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Customer</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
            <!-- Modal body -->
            <div class="modal-body formvisit">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label" for="image">User Image <span class="required">*</span> </label>
                      <input type="file"  name="image" id="image">
                      <span class="text text-danger"> @if ($errors->has('image')){{ $errors->first('image') }} @endif</span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label" for="customer_id">User Id <span class="required">*</span> </label>
                      <input type="text"  id="customer_id" name="customer_id" value="{{ old('customer_id',$last_id) }}" placeholder="Enter User Id"  class="form-control" autocomplete="off" readonly="true">
                      <span class="text text-danger"> @if ($errors->has('customer_id')){{ $errors->first('customer_id') }} @endif</span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label" for="cust_type">Customer Type </label>
                        <select name="cust_type" id="cust_type" class="form-control">
                            <option value="">--select--</option>
                            <option value="VIP"  {{ old('cust_type') == 'VIP' ? 'selected' : '' }}>VIP</option>
                            <option value="NON VIP"  {{ old('cust_type') == 'NON VIP' ? 'selected' : '' }}>NON VIP</option>
                        </select>
                      <span class="text text-danger"> @if ($errors->has('cust_type')){{ $errors->first('cust_type') }} @endif</span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label" for="name">Name <span class="required">*</span> </label>
                      <input type="text"  id="name" name="name" value="{{ old('name') }}" placeholder="Enter name"  class="form-control" autocomplete="off">
                      <span class="text text-danger"> @if ($errors->has('name')){{ $errors->first('name') }} @endif</span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label" for="name">Location <span class="required">*</span> 
                    <a data-toggle="modal" data-target="#addLocation" href="javascript:void(0)">Add New</a></span>
                    </label>
                    <select type="text"  id="location" name="location" value="{{ old('location') }}" placeholder="Enter location"  class="form-control" autocomplete="off">
                    <option value="">Select Location</option>

                    </select>
                      <span class="text text-danger"> @if ($errors->has('location')){{ $errors->first('location') }} @endif</span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label" for="contact">Contact <span class="required">*</span> </label>
                      <input type="number"  id="contact" name="contact" value="{{ old('contact') }}" placeholder="Enter contact"  class="form-control" autocomplete="off">
                      <span class="text text-danger"> @if ($errors->has('contact')){{ $errors->first('contact') }} @endif</span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label" for="contact">OTP <span class="required">*</span> </label>
                      <input type="number"  id="otp" name="otp" value="{{ old('otp') }}" placeholder="Enter OTP"  class="form-control" autocomplete="off">

                      <span class="text text-danger"> @if ($errors->has('otp')){{ $errors->first('otp') }} @endif</span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label" for="other_contact">Other Contact </label>
                      <input type="number"  id="other_contact" name="other_contact" value="{{ old('other_contact') }}" placeholder="Enter other contact"  class="form-control" autocomplete="off">
                      <span class="text text-danger"> @if ($errors->has('other_contact')){{ $errors->first('other_contact') }} @endif</span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label" for="email">Email </label>
                      <input type="email"  id="email" name="email" value="{{ old('email') }}" placeholder="Enter email"  class="form-control" autocomplete="off">
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
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label" for="contact">Gender </label>
                      <select class="form-control" name="gender" id="gender">
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
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
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label" for="anniversary_date">Anniversary Date</label>
                      <input type="text"  id="anniversary_date" name="anniversary_date" value="{{ old('anniversary_date') }}" placeholder="Enter anniversary date"  class="form-control datepicker" data-date-format="yyyy-mm-dd" autocomplete="off">
                      <span class="text text-danger"> @if ($errors->has('anniversary_date')){{ $errors->first('anniversary_date') }} @endif</span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label" for="rf_id">RF-ID Code <span class="required">*</span> </label>
                      <input type="text"  id="rf_id" name="rf_id" value="{{ old('rf_id',$last_id) }}" placeholder="Enter rf id"  class="form-control" autocomplete="off">
                      <span class="text text-danger"> @if ($errors->has('rf_id')){{ $errors->first('rf_id') }} @endif</span>
                      <input type="hidden" required id="otps" name="otps" value="">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label" for="remark">Remark</label>
                    <textarea id="remark" name="remark" placeholder="Enter remark"  class="form-control">{{ old('remark') }}</textarea>
                    <span class="text text-danger"> @if ($errors->has('remark')){{ $errors->first('remark') }} @endif</span>
                  </div>
                </div>
              </div><!--./row-->
            </div>
            <div class="modal-footer">
              <button type="button" class="outline-btn" data-dismiss="modal">Cancel</button>
               <button class="btn btn-danger" id="otpbtn"  type="button" onclick="sendotp()">Get OTP</button>
               <button style="display:none;" type="button" id="customerformbtn" onclick="addcheckincustomer()" class="theme-btn">Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <script src="{{asset('assets/js/lib/jquery.js')}}"></script>
    <script src="{{asset('assets/js/dist/jquery.validate.js')}}"></script>
    <script>
        loadLocation();
        function loadLocation()
        {
          $.ajax({
                url:'{{ url("load_location") }}',
                type:'GET',
                success:function(res) {
                  $("#addLocation").modal('hide');
                  $("#location").html(res);
                },
                error: function (request, status, error) {
                    if( request.status === 422 ) {
                        // var errors = $.parseJSON(reject.responseText);
                        alert(request.responseJSON.errors.name);
                        /*$.each(errors, function (key, val) {
                            $("#" + key + "_error").text(val[0]);
                            alert($("#" + key + "_error").text(val[0]))
                        });*/
                    }
                }
              });
        }

        function getCustomerDetails(){
            let new_row='';
            let checkinstatus='';
            let status_td='';
            let searchnumber= $('#searchnumber').val();
            if(searchnumber!="" && searchnumber.length == 10){
                $.ajax({
                    url:'{{ url("checkaccount") }}',
                    data:{'number':searchnumber},
                    type:'POST',
                    dataType:"JSON",
                    success:function(res) {
                        console.log('----------get details-----------');
                        console.log(res);                        
                        if(res != "" && res != null){
                          checkinstatus=res.checkin;
                          if(checkinstatus==0){
                            status_td=`<button type="button" class="theme-btn mt-2" onclick="ActiveCheckInStatus(${res.id})">CheckIn</button>`;
                          }
                          else{
                            status_td=`<button type="button" class="theme-btn mt-2" onclick="CheckInStatus(${res.id})">CheckOut</button>`;
                          }
                          new_row=`<tr>
                            <td class="td-sm">1</td>
                            <td class="td-sm">${res.name}</td>
                            <td class="td-sm">${res.email}</td>
                            <td class="td-sm">${status_td} </td>
                            </tr>`
                          $('#customerbody').append(new_row);
                        }else{
                            alert('User not found');
                            $('#new_cust_checked').show();
                        }
                    }
                });
            }
            else{
              alert('Invalid Number')
            }
        }
        function addnewcheckin(){
            var number =  $("#searchnumber").val();
            $("#contact").val(number);
            $('#addcustomer').modal('show');
        }

        function sendotp() {
            var number =  $("#searchnumber").val();
            let usedfor='new_cust';
            if (number) {
            if ( number.length == 10  ){
                $.ajax({
                    url:'{{ url("sendotp") }}',
                    data:{'number':number,'usedfor':usedfor},
                    type:'POST',
                    success:function(res) {
                    console.log(res);
                    $("#otps").val(res);
                    $("#customerformbtn").css('display','block');
                    }
                });
            }else{
                alert("Enter Valid Mobile number !");
            }

            }else{
                alert("Enter Mobile number to Verify !");
            }
        }

         function addcheckincustomer(){
           let checkinstatus='';
           let status_td='';
            var newchecking_form=$('#addnewcheckingform').serialize();
            var new_row='';
            $.ajax({
                url:"{{ route ('newcheckin') }}",
                type:'POST',
                data:newchecking_form,
                dataType:'JSON',
                success:function(res) {
                  console.log('----------get details of new-----------');
                  console.log(res);
                  $('#addcustomer').modal('hide');
                  checkinstatus=res.data.checkin;
                    if(checkinstatus==0){
                      status_td=`<button type="button" class="theme-btn mt-2" onclick="ActiveCheckInStatus(${res.data.id})">CheckIn</button>`;
                    }
                    else{
                      status_td=`<button type="button" class="theme-btn mt-2" onclick="CheckInStatus(${res.id})">CheckOut</button>`;
                    }
                  if(res.msg==true){
                    new_row=`<tr>
                            <td class="td-sm">1</td>
                            <td class="td-sm">${res.data.name}</td>
                            <td class="td-sm">${res.data.email}</td>
                            <td class="td-sm">${status_td}</td>
                            </tr>`
                    $('#customerbody').append(new_row);
                  }
                  else{
                    alert('Something wrong in checkin customer');
                  }                  
                },
                error: function(jqXHR, textStatus, errorThrown) {
                alert('Something went wrong in add new checking form');
                }
              });              
          }

        
        function ActiveCheckInStatus(cust_id){
          if(cust_id!="")
          {
            $.ajax({
                url:"{{ route ('activecheckinstatusupdate') }}",
                type:'POST',
                data:{"_token": "{{ csrf_token() }}",'cust_id':cust_id},
                dataType:'JSON',
                success:function(res) {
                  console.log(res);
                  if(res.msg==true){
                    alert('Customer check-in status updated');
                  }
                  else{
                    alert('Something wrong in updating check-in status');
                  }                  
                },
                error: function(jqXHR, textStatus, errorThrown) {
                alert('Something went wrong in CheckInStatus');
                }
              });  
          }
        }

        function CheckInStatus(cust_id){
          // alert(cust_id);
          if(cust_id!="")
          {
            $.ajax({
                url:"{{ route ('checkinstatusupdate') }}",
                type:'POST',
                data:{"_token": "{{ csrf_token() }}",'cust_id':cust_id},
                dataType:'JSON',
                success:function(res) {
                  console.log(res);
                  if(res.msg==true){
                    alert('Customer check-in status updated');
                  }
                  else{
                    alert('Something wrong in updating check-in status');
                  }                  
                },
                error: function(jqXHR, textStatus, errorThrown) {
                alert('Something went wrong in CheckInStatus');
                }
              });  
          }
        }
    </script>
@endsection
