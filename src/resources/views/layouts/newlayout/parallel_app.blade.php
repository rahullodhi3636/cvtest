<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chinnie & Vinnie Jabalpur Salon</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
    <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/switches.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">

    <style type="text/css">
        .dynamic_row {
          padding: 0px 30px !important;
        }
        .error{
          color: red;
          font-size: 12px;
        }
    </style>
    @yield('stylesheets')
</head>
<body>

  <header>
        <nav class="navbar navbar-expand navbar-light topbar static-top">
          <a href="#" class="logo"><img src="{{asset('assets/images/logo-cstestseries3.png')}}" ><!-- CHINNIE & VINNIE JABALPUR SALON --></a>
          <!-- Sidebar Toggle (Topbar) -->
          <button id="menu_icon" class="btn btn-link rounded-circle mr-3 varbtn">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->


          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- <li class="nav-item dropdown no-arrow">
               <form class="d-none d-sm-inline-block form-inline mr-auto mt-3 ml-md-3 my-2 mw-100 navbar-search">
                <div class="input-group">
                  <input type="text" class="form-control bg-default" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                  <div class="input-group-append">
                    <button class="theme-btn" type="button">
                      <i class="fa fa-search fa-sm"></i>
                    </button>
                  </div>
                </div>
              </form>
            </li> -->
            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fa fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>
          </ul>

        </nav>
  </header>


<body>

    <section class="dashboard-section">
        @yield('content')
     </section>



<!-- The Modal -->
    {{-- modals End--}}
  <script src="{{asset('assets/js/jquery.min.js')}}"></script>
  <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
  @yield('script')
</body>
</html>
