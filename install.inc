<?php

use diversen\lang;
/**
 * Install file for settings
 *
 * @package     menus
 */
$_INSTALL['MAIN_MENU_ITEM'] = array (
    'title' => lang::translate('Menus', null ,array ('no_translate'=> true)),
    'url' => '/menus/index',
    'auth' => 'admin',
    'module_name' => 'menus',
    'parent' => 0,
    'weight' => 3,
    'admin_only' => true,
    'section' => 'settings'
);

$_INSTALL['VERSION'] = 4.01;

$_INSTALL['PUBLIC_CLONE_URL'] = 'git://github.com/diversen/menus.git';
$_INSTALL['PRIVATE_CLONE_URL'] = 'git@github.com:diversen/menus.git';

