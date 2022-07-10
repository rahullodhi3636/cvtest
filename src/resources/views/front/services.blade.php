@extends('layouts.frontmaster')
@section('content')
 <section class="videomain">   
   <img src="{{asset('frontend/images/slider2.jpg')}}" class="img-fluid">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="banner-inner">
            <div class="item">
              <div class="item animated"><div class="one"></div><div class="rotate1deg"><div class="two"></div></div></div>
            </div><!--./item-->
            <h1 class="mt-5">Our Services</h1>
          </div><!--./banner-inner-->
         <div class="slidearrow"><a href="#Welcome" class="page-scroll"><i class="fa fa-angle-down"></i></a></div>  
        </div><!--./col-lg-12-->
      </div><!--./row-->
    </div><!--./container-->
  </section> 

  <section class="spacetb135" id="Welcome">
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

 <section class="spacetb135">
  
  <div class="container">
    <div class="row">
     <div class="col-lg-6 col-md-12 col-12">
       <img src="{{asset('frontend/images/seo-digital-marketing.png')}}" class="img-fluid mb-2" />
     </div><!--./col-lg-6--> 
     <div class="col-lg-6 col-md-12 col-12">
      <div class="relative">
        <div class="item animated"><div class="one"></div><div class="rotate1deg"><div class="two"></div></div></div>
      
      
        <div class="section-head">
          <h2>Digital Marketing Services.</h2>
          <!-- <p>Rediscover yourself at Ensight</p> -->
        </div><!--./section-head-->
      </div><!--./relative-->
      <div class="section-head">
          <p>Digital marketing is the marketing of products or services using digital technologies, mainly on the Internet, but also including mobile phones, display advertising, and any other digital medium</p>
        </div>
     </div><!-- ./col-md-6-->  
    </div><!--./row-->
  </div><!--./container-->
</section> 

 <section class="spacetb135">
  <div class="container">
    <div class="row">
     <div class="col-lg-6 col-md-12 col-12">
      <div class="relative">
        <div class="item animated"><div class="one"></div><div class="rotate1deg"><div class="two"></div></div></div>
      
      
        <div class="section-head">
          <h2>Outdoor Advertising.</h2>
          <!-- <p>Rediscover yourself at Ensight</p> -->
        </div><!--./section-head-->
      </div><!--./relative-->
      <div class="section-head">
          <p>Any advertising done outdoors that publicizes your business's products and services. Types of outdoor advertising include billboards, bus benches, interiors and exteriors of buses, taxis and business vehicles, and signage posted on the exterior of your own brick-and-mortar location.</p>
        </div>
     </div><!-- ./col-md-6--> 
       <div class="col-lg-6 col-md-12 col-12">
       <img src="{{asset('frontend/images/seo-digital-marketing.png')}}" class="img-fluid mb-2" />
     </div><!--./col-lg-6-->  
    </div><!--./row-->
  </div><!--./container-->
</section> 

 <section class="spacetb135">
  <div class="container">
    <div class="row">
     <div class="col-lg-6 col-md-12 col-12">
       <img src="{{asset('frontend/images/seo-digital-marketing.png')}}" class="img-fluid mb-2" />
     </div><!--./col-lg-6--> 
     <div class="col-lg-6 col-md-12 col-12">
      <div class="relative">
        <div class="item animated"><div class="one"></div><div class="rotate1deg"><div class="two"></div></div></div>
      
      
        <div class="section-head">
          <h2>Video Ad Film Making.</h2>
          <!-- <p>Rediscover yourself at Ensight</p> -->
        </div><!--./section-head-->
      </div><!--./relative-->
      <div class="section-head">
          <p>Ad film (aka commercial, television commercial etc.). These are a type of television programmes produced and paid for by an organization, typically to convey a message, market a product or service. Advertisers and marketers often refer to television commercials as TVCs. Establish your brand value by getting an advertisement video. Gets the desired script in the video involving a combination of graphics, stop motion shots, proper concept and all other inputs required. If an apt advertisement video solves the purpose and falls into the minimalist production cost, then nothing like that.</p>
        </div>
     </div><!-- ./col-md-6-->  
    </div><!--./row-->
  </div><!--./container-->
