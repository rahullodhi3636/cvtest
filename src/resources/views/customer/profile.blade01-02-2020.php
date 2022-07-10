@extends('layouts.adminmaster')
@section('title', 'Sms Management')
@section('content')                
   <div class="right-details-box">
            <div class="home_brics_row">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-3">
                               <div class="userleft">
                                <div class="userleftbody">
                                   <div class="userleftimg mb-2"><img src="{{ url('images/customer') }}/{{$customer->customer_image}}" /></div>
                                   <h4>{{$customer->name}}</h4>
                                   <p><!-- Ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. --></p>
                                   <table class="table table-striped table-hover">
                                      <tr>
                                        <td style="width:60%;">Status</td>
                                        @php
                                          if($customer->customer_status == 1)
                                            $status = "Active";
                                          else
                                            $status = "Not-active";  
                                        @endphp
                                        <td align="right"><span class="badge badge-default">{{$status}}</span></td>
                                      </tr>
                                      <tr>
                                        <td>Member Since</td>
                                        <td align="right">{{date('d-m-Y',strtotime($customer->created_at))}} </td>
                                      </tr>
                                      <tr>
                                        <td>Reward Points</td>
                                        <td align="right">
                                          {{$customer->reward_points}} &nbsp;<a class="btn btn-success" href="javascript:void(0)" onclick="addReward('{{$customer->id}}')"><i class="mdi mdi-plus"></i></a>
                                        </td>
                                      </tr>
                                  </table>
                                </div>   
                               </div>
                            </div><!--./col-lg-3-->

                             <div class="col-sm-9">
                                <ul class="nav nav-tabs md-tabs profile-nav">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab-md" data-toggle="tab" href="#home-md" role="tab" aria-controls="home-md"
      aria-selected="true">Profile</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab-md" data-toggle="tab" href="#profile-md" role="tab" aria-controls="profile-md"
      aria-selected="false">Package</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab-md" data-toggle="tab" href="#contact-md" role="tab" aria-controls="contact-md"
      aria-selected="false">Services</a>
  </li>
   <li class="nav-item">
    <a class="nav-link" id="transaction-tab-md" data-toggle="tab" href="#transaction-md" role="tab" aria-controls="transaction-md"
      aria-selected="false">Transaction Details</a>
  </li>
