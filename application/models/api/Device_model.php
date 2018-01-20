<?php
/**
 * Created by PhpStorm.
 * User: vaio
 * Date: 12/29/2017
 * Time: 2:42 PM
 */

class Device_model extends My_model
{
	function __construct()
	{
		if (get_parent_class($this) == TRUE)
		{
			parent::__construct();
		}
	}
	
	public function check_user_exist($email=NULL)
	{
		if($email!=NULL && !empty($email))
		{
			$data['select'] = [
				'COUNT(i_id) AS cnt',
				'i_id'
			];
			$data['where'] = [
				'v_email=' => $email
			];
			$data['table'] = TABLE_APP_USERS;
			$result = $this->selectRecords($data, TRUE);
			if($result[0]['cnt']==1 && $result[0]['i_id']>0)
			{
				return $result[0]['i_id'];
			}
			else
			{
				return 0;
			}
		}
		else
		{
			return FALSE;
		}
	}

	public function check_user_active($email=NULL)
	{
		if($email!=NULL && !empty($email))
		{
			$data['select'] = [
				'e_status'
			];
			$data['where'] = [
				'v_email=' => $email
			];
			$data['table'] = TABLE_APP_USERS;
			$result = $this->selectRecords($data, TRUE);
			if(is_array($result) && sizeof($result)>0 && $result[0]['e_status']=='Active')
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return FALSE;
		}
	}

	public function login($input)
    {
        $data['select'] = [
            'COUNT(i_id) as `cnt`',
            'e_type'
        ];
        $data['where'] = [
            'v_email=' => $input['v_email'],
            'v_password=' => $input['v_password'],
            'e_status=' => 'Active'
        ];
        $data['table'] = TABLE_APP_USERS;
        $result = $this->selectRecords($data, true);
        if($result[0]['cnt']==1)
        {
            $uid = $this->get_user_id_from_email($input['v_email']);
            if($result[0]['e_type']=='User')
            {
                return ['uid' => $uid , 'type' => 'User', 'id' => $uid];
            }
            elseif($result[0]['e_type']=='Doctor')
            {
                return ['uid' => $uid , 'type' => 'Doctor', 'id' => $this->get_doctor_id($uid)];
            }
            elseif($result[0]['e_type']=='Supplier')
            {
                return ['uid' => $uid ,  'type' => 'Supplier', 'id' => $this->get_supplier_id($uid)];
            }
            else
            {
                return false;
            }
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

	public function check_device_exist($uid)
    {
        $data['select'] = [
            'COUNT(i_id) as `cnt`'
        ];
        $data['where'] = [
            'v_uid=' => $uid
        ];
        $data['table'] = TABLE_APP_DEVICES;
        $result = $this->selectRecords($data, true);
        if($result[0]['cnt']==1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function check_device_status($uid)
    {
        $data['select'] = [
            'e_status'
        ];
        $data['where'] = [
            'v_uid=' => $uid
        ];
        $data['table'] = TABLE_APP_DEVICES;
        $result = $this->selectRecords($data, true);
        if($result[0]['e_status']=='Active')
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function add_device($input)
    {
        $data['insert'] = $input;
        $data['table'] = TABLE_APP_DEVICES;
        return $this->insertRecord($data);
    }

    public function update_device($input)
    {
        $uid = $input['v_uid'];
        unset($input['v_uid']);
        $data['update'] = $input;
        $data['where'] = [
            'v_uid=' => $uid
        ];
        $data['table'] = TABLE_APP_DEVICES;
        return $this->updateRecords($data);
    }

	public function set_last_seen($id)
	{
		$data['update'] = [
			'dt_last_seen' => Common::date(),
			'v_ip' => Common::ip()
		];
		$data['where'] = 'i_id='.$id;
		$data['table'] = TABLE_APP_USERS;
		return $this->updateRecords($data);
	}

	public function check_status($id)
    {
        $data['select'] = [
            'COUNT(i_id) as `cnt`'
        ];
        $data['where'] = [
            'i_id=' => $id,
            'e_status=' => 'Active',
            'e_logout' => '0'
        ];
        $data['table'] = TABLE_APP_USERS;
        $result = $this->selectRecords($data, true);
        if($result[0]['cnt']==1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function get_user_id_from_email($email)
    {
        $data['select'] = [
            'i_id'
        ];
        $data['where'] = [
            'v_email=' => $email
        ];
        $data['table'] = TABLE_APP_USERS;
        $result = $this->selectRecords($data, true);
        return $result[0]['i_id'];
    }

    public function get_doctor_id($id)
    {
        $data['select'] = [
            'i_id'
        ];
        $data['where'] = [
            'i_u_id=' => $id
        ];
        $data['table'] = TABLE_APP_DOCTORS;
        $result = $this->selectRecords($data, true);
        return $result[0]['i_id'];
    }

    public function get_supplier_id($id)
    {
        $data['select'] = [
            'i_id'
        ];
        $data['where'] = [
            'i_u_id=' => $id
        ];
        $data['table'] = TABLE_APP_SUPPLIER;
        $result = $this->selectRecords($data, true);
        return $result[0]['i_id'];
    }
}