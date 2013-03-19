<?php
/**
 * @module		Into Timeline
 * @copyright	Copyright (C) 2010 artetics.com
 * @copyright	Copyright (C) 2013 Miku Laitinen
 * @license	GPL
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

class TableEvent extends JTable
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
		parent::__construct( '#__tl_event', 'id', $db );
		
	}
}

?>