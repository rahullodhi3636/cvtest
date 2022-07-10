<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="utf-8" />
    <title>CV-Salon Invoice#{{ $invoicedata->invoice_id }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" type="text/css" href="{{asset('assets/invoice/bootstrap/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/invoice/font-awesome/css/font-awesome.min.css')}}" />

    <script type="text/javascript" src="{{asset('assets/invoice/js/jquery-1.10.2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/invoice/bootstrap/js/bootstrap.min.js')}}"></script>

    <style>
    * {
        font-size: 12px;
        font-family: 'Times New Roman';
    }

    td,
    th,
    tr,
    table {
        border-top: 1px solid black;
        border-collapse: collapse;
    }

    td.description,
    th.description {
        width: 75px;
        max-width: 75px;
    }

    td.quantity,
    th.quantity {
        width: 40px;
        max-width: 40px;
        word-break: break-all;
    }

    td.pack_quantity,
    th.pack_quantity {
        width: 70px;
        max-width: 70px;
        word-break: break-all;
    }

    td.price,
    th.price {
        width: 40px;
        max-width: 40px;
        word-break: break-all;
    }

    td.pack_price,
    th.pack_price {
        width: 70px;
        max-width: 70px;
        word-break: break-all;
    }

    .centered {
        text-align: center;
        align-content: center;
    }

    .ticket {
        width: 230px;
        max-width: 230px;
    }

    img {
        max-width: inherit;
        width: inherit;
    }

    #heading {
        text-align: center;
    }

    .ticket {
        margin: 0 auto;
    }

    @media print {

        .hidden-print,
        .hidden-print * {
            display: none !important;
        }
    }

    @media print {
        .btn {
            display: none;
        }
    }
    </style>
</head>

