<?php
/**
* @module		Art Timeline
* @copyright	Copyright (C) 2010 artetics.com
* @license		GPL
*/ 


defined( '_JEXEC' ) or die( 'Restricted access' );

class TableArtYear extends JTable
{
	var $id = null;
	var $year = null;
	
	function __construct(&$db)
	{
		parent::__construct( '#__art_tl_year', 'id', $db );
		
	}
}

?>