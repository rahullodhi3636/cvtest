@extends('layouts.newlayout.app')
@section('content')
<style type="text/css">
.feed-title {
    font-size: 20px;
    width: 100%;
    font-weight: bold;
    text-transform: uppercase;
    color: #fff;
    display: block;
    margin: -20px 0px 0;
    padding: 15px;
    background: linear-gradient(60deg, #917758, #5d4e3c);
    box-shadow: 0 12px 20px -10px rgb(18, 18, 18), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(156, 39, 176, 0.2);
    border-radius: 3px;
}

.feed-body {
    padding: 20px;
    color: #999;
}

.feedinner {
    padding: 20px;
    background: #000;
    color: #999;
}

.submitbtn2 {
    background-color: transparent;
    color: #999;
    border: 1px solid #999;
    padding: 8px 30px;
    outline: 0;
    border-radius: 4px;
    transition: all 0.5s ease;
}

.submitbtn2:focus,
.submitbtn2:hover {
    background: #daba7a;
    color: #000;
    text-decoration: none;
}

.star-nav {
    padding: 0;
    margin: 0;
    list-style: none;
}

.star-nav li {
    padding: 0px 0px;
    font-size: 60px;
    /* color: #daba7a; */
    display: inline-block;
}

.staff_star-nav {
    padding: 0;
    margin: 0;
    list-style: none;
}

.staff_star-nav li {
    padding: 0px 0px;
    font-size: 60px;
    /* color: #daba7a; */
    display: inline-block;
}

.rating {
    border: none;
    margin: 0px;
    margin-bottom: 18px;
    /*float: left;*/
    position: relative;
    right: 35%;
}

.rating>input {
    display: none;
}

.rating.star>label {
    margin: 1px 20px 0px 0px;
    /* background-color: #ffffff; */
    border-radius: 0;
    height: 48px;
    float: right;
    width: 44px;
    /*border: 1px solid #ffffff;*/
}

fieldset.rating.star>label:before {
    margin-top: 0;
    padding: 0px;
    font-size: 47px;
    font-family: FontAwesome;
    /*display: inline-block;*/
    content: "\2605";
    position: relative;
    top: -9px;
}

.rating.staff_star>label {
    margin: 1px 20px 0px 0px;
    /* background-color: #ffffff; */
    border-radius: 0;
    height: 48px;
    float: right;
    width: 44px;
    /*border: 1px solid #ffffff;*/
}

fieldset.rating.staff_star>label:before {
    margin-top: 0;
    padding: 0px;
    font-size: 47px;
    font-family: FontAwesome;
    /*display: inline-block;*/
    content: "\2605";
    position: relative;
    top: -9px;
}
</style>
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="boxbody">
                <ul class="nav nav-tabs2 nav-justified">
                    <li class="nav-item">
                        <a class="nav-link active pull-left" style="min-width:85%;" data-toggle="tab"
                            href="#SittingPackageData">Check In Customers</a>
                        <a class="nav-link active pull-right" href="{{url('recent_checkin')}}"> New Check-in</a>
                    </li>
                    <!-- <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#Service">Service Segment</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#Upcoming">Upcoming Segment</a>
              </li> -->
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="SittingPackageData">
                        <form class="formvisit">
                            <div class="panelbox">

                                <div class="row pull-right">
                                    @if (\Session::has('success'))
                                    <div class="alert alert-success">
                                        <ul>
                                            <li>{!! \Session::get('success') !!}</li>
                                        </ul>
                                    </div>
                                    @endif
                                </div>
                                <div class="row">

                                    <div class="col-lg-12 col-md-12 col-12 mt-3">

                                        <div class="table-responsive">

                                            <div class="table-responsive">
                                                <table
                                                    class="table table-bordered table-striped recent-purchases-listing"
                                                    id="customer_data_Table">
                                                    <thead>
                                                        <tr>
                                                            <th>Customer Name & ID</th>
                                                            <th>Email Id & Mobile</th>
                                                            <th>Action
                                                                <a onclick="checkout_all()" class="theme-btn mt-1"
                                                                    href="javascript:void(0)">All Check-Out</a>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="customerTableBody">
                                                        <?php if (!empty($customer)): ?>
                                                        <?php foreach ($customer as $value): ?>
                                                        <tr>
                                                            <td>{{ $value->name }}</td>
                                                            <td>{{ $value->email }}</td>
                                                            <td>
                                                                <button type="button" class="theme-btn mt-2"
                                                                    onclick="showStaffFeedback('{{ $value->id }}' )">Staff
                                                                    Feedback</button>
                                                                <button type="button" class="theme-btn mt-2"
                                                                    onclick="CheckoutStatus( {{ $value->id }} )">CheckOut</button>
                                                                @if(Auth::user()->department==4)
                                                                <a class="theme-btn mt-2"
                                                                    href="{{route('recent_invoice',$value->id)}}">Recent
                                                                    Invoices</a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <?php endforeach?>
                                                        <?php endif?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/col-lg-12-->
                                </div>
                                <!--./row-->
                            </div>
                            <!--./panelbox-->
                        </form>
                    </div>
                    <!--./Customer-->
                </div>
                <!--./tab-content-->
            </div>
            <!--./boxbody-->
        </div>
        <!--./container-fluid-->
        <footer>Copyright © 2020 Chinnie & Vinnie Jabalpur Salon. All rights reserved.</footer>
    </div>
    <!--./main-content-->

</div>
<!--./main-->

<!-- The Modal -->
<div class="modal" id="feedbackbystaff_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">FeedBack</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body formvisit">
                <form id="stf_fdbk_Form" class="formvisit mt-2" style="display:none;">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" name="customer_id" id="fdbk_customer_id" required="">
                    <input type="hidden" name="staff_id" id="fdbk_staff_id" required="">
                    {{-- <input type="hidden" name="invoice_id" id="fdbk_invoice_id" required=""> --}}
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Staff Rating :-</label>
                            <select name="rating" id="staff_rating" class="form-control">
                                <option value="1">1 Star</option>
                                <option value="2">2 Stars</option>
                                <option value="3">3 Stars</option>
                                <option value="4">4 Stars</option>
                                <option value="5">5 Stars</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="comment">Please leave Staff feedback below.</label>
                                <textarea class="form-control" rows="3" name="staff_comment"
                                    id="staff_comment"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Customer Rating :-</label>
                            <select name="cust_rating" id="cust_rating" class="form-control">
                                <option value="1">1 Star</option>
                                <option value="2">2 Stars</option>
                                <option value="3">3 Stars</option>
                                <option value="4">4 Stars</option>
                                <option value="5">5 Stars</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="comment">Please leave Customer feedback below.</label>
                                <textarea class="form-control" rows="3" name="cust_comment"
                                    id="cust_comment"></textarea>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="mt-3" data-parsley-validate id="cust_feedback_form"                    >
                    <h4>Customer Feedback About Service</h4>
                    <ul class="star-nav mt-4 text-center" id='stars'>
                        <fieldset class="rating star">
                            <input type="radio" id="field6_star5" name="rating2" value="5" />
                            <label title='WOW!!!' class="full" for="field6_star5"></label>
                            <input type="radio" id="field6_star4" name="rating2" value="4" />
                            <label title='Excellent' class="full" for="field6_star4"></label>
                            <input type="radio" id="field6_star3" name="rating2" value="3" />
                            <label title='Good' class="full" for="field6_star3"></label>
                            <input type="radio" id="field6_star2" name="rating2" value="2" />
                            <label title='Fair' class="full" for="field6_star2"></label>
                            <input type="radio" id="field6_star1" name="rating2" value="1" />
                            <label title='Poor' class="full" for="field6_star1"></label>
                        </fieldset>
                    </ul>
                    <div class="form-group">
                        <label for="comment">Please leave your feedback below.</label>
                        <textarea class="form-control" rows="5" name="customer_comment"
                            id="customer_comment"></textarea>

                    </div>
                    <div class="form-group text-center">
                        <button type="button" class="submitbtn2" onclick="submit_cust_feedback()">Submit</button>
                        <button type="button" class="submitbtn2" onclick="skip_cust_feedback()">Skip</button>
                    </div>
                </div>


                <div class="mt-3"  id="staff_feedback_form"
                    style="display:none;" enctype="multipart/form-data">
                    <h4>Staff Feedback About Customer</h4>
                    <ul class="star-nav mt-4 text-center" id='staff_stars'>
                        <fieldset class="rating staff_star">
                            <input type="radio" id="field6_staff_star5" name="rating_by_staff" value="5" />
                            <label title='WOW!!!' class="full" for="field6_staff_star5"></label>
                            <input type="radio" id="field6_staff_star4" name="rating_by_staff" value="4" />
                            <label title='Excellent' class="full" for="field6_staff_star4"></label>
                            <input type="radio" id="field6_staff_star3" name="rating_by_staff" value="3" />
                            <label title='Good' class="full" for="field6_staff_star3"></label>
                            <input type="radio" id="field6_staff_star2" name="rating_by_staff" value="2" />
                            <label title='Fair' class="full" for="field6_staff_star2"></label>
                            <input type="radio" id="field6_staff_star1" name="rating_by_staff" value="1" />
                            <label title='Poor' class="full" for="field6_staff_star1"></label>
                        </fieldset>
                    </ul>
                    <div class="form-group">
                        <label for="comment">Please leave your feedback below.</label>
                        <textarea class="form-control" rows="5" name="staff_comment_res"
                            id="staff_comment_res"></textarea>

                    </div>
                    <div class="form-group text-center">
                        <button type="button" class="submitbtn2" onclick="submit_staff_feedback()">Submit</button>
                        <button type="button" class="submitbtn2" onclick="skip_staff_feedback()">Skip</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="outline-btn" data-dismiss="modal" id="save_feedback_btn" style="display:none;"
                    onclick="saveStaffFeedback()">Send</button>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('assets/js/lib/jquery.js')}}"></script>
