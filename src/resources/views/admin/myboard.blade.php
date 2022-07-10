@extends('layouts.newlayout.app')
@section('content')
<div class="main">
    <div class="main-content">
      <div class="container-fluid">
         <div class="boxbody">
            <ul class="nav nav-tabs2 nav-justified">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#Customer">Dashboard</a>
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

                <div class="panelbox">
                  <div class="row">
                    <div class="col-lg-12">
                            <h4 style="background:#917758; color:white;" class="p-2">Today Customers</h4>
                            <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                              <thead>
                                  <tr>
                                      <th class="th-sm">Sr No</th>
                                      <th class="th-sm">Customer Name</th>
                                      <th class="th-sm">Email & Contact</th>
                                      <th class="th-sm">Invoice No</th>
                                      <th class="th-sm">Invoice Amount</th>
                                  </tr>
                              </thead>
                              <tbody id="birthdaybody">
                                  @foreach($todays_cust as $todays_cst)
                                  <tr>
                                      <td>{{($loop->index)+1}}</td>
                                      <td>{{$todays_cst->name}}</td>
                                      <td>{{$todays_cst->email}} <br> {{$todays_cst->contact}} </td>
                                      <td>{{$todays_cst->invoice_id }}</td>
                                      <td> <i class="fa fa-inr"></i> {{$todays_cst->all_total }}</td>
                                  </tr>
                                  @endforeach
                                  <tr>
                                    <td colspan='4' class="text-right">Total</td>
                                    <td> <i class="fa fa-inr"></i> {{$today_total }} </td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                  </div>
                  <hr>
                  <div class="container">
                    <div class="row">
                    <div class="col-lg-6">
                          <h4 style="background:#917758; color:white;" class="p-2">Birthdays</h4>
                          <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="th-sm">Sr No</th>
                                    <th class="th-sm">Customer Name</th>
                                    <th class="th-sm">Email & Contact</th>
                                    <th class="th-sm">Action</th>
                                </tr>
                            </thead>
                            <tbody id="birthdaybody">
                                @foreach($today_birthdays as $today_birthday)
                                <tr>
                                    <td>{{($loop->index)+1}}</td>
                                    <td>{{$today_birthday->name}}</td>
                                    <td>{{$today_birthday->email}} <br> {{$today_birthday->contact}} </td>
                                    <td><button type="button" class="theme-btn mt-1" onclick="sendOffers({{$today_birthday->id}})">Send MSG</button> </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-6">
                      <h4 style="background:#917758; color:white;" class="p-2">Anniversaries</h4>
                      <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="th-sm">Sr No</th>
                                <th class="th-sm">Customer Name</th>
                                <th class="th-sm">Email & Contact</th>
                                <th class="th-sm">Action</th>
                            </tr>
                        </thead>
                        <tbody id="birthdaybody">
                            @foreach($today_anniversaries as $today_anniversary)
                            <tr>
                                <td>{{($loop->index)+1}}</td>
                                <td>{{$today_anniversary->name}}</td>
                                <td>{{$today_anniversary->email}} <br> {{$today_anniversary->contact}} </td>
                                <td><button type="button" class="theme-btn mt-1" onclick="sendOffers({{$today_anniversary->id}})">Send MSG</button> </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                    </div>

                  </div>
                  <hr>
                  <div class="container">
                      <div class="row">
                        <div class="col-lg-6">
                        <h4 style="background:#917758; color:white;" class="p-2">Currently Check-in</h4>
                        <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                          <thead>
                              <tr>
                                  <th class="th-sm">Sr No</th>
                                  <th class="th-sm">Customer Name</th>
                                  <th class="th-sm">Email & Contact</th>
                                  <th class="th-sm">Action</th>
                              </tr>
                          </thead>
                          <tbody id="birthdaybody">
                              @foreach($check_ins as $check_in)
                              <tr>
                                  <td>{{($loop->index)+1}}</td>
                                  <td>{{$check_in->name}}</td>
                                  <td>{{$check_in->email}} <br> {{$check_in->contact}} </td>
                                  <td><a class="theme-btn mt-2" href="{{route('recent_invoice',$check_in->id)}}">Recent Invoices</a> </td>
                              </tr>
                              @endforeach
                          </tbody>
                        </table>
                        </div>
                        <div class="col-lg-6">
                          <div class="row" style="background:#917758; color:white;">
                          <h4 class="p-1">Enquiries</h4>
                          <div class="text-right mt-2 mb-2">
                            <a data-toggle="modal" data-target="#addenquiry" href="javascript:void(0)" class="btn btn-info">New Enquiry</a></div>
                          </div>
                        <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                          <thead>
                              <tr>
                                  <th class="th-sm">Sr No</th>
                                  <th class="th-sm">Customer Name</th>
                                  <th class="th-sm">Email & Contact</th>
                                  <th class="th-sm">Action</th>
                              </tr>
                          </thead>
                          <tbody id="birthdaybody">
                              @foreach($enquiries as $enquiry)
                              <tr>
                                  <td>{{($loop->index)+1}}</td>
                                  <td>{{$enquiry->name}}</td>
                                  <td>{{$enquiry->contact}} </td>
                                  <td>
                                    <button type="button" onclick="show_enq_status({{$enquiry->id}})" class="theme-btn">Status</button>
                                  </td>
                              </tr>
                              @endforeach
                          </tbody>
                        </table>
                        </div>
                      </div>

                  </div>

                </div><!--./panelbox-->

              </div><!--./Customer-->


            </div><!--./tab-content-->
         </div><!--./boxbody-->
       </div><!--./container-fluid-->
      <footer>Copyright © 2020 Chinnie & Vinnie Jabalpur Salon. All rights reserved.</footer>
     </div><!--./main-content-->

   </div><!--./main-->

      <div class="modal" id="addenquiry">
        <div class="modal-dialog modal-lg">
          <form id="addenquiryform" enctype="multipart/form-data">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Add Enquiry</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <input type = "hidden" name = "_token" id="csrfToken" value = "<?php echo csrf_token(); ?>">
              <!-- Modal body -->
              <div class="modal-body formvisit">
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label" for="name">Name <span class="required">* </span> </label>
                        <input type="text"  id="name" name="name" value="{{ old('name') }}" placeholder="Enter name"  class="form-control" autocomplete="off">
                        <span class="text text-danger"> @if ($errors->has('name')){{ $errors->first('name') }} @endif</span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label" for="name">Contact <span class="required">* </span> </label>
                        <input type="text"  id="contact" name="contact" value="{{ old('contact') }}" placeholder="Enter Contact"  class="form-control" autocomplete="off">
                        <span class="text text-danger"> @if ($errors->has('contact')){{ $errors->first('contact') }} @endif</span>
                    </div>
                  </div>
                </div><!--./row-->
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label" for="name">For <span class="required">* </span> </label>
                        <input type="text"  id="enq_for" name="enq_for" value="{{ old('enq_for') }}" placeholder="Enter Enquiry for"  class="form-control" autocomplete="off">
                        <span class="text text-danger"> @if ($errors->has('enq_for')){{ $errors->first('Enquiry for') }} @endif</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label" for="Description">Description</label>
                      <textarea id="description" name="description" placeholder="Enter Description"  class="form-control">{{ old('description') }}</textarea>
                      <span class="text text-danger"> @if ($errors->has('description')){{ $errors->first('description') }} @endif</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="outline-btn" data-dismiss="modal">Cancel</button>
                <button type="button" onclick="addEnquiry()" class="theme-btn">Save</button>
              </div>
            </div>
          </form>
        </div>
      </div><!--#/addcustomer-->

      <div class="modal" id="enquiryStatus">
        <div class="modal-dialog modal-lg">
          <form id="addenquiryform" enctype="multipart/form-data">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Change Enquiry Status</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <input type = "hidden" name = "_token" id="csrfToken" value = "<?php echo csrf_token(); ?>">
              <!-- Modal body -->
              <div class="modal-body formvisit">
                <div class="row">
                  <div class="col-md-8">
                    <div class="form-group">
                      <label class="control-label" for="Description">Status</label>
                      <select name="status" id="enqStatus" class="form-control">
                        <option value="Cash">CASH</option>
                        <option value="Cancle">CANCLE</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="outline-btn" data-dismiss="modal">Cancel</button>
                <button type="button" onclick="updateEnquiryStatus()" class="theme-btn">Save</button>
              </div>
            </div>
          </form>
        </div>
      </div><!--#/addcustomer-->