</ul>
<div class="tab-content">
  <div class="tab-pane fade show active" id="home-md" role="tabpanel" aria-labelledby="home-tab-md">
    <div class="userleftbody">
       <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
          <div class="vd_info"> <a class="btn btn-primary" data-toggle="modal" data-target="#editprofile"><i class="mdi mdi-pencil-box-outline"></i> Edit</a></div>
          <h4 class="profile-icon"><i class="mdi mdi-account"></i> ABOUT</h4>
        </div>
              <div class="col-lg-6 col-md-12 col-12">
                 <table class="profile-summary">
                 <tbody><tr>
                   <td>Name<span>:</span></td>
                   <td>{{$customer->name}}</td>
                 </tr>
                 <tr>
                   <td>Email<span>:</span></td>
                   <td>{{$customer->email}}</td>
                 </tr>
                 <tr>
                   <td>Phone<span>:</span></td>
                   <td>{{$customer->contact}}</td>
                 </tr>
                 <tr>
                   <td>Address<span>:</span></td>
                   <td>{{$customer->location}}</td>
                 </tr>
                </tbody></table> 
              </div><!--./col-lg-12-->
             <div class="col-lg-6 col-md-12 col-12">
                <table class="profile-summary">
                 <tbody>
                  <!-- <tr>
                   <td>Gender<span>:</span></td>
                   <td>Male</td>
                 </tr> -->
                 <tr>
                   <td>Birth Date<span>:</span></td>
                   <td>{{date('d-m-Y',strtotime($customer->dob))}}</td>
                 </tr>
                 <tr>
                   <td>Anniversary Date<span>:</span></td>
                   <td>{{date('d-m-Y',strtotime($customer->anniversary_date))}}</td>
                 </tr>
                  <tr>
                   <td>Place<span>:</span></td>
                   <td>{{$customer->location}}</td>
                 </tr>
                  <tr>
                   <td>Reward Points<span>:</span></td>
                   <td>{{$customer->reward_points}}</td>
                 </tr>
               </tbody></table>
              </div><!--./col-lg-6--> 
          </div>
      </div><!--userleftbody-->
      <div class="userleftbody mt-2">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-12">
            <!-- <div class="vd_info"> <a class="btn btn-primary"><i class="mdi mdi-pencil-box-outline"></i> Add Customers</a></div> -->
            <h4 class="profile-icon"><i class="mdi mdi-eye"></i> My Packages</h4>
            <div class="table-responsive">
              <table class="table table-bordered sc_table table-striped table-hover mt-4">
                  <tr>
                    <th>#</th>
                    <!-- <th>Logo / Photos</th>  -->                                 
                    <th>Package Name</th>
                    <th>Price</th>
                    <th>Duration</th>
                    <th>Total Members</th>                                      
                    <!-- <th class="text-right">Action</th> -->                                          
                  </tr>
                  @php 
                   if(!empty($customer->customer_package_id)){ 
                  @endphp
                <tr>
                  <td>1</td>
                  <!-- <td><img height="80" src="http://www.venmond.com/demo/vendroid/img/avatar/avatar-4.jpg" alt=""></td>   -->                  
                  <td>{{$customer->package_title}} </td>                                    
                  <td>{{$customer->package_price}} Rs </td>                                    
                  <td>{{$customer->package_duration}} (Days) </td>                                    
                  <td>{{$customer->total_member}} </td>
                  </tr>
                  @php
                  }
                  @endphp
                  <!-- <td><div class="h5"><span class="badge badge-success">Active</span></div></td> -->  
                  <!-- <td><i class="mdi mdi-currency-inr"></i> 250</td>
                  <td class="menu-action text-right">
                    <a class="btn-floating btn-sm btn-primary"><i class="mdi mdi-eye-outline"></i></a>                                    
                    <a class="btn-floating btn-sm btn-success"><i class="mdi mdi-pencil-outline"></i></a>
                    <a class="btn-floating btn-sm btn-danger"><i class="mdi mdi-trash-can-outline"></i></a>                  
                  </td>                                                                           
                </tr> -->
             </table>
            </div> 
          </div>
        </div><!--./row-->  
      </div><!--./userleftbody-->
  </div><!--  -->
  <div class="tab-pane fade" id="profile-md" role="tabpanel" aria-labelledby="profile-tab-md">
    <div class="userleftbody">
       <div class="row">
        @foreach($packages as $package)
         <div class="col-lg-4 col-md-12 col-12">
           <div class="single-price">
              <div class="top-sec">
                <h4>{{$package->package_title}}</h4>
                @php
                  if($package->package_type == 1)
                    $type = "Premium";
                  else
                    $type = "Normal";
                @endphp
                 <p>{{$type}}</p>
                 <p>({{$package->package_duration}} Days)</p>
              </div>
              <div class="bottom-sec"><h1><i class="mdi mdi-currency-inr"></i>{{$package->package_price}}</h1></div>
              <div class="end-sec">
              <ul>
                @php
                  $serviceJson = json_decode($package->package_services);
                  foreach($serviceJson as $service){
                    $serviceid = $service->service;
                    $getservice = DB::table('services')->where('id', $serviceid)->get()->first();
                    if($service->total == 1)
                     $times = "Time";
                    else
                     $times = "Times";
                @endphp
                <li>{{$getservice->name}} ({{$service->total}} {{$times}})</li>
                @php
                  }
                @endphp
                <!-- <li>Basic Shave</li>
                <li>Basic Head Wash</li>
                <li>Basic Body Massage</li>
                <li>Basic Snacks</li> -->
              </ul>
              @if($customer->package_id != $package->package_id)
              <a class="primary-btn price-btn mt-4" onclick="ordernow('{{$package->package_id}}')">Order Now</a>
              @else
              <a class="primary-btn price-btn mt-4">Purchased</a>
              @endif
            </div>
          </div>
         </div><!--./col-lg-4-->
         @endforeach
       </div><!--./row-->
    </div>    
  </div><!--  -->
  <div class="tab-pane fade" id="contact-md" role="tabpanel" aria-labelledby="contact-tab-md">
    <div class="userleftbody">
       <div class="row">
         @if(!empty($allservices))
          @foreach($allservices as $servicelist)
         <div class="col-lg-4 col-md-12 col-12">
           <div class="single-price serverborder">
            <span class="sc_icon icon-icon1 single-icon"></span>
             <h4>{{$servicelist->name}}</h4>
             <p>{{$servicelist->description}}</p>
             <p>( {{$servicelist->service_price}} Rs )</p>
             <a class="primary-btn price-btn mt-4" onclick="serviceOrder('{{$servicelist->id}}')">Order Now</a>
           </div>
         </div><!--./col-lg-4-->
          @endforeach
         @endif
      </div><!--./row-->   
    </div>  
  </div>

  <div class="tab-pane fade" id="transaction-md" role="tabpanel" aria-labelledby="transaction-tab-md">
    <div class="userleftbody">
       <div class="row">
         <div class="col-lg-12 col-md-12 col-12">
          <h3>Package Transactions</h3>
          <div class="table-responsive">
            <table class="table table-bordered sc_table">
               <tr>
                  <th>Package Name</th>
                  <th>Price</th>
                  <th>Date of purchase</th>
                </tr>
                @php
                  if(!empty($transaction)){
                    foreach($transaction as $trans){
                @endphp
                <tr>
                  <td>{{$trans->package_title}}</td>
                  <td>{{$trans->package_price}} Rs</td>
                  <td>{{date('d-m-Y',strtotime($trans->transaction_date))}}</td>
                </tr>
                @php
                 }
                }else{ }
                @endphp

                <!-- <tr>
                  <td>2</td>
                  <td>00</td>
                  <td>12</td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>00</td>
                  <td>12</td>
                </tr>

                <tr>
                  <td></td>
                  <td>Total</td>
                  <td>1200</td>
                </tr> -->
            </table>
          </div>
         </div><!--./col-lg-12-->
       </div><!--./row--> 
       <hr>
       <div class="row">
         <div class="col-lg-12 col-md-12 col-12">
          <h3>Service Transactions</h3>
          <div class="table-responsive">
            <table class="table table-bordered sc_table">
               <tr>
                  <th>Service Name</th>
                  <th>Price</th>
                  <th>Date of purchase</th>
                </tr>
                @php
                  if(!empty($sevicetransaction)){
                    foreach($sevicetransaction as $servicetrans){
                @endphp
                <tr>
                  <td>{{$servicetrans->name}}</td>
                  <td>{{$servicetrans->service_price}} Rs</td>
                  <td>{{date('d-m-Y',strtotime($servicetrans->transaction_date))}}</td>
                </tr>
                @php
                 }
                }else{ }
                @endphp
            </table>
          </div>
         </div><!--./col-lg-12-->
       </div><!--./row--> 
    </div><!--./userleftbody-->
  </div><!--/#transaction-->       
