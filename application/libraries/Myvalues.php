<?php

class Myvalues
{
    //API part

    var $api_system = [
        "controller" => "control",
        "model"      => "api/System/Control"
    ];

    var $api_device = [
        "controller" => "device",
        "model"      => "api/Device_model"
    ];

    var $api_user = [
        "controller" => "device",
        "model"      => "api/User_model"
    ];

    var $api_job = [
        "controller" => "job",
        "model" => "api/Job_model"
    ];


    //Admin part


    var $admin_auth = [
        "controller" => "system",
        "model"      => "admin/Auth_model"
    ];

    var $admin_users = [
        "controller" => "console",
        "model"      => "admin/User_model"
    ];

    var $admin_doctor = [
        "controller" => "console",
        "model"      => "admin/Doctor_model"
    ];

    var $admin_supplier = [
        "controller" => "console",
        "model"      => "admin/Supplier_model"
    ];

    var $admin_detail = [
        "controller" => "console",
        "model"      => "admin/Details"
    ];

    var $admin_job = [
        "controller" => "console",
        "model"      => "admin/Jobs_model"
    ];

    var $admin_product = [
        "controller" => "console",
        "model"      => "admin/Product_model"
    ];

    /*function __construct()
    {
        $vars = get_class_vars('Myvalues');
        foreach ($vars as $k=>$v)
        {
            static $api_system2 = array("controller"=>"control", "model" => "api/System/Control");
            var_dump(self::$api_system);die;
            $s = "static $".$k." = array(\"controller\"=>\"".$v['controller']."\", \"model\" => \"".$v['model']."\");";
            echo $s;die;
            eval($s);
        }
    }*/

}