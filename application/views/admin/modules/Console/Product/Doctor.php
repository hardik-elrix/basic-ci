<script  type="text/javascript">
    TABLE_DOC_PRODUCT = '<?=TABLE_DOCTOR_PRODUCTS?>';
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
                                <th class="filterhead">Clinic</th>
                                <th class="filterhead">Status</th>
                                <th class="filterhead">City</th>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <th>Sold By</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Change Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($data['data'] as $key=>$value)
                            {
                                ?>
                                <tr id="tr<?=$value['i_id']?>">
                                    <td id="st<?=$value['i_id']?>"><?=$value['e_status']?></td>
                                    <td><?=$value['v_name']?></td>
                                    <td><?=$value['v_clinic']?></td>
                                    <td><?=$value['v_desc']?></td>
                                    <td><?=$value['v_price']?></td>
                                    <td>
                                        <select id="tg<?=$value['i_id']?>" onchange="change_doc_product_status(<?=$value['i_id']?>,'<?=($value['e_status']=="Active") ? 'Inactive': 'Active' ?>')">
                                            <option <?php if($value['e_status']=='Active') { echo "selected"; } ?> value="Active">Active</option>
                                            <option <?php if($value['e_status']=='Inactive') { echo "selected"; } ?> value="Inactive">Inactive</option>
                                        </select>
                                    <td>
                                        <button class="btn btn-danger btn-xs" onclick="delete_doc_product(<?=$value['i_id']?>);"><i class="fa fa-trash fa-lg"></i></button>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Status</th>
                                <th>Sold By</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Change Status</th>
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
<div>
    <div class="modal inmodal" id="p_detail" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <i class="fa fa-stethoscope modal-icon"></i>
                    <h4 class="modal-title">View Doctor</h4>
                </div>
                <div class="modal-body" id="p_view_data">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>