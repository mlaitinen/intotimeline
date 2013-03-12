<?php
/**
* @module		Art Timeline
* @copyright	Copyright (C) 2010 artetics.com
* @license		GPL
*/ 

defined('_JEXEC') or die('Direct Access to this location is not allowed.');
error_reporting(E_ERROR); 
JTable::addIncludePath(JPATH_SITE . DS . 'administrator' . DS . 'components' . DS . 'com_arttimeline' . DS . 'database');
require_once(JPATH_SITE . DS . 'administrator' . DS . 'components' . DS . 'com_arttimeline' . DS . 'libraries'. DS . 'adodb' . DS . 'adodb-time.inc.php'); 
$componentPath = JURI::base().'components/com_arttimeline/';
?>

<link rel="stylesheet" href="<?php echo $componentPath; ?>css/timeline.css" type="text/css" media="screen" />
<?php
$view = JRequest::getString('view');
$Itemid = JRequest::getString('Itemid');
$Itemid = intval($Itemid);
$task = JRequest::getString('task');
if ($task == 'add') {
  $user =& JFactory::getUser();
  if ($user && $user->id) {
    JHTML::_('behavior.calendar'); 
    $db	=& JFactory::getDBO();
    $db->setQuery("SELECT id, name from #__art_tl_timeline");
		$timeline_rows = $db->loadObjectList();
		$db->setQuery("SELECT id, name from #__art_tl_category");
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
										foreach($timeline_rows as $timeline_row) {
									?>
									<option name="0" value="<?php echo $timeline_row->id; ?>" <?php if ($timeline_row->id == $row->timeline_id) echo "selected='selected'"; ?> ><?php echo $timeline_row->name;?></option>
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
										foreach($category_rows as $category_row) {
									?>
									<option name="0" value="<?php echo $category_row->id; ?>" <?php if ($category_row->id == $row->category) echo "selected='selected'"; ?> ><?php echo $category_row->name;?></option>
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
									$start_date = $row->id ? $row->start_date : date( 'Y/m/d', time() );
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
			
			<input type="hidden" name="option" value="com_arttimeline" />
			<input type="hidden" name="task" value="save" />
			<input type="hidden" name="id" value="" />
			<input type="hidden" name="modifiedby" value="<?php echo $user->id; ?>" />
			<input type="hidden" name="modified" value="<?php echo date( 'Y-m-d H:i:s' ); ?>" />
      <input type="submit" name="ok" value="ok" />
			</form>
		<?php
		}
    return;
  } else {
    echo 'Restricted access. Please login';
    return;
  }
} else if ($task == 'save') {
  $user =& JFactory::getUser();
  if ($user && $user->id && JRequest::getString('modifiedby') == $user->id) {
    $post = JRequest::get('post');
		
		$post['description'] = JRequest::getVar( 'description', '', 'post', 'string', JREQUEST_ALLOWHTML );
		$post['title'] = JRequest::getVar( 'title', '', 'post', 'string', JREQUEST_ALLOWHTML );
		if ($post['start_date']) {
      $post['start_date'] = str_replace('/', '-', $post['start_date']);
      if (strlen($post['start_date']) == 4) {
        $post['start_date'] = $post['start_date'] . '-01-01';
      }
		}
    if ($post['end_date']) {
      $post['end_date'] = str_replace('/', '-', $post['end_date']);
    }
		
		$row =& JTable::getInstance('artevent', 'Table');
		
		if (!$row->bind($post)) {
			return JError::raiseWarning(500, $row->getError());
		}
		
		if (!$row->store()) {
			return JError::raiseWarning(500, $row->getError());
		}
    
    require_once(JPATH_SITE . DS . 'administrator' . DS . 'components' . DS . 'com_arttimeline' . DS . 'controller.php');
		ArtTimelineController::generateTimelineFile($post['timeline_id']);
		echo 'Event Saved! Go to <a href="' . JURI::root() . 'index.php?option=com_arttimeline&timelineid=' . $post['timeline_id'] . '">timeline</a>';
    return;
  } else {
    echo 'Restricted access. Please login';
    return;
  }
} else if ($view == 'timeline' && $Itemid) {
  $db	=& JFactory::getDBO();
  if ($Itemid) {
    $menuQuery = 'SELECT * from #__menu WHERE id = ' . $Itemid;
  } else {
    $menuQuery = 'SELECT * from #__menu WHERE id = ' . JRequest::getInt('Itemid');
  }
  $db->setQuery($menuQuery);
  $menuItem = $db->loadObject();
  if ($menuItem) {
    $mp = $menuItem->params;
    if ($mp) {
    $mpArray = explode("\n", $mp);
    foreach ($mpArray as $mpItem) {
      $mpItemArray = explode("=", $mpItem);
      if ($mpItemArray && $mpItemArray[0] && $mpItemArray[0][0] && $mpItemArray[0][0] == 'timeline' && $mpItemArray[0][1]) {
        $timelineId = $mpItemArray[0][1];
      }
    }
	if (!$timelineId) {
	  $params = $menuItem->params;
	  $timelineId = substr($params, 13, strpos($params, '","') - 13);
	} 
    }
  }
  if (!$timelineId) {
    $timelineId = JRequest::getString('timelineid');
    $timelineId = intval($timelineId);
  }
} else {
  $timelineId = JRequest::getString('timelineid');
  $timelineId = intval($timelineId);
}

$settings =& JTable::getInstance('artsetting', 'Table');
$document =& JFactory::getDocument(); 
$settings->load(1);
if ($settings->title) {
	$document->setTitle($settings->title);
}
?>
<div class="componentheading">
  <?php echo $settings->title; ?>
</div>
<?php

if ($timelineId) {
	$timeline =& JTable::getInstance('arttimeline', 'Table');
	$timeline->load($timelineId);
  if ($timeline->query) {
		require_once(JPATH_SITE . DS . 'administrator' . DS . 'components' . DS . 'com_arttimeline' . DS . 'controller.php');
		ArtTimelineController::generateTimelineFile($timelineId);
	} 
	$document->setTitle($timeline->name);
	$user =& JFactory::getUser();

	if (!$timeline->published) {
		echo $settings->not_published_text;
	} else if (!$timeline->file && !$timeline->query) {
		echo $settings->not_generated_text;
	} else if ($timeline->access > $user->get('aid', 0)) {
		echo $settings->no_permissions_text;
	} else {
		if (!$timeline->bubble_width) $timeline->bubble_width = 320;
		if (!$timeline->bubble_height) $timeline->bubble_height = 120;
		if (!$timeline->event_img) $timeline->event_img = 'dull-blue-circle.png';
		if (!$timeline->event_line_color) $timeline->event_line_color = '#58A0DC';
		if (!$timeline->event_imprecise_color) $timeline->event_imprecise_color = '#58A0DC';
		if (!$timeline->event_imprecise_opacity) $timeline->event_imprecise_opacity = 20;
		if (!$timeline->event_duration_color) $timeline->event_duration_color = '#58A0DC';
		if (!$timeline->event_duration_opacity) $timeline->event_duration_opacity = 100;
		if (!$timeline->event_duration_imprecise_color) $timeline->event_duration_imprecise_color = '#58A0DC';
		if (!$timeline->event_duration_imprecise_opacity) $timeline->event_duration_imprecise_opacity = 100;
		$interval_unit = 'WEEK';
		switch($timeline->interval_unit) {
			case 0:
				$interval_unit = 'MILLISECOND';
			break;
			
			case 1:
				$interval_unit = 'SECOND';
			break;
			
			case 2:
				$interval_unit = 'MINUTE';
			break;
			
			case 3:
				$interval_unit = 'HOUR';
			break;
			
			case 4:
				$interval_unit = 'DAY';
			break;
			
			case 5:
				$interval_unit = 'WEEK';
			break;
			
			case 6:
				$interval_unit = 'MONTH';
			break;
			
			case 7:
				$interval_unit = 'YEAR';
			break;
			
			case 8:
				$interval_unit = 'DECADE';
			break;
			
			case 9:
				$interval_unit = 'CENTURY';
			break;
			
			case 10:
				$interval_unit = 'MILLENNIUM';
			break;
		}
		if ($settings->display_description) {
			echo '<span class="art_tl_description">'.$timeline->description.'</span>';
		}
    
    $db	=& JFactory::getDBO(); 
    if ($timelineId) {
      $bquery = 'SELECT * FROM #__art_tl_band WHERE timeline_id = ' . $timelineId;      
      $db->setQuery( $bquery );
      $brows = $db->loadObjectList(); 
    } else {
      $brows = array(); 
    }
    if (count($brows)) {
      $bCount = count($brows);
    }
?>
<div id="<?php echo $settings->container_id; ?>" style="<?php echo $settings->container_style; ?>">
</div>
<a href="http://www.artetics.com/ARTools/art-timeline" title="Art Timeline - Timeline extension for Joomla!" class="art-timeline-logo">Art Timeline</a>
<script type='text/javascript' src='<?php echo $componentPath; ?>js/timeline-api.js'></script>
<script type='text/javascript' src='<?php echo $componentPath; ?>js/timeline-bundle.js'></script>
<script type='text/javascript' src='<?php echo $componentPath; ?>js/labellers.js'></script>
<script type='text/javascript' src='<?php echo $componentPath; ?>js/timeline.js'></script>
<script type='text/javascript' src='<?php echo $componentPath; ?>js/art_timeline.js'></script>
<script type='text/javascript' src='<?php echo $componentPath; ?>js/date.js'></script>
<script type="text/javascript">
var tl;
function artOnLoad() {
	Timeline.componentPath = '<?php echo $componentPath; ?>';
	var eventSource = new Timeline.DefaultEventSource(0);
	
  <?php if ($timeline->scroll_start_date != 0) { ?>
	var startProj = Timeline.DateTime.parseIso8601DateTime("<?php echo $timeline->scroll_start_date;?>");
  <?php } ?>
  <?php if ($timeline->scroll_end_date != 0) { ?>
  var endProj = Timeline.DateTime.parseIso8601DateTime("<?php echo $timeline->scroll_end_date;?>"); 
  <?php } ?>
  
	var theme = Timeline.<?php echo $timeline->theme; ?>.create();
	theme.event.bubble.width = <?php echo $timeline->bubble_width; ?>;
	theme.event.bubble.height = <?php echo $timeline->bubble_height; ?>;
	theme.event.instant.icon = Timeline.componentPath+'img/' + '<?php echo $timeline->event_img; ?>';
	theme.event.instant.lineColor = '<?php echo $timeline->event_line_color; ?>';
	theme.event.instant.impreciseColor = '<?php echo $timeline->event_imprecise_color; ?>';
	theme.event.instant.impreciseOpacity = <?php echo $timeline->event_imprecise_opacity; ?>;
	theme.event.duration.color = '<?php echo $timeline->event_duration_color; ?>';
	theme.event.duration.opacity = <?php echo $timeline->event_duration_opacity; ?>;
	theme.event.duration.impreciseColor = '<?php echo $timeline->event_duration_imprecise_color; ?>';
	theme.event.duration.impreciseOpacity = <?php echo $timeline->event_duration_imprecise_opacity; ?>;
	<?php if ($settings->bubbletype) echo 'Timeline.bubbletype = true;'; ?>
	<?php if ($settings->customJS) echo $settings->customJS; 
  if (strpos($timeline->start_date, '-') === 0) {
  ?>
  var d = Timeline.DateTime.parseGregorianDateTime("<?php echo adodb_strftime( $timeline->start_date ); ?>");
  <?php
  } else {
  ?>
	var d = Timeline.DateTime.parseGregorianDateTime("<?php echo adodb_date2('Y/m/d', adodb_strftime( $timeline->start_date )); ?>");
  <?php }
  ?>
	var bandInfos = [
		Timeline.createBandInfo({
			width:          "<?php echo $timeline->width; ?>", 
			intervalUnit:   Timeline.DateTime.<?php echo $interval_unit; ?>, 
			intervalPixels: <?php echo $timeline->interval_pixel; ?>,
			eventSource:    eventSource,
			date:           d,
      <?php if (count($brows)) {echo 'width:"70%",';} ?>
			theme:          theme
		})
    <?php
      if (count($brows)) {
        foreach ($brows as $brow) {
          $b_interval_unit = 'WEEK';
          switch($brow->interval_unit) {
            case 0:
              $b_interval_unit = 'MILLISECOND';
            break;
            
            case 1:
              $b_interval_unit = 'SECOND';
            break;
            
            case 2:
              $b_interval_unit = 'MINUTE';
            break;
            
            case 3:
              $b_interval_unit = 'HOUR';
            break;
            
            case 4:
              $b_interval_unit = 'DAY';
            break;
            
            case 5:
              $b_interval_unit = 'WEEK';
            break;
            
            case 6:
              $b_interval_unit = 'MONTH';
            break;
            
            case 7:
              $b_interval_unit = 'YEAR';
            break;
            
            case 8:
              $b_interval_unit = 'DECADE';
            break;
            
            case 9:
              $b_interval_unit = 'CENTURY';
            break;
            
            case 10:
              $b_interval_unit = 'MILLENNIUM';
            break;
          }
          ?>
          ,Timeline.createBandInfo({
            width:          "<?php echo (30/$bCount); ?>%",
            intervalUnit:   Timeline.DateTime.<?php echo $b_interval_unit; ?>, 
            intervalPixels: <?php echo $brow->interval_pixel; ?>
          })
          <?php
        }
      }
    ?>
	];
  <?php
    $jj = 1;
    if (count($brows)) {
      foreach ($brows as $brow) {
      ?>
      bandInfos[<?php echo $jj; ?>].syncWith = 0;
      bandInfos[<?php echo $jj; ?>].highlight = true;
      <?php
        $jj++;
      }
    }
  ?>
	
	tl = Timeline.create(document.getElementById("<?php echo $settings->container_id; ?>"), bandInfos, Timeline.<?php echo $timeline->direction; ?>);
  
  <?php if ($timeline->scroll_start_date != 0) { ?>
	tl.timeline_start = startProj;
  <?php } ?>
  <?php if ($timeline->scroll_end_date != 0) { ?>
  tl.timeline_stop  = endProj; 
  <?php } ?>
  
	tl.loadJSON("<?php echo JURI::root() . '/' . $timeline->file; ?>", function(json, url) {
		eventSource.loadJSON(json, url);
	});
}

</script>
<?php
	}
} else {
	$db	=& JFactory::getDBO(); 
	$query = 'SELECT * FROM #__art_tl_timeline WHERE published = 1';
	$db->setQuery( $query );
	$rows = $db->loadObjectList(); 
	if (count($rows)) {
		echo '<div class="art_tl_timelines">';
		foreach ($rows as $row) {
		?>
			<span class="art_tl_timeline">
				<?php $link = artGetLink('index.php?option=com_arttimeline&timelineid=' . $row->id); ?>
				<a href="<?php echo $link; ?>">
					<?php echo $row->name; ?>
				</a>
			</span>
		<?php
		}
		echo '</div>';
	} else {
		echo $settings->no_published_timelines_text;
	}
}

function artGetLink($link) {
	$app = &JFactory::getApplication();
	$router = &$app->getRouter();
	if($router->getMode() == JROUTER_MODE_SEF)  {
		$itemidPos = strpos($link, 'Itemid');
		if ($itemidPos !== false)
		{
			$link = preg_replace('/Itemid(?:=[^&;]*)?/', '', $link);
		}
	}
	$link = JRoute::_($link, $xhtml);
	
	return $link;
}
?>