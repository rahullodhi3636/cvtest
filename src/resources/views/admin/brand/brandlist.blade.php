@extends('layouts.adminmaster')
@section('title', 'Brands')
@section('content')
        <div class="right-details-box">
            <div class="home_brics_row">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dash_boxcontainner white_boxlist">
                            <div class="upper_basic_heading">
                                <span class="white_dash_head_txt">Brand List <a href="{{route('brand.create')}}" class="btn margin0 btn-sm btn-mdb-color single-table-btn float-right waves-effect waves-light" type="button"><i class="mdi mdi-plus mr-1"></i>Add New brand
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
                                  <th class="th-sm">Service name</th>
                                  <th class="th-sm">Create date</th>
                                  <th class="th-sm">Status</th>
                                  <th class="th-sm">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                              @foreach ($brands as $brand)
                                <tr>
                                  <td><img src="{{url('images/brand/')}}/{{$brand->brand_icon}}" width="100px" class="img-responsive"></td>
                                  <td>{{ $brand->brand_name }}</td>
                                  <td>
                                    <?php 
                                      $service = DB::table('services')->where('id',$brand->service_id)->first(); 
                                      if(!empty($service))
                                        echo $service->name;
                                      else
                                        echo "NA";
                                    ?>
                                  </td>
                                  <td>{{ $brand->created_at }}</td>
                                  <td>
                                      @if($brand->status ==1)         
                                          Active        
                                      @else
                                          Deactive
                                      @endif
                                  </td>
                                  <td>
                                    <table >
                                      <tr>
                                        <th style="padding: 0">
                                          <a href="{{ route('brand.edit',$brand->id)}}" class="btn-primary btn-sm waves-effect waves-light text-light material-tooltip-main" data-toggle="tooltip" data-html="true" title="Edit">
                                            <i class="mdi mdi-pencil"></i>
                                          </a>
                                          <!-- <a href="" class="btn btn-primary">Edit</a> -->
                                        </th>
                                        <th style="padding: 0">
                                          <form action="{{ route('brand.destroy', $brand->id)}}" method="post">
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
                              <!-- <tfoot>
                                <tr>
                                  <th>Name
                                  </th>
                                 
                                  <th>Status
                                  </th>
                                  <th>Action
                                  </th>
                                  
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