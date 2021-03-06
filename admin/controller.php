<?php

/**
 * @module		Into Timeline
 * @copyright	Copyright (C) 2010 artetics.com
 * @copyright	Copyright (C) 2013 Miku Laitinen
 * @license	GPL
 */
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
error_reporting(E_ERROR);
jimport('joomla.application.component.controller');

class TimelineController extends JController {

    function __construct() {
        parent::__construct();
        $this->registerTask('add', 'timeline_edit');
        $this->registerTask('publish', 'timeline_publish');
        $this->registerTask('unpublish', 'timeline_unpublish');
    }

    function timeline_save() {
        $option = JRequest::getCmd('option');
        $this->setRedirect('index.php?option=' . $option);

        $post = JRequest::get('post');

        $row = & JTable::getInstance('timeline', 'Table');

        if (!$row->bind($post)) {
            return JError::raiseWarning(500, $row->getError());
        }

        if (!$row->store()) {
            return JError::raiseWarning(500, $row->getError());
        }

        $this->setMessage('Timeline Saved');
    }

    function category_save() {
        $option = JRequest::getCmd('option');
        $this->setRedirect('index.php?option=' . $option . '&task=category_list');

        $post = JRequest::get('post');

        $row = & JTable::getInstance('category', 'Table');

        if (!$row->bind($post)) {
            return JError::raiseWarning(500, $row->getError());
        }

        if (!$row->store()) {
            return JError::raiseWarning(500, $row->getError());
        }

        $this->setMessage('Category Saved');
    }

    function year_save() {
        $option = JRequest::getCmd('option');
        $this->setRedirect('index.php?option=' . $option . '&task=year_list');

        $post = JRequest::get('post');

        $row = & JTable::getInstance('year', 'Table');

        if (!$row->bind($post)) {
            return JError::raiseWarning(500, $row->getError());
        }

        if (!$row->store()) {
            return JError::raiseWarning(500, $row->getError());
        }

        $this->setMessage('Year Saved');
    }

    function timelinefromarticles_edit() {
        require_once(JPATH_COMPONENT . DS . 'admin.intotimeline.html.php');

        $row = & JTable::getInstance('timeline', 'Table');
        $option = JRequest::getCmd('option');
        HTML_Timeline::timelinefromarticles_edit($option, $row);
    }

    function timelinefromarticles_save() {
        $option = JRequest::getCmd('option');
        $this->setRedirect('index.php?option=' . $option);

        $post = JRequest::get('post');
        $timeline_id = JRequest::getVar('timeline_id');
        $name = JRequest::getVar('name');

        if ((!$timeline_id || $timeline_id == -1) && !$name) {
            return JError::raiseWarning(500, 'Either enter the name for new timeline or in indicate existing timeline');
        } else {
            $row = & JTable::getInstance('timeline', 'Table');
            if (isset($timeline_id) && $timeline_id > 0) {
                $row->load($timeline_id);
                $recentId = $timeline_id;
            } else {
                if (!$row->bind($post)) {
                    return JError::raiseWarning(500, $row->getError());
                }

                if (!$row->store()) {
                    return JError::raiseWarning(500, $row->getError());
                }
                $recentId = $row->id;
            }

            $sectionId = $post['section_id'];
            $categoryId = $post['category_id'];
            $db = & JFactory::getDBO();
            $query = 'SELECT title, introtext as description, created as start_date FROM #__content ';
            if (isset($sectionId) && $sectionId && isset($categoryId) && $categoryId) {
                $query .= 'WHERE sectionid = ' . $sectionId;
                $query .= ' AND catid = ' . $categoryId;
            } else if (isset($sectionId) && $sectionId) {
                $query .= 'WHERE sectionid = ' . $sectionId;
            } else if (isset($categoryId) && $categoryId) {
                $query .= ' WHERE catid = ' . $categoryId;
            }
            $row->query = $query;
            $row->store();
            $db->setQuery($query);
            $rows = $db->loadObjectList();
            foreach ($rows as $row) {
                $eventRow = & JTable::getInstance('event', 'Table');
                $eventRow->title = $row->title;
                $eventRow->timeline_id = $recentId;
                $eventRow->description = $row->introtext;
                $eventRow->start_date = $row->created;
                $uri = JFactory::getURI();
                $eventRow->link = $uri->root() . 'index.php?option=com_content&view=article&id=' . $row->id;
                if (isset($categoryId) && $categoryId) {
                    $eventRow->link .= '&catid=' . $categoryId;
                }
                //$eventRow->image = $row->created;
                if (!$eventRow->store()) {
                    return JError::raiseWarning(500, $row->getError());
                }
            }

            $this->setMessage('Timeline Created');
        }
    }

