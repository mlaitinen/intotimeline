<?php
/**
 * @module		Into Timeline
 * @copyright	Copyright (C) 2010 artetics.com
 * @copyright	Copyright (C) 2013 Miku Laitinen
 * @license	GPL
 */

defined('_JEXEC') or die('Direct Access to this location is not allowed.');
error_reporting(E_ERROR); 
JTable::addIncludePath(JPATH_COMPONENT.DS.'database');
require_once(JPATH_COMPONENT.DS.'controller.php');

$controller = new TimelineController();
$task = JRequest::getCmd('task');
$controller->registerDefaultTask('timeline_list');
$controller->execute($task);
$controller->redirect();
TimelineController::addSubmenu();

?>