</div><!--  -->
                            </div><!--./col-lg-3-->
                           
                       
                        </div>
                        
                    </div>
                   
                </div>
            </div>
        </div>

       
     </section>
</main>


<!-- serviceordernow Modal -->
<div class="modal" id="serviceordernow">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background: #000;">

      <!-- Modal Header -->
      <div class="modal-header" style="background: #daba7a; color: #fff; padding: 10px 30px;">
        <h4 class="modal-title" >Buy Service</h4>
        <!-- <span class="text-center" style="display: none;" id="msg">Profile Updated</span> -->
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="">
       <form class="editform" id="serviceorderform" method="post">
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
            <input type="hidden" name="id" id="id" value="{{$customer->id}}">
            <input type="hidden" name="package_id" id="package_id">
            <input type="hidden" name="serviceid" id="serviceid">
            <div class="form-group">
              <label>Service Name</label>
              <input type="text" class="form-control" name="title" id="title" placeholder="" readonly="">
            </div><!--./form-group-->
             <div class="form-group">
              <label>Service Price</label>
              <input type="text" class="form-control" name="price" id="price" placeholder="" readonly="">
            </div><!--./form-group-->
            
            <div class="form-group">
              <label>Payment Mode</label>
              <select class="form-control" name="pay_mode" id="pay_mode">
                <option value="">Select</option>
                <option value="Cash">Cash</option>
                <option value="Paytm">Paytm</option>
                <option value="Googlepay">Googlepay</option>
              </select>
            </div><!--./form-group-->

            <div id="serviceorderresult"></div>
            <button type="button" onclick="serviceorderform()" class="submitbtn">Order</button>

        </form>
      </div>
    </div>
  </div>
</div><!--./serviceordernow-->

