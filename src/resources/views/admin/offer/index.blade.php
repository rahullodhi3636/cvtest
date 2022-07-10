@extends('layouts.newlayout.app')
@section('content')
 <div class="main">
    <div class="main-content">
      <div class="container-fluid">
         <div class="boxbody">
            <ul class="nav nav-tabs2 nav-justified">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#OfferListDiv">Referral</a>
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="OfferListDiv">
                <form class="formvisit">  
                <div class="panelbox">
                  <div class="text-right mt-2 mb-2">
                      <a href="{{url('offer_dashboard')}}" class="theme-btn">Dashboard</a>
                      <a href="{{route('offers.create')}}" class="theme-btn">New Referral</a>
                  </div>
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
                        @if (\Session::has('danger'))
                        <div class="alert alert-danger">
                            <ul>
                            <li>{!! \Session::get('danger') !!}</li>
                            </ul>
                        </div>
                        @endif
                    </div>
                     <!-- <h6><i class="fa fa-tasks"></i> Offer Count <span id="OfferCount">0</span></h6> -->
                      <div class="table-responsive">
                    <table class="table table-bordered table-striped recent-purchases-listing">
                      <thead>
                        <tr>
                          <th class="th-sm">Sr</th>
                          <th class="th-sm">Title</th>
                          <th class="th-sm">Referred Benefits</th>
                          <th class="th-sm">Referring Benefits</th>
                          <th class="th-sm">Type</th>
                          <th class="th-sm">Price</th>
                          <th class="th-sm">Validity (Days)</th>
                          <th class="th-sm">Action</th>
                        </tr>
                      </thead>
                      <tbody id="OffersystemTableBody">
                       @foreach($Offer_data as $Offers)
                        <tr>
                          <td>{{($loop->index)+1}}</td>
                          <td>{{$Offers->offer_title}}</td>
                          <td>{{$Offers->reffered_benefits}}</td>
                          <td>{{$Offers->referring_benefits}}</td>
                          <td>{{$Offers->offer_type}}</td>
                          <td> <i class="fa fa-inr"></i> {{$Offers->offer_price}}</td>
                          <td>{{$Offers->offer_validity}} Days</td>
                          <td width="200px">
                            <table>
                              <tr>
                                <td><a href="{{ route('offers.edit', $Offers->id)}}"  class="btn-primary btn-sm waves-effect waves-light text-light material-tooltip-main"><i class="fa fa-edit"></i></a></td>
                                <td>
                                  <form action="{{route('offers.destroy', $Offers->id)}}" method="post">
                                  <input type="hidden" name="_method" value="delete" />
                                  <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                                  <button class="btn-danger btn-sm waves-effect waves-light material-tooltip-main" type="submit" style="border:0 !important" data-toggle="tooltip" data-html="true" title="Delete">
                                    <i class="fa fa-trash"></i>
                                  </button>
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
      
   </div><!--./main-->
 
<script src="{{asset('assets/js/lib/jquery.js')}}"></script>
<script src="{{asset('assets/js/dist/jquery.validate.js')}}"></script>
<script type="text/javascript">
  function getOfferDetails(Offer_id)
  {
    console.log(Offer_id);
  }
  
</script>
@endsection