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
    <link href="{{asset('assets/css/bootstrap-datetimepicker.css')}}" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
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
          {{--
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle addbtn" href="#" id="userDropdown" role="button" onclick="addCustomer()"><span style="background: #917758;
                padding: 7px 20px; display: inline-block;
                border-radius: 30px; color: #fff" >Add <b class="caret"></b></span>
              </a>
            </li> --}}

            <!-- Nav Item - Messages -->
            {{-- <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter">7</span>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Message Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="{{asset('assets/images/photo.jpg')}}" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div class="font-weight-bold">
                    <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                  </div>
                </a>


                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
              </div>
            </li> --}}

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ Auth::user()->name }}
              <img class="img-profile rounded-circle" src="{{asset('assets/images/photo.jpg')}}">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <!-- <a class="dropdown-item" href="#"><i class="fa fa-user mr-2"></i>Change Branch</a>
                <a class="dropdown-item" href="#"><i class="fa fa-cogs mr-2"></i>My Account</a>
                <a class="dropdown-item" href="#"><i class="fa fa-cog mr-2"></i>Support</a>
                <a class="dropdown-item" href="#"><i class="fa fa-list mr-2"></i>GST Details</a> -->
                <div class="dropdown-divider"></div>
                    {{-- <a href="{{url('admin/change_password')}}">
                      <i class="mdi mdi-settings"></i>Change Password
                  </a> --}}
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="fa fa-sign-out mr-2"></i>
                            {{ __('Logout') }}
                </a>

           <form id="logout-form" action="{{ url('/logout') }}" method="POST">
                                           {{ csrf_field() }}
           </form>

              </div>
            </li>

          </ul>

        </nav>
  </header>


