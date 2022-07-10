@extends('layouts.newlayout.app')
@section('content')
<div class="main">
    <div class="main-content">
      <div class="container-fluid">
         <div class="boxbody">
            <ul class="nav nav-tabs2 nav-justified">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#SittingPackageData">Filter Details</a>
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
                    <div class="container">
                        <div class="row">
                         Pack Name:-<h5>{{$pack_data[0]->pack_name}}</h5>
                        </div>
                        <div class="row">
                         Pack Price:- <h5><i class="fa fa-inr"></i> {{$pack_data[0]->pack_final_price}}</h5>   
                        </div>
                        <div class="row">
                        Package Advance Payment:- <h5> <i class="fa fa-inr"></i> {{$Cust_sitting_packs[0]->packageAdvancePayment}}</h5>
                        </div>
                        <div class="row">
                        Package Expire Date:- <h5> {{$Cust_sitting_packs[0]->expire_date}}</h5>
                        </div>
                    </div> 
                    <div class="table-responsive">
                        @foreach($Cust_sitting_packs as $rounds)
                    <table class="table table-bordered table-striped recent-purchases-listing">
                      <thead>
                        <tr>
                          <th class="th-sm">Sr</th>
                          <th class="th-sm">Name</th>
                          <th class="th-sm">Sitting Date</th>
                          <th class="th-sm">Sitting Time</th>
                          <th class="th-sm">Sitting Status</th>                          
                        </tr>
                      </thead>
                      <tbody id="SittingPackageTableBody">
                       <td>{{($loop->index)+1}}</td>
                       <td>Sitting {{$rounds->sitting_round}}</td>
                       <td>{{$rounds->sitting_date}}</td>
                       <td>{{$rounds->sitting_time}}</td>
                       <td>{{$rounds->sittingStatus}}</td>
                      </tbody>
                    </table>
                        @foreach($service_round[$rounds->sitting_round] as $ser_round)
                            @if($ser_round['round']== $rounds->sitting_round)                           
                             <h5>Services:- {{$ser_round['sbname']}}</h5>                                                                
                            @endif
                        @endforeach
                    @endforeach
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
