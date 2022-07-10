@extends('layouts.newlayout.app')
@section('content')
 <div class="main">
    <div class="main-content">
      <div class="container-fluid">
         <div class="boxbody">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="card-header">
                    <h5 class="card-title">Wallet Report- {{$customer[0]->name}}</h5>
                    </div>
                </div><!--./col-lg-6-->
            </div><!--./row-->
            <div class="card-body">
                <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="th-sm">Sr No</th>
                            <th class="th-sm">Invoice No</th>
                            <th class="th-sm">Available Point</th>
                            <th class="th-sm">Used Point</th>
                            <th class="th-sm">Date</th>
                            <!-- <th class="th-sm">Action</th> -->
                        </tr>
                    </thead>
                    <tbody id="reportbody">
                       
                        @foreach($customer as $cust_data)
                        <tr>
                            <td>{{($loop->index)+1}}</td>
                            <td>{{$cust_data->invoice_id}}</td>
                            <td>{{$cust_data->amount_allow}}</td>
                            <td>{{$cust_data->amount_used}}</td>
                            <td><?php echo date("d-M-Y", strtotime($cust_data->created_at)); ?> </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>                
            </div>
         </div><!--./boxbody-->
       </div><!--./container-fluid-->
      <footer>Copyright © 2020 Chinnie & Vinnie Jabalpur Salon. All rights reserved.</footer>
     </div><!--./main-content-->

   </div><!--./main-->

    <script src="{{asset('assets/js/lib/jquery.js')}}"></script>
    <script src="{{asset('assets/js/dist/jquery.validate.js')}}"></script>
    <script>         
    </script>
@endsection
