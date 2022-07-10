@extends('layouts.newlayout.app')
@section('content')
 <div class="main">
    <div class="main-content">
      <div class="container-fluid">
         <div class="boxbody">
            <ul class="nav nav-tabs2 nav-justified">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#CouponListDiv">Coupon</a>
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="CouponListDiv">
                <form class="formvisit">  
                <div class="panelbox">
                  <div class="text-right mt-2 mb-2">
                      <a href="{{route('coupon.create')}}" class="theme-btn">New Coupon</a>
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
                     <h6><i class="fa fa-tasks"></i> Coupon Count <span id="CouponCount">0</span></h6>
                      <div class="table-responsive">
                    <table class="table table-bordered table-striped recent-purchases-listing">
                      <thead>
                        <tr>
                          <th class="th-sm">Sr</th>
                          <th class="th-sm">Title</th>
                          <th class="th-sm">Type</th>
                          <th class="th-sm">Prefix</th>
                          <th class="th-sm">Discount</th>
                          <th class="th-sm">Allowed Use Count</th>
                          <th class="th-sm">Req Min Amt</th>
                          <th class="th-sm">Valid From</th>
                          <th class="th-sm">Valid To</th>
                          <!-- <th class="th-sm">Validity (Days)</th> -->
                          <th class="th-sm">Action</th>
                        </tr>
                      </thead>
                      <tbody id="couponsystemTableBody">
                        @foreach($Coupon_data as $Coupons)
                          <tr>
                            <td>{{($loop->index)+1}}</td>
                            <td>{{$Coupons->coupon_title}}</td>
                            <td>{{$Coupons->coupon_type}}</td>
                            <td>{{$Coupons->coupon_prefix}}</td>
                            <td>{{$Coupons->coupon_discount}}
                            @if($Coupons->coupon_type=='Percentage')
                                 %
                            @else
                                <i class="fa fa-inr"></i> 
                            @endif
                            </td>
                            <td>{{$Coupons->allow_count}}</td>
                            <td> <i class="fa fa-inr"></i>  {{$Coupons->min_amount}}</td>
                            <td>{{date('d-M-Y',strtotime($Coupons->start_date))}} </td>
                            <td>{{date('d-M-Y',strtotime($Coupons->expire_date))}}</td>
                            <td>
                                <form action="{{route('coupon.destroy', $Coupons->id)}}" method="post">
                                  <input type="hidden" name="_method" value="delete" />
                                  <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                                  <button class="btn-danger btn-sm waves-effect waves-light material-tooltip-main" type="submit" style="border:0 !important" data-toggle="tooltip" data-html="true" title="Delete"><i class="fa fa-close">Delete</i></button>
                                </form>
                            </td>
                            <!-- <td>{{$Coupons->coupon_validity}}</td> -->
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
  function getCouponDetails(coupon_id)
  {
    console.log(coupon_id);
  }
  
</script>
@endsection