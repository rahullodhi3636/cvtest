 <style type="text/css">
     .admin-baskit {
    color: #ffffff;
    margin-top: 15px;
}
.admin-baskit .counter {
    -webkit-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12);
    box-shadow: 0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12);
    position: absolute;
    z-index: 2;
    margin-top: 0;
    margin-left: -23px;
    -webkit-border-radius: 10em;
    border-radius: 10em;
    padding: 1px 7px;
    background-color: #fe1212;
    font-size: 11px;
    color: #fff;
    left: auto;
}
.alert
{
position: relative;
z-index: 10;
padding-left: 250px;
font-size: 14px;
}

.alert h3,
.alert .h3
{
margin-top:0;
margin-bottom:0;
font-size: 24px;
}
 </style>

 <header class="menu_header">
        <div class="top-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo-block">
                            <img src="{{asset('backend/images/logo-cstestseries3.png')}}"> 
                        </div>
                        <div class="logotext">CHINNIE & VINNIE<span>Jabalpur Salon</span></div>
                    </div>
                    <div class="col-sm-5">
                        <div class="top-content mt-2">
                            <div class="top-contact-block">
                               
                                <a class="top-contact" href="tel:9179999557"><i class="mdi mdi-phone mr-2"></i>
                                    <div class="support-txt">+0761-4923091</div>
                                </a>
                                <a class="top-contact" href="tel:8982459004"><i class="mdi mdi-phone mr-2"></i>
                                    <div class="support-txt">+91-7828550550 9144400550</div>
                                </a></div>
                            <div class="top-contact-block">
                                <a class="top-contact" href="mailto:admin@cstestseries.com">
                                    <i class="mdi mdi-email-open mr-2"></i>cvsalon.academy@gmail.com
                                    <div class="support-txt">Any query for Chinnie & Vinnie</div>
                                </a>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                       
                        <div class="nav_icon_withtxt"><i class="mdi mdi-account-circle-outline" style="display: none;"></i><span class="btn btn-sm btn-login text-white waves-effect waves-light" onclick="openloginregistration('login');" style="display: none;">Login</span>
                        <span class="btn btn-sm btn-signup text-white waves-effect waves-light" onclick="openloginregistration('registration');" style="display: none;">Register</span>
                            <div class="user-login-block dropdown show" style="">
                                <div class="user-login">
                                @php
                                $username = Auth::user()->name;
                                echo strtoupper(substr($username, 0, 1));
                                @endphp
                                </div>
                                <div class="dropdown-menu pullDown user-seting-popup" id="login-user-popup">
                                    <ul class="user_dw_menu list-unstyled">
                                        <li>
                                            <div class="heading-popup">{{ strtoupper(Auth::user()->name) }}</div>
                                        </li>
                                        <!-- <li>
                                            <a href="#" onclick="return false;">
                                                <i class="mdi mdi-monitor-dashboard"></i>Dashboard
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" onclick="return false;">
                                                <i class="mdi mdi-face-profile"></i>Profile
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" onclick="return false;">
                                                <i class="mdi mdi-settings"></i>Setting
                                            </a>
                                        </li> -->
                                        <li>
                                            <a href="{{url('admin/change_password')}}">
                                                <i class="mdi mdi-settings"></i>Change Password
                                            </a>
                                        </li>
                                        <li>

                                          <a class="dropdown-item" href="{{ route('logout') }}"
                                             onclick="event.preventDefault();
                                                           document.getElementById('logout-form').submit();"><i class="mdi mdi-logout"></i>
                                              {{ __('Logout') }}
                                          </a>

                                          <form id="logout-form" action="{{ url('/logout') }}" method="POST">
                                                                          {{ csrf_field() }}
                                          </form>

                                           
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- <div class="user-baskitbox admin-baskit" onclick="viewcard();">
                                <i class="mdi mdi-basket"></i>
                                <span class="counter" id="basket_counter">{{Cart::getContent()->count()}}</span>
                            </div> -->
                        </div>



                    </div>
                </div>
            </div>
        </div>
        <div class="top_nav_section" style="display: none;">
            <div class="container" id="top_navigation">
                <div class="menus-block">
                    <nav class="main-menu">
                        <div class="res_menu_btn" onclick="ResponsiveMenu();">
                            <i class="mdi mdi-menu"></i>
                        </div>
                        <ul class="top_menu_ul list-unstyled" id="res_menucontainer">
                            <li class="active pl-0"><a href="#banner_slider"><i class="mdi mdi-home"></i>Home</a></li>
                            <li><a href="#banner_slider"><i class="mdi mdi-account-box-outline"></i>About</a></li>
                            <!--                            <li id="nav_about"><a href="#about-section">Schedule</a></li>-->
                            <li id="nav_how"><a href="#fest-section"><i class="mdi mdi-file-document-box-multiple-outline"></i>Test Series</a></li>
                            <li id="nav_video"><a href="#sponser-section"><i class="mdi mdi-video"></i>Video Classes</a>
                            </li>
                            <li id="nav_books"><a href="#sponser-section"><i class="mdi mdi-book-open-page-variant"></i>Books</a>
                            </li>
                            <li id="nav_placement"><a href="#sponser-section"><i class="mdi mdi-file-account"></i>Placement
                                Portal</a></li>
                            <li id="nav_download"><a href="#sponser-section"><i class="mdi mdi-download"></i>Download</a></li>
                            <li id="nav_sell"><a href="#sponser-section"><i class="mdi mdi-hand"></i>Sell with us</a>
                            </li>
                            <li id="contact" class="last_afternone"><a href="#contact-section"><i class="mdi mdi-contacts"></i>Contact</a></li>
                        </ul>
                        <div class="menu_overlay" id="menu_overlay_div" onclick="ResponsiveMenu();"></div>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <script type="text/javascript">
        /*$(".alert-message").prepend(htmlAlert);*/
        

        function viewcard() {
            $('#mycard-popup').modal('show');
        }
        function removeItem(id) {
            if (confirm("Do you really want remove this service from cart?")) {
                if (id != "") {
                    var formdata = $("#remove_item_"+id).serialize();
                    var csrf = "<?php echo csrf_token(); ?>";
                    $.ajax({
                        url:"{{route('cart.remove')}}",
                        type:'POST',
                        data:formdata,
                        dataType:'JSON',
                        success:function(res) {
                            $("#cart-item-body").html(res.html);
                            $("#headcount").html('My Cart ('+res.count+') items');
                            $("#basket_counter").html(res.count);
                            $("#subTotal").html(res.subtotal);
                        }
                    });
                }
            }
        }
    </script>