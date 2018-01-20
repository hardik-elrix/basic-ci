<?php
/**
 * Created by PhpStorm.
 * User: Hardik
 * Date: 17-01-2018
 * Time: 15:56
 */

class Details extends Data
{
    function __construct()
    {
        parent::__construct();
    }

    public static function doctor_details($id)
    {
        $data['select'] = [
            '*',
            '(SELECT AVG(v_star) FROM `'.TABLE_DOC_REVIEW.'` WHERE `i_d_id`='.$id.') AS `rating`'
        ];
        $data['table'] = TABLE_APP_DOCTORS;
        $data['where'] = [
            'i_id=' => $id
        ];
        return Data::select($data);
    }

    public static function sup_details($id)
    {
        $data['select'] = [
            '*',
            '(SELECT AVG(v_star) FROM `'.TABLE_DOC_REVIEW.'` WHERE `i_d_id`='.$id.') AS `rating`'
        ];
        $data['table'] = TABLE_APP_SUPPLIER;
        $data['where'] = [
            'i_id=' => $id
        ];
        return Data::select($data);
    }

    public static function user_details($id)
    {
        $data['select'] = [
            '*'
        ];
        $data['table'] = TABLE_APP_USERS;
        $data['where'] = [
            'i_id=' => $id
        ];
        return Data::select($data);
    }

    public static function fetch_jobs($id)
    {
        $data['select'] = [
            '*'
        ];
        $data['table'] = TABLE_JOBS;
        $data['where'] = [
            'i_d_id=' => $id
        ];
        return Data::select($data);
    }

    public static function fetch_doc_review($id)
    {
        $data['select'] = [
            'v_star',
            'v_comment',
            'dt_updated'
        ];
        $data['table'] = TABLE_DOC_REVIEW;
        $data['where'] = [
            'i_d_id=' => $id
        ];
        return Data::select($data);
    }

    public static function fetch_sup_review($id)
    {
        $data['select'] = [
            'v_star',
            'v_comment',
            'dt_updated'
        ];
        $data['table'] = TABLE_SUP_REVIEW;
        $data['where'] = [
            'i_s_id=' => $id
        ];
        return Data::select($data);
    }

    public static function list_jobs($id)
    {
        $data['select'] = [
            'i_id',
            'v_title',
            'v_desc',
            'e_type',
            'e_status',
            'f_min_salary',
            'f_max_salary',
            'dt_created',
            'dt_updated'
        ];
        $data['table'] = TABLE_JOBS;
        $data['where'] = [
            'i_d_id=' => $id
        ];
        $data['order'] = 'i_id DESC';
        $result = Data::select($data);
        if(sizeof($result)>0)
        {
            foreach ($result as $k=>$v)
            {
                $created = new DateTime($v['dt_updated']);
                $today = new DateTime;
                if($created->diff($today)->days < 1)
                {
                    $to_time = strtotime(date("Y-m-d H:i:s"));
                    $from_time = strtotime($v['dt_updated']);
                    if(round(abs($to_time - $from_time) / 60, 0)<60)
                    {
                        $result[$k]['time'] =  round(abs($to_time - $from_time) / 60, 0). " minute(s) ago";
                    }
                    else
                    {
                        $result[$k]['time'] =  round(abs($to_time - $from_time)/3600, 0). " hour(s) ago";
                    }
                }
                else
                {
                    $result[$k]['time'] = $created->diff($today)->days . " Day(s) ago";
                }
                unset($result[$k]['dt_created']);
            }
            return $result;
        }
        else
        {
            return [];
        }
    }

    public static function count_param_doc($id)
    {
        $sql = 'SELECT (SELECT COUNT(i_id) FROM '.TABLE_DOC_APPOINTMENT.' WHERE `i_d_id`='.$id.') AS cnt_appoint,
                (SELECT COUNT(i_id) FROM '.TABLE_DOC_REVIEW.' WHERE `i_d_id`='.$id.') AS cnt_review,
                (SELECT COUNT(i_id) FROM '.TABLE_DOCTOR_PRODUCTS.' WHERE `i_d_id`='.$id.') AS cnt_product
                ';
        return Data::$CI->db->query($sql)->result_array();
    }

    public static function count_param_sup($id)
    {
        $sql = 'SELECT
                (SELECT COUNT(i_id) FROM '.TABLE_SUP_REVIEW.' WHERE `i_s_id`='.$id.') AS cnt_review,
                (SELECT COUNT(i_id) FROM '.TABLE_SUPPLIER_PRODUCTS.' WHERE `i_s_id`='.$id.') AS cnt_product
                ';
        return Data::$CI->db->query($sql)->result_array();
    }

    public static function doc_products($id)
    {
        $data['select'] = [
            '*'
        ];
        $data['table'] = TABLE_DOCTOR_PRODUCTS;
        $data['where'] = 'i_d_id='.$id;
        return Data::select($data);
    }

    public static function sup_products($id)
    {
        $data['select'] = [
            '*'
        ];
        $data['table'] = TABLE_SUPPLIER_PRODUCTS;
        $data['where'] = 'i_s_id='.$id;
        return Data::select($data);
    }

    public static function doc_appoint($id)
    {
        $sql = 'SELECT a.dt_time AS dt_time, a.e_status AS e_status, b.v_name AS v_name FROM '.TABLE_DOC_APPOINTMENT.' a JOIN '.TABLE_APP_USERS.' b ON a.i_u_id=b.i_id WHERE i_d_id='.$id.' ORDER BY a.i_id DESC';
        return Data::$CI->db->query($sql)->result_array();
    }
}