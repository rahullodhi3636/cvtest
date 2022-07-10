@extends('layouts.newlayout.app')
@section('content')
 <div class="main">
    <div class="main-content">
      <div class="container-fluid">
         <div class="boxbody">
            <ul class="nav nav-tabs2 nav-justified">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#Customer">Membership</a>
              </li>
            </ul>

            <div class="tab-content">
              <div class="tab-pane active" id="Customer">
                <form class="formvisit">
                <div class="panelbox">
                  <div class="text-right mt-2 mb-2">
                      <a href="{{route('MemberSystem.create')}}" class="theme-btn">New Membership</a>
                  </div>
                    <div class="row pull-right">
                        @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                            <li>{!! \Session::get('success') !!}</li>
                            </ul>
                        </div>
                        @endif
                    </div>
                  <div class="row">
                   <div class="col-lg-12 col-md-12 col-12 mt-3">
                     <!-- <h6><i class="fa fa-tasks"></i> Membership Count <span id="membershipCount">0</span></h6> -->
                      <div class="table-responsive">
                    <table class="table table-bordered table-striped recent-purchases-listing">
                      <thead>
                        <tr>
                          <th class="th-sm">Sr</th>
                          <th class="th-sm">Title</th>
                          <th class="th-sm">Type</th>
                          <th class="th-sm">Price</th>
                          <th class="th-sm">Minimum Required Amt</th>
                          <th class="th-sm">Validity (Days)</th>
                          <th class="th-sm">Action</th>
                        </tr>
                      </thead>
                      <tbody id="membersystemTableBody">
                        @foreach($Member_Systems as $Member_System)
                          <tr>
                            <td>{{($loop->index)+1}}</td>
                            <td>{{$Member_System->membership_name}}</td>
                            <td>{{$Member_System->membership_type}}</td>
                            <td> <i class="fa fa-inr"></i> {{$Member_System->membership_price}}</td>
                            <td><i class="fa fa-inr"></i> {{$Member_System->minimum_req_amt}} </td>
                            <td>{{$Member_System->membership_validity}} days</td>
                            <td>
                              <!-- <button type='button' class='btn btn-info' onclick='getPlanDetails($Member_System->id)'>
                                <i class='fa fa-eye'></i>
                              </button> -->
                              <!-- <th style="padding: 0"> -->
                                <form action="{{route('MemberSystem.destroy', $Member_System->id)}}" method="post">
                                  <input type="hidden" name="_method" value="delete" />
                                  <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                                  <button class="btn-danger btn-sm waves-effect waves-light material-tooltip-main" type="submit" style="border:0 !important" data-toggle="tooltip" data-html="true" title="Delete"><i class="fa fa-close">Delete</i></button>
                                </form>
                              <!-- </th> -->
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

<script src="{{asset('assets/js/lib/jquery.js')}}"></script>
<script src="{{asset('assets/js/dist/jquery.validate.js')}}"></script>
<script type="text/javascript">
  function getPlanDetails(plan_id)
  {
    console.log(plan_id);
  }

</script>
@endsection
