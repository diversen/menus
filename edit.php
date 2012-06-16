<?php

/**
 * view functions for settings/menu
 *
 * @package settings
 */
if (!session::checkAccessControl('menus_allow_edit')){
    return;
}

template::setJs('/js/jquery.jeditable.js');

$indicator = lang::translate('menus_edit_indicator');
$saving = lang::translate('menus_edit_saving');

?>
<script>
$(document).ready(function() {
     $('.edit').editable('/menus/menu_update', {
         indicator : 'Saving...',
         tooltip   : 'Click to edit...'
     });
     /*
     $('.edit_area').editable('http://www.example.com/save.php', { 
         type      : 'textarea',
         cancel    : 'Cancel',
         submit    : 'OK',
         indicator : '<img src="img/indicator.gif">',
         tooltip   : 'Click to edit...'
     }); */
 });
</script>
 <?php

$sections = systemMenu::getAllMenuAsSections();
//print_r($sections['main']);
$str = '';
foreach ($sections['main'] as $val) {
    $current = lang::translate($val['title']);
    //echo $current . "<br />\n";
    //echo html::createLink('#', , $options)
    //echo html::createLink('#', $current,
    //        array ('class' => 'edit', 'id' => "id_$val[id]")
    //);
    //$item = lang::translate()
    $str.= <<<EOF
<div class="edit" id = "id_$val[id]">$current</div><br />
EOF;
    
}

echo $str;