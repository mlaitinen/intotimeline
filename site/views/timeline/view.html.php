<?php
/**
 * The default view for a single timeline.
 *
 * @author miku
 */
// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

class IntotimelineViewTimeline extends JView {

    private $intervalUnits = array(
        'MILLISECOND',
        'SECOND',
        'MINUTE',
        'HOUR',
        'DAY',
        'WEEK',
        'MONTH',
        'YEAR',
        'DECADE',
        'CENTURY',
        'MILLENNIUM'
    );
    
    function display($tmp = null) {

        $settings = & JTable::getInstance('setting', 'Table');
        /* @var $document JDocument */
        $document = & JFactory::getDocument();
        $settings->load(1);
        if ($settings->title) {
            $document->setTitle($settings->title);
        }
        
        $componentPath = 'components/com_intotimeline/';
        $jsPath = $componentPath.'js/';
        $timelinePath = $jsPath.'timeline_js/';
        
        $document->_links[] = "<script type=\"text/javascript\"> //";
        $document->_links[] = "Timeline_ajax_url=\"" . JURI::base() . $jsPath . "timeline_ajax/simile-ajax-api.js\"; //";
        $document->_links[] = "SimileAjax_urlPrefix=\"" . JURI::base() . $jsPath . "timeline_ajax/\"; //";
        $document->_links[] = "Timeline_urlPrefix=\"" . JURI::base() . $jsPath . "timeline_js/\"; // ";
        $document->_links[] = "Timeline_parameters='bundle=true&forceLocale=fi&defaultLocale=fi'; //";
        $document->_links[] = "</script> <span";

        $document->addScript($jsPath . 'timeline_ajax/simile-ajax-api.js');
        $document->addScript($jsPath . 'timeline_ajax/simile-ajax-bundle.js');
        $document->addScript($timelinePath . 'timeline-api.js');
        $document->addScript($jsPath . 'date.js'); // TODO: Is this needed?
        $document->addScript($jsPath . 'into_timeline.js');

        $timeline = $this->get('timeline');
        
        $document->setTitle($timeline->name);
        $user = & JFactory::getUser();

        if (!$timeline->published) {
            echo JText::_('Timeline is not published or does not exist');
        } else if ($timeline->access > $user->get('aid', 0)) {
            echo JText::_('You do not have permissions to access this page');
        } else {
            
            $interval_unit = $this->intervalUnits[$timeline->interval_unit];

            $db = & JFactory::getDBO();
            if ($timeline->id) {
                $bquery = 'SELECT * FROM #__tl_band WHERE timeline_id = ' . $timeline->id;
                $db->setQuery($bquery);
                $brows = $db->loadObjectList();
                foreach ($brows as &$brow) {
                    $brow->interval_unit_name = $this->intervalUnits[$brow->interval_unit];
                }
            } else {
                $brows = array();
            }
        }

        unset($settings->_db);
        unset($timeline->_db);
        
        $this->assignRef('settings', $settings);
        $this->assignRef('componentPath', $componentPath);
        $this->assignRef('timeline', $timeline);
        $this->assignRef('interval_unit', $interval_unit);
        $this->assignRef('brows', $brows);
        
        parent::display($tmp);
    }
    
    function assignRef($name, $value) {
        $document = & JFactory::getDocument();
        $document->addScriptDeclaration("var $name = " . json_encode($value) . ";");
        parent::assignRef($name, $value);
    }
    
}
?>
