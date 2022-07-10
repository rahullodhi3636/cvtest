@extends('layouts.newlayout.app')
@section('content')
 <div class="main">
    <div class="main-content">
      <div class="container-fluid">
         <div class="boxbody">
            <ul class="nav nav-tabs2 nav-justified">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#Customer">Membership</a>
              </li>
            </ul>


            <div class="tab-content">
              <div class="tab-pane active" id="Customer">
                <form class="formvisit">  
                <div class="panelbox">
                  <div class="text-right mt-2 mb-2"><a data-toggle="modal" data-target="#addmembership" href="javascript:void(0)" class="theme-btn">New Membership</a></div>
                  <div class="row">

                   <div class="col-lg-12 col-md-12 col-12 mt-3">
                     <h6><i class="fa fa-tasks"></i> Membership Count <span id="membershipCount"><?php echo count($memberships) ?></span></h6>
                      <div class="table-responsive">
                    <table class="table table-bordered table-striped recent-purchases-listing">
                      <thead>
                        <tr>
                          <th class="th-sm">Title</th>
                          <th class="th-sm">Firm name</th>
                          <th class="th-sm">Price</th>
                          <th class="th-sm">Validity (Days)</th>
                          <th class="th-sm">Action</th>
                        </tr>
                      </thead>
                      <tbody id="membershipTableBody">
                        @php 
                          $sn = 1
                          @endphp
                          @foreach ($memberships as $membership)
                            <tr>
                              <td>{{ $membership->membership_title }}</td>
                              <td>{{ $membership->firm_name }}</td>
                              <td>{{ $membership->membership_price }}</td>
                              <td>{{ $membership->membership_validity }}</td>
                              <td>
                                <table >
                                  <tr>
                                    <th style="padding: 0">
                                      <a href="javascript:void(0)" onclick="getMembership('{{ $membership->id }}')" class="theme-btn" data-toggle="tooltip" data-html="true" title="Edit">
                                        <i class="fa fa-edit"></i>
                                      </a>
                                      <!-- <a href="" class="btn btn-primary">Edit</a> -->
                                    </th>
                                    <th style="padding: 0">
                                      <button onclick="deleteMemberShip('{{ $membership->id }}')" class="theme-btn" type="button" style="border:0 !important" data-toggle="tooltip" data-html="true" title="Delete"><i class="fa fa-close"></i></button>
                                    </th>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                          @endforeach
                        
                      </tbody>
                    </table>
                  </div>
                     
                   </div><!--/col-lg-12--> 
                  </div><!--./row-->
                </div><!--./panelbox-->
               </form>    
              </div><!--./Customer-->
            </div><!--./tab-content-->
         </div><!--./boxbody-->
       </div><!--./container-fluid--> 
      <footer>Copyright © 2020 Chinnie & Vinnie Jabalpur Salon. All rights reserved.</footer> 
     </div><!--./main-content-->
      
   </div><!--./main-->
  <!-- The Modal -->
  <div class="modal" id="addmembership">
    <div class="modal-dialog modal-lg">
      <form id="addproductform" method="post">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Add Membership</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
          <!-- Modal body -->
          <div class="modal-body formvisit">
            <div class="row">

              <div class="col-lg-6 col-md-12 col-12">
                <div class="form-group">
                  <label>Select firm</label>
                  <select class="form-control" id="firm" name="firm">
                    <option value="">Select</option>
                    <?php if (!empty($firms)): ?>
                      <?php foreach ($firms as $firm): ?>
                        <option value="{{ $firm->id }}">{{ $firm->firm_name }}</option>
                      <?php endforeach ?>
                    <?php endif ?>
                  </select>
                </div>
              </div><!--./col-lg-4-->

              <div class="col-lg-6 col-md-12 col-12">
                <div class="form-group">
                  <label>Membership title</label>
                  <input type="text" name="title" id="title" value="" placeholder="Enter membership title"  class="form-control">
                </div>
              </div><!--./col-lg-4-->

              <div class="col-lg-6 col-md-12 col-12">
                 <div class="form-group">
                    <label>Price</label>
                    <input id="price" name="price" value="" placeholder="Enter membership price" type="number" class="form-control">
                  </div>
              </div><!--./col-lg-4-->

              <div class="col-lg-6 col-md-12 col-12">
                 <div class="form-group">
                    <label>Validity (Days)</label>
                    <input type="number" name="validity" id="validity" class="form-control" placeholder="Eg. 45">
                  </div>
              </div><!--./col-lg-4-->

              <div class="col-lg-6 col-md-12 col-12">
                 <div class="form-group">
                    <label>Discount type on service</label>
                    <select class="form-control" name="service_discount_type" id="service_discount_type">
                      <option value="">Select</option>
                      <option value="1">Percent</option>
                      <option value="2">Value</option>
                    </select>
                  </div>
              </div><!--./col-lg-4-->

              <div class="col-lg-6 col-md-12 col-12">
                 <div class="form-group">
                    <label>Discount on service</label>
                    <input type="number" name="service_discount" id="service_discount" class="form-control" placeholder="Eg. 45">
                  </div>
              </div><!--./col-lg-4-->

              <div class="col-lg-6 col-md-12 col-12">
                 <div class="form-group">
                    <label>Discount type on product</label>
                    <select class="form-control" name="product_discount_type" id="product_discount_type">
                      <option value="">Select</option>
                      <option value="1">Percent</option>
                      <option value="2">Value</option>
                    </select>
                  </div>
              </div><!--./col-lg-4-->

              <div class="col-lg-6 col-md-12 col-12">
                 <div class="form-group">
                    <label>Discount on product</label>
                    <input type="number" name="product_discount" id="product_discount" class="form-control" placeholder="Eg. 45">
                  </div>
              </div><!--./col-lg-4-->

              <!-- <div class="col-lg-4 col-md-12 col-12">
                 <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control col-md-7 col-xs-12" id="status">
                        <option value="1" {{ old('status') == '1'? 'selected' : '' }} >Active</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Deactive</option>
                    </select>
                  </div>
              </div> --><!--./col-lg-4-->
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
  <div class="modal" id="editmembership">
    <div class="modal-dialog modal-lg">
      <form id="editproductform" method="post">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Membership</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
          <input type ="hidden" name ="membershipid" id="membershipid">
          <!-- Modal body -->
          <div class="modal-body formvisit">
            <div class="row">

              <div class="col-lg-6 col-md-12 col-12">
                <div class="form-group">
                  <label>Select firm</label>
                  <select class="form-control" id="editfirm" name="editfirm">
                    <option value="">Select</option>
                    <?php if (!empty($firms)): ?>
                      <?php foreach ($firms as $firm): ?>
                        <option value="{{ $firm->id }}">{{ $firm->firm_name }}</option>
                      <?php endforeach ?>
                    <?php endif ?>
                  </select>
                </div>
              </div><!--./col-lg-4-->

              <div class="col-lg-6 col-md-12 col-12">
                <div class="form-group">
                  <label>Membership title</label>
                  <input type="text" name="edittitle" id="edittitle" value="" placeholder="Enter membership title"  class="form-control">
                </div>
              </div><!--./col-lg-4-->

              <div class="col-lg-6 col-md-12 col-12">
                  <div class="form-group">
                    <label>Price</label>
                    <input id="editprice" name="editprice" value="" placeholder="Enter membership price" type="number" class="form-control">
                  </div>
              </div><!--./col-lg-4-->

              <div class="col-lg-6 col-md-12 col-12">
                  <div class="form-group">
                    <label>Validity (Days)</label>
                    <input type="number" name="editvalidity" id="editvalidity" class="form-control" placeholder="Eg. 45">
                  </div>
              </div><!--./col-lg-4-->

              <div class="col-lg-6 col-md-12 col-12">
                 <div class="form-group">
                    <label>Discount type on service</label>
                    <select class="form-control" name="editservice_discount_type" id="editservice_discount_type">
                      <option value="">Select</option>
                      <option value="1">Percent</option>
                      <option value="2">Value</option>
                    </select>
                  </div>
              </div><!--./col-lg-4-->

              <div class="col-lg-6 col-md-12 col-12">
                 <div class="form-group">
                    <label>Discount on service</label>
                    <input type="number" name="editservice_discount" id="editservice_discount" class="form-control" placeholder="Eg. 45">
                  </div>
              </div><!--./col-lg-4-->

              <div class="col-lg-6 col-md-12 col-12">
                 <div class="form-group">
                    <label>Discount type on product</label>
                    <select class="form-control" name="editproduct_discount_type" id="editproduct_discount_type">
                      <option value="">Select</option>
                      <option value="1">Percent</option>
                      <option value="2">Value</option>
                    </select>
                  </div>
              </div><!--./col-lg-4-->

              <div class="col-lg-6 col-md-12 col-12">
                 <div class="form-group">
                    <label>Discount on product</label>
                    <input type="number" name="editproduct_discount" id="editproduct_discount" class="form-control" placeholder="Eg. 45">
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
<script src="{{asset('assets/js/lib/jquery.js')}}"></script>
<script src="{{asset('assets/js/dist/jquery.validate.js')}}"></script>
<script type="text/javascript">

  function deleteMemberShip(membershipid) {
    if (confirm('Do you really want delete this membership?')) {
      if (membershipid != '') {
        $.ajax({
          url:'{{ url("deleteMemberShip") }}',
          type:'POST',
          data:{'membershipid':membershipid},
          dataType:'JSON',
          success:function(res) {
            $("#membershipTableBody").html(res.html);
            $("#membershipCount").html(res.count);
          }
        });
      }
    }
  }

  $("#editproductform").validate({
    rules:{
      editfirm: "required",
      edittitle: "required",
      editprice: "required",
      editvalidity: "required",
    },
    messages:{
      editfirm: "Select firm",
      edittitle: "Enter title",
      editprice: "Enter price",
      editvalidity: "Enter validity",
    },
    submitHandler: function() {
      var formdata = $("#editproductform").serialize();
      $.ajax({
        url:'{{ url("updateMembership") }}',
        data:formdata,
        type:'POST',
        dataType:"JSON",
        success:function(res) {
          $("#editmembership").modal('hide');
          $("#membershipTableBody").html(res.html);
          $("#membershipCount").html(res.count);
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

  function getMembership(membershipid) {
    if (membershipid != '') {
      $.ajax({
        url:'{{ url("getMembership") }}',
        type:'POST',
        data:{'membershipid':membershipid},
        dataType:'JSON',
        success:function(res) {
          $("#editmembership").modal('show');
          $("#membershipid").val(res.id);
          $("#editfirm").val(res.firm_id);
          $("#edittitle").val(res.membership_title);
          $("#editprice").val(res.membership_price);
          $("#editvalidity").val(res.membership_validity);
          $("#editservice_discount_type").val(res.service_discount_type);
          $("#editservice_discount").val(res.service_discount);
          $("#editproduct_discount_type").val(res.product_discount_type);
          $("#editproduct_discount").val(res.product_discount);
        }
      });
    }
  }

  $("#addproductform").validate({
    rules:{
      firm: "required",
      title: "required",
      price: "required",
      validity: "required",
    },
    messages:{
      firm: "Select firm",
      title: "Enter title",
      price: "Enter price",
      validity: "Enter validity",
    },
    submitHandler: function() {
      var formdata = $("#addproductform").serialize();
      $.ajax({
        url:'{{ route("membership.store") }}',
        data:formdata,
        type:'POST',
        dataType:"JSON",
        success:function(res) {
          $("#addmembership").modal('hide');
          $("#membershipTableBody").html(res.html);
          $("#membershipCount").html(res.count);
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
</script>
@endsection