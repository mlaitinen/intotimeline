<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');

class IntotimelineModelTimeline extends JModel {

    var $_id;

    function __construct() {
        parent::__construct();
        $this->_id = JRequest::getInt('id');
    }

    function getTimeline() {
        $timeline = & JTable::getInstance('timeline', 'Table');
        $timeline->load($this->_id);

        return $timeline;
    }

    function getTimelinejson() {
        $db = & JFactory::getDBO();
        $row = & JTable::getInstance('timeline', 'Table');
        $row->load($this->_id);
        
        if ($row->query) {
            $db->setQuery($row->query);
        } else {
            $db->setQuery("SELECT E.id, E.title, E.description, E.timeline_id, E.start_date, E.end_date, E.latest_start, E.earliest_end, E.image, E.link, E.category, T.datetime_format FROM #__tl_event E INNER JOIN #__tl_timeline T ON E.timeline_id = T.id WHERE timeline_id = " . $this->_id);
        }
        
        $rows = $db->loadObjectList();

        $data = '';
        $i = 1;
        $itemsCount = count($rows);
        foreach ($rows as $row) {
            $image = $row->image;
            if ($image && strstr($image, 'http:') === false && strstr($image, 'www.') === false) {
                $image = JURI::root() . $image;
            }
            $row->description = $this->_prepare_description($row->description);
            $row->title = $this->_prepare_description($row->title);
            $doAdd = false;
            if ($row->category && $row->category != '-1') {
                $category = & JTable::getInstance('category', 'Table');
                $category->load($row->category);
                if ($category->enabled) {
                    $doAdd = true;
                    $data .= "{";
                    if ($category->event_img) {
                        $data .= "'icon': '" . JURI::root() . 'components/com_intotimeline/img/' . $category->event_img . "',";
                    }
                    if ($category->event_text_color) {
                        $data .= "'textColor': '" . $category->event_text_color . "',";
                    }
                    if ($category->event_duration_color) {
                        $data .= "'color': '" . $category->event_duration_color . "',";
                    }
                    if ($category->event_duration_imprecise_color) {
                        $data .= "'impreciseColor': '" . $category->event_duration_imprecise_color . "',";
                    }
                    if ($category->event_duration_imprecise_opacity) {
                        $data .= "'impreciseOpacity': '" . $category->event_duration_imprecise_opacity . "',";
                    }
                }
            } else {
                $doAdd = true;
                $data .= "{";
            }
            if ($doAdd) {

                if ($row->latest_start && $row->latest_start != '0000-00-00 00:00:00') {
                    $data .= "'latestStart': '" . $row->latest_start . "',";
                }
                if ($row->earliest_end && $row->earliest_end != '0000-00-00 00:00:00') {
                    $data .= "'earliestEnd': '" . $row->earliest_end . "',";
                }
                $data .= "'start': '" . $row->start_date . "'," . ($row->end_date != 0 ? "'end': '" . $row->end_date . "'," : "") .
                        "'title': '" . $row->title . "'," .
                        "'description': '" . $row->description . "'," .
                        "'image': '" . $image . "'," .
                        "'link': '" . $row->link . "'}";
                if ($i != $itemsCount) {
                    $data .= ',';
                } else {
                    $dateTimeFormat = $row->datetime_format;
                }
            }
            $i++;
        }
        if (substr($data, strlen($data) - 1) == ',') {
            $data = substr($data, 0, -1);
        }

        $data = "{'dateTimeFormat': '" . $dateTimeFormat . "', 'wikiURL': '', 'wikiSection': '', 'events': [" . $data . "]}";

        return $data;
    }
    
    private function _prepare_description($str) {
        //$description = htmlentities($str, ENT_QUOTES, 'UTF-8');
        $description = str_replace("'", "\'", $str);
        $description = str_replace("\\'", "\'", $description);
        $order = array("\r\n", "\n", "\r");
        $description = str_replace($order, '<br />', $description);
        return $description;
    }

}

?>
