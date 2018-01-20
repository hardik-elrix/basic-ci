<?php
/**
 * Created by PhpStorm.
 * User: vaio
 * Date: 12/27/2017
 * Time: 5:25 PM
 */

class Form {
	public static $CI;
	
	function __construct()
	{
		if (get_parent_class($this) == TRUE)
		{
			parent::__construct();
		}
		self::$CI =& get_instance();
	}
	
	public static $form_tag = [
		'enctype' => 'multipart',
		'action'  => '',
		'method'  => 'POST'
	
	];
	
	public static $conf = [];
	
	public static function input($params)
	{
		if ($params['type'] == 'hidden')
		{
			echo form_hidden($params['name'], $params['value']);
			return;
		}
		$params['data-selector'] = 'form-element';
		if ( ! isset($params['id']) || empty($params['id']))
		{
			$params['id'] = $params['name'];
		}
		$conf['placeholder'] = $params['title'];
		if ($params['required'] == 1)
		{
			$params['required'] = 'required';
		}
		else
		{
			unset($params['required']);
		}
		
		echo '<div class="form-group">';
		echo '<label class="col-sm-2 control-label">' . ucfirst($params['title']) . '</label>';
		echo '<div class="col-sm-10">';
		
		if ($params['type'] == 'text' || $params['type'] == 'file' || $params['type'] == 'password')
		{
			if ($params['type'] == 'text')
			{
				unset($params['type']);
			}
			echo form_input($params);
		}
		elseif ($params['type'] == 'email')
		{
			echo form_input($params);
		}
        elseif ($params['type'] == 'password')
        {
            echo form_input($params);
        }
		elseif ($params['type'] == 'select')
		{
			echo form_dropdown($params['name'], $params['options'], $params['selected']);
		}
		
		echo '</div></div>';
	}
	
	public static function button($params)
	{
		$conf = $params;
		if ( ! isset($params['title']) || empty($params['title']))
		{
			$conf['content'] = 'Save';
		}
		
		echo form_button($conf);
	}
}