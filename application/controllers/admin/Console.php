<?php
/**
 * Created by PhpStorm.
 * User: vaio
 * Date: 12/22/2017
 * Time: 8:09 PM
 */

class Console extends Admin
{
	public $info;
	function __construct()
	{
		parent::__construct();
		$this->current['action'] = NULL;
		$this->page_title        = "Console";
	}
	
	public function index()
	{
		$this->current['option'] = 'dashboard';
		$this->dashboard();
	}
	
	public function dashboard()
	{
        $this->users();
	}
	
	public function users($action = 'view', $id = '')
	{
		$this->info              = $this->myvalues->admin_users;
		$this->load->model($this->info["model"], "model");
		if ($action == 'view')
		{
			$this->current['action'] = $action;
			$this->current['option'] = 'users-view';
			$this->current['filter_limit'] = 2;
			$this->page_title        = "View Users";
			$list                    = $this->model->list_users();
			$this->view("Console/Users/View.php", ["data" => $list]);
		}
        if ($action == 'add')
        {
            $this->current['action'] = $action;
            $this->current['option'] = 'users-add';
            $this->page_title        = "Add User";
            $data['form']            = [
                'conf'   => [
                    'edit' => 0
                ],
                'inputs' => [
                    [
                        'title'    => "Name",
                        'name'     => 'v_name',
                        'required' => 1,
                        'type'     => 'text',
                        'class'    => 'form-control',
                        'value'    => ''
                    ],
                    [
                        'title'    => "Phone",
                        'name'     => 'v_phone',
                        'required' => 1,
                        'type'     => 'text',
                        'class'    => 'form-control',
                        'value'    => ''
                    ],
                    [
                        'title'    => "Email",
                        'name'     => 'v_email',
                        'required' => 1,
                        'type'     => 'email',
                        'class'    => 'form-control',
                        'value'    => ''
                    ],
                    [
                        'title'    => "Password",
                        'name'     => 'v_password',
                        'required' => 1,
                        'type'     => 'password',
                        'class'    => 'form-control',
                        'value'    => ''
                    ]
                ]
            ];
            $data['action']          = SITEURLADM . 'submit/add_user';
            $this->view("Console/Users/Add.php", $data);
        }
        if ($action == 'edit' && $id!='' && $id>0)
        {
            $this->info = $this->myvalues->admin_users;
            $this->load->model($this->info["model"], "model");
            $user = $this->model->view_user($id);
            $user = $user[0];
            $this->current['action'] = $action;
            $this->current['option'] = 'users-add';
            $this->page_title        = "Edit User";
            $data['form']            = [
                'conf'   => [
                    'edit' => 0
                ],
                'inputs' => [
                    [
                        'title'    => "Name",
                        'name'     => 'v_name',
                        'required' => 1,
                        'type'     => 'text',
                        'class'    => 'form-control',
                        'value'    => $user['v_name']
                    ],
                    [
                        'title'    => "Phone",
                        'name'     => 'v_phone',
                        'required' => 1,
                        'type'     => 'text',
                        'class'    => 'form-control',
                        'value'    => $user['v_phone']
                    ],
                    [
                        'title'    => "Email",
                        'name'     => 'v_email',
                        'required' => 1,
                        'type'     => 'email',
                        'class'    => 'form-control',
                        'value'    => $user['v_email']
                    ]
                ]
            ];
            $data['action']          = SITEURLADM . 'submit/edit_user/'.$id;
            $this->view("Console/Users/Edit.php", $data);
        }
	}
	
