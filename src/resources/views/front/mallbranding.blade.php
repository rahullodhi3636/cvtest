@extends('layouts.frontmaster')
@section('content')
 <section class="videomain">   
   <img src="{{asset('frontend/images/slider5.jpg')}}" class="img-fluid">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="banner-inner">
            <div class="item">
              <div class="item animated"><div class="one"></div><div class="rotate1deg"><div class="two"></div></div></div>
            </div><!--./item-->
            <div class="section-head-white">
                <h2>Mall Branding</h2>
                <p><b>Advrtu</b> is an experience. You have to live it to know it... Rediscover yourself!</p>
            </div><!--./section-head-->
           
          </div><!--./banner-inner-->
         <div class="slidearrow"><a href="#Welcome" class="page-scroll"><i class="fa fa-angle-down"></i></a></div>
        </div><!--./col-lg-12-->
      </div><!--./row-->
    </div><!--./container-->
  </section> 
<!-- 
@php
echo '<pre>';
print_r($branding);
echo '</pre>';
@endphp -->
<section class="spacet70 spaceb100" id="Welcome">
  <div class="container">
      <div class="row">
      @if(!empty($branding))
      @foreach($branding as $value)

      <div class="col-lg-4 col-md-12 col-12">
          <div class="mallbranding">
              <div class="hovereffect">
                  <div class="mallbrandingimg"><img src="{{asset('images/mall_brandings/'.$value->image)}}" class="mx-auto d-block"></div>   
                      <div class="overlay">
                        <div class="hovereffect-title">
                          <h3>{{$value->title}}</h3>
                        </div>
                    </div>    
                </div>
              <div class="mallcontent">
              <div class="clear mb-2">   
                <div class="position"><b>Position:</b> {{$value->position}}</div> 
                <div class=""><b>Size:</b> {{$value->size}}</div>
              </div>  
              <div class="clear"> 
                
                <div class="brprice float-left">Price &nbsp;&#8377;
                @if($value->offer_price!=0)
                  <span><del>{{$value->rate}}/-</del></span>
                @endif
                </div>
                <div class="brprice float-left">{{$value->offer_price}}/-</div>
                <div class="discount float-right">Discount <span>{{$value->discount}}%</span></div> 
              </div>  
              <div class="clear mt-2"> 
                
                <div class="brwhat"><a href="https://api.whatsapp.com/send?phone={{$value->whatsup_no}}" target="_blank"><i class="fa fa-whatsapp"></i>{{$value->whatsup_no}}</a></div>
                
               </div>  
              </div>
          </div><!--./mallbranding-->
       </div><!--./col-lg-6-->

      @endforeach
      @endif
      </div><!--./row--> 
  </div>          
</section>
@endsection