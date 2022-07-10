@extends('layouts.adminmaster')
@section('title', 'Enquiry')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.0/css/bootstrap-datepicker.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.0/js/bootstrap-datepicker.min.js"></script>

<!-- body -->
<style type="text/css">
  .datepicker{ z-index:99999 !important; }
</style>
        <div class="right-details-box">
            <div class="home_brics_row">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dash_boxcontainner white_boxlist">
                            <div class="upper_basic_heading">
                                <span class="white_dash_head_txt">Customer List <a href="{{route('customer.create')}}" class="btn margin0 btn-sm btn-mdb-color single-table-btn float-right waves-effect waves-light" type="button"><i class="mdi mdi-plus mr-1"></i>Add New Customer
</a> </span>
                                
                            
                            </div>
                            <div class="panel-body dash_table_containner">
                            @if($message=Session::get('success'))
                            <div class="alert alert-success">
                              {{ $message }}
                            </div>
                            @endif
                            <table class="table table-striped table-bordered dtBasicExample" cellspacing="0" width="100%">
                              <thead>
                                <tr>
                                  <th class="th-sm">Image</th>
                                  <th class="th-sm">Name</th>
                                  <th class="th-sm">Contact</th>
                                  <th class="th-sm">Location</th>
                                  <th class="th-sm">Remark</th>
                                  <th class="th-sm">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                              @foreach ($customer as $cat)
                                <tr>
                                  <td>
                                    @if(!empty($cat->customer_image))
                                    <img src="{{ url('images/customer') }}/{{$cat->customer_image}}" width="50px">
                                    @endif
                                  </td>
                                  <td>{{ $cat->name }}</td>s
                                  <td>{{ $cat->contact }}</td>
                                  <td>{{ $cat->location }}</td>
                                  <td>{{ $cat->remark }}</td>
                                 
                                  <td>
                                    <table >
                                      <tr>
                                        <th style="padding: 0">
                                          <a href="javascript:void(0)" onclick="addMember('{{ $cat->id }}')" class="btn-primary btn-sm waves-effect waves-light text-light material-tooltip-main" data-toggle="tooltip" data-html="true" title="Add Sub-members">
                                            <i class="mdi mdi-plus"></i>
                                          </a>
                                          <!-- <a href="" class="btn btn-primary">Edit</a> -->
                                        </th>
                                        <th style="padding: 0">
                                          <a href="{{ route('customer.edit',$cat->id)}}" class="btn-primary btn-sm waves-effect waves-light text-light material-tooltip-main" data-toggle="tooltip" data-html="true" title="Edit">
                                            <i class="mdi mdi-pencil"></i>
                                          </a>
                                          <!-- <a href="" class="btn btn-primary">Edit</a> -->
                                        </th>
                                        <th style="padding: 0">
                                          <form action="{{ route('customer.destroy', $cat->id)}}" method="post">
                                            <input type="hidden" name="_method" value="delete" />
                                            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                                            <button class="btn-danger btn-sm waves-effect waves-light material-tooltip-main" type="submit" style="border:0 !important" data-toggle="tooltip" data-html="true" title="Delete"><i class="mdi mdi-delete"></i></button>
                                          </form>
                                        </th>
                                      </tr>
                                    </table>
                                  </td>
                                </tr>
                                @endforeach
                                
                              
                              </tbody>
                              <!-- <tfoot>
                                <tr>
                                   <th class="th-sm">Name</th>
                                  <th class="th-sm">Contact</th>
                                  <th class="th-sm">Address</th>
                                  <th class="th-sm">Remark</th>
                                  <th class="th-sm">Action</th>
                                  
                                </tr>
                              </tfoot> -->
                            </table>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add member Modal -->
        <div class="modal" id="addsubmember">
          <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background: #000;">
              <!-- Modal Header -->
              <div class="modal-header" style="background: #daba7a; color: #fff; padding: 10px 30px;">
                <h4 class="modal-title" >Add Sub-member</h4>
                <!-- <span class="text-center" style="display: none;" id="msg">Profile Updated</span> -->
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- Modal body -->
              <div class="">
              <form class="editform" id="editform" method="post">
                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                <input type="hidden" name="custid" id="custid" value="">
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="form-group">
                      <label class="control-label" for="cust_type">Customer Type </label>
                          <select name="cust_type" class="form-control">
                              <option value="">--select--</option>
                              <option value="VIP"  {{ old('cust_type') == 'VIP' ? 'selected' : '' }}>VIP</option>
                              <option value="NON VIP"  {{ old('cust_type') == 'NON VIP' ? 'selected' : '' }}>NON VIP</option>
                          </select>
                        <span class="text text-danger"> @if ($errors->has('cust_type')){{ $errors->first('cust_type') }} @endif</span>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="form-group">
                      <label class="control-label" for="name">Name <span class="required">*</span> </label>
                        <input type="text"  id="name" name="name" value="{{ old('name') }}" placeholder="Enter name"  class="form-control" autocomplete="off">
                        <span class="text text-danger"> @if ($errors->has('name')){{ $errors->first('name') }} @endif</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="form-group">
                      <label class="control-label" for="name">Location <span class="required">*</span> </label>
                      <input type="text"  id="location" name="location" value="{{ old('location') }}" placeholder="Enter location"  class="form-control" autocomplete="off">
                      <span class="text text-danger"> @if ($errors->has('location')){{ $errors->first('location') }} @endif</span>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="form-group">
                      <label class="control-label" for="contact">Contact <span class="required">*</span> </label>
                      <input type="text"  id="contact" name="contact" value="{{ old('contact') }}" placeholder="Enter contact"  class="form-control" autocomplete="off">
                      <span class="text text-danger"> @if ($errors->has('contact')){{ $errors->first('contact') }} @endif</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="form-group">
                      <label class="control-label" for="other_contact">Other Contact </label>
                      <input type="text"  id="other_contact" name="other_contact" value="{{ old('other_contact') }}" placeholder="Enter other contact"  class="form-control" autocomplete="off">
                      <span class="text text-danger"> @if ($errors->has('other_contact')){{ $errors->first('other_contact') }} @endif</span>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="form-group">
                      <label class="control-label" for="email">Email </label>
                      <input type="text"  id="email" name="email" value="{{ old('email') }}" placeholder="Enter email"  class="form-control" autocomplete="off">
                      <span class="text text-danger"> @if ($errors->has('email')){{ $errors->first('email') }} @endif</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="form-group">
                      <label class="control-label" for="contact">Dob </label>
                      <input type="text"  id="dob" name="dob" value="{{ old('dob') }}" placeholder="Enter dob"  class="form-control datepicker" data-date-format="yyyy-mm-dd" autocomplete="off">
                      <span class="text text-danger"> @if ($errors->has('dob')){{ $errors->first('dob') }} @endif</span>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="form-group">
                      <label class="control-label" for="referral_code">Referral Code  </label>
                      <input type="text"  id="referral_code" name="referral_code" value="{{ old('referral_code') }}" placeholder="Enter referral code"  class="form-control" autocomplete="off">
                      <span class="text text-danger"> @if ($errors->has('referral_code')){{ $errors->first('referral_code') }} @endif</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="form-group">
                      <label class="control-label" for="referred_by">Referred By  </label>
                      <input type="text"  id="referred_by" name="referred_by" value="{{ old('referred_by') }}" placeholder="Enter Referred By"  class="form-control" autocomplete="off">
                      <span class="text text-danger"> @if ($errors->has('referred_by')){{ $errors->first('referred_by') }} @endif</span>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="form-group">
                      <label class="control-label" for="reward_points">Reward Points  </label>
                      <input type="text"  id="reward_points" name="reward_points" value="{{ old('reward_points') }}" placeholder="Enter reward points"  class="form-control" autocomplete="off">
                      <span class="text text-danger"> @if ($errors->has('reward_points')){{ $errors->first('reward_points') }} @endif</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="form-group">
                      <label class="control-label" for="anniversary_date">Anniversary Date</label>
                      <input type="text"  id="anniversary_date" name="anniversary_date" value="{{ old('anniversary_date') }}" placeholder="Enter anniversary date"  class="form-control datepicker" data-date-format="yyyy-mm-dd" autocomplete="off">
                      <span class="text text-danger"> @if ($errors->has('anniversary_date')){{ $errors->first('anniversary_date') }} @endif</span>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="form-group">
                      <label class="control-label" for="rf_id">RF-ID Code <span class="required">*</span> </label>
                      <input type="text"  id="rf_id" name="rf_id" value="{{ old('rf_id') }}" placeholder="Enter rf id"  class="form-control" autocomplete="off">
                      <span class="text text-danger"> @if ($errors->has('rf_id')){{ $errors->first('rf_id') }} @endif</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="form-group">
                      <label class="control-label" for="remark">Remark</label>
                      <textarea id="remark" name="remark" placeholder="Enter remark"  class="form-control">{{ old('remark') }}</textarea>
                      <span class="text text-danger"> @if ($errors->has('remark')){{ $errors->first('remark') }} @endif</span>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="form-group">
                      <label class="control-label" for="name">Name <span class="required">*</span> </label>
                        <input type="text"  id="name" name="name" value="{{ old('name') }}" placeholder="Enter name"  class="form-control" autocomplete="off">
                        <span class="text text-danger"> @if ($errors->has('name')){{ $errors->first('name') }} @endif</span>
                    </div>
                  </div>
                </div>
                <div id="result"></div>
                <button type="button" onclick="editform()" class="submitbtn">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div><!--./editprofile-->
        <script type="text/javascript">
          function addMember(custid) {
            $("#addsubmember").modal('show');
            $("#custid").val(custid);
          }
          $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
        </script>

@endsection