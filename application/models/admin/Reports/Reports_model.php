<?php

class Reports_model extends My_model
{
    function __construct()
    {
        if (get_parent_class($this) == TRUE)
        {
            parent::__construct();
        }
    }
    
    function get_redeem_report()
    {
    	$table_redeem_history = TABLE_REDEEM_HISTORY;
    	$table_coupons = TABLE_COUPONS;
    	$table_business = TABLE_LOCAL_BUSINESS;
    	$table_category = TABLE_COUPONS_CAT;
    	$table_devices = TABLE_DEVICES;
        $sql = <<<SQL
SELECT
a.`i_id` AS `i_id`,
e.`e_platform` AS `platform`,
b.`e_type` AS `type`,
b.`v_name` AS `coupon`,
c.`v_business_name` AS `business`,
MONTHNAME(STR_TO_DATE(a.`i_month`, '%m')) AS `month`,
a.`i_year` AS `year`,
a.`i_date` AS `date`,
a.`dt_datetime` AS `datetime`,
d.`v_name` AS `category`,
a.`v_ip` AS `ip`
FROM $table_redeem_history a
JOIN
$table_coupons b ON a.i_c_id=b.i_id
JOIN
$table_business c ON b.i_business_id=c.i_id
JOIN
$table_category d ON d.i_id=b.i_cat_id
JOIN
$table_devices e ON e.i_id=a.i_d_id
ORDER BY a.i_id DESC
SQL;
        
        $result = $this->db->query($sql)->result_array();
        return $result;
    }
	
	function get_purchase_report()
	{
		$table_purchase = TABLE_PURCHASE;
		$table_devices = TABLE_DEVICES;
		$sql = <<<SQL
SELECT
a.`i_id` AS `i_id`,
a.v_transaction_id AS `v_transaction_id`,
a.v_reference AS `v_reference`,
b.`e_platform` AS `platform`,
a.`v_amount` AS `v_amount`,
MONTHNAME(STR_TO_DATE(a.`i_month`, '%m')) AS `month`,
a.`i_year` AS `year`,
a.`i_date` AS `date`,
a.`v_purchase_time` AS `client_datetime`,
a.`dt_server_time` AS `server_datetime`,
a.`v_ip` AS `ip`
FROM $table_purchase a
JOIN
$table_devices b ON b.i_id=a.i_d_id
ORDER BY a.i_id DESC
SQL;
		
		$result = $this->db->query($sql)->result_array();
		return $result;
	}
}