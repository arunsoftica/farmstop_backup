<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	/*'username' => 'ilaqadgr_testing',
	'password' => '}[jeLOc7ntN*',
	'database' => 'ilaqadgr_testing',*/
	'username' => 'ilaqadgr_newfarm',
	'password' => '5Zapb9SIe@Ps',
	'database' => 'ilaqadgr_newfarm',
	/*'username' => 'root',
	'password' => '',
	'database' => 'farmstopnew',*/
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
