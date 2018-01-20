<?php
(defined('BASEPATH')) or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public $currentMenuId = 0;

    function __construct()
    {
        parent::__construct();
        require_once APPPATH . 'config/tablenames_constants.php';
        require_once APPPATH . 'config/static_constants.php';
    }

    public function myView($viewName, $data = [])
    {
        $this->load->view("templates/html_open.php", $data);
        
        /* Loads HeaderInfo Like Title,MEta Tags and Scripts */
        /* Also Loads Javascript That Require In Header Section */
        $data ["view"] = $viewName;
        $data ["title"] = isset($data ["title"]) ? $data ["title"] : (isset($this->title) ? $this->title . " : " . SITE_TITLE : SITE_TITLE);
        $this->load->view("templates/header.php", $data);
        
        /* Loads Menu For Admin or Other Users */
        if (! isset($data ["showMenu"]) || $data ["showMenu"] === true) {
            $this->load->view("templates/menu.php", $data);
        }
        
        /* Loads Main Content */
        $this->load->view($viewName, $data);
        
        /* Loads footer For Admin or Other Users */
        $this->load->view("templates/footer.php", $data);
        
        /* Loads Javascript, CSS Required At Bottom Of Page */
        $this->load->view("templates/bottom_files.php", $data);
        
        /* Loads HTML Tags and DOCKTYPE */
        $this->load->view("templates/html_close.php", $data);
    }

    public function myViewAjax($viewName, $data = [], $string = false)
    {
        /* Loads Main Content */
        if ($string) {
            return $this->load->view($viewName, $data, $string);
        }
        else {
            $this->load->view($viewName, $data);
        }
    }

    public function validateData($rules, $data = [])
    {
        $config ['error_prefix'] = '<div class="error_prefix">';
        $config ['error_suffix'] = '</div>';
        $this->load->library('form_validation', $config);
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_error_delimiters('<label class="ci-validations error">', '</label>');
        
        if (count($data) > 0)
            $this->form_validation->set_data($data);
        return ($this->form_validation->run());
    }

    public function get_validation_errors()
    {
        $error = validation_errors();
        if ($error === "")
            $error = '<div class="error_prefix">' . $this->lang->line('error_default_form_submission') . '</div>';
        return $error;
    }

    public function checkFunctionAvailability($onlyAjaxFunctions, $notAjaxFunctions = ["index"])
    {
        $method = $this->router->fetch_method();
        if (! $this->input->is_ajax_request() && in_array($method, $onlyAjaxFunctions)) {
            // die(json_encode(["status" => "danger","message" => "You are not allowed to perform this task."]));
            show_error($this->lang->line("forbidden_function"), "403", "Forbidden");
            die();
        }
        if ($this->input->is_ajax_request() && in_array($method, $notAjaxFunctions)) {
            die(json_encode([
                "status" => "danger",
                "message" => "You are not allowed to perform this task."
            ]));
            // show_error($this->lang->line("forbidden_function"), "403", "Forbidden");
            // die();
        }
    }

    public function my_jquery_pagination($url, $total, $limit, $div = "#my-content", $uriSegment = 4, $additionalParam = "load_ajax_table()")
    {
        $this->load->library("Jquery_pagination");
        $config ['base_url'] = $url;
        $config ['total_rows'] = $total;
        $config ['per_page'] = $limit;
        $config ['uri_segment'] = $uriSegment;
        $config ['num_links'] = 2;
        $config ['div'] = $div;
        $config ['additional_param'] = $additionalParam;
        $this->jquery_pagination->initialize($config);
        return $this->jquery_pagination->create_links();
    }
}
