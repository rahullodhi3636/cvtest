<div class="left-menubox style-scroll">
            @php
              if(Auth::user()->admin == 1){
            @endphp
            <div class="left-menucontainer">
                <ul class="list-unstyled left-menu">
                    <li class="@if(Request::segment(1) == 'home') menu_active @endif">
                        <a href="{{ url('home') }}" class="menu-box">
                            <i class="mdi mdi-monitor-dashboard"></i>
                            <h4>My Dashboard</h4>
                        </a>
                    </li>
                    <li class="@if(Request::segment(2) == 'brand') menu_active @endif">
                        <a href="{{ url('admin/reports')}}" class="menu-box">
                            <i class="mdi mdi-content-cut"></i>
                            <h4>Transaction Report</h4>
                        </a>
                    </li>
                    <li class="@if(Request::segment(2) == 'brand') menu_active @endif">
                        <a href="{{ url('admin/brand')}}" class="menu-box">
                            <i class="mdi mdi-content-cut"></i>
                            <h4>Product Brands</h4>
                        </a>
                    </li>
                    <li class="@if(Request::segment(2) == 'scan') menu_active @endif">
                        <a href="{{ url('admin/firm')}}" class="menu-box">
                            <i class="mdi mdi-content-cut"></i>
                            <h4>Firms</h4>
                        </a>
                    </li>
                    <li class="@if(Request::segment(2) == 'scan') menu_active @endif">
                        <a href="{{ url('admin/scan')}}" class="menu-box">
                            <i class="mdi mdi-content-cut"></i>
                            <h4>QUICK SALE</h4>
                        </a>
                    </li>
                    <!-- <li class="@if(Request::segment(2) == 'scan') menu_active @endif">
                        <a href="{{ url('admin/totalsales')}}" class="menu-box">
                            <i class="mdi mdi-content-cut"></i>
                            <h4>Total Sales</h4>
                        </a>
                    </li> -->
                    <li class="@if(Request::segment(2) == 'sms') menu_active @endif">
                        <a href="{{ url('admin/sms')}}" class="menu-box">
                            <i class="mdi mdi-content-cut"></i>
                            <h4>SMS Management</h4>
                        </a>
                    </li>

                    <li class="@if(Request::segment(2) == 'branches') menu_active @endif">
                        <a href="{{ url('admin/branches')}}" class="menu-box">
                            <i class="mdi mdi-content-cut"></i>
                            <h4>Branches</h4>
                        </a>
                    </li>
                    <li class="@if(Request::segment(2) == 'services') menu_active @endif">
                        <a href="{{ url('admin/services_new')}}" class="menu-box">
                            <i class="mdi mdi-file-document-box-multiple-outline"></i>
                            <h4>Services</h4>
                        </a>
                    </li>
                    <li class="@if(Request::segment(2) == 'enquiry_categories') menu_active @endif">
                        <a href="{{ url('admin/enquiry_categories')}}" class="menu-box">
                            <i class="mdi mdi-account-alert-outline"></i>
                            <h4>Enquiry Categories</h4>
                        </a>
                    </li>
                    <li class="@if(Request::segment(2) == 'enquiry') menu_active @endif">
                        <a href="{{ url('admin/enquiry')}}" class="menu-box">
                            <i class="mdi mdi-account-alert-outline"></i>
                            <h4>Enquiries</h4>
                        </a>
                    </li>
                    <li class="@if(Request::segment(2) == 'packages') menu_active @endif">
                        <a href="{{ url('admin/packages')}}" class="menu-box">
                            <i class="mdi mdi-currency-inr"></i>
                            <h4>Packeges</h4>
                        </a>
                    </li>

                    <li class="@if(Request::segment(2) == 'staff') menu_active @endif">
                        <a href="{{ url('admin/staff')}}" class="menu-box">
                            <i class="mdi mdi-face-agent"></i>
                            <h4>Staff</h4>
                        </a>
                    </li>


                    <li class="@if(Request::segment(2) == 'customer') menu_active @endif">
                        <a href="{{ url('admin/customer')}}" class="menu-box">
                            <i class="mdi mdi-face-agent"></i>
                            <h4>Customers</h4>
                        </a>
                    </li>

                    <li class="@if(Request::segment(2) == 'collection') menu_active @endif">
                        <a href="{{ url('admin/collection')}}" class="menu-box">
                            <i class="mdi mdi-package-variant"></i>
                            <h4>Transactions</h4>
                        </a>
                    </li>
                   <!--  <li class="">
                        <a href="{{ url('admin/packages')}}" class="menu-box">
                            <i class="mdi mdi-account-card-details-outline"></i>
                            <h4>Expenses</h4>
                        </a>
                    </li> -->
                </ul>
            </div>
            @php
              }else{
            @endphp
              <div class="left-menucontainer">
                <ul class="list-unstyled left-menu">
                    <li class="@if(Request::segment(1) == 'home') menu_active @endif">
                        <a href="{{ url('home') }}" class="menu-box">
                            <i class="mdi mdi-monitor-dashboard"></i>
                            <h4>My Dashboard</h4>
                        </a>
                    </li>
                    <!-- <li class="@if(Request::segment(2) == 'scan') menu_active @endif">
                        <a href="{{ url('admin/scan')}}" class="menu-box">
                            <i class="mdi mdi-content-cut"></i>
                            <h4>Scan RFID</h4>
                        </a>
                    </li>
                    <li class="@if(Request::segment(2) == 'sms') menu_active @endif">
                        <a href="{{ url('admin/sms')}}" class="menu-box">
                            <i class="mdi mdi-content-cut"></i>
                            <h4>SMS Management</h4>
                        </a>
                    </li>

                    <li class="@if(Request::segment(2) == 'branches') menu_active @endif">
                        <a href="{{ url('admin/branches')}}" class="menu-box">
                            <i class="mdi mdi-content-cut"></i>
                            <h4>Branches</h4>
                        </a>
                    </li>
                    <li class="@if(Request::segment(2) == 'services') menu_active @endif">
                        <a href="{{ url('admin/services')}}" class="menu-box">
                            <i class="mdi mdi-file-document-box-multiple-outline"></i>
                            <h4>Services</h4>
                        </a>
                    </li>
                    <li class="@if(Request::segment(2) == 'enquiry_categories') menu_active @endif">
                        <a href="{{ url('admin/enquiry_categories')}}" class="menu-box">
                            <i class="mdi mdi-account-alert-outline"></i>
                            <h4>Enquiry Categories</h4>
                        </a>
                    </li>
                    <li class="@if(Request::segment(2) == 'enquiry') menu_active @endif">
                        <a href="{{ url('admin/enquiry')}}" class="menu-box">
                            <i class="mdi mdi-account-alert-outline"></i>
                            <h4>Enquiries</h4>
                        </a>
                    </li>
                    <li class="@if(Request::segment(2) == 'packages') menu_active @endif">
                        <a href="{{ url('admin/packages')}}" class="menu-box">
                            <i class="mdi mdi-currency-inr"></i>
                            <h4>Packeges</h4>
                        </a>
                    </li>

                    <li class="@if(Request::segment(2) == 'staff') menu_active @endif">
                        <a href="{{ url('admin/staff')}}" class="menu-box">
                            <i class="mdi mdi-face-agent"></i>
                            <h4>Staff</h4>
                        </a>
                    </li>


                    <li class="@if(Request::segment(2) == 'customer') menu_active @endif">
                        <a href="{{ url('admin/customer')}}" class="menu-box">
                            <i class="mdi mdi-face-agent"></i>
                            <h4>Customers</h4>
                        </a>
                    </li>

                    <li class="@if(Request::segment(2) == 'collection') menu_active @endif">
                        <a href="{{ url('admin/collection')}}" class="menu-box">
                            <i class="mdi mdi-package-variant"></i>
                            <h4>Transactions</h4>
                        </a>
                    </li> -->
                   <!--  <li class="">
                        <a href="{{ url('admin/packages')}}" class="menu-box">
                            <i class="mdi mdi-account-card-details-outline"></i>
                            <h4>Expenses</h4>
                        </a>
                    </li> -->
                </ul>
            </div>
            @php
            }
            @endphp
</div>        