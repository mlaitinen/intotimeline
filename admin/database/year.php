<?php

/**
 * @module		Into Timeline
 * @copyright	Copyright (C) 2010 artetics.com
 * @copyright	Copyright (C) 2013 Miku Laitinen
 * @license	GPL
 */
defined('_JEXEC') or die('Restricted access');

class TableYear extends JTable {

    var $id = null;
    var $year = null;

    function __construct(&$db) {
        parent::__construct('#__tl_year', 'id', $db);
    }

}

?>