</section> 

 <section class="spacetb135">
  <div class="container">
    <div class="row">
     <div class="col-lg-6 col-md-12 col-12">
      <div class="relative">
        <div class="item animated"><div class="one"></div><div class="rotate1deg"><div class="two"></div></div></div>
      
      
        <div class="section-head">
          <h2>UFO Advertising.</h2>
          <!-- <p>Rediscover yourself at Ensight</p> -->
        </div><!--./section-head-->
      </div><!--./relative-->
      <div class="section-head">
          <p>UFO delivers advertising solutions for national, regional and local marketing needs to its advertisers. UFO provides targeted and affordable branding. Cinema advertising is a medium offering advertisers the opportunity to reach their target consumers in a captive, distraction-free environment.</p>
        </div>
     </div><!-- ./col-md-6--> 
       <div class="col-lg-6 col-md-12 col-12">
       <img src="{{asset('frontend/images/seo-digital-marketing.png')}}" class="img-fluid mb-2" />
     </div><!--./col-lg-6-->  
    </div><!--./row-->
  </div><!--./container-->
</section> 

<section class="spacetb135">
  <div class="container">
    <div class="row">
     <div class="col-lg-6 col-md-12 col-12">
       <img src="{{asset('frontend/images/seo-digital-marketing.png')}}" class="img-fluid mb-2" />
     </div><!--./col-lg-6--> 
     <div class="col-lg-6 col-md-12 col-12">
      <div class="relative">
        <div class="item animated"><div class="one"></div><div class="rotate1deg"><div class="two"></div></div></div>
      
      
        <div class="section-head">
          <h2>Turnkey Marketing Projects.</h2>
          <!-- <p>Rediscover yourself at Ensight</p> -->
        </div><!--./section-head-->
      </div><!--./relative-->
      <div class="section-head">
          <p>A type of solution that is easily or readily deployed into a current business, system or process by a third-party, which is able to be used immediately once installed or implemented. For example, a website, training program or billing system.</p>
        </div>
     </div><!-- ./col-md-6-->  
    </div><!--./row-->
  </div><!--./container-->
</section> 

 <section class="spacetb135">
  <div class="container">
    <div class="row">
     <div class="col-lg-6 col-md-12 col-12">
      <div class="relative">
        <div class="item animated"><div class="one"></div><div class="rotate1deg"><div class="two"></div></div></div>
      
      
        <div class="section-head">
          <h2>Short Film Making etc.</h2>
          <!-- <p>Rediscover yourself at Ensight</p> -->
        </div><!--./section-head-->
      </div><!--./relative-->
      <div class="section-head">
          <p>A short film is any motion picture not long enough to be considered a feature film. The Academy of Motion Picture Arts and Sciences defines a short film as "an original motion picture that has a running time of 40 minutes or less, including all credits".</p>
        </div>
     </div><!-- ./col-md-6--> 
       <div class="col-lg-6 col-md-12 col-12">
       <img src="{{asset('frontend/images/seo-digital-marketing.png')}}" class="img-fluid mb-2" />
     </div><!--./col-lg-6-->  
    </div><!--./row-->
  </div><!--./container-->
</section> 


<section class="spacetb135">
  <div class="container">
    <div class="row">
     <div class="col-lg-6 col-md-12 col-12">
       <img src="{{asset('frontend/images/seo-digital-marketing.png')}}" class="img-fluid mb-2" />
     </div><!--./col-lg-6--> 
     <div class="col-lg-6 col-md-12 col-12">
      <div class="relative">
        <div class="item animated"><div class="one"></div><div class="rotate1deg"><div class="two"></div></div></div>
      
      
        <div class="section-head">
          <h2>Jingle Creation.</h2>
          <!-- <p>Rediscover yourself at Ensight</p> -->
        </div><!--./section-head-->
      </div><!--./relative-->
      <div class="section-head">
          <p>A jingle is a short song or tune used in advertising and for other commercial uses. Jingles are a form of sound branding. A jingle contains one or more hooks and meaning that explicitly promote the product or service being advertised, usually through the use of one or more advertising slogans. Ad buyers’ use jingles in radio and television commercials; they can also be used in non-advertising contexts to establish or maintain a brand image. Many jingles are also created using snippets of popular songs, in which lyrics are modified to appropriately advertise the product or service.</p>
        </div>
     </div><!-- ./col-md-6-->  
    </div><!--./row-->
  </div><!--./container-->
