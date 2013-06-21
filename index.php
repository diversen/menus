<?php


if (!session::checkAccessControl('menus_allow_edit')){
    return;
}

template::setTitle(lang::translate('menus_menu_sort'));
settings_menu::displaySortItems();
