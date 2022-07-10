<!DOCTYPE html>
<html lang="en" class="js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="shortcut icon" href="images/fevicon-icon.png" type="image/x-icon">
    <link href="{{asset('backend/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('backend/css/mdb.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('backend/css/materialdesignicons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('backend/css/additional.csss')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('backend/css/animation-scroll.css')}}" type="text/css">
    <link href="{{asset('backend/css/keyframe.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('backend/css/style.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('backend/css/fontello.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('backend/css/media.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('backend/css/bootstrap-select.css')}}" rel="stylesheet" type="text/css">
     <link rel="stylesheet" href="{{asset('backend/css/flaticon.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i|Supermercado+One" rel="stylesheet">
    <link rel="stylesheet" id="nd_options_font_family_h-css" href="http://fonts.googleapis.com/css?family=Open+Sans%3A300%2C400%2C700&amp;ver=4.9.4" type="text/css" media="all">
    <link href="https://fonts.googleapis.com/css?family=Cabin&amp;display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{asset('backend/datatable/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/datatable/dataTables.bootstrap4.min.css')}}">

    @yield('stylesheets')
</head>
<body>
<main>
    <!-- <div class="main-preloader active" id="mainloader">
        <div class="fl spinner6">
            <div class="rect1"></div>
            <div class="rect2"></div>
            <div class="rect3"></div>
            <div class="rect4"></div>
            <div class="rect5"></div>
        </div>
    </div> -->
     @if(Request::segment(1) == "search_profile")
     @include('layouts.adminpartials.profile-header')
     @else
     @include('layouts.adminpartials.header')
     @endif
     <section class="dashboard-section">
        @include('layouts.adminpartials.sidebar')
        @yield('content')
     </section>
</main>
<script type="text/javascript" src="{{asset('backend/js/jquery-3.4.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/mdb.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/util.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/main.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/master.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/animate-scroll.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/bootstrap-select.js')}}"></script>

<script type="text/javascript" language="javascript" src="{{ asset('backend/datatable/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" language="javascript" src="{{ asset('backend/datatable/dataTables.bootstrap4.min.js')}}"></script>

@yield('script')
<script type="text/javascript">
   
    window.onload = function (e) {
        setTimeout(function () {
            //$('#loader-overlay').addClass('scale0');
            $('#mainloader').hide();
        }, 2000);
    }
    window.onscroll = function () {
        //scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 180 || document.documentElement.scrollTop > 20) {
            $('#top_navigation_bar').addClass('logowithmenu_bar_fixed');
        } else {
            $('#top_navigation_bar').removeClass('logowithmenu_bar_fixed');
        }
    }

    $(document).click(function (e) {
        $('#login-user-popup').removeClass('show');
        $('#support-user-popup').removeClass('show');
        //$('#view-setting-page').removeClass('show');
        //$('#advance-search-page').removeClass('show');
    })
    $(document).ready(function () {
        $('.support-block').click(function (e) {
            $('#login-user-popup').removeClass('show');
            let chkclass = $('#support-user-popup').attr('class');
            if (chkclass == 'dropdown-menu pullDown user-seting-popup') {
                $('#support-user-popup').addClass('show');
            } else {
                $('#support-user-popup').removeClass('show');
            }
            e.stopPropagation();
        });
        $('.user-login-block').click(function (e) {
            $('#support-user-popup').removeClass('show');
            let chkclass = $('#login-user-popup').attr('class');
            if (chkclass == 'dropdown-menu pullDown user-seting-popup') {
                $('#login-user-popup').addClass('show');
            } else {
                $('#login-user-popup').removeClass('show');
            }
            e.stopPropagation();
        });
    });

    $(document).ready(function() {
                    $('.dtBasicExample').DataTable();
    });

    $(function () {
        $('.material-tooltip-main').tooltip({
            template: '<div class="tooltip md-tooltip-main"> <div class = "tooltip-arrow md-arrow" > < /div> <div class = "tooltip-inner md-inner-main" > < /div> </div>'
        });
    })
</script>
</body>
</html>