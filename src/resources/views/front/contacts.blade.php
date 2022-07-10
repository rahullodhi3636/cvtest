@extends('layouts.frontmaster')
@section('content')
   <section class="videomain">   
   <img src="{{asset('frontend/images/contact-banner.jpg')}}" class="img-fluid">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="banner-inner">
            <div class="item">
              <div class="item animated"><div class="one"></div><div class="rotate1deg"><div class="two"></div></div></div>
            </div><!--./item-->
            <div class="section-head-white">
                <h2>Contact</h2>
                <p>Live your dream at <b>Advrtu!</b></p>
            </div><!--./section-head-->
           
          </div><!--./banner-inner-->
          <div class="slidearrow"><a href="#Welcome" class="page-scroll"><i class="fa fa-angle-down"></i></a></div> 
        </div><!--./col-lg-12-->
      </div><!--./row-->
    </div><!--./container-->
  </section> 

<section class="spacetb135 relative" id="Welcome">
  <div class="contact-rightmain"></div>
  <div class="container">
    <div class="row">
      <div class="relative">
        <div class="item animated"><div class="one"></div><div class="rotate1deg"><div class="two"></div></div></div>
     </div> 
     <div class="col-lg-6 col-md-12 col-12">

       <div class="section-head">
          <h2>Provide Your Details</h2>
          <p>On filling up the form below, one of the Monks will get in touch with you within 24-48 hours to help you with pricing and requirements.</p>
        </div><!--./section-head-->
        <form class="contactform row">
          <div class="col-lg-6 col-md-12 col-sm-12">
             <div class="form-group">
                <input type="text" class="form-control" placeholder="Name:">
              </div>
          </div><!--./col-lg-6--> 
          <div class="col-lg-6 col-md-12 col-sm-12">
             <div class="form-group">
                <input type="text" class="form-control" placeholder="Email:">
              </div>
          </div><!--./col-lg-6-->
          <div class="col-lg-6 col-md-12 col-sm-12">
             <div class="form-group">
                <input type="text" class="form-control" placeholder="Phone:">
              </div>
          </div><!--./col-lg-6--> 
          <div class="col-lg-6 col-md-12 col-sm-12">
             <div class="form-group">
                <input type="text" class="form-control" placeholder="Subject:">
              </div>
          </div><!--./col-lg-6--> 
          <div class="col-lg-12 col-md-12 col-sm-12">
             <div class="form-group">
                <textarea class="form-control" rows="10" placeholder="Question:"></textarea>
              </div>
          </div><!--./col-lg-12--> 
          <div class="col-lg-12 col-md-12 col-sm-12"> 
            <div class="form-group"><button type="submit" class="viewbtn">Register</button></div> 
          </div><!--./col-lg-12-->  
        </form>
     </div><!--./col-lg-6-->

     <div class="col-lg-5 col-md-12 col-12 offset-lg-1">
       <div class="contact-right">
         <h4>Get in touch with us at</h4>
          <div class="contact-info">
            <ul>
              <li><i class="fa fa-envelope-o"></i><a href="#">infoadvrtu@gmail.com</a></li>
              <li><i class="fa fa-phone"></i><a href="#">8463039093</a></li>
              <li><i class="fa fa-fax"></i><a href="#">8463039093</a></li>
            </ul>
          </div>
          <div class="divider"></div>
          <h4 style="padding-bottom: 0">Advrtu-Your Digital Pitch</h4>
           <div class="contact-info">
            <p>Samdarreya mall, 3rd floor, madhotal, Jabalpur, 482002</p>
          </div>
          <div class="divider"></div>
          <h4 style="padding-bottom: 0">Follow Us</h4>
           <ul class="contact-social">
            <li><a href="https://www.facebook.com/advrtu/" target="_blank"><i class="fa fa-facebook"></i></a></li>
            <li><a href="https://twitter.com/advrtu" target="_blank"><i class="fa fa-twitter"></i></a></li>
            <li><a href="https://www.instagram.com/advrtu/" target="_blank"><i class="fa fa-instagram"></i></a></li> 
            <li><a href="https://plus.google.com/u/0/112079541" target="_blank"><i class="fa fa-google-plus"></i></a></li>
            <li><a href="https://in.pinterest.com/advrtu/" target="_blank"><i class="fa fa-linkedin"></i></a></li>
          </ul>

       </div><!--./contact-right-->
     </div><!--./col-lg-6-->

    </div><!--./row-->
  </div><!--./container-->
</section> 

    
<section class="spacetb135 contactbg" style="padding-bottom: 58px">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3>Let’s Build A Strong & Growing Partnership</h3>
        <div class="newsletter">
          <div class="newsletterinput">
            <input type="text" placeholder="Enter Your email">

          </div><!--./newsletterinput-->
          <a href="" class="sendbtn">Subscribe</a>
        </div><!-- ./newsletter -->
      </div><!--./col-md-12-->
    </div><!--./row-->
  </div><!--./container-->    
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3668.2359706765565!2d79.93251991542483!3d23.161586216929244!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m3!3e6!4m0!4m0!5e0!3m2!1sen!2sin!4v1564043490612!5m2!1sen!2sin" width="100%" height="550" frameborder="0" style="border:0;display: block;" allowfullscreen></iframe>
</section> 
@endsection