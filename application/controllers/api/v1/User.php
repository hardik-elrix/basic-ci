<?php
/**
 * Created by PhpStorm.
 * User: Hardik
 * Date: 05-01-2018
 * Time: 11:50
 */

class User extends API_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->info = $this->myvalues->api_user;
        $this->load->model($this->info["model"], "model");
        class_alias("User_model", "Model");
    }

    public function enlist($type='')
    {
        if (Api::get_request_method()=='POST')
        {
            if($type!='' && in_array($type, ['Doctor']))
            {
                $list = $this->model->list_user($type);
                $response = [
                    'status' => '1',
                    'message' => 'OK',
                    'data' => $list
                ];
                Api::print_json_array($response);
            }
            else
            {
                Api::print_invalid_input_msg();
            }
        }
        else
        {
            Api::print_invalid_request_msg();
        }
    }

    public function profile($action='', $user_type='User', $id=null)
    {
        if(Api::get_request_method()=='POST' || Api::get_request_method()=='GET')
        {
            if(in_array($user_type, ['User', 'Doctor', 'Supplier']) && $id!=null && $id>0 && $id!='' && $action!='' && in_array($action, ['view', 'edit']))
            {
                if($action=='view')
                {
                    if($user_type=='Doctor')
                    {
                        Api::print_success_response($this->model->view_doctor($id));
                    }
                    elseif ($user_type=='Supplier')
                    {
                        Api::print_success_response($this->model->view_supplier($id));
                    }
                    elseif ($user_type=='User')
                    {
                        Api::print_success_response($this->model->view_user($id));
                    }

                }
                elseif($action=='edit')
                {
                    //edit
                    if($user_type=='Doctor')
                    {
                        foreach ($_POST as $k=>$v)
                        {
                            if(!empty($v))
                            {
                                $input[$k] = $v;
                            }
                        }
                        Api::print_success_response($this->model->edit_doctor($id, $input));
                    }
                    elseif ($user_type=='Supplier')
                    {
                        foreach ($_POST as $k=>$v)
                        {
                            if(!empty($v))
                            {
                                $input[$k] = $v;
                            }
                        }
                        Api::print_success_response($this->model->edit_supplier($id, $input));
                    }
                    elseif ($user_type=='User')
                    {
                        foreach ($_POST as $k=>$v)
                        {
                            if(!empty($v))
                            {
                                $input[$k] = $v;
                            }
                        }
                        Api::print_success_response($this->model->edit_user($id, $input));
                    }
                }
            }
            else
            {
                Api::print_invalid_input_msg();
            }
        }
        else
        {
            die("kk");
            Api::print_invalid_request_msg();
        }
    }

    public function become($type=null, $id=null)
    {
        if(Api::get_request_method()=='GET')
        {
            Api::int_id($id);
            Api::not_empty($type);
            Api::in_array($type, ['Doctor', 'Supplier']);
            if($type=='Doctor')
            {
                $result = $this->model->check_pending_doctor($id);
            }
            elseif($type=='Supplier')
            {
                $result = $this->model->check_pending_supplier($id);
            }
            if($result==true)
            {
                Api::print_success_response(['pending' => '1']);
            }
            else
            {
                Api::print_success_response(['pending' => '0']);
            }
        }
        elseif(Api::get_request_method()=='POST' && !empty($id) && $id!=null && in_array($type, ['Doctor', 'Supplier']))
        {
            Api::int_id($id);
            Api::not_empty($type);
            Api::in_array($type, ['Doctor', 'Supplier']);
            $input = Common::full_post_array();
            $input['i_u_id'] = $id;
            if($type=='Doctor')
            {
                $result = $this->model->add_doctor($input);
                if($result>0)
                {
                    $res = Model::become_doctor($id);
                    Api::print_success_response(['id' => $result]);
                }
                else
                {
                    Api::print_success_response(false, "Similar record already exists. Duplicate Record can't be accepted.");
                }
            }
            elseif($type=='Supplier')
            {
                $result = $this->model->add_supplier($input);
                if($result>0 && $result!=false)
                {
                    Api::print_success_response(['id' => $result]);
                }
                else
                {
                    Api::print_success_response(false, "Similar record already exists. Duplicate Record can't be accepted.");
                }
            }
            //receive data to create pending Application of DOCTOR or SUPPLIER
        }
        else
        {
            Api::print_invalid_request_msg();
        }
    }

    public function review($user=0, $doctor=0)
    {
        if(Api::get_request_method()=='GET')
        {
            Api::int_id($user);
            Api::not_empty($doctor);
            $result = $this->model->fetch_reviews($user, $doctor);
            Api::print_success_response($result);
        }
        elseif(Api::get_request_method()=='POST')
        {
            Api::int_id($user);
            Api::not_empty($doctor);
            if($this->model->check_review_exist($user, $doctor)===true)
            {
                $input = Common::full_post_array();
                $input['i_d_id'] = $doctor;
                $input['i_u_id'] = $user;
                $result = $this->model->update_review($input);
                if($result===true)
                {
                    Api::print_success_response(true);
                }
                else
                {
                    Api::print_success_response(false);
                }
            }
            else
            {
                $input = Common::full_post_array();
                $input['i_d_id'] = $doctor;
                $input['i_u_id'] = $user;
                $result = $this->model->update_review($input);
                if ($result > 0 && $result != false) {
                    Api::print_success_response(true);
                }
                else
                {
                    Api::print_success_response(false);
                }
            }
        }
        else
        {
            Api::print_invalid_request_msg();
        }
    }
}