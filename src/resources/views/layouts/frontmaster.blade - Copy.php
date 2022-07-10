<!DOCTYPE html>
<html lang="en" class="js">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{asset('frontend/images/favicon.png')}}" type="image/x-icon"/>
    <link href="{{asset('frontend/css/bootstrap.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('frontend/css/mdb.min.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{asset('frontend/css/materialdesignicons.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('frontend/css/additional.css')}}" type="text/css"/>
    <!--    <link rel="stylesheet" href="css/menu.css">-->
    <link href="{{asset('frontend/css/style.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('frontend/css/animation-scroll.css')}}" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link rel='stylesheet' id='nd_options_font_family_h-css' href='http://fonts.googleapis.com/css?family=Open+Sans%3A300%2C400%2C700&#038;ver=4.9.4' type='text/css' media='all'/>
    <link href="https://fonts.googleapis.com/css?family=Cabin&display=swap" rel="stylesheet"/>

    <link rel="stylesheet" href="{{asset('frontend/calendar/css/jquery.ui.all.css')}}">
    @yield('stylesheets')
</head>
<body>
<main>
    <div class="upper_loader preloader" id="loader-overlay">
        <div class="spinner">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
    </div>
    @include('layouts.frontpartials.header')
    @yield('content')

</main>

<!-- <div class="modal fade" id="registration" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style=""
     aria-modal="true">
    <div class="modal-dialog cascading-modal" role="document">
        <div class="modal-content">
            <div class="modal-c-tabs">
                <ul class="nav nav-tabs md-tabs tabs-2 light-blue darken-3" role="tablist">
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link active" data-toggle="tab" href="#panel1" role="tab" aria-selected="true"><i
                                class="mdi mdi-account mr-1"></i>Email</a>
                    </li>
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link" data-toggle="tab" href="#panel2" role="tab" aria-selected="false"><i
                                class="mdi mdi-phone mr-1"></i>
                            Mobile</a>
                    </li>
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link" data-toggle="tab" href="#panel3" role="tab" aria-selected="false"><i
                                class="mdi mdi-account-card-details mr-1"></i>
                            Aadhar</a>
                    </li>
                </ul>
                <div class="tab-content pt-2">
                    <div class="tab-pane fade in active show" id="panel1" role="tabpanel">
                        <div class="modal-body mb-1 pt-3">
                            <div class="show_result"></div>
                            <div class="title text-center">Registration by Email</div>
                            
                            <form method="POST" action="" id="registration_email">
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                            <div class="md-form form-sm mb-3">
                                <i class="mdi mdi-account prefix"></i>
                                <input type="text" name="name" value="{{ old('name') }}" id="name" class="form-control form-control-sm validate" autocomplete="name">
                                <span class="registration_error" id="name_error"></span>
                                <label data-error="wrong"  for="name" class="">Enter Username</label>
                            </div>


                            <div class="md-form form-sm mb-3">
                                <i class="mdi mdi-email prefix"></i>
                                <input id="email" type="email" class="form-control form-control-sm validate" name="email" value="{{ old('email') }}" autocomplete="email">
                                <span class="registration_error" id="email_error"></span>
                                <label data-error="wrong"  for="email" class="">Enter Email </label>
                            </div>

                            <div class="md-form form-sm mb-4 mt-3">
                                <i class="mdi mdi-lock prefix"></i>
                                <input id="password" type="password" class="form-control form-control-sm validate" name="password" autocomplete="new-password">
                                <span class="registration_error" id="password_error"></span>
                                <label data-error="wrong"  for="reg_pass" class="">Your
                                    password</label>
                            </div>

                            <div class="text-center mt-2">
                                <a class="btn btn-info waves-effect waves-light" onclick="register_byemail();" >Submit<i class="mdi mdi-send ml-2"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="panel2" role="tabpanel">
                        <div class="modal-body mb-1 pt-3">
                            <div class="title text-center">Registration by Mobile Number</div>
                            <div class="md-form form-sm mb-1">
                                <i class="mdi mdi-cellphone-android prefix"></i>
                                <input type="text" id="reg_mobile" class="form-control form-control-sm validate mb-2">
                                <label data-error="wrong" data-success="right" for="reg_mobile" class="">Enter Mobile
                                    No.</label>
                            </div>

                            <div class="text-center mt-2">
                                <button class="btn btn-info waves-effect waves-light btn-sm">Generate Otp</button>
                            </div>
                            <div class="small text-center mt-2">To continue, please enter OTP sent to verify mobile
                                number
                            </div>

                            <div class="md-form form-sm mb-3 mt-3">
                                <i class="mdi mdi-cellphone-message prefix"></i>
                                <input type="password" id="reg_otp" class="form-control form-control-sm validate mb-2">
                                <label data-error="wrong" data-success="right" for="reg_otp" class="">Enter otp</label>
                            </div>
                            <div class="text-center mt-2">
                                <button class="btn btn-info waves-effect waves-light btn-sm">Confirm Otp</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="panel3" role="tabpanel">


                        <div class="modal-body mb-1 pt-3">
                            <div class="title text-center">Regiatration by Aadhar Number</div>
                            <div class="md-form form-sm mb-1">
                                <i class="mdi mdi-account prefix"></i>
                                <input type="text" id="reg_aadhar" class="form-control form-control-sm validate mb-2">
                                <label data-error="wrong" data-success="right" for="reg_aadhar" class="">Enter Mobile
                                    No.</label>
                            </div>

                            <div class="text-center mt-2">
                                <button class="btn btn-info waves-effect waves-light btn-sm">Generate Otp</button>
                            </div>
                            <div class="small text-center mt-2">To continue, please enter OTP sent to verify mobile
                                number
                            </div>

                            <div class="md-form form-sm mb-3 mt-3">
                                <i class="mdi mdi-cellphone-message prefix"></i>
                                <input type="password" id="reg_aadhar_otp" class="form-control form-control-sm validate mb-2">
                                <label data-error="wrong" data-success="right" for="reg_aadhar_otp" class="">Enter otp</label>
                            </div>
                            <div class="text-center mt-2">
                                <button class="btn btn-info waves-effect waves-light btn-sm">Confirm Otp</button>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>  -->
