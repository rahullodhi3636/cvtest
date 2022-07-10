@extends('layouts.newlayout.app')
@section('content')
 <div class="main">
    <div class="main-content">
      <div class="container-fluid">
         <div class="boxbody">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="card-header">
                    <h5 class="card-title">Customer Feedbacks</h5>
                    </div>
                </div><!--./col-lg-6-->
            </div><!--./row-->
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-md-12 col-12">
                        <div class="form-group">
                            <label>Select Rating</label>
                            <div class="input-group mb-3">
                            <select name="rating_name" id="rating_id" class="form-control">
                                <option value="0">Select Rating</option>
                                <option value="1">1 star</option>
                                <option value="2">2 stars</option>
                                <option value="3">3 stars</option>
                                <option value="4">4 stars</option>
                                <option value="5">5 stars</option>
                            </select>
                            </div>
                        </div><!--./form-group-->
                    </div><!--./col-lg-4-->
                    <div class="col-lg-3 col-md-12 col-12">
                        <div class="form-group">
                            <label>From Date</label>
                            <div class="input-group mb-3">
                                <input id="start_date" name="start_date" required="" type="text" class="form-control datepicker" placeholder="" value="<?php echo date('d-m-Y') ?>" >
                                <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div><!--./form-group-->
                    </div><!--./col-lg-4-->
                    <div class="col-lg-3 col-md-12 col-12">
                        <div class="form-group">
                            <label>To Date</label>
                            <div class="input-group mb-3">
                            <input id="end_date" name="visitFrom" required="" type="text" class="form-control datepicker" placeholder="" value="<?php echo date('d-m-Y') ?>" >
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
                            </div>
                        </div><!--./form-group-->
                    </div><!--./col-lg-4-->
                    <div class="col-lg-1 col-md-12 col-12">
                        <br>
                        <button type="button" class="theme-btn mt-1" onclick="getRatingDetails()">Show</button>
                    </div>
                    <div class="col-lg-1 col-md-12 col-12">
                        <br>
                        <button type="button" id="download_Report" class="theme-btn mt-1" style="display:none;" onclick="getReportExcel()">Excel</button>
                    </div>
                </div>
                <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                                    <th class="th-sm">Sr No</th>
                                    <th class="th-sm">Customer Name</th>
                                    <th class="th-sm">Mobile No. </th>
                                    <th class="th-sm">Feedback</th>
                            <!-- <th class="th-sm">Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                               @foreach($feedback as $feed)
                                <tr>
                                    <td>{{($loop->index)+1}}</td>
                                    <td>
                                      {{ $feed->customer_name}}
                                    </td>
                                    <td>{{$feed->customer_contact}}</td>
                                    <td>{{$feed->comment}} </td>
                                   
                                </tr>
                                @endforeach
                    </tbody>
                </table>

                 {!! $feedback->links() !!}
                
            </div>
         </div><!--./boxbody-->
       </div><!--./container-fluid-->
      <footer>Copyright © 2020 Chinnie & Vinnie Jabalpur Salon. All rights reserved.</footer>
     </div><!--./main-content-->

   </div><!--./main-->

    <div class="modal" id="viewinvoice">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">View Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body formvisit">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Customer Name :-</label>
                            <span id="customer_name"></span>
                        </div>
                        <div class="col-md-12">
                            <label for="">Customer Email :-</label>
                            <span id="customer_mail"></span>
                        </div>
                        <div class="col-md-12">
                            <label for="">Customer Contact :-</label>
                            <span id="customer_contact"></span>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <th class="th-sm">Sr</th>
                            <th class="th-sm">Brand</th>
                            <th class="th-sm">Item</th>
                            <th class="th-sm">Total</th>
                        </thead>
                        <tbody id="servicebody">
                            <tr>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <label for="">Total Amount :-</label>
                            <i class="fa fa-inr"></i>
                            <span id="invoice_total"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="outline-btn" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('assets/js/lib/jquery.js')}}"></script>
    <script src="{{asset('assets/js/dist/jquery.validate.js')}}"></script>
    <script>
        
        function getRatingDetails() {
            $('#reportbody').html('');  
            let result_row='';
            let rating=$('#rating_id').val();
            let start_date=$('#start_date').val();
            let end_date=$('#end_date').val();
            console.log(start_date);
            console.log(end_date);
        if (rating != 0) {
          $.ajax({
            url:'{{ url("getFeedbackByRatings") }}',
            data:{"_token": "{{ csrf_token() }}",'rating':rating,'start_date':start_date,'end_date':end_date},
            type:'POST',
            dataType:'JSON',
            success:function(res) {
                console.log(res);
                if(res.data.length>0){
                    res.data.forEach((element,index) => {
                        result_row=`<tr>
                                        <td>${index+1}</td>
                                        <td>${element.customer_name}</td>
                                        <td>${element.rating}</td>
                                        <td>${element.comment}</td>
                                        <td>${element.cust_rating}</td>
                                        <td>${element.cust_comment}</td>
                                        <td>
                                            <a href="{{url('myinvoice/${element.invoice_id}')}}" target="_blank" class='theme-btn mt-1 ml-2'>Invoice</a>
                                        </td>
                                    </tr>`;
                        $('#reportbody').append(result_row);            
                    });
                }
                else{
                    alert('No data found in this category');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {               
                alert('Something went wrong');
                }
          });
        }
        else{
            alert('Please Select Rating');
        }
      }
    
    </script>
@endsection
