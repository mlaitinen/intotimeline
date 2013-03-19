<?php

/**
 * @module		Into Timeline
 * @copyright	Copyright (C) 2010 artetics.com
 * @copyright	Copyright (C) 2013 Miku Laitinen
 * @license	GPL
 */
defined('_JEXEC') or die('Restricted access');

class TableTimeline extends JTable {

    var $id = null;
    var $name = null;
    var $description = null;
    var $published = null;
    var $access = null;
    var $datetime_format = null;
    var $theme = null;
    var $interval_unit = null;
    var $interval_pixel = null;
    var $start_date = null;
    var $scroll_start_date = null;
    var $scroll_end_date = null;
    var $width = null;
    var $direction = null;
    var $bubble_width = null;
    var $bubble_height = null;
    var $event_img = null;
    var $event_line_color = null;
    var $event_imprecise_color = null;
    var $event_imprecise_opacity = null;
    var $event_duration_color = null;
    var $event_duration_opacity = null;
    var $event_duration_imprecise_color = null;
    var $event_duration_imprecise_opacity = null;
    var $modified = null;
    var $modifiedby = null;
    var $last_generated = null;
    var $file = null;
    var $query = null;

    function __construct(&$db) {
        parent::__construct('#__tl_timeline', 'id', $db);
    }

}

?>