    function timelinefromk2_edit() {
        require_once(JPATH_COMPONENT . DS . 'admin.intotimeline.html.php');

        $row = & JTable::getInstance('timeline', 'Table');
        $option = JRequest::getCmd('option');
        HTML_Timeline::timelinefromk2_edit($option, $row);
    }

    function timelinefromk2_save() {
        $option = JRequest::getCmd('option');
        $this->setRedirect('index.php?option=' . $option);

        $post = JRequest::get('post');
        $name = JRequest::getVar('name');
        $db = & JFactory::getDBO();

        $row = & JTable::getInstance('timeline', 'Table');
        $k2category_id = $post['k2category_id'];
        if ($k2category_id) {
            $post['query'] = 'SELECT title, DATE_FORMAT(created, "%Y-%m-%d") as start_date, introtext as description FROM `#__k2_items` WHERE catid = ' . mysql_real_escape_string($k2category_id);
        }
        if (!$row->bind($post)) {
            return JError::raiseWarning(500, $row->getError());
        }

        if (!$row->store()) {
            return JError::raiseWarning(500, $row->getError());
        }
        $recentId = $row->id;
        $this->setMessage('Timeline Created');
    }

    function timelinefromcsv_edit() {
        require_once(JPATH_COMPONENT . DS . 'admin.intotimeline.html.php');

        $row = & JTable::getInstance('timeline', 'Table');
        $option = JRequest::getCmd('option');
        HTML_Timeline::timelinefromcsv_edit($option, $row);
    }

    function timelinefromcsv_save() {
        $option = JRequest::getCmd('option');
        $this->setRedirect('index.php?option=' . $option);

        $post = JRequest::get('post');
        $timeline_id = JRequest::getVar('timeline_id');
        $name = JRequest::getVar('name');

        if ((!$timeline_id || $timeline_id == -1) && !$name) {
            return JError::raiseWarning(500, 'Either enter the name for new timeline or in indicate existing timeline');
        } else {
            $row = & JTable::getInstance('timeline', 'Table');
            if (isset($timeline_id) && $timeline_id > 0) {
                $row->load($timeline_id);
                $recentId = $timeline_id;
            } else {
                if (!$row->bind($post)) {
                    return JError::raiseWarning(500, $row->getError());
                }

                if (!$row->store()) {
                    return JError::raiseWarning(500, $row->getError());
                }
                $recentId = $row->id;
            }

            $csvFile = $post['csv'];
            $handle = fopen(JPATH_SITE . DS . $csvFile, 'r');
            if ($handle) {
                while (($event = fgetcsv($handle)) !== FALSE) {
                    $eventRow = & JTable::getInstance('event', 'Table');
                    $eventRow->title = $event[0];
                    $eventRow->timeline_id = $recentId;
                    $eventRow->description = $event[1];
                    $eventRow->start_date = $event[2];
                    $eventRow->end_date = $event[3];
                    $eventRow->image = $event[4];
                    $eventRow->link = $event[5];
                    if ($event[6]) {
                        $eventRow->category = $event[6];
                    }
                    if (!$eventRow->store()) {
                        return JError::raiseWarning(500, $row->getError());
                    }
                }
                fclose($handle);
            } else {
                return JError::raiseWarning(500, 'Indicated file not found: ' . $csvFile);
            }
            $this->setMessage('Timeline Created');
        }
    }

    function timelinefromsql_edit() {
        require_once(JPATH_COMPONENT . DS . 'admin.intotimeline.html.php');

        $row = & JTable::getInstance('timeline', 'Table');
        $option = JRequest::getCmd('option');
        HTML_Timeline::timelinefromsql_edit($option, $row);
    }

