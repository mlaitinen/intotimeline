<?php
/**
 * @module		Into Timeline
 * @copyright	Copyright (C) 2010 artetics.com
 * @copyright	Copyright (C) 2013 Miku Laitinen
 * @license	GPL
 */

defined('_JEXEC') or die('Direct Access to this location is not allowed.');

global $option;
$compdir = 'components/' . $option;

/* @var $doc JDocument */
$doc =& JFactory::getDocument();
$doc->addStyleSheet($compdir . '/css/timeline.css');

require_once(JPATH_COMPONENT . DS . 'controller.php');

$controller = new IntoTimelineController();
$controller->execute(JRequest::getVar('task'), 'display');
$controller->redirect();

?>