@extends('layouts.newlayout.app')
@section('content')
 <div class="main">
    <div class="main-content">
      <div class="container-fluid">
         <div class="boxbody">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="card-header">
                    <h5 class="card-title">Report</h5>
                    </div>
                </div><!--./col-lg-6-->
            </div><!--./row-->
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-md-12 col-12">
                        <div class="form-group">
                            <label>Select Firm</label>
                            <div class="input-group mb-3">
                            <select name="firm_name" id="firm_id" class="form-control">
                                <option value="0">Select firm</option>
                                @foreach($firms as $firm)
                                <option value="{{$firm->id}}">{{$firm->firm_name}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div><!--./form-group-->
                    </div><!--./col-lg-4-->
                    <div class="col-lg-2 col-md-12 col-12">
                        <div class="form-group">
                            <label>From Date</label>
                            <div class="input-group mb-3">
                            <input id="start_date" name="start_date" required="" type="text" class="form-control datepicker" placeholder="" value="<?php echo date('d-m-Y') ?>" >
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
                            </div>
                        </div><!--./form-group-->
                    </div><!--./col-lg-4-->
                    <div class="col-lg-2 col-md-12 col-12">
                        <div class="form-group">
                            <label>To Date</label>
                            <div class="input-group mb-3">
                            <input id="end_date" name="visitFrom" required="" type="text" class="form-control datepicker" placeholder="" value="<?php echo date('d-m-Y') ?>" >
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
                            </div>
                        </div><!--./form-group-->
                    </div><!--./col-lg-4-->
                    <div class="col-lg-2 col-md-12 col-12">
                        <div class="form-group">
                            <label>Invoice Type</label>
                            <div class="input-group mb-3">
                                 <select class="form-control" name="is_estimate" id="is_estimate">
                                     <option value="0">Invoice</option>
                                     <option value="1">Estimate</option>
                                 </select>
                            </div>
                        </div><!--./form-group-->
                    </div><!--./col-lg-4-->
                    <div class="col-lg-1 col-md-12 col-12">
                        <br>
                        <button type="button" class="theme-btn mt-1" onclick="getBillDetails()">Show</button>
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
                            <th class="th-sm">Invoice No</th>
                            <th class="th-sm">Customer Name</th>
                            <th class="th-sm">Invoice Amount</th>
                            <th class="th-sm">Invoice Date</th>
                            <th class="th-sm">Action</th>
                        </tr>
                    </thead>
                    <tbody id="reportbody">
                    </tbody>
                </table>
                <div class="upper_basic_heading">
                    <span class="white_dash_head_txt pull-right">Total Transaction - <span id="totaltransaction">0</span></span>
                    <br>
                </div>
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
        function getBillDetails() {
            let firm_id=$('#firm_id').val();
            let start_date=$('#start_date').val();
            let end_date=$('#end_date').val();
            let is_estimate=$('#is_estimate').val();

        if (firm_id != 0) {
          $.ajax({
            url:'{{ url("getBillsByFirm") }}',
            data:{"_token": "{{ csrf_token() }}",'firm_id':firm_id,'start_date':start_date,'end_date':end_date,'is_estimate':is_estimate},
            type:'POST',
            dataType:'JSON',
            success:function(res) {
              console.log(res);
              if(res != ""){
                  if(res.html=="")
                  {
                    document.getElementById("download_Report").style.display="none";
                    $("#reportbody").html('<tr><td colspan="6" class="text-center">No data available for this selection</td></tr>');
                  }
                  else{
                    $("#reportbody").html(res.html);
					$("#totaltransaction").html(res.subtotal);
                    document.getElementById("download_Report").style.display="block";
                  }
				}else{
                    document.getElementById("download_Report").style.display="none";
					$("#reportbody").html('<tr><td colspan="6">No data available for this selection</td></tr>');
				}
            }
            // },
            // error: function(jqXHR, textStatus, errorThrown) {
            //     document.getElementById("download_Report").style.display="none";
            //     alert('Something went wrong');
            //     }
          });
        }
        else{
            alert('Please select firm');
        }
      }
      function getInvoiceDetails(invoice_id)
      {
        // alert(invoice_id);
        if (invoice_id != '') {
            $.ajax({
                url:'{{ url("get_invoice_details") }}',
                type:'POST',
                data:{"_token": "{{ csrf_token() }}",'invoice_id':invoice_id},
                dataType:'JSON',
                success:function(res) {
                $("#viewinvoice").modal('show');
                // console.log(res.contact);
                $("#customer_name").text(res.invoice.name);
                $("#customer_mail").text(res.invoice.email);
                $("#customer_contact").text(res.invoice.contact);
                $("#servicebody").html(res.services);
                $("#invoice_total").text(res.invoice.all_total);
                }
            });
         }
      }

      function deleteInvoice(invoice_id)
      {
        // alert(invoice_id);
        if (confirm('Are you sure you want to delete this Invoice ?')) {
            if (invoice_id != '') {
            $.ajax({
                url:'{{ url("delete_invoice") }}',
                type:'POST',
                data:{"_token": "{{ csrf_token() }}",'invoice_id':invoice_id},
                dataType:'JSON',
                success:function(res) {
                    console.log(res);
                    // var result=(JSON.parse(res));
                    if(res.msg==true){
                        alert('Invoice deleted successfully');
                        getBillDetails();
                    }
                    else{
                        alert('Invoice not deleted');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                alert('Something went wrong in delete invoice');
                }
            });
         }
        } else {
        // Do nothing!
        console.log('Invoice not deleted.');
        }
      }

         function getReportExcel(){
            let firm_id=$('#firm_id').val();
            let start_date=$('#start_date').val();
            let end_date=$('#end_date').val();
            let is_estimate=$('#is_estimate').val();
            // console.log(start_date);
            // console.log(end_date);
          $.ajax({
            url:'{{ url("reportExportExcel") }}',
            data:{"_token": "{{ csrf_token() }}",'firm_id':firm_id,'start_date':start_date,'end_date':end_date,'is_estimate':is_estimate},
            type:'POST',
            dataType:'JSON',
            success:function(res) {
              console.log(res.url);
                if(res.result=="true")
                {
                    window.location.href = "{{route('downloadFile')}}";
                }
                else{
                    alert('Something wrong in download');
                }
            }
          });
        }

    </script>
@endsection
