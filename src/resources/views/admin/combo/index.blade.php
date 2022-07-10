@extends('layouts.newlayout.app')
@section('content')
<div class="main">
    <div class="main-content">
      <div class="container-fluid">
         <div class="boxbody">
            <ul class="nav nav-tabs2 nav-justified">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#ComboData">Combo</a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#Service">Service Segment</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#Upcoming">Upcoming Segment</a>
              </li> -->
            </ul>

            <div class="tab-content">
              <div class="tab-pane active" id="ComboData">
                <form class="formvisit">
                <div class="panelbox">
                  <div class="text-right mt-2 mb-2">
                      <a href="{{route('add_combo')}}" class="theme-btn">New combo</a>
                  </div>
                  <div class="row">
                   <div class="col-lg-12 col-md-12 col-12 mt-3">
                     <h6><i class="fa fa-tasks"></i> Combo Count <span id="customerCount">0</span></h6>
                      <div class="table-responsive">
                    <table class="table table-bordered table-striped recent-purchases-listing">
                      <thead>
                        <tr>
                          <th class="th-sm">Sr</th>
                          <th class="th-sm">Name</th>
                          <th class="th-sm">Price</th>
                          <th class="th-sm">Start Date</th>
                          <!-- <th class="th-sm">Action</th> -->
                        </tr>
                      </thead>
                      <tbody id="comboTableBody">
                        @foreach($combos as $combo)
                          <tr>
                            <td>{{($loop->index)+1}}</td>
                            <td>{{$combo->combo_name}}</td>
                            <td><i class="fa fa-inr"></i> {{$combo->combo_price}}</td>
                            <td><?php echo date("d-M-Y", strtotime($combo->created_at)); ?> </td>
                            <!-- <td><button type='button' class='btn btn-info' onclick='getComboDetails($combo->id)'><i class='fa fa-eye'></i></button></td> -->
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
   <div class="modal" id="addcombo">
      <div class="modal-dialog modal-lg">
        <form id="addcomboform" >
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add combo</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
            <!-- Modal body -->
            <div class="modal-body formvisit">
              <div class="row">
                <div class="col-lg-4 col-md-12 col-12">
                  <div class="form-group">
                    <label>combo Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Enter combo name"  class="form-control">
                  </div>
                </div><!--./col-lg-4-->

                <div class="col-lg-4 col-md-12 col-12">
                   <div class="form-group">
                      <label>Price</label>
                      <input type="text"  id="price" name="price" value="{{ old('price') }}" placeholder="Enter Combo Price"  class="form-control">
                    </div>
                </div><!--./col-lg-4-->

                <div class="col-lg-4 col-md-12 col-12">
                   <div class="form-group">
                      <label>Status</label>
                      <select name="status" id="status" class="form-control col-md-7 col-xs-12" id="status">
                          <option value="1" {{ old('status') == '1'? 'selected' : '' }} >Active</option>
                          <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Deactive</option>
                      </select>
                    </div>
                </div><!--./col-lg-4-->
              </div><!--./row-->
            </div>
            <div class="modal-footer">
              <button type="button" class="outline-btn" data-dismiss="modal">Cancel</button> 
              <button type="submit" class="theme-btn">Save</button>
            </div>
          </div>
        </form>
      </div>
    </div><!--#/addcustomer-->

   <div class="modal" id="viewinvoice">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">View Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body formvisit">
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
            let combo_id=$('#combo_id').val();
            let start_date=$('#start_date').val();
            let end_date=$('#end_date').val();
            console.log(start_date);
            console.log(end_date);
        if (combo_id != 0) {
          $.ajax({
            url:'{{ url("getBillsBycombo") }}',
            data:{"_token": "{{ csrf_token() }}",'combo_id':combo_id,'start_date':start_date,'end_date':end_date},
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
            },
            error: function(jqXHR, textStatus, errorThrown) {
                document.getElementById("download_Report").style.display="none";
                alert('Something went wrong');
                }
          });
        }
        else{
            alert('Please select combo');
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
        if (concombo('Are you sure you want to delete this Invoice ?')) {
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
            let combo_id=$('#combo_id').val();
            let start_date=$('#start_date').val();
            let end_date=$('#end_date').val();
            // console.log(start_date);
            // console.log(end_date);
          $.ajax({
            url:'{{ url("reportExportExcel") }}',
            data:{"_token": "{{ csrf_token() }}",'combo_id':combo_id,'start_date':start_date,'end_date':end_date},
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
