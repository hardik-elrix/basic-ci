<?php
/**
 * Created by PhpStorm.
 * User: vaio
 * Date: 12/28/2017
 * Time: 4:38 PM
 */

class Submit extends Admin
{
	public $info;
	function __construct()
	{
		if (get_parent_class($this) == TRUE)
		{
			parent::__construct();
		}
		$this->current['action'] = NULL;
		$this->page_title        = "Submit";
	}
	
	public function index()
	{
		//
	}

	public function add_user()
    {
        $this->info              = $this->myvalues->admin_users;
        $this->load->model($this->info["model"], "model");
        if(isset($_POST))
        {
            $inputs_user = [
                'v_name' => $this->input->post('v_name'),
                'v_email' => $this->input->post('v_email'),
                'v_password' => md5($this->input->post('v_password')),
                'v_phone' => $this->input->post('v_phone'),
                'dt_created' => Common::date(),
                'dt_last_seen' => Common::date(),
                'v_ip' => Common::ip()
            ];
            $result = $this->model->add_user($inputs_user);
            if($result>0)
            {
                redirect(ADM_CONSOLE.'users/view/?status=ok&track=0');
            }
            else
            {
                redirect(ADM_CONSOLE.'users/view/?status=fail&track=1');
            }
        }
        else
        {
            redirect(ADM_CONSOLE.'users/view/?status=fail&track=2');
        }
    }

    public function edit_user($id)
    {
        $this->info              = $this->myvalues->admin_users;
        $this->load->model($this->info["model"], "model");
        foreach ($_POST as $k=>$v)
        {
            if(!empty($v))
            {
                $input[$k] = $v;
            }
        }
        $result = $this->model->edit_user($id, $input);
        if($result===true)
        {
            redirect(ADM_CONSOLE.'users/view/?status=ok&track=0');
        }
        else
        {
            redirect(ADM_CONSOLE.'users/view/?status=fail&track=1');
        }
    }

    public function add_doctor()
    {
        $this->info              = $this->myvalues->admin_doctor;
        $this->load->model($this->info["model"], "model");
        $inputs_user = [
            'v_password' => md5($this->input->post('v_password')),
            'v_phone' => $this->input->post('v_phone1'),
            'dt_created' => Common::date(),
            'dt_last_seen' => Common::date(),
            'v_ip' => Common::ip()
        ];
        $inputs_user['v_name'] = $_POST['v_name'];
        $inputs_user['v_email'] = $_POST['v_email1'];
        $result = $this->model->add_user($inputs_user);
        if($result>0)
        {
            $inputs_doc = [
                'i_u_id' => $result,
                'v_clinic' => $_POST['v_clinic'],
                'v_email' => $_POST['v_email2'],
                'v_phone' => $_POST['v_phone2'],
                'e_status' => 'Active',
                'v_lat' => $_POST['v_lat'],
                'v_lon'=> $_POST['v_lon'],
                'v_city' => $_POST['v_city'],
                'v_address' => $_POST['v_address'],
                'v_landmark' => $_POST['v_landmark'],
                'v_services' => $_POST['v_services'],
                'v_languages' => $_POST['v_languages']
            ];
            $result2 = $this->model->add_doctor($inputs_doc);
            if($result2>0)
            {
                redirect(ADM_CONSOLE.'doctors/view/?status=ok&track=0');
            }
            else
            {
                redirect(ADM_CONSOLE.'doctors/view/?status=fail&track=1');
            }
        }
        else
        {
            redirect(ADM_CONSOLE.'doctors/view/?status=fail&track=2');
        }

        if($result2>0)
        {
            redirect(ADM_CONSOLE.'doctors/view/?status=ok&track=0');
        }
        else
        {
            redirect(ADM_CONSOLE.'doctors/view/?status=fail&track=1');
        }
    }

    public function add_supplier()
    {
        $this->info              = $this->myvalues->admin_supplier;
        $this->load->model($this->info["model"], "model");
        $inputs_user = [
            'v_password' => md5($this->input->post('v_password')),
            'v_phone' => $this->input->post('v_phone1'),
            'dt_created' => Common::date(),
            'dt_last_seen' => Common::date(),
            'v_ip' => Common::ip()
        ];
        $inputs_user['v_name'] = $_POST['v_name1'];
        $inputs_user['v_email'] = $_POST['v_email1'];
        $result = Supplier_model::add_user($inputs_user);
        if($result>0)
        {
            $inputs_sup = [
                'i_u_id' => $result,
                'v_name' => $_POST['v_name'],
                'v_email' => $_POST['v_email2'],
                'v_phone' => $_POST['v_phone2'],
                'e_status' => 'Active',
                'v_lat' => $_POST['v_lat'],
                'v_lon'=> $_POST['v_lon'],
                'v_city' => $_POST['v_city'],
                'v_address' => $_POST['v_address'],
                'v_landmark' => $_POST['v_landmark']
            ];
            $result2 = Supplier_model::add_supplier($inputs_sup);
            if($result2>0)
            {
                redirect(ADM_CONSOLE.'supplier/view/?status=ok&track=0');
            }
            else
            {
                redirect(ADM_CONSOLE.'supplier/view/?status=fail&track=1');
            }
        }
        else
        {
            redirect(ADM_CONSOLE.'supplier/view/?status=fail&track=2');
        }

        if($result2>0)
        {
            redirect(ADM_CONSOLE.'supplier/view/?status=ok&track=0');
        }
        else
        {
            redirect(ADM_CONSOLE.'supplier/view/?status=fail&track=1');
        }
    }

    public function edit_doctor($id)
    {
        $this->info              = $this->myvalues->admin_doctor;
        $this->load->model($this->info["model"], "model");
        foreach ($_POST as $k=>$v)
        {
            if(!empty($v))
            {
                $input[$k] = $v;
            }
        }
        $result = $this->model->edit_doctor($id, $input);
        if($result==true)
        {
            redirect(ADM_CONSOLE.'doctors/view/?status=ok&track=0');
        }
        else
        {
            redirect(ADM_CONSOLE.'doctors/view/?status=fail&track=1');
        }
    }

    public function edit_supplier($id)
    {
        $this->info              = $this->myvalues->admin_supplier;
        $this->load->model($this->info["model"], "model");
        foreach ($_POST as $k=>$v)
        {
            if(!empty($v))
            {
                $input[$k] = $v;
            }
        }
        $result = Supplier_model::edit_supplier($id, $input);
        if($result==true)
        {
            redirect(ADM_CONSOLE.'supplier/view/?status=ok&track=0');
        }
        else
        {
            redirect(ADM_CONSOLE.'supplier/view/?status=fail&track=1');
        }
    }
	
	public function add_coupon()
	{
		$this->info              = $this->myvalues->submit_admin;
		$this->load->model($this->info["model"], "model");
		if(!empty($_FILES['v_img']['name']))
		{
			$config['upload_path'] = './assets/uploads/coupons_img';
			$config['allowed_types'] = 'jpg|png|gif|bmp|jpeg';
			$config['file_name'] = 'coupon_'.md5(microtime());
			$this->load->library('upload',$config);
			if(!$this->upload->do_upload('v_img'))
			{
				$error = array('error' => $this->upload->display_errors());
				pr($error);
			}
			else
			{
				if($this->upload->data('file_size')>256)
				{
					$quality = 100 / ($this->upload->data('file_size')/256);
					$config['image_library'] = 'gd2';
					$config['quality'] = (int) $quality;
					$config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = TRUE;
					$config['width']         = $this->upload->data('image_width')-1;
					$config['height']       = $this->upload->data('image_height')-1;
					$config['source_image'] = './assets/uploads/coupons_img/'.$config['file_name'].$this->upload->data('file_ext');
					$config['new_image'] = './assets/uploads/coupons_img/'.$config['file_name'].$this->upload->data('file_ext');
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
				}
			}
		}
		$datas = [
			'v_img' => $this->upload->data('orig_name'),
			'v_ip' => $_SERVER['REMOTE_ADDR'],
			'dt_created' => date("Y-m-d H:i:s"),
			'dt_updated' => date("Y-m-d H:i:s")
		];
		$data = array_merge($this->input->post(), $datas);
		$result = $this->model->add_coupon($data);
		if($result > 0)
		{
			redirect('admin/console/coupons/');
		}
	}
	
	public function edit_coupon($id=NULL)
	{
		if($id!=NULL && $id>0)
		{
			$this->info              = $this->myvalues->submit_admin;
			$this->load->model($this->info["model"], "model");
			if($this->model->exists_coupon($id)==TRUE)
			{
				$data = $this->input->post();
				if(!empty($_FILES['v_img']['name']))
				{
					$config['upload_path'] = './assets/uploads/coupons_img';
					$config['allowed_types'] = 'jpg|png|gif|bmp|jpeg';
					$config['file_name'] = 'coupon_'.md5(microtime());
					$this->load->library('upload',$config);
					if(!$this->upload->do_upload('v_img'))
					{
						$error = array('error' => $this->upload->display_errors());
						pr($error);
					}
					else
					{
						if($this->upload->data('file_size')>256)
						{
							$quality = 100 / ($this->upload->data('file_size')/256);
							$config['image_library'] = 'gd2';
							$config['quality'] = (int) $quality;
							$config['create_thumb'] = FALSE;
							$config['maintain_ratio'] = TRUE;
							$config['width']         = $this->upload->data('image_width')-1;
							$config['height']       = $this->upload->data('image_height')-1;
							$config['source_image'] = './assets/uploads/coupons_img/'.$config['file_name'].$this->upload->data('file_ext');
							$config['new_image'] = './assets/uploads/coupons_img/'.$config['file_name'].$this->upload->data('file_ext');
							$this->load->library('image_lib', $config);
							$this->image_lib->resize();
						}
						$datas = [
							'v_img' => $this->upload->data('orig_name'),
							'v_ip' => $_SERVER['REMOTE_ADDR'],
							'dt_updated' => date("Y-m-d H:i:s")
						];
					}
				}
				else
				{
					$datas = [
						'v_ip' => $_SERVER['REMOTE_ADDR'],
						'dt_updated' => date("Y-m-d H:i:s")
					];
				}
				
				$data = array_merge($this->input->post(), $datas);
				@unlink('./assets/uploads/coupons_img/'.$data['current_img']);
				unset($data['current_img']);
				$result = $this->model->edit_coupon($id, $data);
				if(!empty($result) && $result==TRUE)
				{
					redirect('admin/console/coupons/?ref=edit&status=1');
				}
				else
				{
					redirect('admin/console/coupons/?ref=edit&status=0');
				}
			}
			else
			{
				redirect('admin/console/coupons/?ref=no_edit');
			}
		}
	}
	
