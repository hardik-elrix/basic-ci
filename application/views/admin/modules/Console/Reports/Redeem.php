<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-content">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTables-example" >
							<thead>
							<tr>
								<th class="filterhead">Coupon</th>
								<th class="filterhead">Category</th>
								<th class="filterhead">Business</th>
								<th class="filterhead">Platform</th>
								<th class="filterhead">Year</th>
								<th class="filterhead">Month</th>
								<th class="filterhead">Date</th>
								<th class="filterhead">Type</th>
							</tr>
							<tr>
								<th>Coupon</th>
								<th>Category</th>
								<th>Business</th>
								<th>Platform</th>
								<th>Year</th>
								<th>Month</th>
								<th>Date</th>
								<th>Type</th>
								<th>Time</th>
								<th>IP Address</th>
							</tr>
							</thead>
							<tbody>
							<?php
							foreach ($data as $key=>$value)
							{
								$dt = explode(" ", $value['datetime']);
							?>
								<tr id="tr<?=$value['i_id']?>">
									<td><?=$value['coupon']?></td>
									<td><?=$value['category']?></td>
									<td><?=$value['business']?></td>
									<td><?=$value['platform']?></td>
									<td><?=$value['year']?></td>
									<td><?=$value['month']?></td>
									<td><?=$value['date']?></td>
									<td><?=$value['type']?></td>
									<td><?=$dt[1]?></td>
									<td><?=$value['ip']?></td>
								</tr>
							<?php
							}
							?>
							</tbody>
							<tfoot>
							<tr>
								<th>Coupon</th>
								<th>Category</th>
								<th>Business</th>
								<th>Platform</th>
								<th>Year</th>
								<th>Month</th>
								<th>Date</th>
								<th>Time</th>
								<th>Type</th>
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