	public function doctors($action = 'view', $id=0)
	{
        $this->info              = $this->myvalues->admin_doctor;
        $this->load->model($this->info["model"], "model");
		if ($action == 'view')
		{
            $this->current['action'] = $action;
            $this->current['option'] = 'doctors-view';
            $this->current['filter_limit'] = 3;
            $this->page_title        = "View Doctors";
            $list                    = $this->model->list_docs();
            $this->view("Console/Doctor/View.php", ["data" => $list]);
		}

		if ($action == 'add')
		{
			$this->current['action'] = $action;
			$this->current['option'] = 'doctors-add';
			$this->page_title        = "Add Doctor";
			$data['form']            = [
				'conf'   => [
					'edit' => 0
				],
				'inputs' => [
                    [
                        'title'    => "Name",
                        'name'     => 'v_name',
                        'required' => 1,
                        'type'     => 'text',
                        'class'    => 'form-control',
                        'value'    => ''
                    ],
                    [
                        'title'    => "Personal Email",
                        'name'     => 'v_email1',
                        'required' => 1,
                        'type'     => 'email',
                        'class'    => 'form-control',
                        'value'    => ''
                    ],
                    [
                        'title'    => "Personal Phone",
                        'name'     => 'v_phone1',
                        'required' => 1,
                        'type'     => 'text',
                        'class'    => 'form-control',
                        'value'    => ''
                    ],
                    [
                        'title'    => "Password",
                        'name'     => 'v_password',
                        'required' => 1,
                        'type'     => 'password',
                        'class'    => 'form-control',
                        'value'    => ''
                    ],
					[
						'title'    => "Clinic Name",
						'name'     => 'v_clinic',
						'required' => 1,
						'type'     => 'text',
						'class'    => 'form-control',
						'value'    => ''
					],
					[
						'title'    => "Clinic Email",
						'name'     => 'v_email2',
						'required' => 1,
						'type'     => 'email',
						'class'    => 'form-control',
						'value'    => ''
					],
					[
						'title'    => "Phone",
						'name'     => 'v_phone2',
						'required' => 1,
						'type'     => 'text',
						'class'    => 'form-control',
						'value'    => ''
					],
                    [
                        'title'    => "Address",
                        'name'     => 'v_address',
                        'required' => 1,
                        'type'     => 'text',
                        'class'    => 'form-control',
                        'value'    => ''
                    ],
					[
						'title'    => "Latitude",
						'name'     => 'v_lat',
						'required' => 1,
						'type'     => 'text',
						'class'    => 'form-control',
						'value'    => '',
                        'data-geo' => 'lat'
					],
					[
						'title'    => "Longitude",
						'name'     => 'v_lon',
						'required' => 1,
						'type'     => 'text',
						'class'    => 'form-control',
						'value'    => '',
                        'data-geo' => 'lng'
					],
                    [
                        'title'    => "City",
                        'name'     => 'v_city',
                        'required' => 1,
                        'type'     => 'text',
                        'class'    => 'form-control',
                        'value'    => '',
                        'data-geo' => "administrative_area_level_2"
                    ],
                    [
                        'title'    => "Landmark",
                        'name'     => 'v_landmark',
                        'required' => 1,
                        'type'     => 'text',
                        'class'    => 'form-control',
                        'value'    => ''
                    ],
                    [
                        'title'    => "Services",
                        'name'     => 'v_services',
                        'required' => 1,
                        'type'     => 'text',
                        'class'    => 'form-control',
                        'value'    => ''
                    ],
                    [
                        'title'    => "Languages",
                        'name'     => 'v_languages',
                        'required' => 1,
                        'type'     => 'text',
                        'class'    => 'form-control',
                        'value'    => ''
                    ]/*,
					[
						'title'    => "Image 1",
						'name'     => 'v_img',
						'required' => 0,
						'type'     => 'file',
						'class'    => 'form-control',
						'value'    => ''
					]*/
				]
			];
			$data['action']          = SITEURLADM . 'submit/add_doctor';
			$this->view("Console/Doctor/Add.php", $data);
		}

		if ($action == 'edit' && $id>0)
		{
            $this->current['action'] = $action;
            $this->current['option'] = 'doctors-add';
            $this->page_title        = "Edit Doctor";
            $fill = $this->model->fetch_doc($id);
            $fill = $fill[0];
            $data['form']            = [
                'conf'   => [
                    'edit' => 1
                ],
                'inputs' => [
                    [
                        'title'    => "Clinic Name",
                        'name'     => 'v_clinic',
                        'required' => 1,
                        'type'     => 'text',
                        'class'    => 'form-control',
                        'value'    => $fill['v_clinic']
                    ],
                    [
                        'title'    => "Clinic Email",
                        'name'     => 'v_email',
                        'required' => 1,
                        'type'     => 'email',
                        'class'    => 'form-control',
                        'value'    => $fill['v_email']
                    ],
                    [
                        'title'    => "Phone",
                        'name'     => 'v_phone',
                        'required' => 1,
                        'type'     => 'text',
                        'class'    => 'form-control',
                        'value'    => $fill['v_phone']
                    ],
                    [
                        'title'    => "Address",
                        'name'     => 'v_address',
                        'required' => 1,
                        'type'     => 'text',
                        'class'    => 'form-control',
                        'value'    => $fill['v_address']
                    ],
                    [
                        'title'    => "City",
                        'name'     => 'v_city',
                        'required' => 1,
                        'type'     => 'text',
                        'class'    => 'form-control',
                        'value'    => $fill['v_city'],
                        'data-geo' => "administrative_area_level_2"
                    ],
                    [
                        'title'    => "Latitude",
                        'name'     => 'v_lat',
                        'required' => 1,
                        'type'     => 'text',
                        'class'    => 'form-control',
                        'value'    => $fill['v_lat'],
                        'data-geo' => 'lat'
                    ],
                    [
                        'title'    => "Longitude",
                        'name'     => 'v_lon',
                        'required' => 1,
                        'type'     => 'text',
                        'class'    => 'form-control',
                        'value'    => $fill['v_lon'],
                        'data-geo' => 'lng'
                    ],
                    [
                        'title'    => "Landmark",
                        'name'     => 'v_landmark',
                        'required' => 1,
                        'type'     => 'text',
                        'class'    => 'form-control',
                        'value'    => $fill['v_landmark']
                    ],
                    [
                        'title'    => "Services",
                        'name'     => 'v_services',
                        'required' => 1,
                        'type'     => 'text',
                        'class'    => 'form-control',
                        'value'    => $fill['v_services']
                    ],
                    [
                        'title'    => "Languages",
                        'name'     => 'v_languages',
                        'required' => 1,
                        'type'     => 'text',
                        'class'    => 'form-control',
                        'value'    => $fill['v_languages']
                    ]/*,
					[
						'title'    => "Image 1",
						'name'     => 'v_img',
						'required' => 0,
						'type'     => 'file',
						'class'    => 'form-control',
						'value'    => ''
					]*/
                ]
            ];
            $data['action']          = SITEURLADM . 'submit/edit_doctor/'.$id;
            $this->view("Console/Doctor/Edit.php", $data);
		}
	}