    function timelinefromsql_save() {
        $option = JRequest::getCmd('option');
        $this->setRedirect('index.php?option=' . $option);

        $post = JRequest::get('post');
        $timeline_id = JRequest::getVar('timeline_id');
        $name = JRequest::getVar('name');

        if ((!$timeline_id || $timeline_id == -1) && !$name) {
            return JError::raiseWarning(500, 'Either enter the name for new timeline or in indicate existing timeline');
        } else {
            $row = & JTable::getInstance('timeline', 'Table');
            if (isset($timeline_id) && $timeline_id > 0) {
                $row->load($timeline_id);
                $recentId = $timeline_id;
            } else {
                $post['query'] = $post['sql'];
                if (!$row->bind($post)) {
                    return JError::raiseWarning(500, $row->getError());
                }

                if (!$row->store()) {
                    return JError::raiseWarning(500, $row->getError());
                }
                $recentId = $row->id;
            }

            $sql = $post['sql'];
            $db = & JFactory::getDBO();
            $db->setQuery($sql);
            $rows = $db->loadObjectList();
            if ($db->getErrorNum()) {
                JError::raiseWarning(500, $db->getError() . 'Error executing query: ' . $sql);
                return false;
            } else {
                foreach ($rows as $row) {
                    $eventRow = & JTable::getInstance('event', 'Table');
                    $row->description = TimelineController::_prepare_description($row->description);
                    $row->title = TimelineController::_prepare_description($row->title);
                    $eventRow->title = $row->title;
                    $eventRow->timeline_id = $recentId;
                    $eventRow->description = $row->description;
                    $eventRow->start_date = $row->start_date;
                    $eventRow->end_date = $row->end_date;
                    $eventRow->image = $row->image;
                    $eventRow->link = $row->link;
                    if (!$eventRow->store()) {
                        return JError::raiseWarning(500, $row->getError());
                    }
                }

                $this->setMessage('Timeline Created');
            }
        }
    }

    function timeline_edit() {
        $cid = JRequest::getVar('cid', array(), 'request', 'array');

        $row = & JTable::getInstance('timeline', 'Table');

        if (isset($cid[0])) {
            $row->load($cid[0]);
        }

        require_once(JPATH_COMPONENT . DS . 'admin.intotimeline.html.php');
        $option = JRequest::getCmd('option');
        HTML_Timeline::timeline_edit($option, $row);
    }

    function category_edit() {
        $cid = JRequest::getVar('cid', array(), 'request', 'array');

        $row = & JTable::getInstance('category', 'Table');

        if (isset($cid[0])) {
            $row->load($cid[0]);
        }

        require_once(JPATH_COMPONENT . DS . 'admin.intotimeline.html.php');
        $option = JRequest::getCmd('option');
        HTML_Timeline::category_edit($option, $row);
    }

    function year_edit() {
        $cid = JRequest::getVar('cid', array(), 'request', 'array');

        $row = & JTable::getInstance('year', 'Table');

        if (isset($cid[0])) {
            $row->load($cid[0]);
        }

        require_once(JPATH_COMPONENT . DS . 'admin.intotimeline.html.php');
        $option = JRequest::getCmd('option');
        HTML_Timeline::year_edit($option, $row);
    }

    function timeline_remove() {
        $option = JRequest::getCmd('option');

        $this->setRedirect('index.php?option=' . $option);

        $db = & JFactory::getDBO();
        $cid = JRequest::getVar('cid', array(), 'request', 'array');
        $count = count($cid);

        if ($count) {
            $db->setQuery('DELETE FROM #__tl_timeline WHERE id IN (' . implode(',', $cid) . ')');

            if (!$db->query()) {
                JError::raiseWarning(500, $db->getError());
            }

            if ($count > 1) {
                $s = 's';
            } else {
                $s = '';
            }

            $this->setMessage('Timeline' . $s . ' removed');
        }
    }

    function category_remove() {
        $option = JRequest::getCmd('option');

        $this->setRedirect('index.php?option=' . $option . '&task=category_list');

        $db = & JFactory::getDBO();
        $cid = JRequest::getVar('cid', array(), 'request', 'array');
        $count = count($cid);

        if ($count) {
            $db->setQuery('DELETE FROM #__tl_category WHERE id IN (' . implode(',', $cid) . ')');

            if (!$db->query()) {
                JError::raiseWarning(500, $db->getError());
            }

            $this->setMessage('Category removed');
        }
    }

    function year_remove() {
        $option = JRequest::getCmd('option');

        $this->setRedirect('index.php?option=' . $option . '&task=year_list');

        $db = & JFactory::getDBO();
        $cid = JRequest::getVar('cid', array(), 'request', 'array');
        $count = count($cid);

        if ($count) {
            $db->setQuery('DELETE FROM #__tl_year WHERE id IN (' . implode(',', $cid) . ')');

            if (!$db->query()) {
                JError::raiseWarning(500, $db->getError());
            }

            $this->setMessage('Year removed');
        }
    }