<body>
    <div class="page-header">
        <h1 id="heading">
            @if($is_estimate==1)
            Estimate
            @else
            Invoice
            @endif
        </h1> <button value="Print Document" type="button" id="print_btn" onclick="myFunction()"
            class="btn btn-primary">Print</button>
    </div>

    <div class="ticket">
        {{-- <img src="./logo.png" alt="Logo"> --}}

        <?php

                        // echo '<pre>';
                        // print_r($invoicedata);
                        // echo '</pre>';
                        // exit();

                        $getWallet = DB::table('customer_wallet')
                        ->select('amount_used')
                        ->where('invoice_id',$invoicedata->invoice_id)->first();
                        $cust_Wallet=json_encode($getWallet->amount_used);

                        // fetch gift points
                        $getPoints = DB::table('customer_points')
                        ->select('used_points')
                        ->where('invoice_id',$invoicedata->invoice_id)->first();
                        $cust_Points=json_encode($getPoints->used_points);

                    $services = DB::table('invoice_service AS IS')
                        ->select('SG.group_name AS service_name','SG.firm_id','SU.name AS service_staff_name','PB.brand_name','SB.brand_name as sbname','IS.*','F.firm_name', 'SB.service_duration')
                        ->leftJoin('users AS SU','SU.id','=','IS.staff_id')
                        ->leftJoin('service_brands AS SB','SB.service_brand_id','=','IS.service_id')
                        //->leftJoin('services AS SE','SE.id','=','SB.service_id')
                        ->leftJoin('service_group AS SG','SG.id','=','SB.service_id')
                        ->leftJoin('firms AS F','SG.firm_id','=','F.id')
                        ->leftJoin('product_brands AS PB','PB.id','=','IS.brand_id')
                        ->where('IS.invoice_id',$invoicedata->invoice_id);
                        $services = $services->addSelect(DB::raw("$cust_Points as used_points"))
			            ->addSelect(DB::raw("$cust_Wallet as amount_used"))
                        // echo $services->toSql();
                        // die;
                        ->get();



        //                 echo '<pre>';
        // print_r($invoicedata->firm_name);
        // echo '</pre>';
        // exit();
                    if(sizeof($services)>0) {
                    //  $firm = [];
                    //  $f_services = [];
                    //  $f_name = [];

                    // foreach ($services as $ser){
                    //      $firm[] = $ser->firm_id;
                    //      $f_services[$ser->firm_id][] = $ser;
                    //      $f_name[$ser->firm_id] = $ser->firm_name;
                    // }

                    // $firm = array_values(array_unique($firm));


                    //foreach ($firm as $key => $fi) {

                    ?>

                    <p class="centered">{{ $invoicedata->name }}
                        <br> {{ $invoicedata->email }}
                        <br>{{ $invoicedata->contact }}
                    </p>

                    <p class="centered"> Invoice No:-{{ $invoicedata->invoice_id }} </p>
                    <p class="centered"> Invoice Date:-{{ date('d-m-Y h:i:s a',strtotime($invoicedata->invoice_time)) }} </p>
                    <p class="centered"> {{ $invoicedata->firm_name }} </p>

                    <table align="center">
                        <thead>
                            <tr>
                                {{-- <th class="quantity">Brand</th> --}}
                                <th width="20%">Service</th>
                                <th width="20%">Price</th>
                                <th width="20%">Discount</th>
                                <th width="20%">GST</th>
                                <th width="20%">Total</th>
                                {{-- <th class="description">Duration</th> --}}
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                    $price = 0;
                                    $discount = 0;
                                    $totalgst= 0;
                                    $totalprice = 0;

                                    $combo_count=0;
                                    $combo_row='';
                                    $needle='Combo price applied';
                                    // echo "deep-".strpos( $invoicedata->remark, $needle );
                                   //$services = services;
                                        foreach ($services as $service) {
                                        $checkCombo = DB::table('combo')
                                        ->select('combo.combo_price')
                                        ->leftJoin('combo_service AS CMBS','CMBS.combo_id','=','combo.id')
                                        ->where('CMBS.service_id',$service->service_id)->get();
                                        if(!($checkCombo)->isEmpty() && ( strpos( $invoicedata->remark, $needle ) !== false)  ) {
                                            $curr_combo_price=$checkCombo[0]->combo_price;
                                            $combo_row='<tr><td><strong>Combo Total</strong></td><td></td><td><i class="fa fa-inr"></i> '.$curr_combo_price.'</td></tr>';
                                            $combo_count+=1;
                                            $combo_service='yes';
                                            $price_row='-';
                                        }
                                        else{
                                            $combo_service='not';
                                            $price_row=$service->total_price;
                                        }

                            ?>
                            <?php
                            //  $checkother='';
                            if($service->brand_name=='Himalaya'){
                                $checkother = DB::table('invoice_service')
                                    ->select('OSB.*')
                                    ->leftJoin('other_service_brands AS OSB','OSB.id','=','invoice_service.other_service_id')
                                    ->where('invoice_service.invoice_id',$invoicedata->invoice_id)->get();
                                if(!$checkother->isEmpty()){
                                    $service->brand_name='Other Services';
                                    $service->sbname=$checkother[0]->brand_name;
                                    $service->service_duration=$checkother[0]->service_duration;
                                }
                            }


                            $tgst = $service->cgst+$service->sgst;
                            $price += $service->price+$service->service_add;
                            $discount += $service->discount;
                            $totalgst += $tgst;
                            $totalprice += $price_row;
                            ?>
                            <tr>
                                {{-- <td>{{$service->brand_name}}</td> --}}
                                <td>{{ $service->sbname }} </td>
                                <td><?php echo $service->price+$service->service_add; ?></td>
                                <td><?php echo $service->discount; ?></td>
                                <td><?php echo $service->cgst+$service->sgst; ?></td>
                                <td><?php echo '<i class="fa fa-inr"></i>'.$price_row; ?></td>
                                {{-- <td class="text-center"><i class="fa fa-inr"></i> {{ $service->price }}</td>
                                <td class="text-center">{{ $service->quantity }}</td> --}}
                                {{-- <td class="text-center"> {{ $service->service_duration }} min </td> --}}
                            </tr>

                            <?php }
                                if($combo_service=='yes')
                                echo $combo_row;
                                ?>
                            <tr>
                                <td class="emptyrow text-center" colspan="3"><strong>Gift Points </strong></td>
                                <td class="emptyrow"></td>
                                {{-- <td class="emptyrow"></td> --}}
                                <td class="emptyrow text-right">
                                    <?php echo isset($service->used_points)?$service->used_points:"0"; ?></td>
                            </tr>
                            <tr>
                                <td class="emptyrow text-center" colspan="3"><strong>Paid By Wallet</strong></td>
                                <td class="emptyrow"></td>
                                {{-- <td class="emptyrow"></td> --}}
                                <td class="emptyrow text-right" > <i class="fa fa-inr"></i>
                                    <?php echo isset($service->amount_used)?$service->amount_used:"0"; ?></td>
                            </tr>
                            @if($discount>0)
                            <tr>
                                <td class="emptyrow text-center" colspan="3"><strong>Total discount </strong></td>
                                <td class="emptyrow"></td>
                                <td class="emptyrow text-right"><i class="fa fa-inr"></i>
                                    <?php echo $discount; ?></td>
                            </tr>
                            @endif
                            @php
                             $extra_discount = 0;
                             if($invoicedata->total_discont_percent!=0){
                                $extra_discount = $invoicedata->total_discont_percent;
                             }
                             if($invoicedata->total_discount_value!=0){
                                $extra_discount = $invoicedata->total_discount_value;
                             }
                            @endphp



                            @if($totalgst>0)
                            <tr>
                                <td class="emptyrow text-center" colspan="3"><strong>Total gst </strong></td>
                                <td class="emptyrow"></td>
                                <td class="emptyrow text-right"><i class="fa fa-inr"></i>
                                    <?php echo $totalgst; ?></td>
                            </tr>
                            @endif
                            <tr>
                                <td class="emptyrow text-center" colspan="3"><strong>Subtotal </strong></td>
                                <td class="emptyrow"></td>
                                <td class="emptyrow text-right"><i class="fa fa-inr"></i>
                                    <?php echo $totalprice; ?></td>
                            </tr>
                            @if($extra_discount!=0)
                            <tr>
                                <td class="emptyrow text-center" colspan="3"><strong>Other discount </strong></td>
                                <td class="emptyrow"></td>
                                <td class="emptyrow text-right"><i class="fa fa-inr"></i>
                                    <?php echo $extra_discount; ?></td>
                            </tr>
                            @endif
                            <tr>

                                <td class="emptyrow text-center" colspan="2"><strong>Total </strong></td>
                                <td class="emptyrow"></td>
                                {{-- <td class="emptyrow"></td> --}}
                                <td class="emptyrow text-right"><i class="fa fa-inr"></i>
                                    <?php echo $invoicedata->grand_total.'&nbsp'; ?></td>

                                <td class="emptyrow text-center">
                                    <?php
                                            $total_time=0;
                                            foreach ($services as $service) {
                                            $total_time=$total_time+$service->service_duration;
                                            }
                                            $total_sec=$total_time*60;
                                            // echo $total_sec;
                                            echo (intdiv($total_sec,3600)."H:".($total_sec/ 60 % 60)."M:".($total_sec% 60)."S");
                                        ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="emptyrow text-center"><strong>Remark </strong></td>
                                <!-- <td class="emptyrow"></td> -->
                                <td class="emptyrow text-right" colspan="4"> <?php echo $invoicedata->remark ?> </td>
                            </tr>
                        </tbody>
                    </table>

                     <p class="centered">Thanks for your purchase!</p>
                        <?php
                          // }//end foreach

                        }//end if  ?>
                        <?php





                    $CustomerSittingPack = DB::table('customer_sitting_pack AS CSP')
                    ->select('SP.*','CSP.packageAdvancePayment')
                    ->leftJoin('sittingpack AS SP','SP.id','=','CSP.sittingpack_id')
                    ->where('CSP.invoice_id',$invoicedata->invoice_id);
                    $CustomerSittingPack = $CustomerSittingPack->addSelect(DB::raw("$cust_Points as used_points"))
                    ->addSelect(DB::raw("$cust_Wallet as amount_used"))
                    ->get();
                    if(!($CustomerSittingPack)->isEmpty()){ ?>
                        <p class="centered">{{ $invoicedata->name }}
                            <br> {{ $invoicedata->email }}
                            <br>{{ $invoicedata->contact }}
                        </p>

                        <p class="centered"> Invoice No:-{{ $invoicedata->invoice_id }} </p>
        <table align="center">
            <thead>
                <tr>
                    <th class="pack_quantity">Pack</th>
                    <th class="pack_quantity">Members</th>
                    <th class="pack_price">Price</th>
                    <th class="pack_price">Advance</th>
                </tr>
            </thead>

            <tbody>

                <?php

                foreach ($CustomerSittingPack as $SittingPack) {
                         ?>
                <tr>
                    <td>{{$SittingPack->pack_name}}</td>
                    <td>{{ $SittingPack->total_members }} </td>
                    <td class="text-right"><i class="fa fa-inr"></i> {{ $SittingPack->pack_final_price }}</td>
                    <td class="text-right"><i class="fa fa-inr"></i> {{ $SittingPack->packageAdvancePayment }}</td>
                </tr>

                <?php } ?>
                <tr>
                    <td class="emptyrow text-center"><strong>Gift Points </strong></td>
                    <td class="emptyrow"></td>

                    <td class="emptyrow text-right">
                        <?php  if($invoicedata->invoice_type != 3) echo $SittingPack->used_points; else echo "0"; ?></td>
                </tr>
                <tr>
                    <td class="emptyrow text-center"><strong>Paid By Wallet</strong></td>
                    <td class="emptyrow"></td>

                    <td class="emptyrow text-right"> <i class="fa fa-inr"></i>
                        <?php if($invoicedata->invoice_type != 3) echo $SittingPack->amount_used; else echo "0"; ?></td>
                </tr>
                <tr>

                    <td class="emptyrow text-center"><strong>Subtotal </strong></td>
                    <td class="emptyrow"></td>

                    <td class="emptyrow text-right"><i class="fa fa-inr"></i>
                        <?php if($invoicedata->invoice_type != 3) echo $invoicedata->subtotal; else echo "0"; ?></td>
                </tr>
                <tr>
                    <td class="emptyrow text-center"><strong>Remark </strong></td>
                    <td class="emptyrow text-right" colspan="3"> <?php echo $invoicedata->remark ?> </td>
                </tr>
            </tbody>
        </table>
        <p class="centered">Thanks for your purchase!</p>
        <?php
             }//end foreach

         ?>


    </div>

    <script type="text/javascript">
    $(document).ready(function(){
        window.print();

    });
    function myFunction() {
        //window.print();
    }
    </script>