    public function supplier($action = 'view', $id=0)
    {
        $this->info              = $this->myvalues->admin_supplier;
        $this->load->model($this->info["model"], "model");
        if ($action == 'view')
        {
            $this->current['action'] = $action;
            $this->current['option'] = 'supplier-view';
            $this->current['filter_limit'] = 3;
            $this->page_title        = "View Suppliers";
            //$list                    = Supplier_model::list_docs();
            class_alias('Supplier_model', 'Model');
            $list                    = Supplier_model::list_supplier();
            $this->view("Console/Supplier/View.php", ["data" => $list]);
        }

        if ($action == 'add')
        {
            $this->current['action'] = $action;
            $this->current['option'] = 'supplier-add';
            $this->page_title        = "Add Supplier";
            $data['form']            = [
                'conf'   => [
                    'edit' => 0
                ],
                'inputs' => [
                    [
                        'title'    => "Name",
                        'name'     => 'v_name1',
                        'required' => 1,
                        'type'     => 'text',
                        'class'    => 'form-control',
                        'value'    => ''
                    ],
                    [
                        'title'    => "Personal Email",
                        'name'     => 'v_email1',
                        'required' => 1,
                        'type'     => 'email',
                        'class'    => 'form-control',
                        'value'    => ''
                    ],
                    [
                        'title'    => "Personal Phone",
                        'name'     => 'v_phone1',
                        'required' => 1,
                        'type'     => 'text',
                        'class'    => 'form-control',
                        'value'    => ''
                    ],
                    [
                        'title'    => "Password",
                        'name'     => 'v_password',
                        'required' => 1,
                        'type'     => 'password',
                        'class'    => 'form-control',
                        'value'    => ''
                    ],
                    [
                        'title'    => "Supplier Name",
                        'name'     => 'v_name',
                        'required' => 1,
                        'type'     => 'text',
                        'class'    => 'form-control',
                        'value'    => ''
                    ],
                    [
                        'title'    => "Work Email",
                        'name'     => 'v_email2',
                        'required' => 1,
                        'type'     => 'email',
                        'class'    => 'form-control',
                        'value'    => ''
                    ],
                    [
                        'title'    => "Phone",
                        'name'     => 'v_phone2',
                        'required' => 1,
                        'type'     => 'text',
                        'class'    => 'form-control',
                        'value'    => ''
                    ],
                    [
                        'title'    => "Address",
                        'name'     => 'v_address',
                        'required' => 1,
                        'type'     => 'text',
                        'class'    => 'form-control',
                        'value'    => ''
                    ],
                    [
                        'title'    => "Latitude",
                        'name'     => 'v_lat',
                        'required' => 1,
                        'type'     => 'text',
                        'class'    => 'form-control',
                        'value'    => '',
                        'data-geo' => 'lat'
                    ],
                    [
                        'title'    => "Longitude",
                        'name'     => 'v_lon',
                        'required' => 1,
                        'type'     => 'text',
                        'class'    => 'form-control',
                        'value'    => '',
                        'data-geo' => 'lng'
                    ],
                    [
                        'title'    => "City",
                        'name'     => 'v_city',
                        'required' => 1,
                        'type'     => 'text',
                        'class'    => 'form-control',
                        'value'    => '',
                        'data-geo' => "administrative_area_level_2"
                    ],
                    [
                        'title'    => "Landmark",
                        'name'     => 'v_landmark',
                        'required' => 1,
                        'type'     => 'text',
                        'class'    => 'form-control',
                        'value'    => ''
                    ]
                    /*,
					[
						'title'    => "Image 1",
						'name'     => 'v_img',
						'required' => 0,
						'type'     => 'file',
						'class'    => 'form-control',
						'value'    => ''
					]*/
                ]
            ];
            $data['action']          = SITEURLADM . 'submit/add_supplier';
            $this->view("Console/Supplier/Add.php", $data);
        }

        if ($action == 'edit' && $id>0)
        {
            $this->current['action'] = $action;
            $this->current['option'] = 'supplier-add';
            $this->page_title        = "Edit Supplier";
            $fill = Supplier_model::fetch_supplier($id);
            $fill = $fill[0];
            $data['form']            = [
                'conf'   => [
                    'edit' => 1
                ],
                'inputs' => [
                    [
                        'title'    => "Name",
                        'name'     => 'v_name',
                        'required' => 1,
                        'type'     => 'text',
                        'class'    => 'form-control',
                        'value'    => $fill['v_name']
                    ],
                    [
                        'title'    => "Email",
                        'name'     => 'v_email',
                        'required' => 1,
                        'type'     => 'email',
                        'class'    => 'form-control',
                        'value'    => $fill['v_email']
                    ],
                    [
                        'title'    => "Phone",
                        'name'     => 'v_phone',
                        'required' => 1,
                        'type'     => 'text',
                        'class'    => 'form-control',
                        'value'    => $fill['v_phone']
                    ],
                    [
                        'title'    => "Latitude",
                        'name'     => 'v_lat',
                        'required' => 1,
                        'type'     => 'text',
                        'class'    => 'form-control',
                        'value'    => $fill['v_lat']
                    ],
                    [
                        'title'    => "Longitude",
                        'name'     => 'v_lon',
                        'required' => 1,
                        'type'     => 'text',
                        'class'    => 'form-control',
                        'value'    => $fill['v_lon']
                    ],
                    [
                        'title'    => "Address",
                        'name'     => 'v_address',
                        'required' => 1,
                        'type'     => 'text',
                        'class'    => 'form-control',
                        'value'    => $fill['v_address']
                    ],
                    [
                        'title'    => "City",
                        'name'     => 'v_city',
                        'required' => 1,
                        'type'     => 'text',
                        'class'    => 'form-control',
                        'value'    => $fill['v_city'],
                        'data-geo' => "administrative_area_level_2"
                    ],
                    [
                        'title'    => "Latitude",
                        'name'     => 'v_lat',
                        'required' => 1,
                        'type'     => 'text',
                        'class'    => 'form-control',
                        'value'    => $fill['v_lat'],
                        'data-geo' => 'lat'
                    ],
                    [
                        'title'    => "Longitude",
                        'name'     => 'v_lon',
                        'required' => 1,
                        'type'     => 'text',
                        'class'    => 'form-control',
                        'value'    => $fill['v_lon'],
                        'data-geo' => 'lng'
                    ],
                    [
                        'title'    => "Landmark",
                        'name'     => 'v_landmark',
                        'required' => 1,
                        'type'     => 'text',
                        'class'    => 'form-control',
                        'value'    => $fill['v_landmark']
                    ],
                    /*,
					[
						'title'    => "Image 1",
						'name'     => 'v_img',
						'required' => 0,
						'type'     => 'file',
						'class'    => 'form-control',
						'value'    => ''
					]*/
                ]
            ];
            $data['action']          = SITEURLADM . 'submit/edit_supplier/'.$id;
            $this->view("Console/Supplier/Edit.php", $data);
        }
    }

