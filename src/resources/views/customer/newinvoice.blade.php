<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>CV-Salon Invoice#{{ $invoicedata->invoice_id }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" type="text/css" href="{{asset('assets/invoice/bootstrap/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/invoice/font-awesome/css/font-awesome.min.css')}}" />

    <script type="text/javascript" src="{{asset('assets/invoice/js/jquery-1.10.2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/invoice/bootstrap/js/bootstrap.min.js')}}"></script>
</head>
<body>

<div class="container">

<div class="page-header">
    <h1>Invoice</h1> <button value="Print Document" type="button" onclick="myFunction()" class="btn btn-primary">Print</button>
</div>

<!-- Simple Invoice - START -->
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="text-center">
                <i class="fa fa-search-plus pull-left icon"></i>
                <h2>Invoice #{{ $invoicedata->invoice_id }}</h2>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-12 col-md-3 col-lg-3 pull-left">
                    <div class="panel panel-default height">
                        <div class="panel-heading">Billing Details</div>
                        <div class="panel-body">
                            <strong>{{ $invoicedata->name }}:</strong><br>
                            {{ $invoicedata->email }}<br>
                            {{-- {{ $invoicedata->contact }}<br> --}}
                            {{ $invoicedata->location }}<br>
                            <!-- <strong>22 203</strong><br> -->
                        </div>
                    </div>
                </div>
                <!-- <div class="col-xs-12 col-md-3 col-lg-3">
                    <div class="panel panel-default height">
                        <div class="panel-heading">Payment Information</div>
                        <div class="panel-body">
                            <strong>Card Name:</strong> Visa<br>
                            <strong>Card Number:</strong> ***** 332<br>
                            <strong>Exp Date:</strong> 09/2020<br>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3 col-lg-3">
                    <div class="panel panel-default height">
                        <div class="panel-heading">Order Preferences</div>
                        <div class="panel-body">
                            <strong>Gift:</strong> No<br>
                            <strong>Express Delivery:</strong> Yes<br>
                            <strong>Insurance:</strong> No<br>
                            <strong>Coupon:</strong> No<br>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3 col-lg-3 pull-right">
                    <div class="panel panel-default height">
                        <div class="panel-heading">Shipping Address</div>
                        <div class="panel-body">
                            <strong>David Peere:</strong><br>
                            1111 Army Navy Drive<br>
                            Arlington<br>
                            VA<br>
                            <strong>22 203</strong><br>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="text-center"><strong>Order summary</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <td><strong>Item Name</strong></td>
                                    <td><strong>Firm Name</strong></td>
                                    <td class="text-center"><strong>Staff Name</strong></td>
                                    <td class="text-center"><strong>Price</strong></td>
                                    <td class="text-center"><strong>Quantity</strong></td>
                                    <td class="text-center"><strong>Discount (%)</strong></td>
                                    <td class="text-center"><strong>CGST</strong></td>
                                    <td class="text-center"><strong>SGST</strong></td>
                                    <td class="text-right"><strong>Total</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $services = DB::table('invoice_service AS IS')
                                        ->select('SE.name AS service_name','SU.name AS service_staff_name','SB.brand_name','IS.*','F.firm_name')
                                        ->leftJoin('services AS SE','SE.id','=','IS.service_id')
                                        ->leftJoin('service_group AS SG','SE.group_id','=','SG.id')
                                        ->leftJoin('firms AS F','SG.firm_id','=','F.id')

                                        ->leftJoin('users AS SU','SU.id','=','IS.staff_id')
                                        ->leftJoin('service_brands AS SB','SB.service_brand_id','=','IS.brand_id')

                                        ->where('IS.invoice_id',$invoicedata->invoice_id)
                                        ->get(); 
                                    if(!empty($services)){
                                        foreach ($services as $service) {
                                ?>
                                <tr>
                                    <td>{{ $service->service_name }} ({{$service->brand_name}})</td>
                                    <td>{{$service->firm_name}}</td>
                                    <td class="text-center">{{ $service->service_staff_name }}</td>
                                    <td class="text-center"><i class="fa fa-inr"></i> {{ $service->price }}</td>
                                    <td class="text-center">{{ $service->quantity }}</td>
                                    <td class="text-center">{{ $service->discount }}</td>
                                    <td class="text-center"><i class="fa fa-inr"></i> {{ $service->cgst }}</td>
                                    <td class="text-center"><i class="fa fa-inr"></i> {{ $service->sgst }}</td>
                                    <td class="text-right"><i class="fa fa-inr"></i> {{ $service->total_price }}</td>
                                </tr>
                                <?php } } ?>
                                <?php
                                    $products = DB::table('invoice_product AS IPR')
                                        ->select('SP.product_name','U.name AS product_staff_name','IPR.*')
                                        ->leftJoin('users AS U','U.id','=','IPR.staff_id')
                                        ->leftJoin('products AS SP','SP.id','=','IPR.product_id')
                                        ->where('IPR.invoice_id',$invoicedata->invoice_id)
                                        ->get(); 
                                    if(!empty($products)){
                                        foreach ($products as $product) {
                                ?>
                                <tr>
                                    <td>{{ $product->product_name }}</td>
                                    <td class="text-center">{{ $product->product_staff_name }}</td>
                                    <td class="text-center"><i class="fa fa-inr"></i> {{ $product->price }}</td>
                                    <td class="text-center">{{ $product->quantity }}</td>
                                    <td class="text-center">{{ $product->discount }}</td>
                                    <td class="text-center"><i class="fa fa-inr"></i> {{ $product->cgst }}</td>
                                    <td class="text-center"><i class="fa fa-inr"></i> {{ $product->sgst }}</td>
                                    <td class="text-right"><i class="fa fa-inr"></i> {{ $product->total_price }}</td>
                                </tr>
                                <?php } } ?>

                                <?php
                                    $packages = DB::table('invoice_package AS IP')
                                        ->select('P.package_title','IP.*')
                                        ->leftJoin('packages AS P','P.package_id','=','IP.package_id')
                                        ->where('IP.invoice_id',$invoicedata->invoice_id)
                                        ->get(); 
                                    if(!empty($packages)){
                                        foreach ($packages as $package) {
                                ?>
                                <tr>
                                    <td>{{ $package->package_title }}</td>
                                    <td class="text-center">-</td>
                                    <td class="text-center"><i class="fa fa-inr"></i> {{ $package->price }}</td>
                                    <td class="text-center">1</td>
                                    <td class="text-center">{{ $package->discount }}</td>
                                    <td class="text-center"><i class="fa fa-inr"></i> {{ $package->cgst }}</td>
                                    <td class="text-center"><i class="fa fa-inr"></i> {{ $package->sgst }}</td>
                                    <td class="text-right"><i class="fa fa-inr"></i> {{ $package->total_price }}</td>
                                </tr>
                                <?php } } ?>


                                <?php if($invoicedata->invoice_type != 3){ ?>
                                <!-- <tr>
                                    <td>Samsung Galaxy S5 Extra Battery</td>
                                    <td class="text-center">$30.00</td>
                                    <td class="text-center">1</td>
                                    <td class="text-right">$30.00</td>
                                </tr>
                                <tr>
                                    <td>Screen protector</td>
                                    <td class="text-center">$7</td>
                                    <td class="text-center">4</td>
                                    <td class="text-right">$28</td>
                                </tr> -->
                                <tr>
                                    <td class="highrow"></td>
                                    <td class="highrow"></td>
                                    <td class="highrow"></td>
                                    <td class="highrow"></td>
                                    <td class="highrow"></td>
                                    <td class="highrow"></td>
                                    <td class="highrow text-center"><strong>Subtotal</strong></td>
                                    <td class="highrow text-right"><i class="fa fa-inr"></i> <?php if($invoicedata->invoice_type != 3) echo $invoicedata->subtotal; else echo "0"; ?></td>
                                </tr>
                                <tr>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow text-center"><strong>SGST(9%) </strong></td>
                                    <td class="emptyrow text-right"><i class="fa fa-inr"></i> <?php if($invoicedata->invoice_type != 3) echo $invoicedata->sgst; else echo "0"; ?></td>
                                </tr>
                                <tr>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow text-center"><strong>CGST(9%) </strong></td>
                                    <td class="emptyrow text-right"><i class="fa fa-inr"></i> <?php if($invoicedata->invoice_type != 3) echo $invoicedata->cgst; else echo "0"; ?></td>
                                </tr>
                                <?php if ($invoicedata->total_discont_percent != 0): ?>
                                    <tr>
                                        <td class="emptyrow"></td>
                                        <td class="emptyrow"></td>
                                        <td class="emptyrow"></td>
                                        <td class="emptyrow"></td>
                                        <td class="emptyrow"></td>
                                        <td class="emptyrow"></td>
                                        <td class="emptyrow text-center"><strong>Total Discount (%) </strong></td>
                                        <td class="emptyrow text-right"> <?php if($invoicedata->invoice_type != 3) echo $invoicedata->total_discont_percent; else echo "0"; ?></td>
                                    </tr>
                                <?php endif ?>
                                <?php if ($invoicedata->total_discount_value != 0): ?>
                                    <tr>
                                        <td class="emptyrow"></td>
                                        <td class="emptyrow"></td>
                                        <td class="emptyrow"></td>
                                        <td class="emptyrow"></td>
                                        <td class="emptyrow"></td>
                                        <td class="emptyrow"></td>
                                        <td class="emptyrow text-center"><strong>Total Discount (<i class="fa fa-inr"></i>) </strong></td>
                                        <td class="emptyrow text-right"><i class="fa fa-inr"></i> {{ $invoicedata->total_discount_value }}</td>
                                    </tr>
                                <?php endif ?>
                                <tr>
                                    <td class="emptyrow"><i class="fa fa-barcode iconbig"></i></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow text-center"><strong>Total</strong></td>
                                    <td class="emptyrow text-right"><i class="fa fa-inr"></i> <?php if($invoicedata->invoice_type != 3) echo $invoicedata->all_total; else echo "0"; ?></td>
                                </tr>
                            <?php } ?>


                            </tbody>
                        </table>
                        @if($invoicedata->iremark)
                        Remark: {{ $invoicedata->iremark }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.height {
    min-height: 200px;
}

.icon {
    font-size: 47px;
    color: #5CB85C;
}

.iconbig {
    font-size: 77px;
    color: #5CB85C;
}

.table > tbody > tr > .emptyrow {
    border-top: none;
}

.table > thead > tr > .emptyrow {
    border-bottom: none;
}

.table > tbody > tr > .highrow {
    border-top: 3px solid;
}

@media print
{
  .btn
  {
    display: none;
  }
}
</style>

<!-- Simple Invoice - END -->
<script type="text/javascript">
    function myFunction() {
        window.print();
    }
</script>
</div>

</body>
</html>