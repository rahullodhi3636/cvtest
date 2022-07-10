@extends('layouts.adminloginmaster')
@section('content')
<link rel="stylesheet" href="{{url('backend/css/materialdesignicons.css')}}" type="text/css">
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

.rating {
    border: none;
    margin: 0px;
    margin-bottom: 18px;
   display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: row-reverse;
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
@media only screen and (max-width: 768px)
{
.top-content
{
    text-align: center;
    margin-bottom: 15px;
}
.cust-head
{
    display: flex;
    justify-content: center;
    margin-bottom: 10px;
}
@media only screen and (max-width: 530px)
{
.menu_header{
    position: relative;
}
fieldset.rating.star>label:before {
 font-size: 37px;
}
    .top-contact-block:after{display: none;}
.top-contact-block {
margin-bottom: 10px;

}
.top-content {
    text-align: center;
    margin-bottom: 0;
}
}
</style>

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
        <header class="menu_header">
            <div class="top-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12 col-md-4 col-lg-4 cust-head">
                            <div class="logo-block">
                                <img src="{{ asset('backend/images/logo-cstestseries3.png')}}">
                            </div>
                            <div class="logotext">CHINNIE &amp; VINNIE<span>Jabalpur Salon</span></div>
                        </div>
                        <div class="col-sm-12 col-md-8 col-lg-8">
                            <div class="top-content mt-2">
                                <div class="top-contact-block">

                                    <a class="top-contact" href="tel:9179999557"><i class="mdi mdi-phone mr-2"></i>
                                        <div class="support-txt">+0761-4923091</div>
                                    </a>
                                    <a class="top-contact" href="tel:8982459004"><i class="mdi mdi-phone mr-2"></i>
                                        <div class="support-txt">+91-7828550550 9144400550</div>
                                    </a>
                                </div>
                                <div class="top-contact-block">
                                    <a class="top-contact" href="mailto:admin@cstestseries.com">
                                        <i class="mdi mdi-email-open mr-2"></i>cvsalon.academy@gmail.com
                                        <div class="support-txt">Any query for Chinnie &amp; Vinnie</div>
                                    </a>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </header>
        <section class="dashboard-section">
            <div class="container mt-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="dash_boxcontainner white_boxlist">
                            <div class="upper_basic_heading"><span class="feed-title">Feedback</span></div>
                            <div class="feed-body star_rating">
                                @if($message=Session::get('success'))
                                <div class="alert alert-success">
                                    {{ $message }}
                                </div>
                                @endif
                                <h4>Welcome to CHINNIE & VINNIE Jabalpur Salon</h4>
                                <p>Thanks for Visiting CV salon we hope we served you well Please provide your valuable
                                    feedback.</p>
                                <form class="mt-3" data-parsley-validate action="{{ route('feedback.store') }}"
                                    method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <input type="hidden" name="custid" id="custid" value="{{$custid}}">
                                    <ul class="star-nav mt-4 text-center" id='stars'>
                                        <fieldset class="rating star">
                                            <input type="radio" id="field6_star1" name="rating2" value="5" />
                                            <label title='Poor' class="full" for="field6_star1"></label>
                                            <input type="radio" id="field6_star2" name="rating2" value="4" />
                                            <label title='Fair' class="full" for="field6_star2"></label>
                                            <input type="radio" id="field6_star3" name="rating2" value="3" />
                                            <label title='Good' class="full" for="field6_star3"></label>
                                            <input type="radio" id="field6_star4" name="rating2" value="2" />
                                            <label title='Excellent' class="full" for="field6_star4"></label>
                                            <input type="radio" id="field6_star5" name="rating2" value="1" />
                                            <label title='WOW!!!' class="full" for="field6_star5"></label>
                                        </fieldset>
                                    </ul>
                                    <div class="form-group">
                                        <label for="comment">Please leave your feedback below.</label>
                                        <textarea class="form-control" rows="5" name="comment" id="comment"></textarea>
                                        <span class="text text-danger"> 
                                        @if ($errors->has('rating2')){{ $errors->first('rating2') }} @endif</span><br>
                                        <span class="text text-danger"> 
                                        @if ($errors->has('comment')){{ $errors->first('comment') }} @endif</span>
                                    </div>
                                    <div class="form-group text-center">
                                        @if($custid != null)
                                        <button type="submit" class="submitbtn2">Submit</button>
                                        @else
                                        <button type="button" class="submitbtn2">Submit</button>
                                        @endif
                                    </div>
                                </form>
                            </div>
                            <!--./feed-body-->
                        </div>
                        <!--./dash_boxcontainner-->
                    </div>
                    <!--./col-lg-12-->
                </div>
                <!--./row-->
            </div>
            <!--./container-->
        </section>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   
    <script type="text/javascript">

    function getstarrating(rating){
       console.log(rating);
    }
    $("label").click(function() {
        $(this).parent().find("label").css({
            "background-color": "transparent"
        });
        $(this).css({
            "background-color": "#daba7a"
        });
        $(this).nextAll().css({
            "background-color": "#daba7a"
        });
    });
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
    </script>
    @endsection