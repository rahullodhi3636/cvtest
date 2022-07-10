@extends('layouts.frontmaster')
@section('content')
  <section class="videomain">   
    <video autoplay="" muted="" loop="" class="myVideo">
      <source src="{{asset('frontend/images/slide-video3.mp4')}}" type="video/mp4">
    </video>

    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="banner-inner">
            <div class="item">
              <div class="item animated"><div class="one"></div><div class="rotate1deg"><div class="two"></div></div></div>
            </div><!--./item-->
            <h1>High-performance, Growth-oriented Company Driven by PEOPLE, Loved Worldwide!</h1>
          </div><!--./banner-inner-->
           <div class="slidearrow"><a href="#Welcome" class="page-scroll"><i class="fa fa-angle-down"></i></a></div>
        </div><!--./col-lg-12-->
      </div><!--./row-->
    </div><!--./container-->
   
  </section> 
<section class="ad-detail spacetb135" id="Welcome">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h3>Welcome to ADVTTU Your Digital Pitch</h3>
        <p>Advrtu is a Digital Marketing startup deals with all types of Digital Marketing and Online Advertising solutions which include SEO, Website Development, Social Media Marketing, Content Marketing, Video making, Email Marketing, Bulk Sms, Whatsapp marketing etc</p>
        <p>Advrtu's main motto is to provide the low-cost Digital Marketing solutions to the startups, young entrepreneurs as well as existing corporates.</p>
        <p>Advrtu-Your Digital Pitch</p>
      </div><!--./col-lg-12-->
    </div><!--./row-->
  </div><!--./container-->
</section>

<section class="spacetb135">
  <div class="container">
    <div class="row">
      <div class="relative">
      <div class="item animated"><div class="one"></div><div class="rotate1deg"><div class="two"></div></div></div>
     </div> 
      <div class="col-lg-9 col-md-12 col-12">
        <div class="section-head">
          <h2>Clients we serve</h2>
          <p>Our Partners in Success</p>
        </div><!--./section-head-->
      </div><!--./col-lg-9-->
      <div class="col-lg-3 col-md-12 col-12 ">
       <a href="clients.html" class="viewbtn btnMDright">View More</a> 
     </div><!--./col-lg-3-->
     <div class="col-lg-12 col-md-12 col-12"><img src="{{asset('frontend/images/partnership.png')}}" class="img-fluid mt-2" /></div>
      <div class="col-lg-12">  
      <div class="partner-slides  owl-carousel owl-theme">
        <div class="col-lg-12">
          <a href="#"><img src="{{asset('frontend/images/clientlogo/agrawal-computer.png')}}"></a>
          <a href="#"><img src="{{asset('frontend/images/clientlogo/coffee-culture.png')}}"></a>
          <a href="#"><img src="{{asset('frontend/images/clientlogo/dental-house.png')}}"></a>
        </div>

        <div class="col-lg-12">
          <a href="#"><img src="{{asset('frontend/images/clientlogo/frankfin.png')}}"></a>
          <a href="#"><img src="{{asset('frontend/images/clientlogo/vrindavan.png')}}"></a>
          <a href="#"><img src="{{asset('frontend/images/clientlogo/lant-computer.png')}}"></a>
        </div>

        <div class="col-lg-12">
          <a href="#"><img src="{{asset('frontend/images/clientlogo/imran.png')}}"></a>
          <a href="#"><img src="{{asset('frontend/images/clientlogo/infinity-heart.png')}}"></a>
          <a href="#"><img src="{{asset('frontend/images/clientlogo/jabalpur-ins-computer.png')}}"></a>
        </div>

        <div class="col-lg-12">
          <a href="#"><img src="{{asset('frontend/images/clientlogo/lucents.png')}}"></a>
          <a href="#"><img src="{{asset('frontend/images/clientlogo/asis-spa.png')}}"></a>
          <a href="#"><img src="{{asset('frontend/images/clientlogo/omezyo.png')}}"></a>
        </div>

         <div class="col-lg-12">
          <a href="#"><img src="{{asset('frontend/images/clientlogo/paramount.png')}}"></a>
          <a href="#"><img src="{{asset('frontend/images/clientlogo/profit-pandit.png')}}"></a>
          <a href="#"><img src="{{asset('frontend/images/clientlogo/raghukul.png')}}"></a>
        </div>

         <div class="col-lg-12">
          <a href="#"><img src="{{asset('frontend/images/clientlogo/rebanta-academy.png')}}"></a>
          <a href="#"><img src="{{asset('frontend/images/clientlogo/sam-group.png')}}"></a>
          <a href="#"><img src="{{asset('frontend/images/clientlogo/samdareeya-abhushan.png')}}"></a>
        </div>

         <div class="col-lg-12">
          <a href="#"><img src="{{asset('frontend/images/clientlogo/samdriya-school.png')}}"></a>
          <a href="#"><img src="{{asset('frontend/images/clientlogo/shriya-electricals.png')}}"></a>
          <a href="#"><img src="{{asset('frontend/images/clientlogo/skd2d.png')}}"></a>
        </div>

         <div class="col-lg-12">
          <a href="#"><img src="{{asset('frontend/images/clientlogo/solar.png')}}"></a>
          <a href="#"><img src="{{asset('frontend/images/clientlogo/sparadise.png')}}"></a>
          <a href="#"><img src="{{asset('frontend/images/clientlogo/the-globaliser.png')}}"></a>
        </div>

         <div class="col-lg-12">
          <a href="#"><img src="{{asset('frontend/images/clientlogo/vardhman.png')}}"></a>
          <a href="#"><img src="{{asset('frontend/images/clientlogo/vijyashree.png')}}"></a>
          <a href="#"><img src="{{asset('frontend/images/clientlogo/wiskers-paws.png')}}"></a>
        </div>

      </div><!--./partner-slides -->             
     </div><!--./col-lg-12-->
    </div><!--./row-->
  </div><!--./container-->
