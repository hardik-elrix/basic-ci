
<script  type="text/javascript">
    TABLE_USERS = '<?=TABLE_APP_USERS?>';
</script>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-content">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTables-example" >
							<thead>
							<tr>
								<th class="filterhead">Name</th>
								<th class="filterhead">Type</th>
							</tr>
							<tr>
								<th>Name</th>
								<th>Type</th>
								<th>Email</th>
								<th>Phone</th>
								<th>Status</th>
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
									<td><?=$value['e_type']?></td>
									<td><?=$value['v_email']?></td>
									<td><?=$value['v_phone']?></td>
									<td><input type="checkbox" id="tg<?=$value['i_id']?>" onchange="change_user_status(<?=$value['i_id']?>,'<?=($value['e_status']=="Active") ? 'Inactive': 'Active' ?>')" <?=($value['e_status']=="Active") ? 'checked': '' ?> data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-size="mini" data-on="Active" data-off="Inactive"></td>
									<td>
										<a href="<?=SITEURLADM?>console/users/edit/<?=$value['i_id']?>" class="btn btn-warning btn-xs" ><i class="fa fa-pencil fa-lg"></i></a>
										<button class="btn btn-danger btn-xs" onclick="delete_user(<?=$value['i_id']?>);"><i class="fa fa-trash fa-lg"></i></button>
									</td>
								</tr>
							<?php
							}
							?>
							</tbody>
							<tfoot>
							<tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
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