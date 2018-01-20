<?php
/**
 * Created by PhpStorm.
 * User: Hardik
 * Date: 04-01-2018
 * Time: 20:11
 */

class User_model extends My_model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function list_users()
    {
        $data['select'] = [
            'i_id',
            'v_name',
            'v_email',
            'v_phone',
            'e_status',
            'e_type'
        ];
        $data['table'] = TABLE_APP_USERS;
        $data['where'] = [
            'e_status!=' => 'Deleted'
        ];
        $data['order'] = 'i_id DESC';
        return $this->selectRecords($data, true);
    }

    public function set_value_common($datas)
    {
        if(isset($datas['field']) && isset($datas['value']) && isset($datas['table']) && $datas['where'])
        {
            $data['update'] = [
                $datas['field'] => $datas['value']
            ];
            $data['table'] = $datas['table'];
            $data['where'] = $datas['where'];
            return $this->updateRecords($data);
        }
        else
        {
            return false;
        }
    }

    public function add_user($input)
    {
        $data['insert'] = $input;
        $data['table'] = TABLE_APP_USERS;
        return $this->insertRecord($data);
    }

    public function view_user($id)
    {
        $data['select'] = [
            'v_name',
            'v_phone',
            'v_email'
        ];
        $data['table'] = TABLE_APP_USERS;
        $data['where'] = 'i_id='.$id;
        $result = $this->selectRecords($data, true);
        if(sizeof($result)==1)
        {
            return $result;
        }
        else
        {
            return false;
        }
    }

    public function edit_user($id, $datas)
    {
        $data['update'] = $datas;
        $data['update']['dt_last_seen'] = Common::date();
        $data['update']['v_ip'] = Common::ip();
        $data['table'] = TABLE_APP_USERS;
        $data['where'] = 'i_id='.$id;
        $this->updateRecords($data);
        if($this->db->error()["code"]=="0")
        {
            return true;
        }
        else
        {
            return false;
        }
    }

}