    function timeline_publish() {
        $option = JRequest::getCmd('option');

        $this->setRedirect('index.php?option=' . $option);

        $cid = JRequest::getVar('cid', array(), 'request', 'array');

        if ($this->getTask() == 'timeline_publish' || $this->getTask() == 'publish') {
            $action = 'published';
            $publish = 1;
        } else {
            $action = 'unpublished';
            $publish = 0;
        }

        $table = & JTable::getInstance('timeline', 'Table');

        $table->publish($cid, $publish);

        if (count($cid) > 1) {
            $s = 's';
        } else {
            $s = '';
        }

        $this->setMessage('Timeline' . $s . ' ' . $action);
    }

    function timeline_unpublish() {
        $option = JRequest::getCmd('option');

        $this->setRedirect('index.php?option=' . $option);

        $cid = JRequest::getVar('cid', array(), 'request', 'array');

        if ($this->getTask() == 'timeline_publish') {
            $action = 'published';
            $publish = 1;
        } else {
            $action = 'unpublished';
            $publish = 0;
        }

        $table = & JTable::getInstance('timeline', 'Table');

        $table->publish($cid, $publish);

        if (count($cid) > 1) {
            $s = 's';
        } else {
            $s = '';
        }

        $this->setMessage('Timeline' . $s . ' ' . $action);
    }

    function timeline_list() {
        $option = JRequest::getCmd('option');

        $db = & JFactory::getDBO();
        $db->setQuery("SELECT * FROM #__tl_timeline");
        $rows = $db->loadObjectList();

        require_once(JPATH_COMPONENT . DS . 'admin.intotimeline.html.php');
        HTML_Timeline::timeline_list($option, $rows);
    }

    function category_list() {
        $option = JRequest::getCmd('option');

        $db = & JFactory::getDBO();
        $db->setQuery("SELECT * FROM #__tl_category");
        $rows = $db->loadObjectList();

        require_once(JPATH_COMPONENT . DS . 'admin.intotimeline.html.php');
        HTML_Timeline::category_list($option, $rows);
    }

    function year_list() {
        $option = JRequest::getCmd('option');

        $db = & JFactory::getDBO();
        $db->setQuery("SELECT * FROM #__tl_year");
        $rows = $db->loadObjectList();

        require_once(JPATH_COMPONENT . DS . 'admin.intotimeline.html.php');
        HTML_Timeline::year_list($option, $rows);
    }

    function event_list() {
        $option = JRequest::getCmd('option');
        $cid = JRequest::getVar('cid', array(), 'request', 'array');
        $order = JRequest::getVar('order');
        $dir = JRequest::getVar('dir');

        $db = & JFactory::getDBO();
        if ($cid) {
            $query = "SELECT E.id, E.title, E.timeline_id, E.start_date, E.end_date, E.modified, T.name FROM #__tl_event E LEFT JOIN #__tl_timeline T ON E.timeline_id = T.id WHERE timeline_id = " . $cid[0];
        } else {
            $query = "SELECT E.id, E.title, E.timeline_id, E.start_date, E.end_date, E.modified, T.name FROM #__tl_event E LEFT JOIN #__tl_timeline T ON E.timeline_id = T.id";
        }
        if ($order) {
            $query .= " ORDER BY " . $order;
        }
        if ($dir) {
            $query .= " " . $dir;
        }
        $db->setQuery($query);
        $rows = $db->loadObjectList();

        require_once(JPATH_COMPONENT . DS . 'admin.intotimeline.html.php');
        HTML_Timeline::event_list($option, $rows, $order, $dir, $cid);
    }

    function band_list() {
        $option = JRequest::getCmd('option');
        $cid = JRequest::getVar('cid', array(), 'request', 'array');

        $db = & JFactory::getDBO();
        if ($cid) {
            $db->setQuery("SELECT E.id, E.name, E.timeline_id, T.name as timeline_name FROM #__tl_band E LEFT JOIN #__tl_timeline T ON E.timeline_id = T.id WHERE timeline_id = " . $cid[0]);
        } else {
            $db->setQuery("SELECT E.id, E.name, E.timeline_id, T.name as timeline_name FROM #__tl_band E LEFT JOIN #__tl_timeline T ON E.timeline_id = T.id");
        }
        $rows = $db->loadObjectList();

        require_once(JPATH_COMPONENT . DS . 'admin.intotimeline.html.php');
        HTML_Timeline::band_list($option, $rows);
    }

