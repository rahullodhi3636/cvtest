@extends('layouts.newlayout.app')
@section('content')
<div class="main">
    <div class="main-content">
      <div class="container-fluid">
         <div class="boxbody">
            <ul class="nav nav-tabs2 nav-justified">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#SittingPackageData">Bridal Package</a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#Service">Service Segment</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#Upcoming">Upcoming Segment</a>
              </li> -->
            </ul>

            <div class="tab-content">
              <div class="tab-pane active" id="SittingPackageData">
                <form class="formvisit">
                <div class="panelbox">
                  <div class="text-right mt-2 mb-2">
                      <a href="{{route('SittingPack.create')}}" class="theme-btn">New Bridal Package</a>
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
                     <!-- <h6><i class="fa fa-tasks"></i> SittingPackage Count <span id="customerCount">0</span></h6> -->
                      <div class="table-responsive">
                    <table class="table table-bordered table-striped recent-purchases-listing">
                      <thead>
                        <tr>
                          <th class="th-sm">Sr</th>
                          <th class="th-sm">Name</th>
                          <th class="th-sm">Total Members</th>
                          <th class="th-sm">Final Price</th>
                          <th class="th-sm">Action</th>
                        </tr>
                      </thead>
                      <tbody id="SittingPackageTableBody">
                        @foreach($sittingPacks as $sittingPack)
                        <tr>
                          <td>{{($loop->index)+1}}</td>
                          <td>{{$sittingPack->pack_name}}</td>
                          <td>{{$sittingPack->total_members}}</td>
                          <td><i class="fa fa-inr"></i> {{$sittingPack->pack_final_price}}</td>
                          <td>
                            <table>
                                <tr>
                                  <th style="padding: 0">
                                      <a href="{{route('SittingPack.edit', $sittingPack->id)}}" class="mr-2 btn-primary btn-sm waves-effect waves-light text-light material-tooltip-main" title="Edit">
                                        <i class="fa fa-edit"></i>
                                      </a>
                                  </th>
                                  <th style="padding: 0">
                                    <form action="{{route('SittingPack.destroy', $sittingPack->id)}}" method="post">
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


    <script src="{{asset('assets/js/lib/jquery.js')}}"></script>
    <script src="{{asset('assets/js/dist/jquery.validate.js')}}"></script>
    <script>


    </script>
@endsection
