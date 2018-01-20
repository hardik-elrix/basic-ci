<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-content">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTables-example" >
							<thead>
							<tr>
								<th class="filterhead">Title</th>
								<th class="filterhead">Category</th>
								<th class="filterhead">Business</th>
								<th class="filterhead">Type</th>
								<th class="filterhead">Top Deal</th>
							</tr>
							<tr>
								<th>Title</th>
								<th>Category</th>
								<th>Business</th>
								<th>Type</th>
								<th>Top Deal</th>
								<th>Image</th>
								<th>Action</th>
							</tr>
							</thead>
							<tbody>
							<?php
							foreach ($data as $key=>$value)
							{
							?>
								<tr id="tr<?=$value['i_id']?>">
									<td><?=$value['v_name']?></td>
									<td><?=$value['category']?></td>
									<td><?=$value['business_name']?></td>
									<td><?=$value['e_type']?></td>
									<td><?=($value['e_top_deal'] == 1) ? 'Yes' : 'No' ?></td>
									<td><img src="<?=$value['v_img']?>" class="img-thumbnail img-responsive img-lg" alt="Image"></td>
									<td>
										<input type="checkbox" id="tg<?=$value['i_id']?>" onchange="change_coupon_status(<?=$value['i_id']?>,'<?=($value['e_status']=="Active") ? 'Inactive': 'Active' ?>')" <?=($value['e_status']=="Active") ? 'checked': '' ?> data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-size="mini" data-on="Active" data-off="Inactive">
										<a href="<?=SITEURLADM?>console/coupons/edit/<?=$value['i_id']?>" class="btn btn-warning btn-xs" ><i class="fa fa-pencil fa-lg"></i></a>
										<button class="btn btn-danger btn-xs" onclick="delete_coupon(<?=$value['i_id']?>);"><i class="fa fa-trash fa-lg"></i></button>
									</td>
								</tr>
							<?php
							}
							?>
							</tbody>
							<tfoot>
							<tr>
								<th>Title</th>
								<th>Category</th>
								<th>Business</th>
								<th>Type</th>
								<th>Top Deal</th>
								<th>Image</th>
								<th>Action</th>
							</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>