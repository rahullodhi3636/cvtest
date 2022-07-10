@extends('layouts.adminmaster')
@section('title', 'Reports')
@section('content')
<div class="right-details-box">
	<div class="home_brics_row">
		<div class="row">
			<div class="col-md-12">
				<div class="dash_boxcontainner white_boxlist">
					<div class="upper_basic_heading">
						<span class="white_dash_head_txt">Transaction Report</span>
						<span class="white_dash_head_txt text-right">Total Transaction - <span id="totaltransaction">0</span></span>
					</div>
					<div class="panel-body dash_table_containner">
						<!-- <table class="table table-striped table-bordered" cellspacing="0" width="100%"> -->
							<form id="reportform" class="form-inline" method="post">
								<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
								<!-- <td width="100%"> -->
									<div class="form-group">
										<label style="color: #fff !important;">Select Firm</label>&nbsp;&nbsp;
										<select class="form-control" name="firm" id="firm">
											<option value="">Select Firm</option>
											<?php if (!empty($firms)): ?>
												<?php foreach ($firms as $firm): ?>
													<option value="<?php echo $firm->id; ?>"><?php echo $firm->firm_name; ?></option>
												<?php endforeach ?>
											<?php endif ?>
										</select>
									</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<div class="form-group">
										<label style="color: #fff !important;">Select From</label>&nbsp;&nbsp;
										<input type="text" name="from" id="from" class="form-control datepicker" placeholder="Select date from">
									</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<div class="form-group">
										<label style="color: #fff !important;">Select To</label>&nbsp;&nbsp;
										<input type="text" name="to" id="to" class="form-control datepicker" placeholder="Select date to">
									</div>
									<div class="form-group">
										<button type="button" onclick="showReport()" class="btn btn-primary btn-sm">Search</button>
									</div>
								<!-- </td> -->
							</form><br>
						<!-- </table> -->
						<table class="table table-striped table-bordered" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th class="th-sm">Customer Name</th>
									<th class="th-sm">Service Name</th>
									<th class="th-sm">Brand Name</th>
									<th class="th-sm">Product Name</th>
									<th class="th-sm">Product Price</th>
									<th class="th-sm">Quantity</th>
									<th class="th-sm">Total</th>
									<th class="th-sm">Transaction Date</th>
								</tr>
							</thead>
							<tbody id="reportbody">
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="{{ asset('backend/calendar/jquery.js')}}"></script> 
<script src="{{ asset('backend/calendar/jquery-ui.js')}}"></script> 
<link href="{{ asset('backend/calendar/jquery-ui.css')}}" rel="stylesheet">  
<script type="text/javascript">
	$( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
	function showReport() {
		var formdata = $("#reportform").serialize();
		$.ajax({
			url:'{{url("admin/showReport")}}',
			type:'POST',
			data:formdata,
			dataType:'JSON',
			success:function(res) {
				if(res != ""){
					$("#reportbody").html(res.html);
					$("#totaltransaction").html(res.subtotal);
				}else{
					$("#reportbody").html('<tbody id="reportbody"></tbody>');
				}
			}
		});
	}
</script>
@endsection