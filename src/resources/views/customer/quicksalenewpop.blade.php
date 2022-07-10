
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
  @if (\Session::has('danger'))
  <div class="alert alert-danger">
    <ul>
      <li>{!! \Session::get('danger') !!}</li>
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
            <button type="button" class="theme-btn mt-1" onclick="edit_invoice();" style="float: right;">Edit Invoice</button>
            <button type="button" class="theme-btn mt-1" onclick="delete_invoice();" style="float: right;">Delete Invoice</button>

            <div style="margin-top:7px">
                <input type="checkbox" class="form-check-input" id="check_estimate" onchange="check_estimate();" title="Check Estimate">
                 <label>Estimate</label>
            </div>

          </div><!--./col-lg-6-->
        </div><!--./row-->
        <div class="col-lg-12 col-md-12 col-12">

         <form id="quicksaleForm" action="{{ url('quicksaleInvoice') }}" method="post" target="_blank" class="formvisit mt-2">
           <div class="row">
                  <!-- <div class="col-lg-4">
                    <select required="" name="services_0" class="form-control selectpicker" onchange="getServicePrice(this.value,0)" aria-describedby="services_0-error" aria-invalid="false"><optgroup label="Hair Services"><option value="5">Basic Haircut</option><option value="9">Hair Coloring</option></optgroup><optgroup label="Beauty Services"></optgroup></select>
                  </div> -->
                  <input type="hidden" name="is_estimate" id="is_estimate" value="0">
                  <div class="col-lg-12 col-md-12 col-12" id="old_invoice_id_div" style="display: none">
                      <div class="form-group">
                        <label>Old Invoice Id</label>
                        <div class="input-group mb-3">
                          <input id="old_invoice_id" name="old_invoice_id" type="text" class="form-control" placeholder="">
                        </div>
                      </div>
                  </div>
                  <div class="col-lg-4 col-md-12 col-12">

                    <div class="form-group">
                      <label>Moblie</label>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend"><span class="input-group-text">+91</span></div>
                        <input type="hidden" name="customer_id" id="customer_id" required="" >
                        <input type="hidden" name="customer_offer_id" id="customer_offer_id" value="0" >
                        <!-- <input required type="number" id="searchnumber" name="searchnumber" onkeyup="checkaccount(this.value)" class="form-control" placeholder="1234567890"> -->
                        <input required type="number" id="searchnumber" name="searchnumber" class="form-control" placeholder="1234567890" >
                        <span class="error" id="searchnumber_error"></span>
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
                  <label>.</label>
                  <div class="input-group mb-3">
                    <button type="button" class="theme-btn btn-sm" id="unpaidbtn"></button>
                  </div>
                </div><!--./form-group-->
              </div><!--./col-lg-4-->
              <div class="col-lg-2 col-md-12 col-12" style="display: none;" id="sittingpackdiv">
                <div class="visitmetric" onclick="getcustomersittingpackdetails();" style="cursor: pointer">
                  <p id="sittingpackShow"> 0 </p>
                  <label ><b>Bridal Packs</b></label>
                </div><!--./metric-->
              </div><!--./col-lg-4-->
              <div class="col-lg-2 col-md-12 col-12" id="recent_checkin_div"><br/>
                <a onclick="recent_checkin_show()" class="theme-btn mt-1" href="javascript:void(0)" id="RecentCheckIn_btn">
                <i class="fa fa-plus">Recent Check-In</i>
                </a>
              </div><!--./col-lg-4-->
              <div class="col-lg-12">
               <div class="row">
                 <div class="col-lg-2 col-md-12 col-12" style="display: none;" id="visitdiv">
                  <div class="visitmetric">
                    <p>Total Visit - <span id="visitshowspan" onclick="showHistoryVisit()" style="cursor: pointer">0</span></p>
                    <p>Last Visit-</p>
                    <p><b id="visitshowdate">Nil</b></p>
                  </div><!--./metric-->
                </div><!--./col-lg-4-->
                <div class="col-lg-2 col-md-12 col-12" style="display: none;" id="revenuediv">
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
                    <p><b>Gift Points</b></p>
                  </div><!--./metric-->
                </div><!--./col-lg-4-->
                <div class="col-lg-3 col-md-12 col-12" style="display: none;" id="walletdiv">
                  <div class="visitmetric">
                    <p>&nbsp;</p>
                    <p id="totalwalletShow"> 0 </p>
                    <p><b>Wallet Amount</b></p>
                  </div><!--./metric-->
                </div><!--./col-lg-4-->
                <div class="col-lg-2 col-md-12 col-12" style="display: none;" id="remarkdiv">
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
              <input type="hidden" name="service_div_count" id="service_div_count" value="0">
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
                    <!-- <li><a onclick="addPackageRow()" href="javascript:void(0)"><i class="fa fa-plus"></i>Package</a></li> -->
                    <li><a onclick="addWalletBalance()" href="javascript:void(0)"><i class="fa fa-plus"></i>Wallet</a></li>
                    <li><a onclick="get_combo_details()" href="javascript:void(0)"><i class="fa fa-plus"></i>Combo</a></li>
                    <li><a onclick="addSittingPackageRow()" href="javascript:void(0)"><i class="fa fa-plus"></i>Bridal Pack</a></li>
                    <li><a onclick="getallmemberplandetails()" href="javascript:void(0)"><i class="fa fa-plus"></i>Sell MemberShip</a></li>
                        <!-- <li><a href=""><i class="fa fa-plus"></i>Membership</a></li>
                        <li><a href=""><i class="fa fa-plus"></i>Gift Voucher</a></li>
                        <li><a href=""><i class="fa fa-plus"></i>Prepaid</a></li> -->
                  </ul>
                </div><!--./col-lg-12-->
              </div>
              <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                  <ul class="serviceslist mt-2 mb-3">
                  <li><a onclick="getcustomersittingpackdetails()" id="btn_getcustomersittingpackdetails" style="display:none;" href="javascript:void(0)"><i class="fa fa-plus"></i>Use Bridal Pack</a></li>
                  <li><a onclick="getcustomermembersysplandetails()" id="btn_getcustomermembersysplandetails"  href="javascript:void(0)"><i class="fa fa-plus"></i>Use MemberShip</a></li>
                  <li><a onclick="getcustomercoupondetails()" id="btn_getcustomercoupondetails"  href="javascript:void(0)"><i class="fa fa-plus"></i>Customer Coupon</a></li>
                  <li><a onclick="getcustomerofferdetails()" id="btn_getcustomerofferdetails"  href="javascript:void(0)"><i class="fa fa-plus"></i>My Referral Offers</a></li>
                  <li><a onclick="getcustomerfrndofferdetails()" id="btn_getcustomerfrndofferdetails"  href="javascript:void(0)"><i class="fa fa-plus"></i>Friends Referral Offers</a></li>
                  </ul>
                  </div>
                  </div>
                </div><!--./col-lg-12-->
                <div class="col-lg-12 col-md-12 col-12"><div class="divider"></div></div><!--/col-lg-12-->
                <div class="col-lg-12 col-md-12 col-12">
                 <h6>Overall benefits</h6>
                 <div class="row">
                   <div class="col-lg-2 col-md-12 col-12">
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

                <div class="col-lg-2 col-md-12 col-12">
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

                     <div class="col-lg-2 col-md-12 col-12">
                       <div class="form-group">
                          <label>Redeem Gift Points</label>
                          <div class="input-group mb-3">
                          <input type="text" name="gift_points" id="gift_points" class="form-control" value="0" onchange="checkcustomerpoints(this.value)" readonly/>
                          </div>
                        </div> <!--./form-group-->
                      </div> <!--./col-lg-4-->

                      <div class="col-lg-2 col-md-12 col-12">
                       <div class="form-group">
                          <br>
                          <button type="button" class="theme-btn mt-1" onclick ="send_otp_point()">GIFT OTP</button>
                        </div> <!--./form-group-->
                      </div> <!--./col-lg-4-->


                      <div class="col-lg-2 col-md-12 col-12">
                        <div class="form-group">
                          <label>Redeem Wallet</label>
                          <div class="input-group mb-3">
                            <input name="cust_wallet" id="cust_wallet" onchange="checkcustomerwallet(this.value)" type="text" class="form-control" readonly>
                          </div>
                        </div><!--./form-group-->
                      </div><!--./col-lg-4-->

                      <div class="col-lg-2 col-md-12 col-12">
                       <div class="form-group">
                          <br>
                          <button type="button" class="theme-btn mt-1" onclick ="send_otp_wallet()">WALLET OTP</button>
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
                                <td>GST Discount:</td>
                                <td><i class="fa fa-inr"></i> <input type="hidden" name="totalgstdiscount" id="totalgstdiscount"><span id="totalgstdiscountval">0.00</span></td>
                              </tr>
                            <tr>
                              <td>Grand Total</td>
                              <td><i class="fa fa-inr"></i> <input type="hidden" name="totalgrandTotal" id="totalgrandTotal"><span id="grandtotal">0.00</span></td>
                            </tr>
                            <tr>
                              <td>
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" id="allow_gift_points" checked>
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
                        <input type="hidden" name="cust_coupon_id" id="cust_coupon_id" value="0">
                        <input type="hidden" name="other_service_invoice_id" id="other_service_invoice_id" value="0">
                        <input type="hidden" name="cust_sitpack_id" id="cust_sitpack_id" value="0">
                        <input type="hidden" name="cust_sitpackround_id" id="cust_sitpackround_id" value="0">
                        <input type="hidden" name="cust_member_sys_id" id="cust_member_sys_id" value="0">
                        <input type="hidden" name="serviceRowCount" id="serviceRowCount" value="0">
                        <input type="hidden" name="productRowCount" id="productRowCount" value="0">
                        <input type="hidden" name="packageRowCount" id="packageRowCount" value="0">
                        <input type="hidden" name="sitpackageRowCount" id="sitpackageRowCount" value="0">
                        <input type="hidden" name="cust_sitpack_alternate" id="cust_sitpack_alternate" value="0">
                        <input type="hidden" name="cust_sitpack_fulladdress" id="cust_sitpack_fulladdress" value="0">
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
                        <a  onclick="reset_quick_sale();" class="btn btn-warning btn-sm waves-effect waves-light">Reset</a> <!-- <button type="submit" class="theme-btn">Save</button> -->
                        <input type="submit" name="invoice_type" id="withsendviasms"  value="Send via SMS" class="btn btn-primary btn-sm waves-effect waves-light" style="display:none">
                        <button type="button" onclick="get_invoice_type(),checkcustomer_id();" class="btn btn-success btn-sm waves-effect waves-light">Continue</button>
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
                <form action="#" id="addcustomerform" enctype="multipart/form-data">
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
                            <label class="control-label" for="contact">Contact <span class="required">* </span> </label>
                              <input type="number"  id="contact" name="contact" value="{{ old('contact') }}" placeholder="Enter contact"  class="form-control" autocomplete="off" onkeyup="usercontact(this.value);">
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

                      <button style="display:block;" type="submit" id="customerformbtn" class="theme-btn">Save</button>
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
                <input type = "hidden" name = "number" id="usermobile_no">
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
                  <button class="btn btn-sm btn-danger" id="otpbtn"  type="button" onclick="resendotp()">Resend OTP</button>
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
                          <option value="Send via SMS">Send via SMS</option>
                        </select>
                      </div>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="set_Invoice_Type();checkcustomer_id();">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>


        <div class="modal" tabindex="-1" role="dialog" id="opt_for_giftpoint">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">OTP FOR GIFT POINT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Enter OTP</label>
                      <input type="text" class="form-control" name="gift_point_otp" id="gift_point_otp">
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="match_otp_with_db()">Verify OTP</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal" tabindex="-1" role="dialog" id="opt_for_wallet">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">OTP FOR WALLET</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Enter OTP</label>
                      <input type="text" class="form-control" name="wallet_otp" id="wallet_otp">
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="match_wallet_otp_with_db()">Verify OTP</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal" tabindex="-1" role="dialog" id="add_wallet">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Add Wallet Amount</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Enter Wallet Amount</label>
                      <input type="text" class="form-control" name="wallet_amount" id="wallet_amount">
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="save_wallet_amount()">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal" tabindex="-1" role="dialog" id="combo_details">
          <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Combo Available</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                          <th class="th-sm">Sr</th>
                          <th class="th-sm">Name</th>
                          <th class="th-sm">Service</th>
                          <th class="th-sm">Price</th>
                          <th class="th-sm">Action</th>
                        </thead>
                        <tbody id="combo_body">
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                  </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal" tabindex="-1" role="dialog" id="sitting_pack_details">
          <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Bridal Pack Available</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                          <th class="th-sm">Sr</th>
                          <th class="th-sm">Name</th>
                          <th class="th-sm">Sitting</th>
                          <th class="th-sm">Service</th>
                          <th class="th-sm">Grand Total</th>
                          <th class="th-sm">Pack Final Price</th>
                          <th class="th-sm">Action</th>
                        </thead>
                        <tbody id="sitting_pack_body">
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                  </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal" tabindex="-1" role="dialog" id="add_sitting_pack_members">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Add Sitting Members Mobile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form class="formvisit mt-2" id="sitpackmembercontacts">
                <div class="modal-body">
                  <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                  <input type = "hidden" name = "customer_mobile" id="reg_customer">
                  <input type = "hidden" name = "sitting_pack_id" id="selected_sitting_pack_id">

                    <div class="row">
                        <div class="col-lg-5 col-md-12 col-12" id="members_head">
                        </div>

                        <div class="col-lg-5 col-md-12 col-12">
                          <div class="form-group">
                            <label>Expiry Date</label>
                            <div class="input-group mb-3">
                              <input id="sitpack_expiry_date" name="expiry_date" required="" type="text" class="form-control datepicker" placeholder="" value="<?php echo date('d-m-Y') ?>">
                              <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
                            </div>
                          </div><!--./form-group-->
                        </div><!--./col-lg-4-->
                    </div>

                    <div id="members_contacts">

                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" onclick=savepackmembers()>Save</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="modal" tabindex="-1" role="dialog" id="customer_sitting_pack_details">
          <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Assigned Bridal Pack Available</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                          <th class="th-sm">Sr</th>
                          <th class="th-sm">Name</th>
                          <th class="th-sm">Expiry Date</th>
                          <th class="th-sm">Advance Payment</th>
                          <th class="th-sm">Grand Total</th>
                          <th class="th-sm">Pack Final Price</th>
                          <th class="th-sm">Action</th>
                        </thead>
                        <tbody id="customer_sitting_pack_body">
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                  </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal" tabindex="-1" role="dialog" id="sitting_pack_otp">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Bridal Pack OTP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Select Pack User</label>
                      <select name="Sitting_Pack_user" class="form-control" id="Sitting_Pack_user"></select>
                      <!-- <input type="text" class="form-control" name="wallet_amount" id="wallet_amount"> -->
                    </div>
                  </div>
                </div>
                <div class="row" style="display:none" id="sit_pack_otp">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Enter OTP</label>
                      <input type="text" class="form-control" name="sit_pack_member_otp" id="cust_sit_pack_otp">
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-warning" id="get_sit_pack_otpbtn" onclick="get_sit_pack_otp()">GET OTP</button>
                <button type="button" class="btn btn-primary" style="display:none;"  id="send_sit_pack_otpbtn"onclick="send_sit_pack_otp()">SEND</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal" tabindex="-1" role="dialog" id="sitting_pack_pswd">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Password to use package</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row" id="sit_pack_pswd">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Enter Password</label>
                      <input type="password" class="form-control" name="sit_package_pswd" id="sit_package_pswd">
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="send_sit_pack_pswdbtn" onclick="send_sit_pack_pswd()">SEND</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal" tabindex="-1" role="dialog" id="member_sys_details">
          <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Member Plans Available</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                          <th class="th-sm">Sr</th>
                          <th class="th-sm">Title</th>
                          <th class="th-sm">Type</th>
                          <th class="th-sm">Price</th>
                          <th class="th-sm">Validity (Days)</th>
                          <th class="th-sm">Action</th>
                        </thead>
                        <tbody id="member_plan_body">
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                  </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal" tabindex="-1" role="dialog" id="add_member_plan_cust">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Add Plan details before assign</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="{{ route('assignMemberPlanToCustomer')}}" id="sell_member_plan" method="POST" class="formvisit mt-2">
                <div class="modal-body">
                  <div id="member_plan_sell_result"></div>
                  <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                  <input type = "hidden" name = "customer_mobile" id="reg_plan_customer">
                  <input type = "hidden" name = "member_plan_id" id="selected_member_plan_id">

                    <div class="row">

                        <div class="col-lg-3 col-md-12 col-12">
                          <div class="form-group">
                            <label>Start Date</label>
                            <div class="input-group mb-3">
                              <input id="plan_start_date" name="plan_start_date" required="" type="text" class="form-control datepicker" placeholder="" value="<?php echo date('d-m-Y') ?>">
                              <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
                            </div>
                          </div><!--./form-group-->
                        </div><!--./col-lg-4-->

                        <div class="col-lg-3 col-md-12 col-12">
                          <div class="form-group">
                            <label>Expiry Date</label>
                            <div class="input-group mb-3">
                              <input id="mem_plan_expiry_date" name="plan_expiry_date" required="" type="text" class="form-control datepicker" placeholder="">
                              <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
                            </div>
                          </div><!--./form-group-->
                        </div><!--./col-lg-4-->

                        <div class="col-lg-3 col-md-12 col-12">
                            <div class="form-group">
                              <label>Coupon Code</label>
                              <div class="input-group mb-3">
                                <input id="coupon_code_mem" name="coupon_code" r type="text" class="form-control" placeholder="">

                              </div>
                            </div><!--./form-group-->
                          </div><!--./col-lg-4-->

                        <div class="col-lg-3 col-md-12 col-12">
                          <div class="form-group">
                            <label>More Members</label>
                            <div class="input-group mb-3">
                              <button type="button" class="btn btn-success" onclick="addplanmembers()"><i class="fa fa-plus"></i></button>
                            </div>
                          </div><!--./form-group-->
                        </div><!--./col-lg-4-->
                    </div>

                    <div id="plan_members_contacts">

                    </div>
                </div>
                <div class="modal-footer">
                  <a  onclick="save_member_plan();" class="btn btn-primary">Save</a>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="modal" tabindex="-1" role="dialog" id="customer_member_plan_details">
          <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Assigned Member Plan Available</h5>
                <button type="button" class="btn btn-info" onclick="get_expired_cust_plan();">
                  Expired
                </button>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                          <th class="th-sm">Sr</th>
                          <th class="th-sm">Title</th>
                          <th class="th-sm">Type</th>
                          <th class="th-sm">Service</th>
                          <th class="th-sm">Price</th>
                          <th class="th-sm">Expiry Date</th>
                          <th class="th-sm">Action</th>
                        </thead>
                        <tbody id="customer_member_plan_body">
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                  </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal" tabindex="-1" role="dialog" id="customer_member_expired_plan_details">
          <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Expired Member Plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                          <th class="th-sm">Sr</th>
                          <th class="th-sm">Title</th>
                          <th class="th-sm">Type</th>
                          <th class="th-sm">Service</th>
                          <th class="th-sm">Price</th>
                          <th class="th-sm">Expiry Date</th>
                          <th class="th-sm">Action</th>
                        </thead>
                        <tbody id="customer_member_expired_plan_body">
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                  </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal" tabindex="-1" role="dialog" id="member_plan_otp">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Member Plan OTP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Select Plan Member</label>
                      <select name="system_Plan_member" class="form-control" id="system_Plan_member"></select>
                      <!-- <input type="text" class="form-control" name="wallet_amount" id="wallet_amount"> -->
                    </div>
                  </div>
                </div>
                <div class="row" style="display:none" id="member_plan_cust_otp">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Enter OTP</label>
                      <input type="text" class="form-control" name="cust_memberplan_otp" id="cust_memberplan_otp">
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <input type="hidden" id="mem_otp_btn">
                <button type="button" class="btn btn-warning" id="get_membersys_plan_otpbtn" onclick="get_membersys_plan_otp()">GET OTP</button>
                <button type="button" class="btn btn-primary" style="display:none;"  id="send_membersys_plan_otpbtn"onclick="send_membersys_plan_otp()">SEND</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal" tabindex="-1" role="dialog" id="Customer_coupon">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Customer Coupon</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body formvisit">
                <div class="row">
                    <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Enter Coupon Code</label>
                      <input type="text" class="form-control" name="cust_coupon_code" id="cust_coupon_code">
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="Get_coupon_details()">Apply</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal" tabindex="-1" role="dialog" id="add_sitting_pack_installments">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Add Sitting Installments</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form class="formvisit mt-2" id="sitpack_payment_details">
                <div class="modal-body">
                  <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                  <input type = "hidden" name = "sitting_pack_id" id="selected_sitting_pack_id">
                    <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="">Alternative Contact</label>
                            <input type="text" class="form-control" name="sit_pack_alt_contact" id="sit_pack_alt_contact" placeholder="Enter Alternative Contacts" value="">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="">Full Address</label>
                            <input type="text" class="form-control" name="sit_pack_full_address" id="sit_pack_full_address" placeholder="Enter Full address" value="">
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="">Package Total Price</label>
                            <input type="text" class="form-control" name="sit_pack_total_price" id="sit_pack_total_price">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="">Package Advance Payment</label>
                            <input type="text" class="form-control" name="sit_pack_adv_payment" id="sit_pack_adv_payment" onblur="calculate_sitpack_installment()">
                          </div>
                        </div>
                    </div>

                    <div id="sitpack_installments">

                    </div>
                    <div id="sitpack_makeups">

                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal" onclick=assignsitpackinstallment()>Save</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="modal" tabindex="-1" role="dialog" id="other_service">
          <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Add Other Services</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form class="formvisit mt-2" id="other_service_details">
                <div class="modal-body">
                  <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                  <input type = "hidden" name = "other_service_id" id="other_service_id">
                  <!-- <input type = "hidden" name = "other_sub_cate_id" id="other_sub_cate_id"> -->
                  <!-- <input type = "hidden" name = "other_brand_id" id="other_brand_id">  -->
                    <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="">Enter Brand Name</label>
                            <input type="text" class="form-control" name="other_brand_name" id="other_brand_name">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="">Service Price</label>
                            <input type="text" class="form-control" name="other_service_price" id="other_service_price" onblur="calculate_sitpack_installment()">
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="">Enter Service Duration<small>(Min)</small></label>
                            <input type="text" class="form-control" name="other_service_duration" id="other_service_duration">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="">Service Description</label>
                            <input type="text" class="form-control" name="other_service_description" id="other_service_description" onblur="calculate_sitpack_installment()">
                          </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal" onclick=addOtherService()>Save</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="modal" tabindex="-1" role="dialog" id="Customer_offers">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Customer Referral offer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body formvisit">
                <div class="row">
                    <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Enter Referral Coupon Code</label>
                      <input type="text" class="form-control" name="cust_referral_coupon_code" id="cust_referral_coupon_code">
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="Get_cust_referral_coupon_details()">Apply</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal" tabindex="-1" role="dialog" id="Customer_frnd_ref_offers">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Friend Referral offer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body formvisit">
                <div class="row">
                    <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Enter Friend Referral Coupon Code</label>
                      <input type="text" class="form-control" name="cust_frnd_referral_offer_code" id="cust_frnd_referral_offer_code">
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="Get_cust_frnd_referral_offer_details()">Apply</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>


        <div class="modal" tabindex="-1" role="dialog" id="all_checkin_customer">
          <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Currently Check-In Customers</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                          <th class="th-sm">Sr</th>
                          <th class="th-sm">Name</th>
                          <th class="th-sm">Email Id & Mobile</th>
                          <th class="th-sm">Action</th>
                        </thead>
                        <tbody id="checkin_customer_data">
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                  </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>



        <div class="modal" tabindex="-1" role="dialog" id="update_expiry">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Update Expiry</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body formvisit">
                <div class="row">
                    <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Enter Expiry date</label>
                      <input  type="hidden" id="c_s_p_id">
                      <input type="text" class="form-control datepicker" name="expiry_date" id="expiry_date">
                      <span class="text text-danger" id="expiry_date_error"></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="save_expiry_date()">Update</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>


        <div class="modal" tabindex="-1" role="dialog" id="delete_invoice">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Delete Invoice</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body formvisit">
                  <div class="row">
                      <div class="col-md-12">
                      <div class="delete_invoice_result"></div>
                      <div class="form-group">
                        <label for="">Invoice Number</label>
                        <input type="number" class="form-control" name="delete_invoice_no" id="delete_invoice_no">
                        <span class="text text-danger" id="delete_invoice_no_error"></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" onclick="delete_invoice_by_invoice_no()">Delete</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>


