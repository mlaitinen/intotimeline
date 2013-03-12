<?php
/**
* @module		Art Timeline
* @copyright	Copyright (C) 2010 artetics.com
* @license		GPL
*/ 

defined( '_JEXEC' ) or die( 'Restricted access' );

class TableArtCategory extends JTable
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
		parent::__construct( '#__art_tl_category', 'id', $db );
		
	}
}

?>