@extends('layouts.adminmaster')
@section('title', 'Enquiry')
@section('content')

<div class="right-details-box">
            <div class="home_brics_row">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dash_boxcontainner white_boxlist">
                            <div class="upper_basic_heading">
                                <span class="white_dash_head_txt">Add staff <a href="{{ url('admin/staff') }}" class="btn margin0 btn-sm btn-mdb-color single-table-btn float-right waves-effect waves-light" ><i class="mdi mdi-arrow-left mr-1"></i>Back</a> </span>
                            </div>
                            <div class="panel-body dash_table_containner">
                            @if($message=Session::get('success'))
                            <div class="alert alert-success">
                              <p>{{ $message }}</p>
                            </div>
                            @endif
                            <div class="col-md-12">
                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('staff.store') }}" method = "post" enctype="multipart/form-data">
                                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                                
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label" for="image">Image <span class="required">*</span> </label>
                                        <input type="file"  name="image">
                                        <span class="text text-danger"> @if ($errors->has('image')){{ $errors->first('image') }} @endif</span>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label" for="name">Select Branch <span class="required">*</span> </label>
                                      <select class="form-control" id="branch" name="branch">
                                        <option value="">Select</option>
                                        @if(!empty($branches))
                                          @foreach($branches as $branch)
                                            @php
                                              $id_branch = $branch->id;
                                            @endphp
                                            <option value="{{$branch->id}}" {{(old("branch") == $id_branch ? "selected":"") }}>{{$branch->name}}</option>
                                          @endforeach
                                        @endif
                                      </select>
                                      <span class="text text-danger">@if ($errors->has('branch')){{ $errors->first('branch') }} @endif</span>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">

                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label" for="name">Name <span class="required">*</span> </label>
                                        <input type="text"  id="name" name="name" value="{{ old('name') }}" placeholder="Enter name"  class="form-control" autocomplete="off">
                                        <span class="text text-danger"> @if ($errors->has('name')){{ $errors->first('name') }} @endif</span>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label" for="contact">Contact <span class="required">*</span> </label>
                                        <input type="text"  id="contact" name="contact" value="{{ old('contact') }}" placeholder="Enter contact"  class="form-control" autocomplete="off">
                                        <span class="text text-danger"> @if ($errors->has('contact')){{ $errors->first('contact') }} @endif</span>
                                    </div>
                                  </div>
                                  
                                </div>

                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label" for="email">Email </label>
                                        <input type="text"  id="email" name="email" value="{{ old('email') }}" placeholder="Enter email"  class="form-control" autocomplete="off">
                                        <span class="text text-danger"> @if ($errors->has('email')){{ $errors->first('email') }} @endif</span>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label" for="email">Password </label>
                                        <input type="password"  id="password" name="password" value="{{ old('password') }}" placeholder="Enter password"  class="form-control" autocomplete="off">
                                        <span class="text text-danger"> @if ($errors->has('password')){{ $errors->first('password') }} @endif</span>
                                    </div>
                                  </div>

                                </div>

                                <div class="row">
                                  <div class="col-md-12">
                                  <div class="form-group">
                                     <button type="submit" class="btn btn-success">Save</button>
                                  </div>
                                  </div>
                                </div>

                              </form>
                            </div>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

  <link rel="stylesheet" href="{{asset('backend/js/bootstrap.min.css')}}">
  <script type="text/javascript" src="{{asset('backend/js/jquery-3.4.1.min.js')}}"></script>
  <script src="{{asset('backend/popup/bootstrap.min.js')}}"></script>

  <!-- Trigger the modal with a button -->
  <button type="button" id="service_modal" class="btn btn-info btn-lg" data-toggle="modal" data-target="#serviceModal" style="display: none">Open Modal</button>

  <!-- Modal -->
  <div class="modal fade" id="serviceModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Services</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
          <div class="show_services"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  



<script src="{{ asset('backend/calendar/jquery.js')}}"></script> 
<script src="{{ asset('backend/calendar/jquery-ui.js')}}"></script> 
<link href="{{ asset('backend/calendar/bootstrap.css')}}" rel="stylesheet">
<link href="{{ asset('backend/calendar/jquery-ui.css')}}" rel="stylesheet">   

<script type="text/javascript">
    $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });

    /*function getservices(package_id){
          if(package_id!=''){
            var dataString = 'package_id='+package_id;
            $.ajax({
            type: "POST",
            url: '{{ url("getservices")}}',
            data: dataString,
            cache: false,
            dataType: "json",
            success: function(result){
              $('#service_modal').trigger('click');
              console.log(result);
                 var list = '<table class="table table-stripped">';
                     list += '<tr><th>Service</th><th>Price</th></tr>'             
                  $.each(result, function (i, item) {
                    list +='<tr><td>'+result[i].service+'</td><td>'+result[i].total+'</td></tr>';
                  });//end each
                  
                  list += '</table>';

                  $('.show_services').html(list);
              
              }//end sucess
            });//end ajax
          }else{
            $('.show_services').html('No any services found');
          }
    }*/
</script>

@endsection