<script src="{{asset('assets/js/lib/jquery.js')}}"></script>
<script src="{{asset('assets/js/dist/jquery.validate.js')}}"></script>

<script type="text/javascript">

function check_estimate(){
    let isChecked = $('#check_estimate').is(':checked');
    if(isChecked){
     $('#is_estimate').val(1);
    }else{
     $('#is_estimate').val(0);
    }
}

function save_member_plan(){
      var sell_member_plan=$('#sell_member_plan').serialize();
      $.ajax({
          url:"{{ url('assignMemberPlan_ToCustomer_by_ajex') }}",
          type:'POST',
          data:sell_member_plan,
          dataType:'JSON',
          success:function(res) {
              if(res.status==0){
                $('#member_plan_sell_result').html('<div class="alert alert-danger">'+res.msg+'</div>');
              }else{
                $('#member_plan_sell_result').html('<div class="alert alert-success">'+res.msg+'</div>');
                setTimeout(function() {
                   $('#member_plan_sell_result').html('');
                   $('#add_member_plan_cust').modal('hide');
                }, 1000);
              }
          }
        });

    }


function update_expiry(cust_sitting_pack_id,expiry_date){
        $('#c_s_p_id').val(cust_sitting_pack_id);
        $('#update_expiry').modal('show');
}

