/*
* Change Coupon Status
**/
function change_user_status(id, status)
{
	var user_param = [];
	user_param['id'] = id;
	user_param['status'] = status;
	var data_array = {};
	data_array['table'] = TABLE_USERS;
	data_array['value'] = status;
	data_array['field'] = 'e_status';
	data_array['where'] = 'i_id='+id;
    var success_call = 'change_user_status_success';
    var fail_call = 'change_user_status_fail';
    ajax_post_short(AJAX_URL+'set_status_custom',data_array,success_call,fail_call,user_param);
}

function change_user_status_success(data, user_param) {
    if ($('#tg' + user_param['id']).prop('checked') == false) {
        $('#tg' + user_param['id']).attr('onchange', "change_user_status(" + user_param['id'] + ",'Active')");
    }
    else {
        $('#tg' + user_param['id']).attr('onchange', "change_user_status(" + user_param['id'] + ",'Inactive')");
    }
}

function change_user_status_fail(user_param) {
	//
}

function delete_user(id)
{
    var user_param = [];
    user_param['id'] = id;
    user_param['status'] = 'Deleted';
    var data_array = {};
    data_array['table'] = TABLE_USERS;
    data_array['value'] = 'Deleted';
    data_array['field'] = 'e_status';
    data_array['where'] = 'i_id='+id;
    var success_call = 'delete_user_success';
    var fail_call = 'delete_users_fail';
    var confirm_dlt = confirm("Are you sure you want to Delete the User? There is no going back.");
    if (confirm_dlt == true) {
        ajax_post_short(AJAX_URL + 'set_status_custom', data_array, success_call, fail_call, user_param);
    }
}

function delete_user_success(data, user_param) {
    $('#tr'+user_param["id"]).remove();
}

function delete_users_fail(user_param) {
    //
}

function view_doctor(id)
{
    $('#doctor_view_data').html('');
    var user_param = [];
    user_param['id'] = id;
    var success_call = 'view_doctor_success';
    var fail_call = 'view_doctor_fail';
    ajax_get_short(AJAX_URL + 'view_doctor/'+id, success_call, fail_call, user_param)
}

function view_doctor_success(data, user_param) {
    $('#doctor_view_data').html(data);
    $('#doctor_detail').modal('show');
}

function view_doctor_fail(user_param) {
    //
}

function view_supplier(id)
{
    $('#sup_view_data').html('');
    var user_param = [];
    user_param['id'] = id;
    var success_call = 'view_supplier_success';
    var fail_call = 'view_supplier_fail';
    ajax_get_short(AJAX_URL + 'view_supplier/'+id, success_call, fail_call, user_param)
}

function view_supplier_success(data, user_param) {
    $('#sup_view_data').html(data);
    $('#sup_detail').modal('show');
}

function view_supplier_fail(user_param) {
    //
}

function change_doctor_status(id)
{
    var user_param = [];
    user_param['id'] = id;
    user_param['status'] = $('#tg'+id).val();
    var data_array = {};
    data_array['table'] = TABLE_DOCTOR;
    data_array['value'] = $('#tg'+id).val();
    data_array['field'] = 'e_status';
    data_array['where'] = 'i_id='+id;
    var success_call = 'change_doctor_status_success';
    var fail_call = 'change_doctor_status_fail';
    ajax_post_short(AJAX_URL+'set_status_custom',data_array,success_call,fail_call,user_param);
}

function change_doctor_status_success(data, user_param) {
    $('#st'+user_param['id']).html(user_param['status']);
}

function change_doctor_status_fail(user_param) {
    //
}

function change_sup_status(id)
{
    var user_param = [];
    user_param['id'] = id;
    user_param['status'] = $('#tg'+id).val();
    var data_array = {};
    data_array['table'] = TABLE_SUPPLIER;
    data_array['value'] = $('#tg'+id).val();
    data_array['field'] = 'e_status';
    data_array['where'] = 'i_id='+id;
    var success_call = 'change_sup_status_success';
    var fail_call = 'change_sup_status_fail';
    ajax_post_short(AJAX_URL+'set_status_custom',data_array,success_call,fail_call,user_param);
}

function change_sup_status_success(data, user_param) {
    $('#st'+user_param['id']).html(user_param['status']);
}

function change_sup_status_fail(user_param) {
    //
}


function delete_doctor(id)
{
    var user_param = [];
    user_param['id'] = id;
    user_param['status'] = 'Deleted';
    var data_array = {};
    data_array['table'] = TABLE_DOCTOR;
    data_array['value'] = 'Deleted';
    data_array['field'] = 'e_status';
    data_array['where'] = 'i_id='+id;
    var success_call = 'delete_doctor_success';
    var fail_call = 'delete_doctor_fail';
    var confirm_dlt = confirm("Are you sure you want to Delete the Doctor? There is no going back.");
    if (confirm_dlt == true) {
        ajax_post_short(AJAX_URL + 'set_status_custom', data_array, success_call, fail_call, user_param);
    }
}

function delete_doctor_success(data, user_param) {
    $('#tr'+user_param["id"]).remove();
}

function delete_doctor_fail(user_param) {
    //
}

