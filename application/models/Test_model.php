<?php
/**
 * Created by PhpStorm.
 * User: vaio
 * Date: 12/30/2017
 * Time: 2:49 PM
 */

class Test_model extends My_model
{
	function __construct()
	{
		if (get_parent_class($this) == TRUE)
		{
			parent::__construct();
		}
	}
	
	public function check()
	{
		$data['table'] = TABLE_REDEEM_CURRENT;
		$data['where'] = 'i_d_id=1';
		$res = $this->deleteRecords($data);
		pr($res);
		echo "<pre>";
		var_dump($this->db);
		die("</pre>");
	}
}