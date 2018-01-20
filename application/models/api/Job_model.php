<?php
/**
 * Created by PhpStorm.
 * User: Hardik
 * Date: 08-01-2018
 * Time: 17:24
 */

class Job_model extends My_model
{
    function __construct()
    {
        parent::__construct();
    }

    public function list_jobs()
    {
        $data['select'] = [
            'i_id',
            'i_d_id',
            'v_title',
            'v_desc',
            'e_type',
            'f_min_salary',
            'f_max_salary',
            'dt_updated'
        ];
        $data['table'] = TABLE_JOBS;
        $data['where'] = [
            'e_status=' => 'Active'
        ];
        $data['order'] = 'i_id DESC';
        $result = $this->selectRecords($data, true);
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
                unset($result[$k]['dt_updated']);
            }
            return $result;
        }
        else
        {
            return [];
        }
    }

    public function list_my_jobs($did)
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
            'i_d_id=' => $did
        ];
        $data['order'] = 'i_id DESC';
        $result = $this->selectRecords($data, true);
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
                unset($result[$k]['dt_created'], $result[$k]['dt_updated']);
            }
            return $result;
        }
        else
        {
            return [];
        }
    }

    public function add_job($id, $input)
    {
        $data['insert'] = $input;
        $data['insert']['i_d_id'] = $id;
        $data['insert']['dt_created'] = Common::date();
        $data['insert']['dt_updated'] = Common::date();
        $data['insert']['v_ip'] = Common::ip();
        $data['table'] = TABLE_JOBS;
        $result = $this->insertRecord($data);
        if(!empty($result) && $result>0)
        {
            return $result;
        }
        else
        {
            return false;
        }
    }

    public function edit_job($id, $input)
    {
        $data['update'] = $input;
        $data['update']['dt_updated'] = Common::date();
        $data['update']['v_ip'] = Common::ip();
        $data['where'] = [
            'i_id=' => $id
        ];
        $data['table'] = TABLE_JOBS;
        $result = $this->updateRecords($data);
        if($result==true)
        {
            return true;
        }
        else
        {
            return true;
        }
    }

    public function apply($job_id, $user_id)
    {
        $data['insert'] = [];
        $data['update']['dt_updated'] = Common::date();
        $data['update']['v_ip'] = Common::ip();
        $data['where'] = [
            'i_id=' => $id
        ];
        $data['table'] = TABLE_JOBS;
        $result = $this->updateRecords($data);
        if($result==true)
        {
            return true;
        }
        else
        {
            return true;
        }
    }
}