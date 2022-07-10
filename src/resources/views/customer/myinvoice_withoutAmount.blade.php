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

td.price,
th.price {
    width: 40px;
    max-width: 40px;
    word-break: break-all;
}

.centered {
    text-align: center;
    align-content: center;
}

.ticket {
    width: 155px;
    max-width: 155px;
}

img {
    max-width: inherit;
    width: inherit;
}
#heading{
    text-align: center;
}
.ticket{
margin: 0 auto;
}
@media print {
    .hidden-print,
    .hidden-print * {
        display: none !important;
    }
}
@media print
{
  .btn
  {
    display: none;
  }
}
        </style>
    </head>
    <body>
        <div class="page-header">
            <h1 id="heading">Service List</h1> <button value="Print Document" type="button" onclick="myFunction()" class="btn btn-primary">Print</button>
        </div>

        <div class="ticket">
            {{-- <img src="./logo.png" alt="Logo"> --}}
            <p class="centered">{{ $invoicedata->name }}
                <br> {{ $invoicedata->email }}
                {{-- <br>{{ $invoicedata->contact }}</p> --}}
            <table align="center">
                <thead>
                    <tr>
                        <th class="quantity">Brand</th>
                        <th class="quantity"></th>

                        <th class="quantity">Item</th>
                        <th class="description">Duration</th>

                    </tr>
                </thead>

                <tbody>
                    <?php
                    $services = DB::table('invoice_service AS IS')
                        ->select('SE.name AS service_name','SU.name AS service_staff_name','PB.brand_name','SB.brand_name as sbname','IS.*','F.firm_name','SB.service_duration')
                        ->leftJoin('services AS SE','SE.id','=','IS.service_id')
                        ->leftJoin('service_group AS SG','SE.group_id','=','SG.id')
                        ->leftJoin('firms AS F','SG.firm_id','=','F.id')

                        ->leftJoin('users AS SU','SU.id','=','IS.staff_id')
                        ->leftJoin('service_brands AS SB','SB.service_brand_id','=','IS.service_id')
                        ->leftJoin('product_brands AS PB','PB.id','=','IS.brand_id')

                        ->where('IS.invoice_id',$invoicedata->invoice_id)
                        ->get();


                    if(!empty($services)){
                        foreach ($services as $service) {

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
                ?>
                    <tr>
                        <td>{{  $service->brand_name }}</td>
                        <td></td>
                        <td>{{ $service->sbname }} </td>
                        <td> {{ $service->service_duration }} min </td>

                    </tr>

                    <?php } } ?>
                    <tr>
                        <td ><strong>Total Time </strong></td>
                        <td ></td>
                        <td></td>
                        <td>
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
                        <td class="emptyrow"></td>
                        <td class="emptyrow text-right" > <?php echo $invoicedata->remark ?> </td>
                    </tr>
                </tbody>
            </table>
            <p class="centered">Service has to be done!
                </p>
        </div>

        <script type="text/javascript">
            function myFunction() {
                window.print();
            }
        </script>
    </body>
</html>
