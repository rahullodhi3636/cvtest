@extends('layouts.newlayout.app')
@section('content')
 <div class="main">
    <div class="main-content">
      <div class="container-fluid">
         <div class="boxbody">
            <ul class="nav nav-tabs2 nav-justified">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#Customer">Salon Firms</a>
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
                <form class="formvisit">  
                <div class="panelbox">
                  <div class="row">
                    <?php if (!empty($firms)): ?>
                      <?php foreach ($firms as $firm): ?>
                        <div class="col-lg-3 col-md-6 col-12">
                          <a target="_blank" style="text-decoration: none;" href="{{ url('quicksaleByFirm') }}/{{ $firm->id }}">
                            <div class="metric clr-block-1">
                              <h3>{{ $firm->firm_name }}</h3>
                              <p>{{ $firm->firm_location }}</p>
                            </div><!--./metric-->
                          </a>
                        </div><!--/col-lg-3-->
                      <?php endforeach ?>
                    <?php endif ?>
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
    <script src="{{asset('assets/js/lib/jquery.js')}}"></script>
    <script src="{{asset('assets/js/dist/jquery.validate.js')}}"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('#btn_delete').click(function(){
          if(confirm("Are you sure you want to delete this?"))
          {
            var id = [];
            $('.deletecheckbox:checkbox:checked').each(function(i){
              id[i] = $(this).val();
            });
           
            if(id.length === 0) //tell you if the array is empty
            {
              alert("Please Select atleast one checkbox");
            }else{
              $.ajax({
                url:'deleteCustomer',
                method:'POST',
                data:{id:id},
                dataType:'JSON',
                success:function(res)
                {
                    $("#customerTableBody").html(res.html);
                    $("#customerCount").html(res.customerCount);
                }
              });
            }
          }else{
            return false;
          }
        });
      });
      $('.selectall').click(function() {
          if ($(this).is(':checked')) {
              $('div input').attr('checked', true);
          } else {
              $('div input').attr('checked', false);
          }
      });
      function getCustomerByLatter(latter) {
        if (latter != '') {
          $.ajax({
            url:'{{ url("getCustomerByLatter") }}',
            data:{'latter':latter},
            type:'POST',
            dataType:'JSON',
            success:function(res) {
              $("#customerTableBody").html(res.html);
              $("#customerCount").html(res.customerCount);
            }
          });
        }
      }
      function filterCustomer() {
        var visitFrom = $("#visitFrom").val();
        var visitTo = $("#visitTo").val();
        var visitCountFrom = $("#visitCountFrom").val();
        var visitCountTo = $("#visitCountTo").val();
        var searchType = $("#searchType").val();
        var amountFilter = $("#amountFilter").val();
        $.ajax({
          url:'{{ url("filterCustomer") }}',
          data:{'visitFrom':visitFrom,'visitTo':visitTo,'visitCountFrom':visitCountFrom,'visitCountTo':visitCountTo,'searchType':searchType,'amountFilter':amountFilter,},
          type:'POST',
          dataType:'JSON',
          success:function(res) {
            $("#customerTableBody").html(res.html);
          }
        });
      }
      function showFilters() {
        $("#filtersDiv").toggle();
        $("#filterDivider").toggle();
      }
   </script>
@endsection