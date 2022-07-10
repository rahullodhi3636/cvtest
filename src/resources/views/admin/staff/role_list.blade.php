@extends('layouts.newlayout.app')
@section('content')
<div class="main">
    <div class="main-content">
      <div class="container-fluid">
         <div class="boxbody">
            <ul class="nav nav-tabs2 nav-justified">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#Staff">Roles</a>
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
                <form class="formvisit">
                <div class="panelbox">
                  
                  <div class="row">

                   <div class="col-lg-12 col-md-12 col-12 mt-3">
                     <!-- <h6><i class="fa fa-tasks"></i> Staff Count <span id="customerCount">1</span></h6> -->
                      <div class="table-responsive">
                    <table class="table table-bordered table-striped recent-purchases-listing">
                      <thead>
                        <tr>
                          <th>Sr</th>
                          <th>Name</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody id="StaffTableBody">
                       @foreach($roles as $role)
                       <tr>
                         <td>{{($loop->index)+1}}</td>
                         <td>{{$role->role_name}}</td>
                         <td>{{$role->status}}</td>
                         <td>
                         <a href="{{route('staff.permission',['id'=>$role->role_id])}}" class="theme-btn"><i class="fa fa-eye"></i></a>   
                         <a href="#" class="theme-btn"><i class="fa fa-pencil"></i></a>   
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
   

<script src="{{asset('assets/js/lib/jquery.js')}}"></script>
<script src="{{asset('assets/js/dist/jquery.validate.js')}}"></script>
<script>


</script>
@endsection