<div class="modal fade" id="forgot_password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog cascading-modal" role="document">
        <div class="modal-content">
            <div class="modal-c-tabs">
                <ul class="nav nav-tabs md-tabs tabs-2 light-blue darken-3" role="tablist">
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link active" data-toggle="tab" href="#forgot_panel1" role="tab" aria-selected="true"><i class="mdi mdi-account-question mr-3"></i>Forgot Password</a>
                    </li>
                </ul>
                <div class="tab-content pt-2">
                    <div class="tab-pane fade in active show" id="forgot_panel1" role="tabpanel">
                        <div class="modal-body mb-1 pt-3">
                            <div class="md-form form-sm mb-1">
                                <i class="mdi mdi-account prefix"></i>
                                <input type="text" id="forgot_mobile" class="form-control form-control-sm validate">
                                <label data-error="wrong" data-success="right" for="forgot_mobile" class="">Enter Mobile
                                    No.</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button class="btn btn-info waves-effect waves-light">Submit<i class="mdi mdi-send ml-2"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript" src="{{asset('frontend/js/jquery-3.4.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/js/mdb.min.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/js/util.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/js/main.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/js/master.js')}}"></script>
<script src="{{asset('frontend/calendar/js/jquery-1.8.3.js')}}"></script>
<script src="{{asset('frontend/calendar/js/jquery.ui.core.js')}}"></script>
<script src="{{asset('frontend/calendar/js/jquery.ui.widget.js')}}"></script>
<script src="{{asset('frontend/calendar/js/jquery.ui.datepicker.js')}}"></script>
<script type="text/javascript">
    jQuery(function($) {
    $( ".datepicker" ).datepicker({dateFormat:"yy-mm-dd"});
    });
