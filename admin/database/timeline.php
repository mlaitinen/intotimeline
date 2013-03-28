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
    var $bubble_width = 320;
    var $bubble_height = 120;
    var $event_img = 'dull-blue-circle.png';
    var $event_line_color = '#58A0DC';
    var $event_imprecise_color = '#58A0DC';
    var $event_imprecise_opacity = 20;
    var $event_duration_color = '#58A0DC';
    var $event_duration_opacity = 100;
    var $event_duration_imprecise_color = '#58A0DC';
    var $event_duration_imprecise_opacity = 100;
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