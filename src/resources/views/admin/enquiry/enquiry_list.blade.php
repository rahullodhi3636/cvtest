@extends('layouts.adminmaster')
@section('title', 'Enquiry')
@section('content')
        <div class="right-details-box">
            <div class="home_brics_row">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dash_boxcontainner white_boxlist">
                            <div class="upper_basic_heading">
                                <span class="white_dash_head_txt">Enquiry List <a href="{{route('enquiry.create')}}" class="btn margin0 btn-sm btn-mdb-color single-table-btn float-right waves-effect waves-light" type="button"><i class="mdi mdi-plus mr-1"></i>Add New Enquiry
</a> </span>
                                
                            
                            </div>
                            <div class="panel-body dash_table_containner">
                            @if($message=Session::get('success'))
                            <div class="alert alert-success">
                              {{ $message }}
                            </div>
                            @endif
                            <table class="table table-striped table-bordered dtBasicExample" cellspacing="0" width="100%">
                              <thead>
                                <tr>
                                  <th class="th-sm">Name</th>
                                  <th class="th-sm">Contact</th>
                                  <th class="th-sm">Address</th>
                                  <th class="th-sm">Remark</th>
                                  <th class="th-sm">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                              @foreach ($enquiry as $cat)
                                <tr>
                                  <td>{{ $cat->name }}</td>
                                  <td>{{ $cat->contact }}</td>
                                  <td>{{ $cat->address }}</td>
                                  <td>{{ $cat->remark }}</td>
                                 
                                
                                    
                                       <td>
                                          <a href="{{ route('enquiry.edit',$cat->id)}}" class="btn-primary btn-sm waves-effect waves-light text-light material-tooltip-main float-left" data-toggle="tooltip" data-html="true" title="Edit">
                                            <i class="mdi mdi-pencil"></i>
                                          </a>
                                      
                                          <form action="{{ route('enquiry.destroy', $cat->id)}}" method="post" class="float-left">
                                            <input type="hidden" name="_method" value="delete" />
                                            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                                            <button class="btn-danger btn-sm waves-effect waves-light material-tooltip-main" type="submit" style="border:0 !important" data-toggle="tooltip" data-html="true" title="Delete"><i class="mdi mdi-delete"></i></button>
                                          </form>
                                       
                                         <a onclick="add_remark('{{ $cat->id }}')" class="btn-warning btn-sm waves-effect waves-light text-light material-tooltip-main float-left" data-toggle="tooltip" data-html="true" title="Add Remark"><i class="mdi mdi-comment-plus-outline"></i></a>
                                         <a onclick="view_remark('{{ $cat->id }}')" class="btn-info btn-sm waves-effect waves-light text-light material-tooltip-main float-left" data-toggle="tooltip" data-html="true" title="View Remark"><i class="mdi mdi-comment-text-outline"></i></a>
                                        </td>
                                     
                                </tr>
                                @endforeach
                                
                              
                              </tbody>
                              <tfoot>
                                <tr>
                                   <th class="th-sm">Name</th>
                                  <th class="th-sm">Contact</th>
                                  <th class="th-sm">Address</th>
                                  <th class="th-sm">Remark</th>
                                  <th class="th-sm">Action</th>
                                  
                                </tr>
                              </tfoot>
                            </table>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

  <link rel="stylesheet" href="{{asset('backend/js/bootstrap.min.css')}}">
  <script type="text/javascript" src="{{asset('backend/js/jquery-3.4.1.min.js')}}"></script>
  <script src="{{asset('backend/popup/bootstrap.min.js')}}"></script>
  <!-- Modal -->
  <div class="modal fade" id="add_remark_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Add Remark</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="show_result"></div>
         
                <div class="col-sm-12">
                      <div class="form-group">
                          <select name="status" id="status" class="form-control">
                              <option value="Interested">Interested</option>
                              <option value="Not Interested" >Not Interested</option>
                              <option value="Enrolled">Enrolled</option>
                              <option value="Closed">Closed</option>
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="username">Remark</label>
                          <input type="text" class="form-control required" id="remark" name="remark" autocomplete="off" placeholder="Remark" maxlength="50">
                          <input type="hidden" class="form-control " id="cid" name="cid" autocomplete="off" placeholder="Remark" maxlength="50">
                          <span id="remark_error" class="text-danger"></span>
                      </div>
                      <div class="form-group">
                          <label for="username">Next Followup Date</label>
                          <input type="text" class="form-control datepicker" value="{{ date('Y-m-d') }}" id="date" name="date" autocomplete="off" placeholder="Followup Date"
                              maxlength="50">
                      </div>

                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <button class="btn btn-info btn-sm" onclick="submit_remark()">Submit</button>
                    </div>
                </div>
          
        </div>
      </div>
      
    </div>
  </div>


  <div class="modal fade" id="view_remark_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">View Remark</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="show_services">
                
          </div>
        </div>
      </div>
      
    </div>
  </div>


  
  



<script src="{{ asset('backend/calendar/jquery.js')}}"></script> 
<script src="{{ asset('backend/calendar/jquery-ui.js')}}"></script> 
<!-- <link href="{{ asset('backend/calendar/bootstrap.css')}}" rel="stylesheet"> -->
<link href="{{ asset('backend/calendar/jquery-ui.css')}}" rel="stylesheet">   

<script type="text/javascript">
    $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });

    function submit_remark(){
          var status = $('#status').val();
          var remark = $('#remark').val();
          var cid = $('#cid').val();
          var date = $('#date').val();
          if(remark!=''){
            var dataString = 'status='+status+'&remark='+remark+'&cid='+cid+'&date='+date;
            $.ajax({
            type: "POST",
            url: '{{ url("addremark")}}',
            data: dataString,
            cache: false,
            dataType: "json",
            success: function(result){
              //console.log(result);
              if(result.status=='1'){
                   $('.show_result').html(result.msg);
                   setTimeout(function(){ 
                      $('#add_remark_modal').modal('hide');
                   }, 1000);
              }else{
                   $('.show_result').html(result.msg);
              }
                  
              }//end sucess
            });//end ajax
          }else{
            $('#remark_error').html('Please insert remark');
          }
    }
</script>

@endsection
@section('script')
<script>
  function add_remark(id){
         $('#cid').val(id);
         $('#add_remark_modal').modal('show');
  }

  function view_remark(id){
            if(id!=''){
              var dataString = 'id='+id;
              $.ajax({
              type: "POST",
              url: '{{ url("viewremark")}}',
              data: dataString,
              cache: false,
              dataType: "json",
              success: function(result){
                   //console.log(result);
                      if(result!=''){
                        $('#view_remark_modal').modal('show');
                        var list = '<table class="table table-stripped">';
                        list += '<tr><th>Remark</th><th>Status</th><th>Next Followup date</th></tr>'             
                        $.each(result, function (i, item) {
                          list +='<tr><td>'+result[i].remark+'</td><td>'+result[i].status_id+'</td><td>'+result[i].date+'</td></tr>';
                        });//end each
                        list += '</table>';
                        $('.show_services').html(list);
                      }
                    
                }//end sucess
              });//end ajax
            }else{
              $('.show_result').html('<div class="alert alert-danger">Remark id not found</div>');
            }
  }
</script>
@endsection