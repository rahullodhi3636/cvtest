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
                            <h5 class="card-title">Edit Bridal Pack <i class="fa fa-pencil"></i></h5>
                        </div>
                    </div>
                    <!--./col-lg-6-->
                </div>
                <!--./row-->
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
                    <form id="addSittingPackForm" action="{{route('SittingPack.update',$sitting_Pack->id)}}"
                        method="post" class="formvisit mt-2">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        @method('patch')
                        <div class="row">
                            <div class="col-lg-4 col-md-12 col-12">
                                <div class="form-group">
                                    <label>Package Name</label>
                                    <div class="input-group mb-3">
                                        <input required type="text" id="pack_name" name="pack_name" class="form-control"
                                            placeholder="Enter Pack Name" value="{{$sitting_Pack->pack_name}}">
                                    </div>
                                </div>
                                <!--./form-group-->
                            </div>
                            <!--./col-lg-8-->

                            <div class="col-lg-8 col-md-12 col-12" id="addservice">
                                <div class="form-group pull-right">
                                    <label>.</label>
                                    <div class="input-group mb-3">
                                        <a onclick="addSittingRow()" href="javascript:void(0)" class="theme-btn mr-3">
                                            <i class="fa fa-plus"></i>Sitting
                                        </a>
                                        <a onclick="addMakeupRow()" href="javascript:void(0)" class="theme-btn ml-3">
                                            <i class="fa fa-plus"></i>Makeup
                                        </a>
                                    </div>

                                </div>
                                <!--./form-group-->
                            </div>
                            <!--./col-lg-4-->
                        </div>
                        <!--./row-->
                        @php

                        $pack_services = DB::table('sittingpack')
                        ->select('SB.brand_name as sbname', 'PS.*','PS.id as sittingpack_service_id',
                        'sittingpack.*','SG.id as groupid')
                        ->leftJoin('sittingpack_service AS PS', 'PS.sittingpack_id', '=', 'sittingpack.id')
                        ->leftJoin('service_brands AS SB', 'SB.service_brand_id', '=', 'PS.service_id')
                        ->leftJoin('service_group AS SG','SB.service_id','=','SG.id')
                        ->where('PS.sittingpack_id', $sitting_Pack->id)
                        ->get();

                        if(count($pack_services)>0){
                            $existing_sit_round= $pack_services->last()->sitting_round;
                        }else{
                            $existing_sit_round= 0;
                        }


                        //echo $existing_sit_round;
                        //die;



                        $pack_makeup_services = DB::table('sittingpack')
                          ->select('SB.brand_name as sbname', 'PS.*', 'PS.id as sittingpack_makeupservice_id', 'sittingpack.*','SG.id as groupid')
                          ->leftJoin('sittingpack_makeupservice AS PS', 'PS.sittingpack_id', '=', 'sittingpack.id')
                          ->leftJoin('service_brands AS SB', 'SB.service_brand_id', '=', 'PS.service_id')
                          ->leftJoin('service_group AS SG','SB.service_id','=','SG.id')
                          ->where('PS.sittingpack_id', $sitting_Pack->id)
                          ->get();

                        $existing_makeup_round= $pack_makeup_services->last()->makeup_round;

                        @endphp

                        <div class="col-lg-12">
                            <div id="sittingDiv">
                                <!-- <p>sitting div</p> -->

                                @for ($round = 1; $round <= $existing_sit_round; $round++)
                                <div
                                    class="col-lg-12 col-md-12 col-12 sittingDivRow">
                                    <h6>Sitting {{$round}}</h6>
                                    <div class="divider serviceDivider">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12 col-12" id="addservice">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <a onclick="addServiceRow('{{$round}}')" href="javascript:void(0)"
                                                class="theme-btn">
                                                <i class="fa fa-plus"></i>Services
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div id="serviceDiv{{$round}}">
                                    @foreach($pack_services as $packservice)
                                        @php $sittingpack_service_id=($loop->index)+1;  @endphp
                                        @if($round==$packservice->sitting_round)
                                        <div class="row servicerow" id="servicerow_count<?php echo $sittingpack_service_id; ?>">
                                            <div class="col-lg-3 col-md-12 col-12">
                                                <div class="form-group">
                                                    <label>Service Categories</label>
                                                    <select title="Select" required
                                                        name="sit<?php echo $round; ?>servicegroups[]"
                                                        id="servicegroups_<?php echo $sittingpack_service_id; ?>"
                                                        class="form-control "
                                                        onchange="getServices(this.value,<?php echo $sittingpack_service_id; ?>)"
                                                        data-live-search="true">
                                                        @foreach($service_group as $group)
                                                        <option value="{{$group->id}}" @if( ($packservice->groupid) ==
                                                            ($group->id)) {{ 'selected' }} @endif >{{$group->group_name}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-12 col-12">
                                                <div class="form-group">
                                                    <label>Service</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-heart-o"></i></span>
                                                        </div>
                                                        <input class="form-control"
                                                            name="sit<?php echo $round; ?>serviceName[]"
                                                            id="serviceName<?php echo $sittingpack_service_id;?>" required
                                                            value="{{$packservice->sbname}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-12">
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label>Qty.</label>
                                                            <input name="sit<?php echo $round; ?>serviceQuantity[]"
                                                                type="text" class="form-control appendfocus" placeholder=""
                                                                id="serviceQty<?php echo $sittingpack_service_id; ?>"
                                                                onkeyup="calcutateDiscount(<?php echo $sittingpack_service_id; ?>)"
                                                                value="{{$packservice->quantity}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label>Price <i class="fa fa-inr"></i></label>
                                                            <input name="sit$<?php echo $round; ?>services[]"
                                                                type="hidden" value="{{$packservice->service_id}}"
                                                                id="services_<?php echo $sittingpack_service_id; ?>" />
                                                            <input name="sit$<?php echo $round; ?>brand[]"
                                                                type="hidden" value="{{$packservice->brand_id}}"
                                                                id="brand_<?php echo $sittingpack_service_id; ?>" />
                                                            <input name="sit$<?php echo $round; ?>servicesSgst[]"
                                                                type="hidden" value="{{$packservice->sgst}}"
                                                                id="servicesSgst<?php echo $sittingpack_service_id; ?>"
                                                                class="sgstCount">
                                                            <input name="sit$<?php echo $round; ?>servicesCgst[]"
                                                                type="hidden" value="{{$packservice->cgst}}"
                                                                id="servicesCgst<?php echo $sittingpack_service_id; ?>"
                                                                class="cgstCount">
                                                            <input
                                                                name="sit$<?php echo $round; ?>servicePriceTotal[]"
                                                                type="hidden"
                                                                id="servicePriceTotal<?php echo $sittingpack_service_id; ?>"
                                                                class="countTotal">
                                                            <input
                                                                name="sit$<?php echo $round; ?>servicePriceActualRate[]"
                                                                type="hidden"
                                                                id="servicePriceActualRate<?php echo $sittingpack_service_id; ?>"
                                                                class="">
                                                            <input name="sit$<?php echo $round; ?>servicePrice[]"
                                                                type="text" class="form-control" placeholder=""
                                                                value="{{$packservice->price}}"
                                                                id="servicePrice<?php echo $sittingpack_service_id; ?>"
                                                                onkeyup="calcutateDiscount(<?php echo $sittingpack_service_id; ?>)">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label>Total <i class="fa fa-inr"></i></label>
                                                            <input name="sit<?php echo $round; ?>serviceTotal[]"
                                                                type="text" class="form-control totalprice"
                                                                value="{{$packservice->total_price}}"
                                                                id="serviceTotal<?php echo $sittingpack_service_id; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-1 col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label style="display: block; visibility: hidden;">Totalsss</label>
                                                            <a href="javascript:void(0)" class="btn btn-danger"
                                                                onclick="deleteServiceRow(<?php echo $sittingpack_service_id; ?>)"><i
                                                                    class="fa fa-trash-o mt-2"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal" id="selectMainService_<?php echo $sittingpack_service_id; ?>">
                                            <div class="modal-dialog modal-lg" id="servicegroupform">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Add Group</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                                    <input value="" type="hidden"
                                                        name="sit<?php echo $round; ?>groupidfirm_<?php echo $sittingpack_service_id; ?>"
                                                        id="groupidfirm_<?php echo $sittingpack_service_id; ?>">
                                                    <!-- Modal body -->
                                                    <div class="modal-body formvisit">
                                                        <div class="text-center" id="spinner_service">
                                                            <div class="spinner-border" style="width: 4rem; height: 4rem;"
                                                                role="status">
                                                                <span class="sr-only">Loading...</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <!--./col-lg-4-->
                                                            <div class="col-lg-12 col-md-12 col-12"
                                                                id="mainserviceDiv_<?php echo $sittingpack_service_id; ?>">
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-12"
                                                                id="groupserviceDiv_<?php echo $sittingpack_service_id; ?>">
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-12"
                                                                id="serviceBrandDiv_<?php echo $sittingpack_service_id; ?>">
                                                            </div>
                                                        </div>
                                                        <!--./row-->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="outline-btn"
                                                            data-dismiss="modal">Cancel</button>
                                                        <button type="button" onclick="showServiceBrandsPrice('{{$round}}')"
                                                            class="theme-btn">save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                     @endforeach
                                    </div>
                                </div>
                            @endfor
                        </div>
                </div>

                <div class="col-lg-12">
                    <div id="MakeupDiv">
                        <!-- <p>sitting div</p> -->
                        @for ($mkp_round = 1; $mkp_round <= $existing_makeup_round; $mkp_round++)
                            <div class="col-lg-12 col-md-12 col-12 MakeUpDivRow" >
                                <h6>Makeup {{$mkp_round}}</h6>
                                <div class="divider makeupserviceDivider">
                                </div>
                              </div>
                            <div class="col-lg-4 col-md-12 col-12" id="addMakeUpservice">
                              <div class="form-group">
                                  <div class="input-group mb-3">
                                    <a onclick="addMakeupserviceRow({{$mkp_round}})" href="javascript:void(0)" class="theme-btn">
                                    <i class="fa fa-plus"></i>Makeup
                                    </a>
                                  </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div id="makeupserviceDiv{{$mkp_round}}">
                                  @foreach($pack_makeup_services as $makeup_service)
                                    @php $mkp_row_id=($loop->index)+1;  @endphp
                                    @if($mkp_round==$makeup_service->makeup_round)
                                    <div class="row Makeupservicerow" id="Makeupservicerow_count<?php echo $mkp_round; ?>">
                                        <div class="col-lg-3 col-md-12 col-12">
                                          <div class="form-group">
                                            <label>Service Categories</label>
                                            <select title="Select" required name="makeup<?php echo $mkp_round; ?>servicegroups[]" id="makeupservicegroups_<?php echo $mkp_row_id; ?>" class="form-control " onchange="getServicesformakeup(this.value,<?php echo $mkp_row_id; ?>)" data-live-search="true">
                                              @foreach($service_group as $group)
                                              <option value="{{$group->id}}" @if( ($makeup_service->groupid) == ($group->id)) {{ 'selected' }} @endif >{{$group->group_name}}</option>
                                              @endforeach
                                            </select>
                                          </div>
                                        </div>
                                        <div class="col-lg-3 col-md-12 col-12">
                                          <div class="form-group">
                                            <label>Service</label>
                                            <div class="input-group mb-3">
                                              <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-heart-o"></i></span>
                                              </div>
                                              <input class="form-control" name="makeup<?php echo $mkp_round; ?>serviceName[]" id="makeupserviceName<?php echo $mkp_row_id; ?>" required value="{{$makeup_service->sbname}}" >
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-12">
                                            <div class="row">
                                              <div class="col-lg-2 col-md-6 col-12">
                                                <div class="form-group">
                                                  <label>Qty.</label>
                                                  <input name="makeup<?php echo $mkp_round; ?>serviceQuantity[]" type="text" class="form-control appendfocus" placeholder="" value="1" id="makeupserviceQty<?php echo $mkp_row_id; ?>" onkeyup="calcutateDiscountformakeup(<?php echo $mkp_row_id; ?>)" value="{{$makeup_service->quantity}}">
                                                </div>
                                              </div>
                                              <div class="col-lg-3 col-md-6 col-12">
                                                <div class="form-group">
                                                  <label>Price <i class="fa fa-inr"></i></label>
                                                  <input name="makeup<?php echo $mkp_round; ?>services[]"  type="hidden" id="makeupservices_<?php echo $mkp_row_id; ?>"/ value="{{$makeup_service->service_id}}">
                                                  <input name="makeup<?php echo $mkp_round; ?>brand[]"  type="hidden" id="makeupbrand_<?php echo $mkp_row_id; ?>" value="{{$makeup_service->brand_id}}"/>
                                                  <input name="makeup<?php echo $mkp_round; ?>servicesSgst[]" type="hidden" value="{{$makeup_service->sgst}}" id="makeupservicesSgst<?php echo $mkp_row_id; ?>" class="sgstCount">
                                                  <input name="makeup<?php echo $mkp_round; ?>servicesCgst[]" type="hidden" value="{{$makeup_service->cgst}}" id="makeupservicesCgst<?php echo $mkp_row_id; ?>" class="cgstCount">
                                                  <input name="makeup<?php echo $mkp_round; ?>servicePriceTotal[]" type="hidden" value="{{$makeup_service->cgst}}" id="makeupservicePriceTotal<?php echo $mkp_row_id; ?>" class="countTotal">
                                                  <input name="makeup<?php echo $mkp_round; ?>servicePriceActualRate[]" type="hidden" id="makeupservicePriceActualRate<?php echo $mkp_row_id; ?>" class="">
                                                  <input name="makeup<?php echo $mkp_round; ?>servicePrice[]" type="text" value="{{$makeup_service->price}}" class="form-control" placeholder="" id="makeupservicePrice<?php echo $mkp_row_id; ?>" onkeyup="calcutateDiscountformakeup(<?php echo $mkp_row_id; ?>)">
                                                </div>
                                              </div>
                                              <div class="col-lg-3 col-md-6 col-12">
                                                <div class="form-group">
                                                  <label>Total <i class="fa fa-inr"></i></label>
                                                  <input name="makeup<?php echo $mkp_round; ?>serviceTotal[]" type="text" class="form-control totalprice" placeholder="" id="makeupserviceTotal<?php echo $mkp_row_id; ?>" value="{{$makeup_service->total_price}}">
                                                </div>
                                              </div>
                                              <div class="col-lg-1 col-md-6 col-12">
                                                <div class="form-group">
                                                  <label style="display: block; visibility: hidden;">Totalsss</label>
                                                  <a href="javascript:void(0)" class="btn btn-danger" onclick="deleteMakeupservicerow(<?php echo $mkp_row_id; ?>)"><i class="fa fa-trash-o mt-2"></i></a>
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal" id="makeupselectMainService_<?php echo $mkp_row_id; ?>">
                                      <div class="modal-dialog modal-lg" id="makeupservicegroupform" >
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h4 class="modal-title">Add Group</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          </div>
                                          <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                                          <input value="" type="hidden" name="makeup<?php echo $mkp_round; ?>groupidfirm_<?php echo $mkp_row_id; ?>" id="makeupgroupidfirm_<?php echo $mkp_row_id; ?>">
                                          <!-- Modal body -->
                                          <div class="modal-body formvisit">
                                            <div class="text-center" id="spinner_service" >
                                              <div class="spinner-border" style="width: 4rem; height: 4rem;" role="status">
                                                <span class="sr-only">Loading...</span>
                                              </div>
                                            </div>
                                            <div class="row">
                                              <!--./col-lg-4-->
                                              <div class="col-lg-12 col-md-12 col-12" id="makeupmainserviceDiv_<?php echo $mkp_row_id; ?>">
                                              </div>
                                              <div class="col-lg-12 col-md-12 col-12" id="makeupgroupserviceDiv_<?php echo $mkp_row_id; ?>">
                                              </div>
                                              <div class="col-lg-12 col-md-12 col-12" id="makeupserviceBrandDiv_<?php echo $mkp_row_id; ?>">
                                              </div>
                                            </div>
                                            <!--./row-->
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="outline-btn" data-dismiss="modal">Cancel</button>
                                            <button type="button" onclick="showServiceBrandsPriceformakeup(<?php echo $mkp_row_id; ?>)" class="theme-btn">Save</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    @endif
                                  @endforeach
                                </div>
                            </div>

                        @endfor

                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-12 col-12">
                        <div class="form-group">
                            <label>Total Members</label>
                            <div class="input-group mb-3">
                                <input required type="text" id="total_members" name="total_members" class="form-control"
                                    placeholder="Enter Combo Members" value="{{$sitting_Pack->total_members}}">
                            </div>
                        </div>
                        <!--./form-group-->
                    </div>
                    <!--./col-lg-4-->
                    <div class="col-lg-4 col-md-12 col-12">
                        <div class="form-group">
                            <label>Grand Total</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-inr"></i></span>
                                </div>
                                <input required type="text" id="grand_total" name="grand_total" class="form-control"
                                value="{{$sitting_Pack->grand_total}}">
                            </div>
                        </div>
                        <!--./form-group-->
                    </div>
                    <!--./col-lg-4-->
                    <div class="col-lg-4 col-md-12 col-12">
                        <div class="form-group">
                            <label>Package Final Price</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-inr"></i></span>
                                </div>
                                <input required type="text" id="pack_final_price" name="pack_final_price"
                                    class="form-control" value="{{$sitting_Pack->pack_final_price}}">
                            </div>
                        </div>
                        <!--./form-group-->
                    </div>
                    <!--./col-lg-4-->

                </div>

                <div class="row">
                    <input type="hidden" name="sittingDivCount" id="sittingDivCount" value="0">
                    <input type="hidden" name="serviceRowCount" id="serviceRowCount" value="0">
                    <input type="hidden" name="MakeUpDivCount" id="MakeUpDivCount" value="0">
                    <input type="hidden" name="MakeUpserviceRowCount" id="MakeUpserviceRowCount" value="0">
                    <div class="col-lg-12 col-md-12 col-12 text-center mb-3 mt-3">
                        <input type="submit" name="pack_with_service" value="Update"
                            class="btn btn-primary waves-effect waves-light">
                    </div>
                </div>
                </form>
            </div>
            <!--./col-lg-12-->
        </div>
        <!--./boxbody-->
    </div>
    <!--./container-fluid-->

    <footer>
        Copyright © 2020 Chinnie & Vinnie Jabalpur Salon. All rights reserved.
    </footer>
</div>
<!--./main-content-->
</div>
<!--./main-->
<script src="{{asset('assets/js/lib/jquery.js')}}"></script>
<script src="{{asset('assets/js/dist/jquery.validate.js')}}"></script>
<script>
let round= <?php if(count($pack_services)>0){ echo $pack_services->last()->sitting_round;}else{ echo 0;} ?>
function addSittingRow() {
    round += 1;
    let servicebutton = `<div class="col-lg-12 col-md-12 col-12 sittingDivRow" >
                            <h6>Sitting ${round}</h6>
                            <div class="divider serviceDivider">
                            </div>
                          </div>
                        <div class="col-lg-4 col-md-12 col-12" id="addservice">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                  <a onclick="addServiceRow(${round})" href="javascript:void(0)" class="theme-btn">
                                  <i class="fa fa-plus"></i>Services
                                  </a>
                                </div>
                              </div>
                          </div>
                          <div class="col-lg-12">
                              <div id="serviceDiv${round}">

                              </div>
                          </div>
                          `;
    $("#sittingDiv").append(servicebutton);
    $("#sittingDivCount").val($(".sittingDivRow").length);
    console.log($("#sittingDivCount").val());
}



function addServiceRow(r_val) {
    // alert(r_val);
    /*var options = '<?php if (!empty($service_group)) {foreach ($service_group as $group) {?><optgroup label="<?php echo $group->group_name ?>"><?php $services = DB::table('services')->where('group_id', $group->id)->get();if (!empty($services)) {foreach ($services as $service) {?><option value="{{ $service->id }}">{{ $service->name }}</option><?php }}?><?php }}?>';*/
    var groupoptions =
        '<?php if (!empty($service_group)) {foreach ($service_group as $group) {?><option value="<?php echo $group->id ?>"><?php echo $group->group_name ?></option><?php }}?>';
    // alert(options);<form></form>services_
    // let counting_val=$(".servicerow").length;
    let service_row_html = `<div class="row servicerow" id="servicerow_count${r_val}">
                              <div class="col-lg-3 col-md-12 col-12">
                                <div class="form-group">
                                  <label>Service Categories</label>
                                  <select title="Select" required name="sit${r_val}servicegroups[]" id="servicegroups_${$(".servicerow").length}" class="form-control " onchange="getServices(this.value,${$(".servicerow").length})" data-live-search="true">
                                  <option value="">Select</option>${groupoptions}
                                  </select>
                                </div>
                              </div>
                              <div class="col-lg-3 col-md-12 col-12">
                                <div class="form-group">
                                  <label>Service</label>
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fa fa-heart-o"></i></span>
                                    </div>
                                    <input class="form-control" name="sit${r_val}serviceName[]" id="serviceName${$(".servicerow").length}" required >
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-6 col-md-12 col-12">
                                  <div class="row">
                                    <div class="col-lg-2 col-md-6 col-12">
                                      <div class="form-group">
                                        <label>Qty.</label>
                                        <input name="sit${r_val}serviceQuantity[]" type="text" class="form-control appendfocus" placeholder="" value="1" id="serviceQty${$(".servicerow").length}" onkeyup="calcutateDiscount(${$(".servicerow").length})">
                                      </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-12">
                                      <div class="form-group">
                                        <label>Price <i class="fa fa-inr"></i></label>
                                        <input name="sit${r_val}services[]"  type="hidden" id="services_${$(".servicerow").length}"/>
                                        <input name="sit${r_val}brand[]"  type="hidden" id="brand_${$(".servicerow").length}"/>
                                        <input name="sit${r_val}servicesSgst[]" type="hidden" id="servicesSgst${$(".servicerow").length}" class="sgstCount">
                                        <input name="sit${r_val}servicesCgst[]" type="hidden" id="servicesCgst${$(".servicerow").length}" class="cgstCount">
                                        <input name="sit${r_val}servicePriceTotal[]" type="hidden" id="servicePriceTotal${$(".servicerow").length}" class="countTotal">
                                        <input name="sit${r_val}servicePriceActualRate[]" type="hidden" id="servicePriceActualRate${$(".servicerow").length}" class="">
                                        <input name="sit${r_val}servicePrice[]" type="text" class="form-control" placeholder="" id="servicePrice${$(".servicerow").length}" onkeyup="calcutateDiscount(${$(".servicerow").length})">
                                      </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-12">
                                      <div class="form-group">
                                        <label>Total <i class="fa fa-inr"></i></label>
                                        <input name="sit${r_val}serviceTotal[]" type="text" class="form-control totalprice" placeholder="" id="serviceTotal${$(".servicerow").length}">
                                      </div>
                                    </div>
                                    <div class="col-lg-1 col-md-6 col-12">
                                      <div class="form-group">
                                        <label style="display: block; visibility: hidden;">Totalsss</label>
                                        <a href="javascript:void(0)" class="btn btn-danger" onclick="deleteServiceRow(${$(".servicerow").length})"><i class="fa fa-trash-o mt-2"></i></a>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                            </div>
                            <div class="modal" id="selectMainService_${$(".servicerow").length}">
                              <div class="modal-dialog modal-lg" id="servicegroupform" >
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title">Add Group</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>
                                  <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                                  <input value="" type="hidden" name="sit${r_val}groupidfirm_${($(".servicerow").length+1)}" id="groupidfirm_${($(".servicerow").length+1)}">
                                  <!-- Modal body -->
                                  <div class="modal-body formvisit">
                                    <div class="text-center" id="spinner_service" >
                                      <div class="spinner-border" style="width: 4rem; height: 4rem;" role="status">
                                        <span class="sr-only">Loading...</span>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <!--./col-lg-4-->
                                      <div class="col-lg-12 col-md-12 col-12" id="mainserviceDiv_${($(".servicerow").length+1)}">
                                      </div>
                                      <div class="col-lg-12 col-md-12 col-12" id="groupserviceDiv_${($(".servicerow").length+1)}">
                                      </div>
                                      <div class="col-lg-12 col-md-12 col-12" id="serviceBrandDiv_${($(".servicerow").length+1)}">
                                      </div>
                                    </div>
                                    <!--./row-->
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="outline-btn" data-dismiss="modal">Cancel</button>
                                    <button type="button" onclick="showServiceBrandsPrice(${r_val})" class="theme-btn">Save</button>
                                  </div>
                                </div>
                              </div>
                            </div>`;
    $("#serviceDiv" + r_val).append(service_row_html);
    // if ($(".servicerow").length == 1) {
    //   $(".serviceDivider").show();
    // }
    $("#serviceRowCount").val($(".servicerow").length);
    $('#serviceDiv').children().last().find('.appendfocus').focus();
    $('.selectpicker').selectpicker();
}

function getServices(groupid, count) {
    console.log(groupid);
    if (groupid != "") {
        $.ajax({
            url: " {{ url('getServiceByGroup') }} ",
            data: {
                'groupid': groupid
            },
            type: 'POST',
            // dataType:'JSON',
            success: function(res) {
                console.log(res);
                $('#spinner_service').hide();
                // alert(res);
                /*$("#services_"+count).html(res);
                $('#services_'+count).selectpicker('refresh'); */
                $("#selectMainService_" + count).modal({
                    backdrop: 'static'
                });
                $("#groupidfirm_" + (++count)).val(groupid);
                showFirmService(groupid);
            }
        });
        // calculatecash();
    }
}

function showFirmService(groupid) {
    // alert(groupid);
    $('#spinner_service').hide();
    if (groupid != "") {
        var totalcount = $(".servicerow").length;
        //var groupid = $("#groupidfirm_"+totalcount).val();
        // alert(groupid)
        $.ajax({
            url: "{{ url('showFirmService') }}",
            type: 'POST',
            data: {
                'groupid': groupid,
                'totalcount': totalcount
            },
            dataType: 'JSON',
            success: function(res) {
                console.log(res.html)
                // alert('res');
                $("#mainserviceDiv_" + totalcount).html(res.html);
            }
        });
    }
}

function showGroupService(group_id, parentId) {
    // alert(parentId);
    $('#spinner_service').hide();
    var totalcount = $(".servicerow").length;
    if (group_id != "") {
        $.ajax({
            url: "{{ url('showGroupService') }}",
            type: 'POST',
            data: {
                'groupid': group_id,
                'totalcount': totalcount,
                'parentId': parentId
            },
            dataType: 'JSON',
            success: function(res) {
                // alert(res.html)
                $("#groupserviceDiv_" + totalcount).html(res.html);
            }
        });
    }
}

function showServiceBrands(service_id) {
    $('#spinner_service').hide();
    var totalcount = $(".servicerow").length;
    var count = $(".servicerow").length - 1;
    if (service_id != "") {
        $.ajax({
            url: "{{ url('showServiceBrands') }}",
            type: 'POST',
            data: {
                'service_id': service_id,
                'totalcount': totalcount
            },
            dataType: 'JSON',
            success: function(res) {
                // alert(res.html)
                $("#serviceBrandDiv_" + totalcount).html(res.html);
                $("#services_" + count).val(service_id);
            }
        });
    }
}

function showServiceBrandsPrice(sit_count) {
    $('#spinner_service').show();
    console.log('--------showServiceBrandsPrice------------');
    var totalcount = $(".servicerow").length - 1;
    var totalcountss = $(".servicerow").length - 1;
    var totalcountnew = $(".servicerow").length;
    //  alert(totalcount);
    var brand_id = $("#groupServiess_" + totalcountnew).val();

    var array = JSON.parse("[" + brand_id + "]");
    // $('#serviceDiv').html('');
    $.each(array, function(i) {
        // alert(i);
        // i=j-totalcount;
        // alert(i);
        if (array[i] != "") {
            $.ajax({
                url: "{{ url('showServiceBrandsPrice') }}",
                type: 'POST',
                data: {
                    'brand_id': array[i]
                },
                dataType: 'JSON',
                success: function(res) {
                    console.log(
                        '--------response ---------------showServiceBrandsPrice------------');
                    console.log(res);
                    $('#spinner_service').hide();
                    //alert("#servicePrice"+totalcount);service_id
                    //  alert(res.service_id);
                    $("#brand_" + totalcount).val(array[i]);

                    $("#servicePrice" + totalcount).val(res.service_price);
                    $("#servicePriceActualRate" + totalcount).val(res.service_price);
                    $("#serviceName" + totalcount).val(res.brand_name);
                    $("#services_" + totalcount).val(res.brand_id);
                    // console.log(totalcount);
                    addServiceRow(sit_count);
                    $("#servicegroups_" + totalcount).val(res.service_id);
                    $("#servicegroups_" + totalcount).find('option[value="' + res.service_id + '"]')
                        .attr('selected', true);
                    calcutateDiscount(totalcount);
                    totalcount++;
                }
            });
        }
    });

    setTimeout(function() {
        $('#spinner_service').hide();
        $("#selectMainService_" + totalcountss).modal('hide');
        deleteService_Row(sit_count);
        deleteService_Row(sit_count);
    }, 1000);
}

function deleteService_Row(del_row_count) {
    // alert('asd');
    $("#serviceDiv" + del_row_count).children().last().remove();
    // $('#servicerow_count'+del_row_count).remove();
    if ($(".servicerow").length == 0) {
        $(".serviceDivider").hide();
    }
    calculate_pack_grand_total();
}

function deleteServiceRow(del_row_count) {
    // alert('asd');
    // $("#serviceDiv" + del_row_count).children().last().remove();
    $('#servicerow_count'+del_row_count).remove();
    if ($(".servicerow").length == 0) {
        $(".serviceDivider").hide();
    }
    calculate_pack_grand_total();
}

function calcutateDiscount(count) {
    var sgst = parseFloat(0);
    var cgst = parseFloat(0);
    //   var disc = $("#serviceDisc"+count).val();
    //   if(disc==''){disc=0;}
    var price = $("#servicePrice" + count).val();
    if (price == '') {
        price = 0;
    }
    var qty = $("#serviceQty" + count).val();
    if (qty == '') {
        qty = 0;
    }
    var total = parseFloat(price) * parseFloat(qty);
    //   var totaldiscount = (parseFloat(total).toFixed(2) * parseFloat(disc).toFixed(2))/100;
    var totaldiscount = 0;
    total = parseFloat(total) - parseFloat(totaldiscount);
    $("#servicePriceTotal" + count).val(parseFloat(total).toFixed(2));
    var totalsgst = (parseFloat(total) * parseFloat(sgst)) / 100;
    var totalcgst = (parseFloat(total) * parseFloat(cgst)) / 100;
    total = parseFloat(total) + parseFloat(totalsgst) + parseFloat(totalcgst);
    $("#serviceTotal" + count).val(parseFloat(total).toFixed(2));
    /*$("#totalsgstval").html(parseFloat(totalsgst));
    $("#totalcgstval").html(parseFloat(totalcgst));*/
    $("#servicesSgst" + count).val(parseFloat(totalsgst).toFixed(2));
    $("#servicesCgst" + count).val(parseFloat(totalcgst).toFixed(2));
    calculate_pack_grand_total();
}

function calculate_pack_grand_total() {
    let subtotal = 0;
    $('.countTotal').each(function() {
        subtotal += parseFloat(this.value);
        $("#grand_total").html(parseFloat(subtotal).toFixed(2));
        $("#grand_total").val(parseFloat(subtotal).toFixed(2));
    });
}

let makeup_round=<?php echo $pack_makeup_services->last()->makeup_round;?>;

function addMakeupRow() {
    // alert('addMakeupRow');
    makeup_round += 1;
    let Makeupservicebutton = `<div class="col-lg-12 col-md-12 col-12 MakeUpDivRow" >
                            <h6>Makeup ${makeup_round}</h6>
                            <div class="divider makeupserviceDivider">
                            </div>
                          </div>
                        <div class="col-lg-4 col-md-12 col-12" id="addMakeUpservice">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                  <a onclick="addMakeupserviceRow(${makeup_round})" href="javascript:void(0)" class="theme-btn">
                                  <i class="fa fa-plus"></i>Makeup
                                  </a>
                                </div>
                              </div>
                          </div>
                          <div class="col-lg-12">
                              <div id="makeupserviceDiv${makeup_round}">

                              </div>
                          </div>
                          `;
    $("#MakeupDiv").append(Makeupservicebutton);
    $("#MakeUpDivCount").val($(".MakeUpDivRow").length);
    console.log($("#MakeUpDivCount").val());
}


function addMakeupserviceRow(row_val) {
    /*var options = '<?php if (!empty($service_group)) {foreach ($service_group as $group) {?><optgroup label="<?php echo $group->group_name ?>"><?php $services = DB::table('services')->where('group_id', $group->id)->get();if (!empty($services)) {foreach ($services as $service) {?><option value="{{ $service->id }}">{{ $service->name }}</option><?php }}?><?php }}?>';*/
    var groupoptions =
        '<?php if (!empty($service_group)) {foreach ($service_group as $group) {?><option value="<?php echo $group->id ?>"><?php echo $group->group_name ?></option><?php }}?>';
    // alert(options);<form></form>services_
    // let counting_val=$(".servicerow").length;
    let Makeupservice_row_html = `<div class="row Makeupservicerow" id="Makeupservicerow_count${row_val}">
                              <div class="col-lg-3 col-md-12 col-12">
                                <div class="form-group">
                                  <label>Service Categories</label>
                                  <select title="Select" required name="makeup${row_val}servicegroups[]" id="makeupservicegroups_${$(".Makeupservicerow").length}" class="form-control " onchange="getServicesformakeup(this.value,${$(".Makeupservicerow").length})" data-live-search="true">
                                  <option value="">Select</option>${groupoptions}
                                  </select>
                                </div>
                              </div>
                              <div class="col-lg-3 col-md-12 col-12">
                                <div class="form-group">
                                  <label>Service</label>
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fa fa-heart-o"></i></span>
                                    </div>
                                    <input class="form-control" name="makeup${row_val}serviceName[]" id="makeupserviceName${$(".Makeupservicerow").length}" required >
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-6 col-md-12 col-12">
                                  <div class="row">
                                    <div class="col-lg-2 col-md-6 col-12">
                                      <div class="form-group">
                                        <label>Qty.</label>
                                        <input name="makeup${row_val}serviceQuantity[]" type="text" class="form-control appendfocus" placeholder="" value="1" id="makeupserviceQty${$(".Makeupservicerow").length}" onkeyup="calcutateDiscountformakeup(${$(".Makeupservicerow").length})">
                                      </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-12">
                                      <div class="form-group">
                                        <label>Price <i class="fa fa-inr"></i></label>
                                        <input name="makeup${row_val}services[]"  type="hidden" id="makeupservices_${$(".Makeupservicerow").length}"/>
                                        <input name="makeup${row_val}brand[]"  type="hidden" id="makeupbrand_${$(".Makeupservicerow").length}"/>
                                        <input name="makeup${row_val}servicesSgst[]" type="hidden" id="makeupservicesSgst${$(".Makeupservicerow").length}" class="sgstCount">
                                        <input name="makeup${row_val}servicesCgst[]" type="hidden" id="makeupservicesCgst${$(".Makeupservicerow").length}" class="cgstCount">
                                        <input name="makeup${row_val}servicePriceTotal[]" type="hidden" id="makeupservicePriceTotal${$(".Makeupservicerow").length}" class="countTotal">
                                        <input name="makeup${row_val}servicePriceActualRate[]" type="hidden" id="makeupservicePriceActualRate${$(".Makeupservicerow").length}" class="">
                                        <input name="makeup${row_val}servicePrice[]" type="text" class="form-control" placeholder="" id="makeupservicePrice${$(".Makeupservicerow").length}" onkeyup="calcutateDiscountformakeup(${$(".Makeupservicerow").length})">
                                      </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-12">
                                      <div class="form-group">
                                        <label>Total <i class="fa fa-inr"></i></label>
                                        <input name="makeup${row_val}serviceTotal[]" type="text" class="form-control totalprice" placeholder="" id="makeupserviceTotal${$(".Makeupservicerow").length}">
                                      </div>
                                    </div>
                                    <div class="col-lg-1 col-md-6 col-12">
                                      <div class="form-group">
                                        <label style="display: block; visibility: hidden;">Totalsss</label>
                                        <a href="javascript:void(0)" class="btn btn-danger" onclick="deleteMakeupservicerow(${row_val})"><i class="fa fa-trash-o mt-2"></i></a>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                            </div>
                            <div class="modal" id="makeupselectMainService_${$(".Makeupservicerow").length}">
                              <div class="modal-dialog modal-lg" id="makeupservicegroupform" >
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title">Add Group</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>
                                  <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                                  <input value="" type="hidden" name="makeup${row_val}groupidfirm_${($(".Makeupservicerow").length+1)}" id="makeupgroupidfirm_${($(".Makeupservicerow").length+1)}">
                                  <!-- Modal body -->
                                  <div class="modal-body formvisit">
                                    <div class="text-center" id="spinner_service" >
                                      <div class="spinner-border" style="width: 4rem; height: 4rem;" role="status">
                                        <span class="sr-only">Loading...</span>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <!--./col-lg-4-->
                                      <div class="col-lg-12 col-md-12 col-12" id="makeupmainserviceDiv_${($(".Makeupservicerow").length+1)}">
                                      </div>
                                      <div class="col-lg-12 col-md-12 col-12" id="makeupgroupserviceDiv_${($(".Makeupservicerow").length+1)}">
                                      </div>
                                      <div class="col-lg-12 col-md-12 col-12" id="makeupserviceBrandDiv_${($(".Makeupservicerow").length+1)}">
                                      </div>
                                    </div>
                                    <!--./row-->
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="outline-btn" data-dismiss="modal">Cancel</button>
                                    <button type="button" onclick="showServiceBrandsPriceformakeup(${row_val})" class="theme-btn">Save</button>
                                  </div>
                                </div>
                              </div>
                            </div>`;
    $("#makeupserviceDiv" + row_val).append(Makeupservice_row_html);
    // if ($(".Makeupservicerow").length == 1) {
    //   $(".serviceDivider").show();
    // }
    $("#MakeUpserviceRowCount").val($(".Makeupservicerow").length);
    $('#makeupserviceDiv').children().last().find('.appendfocus').focus();
    $('.selectpicker').selectpicker();
}

function getServicesformakeup(groupid, count) {
    console.log(groupid);
    if (groupid != "") {
        $.ajax({
            url: " {{ url('getServiceByGroup') }} ",
            data: {
                'groupid': groupid,
                "_token": "{{ csrf_token() }}",
            },
            type: 'POST',
            // dataType:'JSON',
            success: function(res) {
                // console.log(res);
                $('#spinner_service').hide();
                // alert(res);
                /*$("#services_"+count).html(res);
                $('#services_'+count).selectpicker('refresh'); */
                $("#makeupselectMainService_" + count).modal({
                    backdrop: 'static'
                });
                $("#makeupgroupidfirm_" + (++count)).val(groupid);
                showFirmServiceForMakeup(groupid);
            }
        });
        // calculatecash();
    }
}

function showFirmServiceForMakeup(groupid) {
    // alert(count)
    $('#spinner_service').hide();
    if (groupid != "") {
        var totalcount = $(".Makeupservicerow").length;
        //var groupid = $("#groupidfirm_"+totalcount).val();
        // alert(groupid)
        $.ajax({
            url: "{{ url('showFirmServiceForMakeup') }}",
            type: 'POST',
            data: {
                'groupid': groupid,
                'totalcount': totalcount,
                "_token": "{{ csrf_token() }}",
            },
            dataType: 'JSON',
            success: function(res) {
                console.log('-----------showFirmServiceForMakeup------------------');
                // console.log(res.html)
                $("#makeupmainserviceDiv_" + totalcount).html(res.html);
            }
        });
    }
}

function showGroupServiceFormakeup(group_id, parentId) {
    // alert(parentId);
    $('#spinner_service').hide();
    var totalcount = $(".Makeupservicerow").length;
    if (group_id != "") {
        $.ajax({
            url: "{{ url('showGroupServiceForMakeup') }}",
            type: 'POST',
            data: {
                'groupid': group_id,
                'totalcount': totalcount,
                'parentId': parentId,
                "_token": "{{ csrf_token() }}",
            },
            dataType: 'JSON',
            success: function(res) {
                // alert(res.html)
                $("#makeupgroupserviceDiv_" + totalcount).html(res.html);
            }
        });
    }
}

function showServiceBrandsForMakeup(service_id) {
    $('#spinner_service').hide();
    var totalcount = $(".Makeupservicerow").length;
    var count = $(".Makeupservicerow").length - 1;
    if (service_id != "") {
        $.ajax({
            url: "{{ url('showServiceBrandsForMakeup') }}",
            type: 'POST',
            data: {
                'service_id': service_id,
                'totalcount': totalcount,
                "_token": "{{ csrf_token() }}",
            },
            dataType: 'JSON',
            success: function(res) {
                // alert(res.html)
                $("#makeupserviceBrandDiv_" + totalcount).html(res.html);
                $("#makeupservices_" + count).val(service_id);
            }
        });
    }
}

function showServiceBrandsPriceformakeup(sit_count) {
    $('#spinner_service').show();
    console.log('--------showServiceBrandsPriceformakeup------------');
    var totalcount = $(".Makeupservicerow").length - 1;
    var totalcountss = $(".Makeupservicerow").length - 1;
    var totalcountnew = $(".Makeupservicerow").length;
    //  alert(totalcount);
    var brand_id = $("#makeupgroupServiess_" + totalcountnew).val();

    var array = JSON.parse("[" + brand_id + "]");
    // $('#serviceDiv').html('');
    $.each(array, function(i) {
        // alert(i);
        // i=j-totalcount;
        // alert(i);
        if (array[i] != "") {
            $.ajax({
                url: "{{ url('showServiceBrandsPriceForMakeup') }}",
                type: 'POST',
                data: {
                    'brand_id': array[i],
                    "_token": "{{ csrf_token() }}",
                },
                dataType: 'JSON',
                success: function(res) {
                    console.log(
                        '--------response ---------------showServiceBrandsPriceformakeup------------'
                    );
                    // console.log(res);
                    $('#spinner_service').hide();
                    //alert("#servicePrice"+totalcount);service_id
                    //  alert(res.service_id);
                    $("#makeupbrand_" + totalcount).val(array[i]);
                    $("#makeupservicePrice" + totalcount).val(res.service_price);
                    $("#makeupservicePriceActualRate" + totalcount).val(res.service_price);
                    $("#makeupserviceName" + totalcount).val(res.brand_name);
                    $("#makeupservices_" + totalcount).val(res.brand_id);
                    // console.log(totalcount);
                    addMakeupserviceRow(sit_count);
                    $("#makeupservicegroups_" + totalcount).val(res.service_id);
                    $("#makeupservicegroups_" + totalcount).find('option[value="' + res.service_id +
                        '"]').attr('selected', true);
                    calcutateDiscountformakeup(totalcount);
                    totalcount++;
                }
            });
        }
    });

    setTimeout(function() {
        $('#spinner_service').hide();
        $("#makeupselectMainService_" + totalcountss).modal('hide');
        deleteMakeupservicerow(sit_count);
        deleteMakeupservicerow(sit_count);
    }, 1000);
}

function deleteMakeupservicerow(del_row_count) {
    console.log(del_row_count);
    $("#makeupserviceDiv" + del_row_count).children().last().remove();
    if ($(".Makeupservicerow").length == 0) {
        $(".makeupserviceDivider").hide();
    }
    calculate_pack_grand_total();
}

function calcutateDiscountformakeup(count) {
    var sgst = parseFloat(0);
    var cgst = parseFloat(0);
    //   var disc = $("#serviceDisc"+count).val();
    //   if(disc==''){disc=0;}
    var price = $("#makeupservicePrice" + count).val();
    if (price == '') {
        price = 0;
    }
    var qty = $("#makeupserviceQty" + count).val();
    if (qty == '') {
        qty = 0;
    }
    var total = parseFloat(price) * parseFloat(qty);
    //   var totaldiscount = (parseFloat(total).toFixed(2) * parseFloat(disc).toFixed(2))/100;
    var totaldiscount = 0;
    total = parseFloat(total) - parseFloat(totaldiscount);
    $("#makeupservicePriceTotal" + count).val(parseFloat(total).toFixed(2));
    var totalsgst = (parseFloat(total) * parseFloat(sgst)) / 100;
    var totalcgst = (parseFloat(total) * parseFloat(cgst)) / 100;
    total = parseFloat(total) + parseFloat(totalsgst) + parseFloat(totalcgst);
    $("#makeupserviceTotal" + count).val(parseFloat(total).toFixed(2));
    /*$("#totalsgstval").html(parseFloat(totalsgst));
    $("#totalcgstval").html(parseFloat(totalcgst));*/
    $("#makeupservicesSgst" + count).val(parseFloat(totalsgst).toFixed(2));
    $("#makeupservicesCgst" + count).val(parseFloat(totalcgst).toFixed(2));
    calculate_pack_grand_total();
}

$(document).ready(function() {
    let template = null;
    $('.modal').on('show.bs.modal', function(event) {
        template = $(this).html();
    });

    $('.modal').on('hidden.bs.modal', function(e) {
        $(this).html(template);
    });
});
</script>





@endsection
