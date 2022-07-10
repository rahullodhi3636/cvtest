@extends('layouts.newlayout.app')
@section('content')
 <div class="main">
    <div class="main-content">
      <div class="container-fluid">
         <div class="boxbody">
            <ul class="nav nav-tabs2 nav-justified">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#Customer">Firms</a>
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
                  <div class="text-right mt-2 mb-2"><a data-toggle="modal" data-target="#addfirm" href="javascript:void(0)" class="theme-btn">New Firm</a></div>
                  <div class="row">

                   <div class="col-lg-12 col-md-12 col-12 mt-12">

                        @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                            <li>{!! \Session::get('success') !!}</li>
                            </ul>
                        </div>
                        @endif
                        @if (\Session::has('error'))
                        <div class="alert alert-danger">
                            <ul>
                            <li>{!! \Session::get('error') !!}</li>
                            </ul>
                        </div>
                        @endif


                     <h6><i class="fa fa-tasks"></i> Firm Count <span id="customerCount"><?php echo count($firms) ?></span></h6>
                      <div class="table-responsive">
                    <table class="table table-bordered table-striped recent-purchases-listing">
                      <thead>
                        <tr>
                          <th class="th-sm">Name</th>
                          <th class="th-sm">Contact</th>
                          <th class="th-sm">Location</th>
                          <!-- <th class="th-sm">Services</th> -->
                          <th class="th-sm">Total Sales</th>
                          <th class="th-sm">Action</th>
                        </tr>
                      </thead>
                      <tbody id="firmTableBody">
                        @foreach ($firms as $firm)
                          <tr>
                            <td>{{ $firm->firm_name }}</td>
                            <td>{{ $firm->firm_number }}</td>
                            <td>
                                {{ $firm->firm_location }}
                            </td>
                            <td>
                              <a href="{{ url('admin/totalsales')}}" class="btn-success btn-sm waves-effect waves-light text-light material-tooltip-main" data-toggle="tooltip" data-html="true" title="Total sales">
                                <i class="fa fa-eye"></i>
                              </a>
                            </td>
                            <td>
                              <table >
                                <tr>
                                  <th style="padding: 0">
                                    <a href="{{ route('firm.edit',$firm->id)}}" class="btn-primary btn-sm waves-effect waves-light text-light material-tooltip-main" data-toggle="tooltip" data-html="true" title="Edit">Qr</a>
                                    <a href="javascript:void(0)" onclick="getFirm('{{ $firm->id }}')" class="btn-primary btn-sm waves-effect waves-light text-light material-tooltip-main" data-toggle="tooltip" data-html="true" title="Edit">
                                      <i class="fa fa-edit"></i>
                                    </a>
                                  </th>
                                  <th style="padding: 0">
                                    <form action="{{ route('firm.destroy', $firm->id)}}" method="post">
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
        <form id="addfirmform" method="post" enctype="multipart/form-data">
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
                        <label  for="cgst">CGST %<span class="required">*</span></label>
                        <input type="number"  id="cgst" name="cgst" value="{{ old('cgst') }}" placeholder="Enter cgst percent"  class="form-control">
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 col-12">
                    <div class="form-group">
                        <label  for="phone">SGST %<span class="required">*</span>
                        </label>

                        <input type="number"  id="sgst" name="sgst" value="{{ old('sgst') }}" placeholder="Enter sgst percent"  class="form-control ">

                    </div>
                </div>

                <div class="col-lg-4 col-md-12 col-12">
                    <div class="form-group">
                        <label  for="gst_status">GST Status <span class="required">*</span>
                        </label>
                        <select required class="form-control" name="gst_status" id="gst_status">
                            <option value="0">In-active</option>
                            <option value="1">Active</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 col-12">
                    <div class="form-group">
                        <label  for="gst_discount">GST Discount <span class="required">*</span>
                        </label>
                        <select required class="form-control" name="gst_discount" id="gst_discount">
                            <option value="0">Add GST without discount</option>
                            <option value="1">Add GST with same discount</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 col-12">
                    <div class="form-group">
                        <label  for="phone">Composition %<span class="required">*</span>
                        </label>

                        <input type="number"  id="composition" name="composition" value="{{ old('composition') }}" placeholder="Enter composition percent"  class="form-control ">

                    </div>
                </div>

                <div class="col-lg-4 col-md-12 col-12">
                    <div class="form-group">
                        <label  for="composition_status">Composition Status <span class="required">*</span>
                        </label>
                        <select required class="form-control" name="composition_status" id="composition_status">
                            <option value="0">In-active</option>
                            <option value="1">Active</option>
                        </select>
                    </div>
                </div>

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
    <form id="editfirmform" method="post" enctype="multipart/form-data">
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
                    <label  for="cgst">CGST %<span class="required">*</span></label>
                    <input type="number"  id="edit_cgst" name="cgst" value="{{ old('cgst') }}" placeholder="Enter cgst percent"  class="form-control">
                </div>
            </div>

            <div class="col-lg-4 col-md-12 col-12">
                <div class="form-group">
                    <label  for="phone">SGST %<span class="required">*</span>
                    </label>

                    <input type="number"  id="edit_sgst" name="sgst" value="{{ old('sgst') }}" placeholder="Enter sgst percent"  class="form-control ">

                </div>
            </div>

            <div class="col-lg-4 col-md-12 col-12">
                <div class="form-group">
                    <label  for="gst_status">GST Status <span class="required">*</span>
                    </label>
                    <select required class="form-control" name="gst_status" id="edit_gst_status">
                        <option value="0">In-active</option>
                        <option value="1">Active</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 col-12">
                <div class="form-group">
                    <label  for="gst_discount">GST Discount <span class="required">*</span>
                    </label>
                    <select required class="form-control " name="gst_discount" id="edit_gst_discount">
                        <option value="0">Add GST without discount</option>
                        <option value="1">Add GST with same discount</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 col-12">
                <div class="form-group">
                    <label  for="phone">Composition %<span class="required">*</span>
                    </label>

                    <input type="number"  id="edit_composition" name="composition" value="{{ old('composition') }}" placeholder="Enter composition percent"  class="form-control ">

                </div>
            </div>

            <div class="col-lg-4 col-md-12 col-12">
                <div class="form-group">
                    <label  for="composition_status">Composition Status <span class="required">*</span>
                    </label>
                    <select required class="form-control" name="composition_status" id="edit_composition_status">
                        <option value="0">In-active</option>
                        <option value="1">Active</option>
                    </select>
                </div>
            </div>





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
        cgst: "required",
        sgst: "required",
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
        cgst: "Please enter cgst",
        sgst: "Please enter sgst",
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
          //$("#editstatus").val(res.status);
          $('#editstatus option[value='+res.status+']').attr('selected','selected');
          $("#editfirmid").val(res.id);
          $("#edit_sgst").val(res.sgst);
          $("#edit_cgst").val(res.cgst);
          $("#edit_composition").val(res.composition);
          //$("#edit_gst_status").val(res.gst_status);
          $('#edit_gst_status option[value='+res.gst_status+']').attr('selected','selected');
          $('#edit_gst_discount option[value='+res.gst_discount+']').attr('selected','selected');
          $('#edit_composition_status option[value='+res.composition_status+']').attr('selected','selected');
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
        cgst: "required",
        sgst: "required",
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
        cgst: "Please enter cgst",
        sgst: "Please enter sgst",
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
