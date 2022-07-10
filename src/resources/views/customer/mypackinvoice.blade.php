<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>PDF</title>
</head>

<?php

$pack_details = DB::table('invoice')
    ->select('CSP.*')
    ->leftJoin('customer_sitting_pack AS CSP', 'CSP.invoice_id', '=', 'invoice.invoice_id')
    ->where('CSP.invoice_id', $invoicedata->invoice_id)
    ->get();
    $invoicedata->contact = $invoicedata->contact . ' / ' . $pack_details[0]->alternative_phone;
    $invoicedata->location = $invoicedata->location . ',' . $pack_details[0]->full_address;
     //  echo $pack_details->toSql();
    //    die;
    // print_r($pack_details);
    // die;

    $pack_data_details = DB::table('sittingpack')
    ->where('sittingpack.id', $pack_details[0]->sittingpack_id)
    ->first();

$pack_makeup_services = DB::table('invoice')
    ->select('CSPMS.*')
    ->leftJoin('customer_sitting_pack AS CSP', 'CSP.invoice_id', '=', 'invoice.invoice_id')
    ->leftJoin('customer_sittingpack_makeup_payment AS CSPMS', 'CSPMS.CSP_id', '=', 'CSP.id')
    ->where('CSP.invoice_id', $invoicedata->invoice_id)
    ->where('CSP.id', $pack_details[0]->id)
    ->get();
    // print_r($pack_makeup_services);
    // die;

$pack_sitting_services = DB::table('invoice')
    ->select('CSPS.*')
    ->leftJoin('customer_sitting_pack AS CSP', 'CSP.invoice_id', '=', 'invoice.invoice_id')
    ->leftJoin('customer_sittingpack_payment AS CSPS', 'CSPS.CSP_id', '=', 'CSP.id')
    ->where('CSP.invoice_id', $invoicedata->invoice_id)
    ->where('CSP.customer_id', $invoicedata->user_id)
    ->get();
    // print_r($pack_makeup_services);
    // die;

?>

<body style="background-color: #d6b780;margin: 0; padding: 0;">
    <table width="1050" align="center"
        style="border:none; font-family:Arial, Helvetica, sans-serif; line-height:20px; font-size:18px; color:#333; border-collapse:collapse"
        cellpadding="0" cellspacing="0" border="0">

        <tr>
            <td width="25%"><img src="{{asset('assets/images/logo-cstestseries3.png')}}" style="width: 175px;"></td>
            <td width="75%" style="
    text-align: right;
    color: #37343b;
    font-weight: bold;
