@extends('layouts.newlayout.app')
@section('content')
 <div class="main">
    <div class="main-content">
      <div class="container-fluid">
         <div class="boxbody">
            <ul class="nav nav-tabs2 nav-justified">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#Customer">Range</a>
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
                  {{-- <div class="text-right mt-2 mb-2"><a href="#"  onclick="addBrand()" class="theme-btn">Add Brand</a></div> --}}
                  <div class="text-right mt-2 mb-2"><a href="#"  onclick="addServiceRange('{{ $serviceid }}','{{ $subid }}','{{ $brandid }}')" class="theme-btn">Add Range</a></div>
                  <!-- <div class="text-right mt-2 mb-2"><a data-toggle="modal" data-target="#addfirm" href="javascript:void(0)" class="theme-btn">New Service</a></div> -->
                  <div class="row">

                   <div class="col-lg-12 col-md-12 col-12 mt-3">
                     <h6><i class="fa fa-tasks"></i> Service Name : <span id="customerCount"><?php echo $service; ?></span> || Category Name : <span id="customerCount"><?php echo $category; ?></span>|| Brand Name : <span id="customerCount"><?php echo $brands; ?></span></h6>
                     <h6><i class="fa fa-tasks"></i> Brand Count - <span id="customerCount"><?php echo count($subcat) ?></span></h6>
                     <div class="bs-example">
                      <div class="accordion" id="accordionExample">
                          <div class="table table-responsive">
                              <table class="table table-bordered table-striped">
                                  <thead>
                                      <th>S.No.</th>
                                      <th> Name</th>
                                      <th> Price</th>
                                      <th> Special Price</th>
                                      <th> Duration</th>
                                      <th>Action</th>
                                  </thead>
                                  <tbody>

                                
                        <?php if (!empty($subcat)): ?>
                          <?php 
                          $count=1;
                            foreach ($subcat as $sub): 
                              // $services = DB::table('services')->where('group_id',$group->id)->get();
                           
                          ?>
                                <tr>
                                    <td><?php echo $count++; ?></td>
                                    <td><?php echo $sub->brand_name ?></td>
                                    <td><?php echo $sub->service_price ?></td>
                                    <td><?php echo $sub->special_price ?></td>
                                    <td><?php echo $sub->service_duration ?></td>
                                    <td>
                                        <i class="fa fa-edit text-info" onclick="getGroup('<?php echo $sub->service_brand_id; ?>')"></i> | 
                                        <i class="fa fa-trash text-danger" onclick="deletebrandRange('<?php echo $sub->service_brand_id; ?>')"></i> 
                                       
                                    </td>
                                </tr>
                            
                          <?php endforeach ?>
                        <?php endif ?>
                                </tbody>
                            </table>
                        </div>
                      </div>
                    </div>
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
    <div class="modal" id="addservicegroup">
      <div class="modal-dialog modal-sm">
        <form id="servicegroupform" method="post">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Group</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
            <!-- Modal body -->
            <div class="modal-body formvisit">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
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
                <div class="col-lg-12 col-md-12 col-12">
                  <div class="form-group">
                    <label>Group Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Enter group name"  class="form-control">
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

    <!-- The Modal -->
    <div class="modal" id="addBrand">
      <div class="modal-dialog modal-sm">
        <form id="addBrandform" method="post">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Brand</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
            <input type = "hidden" name = "serviceid" id="serviceid" value = "">
            <input type = "hidden" name = "subServiceid" id="subServiceid" value = "">
            <!-- Modal body -->
            <div class="modal-body formvisit">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                  <div class="form-group">
                    <label>Brand Name</label>
                    <input type="text" name="brand_name" id="brand_name" value="" placeholder="Enter Brand Name"  class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label>Brand Description</label>
                    <textarea  name="brand_description" id="brand_description" value="" placeholder="Enter Brand Description"  class="form-control" required></textarea>
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

    <div class="modal" id="editsubcatgroup">
      <div class="modal-dialog modal-sm">
        <form id="editsubcatgroupform" method="post">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Sub-Category</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
            <input type = "hidden" name = "editsubcatgroupid" id="editsubcatgroupid">
            <!-- Modal body -->
            <div class="modal-body formvisit">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                  <div class="form-group">
                    <label>Sub-Category Name</label>
                    <input type="text" name="editsubcat_name" id="editsubcat_name" value="{{ old('name') }}" placeholder="Enter group name"  class="form-control">
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

    <!-- The Modal -->
    <div class="modal" id="addservicerangepopup">
      <div class="modal-dialog modal-lg">
        <form id="servicerangeform" method="post">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Service</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
            <input type="hidden" name="serviceidss" id="serviceidss">
            <input type="hidden" name="cateid" id="cateid">
            <input type="hidden" name="brandid" id="brandid">
            <!-- Modal body -->
            <div class="modal-body formvisit">
              <div class="row">
               
                <div class="col-lg-12 col-md-12 col-12">
                 <div class="row">
                   <table class="table order-list" id="myTable">
                    <thead>
                      <th>Type</th>
                      <th>Price</th>
                      <th>Special Price</th>
                      <th>Duration</th>
                      <th>Description</th>
                      <th></th>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <input type="text" required name="brandname[]" id="brandname" class="form-control" placeholder="Enter brand name">
                        </td>
                        <td><input required type="number" id="serviceprice" name="serviceprice[]" placeholder="Enter price"  class="form-control"></td>
                        <td><input type="number" id="specialserviceprice" name="specialserviceprice[]" placeholder="Enter special price"  class="form-control"></td>
                        <td><input type="number" id="brandDuration" name="brandDuration[]" placeholder="Eg 30"  class="form-control"></td>
                        <td><textarea class="form-control" name="service_description[]" id="service_description" placeholder="Enter description"></textarea></td>
                        <td><input type="button" class="btn btn-md btn-success " id="addrow" value="Add"></td>
                        <td></td>
                      </tr>
                    </tbody>
                  </table>
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

    <div class="modal" id="editservicerangepopup">
      <div class="modal-dialog modal-lg">
        <form id="servicerangeformedt" method="post">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Service</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
            <input type="hidden" name="serviceidss" id="serviceidss">
            <input type="hidden" name="cateid" id="cateid">
            <input type="hidden" name="rangid" id="rangid">
            <!-- Modal body -->
            <div class="modal-body formvisit">
              <div class="row">
               
                <div class="col-lg-12 col-md-12 col-12">
                 <div class="row">
                   <table class="table order-list" id="myTable">
                    <thead>
                      <th>Type</th>
                      <th>Price</th>
                      <th>Special Price</th>
                      <th>Duration</th>
                      <th>Description</th>
                      <th></th>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <input type="text" required name="brandnam" id="brandnameedt" class="form-control" placeholder="Enter brand name">
                        </td>
                        <td><input required type="number" id="servicepriceedt" name="serviceprice" placeholder="Enter price"  class="form-control"></td>
                        <td><input type="number" id="specialservicepriceedt" name="specialserviceprice" placeholder="Enter special price"  class="form-control"></td>
                        <td><input type="number" id="brandDurationedt" name="brandDuration" placeholder="Eg 30"  class="form-control"></td>
                        <td><textarea class="form-control" name="service_description" id="service_descriptionedt" placeholder="Enter description"></textarea></td>
                        {{-- <td><input type="button" class="btn btn-md btn-success " id="addrowedt" value="Add"></td> --}}
                        <td></td>
                      </tr>
                    </tbody>
                  </table>
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

    <!-- The Modal -->
    <div class="modal" id="editservicepopup">
      <div class="modal-dialog modal-lg" id="editservicebody">
        
      </div>
    </div><!--#/addcustomer-->

    <div class="modal" id="editgroup">
      <div class="modal-dialog modal-sm">
        <form id="editgroupform" method="post">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Group</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
            <input type = "hidden" name = "editgroupid" id="editgroupid">
            <!-- Modal body -->
            <div class="modal-body formvisit">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
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
                <div class="col-lg-12 col-md-12 col-12">
                  <div class="form-group">
                    <label>Group Name</label>
                    <input type="text" name="editname" id="editname" value="{{ old('name') }}" placeholder="Enter group name"  class="form-control">
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
    <div class="modal" id="viewservices" tabindex="-1" role="dialog" >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="title"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="modal_body">
            <p>Modal body text goes here.</p>
          </div>
          <div class="modal-footer">             
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function(){
        // Add minus icon for collapse element which is open by default
        $(".collapse.show").each(function(){
          $(this).prev(".card-header").find(".fa").addClass("fa-minus").removeClass("fa-plus");
        });
        
        // Toggle plus minus icon on show hide of collapse element
        $(".collapse").on('show.bs.collapse', function(){
          $(this).prev(".card-header").find(".fa").removeClass("fa-plus").addClass("fa-minus");
        }).on('hide.bs.collapse', function(){
          $(this).prev(".card-header").find(".fa").removeClass("fa-minus").addClass("fa-plus");
        });
    });