<script src="{{asset('assets/js/dist/jquery.validate.js')}}"></script>
<script>
function CheckoutStatus(cust_id) {
    // alert(invoice_id);
    if (cust_id != "") {
        $.ajax({
            url: "{{ route ('checkinstatusupdate') }}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                'cust_id': cust_id
            },
            dataType: 'JSON',
            success: function(res) {

                if (res.msg == true) {
                    alert('Customer check-out status updated');
                    location.reload();
                } else {
                    alert('Something wrong in updating check-out status');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Something went wrong in CheckOutStatus');
            }
        });
    }
}

function checkout_all() {
    $.ajax({
        url: "{{ route ('checkoutall') }}",
        type: 'GET',
        success: function(res) {
            console.log(res);
            if (res == 1) {
                alert('All Customer Checkout');
                location.reload();
            } else {
                alert('Something wrong in checkout all ss');
            }
        }
    });
}

function saveStaffFeedback() {
    var stf_fdbk_Form = $('#stf_fdbk_Form').serialize();
    $.ajax({
        url: "{{ url('add_StaffFeedback') }}",
        type: 'POST',
        data: stf_fdbk_Form,
        dataType: 'JSON',
        success: function(res) {
            console.log(res);
            if (res.msg == true) {
                alert('Feedback submitted successfully');
            }
            location.reload();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Something went wrong in saveStaffFeedback');
        }
    });
}

