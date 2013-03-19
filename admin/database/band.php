<?php
/**
 * @module		Into Timeline
 * @copyright	Copyright (C) 2010 artetics.com
 * @copyright	Copyright (C) 2013 Miku Laitinen
 * @license	GPL
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

class TableBand extends JTable
{
	var $id = null;
	var $timeline_id = null;
	var $name = null;
	var $interval_unit = null;
	var $interval_pixel = null;
	
	function __construct(&$db)
	{
		parent::__construct( '#__tl_band', 'id', $db );
		
	}
}

?>