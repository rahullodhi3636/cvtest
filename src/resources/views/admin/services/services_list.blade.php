@extends('layouts.newlayout.app')
@section('content')
 <div class="main">
    <div class="main-content">
      <div class="container-fluid">
         <div class="boxbody">
            <ul class="nav nav-tabs2 nav-justified">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#Customer">Services</a>
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
                  <div class="text-right mt-2 mb-2"><a data-toggle="modal" data-target="#addservicegroup" href="javascript:void(0)" class="theme-btn">New Group</a></div>
                  <!-- <div class="text-right mt-2 mb-2"><a data-toggle="modal" data-target="#addfirm" href="javascript:void(0)" class="theme-btn">New Service</a></div> -->
                  <div class="row">

                   <div class="col-lg-12 col-md-12 col-12 mt-3">
                     <h6><i class="fa fa-tasks"></i> Services Category Count <span id="customerCount"><?php echo count($groups) ?></span></h6>
                     <div class="bs-example">
                      <div class="accordion" id="accordionExample">
                        <?php if (!empty($groups)): ?>
                          <?php 
                            foreach ($groups as $group): 
                              // $services = DB::table('services')->where('group_id',$group->id)->get();
                              $subcat = DB::table('service_group')->where('parent_id',$group->id)->get();
                          ?>

                            <div class="card">
                              <div class="card-header" id="heading{{ $group->id }}">
                                  <h2 class="mb-0">
                                      <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapse{{ $group->id }}"><i class="fa fa-plus"></i> {{ $group->group_name }} ({{$group->firm_name}}) (<?php echo $group->sub_count; ?>)</button>
                                      <button type="button" onclick="getGroup('{{ $group->id }}')" class="btn btn-primary text-right">edit</button>
                                      <button type="button" onclick="addServiceSubCategory('{{ $group->id }}','{{ $group->firm_id }}')" class="btn btn-primary text-right">Add Sub-Category</button>
                                      <!-- <button type="button" onclick="addService('{{ $group->id }}')" class="btn btn-primary text-right">Add Service</button> -->
                                  </h2>
                              </div>
                              <div id="collapse{{ $group->id }}" class="collapse" aria-labelledby="heading{{ $group->id }}" data-parent="#accordionExample">
                                <div class="card-body">
                                    <table class="table table-bordered table-striped recent-purchases-listing">
                                      <thead>
                                        <tr>
                                          <th class="th-sm">Name</th>
                                         {{-- <th class="th-sm">View Services</th>
                                          <th class="th-sm">Price</th>
                                          <th class="th-sm">Status</th>
                                          <th class="th-sm">Products</th>--}}
                                          <th class="th-sm">Action</th>
                                        </tr>
                                      </thead>
                                      <tbody id="firmTableBody">
                                        @foreach ($subcat as $cat)
                                          <tr>
                                            <td>{{ $cat->group_name }}</td>

                                           {{--  <td><a target="_blank" class="theme-btn" href="{{ url('admin/mainservices') }}/{{ $cat->id }}"><i class="fa fa-eye"></i> View</a></td>--}}

                                            <td><button type="button"  class="theme-btn" onclick="viewservicesmodal({{$cat->id}})" ><i class="fa fa-eye"></i> View</a></td> 
                                            {{--<td>{{ $cat->service_price }}</td>
                                            <td>
                                                @if($cat->status ==1)         
                                                    Active        
                                                @else
                                                    Deactive
                                                @endif
                                            </td>--}}
                                            {{--<td>
                                              <table >
                                                <tr>
                                                  <th style="padding: 0">
                                                    <a href="{{ url('admin/product') }}/{{ $cat->id }}" class="btn-success btn-sm waves-effect waves-light text-light material-tooltip-main" data-toggle="tooltip" data-html="true" title="View products">
                                                      <i class="fa fa-eye"></i>
                                                    </a>
                                                    <!-- <a href="" class="btn btn-primary">Edit</a> -->
                                                  </th>
                                                </tr>
                                              </table>
                                            </td>--}}
                                            <td>
                                              <table >
                                                <tr>
                                                  <th style="padding: 0">
                                                    <a onclick="addService('{{ $cat->id }}')" href="javascript:void(0)" class="btn-primary btn-sm waves-effect waves-light text-light material-tooltip-main" data-toggle="tooltip" data-html="true" title="Add">
                                                      <i class="fa fa-plus"></i>
                                                    </a>
                                                    <!-- <a href="" class="btn btn-primary">Edit</a> -->
                                                  </th>
                                                  <th style="padding: 0">
                                                    <a onclick="getServiceSubCatById('{{ $cat->id }}')" href="javascript:void(0)" class="btn-primary btn-sm waves-effect waves-light text-light material-tooltip-main" data-toggle="tooltip" data-html="true" title="Edit">
                                                      <i class="fa fa-edit"></i>
                                                    </a>
                                                    <!-- <a href="" class="btn btn-primary">Edit</a> -->
                                                  </th>
                                                  <th style="padding: 0">
                                                    <form action="{{ route('services.destroy', $cat->id)}}" method="post">
                                                      <input type="hidden" name="_method" value="delete" />
                                                      <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                                                      <button class="btn-danger btn-sm waves-effect waves-light material-tooltip-main" type="submit" style="border:0 !important" data-toggle="tooltip" data-html="true" title="Delete"><i class="fa fa-close"></i></button>
                                                    </form>
                                                  </th>
                                                </tr>
                                              </table>
                                            </td>
                                          </tr>
                                        @endforeach
                                      </tbody>
                                    </table>
                                </div>
                              </div>
                            </div>
                          <?php endforeach ?>
                        <?php endif ?>
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
    <div class="modal" id="addservicesubcategory">
      <div class="modal-dialog modal-sm">
        <form id="servicesubcategoryform" method="post">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Sub-Category</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
            <input type = "hidden" name = "subcatGroupid" id="subcatGroupid" value = "">
            <input type = "hidden" name = "subcatFirmid" id="subcatFirmid" value = "">
            <!-- Modal body -->
            <div class="modal-body formvisit">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                  <div class="form-group">
                    <label>Sub-Category Name</label>
                    <input type="text" name="subcat_name" id="subcat_name" value="" placeholder="Enter service sub-category name"  class="form-control">
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
                {{--<div class="col-lg-4 col-md-12 col-12">
                  <div class="form-group">
                    <label>Service Price</label>
                    <input type="text" name="service_price" id="service_price" value="{{ old('name') }}" placeholder="Enter service price"  class="form-control">
                  </div>
                </div><!--./col-lg-4-->
                <div class="col-lg-4 col-md-12 col-12">
                  <div class="form-group">
                    <label>Special Price</label>
                    <input type="text" name="service_special_price" id="service_special_price" value="{{ old('name') }}" placeholder="Enter special price"  class="form-control">
                  </div>
                </div><!--./col-lg-4-->
                <div class="col-lg-4 col-md-12 col-12">
                  <div class="form-group">
                    <label>Service description</label>
                    <textarea class="form-control" name="service_description" id="service_description" placeholder="Enter description"></textarea>
                  </div>
                </div><!--./col-lg-4-->--}}
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
                      <th>Brand/Type</th>
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
  function addServiceSubCategory(grpid,firmid) {
    if (grpid != '' && firmid != '') {
      $("#addservicesubcategory").modal('show');
      $("#subcatGroupid").val(grpid);
      $("#subcatFirmid").val(firmid);
    }
  }

  $("#servicesubcategoryform").validate({
    rules:{
      subcat_name: "required",
    },
    messages:{
      subcat_name: "Enter sub-category name",
    },
    submitHandler:function() {
      var formdata = $("#servicesubcategoryform").serialize();
      $.ajax({
        url:'{{ url("addServiceSubCategory") }}',
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
        url:'{{ url("getGroup") }}',
        type:'POST',
        data:{'groupid':groupid},
        dataType:'JSON',
        success:function(res) {
          $("#editgroup").modal('show');
          $("#editgroupid").val(res.id);
          $("#editfirm").val(res.firm_id);
          $("#editname").val(res.group_name);
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
<div class="modal" id="addservicesubcategory">
  <div class="modal-dialog modal-sm">
    <form id="servicesubcategoryform" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Sub-Category</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
        <input type = "hidden" name = "subcatGroupid" id="subcatGroupid" value = "">
        <input type = "hidden" name = "subcatFirmid" id="subcatFirmid" value = "">
        <!-- Modal body -->
        <div class="modal-body formvisit">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
              <div class="form-group">
                <label>Sub-Category Name</label>
                <input type="text" name="subcat_name" id="subcat_name" value="" placeholder="Enter service sub-category name"  class="form-control">
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

$("#servicesubcategoryform").validate({
rules:{
  subcat_name: "required",
},
messages:{
  subcat_name: "Enter sub-category name",
},
submitHandler:function() {
  var formdata = $("#servicesubcategoryform").serialize();
  $.ajax({
    url:'{{ url("addServiceSubCategory") }}',
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

function deleteBrand(brandid) {
if (confirm('Do you really want delete this?')) {
  $.ajax({
    url:'{{ url("deleteBrand") }}',
    data:{'service_brand_id':brandid},
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
function getGroup(groupid) {
if (groupid != '') {
  $.ajax({
    url:'{{ url("getGroup") }}',
    type:'POST',
    data:{'groupid':groupid},
    dataType:'JSON',
    success:function(res) {
      $("#editgroup").modal('show');
      $("#editgroupid").val(res.id);
      $("#editfirm").val(res.firm_id);
      $("#editname").val(res.group_name);
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

$("#addrow").on("click", function () {
    var newRow = $("<tr>");
    var cols = "";

    cols += '<td><input required type="text" name="brandname[]" id="brandname' + counter + '" class="form-control" placeholder="Enter brand name"></td>';
    // cols += '';
    cols += '<td><input required type="number" required id="serviceprice' + counter + '" name="serviceprice[]" placeholder="Enter price"  class="form-control"></td>';
    cols += '<td><input type="number" required id="specialserviceprice' + counter + '" name="specialserviceprice[]" placeholder="Enter special price"  class="form-control"></td>';
    cols += '<td><td><input type="number" id="brandDuration' + counter + '" name="brandDuration[]" placeholder="Eg 30"  class="form-control"></td></td>';
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