</section>

<section class="spacetb135">
  <div class="container">
    <div class="row">
      <div class="relative">
        <div class="item animated"><div class="one"></div><div class="rotate1deg"><div class="two"></div></div></div>
     </div> 
      <div class="col-lg-4 col-md-12 col-12">
        <div class="section-head">
          <h2>What we do</h2>
          <p>We DO what we are BEST at, and DON’T do everything under the Sun</p>
          <a href="services.html" class="viewbtn">View More</a> 
        </div><!--./section-head-->
      </div><!--./col-lg-9-->
      <div class="col-lg-4 col-md-12 col-12">
        <div class="digital-one">
          <h4>Digital Marketing</h4>
          <ul class="services-list">
              <li><a href="#">Campaign Conceptualization</a></li>
              <li><a href="#">Digital &amp; Social Content</a></li>
              <li><a href="#">Digital Video Production</a></li>
              <li><a href="#">Mobile Marketing</a></li>
              <li><a href="#">Digital Media Planning &amp; Buying</a></li>
            </ul>
        </div> 
     </div><!--./col-lg-4-->
     <div class="col-lg-4 col-md-12 col-12">
       <div class="digital-two">
          <h4>Ad design</h4>
          <ul class="services-list">
              <li><a href="#">Campaign Conceptualization</a></li>
              <li><a href="#">Digital &amp; Social Content</a></li>
              <li><a href="#">Digital Video Production</a></li>
              <li><a href="#">Mobile Marketing</a></li>
              <li><a href="#">Digital Media Planning &amp; Buying</a></li>
            </ul>
        </div>
     </div><!--./col-lg-4-->
    </div><!--./row-->
  </div><!--./container-->
</section>

<section class="spacetb135 bggray">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-12">
        <div class="section-head">
          <h2>Outdoor Media</h2>
          <p>Our solution centric ventures are focussed to solve at least one industry problems better than anyone else. 
  Our impeccable list of clientele says it all.</p>
        </div><!--./section-head-->
      </div><!--./col-lg-12-->
     
      <div class="col-lg-3 col-md-12 col-12">
        <div class="mediaout">
          <a href="mailbranding.html">
            <img src="{{asset('frontend/images/mall-branding.png')}}" class="mx-auto d-block">
            <h3>Mall Branding</h3>
          </a>  
        </div>
      </div><!--./col-lg-6-->
       
    </div><!--./row-->
  </div><!--./container-->
</section>




