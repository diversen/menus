<?php

/**
 * view functions for settings/menu
 *
 * @package settings
 */

if (!session::checkAccessControl('menus_allow_edit')){
    return;
}

http::prg();

if (isset($_POST['submit']) ) {
    menus_reset_menus();
    echo lang::translate('menus_reset_done');
} else {
    echo formHelpers::confirmForm(lang::translate('menus_confirm_reset'));
}


function menus_reset_menus () {
    $modules = moduleloader::getInstalledModuleNames();
   
    //print_r($sections); die;
    foreach ($modules as $module) {
        $mod = new moduleInstaller($options = array ('module' => $module));
        $mod->deleteMenuItem();
        $mod->insertMenuItem();
    }
}
