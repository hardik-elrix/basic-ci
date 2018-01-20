<?php
class Common
{
	public static $CI;
	
	function __construct()
	{
		self::$CI =& get_instance();
	}
	
	public function getDateTime($format= "Y-m-d H:i:s")
	{
		date_default_timezone_set("Asia/Kolkata");
		return date($format);
	}
	
	public static function date()
	{
		return date("Y-m-d H:i:s");
	}
	
	public static function month()
	{
		return date("m");
	}
	
	public static function year()
	{
		return date("Y");
	}
	
	public static function date_only()
	{
		return date("d");
	}
	
	public static function month_name($month)
	{
		return date('F', mktime(0, 0, 0, $month, 10));
	}
	
	public static function ip()
	{
		return self::$CI->input->ip_address();
	}
	
	public function getRealIp()
	{
		$CI	=	& get_instance();
		return $CI->input->ip_address();
	}

    public static function int_id($id)
    {
        if($id!=null && !empty($id) && $id==($id/1) && $id>0)
        {
            return true;
        }
        else
        {
            return false;
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
            return false;
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
            return false;
        }
    }

    public static function full_post_array()
    {
        $array = array();
        foreach ($_POST as $key=>$value)
        {
            if(!empty($value) && $value!=null && $value!='')
            {
                $array[$key] = $value;
            }
        }
        return $array;
    }

    public static function full_get_array()
    {
        $array = array();
        foreach ($_GET as $key=>$value)
        {
            if(!empty($value) && $value!=null && $value!='')
            {
                $array[$key] = $value;
            }
        }
        return $array;
    }
}