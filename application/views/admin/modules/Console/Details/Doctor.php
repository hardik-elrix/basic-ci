<script  type="text/javascript">
    TABLE_DOCTOR = '<?=TABLE_APP_DOCTORS?>';
</script>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="row m-b-lg m-t-lg">
            <div class="col-md-5">

                <div class="profile-image">
                    <img src="<?=ASSETS_PATH.'img/a4.jpg'?>" class="img-circle circle-border m-b-md" alt="profile">
                </div>
                <div class="profile-info">
                    <div class="">
                        <div>
                            <h2 class="no-margins">
                                <?=$data['user_detail'][0]['v_name']?>
                            </h2>
                            <h4><?=$data['doctor_detail'][0]['v_clinic']?></h4>
                            <small>Designation
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <h3>Store Name</h3>
                <h2 class="no-margins">My Store</h2>
                <div id="sparkline1"></div>
            </div>
            <div class="col-md-2">
                <h3>Rating</h3>
                <h2 class="no-margins"><?=($data['doctor_detail'][0]['rating']==null || $data['doctor_detail'][0]['rating']<=0) ? 'N/A' : $data['doctor_detail'][0]['rating'].' / 5'?></h2>
                <div id="sparkline1"></div>
            </div>
            <div class="col-md-2">
                <h3>Income</h3>
                <h2 class="no-margins">9999</h2>
                <div id="sparkline1"></div>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Appointment</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?=$data['count'][0]['cnt_appoint']?></h1>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Blogs</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">0</h1>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Jobs</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?=sizeof($data['jobs'])?></h1>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Products</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?=sizeof($data['products'])?></h1>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Reviews</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?=$data['count'][0]['cnt_review']?></h1>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Clients</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">0</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Jobs</h5>
                    <div class="ibox-tools">
                        <a class="btn btn-xs btn-primary" style="text-decoration: none" href="<?=ADM_CONSOLE.'jobs/view/'.$data['doc_id']?>">SHOW ALL</a>
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="feed-activity-list">
                        <?php
                        foreach ($data['jobs'] as $k=>$v)
                        {
                        ?>
                            <div class="feed-element">
                                <div>
                                    <small class="pull-right"><?=$v['time']?></small>
                                    <strong><?=$v['v_title']?></strong>
                                    <div><?=$v['v_desc']?></div>
                                    <small class="text-muted"><?=$v['dt_updated']?></small>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Appointments</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <table class="table table-hover no-margins">
                                <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>User</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($data['appoint']['data'] as $k=>$v)
                                {
                                ?>
                                    <tr>
                                        <td><small class="label <?=$data['appoint']['color'][$v['e_status']]?>"><?=$v['e_status']?>...</small></td>
                                        <td><i class="fa fa-clock-o"></i> <?=$v['dt_time']?></td>
                                        <td><?=$v['v_name']?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Products</h5>
                            <div class="ibox-tools">
                                <a class="btn btn-xs btn-primary" style="text-decoration: none" href="<?=ADM_CONSOLE.'product/Doctor/'.$data['doc_id']?>">SHOW ALL</a>
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="feed-activity-list">
                                <?php
                                foreach ($data['products'] as $k=>$v)
                                {
                                    ?>
                                    <div class="feed-element">
                                        <div>
                                            <small class="pull-right"><?=$v['v_price']?></small>
                                            <strong><?=$v['v_name']?></strong>
                                            <div><?=$v['v_desc']?></div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
    <div class="modal inmodal" id="details" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <i class="fa fa-stethoscope modal-icon"></i>
                    <h4 class="modal-title">Details</h4>
                </div>
                <div class="modal-body" id="view_data">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>