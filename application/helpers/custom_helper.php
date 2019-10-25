<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// check if user is logged in
if (!function_exists('check_login_user')) {
	function check_login_user() {
		$ci = get_instance();
		if ($ci->session->userdata('logged_in') != TRUE) {
			$ci->session->sess_destroy();
			redirect('admin/login','refresh');
		}
	}
}


if (!function_exists('check_power')) {
	function check_power($type) {
		$ci = get_instance() ;

		$ci->load->model('admin/common_model');
		$option = $ci->common_model->check_power($type);

		return $option;
	}
}

// current date-time function
if (!function_exists('current_datetime')) {
	function current_datetime() {
		$dt = new DateTime('now', new DateTimezone('America/New_York'));
		$date_time = $dt->format('Y-m-d H:i:s');
		return $date_time;
	}
}

// show current date & time with custom format
if (!function_exists('my_date_show_time')) {
	function my_date_show_time($date) {
		if($date != '') {
			$date2 = date_create($date);
			$date_new = date_format($date2, "d M Y h:i A");
			return $date_new;
		} else {
			return '';
		}
	}
}

// show current date with custom format
if (!function_exists('my_date_show')) {
	function my_date_show($date) {
		if($date != '') {
			$date2 = date_create($date);
			$date_new = date_format($date2, "d M Y");
			return $date_new;
		} else {
			return '';
		}
	}
}
