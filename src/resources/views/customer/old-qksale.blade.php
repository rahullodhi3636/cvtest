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
               <form id="quicksaleForm" action="{{ url('quicksaleInvoice') }}" method="post" class="formvisit mt-2">
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
                            <input id="billingdate" name="billingdate" required="" type="text" class="form-control datetimepicker" placeholder="" value="<?php echo date('d/m/Y') ?>">
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
                     <div class="col-lg-4 col-md-12 col-12" style="display: none;" id="visitdiv">
                        <div class="visitmetric">
                            <p>Total Visit - <span id="visitshowspan">0</span></p>
                            <p>Last Visit-</p>
                            <p><b id="visitshowdate">Nil</b></p>
                          </div><!--./metric-->
                     </div><!--./col-lg-4-->
                     <div class="col-lg-4 col-md-12 col-12" style="display: none;" id="revenuediv">
                        <div class="visitmetric">
                          <p>&nbsp;</p>
                          <p id="totalRevenueShow"></p>                      
                          <p><b>Total Revenue</b></p>
                        </div><!--./metric-->
                     </div><!--./col-lg-4-->
                     <div class="col-lg-4 col-md-12 col-12" style="display: none;" id="remarkdiv">
                        <div class="visitmetric">
                          <!-- <p>&nbsp;</p>   -->                    
                          <p><b>Remark</b></p>
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

                     <!-- <div class="col-lg-4 col-md-12 col-12">
                       <div class="form-group">
                          <label>Redeem Gift Voucher</label>
                          <input type="text" class="form-control" placeholder="">
                        </div> --><!--./form-group-->
                     <!-- </div> --><!--./col-lg-4-->

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
                        <input type="submit" name="invoice_type" value="Bill with amount" class="btn btn-success btn-sm waves-effect waves-light">
                        <input type="submit" name="invoice_type" value="Bill without amount" class="btn btn-danger btn-sm waves-effect waves-light">
                      </div><!--./col-lg-4-->
                    </div><!--./row-->
                  </div><!--/col-lg-12-->
                </div><!--./row--> 
               </form> 
             </div><!--./col-lg-12-->  
          </div><!--./boxbody-->
        </div><!--./container-fluid-->
        <footer>
          Copyright © 2020 Chinnie & Vinnie Jabalpur Salon. All rights reserved.
        </footer>   
     </div><!--./main-content-->  
    </div><!--./main-->
  <!-- </form> -->
 <!--./wrapper-->

 <!-- The Modal -->
<div class="modal" id="viewUnpaidModel">
  <div class="modal-dialog modal-lg">
    
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Unpaid Invoices</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body formvisit">
          <div class="row">
            <table class="table table-bordered">
              <thead>
                <th>Invoice</th>
                <th>Date</th>
                <th>Invoice Amount</th>
                <th>Outstanding Amount</th>
                <th>Action</th>
              </thead>
              <tbody id="unpaidTbody">
                
              </tbody>
            </table>
          </div><!--./row-->
        </div>
        <div class="modal-footer">
          <button type="button" class="outline-btn" data-dismiss="modal">Cancel</button> 
          <button type="submit" class="theme-btn">Pay</button>
        </div>
      </div>
  </div>
</div><!--#/addcustomer-->

 <!-- The Modal -->
