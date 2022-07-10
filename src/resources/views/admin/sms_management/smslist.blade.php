@extends('layouts.adminmaster')
@section('title', 'smsmanagement')
@section('content')
        <div class="right-details-box">
            <div class="home_brics_row">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dash_boxcontainner white_boxlist">
                            <div class="upper_basic_heading">
                                <span class="white_dash_head_txt">SMS Template Lists <!-- <a href="{{route('sms.create')}}" class="btn margin0 btn-sm btn-mdb-color single-table-btn float-right waves-effect waves-light" type="button"><i class="mdi mdi-plus mr-1"></i>Add New SMS Template
</a> --> </span>
                                
                            
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
                                  <th class="th-sm">Template Name</th>
                                  <th class="th-sm">Template Message</th>
                                  <th class="th-sm">Status</th>
                                  <th class="th-sm">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                              @foreach ($sms as $smslist)
                                <tr>
                                  <td>{{ $smslist->template_name }}</td>s
                                  <td>{{ $smslist->template_message }}</td>
                                  @php
                                    if($smslist->template_status == 1)
                                      $status = "Active";
                                    else
                                      $status = "Deactive";
                                  @endphp
                                  <td>{{ $status }}</td>
                                  <td>
                                    <table >
                                      <tr>
                                        <th style="padding: 0">
                                          <a href="{{ route('sms.edit',$smslist->id)}}" class="btn-primary btn-sm waves-effect waves-light text-light material-tooltip-main" data-toggle="tooltip" data-html="true" title="Edit">
                                            <i class="mdi mdi-pencil"></i>
                                          </a>
                                          <!-- <a href="" class="btn btn-primary">Edit</a> -->
                                        </th>
                                        <th style="padding: 0">
                                          <form action="{{ route('sms.destroy', $smslist->id)}}" method="post">
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