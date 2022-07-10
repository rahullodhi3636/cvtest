@extends('layouts.adminmaster')
@section('title', 'Manage users')
@section('content')

<style type="text/css">
    .remove_relation{
            float: right;
            padding: 5px 10px 5px 10px;
            background: #e42c2c;
            font-weight: bold;
            color: white !important;
            border-radius: 50%;
            cursor: pointer;
    }

    .add_relation{
            float: right;
            padding: 5px 10px 5px 10px;
            background: #2ad9da;
            font-weight: bold;
            color: white !important;
            border-radius: 50%;
            cursor: pointer;
    }
</style>
    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Manage users</h3>
              </div>

            </div>
            <div class="clearfix"></div>
           <!--  @if($errors->count())
             @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
          @endif -->
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Edit <small>users</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li> <a href="{{ route('manageusers.index') }}" title="Back"><i class="fa fa-arrow-left"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    @php
                            
                            $tab = $active_tab;
                            $tab1=$tab2=$tab3=$tab4='';
                            $dtab1=$dtab2=$dtab3=$dtab4='';

                            if($tab=='tab1'){
                               $tab1='active';
                               $dtab1='active in';
                            }elseif($tab=='tab2'){
                               $tab2='active';
                               $dtab2='active in';
                            }elseif($tab=='tab3'){
                               $tab3='active';
                               $dtab3='active in';
                            }elseif($tab=='tab4'){
                               $tab4='active';
                               $dtab4='active in';
                            }else{
                               $tab1='active';
                               $dtab1='active in';
                            }

                        @endphp
                    @if($message=Session::get('success'))
                                                        <div class="alert alert-success">
                                                          <p>{{ $message }}</p>
                                                        </div>
                                                     @endif
                                                      @if($message=Session::get('error'))
                                                        <div class="alert alert-danger">
                                                          <p>{{ $message }}</p>
                                                        </div>
                                                     @endif

                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="{{ $tab1 }}"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Basic Info</a>
                        </li>
                        <li role="presentation" class="{{ $tab2 }}"><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Personal Info</a>
                        </li>
                        <li role="presentation" class="{{ $tab3 }}"><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Dependent Info</a></li>
                        <li role="presentation" class="{{ $tab4 }}"><a href="#tab_content4" role="tab" id="profile-tab3" data-toggle="tab" aria-expanded="false">Company Info</a></li>
                      </ul>
                      <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade {{ $dtab1 }}" id="tab_content1" aria-labelledby="home-tab">
                          <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"  action="{{ url('admin/basic_info') }}" method = "post" enctype="multipart/form-data">
                            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                            <input type="hidden" id="user_id" name="user_id" class="form-control" value="{{$manageusers->id}}" required>


                            <div class="col-md-3 text-center">
                              <div class="">
                                @if($manageusers->image!='')
                                <img src="{{asset('images/users/'.$manageusers->image)}}" class="img-circle" style="width:100px">
                                @else
                                <img src="{{asset('frontend/images/default-pic.png')}}" class="img-circle" style="width:100px">
                                @endif
                                <div class="form-group ">
                                  <input type="file" name="image" class="pull-right"></br></br>
                                  <span class="text text-danger"> @if ($errors->has('image')){{ $errors->first('image') }} @endif</span>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-9">
                              
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label  for="name">First Name <span class="required">*</span></label>
                                    <input type="text"  id="name" name="name" value="{{ old('name',$manageusers->name) }}" class="form-control">
                                    <span class="text text-danger"> @if ($errors->has('name')){{ $errors->first('name') }} @endif</span>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="lname">Last Name <span class="required">*</span></label>
                                    <input type="text"  id="lname" name="lname" value="{{ old('lname',$manageusers->lname) }}"  class="form-control">
                                    <span class="text text-danger"> @if ($errors->has('lname')){{ $errors->first('lname') }} @endif</span>
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label  for="parent_name">Father's/Husband's name <span class="required">*</span></label>
                                    <input type="text"  id="parent_name" name="parent_name" value="{{ old('parent_name',$manageusers->parent_name) }}"  class="form-control">
                                    <span class="text text-danger"> @if ($errors->has('parent_name')){{ $errors->first('parent_name') }} @endif</span>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="email">Email <span class="required">*</span></label>
                                    <input type="text"  id="email" name="email" value="{{ old('email',$manageusers->email) }}" class="form-control">
                                    <span class="text text-danger"> @if ($errors->has('email')){{ $errors->first('email') }} @endif</span>
                                  </div>
                                </div>
                              </div>


                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label  for="phone_no">Phone no.</label>
                                    <input type="text"  id="phone_no" name="phone_no" value="{{ old('phone_no',$manageusers->phone_no) }}" class="form-control">
                                    <span class="text text-danger"> @if ($errors->has('phone_no')){{ $errors->first('phone_no') }} @endif</span>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="mobile_no">Mobile no.<span class="required">*</span></label>
                                    <input type="text"  id="mobile_no" name="mobile_no" value="{{ old('mobile_no',$manageusers->mobile_no) }}"  class="form-control">
                                    <span class="text text-danger"> @if ($errors->has('mobile_no')){{ $errors->first('mobile_no') }} @endif</span>
                                  </div>
                                </div>
                              </div>


                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label  for="dob">Date of birth<span class="required">*</span></label>
                                    <input type="text"  id="dob" name="dob" value="{{ old('dob',$manageusers->dob) }}"  class="form-control datepicker">
                                    <span class="text text-danger"> @if ($errors->has('dob')){{ $errors->first('dob') }} @endif</span>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="aadharcard_number">Aadhar card number<span class="required">*</span></label>
                                    <input type="text"  id="aadharcard_number" name="aadharcard_number" value="{{ old('aadharcard_number',$manageusers->aadharcard_number) }}" class="form-control">
                                    <span class="text text-danger"> @if ($errors->has('aadharcard_number')){{ $errors->first('aadharcard_number') }} @endif</span>
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="aadharcard_number">User Type<span class="required">*</span></label>
                                     <select name="user_type" class="form-control" id="user_type">
                                         <option value="">--select--</option>
                                         <option value="1" {{ old('status',$manageusers->user_type) == '1' ? 'selected' : '' }}>Core-Integra Member</option>
                                         <option value="2" {{ old('status',$manageusers->user_type) == '2' ? 'selected' : '' }}>Core-Integra Sub-Member</option>
                                         <option value="3" {{ old('status',$manageusers->user_type) == '3' ? 'selected' : '' }}>Non Core-Integra member</option>
                                         <option value="0" {{ old('status',$manageusers->user_type) == '0' ? 'selected' : '' }}>Admin</option>
                                     </select>
                                    <span class="text text-danger"> @if ($errors->has('user_type')){{ $errors->first('user_type') }} @endif</span>
                                  </div>
                                </div>
                              </div>


                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label  for="password">Staus<span class="required">*</span></label>
                                    <select name="status" class="form-control" id="status">
                                         <option value="1" {{ old('status',$manageusers->status) == '1' ? 'selected' : '' }} >Active</option>
                                         <option value="0" {{ old('status',$manageusers->status) == '0' ? 'selected' : '' }}>Deactive</option>
                                    </select>
                                    <span class="text text-danger"> @if ($errors->has('status')){{ $errors->first('status') }} @endif</span>
                                  </div>
                                </div>
                              </div>
                              
                              <div class="ln_solid"></div>
                                <div class="form-group">
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <button type="submit" class="btn btn-success">Update</button>
                                  </div>
                                </div>


                            </div>


                          </form>

                        </div>
                        <div role="tabpanel" class="tab-pane fade {{ $dtab2 }}" id="tab_content2" aria-labelledby="profile-tab">
                         <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"  action="{{ url('admin/personal_info') }}" method = "post" enctype="multipart/form-data">
                            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                            <input type="hidden" id="user_id" name="user_id" class="form-control" value="{{$manageusers->id}}" required>
                             <div class="col-md-12">
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label  for="dob">Date of birth<span class="required">*</span></label>
                                    <input type="text"  id="dob" name="dob" value="{{ old('dob',$manageusers->dob) }}"  class="form-control datepicker">
                                    <span class="text text-danger"> @if ($errors->has('dob')){{ $errors->first('dob') }} @endif</span>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                   <div class="form-group">
                                      <label>Gender</label>
                                      <div>
                                        <div id="gender" class="btn-group" data-toggle="buttons">
                                          <label class="btn btn-default {{ ($user_detail->gender=='male') ? 'active focus' : '' }} " data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                            <input type="radio" name="gender" value="male" {{ ($user_detail->gender=='male') ? 'checked' : '' }} > &nbsp; Male &nbsp;
                                          </label>
                                          <label class="btn btn-default {{ ($user_detail->gender=='female') ? 'active focus' : '' }}" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                            <input type="radio" name="gender" value="female" {{ ($user_detail->gender=='female') ? 'checked' : '' }}> Female
                                          </label>

                                           <label class="btn btn-default {{ ($user_detail->gender=='transgender') ? 'active focus' : '' }}" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                            <input type="radio" name="gender" value="transgender" {{ ($user_detail->gender=='transgender') ? 'checked' : '' }}> Transgender
                                          </label>

                                        </div>
                                      </div>
                                    </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-md-6">
                                   <div class="form-group">
                                      <label>Marital Status</label>
                                      <div>
                                        <div class="btn-group" data-toggle="buttons">
                                          <label class="btn btn-default {{ ($user_detail->merital_status==1) ? 'active focus' : '' }}" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                            <input type="radio" name="merital_status" value="1" {{ ($user_detail->merital_status==1) ? 'checked' : '' }}> &nbsp; Married &nbsp;
                                          </label>
                                          <label class="btn btn-default {{ ($user_detail->merital_status==2) ? 'active focus' : '' }}" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                            <input type="radio" name="merital_status" value="2" {{ ($user_detail->merital_status==2) ? 'checked' : '' }}> Single
                                          </label>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                      <label>Diasability</label>
                                      <div>
                                        <div class="btn-group" data-toggle="buttons">
                                          <label class="btn btn-default {{ ($user_detail->diasability==1) ? 'active focus' : '' }}" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                            <input type="radio" name="diasability" value="1" {{ ($user_detail->diasability==1) ? 'checked' : '' }}> &nbsp; Yes &nbsp;
                                          </label>
                                          <label class="btn btn-default {{ ($user_detail->diasability==2) ? 'active focus' : '' }}" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                            <input type="radio" name="diasability" value="2" {{ ($user_detail->diasability==2) ? 'checked' : '' }}> No
                                          </label>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                              </div>


                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label  for="phone_no">Current Address</label>
                                    <input type="text"  id="current_address" name="current_address" value="{{ old('current_address',$user_detail->current_address) }}" class="form-control">
                                    
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="mobile_no">Street Address<span class="required">*</span></label>
                                    <input type="text"  id="street_address" name="street_address" value="{{ old('street_address',$user_detail->street_address) }}"  class="form-control">
                                  </div>
                                </div>
                              </div>


                              <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label  for="phone_no">State</label>
                                    <input type="text"  id="state" name="state" value="{{ old('state',$user_detail->state) }}" class="form-control">
                                    
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="mobile_no">City</label>
                                    <input type="text"  id="city" name="city" value="{{ old('city',$user_detail->city) }}"  class="form-control">
                                  </div>
                                </div>

                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="mobile_no">Pin Code</label>
                                    <input type="text"  id="pincode" name="pincode" value="{{ old('pincode',$user_detail->pincode) }}"  class="form-control">
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <input type="checkbox" onclick="secondaddress();" class="form-check-input"  value="1" name="same_address"  {{($user_detail->same_address==1)?'checked':''}}>
                                    <label class="form-check-label" for="update_notsame"><b class="text-bold">Whether current and permanent address are same</b></label>
                                  </div>
                                </div>
                              </div>

                               <div id="second_address" {{($user_detail->same_address==1)?'style=display:none':''}}>
                               <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label  for="phone_no">Permanent Address</label>
                                    <input type="text"  id="permanent_address" name="permanent_address" value="{{ old('permanent_address',$user_detail->permanent_address) }}" class="form-control">
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="mobile_no">Street Address<span class="required">*</span></label>
                                    <input type="text"  id="pstreet_address" name="pstreet_address" value="{{ old('pstreet_address',$user_detail->pstreet_address) }}"  class="form-control">
                                  </div>
                                </div>
                              </div>


                              <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label  for="phone_no">State</label>
                                    <input type="text"  id="pstate" name="pstate" value="{{ old('pstate',$user_detail->pstate) }}" class="form-control">
                                    
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="mobile_no">City</label>
                                    <input type="text"  id="pcity" name="pcity" value="{{ old('pcity',$user_detail->pcity) }}"  class="form-control">
                                  </div>
                                </div>

                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="mobile_no">Pin Code</label>
                                    <input type="text"  id="ppincode" name="ppincode" value="{{ old('ppincode',$user_detail->ppincode) }}"  class="form-control">
                                  </div>
                                </div>
                              </div>
                               </div>


                              <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <div class="col-md-6 row">
                                      <label  for="pancard_image">Pancard</label>
                                      <input type="file"  id="pancard_image" name="pancard_image" class="form-control">
                                      <span class="text text-danger"> @if ($errors->has('pancard_image')){{ $errors->first('pancard_image') }} @endif</span>
                                    </div>
                                    <div class="col-md-6 row">
                                      <label >&nbsp;</label>
                                      <input type="text"  id="pancard_no" name="pancard_no" value="{{ old('pancard_no',$user_detail->pancard_no) }}" class="form-control" placeholder="Pancard number">
                                    </div>
                                  </div>
                                </div>

                                <div class="col-md-4">
                                  <div class="form-group">
                                    <div class="col-md-6 row">
                                      <label  for="phone_no">Aadhar card number</label>
                                      <input type="file"  id="aadharcard_image" name="aadharcard_image" class="form-control">
                                      <span class="text text-danger"> @if ($errors->has('aadharcard_image')){{ $errors->first('aadharcard_image') }} @endif</span>
                                    </div>
                                    <div class="col-md-6 row">
                                      <label >&nbsp;</label>
                                      <input type="text"  id="aadharcard_number" name="aadharcard_number" value="{{ old('aadharcard_number',$manageusers->aadharcard_number) }}" class="form-control" placeholder="Aadhar card number">
                                    </div>
                                  </div>
                                </div>

                                <div class="col-md-4">
                                  <div class="form-group">
                                    <div class="col-md-6 row">
                                    <label  for="phone_no">ESIC card number</label>
                                      <input type="file"  id="esic_card_image" name="esic_card_image" class="form-control">
                                      <span class="text text-danger"> @if ($errors->has('esic_card_image')){{ $errors->first('esic_card_image') }} @endif</span>
                                    </div>
                                    <div class="col-md-6 row">
                                      <label >&nbsp;</label>
                                      <input type="text"  id="esic_card_no" name="esic_card_no" value="{{ old('esic_card_no',$user_detail->esic_card_no) }}" class="form-control" placeholder="Esic card number">
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <div class="ln_solid"></div>
                                <div class="form-group">
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <button type="submit" class="btn btn-success">Update</button>
                                  </div>
                                </div>


                            </div>
                         </form>

                        </div>
                        <div role="tabpanel" class="tab-pane fade {{ $dtab3 }}" id="tab_content3" aria-labelledby="profile-tab">
                           <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"  action="{{ url('admin/dependent_info') }}" method = "post" enctype="multipart/form-data">
                            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                            <input type="hidden" id="user_id" name="user_id" class="form-control" value="{{$manageusers->id}}" required>
                             <div class="main_dependent">
                               @php
                                    
                                        if($user_detail->relation!=''){
                                          $relation = json_decode($user_detail->relation);
                                        
                                          $count = count($relation->relation);
                                          $j=1;
                                          for($i=0;$i<$count;$i++){
                                        @endphp
                                  <div class="relation_div">
                                            @if($count>1 && $j>1)
                                            <a class="remove_relation">X</a>
                                            @endif
                                     <div class="row">
                                          <div class="col-md-4">
                                             <div class="form-group">
                                                <label>Relation</label>
                                                <select class="form-control" name="relation[relation][]">
                                                     <option value="">Relation</option>
                                                     <option value="1" {{($relation->relation[$i]==1) ? 'selected':''}}>Father</option>
                                                     <option value="2" {{($relation->relation[$i]==2) ? 'selected':''}}>Mother</option>
                                                     <option value="3" {{($relation->relation[$i]==3) ? 'selected':''}}>Spouse</option>
                                                     <option value="4" {{($relation->relation[$i]==4) ? 'selected':''}}>Child</option>
                                                 </select>
                                              </div>
                                          </div>
                                          <div class="col-md-4">
                                            <div class="form-group">
                                              <label>First name</label>
                                              <input type="text"  name="relation[fname][]" class="form-control" value="{{$relation->fname[$i]}}">
                                            </div>
                                          </div>
                                          <div class="col-md-4">
                                            <div class="form-group">
                                              <label>Last name</label>
                                              <input type="text"  name="relation[lname][]" class="form-control" value="{{$relation->lname[$i]}}">
                                            </div>
                                          </div>
                                     </div>

                                     <div class="row">
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <label >Aadhar card number</label>
                                            <input type="text"  name="relation[aadhar_card_no][]" class="form-control" value="{{$relation->aadhar_card_no[$i]}}">
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <label for="mobile_no">Street Address</label>
                                            <input type="text"  id="street_address" name="relation[street_address][]" class="form-control" value="{{$relation->street_address[$i]}}">
                                          </div>
                                        </div>
                                     </div>


                                     <div class="row">
                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <label  for="phone_no">State</label>
                                          <input type="text"  id="state" name="relation[state][]" class="form-control" value="{{$relation->state[$i]}}" value="{{$relation->state[$i]}}">
                                          
                                        </div>
                                      </div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="mobile_no">City</label>
                                          <input type="text"  id="city"  name="relation[city][]"  class="form-control" value="{{$relation->city[$i]}}">
                                        </div>
                                      </div>

                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="mobile_no">Pin Code</label>
                                          <input type="text"   name="relation[pincode][]"    class="form-control" value="{{$relation->pincode[$i]}}" >
                                        </div>
                                      </div>
                                     </div>

                                     <div class="row">
                                      <div class="col-md-12">
                                        <input type="checkbox" class="form-check-input" id="dep_living_1" name="relation[living_with][0]" value="1" @php if(isset($relation->living_with[$i]) && $relation->living_with[$i]==1) echo 'checked'; @endphp>>               
                                        <label><b class="text-bold">Living with the member</b></label>
                                      </div>
                                     </div>
                               </div>
                                @php
                                           $j++;
                                          }
                                        }
                                        else{
                                        @endphp

                               <div class="relation_div">
                                     <div class="row">
                                          <div class="col-md-4">
                                             <div class="form-group">
                                                <label>Relation</label>
                                                <select class="form-control" name="relation[relation][]">
                                                     <option value="">Relation</option>
                                                     <option value="1">Father</option>
                                                     <option value="2">Mother</option>
                                                     <option value="3">Spouse</option>
                                                     <option value="4">Child</option>
                                                 </select>
                                              </div>
                                          </div>
                                          <div class="col-md-4">
                                            <div class="form-group">
                                              <label>First name</label>
                                              <input type="text"  name="relation[fname][]" class="form-control">
                                            </div>
                                          </div>
                                          <div class="col-md-4">
                                            <div class="form-group">
                                              <label>Last name</label>
                                              <input type="text"  name="relation[lname][]" class="form-control">
                                            </div>
                                          </div>
                                     </div>

                                     <div class="row">
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <label >Aadhar card number</label>
                                            <input type="text"  name="relation[aadhar_card_no][]" class="form-control">
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <label for="mobile_no">Street Address</label>
                                            <input type="text"  id="street_address" name="relation[street_address][]" class="form-control">
                                          </div>
                                        </div>
                                     </div>


                                     <div class="row">
                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <label  for="phone_no">State</label>
                                          <input type="text"  id="state" name="relation[state][]" class="form-control">
                                          
                                        </div>
                                      </div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="mobile_no">City</label>
                                          <input type="text"  id="city"  name="relation[city][]"  class="form-control">
                                        </div>
                                      </div>

                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="mobile_no">Pin Code</label>
                                          <input type="text"   name="relation[pincode][]"    class="form-control">
                                        </div>
                                      </div>
                                     </div>

                                     <div class="row">
                                      <div class="col-md-12">
                                        <input type="checkbox" class="form-check-input" id="dep_living_1" name="relation[living_with][0]" value="1">               
                                        <label><b class="text-bold">Living with the member</b></label>
                                      </div>
                                     </div>
                               </div>
                                @php
                                          }
                                        @endphp


                             </div>

                             <div class="row">
                                 <div class="col-md-12">
                                   <a class="add_relation" onclick="append_relation();" title="Add more dependent info">+</a>
                                 </div>
                            </div>

                            <div class="ln_solid"></div>
                                <div class="form-group">
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <button type="submit" class="btn btn-success">Update</button>
                                  </div>
                                </div>


                           </form>

                        </div>

                        <div role="tabpanel" class="tab-pane fade {{ $dtab4 }}" id="tab_content4" aria-labelledby="profile-tab" enctype="multipart/form-data">

                           <form class="needs-validation container" novalidate method="post" action="{{url('admin/company_info')}}" enctype="multipart/form-data">
                                     <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                     <input type="hidden" id="user_id" name="user_id" class="form-control" value="{{$manageusers->id}}" required>

                          <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label  for="phone_no">Joining Date</label>
                                    <input type="text"  name="joining_date" value="{{$user_detail->joining_date}}" class="form-control datepicker">
                                    
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="mobile_no">Company Name</label>
                                     <input type="text" id="update_companyname" class="form-control" name="company_name" value="{{$user_detail->company_name}}">
                                  </div>
                                </div>
                           </div>

                           <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label  for="phone_no">Company ESI Code</label>
                                    <input type="text" id="update_esicode" class="form-control" name="esi_code" value="{{$user_detail->esi_code}}">
                                    
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="mobile_no">Company Sub Code</label>
                                    <input type="text" id="update_subcode" class="form-control" name="sub_code" value="{{$user_detail->sub_code}}">
                                  </div>
                                </div>
                           </div>


                           <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label  for="phone_no">Company Type</label>
                                    <select class="form-control" name="company_type">
                                                        <option value="">Company Type</option>
                                                        @if(!empty($company_type))
                                                        @foreach($company_type as $value)
                                                        <option value="{{$value->id}}" {{$user_detail->company_type==$value->id ? 'selected' : '' }} >{{$value->title}}</option>
                                                        @endforeach
                                                        @endif
                                    </select>
                                    
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="mobile_no">Nature Of Business</label>
                                     <select class="form-control" name="business_nature">
                                                        <option value="">Nature Of Business</option>
                                                        @if(!empty($nature_of_business))
                                                        @foreach($nature_of_business as $value)
                                                        <option value="{{$value->id}}" {{$user_detail->business_nature==$value->id ? 'selected' : '' }}>{{$value->title}}</option>
                                                        @endforeach
                                                        @endif
                                     </select>
                                  </div>
                                </div>

                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="mobile_no">No. of Employee</label>
                                    <select class="form-control" name="no_of_employee">
                                                        <option value="">No. of Employee</option>
                                                        <option value="1" {{$user_detail->no_of_employee==1 ? 'selected' : '' }}>0 to 10</option>
                                                        <option value="2" {{$user_detail->no_of_employee==2 ? 'selected' : '' }}>0 to 25</option>
                                                        <option value="3" {{$user_detail->no_of_employee==3 ? 'selected' : '' }}>0 to 50</option>
                                                        <option value="4" {{$user_detail->no_of_employee==4 ? 'selected' : '' }}>0 to 100</option>
                                                        <option value="5" {{$user_detail->no_of_employee==5 ? 'selected' : '' }}>0 to 100 +</option>
                                                        <option value="6" {{$user_detail->no_of_employee==6 ? 'selected' : '' }}>0 to 250 above</option>
                                    </select>
                                  </div>
                                </div>
                           </div>

                           <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label  for="phone_no">Street Address</label>
                                   <input type="text" id="update_mobile" class="form-control" name="cstreet_address" value="{{$user_detail->cstreet_address}}">
                                  </div>
                                </div>
                           </div>


                            <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label class="">State</label>
                                    <input type="text" class="form-control" name="c_state" value="{{$user_detail->c_state}}">
                                  </div>
                                </div>

                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label class="">City</label>
                                     <input type="text" class="form-control" id="validationCustom032"  name="c_city" value="{{$user_detail->c_city}}">
                                  </div>
                                </div>

                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="validationCustom052" class="">Pin Code</label>
                                    <input type="text" class="form-control" id="validationCustom052" name="c_pincode" value="{{$user_detail->c_pincode}}">
                                  </div>
                                </div>
                           </div>

                            <div class="ln_solid"></div>
                                <div class="form-group">
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <button type="submit" class="btn btn-success">Update</button>
                                  </div>
                                </div>




                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->


