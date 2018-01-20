<?php
/**
 * Created by PhpStorm.
 * User: Hardik
 * Date: 05-01-2018
 * Time: 11:53
 */

class User_model extends My_model
{
    function __construct()
    {
        parent::__construct();
    }

    public function list_user($type)
    {
        $data['select'] = [
            'i_id',
            'v_name',
            'v_email',
            'v_phone'
        ];
        $data['where'] = [
            'e_status=' => 'Active',
            'e_type=' => $type
        ];
        $data['order'] = 'i_id DESC';
        $data['table'] = TABLE_APP_USERS;
        return $this->selectRecords($data, true);
    }

    public function view_doctor($id)
    {
        $data['select'] = [
            'v_clinic',
            'v_email',
            'v_phone',
            'v_hours',
            'v_lat',
            'v_lon',
            'v_city',
            'v_address',
            'v_landmark',
            'v_services',
            'v_languages',
            '(SELECT AVG(v_star) FROM `'.TABLE_DOC_REVIEW.'` WHERE `i_d_id`='.$id.') AS rating'
        ];
        $data['table'] = TABLE_APP_DOCTORS;
        $data['where'] = 'i_id='.$id;
        $result = $this->selectRecords($data, true);
        if(sizeof($result)==1)
        {
            if($result[0]['rating']==null)
            {
                $result[0]['rating'] = "0.0";
            }
            return $result;
        }
        else
        {
            return false;
        }
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

    public function view_supplier($id)
    {
        $data['select'] = [
            'v_name',
            'v_email',
            'v_phone',
            'v_hours',
            'v_lat',
            'v_lon',
            'v_city',
            'v_address',
            'v_landmark'
        ];
        $data['table'] = TABLE_APP_SUPPLIER;
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

    public function edit_doctor($id, $data)
    {
        $data['update'] = $data;
        $data['update']['dt_last_login'] = Common::date();
        $data['update']['v_ip'] = Common::ip();
        $data['table'] = TABLE_APP_DOCTORS;
        $data['where'] = 'i_id='.$id;
        $this->updateRecords($data);
        if($this->db->error('code')=="0")
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function edit_user($id, $data)
    {
        $data['update'] = $data;
        $data['update']['dt_last_login'] = Common::date();
        $data['update']['v_ip'] = Common::ip();
        $data['table'] = TABLE_APP_DOCTORS;
        $data['where'] = 'i_id='.$id;
        $this->updateRecords($data);
        if($this->db->error('code')=="0")
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function edit_supplier($id, $data)
    {
        $data['update'] = $data;
        $data['update']['dt_last_login'] = Common::date();
        $data['update']['v_ip'] = Common::ip();
        $data['table'] = TABLE_APP_DOCTORS;
        $data['where'] = 'i_id='.$id;
        $this->updateRecords($data);
        if($this->db->error('code')=="0")
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function add_doctor($input)
    {
        $data['insert'] = $input;
        $data['insert']['e_status'] = 'Active';
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

    public function approve_doctor($user_id)
    {
        $data['update'] = [
            'e_status' => 'Active'
        ];
        $data['table'] = TABLE_APP_DOCTORS;
        $data['where'] = [
            'i_u_id=' => $user_id
        ];
        $this->updateRecords($data);
        unset($data);
        $data['update'] = [
            'e_type' => 'Doctor'
        ];
        $data['table'] = TABLE_APP_USERS;
        $data['where'] = 'i_id='.$user_id;
        $this->updateRecords($data);
        unset($data);
        $data['where'] = 'i_u_id='.$user_id;
        $data['table'] = TABLE_APP_DOC_PENDING;
        $this->deleteRecords($data);
    }

    public function check_pending_doctor($user_id)
    {
        $data['select'] = [
            'COUNT(i_id) AS `cnt`'
        ];
        $data['where'] = [
            'i_u_id=' => $user_id
        ];
        $data['table'] = TABLE_APP_DOC_PENDING;
        $result = $this->selectRecords($data, true);
        if($result[0]['cnt']==1 || $result[0]['cnt']>0)
        {
            $break = true;
        }
        else
        {
            $break = false;
        }
        unset($data, $result);
        $data['select'] = [
            'COUNT(i_id) AS `cnt`'
        ];
        $data['where'] = [
            'i_id=' => $user_id,
            'e_type=' => 'Doctor'
        ];
        $data['table'] = TABLE_APP_USERS;
        $result = $this->selectRecords($data, true);
        if(($result[0]['cnt']==0 || $result[0]['cnt']<1) && $break===true)
        {
            $break = true;
        }
        else
        {
            $break = false;
        }
        unset($data, $result);
        $data['select'] = [
            'COUNT(i_id) AS `cnt`'
        ];
        $data['where'] = [
            'i_u_id=' => $user_id,
            'e_status=' => 'Pending'
        ];
        $data['table'] = TABLE_APP_DOCTORS;
        $result = $this->selectRecords($data, true);
        if(($result[0]['cnt']==1 || $result[0]['cnt']>0) && $break===true)
        {
            $break = true;
        }
        else
        {
            $break = false;
        }
        if($break===true)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function add_supplier($input)
    {
        $data['insert'] = $input;
        $data['insert']['e_status'] = 'Active';
        $data['insert']['dt_created'] = Common::date();
        $data['insert']['dt_last_seen'] = Common::date();
        $data['insert']['v_ip'] = Common::ip();
        $data['table'] = TABLE_APP_SUPPLIER;
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

    public function approve_supplier($user_id)
    {
        $data['update'] = [
            'e_status' => 'Active'
        ];
        $data['table'] = TABLE_APP_SUPPLIER;
        $data['where'] = [
            'i_u_id=' => $user_id
        ];
        $this->updateRecords($data);
        unset($data);
        $data['update'] = [
            'e_type' => 'Supplier'
        ];
        $data['table'] = TABLE_APP_USERS;
        $data['where'] = 'i_id='.$user_id;
        $this->updateRecords($data);
        unset($data);
        $data['where'] = 'i_u_id='.$user_id;
        $data['table'] = TABLE_APP_SUP_PENDING;
        $this->deleteRecords($data);
    }

    public function check_pending_supplier($user_id)
    {
        $data['select'] = [
            'COUNT(i_id) AS `cnt`'
        ];
        $data['where'] = [
            'i_u_id=' => $user_id
        ];
        $data['table'] = TABLE_APP_SUP_PENDING;
        $result = $this->selectRecords($data, true);
        if($result[0]['cnt']==1 || $result[0]['cnt']>0)
        {
            $break = true;
        }
        else
        {
            $break = false;
        }
        unset($data, $result);
        $data['select'] = [
            'COUNT(i_id) AS `cnt`'
        ];
        $data['where'] = [
            'i_id=' => $user_id,
            'e_type=' => 'Supplier'
        ];
        $data['table'] = TABLE_APP_USERS;
        $result = $this->selectRecords($data, true);
        if(($result[0]['cnt']==0 || $result[0]['cnt']<1) && $break===true)
        {
            $break = true;
        }
        else
        {
            $break = false;
        }
        unset($data, $result);
        $data['select'] = [
            'COUNT(i_id) AS `cnt`'
        ];
        $data['where'] = [
            'i_u_id=' => $user_id,
            'e_status=' => 'Pending'
        ];
        $data['table'] = TABLE_APP_SUPPLIER;
        $result = $this->selectRecords($data, true);
        if(($result[0]['cnt']==1 || $result[0]['cnt']>0) && $break===true)
        {
            $break = true;
        }
        else
        {
            $break = false;
        }
        if($break===true)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function fetch_reviews($user, $doctor)
    {
        $data['select'] = [
            'i_u_id',
            'v_star',
            'v_comment'
        ];
        $data['table'] = TABLE_DOC_REVIEW;
        $data['where'] = [
            'i_d_id=' => $doctor
        ];
        $result = $this->selectRecords($data, true);
        foreach ($result as $key=>$value)
        {
            if($value['i_u_id']==$user)
            {
                $result[$key]['self'] = '1';
            }
            else
            {
                $result[$key]['self'] = '0';
            }
        }
        return $result;
    }

    public function check_review_exist($user, $doctor)
    {
        $data['select'] = [
            'COUNT(i_id) AS `cnt`'
        ];
        $data['table'] = TABLE_DOC_REVIEW;
        $data['where'] = [
            'i_u_id=' => $user,
            'i_d_id=' => $doctor
        ];
        $result = $this->selectRecords($data, true);
        if(sizeof($result)>1 && $result[0]['cnt']==1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function add_review($input)
    {
        $input['dt_created'] = Common::date();
        $input['dt_updated'] = Common::date();
        $input['v_ip'] = Common::ip();
        $data['insert'] = $input;
        $data['table'] = TABLE_DOC_REVIEW;
        $this->insertRecord($data, true);
    }

    public function update_review($input)
    {
        $input['dt_updated'] = Common::date();
        $input['v_ip'] = Common::ip();
        $data['update'] = $input;
        $data['table'] = TABLE_DOC_REVIEW;
        $data['where'] = [
            'i_d_id=' => $input['i_d_id'],
            'i_u_id=' => $input['i_u_id']
        ];
        unset($data['update']['i_d_id'], $data['update']['i_u_id']);
        $this->updateRecords($data, true);
        if($this->db->error()["code"]=="0")
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public static function change_user_type($id, $type)
    {
        $data['update'] = [
            'e_type' => $type
        ];
        $data['where'] = [
            'i_u_id=' => $id
        ];
        $data['table'] = ($type=='Doctor') ? TABLE_APP_DOCTORS : TABLE_APP_SUPPLIER;
        My_model::update($data);

    }

}