    function event_save() {
        $option = JRequest::getCmd('option');
        $this->setRedirect('index.php?option=' . $option . '&task=event_list');

        $post = JRequest::get('post');

        $post['description'] = JRequest::getVar('description', '', 'post', 'string', JREQUEST_ALLOWHTML);
        $post['title'] = JRequest::getVar('title', '', 'post', 'string', JREQUEST_ALLOWHTML);
        if ($post['start_date']) {
            $post['start_date'] = str_replace('/', '-', $post['start_date']);
            if (strlen($post['start_date']) == 4) {
                $post['start_date'] = $post['start_date'] . '-01-01';
            }
        }
        if ($post['end_date']) {
            $post['end_date'] = str_replace('/', '-', $post['end_date']);
        }

        $row = & JTable::getInstance('event', 'Table');

        if (!$row->bind($post)) {
            return JError::raiseWarning(500, $row->getError());
        }

        if (!$row->store()) {
            return JError::raiseWarning(500, $row->getError());
        }

        $this->setMessage('Event Saved');
    }

    function event_edit() {
        $cid = JRequest::getVar('cid', array(), 'request', 'array');

        $row = & JTable::getInstance('event', 'Table');

        if (isset($cid[0])) {
            $row->load($cid[0]);
        }

        require_once(JPATH_COMPONENT . DS . 'admin.intotimeline.html.php');
        $option = JRequest::getCmd('option');
        HTML_Timeline::event_edit($option, $row);
    }

    function event_remove() {
        $option = JRequest::getCmd('option');
        $cid = JRequest::getVar('cid', array(), 'request', 'array');
        $count = count($cid);

        $this->setRedirect('index.php?option=' . $option . '&task=event_list');

        $db = & JFactory::getDBO();

        if ($count) {
            $db->setQuery('DELETE FROM #__tl_event WHERE id IN (' . implode(',', $cid) . ')');

            if (!$db->query()) {
                JError::raiseWarning(500, $db->getError());
            }

            if ($count > 1) {
                $s = 's';
            } else {
                $s = '';
            }

            $this->setMessage('Event' . $s . ' removed');
        }
    }

    function band_save() {
        $option = JRequest::getCmd('option');
        $this->setRedirect('index.php?option=' . $option . '&task=band_list');

        $post = JRequest::get('post');

        $row = & JTable::getInstance('band', 'Table');

        if (!$row->bind($post)) {
            return JError::raiseWarning(500, $row->getError());
        }

        if (!$row->store()) {
            return JError::raiseWarning(500, $row->getError());
        }

        $this->setMessage('Band Saved');
    }

    function band_edit() {
        $cid = JRequest::getVar('cid', array(), 'request', 'array');

        $row = & JTable::getInstance('band', 'Table');

        if (isset($cid[0])) {
            $row->load($cid[0]);
        }

        require_once(JPATH_COMPONENT . DS . 'admin.intotimeline.html.php');
        $option = JRequest::getCmd('option');
        HTML_Timeline::band_edit($option, $row);
    }

    function band_remove() {
        $option = JRequest::getCmd('option');
        $cid = JRequest::getVar('cid', array(), 'request', 'array');
        $count = count($cid);

        $this->setRedirect('index.php?option=' . $option . '&task=band_list');

        $db = & JFactory::getDBO();

        if ($count) {
            $db->setQuery('DELETE FROM #__tl_band WHERE id IN (' . implode(',', $cid) . ')');

            if (!$db->query()) {
                JError::raiseWarning(500, $db->getError());
            }

            if ($count > 1) {
                $s = 's';
            } else {
                $s = '';
            }

            $this->setMessage('Band' . $s . ' removed');
        }
    }

    function settings() {
        require_once(JPATH_COMPONENT . DS . 'admin.intotimeline.html.php');

        $row = & JTable::getInstance('setting', 'Table');
        $option = JRequest::getCmd('option');
        $row->load(1);
        HTML_Timeline::settings($option, $row);
    }

