<?php

class Control extends API_Controller
{
	function __construct()
	{
		if (get_parent_class($this) == TRUE)
		{
			parent::__construct();
		}
        $this->info = $this->myvalues->api_device;
        $this->load->model($this->info["model"], "model");
	}
	
	public function index()
	{
		//
	}

	public function ping()
	{
		if(Api::get_request_method()=='GET' || Api::get_request_method()=='GET')
		{
		    $response = [
		        'status' => '1',
                'message' => 'OK',
                'data' => []
            ];
		    Api::print_json_array($response);
		}
		else
		{
			Api::print_invalid_request_msg();
		}
	}

	public function status($id=null)
    {
        if(Api::get_request_method()=='GET')
        {
            if(Api::int_id($id))
            {
                $logout = $this->model->check_status($id);
                $response = [
                    'status' => '1',
                    'message' => 'OK',
                    'data' => [
                        'logout' => ($logout==true) ? '0' : '1'
                    ]
                ];
                Api::print_json_array($response);
            }
            else
            {
                Api::print_invalid_input_msg();
            }
        }
        else
        {
            Api::print_invalid_request_msg();
        }
    }
	
}