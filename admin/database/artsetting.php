<?php
/**
* @module		Art Timeline
* @copyright	Copyright (C) 2010 artetics.com
* @license		GPL
*/ 


defined( '_JEXEC' ) or die( 'Restricted access' );

class TableArtSetting extends JTable
{
	var $id = null;
	var $autogenerate = null;
	var $container_id = null;
	var $container_style = null;
	var $title = null;
	var $display_description = null;
	var $customJS = null;
	var $not_published_text = null;
	var $not_generated_text = null;
	var $no_permissions_text = null;
	var $no_published_timelines_text = null;
	var $bubbletype = null;
	
	function __construct(&$db)
	{
		parent::__construct( '#__art_tl_setting', 'id', $db );
	}
}

?>