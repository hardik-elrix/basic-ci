function ajax_post(path, method, data_array, success_call_back, fail_call_back, user_param) {
	$.ajax({
			type: method,
			url: path,
			data: data_array
		})
		.done(function (response) {
			eval(success_call_back + "(response, user_param);");
		})
		.fail(function () {
			eval(fail_call_back + "(user_param);");
		});
}

function ajax_post_short(path, data_array, success_call_back, fail_call_back, user_param) {
	$.post(path, data_array, function (response, status) {
		if ($.trim(status) == "success") {
			eval(success_call_back + "(response, user_param);");
		}
		else {
			eval(fail_call_back + "(user_param);")
		}
	});
}

function ajax_get(path, success_call_back, fail_call_back, user_param) {
	$.get(path, function (response) {
		})
		.done(function (response) {
			eval(success_call_back + "(response, user_param);");
		})
		.fail(function () {
			eval(fail_call_back + "(user_param);");
		})
}

function ajax_get_short(path, success_call_back, fail_call_back, user_param) {
	$.get(path, function (response, status) {
		if ($.trim(status) == "success") {
			eval(success_call_back+'(response, user_param);');
		}
		else {
			eval(fail_call_back + "(user_param);")
		}
	});
}


/*
* Form Lib
 */
function form_submit_animate_start(selector) {
	$(selector).children('.ibox-content').addClass('sk-loading');
}

function form_submit_animate_start(selector) {
	$(selector).children('.ibox-content').removeClass('sk-loading');
}

function form_reset(selector) {
	$(selector)[0].reset();
}

function get_name_values_map(parent_selector, child_selector) {
	var map = {};
	$(parent_selector).find(child_selector).each(function () {
		map[$(this).attr("name")] = $(this).val();
	});
	return map;
}