    public function jobs($action='view', $doc_id=0)
    {
        $this->info              = $this->myvalues->admin_job;
        $this->load->model($this->info["model"], "model");
        $this->current['action'] = $action;
        $this->current['option'] = 'jobs-view';
        $this->current['filter_limit'] = 2;
        $this->page_title        = "View Jobs";
        $list                    = Jobs_model::get_jobs($doc_id);
        $this->view("Console/Jobs/View.php", ["data" => $list]);
    }

    public function product($type='', $id=0)
    {
        if(in_array($type, ['Doctor', 'Supplier']) && $type=='Doctor')
        {
            $this->info              = $this->myvalues->admin_product;
            $this->load->model($this->info["model"], "model");
            $fill['doc_id'] = $id;
            $fill['data'] = Product_model::by_doc($id);

            $this->current['action'] = 'view';
            $this->current['option'] = 'product-view-doc';
            $this->current['filter_limit'] = 3;
            $this->page_title        = "View Doctor's Products";
            $this->view("Console/Product/Doctor.php", ["data" => $fill]);

        }
        elseif (in_array($type, ['Doctor', 'Supplier']) && $type=='Supplier')
        {
            $this->info              = $this->myvalues->admin_product;
            $this->load->model($this->info["model"], "model");
            $fill['sup_id'] = $id;
            $fill['data'] = Product_model::by_sup($id);

            $this->current['action'] = 'view';
            $this->current['option'] = 'product-view-sup';
            $this->current['filter_limit'] = 3;
            $this->page_title        = "View Supplier's Products";
            $this->view("Console/Product/Supplier.php", ["data" => $fill]);
        }
        else
        {
            redirect(ADM_CONSOLE.'dashboard/?status=fail_over');
        }
    }

