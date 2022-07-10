@extends('layouts.newlayout.app')
@section('content')
<div class="main">
  <!-- <form> -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="boxbody">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="card-header">
                        <h5 class="card-title">Edit Staff <i class="fa fa-pencil"></i></h5>
                        </div>
                    </div><!--./col-lg-6-->
                </div><!--./row-->
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="row pull-right">
                        @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                            <li>{!! \Session::get('success') !!}</li>
                            </ul>
                        </div>
                        @endif
                    </div>
                <form id="editStaffForm" action="{{ route('staff.update',['id'=>$staff->id ]) }}" method="post" class="formvisit mt-2">
                   @csrf
                   {{ method_field('PUT') }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="image">Image <span class="required">*</span> </label>
                                <input type="file" name="image" class="form-control">
                                <span class="text text-danger"> @if ($errors->has('image')){{ $errors->first('image') }} @endif</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="name">Select Branch <span class="required">*</span> </label>
                                <select class="form-control" id="branch" name="branch">
                                <option value="">Select</option>
                                @if(!empty($branches))
                                    @foreach($branches as $branch)
                                    @php
                                        $id_branch = $branch->id;
                                    @endphp
                                    <option value="{{$branch->id}}" {{($staff->branch_id == $id_branch ? "selected":"") }}>{{$branch->name}}</option>
                                    @endforeach
                                @endif
                                </select>
                                <span class="text text-danger">@if ($errors->has('branch')){{ $errors->first('branch') }} @endif</span>
                            </div>
                        </div>
                    </div><!--./row-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="name">Select Department <span class="required">*</span> </label>
                                <select class="form-control" id="department" name="department">
                                <option value="">Select</option>
                                @if(!empty($roles))
                                    @foreach($roles as $role)
                                    @php
                                        $id_role = $role->role_id ;
                                    @endphp
                                    <option value="{{$role->role_id }}" {{($staff->department == $id_role ? "selected":"") }}>{{$role->role_name}}</option>
                                    @endforeach
                                @endif
                                </select>
                                <span class="text text-danger">@if ($errors->has('branch')){{ $errors->first('branch') }} @endif</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="name">Name <span class="required">*</span> </label>
                                <input type="text"  id="name" name="name" value="{{ $staff->name }}" placeholder="Enter name"  class="form-control" autocomplete="off">
                                <span class="text text-danger"> @if ($errors->has('name')){{ $errors->first('name') }} @endif</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="contact">Contact <span class="required">*</span> </label>
                                <input type="text"  id="contact" name="contact" value="{{ $staff->phone_no }}" placeholder="Enter contact"  class="form-control" autocomplete="off">
                                <span class="text text-danger"> @if ($errors->has('contact')){{ $errors->first('contact') }} @endif</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="email">Email </label>
                                <input type="text"  id="email" name="email" value="{{ $staff->email }}" placeholder="Enter email"  class="form-control" autocomplete="off">
                                <span class="text text-danger"> @if ($errors->has('email')){{ $errors->first('email') }} @endif</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="email">Password </label>
                                <input type="password"  id="password" name="password" value="{{ $staff->password }}" placeholder="Enter password"  class="form-control" autocomplete="off">
                                <span class="text text-danger"> @if ($errors->has('password')){{ $errors->first('password') }} @endif</span>
                            </div>
                        </div>
                    </div>                    
                <div class="row">                    
                    <div class="col-lg-12 col-md-12 col-12 text-center mb-3 mt-3">
                    <input type="submit" name="Staff_with_service"  value="Update" class="btn btn-success p-2">
                    </div>
                </div>
                </form>
                </div><!--./col-lg-12-->
            </div><!--./boxbody-->
        </div><!--./container-fluid-->
        <footer>
        Copyright © 2020 Chinnie & Vinnie Jabalpur Salon. All rights reserved.
        </footer>
    </div><!--./main-content-->
</div><!--./main-->
<script src="{{asset('assets/js/lib/jquery.js')}}"></script>
<script src="{{asset('assets/js/dist/jquery.validate.js')}}"></script>
<script>


</script>





@endsection