</script>
<script src="{{asset('assets/js/lib/jquery.js')}}"></script>
<script src="{{asset('assets/js/dist/jquery.validate.js')}}"></script>
<script type="text/javascript">
  function addBrand(servicid,subserid) {
    if (servicid != '' && subserid != '') {
      $("#addBrand").modal('show');
      $("#serviceid").val(servicid);
      $("#subServiceid").val(subserid);
    }
  }

  $("#addBrandform").validate({
    rules:{
      subcat_name: "required",
    },
    messages:{
      subcat_name: "Enter Brand Name",
    },
    submitHandler:function() {
      var formdata = $("#addBrandform").serialize();
      $.ajax({
        url:'{{ url("admin/addBrandform") }}',
        type:'POST',
        data:formdata,
        success:function(res) {
          if (res == "Done") {
            window.location.reload();
          }else{
            alert("Failed");
          }
        }
      });
    }
  });

  $("#editserviceform").validate({
    rules:{
      editservice_name: "required",
      editservice_duration: "required",
      // editservice_price: "required",
      edittag_staff: "required",
    },
    messages:{
      editservice_name: "required",
      editservice_duration: "required",
      // editservice_price: "required",
      edittag_staff: "required",
    },
    submitHandler:function(res) {
      var formdata = $("#editserviceform").serialize();
      $.ajax({
        url:'{{ url("updateService") }}',
        data:formdata,
        type:'POST',
        // dataType:'JSON',
        success:function(res) {
          if (res == 'Done') {
            window.location.reload();
          }else{
            alert("Failed");
          }
        }
      });
    }
  });

  $("#editsubcatgroupform").validate({
      rules:{
        editsubcat_name: "required",
      },
      messages:{
        editsubcat_name: "Enter sub-category name",        
      },
      submitHandler: function() {
        var formdata = $("#editsubcatgroupform").serialize();
        $.ajax({
          url:'{{ url("updateServiceSubCat") }}',
          data:formdata,
          type:'POST',
          // dataType:"JSON",
          success:function(res) {
            if (res == "Done") {
              window.location.reload();
            }else{
              alert("Failed");
            }
          },
          error: function (request, status, error) {
              if( request.status === 422 ) {
                  // var errors = $.parseJSON(reject.responseText);
                  alert(request.responseJSON.errors.editsubcat_name);
                  /*$.each(errors, function (key, val) {
                      $("#" + key + "_error").text(val[0]);
                      alert($("#" + key + "_error").text(val[0]))
                  });*/
              }
          }
        });
      },
  });

  function getServiceSubCatById(subcatid) {
    if (subcatid != '') {
      $.ajax({
        url:'{{ url("editServiceSubCat") }}',
        type:'POST',
        data:{'groupid':subcatid},
        dataType:'JSON',
        success:function(res) {
          $("#editsubcatgroup").modal('show');
          $("#editsubcatgroupid").val(res.id);
          $("#editsubcat_name").val(res.group_name);
        }
      });
    }
  }

  function getServiceById(serviceid) {
 
$("#viewservices").modal('hide');
    if (serviceid != '') {
      $.ajax({
        url:'{{ url("editService") }}',
        type:'POST',
        data:{'serviceid':serviceid},
        // dataType:'JSON',
        success:function(res) {        
          $("#editservicepopup").modal('show');          
          $("#editservicebody").html(res);        
          
        }
      });
    }
  }