    function settings_save() {
        $option = JRequest::getCmd('option');
        $this->setRedirect('index.php?option=' . $option);

        $post = JRequest::get('post');

        $row = & JTable::getInstance('setting', 'Table');

        if (!$row->bind($post)) {
            return JError::raiseWarning(500, $row->getError());
        }

        if (!$row->store()) {
            return JError::raiseWarning(500, $row->getError());
        }

        $this->setMessage('Settings Saved');
    }

    function help() {
        require_once(JPATH_COMPONENT . DS . 'admin.intotimeline.html.php');
        HTML_Timeline::help($option, $rows);
    }

    function timeline_generatejs() {
        $option = JRequest::getCmd('option');
        $cid = JRequest::getVar('cid', array(), 'request', 'array');

        $this->setRedirect('index.php?option=' . $option . '&task=timeline_list');

        $isOk = true;
        foreach ($cid as $single_cid) {
            $t = TimelineController::generateTimelineFile($single_cid);
            if (!$t)
                $isOk = false;
        }
        if ($isOk) {
            $count = count($cid);
            if ($count > 1) {
                $s = 's';
            } else {
                $s = '';
            }

            $this->setMessage('Timeline' . $s . ' generated');
        }
    }

    function generateTimelineFile($timelineId) {
        $db = & JFactory::getDBO();
        $row = & JTable::getInstance('timeline', 'Table');
        $row->load($timelineId);
        if ($row->query) {
            $db->setQuery($row->query);
        } else {
            $db->setQuery("SELECT E.id, E.title, E.description, E.timeline_id, E.start_date, E.end_date, E.latest_start, E.earliest_end, E.image, E.link, E.category, T.datetime_format FROM #__tl_event E INNER JOIN #__tl_timeline T ON E.timeline_id = T.id WHERE timeline_id = " . $timelineId);
        }
        $rows = $db->loadObjectList();
        $currentDate = date('Y-m-d-H-i-s');
        $file = JPATH_SITE . DS . 'administrator' . DS . 'components' . DS . 'com_intotimeline' . DS . 'timelines' . DS . 'timeline_' . $timelineId . '.js';

        $handle = fopen($file, 'w');
        if (!$handle) {
            return JError::raiseWarning(500, 'Cannot create timeline file: ' . $file . '. Please check that folder exists and has appropriate permissions.');
            return false;
        } else {
            $i = 1;
            $dateTimeFormat;
            $itemsCount = count($rows);
            foreach ($rows as $row) {
                $image = $row->image;
                if ($image && strstr($image, 'http:') === false && strstr($image, 'www.') === false) {
                    $image = JURI::root() . $image;
                }
                $row->description = TimelineController::_prepare_description($row->description);
                $row->title = TimelineController::_prepare_description($row->title);
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

            fwrite($handle, $data);
            fclose($handle);

            $timeline = & JTable::getInstance('timeline', 'Table');
            $timeline->load($timelineId);
            $timeline->last_generated = $currentDate;
            //$timeline->file = $file;
            $timeline->file = 'administrator/components/com_intotimeline/timelines/timeline_' . $timelineId . '.js';
            $timeline->store();

            return true;
        }
    }

    function _prepare_description($str) {
        //$description = htmlentities($str, ENT_QUOTES, 'UTF-8');
        $description = str_replace("'", "\'", $str);
        $description = str_replace("\\'", "\'", $description);
        $order = array("\r\n", "\n", "\r");
        $description = str_replace($order, '<br />', $description);
        return $description;
    }

    function addSubmenu() {
        $task = $this->getTask();
        JSubMenuHelper::addEntry(
                JText::_('Timelines'), 'index.php?option=com_intotimeline&task=timeline_list', $task == 'timeline_list' || $task == null);
        JSubMenuHelper::addEntry(
                JText::_('Bands'), 'index.php?option=com_intotimeline&task=band_list', $task == 'band_list');
        JSubMenuHelper::addEntry(
                JText::_('Events'), 'index.php?option=com_intotimeline&task=event_list', $task == 'event_list');
        JSubMenuHelper::addEntry(
                JText::_('Categories'), 'index.php?option=com_intotimeline&task=category_list', $task == 'category_list');
        JSubMenuHelper::addEntry(
                JText::_('Settings'), 'index.php?option=com_intotimeline&task=settings', $task == 'settings');
        JSubMenuHelper::addEntry(
                JText::_('Help'), 'index.php?option=com_intotimeline&task=help', $task == 'help');
    }

}

?>