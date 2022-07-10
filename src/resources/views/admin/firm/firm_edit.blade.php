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
                        <h5 class="card-title">Edit firm QR Code <i class="fa fa-pencil"></i></h5>
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

                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('firm.update', $firm->id) }}" method = "post" enctype="multipart/form-data">
                        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                        <input type="hidden" name="_method" value="patch" />
                        @if($firm->qr_code!='')
                        <div class="form-group">
                          <img src="{{ url('images/firms_qrcode/'.$firm->qr_code) }}" width="100px">
                        </div>
                        @endif


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="image">Qr Code <span class="required">*</span> </label>
                                <input type="file" name="image" class="form-control">
                                <span class="text text-danger"> @if ($errors->has('image')){{ $errors->first('image') }} @endif</span>
                            </div>
                        </div>
                    </div><!--./row-->

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12 text-center mb-3 mt-3">
                    <input type="submit" name="Staff_with_service"  value="Update" class="btn btn-success p-2">
                    </div>
                </div>
                </form>
                </div><!--./col-lg-12-->
            </div><!--./boxbody-->
        </div><!--./container-fluid-->

    </div><!--./main-content-->
</div><!--./main-->
<script src="{{asset('assets/js/lib/jquery.js')}}"></script>
<script src="{{asset('assets/js/dist/jquery.validate.js')}}"></script>
<script>

</script>
@endsection
