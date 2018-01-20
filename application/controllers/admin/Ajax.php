<?php
/**
 * Created by PhpStorm.
 * User: vaio
 * Date: 12/23/2017
 * Time: 6:34 PM
 */

class Ajax extends Admin
{
	public $info;
	function __construct()
	{
		parent::__construct();
		if ( ! $this->input->is_ajax_request())
		{
			$this->output->set_status_header(403);
			exit;
		}
	}

    public function set_status_custom($datas=[])
    {
        $size = sizeof($datas);
        if($size<4)
        {
            if (sizeof($_POST)<4)
            {
                $this->output->set_status_header(403);
                exit;
            }
            foreach ($_POST as $k=>$v)
            {
                if (empty($v) || $v==null || $v=='')
                {
                    $this->output->set_status_header(403);
                    die();
                }
                else
                {
                    $data[$k] = $v;
                }
            }
        }
        else
        {
            foreach ($datas as $k=>$v)
            {
                if (empty($v) || $v==null || $v=='')
                {
                    $this->output->set_status_header(403);
                    die();
                }
                else
                {
                    $data[$k] = $v;
                }
            }
        }
        $this->info = $this->myvalues->admin_users;
        $this->load->model($this->info["model"], "model");
        if ($this->model->set_value_common($data)===true)
        {
            if($size>=4)
            {
                return true;
            }
            die("1");
        }
        else
        {
            if($size>=4)
            {
                return true;
            }
            die("0");
        }
    }

    public function view_doctor($id=0)
    {
        if($id>0)
        {
            $this->info = $this->myvalues->admin_doctor;
            $this->load->model($this->info["model"], "model");
            $result = $this->model->doc_details($id);
            $result = $result[0];
            $print = '<table class="table table-bordered"><thead><tr><th>Fields</th><th>Values</th></tr></thead>';
            $print .= '<tbody><tr><td>Clinic</td><td>'.$result['v_clinic'].'</td></tr>';
            $print .= '<tr><td>Email</td><td>'.$result['v_email'].'</td></tr>';
            $print .= '<tr><td>Phone</td><td>'.$result['v_phone'].'</td></tr>';
            $print .= '<tr><td>Status</td><td>'.$result['e_status'].'</td></tr>';
            $print .= '<tr><td>Lat - Lon</td><td>'.$result['v_lat'].", ".$result['v_lon'].'</td></tr>';
            $print .= '<tr><td>City</td><td>'.$result['v_city'].'</td></tr>';
            $print .= '<tr><td>Address</td><td>'.$result['v_address'].'</td></tr>';
            $print .= '<tr><td>Landmark</td><td>'.$result['v_landmark'].'</td></tr>';
            $print .= '<tr><td>Services</td><td>'.$result['v_services'].'</td></tr>';
            $print .= '<tr><td>Languages Known</td><td>'.$result['v_languages'].'</td></tr>';
            $print .= '</tbody></table>';
            echo $print;
        }
        else
        {
            $this->output->set_status_header(403);
            die();
        }
    }

    public function view_supplier($id=0)
    {
        if($id>0)
        {
            $this->info = $this->myvalues->admin_supplier;
            $this->load->model($this->info["model"], "model");
            $result = Supplier_model::fetch_supplier($id);
            $result = $result[0];
            $print = '<table class="table table-bordered"><thead><tr><th>Fields</th><th>Values</th></tr></thead>';
            $print .= '<tbody><tr><td>Name</td><td>'.$result['v_name'].'</td></tr>';
            $print .= '<tr><td>Email</td><td>'.$result['v_email'].'</td></tr>';
            $print .= '<tr><td>Phone</td><td>'.$result['v_phone'].'</td></tr>';
            $print .= '<tr><td>Status</td><td>'.$result['e_status'].'</td></tr>';
            $print .= '<tr><td>Lat - Lon</td><td>'.$result['v_lat'].", ".$result['v_lon'].'</td></tr>';
            $print .= '<tr><td>City</td><td>'.$result['v_city'].'</td></tr>';
            $print .= '<tr><td>Address</td><td>'.$result['v_address'].'</td></tr>';
            $print .= '<tr><td>Landmark</td><td>'.$result['v_landmark'].'</td></tr>';
            $print .= '</tbody></table>';
            echo $print;
        }
        else
        {
            $this->output->set_status_header(403);
            die();
        }
    }
	
}