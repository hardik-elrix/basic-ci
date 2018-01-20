<?php
/**
 * Created by PhpStorm.
 * User: vaio
 * Date: 12/29/2017
 * Time: 1:48 PM
 */

class Redeem extends API_Controller
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
			'GET /coupon' => [
				'Request' => [
					'Headers' => [
						'HTTP_X_API_SECRET' => '--KEY--'
					],
					'Parameters' => [
						'/user_id',
						'/coupon_id'
					]
				],
				'Response' => [
					'Headers' => [
						'Content-type' => 'application/json'
					],
					'Body' => [
						'status' => '200',
						'text' => 'Coupon Redeemed Successfully',
						'message' => 'Redeemed Successfully',
						'data' => [
							'redeem_id' => '1'
						]
					]
				]
			],
			'GET /list_coupons/:category_id'
		];
		Api::print_services_list($list);
	}
	
	public function coupon($uid, $cid, $lat='00.00', $lon='00.00')
	{
		if(Api::get_request_method()=='GET')
		{
			$this->info = $this->myvalues->api_redeem;
			$this->load->model($this->info["model"], "model");
			$result = $this->model->redeem_coupon($uid, $cid, $lat, $lon);
			if($result>0 && !empty($result))
			{
				$response = [
					'status' => '200',
					'text' => 'Redeem Successful',
					'message' => 'Redeem Successful',
					'data' => [
						'i_id' => $result
					]
				];
				Api::print_json_array($response);
			}
			else
			{
				$response = [
					'status' => '413',
					'text' => 'Redeem did not success',
					'message' => 'Not Redeemed',
					'data' => []
				];
				Api::print_json_array($response);
			}
		}
		else
		{
			Api::print_invalid_request_msg();
		}
	}
}