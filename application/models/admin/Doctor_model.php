<?php
/**
 * Created by PhpStorm.
 * User: Hardik
 * Date: 12-01-2018
 * Time: 17:16
 */

class Doctor_model extends My_model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function list_docs()
    {
        $data['select'] = [
            'i_id',
            'v_clinic',
            'v_phone',
            'v_email',
            'v_city',
            'e_status'
        ];
        $data['table'] = TABLE_APP_DOCTORS;
        $data['where'] = [
            'e_status!=' => 'Deleted'
        ];
        $data['order'] = 'i_id DESC';
        return $this->selectRecords($data, true);
    }

    public function doc_details($id)
    {
        $data['select'] = [
            '*'
        ];
        $data['table'] = TABLE_APP_DOCTORS;
        $data['where'] = [
            'i_id=' => $id,
            'e_status!=' => 'Deleted'
        ];
        return $this->selectRecords($data, true);
    }

    public function add_user($input)
    {
        $data['insert'] = $input;
        $data['insert']['e_type'] = 'Doctor';
        $data['table'] = TABLE_APP_USERS;
        return $this->insertRecord($data);
    }

    public function add_doctor($input)
    {
        $data['insert'] = $input;
        $data['insert']['dt_created'] = Common::date();
        $data['insert']['dt_last_seen'] = Common::date();
        $data['insert']['v_ip'] = Common::ip();
        $data['table'] = TABLE_APP_DOCTORS;
        $result = $this->insertRecord($data, true);
        if($result>0 && !empty($result) && $result!=false)
        {
            return $result;
        }
        else
        {
            return false;
        }
    }

    public function fetch_doc($id)
    {
        $data['select'] = [
            '*'
        ];
        $data['table'] = TABLE_APP_DOCTORS;
        $data['where'] = 'i_id='.$id;
        return $this->selectRecords($data, true);
    }

    public function edit_doctor($id, $datas)
    {
        $data['update'] = $datas;
        $data['update']['dt_last_seen'] = Common::date();
        $data['update']['v_ip'] = Common::ip();
        $data['table'] = TABLE_APP_DOCTORS;
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
}