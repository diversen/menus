<?php

use diversen\lang;

$_MODULE_MENU = array (
    array(
        'title' => lang::translate('Sort menu', null ,array ('no_translate' => true)),
        'url' => '/menus/index',
        'auth' => 'admin'
    ),
    
    array(
        'title' => lang::translate('Edit titles', null ,array ('no_translate' => true)),
        'url' => '/menus/edit',
        'auth' => 'admin'
    ),
    
    array(
        'title' => lang::translate('Reset menus', null ,array ('no_translate' => true)),
        'url' => '/menus/reset',
        'auth' => 'admin'
    ),

);
 