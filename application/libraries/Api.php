<?php

	/**
	 * Created by PhpStorm.
	 * User: Hardik
	 * Date: 17-06-2017
	 * Time: 19:45
	 */
	class Api
	{

		public static $CI;

		public function __construct()
		{
			self::$CI = & get_instance();
		}

		public static function get_agent()
		{
			if (isset($_SERVER['HTTP_ACCESS_AGENT']))
			{
				$agent = $_SERVER['HTTP_ACCESS_AGENT'];
			}
			else
			{
				$agent = 'unknown';
			}
			return $agent;
		}
		
		public static function get_custom_header($header)
		{
			if(isset($_SERVER[$header]))
			{
				return $_SERVER[$header];
			}
			else
			{
				return FALSE;
			}
		}

		public static function set_json_header()
		{
			header("Content-type: application/json");
		}

		public static function print_json_array($array)
		{
			$json = json_encode($array);
			self::set_json_header();
			echo $json;
			exit;
		}

		public static function print_json_object($array)
		{
			$object = (object) $array;
			$json = json_encode($object);
			self::set_json_header();
			echo $json;
			exit;
		}

		public static function set_status_array($array, $status)
		{
			$array['status'] = $status;
			return $array;
		}

		public static function convert_array_to_json($array)
		{
			$result = json_encode($array);
			return $result;
		}

		public static function convert_object_to_json($object)
		{
			$object = (object) $object;
			$result = json_encode($object);
			return $result;
		}

		public static function convert_json_to_array($json)
		{
			$array = json_decode($json, true);
			return $array;
		}

		public static function convert_json_to_object($json)
		{
			$object = json_decode($json);
			return $object;
		}

		public static function fetch_input_stream()
		{
			$body = file_get_contents('php://input');
			return $body;
		}

		public static function get_json_payload()
		{
			$body = file_get_contents('php://input');
			return $body;
		}

		public static function get_input_stream()
		{
			$input = file_get_contents('php://input');
			return $input;
		}

		public static function get_request_method()
		{
			return $_SERVER['REQUEST_METHOD'];
		}

		public static function compare_digest($source, $target)
		{
			if ($source == $target)
			{
				return true;
			}
			return false;
		}

		public static function get_controller()
		{
			return self::$CI->uri->segment(1);
		}

		public static function get_class()
		{
			return self::$CI->router->fetch_class();
		}

		public static function get_method()
		{
			return self::$CI->uri->segment(2);
		}

		public static function get_real_method()
		{
			return self::$CI->router->fetch_method();
		}

		public static function create_file($data, $filePath)
		{
			self::$CI->load->helper('file');
			$fileText = <<<TEXT
$data
TEXT;
			if (write_file($filePath, $fileText) === FALSE)
			{
				return false;
			}
			return true;
		}

		public static function print_invalid_request_msg()
		{
			$response = [
				'status' => "2",
                'message' => 'Invalid Request Method'
			];
			self::print_json_array($response);
		}
		
		public static function print_invalid_input_msg()
		{
			$response = [
                'status' => "3",
                'message' => 'Invalid Input Provided'
			];
			self::print_json_array($response);
		}

		public static function print_ArrayObject($array)
		{
			$ArrayObject = new ArrayObject($array);
			self::print_json_object($ArrayObject);
		}

		public static function send_fcm_notification($tokens, $message)
		{
			$fields = array(
				'registration_ids' => $tokens,
				'data' => $message,
			);
			$headers = array(
				'Authorization: key=' . FCM_API_KEY,
				'Content-Type: application/json'
			);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
			$result = curl_exec($ch);
			if ($result === false)
			{
				return false;
			}
			curl_close($ch);
			return true;
		}

		public static function save_payload($data)
		{
			(strlen(self::$CI->get_controller()) < 1) ? $class = self::$CI->router->fetch_class() : $class = self::$CI->get_controller();
			$method = self::$CI->get_method();
			if ($method == "")
			{
				$method = 'index';
			}
			$date = date("Ymd_His");
			$microtime = explode(' ', microtime());
			$microtime = reset($microtime);
			$microtime = explode('.', $microtime);
			$micro = end($microtime);
			$reqest = self::get_request_method();
			$url = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
			$meta = <<<TEXT
Class/Method => $class/$method
REQUEST_PATH => $url
Date_Time => $date
Request_Method => $reqest
Body =>

$data
TEXT;
			$filename = $date . '_' . $class . '_' . $method . '_' . $micro . ".json";
			if (!is_dir(DEBUG_DIR . $class))
			{
				mkdir(DEBUG_DIR . $class, 0777, TRUE);
			}
			$filePath = DEBUG_DIR . $class . '/' . $filename;
			self::$CI->create_file($meta, $filePath);
		}

		public static function save_output($data)
		{
			$class = self::$CI->get_controller();
			$method = self::$CI->get_method();
			$date = date("Ymd_His");
			$filename = $class . '_' . $method . '_' . $date . "_.json";
			if (!is_dir(DEBUG_DIR . $class))
			{
				mkdir(DEBUG_DIR . $class, 0777, TRUE);
			}
			$filePath = DEBUG_DIR . $class . '/' . $filename;
			self::$CI->create_file($data, $filePath);
		}

		public static function print_empty_data_msg()
        {
            $response = [
                'status' => '200',
                'message' => 'Success',
                'text' => "Empty Dataset.",
                'data' => ""
            ];
            self::print_json_array($response);
        }
        
        public static function print_services_list($list)
        {
        	if(!self::get_custom_header('HTTP_X_DEVELOPER_SECRET') == self::$CI->developer_secret['HTTP_X_DEVELOPER_SECRET'] )
			{
				$array = [
					'status' => '1',
					'message' => 'OK',
					'text' => "List of APIs under this Interface gateway.",
					'data' => $list
				];
				self::print_json_array($array);
			}
            else
			{
				$array = [
					'status' => '2',
					'message' => 'NOT Authorized',
					'text' => "You are not authorized to access the information."
				];
				self::print_json_array($array);
			}
        }

        public static function int_id($id)
        {
            if($id!=null && !empty($id) && $id==($id/1) && $id>0)
            {
                return true;
            }
            else
            {
                self::print_invalid_input_msg();
            }
        }

        public static function not_empty($val)
        {
            if($val!=null && !empty($val) && $val!='')
            {
                return true;
            }
            else
            {
                self::print_invalid_input_msg();
            }
        }

        public static function in_array($needle, $haystack)
        {
            if(in_array($needle, $haystack))
            {
                return true;
            }
            else
            {
                self::print_invalid_input_msg();
            }
        }

        public static function device_blocked()
        {
            $array = [
                'status' => '2',
                'message' => "This device is BLOCKED. Please contact Support"
            ];
            self::print_json_array($array);
        }

        public static function device_inactive()
        {
            $array = [
                'status' => '2',
                'message' => "This device is NOT ACTIVE. Please contact Support"
            ];
            self::print_json_array($array);
        }

        public static function user_blocked()
        {
            $array = [
                'status' => '2',
                'message' => "This user is BLOCKED. Please contact Support"
            ];
            self::print_json_array($array);
        }

        public static function user_inactive()
        {
            $array = [
                'status' => '2',
                'message' => "This user is NOT ACTIVE. Please contact Support"
            ];
            self::print_json_array($array);
        }

        public static function check_request_method($methods)
        {
            if(!in_array(self::get_request_method(), $methods))
            {
                self::print_invalid_request_msg();
                exit();
            }
        }

        public static function print_success_response($data, $message='OK')
        {
            if($data===false)
            {
                if($message=='OK')
                {
                    $response = [
                        'status' => '0',
                        'message' => 'Something went wrong.'
                    ];
                }
                else
                {
                    $response = [
                        'status' => '0',
                        'message' => $message
                    ];
                }
                self::print_json_array($response);
            }
            elseif($data===true)
            {
                $response = [
                    'status' => '1',
                    'message' => 'OK'
                ];
                self::print_json_array($response);
            }
            else
            {
                $response = [
                    'status' => '1',
                    'message' => $message,
                    'data' => $data
                ];
                self::print_json_array($response);
            }
        }

        public static function duplicate_entry()
        {
            $response = [
                'status' => '0',
                'message' => "Similar record already exists. Duplicate Record can't be accepted."
            ];
            self::print_json_array($response);
        }

	}