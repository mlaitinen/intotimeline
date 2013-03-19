<?php
/**
 * @module		Into Timeline
 * @copyright	Copyright (C) 2010 artetics.com
 * @copyright	Copyright (C) 2013 Miku Laitinen
 * @license	GPL
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

class TableCategory extends JTable
{
	var $id = null;
	var $name = null;
	var $event_img = null;
	var $event_text_color = null;
	var $event_duration_color = null;
	var $event_duration_imprecise_color = null;
	var $event_duration_imprecise_opacity = null;
	var $enabled = null;
	
	function __construct(&$db)
	{
		parent::__construct( '#__tl_category', 'id', $db );
		
	}
}

?>