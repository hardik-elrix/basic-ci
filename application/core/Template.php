<?php
	(defined('BASEPATH')) or exit('No direct script access allowed');
	
	class Template extends Zest
	{
		public $currentMenuId = 0;
		public $page_title    = "";
		public $meta_keywords = "";
		public $meta_desc     = "";
		public $meta_robots   = "no index,no follow";
		public $current       = ['class', 'method', 'page', 'parent', 'option'];
		
		function __construct()
		{
			parent::__construct();
			$this->load->library(array('session','Form'));
			$this->load->helper(array('cookie', 'form', 'my_helper'));
			$this->current   = ['class' => $this->router->fetch_class(), 'method' => $this->router->fetch_method(), 'page' => $this->page_title, 'parent' => $this->router->fetch_class(), 'option' => ''];
			$this->meta_desc = "meta_desc";
		}
		
		public function view($view, $data = [])
		{
			/*---   Content for <HEAD> Tag   ---*/
			$data ['page_title']    = $this->page_title;
			$data ['meta_keywords'] = $this->meta_keywords;
			$data ['meta_desc']     = $this->meta_desc;
			$data ['meta_robots']   = $this->meta_robots;
			$data ['current']       = $this->current;
			
			/*---   Load View   ---*/
			$this->load->view("admin/includes/part_1_head_tag.php", $data);
			$this->load->view("admin/includes/part_2_sidebar.php", $data);
			$this->load->view("admin/includes/part_3_header.php", $data);
			$this->load->view("admin/modules/" . $view, $data);
			$this->load->view("admin/includes/part_4_footer.php", $data);
			$this->load->view("admin/includes/part_5_end.php", $data);
		}
	}