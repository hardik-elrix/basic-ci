<?php
	/**
	 * Created by PhpStorm.
	 * User: vaio
	 * Date: 12/22/2017
	 * Time: 5:32 PM
	 */
	
	class Guest extends Template
	{
		function __construct()
		{
			parent::__construct();
			$this->user_id   = 0;
			$this->user_role = "Guest";
			if ($this->session->userdata("logged_in") == 1 && $this->session->userdata("user_role")=="admin")
			{
				$this->user_id   = $this->session->userdata("user_id");
				$this->user_role = $this->session->userdata("user_role");
			}
		}
	}