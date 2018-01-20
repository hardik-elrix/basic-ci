<?php
	/**
	 * Created by PhpStorm.
	 * User: vaio
	 * Date: 12/22/2017
	 * Time: 6:55 PM
	 */
	
	class Auth_model extends My_model
	{
		public function __construct()
		{
			parent::__construct();
		}
		
		public function check_auth($user, $hash)
		{
			$data['select'] = [
				'i_id',
				'e_user_role',
				'COUNT(i_id) AS cnt'
			];
			$data['where'] = [
				'v_email=' => $user,
				'v_password=' => $hash
			];
			$data['table'] = TABLE_USERS;
			$result = $this->selectRecords($data, TRUE);
			if($result[0]['e_user_role']=='admin' && $result[0]['cnt']=='1')
			{
				return $result[0]['i_id'];
			}
			else
			{
				return 0;
			}
		}
	}