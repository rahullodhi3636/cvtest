@extends('layouts.frontmaster')
@section('content')
   <section class="videomain">   
   <img src="{{asset('frontend/images/slider4.jpg')}}" class="img-fluid">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="banner-inner">
            <div class="item">
              <div class="item animated"><div class="one"></div><div class="rotate1deg"><div class="two"></div></div></div>
            </div><!--./item-->
            <div class="section-head-white">
                <h2>Events</h2>
                <p><b>Advrtu</b> is an experience. You have to live it to know it... Rediscover yourself!</p>
            </div><!--./section-head-->
           
          </div><!--./banner-inner-->
           <div class="slidearrow"><a href="#Welcome" class="page-scroll"><i class="fa fa-angle-down"></i></a></div>
        </div><!--./col-lg-12-->
      </div><!--./row-->
    </div><!--./container-->
  </section> 
<section class="spacet70 spaceb70" id="Welcome">
<div class="container-fluid">
   <div class="filters filter-button-group">
    <ul class="filter">
        <li class="active" data-filter="*">All</li>
        <li data-filter=".Master">Smadareeya Master Chef</li>
        <li data-filter=".Frankfinn">Frankfinn</li>
        <li data-filter=".Cutest">Cutest Kid</li>
        <li data-filter=".State">State Level Dance Competition</li>
        <li data-filter=".Competition">Open Mic Competition</li>
    </ul>
  </div>
    <!-- projects -->
    <div id="portfolio" class="no-gutter">
        <ul class="row all-portfolios portfolio list-unstyled gallery grid2">

            <!-- project -->
            <li class="col-lg-3 col-md-12 col-12 project single-portfolio State" data-groups='["portrait"]'>
                <figure class="portfolio-item">
                    <div class="hovereffect">
                      <img src="{{asset('frontend/images/post/summer-event-2.jpg')}}" class="img-fluid" />
                        <a href="{{asset('frontend/images/post/summer-event-2.jpg')}}">
                            <div class="overlay">
                                <div class="hovereffect-title">
                                </div>
                            </div>
                        </a>
                    </div>
                </figure>
            </li>

            <li class="col-lg-3 col-md-12 col-12 project single-portfolio State" data-groups='["portrait"]'>
                <figure class="portfolio-item">
                    <div class="hovereffect">
                      <img src="{{asset('frontend/images/post/summer-event-3.jpg')}}" class="img-fluid" />
                        <a href="{{asset('frontend/images/post/summer-event-3.jpg')}}">
                            <div class="overlay">
                                <div class="hovereffect-title">
                                </div>
                            </div>
                        </a>
                    </div>
                </figure>
            </li>

            <li class="col-lg-3 col-md-12 col-12 project single-portfolio State" data-groups='["portrait"]'>
                <figure class="portfolio-item">
                    <div class="hovereffect">
                      <img src="{{asset('frontend/images/post/summer-event-4.jpg')}}" class="img-fluid" />
                        <a href="{{asset('frontend/images/post/summer-event-4.jpg')}}">
                            <div class="overlay">
                                <div class="hovereffect-title">
                                </div>
                            </div>
                        </a>
                    </div>
                </figure>
            </li>
            <li class="col-lg-3 col-md-12 col-12 project single-portfolio Master" data-groups='["portrait"]'>
               <figure class="portfolio-item">
                    <div class="hovereffect">
                      <img src="{{asset('frontend/images/post/advrtu-register.jpg')}}" class="img-fluid" />
                        <a href="{{asset('frontend/images/post/advrtu-register.jpg')}}">
                            <div class="overlay">
                                <div class="hovereffect-title">
                                </div>
                            </div>
                        </a>
                    </div>
                </figure>
            </li>
            <li class="col-lg-3 col-md-12 col-12 project single-portfolio Frankfinn" data-groups='["portrait"]'>
                <figure class="portfolio-item">
                    <div class="hovereffect">
                      <img src="{{asset('frontend/images/post/frankfinn-1.jpg')}}" class="img-fluid" />
                        <a href="{{asset('frontend/images/post/frankfinn-1.jpg')}}">
                            <div class="overlay">
                                <div class="hovereffect-title">
                                </div>
                            </div>
                        </a>
                    </div>
                </figure>
            </li>

            <li class="col-lg-3 col-md-12 col-12 project single-portfolio Frankfinn" data-groups='["portrait"]'>
                <figure class="portfolio-item">
                    <div class="hovereffect">
                      <img src="{{asset('frontend/images/post/frankfinn-2.jpg')}}" class="img-fluid" />
                        <a href="{{asset('frontend/images/post/frankfinn-2.jpg')}}">
                            <div class="overlay">
                                <div class="hovereffect-title">
                                </div>
                            </div>
                        </a>
                    </div>
                </figure>
            </li>
            <li class="col-lg-3 col-md-12 col-12 project single-portfolio Frankfinn" data-groups='["portrait"]'>
                <figure class="portfolio-item">
                    <div class="hovereffect">
                      <img src="{{asset('frontend/images/post/fly1.jpg')}}" class="img-fluid" />
                        <a href="{{asset('frontend/images/post/fly1.jpg')}}">
                            <div class="overlay">
                                <div class="hovereffect-title">
                                </div>
                            </div>
                        </a>
                    </div>
                </figure>
            </li>
            <li class="col-lg-3 col-md-12 col-12 project single-portfolio Frankfinn" data-groups='["portrait"]'>
                <figure class="portfolio-item">
                    <div class="hovereffect">
                      <img src="{{asset('frontend/images/post/flay2.jpg')}}" class="img-fluid" />
                        <a href="{{asset('frontend/images/post/flay2.jpg')}}">
                            <div class="overlay">
                                <div class="hovereffect-title">
                                </div>
                            </div>
                        </a>
                    </div>
                </figure>
            </li>

            <li class="col-lg-3 col-md-12 col-12 project single-portfolio Frankfinn" data-groups='["portrait"]'>
                <figure class="portfolio-item">
                    <div class="hovereffect">
                      <img src="{{asset('frontend/images/post/growing.jpg')}}" class="img-fluid" />
                        <a href="{{asset('frontend/images/post/growing.jpg')}}">
                            <div class="overlay">
                                <div class="hovereffect-title">
                                </div>
                            </div>
                        </a>
                    </div>
                </figure>
            </li>

            <li class="col-lg-3 col-md-12 col-12 project single-portfolio Cutest" data-groups='["portrait"]'>
                <figure class="portfolio-item">
                    <div class="hovereffect">
                      <img src="{{asset('frontend/images/post/summer-event-1.jpg')}}" class="img-fluid" />
                        <a href="{{asset('frontend/images/post/summer-event-1.jpg')}}">
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


