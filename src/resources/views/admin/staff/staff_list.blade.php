@extends('layouts.adminmaster')
@section('title', 'Enquiry')
@section('content')
        <div class="right-details-box">
            <div class="home_brics_row">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dash_boxcontainner white_boxlist">
                            <div class="upper_basic_heading">
                                <span class="white_dash_head_txt">Staff List <a href="{{route('staff.create')}}" class="btn margin0 btn-sm btn-mdb-color single-table-btn float-right waves-effect waves-light" type="button"><i class="mdi mdi-plus mr-1"></i>Add New Staff
</a> </span>
                                
                            
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
                                  <th class="th-sm">Branch</th>
                                  <th class="th-sm">Contact</th>
                                  <th class="th-sm">Email</th>  
                                  <th class="th-sm">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                              @if(!empty($staff))
                              @foreach ($staff as $cat)
                                @if($cat->admin != 1)
                                <tr>
                                  <td>
                                    @if(!empty($cat->image))
                                    <img src="{{ url('images/staff') }}/{{$cat->image}}" width="80px">
                                    @else
                                    <img class="img img-responsive center-block" src="{{ url('images/staff/icon.png') }}" width="80px">
                                    @endif
                                  </td>
                                  <td>{{ $cat->name }}</td>
                                  <td>{{ $cat->branch_name }}</td>
                                  <td>{{ $cat->phone_no }}</td>
                                  <td>{{ $cat->email }}</td>
                                 
                                  <td>
                                    <table >
                                      <tr>
                                        <th style="padding: 0">
                                          <a href="{{ route('staff.edit',$cat->id)}}" class="btn-primary btn-sm waves-effect waves-light text-light material-tooltip-main" data-toggle="tooltip" data-html="true" title="Edit">
                                            <i class="mdi mdi-pencil"></i>
                                          </a>
                                          <!-- <a href="" class="btn btn-primary">Edit</a> -->
                                        </th>
                                        <th style="padding: 0">
                                          <form action="{{ route('staff.destroy', $cat->id)}}" method="post">
                                            <input type="hidden" name="_method" value="delete" />
                                            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                                            <button class="btn-danger btn-sm waves-effect waves-light material-tooltip-main" type="submit" style="border:0 !important" data-toggle="tooltip" data-html="true" title="Delete"><i class="mdi mdi-delete"></i></button>
                                          </form>
                                        </th>
                                      </tr>
                                    </table>
                                  </td>
                                </tr>
                                @endif
                                @endforeach
                                @endif
                              
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