    public function detail($type='', $id=0)
    {
        if(in_array($type, ['Doctor', 'Supplier']) && $type=='Doctor' && $id>0)
        {
            $this->info              = $this->myvalues->admin_detail;
            $this->load->model($this->info["model"], "model");
            $fill['doc_id'] = $id;
            $fill['doctor_detail'] = Details::doctor_details($id);
            $fill['user_detail'] = Details::user_details($fill['doctor_detail'][0]['i_u_id']);
            $fill['jobs'] = Details::list_jobs($id);
            $fill['review'] = Details::fetch_doc_review($id);
            $fill['count'] = Details::count_param_doc($id);
            $fill['products'] = Details::doc_products($id);
            $fill['appoint']['data'] = Details::doc_appoint($id);
            $fill['appoint']['color']['Upcoming'] = 'label-success';
            $fill['appoint']['color']['Past'] = 'label-info';
            $fill['appoint']['color']['Cancelled'] = 'label-danger';

            $this->current['action'] = 'view';
            $this->current['option'] = 'doctors-view';
            $this->current['filter_limit'] = 3;
            $this->page_title        = "View Details";
            $this->view("Console/Details/Doctor.php", ["data" => $fill]);

        }
        elseif (in_array($type, ['Doctor', 'Supplier']) && $type=='Supplier' && $id)
        {
            $this->info              = $this->myvalues->admin_detail;
            $this->load->model($this->info["model"], "model");
            $fill['sup_id'] = $id;
            $fill['doctor_detail'] = Details::sup_details($id);
            $fill['user_detail'] = Details::user_details($fill['doctor_detail'][0]['i_u_id']);
            $fill['review'] = Details::fetch_sup_review($id);
            $fill['count'] = Details::count_param_sup($id);
            $fill['products'] = Details::sup_products($id);

            $this->current['action'] = 'view';
            $this->current['option'] = 'supplier-view';
            $this->current['filter_limit'] = 3;
            $this->page_title        = "View Details";
            $this->view("Console/Details/Supplier.php", ["data" => $fill]);
        }
        else
        {
            redirect(ADM_CONSOLE.'dashboard/?status=fail_over');
        }
    }

	public function reports($option = 'redeem')
	{
	    $this->info = $this->myvalues->admin_reports;
	    $this->load->model($this->info["model"], "model");
	    //pr($this->info);die;
	    if ($option == 'redeem')
	    {
	        $this->current['action'] = 'view';
			$this->current['filter_limit'] = 8;
	        $this->current['option'] = 'report-redeem';
	        $this->page_title        = "Report of Redeemed Coupons";
	        $list                    = $this->model->get_redeem_report();
	        //pr($list);die;
	        $this->view("Console/Reports/Redeem.php", ["data" => $list]);
	    }
		
		if ($option == 'purchase')
		{
			$this->current['action'] = 'view';
			$this->current['option'] = 'report-purchase';
			$this->page_title        = "Report of Purchase";
			$this->current['filter_limit'] = 7;
			$list                    = $this->model->get_purchase_report();
			$this->view("Console/Reports/Purchase.php", ["data" => $list]);
		}
	}

}