@extends('layouts.newlayout.app')
@section('content')
<div class="main">
    <div class="main-content">
      <div class="container-fluid">
         <div class="boxbody">
            <ul class="nav nav-tabs2 nav-justified">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#Staff">Staffs</a>
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
                  <div class="text-right mt-2 mb-2">
                      <a href="{{route('staff.create')}}" class="theme-btn">Add Staffs</a></div>
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
                    <table class="table table-bordered table-striped recent-purchases-listing">
                      <thead>
                        <tr>
                          <th class="th-sm">Sr</th>
                          <th class="th-sm">Image</th>
                          <th class="th-sm">Department</th>
                          <th class="th-sm">Name</th>
                          <th class="th-sm">Contact</th>                          
                          <th class="th-sm">Email</th>
                          <th class="th-sm">Action</th>
                        </tr>
                      </thead>
                      <tbody id="StaffTableBody">
                        @foreach($staff_list as $staff)
                        <tr>
                            <td>{{($loop->index)+1}}</td>
                            <td>
                                @if(!empty($cat->image))
                                <img src="{{ url('images/staff') }}/{{$staff->image}}" width="80px">
                                @else
                                <img class="img img-responsive center-block" src="{{ url('images/staff/icon.png') }}" width="80px">
                                @endif
                            </td>
                            <td>{{$staff->role_name}}</td>
                            <td>{{$staff->name}}</td>
                            <td>{{$staff->phone_no}}</td>
                            <td>{{ $staff->email }}</td>
                            <td>
                                <table style="border:none;!important">
                                    <tr>
                                    <td style="padding: 2">
                                        <a href="{{ route('staff.edit',$staff->id)}}" class="btn-primary btn-sm " >
                                        <i class="fa fa-pencil"></i>
                                        </a>
                                        <!-- <a href="" class="btn btn-primary">Edit</a> -->
                                    </td>
                                    <td style="padding: 2">
                                        <a href="{{ route('staff.roles', ['id'=>$staff->id])}}" class="btn-success btn-sm">
                                        Role
                                        </a>
                                        <!-- <a href="" class="btn btn-primary">Edit</a> -->
                                    </td>
                                    <td style="padding: 2">
                                        <form action="{{ route('staff.destroy', $staff->id)}}" method="post">
                                        <input type="hidden" name="_method" value="delete" />
                                        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                                        <button class="btn-danger btn-sm " type="submit" style="border:0 !important" ><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
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
   

<script src="{{asset('assets/js/lib/jquery.js')}}"></script>
<script src="{{asset('assets/js/dist/jquery.validate.js')}}"></script>
<script>


</script>
@endsection
