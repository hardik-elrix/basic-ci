<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

/**
 * This file is for Keeping Tablenames in single place and can be used as CONSTANT
 */

//system required tables
define("TABLE_USERS", "sys_users");

define("TABLE_APP_DEVICES", "app_devices");

define("TABLE_APP_USERS", "app_users_list");
define("TABLE_APP_DOCTORS", "app_doc_list");
define("TABLE_APP_SUPPLIER", "app_sup_list");

define("TABLE_JOBS", "app_jobs");
define("TABLE_JOBS_APPLY", "app_jobs_apply");

define("TABLE_DOCTOR_PRODUCTS", "app_doc_products");
define("TABLE_SUPPLIER_PRODUCTS", "app_sup_products");

define("TABLE_APP_DOC_PENDING", "app_doc_pending");
define("TABLE_APP_SUP_PENDING", "app_sup_pending");

define("TABLE_DOC_REVIEW", "app_doc_review");
define("TABLE_SUP_REVIEW", "app_sup_review");

define("TABLE_USERS_CART", "app_users_cart");
define("TABLE_DOC_CART", "app_doc_cart");

define("TABLE_DOC_APPOINTMENT", "app_doc_appointment");