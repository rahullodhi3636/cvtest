<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta  name="viewport" content="width=display-width, initial-scale=1.0, maximum-scale=1.0," />
   <title>CV Salon</title>
  <style type="text/css">
  *{margin:0; padding: 0;}
    html { width: 100%;}
   
  .table{border-collapse: collapse;}
  .table th{background: #97989A; padding: 3px 10px; font-size: 16px; color: #fff;}
  .table td{border: 0px solid #333; padding: 3px 10px; font-size: 16px;}

   .table2{border-collapse: collapse;}
  .table2 td{border: 1px solid #333; padding: 8px 0px; font-size: 16px;}
  ol{padding: 0; margin:0;}
  ol li{padding-bottom: 2px; margin-left: 30px;font-size: 16px}
  @media print
{
  .button
  {
    display: none;
  }
}
</style>
</head>
<body>
 <div style="width:1000px; margin:0px auto; position: relative; font-size: 16px; color: #000; line-height: 20px; font-family: Arial">   
<table cellspacing="0" width="100%" cellpadding="0" cellspacing="0" style="border-right:4px solid #fff" >
  <tr>
    <td width="100%" valign="top">
      <table width="100%" cellpadding="0" cellspacing="0" style="padding: 20px; ">
        <tr>
          <td valign="top"><img src="https://localhost/salon/backend/images/logo-cstestseries3.png" width="150" height="147" style="border:10px solid #fff; border-radius: 100%"></td>
          <td valign="top" style="text-align: right; line-height: 24px; padding-top: 30px"><img style="vertical-align: middle; padding-right: 10px;" src="https://localhost/salon/backend/images/location.png" width="15" height="22"> Vijay Nagar, MR-4 Road, Janki Nagar,<br />In front of Apka Raashan, Ekta Chowk, Jabalpur(M.P.)</td>
        </tr>
      </table>
    </td>
  </tr>
  <tr><td valign="top" style="background: #000; color: #fff; text-align: right;margin-top: -90px;padding: 10px 20px;display: block;"><img style="vertical-align: text-bottom; padding-right: 10px;" src="https://localhost/salon/backend/images/mobile.png" width="10" height="19">0761-4923091, 7828550550, 91444000550</td></tr>

  <tr><td valign="top" height="2"></td></tr>
  <tr>
    <td valign="top">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="middle" width="10%" style="text-transform: uppercase; text-align: right; padding-right: 20px;">Name</td>
          <td valign="top" style="background: #E6E7E9;padding: 10px 20px; height: 20px; margin-bottom: 2px;display: block;">{{$invoicetrans->name}}</td>
        </tr>
         <tr>
          <td valign="middle" width="10%" style="text-transform: uppercase; text-align: right; padding-right: 20px;">Mobile</td>
          <td valign="top" style="background: #E6E7E9;padding: 10px 20px; height: 20px; margin-bottom: 2px;display: block;">{{$invoicetrans->contact}}</td>
        </tr>
         <tr>
          <td valign="middle" width="10%" style="text-transform: uppercase; text-align: right; padding-right: 20px;">Address</td>
          <td valign="top" style="background: #E6E7E9;padding: 10px 20px; height: 20px; margin-bottom: 2px;display: block;">{{$invoicetrans->location}}</td>
        </tr>
      </table>
    </td>
  </tr>
  <tr><td valign="top" height="10"></td></tr>



  <tr>
    <td valign="top">
      <table width="100%" cellpadding="0" cellspacing="0" style="background: #e6e7e9;text-transform: uppercase;">
        <tr>
          <th valign="top" width="25%" style="background: #97989A; color: #fff; padding: 5px 20px; border-left:4px solid #fff;border-bottom:4px solid #fff">Service Name</th>  
          <th valign="top" width="25%" style="background: #97989A; color: #fff; padding: 5px 20px; border-left:4px solid #fff;border-bottom:4px solid #fff">Date</th>
          <th valign="top" width="25%" style="background: #97989A; color: #fff; padding: 5px 20px; border-left:4px solid #fff;border-bottom:4px solid #fff">Time</th>
          <th valign="top" width="25%" style="background: #97989A; color: #fff; padding: 5px 20px; border-left:4px solid #fff;border-bottom:4px solid #fff">Total</th>
        </tr>
        <?php if (!empty($usedservice)) { 
            foreach ($usedservice as $value) {
        ?>
        <tr>
          <th valign="top" style="border-left: 4px solid #fff;padding-bottom: 10px;"><p style="padding: 10px 20px; height: 30px; border-bottom:1px solid #AEAFB1;width: 75%;margin: 0 auto;">{{$value->product_name}}</p></th>
          <th valign="top" style="border-left: 4px solid #fff;padding-bottom: 10px;"><p style="padding: 10px 20px; height: 30px; border-bottom:1px solid #AEAFB1;width: 75%;margin: 0 auto;">{{date('d-M-Y',strtotime($value->date_of_service))}}</p></th>
          <th valign="top" style="border-left: 4px solid #fff;padding-bottom: 10px;"><p style="padding: 10px 20px; height: 30px; border-bottom:1px solid #AEAFB1;width: 75%;margin: 0 auto;">{{date('H:i A',strtotime($value->date_of_service))}}</p></th>
          <th valign="top" style="border-left: 4px solid #fff;padding-bottom: 10px;"><p style="padding: 10px 20px; height: 30px; border-bottom:1px solid #AEAFB1;width: 75%;margin: 0 auto;">{{$value->price}} X {{$value->quantity}}</p></th>
        </tr>
        <?php } } ?>
        <!-- <tr>
          <th valign="top" style="border-left: 4px solid #fff;padding-bottom: 10px;"><p style="padding: 10px 20px;height: 30px; border-bottom:1px solid #AEAFB1;width: 75%;margin: 0 auto;"></p></th>
          <th valign="top" style="border-left: 4px solid #fff;padding-bottom: 10px;"><p style="padding: 10px 20px;height: 30px; border-bottom:1px solid #AEAFB1;width: 75%;margin: 0 auto;"></p></th>
          <th valign="top" style="border-left: 4px solid #fff;padding-bottom: 10px;"><p style="padding: 10px 20px;height: 30px; border-bottom:1px solid #AEAFB1;width: 75%;margin: 0 auto;"></p></th>
          <th valign="top" style="border-left: 4px solid #fff;padding-bottom: 10px;"><p style="padding: 10px 20px;height: 30px; border-bottom:1px solid #AEAFB1;width: 75%;margin: 0 auto;"></p></th>
        </tr>

        <tr>
          <th valign="top" style="border-left: 4px solid #fff;padding-bottom: 10px;"><p style="padding: 10px 20px;height: 30px; border-bottom:1px solid #AEAFB1;width: 75%;margin: 0 auto;"></p></th>
          <th valign="top" style="border-left: 4px solid #fff;padding-bottom: 10px;"><p style="padding: 10px 20px;height: 30px; border-bottom:1px solid #AEAFB1;width: 75%;margin: 0 auto;"></p></th>
          <th valign="top" style="border-left: 4px solid #fff;padding-bottom: 10px;"><p style="padding: 10px 20px;height: 30px; border-bottom:1px solid #AEAFB1;width: 75%;margin: 0 auto;"></p></th>
          <th valign="top" style="border-left: 4px solid #fff;padding-bottom: 10px;"><p style="padding: 10px 20px;height: 30px; border-bottom:1px solid #AEAFB1;width: 75%;margin: 0 auto;"></p></th>
        </tr> -->
      </table>
    </td>
  </tr>
  <!-- <tr><td valign="top" height="4"></td></tr> -->
  <!-- <tr>
    <td valign="top">
      <table width="100%" cellpadding="0" cellspacing="0" style="background: #e6e7e9;text-transform: uppercase;">
        <tr>
          <th valign="top" width="25%" style="background: #97989A; color: #fff; padding: 5px 20px; border-left:4px solid #fff;border-bottom:4px solid #fff">Date</th>
          <th valign="top" width="25%" style="background: #97989A; color: #fff; padding: 5px 20px; border-left:4px solid #fff;border-bottom:4px solid #fff">Package</th>
          <th valign="top" width="25%" style="background: #97989A; color: #fff; padding: 5px 20px; border-left:4px solid #fff;border-bottom:4px solid #fff">Package</th>
          <th valign="top" width="25%" style="background: #97989A; color: #fff; padding: 5px 20px; border-left:4px solid #fff;border-bottom:4px solid #fff">Lehenga</th>
        </tr>

        <tr>
          <th valign="top" style="border-left: 4px solid #fff;padding-bottom: 10px;"><p style="padding: 10px 20px;height: 30px; border-bottom:1px solid #AEAFB1;width: 75%;margin: 0 auto;">Date</p></th>
          <th valign="top" style="border-left: 4px solid #fff;padding-bottom: 10px;"><p style="padding: 10px 20px;height: 30px; border-bottom:1px solid #AEAFB1;width: 75%;margin: 0 auto;"></p></th>
          <th valign="top" style="border-left: 4px solid #fff;padding-bottom: 10px;"><p style="padding: 10px 20px;height: 30px; border-bottom:1px solid #AEAFB1;width: 75%;margin: 0 auto;"></p></th>
          <th valign="top" style="border-left: 4px solid #fff;padding-bottom: 10px;"><p style="padding: 10px 20px;height: 30px; border-bottom:1px solid #AEAFB1;width: 75%;margin: 0 auto;"></p></th>
        </tr>

        <tr>
          <th valign="top" style="border-left: 4px solid #fff;padding-bottom: 10px;"><p style="padding: 10px 20px;height: 30px; border-bottom:1px solid #AEAFB1;width: 75%;margin: 0 auto;">Price/No.</p></th>
          <th valign="top" style="border-left: 4px solid #fff;padding-bottom: 10px;"><p style="padding: 10px 20px;height: 30px; border-bottom:1px solid #AEAFB1;width: 75%;margin: 0 auto;"></p></th>
          <th valign="top" style="border-left: 4px solid #fff;padding-bottom: 10px;"><p style="padding: 10px 20px;height: 30px; border-bottom:1px solid #AEAFB1;width: 75%;margin: 0 auto;"></p></th>
          <th valign="top" style="border-left: 4px solid #fff;padding-bottom: 10px;"><p style="padding: 10px 20px;height: 30px; border-bottom:1px solid #AEAFB1;width: 75%;margin: 0 auto;"></p></th>
        </tr>

        <tr>
          <th valign="top" style="border-left: 4px solid #fff;padding-bottom: 10px;"><p style="padding: 10px 20px;height: 30px; border-bottom:1px solid #AEAFB1;width: 75%;margin: 0 auto;">Total</p></th>
          <th valign="top" style="border-left: 4px solid #fff;padding-bottom: 10px;"><p style="padding: 10px 20px;height: 30px; border-bottom:1px solid #AEAFB1;width: 75%;margin: 0 auto;"></p></th>
          <th valign="top" style="border-left: 4px solid #fff;padding-bottom: 10px;"><p style="padding: 10px 20px;height: 30px; border-bottom:1px solid #AEAFB1;width: 75%;margin: 0 auto;"></p></th>
          <th valign="top" style="border-left: 4px solid #fff;padding-bottom: 10px;"><p style="padding: 10px 20px;height: 30px; border-bottom:1px solid #AEAFB1;width: 75%;margin: 0 auto;"></p></th>
        </tr>
      </table>
    </td>
  </tr> -->

  <tr><td valign="top" height="4"></td></tr>
   <tr>
    <td valign="top">
      <table width="100%" cellpadding="0" cellspacing="0" style="border-left: 4px solid #fff;">
        <tr>
          <td valign="top" width="35%">
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td valign="top" style="background: #97989A; font-weight: bold; color: #fff; text-transform: uppercase; text-align: center; padding: 5px 20px;">Remark</td>
              </tr>
              <tr>
                <td valign="top" style="background:#E6E7E9; height: 100px; border-top:4px solid #fff"></td>
              </tr>
              <tr>
                <td valign="top">
                  <ul style="padding: 0;list-style: disc;margin-left: 20px;padding-top: 10px;line-height: 24px;">
                    <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
                    <li>Aliquam tincidunt mauris eu risus.</li>
                    <li>Vestibulum auctor dapibus neque.</li>
                    <li>Nunc dignissim risus id metus.</li>
                    <li>Cras ornare tristique elit.</li>
                    <li>Vivamus vestibulum ntulla nec ante.</li>
                    <li>Praesent placerat risus quis eros.</li>
                    <li>Fusce pellentesque suscipit nibh.</li>
                    <li>Integer vitae libero ac risus egestas placerat.</li>
                    <li>Vestibulum commodo felis quis tortor.</li>
                    <li>Ut aliquam sollicitudin leo.</li>
                    <li>Cras iaculis ultricies nulla.</li>
                    <li>Donec quis dui at dolor tempor interdum.</li>
                  </ul>
                </td>
              </tr>
            </table>
          </td>
          <td valign="top" width="65%">
            <table width="100%" cellpadding="0" cellspacing="0" style="border-left:4px solid #fff">
              <tr>
                <td valign="top">
                  <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                      <td valign="top" width="35%" style="background: #97989A; color: #fff;text-transform: uppercase; text-align: center; padding: 5px 20px;font-weight: bold;">Grand Total</td>
                      <td valign="top" width="65%" style="border-bottom:2px solid #97989A;padding: 5px 20px;">{{$invoicetrans->transaction_amount}}</td>
                    </tr>

                    <tr><td valign="top" colspan="2" height="8"></td></tr>
                    <tr>
                      <td valign="top" width="35%" style="background: #97989A; color: #fff;text-transform: uppercase; text-align: center; padding: 5px 20px;font-weight: bold;">Paid Amount</td>
                      <td valign="top" width="65%" style="border-bottom:2px solid #97989A;padding: 5px 20px;">{{$invoicetrans->paid_amount}}</td>
                    </tr>

                    <tr><td valign="top" colspan="2" height="8"></td></tr>

                    <tr>
                      <td valign="top" width="35%" style="background: #97989A; color: #fff; text-transform: uppercase; text-align: center; padding: 5px 20px;font-weight: bold;">Remaining Amount</td>
                      <td valign="top" width="65%" style="border-bottom:2px solid #97989A;padding: 5px 20px;">{{$invoicetrans->remaining_amount}}</td>
                    </tr>

                    <tr><td valign="top" colspan="2" height="12"></td></tr>

                     
                  </table>
                </td>
              </tr>
              <tr><td valign="top" height="4"></td></tr>
              <tr>
                <td valign="top">
                  <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                      <td valign="top" width="15%" style="background: #97989A; color: #fff;padding: 10px 20px; text-transform: uppercase; text-align: center;  border-right:4px solid #fff;font-weight: bold;">Date</td>
                      <td valign="top" width="85%" style="background: #97989A; color: #fff;padding: 10px 20px; text-transform: uppercase; text-align: center;font-weight: bold;">Payment Distribution</td>
                    </tr>
                    <tr><td valign="top" height="4"></td></tr>
                    <tr>
                      <td valign="top" style="border-right:4px solid #fff;background: #E6E7E9;text-transform: uppercase; text-align: center; padding: 5px 20px;"></td>
                      <td valign="top" style="border-bottom:2px solid #97989A;padding: 5px 20px;">1</td>
                    </tr>

                    <tr><td valign="top" height="4"></td></tr>
                    <tr>
                      <td valign="top" style="border-right:4px solid #fff;background: #E6E7E9;text-transform: uppercase; text-align: center; padding: 5px 20px;"></td>
                      <td valign="top" style="border-bottom:2px solid #97989A;padding: 5px 20px;">2</td>
                    </tr>

                    <tr><td valign="top" height="4"></td></tr>
                    <tr>
                      <td valign="top" style="border-right:4px solid #fff;background: #E6E7E9;text-transform: uppercase; text-align: center; padding: 5px 20px;"></td>
                      <td valign="top" style="border-bottom:2px solid #97989A;padding: 5px 20px;">3</td>
                    </tr>

                    <tr><td valign="top" height="4"></td></tr>
                    <tr>
                      <td valign="top" style="border-right:4px solid #fff;background: #E6E7E9;text-transform: uppercase; text-align: center; padding: 5px 20px;"></td>
                      <td valign="top" style="border-bottom:2px solid #97989A;padding: 5px 20px;">4</td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr><td valign="top" height="10"></td></tr>

              <tr>
                <td valign="top">
                  <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                      <td valign="top">
                        <ul style="padding: 0;list-style: disc;margin-left: 20px;padding-top: 10px;line-height: 24px;">
                          <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
                          <li>Aliquam tincidunt mauris eu risus.</li>
                          <li>Vestibulum auctor dapibus neque.</li>
                          <li>Nunc dignissim risus id metus.</li>
                          <li>Cras ornare tristique elit.</li>
                      </td>
                      <td valign="top">
                          <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                              <td valign="top" style="background: #E6E7E9; height: 100px; width: 150px;"></td>
                            </tr>
                            <tr><td valign="top" style="text-transform: uppercase; text-align: center; padding-top: 10px;font-weight: bold;">Customer Sign</td></tr>
                          </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  </table>
</div>
<div class="text-center">
    <button class="btn btn-primary" onclick="myFunction()">Print</button>
</div>
<script>
        function myFunction()
        {
            window.print();
        }
    </script>
</body>
</html>
