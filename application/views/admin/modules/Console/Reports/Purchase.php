<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-content">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTables-example" >
							<thead>
							<tr>
								<th class="filterhead">Transaction ID</th>
								<th class="filterhead">Refrence No.</th>
								<th class="filterhead">Platform</th>
								<th class="filterhead">Year</th>
								<th class="filterhead">Month</th>
								<th class="filterhead">Date</th>
							</tr>
							<tr>
								<th>Transaction ID</th>
								<th>Refrence No.</th>
								<th>Platform</th>
								<th>Year</th>
								<th>Month</th>
								<th>Date</th>
								<th>Time</th>
								<th>Amount</th>
								<th>ID</th>
								<th>Client Time</th>
								<th>IP Address</th>
							</tr>
							</thead>
							<tbody>
							<?php
							foreach ($data as $key=>$value)
							{
								$dt = explode(" ", $value['server_datetime']);
								?>
								<tr id="tr<?=$value['i_id']?>">
									<td><?=$value['v_transaction_id']?></td>
									<td><?=$value['v_reference']?></td>
									<td><?=$value['platform']?></td>
									<td><?=$value['year']?></td>
									<td><?=$value['month']?></td>
									<td><?=$value['date']?></td>
									<td><?=$value['client_datetime']?></td>
									<td><?=$value['v_amount']?></td>
									<td><?=$value['i_id']?></td>
									<td><?=$dt[1]?></td>
									<td><?=$value['ip']?></td>
								</tr>
								<?php
							}
							?>
							</tbody>
							<tfoot>
							<tr>
								<th>Transaction ID</th>
								<th>Refrence No.</th>
								<th>Platform</th>
								<th>Year</th>
								<th>Month</th>
								<th>Date</th>
								<th>Time</th>
								<th>Amount</th>
								<th>ID</th>
								<th>Client Time</th>
								<th>IP Address</th>
							</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>