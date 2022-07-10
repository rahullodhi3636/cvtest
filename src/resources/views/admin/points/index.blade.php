@extends('layouts.newlayout.app')
@section('content')
<div class="main">
    <div class="main-content">
      <div class="container-fluid">
         <div class="boxbody">
            <ul class="nav nav-tabs2 nav-justified">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#Customer">Points</a>
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
                  <div class="text-right mt-2 mb-2"><a data-toggle="modal" data-target="#addPoints" href="javascript:void(0)" class="theme-btn">Add Points</a></div>
                  <div class="row">

                   <div class="col-lg-12 col-md-12 col-12 mt-3">
                     <!-- <h6><i class="fa fa-tasks"></i> point Count <span id="customerCount">1</span></h6> -->
                      <div class="table-responsive">
                    <table class="table table-bordered table-striped recent-purchases-listing">
                      <thead>
                        <tr>
                          <th class="th-sm">Invoice Amount</th>
                          <th class="th-sm">Point</th>
                          <th class="th-sm">Action</th>
                        </tr>
                      </thead>
                      <tbody id="PointTableBody">
                        @foreach ($points as $point)
                          <tr>
                            <td>{{$point->invoice_amt}}</td>
                            <td>{{$point->point_amt}}</td>
                            <td>
                              <table >
                                <tr>
                                  <th style="padding: 0">
                                    <a href="javascript:void(0)" onclick="getPoint('{{ $point->id }}')" class="btn-primary btn-sm waves-effect waves-light text-light material-tooltip-main" data-toggle="tooltip" data-html="true" title="Edit">
                                      <i class="fa fa-edit"></i>
                                    </a>
                                  </th>
                                  <th style="padding: 0">
                                    <form action="{{ route('point.destroy', $point->id)}}" method="post">
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
   </div><!--/main-->
    <!-- The Modal -->
    <div class="modal" id="addPoints">
      <div class="modal-dialog modal-lg">
        <form id="addPointsform">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Point</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
            <!-- Modal body -->
            <div class="modal-body formvisit">
              <div class="row">
                <div class="col-lg-6 col-md-12 col-12">
                  <div class="form-group">
                    <label>Invoice Amount</label>
                    <input type="text" name="invoice_amt" id="invoice_amt" value="{{ old('invoice_amt') }}" placeholder="Enter Invoice Amount" class="form-control">
                  </div>
                </div><!--./col-lg-4-->
                <div class="col-lg-6 col-md-12 col-12">
                  <div class="form-group">
                    <label>Invoice Amount</label>
                    <input type="text" name="point_amt" id="point_amt" value="{{ old('point_amt') }}" placeholder="Enter Points Amount" class="form-control">
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
    <div class="modal" id="editPoint">
      <div class="modal-dialog modal-lg">
        <form id="editPointsform">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Point</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
            <input type = "hidden" name = "editpointid" id="editpointid">
            <!-- Modal body -->
            <div class="modal-body formvisit">
              <div class="row">
                <div class="col-lg-6 col-md-12 col-12">
                  <div class="form-group">
                    <label>Invoice Amount</label>
                    <input type="text" name="invoice_amt" id="editinvoice_amt" value="{{ old('invoice_amt') }}" placeholder="Enter Invoice Amount"  class="form-control">
                  </div>
                </div><!--./col-lg-4-->
                <div class="col-lg-6 col-md-12 col-12">
                  <div class="form-group">
                    <label>Invoice Amount</label>
                    <input type="text" name="point_amt" id="editpoint_amt" value="{{ old('point_amt') }}" placeholder="Enter Points Amount" class="form-control">
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
<script>

$("#editPointsform").validate({
      rules:{
        invoice_amt: "required",
        point_amt: "required",
      },
      messages:{
        invoice_amt: "Please enter invoice amount",
        point_amt: "Please enter point amount",
      },
      submitHandler: function() {
        var formdata = $("#editPointsform").serialize();
        $.ajax({
            url:'{{ url("updatePoint") }}',
          data:formdata,
          type:'POST',
          dataType:"JSON",
          success:function(res) {
            $("#editPoint").modal('hide');
            $("#PointTableBody").html(res.html);
          },
          error: function (request, status, error) {
              if( request.status === 422 ) {
                  alert(request.responseJSON.errors.name);
              }
          }
        });
      },
  });




function getPoint(pointid) {
    if (pointid != '') {
      $.ajax({
        url:'{{ url("getPoint") }}',
        type:'POST',
        data:{ "_token": "{{ csrf_token() }}",'pointid':pointid},
        dataType:'JSON',
        success:function(res) {
          $("#editPoint").modal('show');
          $("#editinvoice_amt").val(res.invoice_amt);
          $("#editpoint_amt").val(res.point_amt);
          $("#editpointid").val(res.id);
        }
      });
    }
  }

    $("#addPointsform").validate({
      rules:{
        invoice_amt: "required",
        point_amt: "required",
      },
      messages:{
        invoice_amt: "Please enter invoice amount",
        point_amt: "Please enter point amount",
      },
      submitHandler: function() {
        var formdata = $("#addPointsform").serialize();
        $.ajax({
          url:'{{ route("point.store") }}',
          data:formdata,
          type:'POST',
          dataType:"JSON",
          success:function(res) {
            $("#addPoints").modal('hide');
            $("#PointTableBody").html(res.html);
          },
          error: function (request, status, error) {
              if( request.status === 422 ) {
                  alert(request.responseJSON.errors.name);
              }
          }
        });
      },
  });

</script>
@endsection
