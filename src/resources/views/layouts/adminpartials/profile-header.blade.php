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
 <div style="display: none;" class="alert-message alert-success"><h3>Success</h3><BR><p>Service has successfully been added to the shopping cart!</p> </div>
 <div class="modal fade right" id="mycard-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="true" style="display: none;" aria-hidden="true"><div class="modal-dialog modal-full-height modal-right modal-card modal-notify modal-info" role="document" id="car_modal">
        <div class="modal-content" id="cartbody">
            <div class="modal-header">
                <p class="heading lead py-0" id="headcount">
                    
                    My Cart (<?php if(!empty($count)) echo $count; else echo 0; ?> items)
                </p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">×</span>
                </button>
            </div>
            <div class="cart-modalbody">
                <div class="cart-items-container" id="cart-item-body">
                    @if(!empty($cartitem))
                    @foreach($cartitem as $product)
                    <div class="cart-items-row">
                        <div class="cart-product_img">
                            <img src="https://localhost/salon/backend/images/logo-cstestseries3.png">
                        </div>
                        <div class="cart-items-details">
                            <div class="row">
                                <div class="col-sm-8">
                                </div>
                                <div class="col-sm-4 float-right">
                                    <form id="remove_item_{{$product->id}}" action="{{route('cart.remove')}}" method="POST" class="">
                                        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                                        <input name="id" type="hidden" value="{{$product->id}}">
                                        <input name="cid" type="hidden" value="{{$product->customer_id}}">
                                        <button type="button" onclick="removeItem('{{$product->id}}');" class="close">×</button>
                                    </form>                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="cartproduct-name" title="{{$product->item_name}}">
                                        {{$product->item_name}}
                                    </div>
                                    <div class="cartproduct-items">
                                        <span class="cartnew-price"> {{$product->item_price}}
                                        </span>
                                        <span class=""> x <strong class="badge badge-warning badge-xs">{{$product->item_quantity}}</strong>
                                        </span>
                                        <div class="carttotel-price float-right badge badge-xs badge-info" style="border-radius: 7%">
                                            ₹ {{$product->item_price * $product->item_quantity}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="cart-items-row">
                        <div class="cart-product_img">
                        </div>
                        <div class="cart-items-details">
                            <div class="row">
                                <div class="col-sm-8">
                                    
                                </div>
                                <div class="col-sm-4 float-right">
                                                                  
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    
                                    <div class="cartproduct-items">
                                        <span class="cartnew-price"> Cart Empty
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="card-footer">
                <small class="cartpromo">
                    
                </small>
                <form id="checkout_form" action="" method="POST" class="">
                    <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                    <input name="customerid" type="hidden" value="{{$customer->id}}">
                    <a type="button" onclick="proceedToCheckout('{{$customer->id}}')" class="btn btn-info btn-block waves-effect waves-light" href="javascript:void(0)">
                        Proceed to Checkout :
                        <span id="subTotal">₹ <?php 
                        $subtotal = 0;
                        foreach ($cartitem as $value) {
                            $subtotal += $value->item_price * $value->item_quantity;
                        }
                        if(!empty($subtotal)) echo $subtotal; else echo 0; ?></span>
                        <i class="mdi mdi-chevron-right pull-right"></i>
                        <input type="hidden" name="totalamount" value="{{$subtotal}}">
                    </a>
                </form>
            </div>
        </div>
        <div class="modal-content" id="checkoutbody" style="display: none;">
            
        </div>
    </div>
</div>
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
                            <div class="user-baskitbox admin-baskit" onclick="viewcard();">
                                <i class="mdi mdi-basket"></i>
                                <span class="counter" id="basket_counter"><?php if(!empty($count)) echo $count; else echo 0; ?></span>
                            </div>
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

    <script src="{{ asset('backend/calendar/jquery.js')}}"></script> 
    <script src="{{ asset('backend/calendar/jquery-ui.js')}}"></script> 
    <link href="{{ asset('backend/calendar/jquery-ui.css')}}" rel="stylesheet">   
    <script type="text/javascript">
        /*$(".alert-message").prepend(htmlAlert);*/
       $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
        

        function checkreward(point) {
            var totalamount = parseInt($("#totalamount").val());
            var rewardpoints = parseInt($("#rewardpoints").val());
            point = parseInt(point);
            if (rewardpoints >= point) {
                /*$("#remaindiv").show();
                $("#duediv").show();
                var remainamt = totalamount - amt;
                $("#remainamount").val(remainamt);*/
                var totalpay = totalamount - point;
                $("#payamount").val(totalpay);
            }else if(rewardpoints < point){
                /*$("#remaindiv").hide();
                $("#duediv").hide();
                var remainamt = 0;
                $("#remainamount").val(remainamt);
                $("#paidamount").val(0);
                var totalpay = totalamount - point;*/
                $("#rewardpoint").val(rewardpoints);
                var totalpay = totalamount - rewardpoints;
                $("#payamount").val(totalpay);
            }else{
                /*$("#remaindiv").hide();
                $("#duediv").hide();
                var remainamt = 0;
                $("#remainamount").val(remainamt);*/
                $("#payamount").val(totalamount);
            }
        }

        function checkamount(amt) {
            var totalamount = parseInt($("#payamount").val());
            amt = parseInt(amt);
            if (totalamount > amt) {
                $("#remaindiv").show();
                $("#duediv").show();
                var remainamt = totalamount - amt;
                $("#remainamount").val(remainamt);
            }else if(totalamount < amt){
                $("#remaindiv").hide();
                $("#duediv").hide();
                var remainamt = 0;
                $("#remainamount").val(remainamt);
                $("#paidamount").val(0);
            }else{
                $("#remaindiv").hide();
                $("#duediv").hide();
                var remainamt = 0;
                $("#remainamount").val(remainamt);
            }
        }

        function checkoutnow() {
            var formdata = $("#checknowform").serialize();
            $.ajax({
                url:'{{url("admin/checkoutnow")}}',
                type:'POST',
                data:formdata,
                dataType:'JSON',
                success:function(res) {
                    if (res == "Done") {
                        $(".alert-success").show();
                        $(".alert-success").html("<h3>Success</h3><p>Transaction successfully done</p>");
                        setTimeout(function() {
                            $(".alert-success").hide();
                            $(".alert-success").fadeTo(500, 0).slideUp(500, function () {
                             $(this).remove();
                            });
                            window.location.reload();
                        },2000);
                        // window.location.reload();
                    }
                }
            });
        }
        
        function proceedToCheckout(custid) {
            var formdata = $("#checkout_form").serialize();
            var csrf = "<?php echo csrf_token(); ?>";
            $.ajax({
                url:'{{url("admin/checkout")}}',
                type:'POST',
                data:formdata,
                dataType:'JSON',
                async:false,
                success:function(res) {
                    $("#cartbody").hide();
                    $("#checkoutbody").show();
                    $("#checkoutbody").html(res.html);
                    $( ".datepicker" ).datepicker();
                }
            });
        }

        function cancelcheckout(custid) {
            var formdata = $("#cancel_form").serialize();
            $.ajax({
                url:'{{url("admin/cancelcheckout")}}',
                type:'POST',
                data:formdata,
                dataType:'JSON',
                success:function(res) {
                    $("#checkoutbody").hide();
                    $("#checkoutbody").html('');
                    $("#cartbody").show();
                    $("#cart-item-body").html(res.html);
                    $("#headcount").html('My Cart ('+res.count+') items');
                    $("#basket_counter").html(res.count);
                    $("#subTotal").html(res.subtotal);
                }
            });
        }

        function viewcard() {
            $('#mycard-popup').modal('show');
        }
        function removeItem(id) {
            if (confirm("Do you really want remove this service from cart?")) {
                if (id != "") {
                    var formdata = $("#remove_item_"+id).serialize();
                    var csrf = "<?php echo csrf_token(); ?>";
                    $.ajax({
                        url:"{{url('admin/deleteitem')}}",
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