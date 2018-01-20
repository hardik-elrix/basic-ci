<?php
/**
 * Created by PhpStorm.
 * User: vaio
 * Date: 12/29/2017
 * Time: 1:49 PM
 */

class Purchase extends API_Controller
{
	public $info;
	function __construct()
	{
		if (get_parent_class($this) == TRUE)
		{
			parent::__construct();
		}
	}
	
	public function make()
	{
		if(Api::get_request_method()=='POST')
		{
			$this->info = $this->myvalues->api_purchase;
			$this->load->model($this->info["model"], "model");
		}
		else
		{
			Api::print_invalid_request_msg();
		}
	}
}