<div class="row">
  <div class="col-lg-8 col-md-12 col-12">
    <input type="hidden" name="editpackageid" id="editpackageid" value="{{ $package->package_id }}"> 
    <div class="form-group">
      <label>Select firm</label>
      <select class="form-control" id="editfirm" name="editfirm">
        <option value="">Select</option>
        <?php if (!empty($firms)): ?>
          <?php foreach ($firms as $firm): ?>
            <option <?php if($package->firm_id == $firm->id) echo "selected"; else echo ""; ?> value="{{ $firm->id }}">{{ $firm->firm_name }}</option>
          <?php endforeach ?>
        <?php endif ?>
      </select>
    </div>
  </div><!--./col-lg-4-->

  <div class="col-lg-6 col-md-12 col-12">
    <div class="form-group">
      <label>Package name</label>
      <input type="text" name="edittitle" id="edittitle" value="{{ $package->package_title }}" placeholder="Enter membership title"  class="form-control">
    </div>
  </div><!--./col-lg-4-->

  <div class="col-lg-6 col-md-12 col-12">
     <div class="form-group">
        <label>Package Type</label>
        <select name="editpackagetype" class="form-control" id="editpackagetype">
            <option value="">Select</option>
            <option <?php if($package->package_type == 1) echo "selected"; else echo ""; ?> value="1">Premium</option>
            <option <?php if($package->package_type == 0) echo "selected"; else echo ""; ?> value="0">Normal</option>
        </select>
      </div>
  </div>

  <div class="col-lg-6 col-md-12 col-12">
     <div class="form-group">
        <label>Package validity type</label>
        <select name="editvalidityType" class="form-control" id="editvalidityType">
          <option value="">Select</option>
          <option <?php if($package->package_validity_type == 1) echo "selected"; else echo ""; ?> value="1">Days</option>
          <option <?php if($package->package_validity_type == 2) echo "selected"; else echo ""; ?> value="2">Weeks</option>
          <option <?php if($package->package_validity_type == 3) echo "selected"; else echo ""; ?> value="3">Months</option>
          <option <?php if($package->package_validity_type == 4) echo "selected"; else echo ""; ?> value="4">Years</option>
        </select>
      </div>
  </div>

  <div class="col-lg-6 col-md-12 col-12">
    <div class="form-group">
      <label>Package validity</label>
      <input type="number" name="editvalidity" id="editvalidity" value="{{ $package->package_duration }}" placeholder="Eg. 10"  class="form-control">
    </div>
  </div><!--./col-lg-4-->

  <div class="col-lg-6 col-md-12 col-12">
     <div class="form-group">
        <label>Total members</label>
        <input id="editmembers" name="editmembers" value="{{ $package->total_member }}" placeholder="Enter total members" type="number" class="form-control">
      </div>
  </div>
  <div class="col-lg-6 col-md-12 col-12">
     <div class="form-group">
        <label>Price</label>
        <input id="editprice" name="editprice" value="{{ $package->package_price }}" placeholder="Enter membership price" type="number" class="form-control">
      </div>
  </div><!--./col-lg-4-->

  <div class="col-lg-12 col-md-12 col-12">
     <div class="form-group">
        <label>Services</label>
      </div>
  </div><!--./col-lg-4-->

  <div class="col-lg-12 col-md-12 col-12">
     <div class="row">
       <table class="table order-list2" id="myTable">
        <thead>
          <th>Service</th>
          <th>Total service provide</th>
          <th></th>
          <th></th>
        </thead>
        <tbody>
          <?php 
            $serviceList = json_decode($package->package_services);
            $ser = array();
            $count = 1;
            foreach ($serviceList as $value) {
              $serviceid = $value->service;
              $total = $value->total;
          ?>
          <tr>
            <td>
              <select required class="form-control" id="editservices" name="editservices[]">
                <option value="">Select</option>
                @foreach ($services as $service)
                 <option @php if($serviceid==$service->id)echo 'selected';@endphp value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
              </select>
            </td>
            <td><input type="number" required id="edittotal" name="edittotal[]" value="{{ old('total',$total) }}" placeholder="Enter package total service provide"  class="form-control"></td>
            @php 
              if($count == 1){ 
            @endphp
            <td><input type="button" class="btn btn-md btn-success " id="addrow2" value="Add"></td>
            @php
              }else{
            @endphp
            <td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td>
            @php
            }
            $count++;
            @endphp
            <td></td>
          </tr>
          <?php
            }
          ?>
        </tbody>
      </table>
     </div>
  </div><!--./col-lg-4-->
</div><!--./row-->

<!-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
<script type="text/javascript">
  $(document).ready(function () {
    var counter = 0;
    $("#addrow2").on("click", function () {
      var newRow = $("<tr>");
      var cols = "";
      cols += '<td><select required class="form-control" id="editservices' + counter + '" name="editservices[]"><option value="">Select</option>@foreach ($services as $service)<option value="{{ $service->id }}">{{ $service->name }}</option>@endforeach</select></td>';
      cols += '<td><input required type="number"  id="edittotal' + counter + '" name="edittotal[]" value="{{ old("total") }}" placeholder="Enter package total service provide"  class="form-control"></td>';
      cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td>';
      newRow.append(cols);
      $("table.order-list2").append(newRow);
      counter++;
    });
    $("table.order-list2").on("click", ".ibtnDel", function (event) {
      $(this).closest("tr").remove();       
      counter -= 1
    });


  });
</script>