@extends('layouts.adminmaster')
@section('title', 'Sms Management')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.0/css/bootstrap-datepicker.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.0/js/bootstrap-datepicker.min.js"></script>                
<div class="right-details-box">
  <div class="home_brics_row">
    <div class="row">
      <div class="col-sm-12">
        <div class="row">
          <div class="col-sm-3">

           <div class="userleft">
            <div class="userleftbody">
              <form method="post" enctype="multipart/form-data" id="imageForm">
                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                <input type = "hidden" name = "customerid" value = "{{$customer->id}}">
                <div style="display: none;" id="snapdiv">
                  <div class="row">
                    <div class="col-lg-12" id="my_camera_div">
                      <div id="my_camera"></div>
                        <br/>
                        <input type=button class="btn-primary btn-sm" value="Take Snapshot" onClick="take_snapshot()">
                        <input type=button class="btn-danger btn-sm" value="Cancel Snapshot" onClick="cancel_take_snapshot()">
                        <input type="hidden" name="image" class="image-tag">
                    </div>
                    <div class="col-md-12">
                        <div id="results"></div>
                    </div>
                  </div>
                  <!-- <div class="row"> -->
                    
                  <!-- </div> -->
                </div>
              <div class="userleftimg mb-2" id="userimage">
                @if(!empty($customer->customer_image) && $customer->customer_image != '')
                <img src="{{ url('images/customer') }}/{{$customer->customer_image}}" />
                @else
                <img src="{{ url('images/customer') }}/default.png" />
                @endif
                <h5><button type="button" class="btn btn-primary" onclick="showsnapdiv()">Change Image</button></h5>
              </div>
              </form>
              
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
                   <tr>
                     <td>Remark<span>:</span></td>
                     <td>{{$customer->remark}}</td>
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
                    <th>Package Service</th>                                          
                    <th>Use Service</th>
                    <th>Add Member</th>                                          
                  </tr>
                  @php 
                  if(!empty($customer_packages)){ 
                  foreach($customer_packages as $packagelist){
                  @endphp
                  <tr>
                    <td>1</td>
                    <!-- <td><img height="80" src="http://www.venmond.com/demo/vendroid/img/avatar/avatar-4.jpg" alt=""></td>   -->                  
                    <td>{{$packagelist->package_title}} </td>                                    
                    <td>{{$packagelist->package_price}} Rs </td>                                    
                    <td>{{$packagelist->package_duration}} (Days) </td>                                    
                    <td>{{$packagelist->total_member}} </td>
                    <td class="text-center"><a onclick="openpackageservice('{{$packagelist->package_id}}','{{$packagelist->customer_id}}')" class="btn-floating btn-sm btn-success"><i style="color: #000;" class="mdi mdi-eye-outline"></i></a> </td>
                    <td class="text-center"><a onclick="usepackageservice('{{$packagelist->package_id}}','{{$packagelist->customer_id}}')" class="btn-floating btn-sm btn-danger"><i style="color: #000;" class="mdi mdi-eye-outline"></i></a> </td>
                    <td class="text-center">
                      @if($packagelist->total_member != $packagelist->member_in_package)
                      <a onclick="addMember('{{ $packagelist->customer_package_id }}')" class="btn-floating btn-sm btn-danger"><i style="color: #000;" class="mdi mdi-plus-outline"></i></a>
                      @endif
                    </td>
                  </tr>
                  @php
                  }
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
              @php
                $myPackage = DB::table('customer_package')->where('package_id',$package->package_id)->first();
                if(!empty($myPackage)){
                  $packid = $myPackage->package_id;
                }else{
                  $packid = 0;
                }
              @endphp
              @if($packid != $package->package_id)
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
          <form id="cartform_{{$servicelist->id}}" method="post" class="form-inline my-2 my-lg-0" >
              <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
              <input name="id" type="hidden" value="{{$servicelist->id}}">
              <button class="btn btn-success btn-block" onclick="addtocart('{{$servicelist->id}}')" type="button">Add to cart</button>
          </form>
        </div>
      </div><!--./col-lg-4-->
      @endforeach
      @endif
    </div><!--./row-->   
  </div>  
</div>

<script type="text/javascript">
  function addtocart(serviceid) {
    if (serviceid != '') {
      var formdata = $("#cartform_"+serviceid).serialize();
      // alert(formdata)
      $.ajax({
        url:"{{route('cart.add')}}",
        type:'POST',
        data: formdata,
        dataType:'JSON',
        success:function(res) {
          /*$(".alert-message .alert").first().hide().fadeIn(200).delay(2000).fadeOut(1000, function () { $(this).remove(); });*/
          // $("#mycard-popup").modal("show");
          $("#cart-item-body").html(res.html);
          $("#headcount").html('My Cart ('+res.count+') items');
          $("#basket_counter").html(res.count);
          $("#subTotal").html(res.subtotal);
        }
      });
    }
  }
</script>

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
        $transaction = DB::table('transaction')->leftJoin('packages','packages.package_id','=','transaction.package_id')->where('transaction.customer_id',$customer->id)->get();
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
              <th>Action</th>
            </tr>
            <tbody id="servicetransbody">
            @php
            $sevicetransaction = DB::table('service_transaction')->where('service_transaction.customer_id',$customer->id)->leftJoin('services','services.id','=','service_transaction.service_id')->get();
            if(!empty($sevicetransaction)){
            foreach($sevicetransaction as $servicetrans){
            @endphp
            <tr>
              <td>{{$servicetrans->name}}</td>
              <td>{{$servicetrans->service_price}} Rs</td>
              <td>{{date('d-m-Y',strtotime($servicetrans->transaction_date))}}</td>
              <td>
                <a href="javascript:void(0)" onclick="deleteTransaction('{{$servicetrans->service_transaction_id}}','{{$servicetrans->customer_id}}')" class="btn-danger btn-sm waves-effect waves-light material-tooltip-main" style="border:0 !important" data-toggle="tooltip" data-html="true" title="Delete">
                    <i class="mdi mdi-delete"></i>
                </a>
              </td>
            </tr>
            @php
          }
        }else{ }
        @endphp
        </tbody>
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

  <!-- Add member Modal -->
  <div class="modal" id="addsubmember">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="background: #000;">
        <!-- Modal Header -->
        <div class="modal-header" style="background: #daba7a; color: #fff; padding: 10px 30px;">
          <h4 class="modal-title" >Add Sub-member</h4>
          <!-- <span class="text-center" style="display: none;" id="msg">Profile Updated</span> -->
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="">
        <form class="editform" id="addsubmemberform" method="post">
          <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
          <input type="hidden" name="custid" id="custid" value="">
          <input type="hidden" name="custpackid" id="custpackid" value="">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
              <div class="form-group">
                <label class="control-label" for="customer_id">User Id <span class="required">*</span> </label>
                <input type="text"  id="customer_id" name="customer_id" value="{{ old('customer_id',$last_id) }}" placeholder="Enter User Id"  class="form-control" autocomplete="off" readonly="true">
                <span class="text text-danger"> @if ($errors->has('customer_id')){{ $errors->first('customer_id') }} @endif</span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
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
            <div class="col-lg-6 col-md-6 col-12">
              <div class="form-group">
                <label class="control-label" for="name">Name <span class="required">*</span> </label>
                  <input type="text"  id="name" name="name" value="{{ old('name') }}" placeholder="Enter name"  class="form-control" autocomplete="off">
                  <span class="text text-danger"> @if ($errors->has('name')){{ $errors->first('name') }} @endif</span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
              <div class="form-group">
                <label class="control-label" for="name">Location <span class="required">*</span> </label>
                <input type="text"  id="location" name="location" value="{{ old('location') }}" placeholder="Enter location"  class="form-control" autocomplete="off">
                <span class="text text-danger"> @if ($errors->has('location')){{ $errors->first('location') }} @endif</span>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
              <div class="form-group">
                <label class="control-label" for="contact">Contact <span class="required">*</span> </label>
                <input type="text"  id="contact" name="contact" value="{{ old('contact') }}" placeholder="Enter contact"  class="form-control" autocomplete="off">
                <span class="text text-danger"> @if ($errors->has('contact')){{ $errors->first('contact') }} @endif</span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
              <div class="form-group">
                <label class="control-label" for="other_contact">Other Contact </label>
                <input type="text"  id="other_contact" name="other_contact" value="{{ old('other_contact') }}" placeholder="Enter other contact"  class="form-control" autocomplete="off">
                <span class="text text-danger"> @if ($errors->has('other_contact')){{ $errors->first('other_contact') }} @endif</span>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
              <div class="form-group">
                <label class="control-label" for="email">Email </label>
                <input type="text"  id="email" name="email" value="{{ old('email') }}" placeholder="Enter email"  class="form-control" autocomplete="off">
                <span class="text text-danger"> @if ($errors->has('email')){{ $errors->first('email') }} @endif</span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
              <div class="form-group">
                <label class="control-label" for="contact">Dob </label>
                <input type="text"  id="dob" name="dob" value="{{ old('dob') }}" placeholder="Enter dob"  class="form-control datepicker" data-date-format="yyyy-mm-dd" autocomplete="off">
                <span class="text text-danger"> @if ($errors->has('dob')){{ $errors->first('dob') }} @endif</span>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
              <div class="form-group">
                <label class="control-label" for="referral_code">Referral Code  </label>
                <input type="text"  id="referral_code" name="referral_code" value="{{ old('referral_code',$last_id) }}" placeholder="Enter referral code"  class="form-control" autocomplete="off">
                <span class="text text-danger"> @if ($errors->has('referral_code')){{ $errors->first('referral_code') }} @endif</span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
              <div class="form-group">
                <label class="control-label" for="referred_by">Referred By  </label>
                <input type="text"  id="referred_by" name="referred_by" value="{{ old('referred_by') }}" placeholder="Enter Referred By"  class="form-control" autocomplete="off">
                <span class="text text-danger"> @if ($errors->has('referred_by')){{ $errors->first('referred_by') }} @endif</span>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
              <div class="form-group">
                <label class="control-label" for="reward_points">Reward Points  </label>
                <input type="text"  id="reward_points" name="reward_points" value="{{ old('reward_points') }}" placeholder="Enter reward points"  class="form-control" autocomplete="off">
                <span class="text text-danger"> @if ($errors->has('reward_points')){{ $errors->first('reward_points') }} @endif</span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
              <div class="form-group">
                <label class="control-label" for="anniversary_date">Anniversary Date</label>
                <input type="text"  id="anniversary_date" name="anniversary_date" value="{{ old('anniversary_date') }}" placeholder="Enter anniversary date"  class="form-control datepicker" data-date-format="yyyy-mm-dd" autocomplete="off">
                <span class="text text-danger"> @if ($errors->has('anniversary_date')){{ $errors->first('anniversary_date') }} @endif</span>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
              <div class="form-group">
                <label class="control-label" for="rf_id">RF-ID Code <span class="required">*</span> </label>
                <input type="text"  id="rf_id" name="rf_id" value="{{ old('rf_id',$last_id) }}" placeholder="Enter rf id"  class="form-control" autocomplete="off">
                <span class="text text-danger"> @if ($errors->has('rf_id')){{ $errors->first('rf_id') }} @endif</span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
              <div class="form-group">
                <label class="control-label" for="remark">Remark</label>
                <textarea id="remark" name="remark" placeholder="Enter remark"  class="form-control">{{ old('remark') }}</textarea>
                <span class="text text-danger"> @if ($errors->has('remark')){{ $errors->first('remark') }} @endif</span>
              </div>
            </div>
          </div>
          <div id="addmemberresult"></div>
          <button type="button" onclick="addmemberform()" class="submitbtn">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div><!--./Add member Modal-->

<!-- package services Modal -->
<div class="modal" id="packageservice">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background: #000;">

      <!-- Modal Header -->
      <div class="modal-header" style="background: #daba7a; color: #fff; padding: 10px 30px;">
        <h4 class="modal-title" >Package Services</h4>
        <!-- <span class="text-center" style="display: none;" id="msg">Profile Updated</span> -->
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="table-responsive">
        <table class="table table-bordered">
          <th class="text-center">Service Name</th>
          <th class="text-center">Total Service</th>
          <th class="text-center">Remaining Service</th>
          <th class="text-center">Used Service</th>
          <tbody id="tablebody"></tbody>
        </table>
      </div>
    </div>
  </div>
</div><!--./package services Modal-->

<!-- package services Modal -->
<div class="modal" id="usedpackageservice">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background: #000;">

      <!-- Modal Header -->
      <div class="modal-header" style="background: #daba7a; color: #fff; padding: 10px 30px;">
        <h4 class="modal-title" >Used Package Services</h4>
        <!-- <span class="text-center" style="display: none;" id="msg">Profile Updated</span> -->
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="table-responsive">
        <table class="table table-bordered">
          <th class="text-center">S.No.</th>
          <th class="text-center">Customer Name</th>
          <th class="text-center">RFID</th>
          <th class="text-center">Count</th>
          <th class="text-center">Date</th>
          <!-- <th class="text-center">Remaining Service</th>
          <th class="text-center">Used Service</th> -->
          <tbody id="usedtablebody"></tbody>
        </table>
      </div>
    </div>
  </div>
</div><!--./package services Modal-->

<!--use package services Modal -->
<div class="modal" id="usepackageservice">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background: #000;">

      <!-- Modal Header -->
      <div class="modal-header" style="background: #daba7a; color: #fff; padding: 10px 30px;">
        <h4 class="modal-title" >Use Service</h4>
        <!-- <span class="text-center" style="display: none;" id="msg">Profile Updated</span> -->
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="">
        <form class="editform" id="useserviceform" method="post">
          <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
          <input type="hidden" name="cust_id" id="cust_id" value="">
          <input type="hidden" name="pack_id" id="pack_id" value="">
          <div class="form-group">
            <label>Select Service</label>
            <select class="form-control" id="selectservice" name="selectservice" onchange="getServiceDetails(this.value)">
              <option value="">Select</option>
            </select>
          </div>
          <div id="othercontent" style="display: none;">
          </div>
          <div id="useserviceresult"></div>
          <button id="saveBtn" style="display: none;" type="button" onclick="useservice()" class="submitbtn">Save</button>
        </form>
      </div>
    </div>
  </div>
</div><!--./use package services Modal-->


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
        <input type="hidden" name="package_id" id="packageid">
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
        <div class="form-group col-md-3">
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
              <div class="col-lg-6 col-md-6 col-12">
                <div class="form-group">
                  <label>Remark</label>
                  <input type="text" class="form-control" name="remark" id="remark" placeholder="" value="{{$customer->remark}}">
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
            <label>Add/Deduct</label>
            <select class="form-control" id="addremove" name="addremove" onchange="showRewardDiv(this.value)">
              <option value="">Select</option>
              <option value="1">Add Reward Points</option>
              <option value="2">Deduct Reward Points</option>
            </select>
          </div>
          <div id="rewarddiv" style="display: none;">
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
          </div>

        </form>
      </div>
    </div>
  </div>
</div><!--./addreward-->
<script type="text/javascript">
  function deleteTransaction(id,cust_id) {
    if (confirm("Are you sure?")) {
      $.ajax({
        url:'{{url("customer/delete_transaction")}}/'+id+'/'+cust_id,
        type:"GET",
        success:function(res) {
          // alert(res);
          if (res != "") {
            $("#servicetransbody").html(res);
          }
        }
      });
    }
  }
  $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
  function addmemberform() {
    var formdata = $("#addsubmemberform").serialize();
    $.ajax({
      url:'{{ route("customers.store") }}',
      data:formdata,
      type:"POST",
      success:function(res) {
        if(res == "Done"){
          $("#addmemberresult").html('<div class="alert alert-success"><button type="button" class="close">×</button>Member add Successfully</div>');
          setTimeout(function() {
            $("#addsubmemberform").modal('hide');
            $(".alert").fadeTo(500, 0).slideUp(500, function () {
             $(this).remove();
           });
            window.location.reload();
          },2000);
        }
      }
    })
  }
  function addMember(custid) {
    $("#addsubmember").modal('show');
    $("#custpackid").val(custid);
  }
  function showRewardDiv(val) {
    if (val != '') {
      $("#rewarddiv").show();
      if (val == 1) {
        $("#addRewardBtn").html("Add");
      }else{
        $("#addRewardBtn").html("Deduct");
      }
    }else{
      $("#rewarddiv").hide();
    }
  }
  function useservice() {
    var formdata = $("#useserviceform").serialize();
    $.ajax({
      url:'{{url("useservice")}}',
      type:'POST',
      data:formdata,
      success:function(res) {
        if(res == "Done"){
          $("#useserviceresult").html('<div class="alert alert-success"><button type="button" class="close">×</button>Record save Successfully</div>');
          setTimeout(function() {
            $("#usepackageservice").modal('hide');
            $(".alert").fadeTo(500, 0).slideUp(500, function () {
             $(this).remove();
           });
            window.location.reload();
          },2000);
        }
      },
      error: function (jqXHR, exception) {
        var msg = '';
        if (jqXHR.status === 0) {
          msg = 'Not connect.\n Verify Network.';
        } else if (jqXHR.status == 422) {
          $("#useserviceresult").html('<div class="alert alert-danger"><button type="button" class="close">×</button>Select checkbox for use this service</div>');
          $(".alert").fadeTo(2000, 0).slideUp(500, function () {
           $(this).remove();
         });
        } /*else if (jqXHR.status == 500) {
            msg = 'Internal Server Error [500].';
        } else if (exception === 'parsererror') {
            msg = 'Requested JSON parse failed.';
        } else if (exception === 'timeout') {
            msg = 'Time out error.';
        } else if (exception === 'abort') {
            msg = 'Ajax request aborted.';
        } else {
            msg = 'Uncaught Error.\n' + jqXHR.responseText;
          }*/
        // $('#post').html(msg);
        /*$("#useserviceresult").html('<div class="alert alert-danger"><button type="button" class="close">×</button>Select checkbox for use this service</div>');*/
      }
    })
  }

  function getServiceDetails(serv_id) {
    // if (serv_id != '') {
      var customerid = $("#cust_id").val();
      var package_id = $("#pack_id").val();
      $.ajax({
        url:'{{url("getServiceDetails")}}/'+package_id+'/'+customerid+'/'+serv_id,
        type:'GET',
        dataType:'JSON',
        success:function(res) {
          // alert(res)
          if (res != '') {
            $("#othercontent").show();
            $("#othercontent").html(res);
            $("#saveBtn").show();
          }else{
            $("#saveBtn").hide();
            $("#othercontent").hide();
            $("#useserviceresult").html('<div class="alert alert-danger"><button type="button" class="close">×</button>No Remaining service on this package</div>');
            $(".alert").fadeTo(5000, 0).slideUp(500, function () {
             $(this).remove();
           });
          }
        },
        error: function (jqXHR, exception) {
          var msg = '';
          if (jqXHR.status === 0) {
            msg = 'Not connect.\n Verify Network.';
          } else if (jqXHR.status == 422) {
            $("#useserviceresult").html('<div class="alert alert-danger"><button type="button" class="close">×</button>Select checkbox for use this service</div>');
            $(".alert").fadeTo(5000, 0).slideUp(500, function () {
             $(this).remove();
           });
        } /*else if (jqXHR.status == 500) {
            msg = 'Internal Server Error [500].';
        } else if (exception === 'parsererror') {
            msg = 'Requested JSON parse failed.';
        } else if (exception === 'timeout') {
            msg = 'Time out error.';
        } else if (exception === 'abort') {
            msg = 'Ajax request aborted.';
        } else {
            msg = 'Uncaught Error.\n' + jqXHR.responseText;
          }*/
        // $('#post').html(msg);
        /*$("#useserviceresult").html('<div class="alert alert-danger"><button type="button" class="close">×</button>Select checkbox for use this service</div>');*/
      }
    });
    // }
  }

  function usepackageservice(package_id,customerid) {
    if (package_id != '') {
      $.ajax({
        url:'{{url("usepackageservice")}}/'+package_id+'/'+customerid,
        type:'GET',
        dataType:'JSON',
        success:function(res) {
          $("#usepackageservice").modal('show');
          $("#cust_id").val(customerid);
          $("#pack_id").val(package_id);
          $("#selectservice").html(res);
        }
      });
    }
  }

  function openpackageservice(package_id,customerid) {
    if (package_id != '') {
      $.ajax({
        url:'{{url("packageservice")}}/'+package_id+'/'+customerid,
        type:'GET',
        dataType:'JSON',
        success:function(res) {
          $("#packageservice").modal('show');
          $("#tablebody").html(res);
        }
      });
    }
  }

  function checkusedservice(package_service_id) {
    if (package_service_id != '') {
      $.ajax({
        url:'{{url("checkusedservice")}}/'+package_service_id,
        type:'GET',
        dataType:'JSON',
        success:function(res) {
          $("#usedpackageservice").modal('show');
          $("#usedtablebody").html(res);
          if(res != "")
          {
            $("#usedtablebody").html(res);
          }else{
            $("#usedtablebody").html('<tr><td class="text-center" colspan="5">No result found</td></tr>');
          }
        }
      });
    }
  }

  function addReward(id) {
    $("#addreward").modal('show');
  }

    /*function addRewardPoint() {
      var formdata = $("#rewardPointform").serialize();
      $.ajax({
         url:'{{route("add_reward")}}',
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
           }
         }
      });
    }*/

    function otpVerifyReward() {
      var formdata = $("#rewardPointform").serialize();
      $.ajax({
        url:'{{route("otpverify")}}',
        data:formdata,
        type:'POST',
        success:function(res) {
          if(res == "Done"){
            var addremove = $("#addremove").val();
            if(addremove == 1){
              $("#addrewardresult").html('<div class="alert alert-success"><button type="button" class="close">×</button>Reward point added Successfully</div>');
            }else{
              $("#addrewardresult").html('<div class="alert alert-success"><button type="button" class="close">×</button>Reward point deduct Successfully</div>');
            }

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
        },
        error: function (jqXHR, exception) {
          var msg = '';
          if (jqXHR.status === 0) {
            msg = 'Not connect.\n Verify Network.';
          } else if (jqXHR.status == 422) {
            $("#addrewardresult").html('<div class="alert alert-danger"><button type="button" class="close">×</button>Enter otp</div>');
            $(".alert").fadeTo(2000, 0).slideUp(500, function () {
             $(this).remove();
           });
          } /*else if (jqXHR.status == 500) {
              msg = 'Internal Server Error [500].';
          } else if (exception === 'parsererror') {
              msg = 'Requested JSON parse failed.';
          } else if (exception === 'timeout') {
              msg = 'Time out error.';
          } else if (exception === 'abort') {
              msg = 'Ajax request aborted.';
          } else {
              msg = 'Uncaught Error.\n' + jqXHR.responseText;
            }*/
          // $('#post').html(msg);
          /*$("#useserviceresult").html('<div class="alert alert-danger"><button type="button" class="close">×</button>Select checkbox for use this service</div>');*/
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
        },
        error: function (jqXHR, exception) {
          var msg = '';
          if (jqXHR.status === 0) {
            msg = 'Not connect.\n Verify Network.';
          } else if (jqXHR.status == 422) {
            $("#addrewardresult").html('<div class="alert alert-danger"><button type="button" class="close">×</button>Enter reward points</div>');
            $(".alert").fadeTo(2000, 0).slideUp(500, function () {
             $(this).remove();
           });
        } /*else if (jqXHR.status == 500) {
            msg = 'Internal Server Error [500].';
        } else if (exception === 'parsererror') {
            msg = 'Requested JSON parse failed.';
        } else if (exception === 'timeout') {
            msg = 'Time out error.';
        } else if (exception === 'abort') {
            msg = 'Ajax request aborted.';
        } else {
            msg = 'Uncaught Error.\n' + jqXHR.responseText;
          }*/
        // $('#post').html(msg);
        /*$("#useserviceresult").html('<div class="alert alert-danger"><button type="button" class="close">×</button>Select checkbox for use this service</div>');*/
      }
    });
    }

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
              $("#packageid").val(packageid);
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>

<script>
    function showsnapdiv() {
      $("#snapdiv").show();
      $("#userimage").hide();
    }
    function cancel_take_snapshot() {
      // alert("hii")
      $("#snapdiv").hide();
      $("#my_camera_div").show();
      $("#userimage").show();
      $(".image-tag").val('');
      document.getElementById('results').innerHTML = '';
    }
    /*Webcam.set({
        width: 250,
        height: 200,
        image_format: 'jpeg',
        jpeg_quality: 90
    });

    Webcam.attach('#my_camera');*/

    function take_snapshot() {
       // alert('hello');
        Webcam.snap(function (data_uri) {
            // alert(data_uri)
            $("#my_camera_div").hide();
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/><br><input type=button class="btn-primary btn-sm" value="Upload Image" onClick="update_snapshot()"><input type=button class="btn-danger btn-sm" value="Change Snapshot" onClick="cancel_current_snapshot()">';

        });
    }
    function cancel_current_snapshot(argument) {
      $("#snapdiv").show();
      $("#results").html('');
      $("#my_camera_div").show();
      $("#userimage").hide();
      $(".image-tag").val('');
      document.getElementById('results').innerHTML = '';
    }

    function update_snapshot() {
      var formdata = $("#imageForm").serialize();
      $.ajax({
        url:'{{url("uploadUserImage")}}',
        data:formdata,
        type:'POST',
        success:function(res) {
          if(res == "Done"){
            window.location.reload();
          }
        }
      });
    }
</script>

    @endsection