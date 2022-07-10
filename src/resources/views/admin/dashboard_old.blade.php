@extends('layouts.adminmaster')
@section('content')
<div class="right-details-box">
    <div class="home_brics_row">
        <div class="row">
            <div class="col-sm-7">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="white_brics">
                            <div class="white_icon_withtxt">
                                <div class="white_icons_blk"><i
                                        class="mdi mdi-basket-fill"></i></div>
                                <div class="white_brics_txt">Today Collections</div>
                                <div class="white_brics_count">{{ $today_collection }}</div>
                            </div>
                            <div class="brics_progress white_brics_border_clr1"></div>
                        </div>
                    </div>
                    <!-- <div class="col-sm-6">
                        <div class="white_brics">
                            <div class="white_icon_withtxt">
                                <div class="white_icons_blk"><i
                                        class="mdi mdi-basket-unfill"></i></div>
                                <div class="white_brics_txt">Expenses</div>
                                <div class="white_brics_count">0</div>
                            </div>
                            <div class="brics_progress white_brics_border_clr1"></div>
                        </div>
                    </div> -->
                    <div class="col-sm-6">
                        <div class="white_brics">
                            <div class="white_icon_withtxt">
                                <div class="white_icons_blk"><i
                                        class="mdi mdi-file-document-box-multiple-outline"></i></div>
                                <div class="white_brics_txt">Total Customers</div>
                                <div class="white_brics_count">{{ $total_customer }}</div>
                            </div>
                            <div class="brics_progress white_brics_border_clr1"></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="white_brics">
                            <div class="white_icon_withtxt">
                                <div class="white_icons_blk white_brics_clr2"><i class="mdi mdi-basket"></i>
                                </div>
                                <div class="white_brics_txt">Total Enquiries</div>
                                <div class="white_brics_count">{{ $total_enquery }}</div>
                            </div>
                            <div class="brics_progress white_brics_border_clr2"></div>
                        </div>

                    </div>
                    <div class="col-sm-6">
                        <div class="white_brics">
                            <div class="white_icon_withtxt">
                                <div class="white_icons_blk white_brics_clr3"><i
                                        class="mdi mdi-book-open-page-variant"></i></div>
                                <div class="white_brics_txt">Total Packages</div>
                                <div class="white_brics_count">{{ $total_package }}</div>
                            </div>
                            <div class="brics_progress white_brics_border_clr3"></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="white_brics">
                            <div class="white_icon_withtxt">
                                <div class="white_icons_blk white_brics_clr4"><i class="mdi mdi-chart-line"></i>
                                </div>
                                <div class="white_brics_txt">Total Services</div>
                                <div class="white_brics_count">{{ $total_services }}</div>
                            </div>
                            <div class="brics_progress white_brics_border_clr4"></div>
                        </div>
                    </div>
                </div>
                <div class="dash_boxcontainner white_boxlist">
                    <div class="upper_basic_heading">
                        <span class="white_dash_head_txt">Recent Customers</span>
                    </div>
                    <div class="panel-body dash_table_containner">
                        <table class="table table-bordered table-hover grid-table">
                            <thead>
                            <tr class="tr-header globe-header-tr">
                                <th >No.</th>
                                <th class="paper-name">Name</th>
                                <th class="">Contact</th>
                                <th class="">Location</th>
                                <th class="">Remark</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $i=1; @endphp
                            @foreach ($customer as $cat)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td class="tab-grid width_25 paper-name" data-line="Coloum 1">{{ $cat->name }}</td>
                                    <td class="tab-grid width_18 col2" data-line="Coloum 2">{{ $cat->contact }}</td>
                                    <td class="tab-grid width_15 col3" data-line="Coloum 3">{{ $cat->location }}</td>
                                    <td class="tab-grid width_12 col4" data-line="Coloum 4">{{ $cat->remark }}</td>
                                </tr>
                            @php $i++ @endphp
                            @endforeach

                          
                           
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="mb-5">
                    <div class="dash_boxcontainner white_boxlist">
                        <div class="upper_basic_heading">
                            <span class="white_dash_head_txt">Birthday's</span>
                        </div>
                        <div class="panel-body dash_table_containner">
                            <table class="table table-bordered table-hover grid-table">
                            <thead>
                            <tr class="tr-header globe-header-tr">
                                <th >No.</th>
                                <th class="paper-name">Name</th>
                                <th class="">Contact</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $i=1; @endphp
                            @foreach ($customer as $cat)
                            @php
                                $dob = $cat->dob;
                                $todayDate = date("m-d");
                                $dateMonth = date("m-d",strtotime($cat->dob));
                                $todayDate." ".$dateMonth;
                                if($todayDate == $dateMonth){
                            @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td class="tab-grid width_25 paper-name" data-line="Coloum 1">{{ $cat->name }}</td>
                                    <td class="tab-grid width_18 col2" data-line="Coloum 2">{{ $cat->contact }}</td>
                                </tr>
                            @php $i++;
                            } 
                            @endphp
                            @endforeach

                          
                           
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
                <div class="dash_boxcontainner white_boxlist">
                    <div class="upper_basic_heading">
                        <span class="white_dash_head_txt">Anniversaries </span>
                    </div>
                    <div class="panel-body dash_table_containner">
                            <table class="table table-bordered table-hover grid-table">
                            <thead>
                            <tr class="tr-header globe-header-tr">
                                <th >No.</th>
                                <th class="paper-name">Name</th>
                                <th class="">Contact</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $i=1; @endphp
                            @foreach ($customer as $cat)
                            @php
                                $dob = $cat->dob;
                                $todayDate = date("m-d");
                                $dateMonth = date("m-d",strtotime($cat->anniversary_date));
                                $todayDate." ".$dateMonth;
                                if($todayDate == $dateMonth){
                            @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td class="tab-grid width_25 paper-name" data-line="Coloum 1">{{ $cat->name }}</td>
                                    <td class="tab-grid width_18 col2" data-line="Coloum 2">{{ $cat->contact }}</td>
                                </tr>
                            @php $i++;
                            } 
                            @endphp
                            @endforeach

                          
                           
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="right-details-box">
    <div class="home_brics_row">
        <div class="row">
            <div class="col-md-12">
                <div class="dash_boxcontainner white_boxlist">
                    <div class="upper_basic_heading">
                        <span class="white_dash_head_txt">My Order List</span>
                    </div>
                    <div class="panel-body dash_table_containner">
                        <table class="table table-bordered table-hover grid-table">
                            <thead>
                            <tr class="tr-header globe-header-tr">
                                <th>No.</th>
                                <th class="paper-name">Name</th>
                                <th class="">Contact</th>
                                <th class="">Address</th>
                                <th class="">Remark</th>
                                
                            </tr>
                            </thead>
                            <tbody>
                            @php $i=1; @endphp
                            @foreach ($enquiry as $cat)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td class="tab-grid width_25 paper-name" data-line="Coloum 1">{{ $cat->name }}</td>
                                    <td class="tab-grid width_18 col2" data-line="Coloum 2">{{ $cat->contact }}</td>
                                    <td class="tab-grid width_15 col3" data-line="Coloum 3">{{ $cat->address }}</td>
                                    <td class="tab-grid width_12 col4" data-line="Coloum 4">{{ $cat->remark }}</td>
                                </tr>
                            @php $i++; @endphp
                            @endforeach
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection