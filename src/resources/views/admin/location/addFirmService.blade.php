@extends('layouts.adminmaster')
@section('title', 'Packages')
@section('content')

<style type="text/css">
  button.bs-placeholder{margin: 0;}
</style>

<div class="right-details-box">
            <div class="home_brics_row">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dash_boxcontainner white_boxlist">
                            <div class="upper_basic_heading">
                                <span class="white_dash_head_txt">Add Package <a href="{{ url('admin/packages') }}" class="btn margin0 btn-sm btn-mdb-color single-table-btn float-right waves-effect waves-light" ><i class="mdi mdi-arrow-left mr-1"></i>Back</a> </span>
                            </div>
                            <div class="panel-body dash_table_containner">
                            @if($message=Session::get('success'))
                            <div class="alert alert-success">
                              <p>{{ $message }}</p>
                            </div>
                            @endif
                            <div class="col-md-12">
                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="" method = "post" enctype="multipart/form-data">
                                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                                
                                <!-- <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address"> Services <span class="required">*</span>
                                  </label>
                                  <table class="table order-list" id="myTable">
                                    <thead>
                                      <th>Service</th>
                                      <th>Total service provide</th>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>
                                          <select class="form-control" id="services" name="services[]">
                                            <option value="">Select</option>
                                            @foreach ($services as $service)
                                             <option value="{{ $service->id }}">{{ $service->name }}</option>
                                            @endforeach
                                          </select>
                                        </td>
                                        <td><input type="number"  id="total" name="total[]" value="{{ old('total') }}" placeholder="Enter package total service provide"  class="form-control"></td>
                                        <td><input type="button" class="btn btn-md btn-success " id="addrow" value="Add Row"></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div> -->

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Select Branch <span class="required">*</span>
                                  </label>
                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                    <select class="form-control selectpicker col-md-7 col-xs-12" name="branches[]" id="branches" data-live-search="true" data-hide-disabled="true" data-actions-box="true" multiple>
                                      <!-- <option value="">Select</option> -->
                                      @foreach ($services as $service)
                                       <option value="{{ $service->id }}">{{ $service->name }}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Status <span class="required">*</span>
                                  </label>
                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                    <select name="status" class="form-control col-md-7 col-xs-12" id="status">
                                        <option value="">Select</option>
                                        <option value="1" {{ old('status') == '1'? 'selected' : '' }} >Active</option>
                                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Deactive</option>
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