<section class="spacetb135">
  <div class="container">
    <div class="row">
      <div class="relative">
        <div class="item animated"><div class="one"></div><div class="rotate1deg"><div class="two"></div></div></div>
      </div><!--./relative-->
      <div class="col-lg-12 col-md-12 col-12">
        <div class="section-head">
          <h2>Turnkey Marketing Projects.</h2>
          <p>Rediscover yourself at Ensight</p>
        </div><!--./section-head-->
      </div><!--./col-lg-12-->
     <div class="col-lg-6 col-md-12 col-12">
       <img src="{{asset('frontend/images/main-banner1.jpg')}}" class="img-fluid mb-2" />
     </div><!--./col-lg-6--> 
     <div class="col-lg-6 col-md-12 col-12">
      <div class="section-head">
          <!-- <h2>Events Promotion</h2> -->
          <p>A type of solution that is easily or readily deployed into a current business, system or process by a third-party, which is able to be used immediately once installed or implemented. For example, a website, training program or billing system.</p>
        </div>
      
     </div><!-- ./col-md-6-->  
    </div><!--./row-->
  </div><!--./container-->
</section> 

<section class="spacetb135 bggray">
  <div class="container">
    <div class="row">
      <div class="relative">
        <div class="item animated"><div class="one"></div><div class="rotate1deg"><div class="two"></div></div></div>
      </div><!--./relative-->
      <div class="col-lg-12 col-md-12 col-12">
        <div class="section-head">
          <h2>Videos</h2>
          <!-- <p>Rediscover yourself at Ensight</p> -->
        </div><!--./section-head-->
      </div><!--./col-lg-12-->
     <div class="col-lg-4 col-md-12 col-12 videogallery">
        <iframe width="100%" height="300" src="https://www.youtube.com/embed/DWJLoXT6vGo" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
     </div><!--./col-lg-4--> 
     <div class="col-lg-4 col-md-12 col-12 videogallery">
        <iframe width="100%" height="300" src="https://www.youtube.com/embed/eyqCtTgtx44" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
     </div><!--./col-lg-4-->
     <div class="col-lg-4 col-md-12 col-12 videogallery">
        <iframe width="100%" height="300" src="https://www.youtube.com/embed/iUvj2BAjIuM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
     </div><!--./col-lg-4-->

     <div class="col-lg-4 col-md-12 col-12 videogallery">
        <iframe width="100%" height="300" src="https://www.youtube.com/embed/SmZPyTcKL_c" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
     </div><!--./col-lg-4-->

     <div class="col-lg-4 col-md-12 col-12 videogallery">
        <iframe width="100%" height="300" src="https://www.youtube.com/embed/QZc_9QhDXjg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
     </div><!--./col-lg-4-->

     <div class="col-lg-4 col-md-12 col-12 videogallery">
        <iframe width="100%" height="300" src="https://www.youtube.com/embed/q49vJSH1cmk" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
     </div><!--./col-lg-4-->

     <div class="col-lg-4 col-md-12 col-12 videogallery">
        <iframe width="100%" height="300" src="https://www.youtube.com/embed/FspjalH_Bfc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
     </div><!--./col-lg-4-->

     <div class="col-lg-4 col-md-12 col-12 videogallery">
        <iframe width="100%" height="300" src="https://www.youtube.com/embed/gr0idlGg4bo" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
     </div><!--./col-lg-4-->

     <div class="col-lg-4 col-md-12 col-12 videogallery">
        <iframe width="100%" height="300" src="https://www.youtube.com/embed/q68zcTqgY0s" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
     </div><!--./col-lg-4-->
       
    </div><!--./row-->
  </div><!--./container-->
</section>

<section class="spacetb135 careers">
  <div class="container">
    <div class="row">
      <div class="relative">
        <div class="item animated"><div class="one"></div><div class="rotate1deg"><div class="two"></div></div></div>
      </div><!--./relative-->
      <div class="col-lg-7 col-md-12 col-12">
        <div class="rewards">
          <h2>Career Opportunities</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam earum, provident ad, porro aperiam dolore, blanditiis, nihil pariatur eius adipisci consequuntur officiis. Excepturi, nostrum? Id incidunt nesciunt officia hic distinctio nihil pariatur.</p>
          <a href="careers.html" class="viewbtn">View More</a>
        </div><!--./section-head-->
      </div><!--./col-lg-8-->
      <div class="col-lg-4 col-md-12 col-12">
        
            <img src="{{asset('frontend/images/careers.jpg')}}" class="img-fluid" />
      </div><!--./col-lg-4-->
        
         
       
      
    </div><!--./row-->
  </div><!--./container-->    
</section> 
@endsection