</script>

@yield('script')
<script type="text/javascript">
    function register_byemail(){
       var name = $('#name').val();
       var email = $('#email').val();
       var password = $('#password').val();
       var token = $('#token').val();
       
       var valid=1;
       if(name==''){
        $('#name_error').html('User name is required');
        valid=0;
       }else{
        $('#name_error').html('');
       }

       if(email==''){
        $('#email_error').html('Email is required');
        valid=0;
       }else{
        $('#email_error').html('');
       }

       if(password==''){
        $('#password_error').html('Password is required');
        valid=0;
       }else{
        $('#password_error').html('');
       }

       if(valid==1){
          var dataString = 'name='+name+'&email='+email+'&password='+password+'&token='+token;
          $.ajax({
          type: "POST",
          url: "{{url('registration_email')}}",
          data: dataString,
          cache: false,
          dataType: "json",
          success: function(result){
                if(result.success==1){
                  $('.show_result').html('<div class="alert alert-success">'+result.msg+'</div>');
                  setTimeout(function(){
                    $('.show_result').html('');
                    $('#registration_email')[0].reset();
                    $('#registration').modal('hide');
                  }, 2000); 
                }
                 if(result.success==0){
                  $('.show_result').html('<div class="alert alert-danger">'+result.msg+'</div>');  
                }
            }//end sucess
          });//end ajax
       }
    }

    function removelayer() {
        $('.footer_block').removeClass('footer_block_show');
        $('#upper_layer').addClass('scale0');
    }

    function Openlayer(dis) {
        $(dis).addClass('footer_block_show');
        $('#upper_layer').removeClass('scale0');
    }

    function Menupopup(dis) {
        var chkmenu = $(dis).find('.menu').attr('class');
        if (chkmenu == 'menu open_menu') {
            $(dis).find('.menu').removeClass('open_menu');
            $('#menus_block').removeClass('right_menublock_show');
        } else {
            $(dis).find('.menu').addClass('open_menu');
            $('#menus_block').addClass('right_menublock_show');
        }
    }

    window.onload = function (e) {
        setTimeout(function () {
            $('#loader-overlay').addClass('scale0');
        }, 2000);
    }
    window.onscroll = function () {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 180 || document.documentElement.scrollTop > 20) {
            $('#top_navigation_bar').addClass('logowithmenu_bar_fixed');
        } else {
            $('#top_navigation_bar').removeClass('logowithmenu_bar_fixed');
        }
    }


    $(document).ready(function () {
        wow = new WOW({
            boxClass: 'wow',
            animateClass: 'animated',
            offset: 0,
            mobile: true,
            live: true
        })
        wow.init();
        //$('#loader-overlay').addClass('scale0');
    });
</script>

<!--menu Click jquery-->
<script type="text/javascript">
    $(document).ready(function () {
        $('.glo_menuclick').click(function (e) {
            debugger;
            let chkopen = $(this).find('.menu_basic_popup').attr('class');
            $('.menu').removeClass('open_menu');
            $('#menus_block').removeClass('right_menublock_show');
            //$('#setting_box_slide').removeClass('show_setting');
            if (chkopen != 'menu_basic_popup effect') {
                if (chkopen != 'menu_basic_popup menu_popup_setting effect') {
                    $('.menu_basic_popup').addClass('scale0');
                    $(this).find('.menu_basic_popup').removeClass('scale0');
                    $('#User_info_block').addClass('add_color');
                } else {
                    $('.menu_basic_popup').addClass('scale0');
                    $('#User_info_block').removeClass('add_color');
                }
            } else {
                $('.menu_basic_popup').addClass('scale0');
                $('#User_info_block').removeClass('add_color');
            }
            e.stopPropagation();
        });
    });
    $(document).click(function (e) {
        $('.menu_basic_popup').addClass('scale0');
        $('#User_info_block').removeClass('add_color');
        e.stopPropagation();
    });
</script>
</body>
</html>