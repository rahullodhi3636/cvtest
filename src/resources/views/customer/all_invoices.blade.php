@extends('layouts.newlayout.app')
@section('content')
<div class="main">
    <div class="main-content">
      <div class="container-fluid">
          <ul class="navbar-nav ml-auto text-right">
            <li class="nav-item dropdown no-arrow">
               <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 mw-100 navbar-search">
                <div class="input-group">
                  <input type="text" class="form-control bg-default" id="find_cust_invoice_no" placeholder="Search Invoice..." aria-label="Search" aria-describedby="basic-addon2">
                  <div class="input-group-append">
                    <button class="theme-btn" type="button" onclick="find_cust_invoice()">
                      <i class="fa fa-search fa-sm"></i>
                    </button>
                  </div>
                </div>
              </form>
            </li>
            </ul>
         <div class="boxbody">
            <ul class="nav nav-tabs2 nav-justified">
              <li class="nav-item">
              <?php 
                // print_r($invoicedata);
                // die;
              ?>
                <a class="nav-link active" data-toggle="tab" href="#Customer"> All Invoices---{{ isset($invoicedata[0]->name)?$invoicedata[0]->name:'No Data Found' }}</a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#Service">Service Segment</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#Upcoming">Upcoming Segment</a>
              </li> -->
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="Customer">
               
                <div class="panelbox">
                  <div class="row">
                    <div class="col-lg-12">
                            <!-- <h4 style="background:#917758; color:white;" class="p-2">Today Customers</h4> -->
                            <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                              <thead>
                                  <tr>
                                      <th class="th-sm">Sr No</th>
                                      <th class="th-sm">Invoice Date</th>                                     
                                      <th class="th-sm">Invoice No</th>
                                      <th class="th-sm">Invoice Amount</th>
                                      <!-- <th class="th-sm">Invoice Remark</th> -->
                                      <th class="th-sm"> Action </th>
                                  </tr>
                              </thead>
                              <tbody id="all_invoices">
                                  @foreach($invoicedata as $invoice_data)
                                  <?php $needle='Package Advance Payment'; ?>
                                    <tr>
                                      <td>{{($loop->index)+1}}</td>
                                      <td>{{date('d-M-Y',strtotime($invoice_data->invoice_date))}}</td>
                                      <td>{{$invoice_data->invoice_id}}</td>
                                      <td> <i class="fa fa-inr"></i> {{$invoice_data->all_total }} </td>
                                      <!-- <td> {{$invoice_data->iremark}} </td> -->
                                      <td>
                                      @if( ( strpos( $invoice_data->iremark, $needle ) !== false)  ) 
                                        <a class="theme-btn mt-2" href="{{url('mypackinvoice',$invoice_data->invoice_id)}}" target="_blank"><i class="fa fa-eye"> Package Invoice</i></a>
                                      @else  
                                        <!-- <a class="theme-btn mt-2" href="{{url('myinvoice_withoutAmount',$invoice_data->invoice_id)}}" target="_blank"><i class="fa fa-eye"> Without Amt</i> </a>  -->
                                        <a class="theme-btn mt-2" href="{{url('myinvoice',$invoice_data->invoice_id)}}" target="_blank"><i class="fa fa-eye"> With Amt</i></a>
                                      @endif
                                       </td>                             
                                    </tr>
                                  @endforeach
                              </tbody>
                          </table>
                      </div>           
                  </div>
                               
                </div><!--./panelbox-->               
              </div><!--./Customer-->
            </div><!--./tab-content-->
         </div><!--./boxbody-->
       </div><!--./container-fluid-->
      <footer>Copyright © 2020 Chinnie & Vinnie Jabalpur Salon. All rights reserved.</footer>
     </div><!--./main-content-->
   </div><!--./main-->

      <!-- <div class="modal" id="enquiryStatus">
        <div class="modal-dialog modal-lg">
          <form id="addenquiryform" enctype="multipart/form-data">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Change Enquiry Status</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <input type = "hidden" name = "_token" id="csrfToken" value = " ">
             
              <div class="modal-body formvisit">                               
                <div class="row">
                  <div class="col-md-8">
                    <div class="form-group">
                      <label class="control-label" for="Description">Status</label>
                      <select name="status" id="enqStatus" class="form-control">
                        <option value="Cash">CASH</option>
                        <option value="Cancle">CANCLE</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="outline-btn" data-dismiss="modal">Cancel</button>
                <button type="button" onclick="updateEnquiryStatus()" class="theme-btn">Save</button>
              </div>
            </div>
          </form>
        </div>
      </div> -->
 
<script src="{{asset('assets/js/lib/jquery.js')}}"></script>
<script src="{{asset('assets/js/dist/jquery.validate.js')}}"></script>
<script type="text/javascript">
  function find_cust_invoice(){
      let find_cust_invoice_no = $('#find_cust_invoice_no').val();
      let result_row='';
      let view_row='';
      let invoice_url='';
      console.log(find_cust_invoice_no);
      if (find_cust_invoice_no!='') {
        $.ajax({
          url:"{{ route('invoice_search') }}",
          type:'POST',
          data:{"_token": "{{ csrf_token() }}",'invoice_id':find_cust_invoice_no},
          dataType:'JSON',
          success:function(res) {
            console.log(res);     
             $('#all_invoices').html(''); 
             res.data.forEach((element,index) => {
               console.log(element);               
               if (element.remark==null) {
                invoice_url = '{{ route("myinvoice", ":id") }}';
                invoice_url = invoice_url.replace(':id', element.invoice_id);
                console.log(invoice_url);
                view_row=`<a class="theme-btn mt-2" href="${invoice_url}" target="_blank"><i class="fa fa-eye"> With Amt</i></a>`;
               }
               else if ((element.remark).includes('Package Advance Payment')) {
                invoice_url = '{{ route("mypackinvoice", ":id") }}';
                invoice_url = invoice_url.replace(':id', element.invoice_id);
                 view_row=`<a class="theme-btn mt-2" href="${invoice_url}" target="_blank"><i class="fa fa-eye"> Package Invoice</i></a>`;
               } else {
                invoice_url = '{{ route("myinvoice", ":id") }}';
                invoice_url = invoice_url.replace(':id', element.invoice_id);
                 view_row=`<a class="theme-btn mt-2" href="${invoice_url}" target="_blank"><i class="fa fa-eye"> With Amt</i></a>`;
               }
               result_row=`
                <tr>
                  <td>${(index+1)}</td>                  
                  <td>${element.invoice_date}</td>
                  <td>${element.invoice_id}</td>
                  <td> <i class="fa fa-inr"> </i> ${element.all_total}</td>
                  <td>${view_row}</td>
                </tr>
               `;
             }); 
             $('#all_invoices').append(result_row);       
          },
          error: function(jqXHR, textStatus, errorThrown) {
            alert('Something went wrong in find_cust_invoice_no');
          }
        }); 
      }
      else{
        alert('Enter Invoice No to search');
      }       
    }
  
</script>
@endsection