<!-- Ordernow Modal -->
<div class="modal" id="ordernow">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background: #000;">

      <!-- Modal Header -->
      <div class="modal-header" style="background: #daba7a; color: #fff; padding: 10px 30px;">
        <h4 class="modal-title" >Buy Package</h4>
        <!-- <span class="text-center" style="display: none;" id="msg">Profile Updated</span> -->
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="">
       <form class="editform" id="orderform" method="post">
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
            <input type="hidden" name="id" id="id" value="{{$customer->id}}">
            <input type="hidden" name="package_id" id="package_id">
            <div class="form-group">
              <label>Package Title</label>
              <input type="text" class="form-control" name="title" id="packagetitle" placeholder="" readonly="">
            </div><!--./form-group-->
             <div class="form-group">
              <label>Package Price</label>
              <input type="text" class="form-control" name="price" id="packageprice" placeholder="" readonly="">
            </div><!--./form-group-->
            <div class="form-group">
              <label>Package Duration</label>
              <input type="text" class="form-control" name="duration" id="duration" placeholder="" readonly="">
            </div><!--./form-group-->
            <div class="form-group">
              <label>Total Members</label>
              <input type="text" class="form-control" name="members" id="members" placeholder="" readonly="">
            </div><!--./form-group-->

            <div class="form-group">
              <label>Payment Mode</label>
              <select class="form-control" name="pay_mode" id="pay_mode">
                <option value="">Select</option>
                <option value="Cash">Cash</option>
                <option value="Paytm">Paytm</option>
                <option value="Googlepay">Googlepay</option>
              </select>
            </div><!--./form-group-->

            <div class="form-group">
              <label>Add Reward Point</label>
              <input type="checkbox" name="rewardcheck" id="rewardcheck" onclick="checkboxchecked(this.value)" value="1">
            </div>

            <div class="form-group" id="dvreward" style="display: none;">
              <label>Reward Points</label>
              <input type="number" name="rewards" id="rewards" class="form-control" placeholder="Enter reward points" onkeyup="totalrewards(this.value)" value="{{$customer->reward_points}}">
              <span class="text text-danger" id="rewarderror"></span>
            </div>

            <div class="form-group">
              <label>Total payable price</label>
              <input type="number" name="totalprice" id="totalprice" class="form-control" placeholder="Enter price" readonly="">
            </div>

            <div id="orderresult"></div>
            <button type="button" onclick="orderform()" class="submitbtn">Order</button>

        </form>
      </div>
    </div>
  </div>
</div><!--./ordernow-->

 <!-- Edit profile Modal -->
<div class="modal" id="editprofile">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background: #000;">

      <!-- Modal Header -->
      <div class="modal-header" style="background: #daba7a; color: #fff; padding: 10px 30px;">
        <h4 class="modal-title" >Edit Profile</h4>
        <!-- <span class="text-center" style="display: none;" id="msg">Profile Updated</span> -->
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="">
       <form class="editform" id="editform" method="post">
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
            <input type="hidden" name="id" id="id" value="{{$customer->id}}">
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" name="name" id="name" placeholder="" value="{{$customer->name}}">
            </div><!--./form-group-->
             <div class="form-group">
              <label>Email</label>
              <input type="text" class="form-control" name="email" id="email" placeholder="" value="{{$customer->email}}">
            </div><!--./form-group-->
            <div class="form-group">
              <label>Phone</label>
              <input type="text" class="form-control" name="contact" id="contact" placeholder="" value="{{$customer->contact}}">
            </div><!--./form-group-->
            <div class="form-group">
              <label>Address</label>
              <input type="text" class="form-control" name="location" id="location" placeholder="" value="{{$customer->location}}">
            </div><!--./form-group-->
          <div class="row">
            <!-- <div class="col-lg-6 col-md-6 col-12"> -->
            <!-- <div class="form-group"> -->
              <!-- <label>Gender</label> -->
              <!-- <input type="text" class="form-control" placeholder="" value="{{$customer->name}}"> -->
            <!-- </div> --><!--./form-group--> 
            <!-- </div> --><!--./col-lg-6-->
            <div class="col-lg-6 col-md-6 col-12">
              <div class="form-group">
              <label>Birth Date</label>
              <input type="text" class="form-control" name="dob" id="dob" placeholder="" value="{{$customer->dob}}">
            </div><!--./form-group--> 
            </div><!--./col-lg-6-->
            <div class="col-lg-6 col-md-6 col-12">
            <div class="form-group">
              <label>Place</label>
              <input type="text" class="form-control" name="place" id="place" placeholder="" value="{{$customer->location}}">
            </div><!--./form-group--> 
            </div><!--./col-lg-6-->
          </div><!--./row--> 

          <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
              <div class="form-group">
              <label>City</label>
              <input type="text" class="form-control" name="city" id="city" placeholder="" value="{{$customer->location}}">
            </div><!--./form-group--> 
            </div><!--./col-lg-6-->
          </div><!--./row--> 

            <div id="result"></div>
            <button type="button" onclick="editform()" class="submitbtn">Submit</button>

        </form>
      </div>
    </div>
  </div>
