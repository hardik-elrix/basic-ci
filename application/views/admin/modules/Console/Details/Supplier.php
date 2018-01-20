<script  type="text/javascript">
    TABLE_DOCTOR = '<?=TABLE_APP_DOCTORS?>';
</script>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="row m-b-lg m-t-lg">
            <div class="col-md-6">

                <div class="profile-image">
                    <img src="<?=ASSETS_PATH.'img/a4.jpg'?>" class="img-circle circle-border m-b-md" alt="profile">
                </div>
                <div class="profile-info">
                    <div class="">
                        <div>
                            <h2 class="no-margins">
                                <?=$data['user_detail'][0]['v_name']?>
                            </h2>
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
            <div class="col-md-3">
                <h3>Income</h3>
                <h2 class="no-margins">9999</h2>
                <div id="sparkline1"></div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Products</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?=$data['count'][0]['cnt_product']?></h1>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Reviews</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?=$data['count'][0]['cnt_review']?></h1>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
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
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Products</h5>
                    <div class="ibox-tools">
                        <a class="btn btn-xs btn-primary" style="text-decoration: none" href="<?=ADM_CONSOLE.'product/Supplier/'.$data['sup_id']?>">SHOW ALL</a>
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
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Orders</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="feed-activity-list">
                        <div class="feed-element">
                            <div>
                                <small class="pull-right">#ID 123</small>
                                <strong>Client Name</strong>
                                <div>Order Details</div>
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