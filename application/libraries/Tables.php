<?php

/**
 * Created by PhpStorm.
 * User: Hardik
 * Date: 16-06-2017
 * Time: 13:40
 */
class Tables
{
	var $loginDetails = [
		"controller" => "login",
		"model" => "login_model"
	];
	var $logoutDetails = [
		"controller" => "logout",
		"model" => ""
	];
	
	var $dashboardDetails = [
		"controller" => "dashboard",
		"model" => "dashboard_model"
	];
	
	var $businessDetails = [
		"controller" => "business",
		"model" => "business_model"
	];
	
	var $registrationDetails = [
		"controller" => "registration",
		"model" => "registration_model"
	];
	
	var $userDetails = [
		"controller" => "user",
		"model" => "user_model"
	];
	
	var $changePasswordDetails = [
		"controller" => "change_password",
		"model" => "change_password_model"
	];
}