</div><!--./editprofile-->

<!-- addreward Modal -->
<div class="modal" id="addreward">
  <div class="modal-dialog modal-sm">
    <div class="modal-content" style="background: #000;">

      <!-- Modal Header -->
      <div class="modal-header" style="background: #daba7a; color: #fff; padding: 10px 30px;">
        <h4 class="modal-title" >Add Reward</h4>
        <!-- <span class="text-center" style="display: none;" id="msg">Profile Updated</span> -->
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="">
       <form class="editform" id="rewardPointform" method="post">
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
            <input type="hidden" name="custid" id="custid" value="{{$customer->id}}">
            <div class="form-group">
              <label>Reward Point</label>
              <input type="number" class="form-control" name="point" id="point" placeholder="Enter reward point" required="">
            </div><!--./form-group-->
            <div class="form-group" style="display: none;" id="otpdiv">
              <label>Verify OTP <a class="text text-primary" href="javascript:void(0)" onclick="addRewardPoint()">Resend otp</a></label>
              <input type="text" name="otp" id="otp" class="form-control" placeholder="Enter otp">
              <span class="text text-danger" id="otperror"></span>
            </div>

            <div id="addrewardresult"></div>
            <button type="button" id="addRewardBtn" onclick="addRewardPoint()" class="submitbtn">Add</button>
            <button type="button" style="display: none;" id="otpVerifyBtn" onclick="otpVerifyReward()" class="submitbtn">Verify</button>

        </form>
      </div>
    </div>
  </div>
