<?php

namespace modules\menus;

use diversen\db;
use diversen\db\q;
use diversen\html;
use diversen\html\helpers;
use diversen\http;
use diversen\lang;
use diversen\moduleinstaller;
use diversen\moduleloader;
use diversen\session;
use diversen\template;
use diversen\template\assets;

use modules\jquerysort\module as jquerysort;
use modules\system\menu\module as menuModule;
/**
 * class for manipulating  main menu
 *
 * @package    menus
 */
//moduleloader::includeModule('system/menu');

class module {

    public function indexAction() {
        if (!session::checkAccessFromModuleIni('menus_allow_edit')) {
            return;
        }

        template::setTitle(lang::translate('Sort menu'));
        self::displaySortItems();
    }

    public function editAction() {

        if (!session::checkAccessFromModuleIni('menus_allow_edit')) {
            return;
        }

        assets::setJs('/bower_components/jeditable/jquery.jeditable.js');

        $indicator = lang::translate('Saving item ... ');
        $tooltip = lang::translate('Click to edit');
        ?>
        <script>
            $(document).ready(function () {
                $('.edit').editable('/menus/update', {
                    indicator: '<?= $indicator ?>',
                    tooltip: '<?= $tooltip ?>'
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
        $sections = menuModule::getAllMenuAsSections();

        $str = '';
        foreach ($sections['main'] as $val) {
            $current = $val['title'];
            $str.= <<<EOF
<div class="edit" id = "id_$val[id]">$current</div><br />
EOF;
        }

        echo $str;
    }

    public function resetAction() {
        /**
         * view functions for settings/menu
         *
         * @package settings
         */
        if (!session::checkAccessFromModuleIni('menus_allow_edit')) {
            return;
        }

        http::prg();

        if (isset($_POST['submit'])) {
            self::reset();
            echo lang::translate('Menu has been reset');
        } else {
            echo helpers::confirmForm(lang::translate('Confirm reset'));
        }
    }

    public function updateAction() {
        if (!session::checkAccessFromModuleIni('menus_allow_edit')) {
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
            $values = array('title_human' => $str);
            $db->update('menus', $values, $id);
        }

        die;
    }

    static function reset() {

        q::delete('menus')->exec(); 
        $modules = moduleloader::getInstalledModuleNames();
     
        foreach ($modules as $module) {
            $mod = new moduleinstaller($options = array('module' => $module));
            $mod->insertMenuItem();
        }
    }

    /**
     * method for updating main menu
     *
     * @todo    return something usefull
     */
    function updateMenuTitles() {

        $db = new db();
        self::$dbh->beginTransaction();
        foreach ($_POST as $key => $val) {
            $sql = "UPDATE `menus` SET `title`= '$val' WHERE `id` = '$key'";
            $stmt = $db->rawQuery($sql);
            $stmt->execute();
        }

        self::$dbh->commit();
    }


    public static function displaySortItems() {
        
        self::viewAdminDropdown();
        $sections = menuModule::getAllMenuAsSections();
        
        $options = array();
        $options['table'] = 'menus';
        $options['field'] = 'weight';
        $options['title'] = 'title';

        if (!isset($_GET['menus_filter'])) {
            $options['items'] = $sections['main'];
        } else {
            $options['items'] = $sections[$_GET['menus_filter']];
        }
        $options['translate'] = false;

        jquerysort::setOptions($options);
        jquerysort::setJs();
        echo jquerysort::getHTML();
    }

    public static function viewAdminDropdown() {

        $rows = menuModule::getSectionsForDropdown();
        $extras = array('onChange' => "this.form.submit()");

        if (isset($_GET))
            $_GET = html::specialEncode($_GET);

        html::$autoLoadTrigger = 'submit';
        html::init($_GET);
        html::formStart('menus_dropdown', 'get');
        html::legend(lang::translate('Pick menu section'));
        html::select('menus_filter', $rows, 'title', 'id', null, $extras);
        html::formEnd();
        echo html::getStr();
        echo "<br />\n";
    }
}
