<?php

//echo $_POST['id'];
$id = str_replace('id_', '', $_POST['id']);
echo $str = htmlspecialchars($_POST['value']);

$db = new db();
$values = array ('title_human' => $str);
$db->update('menus', $values, $id);
//cos_error_log($str);
die;