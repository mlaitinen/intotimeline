<?php
/**
 * The default controller of Into Timeline
 *
 * @author miku
 */
// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.controller');

class IntoTimelineController extends JController {

    function __construct() {
        parent::__construct();
        JTable::addIncludePath(JPATH_SITE . DS . 'administrator' . DS . 'components' . DS . 'com_intotimeline' . DS . 'database');
    }
    
    function display() {
        $timelineId = JRequest::getInt('id');
        $viewName = $timelineId === 0 ? 'timelines' : 'timeline';
        
        /* @var $view JView */
        $view =& $this->getView($viewName, 'html');
        $model =& $this->getModel($viewName);
        $view->setModel($model, true);

        $view->display();
    }
    
    function jsontimeline() {
        $model =& $this->getModel('timeline');
        echo $model->getTimelinejson();
    }

    function add() {
        $user = & JFactory::getUser();
        if ($user && $user->id) {
            JHTML::_('behavior.calendar');
            $db = & JFactory::getDBO();
            $db->setQuery("SELECT id, name from #__tl_timeline");
            $timeline_rows = $db->loadObjectList();
            $db->setQuery("SELECT id, name from #__tl_category");
            $category_rows = $db->loadObjectList();
            if (count($timeline_rows) > 0) {
                ?>
                <form action="index.php" method="post" name="adminForm">

                    <div class="col100" id="editForm">
                        <fieldset class="adminform">
                            <table class="admintable">
                                <tbody>
                                    <tr>
                                        <td width="20%" class="key" title="Title for event">
                                            <label for="title">Title</label>
                                        </td>
                                        <td>
                                            <input class="inputbox" type="text" name="title" id="title" size="40" maxlength="255" value="<?php echo $row->title; ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="20%" class="key" title="Timeline to which event will belong">
                                            <label for="timeline_id">Timeline</label>
                                        </td>
                                        <td>
                                            <select id="timeline_id" name="timeline_id">
                                                <?php
                                                foreach ($timeline_rows as $timeline_row) {
                                                    ?>
                                                    <option name="0" value="<?php echo $timeline_row->id; ?>" <?php if ($timeline_row->id == $row->timeline_id) echo "selected='selected'"; ?> ><?php echo $timeline_row->name; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="20%" class="key" title="Category to which event will belong">
                                            <label for="category">Category</label>
                                        </td>
                                        <td>
                                            <select id="category" name="category">
                                                <option name="-1" value="-1" <?php if ($category_row->id == $row->category) echo "selected='selected'"; ?> ></option>
                                                <?php
                                                foreach ($category_rows as $category_row) {
                                                    ?>
                                                    <option name="0" value="<?php echo $category_row->id; ?>" <?php if ($category_row->id == $row->category) echo "selected='selected'"; ?> ><?php echo $category_row->name; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="20%" class="key" title="Description for event">
                                            <label for="description">Description</label>
                                        </td>
                                        <td>
                                            <textarea class="inputbox" type="text" name="description" id="description" cols="28" rows="4"><?php echo $row->description; ?></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="20%" class="key" title="Start date for event">
                                            <label for="start_date">Start Date</label>
                                        </td>
                                        <td>
                                            <?php
                                            $start_date = $row->id ? $row->start_date : date('Y/m/d', time());
                                            ?>
                                            <input class="inputbox" type="text" name="start_date" id="start_date" size="40" value="<?php echo $start_date; ?>" />
                                            <?php
                                            $version = new JVersion();
                                            if ($version->RELEASE >= 1.6) {
                                                JHTML::calendar('', 'start_date', 'start_date', '%Y/%m/%d');
                                            } else {
                                                ?>
                                                <input type="reset" class="button" value="..." onclick="return showCalendar('start_date', '%Y/%m/%d');" />
                                                <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="20%" class="key" title="End date for event">
                                            <label for="end_date">End Date</label>
                                        </td>
                                        <td>
                                            <?php
                                            $end_date = ($row->id && $row->end_date != 0) ? $row->end_date : '';
                                            ?>
                                            <input class="inputbox" type="text" name="end_date" id="end_date" size="40" value="<?php echo $end_date; ?>" />
                                            <?php
                                            $version = new JVersion();
                                            if ($version->RELEASE >= 1.6) {
                                                JHTML::calendar('', 'end_date', 'end_date', '%Y/%m/%d');
                                            } else {
                                                ?>
                                                <input type="reset" class="button" value="..." onclick="return showCalendar('end_date', '%Y/%m/%d');" />
                                                <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="20%" class="key" title="Image">
                                            <label for="image">Image</label>
                                        </td>
                                        <td>
                                            <input class="inputbox" type="text" name="image" id="image" size="40" maxlength="255" value="<?php echo $row->image; ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="20%" class="key" title="Link">
                                            <label for="image">Link</label>
                                        </td>
                                        <td>
                                            <input class="inputbox" type="text" name="link" id="link" size="40" maxlength="255" value="<?php echo $row->link; ?>" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </fieldset>
                    </div>

                    <input type="hidden" name="option" value="com_intotimeline" />
                    <input type="hidden" name="task" value="save" />
                    <input type="hidden" name="id" value="" />
                    <input type="hidden" name="modifiedby" value="<?php echo $user->id; ?>" />
                    <input type="hidden" name="modified" value="<?php echo date('Y-m-d H:i:s'); ?>" />
                    <input type="submit" name="ok" value="ok" />
                </form>
                <?php
            }
            return;
        } else {
            echo 'Restricted access. Please login';
            return;
        }
    }

    function save() {
        $user = & JFactory::getUser();
        if ($user && $user->id && JRequest::getString('modifiedby') == $user->id) {
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

            require_once(JPATH_SITE . DS . 'administrator' . DS . 'components' . DS . 'com_intotimeline' . DS . 'controller.php');
            IntoTimelineController::generateTimelineFile($post['timeline_id']);
            echo 'Event Saved! Go to <a href="' . JURI::root() . 'index.php?option=com_intotimeline&id=' . $post['timeline_id'] . '">timeline</a>';
            return;
        } else {
            echo 'Restricted access. Please login';
            return;
        }
    }

}
?>
