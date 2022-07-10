@extends('layouts.newlayout.app')
@section('content')
 <div class="main">
    <div class="main-content">
      <div class="container-fluid">
         <div class="boxbody">
            <ul class="nav nav-tabs2 nav-justified">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#Customer">Products</a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#Service">Service Segment</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#Upcoming">Upcoming Segment</a>
              </li> -->
            </ul>


            <div class="tab-content">
              <div class="tab-pane active" id="Customer">
                <form class="formvisit">  
                <div class="panelbox">
                  <div class="text-right mt-2 mb-2"><a data-toggle="modal" data-target="#addproduct" href="javascript:void(0)" class="theme-btn">New Product</a></div>
                  <div class="row">

                   <div class="col-lg-12 col-md-12 col-12 mt-3">
                     <h6><i class="fa fa-tasks"></i> Product Count <span id="productsCount"><?php echo count($products) ?></span></h6>
                      <div class="table-responsive">
                    <table class="table table-bordered table-striped recent-purchases-listing">
                      <thead>
                        <tr>
                          <th class="th-sm">Name</th>
                          <th class="th-sm">Firm name</th>
                          <th class="th-sm">Price</th>
                          <th class="th-sm">Quantity</th>
                          <th class="th-sm">Status</th>
                          <th class="th-sm">Action</th>
                        </tr>
                      </thead>
                      <tbody id="firmTableBody">
                        @foreach ($products as $cat)
                          <tr>
                            <td>{{ $cat->product_name }}</td>
                            <td>{{ $cat->firm_name }}</td>
                            <td>{{ $cat->product_price }}</td>
                            <td>{{ $cat->product_quantity }}</td>
                            <td>
                                @if($cat->status ==1)         
                                    In-stock        
                                @else
                                    Out-stock
                                @endif
                            </td>
                            <td>
                              <table >
                                <tr>
                                  <th style="padding: 0">
                                    <a href="javascript:void(0)" onclick="getProductById('{{$cat->id}}')" class="btn-primary btn-sm waves-effect waves-light text-light material-tooltip-main" data-toggle="tooltip" data-html="true" title="Edit">
                                      <i class="fa fa-edit"></i>
                                    </a>
                                  </th>
                                  <th style="padding: 0">
                                    <button onclick="deleteProduct('{{ $cat->id }}')" class="btn-danger btn-sm waves-effect waves-light material-tooltip-main" type="button" style="border:0 !important" data-toggle="tooltip" data-html="true" title="Delete"><i class="fa fa-close"></i></button>
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
<div class="modal" id="addproduct">
  <div class="modal-dialog modal-lg">
    <form id="addproductform" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Product</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
        <!-- Modal body -->
        <div class="modal-body formvisit">
          <div class="row">

            <div class="col-lg-4 col-md-12 col-12">
              <div class="form-group">
                <label>Select firm</label>
                <select class="form-control" name="firm" id="firm">
                  <option value="">Select</option>
                  <?php if (!empty($firms)): ?>
                    <?php foreach ($firms as $firm): ?>
                      <option value="{{ $firm->id }}">{{ $firm->firm_name }}</option>
                    <?php endforeach ?>
                  <?php endif ?>
                </select>
              </div>
            </div><!--./col-lg-4-->

            <div class="col-lg-4 col-md-12 col-12">
              <div class="form-group">
                <label>Product name</label>
                <input type="text" name="product_name" id="product_name" value="" placeholder="Enter product name"  class="form-control">
              </div>
            </div><!--./col-lg-4-->

            <div class="col-lg-4 col-md-12 col-12">
                <div class="form-group">
                  <label>Price</label>
                  <input id="product_price" name="product_price" value="" placeholder="Enter product price" type="number" class="form-control">
                </div>
            </div><!--./col-lg-4-->

            <div class="col-lg-4 col-md-12 col-12">
               <div class="form-group">
                  <label>Special price</label>
                  <input type="number"  id="special_price" name="special_price" value="" placeholder="Enter special price"  class="form-control">
                </div>
            </div><!--./col-lg-4-->

            <div class="col-lg-4 col-md-12 col-12">
               <div class="form-group">
                  <label>Quantity</label>
                  <input type="number"  id="product_quantity" name="product_quantity" value="" placeholder="Enter quantity"  class="form-control">
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

