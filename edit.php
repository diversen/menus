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
$tooltip = lang::translate('menus_edit_tooltip');

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

echo "<p>" . lang::translate('menus_menu_edit_help') . "</p>";
$sections = systemMenu::getAllMenuAsSections();
//print_r($sections['main']);
$str = '';
foreach ($sections['main'] as $val) {
    $current = $val['title'];

    $str.= <<<EOF
<div class="edit" id = "id_$val[id]">$current</div><br />
EOF;
    
}

echo $str;