</div><!--./addreward-->
<script type="text/javascript">
    function addReward(id) {
      $("#addreward").modal('show');
    }
    // 923024

    function otpVerifyReward(argument) {
      var formdata = $("#rewardPointform").serialize();
      $.ajax({
        url:'{{route("otpverify")}}',
        data:formdata,
        type:'POST',
        success:function(res) {
          if(res == "Done"){
          $("#addrewardresult").html('<div class="alert alert-success"><button type="button" class="close">×</button>Reward point added Successfully</div>');
            setTimeout(function() {
              $("#editprofile").modal('hide');
              $(".alert").fadeTo(500, 0).slideUp(500, function () {
                   $(this).remove();
              });
              window.location.reload();
            },2000);
          }else{
            $("#otperror").html("Please enter correct otp");
          }
        }
      });
    }
    function addRewardPoint() {
      var formdata = $("#rewardPointform").serialize();
      $.ajax({
         url:'{{route("add_reward")}}',
         data:formdata,
         type:'POST',
         success:function(res) {
           if(res == "Done"){
            /*$("#addrewardresult").html('<div class="alert alert-success"><button type="button" class="close">×</button>Reward point added Successfully</div>');*/
            /*setTimeout(function() {
              $("#editprofile").modal('hide');
              $(".alert").fadeTo(500, 0).slideUp(500, function () {
                   $(this).remove();
              });
              window.location.reload();
            },2000);*/
            $("#point").attr("readonly", "true");
            $("#addRewardBtn").hide();
            $("#otpVerifyBtn").show();
            $("#otpdiv").show();
           }
         }
      });
    }
    function totalrewards(val) {
      // alert(val)
      var userreward = '{{$customer->reward_points}}';
      if (val > userreward) {
        $("#rewarderror").html("You have only "+userreward+" for use");
        $("#rewards").val(userreward);
      }else{
        $("#rewarderror").html("");
      }
    }
    function checkboxchecked(val) {
        // Get the checkbox
        var checkBox = document.getElementById("rewardcheck");
        // Get the output text
        var text = document.getElementById("text");

        // If the checkbox is checked, display the output text
        if (checkBox.checked == true){
          $("#dvreward").show();
        } else {
          $("#dvreward").hide();
        }
    }
    /*$(function () {
        $("#rewardcheck").click(function () {
          alert("Hii")
            if ($(this).is(":checked")) {
                $("#dvreward").show();
            } else {
                $("#dvreward").hide();
            }
        });
    });*/
   
    window.onload = function (e) {
        setTimeout(function () {
            //$('#loader-overlay').addClass('scale0');
            $('#mainloader').hide();
        }, 2000);
    }
    window.onscroll = function () {
        //scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 180 || document.documentElement.scrollTop > 20) {
            $('#top_navigation_bar').addClass('logowithmenu_bar_fixed');
        } else {
            $('#top_navigation_bar').removeClass('logowithmenu_bar_fixed');
        }
    }

    $(document).click(function (e) {
        $('#login-user-popup').removeClass('show');
        $('#support-user-popup').removeClass('show');
        //$('#view-setting-page').removeClass('show');
        //$('#advance-search-page').removeClass('show');
    })
    $(document).ready(function () {
        $('.support-block').click(function (e) {
            $('#login-user-popup').removeClass('show');
            let chkclass = $('#support-user-popup').attr('class');
            if (chkclass == 'dropdown-menu pullDown user-seting-popup') {
                $('#support-user-popup').addClass('show');
            } else {
                $('#support-user-popup').removeClass('show');
            }
            e.stopPropagation();
        });
        $('.user-login-block').click(function (e) {
            $('#support-user-popup').removeClass('show');
            let chkclass = $('#login-user-popup').attr('class');
            if (chkclass == 'dropdown-menu pullDown user-seting-popup') {
                $('#login-user-popup').addClass('show');
            } else {
                $('#login-user-popup').removeClass('show');
            }
            e.stopPropagation();
        });
    });

    $(document).ready(function() {
        $('.dtBasicExample').DataTable();
    });

    $(function () {
        $('.material-tooltip-main').tooltip({
            template: '<div class="tooltip md-tooltip-main"> <div class = "tooltip-arrow md-arrow" > < /div> <div class = "tooltip-inner md-inner-main" > < /div> </div>'
        });
    })
    function editform() {
      var formdata = $("#editform").serialize();
      $.ajax({
         url:'{{route("edit_profile")}}',
         data:formdata,
         type:'POST',
         success:function(res) {
           if(res == "Done"){
            $("#result").html('<div class="alert alert-success"><button type="button" class="close">×</button>Profile Updated Successfully</div>');
            setTimeout(function() {
              $("#editprofile").modal('hide');
              $(".alert").fadeTo(500, 0).slideUp(500, function () {
                   $(this).remove();
              });
              window.location.reload();
            },2000);
           }
         }
      });
    }
    $('.alert .close').on("click", function (e) {
      $(this).parent().fadeTo(500, 0).slideUp(500);
    });
    function ordernow(packageid) {
      if(packageid != ''){
        $.ajax({
          url:'{{url("getOrder")}}/'+packageid,
          type:'GET',
          dataType:'JSON',
          success:function(res) {
            $("#ordernow").modal('show');
            $("#packagetitle").val(res.package_title);
            $("#packageprice").val(res.package_price);
            $("#duration").val(res.package_duration);
            $("#members").val(res.total_member);
            $("#totalprice").val(res.package_price);
            $("#package_id").val(packageid);
          }
        });
      }
    }

    function orderform() {
      var formdata = $("#orderform").serialize();
      $.ajax({
        url:'{{route("ordernow")}}',
        data:formdata,
        type:'POST',
        success:function(res) {
          if(res == "Done"){
            $("#orderresult").html('<div class="alert alert-success"><button type="button" class="close">×</button>Package added Successfully</div>');
            setTimeout(function() {
              $("#ordernow").modal('hide');
              $(".alert").fadeTo(500, 0).slideUp(500, function () {
                   $(this).remove();
              });
              window.location.reload();
            },2000);
           }
        }
      });
    }

    function serviceOrder(serviceid) {
      if(serviceid != ''){
        $.ajax({
          url:'{{url("getService")}}/'+serviceid,
          type:'GET',
          dataType:'JSON',
          success:function(res) {
            $("#serviceordernow").modal('show');
            $("#title").val(res.name);
            $("#price").val(res.service_price);
            $("#package_id").val(0);
            $("#serviceid").val(res.id);
          }
        });
      }
    }

    function serviceorderform() {
      var formdata = $("#serviceorderform").serialize();
      $.ajax({
        url:'{{route("ordernow")}}',
        data:formdata,
        type:'POST',
        success:function(res) {
          if(res == "Done"){
            $("#serviceorderresult").html('<div class="alert alert-success"><button type="button" class="close">×</button>Service added Successfully</div>');
            setTimeout(function() {
              $("#serviceordernow").modal('hide');
              $(".alert").fadeTo(500, 0).slideUp(500, function () {
                   $(this).remove();
              });
              window.location.reload();
            },2000);
           }
        }
      });
    }
</script>

@endsection