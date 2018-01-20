<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main_model extends My_model
{

    public function __construct()
    {
        parent::__construct();
    }
    
    /* Validates Incoming webservices Request Wheather They are Passed all required Parameters or Not */
    public function validateRequest($required, $provided)
    {
        foreach ($required as $k => $v) {
            if (! array_key_exists($v, $provided))
                return $this->lang->line("error_specify_all_params");
            if ($v == "type") {
                if (! in_array($provided [$v], [
                    "Android",
                    "Java",
                    "Desktop"
                ]))
                    return $this->lang->line("error_invalid_platform");
            }
        }
        return true;
    }

    public function generateToken($userId, $data)
    {
        $string = implode("||", $data);
        $string = "{{" . $string . "}}";
        $string = substr($userId, 0, 10) . $string;
        $string = $string . substr($userId, - 10, 10);
        return md5(sha1($string));
    }
}
