<?php
	/**
	 * Created by PhpStorm.
	 * User: vaio
	 * Date: 12/22/2017
	 * Time: 5:56 PM
	 */
	
	class Admin extends Template
	{
		public $user_id = '';
		public $user_role = '';
		
		function __construct()
		{
			parent::__construct();
			if ($this->session->userdata("logged_in") == '1')
			{
				if ($this->session->userdata("user_role")!="admin")
				{
					$array = array('logged_in', 'user_id', 'user_type');
					$this->session->unset_userdata($array);
					redirect(SITEURLADM."system/login/?r=1", "location");
				}
				else
				{
					$this->user_id = $this->session->userdata("user_id");
					$this->user_role = $this->session->userdata("user_type");
				}
			}
			else
			{
				redirect(SITEURLADM."system/login/?redir_by=admin-constr", "location");
			}
		}
	}