	public function add_business()
	{
		$this->info              = $this->myvalues->submit_admin_business;
		$this->load->model($this->info["model"], "model");
		$datas = [
			'v_ip' => $_SERVER['REMOTE_ADDR'],
			'dt_created' => date("Y-m-d H:i:s"),
			'dt_updated' => date("Y-m-d H:i:s")
		];
		$imgs[1] = $imgs[2] = $imgs[3] = $imgs[4] = $imgs[5] = NULL;
		for($i=1; $i<=5; $i++)
		{
			$file = 'v_img'.$i;
			if(!empty($_FILES[$file]['name']))
			{
				$config['upload_path'] = './assets/uploads/business_img';
				$config['allowed_types'] = 'jpg|png|gif|bmp|jpeg';
				$config['file_name'] = 'business_'.md5(microtime());
				$this->load->library('upload',$config);
				if(!$this->upload->do_upload($file))
				{
					$error = array('error' => $this->upload->display_errors());
					pr($error);
				}
				else
				{
					if($this->upload->data('file_size')>256)
					{
						$quality = 100 / ($this->upload->data('file_size')/256);
						$config['image_library'] = 'gd2';
						$config['quality'] = (int) $quality;
						$config['create_thumb'] = FALSE;
						$config['maintain_ratio'] = TRUE;
						$config['width']         = $this->upload->data('image_width')-1;
						$config['height']       = $this->upload->data('image_height')-1;
						$config['source_image'] = './assets/uploads/business_img/'.$config['file_name'].$this->upload->data('file_ext');
						$config['new_image'] = './assets/uploads/business_img/'.$config['file_name'].$this->upload->data('file_ext');
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();
					}
				}
				$datas[$file] = $config['file_name'].$this->upload->data('file_ext');
			}
		}
		
		$data = array_merge($this->input->post(), $datas);
		$result = $this->model->add_business($data);
		if($result > 0)
		{
			redirect('admin/console/business/?ref=add&status=1');
		}
	}
	
	public function edit_business($id=NULL)
	{
		if($id!=NULL && $id>0)
		{
			$this->info              = $this->myvalues->submit_admin_business;
			$this->load->model($this->info["model"], "model");
			if($this->model->exists_business($id)==TRUE)
			{
				$datas = [
					'v_ip' => $_SERVER['REMOTE_ADDR'],
					'dt_updated' => date("Y-m-d H:i:s")
				];
				$imgs[1] = $imgs[2] = $imgs[3] = $imgs[4] = $imgs[5] = NULL;
				for($i=1; $i<=5; $i++)
				{
					$file = 'v_img'.$i;
					if(!empty($_FILES[$file]['name']))
					{
						$config['upload_path'] = './assets/uploads/business_img';
						$config['allowed_types'] = 'jpg|png|gif|bmp|jpeg';
						$config['file_name'] = 'business_'.md5(microtime());
						$this->load->library('upload',$config);
						if(!$this->upload->do_upload($file))
						{
							$error = array('error' => $this->upload->display_errors());
							pr($error);
						}
						else
						{
							if($this->upload->data('file_size')>256)
							{
								$quality = 100 / ($this->upload->data('file_size')/256);
								$config['image_library'] = 'gd2';
								$config['quality'] = (int) $quality;
								$config['create_thumb'] = FALSE;
								$config['maintain_ratio'] = TRUE;
								$config['width']         = $this->upload->data('image_width')-1;
								$config['height']       = $this->upload->data('image_height')-1;
								$config['source_image'] = './assets/uploads/business_img/'.$config['file_name'].$this->upload->data('file_ext');
								$config['new_image'] = './assets/uploads/business_img/'.$config['file_name'].$this->upload->data('file_ext');
								$this->load->library('image_lib', $config);
								$this->image_lib->resize();
							}
						}
						$datas[$file] = $config['file_name'].$this->upload->data('file_ext');
					}
				}
				
				$data = array_merge($this->input->post(), $datas);
				unset($data['current_img1'],$data['current_img2'],$data['current_img3'],$data['current_img4'],$data['current_img5']);
				$result = $this->model->edit_business($id, $data);
				if(!empty($result) && $result==TRUE)
				{
					redirect('admin/console/business/?ref=edit&status=1');
				}
				else
				{
					redirect('admin/console/business/?ref=edit&status=0');
				}
			}
			else
			{
				redirect('admin/console/business/?ref=no_edit');
			}
		}
	}
}