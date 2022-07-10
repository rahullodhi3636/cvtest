@extends('layouts.newlayout.parallel_app')
@section('content')

<style>
    .centered {
        text-align: center;
        align-content: center;
    }

    .ticket {
        max-width: 90%;
    }

    img {
        max-width: inherit;
        width: inherit;
    }

    #heading {
        text-align: center;
    }

    .ticket {
        margin: 0 auto;
    }
    .ticket{
        font-size: 12px;
        font-family: 'Times New Roman';
    }

    .card-body{
      background: black;
    }
    .card>.card-header{
      background:#917758;
    }
    .card-header button{
      color:white;
    }
    .card{
      border:0px solid black;
    }
    .card-header:first-child{
        border-radius: unset !important;
    }
    .qr_img{
        padding: 10px;
    margin-top: 20px;
    margin-bottom: 20px;
    max-width: 200px;
    }

    </style>

<div class="modal bd-example-modal-lg" tabindex="-1" role="dialog" id="getInvoiceType">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">REVIEW YOUR BILL</h5>
          {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> --}}
        </div>
        <div class="modal-body">
          <div class="invoice_data">
            <div class="invoice_logo" style="text-align:center">
                <img src="{{ url('assets/images/logo-cstestseries3.png')}}" style="width: 50%;opacity:0.2">
            </div>
          </div>
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div> --}}
      </div>
    </div>
  </div>
  @endsection
  @section('script')
  <script type="text/javascript">
    $(document).ready(function(){
         setInterval(function () {
             get_invoice_type();
         }, 5000);
    });
    function get_invoice_type(){
          // $("#addfirm").modal('hide');
          $('#getInvoiceType').modal('show');
          var user_id = "{{ $user_id }}";
          var dataString = "user_id="+user_id+"&_token={{ csrf_token() }}";
          $.ajax({
                type: "POST",
                url:'{{ url("parallel_popupdata") }}',
                data: dataString,
                cache: false,
                dataType: "json",
                success: function(result){
                    console.log(result)
                  if(result.row!=0){
                        var res = result.row.data;
                        var save_firm_id = result.row.save_firm_id;

                        var html = '<div id="accordion">';
                        if(res.length>0){
                        $.each(res, function (i, item) {
                        html+=`<div class="card">`;
                        html+=`<div class="card-header" id="heading${i}">`;
                        html+=`<h5 class="mb-0">`;
                        html+=`<button class="btn btn-link" data-toggle="collapse" data-target="#collapse${i}" aria-expanded="true" aria-controls="collapse${i}">
                                ${item.firm_name}
                              </button>`;
                        html+=`</h5>`;
                        html+=`</div>`;
                        var firm_id = item.firm_id;
                        html+=`<div id="collapse${i}" class="collapse show" aria-labelledby="heading${i}" data-parent="#accordion">`;
                        html+=`<div class="card-body">`;//start card body
                        html+= '<div class="row">';
                        html += '<div class="ticket col-md-8">';
                        html += '<p class="centered">'+item.customer_name+'<br> '+item.customer_email+' <br>'+item.customer_contact+'</p>';
                        html += '<p class="centered">'+item.firm_name+'</p>';
                        var services = '<table align="center">';
                         services += '<thead><tr><th width="20%">Brand</th><th width="20%">Service</th><th width="20%">Price</th><th width="20%">Discount</th><th width="20%">GST</th><th width="20%">Total</th></tr></thead>';
                         services += '<tbody>';
                            $.each(item.services, function (r, ritem) {
                                services += '<tr><td>'+ritem.pb_name+'</td><td>'+ritem.sbname+'</td><td>'+ritem.servicePriceTotal+'</td><td>'+ritem.serviceDisc+'</td><td>'+ritem.servicesgstdiscount+'</td><td><i class="fa fa-inr"></i>'+ritem.serviceTotal+'</td></tr>';
                            });
                            services += '<tr><td class="emptyrow" colspan="4"><strong>Subtotal </strong></td><td class="emptyrow"></td><td class="emptyrow"><i class="fa fa-inr"></i>'+item.total_amount+'</td></tr>';
                        if(item.extra_discount!=0){
                            services += '<tr><td class="emptyrow" colspan="4"><strong>Other discount </strong></td><td class="emptyrow"></td><td class="emptyrow"><i class="fa fa-inr"></i>'+item.extra_discount+'</td></tr>';
                        }
                        services += '<tr><td class="emptyrow" colspan="4"><strong>Total </strong></td><td class="emptyrow"></td><td class="emptyrow"><i class="fa fa-inr"></i>'+item.totalgrandTotal+'</td></tr>';
                        services += '</tbody>';
                        services += '</table>';
                        html += services;
                        html += '</div>';
                        html += '<div class="centered qr_img col-md-4"><img src="'+item.firm_qr+'" style="width:200px"></div>';
                        html += '</div>';//end row class
                        html+=`</div>`;//end card body
                        html+=`</div>`;
                        html+=`</div>`;
                        });//end each
                        html+=`</div>`;
                       }
                        $('.invoice_data').html(html);
                  }//end if
                  else{
                    html = '<div class="invoice_logo" style="text-align:center"><img src="assets/images/logo-cstestseries3.png" style="width: 50%;opacity:0.2"></div>';
                    $('.invoice_data').html(html);
                  }
                }//end sucess
          });//end ajax
        }
</script>
@endsection