function showStaffFeedback(fdb_cust_id) {
    // localStorage.setItem('feedback_cust', fdb_cust_id);
    $('#fdbk_customer_id').val(fdb_cust_id);
    //$('#fdbk_invoice_id').val(fdbk_invoice_id);
    $('#fdbk_staff_id').val('{{ Auth::user()->id }}');
    $('#feedbackbystaff_modal').modal('show');
}

$(".star label").click(function() {
    $(this).parent().find("label").css({
        "color": "#999"
    });
    $(this).css({
        "color": "#daba7a"
    });
    $(this).nextAll().css({
        "color": "#daba7a"
    });
    $(this).css({
        "background-color": "transparent"
    });
    $(this).nextAll().css({
        "background-color": "transparent"
    });
});


$(".staff_star label").click(function() {
    $(this).parent().find("label").css({
        "color": "#999"
    });
    $(this).css({
        "color": "#daba7a"
    });
    $(this).nextAll().css({
        "color": "#daba7a"
    });
    $(this).css({
        "background-color": "transparent"
    });
    $(this).nextAll().css({
        "background-color": "transparent"
    });
});

function submit_cust_feedback() {
    let rating_by_cust = 0;
    let comm_by_cust = '';
    // var cust_feedback_form = $('#cust_feedback_form').serialize();
    // console.log(cust_feedback_form);
    $('#cust_feedback_form').hide();
    if ($('input[name=rating2]:checked').length > 0) {
        rating_by_cust = document.querySelector('input[name="rating2"]:checked').value;
        console.log(rating_by_cust);
    }
    comm_by_cust = document.getElementById("customer_comment").value;
    $('#cust_rating').val(rating_by_cust);
    $('#cust_comment').val(comm_by_cust);
    $('#staff_feedback_form').show();

}

function skip_cust_feedback() {
    let rating_by_cust = 0;
    let comm_by_cust = '';
    $('#cust_rating').val(rating_by_cust);
    $('#cust_comment').val(comm_by_cust);
    $('#cust_feedback_form').hide();
    $('#staff_feedback_form').show();
}

function submit_staff_feedback() {
    let rating_by_staff = 0;
    let staff_comment_res = '';
    $('#staff_feedback_form').hide();
    if ($('input[name=rating_by_staff]:checked').length > 0) {
        rating_by_staff = document.querySelector('input[name="rating_by_staff"]:checked').value;
        console.log(rating_by_staff);
    }
    staff_comment_res = document.getElementById("staff_comment_res").value;
    $('#staff_rating').val(rating_by_staff);
    $('#staff_comment').val(staff_comment_res);
    $('#stf_fdbk_Form').show();
    $('#save_feedback_btn').click();
}

function  skip_staff_feedback() {
  let rating_by_staff = 0;
  let staff_comment_res = '';
  $('#staff_rating').val(rating_by_staff);
  $('#staff_comment').val(staff_comment_res);
  $('#staff_feedback_form').hide();
  $('#stf_fdbk_Form').show();
  $('#save_feedback_btn').click();
}
</script>
@endsection
