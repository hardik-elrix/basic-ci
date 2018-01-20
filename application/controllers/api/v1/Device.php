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
        $this->info = $this->myvalues->api_device;
        $this->load->model($this->info["model"], "model");
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
            $inputs_user = [
                'v_name' => $this->input->post('v_name'),
                'v_email' => $this->input->post('v_email'),
                'v_password' => md5($this->input->post('v_password')),
                'v_phone' => $this->input->post('v_phone'),
                'dt_created' => Common::date(),
                'dt_last_seen' => Common::date(),
                'v_ip' => Common::ip()
            ];
			$user_exist = $this->model->check_user_exist($inputs_user['v_email']);
			if($user_exist===FALSE)
			{
				$response = [
					'status' => '2',
					'message' => 'Something went wrong',
					'data' => []
				];
				Api::print_json_array($response);
			}

			if($user_exist===0)
			{
				$user_id = $this->model->add_user($inputs_user);
                $inputs_device = [
                    'v_uid' => $this->input->post('v_uid'),
                    'v_api_key' => md5($this->input->post('v_uid')),
                    'e_platform' => $this->input->post('e_platform'),
                    'v_fcm' => $this->input->post('v_fcm'),
                    'dt_created' => Common::date(),
                    'dt_last_seen' => Common::date(),
                    'v_ip' => Common::ip()
                ];
                $device_exist = $this->model->check_device_exist($inputs_device['v_uid']);
                if($device_exist===false)
                {
                    $inputs_device['i_u_id'] = $user_id;
                    $d_id = $this->model->add_device($inputs_device);
                    $text = 'New User and New Device Registered';
                }
                else
                {
                    $device_status = $this->model->check_device_status($inputs_device['v_uid']);
                    if($device_status===true)
                    {
                        $inputs_device['i_u_id'] = $user_id;
                        $d_id = $this->model->update_device($inputs_device);
                        $text = 'New User and Old Device Registered';
                    }
                    else
                    {
                        Api::device_inactive();
                    }
                }
			}
			else
			{
                $response = [
                    'status' => '2',
                    'message' => 'User Already Exist',
                    'data' => []
                ];
                Api::print_json_array($response);
			}
			$response = [
				'status' => '1',
				'message' => $text,
				'data' => [
					'id' => (string) $user_id
				]
			];
			Api::print_json_array($response);
		}
		else
		{
			Api::print_invalid_request_msg();
		}
	}

	public function login()
    {
        if (Api::get_request_method()=='POST')
        {
            if(!empty($this->input->post('v_email')) && strlen($this->input->post('v_email') <= 3))
            {
                $exist_user = $this->model->check_user_exist($this->input->post('v_email'));
                $active_user = $this->model->check_user_active($this->input->post('v_email'));
                if($exist_user == true && $active_user == true)
                {
                    $inputs_user = [
                        'v_email' => $this->input->post('v_email'),
                        'v_password' => md5($this->input->post('v_password'))
                    ];
                    $login = $this->model->login($inputs_user);
                    if($login['uid']>0 && $login!=false)
                    {
                        $udid = $this->input->post('v_uid');
                        $device_exist = $this->model->check_device_exist($udid);
                        if($device_exist === true)
                        {
                            $update_device_info = [
                                'i_u_id' => $login['uid'],
                                'v_uid' => $this->input->post('v_uid'),
                                'v_fcm' => $this->input->post('v_fcm'),
                                'e_platform' => $this->input->post('e_platform'),
                                'dt_last_seen' => Common::date(),
                                'v_ip' => Common::ip()
                            ];
                            $update_device = $this->model->update_device($update_device_info);
                            $response = [
                                'status' => '1',
                                'message' => 'Login Successful with existing device.',
                                'data' => $login
                            ];
                            Api::print_json_array($response);
                        }
                        else
                        {
                            $new_device = [
                                'v_uid' => $udid,
                                'i_u_id' => $login['uid'],
                                'v_fcm' => $this->input->post('v_fcm'),
                                'e_platform' => $this->input->post('e_platform'),
                                'dt_created' => Common::date(),
                                'dt_last_seen' => Common::date(),
                                'v_ip' => Common::ip()
                            ];
                            $add_status = $this->model->add_device($new_device);
                            if(!empty($add_status) && $add_status>0)
                            {
                                $response = [
                                    'status' => '1',
                                    'message' => 'Login Successful with NEW device.'
                                ];
                                Api::print_json_array($response);
                            }
                            else
                            {
                                $response = [
                                    'status' => '2',
                                    'message' => "Login Successful but couldn't register NEW device."
                                ];
                                Api::print_json_array($response);
                            }
                        }
                    }
                    else
                    {
                        $response = [
                            'status' => '2',
                            'message' => 'Please check your access credentials.'
                        ];
                        Api::print_json_array($response);
                    }
                }
                else
                {
                    if($exist_user==false)
                    {
                        $text = 'User does NOT exist.';
                    }
                    elseif ($active_user==false)
                    {
                        $text = 'User is NOT Active. Please contact Support.';
                    }
                    $response = [
                        'status' => '2',
                        'message' => $text
                    ];
                    Api::print_json_array($response);
                }
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

	public function update_fcm()
    {
        if(Api::get_request_method()=='POST')
        {
            $data = [
                'v_uid' => $this->input->post('v_uid'),
                'v_fcm' => $this->input->post('v_fcm')
            ];
            $this->model->update_device($data);
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
}