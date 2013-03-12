<?php
/**
* @module		Art Timeline
* @copyright	Copyright (C) 2010 artetics.com
* @license		GPL
*/ 


defined( '_JEXEC' ) or die( 'Restricted access' );

class TableArtBand extends JTable
{
	var $id = null;
	var $timeline_id = null;
	var $name = null;
	var $interval_unit = null;
	var $interval_pixel = null;
	
	function __construct(&$db)
	{
		parent::__construct( '#__art_tl_band', 'id', $db );
		
	}
}

?>