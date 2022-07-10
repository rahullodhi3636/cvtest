@extends('layouts.adminmaster')
@section('title', 'Enquiry')
@section('content')
        <div class="right-details-box">
            <div class="home_brics_row">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dash_boxcontainner white_boxlist">
                            <div class="upper_basic_heading">
                                <span class="white_dash_head_txt">Customer Feedback List </span>
                                
                            
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
                                  <th class="th-sm">Image</th>
                                  <th class="th-sm">Name</th>
                                  <th class="th-sm">Contact</th>
                                  <th class="th-sm">Rating Star</th>
                                  <th class="th-sm">Comment</th>
                                  <th class="th-sm">Date</th>
                                  <!-- <th class="th-sm">Action</th> -->
                                </tr>
                              </thead>
                              <tbody>
                              @foreach ($feedback as $list)
                                <tr>
                                  <td>
                                    @if(!empty($list->customer_image))
                                    <img src="{{ url('images/customer') }}/{{$list->customer_image}}" width="50px">
                                    @endif
                                  </td>
                                  <td>{{ $list->name }}</td>s
                                  <td>{{ $list->contact }}</td>
                                  <td>{{ $list->rating }}</td>
                                  <td>{{ $list->comment }}</td>
                                  <td>{{ date('d-M-Y',strtotime($list->feedback_date)) }}</td>
                                 
                                  <!-- <td>
                                    <table >
                                      <tr>
                                        <th style="padding: 0">
                                          <a href="{{ route('customer.edit',$list->feedback_id)}}" class="btn-primary btn-sm waves-effect waves-light text-light material-tooltip-main" data-toggle="tooltip" data-html="true" title="Edit">
                                            <i class="mdi mdi-pencil"></i>
                                          </a>-->
                                          <!-- <a href="" class="btn btn-primary">Edit</a> -->
                                        <!--</th>
                                        <th style="padding: 0">
                                          <form action="{{ route('customer.destroy', $list->feedback_id)}}" method="post">
                                            <input type="hidden" name="_method" value="delete" />
                                            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                                            <button class="btn-danger btn-sm waves-effect waves-light material-tooltip-main" type="submit" style="border:0 !important" data-toggle="tooltip" data-html="true" title="Delete"><i class="mdi mdi-delete"></i></button>
                                          </form>
                                        </th>
                                      </tr>
                                    </table>
                                  </td> -->
                                </tr>
                                @endforeach
                                
                              
                              </tbody>
                              <!-- <tfoot>
                                <tr>
                                   <th class="th-sm">Name</th>
                                  <th class="th-sm">Contact</th>
                                  <th class="th-sm">Address</th>
                                  <th class="th-sm">Remark</th>
                                  <th class="th-sm">Action</th>
                                  
                                </tr>
                              </tfoot> -->
                            </table>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection