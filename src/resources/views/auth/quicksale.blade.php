
@extends('layouts.newlayout.app')
@section('content')
<div class="main">
  @if (\Session::has('success'))
  <div class="alert alert-success">
    <ul>
      <li>{!! \Session::get('success') !!}</li>
    </ul>
  </div>
  @endif
  <!-- <form> -->
    <div class="main-content">
      <div class="container-fluid">
       <div class="boxbody">
         <div class="row">
          <div class="col-lg-6 col-md-12 col-12">
            <div class="card-header">
              <h5 class="card-title">Quick Sale <i class="fa fa-question-circle"></i></h5>
            </div>
          </div><!--./col-lg-6-->
          <div class="col-lg-6 col-md-12 col-12 text-right">
            <a href="#" class="theme-btn mt-2 mr-3"><i class="fa fa-refresh"></i> Switch to new quick sale</a>
          </div><!--./col-lg-6-->
        </div><!--./row-->
        <div class="col-lg-12 col-md-12 col-12">

         <form id="quicksaleForm" action="{{ url('quicksaleInvoice') }}" method="post" target="_blank" class="formvisit mt-2">
           <div class="row">
                  <!-- <div class="col-lg-4">
                    <select required="" name="services_0" class="form-control selectpicker" onchange="getServicePrice(this.value,0)" aria-describedby="services_0-error" aria-invalid="false"><optgroup label="Hair Services"><option value="5">Basic Haircut</option><option value="9">Hair Coloring</option></optgroup><optgroup label="Beauty Services"></optgroup></select>
                  </div> -->
                  <div class="col-lg-4 col-md-12 col-12">
                    <div class="form-group">
                      <label>Visit Date</label>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend"><span class="input-group-text">+91</span></div>
                        <input type="hidden" name="customer_id" id="customer_id" required="" >
                        <!-- <input required type="number" id="searchnumber" name="searchnumber" onkeyup="checkaccount(this.value)" class="form-control" placeholder="1234567890"> -->
                        <input required type="number" id="searchnumber" name="searchnumber" class="form-control" placeholder="1234567890">
                        <div id="data-container"></div>
                        <div class="input-group-prepend" style="display: none;" id="customeraddicon">

                          <a onclick="addCustomer()" href="javascript:void(0)" class="input-group-text"><i class="fa fa-plus">Add</i></a>
                        </div>
                        <div class="input-group-prepend" style="display: none;" id="customericon">
                          <span class="input-group-text"><i class="fa fa-user"></i></span>
                        </div>
                        <input id="customername" readonly="" style="display: none;" type="text" class="form-control" placeholder="Customer name">
                        <input id="customerid" readonly="" style="display: none;" type="text" class="form-control" placeholder="Customer id">
                        <div id="customerupdateicon" class="input-group-prepend" style="display: none;">
                          <a data-toggle="modal" data-target="#editcustomer" href="javascript:void(0)" class="input-group-text"><i class="fa fa-pencil-square-o"></i></a>
                        </div>
                      </div>
                    </div><!--./form-group-->
                  </div><!--./col-lg-8-->
                  <div class="col-lg-4 col-md-12 col-12">
                   <div class="form-group">
                    <label>Date</label>
                    <div class="input-group mb-3">
                      <input id="billingdate" name="billingdate" required="" type="text" class="form-control datepicker" placeholder="" value="<?php echo date('d/m/Y') ?>">
                      <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
                    </div>
                  </div><!--./form-group-->
                </div><!--./col-lg-4-->
                <div class="col-lg-2 col-md-12 col-12" style="display: none;" id="unpaidbtndiv">
                 <div class="form-group">
                  <!-- <label>Date</label> -->
                  <div class="input-group mb-3">
                    <button type="button" class="theme-btn btn-sm" id="unpaidbtn"></button>
                  </div>
                </div><!--./form-group-->
              </div><!--./col-lg-4-->
              <div class="col-lg-12">
               <div class="row">
                 <div class="col-lg-3 col-md-12 col-12" style="display: none;" id="visitdiv">
                  <div class="visitmetric">
                    <p>Total Visit - <span id="visitshowspan" onclick="showHistoryVisit()" style="cursor: pointer">0</span></p>
                    <p>Last Visit-</p>
                    <p><b id="visitshowdate">Nil</b></p>
                  </div><!--./metric-->
                </div><!--./col-lg-4-->
                <div class="col-lg-3 col-md-12 col-12" style="display: none;" id="revenuediv">
                  <div class="visitmetric">
                    <p>&nbsp;</p>
                    <p id="totalRevenueShow"></p>
                    <p><b>Total Revenue</b></p>
                  </div><!--./metric-->
                </div><!--./col-lg-4-->
                <div class="col-lg-3 col-md-12 col-12" style="display: none;" id="giftpointdiv">
                  <div class="visitmetric">
                    <p>&nbsp;</p>
                    <p id="totalgiftpointShow"> 0 </p>
                    <p><b>Total Gift Points</b></p>
                  </div><!--./metric-->
                </div><!--./col-lg-4-->
                <div class="col-lg-3 col-md-12 col-12" style="display: none;" id="remarkdiv">
                  <div class="visitmetricdd">
                    <!-- <p>&nbsp;</p>   -->
                    <p><textarea class="form-control" placeholder="Remark" rows="4" id="customerRemark" onkeyup="saveRemark(this.value)"></textarea></p>
                    <p id="remarkShow"></p>
                    <p>&nbsp;</p>
                  </div><!--./metric-->
                </div><!--./col-lg-4-->
              </div>
            </div>
            <div class="col-lg-12 col-md-12 col-12"><div style="display: none;" class="divider serviceDivider"></div></div><!--/col-lg-12-->
            <div class="col-lg-12">
              <div id="serviceDiv">

              </div>
              <!-- </div> -->

              <div id="productDiv">
                <div class="divider productDivider" style="display: none"></div>
              </div>

              <div id="packageDiv">
                <div class="divider packageDivider" style="display: none"></div>
              </div>
              <!--./row-->
              <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                  <ul class="serviceslist mt-2 mb-3">
                    <li><a onclick="addServiceRow()" href="javascript:void(0)"><i class="fa fa-plus"></i>Services</a></li>
                    <li><a onclick="addProductRow()" href="javascript:void(0)"><i class="fa fa-plus"></i>Product</a></li>
                    <li><a onclick="addPackageRow()" href="javascript:void(0)"><i class="fa fa-plus"></i>Package</a></li>
                        <!-- <li><a href=""><i class="fa fa-plus"></i>Membership</a></li>
                        <li><a href=""><i class="fa fa-plus"></i>Gift Voucher</a></li>
                        <li><a href=""><i class="fa fa-plus"></i>Prepaid</a></li> -->
                  </ul>
                </div><!--./col-lg-12-->
              </div>
                </div><!--./col-lg-12-->
                <div class="col-lg-12 col-md-12 col-12"><div class="divider"></div></div><!--/col-lg-12-->
                <div class="col-lg-12 col-md-12 col-12">
                 <h6>Overall benefits</h6>
                 <div class="row">
                   <div class="col-lg-4 col-md-12 col-12">
                     <div class="form-group">
                      <label>Disc. by Value</label>
                      <div class="input-group mb-3">
                       <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-inr"></i></span>
                      </div>
                      <input name="discountByValue" id="discountByValue" onkeyup="discByValue(this.value)" type="text" class="form-control" placeholder="0">
                    </div>
                  </div><!--./form-group-->
                </div><!--./col-lg-4-->

                <div class="col-lg-4 col-md-12 col-12">
                 <div class="form-group">
                  <label>Disc. by Percentage</label>
                  <div class="input-group mb-3">
                    <input name="discountByPercent" id="discountByPercent" onkeyup="discByPercent(this.value)" type="text" class="form-control" placeholder="0">
                    <div class="input-group-prepend">
                      <span class="input-group-text">%</span>
                    </div>
                  </div>
                </div><!--./form-group-->
              </div><!--./col-lg-4-->

                     <div class="col-lg-4 col-md-12 col-12">
                       <div class="form-group">
                          <label>Redeem Gift Points</label>
                          <input type="text" name="gift_points" id="gift_points" class="form-control" value="0" onchange="checkcustomerpoints(this.value)"/>
                        </div> <!--./form-group-->
                      </div> <!--./col-lg-4-->

                </div><!--./row-->
              </div><!--/col-lg-12-->

                    <div class="col-lg-12 col-md-12 col-12"><div class="divider"></div></div><!--/col-lg-12-->
                    <div class="col-lg-12 col-md-12 col-12">
                      <h6>Mode of Payment</h6>
                      <div class="row mb-2">
                        <div class="col-lg-8 col-md-12 col-12">
                          <ul class="cashlist mt-3 mb-3">
                            <li><a href="javascript:void(0)" onclick="changeValue()">Cash <span id="cashpay">0</span></a></li>
                            <li><a href="#">Card <span>0</span></a></li>
                          </ul>
                          <div class="form-group">
                            <label>Payable Amount</label>
                            <div class="input-group mb-3" style="width: 250px;">
                              <div class="input-group-append">
                                <span class="input-group-text"><i class="fa fa-inr"></i></span>
                              </div>
                              <input id="payLater" name="payLater" type="text" class="form-control" placeholder="" value="0">
                            </div>
                          </div>
                          <p class="mt-3 mb-3"><a href="javascript:void(0)" onclick="showRemark()" class="text-warning">Remarks</a></p>
                          <div class="form-group" style="display: none;" id="remarkDiv">
                            <div class="input-group mb-3" style="width: 250px;">
                              <div class="input-group-append">
                                <span class="input-group-text"><i class="fa fa-envelope-o"></i></span>
                              </div>
                              <textarea id="remark" name="remark" class="form-control"></textarea>
                            </div>
                          </div>
                        </div><!--./col-lg-8-->
                        <div class="col-lg-4 col-md-12 col-12">
                          <table class="table table-bordered table-striped">
                            <tr>
                              <td>Sub Total Amount:</td>
                              <td><i class="fa fa-inr"></i> <input type="hidden" name="subtotalamount" id="subtotalamount"><span id="subtotal">0.00</span></td>
                            </tr>
                            <tr>
                              <td>CGST:</td>
                              <td><i class="fa fa-inr"></i> <input type="hidden" name="totalinputSgst" id="totalinputSgst"><span id="totalsgstval">0.00</span></td>
                            </tr>
                            <tr>
                              <td>SGST:</td>
                              <td><i class="fa fa-inr"></i> <input type="hidden" name="totalinputCgst" id="totalinputCgst"><span id="totalcgstval">0.00</span></td>
                            </tr>
                            <tr>
                              <td>Grand Total</td>
                              <td><i class="fa fa-inr"></i> <input type="hidden" name="totalgrandTotal" id="totalgrandTotal"><span id="grandtotal">0.00</span></td>
                            </tr>
                            <tr>
                              <td>
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" id="allow_gift_points">
                                  <label class="form-check-label" for="allow_gift_points">
                                    Allow Gift Points
                                  </label>
                                </div>
                              </td>
                              <td>
                              <input type="hidden" name="totalredeempoint" id="totalredeempoint" value="0">
                              <span id="redeem_point">0</span>
                              </td>

                            </tr>
                          <!-- <tr>
                            <td><a href="javascript:void(0)" onclick="getTipPopup()" class="text-warning"><i class="fa fa-plus-circle"></i> Add Tip</a></td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>Change</td>
                            <td><i class="fa fa-inr"></i> 0.00</td>
                          </tr> -->
                        </table>
                      </div><!--./col-lg-4-->
                      <div class="col-md-12 col-md-12 col-12">
                        <input type="hidden" name="serviceRowCount" id="serviceRowCount" value="0">
                        <input type="hidden" name="productRowCount" id="productRowCount" value="0">
                        <input type="hidden" name="packageRowCount" id="packageRowCount" value="0">
                        <p>Total Tax: <i class="fa fa-inr"></i> <input type="hidden" name="totaltax" id="totaltaxinput"><span id="totalTax">0.00</span> Final Tax <i class="fa fa-inr"></i> <span id="finalTax">0.00</span></p>
                      </div><!--./col-lg-12-->
                      <div class="col-lg-12 col-md-12 col-12"><div class="divider"></div></div><!--/col-lg-12-->
                      <div class="col-lg-6 col-md-12 col-12">
                        <!-- <p>Note: Tax is not applicable if mode of payment is PREPAID</p> -->
                      </div><!--/col-lg-12-->
                      <div class="col-lg-6 col-md-12 col-12 text-right">
                        <!-- <div class="form-group">
                          <label>Invoice type</label>
                          <select class="form-control" name="invoice_type" id="invoice_type">
                            <option value="">Select</option>
                            <option value="1">Send via SMS</option>
                            <option value="2">Bill with amount</option>
                            <option value="3">Bill without amount</option>
                          </select>
                        </div> -->
                        <a href="" onclick="confirm('Do you really wants reset fields?')" class="btn btn-warning btn-sm waves-effect waves-light">Reset</a> <!-- <button type="submit" class="theme-btn">Save</button> -->
                        <input type="submit" name="invoice_type" value="Send via SMS" class="btn btn-primary btn-sm waves-effect waves-light">
                        <button type="button" onclick="get_invoice_type()" class="btn btn-success btn-sm waves-effect waves-light"> Save Invoice</button>
                        <input type="submit" name="invoice_type" id="withamountinvoice" value="Bill with amount" style="display:none;">
                        <input type="submit" name="invoice_type" id="withoutamountinvoice" value="Bill without amount" style="display:none;">
                      </div><!--./col-lg-4-->
                    </div><!--./row-->
                  </div><!--/col-lg-12-->
                </div><!--./row-->
              </form>
            </div><!--./col-lg-12-->
          </div><!--./boxbody-->
        </div><!--./container-fluid-->

        <div class="modal" id="addcustomer">
          <div class="modal-dialog modal-lg">
            <form action="{{ route('quick_sale.store') }}" id="addcustomerform" method="post" enctype="multipart/form-data">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Add Customer</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <input type = "hidden" name = "_token" id="csrfToken" value = "<?php echo csrf_token(); ?>">
                <!-- Modal body -->
                <div class="modal-body formvisit">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label" for="image">User Image   </label>
                          <input type="file"  name="image" id="image">
                          <span class="text text-danger"> @if ($errors->has('image')){{ $errors->first('image') }} @endif</span>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label" for="customer_id">User Id   </label>
                          <input type="text"  id="customer_ids" name="customer_id" placeholder="Enter User Id"  class="form-control" autocomplete="off" readonly="true">
                          <span class="text text-danger"> @if ($errors->has('customer_id')){{ $errors->first('customer_id') }} @endif</span>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label" for="cust_type">Customer Type </label>
                            <select name="cust_type" id="cust_type" class="form-control">
                              <option value="NON VIP"  {{ old('cust_type') == 'NON VIP' ? 'selected' : '' }}>NON VIP</option>
                                <option value="VIP"  {{ old('cust_type') == 'VIP' ? 'selected' : '' }}>VIP</option>
                            </select>
                          <span class="text text-danger"> @if ($errors->has('cust_type')){{ $errors->first('cust_type') }} @endif</span>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label" for="name">Name <span class="required">* </span> </label>
                          <input type="text"  id="name" name="name" value="{{ old('name') }}" placeholder="Enter name"  class="form-control" autocomplete="off">
                          <span class="text text-danger"> @if ($errors->has('name')){{ $errors->first('name') }} @endif</span>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label" for="name">Location <span class="required">  <a data-toggle="modal" data-target="#addLocation" href="javascript:void(0)">Add New</a></span> </label>
                          <select type="text"  id="location" name="location" value="{{ old('location') }}" placeholder="Enter location"  class="form-control" autocomplete="off">
                           <option value="">Select Location</option>

                          </select>
                          <span class="text text-danger"> @if ($errors->has('location')){{ $errors->first('location') }} @endif</span>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label" for="contact">Contact <span class="required">*  <button class="btn btn-sm btn-danger" id="otpbtn"  type="button" onclick="sendotp()">Get OTP</button></span> </label>
                          <input type="number"  id="contact" name="contact" value="{{ old('contact') }}" placeholder="Enter contact"  class="form-control" autocomplete="off">
                          <span class="text text-danger"> @if ($errors->has('contact')){{ $errors->first('contact') }} @endif</span>
                      </div>
                    </div>
                    {{-- <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label" for="contact">OTP <span class="required">*</span> </label>
                          <input type="number"  id="otp" name="otp" value="{{ old('otp') }}" placeholder="Enter OTP"  class="form-control" autocomplete="off">

                          <span class="text text-danger"> @if ($errors->has('otp')){{ $errors->first('otp') }} @endif</span>
                      </div>
                    </div> --}}
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
                        <label class="control-label" for="referral_code">Designation <a data-toggle="modal" data-target="#addDesignation" href="javascript:void(0)">Add New</a> </label>
                          <select type="text"  id="designation" name="designation" value="" placeholder="Enter designation"  class="form-control" autocomplete="off">


                          </select>
                          <span class="text text-danger"> @if ($errors->has('designation')){{ $errors->first('designation') }} @endif</span>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label" for="referral_code">Referral Code  </label> {{-- value="{{ old('referral_code',$last_id) }}" --}}

                          <input type="text"  id="referral_code" name="referral_code"  placeholder="Enter referral code"  class="form-control" autocomplete="off">
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
                        <label class="control-label" for="rf_id">RF-ID Code   </label> {{-- value="{{ old('rf_id',$last_id) }}" --}}
                          <input type="text"  id="rf_id" name="rf_id" placeholder="Enter rf id"  class="form-control" autocomplete="off">
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

                   <button style="display:none;" type="submit" id="customerformbtn" class="theme-btn">Save</button>
                </div>
              </div>
            </form>
          </div>
          </div><!--#/addcustomer-->
          <footer>
            Copyright © 2020 Chinnie & Vinnie Jabalpur Salon. All rights reserved.
          </footer>
           </div><!--./main-content-->
        </div><!--./main-->
    <!-- </form> -->
    <!--./wrapper-->

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


        <div class="modal" id="addDesignation">
          <div class="modal-dialog modal-mld">
            <form id="addDesignationform" method="post">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Add Designation</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                <!-- Modal body -->
                <div class="modal-body formvisit">
                  <div class="row">
                    <div class="col-lg-6 col-md-12 col-12">
                      <div class="form-group">
                        <label>Designation</label>
                        <input type="text" name="name" id="designame" value="{{ old('name') }}" placeholder="Enter Designation "  class="form-control">
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
        </div>

        <div class="modal" id="saveotpModelsssssss">
          <div class="modal-dialog modal-sm">
            {{-- <form id="saveotpModelssform" method="post"> --}}
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">OTP Verification</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                <!-- Modal body -->
                <div class="modal-body formvisit">
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                      <div class="form-group">
                        <label class="control-label" for="contact">OTP <span class="required">*</span> </label>
                          <input type="number"  id="otp" name="otp" value="{{ old('otp') }}" placeholder="Enter OTP"  class="form-control" autocomplete="off">

                          <span class="text text-danger"> @if ($errors->has('otp')){{ $errors->first('otp') }} @endif</span>
                      </div>
                    </div><!--./col-lg-4-->



                  </div><!--./row-->
                </div>
                <div class="modal-footer">
                  <button type="submit" onclick="skip()" class="outline-btn" >Skip</button>
                  <button onclick="saveotp();" class="theme-btn">Save</button>
                </div>
              </div>
            {{-- </form> --}}
          </div>
        </div><!--#/addcustomer-->

        <div class="modal" id="historyofCustomer">
          <div class="modal-dialog modal-lg">
            {{-- <form id="saveotpModelssform" method="post"> --}}
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Customer Visit History</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                <!-- Modal body -->
                <div class="modal-body formvisit">
                 <div class="table table-responsive">
                   <table class="table table-bordered table-striped">
                     <thead>
                       <th>SI.No.</th>
                       <th>Sub Total</th>
                       <th>Grand Total</th>
                       <th>Paid Amount</th>
                       <th>Payment Mode</th>
                       <th>Date</th>
                       <th>Bill</th>
                     </thead>
                     <tbody id="setvisitData">

                     </tbody>
                   </table>
                 </div>
                </div>
                <div class="modal-footer">
                  <button type="submit"  class="outline-btn" data-dismiss="modal">Cencel</button>
                  {{-- <button onclick="saveotp();" class="theme-btn">Save</button> --}}
                </div>
              </div>
            {{-- </form> --}}
          </div>
        </div><!--#/addcustomer-->


        <div class="modal" tabindex="-1" role="dialog" id="getInvoiceType">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Select Invoice Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                      <div class="col-md-12">
                        <select name="" id="setInvoiceType" class="form-control">
                          <option value="Bill with amount">Bill with amount</option>
                          <option value="Bill without amount">Bill without amount</option>
                        </select>
                      </div>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="set_Invoice_Type()">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>