<div class="modal" id="addcustomer">
  <div class="modal-dialog modal-lg">
    <form id="addcustomerform" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Customer</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body formvisit">
          <div class="row">
            <div class="col-lg-4 col-md-12 col-12">
               <div class="form-group">
                  <label>Mobile Number</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">+91</span>
                    </div>
                    <input type="number" id="addmobile" name="addmobile" class="form-control" placeholder="1234567890">
                  </div>
                </div>
            </div><!--./col-lg-4-->

             <div class="col-lg-4 col-md-12 col-12">
               <div class="form-group">
                  <label>Customer Name</label>
                  <input type="text" class="form-control" name="addname" id="addname" placeholder="Customer name">
                </div>
            </div><!--./col-lg-4-->

            <div class="col-lg-4 col-md-12 col-12">
               <div class="form-group">
                  <label>Customer ID</label>
                  <input readonly="" id="addcustid" name="addcustid" type="text" class="form-control" placeholder="">
                </div>
            </div><!--./col-lg-4-->

            <div class="col-lg-4 col-md-12 col-12">
               <div class="form-group">
                  <label>Customer Type</label>
                  <select id="addcusttype" name="addcusttype" class="form-control">
                    <option value="">Select</option>
                    <option value="VIP">VIP</option>
                    <option value="NON VIP">NON VIP</option>
                  </select>
                </div>
            </div><!--./col-lg-4-->

            <div class="col-lg-4 col-md-12 col-12">
               <div class="form-group">
                  <label>Email ID</label>
                  <input type="text" id="addemail" name="addemail" class="form-control" placeholder="">
                </div>
            </div><!--./col-lg-4-->

            <div class="col-lg-4 col-md-12 col-12">
                <div class="form-group">
                  <label>DOB</label>
                  <input type="text" id="adddob" name="adddob" class="form-control datepicker" placeholder="">
                </div>
            </div><!--./col-lg-4-->
            <div class="col-lg-4 col-md-12 col-12">
                <div class="form-group">
                  <label>Designation</label>
                  <input type="text"  id="designation" name="designation" value="" placeholder="Enter designation"  class="form-control" autocomplete="off">
                </div>
            </div><!--./col-lg-4-->

            <div class="col-lg-4 col-md-12 col-12">
                <div class="form-group">
                  <label>Gender</label>
                  <select class="form-control" name="gender" id="gender">
                    <option value="">Select</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>
            </div><!--./col-lg-4-->

            <div class="col-lg-4 col-md-12 col-12">
                <div class="form-group">
                  <label>Aniversary</label>
                  <div class="input-group mb-3">
                    <input type="text" id="addanniversary" name="addanniversary" class="form-control datepicker" placeholder="">
                    <div class="input-group-append">
                      <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                  </div>
                  <!-- <input type="text" class="form-control" placeholder=""> -->
                </div>
            </div><!--./col-lg-4-->

            <div class="col-lg-4 col-md-12 col-12">
              <div class="form-group">
                <label>Location</label>
                <input type="text" name="addlocation" id="addlocation" class="form-control" placeholder="">
              </div>
            </div><!--./col-lg-4-->

            <div class="col-lg-4 col-md-12 col-12">
                <div class="form-group">
                  <label>Other contact</label>
                  <input type="text" name="addothercontact" id="addothercontact" class="form-control" placeholder="">
                </div>
            </div><!--./col-lg-4-->

            <div class="col-lg-6 col-md-12 col-12">
               <div class="form-group">
                  <label>Remark</label>
                  <textarea class="form-control" placeholder="Remark" name="addRemark" id="addRemark"></textarea>
                </div>
            </div><!--./col-lg-6-->
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

<!-- The Modal -->
<div class="modal" id="editcustomer">
  <div class="modal-dialog modal-lg">
    <form id="editform" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Customer</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body formvisit">
          <div class="row">
            <div class="col-lg-4 col-md-12 col-12">
               <div class="form-group">
                  <label>Mobile Number</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">+91</span>
                    </div>
                    <input type="text" class="form-control" id="editmobile" name="editmobile" placeholder="1234567890">
                  </div>
                </div>
            </div><!--./col-lg-4-->

             <div class="col-lg-4 col-md-12 col-12">
               <div class="form-group">
                  <label>Customer Name</label>
                  <!-- <input type="hidden" name="editcusid" id="editcusid"> -->
                  <input type="text" class="form-control" placeholder="Customer name" name="editname" id="editname">
                </div>
            </div><!--./col-lg-4-->

            <div class="col-lg-4 col-md-12 col-12">
               <div class="form-group">
                  <label>Customer ID</label>
                  <input type="text" readonly="" class="form-control" placeholder="" id="editid" name="editid">
                </div>
            </div><!--./col-lg-4-->

            <div class="col-lg-4 col-md-12 col-12">
               <div class="form-group">
                  <label>Email ID</label>
                  <input type="text" class="form-control" placeholder="" id="editemail" name="editemail">
                </div>
            </div><!--./col-lg-4-->

            <div class="col-lg-4 col-md-12 col-12">
               <div class="form-group">
                  <label>DOB</label>
                  <input type="text" class="form-control datepicker" placeholder="" name="editdob" id="editdob">
                </div>
            </div><!--./col-lg-4-->

            <div class="col-lg-4 col-md-12 col-12">
               <div class="form-group">
                  <label>Aniversary</label>
                <div class="input-group mb-3">
                  <input type="text" class="form-control datepicker" placeholder="" id="editanniversary" name="editanniversary">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                  </div>
                </div>
                  <!-- <input type="text" class="form-control" placeholder=""> -->
                </div>
            </div><!--./col-lg-4-->

             <div class="col-lg-4 col-md-12 col-12">
               <div class="form-group">
                  <label>Location</label>
                  <input type="text" class="form-control" placeholder="" name="editlocation" id="editlocation">
                </div>
            </div><!--./col-lg-4-->
          </div><!--./row-->
        </div>
        <div class="modal-footer">
          <button type="button" class="outline-btn" data-dismiss="modal">Cancel</button> <button type="submit" class="theme-btn">Save</button>
        </div>
      </div>
    </form>
  </div>
