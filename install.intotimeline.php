<?php

/**
 * @module		Into Timeline
 * @copyright	Copyright (C) 2010 artetics.com
 * @copyright	Copyright (C) 2013 Miku Laitinen
 * @license	GPL
 */
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
define('JPATH_BASE', dirname(__FILE__));

jimport('joomla.application.component.controller');

function com_install() {
    updateMenuIcons();
    updateCategories();
    return true;
}

function updateMenuIcons() {
    $db = & JFactory::getDBO();
    $queries = array();
    $queries[] = 'UPDATE `#__components` SET admin_menu_img= "../administrator/components/com_intotimeline/images/artetics_logo.png" WHERE admin_menu_link="option=com_intotimeline"';
    $queries[] = 'UPDATE `#__components` SET admin_menu_img= "../includes/js/ThemeOffice/categories.png" WHERE admin_menu_link="option=com_intotimeline&task=timeline_list"';
    $queries[] = 'UPDATE `#__components` SET admin_menu_img= "../includes/js/ThemeOffice/categories.png" WHERE admin_menu_link="option=com_intotimeline&task=category_list"';
    $queries[] = 'UPDATE `#__components` SET admin_menu_img= "../includes/js/ThemeOffice/content.png" WHERE admin_menu_link="option=com_intotimeline&task=event_list"';
    $queries[] = 'UPDATE `#__components` SET admin_menu_img= "../includes/js/ThemeOffice/controlpanel.png" WHERE admin_menu_link="option=com_intotimeline&task=settings"';
    $queries[] = 'UPDATE `#__components` SET admin_menu_img= "../includes/js/ThemeOffice/tooltip.png" WHERE admin_menu_link="option=com_intotimeline&task=help"';

    $db->setQuery(join($queries, ';'));
    $db->queryBatch();
}

function updateCategories() {
    $db = & JFactory::getDBO();

    $queries = array();

    $queries[0] = "ALTER TABLE #__tl_event ADD COLUMN `category` int(11)";
    $queries[1] = "ALTER TABLE #__tl_timeline ADD COLUMN `scroll_start_date` datetime";
    $queries[2] = "ALTER TABLE #__tl_timeline ADD COLUMN `scroll_end_date` datetime";
    $queries[3] = "ALTER TABLE #__tl_timeline ADD COLUMN `scroll_end_date` datetime";
    $db->setQuery($queries[0]);
    $db->query();
    $db->setQuery($queries[1]);
    $db->query();
    $db->setQuery($queries[2]);
    $db->query();
    $db->setQuery($queries[3]);
    $db->query();

    $queries = array();
    $queries[] = "ALTER TABLE #__tl_event ADD COLUMN `category` int(11)";
    $db->setQuery(join($queries, ';'));
    @$db->queryBatch();

    $query4 = "ALTER TABLE #__tl_setting ADD COLUMN `bubbletype` tinyint(1);";
    $db->setQuery($query4);
    @$db->query();

    $query4 = "ALTER TABLE `#__tl_timeline` ADD COLUMN `query` text;";
    $db->setQuery($query4);
    @$db->query();

    $query4 = "ALTER TABLE `#__tl_event` ADD COLUMN `latest_start` datetime;";
    $db->setQuery($query4);
    @$db->query();

    $query4 = "ALTER TABLE `#__tl_event` ADD COLUMN `earliest_end` datetime;";
    $db->setQuery($query4);
    @$db->query();

    $query4 = "ALTER TABLE `#__tl_category` ADD COLUMN `event_duration_imprecise_color` varchar(10);";
    $db->setQuery($query4);
    @$db->query();

    $query4 = "ALTER TABLE `#__tl_category` ADD COLUMN `event_duration_imprecise_opacity` varchar(10);";
    $db->setQuery($query4);
    @$db->query();

    $query4 = "ALTER TABLE `#__tl_timeline` MODIFY COLUMN `scroll_start_date` varchar(255);";
    $db->setQuery($query4);
    @$db->query();

    $query4 = "ALTER TABLE `#__tl_timeline` MODIFY COLUMN `scroll_end_date` varchar(255);";
    $db->setQuery($query4);
    @$db->query();

    $query4 = "ALTER TABLE `#__tl_timeline` MODIFY COLUMN `start_date` varchar(255);";
    $db->setQuery($query4);
    @$db->query();
}

?>