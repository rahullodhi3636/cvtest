@extends('layouts.adminloginmaster')
@section('content')
<link href="{{asset('assets/css/bootstrap-datetimepicker.css')}}" rel="stylesheet">
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
    color: #daba7a;
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
    color: #daba7a;
    margin: 1px 20px 0px 0px;
    /*background-color: #ffffff;*/
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
                        <div class="col-sm-6">
                            <div class="logo-block">
                                <img src="{{ asset('backend/images/logo-cstestseries3.png')}}">
                            </div>
                            <div class="logotext">CHINNIE &amp; VINNIE<span>Jabalpur Salon</span></div>
                        </div>
                        <div class="col-sm-6">
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
                                        <i class="mdi mdi-email-open mr-2"></i>cvsalan.academy@gmail.com
                                        <div class="support-txt">Any query for Chinnic &amp; Vinnic</div>
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
                            <div class="upper_basic_heading"><span class="feed-title">Refer Customer</span></div>
                            <div class="feed-body star_rating">
                                @if($message=Session::get('success'))
                                <div class="alert alert-success">
                                    {{ $message }}
                                </div>
                                @endif
                                @if($message=Session::get('danger'))
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                                @endif
                                <h4 class="text-center mb-5">Welcome to CHINNIE & VINNIE Jabalpur Salon</h4>
  
                                <form class="mt-3" data-parsley-validate action="{{ route('referral.store') }}"
                                    method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <input type="hidden" name="custid" id="custid" value="{{$custid}}">

                                    <div class="row">
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label class="control-label" for="image">User Image <span class="required">*</span> </label>
                                          <input type="file"  name="image" id="image">
                                          <span class="text text-danger"> @if ($errors->has('image')){{ $errors->first('image') }} @endif</span>
                                      </div>
                                    </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label" for="cust_type">Customer Type </label>
                              <select name="cust_type" id="cust_type" class="form-control">
                                  <option value="">--select--</option>
                                  <option value="VIP"  {{ old('cust_type') == 'VIP' ? 'selected' : '' }}>VIP</option>
                                  <option value="NON VIP"  {{ old('cust_type') == 'NON VIP' ? 'selected' : '' }}>NON VIP</option>
                              </select>
                            <span class="text text-danger"> @if ($errors->has('cust_type')){{ $errors->first('cust_type') }} @endif</span>
                        </div>
                      </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label" for="name">Name <span class="required">*</span> </label>
                          <input type="text"  id="name" name="name" value="{{ old('name') }}" placeholder="Enter name"  class="form-control" autocomplete="off">
                          <span class="text text-danger"> @if ($errors->has('name')){{ $errors->first('name') }} @endif</span>
                      </div>
                    </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label" for="name">Location <span class="required">*</span> </label>
                        <input type="text"  id="location" name="location" value="{{ old('location') }}" placeholder="Enter location"  class="form-control" autocomplete="off">
                        <span class="text text-danger"> @if ($errors->has('location')){{ $errors->first('location') }} @endif</span>
                    </div>
                  </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label" for="contact">Contact <span class="required">*</span> </label>
                      <input type="number"  id="contact" name="contact" value="{{ old('contact') }}" placeholder="Enter contact"  class="form-control" autocomplete="off">
                      <span class="text text-danger"> @if ($errors->has('contact')){{ $errors->first('contact') }} @endif</span>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label" for="other_contact">Other Contact </label>
                      <input type="number"  id="other_contact" name="other_contact" value="{{ old('other_contact') }}" placeholder="Enter other contact"  class="form-control" autocomplete="off">
                      <span class="text text-danger"> @if ($errors->has('other_contact')){{ $errors->first('other_contact') }} @endif</span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label" for="email">Email </label>
                      <input type="email"  id="email" name="email" value="{{ old('email') }}" placeholder="Enter email"  class="form-control" autocomplete="off">
                      <span class="text text-danger"> @if ($errors->has('email')){{ $errors->first('email') }} @endif</span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label" for="contact">Dob </label>
                      <input type="text"  id="dob" name="dob" value="{{ old('dob') }}" placeholder="Enter dob"  class="form-control datepicker" data-date-format="yyyy-mm-dd" autocomplete="off">
                      <span class="text text-danger"> @if ($errors->has('dob')){{ $errors->first('dob') }} @endif</span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label" for="contact">Gender </label>
                      <select class="form-control" name="gender" id="gender">
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                      <span class="text text-danger"> @if ($errors->has('gender')){{ $errors->first('gender') }} @endif</span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label" for="referral_code">Designation  </label>
                      <input type="text"  id="designation" name="designation" value="" placeholder="Enter designation"  class="form-control" autocomplete="off">
                      <span class="text text-danger"> @if ($errors->has('designation')){{ $errors->first('designation') }} @endif</span>
                  </div>
                </div>
                <input type="hidden"  id="referred_by" name="referred_by" value="{{ Request::segment(2) }} ">

                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label" for="anniversary_date">Anniversary Date</label>
                      <input type="text"  id="anniversary_date" name="anniversary_date" value="{{ old('anniversary_date') }}" placeholder="Enter anniversary date"  class="form-control datepicker" data-date-format="yyyy-mm-dd" autocomplete="off">
                      <span class="text text-danger"> @if ($errors->has('anniversary_date')){{ $errors->first('anniversary_date') }} @endif</span>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label" for="remark">Remark</label>
                    <textarea id="remark" name="remark" placeholder="Enter remark"  class="form-control">{{ old('remark') }}</textarea>
                    <span class="text text-danger"> @if ($errors->has('remark')){{ $errors->first('remark') }} @endif</span>
                  </div>
                </div>
              </div><!--./row-->
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
    <script type="text/javascript" src="{{asset('assets/js/bootstrap-datetimepicker.js')}}"></script>
    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
    <script type="text/javascript">
    $(document).ready(function() {
      $( ".datepicker" ).datepicker({
        format: 'dd-mm-yyyy',
        todayHighlight: true
      });
    });
  
    </script>
    @endsection