<?php
/**
 * Created by PhpStorm.
 * User: vaio
 * Date: 12/28/2017
 * Time: 5:05 PM
 */

class Files
{
	public static $CI;
	function __construct()
	{
		if (get_parent_class($this) == TRUE)
		{
			parent::__construct();
		}
		self::$CI =& get_instance();
	}
	
	public static function upload($conf, $post_name, $new_name)
	{
		self::$CI->load->library('upload', $conf);
		
		if ( ! self::$CI->upload->do_upload($post_name))
		{
			$error = array('error' => self::$CI->upload->display_errors());
			$status = [
				'flag' => FALSE,
				'error' => $error
			];
			return $status;
		}
		else
		{
			$data = array('upload_data' => self::$CI->upload->data());
			self::$CI->load->view('upload_success', $data);
		}
	}
}