function save_expiry_date(){
  var sitting_id = $('#c_s_p_id').val();
  var expiry_date = $('#expiry_date').val();
  if(expiry_date==''){
    $('#expiry_date_error').html('Please enter expiry date');
  }else{
     $('#expiry_date_error').html('');

      var dataString = 'sitting_id='+sitting_id+'&_token={{ csrf_token() }}'+'&expiry_date='+expiry_date;
      $.ajax({
      type: "POST",
      url: 'save_expiry_date',
      data: dataString,
      cache: false,
      dataType: "json",
      success: function(result){
        if(result.msg==true){
          $('#update_expiry').modal('hide');
          getcustomersittingpackdetails();
          alert('Expriy date updated');

        }else{
          alert('something went wrong');
        }

        }//end sucess
      });//end ajax


  }
}
function usercontact(number){
   $('#usermobile_no').val(number);
}
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
          //console.log(response);
          if (response != '') {
            // if (response.verify_otp != 0 && response.is_verified == 0 && search_query.length == 10) {
            //   $("#addcustomer").modal('hide');

            //   $("#customerid").val(response.id);
            // }else{
            //   for (var i = 0; i < response.contact.length; i++) {

            //     resp_data_format=resp_data_format+"<li style='cursor:pointer' onclick='checkaccount('"+response[i].contact+"')' class='select_contact'>"+response[i].contact+"</li><span>- "+response[i].name+" ("+response[i].id+")<span>";
            //   };
            //   $("#data-container").html(resp_data_format);
            // }

            for (var i = 0; i < response.length; i++) {
                // alert(response.contact[i])
                resp_data_format=resp_data_format+"<li style='cursor:pointer' onclick='checkaccount('"+response[i].contact+"')' class='select_contact'>"+response[i].contact+"</li><span>- "+response[i].name+" ("+response[i].id+")<span>";
              };
            $("#data-container").html(resp_data_format);

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
  let total_flag2=true;
  let combo_flag=false;
  function calculatecash() {
    var sum = 0;
    var subtotal = 0;
    var totalsgst = 0;
    var totalcgst = 0;
    var totalgstdiscount = 0;
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
    $('.gstdiscount').each(function(){
          totalgstdiscount += parseFloat(this.value);  // Or this.innerHTML, this.innerText
          $("#totalgstdiscountval").html(parseFloat(totalgstdiscount).toFixed(2));
          $("#totalgstdiscount").val(parseFloat(totalgstdiscount).toFixed(2));
        });

    $("#totalTax").html(parseFloat(totalsgst+totalcgst).toFixed(2));
    $("#totaltaxinput").val(parseFloat(totalsgst+totalcgst).toFixed(2));
    $("#finalTax").html(parseFloat(totalsgst+totalcgst).toFixed(2));
    // let allow_points_ischecked=$("#allow_gift_points").is(':checked');
    // if(!allow_points_ischecked){
      if(total_flag){
        getpointbytotal(sum);
      }
      if(combo_flag){
        checkcombo();
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
      let discountByValue=$("#discountByValue").val();
      if (discountByValue==0 || discountByValue=='' || discountByValue==undefined || discountByValue== null) {
        let subtotal= 0;
      let sum=0;
      let totaldiscount1=0;
      let totaldiscount=0;
      if(disc==''){disc=0;}
      $("#discountByValue").val(0);
      let disc_per = $("#discountByPercent").val();
      var service_row = $(".servicerow").length;
      var product_row = $(".productRow").length;
      var package_row = $(".packageRow").length;
      $('.countTotal').each(function() {
            subtotal += parseFloat(this.value);
            totaldiscount = (parseFloat(subtotal).toFixed(2) * parseFloat(disc_per).toFixed(2))/100;
            $("#subtotal").html(parseFloat(subtotal-totaldiscount).toFixed(2));
            $("#subtotalamount").val(parseFloat(subtotal-totaldiscount).toFixed(2));
        });
        $('.totalprice').each(function(){
            sum += parseFloat(this.value);  // Or this.innerHTML, this.innerText
            totaldiscount1 = (parseFloat(sum).toFixed(2) * parseFloat(disc_per).toFixed(2))/100;
            $("#cashpay").html(parseFloat(sum-totaldiscount1).toFixed(2));
            $("#grandtotal").html(parseFloat(sum-totaldiscount1).toFixed(2));
            $("#totalgrandTotal").val(parseFloat(sum-totaldiscount1).toFixed(2));
        });
        if(total_flag){
            console.log('-----after discount----');
            getpointbytotal(parseFloat(sum-totaldiscount1));
        }
        if(combo_flag){
            checkcombo();
        }
      }
    //   if (service_row != "") {
    //     for (var i = 0; i < service_row; i++) {
    //       var count = i;
    //       var sgst = parseFloat(9);
    //       var cgst = parseFloat(9);
    //       var price = $("#servicePrice"+count).val();
    //       var qty = $("#serviceQty"+count).val();
    //       var total = parseFloat(price) * parseFloat(qty);
    //       // var totaldiscountbyvalue = (parseFloat(disc) * 100)/ parseFloat(total);
    //       var totaldiscount = (parseFloat(total).toFixed(2) * parseFloat(disc).toFixed(2))/100;
    //       total = parseFloat(total) - parseFloat(totaldiscount);
    //       $("#servicePriceTotal"+count).val(parseFloat(total).toFixed(2));
    //       var totalsgst = (parseFloat(total) * parseFloat(sgst))/100;
    //       var totalcgst = (parseFloat(total) * parseFloat(cgst))/100;
    //       total = parseFloat(total) + parseFloat(totalsgst) + parseFloat(totalcgst);
    //       $("#serviceTotal"+count).val(parseFloat(total).toFixed(2));
    //       $("#serviceDisc"+count).val(disc);
    //       $("#servicesSgst"+count).val(parseFloat(totalsgst).toFixed(2));
    //       $("#servicesCgst"+count).val(parseFloat(totalcgst).toFixed(2));
    //     }
    //   }
    //   if (product_row != "") {
    //     for (var i = 0; i < product_row; i++) {
    //       var count = i;
    //       var sgst = parseFloat(9);
    //       var cgst = parseFloat(9);
    //       var price = $("#productPrice"+count).val();
    //       var qty = $("#productQty"+count).val();
    //       total = parseFloat(price) * parseFloat(qty);
    //       var totaldiscount = (parseFloat(total).toFixed(2) * parseFloat(disc).toFixed(2))/100;
    //       total = parseFloat(total) - parseFloat(totaldiscount);
    //       $("#productPriceTotal"+count).val(parseFloat(total).toFixed(2));
    //       var totalsgst = (parseFloat(total) * parseFloat(sgst))/100;
    //       var totalcgst = (parseFloat(total) * parseFloat(cgst))/100;
    //       total = parseFloat(total) + parseFloat(totalsgst) + parseFloat(totalcgst);
    //       $("#productTotal"+count).val(parseFloat(total).toFixed(2));
    //       $("#productDisc"+count).val(disc);
    //       $("#productSgst"+count).val(parseFloat(totalsgst).toFixed(2));
    //       $("#productCgst"+count).val(parseFloat(totalcgst).toFixed(2));
    //     }
    //   }
    //   calculatecash();
    }
    function discByValue(disc_val) {
      let discountByPercent=$("#discountByPercent").val();
      let subtotal= 0;
      let sum=0;
      if (discountByPercent==0 || discountByPercent=='' || discountByPercent==undefined || discountByPercent== null)  {
        if(disc_val==''){disc_val=0;}
      disc_val=parseFloat(disc_val);
      //  alert(disc);
      $("#discountByPercent").val(0);
      var service_row = $(".servicerow").length;
      var product_row = $(".productRow").length;
      var package_row = $(".packageRow").length;
      $('.countTotal').each(function() {
            subtotal += parseFloat(this.value);
            $("#subtotal").html(parseFloat(subtotal-disc_val).toFixed(2));
            $("#subtotalamount").val(parseFloat(subtotal-disc_val).toFixed(2));
        });
        $('.totalprice').each(function(){
            sum += parseFloat(this.value);  // Or this.innerHTML, this.innerText
            $("#cashpay").html(parseFloat(sum-disc_val).toFixed(2));
            $("#grandtotal").html(parseFloat(sum-disc_val).toFixed(2));
            $("#totalgrandTotal").val(parseFloat(sum-disc_val).toFixed(2));
        });
        if(total_flag){
            console.log('-----after discount----');
            getpointbytotal(parseFloat(sum-disc_val));
        }
        if(combo_flag){
            checkcombo();
        }
      }

        // $('.totalprice').each(function(){
        //     sum += parseFloat(this.value);  // Or this.innerHTML, this.innerText
        //     valid_points=parseFloat((sum*allow_redeem_points)/100);
        //     valid_points=valid_points.toFixed(2);
        //     $('#redeem_point').html(valid_points);
        //     if($("#allow_gift_points").is(':checked'))
        //     {
        //     gift_points=$('#redeem_point').html();
        //     gift_points=parseFloat(gift_points);
        //     $('#totalredeempoint').val(gift_points);
        //     }

        // });
    //   if (service_row != "") {
    //     for (var i = 0; i < service_row; i++) {
    //       var count = i;
    //       var sgst = parseFloat(9);
    //       var cgst = parseFloat(9);
    //       var price = $("#servicePrice"+count).val();
    //       var qty = $("#serviceQty"+count).val();
    //       var total = parseFloat(price) * parseFloat(qty);
    //       console.log('-------price-----');
    //       console.log(price);
    //     //   var totaldiscountbyvalue = (parseFloat(disc) * 100)/ parseFloat(total);
    //     //   var totaldiscount = (parseFloat(total) * parseFloat(totaldiscountbyvalue))/100;
    //       total = parseFloat(total) - parseFloat(disc);
    //       console.log('-------after total-----');
    //       console.log(total);
    //       $("#servicePriceTotal"+count).val(parseFloat(total).toFixed(2));
    //       var totalsgst = (parseFloat(total) * parseFloat(sgst))/100;
    //       var totalcgst = (parseFloat(total) * parseFloat(cgst))/100;
    //       total = parseFloat(total) + parseFloat(totalsgst) + parseFloat(totalcgst);
    //       $("#serviceTotal"+count).val(parseFloat(total).toFixed(2));
    //       console.log($("#serviceTotal"+count).val());
    //     //   $("#serviceDisc"+count).val(disc);
    //       $("#servicesSgst"+count).val(parseFloat(totalsgst).toFixed(2));
    //       $("#servicesCgst"+count).val(parseFloat(totalcgst).toFixed(2));
    //     }
    //   }
    //   if (product_row != "") {
    //     for (var i = 0; i < product_row; i++) {
    //       var count = i;
    //       var sgst = parseFloat(9);
    //       var cgst = parseFloat(9);
    //       var price = $("#productPrice"+count).val();
    //       var qty = $("#productQty"+count).val();
    //       var total = parseFloat(price) * parseFloat(qty);
    //       var totaldiscountbyvalue = (parseFloat(disc) * 100)/ parseFloat(total);
    //       var totaldiscount = (parseFloat(total) * parseFloat(totaldiscountbyvalue))/100;
    //       var total = parseFloat(total) - parseFloat(totaldiscount);
    //       $("#productPriceTotal"+count).val(parseFloat(total).toFixed(2));
    //       var totalsgst = (parseFloat(total) * parseFloat(sgst))/100;
    //       var totalcgst = (parseFloat(total) * parseFloat(cgst))/100;
    //       total = parseFloat(total) + parseFloat(totalsgst) + parseFloat(totalcgst);
    //       $("#productTotal"+count).val(parseFloat(total).toFixed(2));
    //       $("#productDisc"+count).val(totaldiscountbyvalue);
    //       $("#productSgst"+count).val(parseFloat(totalsgst).toFixed(2));
    //       $("#productCgst"+count).val(parseFloat(totalcgst).toFixed(2));
    //     }
    //   }
    //   calculatecash();
    }

    function addServiceRow(argument) {
      /*var options = '<?php if (!empty($service_group)) {foreach ($service_group as $group) {?><optgroup label="<?php echo $group->group_name ?>"><?php $services = DB::table('services')->where('group_id', $group->id)->get();if (!empty($services)) {foreach ($services as $service) {?><option value="{{ $service->id }}">{{ $service->name }}</option><?php }}?><?php }}?>';*/
      var groupoptions = '<?php if (!empty($service_group)) {foreach ($service_group as $group) {?><option value="<?php echo $group->id ?>"><?php echo $group->group_name ?></option><?php }}?>';
      // alert(options);<form></form>services_
      let rowcount=$(".servicerow").length;
      var html = '<div class="row servicerow" id="rowcount'+$(".servicerow").length+'">';
      html +='<div class="col-lg-2 col-md-12 col-12">';
      html +='<div class="form-group">';
      html +='<label>Service Categories</label>';
      html +='<input type="hidden" name="service['+rowcount+'][offer_id]" id="offer_id_'+rowcount+'" value="0">';
      html +='<input type="hidden" name="service['+rowcount+'][free_service]" id="free_service_'+rowcount+'" value="0">';
      html +='<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">';
      html +='<input value="" type="hidden" name="service['+rowcount+'][groupidfirm]" id="groupidfirm_'+rowcount+'">';
      html +='<select title="Select" required name="service['+rowcount+'][servicegroups]" id="servicegroups_'+rowcount+'" class="form-control " onchange="getServices(this.value,'+$(".servicerow").length+')" data-live-search="true">';
      html +='<option value="">Select</option>'+groupoptions+'</select>';
      html +='</div>';
      html +='</div>';
      html +='<div class="col-lg-2 col-md-12 col-12">';
      html +='<div class="form-group">';
      html += '<label>Service</label>';
      html +='<div class="input-group mb-3">';
      html +='<div class="input-group-prepend">';
      html +='<span class="input-group-text"><i class="fa fa-heart-o"></i></span>';
      html +='</div>';
      html +='<input class="form-control" name="service['+rowcount+'][serviceName]" id="serviceName'+rowcount+'" required >';
      html +='</div>';
      html += '</div>';
      html +='</div>';
      html +='<div class="col-lg-2 col-md-12 col-12">';
      html +='<div class="form-group">';
      html +='<label>Staff</label>';
      html += '<div class="input-group mb-3">';
      html +='<div class="input-group-prepend">';
      html +='<span class="input-group-text"><i class="fa fa-heart-o"></i></span>';
      html += '</div>';
      html +='<select class="form-control" name="service['+rowcount+'][serviceStaff]" >';
      html +='<?php if (!empty($staffs)): ?><option value="0">Select Staff</option>';
      html +='<?php foreach ($staffs as $staff): ?>';
      html +='<option value="{{ $staff->id }}">{{ $staff->name }}</option>';
      html +='<?php endforeach?><?php endif?>';
      html +='</select>';
      html +='</div>';
      html +='</div>';
      html +='</div>';
      html +='<div class="col-lg-6 col-md-12 col-12">';
      html +='<div class="row">';
      html +='<div class="col-lg-1 col-md-6 col-12">';
      html +='<div class="form-group">';
      html +='<label>Qty.</label>';
      html +='<input name="service['+rowcount+'][serviceQuantity]" style="width:50px" type="text" class="form-control appendfocus" placeholder="" value="1" id="serviceQty'+$(".servicerow").length+'" onkeyup="calcutateDiscount('+$(".servicerow").length+')">';
      html +='</div>';
      html +='</div>';
      html +='<div class="col-lg-2 col-md-6 col-12">';
      html +='<div class="form-group">';
      html +='<label>Price <i class="fa fa-inr"></i></label>';
      html +='<input name="service['+rowcount+'][services]"  type="hidden" id="services_'+$(".servicerow").length+'"/>';
      html +='<input name="service['+rowcount+'][brand]"  type="hidden" id="brand_'+$(".servicerow").length+'"/>';
      html +='<input name="service['+rowcount+'][servicesSgst]" type="hidden" id="servicesSgst'+$(".servicerow").length+'" class="sgstCount">';
      html +='<input name="service['+rowcount+'][servicesCgst]" type="hidden" id="servicesCgst'+$(".servicerow").length+'" class="cgstCount">';
      html +='<input name="service['+rowcount+'][servicesgstdiscount]" type="hidden" id="servicesgstdiscount'+$(".servicerow").length+'" class="gstdiscount">';
      html +='<input name="service['+rowcount+'][servicePriceTotal]" type="hidden" id="servicePriceTotal'+$(".servicerow").length+'" class="countTotal">';
      html +='<input name="service['+rowcount+'][servicePriceActualRate]" type="hidden" id="servicePriceActualRate'+$(".servicerow").length+'" class="">';
      html +='<input name="service['+rowcount+'][servicePrice]" type="text" class="form-control" placeholder="" id="servicePrice'+$(".servicerow").length+'">';
      html +='</div>';
      html +='</div>';
      html +='<div class="col-lg-2 col-md-6 col-12">';
      html +='<div class="form-group">';
      html +='<label>Disc.</label>';
      html +='<input name="service['+rowcount+'][serviceDisc]" id="serviceDisc'+$(".servicerow").length+'" type="text" class="form-control" placeholder="" value="0" onkeyup="calcutateDiscount('+$(".servicerow").length+')">';
      html +='</div>';
      html +='</div>';
      html +='<div class="col-lg-2 col-md-6 col-12">';
      html +='<div class="form-group">';
      html +='<label style="font-size:14px">Cgst/Sgst/Disc%</label>';
      html +='<input name="service['+rowcount+'][cgst]" id="cgst_'+$(".servicerow").length+'" type="text" class="form-control" placeholder=""  onkeyup="calcutateDiscount('+$(".servicerow").length+')" readonly="true">';
      html +='</div>';
      html +='</div>';
      html +='<div class="col-lg-2 col-md-6 col-12">';
      html +='<div class="form-group">';
      html +='<label>Add.</label>';
      html +='<input name="service['+rowcount+'][serviceAdd]" id="serviceAdd'+$(".servicerow").length+'" type="text" class="form-control" placeholder="0" value="0" onkeyup="addDiscount('+$(".servicerow").length+')">';
      html +='</div>';
      html +='</div>';
      html +='<div class="col-lg-2 col-md-6 col-12">';
      html +='<div class="form-group">';
      html +='<label>Total <i class="fa fa-inr"></i></label>';
      html +='<input name="service['+rowcount+'][serviceTotal]" type="text" class="form-control totalprice" placeholder="" id="serviceTotal'+$(".servicerow").length+'">';
      html +='</div>';
      html +='</div>';
      html +='<div class="col-lg-1 col-md-6 col-12">';
      html +='<div class="form-group">';
      html +='<label style="display: block; visibility: hidden;">Totalsss</label>';
      html +='<a href="javascript:void(0)" onclick="deleteServiceRow('+rowcount+')"><i class="fa fa-trash-o mt-2"></i></a>';
      html +='</div>';
      html +='</div>';
      html +='</div>';
      html +='</div>';
      html +='</div>';
      html +='<div class="modal" id="selectMainService_'+$(".servicerow").length+'">';
      html +='<div class="modal-dialog modal-lg" id="servicegroupform" >';
      html +='<div class="modal-content">';
      html +='<div class="modal-header">';
      html +='<h4 class="modal-title">Add Group</h4>';
      html +='<button type="button" class="close" data-dismiss="modal">&times;</button>';
      html +='</div>';
      html +='<!-- Modal body --><div class="modal-body formvisit">';
      html +='<div class="text-center" id="spinner_service" >';
      html +='<div class="spinner-border" style="width: 4rem; height: 4rem;" role="status"><span class="sr-only">Loading...</span> </div>';
      html +='</div>';
      html +='<div class="row"><!--./col-lg-4-->';
      html +='<div class="col-lg-12 col-md-12 col-12" id="mainserviceDiv_'+($(".servicerow").length+1)+'"></div>';
      html +='<div class="col-lg-12 col-md-12 col-12" id="groupserviceDiv_'+($(".servicerow").length+1)+'"></div>';
      html +='<div class="col-lg-12 col-md-12 col-12" id="serviceBrandDiv_'+($(".servicerow").length+1)+'"></div>';
      html +='</div>';
      html +='<!--./row-->';
      html +='</div>';
      html +='<div class="modal-footer">';
      html +='<button type="button" class="outline-btn" data-dismiss="modal">Cancel</button>';
      html +='<button type="button" onclick="showServiceBrandsPrice()" class="theme-btn">Save</button>';
      html +='</div>';
      html +='</div>';
      html +='</div>';
      html +='</div>';
      $("#serviceDiv").append(html);
      /*$("#serviceDiv").append('<div class="row servicerow"><div class="col-lg-3 col-md-12 col-12"><div class="form-group"><label>Services</label><select title="Select" required name="services_'+$(".servicerow").length+'" class="form-control selectpicker" onchange="getServicePrice(this.value,'+$(".servicerow").length+')" data-live-search="true">'+groupoptions+'</select></div>  </div><div class="col-lg-3 col-md-12 col-12"><div class="form-group"><label>Staff</label><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-heart-o"></i></span></div><select class="form-control" name="serviceStaff'+$(".servicerow").length+'" required><option value="">Select</option><?php // if (!empty($staffs)): ?><?php // foreach ($staffs as $staff): ?><option value="{{ $staff->id }}">{{ $staff->name }}</option><?php // endforeach ?><?php // endif ?></select></div></div></div><div class="col-lg-6 col-md-12 col-12"><div class="row"><div class="col-lg-2 col-md-6 col-12"><div class="form-group"><label>Qty.</label><input name="serviceQuantity[]" type="text" class="form-control appendfocus" placeholder="" value="1" id="serviceQty'+$(".servicerow").length+'" onkeyup="calcutateDiscount('+$(".servicerow").length+')"></div></div>   <div class="col-lg-3 col-md-6 col-12"><div class="form-group"><label>Price <i class="fa fa-inr"></i></label><input name="servicesSgst[]" type="hidden" id="servicesSgst'+$(".servicerow").length+'" class="sgstCount"><input name="servicesCgst[]" type="hidden" id="servicesCgst'+$(".servicerow").length+'" class="cgstCount"><input name="servicePriceTotal[]" type="hidden" id="servicePriceTotal'+$(".servicerow").length+'" class="countTotal"><input name="servicePrice[]" type="text" class="form-control" placeholder="" id="servicePrice'+$(".servicerow").length+'"></div></div>  <div class="col-lg-2 col-md-6 col-12"><div class="form-group"><label>Disc. (%)</label><input name="serviceDisc[]" id="serviceDisc'+$(".servicerow").length+'" type="text" class="form-control" placeholder="" value="0" onkeyup="calcutateDiscount('+$(".servicerow").length+')"></div></div><div class="col-lg-3 col-md-6 col-12"><div class="form-group"><label>Total <i class="fa fa-inr"></i></label><input name="serviceTotal[]" type="text" class="form-control totalprice" placeholder="" id="serviceTotal'+$(".servicerow").length+'"></div></div><div class="col-lg-1 col-md-6 col-12"><div class="form-group"><label style="display: block; visibility: hidden;">Total</label><a href="javascript:void(0)" onclick="deleteServiceRow()"><i class="fa fa-trash-o mt-2"></i></div></div></div></div></div>');*/
      if ($(".servicerow").length == 1) {
        $(".serviceDivider").show();
      }
      $("#serviceRowCount").val($(".servicerow").length);
      $('#serviceDiv').children().last().find('.appendfocus').focus();
      $('.selectpicker').selectpicker();
      $('#service_div_count').val(rowcount);
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
            addServiceRow();
             //alert("#servicePrice"+totalcount);service_id
            //  alert(res.service_id);
            $("#brand_"+totalcount).val(array[i]);
            $("#servicePrice"+totalcount).val(res.service_price);
            $("#servicePriceActualRate"+totalcount).val(res.service_price);
            $("#serviceName"+totalcount).val(res.brand_name);
            $("#services_"+totalcount).val(res.brand_id);
            // addServiceRow(totalcount);
            $("#servicegroups_"+totalcount).val(res.service_id);
            $("#servicegroups_"+totalcount).find('option[value="'+res.service_id+'"]').attr('selected', true);
            var cgstvalue="0/0/0";
            if(res.gst_status==1){
                var gstdiscount = 0;
                if(res.gst_discount==1){
                     gstdiscount = parseInt(res.cgst)+parseInt(res.sgst);
                }
                var cgstvalue = res.cgst+'/'+res.sgst+'/'+gstdiscount;
            }
            $("#cgst_"+totalcount).val(cgstvalue);
            calcutateDiscount(totalcount);
            totalcount++;
          }
        });
      }
    });

    // deleteServiceRow();
    setTimeout(function() {
    $("#selectMainService_"+totalcountss).modal('hide');
    $('#spinner_service').hide();
    $("#serviceDiv").children().last().remove();
    $("#serviceDiv").children().last().remove();
    calculatecash();
      // deleteServiceRow(totalcountnew);
      // deleteServiceRow(totalcountnew);
       }, 1000);
    }

    function showServiceBrands(service_id) {
      var totalcount = $(".servicerow").length;
      var totalcountss = $(".servicerow").length-1;
      var count = $(".servicerow").length-1;
      console.log(service_id);
      if((service_id != "")&&(service_id!=0)){
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
      else if((service_id != "")&&(service_id==0))
      {
        var other_service_id=$('#servicegroups_'+totalcountss).val();
        console.log('other services');
        $("#serviceBrandDiv_"+totalcount).html('');
        $('#other_service_id').val(other_service_id);
        // servicegroups_
        $('#other_service').modal('show');
        $("#selectMainService_"+totalcountss).modal('hide');
      }
    }

    function addOtherService(){
      var other_service_form=$('#other_service_details').serialize();
      var totalcount = $(".servicerow").length-1;
      var rowcount = $(".servicerow").length;
      $.ajax({
          url:"{{ url('add_other_service') }}",
          type:'POST',
          data:other_service_form,
          dataType:'JSON',
          success:function(res) {
            $('#other_service_invoice_id').val(res.data.id);
            $("#brand_"+totalcount).val(res.data.brand_id);
            $("#servicePrice"+totalcount).val(res.data.service_price);
            $("#servicePriceActualRate"+totalcount).val(res.data.service_price);
            $("#serviceName"+totalcount).val(res.data.brand_name);
            $("#services_"+totalcount).val(res.data.service_id);
            //addServiceRow(totalcount);
            $("#servicegroups_"+totalcount).val(res.data.service_id);
            $("#servicegroups_"+totalcount).find('option[value="'+res.data.service_id+'"]').attr('selected', true);
            $('#service_div_count').val(rowcount);
            var cgstvalue="0/0/0";
            if(res.gst_status==1){
                var gstdiscount = 0;
                if(res.gst_discount==1){
                     gstdiscount = parseInt(res.cgst)+parseInt(res.sgst);
                }
                var cgstvalue = res.cgst+'/'+res.sgst+'/'+gstdiscount;
            }
            $("#cgst_"+totalcount).val(cgstvalue);
            calcutateDiscount(totalcount);
          }
        });
          setTimeout(function() {
                deleteServiceRow(rowcount);
                deleteServiceRow(rowcount);
          }, 1000);
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
      // alert(groupid)
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
      let add_disc=$('#serviceDisc'+count).val();
      let gstvalue=$('#cgst_'+count).val();
      var gst = gstvalue.split('/');
      var vcgst = gst[0];
      var vsgst = gst[1];
      var gstdiscount = gst[2];
      if (add_disc==0) {
        var sgst = vsgst?vsgst:0;
        var cgst = vcgst?vcgst:0;
        var disc = $("#serviceAdd"+count).val();
        if(disc==''){disc=0;}
        var price = $("#servicePriceActualRate"+count).val();
        if(price==''){price=0;}
        var qty = $("#serviceQty"+count).val();
        if(qty==''){qty=0;}
        var total = parseFloat(price) * parseFloat(qty);
        // var totaldiscount = (parseFloat(total).toFixed(2) * parseFloat(disc).toFixed(2))/100;
        if(gstdiscount!=0){
          var gstdiscount = (parseFloat(total) * parseFloat(gstdiscount))/100;
        }
        var totaldiscount= parseFloat(disc)+parseFloat(gstdiscount);
        total = parseFloat(total) + parseFloat(totaldiscount);
        // total = parseFloat(total) + parseFloat(totaldiscount);
        $("#servicePriceTotal"+count).val(parseFloat(total).toFixed(2));
        var totalsgst = (parseFloat(total) * parseFloat(sgst))/100;
        var totalcgst = (parseFloat(total) * parseFloat(cgst))/100;
        total = parseFloat(total) + parseFloat(totalsgst) + parseFloat(totalcgst);
        $("#serviceTotal"+count).val(parseFloat(total).toFixed(2));
        $("#servicePrice"+count).val(parseFloat(price).toFixed(2));
        /*$("#totalsgstval").html(parseFloat(totalsgst));
        $("#totalcgstval").html(parseFloat(totalcgst));*/
        $("#servicesSgst"+count).val(parseFloat(totalsgst).toFixed(2));
        $("#servicesCgst"+count).val(parseFloat(totalcgst).toFixed(2));
        $("#servicesgstdiscount"+count).val(parseFloat(gstdiscount).toFixed(2));
        calculatecash();
      }
      else{
        $('#serviceAdd'+count).val(0);
      }
    }

    function calcutateDiscount(count) {
      let add_disc=$('#serviceAdd'+count).val();
      let gstvalue=$('#cgst_'+count).val();
      var gst = gstvalue.split('/');
      var vcgst = gst[0];
      var vsgst = gst[1];
      var gstdiscount = gst[2];


      if (add_disc==0) {
        var sgst = vsgst?vsgst:0;
        var cgst = vcgst?vcgst:0;
        var disc = $("#serviceDisc"+count).val();
        // alert(disc);
        if((disc=='')||(disc==undefined)||(disc==null)){disc=0;}
        var price = $("#servicePrice"+count).val();
        if(price==''){price=0;}
        var qty = $("#serviceQty"+count).val();
        if(qty==''){qty=0;}
        var total = parseFloat(price) * parseFloat(qty);
        // var totaldiscount = (parseFloat(total).toFixed(2) * parseFloat(disc).toFixed(2))/100;
        if(gstdiscount!=0){
          var gstdiscount = (parseFloat(total) * parseFloat(gstdiscount))/100;
        }
        var totaldiscount= parseFloat(disc)+parseFloat(gstdiscount);
        total = parseFloat(total) - parseFloat(totaldiscount);
        $("#servicePriceTotal"+count).val(parseFloat(price).toFixed(2));
        var totalsgst = (parseFloat(total) * parseFloat(sgst))/100;
        var totalcgst = (parseFloat(total) * parseFloat(cgst))/100;
        total = parseFloat(total) + parseFloat(totalsgst) + parseFloat(totalcgst);
        $("#serviceTotal"+count).val(parseFloat(total).toFixed(2));
        /*$("#totalsgstval").html(parseFloat(totalsgst));
        $("#totalcgstval").html(parseFloat(totalcgst));*/
        $("#servicesSgst"+count).val(parseFloat(totalsgst).toFixed(2));
        $("#servicesCgst"+count).val(parseFloat(totalcgst).toFixed(2));
        $("#servicesgstdiscount"+count).val(parseFloat(gstdiscount).toFixed(2));
        // alert(total);
        calculatecash();
      }
      else{
        $('#serviceDisc'+count).val(0);
      }
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

    function deleteServiceRow(del_ser_count) {
      // alert('asd');
      $('#rowcount'+del_ser_count).remove();
    //   $("#serviceDiv").children().last().remove();
      if ($(".servicerow").length == 0) {
        $(".serviceDivider").hide();
      }

      $("#serviceDiv").append('<div class="deleted servicerow"></div>');
      calculatecash();
    }

    function deletepackServiceRow(del_row_count) {
      // alert('asd');
      $("#packserviceDiv"+del_row_count).remove();
      if ($(".servicerow").length == 0) {
        $(".serviceDivider").hide();
      }
      calculatecash();
    }

    function deleteMakeupServiceRow(del_row_count) {
      // alert('asd'); deleteMakeupServiceRow
      $("#makeupserviceDiv"+del_row_count).remove();
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
          data:{'number':number},
          dataType:'JSON',
          success:function(res) {
            if (res != "" && res != null) {
              $("#contact").val(number);
              $("#usermobile_no").val(number);
              $("#customer_ids").val(res.last_id);
              $("#referral_code").val(res.last_id);
              $("#otps").val(res.otp);
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
              console.log('-----new num-------');

            }
            //searchnumber
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
              $("#sittingpackdiv").show();
              $("#giftpointdiv").show();
              $("#walletdiv").show();
              $("#remarkdiv").show();
              $("#customerRemark").val(res.remarks);
              $("#sittingpackShow").html(res.sum_of_sittingPack);
              if(res.sum_of_sittingPack>0){
                $('#btn_getcustomersittingpackdetails').show();
                // $('#btn_sittingpackotp').show();
              }
              $("#totalgiftpointShow").html(res.sum_of_points);
              console.log(res.sum_of_points);
              if(!(res.sum_of_points))
              {
                $("#totalgiftpointShow").html(0);
              }
              // totalwalletShow
              $("#totalwalletShow").html(res.sum_of_wallet);
              console.log(res.sum_of_wallet);
              if(!(res.sum_of_wallet))
              {
                $("#totalwalletShow").html(0);
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
              $("#walletdiv").hide();
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
        $("#walletdiv").hide();
        $("#remarkdiv").hide();
        $("#unpaidbtndiv").hide();
        $("#unpaidbtn").html('');
      }
    }

    function skip(){
     // location.reload(true);
     console.log('-------SKIP---------');
     var number =  $("#searchnumber").val();
     console.log('-----------'+number);
     $("#addcustomer").modal('hide');
     $("#saveotpModelsssssss").modal('hide');
     checkaccount(number);

    }

    function saveotp() {
       var otp =  $("#otp").val();
       var number =  $("#usermobile_no").val();


            $.ajax({
                url:'{{ url("checkotp") }}',
                data:{'otp':otp,'number':number},
                type:'POST',
                success:function(res) {
                if(res=='yes'){
                  alert('Mobile number verified');
                  $("#saveotpModelsssssss").modal('hide');
                  checkaccount(number);
                  //location.reload(true);
                }else{
                  alert('OTP is not Correct');
                }
                }
              });
        }

    function sendotp() {
       var number =  $("#usermobile_no").val();
      //  alert(number);
        let usedfor='new_cust';
        if (number) {
          if ( number.length == 10  ){
            $.ajax({
                url:'{{ url("sendotp") }}',
                data:{'number':number,'usedfor':usedfor},
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

    function resendotp() {
       var number =  $("#usermobile_no").val();
       var token = '{{ csrf_token() }}';
        if (number) {
          if ( number.length == 10  ){
            $.ajax({
                url:'{{ url("resendotp") }}',
                data:{'number':number,'_token':token},
                type:'POST',
                success:function(res) {

                  //console.log(res);
                    if(res==1){
                      alert('Otp send successfully');
                    }else{
                      alert('Otp not send');
                    }
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

  function send_remain_giftpoint_bal(deduct_point,pending_point) {
      // alert(pending_point);
       var number =  $("#searchnumber").val();
       let usedfor= 'giftpoint_remain';
        if (number) {
          if ( number.length == 10  ){
            $.ajax({
                url:'{{ url("sendotp") }}',
                data:{'number':number,'usedfor':usedfor,'deduct_point':deduct_point,'pending_point':pending_point},
                type:'POST',
                success:function(res) {
                  console.log(res);
                  alert('giftpoint amount adjusted');
                }
              });
          }
          else{
            alert("Enter Valid Mobile number !");
          }

          }
        else{
          alert("Enter Mobile number to Verify !");
        }
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
        let pending_gft_point=old_points-point_to_be_cut;
        send_remain_giftpoint_bal(point_to_be_cut,pending_gft_point);
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
    console.log('-----------total_amt---------');
    console.log(total_amt);
    if(!isNaN(total_amt))
    {
      let sum=0;
      let subtotal=0;
      let allow_redeem_points=0;
      let valid_points=0;
      let gift_points='';
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
                // $('.countTotal').each(function() {
                //   subtotal += parseFloat(this.value);
                  // $("#subtotal").html(parseFloat(subtotal-gift_points).toFixed(2));
                  // $("#subtotalamount").val(parseFloat(subtotal-gift_points).toFixed(2));
                // });
                // $('.totalprice').each(function(){
                //   sum += parseFloat(this.value);  // Or this.innerHTML, this.innerText
                  sum = $("#totalgrandTotal").val();
                  valid_points=parseFloat((sum*allow_redeem_points)/100);
                  valid_points=valid_points.toFixed(2);
                  $('#redeem_point').html(valid_points);
                  if($("#allow_gift_points").is(':checked'))
                  {
                    gift_points=$('#redeem_point').html();
                    gift_points=parseFloat(gift_points);
                    $('#totalredeempoint').val(gift_points);
                    // gift_point_sms(gift_points);
                  }
                // });
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

    function gift_point_sms(more_gift_points) {
       var number =  $("#searchnumber").val();
       let usedfor='add_gift_points';
        if (number) {
          if ( number.length == 10  ){
            $.ajax({
                url:'{{ url("sendotp") }}',
                data:{'number':number,'usedfor':usedfor,'more_gift_points':more_gift_points},
                type:'POST',
                success:function(res) {
                  console.log(res);
                  console.log('Gift Points Added Successfully');
                  // $('#opt_for_giftpoint').modal('show');
                }
              });
          }
          else{
            alert("Enter Valid Mobile number !");
          }

          }
        else{
          alert("Enter Mobile number to Verify !");
        }
    }

    $('#allow_gift_points').click(function() {
      // alert('test');
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
    function get_invoice_type(){
      // $("#addfirm").modal('hide');
      $('#getInvoiceType').modal('show');

      var dataString = $('#quicksaleForm').serialize();

      $.ajax({
            type: "POST",
            url:'{{ url("quicksalepopupdata") }}',
            data: dataString,
            cache: false,
            dataType: "json",
            success: function(result){
              //console.log(result);

            }//end sucess
      });//end ajax

    }

    </script>

    <script>
      function set_Invoice_Type(){
        localStorage.clear();
      let set_Invoice_type_value = $('#setInvoiceType').find(":selected").val();
      //console.log(set_Invoice_type_value);
      localStorage.removeItem('sitting_pack_final_price');
      if(set_Invoice_type_value=='Bill with amount')
      {
        if($("#allow_gift_points").is(':checked'))
          {
            gift_points=$('#redeem_point').html();
            gift_points=parseFloat(gift_points);
            // $('#totalredeempoint').val(gift_points);
            gift_point_sms(gift_points);
          }
        $("#withamountinvoice").click();
        // $('#getInvoiceType').modal('hide');
        // location.reload();
      }
      else if(set_Invoice_type_value=='Bill without amount'){
        if($("#allow_gift_points").is(':checked'))
          {
            gift_points=$('#redeem_point').html();
            gift_points=parseFloat(gift_points);
            // $('#totalredeempoint').val(gift_points);
            gift_point_sms(gift_points);
          }
        $("#withoutamountinvoice").click();
      }
      else if(set_Invoice_type_value=='Send via SMS'){
        $("#withsendviasms").click();
      }
      else{
        alert('please select correct option');
        // $('#getInvoiceType').modal('hide');
      }
    }

    function send_otp_point() {
       var number =  $("#searchnumber").val();
       let usedfor='giftpoint';
        if (number) {
          if ( number.length == 10  ){
            $.ajax({
                url:'{{ url("sendotp") }}',
                data:{'number':number,'usedfor':usedfor},
                type:'POST',
                success:function(res) {
                  console.log(res);
                  $('#opt_for_giftpoint').modal('show');
                }
              });
          }
          else{
            alert("Enter Valid Mobile number !");
          }

          }
        else{
          alert("Enter Mobile number to Verify !");
        }
    }

    function match_otp_with_db() {
       var number =  $("#searchnumber").val();
       var user_otp =  $("#gift_point_otp").val();
          if ( user_otp!="" ){
            $.ajax({
                url:'{{ url("otp_verify_points") }}',
                data:{"_token": "{{ csrf_token() }}",'contact':number,'otp':user_otp},
                type:'POST',
                success:function(res) {
                  console.log(res);
                  $('#opt_for_giftpoint').modal('hide');
                  var result=(JSON.parse(res));
                  if(result.msg==true){
                    $("#gift_points").prop('readonly', false);
                  }
                  else{
                    alert('Invalid OTP');
                  }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                // document.getElementById("download_Report").style.display="none";
                alert('Something went wrong in opt varification');
                }
              });
          }
    }

    function addWalletBalance() {
      $('#add_wallet').modal('show');
    }

    function add_wallet_amt(wallet_amount) {
       var number =  $("#searchnumber").val();
       let usedfor='addwallet';
        if (number) {
          if ( number.length == 10  ){
            $.ajax({
                url:'{{ url("sendotp") }}',
                data:{'number':number,'usedfor':usedfor,'wallet_amount':wallet_amount},
                type:'POST',
                success:function(res) {
                  console.log(res);
                  alert('Amount Added Successfully');
                  // $('#opt_for_giftpoint').modal('show');
                }
              });
          }
          else{
            alert("Enter Valid Mobile number !");
          }

          }
        else{
          alert("Enter Mobile number to Verify !");
        }
    }

    function save_wallet_amount() {
      let customer_id =  $("#customer_id").val();
      if(customer_id!="")
      {
        let wallet_amount= $('#wallet_amount').val();
        if(wallet_amount!="")
        {
          let amount_used=0;
          let invoice_id=0;
            $.ajax({
                url:'{{ url("add_customer_wallet") }}',
                data:{"_token": "{{ csrf_token() }}",'amount_allow':wallet_amount,'customer_id':customer_id,'amount_used':amount_used,'invoice_id':invoice_id},
                type:'POST',
                success:function(res) {
                  console.log(res);
                  var result=(JSON.parse(res));
                  if(result.msg==true){
                    add_wallet_amt(wallet_amount);

                  }
                  else{
                    alert('Amount Not Added');
                  }
                  $('#add_wallet').modal('hide');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                // document.getElementById("download_Report").style.display="none";
                alert('Something went wrong in adding wallet amount');
                }
              });
        }
        else{
          alert('Please enter some amount');
        }
      }
      else{
        alert('Please select customer');
      }
    }

    function send_otp_wallet() {
       var number =  $("#searchnumber").val();
       let usedfor= 'walletotp';
        if (number) {
          if ( number.length == 10  ){
            $.ajax({
                url:'{{ url("sendotp") }}',
                data:{'number':number,'usedfor':usedfor},
                type:'POST',
                success:function(res) {
                  console.log(res);
                  $('#opt_for_wallet').modal('show');
                }
              });
          }
          else{
            alert("Enter Valid Mobile number !");
          }

          }
        else{
          alert("Enter Mobile number to Verify !");
        }
    }

    function match_wallet_otp_with_db() {
       var number =  $("#searchnumber").val();
       var user_otp =  $("#wallet_otp").val();
          if ( user_otp!="" ){
            $.ajax({
                url:'{{ url("otp_verify_points") }}',
                data:{"_token": "{{ csrf_token() }}",'contact':number,'otp':user_otp},
                type:'POST',
                success:function(res) {
                  console.log(res);
                  $('#opt_for_wallet').modal('hide');
                  var result=(JSON.parse(res));
                  if(result.msg==true){
                    $("#cust_wallet").prop('readonly', false);
                  }
                  else{
                    alert('Invalid OTP');
                  }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                // document.getElementById("download_Report").style.display="none";
                alert('Something went wrong in opt varification');
                }
              });
          }
    }

    function send_remain_wallet_bal(deduct_amt,pending_amt) {
      // alert(pending_amt);
       var number =  $("#searchnumber").val();
       let usedfor= 'wallet_remain';
        if (number) {
          if ( number.length == 10  ){
            $.ajax({
                url:'{{ url("sendotp") }}',
                data:{'number':number,'usedfor':usedfor,'deduct_amt':deduct_amt,'pending_amt':pending_amt},
                type:'POST',
                success:function(res) {
                  console.log(res);
                  alert('Wallet amount adjusted');
                }
              });
          }
          else{
            alert("Enter Valid Mobile number !");
          }

          }
        else{
          alert("Enter Mobile number to Verify !");
        }
    }

    function checkcustomerwallet(curr_wallet){
    let old_wallet=0;
    let subtotal=0;
    let sum=0;
    let point_to_be_cut=0;
    DBcustomerWallet=$('#totalwalletShow').html();
    console.log(DBcustomerWallet);
    if((DBcustomerWallet!="")||(DBcustomerWallet!=0))
    {
      old_wallet=parseFloat(DBcustomerWallet);
      curr_wallet=parseFloat(curr_wallet);
      if(old_wallet>=curr_wallet)
      {
        total_flag2=false;
        // $('#gift_points').val(curr_wallet);
        point_to_be_cut=$('#cust_wallet').val();
        console.log(point_to_be_cut);
        subtotal=parseFloat($("#subtotalamount").val());
        $("#subtotal").html(parseFloat(subtotal-point_to_be_cut).toFixed(2));
        $("#subtotalamount").val(parseFloat(subtotal-point_to_be_cut).toFixed(2));
        sum=parseFloat($("#totalgrandTotal").val());
        $("#grandtotal").html(parseFloat(sum-point_to_be_cut).toFixed(2));
        $("#totalgrandTotal").val(parseFloat(sum-point_to_be_cut).toFixed(2));
        let remain_wallet=old_wallet-point_to_be_cut;
        // alert(remain_wallet);
        send_remain_wallet_bal(point_to_be_cut,remain_wallet);
        // $('.countTotal').each(function() {
        //   subtotal += parseFloat(this.value);
        //   $("#subtotal").html(parseFloat(subtotal-point_to_be_cut).toFixed(2));
        //   $("#subtotalamount").val(parseFloat(subtotal-point_to_be_cut).toFixed(2));
        // });
        // $('.totalprice').each(function(){
        //   sum += parseFloat(this.value);  // Or this.innerHTML, this.innerText
        //   // console.log(sum);
        //   $("#cashpay").html(parseFloat(sum-point_to_be_cut).toFixed(2));
        //   $("#grandtotal").html(parseFloat(sum-point_to_be_cut).toFixed(2));
        //   $("#totalgrandTotal").val(parseFloat(sum-point_to_be_cut).toFixed(2));
        // });
      }
      else{
        alert('Please Enter Amount Under Limit');
        $('#cust_wallet').val(0);
      }
    }
    else{
      alert('Not allowed');
      $('#totalwalletShow').html(0);
      $('#cust_wallet').val(0);
    }
  }

  function get_combo_details(){
    // alert('getcombodata');
    $.ajax({
        url:'{{ url("getAllCombo") }}',
        type:'GET',
        success:function(res) {
          console.log(res);
          // $('#opt_for_wallet').modal('show');
          var result=(JSON.parse(res));
            // $("#combo_body").html(result.data.html);
            // $('#combo_details').modal('show');
          if(result.msg==true){
            $("#combo_body").html(result.data.html);
            $('#combo_details').modal('show');
            // alert('all combo Found');
          }
          else{
            alert('No combo Found');
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
        // document.getElementById("download_Report").style.display="none";
        alert('Something went wrong in getAllCombo');
        }
      });
  }

  function getComboDetails(combo_id)
  {
    // alert(combo_id);
    let combo_price=0;
    if(combo_id!="")
    {
      $.ajax({
        url:'{{ url("getComboService") }}',
        data:{"_token": "{{ csrf_token() }}",'combo_id':combo_id},
        type:'POST',
        success:function(res) {
          console.log(res);
          var result=(JSON.parse(res));
          console.log(result.data);
          result.data.forEach((element,index) => {
            // console.log(index); $("#salesrep").val("Bruce Jones");  firmid
            console.log(element.service_id);
            console.log('-----set value------');
            addServiceRow();
            $('.totalprice').addClass('comboprice').removeClass('totalprice');
            $('.countTotal').addClass('comboTotal').removeClass('countTotal');
            $('#groupidfirm_'+index).val(element.firmid);
            $('#brand_'+index).val(element.service_brand_id);
            $('#services_'+index).val(element.brand_id);
            $('#servicegroups_'+index).val(element.service_id);
            $('#serviceName'+index).val(element.brand_name);
            $('#serviceQty'+index).val(element.quantity);
            $('#servicePrice'+index).val(element.price);
            $('#serviceDisc'+index).val(0);
            $('#serviceAdd'+index).val(0);
            $('#serviceTotal'+index).val(element.total_price);
            $('#servicesSgst'+index).val(0);
            $('#servicesCgst'+index).val(0);
            $('#servicePriceActualRate'+index).val(0);
            $('#servicePriceTotal'+index).val(element.total_price);
            localStorage.setItem('combo_price', element.combo_price);
          });
          calculatecash();
          $("#serviceRowCount").val(($(".servicerow").length)+1);
          combo_price=localStorage.getItem('combo_price');
          $("#subtotal").html(parseFloat(combo_price).toFixed(2));
          $("#subtotalamount").val(parseFloat(combo_price).toFixed(2));
          $("#cashpay").html(parseFloat(combo_price).toFixed(2));
          $("#grandtotal").html(parseFloat(combo_price).toFixed(2));
          $("#totalgrandTotal").val(parseFloat(combo_price).toFixed(2));
          $("#remark").val(`Rs ${combo_price} Combo price applied`);
          combo_flag=true;


          // $('#opt_for_wallet').modal('show');
          // var result=(JSON.parse(res));
            // $("#combo_body").html(result.data.html);
            // $('#combo_details').modal('show');
          // if(result.msg==true){
          //   $("#combo_body").html(result.data.html);
          //   $('#combo_details').modal('show');
          //   // alert('all combo Found');
          // }
          // else{
          //   alert('No combo Found');
          // }
        },
        error: function(jqXHR, textStatus, errorThrown) {
        // document.getElementById("download_Report").style.display="none";
        alert('Something went wrong in getComboService');
        }
      });
    }
  }

  function checkcombo(){
    let combo_subtotal=0;
    let combo_total=0;
    let combo_price=0;
    combo_price=localStorage.getItem('combo_price');
    combo_subtotal=$("#subtotalamount").val();
    combo_total=$("#totalgrandTotal").val();
    console.log('combo_subtotal'+combo_subtotal);
    console.log('combo_total'+combo_total);
    $("#subtotal").html(parseFloat(parseFloat(combo_subtotal)+parseFloat(combo_price)).toFixed(2));
    $("#subtotalamount").val(parseFloat(parseFloat(combo_subtotal)+parseFloat(combo_price)).toFixed(2));
    $("#cashpay").html(parseFloat(parseFloat(combo_total)+parseFloat(combo_price)).toFixed(2));
    $("#grandtotal").html(parseFloat(parseFloat(combo_total)+parseFloat(combo_price)).toFixed(2));
    $("#totalgrandTotal").val(parseFloat(parseFloat(combo_total)+parseFloat(combo_price)).toFixed(2));
    $("#remark").val(`Rs ${combo_price} Combo price applied`);
  }

  var dynamic_rowcount = 0;
    function addSittingPackageRow() {
      $("#packageDiv").append('<div class="row packageRow"><div class="col-lg-3 col-md-12 col-12"><div class="form-group"><label>Package</label><select required name="package_'+ dynamic_rowcount +'" class="form-control" onchange="showSittingServices(this.value,'+ dynamic_rowcount +')"><option value="">Select</option><?php if (!empty($sitting_packs)): ?><?php foreach ($sitting_packs as $sitting_pack): ?><option value="{{ $sitting_pack->id }}">{{ $sitting_pack->pack_name }}</option><?php endforeach?><?php endif?></select></div>  </div> <div class="col-lg-2 col-md-6 col-12"><div class="form-group"><label>Price <i class="fa fa-inr"></i></label><input name="pacakgePrice[]" type="text" class="form-control appendfocus" placeholder="" id="pacakgePrice'+ dynamic_rowcount +'"></div></div>  <div class="col-lg-1 col-md-6 col-12"><div class="form-group"><label style="display: block; visibility: hidden;">-</label><input name="packageAdvancePayment[]" type="hidden" readonly class="form-control" id="packageAdvancePayment'+ dynamic_rowcount +'"></div></div> <div class="col-lg-1 col-md-6 col-12"><div class="form-group"><label style="display: block; visibility: hidden;">Total</label><a href="javascript:void(0)" class="btn btn-danger" onclick="deletePackageRow(this)"><i class="fa fa-trash-o mt-2"></i></a></div></div><div class="col-lg-1 col-md-6 col-12"><div class="form-group"><label style="display: block; visibility: hidden;">-</label><a href="javascript:void(0)" class="btn btn-info ml-2" onclick="showsitpackdatetime()" id="btn_sitpackdatetimebox"><i class="fa fa-eye"></i></a></div></div> <div class="col-lg-1 col-md-6 col-12"><div class="form-group"><label style="display: block; visibility: hidden;">Contacts</label><a href="javascript:void(0)" class="btn btn-warning" onclick="assignsitpacktocustomer()" id="btn_sitpackcontacts" style="display:none;"><i class="fa fa-plus">Members</i></a></div></div><div class="col-lg-1 col-md-6 col-12"> <div class="form-group"> <label style="display: block; visibility: hidden;">-</label> <a href="javascript:void(0)" class="theme-btn ml-3" onclick="addMakeupRow()" id="btn_addmakeuprow" style="display:none;"> <i class="fa fa-plus">Makeup</i> </a> </div> </div></div></div><div class="row dynamic_ddlrow" id="sittingpackageServiceRow'+ dynamic_rowcount +'"></div><div class="row dynamic_ddlrow" id="sittingpackageMakeUpServiceRow'+ dynamic_rowcount +'"></div>');
      if ($(".packageRow").length == 1) {
        $(".packageDivider").show();
      }
      $("#sitpackageRowCount").val($(".packageRow").length);
      dynamic_rowcount++;
      $('#packageDiv').children().last().prev().find('.appendfocus').focus();
    }

    function showsitpackdatetime(){
      let packupdatedvalue=$('#subtotalamount').val();
      if((packupdatedvalue!='')||(packupdatedvalue!=0)){
        $('#pacakgePrice0').val(packupdatedvalue);
        $('#sit_pack_total_price').val(packupdatedvalue);
      }

      var pack_makeups=document.getElementsByName('pack_makeups[]');
      var makeupPayment=document.getElementsByName('makeupPayment[]');
      if(pack_makeups.length!=makeupPayment.length){
        let more_makeup_rounds=((makeupPayment.length)-(pack_makeups.length));
        // add more makeup rows
        let mindex=(pack_makeups.length)-1;
        for (let mkp_round = 0; mkp_round < more_makeup_rounds; mkp_round++) {
          mindex+=1;
          pack_makeup_row=`<div class="row" id="pack_makeuprow${mindex}">
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label class="control-label" for="name">MakeUp ${mindex+1} <span class="required">*</span> </label>
                                        <input type="text"  id="pack_makeups${mindex+1}" name="pack_makeups[]" placeholder="sit pack makeup"  class="form-control" autocomplete="off" onchange="checksitpacktotal()">
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label class="control-label" for="name">Date for Makeup ${mindex+1} <span class="required">*</span> </label>
                                      <div class="input-group mb-3">
                                          <input id="makeup_date${mindex+1}" name="makeup_date" required="" type="text" class="form-control sittingdatepicker" placeholder=""  >
                                          <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                          </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label class="control-label" for="name">Time for Makeup ${mindex+1} <span class="required">*</span> </label>
                                      <div class="input-group mb-3">
                                          <input id="makeup_time${mindex+1}" name="makeup_time" required="" type="text" class="form-control sittingtimepicker" placeholder=""  >
                                          <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                                          </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                `;
              $('#sitpack_makeups').append(pack_makeup_row);
        }
      }
      $( ".sittingdatepicker" ).datepicker({
      format: 'dd-mm-yyyy',
      todayHighlight: true
      });
      $( ".sittingtimepicker" ).timepicker();
      $('#add_sitting_pack_installments').modal('show');
    }

    function showSittingServices(sitpackageid,count){
      if(sitpackageid!='')
      {
        // alert(sitpackageid);
        localStorage.setItem('sitpackageid', sitpackageid);
        console.log(count);
        $("#sittingpackageServiceRow"+count).html('');
        $.ajax({
        url:'{{ url("getSittingPack") }}',
        type:'POST',
        data:{"_token": "{{ csrf_token() }}",'sit_pk_id':sitpackageid},
        success:function(res) {
          console.log('-------------sitting round---------------');
          console.log(res);
          var result=(JSON.parse(res));
          if(result.msg==true){
            $('#btn_sitpackcontacts').show();
            $('#btn_addmakeuprow').show();
            $("#sittingpackageServiceRow"+count).html(result.data);
            $("#sittingpackageMakeUpServiceRow"+count).html(result.makeupdata);
            $('#pacakgePrice'+count).val(result.sitting_pack_data.pack_final_price);
            sitpackinstallments(sitpackageid);
            // calculatesitpackinstallment();
          }
          else{
            alert('No Bridal pack Found');
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
        alert('Something went wrong in showSittingServices');
        }
      });

      }
      else{
        alert("Package not selected")
      }
    }

    function sitpackinstallments(sitpackageid) {
      let pack_installments='';
      // $('#add_sitting_pack_installments').modal('show');
      $.ajax({
        url:'{{ url("getSittingInstallments") }}',
        type:'POST',
        data:{"_token": "{{ csrf_token() }}",'sit_pk_id':sitpackageid},
        success:function(res) {
          console.log(res);
          var result=(JSON.parse(res));
          if(result.msg==true){
            result.data.forEach((element,index) => {
              pack_installments=`<div class="row" id="pack_installmentrow${index}">
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label class="control-label" for="name">Installment ${index+1} <span class="required">*</span> </label>
                                        <input type="text"  id="pack_installments${index+1}" name="pack_installments[]" placeholder="sit pack installments"  class="form-control" autocomplete="off" onchange="checksitpacktotal()">
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label class="control-label" for="name">Date for Sitting ${index+1} <span class="required">*</span> </label>
                                      <div class="input-group mb-3">
                                          <input id="sitting_date${index+1}" name="sitting_date" required="" type="text" class="form-control sittingdatepicker" placeholder=""  >
                                          <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                          </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label class="control-label" for="name">Time for Sitting ${index+1} <span class="required">*</span> </label>
                                      <div class="input-group mb-3">
                                          <input id="sitting_time${index+1}" name="sitting_time" required="" type="text" class="form-control sittingtimepicker" placeholder=""  >
                                          <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                                          </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                `;
              $('#sitpack_installments').append(pack_installments);
            });
            result.makeup_data.forEach((melement,mindex) => {
              pack_makeups=`<div class="row" id="pack_makeuprow${mindex}">
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label class="control-label" for="name">MakeUp ${mindex+1} <span class="required">*</span> </label>
                                        <input type="text"  id="pack_makeups${mindex+1}" name="pack_makeups[]" placeholder="sit pack makeup"  class="form-control" autocomplete="off" onchange="checksitpacktotal()">
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label class="control-label" for="name">Date for Makeup ${mindex+1} <span class="required">*</span> </label>
                                      <div class="input-group mb-3">
                                          <input id="makeup_date${mindex+1}" name="makeup_date" required="" type="text" class="form-control sittingdatepicker" placeholder=""  >
                                          <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                          </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label class="control-label" for="name">Time for Makeup ${mindex+1} <span class="required">*</span> </label>
                                      <div class="input-group mb-3">
                                          <input id="makeup_time${mindex+1}" name="makeup_time" required="" type="text" class="form-control sittingtimepicker" placeholder=""  >
                                          <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                                          </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                `;
              $('#sitpack_makeups').append(pack_makeups);
            });
            $( ".sittingdatepicker" ).datepicker({
              format: 'dd-mm-yyyy',
              todayHighlight: true
            });
            $( ".sittingtimepicker" ).timepicker();
            $('#sit_pack_total_price').val(result.pack_final_price);
            $('#sit_pack_adv_payment').val((result.pack_final_price)/2);
            calculate_sitpack_installment();
            $('#add_sitting_pack_installments').modal('show');
          }
          else{
            alert('No Bridal pack installment Found');
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
        alert('Something went wrong in sitpackinstallments');
        }
      });
    }

    function calculate_sitpack_installment(){
      let sit_pack_total_price=0;
      let sit_pack_advance=0;
      let installment_amt=0;
      sit_pack_total_price=$('#sit_pack_total_price').val();
      sit_pack_advance=$('#sit_pack_adv_payment').val();
      // alert('calculate_sitpack_installment');
      let paid_amt=0;
      let remain_amt=0;
      var totalinstallment = document.getElementsByName('pack_installments[]');
      var makeuppayments=document.getElementsByName('pack_makeups[]');
      let makeup_count=makeuppayments.length;
      installment_amt=parseFloat(sit_pack_total_price)-parseFloat(sit_pack_advance);
      let installment_count=totalinstallment.length;
      for(var i=1;i<=totalinstallment.length;i++){
        $('#pack_installments'+i).val(Math.round(installment_amt/(installment_count+makeup_count)));
        paid_amt=parseFloat(paid_amt)+parseFloat($('#pack_installments'+i).val());
     }

     remain_amt=parseFloat(sit_pack_total_price)-(parseFloat(sit_pack_advance)+parseFloat(paid_amt));
     for(var k=1;k<=makeuppayments.length;k++){
        $('#pack_makeups'+k).val(Math.round(remain_amt/(makeup_count)));
        paid_amt=parseFloat(paid_amt)+parseFloat($('#pack_makeups'+k).val());
        console.log('----------------paid_amt');
        console.log(paid_amt);
     }
     if((parseFloat(paid_amt)+parseFloat(sit_pack_advance))!=parseFloat(sit_pack_total_price))
      {
        let extra_paid=(parseFloat(sit_pack_advance)+parseFloat(paid_amt))-parseFloat(sit_pack_total_price);
        let last_pay=$('#pack_makeups'+(makeuppayments.length)).val();
        console.log('----------------extra_paid');
        console.log(extra_paid);
        console.log('----------------last_pay');
        console.log(last_pay);
        $('#pack_makeups'+(makeuppayments.length)).val(parseFloat((last_pay)-parseFloat(extra_paid)));
      }
    }

    function checksitpacktotal(){
      let sitpacktot=0;
      let sit_pack_final_price=0;
      let adv_pay=0;
      sit_pack_final_price=$('#sit_pack_total_price').val();
      adv_pay=$('#sit_pack_adv_payment').val();
      var packtotalinstallment = document.getElementsByName('pack_installments[]');
      var makeuppayments=document.getElementsByName('pack_makeups[]');
      let payment_last=parseInt(packtotalinstallment.length);
      let makeup_last=parseInt(makeuppayments.length);
      for(var i=1;i<=packtotalinstallment.length;i++){
        sitpacktot += parseFloat(packtotalinstallment[i].value);
     }
     for(var j=1;j<=makeuppayments.length;j++){
        sitpacktot += parseFloat(makeuppayments[j].value);
     }
     sitpacktot=parseFloat(sitpacktot)+parseFloat(adv_pay);
     console.log(sit_pack_final_price);
     console.log(sitpacktot);
     if(parseFloat(sit_pack_final_price)==parseFloat(sitpacktot)){
       console.log('Installment correct');
     }
     else{
       alert('Installment not correct');
       $('#pack_installments'+payment_last).val(0);
       $('#pack_makeups'+makeup_last).val(0);
     }
    }

  // function getallsittingpackdetails(){
  //   $.ajax({
  //       url:'{{ url("getAllSittingPack") }}',
  //       type:'GET',
  //       success:function(res) {
  //         console.log(res);
  //         var result=(JSON.parse(res));
  //         if(result.msg==true){
  //           $("#sitting_pack_body").html(result.data.html);
  //           $('#sitting_pack_details').modal('show');
  //           // alert('all sitting pack Found');
  //         }
  //         else{
  //           alert('No sitting pack Found');
  //         }
  //       },
  //       error: function(jqXHR, textStatus, errorThrown) {
  //       alert('Something went wrong in getAllSittingPack');
  //       }
  //     });
  // }

  function assignsitpacktocustomer()
  {
    let total_members=0;
    let memders_data='';
    let pack_mem_count=0;
    let k=0;
    let sit_pk_id=localStorage.getItem('sitpackageid');
    var number =  $("#searchnumber").val();
        if (number) {
          if ( (number.length == 10) &&(sit_pk_id !="")  ){
            $.ajax({
              url:'{{ url("beforeAssignSittingPackdata") }}',
              data:{"_token": "{{ csrf_token() }}",'sit_pk_id':sit_pk_id},
              type:'POST',
              success:function(res) {
                console.log(res);
                var result=(JSON.parse(res));
                if(result.msg==true){
                  // $("#sitting_pack_body").html(result.data.html);
                  localStorage.removeItem('sitpackageid');
                  $('#selected_sitting_pack_id').val(sit_pk_id);
                  $('#reg_customer').val(number);
                  $('#sitting_pack_details').modal('hide');
                  $('#add_sitting_pack_members').modal('show');
                  total_members=result.data.total_members;
                  let head_msg=`<div class='container'><h6>This pack can used by ${total_members} members</h6></div>`;
                  $('#members_head').append(head_msg);
                  members_data=`<div class="row" id="pack_mem_count${pack_mem_count}">
                                <div class="col-md-5">
                                  <div class="form-group">
                                    <label class="control-label" for="name">Name <span class="required">*</span> </label>
                                      <input type="text"  id="member_name" name="member_name[]" placeholder="Enter name"  class="form-control" autocomplete="off">
                                  </div>
                                </div>
                                <div class="col-md-5">
                                  <div class="form-group">
                                    <label class="control-label" for="mobile">Mobile <span class="required">*</span> </label>
                                      <input type="text"  id="member_mobile" name="member_mobile[]" placeholder="Enter Mobile"  class="form-control" autocomplete="off">
                                  </div>
                                </div>
                                <div class="col-lg-2 col-md-12 col-12">
                                  <div class="form-group">
                                    <label>.</label>
                                    <div class="input-group mb-3">
                                      <button type="button" class="btn btn-danger" onclick="removepackmembers(${pack_mem_count})"><i class="fa fa-minus"></i></button>
                                    </div>
                                  </div>
                                </div>
                                </div>
                                `;
                for (k = 0; k < total_members; k++) {
                  pack_mem_count=k+1;
                    $('#members_contacts').append(members_data);
                    // console.log('deepshikha');
                  }
                }
                else{
                  alert('No Bridal pack Found');
                }
              },
              error: function(jqXHR, textStatus, errorThrown) {
              alert('Something went wrong in assignsitpacktocustomer');
              }
            });
          }
          else{
            alert("Enter Valid Mobile number !");
          }

          }
        else{
          alert("Enter Customer Mobile number before assign this pack !");
        }
  }

  function savepackmembers(){
    var formdata = $("#sitpackmembercontacts").serialize();
    $.ajax({
          url:'{{ url("assignSitPackToCustomer") }}',
          data:formdata,
          type:'POST',
          dataType:"JSON",
          success:function(res) {
            console.log(res);
            $("#add_sitting_pack_members").modal('hide');
            if(res.msg==true){
              alert('Members contact save successfully');
            }
            else{
              alert('Members contact not saved');
            }

          },
          error: function (request, status, error) {
              alert('Something went wrong in savepackmembers');
          }
        });
  }

  function assignsitpackinstallment(){
    // alert('test');
    let row_seq=0;
    let packageAdvancePayment=0;
    let pack_installments=0;
    let date_installments=0;
    let time_installments=0;
    let pack_makeups=0;
    let date_makeup=0;
    let time_makeup=0;
    let cust_sitpack_fulladdress=$('#sit_pack_full_address').val();
    let cust_sitpack_alternate=$('#sit_pack_alt_contact').val();
    packageAdvancePayment=$('#sit_pack_adv_payment').val();
    var sittingPayment = document.getElementsByName('sittingPayment[]');
    $('#packageAdvancePayment'+row_seq).val(packageAdvancePayment);
    for(var i=1;i<=sittingPayment.length;i++){
      pack_installments=$('#pack_installments'+i).val();
      date_installments=$('#sitting_date'+i).val();
      time_installments=$('#sitting_time'+i).val();
        $("#sittingPayment"+i).val(pack_installments);
        $("#sittingDate"+i).val(date_installments);
        $("#sittingTime"+i).val(time_installments);
     }
     var makeupPayment = document.getElementsByName('makeupPayment[]');
     for(var m=1;m<=makeupPayment.length;m++){
      pack_makeups=$('#pack_makeups'+m).val();
      date_makeup=$('#makeup_date'+m).val();
      time_makeup=$('#makeup_time'+m).val();
        $("#makeupPayment"+m).val(pack_makeups);
        $("#makeupDate"+m).val(date_makeup);
        $("#makeupTime"+m).val(time_makeup);
     }
    calculatecash();
    $("#cust_sitpack_alternate").val(cust_sitpack_alternate);
    $("#cust_sitpack_fulladdress").val(cust_sitpack_fulladdress);
    $("#subtotal").html(parseFloat(packageAdvancePayment).toFixed(2));
    $("#subtotalamount").val(parseFloat(packageAdvancePayment).toFixed(2));
    $("#cashpay").html(parseFloat(packageAdvancePayment).toFixed(2));
    $("#grandtotal").html(parseFloat(packageAdvancePayment).toFixed(2));
    $("#totalgrandTotal").val(parseFloat(packageAdvancePayment).toFixed(2));
    $("#remark").val(`Rs ${packageAdvancePayment} Done as Package Advance Payment`);
  }

  function getassignedsittingpackDetails(sitting_pack_id){
    // alert(sitting_pack_id);
    var number =  $("#searchnumber").val();
    if(sitting_pack_id!="")
    {
      $.ajax({
        url:'{{ url("getCustSitPackService") }}',
        data:{"_token": "{{ csrf_token() }}",'sitting_pack_id':sitting_pack_id,'customer_mobile':number},
        type:'POST',
        success:function(res) {
          // console.log(res);
          var result=(JSON.parse(res));
          // console.log(result.data);
          result.data.forEach((element,index) => {
            // console.log(index); $("#salesrep").val("Bruce Jones");  firmid
            console.log(element.service_id);
            console.log('-----set value------');
            addServiceRow();
            $('#groupidfirm_'+index).val(element.firmid);
            $('#brand_'+index).val(element.service_brand_id);
            $('#services_'+index).val(element.brand_id);
            $('#servicegroups_'+index).val(element.service_id);
            $('#serviceName'+index).val(element.brand_name);
            $('#serviceQty'+index).val(element.quantity);
            $('#servicePrice'+index).val(element.price);
            $('#serviceDisc'+index).val(0);
            $('#serviceAdd'+index).val(0);
            $('#serviceTotal'+index).val(element.total_price);
            $('#servicesSgst'+index).val(0);
            $('#servicesCgst'+index).val(0);
            $('#servicePriceActualRate'+index).val(0);
            $('#servicePriceTotal'+index).val(element.total_price);
            // localStorage.setItem('customer_sitting_pack_id', CSP_Payment.sittingpack_id);
            // localStorage.setItem('sitting_installment', CSP_Payment.sittingPayment);
          });
          calculatecash();
          $("#serviceRowCount").val(($(".servicerow").length)+1);
          $("#cust_sitpack_id").val(result.CSP_Payment.sittingpack_id);
          $("#cust_sitpackround_id").val(result.CSP_Payment.sitting_round);
          $('#customer_sitting_pack_details').modal('hide');
          $("#subtotal").html(parseFloat(result.CSP_Payment.sittingPayment).toFixed(2));
          $("#subtotalamount").val(parseFloat(result.CSP_Payment.sittingPayment).toFixed(2));
          $("#cashpay").html(parseFloat(result.CSP_Payment.sittingPayment).toFixed(2));
          $("#grandtotal").html(parseFloat(result.CSP_Payment.sittingPayment).toFixed(2));
          $("#totalgrandTotal").val(parseFloat(result.CSP_Payment.sittingPayment).toFixed(2));
          $("#remark").val(`Rs ${result.CSP_Payment.sittingPayment} Done as Package Insallment Payment`);
        },
        error: function(jqXHR, textStatus, errorThrown) {
        alert('Something went wrong in getassignedsittingpackDetails');
        }
      });
    }
  }

  function getcustomersittingpackdetails(){
    var number =  $("#searchnumber").val();
    if(number!="")
    {
      $.ajax({
          url:'{{ url("getCustomerSittingPack") }}',
          data:{"_token": "{{ csrf_token() }}",'customer_mobile':number},
          type:'POST',
          success:function(res) {
            console.log(res);
            var result=(JSON.parse(res));
            if(result.msg==true){
              $("#customer_sitting_pack_body").html(result.data.html);
              $('#customer_sitting_pack_details').modal('show');
              // alert('all sitting pack Found');
            }
            else{
              alert('No Bridal pack Found');
            }
          },
          error: function(jqXHR, textStatus, errorThrown) {
          alert('Something went wrong in getcustomersittingpackdetails');
          }
        });
    }
  }

  function sittingpackotp(customer_sitting_pack_id)
  {
    $('#Sitting_Pack_user').find('option').remove();
    let customer_number =  $("#searchnumber").val();
    let mobile='';
    if(customer_sitting_pack_id !="" && customer_number!="" )
    {
      $.ajax({
          url:'{{ url("getSittingPackMemberContacts") }}',
          data:{"_token": "{{ csrf_token() }}",'customer_mobile':customer_number,'customer_sitting_pack_id':customer_sitting_pack_id},
          type:'POST',
          success:function(res) {
            console.log(res);
            var result=(JSON.parse(res));
            if(result.msg==true){
              $('#Sitting_Pack_user').append(`<option value='${result.cust_data.contact}'>${result.cust_data.name}</option>`);
              let all_members_contacts= result.data.member_mobile;
              if(all_members_contacts!=null){
                let contact_array= all_members_contacts.split(",");
              let all_members= result.data.member_name;
              let name_array= all_members.split(",");
              name_array.forEach((element,index) => {
                mobile=contact_array[index];
                element=element.replace(/[^a-zA-Z ]/g, "");
                mobile=mobile.replace(/[^a-zA-Z0-9 ]/g, "");
                // console.log(element);
                $('#Sitting_Pack_user').append(`<option value='${mobile}'>${element}</option>`);
              });
              }
              $('#sitting_pack_otp').modal('show');
              localStorage.setItem('customer_sitting_pack_id',customer_sitting_pack_id);
              // alert('all sitting pack Found');
            }
            else{
              alert('No members found in this Bridal pack');
            }
          },
          error: function(jqXHR, textStatus, errorThrown) {
          alert('Something went wrong in getcustomersittingpackdetails');
          }
        });
    }
  }

  function get_sit_pack_otp() {
    var contact_num = $('#Sitting_Pack_user').find(":selected").val();
      if (contact_num) {
        if ( contact_num.length == 10  ){
          $.ajax({
              url:'{{ url("send_otp_sit_pack") }}',
              data:{"_token": "{{ csrf_token() }}",'number':contact_num},
              type:'POST',
              success:function(res) {
                console.log(res);
                var result=(JSON.parse(res));
                if(result.msg==true){
                  $('#sit_pack_otp').show();
                  $('#get_sit_pack_otpbtn').hide();
                  $('#send_sit_pack_otpbtn').show();
                }
              } ,
              error: function(jqXHR, textStatus, errorThrown) {
                alert('Something went wrong in get_sit_pack_otp');
              }
            });
        }
        else{
          alert("Invalid Mobile number !");
        }

        }
      else{
        alert("Mobile number not available !");
      }
    }

  function send_sit_pack_otp() {
    var contact_num = $('#Sitting_Pack_user').find(":selected").val();
      var user_otp =  $("#cust_sit_pack_otp").val();
      let customer_sitting_pack_id= localStorage.getItem('customer_sitting_pack_id');
      let final_price_sitpack=0;
        if ( user_otp!="" ){
          $.ajax({
              url:'{{ url("sitpack_otp_verify") }}',
              data:{"_token": "{{ csrf_token() }}",'contact':contact_num,'otp':user_otp},
              type:'POST',
              success:function(res) {
                console.log(res);
                $('#sitting_pack_otp').modal('hide');
                var result=(JSON.parse(res));
                if(result.msg==true){
                  // $('#btn_sitpack'+customer_sitting_pack_id).show();
                  $('#btn_adminpswdsitpack'+customer_sitting_pack_id).show();
                  $('#btn_sitpackotp'+customer_sitting_pack_id).hide();
                }
                else{
                  alert('Invalid OTP');
                }
              },
              error: function(jqXHR, textStatus, errorThrown) {
              // document.getElementById("download_Report").style.display="none";
              alert('Something went wrong in send_sit_pack_otp');
              }
            });
        }
  }

  function check_pswd_for_pack(sit_pk_id) {
    $('#sitting_pack_pswd').modal('show');
  }

  function send_sit_pack_pswd() {
      let user_pswd=$('#sit_package_pswd').val();
      let customer_sitting_pack_id= localStorage.getItem('customer_sitting_pack_id');
      $.ajax({
        url:'{{ url("sitpack_pswd_verify") }}',
        data:{"_token": "{{ csrf_token() }}",'pswd':user_pswd},
        type:'POST',
        success:function(res) {
          console.log(res);
          $('#sitting_pack_pswd').modal('hide');
          var result=(JSON.parse(res));
          if(result.msg==true){
            $('#btn_sitpack'+customer_sitting_pack_id).show();
            $('#btn_adminpswdsitpack'+customer_sitting_pack_id).hide();
          }
          else{
            alert('Invalid Password');
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
        // document.getElementById("download_Report").style.display="none";
        alert('Something went wrong in send_sit_pack_otp');
        }
      });
  }

    $(document).ready(function()
      {
        let template = null;
          $('.modal').on('show.bs.modal', function(event) {
            template = $(this).html();
          });

          $('.modal').on('hidden.bs.modal', function(e) {
            $(this).html(template);
          });
      });

    function getallmemberplandetails(){
      $.ajax({
          url:'{{ url("getAllmembersys") }}',
          type:'GET',
          success:function(res) {
            console.log(res);
            var result=(JSON.parse(res));
            if(result.msg==true){
              $("#member_plan_body").html(result.data.html);
              $('#member_sys_details').modal('show');
              // alert('all sitting pack Found');
            }
            else{
              alert('No Bridal pack Found');
            }
          },
          error: function(jqXHR, textStatus, errorThrown) {
          alert('Something went wrong in getAllSittingPack');
          }
        });
    }

    function assignplan_tocustomer(mem_plan_id)
    {
    let expire_plan_at='';
    let expirydate_plan='';
    var today = new Date();
    var number =  $("#searchnumber").val();
        if (number) {
          if ( number.length == 10  ){
            $.ajax({
              url:'{{ url("beforeAssignMemberPlandata") }}',
              data:{"_token": "{{ csrf_token() }}",'mem_plan_id':mem_plan_id},
              type:'POST',
              success:function(res) {
                console.log(res);
                var result=(JSON.parse(res));
                if(result.msg==true){
                  let membership_validity=result.data.membership_validity;
                  // $("#sitting_pack_body").html(result.data.html);
                  expire_plan_at=new Date(today.setDate(today.getDate() + membership_validity));
                  $('#selected_member_plan_id').val(mem_plan_id);
                  $('#reg_plan_customer').val(number);
                  $('#mem_plan_expiry_date').val(expire_plan_at.getDate()+'-'+(expire_plan_at.getMonth()+1)+'-'+expire_plan_at.getFullYear());
                  $('#member_sys_details').modal('hide');
                  $('#add_member_plan_cust').modal('show');
                }
                else{
                  alert('No member plan Found to assign plan to customer');
                }
              },
              error: function(jqXHR, textStatus, errorThrown) {
              alert('Something went wrong in assignplan_tocustomer');
              }
            });
          }
          else{
            alert("Enter Valid Mobile number !");
          }

          }
        else{
          alert("Enter Customer Mobile number before assign this pack !");
        }
  }

  let mem_count=0;
  function addplanmembers(){
    mem_count+=1;
    let plan_members_data='';
    plan_members_data=`<div class='row' id="plan_mem_row${mem_count}">
                      <div class="col-md-5">
                        <div class="form-group">
                          <label class="control-label" for="name">Name <span class="required">*</span> </label>
                            <input type="text"  id="member_name" name="member_name[]" placeholder="Enter name"  class="form-control" autocomplete="off">
                        </div>
                      </div>
                      <div class="col-md-5">
                        <div class="form-group">
                          <label class="control-label" for="mobile">Mobile <span class="required">*</span> </label>
                            <input type="text"  id="member_mobile" name="member_mobile[]" placeholder="Enter Mobile"  class="form-control" autocomplete="off">
                        </div>
                      </div>
                      <div class="col-lg-2 col-md-12 col-12">
                        <div class="form-group">
                          <label>.</label>
                          <div class="input-group mb-3">
                            <button type="button" class="btn btn-danger" onclick="removeplanmembers(${mem_count})"><i class="fa fa-minus"></i></button>
                          </div>
                        </div>
                      </div>
                      </div>
                      `;
    $('#plan_members_contacts').append(plan_members_data);
  }

    function removeplanmembers(mem_seq){
      // alert(mem_seq);
      $("#plan_mem_row"+mem_seq).remove();
    }

    function removepackmembers(pack_mem_count){
      // alert(mem_seq);
      $("#pack_mem_count"+pack_mem_count).remove();
    }


  function get_expired_cust_plan(){
    var number =  $("#searchnumber").val();
    if(number!="")
    {
      $.ajax({
          url:'{{ url("getCustomer_membersysplan_expired") }}',
          data:{"_token": "{{ csrf_token() }}",'customer_mobile':number},
          type:'POST',
          success:function(res) {
            console.log(res);
            var result=(JSON.parse(res));
            if(result.msg==true){
              $("#customer_member_expired_plan_body").html(result.data.html);
              $('#customer_member_expired_plan_details').modal('show');
              // alert('all sitting pack Found');
            }
            else{
              alert('No member plan found in getcustomermembersysplandetails');
            }
          },
          error: function(jqXHR, textStatus, errorThrown) {
          alert('Something went wrong in getcustomermembersysplandetails');
          }
        });
    }
  }

    function getcustomermembersysplandetails(){
    var number =  $("#searchnumber").val();
    if(number!="")
    {
      $.ajax({
          url:'{{ url("getCustomer_membersysplan") }}',
          data:{"_token": "{{ csrf_token() }}",'customer_mobile':number},
          type:'POST',
          success:function(res) {
            console.log(res);
            var result=(JSON.parse(res));
            if(result.msg==true){
              $("#customer_member_plan_body").html(result.data.html);
              $('#customer_member_plan_details').modal('show');
              // alert('all sitting pack Found');
            }
            else{
              alert('No member plan found in getcustomermembersysplandetails');
            }
          },
          error: function(jqXHR, textStatus, errorThrown) {
          alert('Something went wrong in getcustomermembersysplandetails');
          }
        });
    }
  }

  function MemberplanOtp(cust_plan_id, btn_id)
  {
    // alert(btn_id);
    $('#system_Plan_member').find('option').remove();
    let customer_number =  $("#searchnumber").val();
    let mobile='';
    if(cust_plan_id !="" && customer_number!="" )
    {
      $.ajax({
          url:'{{ url("getCustPlanMemberContacts") }}',
          data:{"_token": "{{ csrf_token() }}",'customer_mobile':customer_number,'cust_plan_id':cust_plan_id},
          type:'POST',
          success:function(res) {
            console.log(res);
            var result=(JSON.parse(res));
            if(result.msg==true){
              $('#system_Plan_member').append(`<option value='${result.cust_data.contact}'>${result.cust_data.name}</option>`);
              let all_members_contacts= result.data.member_mobile;
              // console.log(all_members_contacts);
              if(all_members_contacts !== null && all_members_contacts !== '') {
                let contact_array= all_members_contacts.split(",");
                let all_members= result.data.member_name;
                let name_array= all_members.split(",");
                name_array.forEach((element,index) => {
                  mobile=contact_array[index];
                  element=element.replace(/[^a-zA-Z ]/g, "");
                  mobile=mobile.replace(/[^a-zA-Z0-9 ]/g, "");
                  // console.log(element);
                  $('#system_Plan_member').append(`<option value='${mobile}'>${element}</option>`);
                });
              }
              $('#mem_otp_btn').val(btn_id);
              $('#member_plan_otp').modal('show');
              // alert('all sitting pack Found');
            }
            else{
              alert('No members found in this plan');
            }
          },
          error: function(jqXHR, textStatus, errorThrown) {
          alert('Something went wrong in memberplanotp');
          }
        });
    }
  }

  function get_membersys_plan_otp() {
    var contact_num = $('#system_Plan_member').find(":selected").val();
    // let btn_id=$('#mem_otp_btn').val();
      if (contact_num) {
        if ( contact_num.length == 10  ){
          $.ajax({
              url:'{{ url("send_otp_member_plan") }}',
              data:{"_token": "{{ csrf_token() }}",'number':contact_num},
              type:'POST',
              success:function(res) {
                console.log(res);
                var result=(JSON.parse(res));
                if(result.msg==true){
                  $('#member_plan_cust_otp').show();
                  $('#get_membersys_plan_otpbtn').hide();
                  $('#send_membersys_plan_otpbtn').show();
                }
              } ,
              error: function(jqXHR, textStatus, errorThrown) {
                alert('Something went wrong in get_sit_pack_otp');
              }
            });
        }
        else{
          alert("Invalid Mobile number !");
        }

        }
      else{
        alert("Mobile number not available !");
      }
    }

  function send_membersys_plan_otp() {
    let btn_id=$('#mem_otp_btn').val();
    var contact_num = $('#system_Plan_member').find(":selected").val();
      var user_otp =  $("#cust_memberplan_otp").val();
      let final_price_sitpack=0;
        if ( user_otp!="" ){
          $.ajax({
              url:'{{ url("memberplan_otp_verify") }}',
              data:{"_token": "{{ csrf_token() }}",'contact':contact_num,'otp':user_otp},
              type:'POST',
              success:function(res) {
                console.log(res);
                // $('#member_plan_otp').modal('hide');
                var result=(JSON.parse(res));
                if(result.msg==true){
                  $('#member_plan_otp').modal('hide');
                  $('#CustMemberplanOtp'+btn_id).hide();
                  $('#CustMemberplanassign'+btn_id).show();
                }
                else{
                  alert('Invalid OTP');
                }
              },
              error: function(jqXHR, textStatus, errorThrown) {
              alert('Something went wrong in send_membersys_plan_otp');
              }
            });
        }
  }

  function MemberplanAssign(member_plan_id, plan_btn_id,brand_id,service_id){
    let membership_type='';
    let minimum_req_amt='';
    let membership_price_amt='';
    let discount_type='';
    let membership_discount='';
    let actual_amt=0;
    if ( member_plan_id!="" ){
          $.ajax({
              url:'{{ url("memberplan_assign") }}',
              data:{"_token": "{{ csrf_token() }}",'member_plan_id':member_plan_id,'service_id':service_id,'brand_id':brand_id},
              type:'POST',
              success:function(res) {
                console.log(res);
                $('#customer_member_plan_details').modal('hide');
                var result=(JSON.parse(res));
                if(result.msg==true){
                  membership_type=result.data[0].membership_type;
                  minimum_req_amt=result.data[0].minimum_req_amt;
                  if(membership_type=="Discounted")
                  {
                    actual_amt=$("#totalgrandTotal").val();
                    if (parseFloat(actual_amt)>parseFloat(minimum_req_amt)) {
                      discount_type=result.data[0].discount_type;
                      membership_discount=result.data[0].membership_discount;
                      if(discount_type=='Fixed'){
                        $('#discountByValue').val(membership_discount);
                        discByValue(membership_discount);
                      }
                      else if(discount_type=='Percent'){
                        $('#discountByPercent').val(membership_discount);
                        discByPercent(membership_discount);
                      }
                    }
                    else{
                      alert('Invoice total less then minimum req amt to use discount of membership');
                    }
                  }
                  else if(membership_type=="Free"){
                    result.data.forEach((element,index) => {
                        addServiceRow();
                        $('#groupidfirm_'+index).val(element.firmid);
                        $('#brand_'+index).val(element.service_brand_id);
                        $('#services_'+index).val(element.brand_id);
                        $('#servicegroups_'+index).val(element.service_id);
                        $('#serviceName'+index).val(element.brand_name);
                        $('#serviceQty'+index).val(1);
                        $('#servicePrice'+index).val(element.price);
                        $('#serviceDisc'+index).val(0);
                        $('#serviceAdd'+index).val(0);
                        $('#serviceTotal'+index).val(element.total_price);
                        $('#servicesSgst'+index).val(0);
                        $('#servicesCgst'+index).val(0);
                        $('#servicePriceActualRate'+index).val(0);
                        $('#servicePriceTotal'+index).val(element.total_price);
                        membership_price_amt=element.membership_price;
                        $('#cust_member_sys_id').val(element.member_sys_id);
                      });
                      calculatecash();
                      $("#serviceRowCount").val(($(".servicerow").length)+1);
                      $("#grandtotal").html(parseFloat(membership_price_amt).toFixed(2));
                      $("#totalgrandTotal").val(parseFloat(membership_price_amt).toFixed(2));
                      $("#remark").val('Amount adjust with free membership pack');
                  }
                }
              },
              error: function(jqXHR, textStatus, errorThrown) {
              alert('Something went wrong in MemberplanAssign');
              }
            });
        }
  }

  function getcustomercoupondetails() {
    $('#Customer_coupon').modal('show');
  }

  function Get_coupon_details() {
    let customer_number =  $("#searchnumber").val();
    let coupon_code= $("#cust_coupon_code").val();
    let coupon_price_amt=0;
    let actual_amt=0;
    if(customer_number!=""){
      if(coupon_code!=""){
        $.ajax({
              url:'{{ url("cust_coupon_bycode") }}',
              data:{"_token": "{{ csrf_token() }}",'coupon_code':coupon_code,'customer_number':customer_number},
              type:'POST',
              success:function(res) {
                console.log(res);
                $('#Customer_coupon').modal('hide');
                var result=(JSON.parse(res));
                if (result.data!='coupon expire') {
                    if (result.data!='used count exceed') {
                        $('#cust_coupon_id').val(result.data.coupon_id);
                        actual_amt=$("#totalgrandTotal").val();
                        if (parseFloat(actual_amt)>parseFloat(result.data.min_amount)) {
                            if((result.msg==true)&&(result.data.coupon_type=='Free')){
                            $("#grandtotal").html(0);
                            $("#totalgrandTotal").val(0);
                            $("#remark").val('Amount adjust with Free coupon');
                            }
                            else if((result.msg==true)&&(result.data.coupon_type=='Fixed')){
                                actual_amt=$("#totalgrandTotal").val();
                                $('#discountByValue').val(result.data.coupon_discount);
                                $("#grandtotal").html(parseFloat(actual_amt-(result.data.coupon_discount)).toFixed(2));
                                $("#totalgrandTotal").val(parseFloat(actual_amt-(result.data.coupon_discount)).toFixed(2));
                                $("#remark").val('Amount adjust with coupon fixed discount');
                            }
                            else if((result.msg==true)&&(result.data.coupon_type=='Percentage')){
                                $('#discountByPercent').val(result.data.coupon_discount);
                                let coupon_disc=((parseFloat(actual_amt)*parseFloat(result.data.coupon_discount))/100).toFixed(2);
                                $("#grandtotal").html(parseFloat(actual_amt-coupon_disc).toFixed(2));
                                $("#totalgrandTotal").val(parseFloat(actual_amt-coupon_disc).toFixed(2));
                                $("#remark").val('Amount adjust with coupon Percentage discount');
                            }
                            else if((result.msg==true)&&(result.data.coupon_type=='Services')){
                                result.data.forEach((element,index) => {
                                    addServiceRow();
                                    // $('#groupidfirm_'+index).val(element.firmid);
                                    $('#brand_'+index).val(element.service_brand_id);
                                    $('#services_'+index).val(element.brand_id);
                                    $('#servicegroups_'+index).val(element.service_id);
                                    $('#serviceName'+index).val(element.brand_name);
                                    $('#serviceQty'+index).val(element.quantity);
                                    $('#servicePrice'+index).val(element.price);
                                    $('#serviceDisc'+index).val(0);
                                    $('#serviceAdd'+index).val(0);
                                    $('#serviceTotal'+index).val(element.total_price);
                                    $('#servicesSgst'+index).val(0);
                                    $('#servicesCgst'+index).val(0);
                                    $('#servicePriceActualRate'+index).val(0);
                                    $('#servicePriceTotal'+index).val(element.total_price);
                                    coupon_price_amt=element.coupon_price;
                                    $('#cust_coupon_id').val(element.coupon_id);
                                });
                                calculatecash();
                                $("#serviceRowCount").val(($(".servicerow").length)+1);
                                actual_amt=$("#totalgrandTotal").val();
                                $("#grandtotal").html(parseFloat(actual_amt-coupon_price_amt).toFixed(2));
                                $("#totalgrandTotal").val(parseFloat(actual_amt-coupon_price_amt).toFixed(2));
                                $("#remark").val(coupon_price_amt+'Rs Amount adjust with coupon');
                            }
                            else if(result.msg=='not allowed'){
                            alert('Coupon not allowed to this customer');
                            }
                        }
                        else{
                            alert('Invoice Total is less then required amount to use coupon');
                        }
                    }
                    else{
                        alert('Coupon allow used count has been crossed');
                    }
                }
                else{
                    alert('Coupon crossed expiry date');
                }
              },
              error: function(jqXHR, textStatus, errorThrown) {
                alert('Something went wrong in Get_coupon_details');
              }
            });
      }
      else{
        alert('Coupon code not found');
      }
    }else{
      alert('Customer not selected');
    }
  }

  function getcustomerofferdetails() {
    $('#Customer_offers').modal('show');
  }

  function getcustomerfrndofferdetails() {
    $('#Customer_frnd_ref_offers').modal('show');
  }

  function Get_cust_referral_coupon_details(){
    let customer_number =  $("#searchnumber").val();
    let offer_code= $("#cust_referral_coupon_code").val();
    let offer_price_amt=0;
    let actual_amt=0;
    let discount_type='';
    let discount=0;
    if(customer_number!=""){
      if(offer_code!=""){
        $.ajax({
              url:'{{ url("cust_referral_offer_bycode") }}',
              data:{"_token": "{{ csrf_token() }}",'offer_code':offer_code,'customer_number':customer_number},
              type:'POST',
              cache: false,
              dataType: "json",
              success:function(result) {
                        //console.log(result);
                        if(result.status==true){
                            $('#Customer_offers').modal('hide');
                            $('#customer_offer_id').val(result.customer_offer_id);
                            //$('#service_div_count').val(result.data.length);
                            result.data.forEach((element,index) => {
                                addServiceRow();
                                $('#brand_'+index).val(element.service_brand_id);
                                $('#services_'+index).val(element.brand_id);
                                $('#servicegroups_'+index).val(element.service_id);
                                $('#serviceName'+index).val(element.brand_name);
                                $('#serviceQty'+index).val(element.quantity);
                                //$('#servicePrice'+index).val(element.price);
                                $('#servicePrice'+index).val(0);
                                $('#serviceDisc'+index).val(0);
                                $('#serviceAdd'+index).val(0);
                                //$('#serviceTotal'+index).val(element.total_price);
                                $('#serviceTotal'+index).val(0);
                                $('#servicesSgst'+index).val(0);
                                $('#servicesCgst'+index).val(0);
                                $('#servicePriceActualRate'+index).val(0);
                                //$('#servicePriceTotal'+index).val(element.total_price);
                                $('#servicePriceTotal'+index).val(0);
                                $('#servicesgstdiscount'+index).val(0);

                                //offer_price_amt=element.offer_price;
                                //$('#cust_offer_id').val(element.offer_id);
                                $('#offer_id_'+index).val(element.offer_id);
                                $('#free_service_'+index).val(1);

                                var cgstvalue="0/0/0";
                                // if(res.gst_status==1){
                                //     var gstdiscount = 0;
                                //     if(res.gst_discount==1){
                                //         gstdiscount = parseInt(res.cgst)+parseInt(res.sgst);
                                //     }
                                //     var cgstvalue = res.cgst+'/'+res.sgst+'/'+gstdiscount;
                                // }
                                $("#cgst_"+index).val(cgstvalue);

                              });
                              calculatecash();
                                //   $("#serviceRowCount").val(($(".servicerow").length)+1);
                                //   actual_amt=$("#totalgrandTotal").val();
                                //   $("#grandtotal").html(parseFloat(actual_amt-offer_price_amt).toFixed(2));
                                //   $("#totalgrandTotal").val(parseFloat(actual_amt-offer_price_amt).toFixed(2));
                                //   $("#remark").val(offer_price_amt+' Rs Amount adjust with referral offer');
                        }
                        else if(result.status==false){
                          alert(result.message);
                        }
              },
              error: function(jqXHR, textStatus, errorThrown) {
                    alert('Something went wrong in Get_cust_referral_coupon_details');
              }
            });
      }
      else{
        alert('offer code not found');
      }
    }else{
      alert('Customer not selected');
    }
  }


  function Get_cust_frnd_referral_offer_details(){
    let customer_number =  $("#searchnumber").val();
    let offer_code= $("#cust_frnd_referral_offer_code").val();
    let offer_price_amt=0;
    let actual_amt=0;
    let discount_type='';
    let discount=0;
    if(customer_number!=""){
      if(offer_code!=""){
        $.ajax({
              url:'{{ url("cust_frnd_referral_offer_bycode") }}',
              data:{"_token": "{{ csrf_token() }}",'offer_code':offer_code,'customer_number':customer_number},
              type:'POST',
              success:function(res) {
                console.log(res);
                $('#Customer_frnd_ref_offers').modal('hide');
                var result=(JSON.parse(res));
                if((result.msg==true)&&(result.data.offer_type=='Add_to_Wallet')){
                    alert("your friend account will be benefitted");
                }
                else if(result.msg=='Not allowed offer'){
                  alert('offer not allowed to this customer');
                }
                else if(result.msg=='Expired'){
                  alert('offer Expired');
                }

              },
              error: function(jqXHR, textStatus, errorThrown) {
              alert('Something went wrong in Get_cust_frnd_referral_offer_details');
              }
            });
      }
      else{
        alert('offer code not found');
      }
    }else{
      alert('Customer not selected');
    }
  }

  function addPackServiceRow(round_val,append_parentid) {
      let append_lastdiv= $(append_parentid).children().last().attr('id');
      let lastdiv_id = append_lastdiv[append_lastdiv.length -1];
      console.log(parseInt(lastdiv_id)+1);
      let sit_round=(parseInt(round_val)-1);
      r_val=parseInt(lastdiv_id)+1;
      /*var options = '<?php if (!empty($service_group)) {foreach ($service_group as $group) {?><optgroup label="<?php echo $group->group_name ?>"><?php $services = DB::table('services')->where('group_id', $group->id)->get();if (!empty($services)) {foreach ($services as $service) {?><option value="{{ $service->id }}">{{ $service->name }}</option><?php }}?><?php }}?>';*/
      var groupoptions = '<?php if (!empty($service_group)) {foreach ($service_group as $group) {?><option value="<?php echo $group->id ?>"><?php echo $group->group_name ?></option><?php }}?>';
      // alert(options);<form></form>services_
      // let counting_val=$(".servicerow").length;
      let service_row_html=`<div class="row servicerow" id="packserviceDiv${r_val}">
                              <div class="col-lg-2 col-md-12 col-12">
                                <div class="form-group">
                                  <label>Service Categories</label>
                                  <select title="Select" required name="sit${r_val}servicegroups[]" id="servicegroups_${r_val}" class="form-control " onchange="getnewpackServices(this.value,${r_val})" data-live-search="true">
                                  <option value="">Select</option>${groupoptions}
                                  </select>
                                </div>
                              </div>
                              <div class="col-lg-2 col-md-12 col-12">
                                <div class="form-group">
                                  <label>Service</label>
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fa fa-heart-o"></i></span>
                                    </div>
                                    <input class="form-control" name="sitpack_serviceName[]" id="serviceName${r_val}" required >
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-2 col-md-12 col-12">
                                  <div class="form-group"><label>Staff</label>
                                      <div class="input-group mb-3">
                                          <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-heart-o"></i></span>
                                          </div>
                                          <select class="form-control" name="sitpack_packageStaff[]" ><?php if (!empty($staffs)): ?>
                                              <option value="0">select staff</option>
                                              <?php foreach ($staffs as $staff): ?>
                                              <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                                              <?php endforeach ?><?php endif ?>
                                          </select>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-lg-1 col-md-6 col-12">
                                <div class="form-group">
                                  <label>Qty.</label>
                                  <input name="sitpack_${round_val}serviceQuantity[]" type="text" class="form-control appendfocus" placeholder="" value="1" id="serviceQty${r_val}" onkeyup="calcutateDiscount(${r_val})">
                                </div>
                              </div>
                              <div class="col-lg-2 col-md-6 col-12">
                                <div class="form-group">
                                  <label>Price <i class="fa fa-inr"></i></label>
                                  <input name="sitpack_${round_val}services[]"  type="hidden" id="services_${r_val}"/>
                                  <input name="sitpack_${round_val}brand[]"  type="hidden" id="brand_${r_val}"/>
                                  <input name="packservicesSgst[]" type="hidden" id="servicesSgst${r_val}" class="sgstCount">
                                  <input name="packservicesCgst[]" type="hidden" id="servicesCgst${r_val}" class="cgstCount">
                                  <input name="packservicePriceTotal[]" type="hidden" id="servicePriceTotal${r_val}" class="countTotal">
                                  <input name="sitpack_${round_val}servicePriceActualRate[]" type="hidden" id="servicePriceActualRate${r_val}" class="">
                                  <input name="sitpack_${round_val}servicePrice[]" type="text" class="form-control" placeholder="" id="servicePrice${r_val}" onkeyup="calcutateDiscount(${$(".servicerow").length})">
                                </div>
                              </div>
                              <div class="col-lg-2 col-md-6 col-12">
                                <div class="form-group">
                                  <label>Total <i class="fa fa-inr"></i></label>
                                  <input name="sitpack_${round_val}serviceTotal[]" type="text" class="form-control totalprice" placeholder="" id="serviceTotal${r_val}">
                                </div>
                              </div>
                              <div class="col-lg-1 col-md-6 col-12">
                                <div class="form-group">
                                  <label style="display: block; visibility: hidden;">Totalsss</label>
                                  <a href="javascript:void(0)" class="btn btn-danger" onclick="deletepackServiceRow(${r_val})"><i class="fa fa-trash-o mt-2"></i></a>
                                </div>
                              </div>
                            </div>
                            <div class="modal" id="selectMainService_${r_val}">
                              <div class="modal-dialog modal-lg" id="servicegroupform" >
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title">Add Group</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>
                                  <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                                  <input value="" type="hidden" name="sit${r_val}groupidfirm_${r_val}" id="groupidfirm_${r_val}">
                                  <!-- Modal body -->
                                  <div class="modal-body formvisit">
                                    <div class="text-center" id="spinner_service" >
                                      <div class="spinner-border" style="width: 4rem; height: 4rem;" role="status">
                                        <span class="sr-only">Loading...</span>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <!--./col-lg-4-->
                                      <div class="col-lg-12 col-md-12 col-12" id="mainserviceDiv_${r_val}">
                                      </div>
                                      <div class="col-lg-12 col-md-12 col-12" id="groupserviceDiv_${r_val}">
                                      </div>
                                      <div class="col-lg-12 col-md-12 col-12" id="serviceBrandDiv_${r_val}">
                                      </div>
                                    </div>
                                    <!--./row-->
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="outline-btn" data-dismiss="modal">Cancel</button>
                                    <button type="button" onclick="shownewpackServiceBrandsPrice(${r_val})" class="theme-btn">Save</button>
                                  </div>
                                </div>
                              </div>
                            </div>`;
      $(append_parentid).append(service_row_html);
      // if ($(".servicerow").length == 1) {
      //   $(".serviceDivider").show();
      // }
      // $("#serviceRowCount").val(r_val);
      $('#serviceDiv').children().last().find('.appendfocus').focus();
      $('.selectpicker').selectpicker();
    }

    function addMakeupServiceRow(round_val,append_parentid) {
      $('#makeup_ser'+round_val).hide();
      let append_lastdiv= $(append_parentid).children().last().attr('id');
      let lastdiv_id=0;
      if(append_lastdiv!=undefined){
         lastdiv_id = append_lastdiv[append_lastdiv.length -1];
      }
      else{
        $(".servicerow").each(function(){
        let div_ids=$(this).attr('id');
        if(div_ids.includes('makeupserviceDiv')){
          lastdiv_id=parseInt(div_ids.slice(-1))+1;
        }
        else{
          lastdiv_id=1;
        }
      });
      }
      // console.log(parseInt(lastdiv_id)+1);
      let sit_round=(parseInt(round_val)-1);
      r_val=parseInt(lastdiv_id)+1;
      /*var options = '<?php if (!empty($service_group)) {foreach ($service_group as $group) {?><optgroup label="<?php echo $group->group_name ?>"><?php $services = DB::table('services')->where('group_id', $group->id)->get();if (!empty($services)) {foreach ($services as $service) {?><option value="{{ $service->id }}">{{ $service->name }}</option><?php }}?><?php }}?>';*/
      var groupoptions = '<?php if (!empty($service_group)) {foreach ($service_group as $group) {?><option value="<?php echo $group->id ?>"><?php echo $group->group_name ?></option><?php }}?>';
      // alert(options);<form></form>services_
      // let counting_val=$(".servicerow").length;
      let service_row_html=`<div class="row servicerow" id="makeupserviceDiv${r_val}">
                              <div class="col-lg-2 col-md-12 col-12">
                                <div class="form-group">
                                  <label>Service Categories</label>
                                  <select title="Select" required name="makeup_${r_val}servicegroups[]" id="makeup_servicegroups_${r_val}" class="form-control " onchange="getnewmakeupServices(this.value,${r_val})" data-live-search="true">
                                  <option value="">Select</option>${groupoptions}
                                  </select>
                                </div>
                              </div>
                              <div class="col-lg-2 col-md-12 col-12">
                                <div class="form-group">
                                  <label>Service</label>
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fa fa-heart-o"></i></span>
                                    </div>
                                    <input class="form-control" name="makeup_${round_val}serviceName[]" id="makeup_serviceName${r_val}" required >
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-2 col-md-12 col-12">
                                  <div class="form-group"><label>Staff</label>
                                      <div class="input-group mb-3">
                                          <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-heart-o"></i></span>
                                          </div>
                                          <select class="form-control" name="makeup_Staff[]" ><?php if (!empty($staffs)): ?>
                                              <option value="0">select staff</option>
                                              <?php foreach ($staffs as $staff): ?>
                                              <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                                              <?php endforeach ?><?php endif ?>
                                          </select>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-lg-1 col-md-6 col-12">
                                <div class="form-group">
                                  <label>Qty.</label>
                                  <input name="makeup_${round_val}serviceQuantity[]" type="text" class="form-control appendfocus" placeholder="" value="1" id="makeup_serviceQty${r_val}" onkeyup="calcutateDiscount(${r_val})">
                                </div>
                              </div>
                              <div class="col-lg-2 col-md-6 col-12">
                                <div class="form-group">
                                  <label>Price <i class="fa fa-inr"></i></label>
                                  <input name="makeup_${round_val}services[]"  type="hidden" id="makeup_services_${r_val}"/>
                                  <input name="makeup_${round_val}brand[]"  type="hidden" id="makeup_brand_${r_val}"/>
                                  <input name="makeupservicesSgst[]" type="hidden" id="makeup_servicesSgst${r_val}" class="sgstCount">
                                  <input name="makeupservicesCgst[]" type="hidden" id="makeup_servicesCgst${r_val}" class="cgstCount">
                                  <input name="makeupservicePriceTotal[]" type="hidden" id="makeup_servicePriceTotal${r_val}" class="countTotal">
                                  <input name="makeup_${round_val}servicePriceActualRate[]" type="hidden" id="makeup_servicePriceActualRate${r_val}" class="">
                                  <input name="makeup_${round_val}servicePrice[]" type="text" class="form-control" placeholder="" id="makeup_servicePrice${r_val}" onkeyup="calcutateDiscount(${r_val})">
                                </div>
                              </div>
                              <div class="col-lg-2 col-md-6 col-12">
                                <div class="form-group">
                                  <label>Total <i class="fa fa-inr"></i></label>
                                  <input name="makeup_${round_val}serviceTotal[]" type="text" class="form-control totalprice" placeholder="" id="makeup_serviceTotal${r_val}">
                                </div>
                              </div>
                              <div class="col-lg-1 col-md-6 col-12">
                                <div class="form-group">
                                  <label style="display: block; visibility: hidden;">Totalsss</label>
                                  <a href="javascript:void(0)" class="btn btn-danger" onclick="deleteMakeupServiceRow(${r_val})"><i class="fa fa-trash-o mt-2"></i></a>
                                </div>
                              </div>
                            </div>
                            <div class="modal" id="selectmakeup_MainService_${r_val}">
                              <div class="modal-dialog modal-lg" id="makeupservicegroupform" >
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title">Add Group</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>
                                  <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                                  <input value="" type="hidden" name="makeupgroupidfirm_${r_val}" id="makeup_groupidfirm_${r_val}">
                                  <!-- Modal body -->
                                  <div class="modal-body formvisit">
                                    <div class="text-center" id="spinner_service" >
                                      <div class="spinner-border" style="width: 4rem; height: 4rem;" role="status">
                                        <span class="sr-only">Loading...</span>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <!--./col-lg-4-->
                                      <div class="col-lg-12 col-md-12 col-12" id="makeup_mainserviceDiv_${r_val}">
                                      </div>
                                      <div class="col-lg-12 col-md-12 col-12" id="makeup_groupserviceDiv_${r_val}">
                                      </div>
                                      <div class="col-lg-12 col-md-12 col-12" id="makeup_serviceBrandDiv_${r_val}">
                                      </div>
                                    </div>
                                    <!--./row-->
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="outline-btn" data-dismiss="modal">Cancel</button>
                                    <button type="button" onclick="shownewmakeup_ServiceBrandsPrice(${r_val})" class="theme-btn">Save</button>
                                  </div>
                                </div>
                              </div>
                            </div>`;
      $(append_parentid).append(service_row_html);
      // if ($(".servicerow").length == 1) {
      //   $(".serviceDivider").show();
      // }
      // $("#serviceRowCount").val($(".servicerow").length);
      $('#serviceDiv').children().last().find('.appendfocus').focus();
      $('.selectpicker').selectpicker();
    }

    function getnewpackServices(groupid,count) {
      if (groupid != "") {
        $.ajax({
          url:" {{ url('getServiceByGroup') }} ",
          data:{"_token": "{{ csrf_token() }}",'groupid':groupid},
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
            shownewpackFirmService(groupid, (--count));
          }
        });
        // calculatecash();
      }
    }

    function shownewpackFirmService(groupid, totalcount) {
      // alert(count)
      if (groupid != "") {
        // var totalcount = $(".servicerow").length;
       //var groupid = $("#groupidfirm_"+totalcount).val();
        // alert(groupid)
        $.ajax({
          url:"{{ url('shownewpackFirmService') }}",
          type:'POST',
          data:{"_token": "{{ csrf_token() }}",'groupid':groupid,'totalcount':totalcount},
          dataType:'JSON',
          success:function(res) {
            // alert(res.html)
            $("#mainserviceDiv_"+totalcount).html(res.html);
          }
        });
      }
    }

    function shownewpackGroupService(group_id,parentId,totalcount) {
      // alert(parentId);
      // var totalcount = $(".servicerow").length;
      if(group_id != ""){
        $.ajax({
          url:"{{ url('shownewpackGroupService') }}",
          type:'POST',
          data:{"_token": "{{ csrf_token() }}",'groupid':group_id,'totalcount':totalcount,'parentId':parentId},
          dataType:'JSON',
          success:function(res) {
            // alert(res.html)
            $("#groupserviceDiv_"+totalcount).html(res.html);
          }
        });
      }
    }

    function shownewpackServiceBrands(service_id, totalcount) {
      // var totalcount = $(".servicerow").length;
      var totalcountss = parseInt(totalcount)-1;
      var count = parseInt(totalcount)-1;
      console.log(service_id);
      if((service_id != "")&&(service_id!=0)){
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
      else if((service_id != "")&&(service_id==0))
      {
        var other_service_id=$('#servicegroups_'+totalcountss).val();
        console.log('other services');
        $("#serviceBrandDiv_"+totalcount).html('');
        $('#other_service_id').val(other_service_id);
        // servicegroups_
        $('#other_service').modal('show');
        $("#selectMainService_"+totalcountss).modal('hide');
      }
    }

    function shownewpackServiceBrandsPrice(totalcountnew) {
      $('#spinner_service').show();
      console.log('--------shownewpackServiceBrandsPrice------------');
      // var totalcount = $(".servicerow").length-1;
      var totalcount = totalcountnew;
      var totalcountss = totalcountnew;

      // var totalcountss = parseInt(totalcount)-1;
      // var totalcountnew = parseInt(totalcount);
      //  alert(totalcount);
      var brand_id = $("#groupServiess_"+totalcountnew).val();
      console.log(brand_id);
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
            console.log('--------response ---------------shownewpackServiceBrandsPrice------------');
            console.log(res);
             //alert("#servicePrice"+totalcount);service_id
            //  alert(res.service_id);
            $("#brand_"+totalcount).val(array[i]);
            $("#servicePrice"+totalcount).val(res.service_price);
            $("#servicePriceActualRate"+totalcount).val(res.service_price);
            $("#serviceName"+totalcount).val(res.brand_name);
            $("#services_"+totalcount).val(res.brand_id);
            // addServiceRow(totalcount);
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
    $('#spinner_service').hide();
      deleteServiceRow();
      deleteServiceRow();
       }, 1000);

    }

    function getnewmakeupServices(groupid,count) {
      if (groupid != "") {
        $.ajax({
          url:" {{ url('getServiceByGroup') }} ",
          data:{"_token": "{{ csrf_token() }}",'groupid':groupid},
          type:'POST',
          // dataType:'JSON',
          success:function(res) {
            $('#spinner_service').hide();
            // alert(res);
            /*$("#services_"+count).html(res);
            $('#services_'+count).selectpicker('refresh'); */
            $("#selectmakeup_MainService_"+count).modal({
                backdrop: 'static'
            });
            $("#makeup_groupidfirm_"+(++count)).val(groupid);
            shownewmakeupFirmService(groupid, (--count));
          }
        });
        // calculatecash();
      }
    }

    function shownewmakeupFirmService(groupid, totalcount) {
      // alert(count)
      if (groupid != "") {
        // var totalcount = $(".servicerow").length;
       //var groupid = $("#groupidfirm_"+totalcount).val();
        // alert(groupid)
        $.ajax({
          url:"{{ url('shownewmakeupFirmService') }}",
          type:'POST',
          data:{"_token": "{{ csrf_token() }}",'groupid':groupid,'totalcount':totalcount},
          dataType:'JSON',
          success:function(res) {
            // alert(res.html)
            $("#makeup_mainserviceDiv_"+totalcount).html(res.html);
          }
        });
      }
    }

    function shownewmakeupGroupService(group_id,parentId,totalcount) {
      // alert(parentId);
      // var totalcount = $(".servicerow").length;
      if(group_id != ""){
        $.ajax({
          url:"{{ url('shownewmakeupGroupService') }}",
          type:'POST',
          data:{"_token": "{{ csrf_token() }}",'groupid':group_id,'totalcount':totalcount,'parentId':parentId},
          dataType:'JSON',
          success:function(res) {
            // alert(res.html) makeup_groupserviceDiv_
            $("#makeup_groupserviceDiv_"+totalcount).html(res.html);
          }
        });
      }
    }

    function shownewmakeupServiceBrands(service_id, totalcount) {
      // var totalcount = $(".servicerow").length;
      var totalcountss = parseInt(totalcount)-1;
      var count = parseInt(totalcount)-1;
      console.log(service_id);
      if((service_id != "")&&(service_id!=0)){
        $.ajax({
          url:"{{ url('showServiceBrandsForMakeup') }}",
          type:'POST',
          data:{"_token": "{{ csrf_token() }}",'service_id':service_id,'totalcount':totalcount},
          dataType:'JSON',
          success:function(res) {
            console.log('-------shownewmakeupServiceBrands------------');
            // console.log(res.html);
            $("#makeup_serviceBrandDiv_"+totalcount).html(res.html);
            $("#services_"+count).val(service_id);
          }
        });
      }
      else if((service_id != "")&&(service_id==0))
      {
        var other_service_id=$('#servicegroups_'+totalcountss).val();
        console.log('other services');
        $("#makeup_serviceBrandDiv_"+totalcount).html('');
        $('#other_service_id').val(other_service_id);
        // servicegroups_
        $('#other_service').modal('show');
        $("#selectmakeup_MainService_"+totalcountss).modal('hide');
      }
    }

    function shownewmakeup_ServiceBrandsPrice(totalcountnew) {
      $('#spinner_service').show();
      console.log('--------shownewpackServiceBrandsPrice------------');
      // var totalcount = $(".servicerow").length-1;
      var totalcount = totalcountnew;
      var totalcountss = totalcountnew;

      // var totalcountss = parseInt(totalcount)-1;
      // var totalcountnew = parseInt(totalcount);
      //  alert(totalcount);
      var brand_id = $("#makeupgroupServiess_"+totalcountnew).val();
      console.log(brand_id);
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
            console.log('--------response ---------------shownewpackServiceBrandsPrice------------');
            console.log(res);
             //alert("#servicePrice"+totalcount);service_id
            //  alert(res.service_id);
            $("#makeup_brand_"+totalcount).val(array[i]);
            $("#makeup_servicePrice"+totalcount).val(res.service_price);
            $("#makeup_servicePriceActualRate"+totalcount).val(res.service_price);
            $("#makeup_serviceName"+totalcount).val(res.brand_name);
            $("#makeup_services_"+totalcount).val(res.brand_id);
            // addServiceRow(totalcount);
            $("#makeup_servicegroups_"+totalcount).val(res.service_id);
            $("#makeup_servicegroups_"+totalcount).find('option[value="'+res.service_id+'"]').attr('selected', true);
            calcutatemakeupDiscount(totalcount);
            totalcount++;
          }
        });
      }
    });

     // deleteServiceRow();
     setTimeout(function() {
    $("#selectmakeup_MainService_"+totalcountss).modal('hide');
    $('#spinner_service').hide();
      deleteServiceRow();
      deleteServiceRow();
       }, 1000);

    }

    function calcutatemakeupDiscount(count) {
      var sgst = parseFloat(0);
      var cgst = parseFloat(0);
      var disc = $("#makeup_serviceDisc"+count).val();
      // alert(disc);
      if((disc=='')||(disc==undefined)||(disc==null)){disc=0;}
      var price = $("#makeup_servicePrice"+count).val();
      if(price==''){price=0;}
      var qty = $("#makeup_serviceQty"+count).val();
      if(qty==''){qty=0;}
      var total = parseFloat(price) * parseFloat(qty);
      var totaldiscount = (parseFloat(total).toFixed(2) * parseFloat(disc).toFixed(2))/100;
      total = parseFloat(total) - parseFloat(totaldiscount);
      $("#makeup_servicePriceTotal"+count).val(parseFloat(total).toFixed(2));
      var totalsgst = (parseFloat(total) * parseFloat(sgst))/100;
      var totalcgst = (parseFloat(total) * parseFloat(cgst))/100;
      total = parseFloat(total) + parseFloat(totalsgst) + parseFloat(totalcgst);
      $("#makeup_serviceTotal"+count).val(parseFloat(total).toFixed(2));
      /*$("#totalsgstval").html(parseFloat(totalsgst));
      $("#totalcgstval").html(parseFloat(totalcgst));*/
      $("#makeup_servicesSgst"+count).val(parseFloat(totalsgst).toFixed(2));
      $("#makeup_servicesCgst"+count).val(parseFloat(totalcgst).toFixed(2));
      calculatecash();
    }

    let makeup_roundkey=0;
    let makeup_round_div=0;
    function addMakeupRow(){
      $(".dynamic_ddlrow").each(function(){
        let div_ids=$(this).attr('id');
        if(div_ids.includes('sittingpackageMakeUpServiceRow')){
          makeup_round_div=parseInt(div_ids.slice(-1))+1;
        }
        else{
          makeup_round_div=1;
        }
      });
      // alert('addMakeupRow');
     makeup_roundkey=parseInt(makeup_round_div)+1;
     let Makeupservicebutton= `<div class="row dynamic_ddlrow" id="sittingpackageMakeUpServiceRow${makeup_round_div}" >
                                    <div class="col-lg-12 col-md-12 col-12">
                                      <div class="row">
                                          <div class="col-lg-4 col-md-12 col-12"
                                              <h6> MakeUp${makeup_roundkey}</h6>
                                              <a onclick="addMakeupServiceRow(${makeup_roundkey}, insidemakeupdiv${makeup_roundkey})" href="javascript:void(0)" class="theme-btn" id="makeup_ser${makeup_roundkey}">
                                              <i class="fa fa-plus"></i>Services
                                              </a>
                                              <a onclick="DeletePackMakeupRound(${makeup_roundkey}, insidemakeupdiv${makeup_roundkey})" href="javascript:void(0)" class="btn btn-danger">
                                              <i class="fa fa-trash"></i>Remove
                                              </a>
                                              <input name="makeupPayment[]" type="hidden" readonly class="form-control Installment" placeholder="Enter Makeup Installment" id="makeupPayment${makeup_roundkey}" required >
                                              <input name="makeupDate[]" type="hidden" readonly class="form-control Installment" placeholder="Enter Makeup Date" id="makeupDate${makeup_roundkey}" required >
                                              <input name="makeupTime[]" type="hidden" readonly class="form-control Installment" placeholder="Enter Makeup Time" id="makeupTime${makeup_roundkey}" required >
                                          </div>
                                      </div>
                                      <div class="divider serviceDivider">  </div>
                                  </div>
                                  <div class="col-lg-12 col-md-12 col-12" id="insidemakeupdiv${makeup_roundkey}"></div>
                              </div>`;
      $("#packageDiv").append(Makeupservicebutton);
      $("#MakeUpDivCount").val($(".MakeUpDivRow").length);
      console.log($("#MakeUpDivCount").val());
  }

  function DeletePackMakeupRound(makeup_round) {
    makeup_round-=1;
    $('#sittingpackageMakeUpServiceRow'+makeup_round).remove();
    calculatecash();
  }

  function DeletePackSittingRound(sitting_round) {
    // sitting_round-=1;
    $('#insidepackhead'+sitting_round).remove();
    $('#insidepackdiv'+sitting_round).remove();
  }

  function recent_checkin_show() {
    $('#checkin_customer_data').html('');
    $.ajax({
          url:"{{ url('recent_all_checkin') }}",
          type:'GET',
          dataType:'JSON',
          success:function(res) {
            console.log('--------response ---------------recent_all_checkin------------');
            console.log(res);
            if(res.msg==true){
              res.data.forEach((element, index) => {
                new_row=`<tr>
                            <td class="td-sm">${index+1}</td>
                            <td class="td-sm">${element.name}</td>
                            <td class="td-sm">${element.email}</td>
                            <td class="td-sm">
                              <a onclick="set_checkin_cust('${element.contact}')" class="theme-btn mt-1" href="javascript:void(0)">Go to Service</a>
                            </td>
                            </tr>`
                    $('#checkin_customer_data').append(new_row);
              });
              $('#RecentCheckIn_btn').hide();
              $('#all_checkin_customer').modal('show');
            }
          }
        });
  }

  function set_checkin_cust(cust_mobile) {
      $('#searchnumber').val(cust_mobile);
      $('#all_checkin_customer').modal('hide');
      checkaccount(cust_mobile);
  }

  function checkcustomer_id(){
    var customer_id = $('#customer_id').val();
    if(customer_id==''){
      $('#searchnumber').val('');
    }
  }

  function reset_quick_sale(){
      var c = confirm('Do you really wants reset fields?');
      if(c){
          location.reload();
      }else{
          return false;
      }
  }

  function edit_invoice(){
      $('#old_invoice_id_div').show();
  }

  function delete_invoice(){
      $('#delete_invoice').modal('show');
  }

  function delete_invoice_by_invoice_no(){
      var delete_invoice_id = $('#delete_invoice_no').val();
      if(delete_invoice_id==''){
          $('#delete_invoice_no_error').html('Please insert invoice id');
      }else{
        $('#delete_invoice_no_error').html('');
        var con = confirm('Are you sure you want to delete it');
        if(con){
            $.ajax({
            url:"{{ url('deleteinvoicebyid') }}",
            type:'POST',
            data:{"_token": "{{ csrf_token() }}",'delete_invoice_id':delete_invoice_id},
            dataType:'JSON',
            success:function(res) {
                console.log('-------delete invoice------------');
                 console.log(res);
                if(res.status==1){
                    $('.delete_invoice_result').html('<div class="alert alert-success">'+res.msg+'</div>');
                    setTimeout(function(){
                        $('#delete_invoice').modal('hide');
                    }, 1000);
                }else{
                    $('.delete_invoice_result').html('<div class="alert alert-danger">'+res.msg+'</div>');
                }
            }
            });
        }else{
            $('#delete_invoice').modal('hide');
        }
      }
  }
    </script>

  @endsection
