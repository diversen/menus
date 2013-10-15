<?php


if (!session::checkAccessFromModuleIni('menus_allow_edit')){
    return;
}

template::setTitle(lang::translate('Sort menu'));
settings_menu::displaySortItems();
