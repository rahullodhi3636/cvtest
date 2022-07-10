@extends('layouts.newlayout.app')
@section('content')
<style>
    .boxbody {
        background-color:white;
        color:black;
    }
    .fc-content{
        color:white;
    }
</style>
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="boxbody">
                <ul class="nav nav-tabs2 nav-justified">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#SittingPackageData">Booking Details</a>
                    </li>
                    <!-- <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#Service">Service Segment</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#Upcoming">Upcoming Segment</a>
              </li> -->
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="SittingPackageData">                        
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
                            <div id='calendar'></div>
                        </div>
                        <!--./row-->
                    </div>
                    <!--./panelbox-->
                </div>
                <!--./Customer-->
            </div>
            <!--./tab-content-->
        </div>
        <!--./boxbody-->
    </div>
    <!--./container-fluid-->
    <footer>Copyright © 2020 Chinnie & Vinnie Jabalpur Salon. All rights reserved.</footer>
</div>
<!--./main-content-->

</div>
<!--./main-->

<!-- The Modal -->


<script src="{{asset('assets/js/lib/jquery.js')}}"></script>
<script src="{{asset('assets/js/dist/jquery.validate.js')}}"></script>
<script>
$(document).ready(function() {
    var SITEURL = "{{ url('/') }}";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var calendar = $('#calendar').fullCalendar({
        header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
        defaultView: 'month',
        events: SITEURL + "/admin/calender",
        displayEventTime: true,
        eventRender: function(event, element, view) {
            console.log(event);
            element.find('.fc-title').after('<br><a style="color:white;" target="_blank" href="{{ url("/mypackinvoice") }}/'+event.description+'">Invoice</a>');
            if (event.allDay === 'true') {
                event.allDay = true;
            } else {
                event.allDay = false;
            }
        },
        
    });
});
</script>
@endsection