<section class="spacetb135 relative">
  <div class="image-layer"><img src="{{asset('frontend/images/solutionimg1.jpg')}}" /></div>
   <div class="container">
    <div class="row">
        <div class="relative">
          <div class="item animated"><div class="one"></div><div class="rotate1deg"><div class="two"></div></div></div>
       </div>
     <div class="col-lg-6 col-md-12 col-12">
       <div class="section-head">
          <h2>Infrastructure</h2>
        </div><!--./section-head-->
     </div><!--./col-lg-6-->
    </div><!--./row-->
  </div><!--./container-->
</section> 



<div class="container">
  <div class="row"> 
    <div class="col-lg-12 col-md-12 col-12">
      <div class="ad-detail">
        <h6>Advrtu is a Digital Marketing startup deals with all types of Digital Marketing and Online Advertising solutions which include SEO, Website Development, Social Media Marketing, Content Marketing, Video making, Email Marketing, Bulk Sms, Whatsapp marketing etc</h6>
        <ul class="adlist">
          <li>Advrtu's main motto is to provide the low-cost Digital Marketing solutions to the startups,</li>
          <li>Advrtu's main motto is to provide the low-cost Digital Marketing solutions to the startups,</li>
          <li>Advrtu's main motto is to provide the low-cost Digital Marketing solutions to the startups,</li>
          <li>Advrtu's main motto is to provide the low-cost Digital Marketing solutions to the startups,</li>
        </ul>
      </div>  
    </div><!--./col-lg-6-->
  </div><!--./row-->
