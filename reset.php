<?php

use diversen\html\helpers as html_helpers;
use diversen\moduleinstaller;
/**
 * view functions for settings/menu
 *
 * @package settings
 */

if (!session::checkAccessFromModuleIni('menus_allow_edit')){
    return;
}

http::prg();

if (isset($_POST['submit']) ) {
    menus_reset_menus();
    echo lang::translate('Menu has been reset');
} else {
    echo html_helpers::confirmForm(lang::translate('Confirm reset'));
}


function menus_reset_menus () {
    $modules = moduleloader::getInstalledModuleNames();
   
    //print_r($sections); die;
    foreach ($modules as $module) {
        $mod = new moduleinstaller($options = array ('module' => $module));
        $mod->deleteMenuItem();
        $mod->insertMenuItem();
    }
}
