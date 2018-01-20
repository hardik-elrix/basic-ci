<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC711vkhHG424lDbLWy3ZH0CIgPVDHb8Dc&libraries=places"></script>
<script src="<?=ASSETS_PATH?>js/jquery.geocomplete.min.js"></script>
<script>
    $(function () {
        $("#v_address").geocomplete({
            details: ".ibox-content",
            detailsAttribute: "data-geo"
        });
    });
    $(function () {
        $("#v_landmark").geocomplete();
    });
</script>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5><?=$page_title?></h5>
				</div>
				<div class="ibox-content">
					<div class="sk-spinner sk-spinner-wave">
						<div class="sk-rect1"></div>
						<div class="sk-rect2"></div>
						<div class="sk-rect3"></div>
						<div class="sk-rect4"></div>
						<div class="sk-rect5"></div>
					</div>
					<?php
					echo form_open_multipart($action, ['class'=>'form-horizontal', 'method' => 'POST', 'id'=>'add']);
					foreach ($form['inputs'] as $k=>$v)
					{
						echo Form::input($v);
					}
					?>
					<div class="hr-line-dashed"></div>
					<div class="form-group">
						<div class="col-sm-4 col-sm-offset-2">
							<button class="btn btn-white" onclick="form_reset('#add')">Reset</button>
							<button class="btn btn-primary" id="submit_data" type="submit">Save changes</button>
						</div>
					</div>
					<?=form_close()?>
					<br><br>
				</div>
			</div>
		</div>
	</div>
</div>