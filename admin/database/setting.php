<?php
/**
 * @module		Into Timeline
 * @copyright	Copyright (C) 2010 artetics.com
 * @copyright	Copyright (C) 2013 Miku Laitinen
 * @license	GPL
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

class TableSetting extends JTable
{
	var $id = null;
	var $autogenerate = null;
	var $container_id = null;
	var $container_style = null;
	var $title = null;
	var $display_description = null;
	var $customJS = null;
	var $bubbletype = null;
	
	function __construct(&$db)
	{
		parent::__construct( '#__tl_setting', 'id', $db );
	}
}

?>