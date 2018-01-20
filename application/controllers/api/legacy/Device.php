<?php
/**
 * Created by PhpStorm.
 * User: vaio
 * Date: 12/27/2017
 * Time: 2:34 PM
 */

class Device extends API_Controller
{
	function __construct()
	{
		if (get_parent_class($this) == TRUE)
		{
			parent::__construct();
		}
	}
	
	public function index()
	{
		$list = [
			'POST /register' => [
				'Request' => [
					'Headers' => [
						'HTTP_X_API_SECRET' => 'API_KEY'
					],
					'Parameters' => [
						'v_device_uid',
						'e_platform'
					]
				],
				'Response' => [
					'Headers' => [
						'Content-type:' => 'application/json'
					],
					'Body' => [
						'status',
						'text',
						'message',
						'data' => [
							'id',
							'config' => [
								'redeem_radius' => '10'
							]
						]
					]
				]
			]
		];
		Api::print_services_list($list);
	}
	
	public function register()
	{
		if(Api::get_request_method()=='POST')
		{
			$this->info = $this->myvalues->api_device;
			$this->load->model($this->info["model"], "model");
			$uid = $this->input->post('v_device_uid');
			$platform = $this->input->post('e_platform');
			$id = $this->model->check_exist($uid);
			if($id===FALSE)
			{
				$text = 'Something went wrong, please try again';
				$response = [
					'status' => '413',
					'message' => 'OK',
					'text' => $text,
					'data' => []
				];
				Api::print_json_array($response);
			}
			//pr($id);die;
			if($id===0)
			{
				unset($id);
				$id = $this->model->add_device($uid, $platform);
				$text = 'New Device Registered';
			}
			else
			{
				$text = 'Already Registered';
				$this->model->set_last_login($id);
			}
			$response = [
				'status' => '200',
				'message' => 'OK',
				'text' => $text,
				'data' => [
					'id' => (string) $id,
					'config' => [
						'redeem_radius' => '10'
					]
				]
			];
			Api::print_json_array($response);
		}
		else
		{
			Api::print_invalid_request_msg();
		}
	}
}