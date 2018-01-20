<?php
/**
 * Created by PhpStorm.
 * User: vaio
 * Date: 12/22/2017
 * Time: 12:50 PM
 */

class Coupons extends API_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->info = $this->myvalues->api_coupons;
        $this->load->model($this->info["model"], "model");
    }

    public function index()
    {
        $list = [
            'GET /list_category',
            'GET /list_coupons/:user_id/:category_id'
        ];
        Api::print_services_list($list);
    }

    public function list_category()
    {
        if (Api::get_request_method() == 'GET')
        {
            $result = $this->model->get_category();
            if (!empty($result))
            {
                $response = [
                    'status' => '200',
                    'message' => 'OK',
                    'text' => "Coupons's categories.",
                    'data' => $result
                ];
                Api::print_json_array($response);
            }
            else
            {
                Api::print_empty_data_msg();
            }
        }
        else
        {
            Api::print_invalid_request_msg();
        }
    }

    public function list_coupons($uid=NULL, $cat_id=null, $top_deal=0)
    {
        if ($cat_id == null || !is_numeric($cat_id) || $uid == null || !is_numeric($uid) || $uid<=0)
        {
            Api::print_invalid_input_msg();
        }

        if (Api::get_request_method()=='GET' && $cat_id!=null)
        {
            $result = $this->model->get_coupons($cat_id, $top_deal);
            $count = 1;
			foreach ($result as $k=>$v)
			{
				$result[$k]['business_imgs'] = [];
				$img = 'v_img'.$count;
				if($v[$img]!=NULL && !empty($v[$img]))
				{
					$result[$k]['business_imgs'][] = $v[$img];
				}
				unset($result[$k]['v_img1'], $result[$k]['v_img2'], $result[$k]['v_img3'], $result[$k]['v_img4'], $result[$k]['v_img5']);
            }
            $redeemed = $this->model->get_redeemed($uid);
			$coupon_arr = [];
			foreach ($redeemed as $key=>$value)
			{
				$coupon_arr[] = $value['i_c_id'];
			}
			foreach ($result as $k=>$v)
			{
				if(in_array($v['i_id'], $coupon_arr))
				{
					$result[$k]['used'] = '1';
				}
				else
				{
					$result[$k]['used'] = '0';
				}
            }
            $response = [
                'status' => '200',
                'message' => 'OK',
                'text' => "List of Coupons for provided category.",
                'data' => $result
            ];
            Api::print_json_array($response);
        }
        else
        {
            Api::print_invalid_request_msg();
        }
    }
}