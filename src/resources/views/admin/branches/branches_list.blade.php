@extends('layouts.adminmaster')
@section('title', 'Branches')
@section('content')
        <div class="right-details-box">
            <div class="home_brics_row">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dash_boxcontainner white_boxlist">
                            <div class="upper_basic_heading">
                                <span class="white_dash_head_txt">Branches List <a href="{{route('branches.create')}}" class="btn margin0 btn-sm btn-mdb-color single-table-btn float-right waves-effect waves-light" type="button"><i class="mdi mdi-plus mr-1"></i>Add New branch
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
                                  <th class="th-sm">Name</th>
                                  <th class="th-sm">Address</th>
                                  <th class="th-sm">Status</th>
                                  <th class="th-sm">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                              @foreach ($branches as $cat)
                                <tr>
                                  <td>{{ $cat->name }}</td>
                                  <td>{{ $cat->address }}</td>
                                  <td>
                                      @if($cat->status ==1)         
                                          Active        
                                      @else
                                          Deactive
                                      @endif
                                  </td>
                                  <td>
                                    <table >
                                      <tr>
                                        <th style="padding: 0">
                                          <a href="{{ route('branches.edit',$cat->id)}}" class="btn-primary btn-sm waves-effect waves-light text-light material-tooltip-main" data-toggle="tooltip" data-html="true" title="Edit">
                                            <i class="mdi mdi-pencil"></i>
                                          </a>
                                          <!-- <a href="" class="btn btn-primary">Edit</a> -->
                                        </th>
                                        <th style="padding: 0">
                                          <form action="{{ route('branches.destroy', $cat->id)}}" method="post">
                                            <input type="hidden" name="_method" value="delete" />
                                            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                                            <button class="btn-danger btn-sm waves-effect waves-light material-tooltip-main" type="submit" style="border:0 !important" data-toggle="tooltip" data-html="true" title="Delete"><i class="mdi mdi-delete"></i></button>
                                          </form>
                                        </th>
                                      </tr>
                                    </table>
                                  </td>
                                </tr>
                                @endforeach
                                
                              
                              </tbody>
                              <tfoot>
                                <tr>
                                  <th>Name
                                  </th>
                                  <th>Address
                                  </th>
                                  <th>Status
                                  </th>
                                  <th>Action
                                  </th>
                                  
                                </tr>
                              </tfoot>
                            </table>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection