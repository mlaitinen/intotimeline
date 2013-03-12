<?php
/**
* @module		Art Timeline
* @copyright	Copyright (C) 2010 artetics.com
* @license		GPL
*/ 


defined( '_JEXEC' ) or die( 'Restricted access' );

class TableArtEvent extends JTable
{
	var $id = null;
	var $timeline_id = null;
	var $title = null;
	var $description = null;
	var $start_date = null;
	var $end_date = null;
	var $latest_start = null;
	var $earliest_end = null;
	var $image = null;
	var $link = null;
	var $modified = null;
	var $modifiedby = null;
	var $category = null;
	
	function __construct(&$db)
	{
		parent::__construct( '#__art_tl_event', 'id', $db );
		
	}
}

?>