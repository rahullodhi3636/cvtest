@extends('layouts.adminloginmaster')
@title('Register')
@section('content')
 <!-- page content -->
 <style type="text/css">
  /*.top-content {
    width: 100%;
    min-height: 95vh;
    padding-bottom: 50px;
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
}*/
.login_wrapper{ display: flex;justify-content: center;flex-wrap: wrap;align-items: center;min-height: 100vh;}
   /*.login{    
    background: linear-gradient(180deg,#3f3f3f,#181818) no-repeat 0 0/100% 400px,#181818 repeat 100% 100%;}*/

    .login{ background: url(https://13.126.237.21/salon/backend/images/loginbg.png) repeat center center;display: block;
      position: relative;z-index: 0;}

    .login:after {
    content: '';
    position: absolute;
    top: 0;
    background: rgba(0, 0, 0, 0.65);
    width: 100%;
    height: 100%;
    z-index: -1;}
    .loginbtn{    background: #917758;
    border: 0;
    border-radius: 4px;
    color: #fff;
    display: block;
    outline: none;
    width: 100%;
    padding: 10px;
    text-transform: uppercase;}
    .loginbtn:focus,
    .loginbtn:hover{background: #000; color: #fff; text-decoration: none; box-shadow: 0;}
    .logo-block2{text-align: center;}
    .logo-block2 img{width: 100px;margin-bottom: 3px;}
    .login_content{ background: -webkit-linear-gradient(top,#231f20,#373638);
    padding: 40px 20px;border-radius: 8px;box-shadow: 0 3px 20px 0 rgba(0,0,0,.1);}
    .help-block{color: #daba6d; font-weight: normal;}
 </style>
    <div class="">
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form top-content">
          <section class="login_content">
            <div class="container">
              <div class="row">
                <div class="col-lg-12">
                <form class="" method="POST" action="{{ url('registerCustomer') }}" class="margin-bottom-0">
                  
                            {{ csrf_field() }} 
                    <div class="logo-block2">
                      <img src="{{ asset('backend/images/logo-cstestseries3.png')}}"> 
                    </div>         
                  <div class="text-center logotext mb-4">CHINNIE & VINNIE JABALPUR SALON</div>
                  <input type="hidden" name="reffer_hashcode" id="reffer_hashcode" value="{{ $hashcode }}">
                  <input type="hidden" name="last_id" id="last_id" value="{{ $last_id }}">
                  <div  class="{{ $errors->has('contact') ? ' has-error' : '' }}">
                    <div class="form-group">
                      <input id="contact" type="number" class="form-control form-control-lg" name="contact" placeholder="Enter contact number" value="{{ old('contact') }}" autofocus>
                        @if ($errors->has('contact'))
                      <span class="help-block">
                        <strong>{{ $errors->first('contact') }}</strong>
                      </span>
                      @endif
                    </div>  
                  </div>
                  <div  class="{{ $errors->has('name') ? ' has-error' : '' }}">
                    <div class="form-group">
                      <input id="name" type="text" class="form-control form-control-lg" name="name" placeholder="Enter name" value="{{ old('name') }}" autofocus>
                        @if ($errors->has('name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                      </span>
                      @endif
                    </div>  
                  </div>
                  <div class="{{ $errors->has('location') ? ' has-error' : '' }}">
                    <div class="form-group">
                      <input id="location" type="text" class="form-control form-control-lg" name="location" placeholder="Enter location" value="{{ old('location') }}" autofocus>
                        @if ($errors->has('location'))
                      <span class="help-block">
                        <strong>{{ $errors->first('location') }}</strong>
                      </span>
                      @endif
                    </div>  
                  </div>
                  <div class="{{ $errors->has('dob') ? ' has-error' : '' }}">
                    <div class="form-group">
                      <input id="dob" type="text" class="form-control form-control-lg datepicker" name="dob" placeholder="Enter Date of birth" value="{{ old('dob') }}" autofocus>
                        @if ($errors->has('dob'))
                      <span class="help-block">
                        <strong>{{ $errors->first('dob') }}</strong>
                      </span>
                      @endif
                    </div>  
                  </div>
                  <div class="">
                    <div class="form-group">
                      <input id="designation" type="text" class="form-control form-control-lg datepicker" name="designation" placeholder="Enter Designation" value="" autofocus>
                    </div>  
                  </div>
                  <div class="{{ $errors->has('gender') ? ' has-error' : '' }}">
                    <div class="form-group">
                      <select class="form-control form-control-lg" id="gender" name="gender">
                        <option value="">Select gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                      @if ($errors->has('gender'))
                        <span class="help-block">
                          <strong>{{ $errors->first('gender') }}</strong>
                        </span>
                      @endif
                    </div>  
                  </div>
                  <div  class="{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="form-group">
                      <input id="email" type="email" class="form-control form-control-lg" name="email" placeholder="Email Address" value="{{ old('email') }}" autofocus>
                        @if ($errors->has('email'))
                      <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                      @endif
                    </div>  
                  </div>
                  <div {{ $errors->has('password') ? ' has-error' : '' }}>
                    <div class="form-group">
                     <input id="password" type="password" class="form-control form-control-lg" name="password" placeholder="Password" value="{{ old('password') }}">
                     @if ($errors->has('password'))
                      <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                     @endif
                    </div>  
                  </div>
                  <div {{ $errors->has('password') ? ' has-error' : '' }}>
                    <div class="form-group">
                     <input id="confirmpassword" type="password" class="form-control form-control-lg" value="{{ old('confirmpassword') }}" name="confirmpassword" placeholder="Confirm Password">
                     @if ($errors->has('password'))
                     <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                     @endif
                   </div>  
                  </div>
                  <div>
                    <button type="submit" class="loginbtn">Register</button>
                  </div>
                </form>
                </div>
              </div>  
            </div>
          </section>
        </div>

      
      </div>
    </div>
        <!-- /page content -->
@endsection