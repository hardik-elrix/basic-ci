<?php
/**
 * Created by PhpStorm.
 * User: Hardik
 * Date: 17-01-2018
 * Time: 23:15
 */

class Product_model extends Data
{
    function __construct()
    {
        parent::__construct();
    }

    public static function by_doc($id)
    {
        if($id>0)
        {
            $sql = 'SELECT a.v_name AS v_name, a.e_status AS e_status, a.v_desc AS v_desc, a.v_price As v_price, b.v_clinic AS v_clinic, b.i_id AS i_id FROM '.TABLE_DOCTOR_PRODUCTS.' a JOIN '.TABLE_APP_DOCTORS.' b ON a.i_d_id=b.i_id WHERE a.i_d_id='.$id.' AND a.e_status!="Deleted" ORDER BY a.i_id DESC';
        }
        else
        {
            $sql = 'SELECT a.v_name AS v_name, a.e_status AS e_status, a.v_desc AS v_desc, a.v_price As v_price, b.v_clinic AS v_clinic, b.i_id AS i_id FROM '.TABLE_DOCTOR_PRODUCTS.' a JOIN '.TABLE_APP_DOCTORS.' b ON a.i_d_id=b.i_id WHERE a.e_status!="Deleted" ORDER BY a.i_id DESC';
        }
        return Data::$CI->db->query($sql)->result_array();
    }

    public static function by_sup($id)
    {
        if($id>0)
        {
            $sql = 'SELECT a.v_name AS v_name, a.e_status AS e_status, a.v_desc AS v_desc, a.v_price As v_price, b.v_name AS v_sname, b.i_id AS i_id FROM '.TABLE_SUPPLIER_PRODUCTS.' a JOIN '.TABLE_APP_SUPPLIER.' b ON a.i_s_id=b.i_id WHERE a.i_s_id='.$id.' AND a.e_status!="Deleted" ORDER BY a.i_id DESC';
        }
        else
        {
            $sql = 'SELECT a.v_name AS v_name, a.e_status AS e_status, a.v_desc AS v_desc, a.v_price As v_price, b.v_name AS v_sname, b.i_id AS i_id FROM '.TABLE_SUPPLIER_PRODUCTS.' a JOIN '.TABLE_APP_SUPPLIER.' b ON a.i_s_id=b.i_id WHERE a.e_status!="Deleted" ORDER BY a.i_id DESC';
        }
        return Data::$CI->db->query($sql)->result_array();
    }
}