<?php
/**
 * Created by PhpStorm.
 * User: Hardik
 * Date: 17-01-2018
 * Time: 11:53
 */

class Supplier_model extends Data
{
    function __construct()
    {
        parent::__construct();
    }

    public static function list_supplier()
    {
        $data['select'] = [
            'i_id',
            'v_name',
            'v_phone',
            'v_email',
            'v_city',
            'e_status'
        ];
        $data['table'] = TABLE_APP_SUPPLIER;
        $data['where'] = [
            'e_status!=' => 'Deleted'
        ];
        $data['order'] = 'i_id DESC';
        return Data::select($data);
    }

    public static function sup_details($id)
    {
        $data['select'] = [
            '*'
        ];
        $data['table'] = TABLE_APP_DOCTORS;
        $data['where'] = [
            'i_id=' => $id,
            'e_status!=' => 'Deleted'
        ];
        return Data::select($data);
    }

    public static function add_user($input)
    {
        $data['insert'] = $input;
        $data['insert']['e_type'] = 'Supplier';
        $data['table'] = TABLE_APP_USERS;
        return Data::insert($data);
    }

    public static function add_supplier($input)
    {
        $data['insert'] = $input;
        $data['insert']['e_status'] = 'Active';
        $data['insert']['dt_created'] = Common::date();
        $data['insert']['dt_last_seen'] = Common::date();
        $data['insert']['v_ip'] = Common::ip();
        $data['table'] = TABLE_APP_SUPPLIER;
        $result = Data::insert($data, true);
        if($result>0 && !empty($result) && $result!=false)
        {
            return $result;
        }
        else
        {
            return false;
        }
    }

    public static function fetch_supplier($id)
    {
        $data['select'] = [
            '*'
        ];
        $data['table'] = TABLE_APP_SUPPLIER;
        $data['where'] = 'i_id='.$id;
        return Data::select($data, true);
    }

    public static function edit_supplier($id, $datas)
    {
        $data['update'] = $datas;
        $data['update']['dt_last_seen'] = Common::date();
        $data['update']['v_ip'] = Common::ip();
        $data['table'] = TABLE_APP_SUPPLIER;
        $data['where'] = 'i_id='.$id;
        Data::update($data);
        if(parent::$CI->db->error()["code"]=="0")
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public static function set_value_common($datas)
    {
        if(isset($datas['field']) && isset($datas['value']) && isset($datas['table']) && $datas['where'])
        {
            $data['update'] = [
                $datas['field'] => $datas['value']
            ];
            $data['table'] = $datas['table'];
            $data['where'] = $datas['where'];
            return Data::update($data);
        }
        else
        {
            return false;
        }
    }

}