<script src="{{asset('assets/js/lib/jquery.js')}}"></script>
<script src="{{asset('assets/js/dist/jquery.validate.js')}}"></script>
<script type="text/javascript">
  function addEnquiry(){
      var add_enquiry_form=$('#addenquiryform').serialize();
      $.ajax({
          url:"{{ route('enquiry.store') }}",
          type:'POST',
          data:add_enquiry_form,
          dataType:'JSON',
          success:function(res) {
            console.log(res);
            localStorage.clear();
            window.location.reload();
          },
          error: function(jqXHR, textStatus, errorThrown) {
          alert('Something went wrong in addEnquiry');
          }
        });
    }

    function show_enq_status(enq_id){
      localStorage.setItem('enq_id', enq_id);
      $('#enquiryStatus').modal('show');
    }

    function updateEnquiryStatus(){
      let enq_id=localStorage.getItem('enq_id');
      var Status=$('#enqStatus').val();
      if(enq_id!=""){
        $.ajax({
          url:"{{ url('enquiry_status_update') }}",
          type:'POST',
          data:{"_token": "{{ csrf_token() }}",'Status':Status,'enq_id':enq_id},
          dataType:'JSON',
          success:function(res) {
            console.log(res);
            localStorage.clear();
            window.location.reload();
          },
          error: function(jqXHR, textStatus, errorThrown) {
          alert('Something went wrong in addEnquiry');
          }
        });
      }
      else{
        alert('Enquiry not found');
      }
    }

</script>
@endsection
