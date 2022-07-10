@extends('layouts.newlayout.app')
@section('content')
 <div class="main">
    <div class="main-content">
      <div class="container-fluid">
         <div class="boxbody">
            <div class="row">
                @if (\Session::has('success'))
                <div class="alert alert-success">
                    <ul>
                    <li>{!! \Session::get('success') !!}</li>
                    </ul>
                </div>
                @endif
            </div>

            <ul class="nav nav-tabs2 nav-justified">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#Customer">Customer Segment</a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#Service">Service Segment</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#Upcoming">Upcoming Segment</a>
              </li> -->
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="Customer">
                <form class="formvisit">
                <div class="panelbox">
                  <div class="toptext">Customer segmentation is a slice and dice of your customer database into relevant groups based on their purchases. frequency of visite and spending behaviour. Send targeted offer campaigns that are relevant to your customers to increases repeat business.</div>
                  <div class="text-right mt-2 mb-2"><!-- <a target="_blank" href="{{ url('admin/customer/create') }}" class="theme-btn">New Customer</a> --><a href="javascript:void(0)" data-toggle="modal" data-target="#addcustomer" class="theme-btn">New Customer</a></div>
                  <div class="row">
                    <div class="col-lg-3 col-md-6 col-12">
                      <div class="metric clr-block-1">
                        <h2><?php echo count($customer) ?></h2>
                        <p>Existing Customers</p>
                      </div><!--./metric-->
                    </div><!--/col-lg-3-->

                    <div class="col-lg-3 col-md-6 col-12">
                      <div class="metric clr-block-2">
                        <h2>{{$active_coustomer_count}}</h2>
                        <p>Active Customers</p>
                      </div><!--./metric-->
                    </div><!--/col-lg-3-->

                    <div class="col-lg-3 col-md-6 col-12">
                      <div class="metric clr-block-3">
                        <h2><a target="_blank" href="{{route('All_inactive_Customer',90)}}" class="text-white"> {{$churn_coustomer_count}} </a> </h2>
                        <p>Churm Prediction</p>
                        <span>(Likely to be inactive)</span>
                      </div><!--./metric-->
                    </div><!--/col-lg-3-->

                    <div class="col-lg-3 col-md-6 col-12">
                      <div class="metric clr-block-4">
                        <h2> <a target="_blank" class="text-white" href="{{route('All_inactive_Customer',180)}}"> {{$defected_coustomer_count}} </a> </h2>
                        <p>Defected Customers</p>
                        <span>(Inactive Customers)</span>
                      </div><!--./metric-->
                    </div><!--/col-lg-3-->
                    <div class="col-lg-12 col-md-12 col-12">
                      <h5>Customer Segmentation - Exsiting Customers</h5>
                      <div class="toptext">Exsiting Customers - Customers who have visited your outlet at least once. Click on the customers to view 360<sup>o</sup> customer profile details</div>
                    </div><!--/col-lg-12-->


                     <div class="col-lg-6 col-md-12 col-12">
                        <div class="form-group has-search mt-1">
                          <span class="fa fa-search form-control-feedback"></span>
                          <input type="text" class="form-control" placeholder="Search mobile number/customer id/email id/customer name" id="nameMobileFilter">
                        </div><!--./form-group-->
                     </div><!--/col-lg-6-->

                     <div class="col-lg-2 col-md-12 col-12">
                       <button class="theme-btn mt-1"  type="button" onclick="getCustomerByNameMobile()">Search</button>
                     </div><!--/col-lg-6-->

                      <div class="col-lg-4 col-md-12 col-12">
                       <div class="text-right mt-2 mb-2"><a href="javascript:void(0)" onclick="showFilters()" class="outline-btn"><i class="fa fa-cog"></i> Filter Customer</a>
                       <!-- <a href="javascript:void(0)" data-toggle="modal" data-target="#promosionalModel" class="theme-btn">Send Promotional Offer</a> -->
                       <a href="{{route('downloadAllCustomer')}}" class="theme-btn">Export All</a>
                       </div>
                     </div><!--/col-lg-6-->

                    <div class="col-lg-12 col-md-12 col-12" style="display: none;" id="filterDivider"><div class="divider"></div></div><!--/col-lg-12-->
                    <div class="col-lg-12" style="display: none;" id="filtersDiv">
                      <div class="row">
                        <form id="searchForm" method="post">
                          <div class="col-lg-6 col-md-12 col-12">
                            <div class="form-group">
                              <label>Visit Date</label>
                              <div class="input-group mb-3">
                              <input name="visitFrom" id="visitFrom" type="text" class="form-control datepicker" placeholder="">
                               <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                              </div>
                              <div class="input-group-prepend">
                                <span class="input-group-text">To</span>
                              </div>
                              <input name="visitTo" id="visitTo" type="text" class="form-control datepicker" placeholder="">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                              </div>
                            </div>
                            </div>
                          </div><!--./col-lg-4-->

                          <div class="col-lg-6 col-md-12 col-12">

                            <div class="form-group">
                              <label>Visit Count</label>
                               <div class="input-group mb-3">
                                  <input name="visitCountFrom" id="visitCountFrom" type="text" class="form-control"  placeholder="Number of visits">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">To</span>
                                  </div>
                                  <input name="visitCountTo" id="visitCountTo" type="text" class="form-control" placeholder="Number of visits">
                                </div>
                            </div>
                          </div><!--./col-lg-4-->

                          <!-- <div class="col-lg-4 col-md-12 col-12">
                            <div class="form-group">
                              <label>Advance Filter</label>
                              <select name="searchType" id="searchType" class="form-control selectpicker" multiple data-live-search="true">
                                <option>Male</option>
                                <option>Female</option>
                                <option>Membership</option>
                                <option>Non Membership</option>
                                <option>New Customer</option>
                              </select>
                            </div>
                          </div> --><!--./col-lg-4-->

                          <div class="col-lg-3 col-md-12 col-12">
                            <div class="form-group">
                              <label>Amount Filter</label>
                               <div class="input-group mb-2">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-inr"></i></span>
                              </div>
                              <input name="amountFilter" id="amountFilter" type="text" class="form-control" placeholder="High value customer">
                            </div>
                            </div>
                          </div><!--./col-lg-4-->

                          <div class="col-lg-3 col-md-12 col-12">
                            <div class="form-group">
                              <label>Location</label>
                              <div class="input-group mb-2">
                                <select name="locationfltr" id="locationfltr" type="text" class="form-control" placeholder="High value customer">
                                  <option  value="">Select</option>
                                  @foreach ($location as $loc)
                                  <option value="{{$loc->id}}">{{$loc->name}}</option>

                                  @endforeach
                                </select>
                              </div>
                            </div>
                          </div><!--./col-lg-4-->
                          <div class="col-lg-3 col-md-12 col-12">
                            <div class="form-group">
                              <label>Designation</label>
                               <div class="input-group mb-2">

                              <select name="designationfltr" id="designationfltr" type="text" class="form-control" placeholder="High value customer">
                                <option  value="">Select</option>
                                @foreach ($designation as $loc)
                                <option value="{{$loc->id}}">{{$loc->name}}</option>

                                @endforeach
                              </select>
                            </div>
                            </div>
                          </div><!--./col-lg-4-->
                          <div class="col-lg-3 col-md-12 col-12">
                            <div class="form-group">
                              <label>Mobile</label>
                               <div class="input-group mb-2">

                              <input name="mobileno" id="mobileno" type="number" class="form-control" placeholder="Mobile Number">

                            </div>
                            </div>
                          </div><!--./col-lg-4-->
                          <div class="col-lg-3 col-md-12 col-12">
                            <div class="form-group">
                              <label>Membership</label>
                              <div class="input-group mb-2">
                                <select name="membersysfltr" id="membersysfltr" type="text" class="form-control" onchange="filterMembersysCustomer(this.value)">
                                  <option  value="">Select</option>
                                  @foreach ($Member_Systems as $mem_sys)
                                  <option value="{{$mem_sys->id}}">{{$mem_sys->membership_name}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-3 col-md-12 col-12">
                            <div class="form-group">
                              <label>SittingPack</label>
                              <div class="input-group mb-2">
                                <select name="SittingPackfltr" id="SittingPackfltr" type="text" class="form-control" onchange="filterSitpackCustomer(this.value)">
                                  <option  value="">Select</option>
                                  @foreach ($sittingPacks as $sys_pack)
                                  <option value="{{$sys_pack->id}}">{{$sys_pack->pack_name}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-3 col-md-12 col-12">
                            <div class="form-group">
                              <label>Not Assigned Ref Offer</label>
                              <div class="input-group mb-2">
                                <select name="Ref_ofr_fltr" id="Ref_ofr_fltr" type="text" class="form-control" onchange="filter_Unassigned_ref_offr_Customer(this.value)">
                                  <option  value="">Select</option>
                                  @foreach ($ref_offs as $ref_ofr)
                                  <option value="{{$ref_ofr->id}}">{{$ref_ofr->offer_title}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                          </div>

                          <div class="col-lg-3 col-md-12 col-12">
                            <div class="form-group">
                              <label>Not Assigned Any offer</label>
                              <div class="input-group mb-2">
                                <select name="assign_offer" id="assign_offer" type="text" class="form-control" >
                                  <option  value="">Select</option>
                                  <option value="1">Not assign any ref offer</option>
                                  <option value="2">Assigned offers</option>
                                  <option value="3">Not assign any coupon</option>
                                  <option value="4">Assigned Coupons</option>
                                </select>
                              </div>
                            </div>
                          </div>

                          <div class="col-lg-3 col-md-12 col-12">
                            <div class="form-group">
                              <label style="visibility: hidden;display: block;">-</label>
                              <button onclick="filterCustomer()" type="button" class="theme-btn">Search</button>

                            </div>
                          </div><!--./col-lg-4-->
                        </form>
                      </div><!--/row-->
                    </div><!--./col-lg-6-->

                     <div class="col-lg-12 col-md-12 col-12"><div class="divider"></div></div><!--/col-lg-12-->
                     <div class="col-lg-8 col-md-12 col-12">
                       <div class="filtername">
                         <p class="mb-0"><b>Name filter by:</b></p>
                         <ul class="filterlist">
                           <li><a href="javascript:void(0)" onclick="getCustomerByLatter('A')">A</a></li>
                           <li><a href="javascript:void(0)" onclick="getCustomerByLatter('B')">B</a></li>
                           <li><a href="javascript:void(0)" onclick="getCustomerByLatter('C')">C</a></li>
                           <li><a href="javascript:void(0)" onclick="getCustomerByLatter('D')">D</a></li>
                           <li><a href="javascript:void(0)" onclick="getCustomerByLatter('E')">E</a></li>
                           <li><a href="javascript:void(0)" onclick="getCustomerByLatter('F')">F</a></li>
                           <li><a href="javascript:void(0)" onclick="getCustomerByLatter('G')">G</a></li>
                           <li><a href="javascript:void(0)" onclick="getCustomerByLatter('H')">H</a></li>
                           <li><a href="javascript:void(0)" onclick="getCustomerByLatter('I')">I</a></li>
                           <li><a href="javascript:void(0)" onclick="getCustomerByLatter('J')">J</a></li>
                           <li><a href="javascript:void(0)" onclick="getCustomerByLatter('K')">K</a></li>
                           <li><a href="javascript:void(0)" onclick="getCustomerByLatter('L')">L</a></li>
                           <li><a href="javascript:void(0)" onclick="getCustomerByLatter('M')">M</a></li>
                           <li><a href="javascript:void(0)" onclick="getCustomerByLatter('N')">N</a></li>
                           <li><a href="javascript:void(0)" onclick="getCustomerByLatter('O')">O</a></li>
                           <li><a href="javascript:void(0)" onclick="getCustomerByLatter('P')">P</a></li>
                           <li><a href="javascript:void(0)" onclick="getCustomerByLatter('Q')">Q</a></li>
                           <li><a href="javascript:void(0)" onclick="getCustomerByLatter('R')">R</a></li>
                           <li><a href="javascript:void(0)" onclick="getCustomerByLatter('S')">S</a></li>
                           <li><a href="javascript:void(0)" onclick="getCustomerByLatter('T')">T</a></li>
                           <li><a href="javascript:void(0)" onclick="getCustomerByLatter('U')">U</a></li>
                           <li><a href="javascript:void(0)" onclick="getCustomerByLatter('V')">V</a></li>
                           <li><a href="javascript:void(0)" onclick="getCustomerByLatter('W')">W</a></li>
                           <li><a href="javascript:void(0)" onclick="getCustomerByLatter('X')">X</a></li>
                           <li><a href="javascript:void(0)" onclick="getCustomerByLatter('Y')">Y</a></li>
                           <li><a href="javascript:void(0)" onclick="getCustomerByLatter('Z')">Z</a></li>
                           <li><a href="javascript:void(0)" onclick="getCustomerByLatter('All')">All</a></li>
                         </ul>
                       </div><!--./filtername-->
                     </div><!--/col-lg-6-->
                     <!-- <div class="col-lg-4 col-md-12 col-12">
                        <div class="text-right mt-2 mb-2"><a href="#" class="theme-btn">Download cusomer database</a></div>
                     </div> --><!--/col-lg-4-->

                   <div class="col-lg-12 col-md-12 col-12 mt-3">
                     <h6><i class="fa fa-tasks"></i> Customer Count <span id="customerCount"><?php echo count($customer) ?></span>
                     <button type="button" class="theme-btn ml-2" onclick="export_excel()">Filtered Excel</button>
                     <button type="button" class="theme-btn ml-2" onclick="import_excel()">Import excel for coupon</button>
                     <button type="button" class="theme-btn ml-2" onclick="assign_ref_offerToSelectedCust()">Assign Ref Offer</button>
                     <button type="button" class="theme-btn ml-2" onclick="assignCoupon()">Assign Coupon</button>
                     <button type="button" class="theme-btn ml-2" onclick="export_assigned_coupons()">Export Assigned Coupons</button>
                     <button type="button" class="theme-btn ml-2" onclick="export_assigned_ref()">Export Assigned Ref</button>
                     </h6>
                      <div class="table-responsive">
                        <table class="table table-bordered table-striped recent-purchases-listing" id="customer_data_Table">
                          <thead>
                            <tr>
                                <th>Customer Name & ID</th>
                                <th>Email Id & Mobile</th>
                                <th>Purchase Value</th>
                                <th>Avg Value</th>
                                <th>Visit Count</th>
                                <th>Last Visited Date</th>
                                <th>Coupons</th>
                                <th>Referrel offer</th>
                                <th>Gift Points</th>
                                <th>Wallet Amt</th>
                                <th>
                                  <div class="form-group form-check">
                                    <input class="form-check-input selectall" type="checkbox"> Select All
                                    <i id="btn_delete" class="fa fa-trash-o"></i>
                                  </div>
                                </th>
                                <th style="width:180px">Action</th>
                            </tr>
                          </thead>
                          <tbody id="customerTableBody">
                            <?php if (!empty($customer)): ?>
                              <?php foreach ($customer as $value): ?>
                                <tr>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->email }} <br> {{ $value->contact }}</td>
                                    <td>{{ $value->total_revenue }}</td>
                                    <td>{{ $value->avg_revenue }}</td>
                                    <td> <a target="_blank" href="{{route('cust_all_invoices',$value->id)}}"> {{ $value->total_visit }} </a> </td>
                                    <td>@if($value->last_visit_date!=0){{ date('d-M-Y',strtotime($value->last_visit_date)) }} @else --- @endif</td>
                                    <td><a onclick="showcustcoupons({{$value->id}})" href="javascript:void(0)">Show Coupons</a></td>
                                    <td><a onclick="showcust_referrel_offer({{$value->id}},{{ $value->contact }})" href="javascript:void(0)">Show Referrel offer</a></td>
                                    <td>
                                        @if($value->sum_of_points)
                                        <a href="{{route('getpointsofCustomer',$value->id)}}">{{$value->sum_of_points}}</a>
                                        @else
                                        0
                                        @endif
                                    </td>
                                    <td>
                                    <?php
                                          $getWallet = DB::table('customers AS C')
                                          ->addSelect(DB::raw('SUM(amount_allow-amount_used) AS sum_of_wallet'))
                                          ->leftJoin('customer_wallet AS CW', 'CW.customer_id', '=', 'C.id')
                                          ->where('C.id', $value->id)->first();
                                          $cust_Wallet = json_encode($getWallet->sum_of_wallet);
                                          // echo $cust_Wallet;
                                    ?>
                                        @if($cust_Wallet!='null')
                                        <a href="{{route('getwalletofCustomer',$value->id)}}">{{$cust_Wallet}}</a>
                                        @else
                                        0
                                        @endif
                                    </td>
                                    <td>
                                      <div class="form-group form-check">
                                        <input name="customer_id[]" class="form-check-input deletecheckbox" type="checkbox" value="{{ $value->id }}">
                                      </div>
                                    </td>
                                    <td>
                                      <div class="form-group form-check">
                                        <button type="button" class="theme-btn mb-1" onclick="get_cust_data({{$value->contact}})" style="padding: 6px 9px 5px 9px"><i class="fa fa-pencil-square-o"></i></button>
                                        <a class="theme-btn mt-1" href="{{route('cust_all_invoices',$value->id)}}" style="padding: 6px 9px 5px 9px">All Invoice</a>
                                      </div>
                                    </td>
                                </tr>
                              <?php endforeach?>
                            <?php endif?>
                          </tbody>
                        </table>
                        <div id="pagination">
                        {!! $customer->links() !!}
                        </div>
                      </div>
                   </div><!--/col-lg-12-->
                  </div><!--./row-->

                </div><!--./panelbox-->
               </form>
              </div><!--./Customer-->
              <div class="tab-pane fade" id="Service">
                <div class="panelbox">
                  <h5>Service Segment</h5>
                </div><!--./panelbox-->
              </div><!--./Service-->
              <div class="tab-pane fade" id="Upcoming">
                 <div class="panelbox">
                  <h5>Upcoming Segment</h5>
                </div><!--./panelbox-->
              </div><!--./Upcoming-->
            </div><!--./tab-content-->
         </div><!--./boxbody-->
       </div><!--./container-fluid-->
      <footer>Copyright © 2020 Chinnie & Vinnie Jabalpur Salon. All rights reserved.</footer>
     </div><!--./main-content-->

   </div><!--./main-->
    <!-- The Modal -->
    <div class="modal" id="addcustomer">
      <div class="modal-dialog modal-lg">
        <form action="{{ route('customer.store') }}" id="addcustomerform" method="post" enctype="multipart/form-data">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Customer</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
            <!-- Modal body -->
            <div class="modal-body formvisit">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label" for="image">User Image <span class="required">*</span> </label>
                      <input type="file"  name="image" id="image">
                      <span class="text text-danger" id="error_image"> @if ($errors->has('image')){{ $errors->first('image') }} @endif</span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label" for="customer_id">User Id <span class="required">*</span> </label>
                      <input type="text"  id="customer_id" name="customer_id" value="{{ old('customer_id',$last_id) }}" placeholder="Enter User Id"  class="form-control" autocomplete="off" readonly="true">
                      <span class="text text-danger"> @if ($errors->has('customer_id')){{ $errors->first('customer_id') }} @endif</span>
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
                      <span class="text text-danger" id="error_cust_type"> @if ($errors->has('cust_type')){{ $errors->first('cust_type') }} @endif</span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label" for="name">Name <span class="required">*</span> </label>
                      <input type="text"  id="name" name="name" value="{{ old('name') }}" placeholder="Enter name"  class="form-control" autocomplete="off">
                      <span class="text text-danger" id="error_name"> @if ($errors->has('name')){{ $errors->first('name') }} @endif</span>
                  </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label" for="name">Location <span class="required"></label>
                        <select type="text"  id="location" name="location" value="{{ old('location') }}" placeholder="Enter location"  class="form-control" autocomplete="off">
                             <option value="">Select Location</option>
                             @if(isset($location))
                             @foreach ($location as $loc)
                              <option value="{{ $loc->id }}">{{ $loc->name }}</option>
                             @endforeach
                             @endif
                        </select>
                        <span class="text text-danger" id="error_location"> @if ($errors->has('location')){{ $errors->first('location') }} @endif</span>
                    </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label" for="contact">Contact <span class="required">*</span> </label>
                      <input type="number"  id="contact" name="contact" value="{{ old('contact') }}" placeholder="Enter contact"  class="form-control" autocomplete="off">
                      <span class="text text-danger" id="error_contact"> @if ($errors->has('contact')){{ $errors->first('contact') }} @endif</span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label" for="contact">OTP <span class="required">*</span> </label>
                      <input type="number"  id="otp" name="otp" value="{{ old('otp') }}" placeholder="Enter OTP"  class="form-control" autocomplete="off">

                      <span class="text text-danger" id="error_otp"> @if ($errors->has('otp')){{ $errors->first('otp') }} @endif</span>
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
                      <span class="text text-danger" id="error_dob"> @if ($errors->has('dob')){{ $errors->first('dob') }} @endif</span>
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
                      <span class="text text-danger" id="error_gender"> @if ($errors->has('gender')){{ $errors->first('gender') }} @endif</span>
                  </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label" for="referral_code">Designation</label>
                        <select type="text"  id="designation" name="designation" value="" placeholder="Enter designation"  class="form-control" autocomplete="off">
                            @if(isset($designation))
                             @foreach ($designation as $des)
                              <option value="{{ $des->id }}">{{ $des->name }}</option>
                             @endforeach
                             @endif
                        </select>
                        <span class="text text-danger"> @if ($errors->has('designation')){{ $errors->first('designation') }} @endif</span>
                    </div>
                </div>


                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label" for="referral_code">Referral Code  </label>
                      <input type="text"  id="referral_code" name="referral_code" value="{{ old('referral_code',$last_id) }}" placeholder="Enter referral code"  class="form-control" autocomplete="off">
                      <span class="text text-danger" id="error_referral_code"> @if ($errors->has('referral_code')){{ $errors->first('referral_code') }} @endif</span>
                  </div>
                </div>
                @if($message=Session::get('referred_by'))
                  {{$message}}
                @endif
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label" for="referred_by">Referred By  </label>
                      <input type="text"  id="referred_by" name="referred_by" value="{{ old('referred_by') }}" placeholder="Enter Referred By"  class="form-control" autocomplete="off">
                      <span class="text text-danger"> @if ($errors->has('referred_by')){{ $errors->first('referred_by') }} @endif</span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label" for="reward_points">Reward Points  </label>
                      <input type="text"  id="reward_points" name="reward_points" value="{{ old('reward_points') }}" placeholder="Enter reward points"  class="form-control" autocomplete="off">
                      <span class="text text-danger"> @if ($errors->has('reward_points')){{ $errors->first('reward_points') }} @endif</span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label" for="anniversary_date">Anniversary Date</label>
                      <input type="text"  id="anniversary_date" name="anniversary_date" value="{{ old('anniversary_date') }}" placeholder="Enter anniversary date"  class="form-control datepicker" data-date-format="yyyy-mm-dd" autocomplete="off">
                      <span class="text text-danger"> @if ($errors->has('anniversary_date')){{ $errors->first('anniversary_date') }} @endif</span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label" for="rf_id">RF-ID Code <span class="required">*</span> </label>
                      <input type="text"  id="rf_id" name="rf_id" value="{{ old('rf_id',$last_id) }}" placeholder="Enter rf id"  class="form-control" autocomplete="off">
                      <span class="text text-danger" id="error_rf_id">@if ($errors->has('rf_id')){{ $errors->first('rf_id') }} @endif</span>
                      <input type="hidden" required id="otps" name="otps" value="">
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
            </div>
            <div class="modal-footer">
               <button type="button" class="outline-btn" data-dismiss="modal">Cancel</button>
               <button class="btn btn-danger" id="otpbtn"  type="button" onclick="sendotp()">Get OTP</button>
               <button style="display:none;" type="button" onclick="save_customer();" id="customersavebtn" class="theme-btn">Save</button>
            </div>
          </div>
        </form>
      </div>
    </div><!--#/addcustomer-->

    <!-- The Modal -->
    <div class="modal" id="promosionalModel">
      <div class="modal-dialog modal-lg">
        <form action="" id="pushsmsform" method="post" enctype="multipart/form-data">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Promotional Offer</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
            <!-- Modal body -->
            <div class="modal-body formvisit">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label" for="name">Existing Customers</label>
                      <input type="text" readonly value="<?php echo count($customer) ?>" placeholder=""  class="form-control" autocomplete="off">
                      <span class="text text-danger"> @if ($errors->has('name')){{ $errors->first('name') }} @endif</span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label" for="name">Offer Title <span class="required">*</span> </label>
                      <input type="text"  id="offer_title" name="offer_title" value="" placeholder="Offer Title"  class="form-control" autocomplete="off">
                      <span class="text text-danger"> @if ($errors->has('name')){{ $errors->first('name') }} @endif</span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label" for="remark">Offer Message</label>
                    <textarea id="offer_sms" name="offer_sms" placeholder="Offer Message"  class="form-control">{{ old('remark') }}</textarea>
                    <span class="text text-danger"> @if ($errors->has('remark')){{ $errors->first('remark') }} @endif</span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label" for="remark">Offer End Date</label>
                    <input type="text"  id="end_date" name="end_date" value="{{ old('name') }}" placeholder="Offer End Date"  class="form-control datepicker" autocomplete="off">
                    <span class="text text-danger"> @if ($errors->has('remark')){{ $errors->first('remark') }} @endif</span>
                  </div>
                </div>
              </div><!--./row-->
            </div>
            <div class="modal-footer">
              <button type="button" class="outline-btn" data-dismiss="modal">Cancel</button>
              <button type="submit" id="customerformbtn" class="theme-btn">Send</button>
            </div>
          </div>
        </form>
      </div>
    </div><!--#/addcustomer-->


    <!-- The Modal -->
    <div class="modal" id="getcoupon">
      <div class="modal-dialog modal-lg">
        <form id="getcouponform">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Available Coupons</h4>
              <a onclick="addcust_coupon()" class="theme-btn ml-5" href="javascript:void(0)"><i class="fa fa-plus"></i>Assign new</a>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
            <input type = "hidden" name = "getcouponcust_id" id="getcouponcust_id">
            <!-- Modal body -->
            <div class="modal-body formvisit">
              <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                      <th class="th-sm">Sr</th>
                      <th class="th-sm">Name</th>
                      <!-- <th class="th-sm">Price</th> -->
                      <th class="th-sm">Code</th>
                      <th class="th-sm">Start Date</th>
                      <th class="th-sm">End Date</th>
                      <th class="th-sm">Action</th>
                    </thead>
                    <tbody id="customer_coupon_body">
                        <tr>
                            <td></td>
                            <td></td>
                            <!-- <td></td> -->
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
              </table>
            </div>
            <div class="modal-footer">
              <!-- <button type="button" class="outline-btn" data-dismiss="modal">Cancel</button>  -->
              <button type="button" class="theme-btn" data-dismiss="modal">OK</button>
            </div>
          </div>
        </form>
      </div>
    </div><!--#/addcustomer-->


    <div class="modal" id="getassignedoffer">
      <div class="modal-dialog modal-lg">
        <form id="get_assigned_offer_form">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Available Referrel offer</h4>
              <!-- <a onclick="addcust_coupon()" class="theme-btn ml-5" href="javascript:void(0)"><i class="fa fa-plus"></i>Assign new</a> -->
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
            <input type = "hidden" name = "get_referrel_offer_cust_id" id="get_referrel_offer_cust_id">
            <!-- Modal body -->
            <div class="modal-body formvisit">
              <div id="send_sms_res"></div>
              <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                      <th class="th-sm">Sr</th>
                      <th class="th-sm">Name</th>
                      <th class="th-sm">Price</th>
                      <th class="th-sm">Code</th>
                      <th class="th-sm">Start Date</th>
                      <th class="th-sm">End Date</th>
                      <th class="th-sm">Action</th>
                    </thead>
                    <tbody id="customer_referrel_offer_body">
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
              </table>
            </div>
            <div class="modal-footer">
              <!-- <button type="button" class="outline-btn" data-dismiss="modal">Cancel</button>  -->
              <button type="button" class="theme-btn" data-dismiss="modal">OK</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- The Modal -->
    <div class="modal" id="addcustcoupon">
      <div class="modal-dialog modal-md">
        <form id="addonecustcouponform">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Coupon to customer</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- <input type = "hidden" name = "_token" value = "<?php //echo csrf_token(); ?>"> -->
            <!-- Modal body -->
            <div class="modal-body formvisit">
              <div class="row">
                <div class="col-lg-8 col-md-12 col-12">

                    <label>Coupon Name</label>
                    <select name="coupon_name" id="new_coupon_id" class="form-control" required>
                    <option value="0">Select Coupon</option>
                      @foreach($coupons as $coupon)
                      <option value="{{$coupon->id}}">{{$coupon->coupon_title}}</option>
                      @endforeach
                    </select>

                </div><!--./col-lg-4-->
              </div><!--./row-->
            </div>
            <div class="modal-footer">
              <button type="button" class="outline-btn" data-dismiss="modal">Cancel</button>
              <button type="button" class="theme-btn" onclick="AssignCouponToCust()">Assign</button>
            </div>
          </div>
        </form>
      </div>
    </div><!--#/addcustomer-->

     <!-- The Modal -->
     <div class="modal" id="all_coupon_assign">
      <div class="modal-dialog modal-md">
        <form id="addmulticustcouponform">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Coupon to selected customers</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- <input type = "hidden" name = "_token" value = "<?php //echo csrf_token(); ?>"> -->
            <!-- Modal body -->
            <div class="modal-body formvisit">
              <div class="row">
                <div class="col-lg-8 col-md-12 col-12">

                    <label>Coupon Name</label>
                    <select name="coupon_name" id="multi_coupon_id" class="form-control" required>
                    <option value="0">Select Coupon</option>
                      @foreach($coupons as $coupon)
                      <option value="{{$coupon->id}}">{{$coupon->coupon_title}}</option>
                      @endforeach
                    </select>

                </div><!--./col-lg-4-->
              </div><!--./row-->
            </div>
            <div class="modal-footer">
              <button type="button" class="outline-btn" data-dismiss="modal">Cancel</button>
              <button type="button" class="theme-btn" onclick="AssignCouponToSelectedCust()">Assign</button>
            </div>
          </div>
        </form>
      </div>
    </div><!--#/addcustomer-->

    <!-- The Modal -->
    <div class="modal" id="all_coupon_list" >
        <div class="modal-dialog modal-md">
          <form id="addmulticustcouponform">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Select coupon to export</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- <input type = "hidden" name = "_token" value = "<?php //echo csrf_token(); ?>"> -->
              <!-- Modal body -->
              <div class="modal-body formvisit">
                  <form></form>
                <form method="post" action="{{route('downloadAssignedCouponCustExcelFile')}}">
                    @csrf
                        <div class="row">
                        <div class="col-lg-8 col-md-12 col-12">

                            <label>Coupon Name</label>
                            <select name="coupon_name[]" id="multi_coupon_id" class="form-control" multiple="true" required>
                            <option value="all">Select All</option>
                                @foreach($coupons as $coupon)
                                <option value="{{$coupon->id}}">{{$coupon->coupon_title}}</option>
                                @endforeach
                            </select>

                        </div><!--./col-lg-4-->
                        </div><!--./row-->

                        <div class="row">
                            <div class="col-lg-8 col-md-12 col-12">
                                <button type="submit" class="theme-btn" >Export</button>
                            </div><!--./col-lg-4-->
                        </div><!--./row-->
                </form>

              </div>

            </div>
          </form>
        </div>
      </div><!--#/addcustomer-->

        <!-- The Modal -->
    <div class="modal" id="all_ref_list" >
        <div class="modal-dialog modal-md">
          <form id="addmulticustcouponform">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Select offer to export</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- <input type = "hidden" name = "_token" value = "<?php //echo csrf_token(); ?>"> -->
              <!-- Modal body -->
              <div class="modal-body formvisit">
                  <form></form>
                <form method="post" action="{{route('downloadAssignedrefCustExcelFile')}}">
                    @csrf
                        <div class="row">
                        <div class="col-lg-8 col-md-12 col-12">

                            <label>Offers Name</label>
                            <select name="offer_name[]" id="multi_offer_id" class="form-control" multiple="true" required>
                            <option value="all">Select All</option>
                                    @foreach($ref_offs as $ref_off)
                                    <option value="{{$ref_off->id}}">{{$ref_off->offer_title}}</option>
                                    @endforeach
                            </select>

                        </div><!--./col-lg-4-->
                        </div><!--./row-->

                        <div class="row">
                            <div class="col-lg-8 col-md-12 col-12">
                                <button type="submit" class="theme-btn" >Export</button>
                            </div><!--./col-lg-4-->
                        </div><!--./row-->
                </form>

              </div>

            </div>
          </form>
        </div>
      </div><!--#/addcustomer-->


    <!-- The Modal -->
    <div class="modal" id="all_ref_offer_assign">
      <div class="modal-dialog modal-md">
        <form id="addmulticustcouponform">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Refferal Offer to selected customers</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- <input type = "hidden" name = "_token" value = "<?php //echo csrf_token(); ?>"> -->
            <!-- Modal body -->
            <div class="modal-body formvisit">
              <div class="row">
                <div class="col-lg-8 col-md-12 col-12">

                    <label>Refferal Offer Name</label>
                    <select name="ref_off_name" id="multi_ref_off_id" class="form-control" required>
                    <option value="0">Select Refferal Offer</option>
                      @foreach($ref_offs as $ref_off)
                      <option value="{{$ref_off->id}}">{{$ref_off->offer_title}}</option>
                      @endforeach
                    </select>

                </div><!--./col-lg-4-->
              </div><!--./row-->
            </div>
            <div class="modal-footer">
              <button type="button" class="outline-btn" data-dismiss="modal">Cancel</button>
              <button type="button" class="theme-btn" onclick="AssignRefOfferToSelectedCust()">Assign Refferal Offer</button>
            </div>
          </div>
        </form>
      </div>
    </div><!--#/addcustomer-->

      <!-- The Modal -->
      <div class="modal" id="import_cust_for_coupon">
      <div class="modal-dialog modal-md">
        <form id="addimportcustcouponform" enctype="multipart/form-data" >
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Import Excel to Assign coupon</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <meta name="_token" content="{{ csrf_token() }}" />
            <!-- Modal body -->
            <div class="modal-body formvisit">
              <div class="row">
                <div class="col-lg-10 col-md-12 col-12">
                    <label>Coupon Name</label>
                    <select name="coupon_name" id="import_coupon_id" class="form-control" required>
                    <option value="0">Select Coupon</option>
                      @foreach($coupons as $coupon)
                      <option value="{{$coupon->id}}">{{$coupon->coupon_title}}</option>
                      @endforeach
                    </select>
                </div><!--./col-lg-4-->
                <div class="col-lg-10 col-md-12 col-12">
                    <label>Select Excel</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="ImportCustFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>
              </div><!--./row-->
            </div>
            <div class="modal-footer">
              <button type="button" class="outline-btn" data-dismiss="modal">Cancel</button>
              <button type="submit" class="theme-btn">Assign</button>
            </div>
          </div>
        </form>
      </div>
    </div><!--#/addcustomer-->


    <script src="{{asset('assets/js/lib/jquery.js')}}"></script>
    <script src="{{asset('assets/js/dist/jquery.validate.js')}}"></script>
    <script type="text/javascript">

      $("#pushsmsform").validate({
        rules:{
          offer_title: "required",
          offer_sms: "required",
          end_date: "required",
        },
        messages:{
          offer_title: "Enter offer title",
          offer_sms: "Enter offer message",
          end_date: "Enter offer end date",
        },
        submitHandler:function() {
          var formdata = $("#pushsmsform").serialize();
          $.ajax({
            url:"{{ url('pushsms') }}",
            data:formdata,
            type:"POST",
            success:function(res) {
              if (res == 'Done') {
                $("#promosionalModel").modal('hide');
                $("#pushsmsform")[0].reset();
              }
            }
          });
        }
      });
      function submitForm() {
        alert("hii")

      }
      $("#addcustomerform").validate({
        rules:{
          image: "required",
          cust_type: "required",
          name: "required",
          otps: "required",
          location: "required",
          contact: "required"
          dob: "required",
          gender: "required",
          referral_code: "required",
          rf_id: "required",
        },
        messages:{
          image: "Image required",
          cust_type: "Select customer type",
          name: "Enter name",
          otp: "please verfiy your number first",
          location: "Enter location",
          contact: "Enter contact number",
          referral_code: "Enter referral code",
          rf_id: "Enter rf id",
        },
        submitHandler: function() {
         // var validator = $(".js-validation").validate();
            var number =  $("#contact").val();
            var otp =  $("#otp").val();
            var dataString = 'otp='+otp+'&number='+number;
          $.ajax({
                url:'{{ url("checkvalid") }}',
                data:dataString,
                type:'POST',
                cache : false,
                dataType : JSON
                success:function(res) {
                if(res=='yes'){
                    $("#addcustomerform").submit();}
                else{
                    alert('OTP Not match !');
                }

                }
         });






          //$("#addcustomerform").submit();
          /*$("#customerformbtn").on('click',(function(e){
            // debugger;
            e.preventDefault();
            $.ajax({
              url: "{{ route('customer.store') }}",
              type: "POST",
              data:  $("#addcustomerform").serialize(),
              contentType: false,
              cache: false,
              processData:false,
              success: function(data){
                $("#targetLayer").html(data);
              },
              error: function(){}
            });
          }));*/
          /*var formdata = $("#addpackageform").serialize();
          $.ajax({
            url:'{{ route("packages.store") }}',
            data:formdata,
            type:'POST',
            dataType:"JSON",
            success:function(res) {
              $("#addpackage").modal('hide');
              $("#packageTableBody").html(res.html);
              $("#packageCount").html(res.count);
            },
            error: function (request, status, error) {
                if( request.status === 422 ) {
                    // var errors = $.parseJSON(reject.responseText);
                    alert(request.responseJSON.errors.name);
                    /*$.each(errors, function (key, val) {
                        $("#" + key + "_error").text(val[0]);
                        alert($("#" + key + "_error").text(val[0]))
                    });*/
                /*}
            }
          });*/
          // $(document).on("click", "#addcustomerform", function() {

        },
      });
    </script>
    <script type="text/javascript">
      $(document).ready(function(){

         $('#addcustomer').on('shown.bs.modal', function (e) {
          $('#addcustomerform').trigger("reset");
          $("#customerformbtn").css('display','none');
          });

        $('#btn_delete').click(function(){
          if(confirm("Are you sure you want to delete this?"))
          {
            var id = [];
            $('.deletecheckbox:checkbox:checked').each(function(i){
              id[i] = $(this).val();
            });

            if(id.length === 0) //tell you if the array is empty
            {
              alert("Please Select atleast one checkbox");
            }else{
              $.ajax({
                url:'deleteCustomer',
                method:'POST',
                data:{id:id},
                dataType:'JSON',
                success:function(res)
                {
                    $("#customerTableBody").html(res.html);
                    $("#customerCount").html(res.customerCount);
                }
              });
            }
          }else{
            return false;
          }
        });
      });
      $('.selectall').click(function() {
          if ($(this).is(':checked')) {
              $('div input').attr('checked', true);
          } else {
              $('div input').attr('checked', false);
          }
      });
      function getCustomerByLatter(latter) {
        if (latter != '') {
          $.ajax({
            url:'{{ url("getCustomerByLatter") }}',
            data:{'latter':latter},
            type:'POST',
            dataType:'JSON',
            success:function(res) {
              $("#customerTableBody").html(res.html);
              $("#customerCount").html(res.customerCount);
            }
          });
        }
      }

      function getCustomerByNameMobile() {
        let filter_param=$('#nameMobileFilter').val();

        if (filter_param != '') {
            $("#pagination").hide();
          $.ajax({
            url:'{{ url("getCustomerByNameMobile") }}',
            data:{'filter_param':filter_param, "_token": "{{ csrf_token() }}"},
            type:'POST',
            dataType:'JSON',
            success:function(res) {
              console.log(res);
              $("#customerTableBody").html(res.html);
              $("#customerCount").html(res.customerCount);

            },
            error: function(jqXHR, textStatus, errorThrown) {
              alert('Something went wrong in getCustomerByNameMobile');
              }
          });
        }
        else{
          alert('Please enter name or mobile to filter');
        }
      }

    function get_cust_data(cust_mobile) {
      // alert(cust_mobile);
        if(cust_mobile!=""){
            $.ajax({
            url:'{{ url("checkaccount") }}',
            data:{'number':cust_mobile},
            type:'POST',
            dataType:"JSON",
            success:function(res) {
              if(res != "" && res != null){
                if(res.dob != null){
                  var dateAr = res.dob.split('-');
                  var newDate = dateAr[1] + '/' + dateAr[2] + '/' + dateAr[0];
                }else{
                  var newDate = "";
                }
                if(res.anniversary_date != null){
                  var date = res.anniversary_date.split('-');
                  var newanniversary_date = date[1] + '/' + date[2] + '/' + date[0];
                }else{
                  var newanniversary_date = "";
                }
                $("#editmobile").val(res.contact);
                $("#editname").val(res.name);
                $("#editid").val(res.id);
                $("#editemail").val(res.email);
                $("#editdob").val(newDate);
                $("#editanniversary").val(newanniversary_date);
                $("#editlocation").val(res.location);
                $('#edit_location option[value='+res.location+']').attr('selected','selected');
                $('#edit_designation option[value='+res.designation+']').attr('selected','selected');
                $('#editcustomer').modal('show');
              }
              else{
                alert('No data found');
              }
            },
            error: function(jqXHR, textStatus, errorThrown) {
              alert('Something went wrong in get_cust_data');
              }
          });
        }
        else{
          alert('Customer not selectedd');
        }
      }

      function export_excel() {
        window.location.href = "{{route('downloadCustExcelFile')}}";
      }

      function sendotp() {
       var number =  $("#contact").val();
       var userfor =  'new_cust';
        if (number) {
          if ( number.length == 10  ){
            $.ajax({
                url:'{{ url("sendotp") }}',
                data:{'number':number,'usedfor':userfor},
                type:'POST',
                success:function(res) {
                  //console.log(res);
                  $("#otps").val(res);
                  $("#customersavebtn").css('display','flex');
                  //$("#otpbtn").css('display','none');
                }
              });
          }else{
            alert("Enter Valid Mobile number !");
          }

          }else{
            alert("Enter Mobile number to Verify !");
          }
    }

      function filterCustomer() {
        $("#pagination").hide();
        $("#customerTableBody").html('<tr><td colspan="11" style="text-align:center;">please wait while loading</td></tr>');
        var visitFrom = $("#visitFrom").val();
        var visitTo = $("#visitTo").val();
        var visitCountFrom = $("#visitCountFrom").val();
        var visitCountTo = $("#visitCountTo").val();
        var searchType = $("#searchType").val();
        var amountFilter = $("#amountFilter").val();
        var locationfltr = $("#locationfltr").val();
        var designationfltr = $("#designationfltr").val();
        var assign_offer = $("#assign_offer").val();
        var mobile = $("#mobileno").val();
        $.ajax({
          url:'{{ url("filterCustomer") }}',
          data:{'visitFrom':visitFrom,'visitTo':visitTo,'visitCountFrom':visitCountFrom,'visitCountTo':visitCountTo,'searchType':searchType,'amountFilter':amountFilter,'locationfltr':locationfltr,'designationfltr':designationfltr,'mobile':mobile,'assign_offer':assign_offer},
          type:'POST',
          dataType:'JSON',
          success:function(res) {
            $("#customerTableBody").html(res.html);

          }
        });
      }

      function filterSitpackCustomer(sitpackid) {
        $("#pagination").hide();
        $("#customerTableBody").html('<tr><td colspan="11" style="text-align:center;">please wait while loading</td></tr>');
        if(sitpackid!=""){
            $.ajax({
            url:'{{ url("filterSitpackCustomer") }}',
            data:{'SittingPackfltr':sitpackid,"_token": "{{ csrf_token() }}"},
            type:'POST',
            dataType:'JSON',
            success:function(res) {
              $("#customerTableBody").html(res.html);

            },
            error: function(jqXHR, textStatus, errorThrown) {
              alert('Something went wrong in filterSitpackCustomer');
              }
          });
        }
        else{
          alert('please select package');
        }
      }

      function filter_Unassigned_ref_offr_Customer(ref_ofr_id) {
        $("#customerTableBody").html('<tr><td colspan="11" style="text-align:center;">please wait while loading</td></tr>');
        if(ref_ofr_id!=""){
            $("#pagination").hide();
            $.ajax({
            url:'{{ url("filter_Unassigned_ref_offr_Customer") }}',
            data:{'ref_ofr_fltr':ref_ofr_id,"_token": "{{ csrf_token() }}"},
            type:'POST',
            dataType:'JSON',
            success:function(res) {
              console.log('--------filter_Unassigned_ref_offr_Customer--------');
              console.log(res);
              $("#customerTableBody").html(res.html);

            },
            error: function(jqXHR, textStatus, errorThrown) {
              alert('Something went wrong in filter_Unassigned_ref_offr_Customer');
              }
          });
        }
        else{
          Alert('please select offer');
        }
      }

      function export_assigned_coupons() {
          $('#all_coupon_list').modal('show');
        //window.location.href = "{{route('downloadAssignedCouponCustExcelFile')}}";
      }

      function export_assigned_ref() {
          $('#all_ref_list').modal('show');
        //window.location.href = "{{route('downloadAssignedCouponCustExcelFile')}}";
      }

      function get_cust_sitpack(cust_sitpackid){
        // alert(cust_sitpackid);
        if(cust_sitpackid!=""){
          window.location.href = '{{url("get_filter_details")}}'+'/'+cust_sitpackid;
        }
      }

      function filterMembersysCustomer(membersysid) {
        $("#customerTableBody").html('<tr><td colspan="11" style="text-align:center;">please wait while loading</td></tr>');
        if(membersysid!=""){
            $("#pagination").hide();
            $.ajax({
            url:'{{ url("filterMembersysCustomer") }}',
            data:{'membersysfltr':membersysid,"_token": "{{ csrf_token() }}"},
            type:'POST',
            dataType:'JSON',
            success:function(res) {
              $("#customerTableBody").html(res.html);
            },
            error: function(jqXHR, textStatus, errorThrown) {
              alert('Something went wrong in filterMembersysCustomer');
              }
          });
        }
        else{
          Alert('please select Membersys');
        }
      }

      function get_cust_memsys(cust_memsys_id){
        alert(cust_memsys_id);
      }

      function showFilters() {
        $("#filtersDiv").toggle();
        $("#filterDivider").toggle();
      }

      function addcust_coupon(){
        $('#getcoupon').modal('hide');
        $('#addcustcoupon').modal('show');
      }

      function showcustcoupons(cust_id){
        // alert(cust_id);
        $('#getcouponcust_id').val(cust_id);
        if ( cust_id!="0" ){
          $.ajax({
              url:'{{ url("get_custAllCoupon") }}',
              data:{"_token": "{{ csrf_token() }}",'customer_id':cust_id},
              type:'POST',
              success:function(res) {
                console.log(res);
                var result=(JSON.parse(res));
                if(result.msg==true){
                  $('#customer_coupon_body').html(result.data.html);
                }
                else{
                  $('#customer_coupon_body').html('NO Coupon found');
                }
              $('#getcoupon').modal('show');
              },
              error: function(jqXHR, textStatus, errorThrown) {
              alert('Something went wrong in showcustcoupons');
              }
            });
        }
        else{
              alert('Customer not selected');
            }
      }

      function showcust_referrel_offer(cust_id,cust_no){
        // alert(cust_id);
        $('#get_referrel_offer_cust_id').val(cust_id);
        if ( cust_id!="0" ){
          $.ajax({
              url:'{{ url("get_custAll_referrel_offer") }}',
              data:{"_token": "{{ csrf_token() }}",'customer_id':cust_id,'cust_no':cust_no},
              type:'POST',
              success:function(res) {
                console.log(res);
                var result=(JSON.parse(res));
                if(result.msg==true){
                  $('#customer_referrel_offer_body').html(result.data.html);
                }
                else{
                  $('#customer_referrel_offer_body').html('NO referrel offer found');
                }
                $('#getassignedoffer').modal('show');
              },
              error: function(jqXHR, textStatus, errorThrown) {
              alert('Something went wrong in showcust_referrel_offer');
              }
            });
        }
        else{
              alert('Customer not selected');
            }
      }

      function send_sms_to_customer(offer_id,customer_id){
        if ( customer_id!="0" ){
          $.ajax({
              url:'{{ url("sendoffersmstocustomer") }}',
              data:{"_token": "{{ csrf_token() }}",'offer_id':offer_id,'customer_id':customer_id},
              type:'POST',
              success:function(res) {
                var result=(JSON.parse(res));
                if(result.msg==true){
                  $('#send_sms_res').html('<div class="alert alert-success">'+result.dd+'</div>');
                  setTimeout(function(){  $('#send_sms_res').html(''); }, 1000);
                }
                else{
                  $('#send_sms_res').html('<div class="alert alert-success">SMS not sent</div>');
                }
              },
              error: function(jqXHR, textStatus, errorThrown) {
              alert('Something went wrong in showcust_referrel_offer');
              }
            });
        }
        else{
              alert('Customer not selected');
            }
      }

      function AssignCouponToCust(){
        let coupon_customer_id=$('#getcouponcust_id').val();
        let coupon_id=$('#new_coupon_id').val();
        console.log(coupon_id);
        if ( coupon_id!="0" ){
          $.ajax({
              url:'{{ url("assign_coupon") }}',
              data:{"_token": "{{ csrf_token() }}",'customer_id':coupon_customer_id,'coupon_id':coupon_id},
              type:'POST',
              success:function(res) {
                console.log(res);
                var result=(JSON.parse(res));
                if(result.msg==true){
                  alert('Coupon alloted to customer successfully');
                  $('#addcustcoupon').modal('hide');
                  showcustcoupons(coupon_customer_id);
                }
                else{
                  alert('Coupon not alloted');
                }
              },
              error: function(jqXHR, textStatus, errorThrown) {
              alert('Something went wrong in AssignCouponToCust');
              }
            });
        }
        else{
              alert('Coupon not selected');
            }
        // console.log(coupon_id);
        // alert(coupon_customer_id);
      }

      function assignCoupon()
      {
          let selected_customers = [];
          // let get_customer_list=$("input[name='customer_id[]']").serialize();
          $("input[name='customer_id[]']").each(function() {
            let id_val = this.checked ? this.value : '';
            selected_customers.push(id_val);
            });
            // console.log(selected_customers);
            var filtered = selected_customers.filter(function (el) {
                        return el != '';
                        });
          console.log(filtered);
          if (filtered.length>=1) {
            $('#all_coupon_assign').modal('show');
            localStorage.setItem("filtered", filtered);
          }
          else{
            alert('Please select atleast One customer to assign coupon');
          }
      }

      function AssignCouponToSelectedCust() {
          console.log('------------AssignCouponToSelectedCust-----------');
          let multi_coupon_id= $('#multi_coupon_id').val();
        //   console.log(multi_coupon_id);
          if(multi_coupon_id!="0"){
            var filtered = localStorage.getItem("filtered");
            $.ajax({
              url:'{{ url("assign_coupon_all") }}',
              data:{"_token": "{{ csrf_token() }}",'customer_ids':filtered,'coupon_id':multi_coupon_id},
              type:'POST',
              success:function(res) {
                console.log(res);
                var result=(JSON.parse(res));
                if(result.msg==true){
                  alert('Coupon alloted to customer successfully');
                  $('#all_coupon_assign').modal('hide');
                  localStorage.removeItem("filtered");
                //   showcustcoupons(coupon_customer_id);
                }
                else{
                  alert('Coupon not alloted');
                }
              },
              error: function(jqXHR, textStatus, errorThrown) {
              alert('Something went wrong in AssignCouponToCust');
              }
            });
          }
          else{
              alert('Please select coupon to assign');
          }
      }

      function import_excel(){
          $('#import_cust_for_coupon').modal('show');
      }


    //   addimportcustcouponform
    $("#addimportcustcouponform").on("submit", function(e) {
        e.preventDefault();
        var extension = $('#ImportCustFile').val().split('.').pop().toLowerCase();
        if ($.inArray(extension, ['xls', 'xlsx']) == -1)
            {
                alert('Please Select Excel File... ');
            }
        else
            {
             var import_coupon_id= $('#import_coupon_id').val();
             var file_data = $('#ImportCustFile').prop('files')[0];
             var form_data = new FormData();
             form_data.append('importfile', file_data);
             form_data.append('import_coupon_id', import_coupon_id);
             $.ajaxSetup({ headers: { 'X-CSRF-Token': $('meta[name=_token]').attr('content') } });
             $.ajax({
              url:'{{ url("assign_coupon_toImport") }}',
              data: form_data,
              contentType: false,
              cache: false,
              processData: false,
              type:'POST',
              success:function(res) {
                console.log(res);
                var result=(JSON.parse(res));
                if(result.msg==true){
                  alert('Coupon alloted to customer successfully');
                  $('#import_cust_for_coupon').modal('hide');

                }
                else{
                  alert('Coupon not alloted');
                }
              },
              error: function(jqXHR, textStatus, errorThrown) {
              alert('Something went wrong in AssignCouponToCust');
              }
            });
            }

    });

    function assign_ref_offerToSelectedCust(){
      let selected_cust_for_offr = [];
          // let get_customer_list=$("input[name='customer_id[]']").serialize();
          $("input[name='customer_id[]']").each(function() {
            let id_val = this.checked ? this.value : '';
            selected_cust_for_offr.push(id_val);
            });
            // console.log(selected_cust_for_offr);
            var filtered_cust = selected_cust_for_offr.filter(function (el) {
                        return el != '';
                        });
          console.log(filtered_cust);
          if (filtered_cust.length>=1) {
            $('#all_ref_offer_assign').modal('show');
            localStorage.setItem("filtered_cust", filtered_cust);
          }
          else{
            alert('Please select atleast One customer to assign refferal offer');
          }
    }

    function AssignRefOfferToSelectedCust(){
      console.log('------------AssignRefOfferToSelectedCust-----------');
          let multi_ref_off_id= $('#multi_ref_off_id').val();
          // console.log(multi_ref_off_id);
          if(multi_ref_off_id!="0"){
            var filtered_cust = localStorage.getItem("filtered_cust");
            $.ajax({
              url:'{{ url("assign_ref_offer_all") }}',
              data:{"_token": "{{ csrf_token() }}",'customer_ids':filtered_cust,'ref_off_id':multi_ref_off_id},
              type:'POST',
              success:function(res) {
                console.log(res);
                var result=(JSON.parse(res));
                if(result.msg==true){
                  alert('Ref Offer alloted to customer successfully');
                  $('#all_ref_offer_assign').modal('hide');
                  localStorage.removeItem("filtered_cust");
                //   showcustcoupons(coupon_customer_id);
                }
                else{
                  alert('Ref Offer not alloted');
                }
              },
              error: function(jqXHR, textStatus, errorThrown) {
              alert('Something went wrong in AssignRefOfferToSelectedCust');
              }
            });
          }
          else{
              alert('Please select Ref Offer to assign');
          }
    }


    //   function AssignCouponToImportedCust(){
    //     let import_coupon_id= $('#import_coupon_id').val();
    //     let ImportCustFile= document.querySelector("#ImportCustFile");
    //     if ( /\.(xlsx|xls)$/i.test(ImportCustFile.files[0].name) === false )
    //      {
    //         alert("not an Excel file!");
    //      }
    //      else if(import_coupon_id!="0"){
    //         $.ajax({
    //           url:'{{ url("assign_coupon_toImport") }}',
    //           data:{"_token": "{{ csrf_token() }}",'customer_excel':ImportCustFile,'coupon_id':import_coupon_id},
    //           type:'POST',
    //           success:function(res) {
    //             console.log(res);
    //             var result=(JSON.parse(res));
    //             if(result.msg==true){
    //               alert('Coupon alloted to customer successfully');
    //               $('#import_cust_for_coupon').modal('hide');

    //             }
    //             else{
    //               alert('Coupon not alloted');
    //             }
    //           },
    //           error: function(jqXHR, textStatus, errorThrown) {
    //           alert('Something went wrong in AssignCouponToCust');
    //           }
    //         });
    //      }
    //      else{
    //          alert('Please select coupon');
    //      }
    //   }
    function save_customer(){
        var image = $('#image').val();
        var cust_type = $('#cust_type').val();
        var name = $('#name').val();
        var location = $('#location').val();
        var contact = $('#contact').val();
        var otp = $('#otp').val();
        var dob = $('#dob').val();
        var referral_code = $('#referral_code').val();
        var rf_id = $('#rf_id').val();
        var valid=1;

        if(image==''){
          $('#error_image').html('Please choose image');
          valid = 0;
        }else{
          $('#error_image').html('');
        }

        if(cust_type==''){
          $('#error_cust_type').html('Please choose customer type');
          valid = 0;
        }else{
          $('#error_cust_type').html('');
        }

        if(name==''){
          $('#error_name').html('Please enter name');
          valid = 0;
        }else{
          $('#error_name').html('');
        }


        if(location==''){
          $('#error_location').html('Please choose location');
          valid = 0;
        }else{
          $('#error_location').html('');
        }


        if(contact==''){
          $('#error_contact').html('Please enter contact');
          valid = 0;
        }else{
          $('#error_contact').html('');
        }

        if(otp==''){
          $('#error_otp').html('Please enter otp');
          valid = 0;
        }else{
          $('#error_otp').html('');
        }

        if(dob==''){
          $('#error_dob').html('Please enter dob');
          valid = 0;
        }else{
          $('#error_dob').html('');
        }

        if(referral_code==''){
          $('#error_referral_code').html('Please enter referral_code');
          valid = 0;
        }else{
          $('#error_referral_code').html('');
        }

        if(rf_id==''){
          valid = 0;
          $('#error_referral_id').html('Please enter referral id');
        }else{
          $('#error_referral_id').html('');
        }

        if(valid==1){
            var token = '{{ csrf_token() }}';
            var dataString ='otp='+otp+'&number='+contact+'&_token='+token;
            $.ajax({
            type: "POST",
            url: '{{ url("checkvalid") }}',
            data: dataString,
            cache: false,
            dataType: "json",
            success: function(result){
                 if(result.status==1){
                    $("#addcustomerform").submit();
                 }else{
                     if(result.msg=='This mobile number already exist'){
                        alert(result.msg);
                         $('#contact').val('');
                         $('#otp').val('');
                         $("#customersavebtn").css('display','none');
                         $("#otpbtn").css('display','flex');
                     }else{
                        alert(result.msg);
                     }
                 }
               }//end sucess
            });//end ajax


        }
      }
   </script>
@endsection
