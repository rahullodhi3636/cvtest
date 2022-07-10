<div class="panelbox">
          
  <div class="row">

   <div class="col-lg-12 col-md-12 col-12 mt-3">
     <h6><i class="fa fa-tasks"></i> Services Count <span id="customerCount"><?php echo count($services) ?></span></h6>
     <div class="bs-example">
      <div class="accordion" id="accordionExample">
        <?php if (!empty($services)): ?>
          <?php 
            foreach ($services as $service): 
              $servicetypes = DB::table('service_brands')->where('service_id',$service->id)->get();
          ?>

            <div class="card">
              <div class="card-header" id="heading{{ $service->id }}">
                  <h2 class="mb-0">
                      <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapse{{ $service->id }}"><i class="fa fa-plus"></i> {{ $service->name }} (<?php echo count($servicetypes) ?>)</button>
                      <button type="button" onclick="getServiceById('{{ $service->id }}')" class="btn btn-primary text-right">edit</button>


                      <button onclick="deleteService('{{ $service->id }}')" class="btn-danger btn-sm waves-effect waves-light material-tooltip-main" type="button" style="border:0 !important" data-toggle="tooltip" data-html="true" title="Delete"><i class="fa fa-close"></i></button>
                      
                  </h2>
              </div>
              <div id="collapse{{ $service->id }}" class="collapse" aria-labelledby="heading{{ $service->id }}" data-parent="#accordionExample">
                <div class="card-body">
                    <table class="table table-bordered table-striped recent-purchases-listing">
                      <thead>
                        <tr>
                          <th class="th-sm">Name</th>
                          <th class="th-sm">Price</th>
                          <th class="th-sm">Special Price</th>
                          <th class="th-sm">Duration (Mins)</th>
                          <th class="th-sm">Action</th>
                        </tr>
                      </thead>
                      <tbody id="firmTableBody">
                         @foreach ($servicetypes as $cat)
                          <tr>
                            <td>{{ $cat->brand_name }}</td>
                            <td>{{ $cat->service_price }}</td>
                            <td>{{ $cat->special_price }}</td>
                            <td>{{ $cat->service_duration }}</td>
                            <td>
                              <table >
                                <tr>
                                  <th style="padding: 0">
                                      <button onclick="deleteBrand('{{ $cat->service_brand_id }}')" class="btn-danger btn-sm waves-effect waves-light material-tooltip-main" type="button" style="border:0 !important" data-toggle="tooltip" data-html="true" title="Delete"><i class="fa fa-close"></i></button>
                                  </th>
                                </tr>
                              </table>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
              </div>
            </div>
          <?php endforeach ?>
        <?php endif ?>
      </div>
    </div>
  </div><!--./row-->
</div><!--./panelbox-->