@extends('layouts.newlayout.app')
@section('content')
 <div class="main">
    <div class="main-content">
      <div class="container-fluid">
         <div class="boxbody">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="card-header">
                    <h5 class="card-title">Gift Point Report- {{$customer[0]->name}}</h5>
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
                            <th class="th-sm">Action</th>
                        </tr>
                    </thead>
                    <tbody id="reportbody">
                       
                        @foreach($customer as $cust_data)
                        <tr>
                            <td>{{($loop->index)+1}}</td>
                            <td>{{$cust_data->invoice_id}}</td>
                            <td>{{$cust_data->points_allow}}</td>
                            <td>{{$cust_data->used_points}}</td>
                            <td>
                                <button type='button' class='btn btn-info' onclick='getPointDetails({{$cust_data->invoice_id}})'>
                                <i class='fa fa-pencil'></i>
                                </button>
                            </td>
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

   <div class="modal" id="viewinvoice">
        <div class="modal-dialog modal-md">        
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">Edit Point Used</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->                
                <div class="modal-body formvisit">
                    <form action="{{ route('update_customerpoint_details') }}" id="addcustomerpointform" method="POST">
                    {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label" for="customer_id">Used Points </label>
                                    <input type="hidden" id="points_id" name="id" >
                                    <input type="text"  id="used_points" name="used_points" placeholder="Enter Used Points"  class="form-control" autocomplete="off" >                                
                                </div>
                            </div>                        
                        </div>  
                    </form>                  
                </div>
                <div class="modal-footer">
                    <input type="submit" class="outline-btn" value="save" />                    
                </div>               
            </div>        
        </div>
    </div>

    <script src="{{asset('assets/js/lib/jquery.js')}}"></script>
    <script src="{{asset('assets/js/dist/jquery.validate.js')}}"></script>
    <script>   

        function getPointDetails(invoice_id){
            if (invoice_id != '') {
            $.ajax({
                url:'{{ url("get_point_details") }}',
                type:'POST',
                data:{"_token": "{{ csrf_token() }}",'invoice_id':invoice_id},
                dataType:'JSON',
                success:function(res) {
                 console.log(res);
                //  var result= JSON.parse(res);
                 if(res.msg==true)
                 {
                     $('#viewinvoice').modal('show');
                     $('#points_id').val(res.data.id);
                     $('#used_points').val(res.data.used_points);
                 }
                 else{
                     alert('Value not find for Invoice');
                 }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                // document.getElementById("download_Report").style.display="none";
                alert('Something went wrong in get points');
                }
            });
         }
        }

    </script>
@endsection
