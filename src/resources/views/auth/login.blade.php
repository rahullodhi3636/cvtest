@extends('layouts.adminloginmaster')
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
                <form class="" method="POST" action="{{ route('login') }}" class="margin-bottom-0">
                  
                            {{ csrf_field() }} 
                   <div class="logo-block2">
                      <img src="{{ asset('backend/images/logo-cstestseries3.png')}}"> 
                    </div>         
                  <div class="text-center logotext mb-4">CHINNIE & VINNIE JABALPUR SALON</div>
                  <div  class="{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="form-group">
                      <input id="email" type="email" class="form-control form-control-lg" name="email" placeholder="Email Address" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                      <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                      @endif
                    </div>  
                  </div>
                  <div {{ $errors->has('password') ? ' has-error' : '' }}>
                    <div class="form-group">
                     <input id="password" type="password" class="form-control form-control-lg" name="password" placeholder="Password" required>
                     @if ($errors->has('password'))
                     <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                     @endif
                   </div>  
                  </div>
                  <div>
                    <button type="submit" class="loginbtn">Log in</button>
                  
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