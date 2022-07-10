@extends('layouts.newlayout.app')
@section('content')
 <div class="main">
    <div class="main-content">
      <div class="container-fluid">
         <div class="boxbody">
            <ul class="nav nav-tabs2 nav-justified">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#Customer">Location</a>
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
                  <div class="text-right mt-2 mb-2"><a data-toggle="modal" data-target="#addfirm" href="javascript:void(0)" class="theme-btn">New Location</a></div>
                  <div class="row">

                   <div class="col-lg-12 col-md-12 col-12 mt-3">
                     <h6><i class="fa fa-tasks"></i> Location Count <span id="customerCount"><?php echo count($location) ?></span></h6>
                      <div class="table-responsive">
                    <table class="table table-bordered table-striped recent-purchases-listing">
                      <thead>
                        <tr>
                          <th class="th-sm">Name</th>
                          {{-- <th class="th-sm">Contact</th>
                          <th class="th-sm">Location</th> --}}
                          <!-- <th class="th-sm">Services</th> -->
                          {{-- <th class="th-sm">Total Sales</th> --}}
                          <th class="th-sm">Action</th>
                        </tr>
                      </thead>
                      <tbody id="firmTableBody">
                        @foreach ($location as $loca)
                          <tr>
                            <td>{{ $loca->name }}</td>
                           
                            {{-- <td>
                              <a href="{{ url('admin/totalsales')}}" class="btn-success btn-sm waves-effect waves-light text-light material-tooltip-main" data-toggle="tooltip" data-html="true" title="Total sales">
                                <i class="fa fa-eye"></i>
                              </a>
                            </td> --}}
                            <td>
                              <table >
                                <tr>
                                  <th style="padding: 0">
                                    <!-- <a href="{{ route('firm.edit',$loca->id)}}" class="btn-primary btn-sm waves-effect waves-light text-light material-tooltip-main" data-toggle="tooltip" data-html="true" title="Edit"> -->
                                    <a href="javascript:void(0)" onclick="getLocation('{{ $loca->id }}')" class="btn-primary btn-sm waves-effect waves-light text-light material-tooltip-main" data-toggle="tooltip" data-html="true" title="Edit">
                                      <i class="fa fa-edit"></i>
                                    </a>
                                  </th>
                                  <th style="padding: 0">
                                    <form action="{{ route('location.destroy', $loca->id)}}" method="post">
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
                    <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Enter firm name"  class="form-control">
                  </div>
                </div><!--./col-lg-4-->

                {{-- <div class="col-lg-4 col-md-12 col-12">
                   <div class="form-group">
                      <label>Firm Location</label>
                      <input id="location" name="location" value="{{ old('location') }}" placeholder="Enter firm location" type="text" class="form-control">
                    </div>
                </div> --}}
                <!--./col-lg-4-->

                {{-- <div class="col-lg-4 col-md-12 col-12">
                   <div class="form-group">
                      <label>Contact Number</label>
                      <input type="number"  id="phone" name="phone" value="{{ old('phone') }}" placeholder="Enter contact number"  class="form-control">
                    </div>
                </div> --}}
                <!--./col-lg-4-->

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

<div class="modal" id="editfirm">
  <div class="modal-dialog modal-lg">
    <form id="editfirmform" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Location</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
        <input type = "hidden" name = "editfirmid" id="editfirmid">
        <!-- Modal body -->
        <div class="modal-body formvisit">
          <div class="row">
            <div class="col-lg-6 col-md-12 col-12">
              <div class="form-group">
                <label>Location Name</label>
                <input type="text" name="editname" id="editname" value="{{ old('name') }}" placeholder="Enter firm name"  class="form-control">
              </div>
            </div><!--./col-lg-4-->

            {{-- <div class="col-lg-4 col-md-12 col-12">
               <div class="form-group">
                  <label>Firm Location</label>
                  <input id="editlocation" name="editlocation" value="{{ old('location') }}" placeholder="Enter firm location" type="text" class="form-control">
                </div>
            </div> --}}
            <!--./col-lg-4-->

            {{-- <div class="col-lg-4 col-md-12 col-12">
               <div class="form-group">
                  <label>Contact Number</label>
                  <input type="number"  id="editphone" name="editphone" value="{{ old('phone') }}" placeholder="Enter contact number"  class="form-control">
                </div>
            </div> --}}
            <!--./col-lg-4-->

            <div class="col-lg-6 col-md-12 col-12">
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
       
        editname: "required",
       
        editstatus: "required",
      },
      messages:{
        
        editname: "Please enter location name",
       
        editstatus: "Please select status",
      },
      submitHandler: function() {
        var formdata = $("#editfirmform").serialize();
        $.ajax({
          url:'{{ url("updateLocation") }}',
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
  function getLocation(locaid) {
    if (locaid != '') {
      $.ajax({
        url:'{{ url("getLocation") }}',
        type:'POST',
        data:{'locaid':locaid,"_token": "{{ csrf_token() }}"},
        dataType:'JSON',
        success:function(res) {
          $("#editfirm").modal('show');
          $("#editname").val(res.name);
          // $("#editlocation").val(res.firm_location);
          // $("#editphone").val(res.firm_number);
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
        // location: "required",
        status: "required",
      },
      messages:{
       
        name: "Please enter firm name",
       
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