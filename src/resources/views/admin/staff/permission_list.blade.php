@extends('layouts.newlayout.app')
@section('content')
<div class="main">
    <div class="main-content">
      <div class="container-fluid">
         <div class="boxbody">
            <ul class="nav nav-tabs2 nav-justified">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#Staff">Permission</a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#Service">Service Segment</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#Upcoming">Upcoming Segment</a>
              </li> -->
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="Staff">
                <div class="panelbox">                  
                  <div class="row">
                   <div class="col-lg-12 col-md-12 col-12 mt-3">
                   <div class="row pull-right">
                        @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                            <li>{!! \Session::get('success') !!}</li>
                            </ul>
                        </div>
                        @endif
                        @if (\Session::has('msg'))
                        <div class="alert alert-danger">
                            <ul>
                            <li>{!! \Session::get('msg') !!}</li>
                            </ul>
                        </div>
                        @endif
                    </div>
                      <div class="table-responsive">
                        <form id="addStaffForm" action="{{ route('staff.role_update') }}" method="post" class="formvisit mt-2">
                        @csrf  
                        <table class="table table-bordered table-striped recent-purchases-listing">
                            <thead>
                              <tr>
                                <th>Sr</th>
                                <th>Name</th>
                                <th>Permission</th>
                              </tr>
                            </thead>
                            <tbody id="StaffTableBody"> 
                            @php ($allowed = [])  @endphp
                              @foreach ($allowed_modules as $allowed_module)
                                  @php ($allowed[] = $allowed_module->module_id)  @endphp
                              @endforeach
                          
                            @foreach($modules as $module)
                            <tr>
                              <td>{{($loop->index)+1}}</td>
                              <td>
                                {{$module->module_name}}
                                <input type="hidden" name="module_id[]" value="{{$module->module_id}}">
                              </td>
                              <td>                         
                                <div class="form-check">                             
                                  <input class="form-check-input" type="checkbox" name="module_permision[]" value="{{$module->module_id}}" id="module_permision" @if(in_array($module->module_id, $allowed)) checked @endif>                                  
                                  <label class="form-check-label" for="module_permision">Allow</label>
                                </div>                           
                              </td>
                            </tr>
                            @endforeach
                            </tbody>
                          </table>
                          <div class="row">                    
                            
                            <div class="col-lg-12 col-md-12 col-12 text-center mb-3 mt-3">   
                            <input type="hidden" name="role_id" value="{{ Request::segment(2) }}">                         
                            <input type="submit" name="Staff_permission"  value="Update" class="btn btn-success">
                            </div>
                          </div>
                        </form>
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
   

<script src="{{asset('assets/js/lib/jquery.js')}}"></script>
<script src="{{asset('assets/js/dist/jquery.validate.js')}}"></script>
<script>


</script>
@endsection