<div class="modal" id="editproduct">
  <div class="modal-dialog modal-lg">
    <form id="editproductform" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Product</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
        <input type = "hidden" name = "editproductid" id="editproductid">
        <!-- Modal body -->
        <div class="modal-body formvisit">
          <div class="row">
            <div class="col-lg-4 col-md-12 col-12">
              <div class="form-group">
                <label>Select firm</label>
                <select class="form-control" name="editfirm" id="editfirm">
                  <option value="">Select</option>
                  <?php if (!empty($firms)): ?>
                    <?php foreach ($firms as $firm): ?>
                      <option value="{{ $firm->id }}">{{ $firm->firm_name }}</option>
                    <?php endforeach ?>
                  <?php endif ?>
                </select>
              </div>
            </div><!--./col-lg-4-->

            <div class="col-lg-4 col-md-12 col-12">
              <div class="form-group">
                <label>Product name</label>
                <input type="text" name="editproduct_name" id="editproduct_name" value="" placeholder="Enter product name"  class="form-control">
              </div>
            </div><!--./col-lg-4-->

            <div class="col-lg-4 col-md-12 col-12">
                <div class="form-group">
                  <label>Price</label>
                  <input id="editproduct_price" name="editproduct_price" value="" placeholder="Enter product price" type="number" class="form-control">
                </div>
            </div><!--./col-lg-4-->

            <div class="col-lg-4 col-md-12 col-12">
               <div class="form-group">
                  <label>Special price</label>
                  <input type="number"  id="editspecial_price" name="editspecial_price" value="" placeholder="Enter special price"  class="form-control">
                </div>
            </div><!--./col-lg-4-->

            <div class="col-lg-4 col-md-12 col-12">
               <div class="form-group">
                  <label>Quantity</label>
                  <input type="number"  id="editproduct_quantity" name="editproduct_quantity" value="" placeholder="Enter quantity"  class="form-control">
                </div>
            </div><!--./col-lg-4-->
          </div><!--./row-->
        </div>
        <div class="modal-footer">
          <button type="button" class="outline-btn" data-dismiss="modal">Cancel</button> 
          <button type="submit" class="theme-btn">Update</button>
        </div>
      </div>
    </form>
  </div>
</div><!--#/addcustomer-->
<script src="{{asset('assets/js/lib/jquery.js')}}"></script>
<script src="{{asset('assets/js/dist/jquery.validate.js')}}"></script>
<script type="text/javascript">
  function deleteProduct(productid) {
    if (confirm('Do you really want delete this product?')) {
      if (productid != '') {
        // var formdata = $("#deleteProductForm").serialize();
        $.ajax({
          url:'{{ url("deleteProductById") }}',
          data:{'productid':productid},
          type:'POST',
          dataType:'JSON',
          success:function(res) {
            $("#productsCount").html(res.count);
            $("#firmTableBody").html(res.html);
          }
        });
      }
    }
  }
  $("#editproductform").validate({
      rules:{
        editfirm: "required",
        editproduct_name: "required",
        editproduct_price: "required",
        editproduct_quantity: "required",
      },
      messages:{
        editfirm: "Select firm name",
        editproduct_name: "Enter product name",
        editproduct_price: "Enter product price",
        editproduct_quantity: "Enter product quantity",
      },
      submitHandler: function() {
        var formdata = $("#editproductform").serialize();
        $.ajax({
          url:'{{ url("updateProduct") }}',
          data:formdata,
          type:'POST',
          dataType:"JSON",
          success:function(res) {
            $("#editproduct").modal('hide');
            $("#productsCount").html(res.count);
            $("#firmTableBody").html(res.html);
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
  function getProductById(productid) {
    if (productid != '') {
      $.ajax({
        url:'{{ url("getProductById") }}',
        type:'POST',
        data:{'productid':productid},
        dataType:'JSON',
        success:function(res) {
          $("#editproduct").modal('show');
          $("#editfirm").val(res.firm_id);
          $("#editproduct_name").val(res.product_name);
          $("#editproduct_price").val(res.product_price);
          $("#editspecial_price").val(res.special_price);
          $("#editproduct_quantity").val(res.product_quantity);
          $("#editproductid").val(res.id);
        }
      });
    }
  } 
  $("#addproductform").validate({
      rules:{
        firm: "required",
        product_name: "required",
        product_price: "required",
        product_quantity: "required",
      },
      messages:{
        firm: "Select firm name",
        product_name: "Enter product name",
        product_price: "Enter product price",
        product_quantity: "Enter product quantity",
      },
      submitHandler: function() {
        var formdata = $("#addproductform").serialize();
        $.ajax({
          url:'{{ route("products.store") }}',
          data:formdata,
          type:'POST',
          dataType:"JSON",
          success:function(res) {
            $("#addproduct").modal('hide');
            $("#productsCount").html(res.count);
            $("#firmTableBody").html(res.html);
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