</script>
<script type="text/javascript">
  $("#servicerangeform").validate({
    rules:{
      service_name: "required",
      service_duration: "required",
      service_price: "required",
      tag_staff: "required",
    },
    messages:{
      service_name: "Service name required",
      service_duration: "Service duration required",
      service_price: "Service price required",
      tag_staff: "Select at least 1 staff",
    },
    submitHandler: function() {
      var formdata = $("#servicerangeform").serialize();
      $.ajax({
        url:'{{ url("admin/SaveRange_By_brand") }}',
        data:formdata,
        type:'POST',
        // dataType:'JSON',
        success:function(res) {
          if (res == 'Done') {
            window.location.reload();
          }else{
            alert("Failed");
            console.log(res);
          }
        },
        error: function (request, status, error) {
              if( request.status === 422 ) {
                  // var errors = $.parseJSON(reject.responseText);
                  alert(request.responseJSON.errors.service_name);
                  $('#service_name').focus();
                  /*$.each(errors, function (key, val) {
                      $("#" + key + "_error").text(val[0]);
                      alert($("#" + key + "_error").text(val[0]))
                  });*/
              }
          }
      });
    }
  });

  $("#servicerangeformedt").validate({
    rules:{
      service_name: "required",
      service_duration: "required",
      service_price: "required",
      tag_staff: "required",
    },
    messages:{
      service_name: "Service name required",
      service_duration: "Service duration required",
      service_price: "Service price required",
      tag_staff: "Select at least 1 staff",
    },
    submitHandler: function() {
      var formdata = $("#servicerangeformedt").serialize();
      $.ajax({
        url:'{{ url("admin/editRange_By_brand") }}',
        data:formdata,
        type:'POST',
        // dataType:'JSON',
        success:function(res) {
          if (res == 'Done') {
            window.location.reload();
          }else{
            alert("Failed");
            console.log(res);
          }
        },
        error: function (request, status, error) {
              if( request.status === 422 ) {
                  // var errors = $.parseJSON(reject.responseText);
                  alert(request.responseJSON.errors.service_name);
                  $('#service_name').focus();
                  /*$.each(errors, function (key, val) {
                      $("#" + key + "_error").text(val[0]);
                      alert($("#" + key + "_error").text(val[0]))
                  });*/
              }
          }
      });
    }
  });
  function addServiceRange(serviceid,cateid,brandid) {
    if (serviceid != '') {
      $("#addservicerangepopup").modal('show');
      $("#serviceidss").val(serviceid);
      $("#cateid").val(cateid);
      $("#brandid").val(brandid);
    }
  }
  $("#editgroupform").validate({
      rules:{
        editfirm: "required",
        editname: "required",
      },
      messages:{
        editfirm: "Please select firm",        
        editname: "Please enter group name",        
      },
      submitHandler: function() {
        var formdata = $("#editgroupform").serialize();
        $.ajax({
          url:'{{ url("updateGroup") }}',
          data:formdata,
          type:'POST',
          dataType:"JSON",
          success:function(res) {
            $("#editgroup").modal('hide');
            //$("#accordionExample").html(res.html);
             window.location.reload();
          },
          error: function (request, status, error) {
              if( request.status === 422 ) {
                  // var errors = $.parseJSON(reject.responseText);
                  alert(request.responseJSON.errors.editname);
                  /*$.each(errors, function (key, val) {
                      $("#" + key + "_error").text(val[0]);
                      alert($("#" + key + "_error").text(val[0]))
                  });*/
              }
          }
        });
      },
  });
  function getGroup(groupid) {
    if (groupid != '') {
      $.ajax({
        url:'{{ url("getGroupRang") }}',
        type:'POST',
        data:{'_token':'{{CSRF_Token()}}','groupid':groupid},
        dataType:'JSON',
        success:function(res) {
          // alert(res);
          $("#editservicerangepopup").modal('show');
          $("#rangid").val(res.service_brand_id);
          $("#brandnameedt").val(res.brand_name);
          $("#servicepriceedt").val(res.service_price);
          $("#specialservicepriceedt").val(res.special_price);
          $("#brandDurationedt").val(res.service_duration);
          $("#service_descriptionedt").val(res.service_description);
          // $("#editfirm").val(res.firm_id);
          // $("#editname").val(res.group_name);
        }
      });
    }
  } 
  $("#servicegroupform").validate({
      rules:{
        firm: "required",
        name: "required",
      },
      messages:{
        firm: "Please select firm",        
        name: "Please enter group name",        
      },
      submitHandler: function() {
        var formdata = $("#servicegroupform").serialize();
        $.ajax({
          url:'{{ url("addServiceGroup") }}',
          data:formdata,
          type:'POST',
          dataType:"JSON",
          success:function(res) {
            $("#addservicegroup").modal('hide');
            $("#accordionExample").html(res.html);
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

    // $("#addrow").on("click", function () {
    //     var newRow = $("<tr>");
    //     var cols = "";

    //     cols += '<td><input required type="text" name="brandname[]" id="brandname' + counter + '" class="form-control" placeholder="Enter brand name"></td>';
    //     // cols += '';
    //     cols += '<td><input required type="number" required id="serviceprice' + counter + '" name="serviceprice[]" placeholder="Enter price"  class="form-control"></td>';
    //     cols += '<td><input type="number" required id="specialserviceprice' + counter + '" name="specialserviceprice[]" placeholder="Enter special price"  class="form-control"></td>';
    //     cols += '<td><input type="number" id="brandDuration' + counter + '" name="brandDuration[]" placeholder="Eg 30"  class="form-control"></td>';
    //     cols += '<td><textarea class="form-control" name="service_description[]" id="service_description' + counter + '" placeholder="Enter description"></textarea></td>';
    //     cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td><td></td>';
    //     newRow.append(cols);
    //     $("table.order-list").append(newRow);
    //     counter++;
    // });



    $("table.order-list").on("click", ".ibtnDel", function (event) {
        $(this).closest("tr").remove();       
        counter -= 1
    });
  });

  function viewservicesmodal(id) { 
       
    if (id != '') {
                 $('#viewservices').modal('show');
                 $.get('{{ url('mainservicesmodal') }}', {id: id}, function (data) {
                $('#title').html('View Services');
                $('#modal_body').html(data);
            });
        }
    }
 
  
</script>
{{-- PRANAV --}}
 <!-- The Modal -->
 <div class="modal" id="addservicegroup">
  <div class="modal-dialog modal-sm">
    <form id="servicegroupform" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Group</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
        <!-- Modal body -->
        <div class="modal-body formvisit">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
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
            <div class="col-lg-12 col-md-12 col-12">
              <div class="form-group">
                <label>Group Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Enter group name"  class="form-control">
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

<!-- The Modal -->


<div class="modal" id="editsubcatgroup">
  <div class="modal-dialog modal-sm">
    <form id="editsubcatgroupform" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Sub-Category</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
        <input type = "hidden" name = "editsubcatgroupid" id="editsubcatgroupid">
        <!-- Modal body -->
        <div class="modal-body formvisit">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
              <div class="form-group">
                <label>Sub-Category Name</label>
                <input type="text" name="editsubcat_name" id="editsubcat_name" value="{{ old('name') }}" placeholder="Enter group name"  class="form-control">
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

<!-- The Modal -->
<div class="modal" id="addservicepopup">
  <div class="modal-dialog modal-lg">
    <form id="serviceform" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Service</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
        <input type="hidden" name="service_groupid" id="service_groupid">
        <!-- Modal body -->
        <div class="modal-body formvisit">
          <div class="row">
            <div class="col-lg-4 col-md-12 col-12">
              <div class="form-group">
                <label>Service Name</label>
                <input type="text" name="service_name" id="service_name" value="{{ old('name') }}" placeholder="Enter service name"  class="form-control">
              </div>
            </div><!--./col-lg-4-->
            <div class="col-lg-4 col-md-12 col-12">
              <div class="form-group">
                <label>Service Duration</label>
                <input type="text" name="service_duration" id="service_duration" value="{{ old('name') }}" placeholder="Enter service duration"  class="form-control">
              </div>
            </div><!--./col-lg-4-->
            <div class="col-lg-4 col-md-12 col-12">
              <div class="form-group">
                <label>Tag Staff</label>
                <select required class="form-control selectpicker" multiple data-live-search="true" name="tag_staff[]" id="tag_staff">
                  <?php if (!empty($staff)): ?>
                    <?php foreach ($staff as $value): ?>
                      <option value="{{ $value->id }}">{{ $value->name }}</option>
                    <?php endforeach ?>
                  <?php endif ?>
                </select>
              </div>
            </div><!--./col-lg-4-->
            <div class="col-lg-12 col-md-12 col-12">
             <div class="row">
               <table class="table order-list" id="myTable">
                <thead>
                  <th>Brand</th>
                  <th>Price</th>
                  <th>Special Price</th>
                  <th>Duration</th>
                  <th>Description</th>
                  <th></th>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <input type="text" required name="brandname[]" id="brandname" class="form-control" placeholder="Enter brand name">
                    </td>
                    <td><input required type="number" id="serviceprice" name="serviceprice[]" placeholder="Enter price"  class="form-control"></td>
                    <td><input type="number" id="specialserviceprice" name="specialserviceprice[]" placeholder="Enter special price"  class="form-control"></td>
                    <td><input type="number" id="brandDuration" name="brandDuration[]" placeholder="Eg 30"  class="form-control"></td>
                    <td><textarea class="form-control" name="service_description[]" id="service_description" placeholder="Enter description"></textarea></td>
                    <td><input type="button" class="btn btn-md btn-success " id="addrow" value="Add"></td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
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

<!-- The Modal -->
<div class="modal" id="editservicepopup" >
  <div class="modal-dialog modal-lg" id="editservicebody">
    
  
              
                
  </div>
</div><!--#/addcustomer-->

<div class="modal" id="editgroup" >
  <div class="modal-dialog modal-sm">
    <form id="editgroupform" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Group</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
        <input type = "hidden" name = "editgroupid" id="editgroupid">
        <!-- Modal body -->
        <div class="modal-body formvisit">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
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
            <div class="col-lg-12 col-md-12 col-12">
              <div class="form-group">
                <label>Group Name</label>
                <input type="text" name="editname" id="editname" value="{{ old('name') }}" placeholder="Enter group name"  class="form-control">
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
    // Add minus icon for collapse element which is open by default
    $(".collapse.show").each(function(){
      $(this).prev(".card-header").find(".fa").addClass("fa-minus").removeClass("fa-plus");
    });
    
    // Toggle plus minus icon on show hide of collapse element
    $(".collapse").on('show.bs.collapse', function(){
      $(this).prev(".card-header").find(".fa").removeClass("fa-plus").addClass("fa-minus");
    }).on('hide.bs.collapse', function(){
      $(this).prev(".card-header").find(".fa").removeClass("fa-minus").addClass("fa-plus");
    });
});
</script>
<script src="{{asset('assets/js/lib/jquery.js')}}"></script>
<script src="{{asset('assets/js/dist/jquery.validate.js')}}"></script>
<script type="text/javascript">
function addServiceSubCategory(grpid,firmid) {
if (grpid != '' && firmid != '') {
  $("#addservicesubcategory").modal('show');
  $("#subcatGroupid").val(grpid);
  $("#subcatFirmid").val(firmid);
}
}




function deleteService(serviceid) {
if (confirm('Do you really want delete this?')) {
  $.ajax({
    url:'{{ url("deleteService") }}',
    data:{'service_id':serviceid},
    type:'POST',
    success:function(res) {
      if (res == "Done") {
        window.location.reload();
      }else{
        alert("Failed");
      }
    }
  });
}
}

function deletebrandRange(rangeid) {
if (confirm('Do you really want delete this?')) {
  $.ajax({
    url:'{{ url("deletebrandRange") }}',
    data:{"_token": "{{ csrf_token() }}",'service_brand_id':rangeid},
    type:'POST',
    success:function(res) {
      if (res == "Done") {
        window.location.reload();
      }else{
        alert("Failed");
      }
    }
  });
}
}

$("#editserviceform").validate({
rules:{
  editservice_name: "required",
  editservice_duration: "required",
  // editservice_price: "required",
  edittag_staff: "required",
},
messages:{
  editservice_name: "required",
  editservice_duration: "required",
  // editservice_price: "required",
  edittag_staff: "required",
},
submitHandler:function(res) {
  var formdata = $("#editserviceform").serialize();
  $.ajax({
    url:'{{ url("updateService") }}',
    data:formdata,
    type:'POST',
    // dataType:'JSON',
    success:function(res) {
      if (res == 'Done') {
        window.location.reload();
      }else{
        alert("Failed");
      }
    }
  });
}
});

$("#editsubcatgroupform").validate({
  rules:{
    editsubcat_name: "required",
  },
  messages:{
    editsubcat_name: "Enter sub-category name",        
  },
  submitHandler: function() {
    var formdata = $("#editsubcatgroupform").serialize();
    $.ajax({
      url:'{{ url("updateServiceSubCat") }}',
      data:formdata,
      type:'POST',
      // dataType:"JSON",
      success:function(res) {
        if (res == "Done") {
          window.location.reload();
        }else{
          alert("Failed");
        }
      },
      error: function (request, status, error) {
          if( request.status === 422 ) {
              // var errors = $.parseJSON(reject.responseText);
              alert(request.responseJSON.errors.editsubcat_name);
              /*$.each(errors, function (key, val) {
                  $("#" + key + "_error").text(val[0]);
                  alert($("#" + key + "_error").text(val[0]))
              });*/
          }
      }
    });
  },
});

function getServiceSubCatById(subcatid) {
if (subcatid != '') {
  $.ajax({
    url:'{{ url("editServiceSubCat") }}',
    type:'POST',
    data:{'groupid':subcatid},
    dataType:'JSON',
    success:function(res) {
      $("#editsubcatgroup").modal('show');
      $("#editsubcatgroupid").val(res.id);
      $("#editsubcat_name").val(res.group_name);
    }
  });
}
}

/* function getServiceById(serviceid) {
if (serviceid != '') {
  $.ajax({
    url:'{{ url("editService") }}',
    type:'POST',
    data:{'serviceid':serviceid},
    // dataType:'JSON',
    success:function(res) {
      $("#editservicepopup").modal('show');
      $("#editservicebody").html(res);
    }
  });
}
} */
</script>
<script type="text/javascript">
$("#serviceform").validate({
rules:{
  service_name: "required",
  service_duration: "required",
  service_price: "required",
  tag_staff: "required",
},
messages:{
  service_name: "Service name required",
  service_duration: "Service duration required",
  service_price: "Service price required",
  tag_staff: "Select at least 1 staff",
},
submitHandler: function() {
  var formdata = $("#serviceform").serialize();
  $.ajax({
    url:'{{ route("services.store") }}',
    data:formdata,
    type:'POST',
    // dataType:'JSON',
    success:function(res) {
      if (res == 'Done') {
        window.location.reload();
      }else{
        alert("Failed");
      }
    }
  });
}
});
function addService(grpid) {
if (grpid != '') {
  $("#addservicepopup").modal('show');
  $("#service_groupid").val(grpid);
}
}
$("#editgroupform").validate({
  rules:{
    editfirm: "required",
    editname: "required",
  },
  messages:{
    editfirm: "Please select firm",        
    editname: "Please enter group name",        
  },
  submitHandler: function() {
    var formdata = $("#editgroupform").serialize();
    $.ajax({
      url:'{{ url("updateGroup") }}',
      data:formdata,
      type:'POST',
      dataType:"JSON",
      success:function(res) {
        $("#editgroup").modal('hide');
        $("#accordionExample").html(res.html);
      },
      error: function (request, status, error) {
          if( request.status === 422 ) {
              // var errors = $.parseJSON(reject.responseText);
              alert(request.responseJSON.errors.editname);
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

    cols += '<td><input required type="text" name="brandname[]" id="brandname' + counter + '" class="form-control" placeholder="Enter brand name"></td>';
    // cols += '';
    cols += '<td><input required type="number" required id="serviceprice' + counter + '" name="serviceprice[]" placeholder="Enter price"  class="form-control"></td>';
    cols += '<td><input type="number" required id="specialserviceprice' + counter + '" name="specialserviceprice[]" placeholder="Enter special price"  class="form-control"></td>';
    cols += '<td><input type="number" id="brandDuration' + counter + '" name="brandDuration[]" placeholder="Eg 30"  class="form-control"></td>';
    cols += '<td><textarea class="form-control" name="service_description[]" id="service_description' + counter + '" placeholder="Enter description"></textarea></td>';
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
{{-- PRANAV --}}
@endsection