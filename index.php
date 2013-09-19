<?php


if (!session::checkAccessControl('menus_allow_edit')){
    return;
}

template::setTitle(lang::translate('Sort menu'));
settings_menu::displaySortItems();
