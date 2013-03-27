<?php

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

class IntotimelineModelTimelines extends JModel {

	function getTimelines() {
        $query = 'SELECT * FROM #__tl_timeline WHERE published = 1';
        return $this->_getList($query);
	}
    
}
?>
