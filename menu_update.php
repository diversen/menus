<?php

//echo $_POST['id'];
$id = str_replace('id_', '', $_POST['id']);
$str = htmlspecialchars($_POST['value']);

$db = new db();
if (empty($str)) {
    echo lang::translate('menus_menu_item_removed');
    $db->delete('menus', 'id', $id);
} else {
    echo $str;
    $values = array ('title_human' => $str);
    $db->update('menus', $values, $id);
}

die;