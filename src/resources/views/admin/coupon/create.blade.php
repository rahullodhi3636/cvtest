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
                        <h5 class="card-title">New Coupon <i class="fa fa-plus"></i></h5>
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
                <form id="addcomboForm" action="{{route('coupon.store')}}" method="post" class="formvisit mt-2">
                  <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">  
                  <div class="row">
                      <div class="col-lg-6 col-md-12 col-12">
                          <div class="form-group">
                          <label>Coupon Name</label>
                          <div class="input-group mb-3">
                              <input required type="text" id="Coupon_name" name="Coupon_name" class="form-control" placeholder="Enter Coupon Name">
                          </div>
                          </div><!--./form-group-->
                      </div><!--./col-lg-8-->

                      <div class="col-lg-6 col-md-12 col-12">
                          <div class="form-group">
                          <label>Coupon Type</label>
                          <div class="input-group mb-3">
                              <select name="coupon_type" id="coupon_type" class="form-control" onchange="set_coupon_type(this.value)">
                                
                                <option value="Free">Free</option>
                                <option value="Fixed">Fixed</option>
                                <option value="Percentage">Percentage</option>
                                <option value="Services">Services</option>
                              </select>
                          </div>
                          </div><!--./form-group-->
                      </div><!--./col-lg-8-->
                    </div>  

                    <div class="row" id="addservice" style="display: none;">
                        <div class="col-lg-12 col-md-12 col-12 ">
                                <div class="form-group">
                                <label>.</label>
                                    <div class="input-group mb-3">
                                        <a onclick="addServiceRow()" href="javascript:void(0)" class="theme-btn">
                                        <i class="fa fa-plus"></i>Services
                                        </a>
                                    </div>
                                </div><!--./form-group-->
                        </div><!--./col-lg-4-->
                    </div> 

                    <div class="row" id="discount_on_plan" style="display:none;">
                      <div class="col-lg-12 col-md-12 col-12" >
                            <div class="form-group">
                            <label id="discount_label">Discount Value</label>
                                <div class="input-group mb-3">
                                  <input type="text" id="coupon_discount" name="coupon_discount" class="form-control" placeholder="Enter Coupon Discount">
                                </div>
                            </div><!--./form-group-->
                      </div><!--./col-lg-4-->
                    </div>                
                    <div class="col-lg-12 col-md-12 col-12"><div style="display: none;" class="divider serviceDivider"></div></div><!--/col-lg-12-->
                    <div class="col-lg-12">
                        <div id="serviceDiv">

                        </div>
                    </div>
                    <div class="row">
                      <!-- <div class="col-lg-6 col-md-12 col-12">
                          <div class="form-group">
                              <label>Coupon Validity (Total Days)</label>
                              <div class="input-group mb-3">
                                <input required type="text" id="Coupon_validity" name="Coupon_validity" class="form-control" placeholder="Enter Coupon Validity">
                              </div>
                          </div>
                      </div> -->
                      <div class="col-lg-6 col-md-12 col-12">
                          <div class="form-group">
                              <label>Coupon Prefix</label>
                              <div class="input-group mb-3">
                                <input type="text" id="coupon_prefix" name="coupon_prefix" class="form-control" placeholder="Enter Coupon Prefix">
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-6 col-md-12 col-12">
                          <div class="form-group">
                              <label>Coupon Total</label>
                              <div class="input-group mb-3">
                                <input type="text" id="Coupon_total" name="Coupon_total" class="form-control" placeholder="Enter Coupon Total">
                              </div>
                          </div><!--./form-group-->
                      </div><!--./col-lg-6-->
                      <!-- <div class="col-lg-4 col-md-12 col-12">
                          <div class="form-group">
                              <label>Coupon Price</label>
                              <div class="input-group mb-3">
                                <input type="text" id="Coupon_price" name="Coupon_price" class="form-control" placeholder="Enter Coupon price">
                              </div>
                          </div>
                      </div> -->
                      
                    </div>
                    <div class="row">                      
                      <div class="col-lg-6 col-md-12 col-12">
                          <div class="form-group">
                              <label>Valid From</label>
                              <div class="input-group mb-3">
                              <input id="start_date" name="start_date" required="" type="text" class="form-control datepicker" placeholder="" value="<?php echo date('d-m-Y') ?>" >
                              <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
                              </div>
                          </div><!--./form-group-->
                      </div><!--./col-lg-4-->
                      <div class="col-lg-6 col-md-12 col-12">
                          <div class="form-group">
                              <label>Valid To</label>
                              <div class="input-group mb-3">
                              <input id="end_date" name="expire_date" required="" type="text" class="form-control datepicker" placeholder="" value="<?php echo date('d-m-Y') ?>" >
                              <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
                              </div>
                          </div><!--./form-group-->
                      </div><!--./col-lg-4-->
                    </div>
                    <div class="row">
                      <div class="col-lg-6 col-md-12 col-12">
                          <div class="form-group">
                              <label>Allow No of Use</label>
                              <div class="input-group mb-3">
                                <input required type="text" id="allow_count" name="allow_count" class="form-control" placeholder="Enter Allowed No of Use">
                              </div>
                          </div><!--./form-group-->
                      </div><!--./col-lg-6-->
                      <div class="col-lg-6 col-md-12 col-12">
                          <div class="form-group">
                              <label>Minimum Req Amt</label>
                              <div class="input-group mb-3">
                                <input required type="text" id="min_amount" name="min_amount" class="form-control" placeholder="Enter minimum amount to check">
                              </div>
                          </div><!--./form-group-->
                      </div><!--./col-lg-6-->
                    </div>
                    <div class="row">
                        <input type="hidden" name="serviceRowCount" id="serviceRowCount" value="0">
                        <div class="col-lg-12 col-md-12 col-12 text-center mb-3 mt-3">
                        <input type="submit" name="member_system"  value="Save" class="btn btn-primary waves-effect waves-light">
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

    function set_coupon_type(plan_type){
      // alert(plan_type);
      if(plan_type=="Services")
      {
        $('#addservice').show();
        // $('#serviceDiv').show();
        $('#discount_on_plan').hide();
      }
      else if((plan_type=="Fixed")||(plan_type=="Percentage"))
      {
        $('#addservice').hide();
        $('#serviceDiv').html('');
        $('#discount_on_plan').show();
        if(plan_type=="Fixed"){
          $('#discount_label').html('Discount Value');
        }else if(plan_type=="Percentage"){
          $('#discount_label').html('Discount %');
        }
      }
      else if((plan_type=="Free"))
      {
        $('#addservice').hide();
        $('#serviceDiv').html('');
        $('#discount_on_plan').hide();
        $('#Coupon_total').val(0);
        $('#Coupon_price').val(0);
      }
    }

    function addServiceRow(argument) {
      /*var options = '<?php if (!empty($service_group)) {foreach ($service_group as $group) {?><optgroup label="<?php echo $group->group_name ?>"><?php $services = DB::table('services')->where('group_id', $group->id)->get();if (!empty($services)) {foreach ($services as $service) {?><option value="{{ $service->id }}">{{ $service->name }}</option><?php }}?><?php }}?>';*/
      var groupoptions = '<?php if (!empty($service_group)) {foreach ($service_group as $group) {?><option value="<?php echo $group->id ?>"><?php echo $group->group_name ?></option><?php }}?>';
      // alert(options);<form></form>services_
      $("#serviceDiv").append('<div class="row servicerow"><div class="col-lg-3 col-md-12 col-12"><div class="form-group"><label>Service Categories</label><select title="Select" required name="servicegroups_'+$(".servicerow").length+'" id="servicegroups_'+$(".servicerow").length+'" class="form-control " onchange="getServices(this.value,'+$(".servicerow").length+')" data-live-search="true"><option value="">Select</option>'+groupoptions+'</select></div>  </div><div class="col-lg-3 col-md-12 col-12"><div class="form-group"><label>Service</label><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-heart-o"></i></span></div><input class="form-control" name="serviceName'+$(".servicerow").length+'" id="serviceName'+$(".servicerow").length+'" required ></div></div></div><div class="col-lg-6 col-md-12 col-12"><div class="row"><div class="col-lg-2 col-md-6 col-12"><div class="form-group"><label>Qty.</label><input name="serviceQuantity[]" type="text" class="form-control appendfocus" placeholder="" value="1" id="serviceQty'+$(".servicerow").length+'" onkeyup="calcutateDiscount('+$(".servicerow").length+')"></div></div>   <div class="col-lg-3 col-md-6 col-12"><div class="form-group"><label>Price <i class="fa fa-inr"></i></label><input name="services_'+$(".servicerow").length+'"  type="hidden" id="services_'+$(".servicerow").length+'"/><input name="brand_'+$(".servicerow").length+'"  type="hidden" id="brand_'+$(".servicerow").length+'"/><input name="servicesSgst[]" type="hidden" id="servicesSgst'+$(".servicerow").length+'" class="sgstCount"><input name="servicesCgst[]" type="hidden" id="servicesCgst'+$(".servicerow").length+'" class="cgstCount"><input name="servicePriceTotal[]" type="hidden" id="servicePriceTotal'+$(".servicerow").length+'" class="countTotal"><input name="servicePriceActualRate[]" type="hidden" id="servicePriceActualRate'+$(".servicerow").length+'" class=""><input name="servicePrice[]" type="text" class="form-control" placeholder="" id="servicePrice'+$(".servicerow").length+'" onkeyup="calcutateDiscount('+$(".servicerow").length+')"> </div></div>  <div class="col-lg-3 col-md-6 col-12"><div class="form-group"><label>Total <i class="fa fa-inr"></i></label><input name="serviceTotal[]" type="text" class="form-control totalprice" placeholder="" id="serviceTotal'+$(".servicerow").length+'"></div></div><div class="col-lg-1 col-md-6 col-12"><div class="form-group"><label style="display: block; visibility: hidden;">Totalsss</label><a href="javascript:void(0)" onclick="deleteServiceRow()"><i class="fa fa-trash-o mt-2"></i></a></div></div></div></div></div><div class="modal" id="selectMainService_'+$(".servicerow").length+'"><div class="modal-dialog modal-lg" id="servicegroupform" ><div class="modal-content"><div class="modal-header"><h4 class="modal-title">Add Group</h4><button type="button" class="close" data-dismiss="modal">&times;</button></div><input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>"><input value="" type="hidden" name="groupidfirm_'+($(".servicerow").length+1)+'" id="groupidfirm_'+($(".servicerow").length+1)+'"><!-- Modal body --><div class="modal-body formvisit"><div class="text-center" id="spinner_service" ><div class="spinner-border" style="width: 4rem; height: 4rem;" role="status"><span class="sr-only">Loading...</span> </div></div><div class="row"><!--./col-lg-4--><div class="col-lg-12 col-md-12 col-12" id="mainserviceDiv_'+($(".servicerow").length+1)+'"></div><div class="col-lg-12 col-md-12 col-12" id="groupserviceDiv_'+($(".servicerow").length+1)+'"></div><div class="col-lg-12 col-md-12 col-12" id="serviceBrandDiv_'+($(".servicerow").length+1)+'"></div></div><!--./row--></div><div class="modal-footer"><button type="button" class="outline-btn" data-dismiss="modal">Cancel</button><button type="button" onclick="showServiceBrandsPrice()" class="theme-btn">Save</button></div></div></div></div>');
      if ($(".servicerow").length == 1) {
        $(".serviceDivider").show();
      }
      $("#serviceRowCount").val($(".servicerow").length);
      $('#serviceDiv').children().last().find('.appendfocus').focus();
      $('.selectpicker').selectpicker();
    }

    function getServices(groupid,count) {
      if (groupid != "") {
        $.ajax({
          url:" {{ url('getServiceByGroup') }} ",
          data:{'groupid':groupid},
          type:'POST',
          // dataType:'JSON',
          success:function(res) {
            $('#spinner_service').hide();
            // alert(res);
            /*$("#services_"+count).html(res);
            $('#services_'+count).selectpicker('refresh'); */
            $("#selectMainService_"+count).modal({
                backdrop: 'static'
            });
            $("#groupidfirm_"+(++count)).val(groupid);
            showFirmService(groupid);
          }
        });
        // calculatecash();
      }
    }

    function showFirmService(groupid) {
      // alert(count)
      if (groupid != "") {
        var totalcount = $(".servicerow").length;
       //var groupid = $("#groupidfirm_"+totalcount).val();
        // alert(groupid)
        $.ajax({
          url:"{{ url('showFirmService') }}",
          type:'POST',
          data:{'groupid':groupid,'totalcount':totalcount},
          dataType:'JSON',
          success:function(res) {
            // alert(res.html)
            $("#mainserviceDiv_"+totalcount).html(res.html);
          }
        });
      }
    }

    function showGroupService(group_id,parentId) {
      // alert(parentId);
      var totalcount = $(".servicerow").length;
      if(group_id != ""){
        $.ajax({
          url:"{{ url('showGroupService') }}",
          type:'POST',
          data:{'groupid':group_id,'totalcount':totalcount,'parentId':parentId},
          dataType:'JSON',
          success:function(res) {
            // alert(res.html)
            $("#groupserviceDiv_"+totalcount).html(res.html);
          }
        });
      }
    }

    function showServiceBrands(service_id) {
      var totalcount = $(".servicerow").length;
      var count = $(".servicerow").length-1;
      if(service_id != ""){
        $.ajax({
          url:"{{ url('showServiceBrands') }}",
          type:'POST',
          data:{'service_id':service_id,'totalcount':totalcount},
          dataType:'JSON',
          success:function(res) {
            // alert(res.html)
            $("#serviceBrandDiv_"+totalcount).html(res.html);
            $("#services_"+count).val(service_id);
          }
        });
      }
    }

    function showServiceBrandsPrice() {
      $('#spinner_service').show();
      console.log('--------showServiceBrandsPrice------------');
      var totalcount = $(".servicerow").length-1;
      var totalcountss = $(".servicerow").length-1;
      var totalcountnew = $(".servicerow").length;
      //  alert(totalcount);
      var brand_id = $("#groupServiess_"+totalcountnew).val();

      var array = JSON.parse("[" + brand_id + "]");
      // $('#serviceDiv').html('');
        $.each(array, function (i) {
        // alert(i);
        // i=j-totalcount;
        // alert(i);
        if(array[i] != ""){
            $.ajax({
            url:"{{ url('showServiceBrandsPrice') }}",
            type:'POST',
            data:{'brand_id':array[i]},
            dataType:'JSON',
            success:function(res) {
                console.log('--------response ---------------showServiceBrandsPrice------------');
                console.log(res);
                //alert("#servicePrice"+totalcount);service_id
                //  alert(res.service_id);
                $("#brand_"+totalcount).val(array[i]);

                $("#servicePrice"+totalcount).val(res.service_price);
                $("#servicePriceActualRate"+totalcount).val(res.service_price);
                $("#serviceName"+totalcount).val(res.brand_name);
                $("#services_"+totalcount).val(res.brand_id);
                addServiceRow(totalcount);
                $("#servicegroups_"+totalcount).val(res.service_id);
                $("#servicegroups_"+totalcount).find('option[value="'+res.service_id+'"]').attr('selected', true);
                calcutateDiscount(totalcount);
                totalcount++;
            }
            });
         }
        });

        setTimeout(function() {
            $("#selectMainService_"+totalcountss).modal('hide');
            deleteServiceRow();
            deleteServiceRow();
            }, 1000);
    }

    function deleteServiceRow() {
      // alert('asd');
      $("#serviceDiv").children().last().remove();
      if ($(".servicerow").length == 0) {
        $(".serviceDivider").hide();
      }
      calcualte_plan_price();
    }

    function calcutateDiscount(count) {
      var sgst = parseFloat(0);
      var cgst = parseFloat(0);
    //   var disc = $("#serviceDisc"+count).val();
    //   if(disc==''){disc=0;}
      var price = $("#servicePrice"+count).val();
      if(price==''){price=0;}
      var qty = 1;
      if(qty==''){qty=0;}
      var total = parseFloat(price) * parseFloat(qty);
     //   var totaldiscount = (parseFloat(total).toFixed(2) * parseFloat(disc).toFixed(2))/100;
     var totaldiscount=0;
      total = parseFloat(total) - parseFloat(totaldiscount);
      $("#servicePriceTotal"+count).val(parseFloat(total).toFixed(2));
      var totalsgst = (parseFloat(total) * parseFloat(sgst))/100;
      var totalcgst = (parseFloat(total) * parseFloat(cgst))/100;
      total = parseFloat(total) + parseFloat(totalsgst) + parseFloat(totalcgst);
      $("#serviceTotal"+count).val(parseFloat(total).toFixed(2));
      /*$("#totalsgstval").html(parseFloat(totalsgst));
      $("#totalcgstval").html(parseFloat(totalcgst));*/
      $("#servicesSgst"+count).val(parseFloat(totalsgst).toFixed(2));
      $("#servicesCgst"+count).val(parseFloat(totalcgst).toFixed(2));
      calcualte_plan_price();
    }

    function calcualte_plan_price(){
      let subtotal=0;
      $('.countTotal').each(function() {
        subtotal += parseFloat(this.value);
        // $("#combo_price").html(parseFloat(subtotal).toFixed(2));
        $("#Coupon_total").val(parseFloat(subtotal).toFixed(2));
      });
    }

</script>





@endsection