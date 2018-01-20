<?php
/**
 * Created by PhpStorm.
 * User: Hardik
 * Date: 17-01-2018
 * Time: 16:52
 */

class Jobs_model extends Data
{
    function __construct()
    {
        parent::__construct();
    }

    public static function get_jobs($id)
    {
        if($id>0)
        {
            $sql = 'SELECT a.i_id AS i_id, a.v_title AS v_title, a.v_desc AS v_desc, a.e_type AS e_type, a.e_status AS e_status, a.f_min_salary AS f_min_salary, a.f_max_salary AS f_max_salary, b.v_clinic FROM '.TABLE_JOBS.' a JOIN '.TABLE_APP_DOCTORS.' b ON a.i_d_id=b.i_id WHERE a.e_status!="Deleted" AND a.i_d_id='.$id.' ORDER BY a.i_id DESC';
        }
        else
        {
            $sql = 'SELECT a.i_id AS i_id, a.v_title AS v_title, a.v_desc AS v_desc, a.e_type AS e_type, a.e_status AS e_status, a.f_min_salary AS f_min_salary, a.f_max_salary AS f_max_salary, b.v_clinic FROM '.TABLE_JOBS.' a JOIN '.TABLE_APP_DOCTORS.' b ON a.i_d_id=b.i_id WHERE a.e_status!="Deleted" ORDER BY a.i_id DESC';
        }
        return parent::$CI->db->query($sql)->result_array();
    }
}