</div><!--./container-->

<section class="spacetb135">
  <div class="container">
    <div class="row">
      <div class="relative">
         <div class="item animated"><div class="one"></div><div class="rotate1deg"><div class="two"></div></div></div>
      </div>
      <div class="col-lg-9 col-md-12 col-12">
        <div class="section-head">
          <h2>Solutions</h2>
          <p>Rediscover yourself at Ensight</p>
        </div><!--./section-head-->
      </div><!--./col-lg-9-->
      <div class="col-md-12">
       <div class="relative intro" id="Home">
        <div class="intro-container">
          <div id="introCarousel" class="carousel slide carousel-fade" data-ride="carousel">
            <!-- <ol class="carousel-indicators"></ol> -->
            <div class="carousel-inner" role="listbox">
              <div class="carousel-item active">
              <div class="carousel-background"><img src="{{asset('frontend/images/slider1.jpg')}}" alt=""></div>
                <div class="carousel-container">
                  <div class="carousel-content">
                   <div class="main-banner-content text-center">
                      <h1>Marketing</h1>
                        <div class="btn-box"><a href="#" class="viewbtn mx-auto d-block">View More</a></div>
                    </div>
                  </div><!--./carousel-content-->
                </div>
              </div><!--./carousel-item-->

              <div class="carousel-item">
               <div class="carousel-background"><img src="{{asset('frontend/images/slider3.jpg')}}" alt=""></div>
                <div class="carousel-container">
                  <div class="carousel-content">
                    <div class="main-banner-content text-center">
                      <h1>Awareness</h1>
                      <div class="btn-box"><a href="#" class="viewbtn mx-auto d-block">View More</a></div>
                    </div>
                  </div><!--./carousel-content-->
                </div>
              </div><!--./carousel-item-->

              <div class="carousel-item">
               <div class="carousel-background"><img src="{{asset('frontend/images/slider2.jpg')}}" alt=""></div>
                <div class="carousel-container">
                  <div class="carousel-content">
                    <div class="main-banner-content text-center">
                      <h1>Engagement</h1>
                      <div class="btn-box"><a href="#" class="viewbtn mx-auto d-block">View More</a></div>
                    </div>
                  </div><!--./carousel-content-->
                </div>
              </div><!--./carousel-item-->

              <div class="carousel-item">
               <div class="carousel-background"><img src="{{asset('frontend/images/slider4.jpg')}}" alt=""></div>
                <div class="carousel-container">
                  <div class="carousel-content">
                    <div class="main-banner-content text-center">
                      <h1>Sales</h1>
                      <div class="btn-box"><a href="#" class="viewbtn mx-auto d-block">View More</a></div>
                    </div>
                  </div><!--./carousel-content-->
                </div>
              </div><!--./carousel-item-->

             <div class="carousel-item">
               <div class="carousel-background"><img src="{{asset('frontend/images/slider5.jpg')}}" alt=""></div>
                <div class="carousel-container">
                  <div class="carousel-content">
                    <div class="main-banner-content text-center">
                      <h1>Webmedia</h1>
                      <div class="btn-box"><a href="#" class="viewbtn mx-auto d-block">View More</a></div>
                    </div>
                  </div><!--./carousel-content-->
                </div>
              </div><!--./carousel-item-->
            </div><!--./carousel-inner-->

            <a class="carousel-control-prev" href="#introCarousel" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon fa fa-angle-left" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>

            <a class="carousel-control-next" href="#introCarousel" role="button" data-slide="next">
              <span class="carousel-control-next-icon fa fa-angle-right" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
     </div><!-- #intro -->
    </div> 
    </div><!--./row-->
  </div><!--./container-->
</section>

@endsection