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
                  <div class="text-right mt-2 mb-2"><a href="javascript:void(0)" data-toggle="modal" data-target="#addpackage" class="theme-btn">Add Package</a></div>
                  <div class="row">

                   <div class="col-lg-12 col-md-12 col-12 mt-3">
                     <h6><i class="fa fa-tasks"></i> Package Count <span id="packageCount"><?php echo count($packages) ?></span></h6>
                      <div class="table-responsive">
                    <table class="table table-bordered table-striped recent-purchases-listing">
                      <thead>
                        <tr>
                          <th class="th-sm">Title</th>
                          <th class="th-sm">Firm</th>
                          <th class="th-sm">Services</th>
                          <th class="th-sm">Total Free in package</th>
                          <th class="th-sm">Status</th>
                          <th class="th-sm">Action</th>
                        </tr>
                      </thead>
                      <tbody id="packageTableBody">
                        @php 
                          $sn = 1
                          @endphp
                          @foreach ($packages as $cat)
                            <tr>
                              <td>{{ $cat->package_title }}</td>
                              <td>{{ $cat->firm_name }}</td>
                              <td>{{ $cat->serviceName }}</td>
                              <td>{{ $cat->totalTime }}</td>
                              <td>
                                  @if($cat->package_satus ==1)         
                                      Active        
                                  @else
                                      Deactive
                                  @endif
                              </td>
                              <td>
                                <table >
                                  <tr>
                                    <th style="padding: 0">
                                      <a href="javascript:void(0)" onclick="getPackage('{{ $cat->package_id }}')" class="theme-btn" data-toggle="tooltip" data-html="true" title="Edit">
                                        <i class="fa fa-edit"></i>
                                      </a>
                                      <!-- <a href="" class="btn btn-primary">Edit</a> -->
                                    </th>
                                    <th style="padding: 0">
                                      <button class="theme-btn" onclick="deletePackage('{{ $cat->package_id }}')" type="button" style="border:0 !important" data-toggle="tooltip" data-html="true" title="Delete"><i class="fa fa-close"></i></button>
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
  <div class="modal" id="addpackage">
    <div class="modal-dialog modal-lg">
      <form id="addpackageform" method="post">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Add Package</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
          <!-- Modal body -->
          <div class="modal-body formvisit">
            <div class="row">

              <div class="col-lg-8 col-md-12 col-12">
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
                  <label>Package name</label>
                  <input type="text" name="title" id="title" value="" placeholder="Enter membership title"  class="form-control">
                </div>
              </div><!--./col-lg-4-->

              <div class="col-lg-6 col-md-12 col-12">
                 <div class="form-group">
                    <label>Package Type</label>
                    <select name="packagetype" class="form-control" id="packagetype">
                        <option value="">Select</option>
                        <option value="1">Premium</option>
                        <option value="0">Normal</option>
                    </select>
                  </div>
              </div>

              <div class="col-lg-6 col-md-12 col-12">
                 <div class="form-group">
                    <label>Package validity type</label>
                    <select name="validityType" class="form-control" id="validityType">
                        <option value="">Select</option>
                        <option value="1">Days</option>
                        <option value="2">Weeks</option>
                        <option value="3">Months</option>
                        <option value="4">Years</option>
                    </select>
                  </div>
              </div>

              <div class="col-lg-6 col-md-12 col-12">
                <div class="form-group">
                  <label>Package validity</label>
                  <input type="number" name="validity" id="validity" value="" placeholder="Eg. 10"  class="form-control">
                </div>
              </div><!--./col-lg-4-->

              <div class="col-lg-6 col-md-12 col-12">
                 <div class="form-group">
                    <label>Total members</label>
                    <input id="members" name="members" value="" placeholder="Enter total members" type="number" class="form-control">
                  </div>
              </div>
              <div class="col-lg-6 col-md-12 col-12">
                 <div class="form-group">
                    <label>Price</label>
                    <input id="price" name="price" value="" placeholder="Enter membership price" type="number" class="form-control">
                  </div>
              </div><!--./col-lg-4-->

              <div class="col-lg-12 col-md-12 col-12">
                 <div class="form-group">
                    <label>Services</label>
                  </div>
              </div><!--./col-lg-4-->

              <div class="col-lg-12 col-md-12 col-12">
                 <div class="row">
                   <table class="table order-list" id="myTable">
                    <thead>
                      <th>Service</th>
                      <th>Total service provide</th>
                      <th></th>
                      <th></th>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <select required class="form-control" id="services" name="services[]">
                            <option value="">Select</option>
                            @foreach ($services as $service)
                             <option value="{{ $service->id }}">{{ $service->name }}</option>
                            @endforeach
                          </select>
                        </td>
                        <td><input type="number" required id="total" name="total[]" value="{{ old('total') }}" placeholder="Enter package total service provide"  class="form-control"></td>
                        <td><input type="button" class="btn btn-md btn-success " id="addrow" value="Add"></td>
                        <td></td>
                      </tr>
                    </tbody>
                  </table>
                 </div>
              </div><!--./col-lg-4-->
              <!-- <div class="col-lg-6 col-md-12 col-12">
                 <div class="form-group">
                    <label>Special Price</label>
                    <input id="price" name="price" value="" placeholder="Enter membership price" type="number" class="form-control">
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

  <div class="modal" id="editpackage">
    <div class="modal-dialog modal-lg">
      <form id="editpackageform" method="post">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Package</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
          <!-- Modal body -->
          <div class="modal-body formvisit" id="editpackageBody">
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
  $("#editpackageform").validate({
    rules:{
      editfirm: "required",
      edittitle: "required",
      editvalidityType: "required",
      editvalidity: "required",
      editmembers: "required",
      editprice: "required",
      editpackagetype: "required",
    },
    messages:{
      editfirm: "Select firm",
      edittitle: "Enter title",
      editvalidityType: "Select validity type",
      editvalidity: "Enter validity",
      editmembers: "Enter members",
      editprice: "Enter price",
      editpackagetype: "Select package type",
    },
    submitHandler: function() {
      var formdata = $("#editpackageform").serialize();
      $.ajax({
        url:'{{ url("updatePackage") }}',
        data:formdata,
        type:'POST',
        dataType:"JSON",
        success:function(res) {
          $("#editpackage").modal('hide');
          $("#packageTableBody").html(res.html);
          $("#packageCount").html(res.count);
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

  function getPackage(packageid) {
    if(packageid != ''){
      $.ajax({
        url:'{{ url("getPackageById") }}',
        type:'POST',
        data:{'packageid':packageid},
        // dataType:'JSON',
        success:function(res) {
          $("#editpackage").modal('show');
          $("#editpackageBody").html(res);
        }
      });
    }
  }
  function deletePackage(packageid) {
    if (confirm('Do you really want delete this package?')) {
      if (packageid != '') {
        $.ajax({
          url:'{{ url("deletePackage") }}',
          type:'POST',
          data:{'packageid':packageid},
          dataType:'JSON',
          success:function(res) {
            $("#packageTableBody").html(res.html);
            $("#packageCount").html(res.count);
          }
        });
      }
    }
  }
  $("#addpackageform").validate({
    rules:{
      firm: "required",
      title: "required",
      validityType: "required",
      validity: "required",
      members: "required",
      price: "required",
    },
    messages:{
      firm: "Select firm",
      title: "Enter title",
      validityType: "Select validity type",
      validity: "Enter validity",
      members: "Enter members",
      price: "Enter price",
    },
    submitHandler: function() {
      var formdata = $("#addpackageform").serialize();
      $.ajax({
        url:'{{ route("packages.store") }}',
        data:formdata,
        type:'POST',
        dataType:"JSON",
        success:function(res) {
          $("#addpackage").modal('hide');
          $("#packageTableBody").html(res.html);
          $("#packageCount").html(res.count);
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
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function () {
      var counter = 0;

      $("#addrow").on("click", function () {
          var newRow = $("<tr>");
          var cols = "";

          cols += '<td><select required class="form-control" id="services' + counter + '" name="services[]"><option value="">Select</option>@foreach ($services as $service)<option value="{{ $service->id }}">{{ $service->name }}</option>@endforeach</select></td>';
          cols += '<td><input required type="number"  id="total' + counter + '" name="total[]" value="{{ old("total") }}" placeholder="Enter package total service provide"  class="form-control"></td>';
          // cols += '<td><input type="text" class="form-control" name="phone' + counter + '"/></td>';

          cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td><td></td>';
          newRow.append(cols);
          $("table.order-list").append(newRow);
          counter++;
      });



      $("table.order-list").on("click", ".ibtnDel", function (event) {
          $(this).closest("tr").remove();       
          counter -= 1
      });
    });
  </script>
@endsection