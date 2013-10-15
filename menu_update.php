<?php

if (!session::checkAccessFromModuleIni('menus_allow_edit')){
    return;
}

$id = str_replace('id_', '', $_POST['id']);
$str = htmlspecialchars($_POST['value']);

$db = new db();
if (empty($str)) {
    echo lang::translate('Menu item deleted');
    $db->delete('menus', 'id', $id);
} else {
    echo $str;
    $values = array ('title_human' => $str);
    $db->update('menus', $values, $id);
}

die;