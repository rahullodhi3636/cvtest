@extends('layouts.newlayout.app')
@section('content')
<div class="main">
    <div class="main-content">
      <div class="container-fluid">
         <div class="boxbody">
            <ul class="nav nav-tabs2 nav-justified">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#InvoiceData">Latest Invoice</a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#Service">Service Segment</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#Upcoming">Upcoming Segment</a>
              </li> -->
            </ul>

            <div class="tab-content">
              <div class="tab-pane active" id="InvoiceData">
                <form class="formvisit">
                <div class="panelbox">
                  
                  <div class="row pull-right">
                        @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                            <li>{!! \Session::get('success') !!}</li>
                            </ul>
                        </div>
                        @endif
                    </div>
                  <div class="row">

                   <div class="col-lg-12 col-md-12 col-12 mt-3">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped recent-purchases-listing" id="customer_data_Table">
                          <thead>
                            <tr>
                                <td>Sr</td>
                                <th>Invoice No</th>
                                <th>Invoice Date</th>
                                <th>Action</th>
                            </tr>
                          </thead>
                          <tbody id="customerInvoiceBody">
                            @foreach($recent_invoices as $recent_invoice)
                                <tr>
                                    <td>{{($loop->index)+1}}</td>
                                    <td>{{$recent_invoice->invoice_id}}</td>
                                    <td> {{ date('d-M-Y h:i:s', strtotime($recent_invoice->created_at)) }} </td>
                                    <td><a class="theme-btn mt-2" href="{{url('myinvoice_withoutAmount',$recent_invoice->invoice_id)}}" target="_blank">Invoice without Amt</a> <a class="theme-btn mt-2" href="{{url('myinvoice',$recent_invoice->invoice_id)}}" target="_blank">Invoice with Amt</a></td>
                                </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                   </div><!--/col-lg-12-->
                  </div><!--./row-->
                </div><!--./panelbox-->
               </form>
              </div><!--./Customer-->
            </div><!--./tab-content-->
         </div><!--./boxbody-->
       </div><!--./container-fluid-->
      <footer>Copyright © 2020 Chinnie & Vinnie Jabalpur Salon. All rights reserved.</footer>
     </div><!--./main-content-->

   </div><!--./main-->

   <!-- The Modal -->


    <script src="{{asset('assets/js/lib/jquery.js')}}"></script>
    <script src="{{asset('assets/js/dist/jquery.validate.js')}}"></script>
    <script>

    </script>
@endsection
