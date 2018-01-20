<?php

/**
 * Created by PhpStorm.
 * User: Hardik
 */
class Zest extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		require_once APPPATH . 'config/static_constants.php';
		require_once APPPATH . 'config/tablenames_constants.php';
	}
}