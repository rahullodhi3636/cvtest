<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css"> -->
<form id="editserviceform" action='{{ url("updateService") }}' method="post">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Edit Service</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
    <!-- <input type="hidden" name="editservice_groupid" id="editservice_groupid"> -->
    <input type="hidden" name="editservice_id" id="editservice_id" value="{{ $services->id }}">
    <!-- Modal body -->
    <div class="modal-body formvisit">
      <div class="row">
        <div class="col-lg-4 col-md-12 col-12">
          <div class="form-group">
            <label>Service Name</label>
            <input type="text" name="editservice_name" id="editservice_name" value="{{ $services->name }}" placeholder="Enter service name"  class="form-control">
          </div>
        </div><!--./col-lg-4-->
        <div class="col-lg-4 col-md-12 col-12">
          <div class="form-group">
            <label>Service Duration</label>
            <input type="text" name="editservice_duration" id="editservice_duration" value="{{ $services->duration }}" placeholder="Enter service duration"  class="form-control">
          </div>
        </div><!--./col-lg-4-->
        {{-- <div class="col-lg-4 col-md-12 col-12">
          <div class="form-group">
            <label>Service Price</label>
            <input type="text" name="editservice_price" id="editservice_price" value="{{ $services->service_price }}" placeholder="Enter service price"  class="form-control">
          </div>
        </div><!--./col-lg-4-->
        <div class="col-lg-4 col-md-12 col-12">
          <div class="form-group">
            <label>Special Price</label>
            <input type="text" name="editservice_special_price" id="editservice_special_price" value="{{ $services->special_price }}" placeholder="Enter special price"  class="form-control">
          </div>
        </div><!--./col-lg-4-->
        <div class="col-lg-4 col-md-12 col-12">
          <div class="form-group">
            <label>Service description</label>
            <textarea class="form-control" name="editservice_description" id="editservice_description" placeholder="Enter description">{{ $services->description }}</textarea>
          </div>
        </div><!--./col-lg-4-->--}}
        <?php 
          if(!empty($services->staff)){
            $servicesstaff = json_decode($services->staff);
            // print_r($servicesstaff);
          }else{
            $servicesstaff = "";
          } 
        ?>
        <div class="col-lg-4 col-md-12 col-12">
          <div class="form-group">
            <label>Tag Staff</label>
            <select class="form-control selectpicker my-select" multiple data-live-search="true" name="edittag_staff[]" id="edittag_staff">
              
              <?php if (!empty($staff)): ?>
                <?php foreach ($staff as $value): ?>
                  <option <?php if(!empty($servicesstaff) && in_array($value->id, $servicesstaff)) echo "selected"; else echo ""; ?> value="{{ $value->id }}">{{ $value->name }}</option>
                <?php endforeach ?>
              <?php endif ?>
            </select>
          </div>
        </div><!--./col-lg-4-->
        <div class="col-lg-12 col-md-12 col-12">
          <div class="row">
            <table class="table order-list2" id="myTable">
              <thead>
                <th>Brand</th>
                <th>Price</th>
                <th>Special Price</th>
                <th>Duration</th>
                <th>Description</th>
                <th></th>
                <th></th>
              </thead>
              <tbody>
                <?php
                  $brand = DB::table('service_brands')->where('service_id',$services->id)->get();
                  // print_r($brand);
                  if (!empty($brand)) {
                    $count = 1;
                    foreach ($brand as $servicebrand) {
                ?>
                    <tr>
                      <td>
                        <input type="hidden" name="brandid[]" id="brandid" value="{{ $servicebrand->service_brand_id }}">
                        <input type="text" required name="editbrandname[]" id="editbrandname" class="form-control" placeholder="Enter brand name" value="{{ $servicebrand->brand_name }}">
                      </td>
                      <td><input required type="number" id="editserviceprice" name="editserviceprice[]" placeholder="Enter price"  class="form-control" value="{{ $servicebrand->service_price }}"></td>
                      <td><input type="number" id="editspecialserviceprice" name="editspecialserviceprice[]" placeholder="Enter special price"  class="form-control" value="{{ $servicebrand->special_price }}"></td>
                      <td><input type="number" id="editbrandDuration" name="editbrandDuration[]" placeholder="Eg 30" value="{{ $servicebrand->service_duration }}"  class="form-control"></td>
                      <td><textarea class="form-control" name="editservice_description[]" id="editservice_description" placeholder="Enter description">{{ $servicebrand->service_description }}</textarea></td>
                      <?php if($count == 1){  ?>
                      <td><input type="button" class="btn btn-md btn-success " id="addrow2" value="Add"></td>
                    <?php }else{ ?>
                      <td><input type="button" onclick="deleteBrand('{{ $servicebrand->service_brand_id }}')" class="editibtnDel btn btn-md btn-danger "  value="Delete"></td>
                    <?php  } ?>
                      <td></td>
                    </tr>
                  <?php $count++; } } ?>
              </tbody>
            </table>
          </div>
        </div><!--./col-lg-4-->
      </div><!--./row-->
    </div>
    <div class="modal-footer">
      <button type="button" class="outline-btn" data-dismiss="modal">Cancel</button>
      <button type="submit" class="theme-btn">Save</button>
    </div>
  </div>
</form>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script> -->
<!-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
<script type="text/javascript">
  $(document).ready(function () {
    var counter = 0;

    $("#addrow2").on("click", function () {
        var newRow = $("<tr>");
        var cols = "";

        cols += '<td><input type="hidden" name="brandid[]" id="brandid' + counter + '" value="0"><input required type="text" name="editbrandname[]" id="editbrandname' + counter + '" class="form-control" placeholder="Enter brand name"></td>';
        // cols += '';
        cols += '<td><input required type="number" required id="editserviceprice' + counter + '" name="editserviceprice[]" placeholder="Enter price"  class="form-control"></td>';
        cols += '<td><input type="number" required id="editspecialserviceprice' + counter + '" name="editspecialserviceprice[]" placeholder="Enter special price"  class="form-control"></td>';
        cols += '<td><input type="number" id="editbrandDuration' + counter + '" name="editbrandDuration[]" placeholder="Eg 30"  class="form-control"></td>';
        cols += '<td><textarea class="form-control" name="editservice_description[]" id="editservice_description' + counter + '" placeholder="Enter description"></textarea></td>';
        cols += '<td><input type="button" class="editibtnDel btn btn-md btn-danger "  value="Delete"></td><td></td>';
        newRow.append(cols);
        $("table.order-list2").append(newRow);
        counter++;
    });



    $("table.order-list2").on("click", ".editibtnDel", function (event) {
        $(this).closest("tr").remove();       
        counter -= 1
    });
  });
  $('.my-select').selectpicker();

  function deleteBrand(brandid) {
    if (confirm('Do you really want remove this?')) {
      $.ajax({
        url:'{{ url("deleteBrand") }}',
        data:{'brand_id':brandid},
        type:'POST',
        success:function(res) {
          // body...
        }
      })
    }
  }
</script>