<body>
    <div class="wrapper">
        @include('layouts.newlayout.sidebar')
        @yield('content')
    </div>

    {{-- modals Start--}}

    <!-- The Modal -->
    <div class="modal" id="viewUnpaidModel">
      <div class="modal-dialog modal-lg">

        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Unpaid Invoices</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body formvisit">
            <div class="row">
              <table class="table table-bordered">
                <thead>
                  <th>Invoice</th>
                  <th>Date</th>
                  <th>Invoice Amount</th>
                  <th>Outstanding Amount</th>
                  <th>Action</th>
                </thead>
                <tbody id="unpaidTbody">

                </tbody>
              </table>
            </div><!--./row-->
          </div>
          <div class="modal-footer">
            <button type="button" class="outline-btn" data-dismiss="modal">Cancel</button>
            <button type="submit" class="theme-btn">Pay</button>
          </div>
        </div>
      </div>
    </div><!--#/addcustomer-->

    <!-- The Modal -->
    {{-- <div class="modal" id="addcustomer">
      <div class="modal-dialog modal-lg" >
        <form id="addcustomerform" method="post">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Customer</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body formvisit">
              <div class="row">
                <div class="col-lg-4 col-md-12 col-12">
                 <div class="form-group">
                  <label>Mobile Number</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">+91</span>
                    </div>
                    <input type="number" id="addmobile" name="addmobile" class="form-control" placeholder="1234567890">
                  </div>
                </div>
              </div><!--./col-lg-4-->

              <div class="col-lg-4 col-md-12 col-12">
               <div class="form-group">
                <label>Customer Name</label>
                <input type="text" class="form-control" name="addname" id="addname" placeholder="Customer name">
              </div>
            </div><!--./col-lg-4-->

            <div class="col-lg-4 col-md-12 col-12">
             <div class="form-group">
              <label>Customer ID</label>
              <input readonly="" id="addcustid" name="addcustid" type="text" class="form-control" placeholder="">
            </div>
          </div><!--./col-lg-4-->

          <div class="col-lg-4 col-md-12 col-12">
           <div class="form-group">
            <label>Customer Type</label>
            <select id="addcusttype" name="addcusttype" class="form-control">
              <option value="">Select</option>
              <option value="VIP">VIP</option>
              <option value="NON VIP">NON VIP</option>
            </select>
          </div>
        </div><!--./col-lg-4-->

        <div class="col-lg-4 col-md-12 col-12">
         <div class="form-group">
          <label>Email ID</label>
          <input type="text" id="addemail" name="addemail" class="form-control" placeholder="">
        </div>
      </div><!--./col-lg-4-->

      <div class="col-lg-4 col-md-12 col-12">
        <div class="form-group">
          <label>DOB</label>
          <input type="text" id="adddob" name="adddob" class="form-control datepicker" placeholder="">
        </div>
      </div><!--./col-lg-4-->
      <div class="col-lg-4 col-md-12 col-12">
        <div class="form-group">
          <label>Designation</label>
          <input type="text"  id="designation" name="designation" value="" placeholder="Enter designation"  class="form-control" autocomplete="off">
        </div>
      </div><!--./col-lg-4-->

      <div class="col-lg-4 col-md-12 col-12">
        <div class="form-group">
          <label>Gender</label>
          <select class="form-control" name="gender" id="gender">
            <option value="">Select</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
        </div>
      </div><!--./col-lg-4-->

      <div class="col-lg-4 col-md-12 col-12">
        <div class="form-group">
          <label>Aniversary</label>
          <div class="input-group mb-3">
            <input type="text" id="addanniversary" name="addanniversary" class="form-control datepicker" placeholder="">
            <div class="input-group-append">
              <span class="input-group-text"><i class="fa fa-calendar"></i></span>
            </div>
          </div>
          <!-- <input type="text" class="form-control" placeholder=""> -->
        </div>
      </div><!--./col-lg-4-->

      <div class="col-lg-4 col-md-12 col-12">
        <div class="form-group">
          <label>Location</label>
          <input type="text" name="addlocation" id="addlocation" class="form-control" placeholder="">
        </div>
      </div><!--./col-lg-4-->

      <div class="col-lg-4 col-md-12 col-12">
        <div class="form-group">
          <label>Other contact</label>
          <input type="text" name="addothercontact" id="addothercontact" class="form-control" placeholder="">
        </div>
      </div><!--./col-lg-4-->

      <div class="col-lg-6 col-md-12 col-12">
       <div class="form-group">
        <label>Remark</label>
        <textarea class="form-control" placeholder="Remark" name="addRemark" id="addRemark"></textarea>
      </div>
    </div><!--./col-lg-6-->
  </div><!--./row-->
</div>
<div class="modal-footer">
  <button type="button" class="outline-btn" data-dismiss="modal">Cancel</button>
  <button type="submit" class="theme-btn">Save</button>
</div>
</div>
</form>
</div>
</div><!--#/addcustomer--> --}}

<!-- Otp verify model -->
<div class="modal" id="verifyotpModel">
  <div class="modal-dialog modal-lg">
    <form id="verifyOtpForm" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Otp Verify</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
        <!-- Modal body -->
        <div class="modal-body formvisit">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
              <div class="form-group">
                <input type="hidden" name="customerid" id="customerid">
                <label>Verify OTP</label>
                <input type="number" class="form-control" name="otp_verify" id="otp_verify" placeholder="Enter otp">
              </div>
            </div><!--./col-lg-4-->
          </div><!--./row-->
        </div>
        <div class="modal-footer">
          <button type="button" class="outline-btn" data-dismiss="modal">Cancel</button>
          <button type="submit" class="theme-btn">Save</button>
        </div>
      </div>
    </form>
  </div>
</div><!--#/addcustomer-->
<!-- Otp verify model -->



<!-- The Modal -->
<div class="modal" id="editcustomer">
  <div class="modal-dialog modal-lg">
    <form id="editform">
    <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Customer</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body formvisit">
          <div class="row">
            <div class="col-lg-4 col-md-12 col-12">
             <div class="form-group">
              <label>Mobile Number</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">+91</span>
                </div>
                <input type="text" class="form-control" id="editmobile" name="editmobile" placeholder="1234567890">
              </div>
            </div>
          </div><!--./col-lg-4-->

          <div class="col-lg-4 col-md-12 col-12">
           <div class="form-group">
            <label>Customer Name</label>
            <!-- <input type="hidden" name="editcusid" id="editcusid"> -->
            <input type="text" class="form-control" placeholder="Customer name" name="editname" id="editname">
          </div>
        </div><!--./col-lg-4-->

        <div class="col-lg-4 col-md-12 col-12">
          <div class="form-group">
            <label>Customer ID</label>
            <input type="text" readonly="" class="form-control" placeholder="" id="editid" name="editid">
          </div>
        </div><!--./col-lg-4-->

      <div class="col-lg-4 col-md-12 col-12">
       <div class="form-group">
        <label>Email ID</label>
        <input type="text" class="form-control" placeholder="" id="editemail" name="editemail">
      </div>
    </div><!--./col-lg-4-->

    <div class="col-lg-4 col-md-12 col-12">
     <div class="form-group">
      <label>DOB</label>
      <input type="text" class="form-control datepicker" placeholder="" name="editdob" id="editdob">
    </div>
  </div><!--./col-lg-4-->


  <div class="col-md-4">
    <div class="form-group">
      <label class="control-label" for="name">Location <span class="required"></label>
        <select type="text"  id="edit_location" name="editlocation" value="{{ old('location') }}" placeholder="Enter location"  class="form-control" autocomplete="off">
             <option value="">Select Location</option>
             @if(isset($location))
             @foreach ($location as $loc)
              <option value="{{ $loc->id }}">{{ $loc->name }}</option>
             @endforeach
             @endif
        </select>
        <span class="text text-danger"> @if ($errors->has('location')){{ $errors->first('location') }} @endif</span>
    </div>
  </div>



  <div class="col-md-4">
    <div class="form-group">
      <label class="control-label" for="referral_code">Designation</label>
        <select type="text"  id="edit_designation" name="editdesignation" value="" placeholder="Enter designation"  class="form-control" autocomplete="off">
            @if(isset($designation))
             @foreach ($designation as $des)
              <option value="{{ $des->id }}">{{ $des->name }}</option>
             @endforeach
             @endif
        </select>
        <span class="text text-danger"> @if ($errors->has('designation')){{ $errors->first('designation') }} @endif</span>
    </div>
  </div>



  <div class="col-lg-4 col-md-12 col-12">
   <div class="form-group">
    <label>Aniversary</label>
    <div class="input-group mb-3">
      <input type="text" class="form-control datepicker" placeholder="" id="editanniversary" name="editanniversary">
      <div class="input-group-append">
        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
      </div>
    </div>
    <!-- <input type="text" class="form-control" placeholder=""> -->
  </div>
</div><!--./col-lg-4-->
</div><!--./row-->
</div>
<div class="modal-footer">
  <button type="button" class="outline-btn" data-dismiss="modal">Cancel</button>
  <button type="button" class="theme-btn" onclick="update_customer_info()">Save</button>
</div>
</div>
</form>
</div>
</div><!--#/addcustomer-->
    {{-- modals End--}}
  <script src="{{asset('assets/js/jquery.min.js')}}"></script>
  <script src="{{asset('assets/js/popper.min.js')}}"></script>
  <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/js/easing.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/bootstrap-datetimepicker.js')}}"></script>
  <script src="{{asset('assets/js/main.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>


  <script type="text/javascript">
    //  $('.recent-purchases-listing').dataTable({
    //   "aLengthMenu": [
    //     [5, 10, 15, -1],
    //     [5, 10, 15, "All"]
    //   ],
    //   "iDisplayLength": 10,
    //   "language": {
    //     search: ""
    //   },
    //   searching: false, paging: false, info: false
    // });

    function update_customer_info() {
      // document.getElementById("editform").submit();
      var formdata = $("#editform").serialize();
        $.ajax({
          url:'{{ url("updateaccount") }}',
          data:formdata,
          type:'POST',
          dataType:"JSON",
          success:function(res) {
            console.log(res);
            if(res != "" && res != null){
              $("#editcustomer").modal('hide');
              $("#customername").val(res.name);
              $("#customerid").val(res.id);
              filterCustomer();
            }else{
              alert("Failed in updateaccount");
            }
          },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Something went wrong in updateaccount');
              }
        });
    }

    $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
  </script>
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
  <!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
<script type="text/javascript" src="https://jonthornton.github.io/jquery-timepicker/jquery.timepicker.js"></script>
<link rel="stylesheet" type="text/css" href="https://jonthornton.github.io/jquery-timepicker/jquery.timepicker.css">
<!-- <script type="text/javascript" src="https://jonthornton.github.io/jquery-timepicker/lib/bootstrap-datepicker.js"></script> -->
<!-- <link rel="stylesheet" type="text/css" href="https://jonthornton.github.io/jquery-timepicker/lib/bootstrap-datepicker.css"> -->
  @yield('script')
</body>
</html>
