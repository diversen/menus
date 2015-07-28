<?php

/**
 * view functions for settings/menu
 *
 * @package settings
 */
if (!session::checkAccessFromModuleIni('menus_allow_edit')){
    return;
}

template::setJs('/bower_components/jeditable/jquery.jeditable.js');

$indicator = lang::translate('Saving item ... ');
$tooltip = lang::translate('Click to edit');

?>
<script>
$(document).ready(function() {
     $('.edit').editable('/menus/menu_update', {
         indicator : '<?=$indicator?>',
         tooltip   : '<?=$tooltip?>'
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

echo "<p>" . lang::translate('Click on the menu items and edit them. Empty will delete') . "</p>";
$sections = system_menu::getAllMenuAsSections();
//print_r($sections['main']);
$str = '';
foreach ($sections['main'] as $val) {
    $current = $val['title'];

    $str.= <<<EOF
<div class="edit" id = "id_$val[id]">$current</div><br />
EOF;
    
}

echo $str;