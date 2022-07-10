<!DOCTYPE html>
<html class="no-js" lang="en-US">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge"> 
    <title>Advrtu Yout Digital Pitch ffc107</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{asset('frontend/images/favicon.png')}}"/>
    <link rel="stylesheet" href="{{asset('frontend/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}"> 
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}"> 
    <link rel="stylesheet" href="{{asset('frontend/css/owl.carousel.min.css')}}">
   
    <link href="{{asset('frontend/css/magnific-popup.css')}}" rel="stylesheet"> 
    @yield('stylesheets')
</head>
<body>
<div class="hamburger js-fh5co-nav-toggle fh5co-nav-toggle">  
  <a class="navbar-brand logo" href="index.html"><img src="{{asset('frontend/images/logo.png')}}" /></a>
  <a href="#" class="hamburger-icon"><i></i></a>
</div>  
 @include('layouts.frontpartials.header')
<main class="main">
 @yield('content')
<footer>
  <p>Copyright © 2019 Advrtu your digital pitch. All Rights Reserved</p>
  <a class="back-to-top" href="#"><i class="fa fa-angle-double-up"></i></a>
</footer>
</main>
 <script src="{{asset('frontend/js/jquery.min.js')}}"></script>
  <script src="{{asset('frontend/js/popper.min.js')}}"></script>
  <script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('frontend/js/owl.carousel.min.js')}}"></script>
  <script src="{{asset('frontend/js/easing.min.js')}}"></script>

  <!-- <script src="{{asset('frontend/js/jquery.fancybox.min.js')}}"></script> -->
  <script type="text/javascript" src="{{asset('frontend/js/main.js')}}"></script>
  <script type="text/javascript">
     $(document).ready(function(){
       $(".hamburger").click(function(){
         $(".sidebar").toggle();
        });

      });

  </script>


<!-- portfolio script -->
<script src="{{asset('frontend/js/jquery.shuffle.min.js')}}"></script>
<script src="{{asset('frontend/js/custom.js')}}"></script>
<!-- / portfolio script -->

<!-- lightbox -->
<script src="{{asset('frontend/js/jquery.magnific-popup.min.js')}}"></script>
<script type="text/javascript">
@yield('script')
$('.gallery').each(function() { 
    $(this).magnificPopup({
        delegate: 'a',
        type: 'image',
        gallery: {
          enabled:true
        }
    });
});
</script>
<!-- / lightbox -->
<script type="text/javascript" src="{{asset('frontend/js/particles.min.js')}}"></script>
</body>
</html>