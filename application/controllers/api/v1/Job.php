<?php
/**
 * Created by PhpStorm.
 * User: Hardik
 * Date: 08-01-2018
 * Time: 17:02
 */

class Job extends API_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->info = $this->myvalues->api_job;
        $this->load->model($this->info['model'], "model");
    }

    public function enlist($id=null)
    {
        Api::check_request_method(['GET']);
        if($id==null || $id=='')
        {
            Api::print_success_response($this->model->list_jobs());
        }
        else
        {
            Api::print_success_response($this->model->list_my_jobs($id));
        }
    }

    public function add($id=null)
    {
        Api::check_request_method(['POST']);
        if(Api::int_id($id))
        {
            foreach ($_POST as $k=>$v)
            {
                if(!empty($v))
                {
                    $input[$k] = $v;
                }
            }
            $result = $this->model->add_job($id, $input);
            Api::print_success_response(['id' => $result]);
        }
        else
        {
            Api::print_invalid_input_msg();
        }
    }

    public function edit($id=null)
    {
        Api::check_request_method(['POST']);
        if(Api::int_id($id))
        {
            foreach ($_POST as $k=>$v)
            {
                if(!empty($v))
                {
                    $input[$k] = $v;
                }
            }
            $result = $this->model->edit_job($id, $input);
            Api::print_success_response($result);
        }
        else
        {
            Api::print_invalid_input_msg();
        }
    }

    public function apply($job_id=0, $user_id=0)
    {
        Api::check_request_method(['GET']);
        if($job_id==0 || $user_id==0 || empty($job_id) || empty($user_id) || $user_id==null || $job_id==null || $user_id<0 || $job_id<0)
        {
            Api::print_success_response(false);
        }
        else
        {
            $result = $this->model->apply($job_id, $user_id);
            if ($this->db->error()["code"]=="1062")
            {
                Api::duplicate_entry();
            }
            if(Common::int_id($result))
            {
                Api::print_success_response(['id' => $result]);
            }
            else
            {
                Api::print_success_response(false);
            }
        }
    }

    public function fetch_applications($job_id=0)
    {
        //fetch users list
    }
}