"><img src="{{asset('assets/images/pin.png')}}" style="width: 16px;margin-right: 6px;">Vijay Nagar, MR-4 Road, Janki Nagar<br /> In front of Apka
                Raashan,Ekta Chowk, Jabalpur (M.P)</td>
        </tr>
    </table>
    <table width="100%" align="center"
        style="background: #35363a;font-family:Arial, Helvetica, sans-serif;line-height:20px;font-size:18px;color: #fff;border-collapse: unset;height: 45px;border: none;text-align: right;margin-top: -47px;">

        <tr>
            <td width="11%"></td>
            <td width="78%"><img src="{{asset('assets/images/telephone.png')}}" style="width: 16px;margin-right: 6px;">0761-4923091, 7828550550,
                9144400550</td>
            <td width="11%"></td>
        </tr>

    </table>
    <br />
    <h4 style="text-align:center;">Invoice no- {{$invoicedata->invoice_id}}</h4>
    <table width="1050" align="center"
        style="border:0; font-family:Arial, Helvetica, sans-serif; line-height:20px; font-size:13px; color:#333; border-collapse:collapse"
        cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td scope="col">
                <table style="border-collapse:collapse;" width="100%" cellpadding="10">
                    <tr>
                        <td width="10%" style="color:#39343b;text-align: right;padding: 4px;">
                            <h1 style="margin:0; padding:0; font-size:18px">NAME</h1>
                        </td>
                        <td width="90%" style="padding: 4px;">
                            <input type="text" readonly style="border: 0px;height: 35px;width: 100%;" value="{{$invoicedata->name}}">
                        </td>
                    </tr>
                    <tr>
                        <td width="10%" style="color:#39343b;text-align: right;padding: 4px;">
                            <h1 style="margin:0; padding:0; font-size:18px">MOBILE</h1>
                        </td>
                        <td width="90%" style="padding: 4px;">
                            <input type="text"  value="{{ $invoicedata->contact }}" readonly style="border: 0px;height: 35px;width: 100%;">
                            
                        </td>
                    </tr>
                    <tr>
                        <td width="10%" style="color:#39343b;text-align: right;padding: 4px;">
                            <h1 style="margin:0; padding:0; font-size:18px">ADDRESS</h1>
                        </td>
                        <td width="90%" style="padding: 4px;">
                            <input type="text" readonly style="border: 0px;height: 35px;width: 100%;" value="{{ $invoicedata->location }}">
                        </td>
                    </tr>
                </table>
                <table style="border-collapse:collapse" width="100%" cellpadding="10">
                    <tr valign="top">
                        <th style="width:10%;background: #36353b;color: #ffffff;padding: 0 10px;line-height: 30px;border: 2px solid #d6b780;">
                            DATE & TIME</th>  
                        <th style="width:10%;background: #36353b;color: #ffffff;padding: 0 10px;line-height: 30px;border: 2px solid #d6b780;">
                        Makeup Round</th>  
                        <th style="width:45%;background: #36353b;color: #ffffff;padding: 0 10px;line-height: 30px;border: 2px solid #d6b780;">
                            MAKE-UP</th>                       
                    </tr>
                    <?php
                    if(!$pack_makeup_services->isEmpty()) {
                    foreach ($pack_makeup_services as $key => $makeup_value) {

                        // print_r($makeup_value); die;
                        $makeup_services = DB::table('customer_sitting_pack AS CSP')
                        ->select('SB.*','CSP_makeupServices.service_id AS csp_service_id')
                        ->leftJoin('CSP_makeupServices', 'CSP.id', '=', 'CSP_makeupServices.CSP_id')
                        ->leftJoin('service_brands AS SB', 'SB.service_brand_id', '=', 'CSP_makeupServices.service_id')
                        ->where('CSP_makeupServices.CSP_id', $makeup_value->CSP_id)
                        ->where('CSP_makeupServices.makeup_round', $makeup_value->makeup_round)
                        ->get();


                        ?>
                    <tr>
                        <td style="background: white;padding: 10px 10px;border: 2px solid #d6b780;">
                            <input type="text" value="{{$makeup_value->makeupDate}} {{$makeup_value->makeupTime}}" style="width: 97%;border: none;border-bottom: 2px solid #d6b780;height: 45px;">
                        </td>

                        <td style="background: white;padding: 0 10px;border: 2px solid #d6b780;">
                            <input type="text" value="Makeup Round {{$makeup_value->makeup_round}}" style="width: 97%;border: none;border-bottom: 2px solid #d6b780;height: 45px;">
                        </td>

                        <td style="background: white;padding: 0 10px;border: 2px solid #d6b780;">
                            <input type="text" value="<?php foreach ($makeup_services as $key => $value) { echo ($key+1)." ".$value->brand_name."    " ;  } ?>"style="width: 97%;border: none;border-bottom: 2px solid #d6b780;height: 45px;"> 
                        </td>                       
                    </tr>
                    <?php } }?>


                </table>

                <table style="border-collapse:collapse" width="100%" cellpadding="10">
                <tr valign="top">
                        <th
                            style="width:10%;background: #36353b;color: #ffffff;padding: 0 10px;line-height: 30px;border: 2px solid #d6b780;">
                            DATE & TIME</th>
                        <th
                            style="width:10%;background: #36353b;color: #ffffff;padding: 0 10px;line-height: 30px;border: 2px solid #d6b780;">
                            PACKAGE-Sitting</th>
                        <th
                            style="width:45%;background: #36353b;color: #ffffff;padding: 0 10px;line-height: 30px;border: 2px solid #d6b780;">
                            services</th>
                       
                    </tr>

                    <?php 
                     if(!$pack_sitting_services->isEmpty()) {
                    foreach ($pack_sitting_services as $key => $sitpack_value) {

                        // print_r($sitpack_value);
                        // die;
                        $pack_services = DB::table('customer_sitting_pack AS CSP')
                        ->select('SB.*','CSP_Services.service_id AS csp_service_id')
                        ->leftJoin('CSP_Services', 'CSP.id', '=', 'CSP_Services.CSP_id')
                        ->leftJoin('service_brands AS SB', 'SB.service_brand_id', '=', 'CSP_Services.service_id')
                        ->where('CSP_Services.CSP_id', $sitpack_value->CSP_id)
                        ->where('CSP_Services.sitpack_round', $sitpack_value->sitting_round)
                        ->get();

                        // print_r($pack_services);
                        // die;
                        
                        ?>
                    <tr>
                        <td style="background: white;padding: 10px 10px;border: 2px solid #d6b780;">
                            <input type="text" value="{{$sitpack_value->sitting_date}} {{$sitpack_value->sitting_time}}" style="width: 97%;border: none;border-bottom: 2px solid #d6b780;height: 45px;">
                        </td>
                        <td style="background: white;padding: 0 10px;border: 2px solid #d6b780;">
                            <input type="text" value="Sitting {{$sitpack_value->sitting_round}}" style="width: 97%;border: none;border-bottom: 2px solid #d6b780;height: 45px;">
                        </td>
                        <td style="background: white;padding: 0 10px;border: 2px solid #d6b780;">
                        <textarea name="text" rows="3" cols="12" wrap="soft" style="width: 100%;border: none;border-bottom: 2px solid #d6b780;height: 45px; line-height: 1.9;"> <?php foreach ($pack_services as $key => $value) { echo ($key+1)."-".$value->brand_name."  " ;  } ?> </textarea> 
                         
                        </td>
                        
                    </tr>
                    <?php } }?>
                </table>

                <table style="border-collapse:collapse" width="100%" cellpadding="10">
                    <tr valign="top">
                        <th style="width: 35%;background: #a77a37;color: #ffffff;border: 2px solid #d6b780;">REMARK</th>
                        <th style="width: 18.9%;
                            background: #a77a37;
                            color: #ffffff;
                            border: 2px solid #d6b780;">GRAND TOTAL</th>
                        <th style="
                            width: 48.2%;
                            background: #a77a37;
                            color: #ffffff;
                            border: 2px solid #d6b780;
                            padding: 0 4px 0 0;
                            "> <input type="text" value="Rs {{$pack_details[0]->sitpack_final_price}}" style="
                            width: 100%;
                            border: none;
                            border-bottom: 2px solid #a77a37;
                            height: 36px;background: white;
                        " /></th>
                    </tr>
                    <tr>
                        <td rowspan="8" style="background: #ffffff; border: 2px solid #d6b780; ">{{$invoicedata->remark}} </td>
                        <td style="width: 18.9%;
                            background: #a77a37;
                            color: #ffffff;
                            border: 2px solid #d6b780;text-align: center;">ADVANCE PAYMENT</td>
                        <td style="
                            width: 48.2%;
                            background: #a77a37;
                            color: #ffffff;
                            border: 2px solid #d6b780;
                            padding: 0 4px 0 0;
                            "><input type="text" value="Rs {{$pack_details[0]->packageAdvancePayment}}" style="
                            width: 100%;
                            border: none;
                            border-bottom: 2px solid #a77a37;
                            height: 36px;background: white;
                        " /></td>
                    </tr>
                    <tr>
                        <td style=" background: #a77a37;color: #ffffff; text-align: center;border: 2px solid #d6b780;">DATE</td>
                        <td style="  background: #a77a37; color: #ffffff; text-align: center;border: 2px solid #d6b780;">PAYMENT DISTRIBUTION</td>
                    </tr>
                    <?php 

                    foreach ($pack_sitting_services as $key => $sitpack_value) {
                    
                    ?>
                    <tr>       
                        <td style=" padding: 0 4px 0 0; ">
                            <input type="text" name=""  value ="{{$sitpack_value->sitting_date}}" style="width: 100%; border: none;height: 30px; ">
                        </td>
                        <td>
                            <input placeholder="1" type="text" name="" value ="Rs {{$sitpack_value->sittingPayment}}" style=" width: 100%; border: none; height: 30px; ">
                        </td>
                    </tr>

                    <?php }
                     foreach ($pack_makeup_services as $key => $makeup_value) {
                    ?>
                    <tr>       
                        <td style=" padding: 0 4px 0 0; ">
                            <input type="text" name=""  value ="{{$makeup_value->makeupDate}}" style="width: 100%; border: none;height: 30px; ">
                        </td>
                        <td>
                            <input placeholder="1" type="text" name="" value ="Rs {{$makeup_value->makeupPayment}}" style=" width: 100%; border: none; height: 30px; ">
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                <table style="border-collapse:collapse" width="100%" cellpadding="10">
                    <tr style="border-bottom:1px solid #000" valign="top">
                        <td width="40%"><b>1.</b> मेकप , पैकेज , लहंगा की बुकिंग कुल बिल के <b>40 प्रतिशत</b> एडवांस से
                            मान्य होगी , और यह <b>40 प्रतिशत</b> एडवांस किसी भी स्तिथि में सम्पूर्ण वापस नहीं होगा |
                            क्लाइंट द्वारा किसी भी परिस्तिथि में बुकिंग केंसिल करने पर नियम <b>नम्बर 2</b> के हिसाब से
                            ही पैसे लौटाए जाएँगे |
                            <br>
                            <b>2.</b> मेकप एवं पैकेज की बुकिंग कैंसिल करने पर -
                            <br>
                            सर्विस की दिनांक से 2 महीने पहले केंसिल करने पर कुल जमा राशी का <b>40%</b> काटा जाएगा |
                            <br>
                            सर्विस की दिनांक से 1 महीने पहले केंसिल करने पर कुल जमा राशि का <b>60%</b> काटा जाएगा |
                            <br>
                            सर्विस की दिनांक में यदि 1 महीने से कम का समय बचा है तो जमा राशी का सम्पूर्ण <b>100%</b>
                            काटा जाएगा |
                            <br>
                            <b>3.</b> यदि मै ( ग्राहक ) अपनी बुकिंग की दिनांक किसी भी वजह से बदलती हूँ तो मुझे <b>500
                                रूपए </b>अतिरिक्त देने होंगे | यदि बुकिंग की दिनांक लॉकडाउन की वजह से बदलती है तो <b>500
                                रूपए</b> अतिरिक्त नहीं लगेगा |
                            <br>
                            <b>4.</b> यदि लॉकडाउन की वजह से बुकिंग केंसिल होती है और सलोन अपनी सेवाए देने में असमर्थ
                            होता है तो मेरे द्वारा दिए गये एडवांस की वापसी नहीं होगी | मेरी सम्पूर्ण राशि उस स्तिथि में
                            सलोन से कोई
                            <br>
                            सर्विस / प्रोडक्ट लेकर या मेरी शादी की नई दिनांक में बुकिंग पोस्टपोन करके इस्तेमाल की जा
                            सकती है |
                            <br>
                            <b>5.</b> मै यह जानती हूँ की सलोन On-Venue सर्विस नहीं देता है | किसी विशेष परिस्तिथि में
                            यदि सलोन On-Venue मेकप सर्विस देता है तो <b>5000 रूपए</b> अतिरिक्त On-Venue चार्ज लगता है |
                            <br>

                        </td>
                        <td width="40%">
                            <b>6.</b> यदि मै अपनी बुकिंग को आंशिक केंसिल ( Partial Cancellation ) करती हूँ तो केंसिल की
                            गयी सर्विस के कुल बिल में <b>2 नम्बर</b> नियम के हिसाब से पेसे काटे जाएँगे |
                            <br>
                            <b>7.</b> यदि सलोन द्वारा खुद किसी वजह से बुकिंग केंसिल की जाती है तो सलोन द्वारा सम्पूर्ण
                            एडवांस राशि वापस की जाएगी |
                            <br>
                            - यदि बुकिंग लॉकडाउन की वजह से केंसिल होती है तो एडवांस की वापसी नहीं होगी, नियम <b>नम्बर 4
                            </b>के हिसाब से एडजस्ट होगा |
                            <br>
                            - यदि ग्राहक कहता है हमे <b>On-Venue</b> सर्विस दीजिये परन्तु सलोन की पहले से बुकिंग है या
                            ग्राहक अतिरिक्त चार्ज नहीं देता है इस स्तिथि में यदि बुकिंग केंसिल होती है तो भी सलोन से
                            एडवांस की वापसी नहीं होगी , नियम <b>नम्बर 4 </b>के हिसाब से एडजस्ट होगा |
                            <br>
                            <b>8.</b> बकाया राशि सर्विस के पहले देनी होगी |
                            <br>
                            <b>9.</b> मेकअप के समय केवल जिनका मेकप है वही आ सकते हैं अन्य किसी को एंट्री नहीं दी जाएगी |
                            <br>
                            <b>10</b>मेकअप यदि सुबह <b>10:30 </b>के पहले है तो ग्राहक को <b>9200005559 </b>पर हमे एक दिन
                            पहले और सुबह घर से निकलने से पहले कॉल करके सूचित करना होगा |
                            <br>
                            <b>11</b>सलोन में फोटोग्राफर बुलाना प्रतिबंधित है |
                            <br>
                            <b>12.</b> बताए समय से अधिकतम <b>1 घंटा</b> देर से आने पर मेकअप ओनर द्वारा ना कर स्टाफ
                            द्वारा किया जाएगा |
                            <br>
                            <b>13.</b> किसी भी विवाद की स्तिथि में सलोन का निर्णय अंतिम एवं मान्य होगा |
                            <br>
                            <b>14.</b> प्री-ब्राइडल सर्विस के दौरान या बादमे यदि ग्राहक की स्किन में किसी प्रकार का
                            रीएक्शन होता है तो सलोन इसके लिए जिम्मेदार नहीं है क्युकी सलोन सर्विस प्रोवाइडर है प्रोडक्ट
                            का निर्माता नहीं |
                        </td>
                        <td width="20%" style="
                            text-align: center;
                            font-size: 18px;
                            font-weight: bold;
                        "><span style="
                            height: 200px;
                            background: #f0e1c4;
                            display: block;
                        "></span><span>CUSTOMER SIGN</span>
                        <button value="Print Document" type="button" onclick="myFunction()"
                        style="background-color:#d2a659; padding:15px; margin:5px; border-radius:5px;">Print</button>    
                    </td>

                    </tr>
                </table>

            </td>
        </tr>
    </table>
</body>

</html>
<script type="text/javascript">
    function myFunction() {
        window.print();
    }
    </script>