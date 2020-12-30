<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['logout'] = "User/logout";
$route['export'] = "User/export";
$route['(:any)'] = "User/page/$1";
//$route['(:any)/(:any)'] = "User/page2/$1";

$route['superadmin/(:any)'] = "SuperAdmin/page/$1";
$route['teacher/(:any)'] = "Teacher/page/$1";
$route['default_controller'] = 'User';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

