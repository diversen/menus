<?php

use diversen\lang;

$_MODULE_MENU = array (
    array(
        'title' => lang::translate('Sort menu'),
        'url' => '/menus/index',
        'auth' => 'admin'
    ),
    
    array(
        'title' => lang::translate('Edit titles'),
        'url' => '/menus/edit',
        'auth' => 'admin'
    ),
    
    array(
        'title' => lang::translate('Reset menus'),
        'url' => '/menus/reset',
        'auth' => 'admin'
    ),

);
 