@extends('layouts.newlayout.app')
@section('content')
<div class="main">
    <div class="main-content">
      <div class="container-fluid">
         <div class="boxbody">
            <ul class="nav nav-tabs2 nav-justified">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#Customer">Offers Summary</a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#Service">Service Segment</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#Upcoming">Upcoming Segment</a>
              </li> -->
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="Customer">
               
                <div class="panelbox">
                  <div class="row">
                    <div class="col-lg-3 col-md-6 col-12">
                      <div class="metric clr-block-1">
                        <h2>{{$total_offers}}</h2>
                        <p>Total offers</p>
                      </div><!--./metric-->
                    </div><!--/col-lg-3-->

                    <div class="col-lg-3 col-md-6 col-12">
                      <div class="metric clr-block-2">
                        <h2>{{$referring_offers}}</h2>
                        <p>Referring Party Offers</p>
                      </div><!--./metric-->
                    </div><!--/col-lg-3-->

                    <div class="col-lg-3 col-md-6 col-12">
                      <div class="metric clr-block-3">
                        <h2>{{$referred_offers}}</h2>
                        <p>Referred Party Offers</p>
                        
                      </div><!--./metric-->
                    </div><!--/col-lg-3-->

                    <div class="col-lg-3 col-md-6 col-12">
                      <div class="metric clr-block-4">
                        <h2>{{$Un_used_offers}}</h2>
                        <p>Unused Offers</p>
                        <span>(Assigned to Customers)</span>
                      </div><!--./metric-->
                    </div><!--/col-lg-3-->

  

                   </div><!--/col-lg-12-->
                  </div><!--./row-->
                  <div class="row">
                    <div class="container-fluid">
                      <div class="col-lg-12 col-md-12 col-12 mt-3">                        
                          <div class="table-responsive">
                            <table class="table table-bordered table-striped recent-purchases-listing" id="customer_data_Table">
                              <thead>
                                <tr>
                                    <th>Sr</th>
                                    <th>Customer Name</th> 
                                    <th>Customer Contact</th>                                    
                                    <th>Refer Customer Count</th>
                                    <th>Action</th>
                                </tr>
                              </thead>
                              <tbody id="customerTableBody">
                                @foreach($Customer_data as $cust)
                                <tr>
                                  <td>{{($loop->index)+1}}</td>
                                  <td>{{$cust->name}}</td>
                                  <td>{{$cust->contact}}</td>
                                  <td>0</td>
                                  <td></td>
                                </tr>                                  
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                      </div><!--/col-lg-12-->
                    </div>
                  </div>

                </div><!--./panelbox-->
               
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