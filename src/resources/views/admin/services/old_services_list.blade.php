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
                  <div class="text-right mt-2 mb-2"><a data-toggle="modal" data-target="#addfirm" href="javascript:void(0)" class="theme-btn">New Service</a></div>
                  <div class="row">

                   <div class="col-lg-12 col-md-12 col-12 mt-3">
                     <h6><i class="fa fa-tasks"></i> Services Count <span id="customerCount"><?php echo count($services) ?></span></h6>
                      <div class="table-responsive">
                    <table class="table table-bordered table-striped recent-purchases-listing">
                      <thead>
                        <tr>
                          <th class="th-sm">Icon</th>
                          <th class="th-sm">Name</th>
                          <th class="th-sm">Price</th>
                          <th class="th-sm">Status</th>
                          <th class="th-sm">Products</th>
                          <th class="th-sm">Action</th>
                        </tr>
                      </thead>
                      <tbody id="firmTableBody">
                        @foreach ($services as $cat)
                          <tr>
                            <td>
                              @if (!empty($cat->service_icon))
                                <img src="{{url('images')}}/{{$cat->service_icon}}" width="50px" height="50px" class="img-responsive">
                              @endif
                            </td>
                            <td>{{ $cat->name }}</td>
                            <td>{{ $cat->service_price }}</td>
                            <td>
                                @if($cat->status ==1)         
                                    Active        
                                @else
                                    Deactive
                                @endif
                            </td>
                            <td>
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
                            </td>
                            <td>
                              <table >
                                <tr>
                                  <th style="padding: 0">
                                    <a href="{{ route('services.edit',$cat->id)}}" class="btn-primary btn-sm waves-effect waves-light text-light material-tooltip-main" data-toggle="tooltip" data-html="true" title="Edit">
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
<div class="modal" id="addfirm">
  <div class="modal-dialog modal-lg">
    <form id="addfirmform" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Firm</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
        <!-- Modal body -->
        <div class="modal-body formvisit">
          <div class="row">
            <div class="col-lg-4 col-md-12 col-12">
              <div class="form-group">
                <label>Firm Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Enter firm name"  class="form-control">
              </div>
            </div><!--./col-lg-4-->

            <div class="col-lg-4 col-md-12 col-12">
               <div class="form-group">
                  <label>Firm Location</label>
                  <input id="location" name="location" value="{{ old('location') }}" placeholder="Enter firm location" type="text" class="form-control">
                </div>
            </div><!--./col-lg-4-->

            <div class="col-lg-4 col-md-12 col-12">
               <div class="form-group">
                  <label>Contact Number</label>
                  <input type="number"  id="phone" name="phone" value="{{ old('phone') }}" placeholder="Enter contact number"  class="form-control">
                </div>
            </div><!--./col-lg-4-->

            <div class="col-lg-4 col-md-12 col-12">
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

<div class="modal" id="editfirm">
  <div class="modal-dialog modal-lg">
    <form id="editfirmform" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Firm</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
        <input type = "hidden" name = "editfirmid" id="editfirmid">
        <!-- Modal body -->
        <div class="modal-body formvisit">
          <div class="row">
            <div class="col-lg-4 col-md-12 col-12">
              <div class="form-group">
                <label>Firm Name</label>
                <input type="text" name="editname" id="editname" value="{{ old('name') }}" placeholder="Enter firm name"  class="form-control">
              </div>
            </div><!--./col-lg-4-->

            <div class="col-lg-4 col-md-12 col-12">
               <div class="form-group">
                  <label>Firm Location</label>
                  <input id="editlocation" name="editlocation" value="{{ old('location') }}" placeholder="Enter firm location" type="text" class="form-control">
                </div>
            </div><!--./col-lg-4-->

            <div class="col-lg-4 col-md-12 col-12">
               <div class="form-group">
                  <label>Contact Number</label>
                  <input type="number"  id="editphone" name="editphone" value="{{ old('phone') }}" placeholder="Enter contact number"  class="form-control">
                </div>
            </div><!--./col-lg-4-->

            <div class="col-lg-4 col-md-12 col-12">
               <div class="form-group">
                  <label>Status</label>
                  <select name="editstatus" id="editstatus" class="form-control col-md-7 col-xs-12" id="status">
                      <option value="1" {{ old('status') == '1'? 'selected' : '' }} >Active</option>
                      <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Deactive</option>
                  </select>
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
  $("#editfirmform").validate({
      rules:{
        editphone: {
          required : true,
          number : true,
          minlength : 10,
          maxlength : 10,
        },
        editname: "required",
        editlocation: "required",
        editstatus: "required",
      },
      messages:{
        editphone: {
          required : "Contact number is required",
          number : "Enter valid number",
          minlength: "Contact number must consist of at least 10 digits",
          maxlength: "Contact number must consist of only 10 digits",
        },
        editname: "Please enter firm name",
        editlocation: "Please enter firm location",
        editstatus: "Please select status",
      },
      submitHandler: function() {
        var formdata = $("#editfirmform").serialize();
        $.ajax({
          url:'{{ url("updateFirm") }}',
          data:formdata,
          type:'POST',
          dataType:"JSON",
          success:function(res) {
            $("#editfirm").modal('hide');
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
  function getFirm(firmid) {
    if (firmid != '') {
      $.ajax({
        url:'{{ url("getFirm") }}',
        type:'POST',
        data:{'firmid':firmid},
        dataType:'JSON',
        success:function(res) {
          $("#editfirm").modal('show');
          $("#editname").val(res.firm_name);
          $("#editlocation").val(res.firm_location);
          $("#editphone").val(res.firm_number);
          $("#editstatus").val(res.status);
          $("#editfirmid").val(res.id);
        }
      });
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
        location: "required",
        status: "required",
      },
      messages:{
        phone: {
          required : "Contact number is required",
          number : "Enter valid number",
          minlength: "Contact number must consist of at least 10 digits",
          maxlength: "Contact number must consist of only 10 digits",
        },
        name: "Please enter firm name",
        location: "Please enter firm location",
        status: "Please select status",
      },
      submitHandler: function() {
        var formdata = $("#addfirmform").serialize();
        $.ajax({
          url:'{{ route("firm.store") }}',
          data:formdata,
          type:'POST',
          dataType:"JSON",
          success:function(res) {
            $("#addfirm").modal('hide');
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