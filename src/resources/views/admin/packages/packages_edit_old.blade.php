@extends('layouts.adminmaster')
@section('title', 'Hotels')
@section('content')
<div class="right-details-box">
  <div class="home_brics_row">
    <div class="row">
      <div class="col-md-12">
        <div class="dash_boxcontainner white_boxlist">
          <div class="upper_basic_heading">
            <span class="white_dash_head_txt">Add package <a href="{{ url('admin/packages') }}" class="btn margin0 btn-sm btn-mdb-color single-table-btn float-right waves-effect waves-light" ><i class="mdi mdi-arrow-left mr-1"></i>Back</a> </span>
          </div>
          <div class="panel-body dash_table_containner">
            @if($message=Session::get('success'))
            <div class="alert alert-success">
              <p>{{ $message }}</p>
            </div>
            @endif
            <div class="col-md-12">
              <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('packages.update', $packages->package_id) }}" method = "post" enctype="multipart/form-data">
                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                <input type="hidden" name="_method" value="patch" />
                <!-- <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Select Branch <span class="required">*</span>
                  </label>
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <select class="form-control selectpicker col-md-7 col-xs-12" name="branches[]" id="branches" data-live-search="true" data-hide-disabled="true" data-actions-box="true" multiple>
                     @foreach ($branches as $branch)
                      <option {{ old('branch_id',$packages->branch_id) == $branch->id? 'selected' : '' }} value="{{ $branch->id }}">{{ $branch->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div> -->

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Select Branch <span class="required">*</span>
                  </label>
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <select class="form-control selectpicker col-md-7 col-xs-12" name="branches[]" id="branches" data-live-search="true" data-hide-disabled="true" data-actions-box="true" multiple>
                      <!-- <option value="">Select</option> -->
                      
                      <option {{ old('branch_id',$packages->branch_id) == $packages->id? 'selected' : '' }} value="{{ $packages->id }}">{{ $packages->name }}</option>
                      
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Package title <span class="required">*</span>
                  </label>
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="text"  id="title" name="title" value="{{ old('package_name',$packages->package_title) }}" placeholder="Enter package title"  class="form-control col-md-7 col-xs-12">
                    <span class="text text-danger"> @if ($errors->has('name')){{ $errors->first('name') }} @endif</span>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address"> Services <span class="required">*</span>
                  </label>
                  <table class="table order-list" id="myTable">
                    <thead>
                      <th>Service</th>
                      <th>Total service provide</th>
                    </thead>
                    <tbody>
                      <?php 
                        $serviceList = json_decode($packages->package_services);
                        $ser = array();
                        $count = 1;
                        foreach ($serviceList as $value) {
                          $serviceid = $value->service;
                          $total = $value->total;
                      ?>
                        <tr>
                        <td>
                          <select class="form-control col-md-4 col-xs-12" id="services" name="services[]">
                            <option value="">Select</option>
                            @foreach ($services as $service)
                            <option value="{{ $service->id }}" @php if($serviceid==$service->id)echo 'selected';@endphp >{{ $service->name }}</option>
                            @endforeach
                          </select>
                        </td>
                        <td><input type="number"  id="total" name="total[]" value="{{ old('total',$total) }}" placeholder="Enter package total service provide"  class="form-control col-md-4 col-xs-12"></td>
                        @php 
                          if($count == 1){ 
                        @endphp
                        <td><input type="button" class="btn btn-md btn-success " id="addrow" value="Add Row"></td>
                        @php
                          }else{
                        @endphp
                        <td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td>
                        @php
                        }
                          $count++;
                        @endphp
                      </tr>
                      <?php
                        }
                      ?>
                    
                    </tbody>
                  </table>
                </div>


                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Package price <span class="required">*</span>
                  </label>
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="number"  id="price" name="price" value="{{ old('package_price',$packages->package_price) }}" placeholder="Enter package price"  class="form-control col-md-7 col-xs-12">
                    <span class="text text-danger"> @if ($errors->has('price')){{ $errors->first('price') }} @endif</span>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Package Duration (in days) <span class="required">*</span>
                  </label>
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="number"  id="duration" name="duration" value="{{ old('package_duration',$packages->package_duration) }}" placeholder="Enter package duration"  class="form-control col-md-7 col-xs-12">
                    <span class="text text-danger"> @if ($errors->has('duration')){{ $errors->first('duration') }} @endif</span>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Package Type <span class="required">*</span>
                  </label>
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <select name="packagetype" class="form-control col-md-7 col-xs-12" id="packagetype">
                      <option value="">Select</option>
                      <option value="1" {{ old('package_type',$packages->package_type) == '1'? 'selected' : '' }} {{ old('packagetype') == '1'? 'selected' : '' }} >Premium</option>
                      <option  value="0" {{ old('package_type',$packages->package_type) == '0' ? 'selected' : '' }}>Normal</option>
                    </select>
                    <span class="text text-danger"> @if ($errors->has('packagetype')){{ $errors->first('packagetype') }} @endif</span>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Total members <span class="required">*</span>
                  </label>
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="number"  id="members" name="members" value="{{ old('total_member',$packages->total_member) }}" placeholder="Enter package members"  class="form-control col-md-7 col-xs-12">
                    <span class="text text-danger"> @if ($errors->has('members')){{ $errors->first('members') }} @endif</span>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Status <span class="required">*</span>
                  </label>
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <select name="status" class="form-control col-md-7 col-xs-12" id="status">
                      <option value="">Select</option>
                      <option value="1" {{ old('package_satus',$packages->package_satus) == '1'? 'selected' : '' }} >Active</option>
                      <option value="0" {{ old('package_satus',$packages->package_satus) == '0' ? 'selected' : '' }}>Deactive</option>
                    </select>
                    <span class="text text-danger"> @if ($errors->has('status')){{ $errors->first('status') }} @endif</span>
                  </div>
                </div>

                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
                    <button type="submit" class="btn btn-success">Save</button>
                  </div>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    var counter = 0;

    $("#addrow").on("click", function () {
      var newRow = $("<tr>");
      var cols = "";

      cols += '<td><select class="form-control col-md-4 col-xs-12" id="services' + counter + '" name="services[]"><option value="">Select</option>@foreach ($services as $service)<option value="{{ $service->id }}">{{ $service->name }}</option>@endforeach</select></td>';
      cols += '<td><input type="number"  id="total' + counter + '" name="total[]" value="{{ old("total") }}" placeholder="Enter package total service provide"  class="form-control col-md-4 col-xs-12"></td>';
                // cols += '<td><input type="text" class="form-control" name="phone' + counter + '"/></td>';

                cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td>';
                newRow.append(cols);
                $("table.order-list").append(newRow);
                counter++;
              });



    $("table.order-list").on("click", ".ibtnDel", function (event) {
      $(this).closest("tr").remove();       
      counter -= 1
    });


  });



        /*function calculateRow(row) {
            var price = +row.find('input[name^="price"]').val();

        }

        function calculateGrandTotal() {
            var grandTotal = 0;
            $("table.order-list").find('input[name^="price"]').each(function () {
                grandTotal += +$(this).val();
            });
            $("#grandtotal").text(grandTotal.toFixed(2));
          }*/
        </script>

        @endsection
        @section('script')
        @endsection