@extends('layouts.adminmaster')
@section('title', 'Manage users')
@section('content')
     <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3 >Manage users List<small>Here we have all users</small></h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Manage users List</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <!-- <li> <a href="{{route('manageusers.create')}}" title="Add New"><i class="fa fa-plus"></i></a></li> -->
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                     @if($message=Session::get('success'))
                        <div class="alert alert-success">
                          <p>{{ $message }}</p>
                        </div>
                     @endif
                    <div class="row">
                    <div class="col-md-10">
                      <a href="{{url('admin/manageusers')}}" type="button" class="btn {{ ($method=='manageusers')?'btn-primary':'btn-default'}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="All">All</a>
                      <a href="{{url('admin/active-manageusers')}}" type="button" class="btn {{ ($method=='active-manageusers')?'btn-primary':'btn-default'}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Active">Active</a>
                      <a href="{{url('admin/deactive-manageusers')}}"type="button" class="btn {{ ($method=='deactive-manageusers')?'btn-primary':'btn-default'}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Deactive">Deactive</a>

                    </div>
                    
                    <div class="col-md-2">
                      <select name="bulk_action" class="form-control" onchange="bulk_action(this.value);">
                        <option value="">Bulk Action</option>
                        <option value="active">Activate</option>
                        <option value="deactive">Deactivate</option>
                        <option value="delete">Delete</option>
                      </select>
                    </div>
                    </div>
                  
                    <table id="datatable-checkbox" class="table table-striped table-bordered jambo_table bulk_action">
                      <thead>
                        <tr class="headings">
                          <th>

                            <input type="checkbox" id="check-all" class="flat">
                          </th>
                          <th class="column-title" >Full Name</th>
                          
                          <th class="column-title">Status</th>
                          <th class="column-title" >Date</th>
                          <th class="column-title  no-link last" >Action</th>
                           <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                        </tr>
                      </thead>


                      <tbody>
                       
                        @foreach ($manageusers as $users)

                        <tr class="even pointer">
                          <td class="a-center ">
                            @if($users->id!='1')
                            <input type="checkbox"  class="flat bulk_ids" name="table_records" value="{{$users->id}}">
                            @endif
                          </td>
                          <td>{{ $users->name }}</td>
                         
                         
                          <td>
                             @if($users->id!='1')
                            <select name="status" class="form-control" onchange="change_status(this.value,{{$users->id}});">
                                         <option value="1" {{ old('status',$users->status) == '1' ? 'selected' : '' }} >Active</option>
                                         <option value="0" {{ old('status',$users->status) == '0' ? 'selected' : '' }}>Deactive</option>
                            </select>
                            @endif
                          </td>
                          <td>{{ date('d M Y',strtotime($users->created_at))}}</td>
                          <td>
                              <table >
                                <tr>
                                  <!-- <th style="padding: 0">
                                    <a href="{{ route('manageusers.edit',$users->id)}}" class="btn btn-primary">
                                      <i class="fa fa-edit"></i>
                                    </a>
                                   
                                  </th> -->
                                  <th style="padding: 0">
                                     @if($users->id!='1')
                                    <form action="{{ route('manageusers.destroy', $users->id)}}" method="post">
                                      <input type="hidden" name="_method" value="delete" />
                                      <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                                    <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                                    </form>
                                    @endif
                                  </th>
                                </tr>
                              </table>
                              
                              
                          </td>
                        </tr>
                        </form>
                         @endforeach

                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->


 <form method="post" action="{{url('admin/manageusers-bulk-action')}}" id="bulk_action_frm">
 @csrf
 <input type="hidden" name="method" value="{{$method}}">
 <input type="hidden" class="form-control" name="bulk_action" id="bulk_action">
 <input type="hidden" class="form-control" name="bulk_action_id" id="bulk_action_id">
 </form>

 <form method="post" action="{{url('admin/change_usertype')}}" id="change_usertype_frm">
 @csrf
 <input type="hidden" name="method" value="{{$method}}">
 <input type="hidden" class="form-control" name="user_type" id="change_user_type">
 <input type="hidden" class="form-control" name="user_id" id="change_user_id">
 </form>


 <form method="post" action="{{url('admin/change_status')}}" id="change_status_frm">
 @csrf
 <input type="hidden" name="method" value="{{$method}}">
 <input type="hidden" class="form-control" name="change_status" id="change_status">
 <input type="hidden" class="form-control" name="user_id" id="change_status_user_id">
 </form>

@endsection

@section('script')
<script>
  $(function () {
    $('#example1').DataTable()
  })

  function bulk_action(action){
    var checked_boxes = $('input.bulk_ids:checked').length
    if(checked_boxes>0){
      if(action!=''){
        var a = confirm('Are you sure you want to do this');
        if(a){
          var arr = [];
          $('input.bulk_ids:checkbox:checked').each(function () {
              arr.push($(this).val());
          });
          $('#bulk_action_id').val(arr);
          $('#bulk_action').val(action);
          $('#bulk_action_frm').submit();
        }else{
          return false;
        }
      }
    }else{
      alert('Please select atleast one row');
    }
  }


  function change_status(user_status,user_id){

    if(user_status!=''){
        var a = confirm('Are you sure you want to do this');
        if(a){
          $('#change_status').val(user_status);
          $('#change_status_user_id').val(user_id);
          $('#change_status_frm').submit();
        }else{
          return false;
        }
    }
  }


   function change_usertype(user_type,user_id){

    if(user_type!=''){
        var a = confirm('Are you sure you want to do this');
        if(a){
          $('#change_user_type').val(user_type);
          $('#change_user_id').val(user_id);
          $('#change_usertype_frm').submit();
        }else{
          return false;
        }
    }
  }

  function bulk_action(action){
    var checked_boxes = $('input.bulk_ids:checked').length
    if(checked_boxes>0){
      if(action!=''){
        var a = confirm('Are you sure you want to do this');
        if(a){
          var arr = [];
          $('input.bulk_ids:checkbox:checked').each(function () {
              arr.push($(this).val());
          });
          $('#bulk_action_id').val(arr);
          $('#bulk_action').val(action);
          $('#bulk_action_frm').submit();
        }else{
          return false;
        }
      }
    }else{
      alert('Please select atleast one row');
    }
  }
</script>
@endsection