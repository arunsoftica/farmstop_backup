<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/
//hooks defination
$hook['display_override'] = array(
        'class'    => 'ReplaceToken',
        'function' => 'replacePlaceholderCode',
        'filename' => 'ReplaceToken.php',
        'filepath' => 'hooks'
        //'params'   => array('beer', 'wine', 'snacks')
);
$hook['pre_controller'][] = array(
        'class'    => 'CheckSession',
        'function' => 'myFunction',
        'filename' => 'CheckSession.php',
        'filepath' => 'hooks',
        'params' => array('beer', 'wine', 'snacks')
        //'params'   => array('beer', 'wine', 'snacks')
);