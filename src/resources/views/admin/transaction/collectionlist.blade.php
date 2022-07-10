@extends('layouts.adminmaster')
@section('title', 'Enquiry')
@section('content')
        <div class="right-details-box">
            <div class="home_brics_row">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dash_boxcontainner white_boxlist">
                            <div class="upper_basic_heading">
                                <span class="white_dash_head_txt">Collection List <!-- <a href="{{route('customer.create')}}" class="btn margin0 btn-sm btn-mdb-color single-table-btn float-right waves-effect waves-light" type="button"><i class="mdi mdi-plus mr-1"></i>Add New Customer
</a> --> </span>
                                
                            
                            </div>
                            <div class="panel-body dash_table_containner">
                            @if($message=Session::get('success'))
                            <div class="alert alert-success">
                              {{ $message }}
                            </div>
                            @endif
                            <table class="table table-striped table-bordered dtBasicExample" cellspacing="0" width="100%">
                              <thead>
                                <tr>
                                  <th class="th-sm">Customer Name</th>
                                  <th class="th-sm">Package Name</th>
                                  <th class="th-sm">Payment Mode</th>
                                  <th class="th-sm">Amount</th>
                                  <th class="th-sm">Transaction Date</th>
                                </tr>
                              </thead>
                              <tbody>
                                @if(!empty($transaction))
                                  @foreach($transaction as $collection)
                                    <tr>
                                      <td>{{$collection->name}}</td>
                                      <td>{{$collection->package_title}}</td>
                                      <td>{{$collection->payment_mode}}</td>
                                      <td>{{$collection->transaction_amount}} Rs</td>
                                      <td>{{date('d-m-Y',strtotime($collection->transaction_date))}}</td>
                                      <!-- <td></td> -->
                                    </tr>
                                  @endforeach
                                @endif
                              </tbody>
                            </table>
                            
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="dash_boxcontainner white_boxlist">
                            <div class="upper_basic_heading">
                                <span class="white_dash_head_txt">Service Collection List <!-- <a href="{{route('customer.create')}}" class="btn margin0 btn-sm btn-mdb-color single-table-btn float-right waves-effect waves-light" type="button"><i class="mdi mdi-plus mr-1"></i>Add New Customer
</a> --> </span>
                                
                            
                            </div>
                            <div class="panel-body dash_table_containner">
                            @if($message=Session::get('success'))
                            <div class="alert alert-success">
                              {{ $message }}
                            </div>
                            @endif
                            <table class="table table-striped table-bordered dtBasicExample" cellspacing="0" width="100%">
                              <thead>
                                <tr>
                                  <th class="th-sm">Customer Name</th>
                                  <th class="th-sm">Service Name</th>
                                  <th class="th-sm">Payment Mode</th>
                                  <th class="th-sm">Amount</th>
                                  <th class="th-sm">Transaction Date</th>
                                </tr>
                              </thead>
                              <tbody>
                                @if(!empty($servicetransaction))
                                  @foreach($servicetransaction as $servicecollection)
                                    <tr>
                                      <td>
                                        {{$servicecollection->customer_name}}
                                      </td>
                                      <td>
                                        {{$servicecollection->service_name}}
                                      </td>
                                      <td>
                                        {{$servicecollection->payment_mode}}
                                      </td>
                                      <td>
                                        {{$servicecollection->transaction_amount}} Rs
                                      </td>
                                      <td>
                                        {{date('d-m-Y',strtotime($collection->transaction_date))}}
                                      </td>
                                      <!-- <td></td> -->
                                    </tr>
                                  @endforeach
                                @endif
                              </tbody>
                            </table>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
<script type="text/javascript">
  
</script>