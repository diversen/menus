<?php

/**
 * Install file for settings
 *
 * @package     menus
 */
$_INSTALL['MAIN_MENU_ITEM'] = array (
    'title' => 'menus_main_menu_title',
    'url' => '/menus/index',
    'auth' => 'admin',
    'module_name' => 'menus',
    'parent' => 0,
    'weight' => 3,
    'admin_only' => true,
    'section' => 'settings'
);

$_INSTALL['VERSION'] = 1.70;

$_INSTALL['PUBLIC_CLONE_URL'] = 'git://github.com/diversen/menus.git';
$_INSTALL['PRIVATE_CLONE_URL'] = 'git@github.com:diversen/menus.git';

