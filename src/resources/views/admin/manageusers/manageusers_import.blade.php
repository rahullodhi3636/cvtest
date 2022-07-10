@extends('layouts.adminmaster')
@section('title', 'Hospitals')
@section('content')

    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Hospitals</h3>
              </div>

            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Import <small>Users</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li> <a href="{{ route('hospitals.index') }}" title="Back"><i class="fa fa-arrow-left"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />

                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('user_import') }}" method = "post" enctype="multipart/form-data">
                      <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">File <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file"   name="file" required="required" class="form-control col-md-7 col-xs-12">
                          <span class="text text-danger"> @if ($errors->has('file')){{ $errors->first('file') }} @endif</span>
                        </div>
                      </div>
                    

                     
                   
                     
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

@endsection