</section> 

 <section class="spacetb135">
  <div class="container">
    <div class="row">
     <div class="col-lg-6 col-md-12 col-12">
      <div class="relative">
        <div class="item animated"><div class="one"></div><div class="rotate1deg"><div class="two"></div></div></div>
      
      
        <div class="section-head">
          <h2>Radio Advertising.</h2>
          <!-- <p>Rediscover yourself at Ensight</p> -->
        </div><!--./section-head-->
      </div><!--./relative-->
      <div class="section-head">
          <p>In the United States, commercial radio stations make most of their revenue by selling airtime to be used for running radio advertisements. These advertisements are the result of a business or a service providing a valuable consideration, usually money, in exchange for the station airing their commercial or mentioning them on air. The most common advertisements are "spot commercials", which normally last for no more than one minute, and longer programs, commonly running up to one hour, known as "infomercials".</p>
        </div>
     </div><!-- ./col-md-6--> 
       <div class="col-lg-6 col-md-12 col-12">
       <img src="{{asset('frontend/images/seo-digital-marketing.png')}}" class="img-fluid mb-2" />
     </div><!--./col-lg-6-->  
    </div><!--./row-->
  </div><!--./container-->
</section> 

<section class="spacetb135">
  <div class="container">
    <div class="row">
     <div class="col-lg-6 col-md-12 col-12">
       <img src="{{asset('frontend/images/seo-digital-marketing.png')}}" class="img-fluid mb-2" />
     </div><!--./col-lg-6--> 
     <div class="col-lg-6 col-md-12 col-12">
      <div class="relative">
        <div class="item animated"><div class="one"></div><div class="rotate1deg"><div class="two"></div></div></div>
      
      
        <div class="section-head">
          <h2>Newspaper Advertising.</h2>
          <!-- <p>Rediscover yourself at Ensight</p> -->
        </div><!--./section-head-->
      </div><!--./relative-->
      <div class="section-head">
          <p>Newspaper advertising has been around longer than any other form of advertising we see today and is still the first kind of advertising that businesses think about doing. These ads can do a lot more than just advertise one item or one sale--each one can work really hard to bring in customers, and then bring them back again and again. They're a good way to reach a large number of people, especially those aged 45-plus who tend to read the paper more frequently than younger demographic groups who tend to get their news from television, radio or the internet.</p>
        </div>
     </div><!-- ./col-md-6-->  
    </div><!--./row-->
  </div><!--./container-->
</section> 

 <section class="spacetb135">
  <div class="container">
    <div class="row">
     <div class="col-lg-6 col-md-12 col-12">
      <div class="relative">
        <div class="item animated"><div class="one"></div><div class="rotate1deg"><div class="two"></div></div></div>
      
      
        <div class="section-head">
          <h2>Celebrity Endorsements.</h2>
          <!-- <p>Rediscover yourself at Ensight</p> -->
        </div><!--./section-head-->
      </div><!--./relative-->
      <div class="section-head">
          <p>Celebrity branding or celebrity endorsement is a form of advertising campaign or marketing strategy used by brands, companies, or a non-profit organization which involves celebrities or a well-known person using their social status or their fame to help promote a product, service or even raise awareness on environmental or social matters</p>
        </div>
     </div><!-- ./col-md-6--> 
       <div class="col-lg-6 col-md-12 col-12">
       <img src="{{asset('frontend/images/seo-digital-marketing.png')}}" class="img-fluid mb-2" />
     </div><!--./col-lg-6-->  
    </div><!--./row-->
  </div><!--./container-->
</section> 


<section class="spacetb135">
  <div class="container">
    <div class="row">
     <div class="col-lg-6 col-md-12 col-12">
       <img src="{{asset('frontend/images/seo-digital-marketing.png')}}" class="img-fluid mb-2" />
     </div><!--./col-lg-6--> 
     <div class="col-lg-6 col-md-12 col-12">
      <div class="relative">
        <div class="item animated"><div class="one"></div><div class="rotate1deg"><div class="two"></div></div></div>
      
      
        <div class="section-head">
          <h2>Event Management</h2>
          <!-- <p>Rediscover yourself at Ensight</p> -->
        </div><!--./section-head-->
      </div><!--./relative-->
      <div class="section-head">
          <p>Event management is the application of project management to the creation and development of large-scale events such as festivals, conferences, ceremonies, weddings, formal parties, concerts, or conventions. It involves studying the brand, identifying its target audience, devising the event concept, and coordinating the technical aspects before actually launching the event.</p>
        </div>
     </div><!-- ./col-md-6-->  
    </div><!--./row-->
  </div><!--./container-->
</section> 

@endsection