@endsection
@section('script')
<script type="text/javascript">
  function secondaddress() {
        $('#second_address').slideToggle();
  }

  function append_relation(){
       var length = $('.relation_div').length;
       var living_id = parseInt(length)+parseInt(1);
       $('.main_dependent').append('<div class="relation_div"><a class="remove_relation">X</a><div class="row"><div class="col-md-4"><div class="form-group"><label>Relation</label><select class="form-control" name="relation[relation][]"><option value="">Relation</option><option value="1">Father</option><option value="2">Mother</option><option value="3">Spouse</option><option value="4">Child</option></select></div></div><div class="col-md-4"><div class="form-group"><label>First name</label><input type="text"  name="relation[fname][]" class="form-control"></div></div><div class="col-md-4"><div class="form-group"><label>Last name</label><input type="text"  name="relation[lname][]" class="form-control"></div></div></div><div class="row"><div class="col-md-6"><div class="form-group"><label >Aadhar card number</label><input type="text"  name="relation[aadhar_card_no][]" class="form-control"></div></div><div class="col-md-6"><div class="form-group"><label for="mobile_no">Street Address</label><input type="text"  id="street_address" name="relation[street_address][]" class="form-control"></div></div></div><div class="row"><div class="col-md-4"><div class="form-group"><label  for="phone_no">State</label><input type="text"  id="state" name="relation[state][]" class="form-control"></div></div><div class="col-md-4"><div class="form-group"><label for="mobile_no">City</label><input type="text"  id="city"  name="relation[city][]"  class="form-control"></div></div><div class="col-md-4"><div class="form-group"><label for="mobile_no">Pin Code</label><input type="text"   name="relation[pincode][]"  class="form-control"></div></div></div><div class="row"><div class="col-md-12"><input type="checkbox" class="form-check-input" id="dep_living_'+living_id+'" name="relation[living_with]['+length+']" value="1"> <label><b class="text-bold">Living with the member</b></label></div></div></div>');

       $('.remove_relation').on('click',(function(){
          $(this).parent('div').remove();
       }));
    }

  $('.remove_relation').on('click',(function(){
          $(this).parent('div').remove();
  }));

</script>
@endsection