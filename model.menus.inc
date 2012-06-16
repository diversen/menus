<?php

/**
 * model file for menus
 *
 * @package     menus
 *
 */

 /**
  * class for manipulating  main menu
  *
  * @package    menus
  */
moduleLoader::includeModule('system/menu');
class menus {

    /**
     * method for updating main menu
     *
     * @todo    return something usefull
     */
    function updateMenuTitles (){

        $db = new db();
        self::$dbh->beginTransaction();
        foreach ($_POST as $key => $val){
            $sql = "UPDATE `menus` SET `title`= '$val' WHERE `id` = '$key'";
            $stmt = $db->rawQuery($sql);
            $stmt->execute();
        }

        self::$dbh->commit();
    }
    
    public static function resetMenuItems () {
        
    }
    
    public static function displaySortItems(){

        self::viewAdminDropdown();
        $sections = systemMenu::getAllMenuAsSections();
        moduleLoader::includeModule ('jquerysort');
        
        $options = array ();
        $options['table'] = 'menus';       
        $options['field'] = 'weight';
        $options['title'] = 'title';
        
        if (!isset($_GET['menus_filter'])) {        
            $options['items'] = $sections['main'];
        } else {
            $options['items'] = $sections[$_GET['menus_filter']];
        }
        $options['translate'] = false;
        //jquerysort::setTable(self::$table);
        jquerysort::setOptions($options);
        jquerysort::setJs();
        echo jquerysort::getHTML();
    }
    
    public static function viewAdminDropdown () {

        $rows = systemMenu::getSectionsForDropdown();
        $extras = array('onChange' => "this.form.submit()");
        
        if (isset($_GET)) $_GET = html::specialEncode ($_GET);
        
        html::$autoLoadTrigger = 'submit';
        html::init($_GET);
        html::formStart('menus_dropdown', 'get');
        html::legend(lang::translate('menus_filter'));
        html::select('menus_filter', $rows, 'title', 'id', null, $extras);
        html::formEnd();
        echo html::getStr();
        echo "<br />\n";
    }   
}