<script src="{{asset('assets/js/lib/jquery.js')}}"></script>
<script src="{{asset('assets/js/dist/jquery.validate.js')}}"></script>

<script type="text/javascript">
function showHistoryVisit()
{
  var customerid=$('#customer_id').val();

  $.ajax({
    type:'POST',
    url:'showHistoryVisit',
    data:{"_token": "{{ csrf_token() }}",customerid:customerid},
    success:function(msg){

      $('#historyofCustomer').modal('show');
      $('#setvisitData').html(msg);

    }
  });
}
  $('#searchnumber').keyup(function() {
    var search_query = $(this).val();
    if (search_query.length >=5 ) {
      var form_data = {
        search_query : search_query
      }
      var resp_data_format="";
      $.ajax({
        url:"{{ url('findResponce') }}",
        data : form_data,
        method : "post",
        dataType : "json",
        success : function(response) {
          // alert(response)
          if (response != '') {
            if (response.verify_otp != 0 && response.is_verified == 0 && search_query.length == 10) {
              $("#addcustomer").modal('hide');
              //$("#verifyotpModel").modal('show');
              $("#customerid").val(response.id);
            }else{
              for (var i = 0; i < response.contact.length; i++) {
                // alert(response.contact[i])
                resp_data_format=resp_data_format+"<li style='cursor:pointer' onclick='checkaccount('"+response.contact[i]+"')' class='select_contact'>"+response.contact[i]+"</li><span>- "+response.name[i]+" ("+response.id[i]+")<span>";
              };
              $("#data-container").html(resp_data_format);
            }
          }else{
            checkaccount(search_query);
            $("#data-container").html('');
          }
        }
      });
    }
  });
  $(document).on( "click", ".select_contact", function(){
    var selected_country = $(this).html();
    $('#searchnumber').val(selected_country);
    checkaccount(selected_country);
    $('#data-container').html('');
  });

  function showRemark() {
    $("#remarkDiv").toggle();
  }
  function changeValue() {
    var cashpay = $("#cashpay").html();
    if (cashpay != 0) {
      $("#payLater").val(cashpay);
      $("#cashpay").html(0);
    }else{
      var payLater = $("#payLater").val();
      $("#payLater").val(0);
      $("#cashpay").html(0);
      $("#cashpay").html(payLater);
    }
  }
  /*function getTipPopup() {
    $.ajax({
      url:'{{ url("getTipStaff") }}',
      type:'POST',
      dataType:'JSON',
      success:function(res) {
        // body...
      }
    });
  }*/
  $("#quicksaleForm").validate({
    errorElement: "em",
    errorPlacement: function ( error, element ) {
          // Add the `help-block` class to the error element
          error.addClass( "help-block" );

          // Add `has-feedback` class to the parent div.form-group
          // in order to add icons to inputs
          element.parents( ".col-sm-5" ).addClass( "has-feedback" );

          if ( element.prop( "type" ) === "checkbox" ) {
            error.insertAfter( element.parent( "label" ) );
          } else {
            error.insertAfter( element );
          }

          // Add the span element, if doesn't exists, and apply the icon classes to it.
          if ( !element.next( "span" )[ 0 ] ) {
            $( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
          }
        },
        success: function ( label, element ) {
          // Add the span element, if doesn't exists, and apply the icon classes to it.
          if ( !$( element ).next( "span" )[ 0 ] ) {
            $( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
          }
        },
        highlight: function ( element, errorClass, validClass ) {
          $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
          $( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
        },
        unhighlight: function ( element, errorClass, validClass ) {
          $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
          $( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
        }
      });

  /*$('.must_required').each(function() {
      alert("hii");
      $(this).rules('add', {
          required: true,
          messages: {
              required: 'this is a must requried field'
          }
      });
    });*/
  /*$("#quicksaleForm").validate({
    ignore: [],
    rules:{
      "services[]":{
        required : true
      },
    },
    messages: {
      "services[]": "Please select service",
    }
  });*/
</script>
<script type="text/javascript">
  function getUnpaidAmount(invoice_id) {
    $.ajax({
      url:'getUnpaidAmount',
      data:{'invoice_id':invoice_id},
      type:'POST',
      dataType:'JSON',
      success:function(res) {
        $("#viewUnpaidModel").modal('show');
        $("#unpaidTbody").html(res.html);
      }
    });
  }
  let total_flag=true;
  function calculatecash() {
    var sum = 0;
    var subtotal = 0;
    var totalsgst = 0;
    var totalcgst = 0;
    $('.countTotal').each(function() {
      subtotal += parseFloat(this.value);
      $("#subtotal").html(parseFloat(subtotal).toFixed(2));
      $("#subtotalamount").val(parseFloat(subtotal).toFixed(2));
    })
    $('.totalprice').each(function(){
          sum += parseFloat(this.value);  // Or this.innerHTML, this.innerText
          $("#cashpay").html(parseFloat(sum).toFixed(2));
          $("#grandtotal").html(parseFloat(sum).toFixed(2));
          $("#totalgrandTotal").val(parseFloat(sum).toFixed(2));
        });
    $('.sgstCount').each(function(){
          totalsgst += parseFloat(this.value);  // Or this.innerHTML, this.innerText
          $("#totalsgstval").html(parseFloat(totalsgst).toFixed(2));
          $("#totalinputSgst").val(parseFloat(totalsgst).toFixed(2));
        });
    $('.cgstCount').each(function(){
          totalcgst += parseFloat(this.value);  // Or this.innerHTML, this.innerText
          $("#totalcgstval").html(parseFloat(totalcgst).toFixed(2));
          $("#totalinputCgst").val(parseFloat(totalcgst).toFixed(2));
        });

    $("#totalTax").html(parseFloat(totalsgst+totalcgst).toFixed(2));
    $("#totaltaxinput").val(parseFloat(totalsgst+totalcgst).toFixed(2));
    $("#finalTax").html(parseFloat(totalsgst+totalcgst).toFixed(2));
    // let allow_points_ischecked=$("#allow_gift_points").is(':checked');
    // if(!allow_points_ischecked){
      if(total_flag){
        getpointbytotal(sum);
      }
    // }
      /*var sgst = parseFloat(9);
      var cgst = parseFloat(9);
      var totalgst = sgst + cgst;
      totalgst = parseFloat(totalgst).toFixed(2);
      // alert(totalgst)
      var gstamount = sum - (sum * (100/(100+totalgst)));
      gstamount = parseFloat(gstamount).toFixed(2);
      var originalAmount = sum - gstamount;
      alert(originalAmount);*/
    }
    function discByPercent(disc) {
      if(disc==''){disc=0;}
      $("#discountByValue").val(0);
      var service_row = $(".servicerow").length;
      var product_row = $(".productRow").length;
      var package_row = $(".packageRow").length;
      if (service_row != "") {
        for (var i = 0; i < service_row; i++) {
          var count = i;
          var sgst = parseFloat(9);
          var cgst = parseFloat(9);
          var price = $("#servicePrice"+count).val();
          var qty = $("#serviceQty"+count).val();
          var total = parseFloat(price) * parseFloat(qty);
          // var totaldiscountbyvalue = (parseFloat(disc) * 100)/ parseFloat(total);
          var totaldiscount = (parseFloat(total).toFixed(2) * parseFloat(disc).toFixed(2))/100;
          total = parseFloat(total) - parseFloat(totaldiscount);
          $("#servicePriceTotal"+count).val(parseFloat(total).toFixed(2));
          var totalsgst = (parseFloat(total) * parseFloat(sgst))/100;
          var totalcgst = (parseFloat(total) * parseFloat(cgst))/100;
          total = parseFloat(total) + parseFloat(totalsgst) + parseFloat(totalcgst);
          $("#serviceTotal"+count).val(parseFloat(total).toFixed(2));
          $("#serviceDisc"+count).val(disc);
          $("#servicesSgst"+count).val(parseFloat(totalsgst).toFixed(2));
          $("#servicesCgst"+count).val(parseFloat(totalcgst).toFixed(2));
        }
      }
      if (product_row != "") {
        for (var i = 0; i < product_row; i++) {
          var count = i;
          var sgst = parseFloat(9);
          var cgst = parseFloat(9);
          var price = $("#productPrice"+count).val();
          var qty = $("#productQty"+count).val();
          total = parseFloat(price) * parseFloat(qty);
          var totaldiscount = (parseFloat(total).toFixed(2) * parseFloat(disc).toFixed(2))/100;
          total = parseFloat(total) - parseFloat(totaldiscount);
          $("#productPriceTotal"+count).val(parseFloat(total).toFixed(2));
          var totalsgst = (parseFloat(total) * parseFloat(sgst))/100;
          var totalcgst = (parseFloat(total) * parseFloat(cgst))/100;
          total = parseFloat(total) + parseFloat(totalsgst) + parseFloat(totalcgst);
          $("#productTotal"+count).val(parseFloat(total).toFixed(2));
          $("#productDisc"+count).val(disc);
          $("#productSgst"+count).val(parseFloat(totalsgst).toFixed(2));
          $("#productCgst"+count).val(parseFloat(totalcgst).toFixed(2));
        }
      }
      calculatecash();
    }
    function discByValue(disc) {
      if(disc==''){disc=0;}

      $("#discountByPercent").val(0);
      var service_row = $(".servicerow").length;
      var product_row = $(".productRow").length;
      var package_row = $(".packageRow").length;
      if (service_row != "") {
        for (var i = 0; i < service_row; i++) {
          var count = i;
          var sgst = parseFloat(9);
          var cgst = parseFloat(9);
          var price = $("#servicePrice"+count).val();
          var qty = $("#serviceQty"+count).val();
          var total = parseFloat(price) * parseFloat(qty);
          // alert(total)
          var totaldiscountbyvalue = (parseFloat(disc) * 100)/ parseFloat(total);
          var totaldiscount = (parseFloat(total) * parseFloat(totaldiscountbyvalue))/100;
          total = parseFloat(total) - parseFloat(totaldiscount);
          $("#servicePriceTotal"+count).val(parseFloat(total).toFixed(2));
          var totalsgst = (parseFloat(total) * parseFloat(sgst))/100;
          var totalcgst = (parseFloat(total) * parseFloat(cgst))/100;
          total = parseFloat(total) + parseFloat(totalsgst) + parseFloat(totalcgst);
          $("#serviceTotal"+count).val(parseFloat(total).toFixed(2));
          $("#serviceDisc"+count).val(totaldiscountbyvalue);
          $("#servicesSgst"+count).val(parseFloat(totalsgst).toFixed(2));
          $("#servicesCgst"+count).val(parseFloat(totalcgst).toFixed(2));
        }
      }
      if (product_row != "") {
        for (var i = 0; i < product_row; i++) {
          var count = i;
          var sgst = parseFloat(9);
          var cgst = parseFloat(9);
          var price = $("#productPrice"+count).val();
          var qty = $("#productQty"+count).val();
          var total = parseFloat(price) * parseFloat(qty);
          var totaldiscountbyvalue = (parseFloat(disc) * 100)/ parseFloat(total);
          var totaldiscount = (parseFloat(total) * parseFloat(totaldiscountbyvalue))/100;
          var total = parseFloat(total) - parseFloat(totaldiscount);
          $("#productPriceTotal"+count).val(parseFloat(total).toFixed(2));
          var totalsgst = (parseFloat(total) * parseFloat(sgst))/100;
          var totalcgst = (parseFloat(total) * parseFloat(cgst))/100;
          total = parseFloat(total) + parseFloat(totalsgst) + parseFloat(totalcgst);
          $("#productTotal"+count).val(parseFloat(total).toFixed(2));
          $("#productDisc"+count).val(totaldiscountbyvalue);
          $("#productSgst"+count).val(parseFloat(totalsgst).toFixed(2));
          $("#productCgst"+count).val(parseFloat(totalcgst).toFixed(2));
        }
      }
      calculatecash();
    }

    function addServiceRow(argument) {
      /*var options = '<?php if (!empty($service_group)) {foreach ($service_group as $group) {?><optgroup label="<?php echo $group->group_name ?>"><?php $services = DB::table('services')->where('group_id', $group->id)->get();if (!empty($services)) {foreach ($services as $service) {?><option value="{{ $service->id }}">{{ $service->name }}</option><?php }}?><?php }}?>';*/
      var groupoptions = '<?php if (!empty($service_group)) {foreach ($service_group as $group) {?><option value="<?php echo $group->id ?>"><?php echo $group->group_name ?></option><?php }}?>';
      // alert(options);<form></form>services_
      $("#serviceDiv").append('<div class="row servicerow"><div class="col-lg-2 col-md-12 col-12"><div class="form-group"><label>Service Categories</label><select title="Select" required name="servicegroups_'+$(".servicerow").length+'" id="servicegroups_'+$(".servicerow").length+'" class="form-control " onchange="getServices(this.value,'+$(".servicerow").length+')" data-live-search="true"><option value="">Select</option>'+groupoptions+'</select></div>  </div><div class="col-lg-2 col-md-12 col-12"><div class="form-group"><label>Service</label><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-heart-o"></i></span></div><input class="form-control" name="serviceName'+$(".servicerow").length+'" id="serviceName'+$(".servicerow").length+'" required ></div></div></div><div class="col-lg-2 col-md-12 col-12"><div class="form-group"><label>Staff</label><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-heart-o"></i></span></div><select class="form-control" name="serviceStaff'+$(".servicerow").length+'" ><?php if (!empty($staffs)): ?><option value="0">Select Staff</option><?php foreach ($staffs as $staff): ?><option value="{{ $staff->id }}">{{ $staff->name }}</option><?php endforeach?><?php endif?></select></div></div></div><div class="col-lg-6 col-md-12 col-12"><div class="row"><div class="col-lg-2 col-md-6 col-12"><div class="form-group"><label>Qty.</label><input name="serviceQuantity[]" type="text" class="form-control appendfocus" placeholder="" value="1" id="serviceQty'+$(".servicerow").length+'" onkeyup="calcutateDiscount('+$(".servicerow").length+')"></div></div>   <div class="col-lg-2 col-md-6 col-12"><div class="form-group"><label>Price <i class="fa fa-inr"></i></label><input name="services_'+$(".servicerow").length+'"  type="hidden" id="services_'+$(".servicerow").length+'"/><input name="brand_'+$(".servicerow").length+'"  type="hidden" id="brand_'+$(".servicerow").length+'"/><input name="servicesSgst[]" type="hidden" id="servicesSgst'+$(".servicerow").length+'" class="sgstCount"><input name="servicesCgst[]" type="hidden" id="servicesCgst'+$(".servicerow").length+'" class="cgstCount"><input name="servicePriceTotal[]" type="hidden" id="servicePriceTotal'+$(".servicerow").length+'" class="countTotal"><input name="servicePriceActualRate[]" type="hidden" id="servicePriceActualRate'+$(".servicerow").length+'" class=""><input name="servicePrice[]" type="text" class="form-control" placeholder="" id="servicePrice'+$(".servicerow").length+'"></div></div>  <div class="col-lg-2 col-md-6 col-12"><div class="form-group"><label>Disc. (%)</label><input name="serviceDisc[]" id="serviceDisc'+$(".servicerow").length+'" type="text" class="form-control" placeholder="" value="0" onkeyup="calcutateDiscount('+$(".servicerow").length+')"></div></div><div class="col-lg-2 col-md-6 col-12"><div class="form-group"><label>Add. (%)</label><input name="serviceAdd[]" id="serviceAdd'+$(".servicerow").length+'" type="text" class="form-control" placeholder="" value="0" onkeyup="addDiscount('+$(".servicerow").length+')"></div></div><div class="col-lg-2 col-md-6 col-12"><div class="form-group"><label>Total <i class="fa fa-inr"></i></label><input name="serviceTotal[]" type="text" class="form-control totalprice" placeholder="" id="serviceTotal'+$(".servicerow").length+'"></div></div><div class="col-lg-1 col-md-6 col-12"><div class="form-group"><label style="display: block; visibility: hidden;">Totalsss</label><a href="javascript:void(0)" onclick="deleteServiceRow()"><i class="fa fa-trash-o mt-2"></i></a></div></div></div></div></div><div class="modal" id="selectMainService_'+$(".servicerow").length+'"><div class="modal-dialog modal-lg" id="servicegroupform" ><div class="modal-content"><div class="modal-header"><h4 class="modal-title">Add Group</h4><button type="button" class="close" data-dismiss="modal">&times;</button></div><input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>"><input value="" type="hidden" name="groupidfirm_'+($(".servicerow").length+1)+'" id="groupidfirm_'+($(".servicerow").length+1)+'"><!-- Modal body --><div class="modal-body formvisit"><div class="text-center" id="spinner_service" ><div class="spinner-border" style="width: 4rem; height: 4rem;" role="status"><span class="sr-only">Loading...</span> </div></div><div class="row"><!--./col-lg-4--><div class="col-lg-12 col-md-12 col-12" id="mainserviceDiv_'+($(".servicerow").length+1)+'"></div><div class="col-lg-12 col-md-12 col-12" id="groupserviceDiv_'+($(".servicerow").length+1)+'"></div><div class="col-lg-12 col-md-12 col-12" id="serviceBrandDiv_'+($(".servicerow").length+1)+'"></div></div><!--./row--></div><div class="modal-footer"><button type="button" class="outline-btn" data-dismiss="modal">Cancel</button><button type="button" onclick="showServiceBrandsPrice()" class="theme-btn">Save</button></div></div></div></div>');
      /*$("#serviceDiv").append('<div class="row servicerow"><div class="col-lg-3 col-md-12 col-12"><div class="form-group"><label>Services</label><select title="Select" required name="services_'+$(".servicerow").length+'" class="form-control selectpicker" onchange="getServicePrice(this.value,'+$(".servicerow").length+')" data-live-search="true">'+groupoptions+'</select></div>  </div><div class="col-lg-3 col-md-12 col-12"><div class="form-group"><label>Staff</label><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-heart-o"></i></span></div><select class="form-control" name="serviceStaff'+$(".servicerow").length+'" required><option value="">Select</option><?php // if (!empty($staffs)): ?><?php // foreach ($staffs as $staff): ?><option value="{{ $staff->id }}">{{ $staff->name }}</option><?php // endforeach ?><?php // endif ?></select></div></div></div><div class="col-lg-6 col-md-12 col-12"><div class="row"><div class="col-lg-2 col-md-6 col-12"><div class="form-group"><label>Qty.</label><input name="serviceQuantity[]" type="text" class="form-control appendfocus" placeholder="" value="1" id="serviceQty'+$(".servicerow").length+'" onkeyup="calcutateDiscount('+$(".servicerow").length+')"></div></div>   <div class="col-lg-3 col-md-6 col-12"><div class="form-group"><label>Price <i class="fa fa-inr"></i></label><input name="servicesSgst[]" type="hidden" id="servicesSgst'+$(".servicerow").length+'" class="sgstCount"><input name="servicesCgst[]" type="hidden" id="servicesCgst'+$(".servicerow").length+'" class="cgstCount"><input name="servicePriceTotal[]" type="hidden" id="servicePriceTotal'+$(".servicerow").length+'" class="countTotal"><input name="servicePrice[]" type="text" class="form-control" placeholder="" id="servicePrice'+$(".servicerow").length+'"></div></div>  <div class="col-lg-2 col-md-6 col-12"><div class="form-group"><label>Disc. (%)</label><input name="serviceDisc[]" id="serviceDisc'+$(".servicerow").length+'" type="text" class="form-control" placeholder="" value="0" onkeyup="calcutateDiscount('+$(".servicerow").length+')"></div></div><div class="col-lg-3 col-md-6 col-12"><div class="form-group"><label>Total <i class="fa fa-inr"></i></label><input name="serviceTotal[]" type="text" class="form-control totalprice" placeholder="" id="serviceTotal'+$(".servicerow").length+'"></div></div><div class="col-lg-1 col-md-6 col-12"><div class="form-group"><label style="display: block; visibility: hidden;">Total</label><a href="javascript:void(0)" onclick="deleteServiceRow()"><i class="fa fa-trash-o mt-2"></i></div></div></div></div></div>');*/
      if ($(".servicerow").length == 1) {
        $(".serviceDivider").show();
      }
      $("#serviceRowCount").val($(".servicerow").length);
      $('#serviceDiv').children().last().find('.appendfocus').focus();
      $('.selectpicker').selectpicker();
    }

    /*function getServices(groupid,count) {
      if (groupid != "") {
        $.ajax({
          url:" {{ url('getServiceByGroup') }} ",
          data:{'groupid':groupid},
          type:'POST',
          // dataType:'JSON',
          success:function(res) {
            // alert(res);
            $("#services_"+count).html(res);
            $('#services_'+count).selectpicker('refresh');
          }
        });
        // calculatecash();
      }
    }*/
    function showServiceBrandsPrice() {
      $('#spinner_service').show();
      console.log('--------showServiceBrandsPrice------------');
      var totalcount = $(".servicerow").length-1;
      var totalcountss = $(".servicerow").length-1;
      var totalcountnew = $(".servicerow").length;
      //  alert(totalcount);
      var brand_id = $("#groupServiess_"+totalcountnew).val();

      var array = JSON.parse("[" + brand_id + "]");
      // $('#serviceDiv').html('');
      $.each(array, function (i) {
// alert(i);
      // i=j-totalcount;
      // alert(i);
     if(array[i] != ""){
        $.ajax({
          url:"{{ url('showServiceBrandsPrice') }}",
          type:'POST',
          data:{'brand_id':array[i]},
          dataType:'JSON',
          success:function(res) {
            console.log('--------response ---------------showServiceBrandsPrice------------');
            console.log(res);

             //alert("#servicePrice"+totalcount);service_id
            //  alert(res.service_id);
             $("#brand_"+totalcount).val(array[i]);

            $("#servicePrice"+totalcount).val(res.service_price);
            $("#servicePriceActualRate"+totalcount).val(res.service_price);
            $("#serviceName"+totalcount).val(res.brand_name);
            $("#services_"+totalcount).val(res.brand_id);
            addServiceRow(totalcount);
            $("#servicegroups_"+totalcount).val(res.service_id);
            $("#servicegroups_"+totalcount).find('option[value="'+res.service_id+'"]').attr('selected', true);
            calcutateDiscount(totalcount);
            totalcount++;
          }
        });
      }


    });

    // deleteServiceRow();
    setTimeout(function() {
    $("#selectMainService_"+totalcountss).modal('hide');
      deleteServiceRow();
      deleteServiceRow();
       }, 1000);
    }

    function showServiceBrands(service_id) {
      var totalcount = $(".servicerow").length;
      var count = $(".servicerow").length-1;
      if(service_id != ""){
        $.ajax({
          url:"{{ url('showServiceBrands') }}",
          type:'POST',
          data:{'service_id':service_id,'totalcount':totalcount},
          dataType:'JSON',
          success:function(res) {
            // alert(res.html)
            $("#serviceBrandDiv_"+totalcount).html(res.html);
            $("#services_"+count).val(service_id);
          }
        });
      }
    }

    function showGroupService(group_id,parentId) {
      // alert(parentId);
      var totalcount = $(".servicerow").length;
      if(group_id != ""){
        $.ajax({
          url:"{{ url('showGroupService') }}",
          type:'POST',
          data:{'groupid':group_id,'totalcount':totalcount,'parentId':parentId},
          dataType:'JSON',
          success:function(res) {
            // alert(res.html)
            $("#groupserviceDiv_"+totalcount).html(res.html);
          }
        });
      }
    }

    function showFirmService(groupid) {
      // alert(count)
      if (groupid != "") {
        var totalcount = $(".servicerow").length;
       //var groupid = $("#groupidfirm_"+totalcount).val();
        // alert(groupid)
        $.ajax({
          url:"{{ url('showFirmService') }}",
          type:'POST',
          data:{'groupid':groupid,'totalcount':totalcount},
          dataType:'JSON',
          success:function(res) {
            // alert(res.html)
            $("#mainserviceDiv_"+totalcount).html(res.html);
          }
        });
      }
    }

    function getServices(groupid,count) {
      if (groupid != "") {
        $.ajax({
          url:" {{ url('getServiceByGroup') }} ",
          data:{'groupid':groupid},
          type:'POST',
          // dataType:'JSON',
          success:function(res) {
            $('#spinner_service').hide();
            // alert(res);
            /*$("#services_"+count).html(res);
            $('#services_'+count).selectpicker('refresh'); */
            $("#selectMainService_"+count).modal({
                backdrop: 'static'
            });
            $("#groupidfirm_"+(++count)).val(groupid);
            showFirmService(groupid);
          }
        });
        // calculatecash();
      }
    }
    function addDiscount(count) {
      var sgst = parseFloat(0);
      var cgst = parseFloat(0);
      var disc = $("#serviceAdd"+count).val();
      if(disc==''){disc=0;}
      var price = $("#servicePriceActualRate"+count).val();
      if(price==''){price=0;}
      var qty = $("#serviceQty"+count).val();
      if(qty==''){qty=0;}
      var total = parseFloat(price) * parseFloat(qty);
      var totaldiscount = (parseFloat(total).toFixed(2) * parseFloat(disc).toFixed(2))/100;
      total = parseFloat(total) + parseFloat(disc);
      // total = parseFloat(total) + parseFloat(totaldiscount);
      $("#servicePriceTotal"+count).val(parseFloat(total).toFixed(2));
      var totalsgst = (parseFloat(total) * parseFloat(sgst))/100;
      var totalcgst = (parseFloat(total) * parseFloat(cgst))/100;
      total = parseFloat(total) + parseFloat(totalsgst) + parseFloat(totalcgst);
      $("#serviceTotal"+count).val(parseFloat(total).toFixed(2));
      $("#servicePrice"+count).val(parseFloat(total).toFixed(2));
      /*$("#totalsgstval").html(parseFloat(totalsgst));
      $("#totalcgstval").html(parseFloat(totalcgst));*/
      $("#servicesSgst"+count).val(parseFloat(totalsgst).toFixed(2));
      $("#servicesCgst"+count).val(parseFloat(totalcgst).toFixed(2));
      calculatecash();
    }

    function calcutateDiscount(count) {
      var sgst = parseFloat(0);
      var cgst = parseFloat(0);
      var disc = $("#serviceDisc"+count).val();
      if(disc==''){disc=0;}
      var price = $("#servicePrice"+count).val();
      if(price==''){price=0;}
      var qty = $("#serviceQty"+count).val();
      if(qty==''){qty=0;}
      var total = parseFloat(price) * parseFloat(qty);
      var totaldiscount = (parseFloat(total).toFixed(2) * parseFloat(disc).toFixed(2))/100;
      total = parseFloat(total) - parseFloat(totaldiscount);
      $("#servicePriceTotal"+count).val(parseFloat(total).toFixed(2));
      var totalsgst = (parseFloat(total) * parseFloat(sgst))/100;
      var totalcgst = (parseFloat(total) * parseFloat(cgst))/100;
      total = parseFloat(total) + parseFloat(totalsgst) + parseFloat(totalcgst);
      $("#serviceTotal"+count).val(parseFloat(total).toFixed(2));
      /*$("#totalsgstval").html(parseFloat(totalsgst));
      $("#totalcgstval").html(parseFloat(totalcgst));*/
      $("#servicesSgst"+count).val(parseFloat(totalsgst).toFixed(2));
      $("#servicesCgst"+count).val(parseFloat(totalcgst).toFixed(2));
      calculatecash();
    }

    function getServicePrice(serviceid,count) {
      if (serviceid != "") {
        $.ajax({
          url:" {{ url('getServicePrice') }} ",
          data:{'service_id':serviceid},
          type:'POST',
          dataType:'JSON',
          success:function(res) {
            // alert(res.result.service_price)
            $("#servicePrice"+count).val(res.result.service_price);
            // $("#servicePriceActualRate"+count).val(res.result.service_price);
            var sgst = parseFloat(9);
            var cgst = parseFloat(9);
            var disc = $("#serviceDisc"+count).val();
            var qty = $("#serviceQty"+count).val();
            var total = parseInt(res.result.service_price)*parseInt(qty);
            var totaldiscount = (parseFloat(total).toFixed(2) * parseFloat(disc).toFixed(2))/100;
            var total = parseFloat(total) - parseFloat(totaldiscount);
            $("#servicePriceTotal"+count).val(parseFloat(total).toFixed(2));
            var totalsgst = (parseFloat(total) * parseFloat(sgst))/100;
            var totalcgst = (parseFloat(total) * parseFloat(cgst))/100;
            total = parseFloat(total) + parseFloat(totalsgst) + parseFloat(totalcgst);
            $("#serviceTotal"+count).val(parseFloat(total).toFixed(2));
            /*$("#totalsgstval").html(parseFloat(totalsgst));
            $("#totalcgstval").html(parseFloat(totalcgst));*/
            $("#servicesSgst"+count).val(parseFloat(totalsgst).toFixed(2));
            $("#servicesCgst"+count).val(parseFloat(totalcgst).toFixed(2));
            calculatecash();
          }
        });
        // calculatecash();
      }
    }

    function addProductRow() {
      $("#productDiv").append('<div class="row productRow"><div class="col-lg-3 col-md-12 col-12"><div class="form-group"><label>Product</label><select required name="products_'+$(".productRow").length+'" class="form-control" onchange="getProductPrice(this.value,'+$(".productRow").length+')"><option value="">Select</option><?php if (!empty($products)): ?><?php foreach ($products as $product): ?><option value="{{ $product->id }}">{{ $product->product_name }}</option><?php endforeach?><?php endif?></select></div>  </div><div class="col-lg-3 col-md-12 col-12"><div class="form-group"><label>Staff</label><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-heart-o"></i></span></div><select required name="productStaff'+$(".productRow").length+'" class="form-control"><option value="">Select</option><?php if (!empty($staffs)): ?><?php foreach ($staffs as $staff): ?><option value="{{ $staff->id }}">{{ $staff->name }}</option><?php endforeach?><?php endif?></select></div></div></div><div class="col-lg-6 col-md-12 col-12"><div class="row"><div class="col-lg-2 col-md-6 col-12"><div class="form-group"><label>Qty.</label><input name="productQty[]" type="text" class="form-control appendfocus" placeholder="" value="1" id="productQty'+$(".productRow").length+'" onkeyup="calcutateProductDiscount('+$(".productRow").length+')"></div></div>   <div class="col-lg-3 col-md-6 col-12"><div class="form-group"><label>Price <i class="fa fa-inr"></i></label><input name="productSgst[]" type="hidden" id="productSgst'+$(".productRow").length+'" class="sgstCount"><input name="productCgst[]" type="hidden" id="productCgst'+$(".productRow").length+'" class="cgstCount"><input name="productPriceTotal[]" type="hidden" id="productPriceTotal'+$(".productRow").length+'" class="countTotal"><input name="productPrice[]" type="text" class="form-control" placeholder="" id="productPrice'+$(".productRow").length+'"></div></div>  <div class="col-lg-2 col-md-6 col-12"><div class="form-group"><label>Disc. (%)</label><input name="productDisc[]" type="text" class="form-control" placeholder="" id="productDisc'+$(".productRow").length+'" value="0" onkeyup="calcutateProductDiscount('+$(".productRow").length+')"></div></div><div class="col-lg-3 col-md-6 col-12"><div class="form-group"><label>Total <i class="fa fa-inr"></i></label><input name="productTotal[]" type="text" class="form-control totalprice" placeholder="" id="productTotal'+$(".productRow").length+'"></div></div><div class="col-lg-1 col-md-6 col-12"><div class="form-group"><label style="display: block; visibility: hidden;">Total</label><a href="javascript:void(0)" onclick="deleteProductRow()"><i class="fa fa-trash-o mt-2"></i></div></div></div></div></div>');
      if ($(".productRow").length == 1) {
        $(".productDivider").show();
      }
      $("#productRowCount").val($(".productRow").length);
      $('#productDiv').children().last().find('.appendfocus').focus();
    }

    function calcutateProductDiscount(count) {
      var sgst = parseFloat(9);
      var cgst = parseFloat(9);
      var disc = $("#productDisc"+count).val();
      var price = $("#productPrice"+count).val();
      var qty = $("#productQty"+count).val();
      var total = parseFloat(price) * parseFloat(qty);
      var totaldiscount = (parseFloat(total).toFixed(2) * parseFloat(disc).toFixed(2))/100;
      total = parseFloat(total) - parseFloat(totaldiscount);
      $("#productPriceTotal"+count).val(parseFloat(total).toFixed(2));
      var totalsgst = (parseFloat(total) * parseFloat(sgst))/100;
      var totalcgst = (parseFloat(total) * parseFloat(cgst))/100;
      total = parseFloat(total) + parseFloat(totalsgst) + parseFloat(totalcgst);
      $("#productTotal"+count).val(parseFloat(total).toFixed(2));
      $("#productSgst"+count).val(parseFloat(totalsgst).toFixed(2));
      $("#productCgst"+count).val(parseFloat(totalcgst).toFixed(2));
      calculatecash();
    }

    function getProductPrice(productid,count) {
      if(productid != ""){
        $.ajax({
          url:"{{ url('getProductPrice') }}",
          data:{'product_id':productid},
          type:"POST",
          dataType:'JSON',
          success:function(res) {
            $("#productPrice"+count).val(res.result.product_price);
            var sgst = parseFloat(9);
            var cgst = parseFloat(9);
            var qty = $("#productQty"+count).val();
            var disc = $("#productDisc"+count).val();
            var total = parseInt(res.result.product_price)*parseInt(qty);
            var totaldiscount = (parseInt(total).toFixed(2) * parseInt(disc).toFixed(2))/100;
            total = parseInt(total) - parseInt(totaldiscount);
            $("#productPriceTotal"+count).val(parseFloat(total).toFixed(2));
            var totalsgst = (parseFloat(total) * parseFloat(sgst))/100;
            var totalcgst = (parseFloat(total) * parseFloat(cgst))/100;
            total = parseFloat(total) + parseFloat(totalsgst) + parseFloat(totalcgst);
            $("#productTotal"+count).val(parseFloat(total).toFixed(2));
            $("#productSgst"+count).val(parseFloat(totalsgst).toFixed(2));
            $("#productCgst"+count).val(parseFloat(totalcgst).toFixed(2));
            calculatecash();
          }
        });
        // calculatecash();
      }
    }
    var dynamic_rowcount = 0;
    function addPackageRow() {
      $("#packageDiv").append('<div class="row packageRow"><div class="col-lg-3 col-md-12 col-12"><div class="form-group"><label>Package</label><select required name="package_'+ dynamic_rowcount +'" class="form-control" onchange="showServices(this.value,'+ dynamic_rowcount +')"><option value="">Select</option><?php if (!empty($packages)): ?><?php foreach ($packages as $package): ?><option value="{{ $package->package_id }}">{{ $package->package_title }}</option><?php endforeach?><?php endif?></select></div>  </div> <div class="col-lg-3 col-md-6 col-12"><div class="form-group"><label>Price <i class="fa fa-inr"></i></label><input name="pacakgePrice[]" type="text" class="form-control appendfocus" placeholder="" id="pacakgePrice'+ dynamic_rowcount +'"></div></div>  <div class="col-lg-2 col-md-6 col-12"><div class="form-group"><label>Disc. (%)</label><input name="packageSgst[]" type="hidden" id="packageSgst'+ dynamic_rowcount +'" class="sgstCount"><input name="packageCgst[]" type="hidden" id="packageCgst'+ dynamic_rowcount +'" class="cgstCount"><input name="packagePriceTotal[]" type="hidden" id="packagePriceTotal'+ dynamic_rowcount +'" class="countTotal"><input name="packageDisc[]" type="text" class="form-control" placeholder="" id="packageDisc'+ dynamic_rowcount +'"></div></div><div class="col-lg-3 col-md-6 col-12"><div class="form-group"><label>Total <i class="fa fa-inr"></i></label><input name="packageTotal[]" type="text" class="form-control totalprice" placeholder="" id="packageTotal'+ dynamic_rowcount +'"></div></div><div class="col-lg-1 col-md-6 col-12"><div class="form-group"><label style="display: block; visibility: hidden;">Total</label><a href="javascript:void(0)" onclick="deletePackageRow(this)"><i class="fa fa-trash-o mt-2"></i></div></div></div></div></div><div class="row dynamic_ddlrow" id="packageServiceRow'+ dynamic_rowcount +'"></div>');
      // $("#packageDiv").append('<div class="row packageRow"><div class="col-lg-3 col-md-12 col-12"><div class="form-group"><label>Package</label><select required name="package_'+$(".packageRow").length+'" class="form-control" onchange="showServices(this.value,'+$(".packageRow").length+')"><option value="">Select</option><?php if (!empty($packages)): ?><?php foreach ($packages as $package): ?><option value="{{ $package->package_id }}">{{ $package->package_title }}</option><?php endforeach?><?php endif?></select></div>  </div> <div class="col-lg-3 col-md-6 col-12"><div class="form-group"><label>Price <i class="fa fa-inr"></i></label><input name="pacakgePrice[]" type="text" class="form-control" placeholder="" id="pacakgePrice'+$(".packageRow").length+'"></div></div>  <div class="col-lg-2 col-md-6 col-12"><div class="form-group"><label>Disc. (%)</label><input name="packageSgst[]" type="hidden" id="packageSgst'+$(".packageRow").length+'" class="sgstCount"><input name="packageCgst[]" type="hidden" id="packageCgst'+$(".packageRow").length+'" class="cgstCount"><input name="packagePriceTotal[]" type="hidden" id="packagePriceTotal'+$(".packageRow").length+'" class="countTotal"><input name="packageDisc[]" type="text" class="form-control" placeholder="" id="packageDisc'+$(".packageRow").length+'"></div></div><div class="col-lg-3 col-md-6 col-12"><div class="form-group"><label>Total <i class="fa fa-inr"></i></label><input name="packageTotal[]" type="text" class="form-control totalprice" placeholder="" id="packageTotal'+$(".packageRow").length+'"></div></div><div class="col-lg-1 col-md-6 col-12"><div class="form-group"><label style="display: block; visibility: hidden;">Total</label><a href="javascript:void(0)" onclick="deletePackageRow(this)"><i class="fa fa-trash-o mt-2"></i></div></div></div></div></div><div class="row dynamic_ddlrow" id="packageServiceRow'+$(".packageRow").length+'"></div>');
      if ($(".packageRow").length == 1) {
        $(".packageDivider").show();
      }
      $("#packageRowCount").val($(".packageRow").length);
      dynamic_rowcount++;
      $('#packageDiv').children().last().prev().find('.appendfocus').focus();
    }

    function showServices(packageid,count) {
      // debugger;

      if (packageid != "") {
        $.ajax({
          url:"{{ url('viewservices') }}",
          data:{'packageid':packageid},
          type:'POST',
          dataType:'JSON',
          success: function(res) {
            // var count = $(".packageRow").length;
              // alert(count);
              if (res != "" && res != null) {
                var sgst = parseFloat(9);
                var cgst = parseFloat(9);
                var price = res.package.package_price;
                var disc = res.package.package_discount;
                var totaldiscount = parseFloat(price) * parseFloat(disc)/100;
                total = parseFloat(price) - parseFloat(totaldiscount);
                $("#packagePriceTotal"+count).val(parseFloat(total).toFixed(2));
                var totalsgst = (parseFloat(total) * parseFloat(sgst))/100;
                var totalcgst = (parseFloat(total) * parseFloat(cgst))/100;
                total = parseFloat(total) + parseFloat(totalsgst) + parseFloat(totalcgst);
                $("#pacakgePrice"+count).val(res.package.package_price);
                $("#packageDisc"+count).val(res.package.package_discount);
                $("#packageTotal"+count).val(parseFloat(total).toFixed(2));
                $("#packageServiceRow"+count).html(res.hi);
                $("#packageSgst"+count).val(parseFloat(totalsgst).toFixed(2));
                $("#packageCgst"+count).val(parseFloat(totalcgst).toFixed(2));
                calculatecash();
              }
            }
          });
        // calculatecash();
      }
    }

    function deleteProductRow() {
      $("#productDiv").children().last().remove();
      if ($(".productRow").length == 0) {
        $(".productDivider").hide();
      }
      calculatecash();
    }

    function deleteServiceRow() {
      // alert('asd');
      $("#serviceDiv").children().last().remove();
      if ($(".servicerow").length == 0) {
        $(".serviceDivider").hide();
      }
      calculatecash();
    }

    function deletePackageRow(dis) {
      // debugger;
      var chk_rowexist = $(dis).parent().parent().parent().next().attr('class');
      if(chk_rowexist == 'row dynamic_ddlrow'){
        $(dis).parent().parent().parent().next().remove();
      }
      $(dis).parent().parent().parent().remove();
      //$("#packageDiv").children().last().remove();
      if ($(".packageRow").length == 0) {
        $(".packageDivider").hide();
      }
      calculatecash();
    }

  </script>


  <script type="text/javascript">

    function addCustomer() {
      $("#addcustomer").modal('show');
      var number = $("#searchnumber").val();
      if (number != "" && number.length == 10) {
        $.ajax({
          url:'{{ url("getlastid") }}',
          type:'POST',
          dataType:'JSON',
          success:function(res) {
            if (res != "" && res != null) {
              $("#contact").val(number);
              $("#customer_ids").val(res.last_id);
              $("#referral_code").val(res.last_id);
              $("#rf_id").val(res.last_id);
            }
          }
        });

      }
    }

    $("#verifyotpModel").validate({
      rules:{
        otp_verify:{
          required:true,
          number:true,
        }
      },
      messages:{
        required:"Please enter otp",
        number:"Characters not allowed",
      },
    });

    $("#addcustomerform").validate({
      rules:{
        addmobile: {
          required : true,
          number : true,
          minlength : 10,
          maxlength : 10,
        },
        addname: "required",
        adddob: "required",
        addlocation: "required",
        addemail: {
          required: true,
          email: true
        },
      },
      messages:{
        addmobile: {
          required : "Contact number is required",
          number : "Enter valid number",
          minlength: "Contact number must consist of at least 10 digits",
          maxlength: "Contact number must consist of only 10 digits",
        },
        addname: "Please enter customer name",
        adddob: "Please enter date of birth",
        addlocation: "Please enter a valid email address",
        addemail: "Please enter location",
      },
      submitHandler: function() {
        var formdata = $("#addcustomerform").serialize();
        $.ajax({
          url:'{{ url("addaccount") }}',
          data:formdata,
          type:'POST',
          dataType:"JSON",
          success:function(res) {
            if (res != "") {
              $("#addcustomer").modal('hide');
              $("#saveotpModelsssssss").modal('show');
              $("#customerid").val(res);
            }
            /*if(res != "" && res != null){
              if(res.dob != null){
                var dateAr = res.dob.split('-');
                var newDate = dateAr[1] + '/' + dateAr[2] + '/' + dateAr[0];
              }else{
                var newDate = "";
              }
              if(res.anniversary_date != null){
                var date = res.anniversary_date.split('-');
                var newanniversary_date = date[1] + '/' + date[2] + '/' + date[0];
              }else{
                var newanniversary_date = "";
              }
              $("#customericon").show();
              $("#customername").show();
              $("#customer_id").val(res.id);
              $("#customername").val(res.name);
              $("#editmobile").val(res.contact);
              $("#editname").val(res.name);
              $("#editid").val(res.id);
              $("#editemail").val(res.email);
              $("#editdob").val(newDate);
              $("#editanniversary").val(newanniversary_date);
              $("#editlocation").val(res.location);
              $("#customerupdateicon").show();
              $("#customeraddicon").hide();
              $("#addcustomer").modal('hide');
            }else{
              $("#customeraddicon").show();
              $("#customericon").hide();
              $("#customername").hide();
              $("#customerupdateicon").hide();
            }*/
          }
        });
      },
    });

    // validate signup form on keyup and submit
    $("#editform").validate({
      rules: {
        editmobile: {
          required : true,
          number : true,
          minlength : 10,
          maxlength : 10,
        },
        editname: "required",
        editdob: "required",
        editlocation: "required",
        editemail: {
          required: true,
          email: true
        },
      },
      messages: {
        editmobile: {
          required : "Contact number is required",
          number : "Enter valid number",
          minlength: "Contact number must consist of at least 10 digits",
          maxlength: "Contact number must consist of only 10 digits",
        },
        editname: "Please enter customer name",
        editdob: "Please enter date of birth",
        editemail: "Please enter a valid email address",
        editlocation: "Please enter location",
      },
      submitHandler: function() {
        var formdata = $("#editform").serialize();
        $.ajax({
          url:'{{ url("updateaccount") }}',
          data:formdata,
          type:'POST',
          dataType:"JSON",
          success:function(res) {
            if(res != "" && res != null){
              $("#editcustomer").modal('hide');
              $("#customername").val(res.name);
              $("#customerid").val(res.id);
            }else{
              alert("Failed");
            }
          }
        });
      }
    });
    function checkaccount(number) {
      if (number != "" && number.length == 10) {
        $.ajax({
          url:'{{ url("checkaccount") }}',
          data:{'number':number},
          type:'POST',
          dataType:"JSON",
          success:function(res) {
            console.log(res);
            if(res != "" && res != null){
              if(res.dob != null){
                var dateAr = res.dob.split('-');
                var newDate = dateAr[1] + '/' + dateAr[2] + '/' + dateAr[0];
              }else{
                var newDate = "";
              }
              if(res.anniversary_date != null){
                var date = res.anniversary_date.split('-');
                var newanniversary_date = date[1] + '/' + date[2] + '/' + date[0];
              }else{
                var newanniversary_date = "";
              }
              $("#customericon").show();
              $("#customername").show();
              $("#customername").val(res.name);
              $("#customer_id").val(res.id);
              $("#editmobile").val(res.contact);
              $("#editname").val(res.name);
              $("#editid").val(res.id);
              $("#editemail").val(res.email);
              $("#editdob").val(newDate);
              $("#editanniversary").val(newanniversary_date);
              $("#editlocation").val(res.location);
              $("#customerupdateicon").show();
              $("#visitdiv").show();
              $("#revenuediv").show();
              $("#giftpointdiv").show();
              $("#remarkdiv").show();
              $("#customerRemark").val(res.remarks);
              $("#totalgiftpointShow").html(res.sum_of_points);
              //console.log(res.sum_of_points);
              if(!(res.sum_of_points))
              {
                $("#totalgiftpointShow").html(0);
              }
              $("#totalRevenueShow").html('<i class="fa fa-inr"></i> '+res.total_revenue);
              $("#visitshowspan").html(res.total_visit);
              $("#remarkShow").html(res.remark);
              if (res.last_visit_date != '' && res.last_visit_date != '0000-00-00') {
                var last_visit_date = moment(res.last_visit_date).format('DD-MM-YYYY');
              }else{
                var last_visit_date = 'Nil';
              }
              if (res.payable_amount != 0) {
                $("#unpaidbtndiv").show();
                // $('#ButtonName').removeAttr('onclick');
                $('#unpaidbtn').attr('onClick', 'getUnpaidAmount('+res.invoice_id+');');
                $("#unpaidbtn").html('Unpaid - <i class="fa fa-inr"></i> '+res.payable_amount);
              }
              $("#visitshowdate").html(last_visit_date);
              $("#customeraddicon").hide();
            }else{
              $("#customeraddicon").show();
              $("#customericon").hide();
              $("#customername").hide();
              $("#visitdiv").hide();
              $("#revenuediv").hide();
              $("#giftpointdiv").hide();
              $("#remarkdiv").hide();
              $("#customerupdateicon").hide();
              $("#unpaidbtndiv").hide();
              $("#unpaidbtn").html('');
            }
          }
        });
      }else{
        $("#customericon").hide();
        $("#customername").hide();
        $("#customerupdateicon").hide();
        $("#customeraddicon").hide();
        $("#visitdiv").hide();
        $("#revenuediv").hide();
        $("#giftpointdiv").hide();
        $("#remarkdiv").hide();
        $("#unpaidbtndiv").hide();
        $("#unpaidbtn").html('');
      }
    }

    function skip(){
     // location.reload(true);
     $("#addcustomer").modal('hide');
     var number =  $("#contact").val();
     $("#saveotpModelsssssss").modal('hide');
     checkaccount(number);

    }

    function saveotp() {
       var otp =  $("#otp").val();
       var number =  $("#contact").val();


            $.ajax({
                url:'{{ url("checkotp") }}',
                data:{'otp':otp,'number':number},
                type:'POST',
                success:function(res) {
                if(res=='yes'){
                  location.reload(true);
                }else{
                  alert('OTP is not Correct');
                }
                }
              });
        }

    function sendotp() {
       var number =  $("#contact").val();

        if (number) {
          if ( number.length == 10  ){
            $.ajax({
                url:'{{ url("sendotp") }}',
                data:{'number':number},
                type:'POST',
                success:function(res) {
                  $("#otps").val(res);
                  $("#customerformbtn").css('display','block');
                  // $('#saveotpModelsssssss').modal('show');
                  //$("#otpbtn").css('display','none');
                }
              });
          }else{
            alert("Enter Valid Mobile number !");
          }

          }else{
            alert("Enter Mobile number to Verify !");
          }

    }

    $("#addfirmform").validate({
      rules:{
        phone: {
          required : true,
          number : true,
          minlength : 10,
          maxlength : 10,
        },
        name: "required",
        // location: "required",
        status: "required",
      },
      messages:{

        name: "Please enter Location name",

        status: "Please select status",
      },
      submitHandler: function() {
        var formdata = $("#addfirmform").serialize();
        $.ajax({
          url:'{{ route("location.store") }}',
          data:formdata,
          type:'POST',
          dataType:"JSON",
          success:function(res) {
            $('#location').val('');
            $("#addLocation").modal('hide');

            loadLocation();
            // $("#firmTableBody").html(res.html);
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
      },
  });
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
  loaddesignation();
  function loaddesignation()
  {
    $.ajax({
          url:'{{ url("load_designation") }}',
          type:'GET',
          success:function(res) {
            $("#addDesignation").modal('hide');
            $("#designation").html(res);
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

  $("#addDesignationform").validate({
      rules:{
        phone: {
          required : true,
          number : true,
          minlength : 10,
          maxlength : 10,
        },
        name: "required",
        // location: "required",
        status: "required",
      },
      messages:{

        name: "Please enter firm name",

        status: "Please select status",
      },
      submitHandler: function() {
        var formdata = $("#addDesignationform").serialize();
        $.ajax({
          url:'{{ route("designation.store") }}',
          data:formdata,
          type:'POST',
          dataType:"JSON",
          success:function(res) {
            $("#addfirm").modal('hide');
            loaddesignation();
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
      },
  });


  function saveRemark(remark)
  {
    var customer_id=$('#customer_id').val();
    $.ajax({
          url:'qs_saveRemark',
          data:{'customer_id':customer_id,
                 'remark':remark,
                 "_token": "{{ csrf_token() }}" },
          type:'POST',
          dataType:"JSON",
          success:function(res) {

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

  function checkcustomerpoints(curr_points){
    let old_points=0;
    let subtotal=0;
    let sum=0;
    let point_to_be_cut=0;
    DBcustomerPoints=$('#totalgiftpointShow').html();
    console.log(DBcustomerPoints);
    if((DBcustomerPoints!="")||(DBcustomerPoints!=0))
    {
      old_points=parseFloat(DBcustomerPoints);
      curr_points=parseFloat(curr_points);
      if(old_points>=curr_points)
      {
        total_flag=false;
        // $('#gift_points').val(curr_points);
        point_to_be_cut=$('#gift_points').val();
        console.log(point_to_be_cut);
        $('.countTotal').each(function() {
          subtotal += parseFloat(this.value);
          $("#subtotal").html(parseFloat(subtotal-point_to_be_cut).toFixed(2));
          $("#subtotalamount").val(parseFloat(subtotal-point_to_be_cut).toFixed(2));
        });
        $('.totalprice').each(function(){
          sum += parseFloat(this.value);  // Or this.innerHTML, this.innerText
          // console.log(sum);
          $("#cashpay").html(parseFloat(sum-point_to_be_cut).toFixed(2));
          $("#grandtotal").html(parseFloat(sum-point_to_be_cut).toFixed(2));
          $("#totalgrandTotal").val(parseFloat(sum-point_to_be_cut).toFixed(2));
        });
      }
      else{
        alert('Please Enter Points Under Limit');
        $('#gift_points').val(0);
      }
    }
    else{
      alert('Not allowed');
      $('#totalgiftpointShow').html(0);
      $('#gift_points').val(0);
    }
  }


  function getpointbytotal(total_amt) {
    // console.log(total_amt);
    if(!isNaN(total_amt))
    {
      let sum=0;
      let subtotal=0;
      let allow_redeem_points=0;
      let valid_points=0;
      $.ajax({
            url:'{{ url("getpointsByAmount") }}',
            data:{"_token": "{{ csrf_token() }}",'total_amt':total_amt},
            type:'POST',
            dataType:'JSON',
            success:function(res) {
              console.log(res);
              if(res != ""){
                allow_redeem_points=res.point_amt;
                console.log(allow_redeem_points);
                $('.countTotal').each(function() {
                  subtotal += parseFloat(this.value);
                  // $("#subtotal").html(parseFloat(subtotal-gift_points).toFixed(2));
                  // $("#subtotalamount").val(parseFloat(subtotal-gift_points).toFixed(2));
                });
                $('.totalprice').each(function(){
                  sum += parseFloat(this.value);  // Or this.innerHTML, this.innerText
                  valid_points=parseFloat((sum*allow_redeem_points)/100);
                  $('#redeem_point').html(valid_points);
                  // console.log(sum);
                  // $("#cashpay").html(parseFloat(sum-gift_points).toFixed(2));
                  // $("#grandtotal").html(parseFloat(sum-gift_points).toFixed(2));
                  // $("#totalgrandTotal").val(parseFloat(sum-gift_points).toFixed(2));
                });
                // $('#redeem_point').html(allow_redeem_points);
                // $('#totalredeempoint').val(allow_redeem_points);
              }else{
                $('#redeem_point').html(0);
                // $('#totalredeempoint').val(0);
              }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // document.getElementById("download_Report").style.display="none";
                alert('Something went wrong in getpoints');
                }
          });
      }
    }

    $('#allow_gift_points').click(function() {
      // let sum=0;
      // let subtotal=0;
      let gift_points = 0;
      gift_points=$('#redeem_point').html();
      console.log('----------gift ponits----');
      console.log(gift_points);
      gift_points=parseFloat(gift_points);
        if($("#allow_gift_points").is(':checked'))
        {
          $('#totalredeempoint').val(gift_points);
        }
        else
        {
          console.log('not allowed gift points');
          $('#totalredeempoint').val(0);
        }
    });
  </script>

  <script>
    function addmorepoint(val){
      console.log(val);
    var element=document.getElementById('new_gift_points');
    let old_point=document.getElementById('gift_points');
    if(val=='more')
    {
      element.style.display='block';
      old_point.style.display='none';
    }
    else
    {
      element.style.display='none';
      old_point.style.display='block';
    }
    }
  </script>

  <script>
    function get_invoice_type(){
      // $("#addfirm").modal('hide');
      $('#getInvoiceType').modal('show');
    }

    </script>

    <script>
      function set_Invoice_Type(){
      let set_Invoice_type_value = $('#setInvoiceType').find(":selected").val();
      console.log(set_Invoice_type_value);
      if(set_Invoice_type_value=='Bill with amount')
      {
        $("#withamountinvoice").click();
        $('#getInvoiceType').modal('hide');
        // location.reload();
      }
      else if(set_Invoice_type_value=='Bill without amount'){
        $("#withoutamountinvoice").click();
        $('#getInvoiceType').modal('hide');
        // location.reload();
      }
      else{
        alert('please select correct option');
        $('#getInvoiceType').modal('hide');
      }
    }


    </script>

  @endsection
