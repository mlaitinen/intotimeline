<?php
/**
* @module		Art Timeline
* @copyright	Copyright (C) 2010 artetics.com
* @license		GPL
*/ 

defined('_JEXEC') or die('Direct Access to this location is not allowed.');
error_reporting(E_ERROR); 
JTable::addIncludePath(JPATH_COMPONENT.DS.'database');
require_once(JPATH_COMPONENT.DS.'controller.php');

$controller = new ArtTimelineController();
$task = JRequest::getCmd('task');
$controller->registerDefaultTask('timeline_list');
$controller->execute($task);
$controller->redirect();
ArtTimelineController::addSubmenu();

?>