<?php
/**
 * Created by PhpStorm.
 * User: vaio
 * Date: 12/22/2017
 * Time: 6:18 PM
 */

class System extends Guest
{
	function __construct()
	{
		parent::__construct();
		$this->page_title = "Login";
		$this->info       = $this->myvalues->admin_auth;
		$this->load->model($this->info["model"], "model");
	}
	
	public function index()
	{
		redirect(SITEURLADM . "system/login/?ref=redir_by_system-index", 'location');
	}
	
	public function login()
	{
		$this->load->view('admin/modules/System/Login.php');
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		$this->load->view('admin/modules/System/Login.php');
	}
	
	public function auth()
	{
		$user = $this->input->post("username");
		$hash = md5(base64_decode($this->input->post("password")));
		$id   = $this->model->check_auth($user, $hash);
		if ($id != 0 && $id > 0)
		{
			$this->session->set_userdata("user_id", $id);
			$this->session->set_userdata("logged_in", "1");
			$this->session->set_userdata("user_role", "admin");
			die("1");
		}
		else
		{
			die("0");
		}
	}
}