<script language="VBScript">
// THIS VB SCRIP REMOVES THE PRINT DIALOG BOX AND PRINTS TO YOUR DEFAULT PRINTER
Sub window_onunload() On Error Resume Next Set WB = nothing On Error Goto 0 End Sub Sub Print() OLECMDID_PRINT = 6 OLECMDEXECOPT_DONTPROMPTUSER = 2 OLECMDEXECOPT_PROMPTUSER = 1 On Error Resume Next If DA Then call WB.ExecWB(OLECMDID_PRINT, OLECMDEXECOPT_DONTPROMPTUSER,1) Else call WB.IOleCommandTarget.Exec(OLECMDID_PRINT ,OLECMDEXECOPT_DONTPROMPTUSER,"","","") End If If Err.Number <> 0 Then If DA Then Alert("Nothing Printed :" & err.number & " : " & err.description) Else HandleError() End if End If On Error Goto 0 End Sub If DA Then wbvers="8856F961-340A-11D0-A96B-00C04FD705A2" Else wbvers="EAB22AC3-30C1-11CF-A7EB-0000C05BAE0B" End If document.write "<object ID=""WB"" WIDTH=0 HEIGHT=0 CLASSID=""CLSID:" document.write wbvers & """> </object>" </script>

</body>

</html>