</div><!--#/addcustomer-->
<script src="{{asset('assets/js/lib/jquery.js')}}"></script>
<script src="{{asset('assets/js/dist/jquery.validate.js')}}"></script>
<script type="text/javascript">

  $('#searchnumber').keyup(function() {
    var search_query = $(this).val();
    if (search_query.length >= 3) {
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
            for (var i = 0; i < response.contact.length; i++) {
              // alert(response.contact[i])
              resp_data_format=resp_data_format+"<li style='cursor:pointer' onclick='checkaccount('"+response.contact[i]+"')' class='select_contact'>"+response.contact[i]+"</li><span>- "+response.name[i]+" ("+response.id[i]+")<span>";
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
      // alert(disc);
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
      /*var options = '<?php if (!empty($service_group)) { foreach ($service_group as $group){ ?><optgroup label="<?php echo $group->group_name ?>"><?php $services = DB::table('services')->where('group_id',$group->id)->get(); if (!empty($services)) { foreach ($services as $service){ ?><option value="{{ $service->id }}">{{ $service->name }}</option><?php } } ?><?php } } ?>';*/
      var groupoptions = '<?php if (!empty($service_group)) { foreach ($service_group as $group){ ?><optgroup label="<?php echo $group->group_name ?>"><?php $services = DB::table('service_group')->where('parent_id',$group->id)->get(); if (!empty($services)) { foreach ($services as $service){ ?><option value="{{ $service->id }}">{{ $service->group_name }}</option><?php } } ?></optgroup><?php } } ?>';
      // alert(options);
      $("#serviceDiv").append('<div class="row servicerow"><div class="col-lg-2 col-md-12 col-12"><div class="form-group"><label>Service Categories</label><select title="Select" required name="servicegroups_'+$(".servicerow").length+'" class="form-control selectpicker" onchange="getServices(this.value,'+$(".servicerow").length+')" data-live-search="true">'+groupoptions+'</select></div>  </div><div class="col-lg-2 col-md-12 col-12"><div class="form-group"><label>Services</label><select id="services_'+$(".servicerow").length+'" title="Select" required name="services_'+$(".servicerow").length+'" class="form-control selectpicker" onchange="getServicePrice(this.value,'+$(".servicerow").length+')" data-live-search="true"></select></div>  </div><div class="col-lg-2 col-md-12 col-12"><div class="form-group"><label>Staff</label><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-heart-o"></i></span></div><select class="form-control" name="serviceStaff'+$(".servicerow").length+'" required><option value="">Select</option><?php if (!empty($staffs)): ?><?php foreach ($staffs as $staff): ?><option value="{{ $staff->id }}">{{ $staff->name }}</option><?php endforeach ?><?php endif ?></select></div></div></div><div class="col-lg-6 col-md-12 col-12"><div class="row"><div class="col-lg-2 col-md-6 col-12"><div class="form-group"><label>Qty.</label><input name="serviceQuantity[]" type="text" class="form-control appendfocus" placeholder="" value="1" id="serviceQty'+$(".servicerow").length+'" onkeyup="calcutateDiscount('+$(".servicerow").length+')"></div></div>   <div class="col-lg-3 col-md-6 col-12"><div class="form-group"><label>Price <i class="fa fa-inr"></i></label><input name="servicesSgst[]" type="hidden" id="servicesSgst'+$(".servicerow").length+'" class="sgstCount"><input name="servicesCgst[]" type="hidden" id="servicesCgst'+$(".servicerow").length+'" class="cgstCount"><input name="servicePriceTotal[]" type="hidden" id="servicePriceTotal'+$(".servicerow").length+'" class="countTotal"><input name="servicePrice[]" type="text" class="form-control" placeholder="" id="servicePrice'+$(".servicerow").length+'"></div></div>  <div class="col-lg-2 col-md-6 col-12"><div class="form-group"><label>Disc. (%)</label><input name="serviceDisc[]" id="serviceDisc'+$(".servicerow").length+'" type="text" class="form-control" placeholder="" value="0" onkeyup="calcutateDiscount('+$(".servicerow").length+')"></div></div><div class="col-lg-3 col-md-6 col-12"><div class="form-group"><label>Total <i class="fa fa-inr"></i></label><input name="serviceTotal[]" type="text" class="form-control totalprice" placeholder="" id="serviceTotal'+$(".servicerow").length+'"></div></div><div class="col-lg-1 col-md-6 col-12"><div class="form-group"><label style="display: block; visibility: hidden;">Total</label><a href="javascript:void(0)" onclick="deleteServiceRow()"><i class="fa fa-trash-o mt-2"></i></div></div></div></div></div>');
      /*$("#serviceDiv").append('<div class="row servicerow"><div class="col-lg-3 col-md-12 col-12"><div class="form-group"><label>Services</label><select title="Select" required name="services_'+$(".servicerow").length+'" class="form-control selectpicker" onchange="getServicePrice(this.value,'+$(".servicerow").length+')" data-live-search="true">'+groupoptions+'</select></div>  </div><div class="col-lg-3 col-md-12 col-12"><div class="form-group"><label>Staff</label><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-heart-o"></i></span></div><select class="form-control" name="serviceStaff'+$(".servicerow").length+'" required><option value="">Select</option><?php if (!empty($staffs)): ?><?php foreach ($staffs as $staff): ?><option value="{{ $staff->id }}">{{ $staff->name }}</option><?php endforeach ?><?php endif ?></select></div></div></div><div class="col-lg-6 col-md-12 col-12"><div class="row"><div class="col-lg-2 col-md-6 col-12"><div class="form-group"><label>Qty.</label><input name="serviceQuantity[]" type="text" class="form-control appendfocus" placeholder="" value="1" id="serviceQty'+$(".servicerow").length+'" onkeyup="calcutateDiscount('+$(".servicerow").length+')"></div></div>   <div class="col-lg-3 col-md-6 col-12"><div class="form-group"><label>Price <i class="fa fa-inr"></i></label><input name="servicesSgst[]" type="hidden" id="servicesSgst'+$(".servicerow").length+'" class="sgstCount"><input name="servicesCgst[]" type="hidden" id="servicesCgst'+$(".servicerow").length+'" class="cgstCount"><input name="servicePriceTotal[]" type="hidden" id="servicePriceTotal'+$(".servicerow").length+'" class="countTotal"><input name="servicePrice[]" type="text" class="form-control" placeholder="" id="servicePrice'+$(".servicerow").length+'"></div></div>  <div class="col-lg-2 col-md-6 col-12"><div class="form-group"><label>Disc. (%)</label><input name="serviceDisc[]" id="serviceDisc'+$(".servicerow").length+'" type="text" class="form-control" placeholder="" value="0" onkeyup="calcutateDiscount('+$(".servicerow").length+')"></div></div><div class="col-lg-3 col-md-6 col-12"><div class="form-group"><label>Total <i class="fa fa-inr"></i></label><input name="serviceTotal[]" type="text" class="form-control totalprice" placeholder="" id="serviceTotal'+$(".servicerow").length+'"></div></div><div class="col-lg-1 col-md-6 col-12"><div class="form-group"><label style="display: block; visibility: hidden;">Total</label><a href="javascript:void(0)" onclick="deleteServiceRow()"><i class="fa fa-trash-o mt-2"></i></div></div></div></div></div>');*/ 
        if ($(".servicerow").length == 1) {
            $(".serviceDivider").show();
        }
        $("#serviceRowCount").val($(".servicerow").length);
        $('#serviceDiv').children().last().find('.appendfocus').focus();
        $('.selectpicker').selectpicker();
    }

    function getServices(groupid,count) {
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
            /*$("#servicePrice"+count).val(res.result.service_price);
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
            /*$("#servicesSgst"+count).val(parseFloat(totalsgst).toFixed(2));
            $("#servicesCgst"+count).val(parseFloat(totalcgst).toFixed(2));
            calculatecash();*/
          }
        });
        // calculatecash();
      }
    }

    function calcutateDiscount(count) {
      var sgst = parseFloat(9);
      var cgst = parseFloat(9);
      var disc = $("#serviceDisc"+count).val();
      var price = $("#servicePrice"+count).val();
      var qty = $("#serviceQty"+count).val();
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
      $("#productDiv").append('<div class="row productRow"><div class="col-lg-3 col-md-12 col-12"><div class="form-group"><label>Product</label><select required name="products_'+$(".productRow").length+'" class="form-control" onchange="getProductPrice(this.value,'+$(".productRow").length+')"><option value="">Select</option><?php if (!empty($products)): ?><?php foreach ($products as $product): ?><option value="{{ $product->id }}">{{ $product->product_name }}</option><?php endforeach ?><?php endif ?></select></div>  </div><div class="col-lg-3 col-md-12 col-12"><div class="form-group"><label>Staff</label><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-heart-o"></i></span></div><select required name="productStaff'+$(".productRow").length+'" class="form-control"><option value="">Select</option><?php if (!empty($staffs)): ?><?php foreach ($staffs as $staff): ?><option value="{{ $staff->id }}">{{ $staff->name }}</option><?php endforeach ?><?php endif ?></select></div></div></div><div class="col-lg-6 col-md-12 col-12"><div class="row"><div class="col-lg-2 col-md-6 col-12"><div class="form-group"><label>Qty.</label><input name="productQty[]" type="text" class="form-control appendfocus" placeholder="" value="1" id="productQty'+$(".productRow").length+'" onkeyup="calcutateProductDiscount('+$(".productRow").length+')"></div></div>   <div class="col-lg-3 col-md-6 col-12"><div class="form-group"><label>Price <i class="fa fa-inr"></i></label><input name="productSgst[]" type="hidden" id="productSgst'+$(".productRow").length+'" class="sgstCount"><input name="productCgst[]" type="hidden" id="productCgst'+$(".productRow").length+'" class="cgstCount"><input name="productPriceTotal[]" type="hidden" id="productPriceTotal'+$(".productRow").length+'" class="countTotal"><input name="productPrice[]" type="text" class="form-control" placeholder="" id="productPrice'+$(".productRow").length+'"></div></div>  <div class="col-lg-2 col-md-6 col-12"><div class="form-group"><label>Disc. (%)</label><input name="productDisc[]" type="text" class="form-control" placeholder="" id="productDisc'+$(".productRow").length+'" value="0" onkeyup="calcutateProductDiscount('+$(".productRow").length+')"></div></div><div class="col-lg-3 col-md-6 col-12"><div class="form-group"><label>Total <i class="fa fa-inr"></i></label><input name="productTotal[]" type="text" class="form-control totalprice" placeholder="" id="productTotal'+$(".productRow").length+'"></div></div><div class="col-lg-1 col-md-6 col-12"><div class="form-group"><label style="display: block; visibility: hidden;">Total</label><a href="javascript:void(0)" onclick="deleteProductRow()"><i class="fa fa-trash-o mt-2"></i></div></div></div></div></div>');  
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
      $("#packageDiv").append('<div class="row packageRow"><div class="col-lg-3 col-md-12 col-12"><div class="form-group"><label>Package</label><select required name="package_'+ dynamic_rowcount +'" class="form-control" onchange="showServices(this.value,'+ dynamic_rowcount +')"><option value="">Select</option><?php if (!empty($packages)): ?><?php foreach ($packages as $package): ?><option value="{{ $package->package_id }}">{{ $package->package_title }}</option><?php endforeach ?><?php endif ?></select></div>  </div> <div class="col-lg-3 col-md-6 col-12"><div class="form-group"><label>Price <i class="fa fa-inr"></i></label><input name="pacakgePrice[]" type="text" class="form-control appendfocus" placeholder="" id="pacakgePrice'+ dynamic_rowcount +'"></div></div>  <div class="col-lg-2 col-md-6 col-12"><div class="form-group"><label>Disc. (%)</label><input name="packageSgst[]" type="hidden" id="packageSgst'+ dynamic_rowcount +'" class="sgstCount"><input name="packageCgst[]" type="hidden" id="packageCgst'+ dynamic_rowcount +'" class="cgstCount"><input name="packagePriceTotal[]" type="hidden" id="packagePriceTotal'+ dynamic_rowcount +'" class="countTotal"><input name="packageDisc[]" type="text" class="form-control" placeholder="" id="packageDisc'+ dynamic_rowcount +'"></div></div><div class="col-lg-3 col-md-6 col-12"><div class="form-group"><label>Total <i class="fa fa-inr"></i></label><input name="packageTotal[]" type="text" class="form-control totalprice" placeholder="" id="packageTotal'+ dynamic_rowcount +'"></div></div><div class="col-lg-1 col-md-6 col-12"><div class="form-group"><label style="display: block; visibility: hidden;">Total</label><a href="javascript:void(0)" onclick="deletePackageRow(this)"><i class="fa fa-trash-o mt-2"></i></div></div></div></div></div><div class="row dynamic_ddlrow" id="packageServiceRow'+ dynamic_rowcount +'"></div>');
      // $("#packageDiv").append('<div class="row packageRow"><div class="col-lg-3 col-md-12 col-12"><div class="form-group"><label>Package</label><select required name="package_'+$(".packageRow").length+'" class="form-control" onchange="showServices(this.value,'+$(".packageRow").length+')"><option value="">Select</option><?php if (!empty($packages)): ?><?php foreach ($packages as $package): ?><option value="{{ $package->package_id }}">{{ $package->package_title }}</option><?php endforeach ?><?php endif ?></select></div>  </div> <div class="col-lg-3 col-md-6 col-12"><div class="form-group"><label>Price <i class="fa fa-inr"></i></label><input name="pacakgePrice[]" type="text" class="form-control" placeholder="" id="pacakgePrice'+$(".packageRow").length+'"></div></div>  <div class="col-lg-2 col-md-6 col-12"><div class="form-group"><label>Disc. (%)</label><input name="packageSgst[]" type="hidden" id="packageSgst'+$(".packageRow").length+'" class="sgstCount"><input name="packageCgst[]" type="hidden" id="packageCgst'+$(".packageRow").length+'" class="cgstCount"><input name="packagePriceTotal[]" type="hidden" id="packagePriceTotal'+$(".packageRow").length+'" class="countTotal"><input name="packageDisc[]" type="text" class="form-control" placeholder="" id="packageDisc'+$(".packageRow").length+'"></div></div><div class="col-lg-3 col-md-6 col-12"><div class="form-group"><label>Total <i class="fa fa-inr"></i></label><input name="packageTotal[]" type="text" class="form-control totalprice" placeholder="" id="packageTotal'+$(".packageRow").length+'"></div></div><div class="col-lg-1 col-md-6 col-12"><div class="form-group"><label style="display: block; visibility: hidden;">Total</label><a href="javascript:void(0)" onclick="deletePackageRow(this)"><i class="fa fa-trash-o mt-2"></i></div></div></div></div></div><div class="row dynamic_ddlrow" id="packageServiceRow'+$(".packageRow").length+'"></div>');  
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
              $("#addmobile").val(number);
              $("#addcustid").val(res.last_id);
            }
          }
        });
        
      }
    }

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
            /*if(res != "" && res != null){
              $("#editcustomer").modal('hide');
              $("#customername").val(res.name);
            }else{
              alert("Failed");
            }*/
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
            }
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
              $("#remarkdiv").show();
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
        $("#remarkdiv").hide();
        $("#unpaidbtndiv").hide();
        $("#unpaidbtn").html('');
      }
    }
  </script>

@endsection