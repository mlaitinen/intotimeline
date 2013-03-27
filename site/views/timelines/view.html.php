<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

class intotimelineViewtimelines extends JView {

    function display($tmp = null) {

        $model = $this->getModel();
        $timelines = $model->getTimelines();
        
        foreach ($timelines as &$timeline) {
            $timeline->link = $this->createLink('index.php?option=com_intotimeline&id=' . $timeline->id);
        }
        
        $this->assignRef('timelines', $timelines);

        parent::display($tmp);
    }

    private function createLink($link) {
        $app = &JFactory::getApplication();
        $router = &$app->getRouter();
        if ($router->getMode() == JROUTER_MODE_SEF) {
            $itemidPos = strpos($link, 'Itemid');
            if ($itemidPos !== false) {
                $link = preg_replace('/Itemid(?:=[^&;]*)?/', '', $link);
            }
        }
        $link = JRoute::_($link);
        
        return $link;
    }
}

?>