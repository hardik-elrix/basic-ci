<?php

/**
 * Created by PhpStorm.
 * User: Hardik
 * Date: 16-06-2017
 */
class API_Controller extends Zest
{
	public $info = "";
	public static $access_agents = [
		'2017_app_v1.0',
		'2017_api_v1.0'
	];
	public $developer_secret = [
		'HTTP_X_DEVELOPER_SECRET' => 'ZEST201712_BOB'
	];

	function __construct()
	{
		parent::__construct();
		$this->load->library('api');
		if (DEBUG_INPUT == 1)
		{
			$input_payload = $this->fetch_input_stream();
			if (strlen($input_payload) < 2)
			{
				$input_payload = $_REQUEST;
				$input_payload = Api::convert_object_to_json($input_payload);
			}
			Api::save_payload($input_payload);
		}

		if (SANDBOX_MODE != 1 && !in_array(Api::get_agent(), self::$access_agents))
		{
			$response = [
				'status' => '0',
				'text' => 'API Access Agent not recognized'
			];
			Api::print_json_object($response);
		}
	}

	public function set_json_header()
	{
		header("Content-type: application/json");
	}

	public function print_json_array($array)
	{
		$this->set_json_header();
		$json = json_encode($array);
		echo $json;
		exit;
	}

	public function print_json_object($array)
	{
		$this->set_json_header();
		$object = (object) $array;
		$json = json_encode($object);
		echo $json;
		exit;
	}

	public function set_status_array($array, $status)
	{
		$array['status'] = $status;
		return $array;
	}

	public function convert_json_to_array($json)
	{
		$array = json_decode($json, true);
		return $array;
	}

	public function convert_json_to_object($json)
	{
		$object = json_decode($json);
		return $object;
	}

	public function fetch_input_stream()
	{
		$body = file_get_contents('php://input');
		return $body;
	}

	public function get_json_payload()
	{
		$body = file_get_contents('php://input');
		return $body;
	}

	public function get_input_stream()
	{
		$input = file_get_contents('php://input');
		return $input;
	}

	public function get_request_type()
	{
		$type = $_REQUEST['REQUEST_METHOD'];
		return $type;
	}

	public function compare_digest($source, $target)
	{
		if ($source == $target)
		{
			return true;
		}
		return false;
	}

	public function get_controller()
	{
		return $this->uri->segment(1);
	}

	public function get_class()
	{
		return $this->router->fetch_class();
	}

	public function get_method()
	{
		return $this->uri->segment(2);
	}

	public function get_real_method()
	{
		return $this->router->fetch_method();
	}

	public function create_file($data, $filePath)
	{
		$this->load->helper('file');
		$fileText = <<<TEXT
$data
TEXT;
		if (write_file($filePath, $fileText) === FALSE)
		{
			return false;
		}
		return true;
	}

	public function save_payload($data)
	{
		$class = $this->get_controller();
		$method = $this->get_method();
		$date = date("Ymd_His");
		$microtime = explode(' ', microtime());
		$microtime = reset($microtime);
		$microtime = explode('.', $microtime);
		$micro = end($microtime);
		$filename = $class . '_' . $method . '_' . $date . '_' . $micro . ".json";
		if (!is_dir(DEBUG_DIR . $class))
		{
			mkdir(DEBUG_DIR . $class, 0777, TRUE);
		}
		$filePath = DEBUG_DIR . $class . '/' . $filename;
		$this->create_file($data, $filePath);
	}

}