function delete_supplier(id)
{
    var user_param = [];
    user_param['id'] = id;
    user_param['status'] = 'Deleted';
    var data_array = {};
    data_array['table'] = TABLE_SUPPLIER;
    data_array['value'] = 'Deleted';
    data_array['field'] = 'e_status';
    data_array['where'] = 'i_id='+id;
    var success_call = 'delete_supplier_success';
    var fail_call = 'delete_supplier_fail';
    var confirm_dlt = confirm("Are you sure you want to Delete the Supplier? There is no going back.");
    if (confirm_dlt == true) {
        ajax_post_short(AJAX_URL + 'set_status_custom', data_array, success_call, fail_call, user_param);
    }
}

function delete_supplier_success(data, user_param) {
    $('#tr'+user_param["id"]).remove();
}

function delete_supplier_fail(user_param) {
    //
}

function delete_job(id)
{
    var user_param = [];
    user_param['id'] = id;
    user_param['status'] = 'Deleted';
    var data_array = {};
    data_array['table'] = TABLE_JOBS;
    data_array['value'] = 'Deleted';
    data_array['field'] = 'e_status';
    data_array['where'] = 'i_id='+id;
    var success_call = 'delete_job_success';
    var fail_call = 'delete_job_fail';
    var confirm_dlt = confirm("Are you sure you want to Delete the Job? There is no going back.");
    if (confirm_dlt == true) {
        ajax_post_short(AJAX_URL + 'set_status_custom', data_array, success_call, fail_call, user_param);
    }
}

function delete_job_success(data, user_param) {
    $('#tr'+user_param["id"]).remove();
}

function delete_job_fail(user_param) {
    //
}

function change_job_status(id)
{
    var user_param = [];
    user_param['id'] = id;
    user_param['status'] = $('#tg'+id).val();
    var data_array = {};
    data_array['table'] = TABLE_JOBS;
    data_array['value'] = $('#tg'+id).val();
    data_array['field'] = 'e_status';
    data_array['where'] = 'i_id='+id;
    var success_call = 'change_job_status_success';
    var fail_call = 'change_job_status_fail';
    ajax_post_short(AJAX_URL+'set_status_custom',data_array,success_call,fail_call,user_param);
}

function change_job_status_success(data, user_param) {
    //
}

function change_job_status_fail(user_param) {
    //
}

function change_doc_product_status(id)
{
    var user_param = [];
    user_param['id'] = id;
    user_param['status'] = $('#tg'+id).val();
    var data_array = {};
    data_array['table'] = TABLE_DOC_PRODUCT;
    data_array['value'] = $('#tg'+id).val();
    data_array['field'] = 'e_status';
    data_array['where'] = 'i_id='+id;
    var success_call = 'change_doc_product_status_success';
    var fail_call = 'change_doc_product_status_fail';
    ajax_post_short(AJAX_URL+'set_status_custom',data_array,success_call,fail_call,user_param);
}

function change_doc_product_status_success(data, user_param) {
    //
}

function change_doc_product_status_fail(user_param) {
    //
}

function delete_doc_product(id)
{
    var user_param = [];
    user_param['id'] = id;
    user_param['status'] = 'Deleted';
    var data_array = {};
    data_array['table'] = TABLE_DOC_PRODUCT;
    data_array['value'] = 'Deleted';
    data_array['field'] = 'e_status';
    data_array['where'] = 'i_id='+id;
    var success_call = 'delete_doc_product_success';
    var fail_call = 'delete_doc_product_fail';
    var confirm_dlt = confirm("Are you sure you want to Delete the Product? There is no going back.");
    if (confirm_dlt == true) {
        ajax_post_short(AJAX_URL + 'set_status_custom', data_array, success_call, fail_call, user_param);
    }
}

function delete_doc_product_success(data, user_param) {
    $('#tr'+user_param["id"]).remove();
}

function delete_doc_product_fail(user_param) {
    //
}

function change_sup_product_status(id)
{
    var user_param = [];
    user_param['id'] = id;
    user_param['status'] = $('#tg'+id).val();
    var data_array = {};
    data_array['table'] = TABLE_SUP_PRODUCT;
    data_array['value'] = $('#tg'+id).val();
    data_array['field'] = 'e_status';
    data_array['where'] = 'i_id='+id;
    var success_call = 'change_sup_product_status_success';
    var fail_call = 'change_sup_product_status_fail';
    ajax_post_short(AJAX_URL+'set_status_custom',data_array,success_call,fail_call,user_param);
}

function change_sup_product_status_success(data, user_param) {
    //
}

function change_sup_product_status_fail(user_param) {
    //
}

function delete_sup_product(id)
{
    var user_param = [];
    user_param['id'] = id;
    user_param['status'] = 'Deleted';
    var data_array = {};
    data_array['table'] = TABLE_SUP_PRODUCT;
    data_array['value'] = 'Deleted';
    data_array['field'] = 'e_status';
    data_array['where'] = 'i_id='+id;
    var success_call = 'delete_sup_product_success';
    var fail_call = 'delete_sup_product_fail';
    var confirm_dlt = confirm("Are you sure you want to Delete the Product? There is no going back.");
    if (confirm_dlt == true) {
        ajax_post_short(AJAX_URL + 'set_status_custom', data_array, success_call, fail_call, user_param);
    }
}

function delete_sup_product_success(data, user_param) {
    $('#tr'+user_param["id"]).remove();
}

function delete_sup_product_fail(user_param) {
    //
}