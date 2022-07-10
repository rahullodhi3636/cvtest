@extends('layouts.frontmaster')
@section('content')
<section class="videomain">   
   <img src="{{asset('frontend/images/slider3.jpg')}}" class="img-fluid">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="banner-inner">
            <div class="item">
              <div class="item animated"><div class="one"></div><div class="rotate1deg"><div class="two"></div></div></div>
            </div><!--./item-->
            <div class="section-head-white">
                <h2>Post</h2>
                <p><b>Advrtu</b> is an experience. You have to live it to know it... Rediscover yourself!</p>
            </div><!--./section-head-->
           
          </div><!--./banner-inner-->
        </div><!--./col-lg-12-->
      </div><!--./row-->
    </div><!--./container-->
  </section> 

<section class="spacet70 spaceb70">
  <div class="container">
      <!-- projects -->
      <div id="portfolio" class="no-gutter">
          <ul class="row portfolio list-unstyled gallery" id="grid">

              <!-- project -->
              <li class="col-lg-4 col-md-12 col-12 project" data-groups='["portrait"]'>
                  <figure class="portfolio-item">
                      <div class="hovereffect">
                        <img src="{{asset('frontend/images/grand-ads/grend-ads-1.jpg')}}" class="img-fluid" />
                          <!-- <img class="img-responsive" src="images/project1.jpg" alt=""> -->
                          <a href="images/grand-ads/grend-ads-1.jpg">
                              <div class="overlay">
                                  <div class="hovereffect-title">
                                  </div>
                              </div>
                          </a>
                      </div>
                  </figure>
              </li>

              <li class="col-lg-4 col-md-12 col-12 project" data-groups='["portrait"]'>
                  <figure class="portfolio-item">
                      <div class="hovereffect">
                        <img src="{{asset('frontend/images/grand-ads/grend-ads-2.jpg')}}" class="img-fluid" />
                          <!-- <img class="img-responsive" src="images/project1.jpg" alt=""> -->
                          <a href="images/grand-ads/grend-ads-2.jpg">
                              <div class="overlay">
                                  <div class="hovereffect-title">
                                  </div>
                              </div>
                          </a>
                      </div>
                  </figure>
              </li>

              <li class="col-lg-4 col-md-12 col-12 project" data-groups='["portrait"]'>
                  <figure class="portfolio-item">
                      <div class="hovereffect">
                        <img src="{{asset('frontend/images/grand-ads/grend-ads-3.jpg')}}" class="img-fluid" />
                          <!-- <img class="img-responsive" src="images/project1.jpg" alt=""> -->
                          <a href="images/grand-ads/grend-ads-3.jpg">
                              <div class="overlay">
                                  <div class="hovereffect-title">
                                  </div>
                              </div>
                          </a>
                      </div>
                  </figure>
              </li>

           </ul>
        </div>
    </div>          
</section>
@endsection