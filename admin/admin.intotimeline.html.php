<?php
/**
 * @module		Into Timeline
 * @copyright	Copyright (C) 2010 artetics.com
 * @copyright	Copyright (C) 2013 Miku Laitinen
 * @license	GPL
 */

defined('_JEXEC') or die('Direct Access to this location is not allowed.');
error_reporting(E_ERROR); 
class HTML_Timeline {
	function help($option, &$rows) {
		HTML_Timeline::setHelpToolbar();
	?>
		<ul>
			<li><b>Into Timeline Component description</b><br />
			Into Timeline component allows display highly-configurable timelines and their events. Timelines and events have several settings, can be created manually, generated from sql or from articles by category id and section id.
			<br /><br /><br /><br />
			</li>
			<li><b>Creating timelines</b><br />
			Go to <b>Components -> Into Timeline -> Timelines</b> to manage timelines. Using this view administrator can publish/unpublish, create, edit, delete timelines, generate timeline files. If timeline is unpublished it cannot be viewed on front-end.
			<br /><br />
			<u>Before timeline can be published on front-end it should have timeline file generated.</u> This can be done by clicking 'Generate Timelines' button.
			<img src="components/com_intotimeline/images/timeline_help_1.jpg" />
			<br /><br />
			Using 'New' button administrator can create new timeline.
			<img src="components/com_intotimeline/images/timeline_help_2.jpg" />
			<br /><br /><br /><br />
			Timelines and their events can also be created from articles using category and section id. This can be done on Settings page.
			<br /><br /><br /><br />
			</li>
			<li><b>Creating events</b><br />
			Once timeline is created administrator can add new events. Go to <b>Components -> Into Timeline -> Events</b> to manage events. Administrator can create, edit, remove events here. Each event should have title, start date and must be assigned to timeline. Description, end date, image and link are optional.
			<img src="components/com_intotimeline/images/timeline_help_3.jpg" />
			<br /><br /><br /><br />
			</li>
			<li><b>Settings</b><br />
			Using <b>Components -> Into Timeline -> Settings</b> page administrator can manage common settings:
			<ul>
				<li>Timeline container properties</li>
				<li>Page title</li>
				<li>Custom Javascript code to be executed on page load</li>
				<li>Error messages text</li>
				<li>Create timelines from articles</li>
				<li>Create timelines from SQL</li>
				<li>Create timelines from CSV file</li>
			</ul>
			<br />
			<img src="components/com_intotimeline/images/timeline_help_4.jpg" />
			<br /><br /><br /><br />
			</li>
			<li><b>Displaying timeline on front-end</b><br />
			To display list of timelines on front-end administrator should create menu item that points to Into Timeline component.<br /><br />
			This url can be used to display list of available timelines: <b>index.php?option=com_intotimeline</b><br /><br />
			This url can be used to display single timeline: <b>index.php?timelineid=ID&amp;option=com_intotimeline</b>, where ID is timeline id.
			<br /><br /><br /><br />
			</li>
			<li><b>Importing event from CSV file</b><br />
			To import events from CSV administrator should go to Components -> Into Timeline -> Settings -> Create Timeline from CSV and indicate CSV file on server.<br /><br />
			CSV file format should be the following:<br /><br />
			title,description,start_date,end_date,image,link<br />
			title2,description2,start_date2,end_date2,image2,link2<br />
			title3,this is description,2009-08-10 00:00:00,2009-09-10 00:00:00,http://www.example.com/image.jpg,http://www.example.com<br />
			...
			<br /><br /><br /><br />
			</li>
			<li><b>Upgrading Into Timeline</b><br />
			To upgrade Into Timeline extension to newer version, uninstall old and install new version of component using standard Joomla! procedures. Timeline-related data in database will remain untouched.
			<br /><br /><br /><br />
			</li>
		</ul>
	<?php
	}
	
	function settings($option, &$row) {
		HTML_Timeline::setSettingsToolbar();
    HTML_Timeline::includeResources();
		
		?>
		<form action="index.php" method="post" name="adminForm">
			<div class="col100" id="editForm">
			<fieldset class="adminform">
			<table class="admintable">
				<tbody>
					<tr>
						<td width="20%" class="key" title="Id for Timeline Container">
							<label for="container_id">Container Id</label>
						</td>
						<td>
							<input class="inputbox" type="text" name="container_id" id="container_id" size="40" maxlength="255" value="<?php echo $row->container_id; ?>" />
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Style for Timeline Container">
							<label for="container_style">Container Style</label>
						</td>
						<td>
							<textarea class="inputbox" type="text" name="container_style" id="container_style" cols="28" rows="4"><?php echo $row->container_style; ?></textarea>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Page title">
							<label for="title">Page title</label>
						</td>
						<td>
							<input class="inputbox" type="text" name="title" id="title" size="40" maxlength="255" value="<?php echo $row->title; ?>" />
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Display Description">
							<label for="displayDescription">Display Description</label>
						</td>
						<td>
							<?php echo JHTML::_('select.booleanlist',  'display_description', '', $row->display_description ); ?>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Custom Javascript to be Executed on Page Load">
							<label for="customJS">Custom Javascript</label>
						</td>
						<td>
							<textarea class="inputbox" type="text" name="customJS" id="customJS" cols="28" rows="4"><?php echo $row->customJS; ?></textarea>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key">
							<label for="not_published_text">'Not Published' text</label>
						</td>
						<td>
							<textarea class="inputbox" type="text" name="not_published_text" id="not_published_text" cols="28" rows="4"><?php echo $row->not_published_text; ?></textarea>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key">
							<label for="not_generated_text">'Not Generated' text</label>
						</td>
						<td>
							<textarea class="inputbox" type="text" name="not_generated_text" id="not_generated_text" cols="28" rows="4"><?php echo $row->not_generated_text; ?></textarea>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key">
							<label for="no_permissions_text">'No Permissions' text</label>
						</td>
						<td>
							<textarea class="inputbox" type="text" name="no_permissions_text" id="no_permissions_text" cols="28" rows="4"><?php echo $row->no_permissions_text; ?></textarea>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key">
							<label for="no_published_timelines_text">'No Published Timelines' text</label>
						</td>
						<td>
							<textarea class="inputbox" type="text" name="no_published_timelines_text" id="no_published_timelines_text" cols="28" rows="4"><?php echo $row->no_published_timelines_text; ?></textarea>
						</td>
					</tr>
          <tr>
						<td width="20%" class="key" title="Display event bubble on mouse click">
							<label for="bubbletype">Display event bubble on mouse click</label>
						</td>
						<td>
							<?php echo JHTML::_('select.booleanlist',  'bubbletype', '', $row->bubbletype ); ?>
						</td>
					</tr>
				</tbody>
			</table>
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			<input type="hidden" name="task" value="timeline_list" />
			<input type="hidden" name="boxchecked" value="0" />
			<input type="hidden" name="id" value="1" />
		</form>
		<?php
	}
	
	function timeline_list($option, &$rows) {
		HTML_Timeline::setTimelinesListToolbar();
		
		?>
		<form action="index.php" method="post" name="adminForm" id="adminForm">
			
			<table class="adminlist">
				<thead>
					<tr>
						<th width="20"><input type="checkbox" name="toggle" value=""  onclick="checkAll(<?php echo count( $rows ); ?>);" /></th>
						<th nowrap="nowrap" class="title">Name</th>
						<th nowrap="nowrap">Published</th>
						<th nowrap="nowrap">Events</th>
						<th nowrap="nowrap">Modified</th>
						<th nowrap="nowrap">File Generated</th>
					</tr>
				</thead>
				<tbody>
					<?php
					
					$k = 0;
					for ($i=0, $n=count( $rows ); $i < $n; $i++) {
						$row = &$rows[$i];
						
						$published = JHTML::_('grid.published', $row, $i );
 						$checked = JHTML::_('grid.id', $i, $row->id );
						
						$link = 'index.php?option=' . $option . '&task=timeline_edit&cid[]='. $row->id;
						$events_link = 'index.php?option=' . $option . '&task=event_list&cid[]='. $row->id;
						
						?>
						<tr class="<?php echo "row$k"; ?>">
							<td align="center">
								<?php echo $checked; ?>
							</td>
							<td>
								<a href="<?php echo $link; ?>" title="Edit Timeline">
									<?php echo $row->name; ?>
								</a>
							</td>
							<td align="center">
								<?php echo $published; ?>
							</td>
							<td align="center">
								<a href="<?php echo $events_link; ?>" title="Events">
									Events
								</a>
							</td>
							<td align="center">
								<?php echo JHTML::date($row->modified); ?>
							</td>
							<td align="center">
								<?php 
                if ($row->query) {
                  echo 'Query: ' . $row->query . '<br />(<b>file is generated automatically</b>)';
                } else if ($row->last_generated != 0) {
									echo '[' . JHTML::date($row->last_generated) . '] '.$row->file;
								} else {
									echo '';
								}
								?>
							</td>
						<?php
						
						$k = 1 - $k;
					}
					
					?>
				</tbody>
			</table>
			
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="boxchecked" value="0" />
		</form>
		<?php
	}

	function category_list($option, &$rows) {
		HTML_Timeline::setCategoryListToolbar();
		
		?>
		<form action="index.php" method="post" name="adminForm">
			
			<table class="adminlist">
				<thead>
					<tr>
						<th width="20"><input type="checkbox" name="toggle" value=""  onclick="checkAll(<?php echo count( $rows ); ?>);" /></th>
						<th nowrap="nowrap" class="title">Name</th>
					</tr>
				</thead>
				<tbody>
					<?php
					
					$k = 0;
					for ($i=0, $n=count( $rows ); $i < $n; $i++) {
						$row = &$rows[$i];
						
						$link = 'index.php?option=' . $option . '&task=category_edit&cid[]='. $row->id;
						
 						$checked = JHTML::_('grid.id', $i, $row->id );						
						?>
						<tr class="<?php echo "row$k"; ?>">
							<td align="center">
								<?php echo $checked; ?>
							</td>
							<td>
								<a href="<?php echo $link; ?>" title="Edit Category">
									<?php echo $row->name; ?>
								</a>
							</td>
						<?php
						
						$k = 1 - $k;
					}
					
					?>
				</tbody>
			</table>
			
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="boxchecked" value="0" />
		</form>
		<?php
	}
	
	function year_list($option, &$rows) {
		HTML_Timeline::setYearListToolbar();
		
		?>
		<form action="index.php" method="post" name="adminForm">
			
			<table class="adminlist">
				<thead>
					<tr>
						<th width="20"><input type="checkbox" name="toggle" value=""  onclick="checkAll(<?php echo count( $rows ); ?>);" /></th>
						<th nowrap="nowrap" class="title">Year</th>
					</tr>
				</thead>
				<tbody>
					<?php
					
					$k = 0;
					for ($i=0, $n=count( $rows ); $i < $n; $i++) {
						$row = &$rows[$i];
						
						$link = 'index.php?option=' . $option . '&task=year_edit&cid[]='. $row->id;
						
 						$checked = JHTML::_('grid.id', $i, $row->id );						
						?>
						<tr class="<?php echo "row$k"; ?>">
							<td align="center">
								<?php echo $checked; ?>
							</td>
							<td>
								<a href="<?php echo $link; ?>" title="Edit Year">
									<?php echo $row->year; ?>
								</a>
							</td>
						<?php
						
						$k = 1 - $k;
					}
					
					?>
				</tbody>
			</table>
			
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="boxchecked" value="0" />
		</form>
		<?php
	}

	function event_list($option, &$rows, $order, $dir, $cid) {
		HTML_Timeline::setEventsListToolbar();
		require_once(JPATH_COMPONENT.DS.'libraries'. DS . 'adodb' . DS . 'adodb-time.inc.php');
		
    $titleSortLink = 'index.php?option=' . $option . '&task=event_list';
		if ($cid) {
			$titleSortLink .= '&cid[]='. $cid;
		}
		$titleSortLink .= '&order=title';
		if ($dir == 'ASC') {
			$titleSortLink .= '&dir=DESC';
		} else {
			$titleSortLink .= '&dir=ASC';
		}
		
		$startSortLink = 'index.php?option=' . $option . '&task=event_list';
		if ($cid) {
			$startSortLink .= '&cid[]='. $cid;
		}
		$startSortLink .= '&order=start_date';
		if ($dir == 'ASC') {
			$startSortLink .= '&dir=DESC';
		} else {
			$startSortLink .= '&dir=ASC';
		}
		
		$calendarSortLink = 'index.php?option=' . $option . '&task=event_list';
		if ($cid) {
			$calendarSortLink .= '&cid[]='. $cid;
		}
		$calendarSortLink .= '&order=timeline_id';
		if ($dir == 'ASC') {
			$calendarSortLink .= '&dir=DESC';
		} else {
			$calendarSortLink .= '&dir=ASC';
		}
		?>
		<form action="index.php" method="post" name="adminForm">
			
			<table class="adminlist">
				<thead>
					<tr>
						<th width="20"><input type="checkbox" name="toggle" value=""  onclick="checkAll(<?php echo count( $rows ); ?>);" /></th>
						<th nowrap="nowrap" class="title">
              <a href="<?php echo $titleSortLink; ?>">
								Title
							</a>
            </th>
						<th nowrap="nowrap">
            <a href="<?php echo $startSortLink; ?>">
								Start Date
							</a>
            </th>
						<th nowrap="nowrap">End Date</th>
						<th nowrap="nowrap">
              <a href="<?php echo $calendarSortLink; ?>">
								Timeline
							</a>
            </th>
						<th nowrap="nowrap">Modified</th>
					</tr>
				</thead>
				<tbody>
					<?php
					
					$k = 0;
					for ($i=0, $n=count( $rows ); $i < $n; $i++) {
						$row = &$rows[$i];
						
						$published = JHTML::_('grid.published', $row, $i );
 						$checked = JHTML::_('grid.id', $i, $row->id );
						
						$link = 'index.php?option=' . $option . '&task=event_edit&cid[]='. $row->id;
						$timeline_link = 'index.php?option=' . $option . '&task=timeline_edit&cid[]='. $row->timeline_id;
						
						?>
						<tr class="<?php echo "row$k"; ?>">
							<td align="center">
								<?php echo $checked; ?>
							</td>
							<td>
								<a href="<?php echo $link; ?>" title="Edit Event">
									<?php echo $row->title; ?>
								</a>
							</td>
							<td align="center">
								<?php 
                  try {
                    $adodbDate = adodb_date2('l, d F Y',$row->start_date);
                    if (!@JHTML::date($row->start_date)) { echo $adodbDate; } else { echo $row->start_date; }
                  } catch(Exception $e) {
                  }
                ?>
							</td>
							<td align="center">
								<?php 
								if ($row->end_date != 0) {
									echo $row->end_date;
								}
								?>
							</td>
							<td align="center">
								<a href="<?php echo $timeline_link; ?>" title="Edit Timeline">
									<?php echo $row->name; ?>
								</a>
							</td>
							<td>
								<?php echo JHTML::date($row->modified); ?>
							</td>
						<?php
						
						$k = 1 - $k;
					}
					
					?>
				</tbody>
			</table>
			
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="boxchecked" value="0" />
		</form>
		<?php
	}
  
  function band_list($option, &$rows) {
		HTML_Timeline::setBandListToolbar();
		require_once(JPATH_COMPONENT.DS.'libraries'. DS . 'adodb' . DS . 'adodb-time.inc.php');
		
		?>
		<form action="index.php" method="post" name="adminForm">
			
			<table class="adminlist">
				<thead>
					<tr>
						<th width="20"><input type="checkbox" name="toggle" value=""  onclick="checkAll(<?php echo count( $rows ); ?>);" /></th>
						<th nowrap="nowrap" class="name">Name</th>
						<th nowrap="nowrap">Timeline</th>
					</tr>
				</thead>
				<tbody>
					<?php
					
					$k = 0;
					for ($i=0, $n=count( $rows ); $i < $n; $i++) {
						$row = &$rows[$i];
						
 						$checked = JHTML::_('grid.id', $i, $row->id );
						
						$link = 'index.php?option=' . $option . '&task=band_edit&cid[]='. $row->id;
						$timeline_link = 'index.php?option=' . $option . '&task=timeline_edit&cid[]='. $row->timeline_id;
						
						?>
						<tr class="<?php echo "row$k"; ?>">
							<td align="center">
								<?php echo $checked; ?>
							</td>
							<td>
								<a href="<?php echo $link; ?>" title="Edit Band">
									<?php echo $row->name; ?>
								</a>
							</td>
							<td align="center">
								<a href="<?php echo $timeline_link; ?>" title="Edit Timeline">
									<?php echo $row->timeline_name; ?>
								</a>
							</td>
						<?php
						
						$k = 1 - $k;
					}
					
					?>
				</tbody>
			</table>
			
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="boxchecked" value="0" />
		</form>
		<?php
	}

	function timeline_edit($option, &$row) {
		HTML_Timeline::setTimelineToolbar($row->id);
		HTML_Timeline::includeResources();		
		JHTML::_('behavior.calendar');
		$user =& JFactory::getUser();
		
		?>
		<form action="index.php" method="post" name="adminForm">
		
		<div class="col100" id="editForm">
			<fieldset class="adminform">
			<table class="admintable">
				<tbody>
					<tr>
						<td width="20%" class="key" title="Name for timeline">
							<label for="name">Name</label>
						</td>
						<td>
							<input class="inputbox" type="text" name="name" id="name" size="40" maxlength="255" value="<?php echo $row->name; ?>" />
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Should timeline be published or not">
							<label for="published">Published</label>
						</td>
						<td>
							<?php echo JHTML::_('select.booleanlist',  'published', '', $row->published ); ?>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Access Level for Timeline">
							<label for="access">Access</label>
						</td>
						<td>
							<select id="access" name="access">
								<option name="0" value="0" <?php if ($row->access == '0') echo "selected='selected'"; ?> >Public</option>
								<option name="1" value="1" <?php if ($row->access == '1') echo "selected='selected'"; ?> >Registered</option>
								<option name="2" value="2" <?php if ($row->access == '2') echo "selected='selected'"; ?> >Special</option>
							</select>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Description for timeline">
							<label for="description">Description</label>
						</td>
						<td>
							<textarea class="inputbox" type="text" name="description" id="description" cols="28" rows="4"><?php echo $row->description; ?></textarea>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Date-Time format for timeline. Default value is iso8601">
							<label for="datetime_format">Date-Time Format</label>
						</td>
						<td>
							<?php
								$datetime_format = $row->id ? $row->datetime_format : 'iso8601';
							?>
							<input class="inputbox" type="text" name="datetime_format" id="datetime_format" size="40" maxlength="255" value="<?php echo $datetime_format; ?>" />
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Timeline theme. Default value is ClassicTheme">
							<label for="theme">Theme</label>
						</td>
						<td>
							<select id="theme" name="theme">
								<option name="ClassicTheme" value="ClassicTheme" <?php if ($row->theme == 'ClassicTheme') echo "selected='selected'"; ?> >ClassicTheme</option>
							</select>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Interval unit for timeline: from millisecond to millemium. Default value is Week">
							<label for="interval_unit">Interval Unit</label>
						</td>
						<td>
							<select id="interval_unit" name="interval_unit">
								<option name="0" value="0" <?php if ($row->interval_unit == '0') echo "selected='selected'"; ?> >Millisecond</option>
								<option name="1" value="1" <?php if ($row->interval_unit == '1') echo "selected='selected'"; ?> >Second</option>
								<option name="2" value="2" <?php if ($row->interval_unit == '2') echo "selected='selected'"; ?> >Minute</option>
								<option name="3" value="3" <?php if ($row->interval_unit == '3') echo "selected='selected'"; ?> >Hour</option>
								<option name="4" value="4" <?php if ($row->interval_unit == '4') echo "selected='selected'"; ?> >Day</option>
								<option name="5" value="5" <?php if ($row->interval_unit == '5' || !$row->interval_unit) echo "selected='selected'"; ?> >Week</option>
								<option name="6" value="6" <?php if ($row->interval_unit == '6') echo "selected='selected'"; ?> >Month</option>
								<option name="7" value="7" <?php if ($row->interval_unit == '7') echo "selected='selected'"; ?> >Year</option>
								<option name="8" value="8" <?php if ($row->interval_unit == '8') echo "selected='selected'"; ?> >Decade</option>
								<option name="9" value="9" <?php if ($row->interval_unit == '9') echo "selected='selected'"; ?> >Century</option>
								<option name="10" value="10" <?php if ($row->interval_unit == '10') echo "selected='selected'"; ?> >Millemium</option>
							</select>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="How many pixels for interval. Default value is 100">
							<label for="interval_pixel">Interval Pixels</label>
						</td>
						<td>
							<?php
								$interval_pixel = $row->id ? $row->interval_pixel : '100';
							?>
							<input class="inputbox" type="text" name="interval_pixel" id="interval_pixel" size="40" maxlength="255" value="<?php echo $interval_pixel; ?>" />
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Start date for timeline">
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
						<td width="20%" class="key" title="Scroll start date for timeline">
							<label for="scroll_start_date">Scroll Start Date</label>
						</td>
						<td>
							<?php
								$scroll_start_date = $row->id ? $row->scroll_start_date : '';
							?>
							<input class="inputbox" type="text" name="scroll_start_date" id="scroll_start_date" size="40" value="<?php echo $scroll_start_date; ?>" />
              <?php
              $version = new JVersion(); 
              if ($version->RELEASE >= 1.6) {
                JHTML::calendar('', 'scroll_start_date', 'scroll_start_date', '%Y/%m/%d');
              } else {
              ?>
							<input type="reset" class="button" value="..." onclick="return showCalendar('scroll_start_date', '%Y/%m/%d');" />
              <?php
              }
              ?>
						</td>
					</tr>
          <tr>
						<td width="20%" class="key" title="Scroll end date for timeline">
							<label for="scroll_end_date">Scroll End Date</label>
						</td>
						<td>
							<?php
								$scroll_end_date = $row->id ? $row->scroll_end_date : '';
							?>
							<input class="inputbox" type="text" name="scroll_end_date" id="scroll_end_date" size="40" value="<?php echo $scroll_end_date; ?>" />
              <?php
              $version = new JVersion(); 
              if ($version->RELEASE >= 1.6) {
                JHTML::calendar('', 'scroll_end_date', 'scroll_end_date', '%Y/%m/%d');
              } else {
              ?>
							<input type="reset" class="button" value="..." onclick="return showCalendar('scroll_end_date', '%Y/%m/%d');" />
              <?php
              }
              ?>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Width of timeline container. Example: 100 or 100%">
							<label for="width">Width</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="width" id="width" size="40" maxlength="255" value="<?php echo $row->width; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="width" id="width" size="40" maxlength="255" value="100%" />
							<?php } ?>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Direction of timeline. This is for future implementations">
							<label for="direction">Direction</label>
						</td>
						<td>
							<select id="direction" name="direction">
								<option name="VERTICAL" value="VERTICAL" <?php if ($row->direction == 'VERTICAL') echo "selected='selected'"; ?> >Vertical</option>
								<option name="HORIZONTAL" value="HORIZONTAL" <?php if ($row->direction == 'HORIZONTAL' || !$row->direction) echo "selected='selected'"; ?> >Horizontal</option>
							</select>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Width of event bubble">
							<label for="bubble_width">Bubble Width</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="bubble_width" id="bubble_width" size="40" maxlength="255" value="<?php echo $row->bubble_width; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="bubble_width" id="bubble_width" size="40" maxlength="255" value="320" />
							<?php } ?>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Height of event bubble">
							<label for="bubble_height">Bubble Height</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="bubble_height" id="bubble_height" size="40" maxlength="255" value="<?php echo $row->bubble_height; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="bubble_height" id="bubble_height" size="40" maxlength="255" value="120" />
							<?php } ?>
	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Image. Either external image or located in JOOMLA_DIR folder by default. Example: blue-circle.png - this will display image JOOMLA_DIR/components/com_intotimeline/img/blue-circle.png ">
							<label for="event_img">Event Image</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_img" id="event_img" size="40" maxlength="255" value="<?php echo $row->event_img; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_img" id="event_img" size="40" maxlength="255" value="dull-blue-circle.png" />
							<?php } ?>
	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Line Color">
							<label for="event_line_color">Event Line Color</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_line_color" id="event_line_color" size="40" maxlength="255" value="<?php echo $row->event_line_color; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_line_color" id="event_line_color" size="40" maxlength="255" value="#58A0DC" />
							<?php } ?>
	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Imprecise Color">
							<label for="event_imprecise_color">Event Imprecise Color</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_imprecise_color" id="event_imprecise_color" size="40" maxlength="255" value="<?php echo $row->event_imprecise_color; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_imprecise_color" id="event_imprecise_color" size="40" maxlength="255" value="#58A0DC" />
							<?php } ?>
	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Imprecise Opacity">
							<label for="event_imprecise_opacity">Event Imprecise Opacity</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_imprecise_opacity" id="event_imprecise_opacity" size="40" maxlength="255" value="<?php echo $row->event_imprecise_opacity; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_imprecise_opacity" id="event_imprecise_opacity" size="40" maxlength="255" value="20" />
							<?php } ?>
	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Duration Color">
							<label for="event_duration_color">Event Duration Color</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_duration_color" id="event_duration_color" size="40" maxlength="255" value="<?php echo $row->event_duration_color; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_duration_color" id="event_duration_color" size="40" maxlength="255" value="#58A0DC" />
							<?php } ?>
	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Duration Opacity">
							<label for="event_duration_opacity">Event Duration Opacity</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_duration_opacity" id="event_duration_opacity" size="40" maxlength="255" value="<?php echo $row->event_duration_opacity; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_duration_opacity" id="event_duration_opacity" size="40" maxlength="255" value="100" />
							<?php } ?>
	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Duration Imprecise Color">
							<label for="event_duration_imprecise_color">Event Duration Imprecise Color</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_duration_imprecise_color" id="event_duration_imprecise_color" size="40" maxlength="255" value="<?php echo $row->event_duration_imprecise_color; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_duration_imprecise_color" id="event_duration_imprecise_color" size="40" maxlength="255" value="#58A0DC" />
							<?php } ?>
	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Duration Imprecise Opacity">
							<label for="event_duration_imprecise_opacity">Event Duration Imprecise Opacity</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_duration_imprecise_opacity" id="event_duration_imprecise_opacity" size="40" maxlength="255" value="<?php echo $row->event_duration_imprecise_opacity; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_duration_imprecise_opacity" id="event_duration_imprecise_opacity" size="40" maxlength="255" value="20" />
							<?php } ?>
	
						</td>
					</tr>
				</tbody>
			</table>
			</fieldset>
		</div>
		
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
		<input type="hidden" name="modifiedby" value="<?php echo $user->id; ?>" />
		<input type="hidden" name="modified" value="<?php echo date( 'Y-m-d H:i:s' ); ?>" />
		</form>
		<script type="text/javascript">
			window.addEvent("domready", function() {
				editTimeline('timeline_save');
			});
		</script>
		<?php
	}
	
	function category_edit($option, &$row) {
		HTML_Timeline::setCategoryToolbar($row->id);
		HTML_Timeline::includeResources();		
		
		?>
		<form action="index.php" method="post" name="adminForm">
		
		<div class="col100" id="editForm">
			<fieldset class="adminform">
			<table class="admintable">
				<tbody>
					<tr>
						<td width="20%" class="key" title="Name for category">
							<label for="name">Name</label>
						</td>
						<td>
							<input class="inputbox" type="text" name="name" id="name" size="40" maxlength="255" value="<?php echo $row->name; ?>" />
						</td>
					</tr>
          <tr>
						<td width="20%" class="key" title="Should category be enabled or not">
							<label for="enabled">Enabled</label>
						</td>
						<td>
							<?php echo JHTML::_('select.booleanlist',  'enabled', '', $row->enabled ); ?>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Image. Either external image or located in JOOMLA_DIR folder by default. Example: images/image.jpg - this will display image JOOMLA_DIR/images/image.jpg ">
							<label for="event_img">Event Image</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_img" id="event_img" size="40" maxlength="255" value="<?php echo $row->event_img; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_img" id="event_img" size="40" maxlength="255" value="dull-blue-circle.png" />
							<?php } ?>
	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Text Color">
							<label for="event_text_color">Event Text Color</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_text_color" id="event_text_color" size="40" maxlength="255" value="<?php echo $row->event_text_color; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_text_color" id="event_text_color" size="40" maxlength="255" value="#000000" />
							<?php } ?>	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Duration Color">
							<label for="event_duration_color">Event Duration Color</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_duration_color" id="event_duration_color" size="40" maxlength="255" value="<?php echo $row->event_duration_color; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_duration_color" id="event_duration_color" size="40" maxlength="255" value="#58A0DC" />
							<?php } ?>
						</td>
					</tr>
          <tr>
						<td width="20%" class="key" title="Event Imprecise Color">
							<label for="event_duration_color">Event Imprecise Color</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_duration_imprecise_color" id="event_duration_imprecise_color" size="40" maxlength="255" value="<?php echo $row->event_duration_imprecise_color; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_duration_imprecise_color" id="event_duration_imprecise_color" size="40" maxlength="255" value="#58A0DC" />
							<?php } ?>
						</td>
					</tr>
          <tr>
						<td width="20%" class="key" title="Event Imprecise Opacity">
							<label for="event_text_color">Event Imprecise Opacity</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_duration_imprecise_opacity" id="event_duration_imprecise_opacity" size="40" maxlength="255" value="<?php echo $row->event_duration_imprecise_opacity; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_duration_imprecise_opacity" id="event_duration_imprecise_opacity" size="40" maxlength="255" value="30" />
							<?php } ?>	
						</td>
					</tr>
				</tbody>
			</table>
			</fieldset>
		</div>
		
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
		</form>
		<script type="text/javascript">
			window.addEvent("domready", function() {
				editCategory('category_save');
			});
		</script>
		<?php
	}
	
	function year_edit($option, &$row) {
		HTML_Timeline::setYearToolbar($row->id);
		HTML_Timeline::includeResources();		
		
		?>
		<form action="index.php" method="post" name="adminForm">
		
		<div class="col100" id="editForm">
			<fieldset class="adminform">
			<table class="admintable">
				<tbody>
					<tr>
						<td width="20%" class="key" title="year">
							<label for="year">Year</label>
						</td>
						<td>
							<input class="inputbox" type="text" name="year" id="year" size="40" maxlength="255" value="<?php echo $row->year; ?>" />
						</td>
					</tr>
				</tbody>
			</table>
			</fieldset>
		</div>
		
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
		</form>
		<script type="text/javascript">
			window.addEvent("domready", function() {
				editYear('year_save');
			});
		</script>
		<?php
	}
	
	function event_edit($option, &$row) {
		HTML_Timeline::setEventToolbar($row->id);
		HTML_Timeline::includeResources();		
		JHTML::_('behavior.calendar');
		$user =& JFactory::getUser();
		$db	=& JFactory::getDBO();
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
								<td title="Imprecise" colspan="2">
									<span style="cursor:pointer;" onclick="var elm = document.getElementById('imprecise_container'); if (elm.style.display == 'none') {elm.style.display = '';} else {elm.style.display = 'none';}">Are event dates imprecise?</span>
								</td>
						</tr>
						<tr style="display:none" id="imprecise_container">
								<td title="Imprecise" colspan="2" style="padding:0">
									<table>
										<tr>
											<td width="20%" class="key" title="Latest start date for event">
												<label for="latest_start">Latest Start Date</label>
											</td>
											<td>
												<?php
													$latest_start = $row->id ? $row->latest_start : '';
												?>
												<input class="inputbox" type="text" name="latest_start" id="latest_start" size="40" value="<?php echo $latest_start; ?>" />
												<?php
												$version = new JVersion(); 
												if ($version->RELEASE >= 1.6) {
												  JHTML::calendar('', 'latest_start', 'latest_start', '%Y/%m/%d');
												} else {
												?>
												<input type="reset" class="button" value="..." onclick="return showCalendar('latest_start', '%Y/%m/%d');" />
												<?php
												}
												?>
											</td>
										</tr>
										<tr>
											<td width="20%" class="key" title="Earliest end date for event">
												<label for="earliest_end">Earliest end Date</label>
											</td>
											<td>
												<?php
													$earliest_end = ($row->id && $row->earliest_end != 0) ? $row->earliest_end : '';
												?>
												<input class="inputbox" type="text" name="earliest_end" id="earliest_end" size="40" value="<?php echo $earliest_end; ?>" />
												<?php
												$version = new JVersion(); 
												if ($version->RELEASE >= 1.6) {
												  JHTML::calendar('', 'earliest_end', 'earliest_end', '%Y/%m/%d');
												} else {
												?>
												<input type="reset" class="button" value="..." onclick="return showCalendar('earliest_end', '%Y/%m/%d');" />
												<?php
												}
												?>
											</td>
										</tr>
									</table>
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
			
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
			<input type="hidden" name="modifiedby" value="<?php echo $user->id; ?>" />
			<input type="hidden" name="modified" value="<?php echo date( 'Y-m-d H:i:s' ); ?>" />
			</form>
			<script type="text/javascript">
				window.addEvent("domready", function() {
					editEvent();
				});
			</script>
		<?php
		} else {
			echo '<b>Please <a href="index.php?option='.$option.'&task=timeline_edit">create timeline</a> first.</b>';
		}
	}
  
  function band_edit($option, &$row) {
		HTML_Timeline::setBandToolbar($row->id);
		HTML_Timeline::includeResources();		
		JHTML::_('behavior.calendar');
		$db	=& JFactory::getDBO();
		$db->setQuery("SELECT id, name from #__tl_timeline");
		$timeline_rows = $db->loadObjectList();
		if (count($timeline_rows) > 0) {
		?>
			<form action="index.php" method="post" name="adminForm">
			
			<div class="col100" id="editForm">
				<fieldset class="adminform">
				<table class="admintable">
					<tbody>
						<tr>
							<td width="20%" class="key" title="Title for event">
								<label for="name">Name</label>
							</td>
							<td>
								<input class="inputbox" type="text" name="name" id="name" size="40" maxlength="255" value="<?php echo $row->name; ?>" />
							</td>
						</tr>
						<tr>
							<td width="20%" class="key" title="Timeline to which band will belong">
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
              <td width="20%" class="key" title="Interval unit for timeline: from millisecond to millemium. Default value is Week">
                <label for="interval_unit">Interval Unit</label>
              </td>
              <td>
                <select id="interval_unit" name="interval_unit">
                  <option name="0" value="0" <?php if ($row->interval_unit == '0') echo "selected='selected'"; ?> >Millisecond</option>
                  <option name="1" value="1" <?php if ($row->interval_unit == '1') echo "selected='selected'"; ?> >Second</option>
                  <option name="2" value="2" <?php if ($row->interval_unit == '2') echo "selected='selected'"; ?> >Minute</option>
                  <option name="3" value="3" <?php if ($row->interval_unit == '3') echo "selected='selected'"; ?> >Hour</option>
                  <option name="4" value="4" <?php if ($row->interval_unit == '4') echo "selected='selected'"; ?> >Day</option>
                  <option name="5" value="5" <?php if ($row->interval_unit == '5' || !$row->interval_unit) echo "selected='selected'"; ?> >Week</option>
                  <option name="6" value="6" <?php if ($row->interval_unit == '6') echo "selected='selected'"; ?> >Month</option>
                  <option name="7" value="7" <?php if ($row->interval_unit == '7') echo "selected='selected'"; ?> >Year</option>
                  <option name="8" value="8" <?php if ($row->interval_unit == '8') echo "selected='selected'"; ?> >Decade</option>
                  <option name="9" value="9" <?php if ($row->interval_unit == '9') echo "selected='selected'"; ?> >Century</option>
                  <option name="10" value="10" <?php if ($row->interval_unit == '10') echo "selected='selected'"; ?> >Millemium</option>
                </select>
              </td>
            </tr>
            <tr>
              <td width="20%" class="key" title="How many pixels for interval. Default value is 100">
                <label for="interval_pixel">Interval Pixels</label>
              </td>
              <td>
                <?php
                  $interval_pixel = $row->id ? $row->interval_pixel : '100';
                ?>
                <input class="inputbox" type="text" name="interval_pixel" id="interval_pixel" size="40" maxlength="255" value="<?php echo $interval_pixel; ?>" />
              </td>
            </tr>
					</tbody>
				</table>
				</fieldset>
			</div>
			
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
			<input type="hidden" name="modifiedby" value="<?php echo $user->id; ?>" />
			<input type="hidden" name="modified" value="<?php echo date( 'Y-m-d H:i:s' ); ?>" />
			</form>
			<script type="text/javascript">
				window.addEvent("domready", function() {
					editBand();
				});
			</script>
		<?php
		} else {
			echo '<b>Please <a href="index.php?option='.$option.'&task=timeline_edit">create timeline</a> first.</b>';
		}
	}
	
	function timelinefromarticles_edit($option, &$row) {
		HTML_Timeline::setTimelineFromArticlesToolbar();
		HTML_Timeline::includeResources();		
		JHTML::_('behavior.calendar');
		$user =& JFactory::getUser();
		$db	=& JFactory::getDBO();
		$db->setQuery("SELECT id, title from #__sections");
		$sections_rows = $db->loadObjectList();
		$db->setQuery("SELECT id, title from #__categories");
		$categories_rows = $db->loadObjectList();
		?>
		<form action="index.php" method="post" name="adminForm">
		<div class="col100" id="editForm">
			<fieldset class="adminform">
			<table class="admintable">
				<tbody>
					<tr>
						<td width="20%" class="key" title="Name for timeline">
							<label for="name">Name</label>
						</td>
						<td>
							<input class="inputbox" type="text" name="name" id="name" size="40" maxlength="255" value="<?php echo $row->name; ?>" />
							<?php
								$db->setQuery("SELECT id, name from #__tl_timeline");
								$timeline_rows = $db->loadObjectList();
								if (count($timeline_rows) > 0) {
							?>
							&nbsp;Or select existing timeline 
							<select id="timeline_id" name="timeline_id">
								<option name="0" value="-1">---</option>
								<?php
									foreach($timeline_rows as $timeline_row) {
								?>
								<option name="0" value="<?php echo $timeline_row->id; ?>" <?php if ($timeline_row->id == $row->timeline_id) echo "selected='selected'"; ?> ><?php echo $timeline_row->name;?></option>
								<?php
									}
								?>
							</select>
							<?php } ?>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Section to get articles from">
							<label for="section"><u>Section</u></label>
						</td>
						<td>
							<select id="section_id" name="section_id">
								<?php
									foreach($sections_rows as $section_row) {
								?>
								<option name="0" value="<?php echo $section_row->id; ?>"><?php echo $section_row->title;?></option>
								<?php
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Category to get articles from">
							<label for="category"><u>Category</u></label>
						</td>
						<td>
							<select id="category_id" name="category_id">
								<?php
									foreach($categories_rows as $category_row) {
								?>
								<option name="0" value="<?php echo $category_row->id; ?>"><?php echo $category_row->title;?></option>
								<?php
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Should timeline be published or not">
							<label for="published">Published</label>
						</td>
						<td>
							<?php echo JHTML::_('select.booleanlist',  'published', '', $row->published ); ?>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Description for timeline">
							<label for="description">Description</label>
						</td>
						<td>
							<textarea class="inputbox" type="text" name="description" id="description" cols="28" rows="4"><?php echo $row->description; ?></textarea>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Date-Time format for timeline. Default value is iso8601">
							<label for="datetime_format">Date-Time Format</label>
						</td>
						<td>
							<?php
								$datetime_format = $row->id ? $row->datetime_format : 'iso8601';
							?>
							<input class="inputbox" type="text" name="datetime_format" id="datetime_format" size="40" maxlength="255" value="<?php echo $datetime_format; ?>" />
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Timeline theme. Default value is ClassicTheme">
							<label for="theme">Theme</label>
						</td>
						<td>
							<select id="theme" name="theme">
								<option name="ClassicTheme" value="ClassicTheme" <?php if ($row->theme == 'ClassicTheme') echo "selected='selected'"; ?> >ClassicTheme</option>
							</select>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Interval unit for timeline: from millisecond to millemium. Default value is Week">
							<label for="interval_unit">Interval Unit</label>
						</td>
						<td>
							<select id="interval_unit" name="interval_unit">
								<option name="0" value="0" <?php if ($row->interval_unit == '0') echo "selected='selected'"; ?> >Millisecond</option>
								<option name="1" value="1" <?php if ($row->interval_unit == '1') echo "selected='selected'"; ?> >Second</option>
								<option name="2" value="2" <?php if ($row->interval_unit == '2') echo "selected='selected'"; ?> >Minute</option>
								<option name="3" value="3" <?php if ($row->interval_unit == '3') echo "selected='selected'"; ?> >Hour</option>
								<option name="4" value="4" <?php if ($row->interval_unit == '4') echo "selected='selected'"; ?> >Day</option>
								<option name="5" value="5" <?php if ($row->interval_unit == '5' || !$row->interval_unit) echo "selected='selected'"; ?> >Week</option>
								<option name="6" value="6" <?php if ($row->interval_unit == '6') echo "selected='selected'"; ?> >Month</option>
								<option name="7" value="7" <?php if ($row->interval_unit == '7') echo "selected='selected'"; ?> >Year</option>
								<option name="8" value="8" <?php if ($row->interval_unit == '8') echo "selected='selected'"; ?> >Decade</option>
								<option name="9" value="9" <?php if ($row->interval_unit == '9') echo "selected='selected'"; ?> >Century</option>
								<option name="10" value="10" <?php if ($row->interval_unit == '10') echo "selected='selected'"; ?> >Millemium</option>
							</select>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="How many pixels for interval. Default value is 100">
							<label for="interval_pixel">Interval Pixels</label>
						</td>
						<td>
							<?php
								$interval_pixel = $row->id ? $row->interval_pixel : '100';
							?>
							<input class="inputbox" type="text" name="interval_pixel" id="interval_pixel" size="40" maxlength="255" value="<?php echo $interval_pixel; ?>" />
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Start date for timeline">
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
						<td width="20%" class="key" title="Width of timeline container. Example: 100 or 100%">
							<label for="width">Width</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="width" id="width" size="40" maxlength="255" value="<?php echo $row->width; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="width" id="width" size="40" maxlength="255" value="100%" />
							<?php } ?>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Direction of timeline">
							<label for="direction">Direction</label>
						</td>
						<td>
							<select id="direction" name="direction">
								<option name="VERTICAL" value="VERTICAL" <?php if ($row->direction == 'VERTICAL') echo "selected='selected'"; ?> >Vertical</option>
								<option name="HORIZONTAL" value="HORIZONTAL" <?php if ($row->direction == 'HORIZONTAL' || !$row->direction) echo "selected='selected'"; ?> >Horizontal</option>
							</select>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Width of event bubble">
							<label for="bubble_width">Bubble Width</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="bubble_width" id="bubble_width" size="40" maxlength="255" value="<?php echo $row->bubble_width; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="bubble_width" id="bubble_width" size="40" maxlength="255" value="320" />
							<?php } ?>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Height of event bubble">
							<label for="bubble_height">Bubble Height</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="bubble_height" id="bubble_height" size="40" maxlength="255" value="<?php echo $row->bubble_height; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="bubble_height" id="bubble_height" size="40" maxlength="255" value="120" />
							<?php } ?>
	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Image. Located in components/com_intotimeline/img folder">
							<label for="event_img">Event Image</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_img" id="event_img" size="40" maxlength="255" value="<?php echo $row->event_img; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_img" id="event_img" size="40" maxlength="255" value="dull-blue-circle.png" />
							<?php } ?>
	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Line Color">
							<label for="event_line_color">Event Line Color</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_line_color" id="event_line_color" size="40" maxlength="255" value="<?php echo $row->event_line_color; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_line_color" id="event_line_color" size="40" maxlength="255" value="#58A0DC" />
							<?php } ?>
	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Imprecise Color">
							<label for="event_imprecise_color">Event Imprecise Color</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_imprecise_color" id="event_imprecise_color" size="40" maxlength="255" value="<?php echo $row->event_imprecise_color; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_imprecise_color" id="event_imprecise_color" size="40" maxlength="255" value="#58A0DC" />
							<?php } ?>
	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Imprecise Opacity">
							<label for="event_imprecise_opacity">Event Imprecise Opacity</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_imprecise_opacity" id="event_imprecise_opacity" size="40" maxlength="255" value="<?php echo $row->event_imprecise_opacity; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_imprecise_opacity" id="event_imprecise_opacity" size="40" maxlength="255" value="20" />
							<?php } ?>
	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Duration Color">
							<label for="event_duration_color">Event Duration Color</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_duration_color" id="event_duration_color" size="40" maxlength="255" value="<?php echo $row->event_duration_color; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_duration_color" id="event_duration_color" size="40" maxlength="255" value="#58A0DC" />
							<?php } ?>
	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Duration Opacity">
							<label for="event_duration_opacity">Event Duration Opacity</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_duration_opacity" id="event_duration_opacity" size="40" maxlength="255" value="<?php echo $row->event_duration_opacity; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_duration_opacity" id="event_duration_opacity" size="40" maxlength="255" value="100" />
							<?php } ?>
	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Duration Imprecise Color">
							<label for="event_duration_imprecise_color">Event Duration Imprecise Color</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_duration_imprecise_color" id="event_duration_imprecise_color" size="40" maxlength="255" value="<?php echo $row->event_duration_imprecise_color; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_duration_imprecise_color" id="event_duration_imprecise_color" size="40" maxlength="255" value="#58A0DC" />
							<?php } ?>
	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Duration Imprecise Opacity">
							<label for="event_duration_imprecise_opacity">Event Duration Imprecise Opacity</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_duration_imprecise_opacity" id="event_duration_imprecise_opacity" size="40" maxlength="255" value="<?php echo $row->event_duration_imprecise_opacity; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_duration_imprecise_opacity" id="event_duration_imprecise_opacity" size="40" maxlength="255" value="20" />
							<?php } ?>
	
						</td>
					</tr>
				</tbody>
			</table>
			</fieldset>
		</div>
		
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="id" value="" />
		<input type="hidden" name="modifiedby" value="<?php echo $user->id; ?>" />
		<input type="hidden" name="modified" value="<?php echo date( 'Y-m-d H:i:s' ); ?>" />
		</form>
		<script type="text/javascript">
			window.addEvent("domready", function() {
				fromArticles('timelinefromarticles_save');
			});
		</script>
		<?php
	}
  
  function timelinefromk2_edit($option, &$row) {
		HTML_Timeline::setTimelineFromk2Toolbar();
		HTML_Timeline::includeResources();
		JHTML::_('behavior.calendar');
		$user =& JFactory::getUser();
		$db	=& JFactory::getDBO();
		$db->setQuery("SELECT id, name from #__k2_categories");
		$k2_rows = $db->loadObjectList(); 
		?>
		<form action="index.php" method="post" name="adminForm">
		<div class="col100" id="editForm">
			<fieldset class="adminform">
			<table class="admintable">
				<tbody>
					<tr>
						<td width="20%" class="key" title="K2 category">
							<label for="k2category_id">K2 category</label>
						</td>
						<td>
							<select id="k2category_id" name="k2category_id">
                <option name="0" value="-1">---Select---</option>
								<?php
									foreach($k2_rows as $k2_row) {
								?>
								<option name="0" value="<?php echo $k2_row->id; ?>"><?php echo $k2_row->name;?></option>
								<?php
									}
								?>
							</select>
						</td>
					</tr> 
					<tr>
						<td width="20%" class="key" title="Name for timeline">
							<label for="name">Name</label>
						</td>
						<td>
							<input class="inputbox" type="text" name="name" id="name" size="40" maxlength="255" value="<?php echo $row->name; ?>" />
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Should timeline be published or not">
							<label for="published">Published</label>
						</td>
						<td>
							<?php echo JHTML::_('select.booleanlist',  'published', '', $row->published ); ?>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Description for timeline">
							<label for="description">Description</label>
						</td>
						<td>
							<textarea class="inputbox" type="text" name="description" id="description" cols="28" rows="4"><?php echo $row->description; ?></textarea>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Date-Time format for timeline. Default value is iso8601">
							<label for="datetime_format">Date-Time Format</label>
						</td>
						<td>
							<?php
								$datetime_format = $row->id ? $row->datetime_format : 'iso8601';
							?>
							<input class="inputbox" type="text" name="datetime_format" id="datetime_format" size="40" maxlength="255" value="<?php echo $datetime_format; ?>" />
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Timeline theme. Default value is ClassicTheme">
							<label for="theme">Theme</label>
						</td>
						<td>
							<select id="theme" name="theme">
								<option name="ClassicTheme" value="ClassicTheme" <?php if ($row->theme == 'ClassicTheme') echo "selected='selected'"; ?> >ClassicTheme</option>
							</select>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Interval unit for timeline: from millisecond to millemium. Default value is Week">
							<label for="interval_unit">Interval Unit</label>
						</td>
						<td>
							<select id="interval_unit" name="interval_unit">
								<option name="0" value="0" <?php if ($row->interval_unit == '0') echo "selected='selected'"; ?> >Millisecond</option>
								<option name="1" value="1" <?php if ($row->interval_unit == '1') echo "selected='selected'"; ?> >Second</option>
								<option name="2" value="2" <?php if ($row->interval_unit == '2') echo "selected='selected'"; ?> >Minute</option>
								<option name="3" value="3" <?php if ($row->interval_unit == '3') echo "selected='selected'"; ?> >Hour</option>
								<option name="4" value="4" <?php if ($row->interval_unit == '4') echo "selected='selected'"; ?> >Day</option>
								<option name="5" value="5" <?php if ($row->interval_unit == '5' || !$row->interval_unit) echo "selected='selected'"; ?> >Week</option>
								<option name="6" value="6" <?php if ($row->interval_unit == '6') echo "selected='selected'"; ?> >Month</option>
								<option name="7" value="7" <?php if ($row->interval_unit == '7') echo "selected='selected'"; ?> >Year</option>
								<option name="8" value="8" <?php if ($row->interval_unit == '8') echo "selected='selected'"; ?> >Decade</option>
								<option name="9" value="9" <?php if ($row->interval_unit == '9') echo "selected='selected'"; ?> >Century</option>
								<option name="10" value="10" <?php if ($row->interval_unit == '10') echo "selected='selected'"; ?> >Millemium</option>
							</select>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="How many pixels for interval. Default value is 100">
							<label for="interval_pixel">Interval Pixels</label>
						</td>
						<td>
							<?php
								$interval_pixel = $row->id ? $row->interval_pixel : '100';
							?>
							<input class="inputbox" type="text" name="interval_pixel" id="interval_pixel" size="40" maxlength="255" value="<?php echo $interval_pixel; ?>" />
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Start date for timeline">
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
						<td width="20%" class="key" title="Width of timeline container. Example: 100 or 100%">
							<label for="width">Width</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="width" id="width" size="40" maxlength="255" value="<?php echo $row->width; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="width" id="width" size="40" maxlength="255" value="100%" />
							<?php } ?>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Direction of timeline">
							<label for="direction">Direction</label>
						</td>
						<td>
							<select id="direction" name="direction">
								<option name="VERTICAL" value="VERTICAL" <?php if ($row->direction == 'VERTICAL') echo "selected='selected'"; ?> >Vertical</option>
								<option name="HORIZONTAL" value="HORIZONTAL" <?php if ($row->direction == 'HORIZONTAL' || !$row->direction) echo "selected='selected'"; ?> >Horizontal</option>
							</select>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Width of event bubble">
							<label for="bubble_width">Bubble Width</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="bubble_width" id="bubble_width" size="40" maxlength="255" value="<?php echo $row->bubble_width; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="bubble_width" id="bubble_width" size="40" maxlength="255" value="320" />
							<?php } ?>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Height of event bubble">
							<label for="bubble_height">Bubble Height</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="bubble_height" id="bubble_height" size="40" maxlength="255" value="<?php echo $row->bubble_height; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="bubble_height" id="bubble_height" size="40" maxlength="255" value="120" />
							<?php } ?>
	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Image. Located in components/com_intotimeline/img folder">
							<label for="event_img">Event Image</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_img" id="event_img" size="40" maxlength="255" value="<?php echo $row->event_img; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_img" id="event_img" size="40" maxlength="255" value="dull-blue-circle.png" />
							<?php } ?>
	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Line Color">
							<label for="event_line_color">Event Line Color</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_line_color" id="event_line_color" size="40" maxlength="255" value="<?php echo $row->event_line_color; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_line_color" id="event_line_color" size="40" maxlength="255" value="#58A0DC" />
							<?php } ?>
	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Imprecise Color">
							<label for="event_imprecise_color">Event Imprecise Color</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_imprecise_color" id="event_imprecise_color" size="40" maxlength="255" value="<?php echo $row->event_imprecise_color; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_imprecise_color" id="event_imprecise_color" size="40" maxlength="255" value="#58A0DC" />
							<?php } ?>
	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Imprecise Opacity">
							<label for="event_imprecise_opacity">Event Imprecise Opacity</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_imprecise_opacity" id="event_imprecise_opacity" size="40" maxlength="255" value="<?php echo $row->event_imprecise_opacity; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_imprecise_opacity" id="event_imprecise_opacity" size="40" maxlength="255" value="20" />
							<?php } ?>
	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Duration Color">
							<label for="event_duration_color">Event Duration Color</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_duration_color" id="event_duration_color" size="40" maxlength="255" value="<?php echo $row->event_duration_color; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_duration_color" id="event_duration_color" size="40" maxlength="255" value="#58A0DC" />
							<?php } ?>
	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Duration Opacity">
							<label for="event_duration_opacity">Event Duration Opacity</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_duration_opacity" id="event_duration_opacity" size="40" maxlength="255" value="<?php echo $row->event_duration_opacity; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_duration_opacity" id="event_duration_opacity" size="40" maxlength="255" value="100" />
							<?php } ?>
	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Duration Imprecise Color">
							<label for="event_duration_imprecise_color">Event Duration Imprecise Color</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_duration_imprecise_color" id="event_duration_imprecise_color" size="40" maxlength="255" value="<?php echo $row->event_duration_imprecise_color; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_duration_imprecise_color" id="event_duration_imprecise_color" size="40" maxlength="255" value="#58A0DC" />
							<?php } ?>
	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Duration Imprecise Opacity">
							<label for="event_duration_imprecise_opacity">Event Duration Imprecise Opacity</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_duration_imprecise_opacity" id="event_duration_imprecise_opacity" size="40" maxlength="255" value="<?php echo $row->event_duration_imprecise_opacity; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_duration_imprecise_opacity" id="event_duration_imprecise_opacity" size="40" maxlength="255" value="20" />
							<?php } ?>
	
						</td>
					</tr>
				</tbody>
			</table>
			</fieldset>
		</div>
		
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="id" value="" />
		<input type="hidden" name="modifiedby" value="<?php echo $user->id; ?>" />
		<input type="hidden" name="modified" value="<?php echo date( 'Y-m-d H:i:s' ); ?>" />
		</form>
		<script type="text/javascript">
			window.addEvent("domready", function() {
				fromK2('timelinefromk2_save');
			});
		</script>
		<?php
	}
	
	function timelinefromcsv_edit($option, &$row) {
		HTML_Timeline::setTimelineFromCSVToolbar();
		HTML_Timeline::includeResources();		
		JHTML::_('behavior.calendar');
		$user =& JFactory::getUser();
		$db	=& JFactory::getDBO();
		?>
		<form action="index.php" method="post" name="adminForm">
		<div class="col100" id="editForm">
			<fieldset class="adminform">
			<table class="admintable">
				<tbody>
					<tr>
						<td width="20%" class="key" title="CSV file. Please indicate path on server like docs/my.csv.<br /> Format: title,description,start_date,end_date,image,link">
							<label for="name"><u>CSV file</u></label>
						</td>
						<td>
							<input class="inputbox" type="text" name="csv" id="csv" size="40" maxlength="255" value="" />
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Name for timeline">
							<label for="name">Name</label>
						</td>
						<td>
							<input class="inputbox" type="text" name="name" id="name" size="40" maxlength="255" value="<?php echo $row->name; ?>" />
							<?php
								$db->setQuery("SELECT id, name from #__tl_timeline");
								$timeline_rows = $db->loadObjectList();
								if (count($timeline_rows) > 0) {
							?>
							&nbsp;Or select existing timeline 
							<select id="timeline_id" name="timeline_id">
								<option name="0" value="-1">---</option>
								<?php
									foreach($timeline_rows as $timeline_row) {
								?>
								<option name="0" value="<?php echo $timeline_row->id; ?>" <?php if ($timeline_row->id == $row->timeline_id) echo "selected='selected'"; ?> ><?php echo $timeline_row->name;?></option>
								<?php
									}
								?>
							</select>
							<?php } ?>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Should timeline be published or not">
							<label for="published">Published</label>
						</td>
						<td>
							<?php echo JHTML::_('select.booleanlist',  'published', '', $row->published ); ?>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Description for timeline">
							<label for="description">Description</label>
						</td>
						<td>
							<textarea class="inputbox" type="text" name="description" id="description" cols="28" rows="4"><?php echo $row->description; ?></textarea>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Date-Time format for timeline. Default value is iso8601">
							<label for="datetime_format">Date-Time Format</label>
						</td>
						<td>
							<?php
								$datetime_format = $row->id ? $row->datetime_format : 'iso8601';
							?>
							<input class="inputbox" type="text" name="datetime_format" id="datetime_format" size="40" maxlength="255" value="<?php echo $datetime_format; ?>" />
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Timeline theme. Default value is ClassicTheme">
							<label for="theme">Theme</label>
						</td>
						<td>
							<select id="theme" name="theme">
								<option name="ClassicTheme" value="ClassicTheme" <?php if ($row->theme == 'ClassicTheme') echo "selected='selected'"; ?> >ClassicTheme</option>
							</select>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Interval unit for timeline: from millisecond to millemium. Default value is Week">
							<label for="interval_unit">Interval Unit</label>
						</td>
						<td>
							<select id="interval_unit" name="interval_unit">
								<option name="0" value="0" <?php if ($row->interval_unit == '0') echo "selected='selected'"; ?> >Millisecond</option>
								<option name="1" value="1" <?php if ($row->interval_unit == '1') echo "selected='selected'"; ?> >Second</option>
								<option name="2" value="2" <?php if ($row->interval_unit == '2') echo "selected='selected'"; ?> >Minute</option>
								<option name="3" value="3" <?php if ($row->interval_unit == '3') echo "selected='selected'"; ?> >Hour</option>
								<option name="4" value="4" <?php if ($row->interval_unit == '4') echo "selected='selected'"; ?> >Day</option>
								<option name="5" value="5" <?php if ($row->interval_unit == '5' || !$row->interval_unit) echo "selected='selected'"; ?> >Week</option>
								<option name="6" value="6" <?php if ($row->interval_unit == '6') echo "selected='selected'"; ?> >Month</option>
								<option name="7" value="7" <?php if ($row->interval_unit == '7') echo "selected='selected'"; ?> >Year</option>
								<option name="8" value="8" <?php if ($row->interval_unit == '8') echo "selected='selected'"; ?> >Decade</option>
								<option name="9" value="9" <?php if ($row->interval_unit == '9') echo "selected='selected'"; ?> >Century</option>
								<option name="10" value="10" <?php if ($row->interval_unit == '10') echo "selected='selected'"; ?> >Millemium</option>
							</select>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="How many pixels for interval. Default value is 100">
							<label for="interval_pixel">Interval Pixels</label>
						</td>
						<td>
							<?php
								$interval_pixel = $row->id ? $row->interval_pixel : '100';
							?>
							<input class="inputbox" type="text" name="interval_pixel" id="interval_pixel" size="40" maxlength="255" value="<?php echo $interval_pixel; ?>" />
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Start date for timeline">
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
						<td width="20%" class="key" title="Width of timeline container. Example: 100 or 100%">
							<label for="width">Width</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="width" id="width" size="40" maxlength="255" value="<?php echo $row->width; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="width" id="width" size="40" maxlength="255" value="100%" />
							<?php } ?>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Direction of timeline">
							<label for="direction">Direction</label>
						</td>
						<td>
							<select id="direction" name="direction">
								<option name="VERTICAL" value="VERTICAL" <?php if ($row->direction == 'VERTICAL') echo "selected='selected'"; ?> >Vertical</option>
								<option name="HORIZONTAL" value="HORIZONTAL" <?php if ($row->direction == 'HORIZONTAL' || !$row->direction) echo "selected='selected'"; ?> >Horizontal</option>
							</select>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Width of event bubble">
							<label for="bubble_width">Bubble Width</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="bubble_width" id="bubble_width" size="40" maxlength="255" value="<?php echo $row->bubble_width; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="bubble_width" id="bubble_width" size="40" maxlength="255" value="320" />
							<?php } ?>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Height of event bubble">
							<label for="bubble_height">Bubble Height</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="bubble_height" id="bubble_height" size="40" maxlength="255" value="<?php echo $row->bubble_height; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="bubble_height" id="bubble_height" size="40" maxlength="255" value="120" />
							<?php } ?>
	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Image. Located in components/com_intotimeline/img folder">
							<label for="event_img">Event Image</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_img" id="event_img" size="40" maxlength="255" value="<?php echo $row->event_img; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_img" id="event_img" size="40" maxlength="255" value="dull-blue-circle.png" />
							<?php } ?>
	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Line Color">
							<label for="event_line_color">Event Line Color</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_line_color" id="event_line_color" size="40" maxlength="255" value="<?php echo $row->event_line_color; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_line_color" id="event_line_color" size="40" maxlength="255" value="#58A0DC" />
							<?php } ?>
	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Imprecise Color">
							<label for="event_imprecise_color">Event Imprecise Color</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_imprecise_color" id="event_imprecise_color" size="40" maxlength="255" value="<?php echo $row->event_imprecise_color; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_imprecise_color" id="event_imprecise_color" size="40" maxlength="255" value="#58A0DC" />
							<?php } ?>
	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Imprecise Opacity">
							<label for="event_imprecise_opacity">Event Imprecise Opacity</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_imprecise_opacity" id="event_imprecise_opacity" size="40" maxlength="255" value="<?php echo $row->event_imprecise_opacity; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_imprecise_opacity" id="event_imprecise_opacity" size="40" maxlength="255" value="20" />
							<?php } ?>
	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Duration Color">
							<label for="event_duration_color">Event Duration Color</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_duration_color" id="event_duration_color" size="40" maxlength="255" value="<?php echo $row->event_duration_color; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_duration_color" id="event_duration_color" size="40" maxlength="255" value="#58A0DC" />
							<?php } ?>
	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Duration Opacity">
							<label for="event_duration_opacity">Event Duration Opacity</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_duration_opacity" id="event_duration_opacity" size="40" maxlength="255" value="<?php echo $row->event_duration_opacity; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_duration_opacity" id="event_duration_opacity" size="40" maxlength="255" value="100" />
							<?php } ?>
	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Duration Imprecise Color">
							<label for="event_duration_imprecise_color">Event Duration Imprecise Color</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_duration_imprecise_color" id="event_duration_imprecise_color" size="40" maxlength="255" value="<?php echo $row->event_duration_imprecise_color; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_duration_imprecise_color" id="event_duration_imprecise_color" size="40" maxlength="255" value="#58A0DC" />
							<?php } ?>
	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Duration Imprecise Opacity">
							<label for="event_duration_imprecise_opacity">Event Duration Imprecise Opacity</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_duration_imprecise_opacity" id="event_duration_imprecise_opacity" size="40" maxlength="255" value="<?php echo $row->event_duration_imprecise_opacity; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_duration_imprecise_opacity" id="event_duration_imprecise_opacity" size="40" maxlength="255" value="20" />
							<?php } ?>
	
						</td>
					</tr>
				</tbody>
			</table>
			</fieldset>
		</div>
		
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="id" value="" />
		<input type="hidden" name="modifiedby" value="<?php echo $user->id; ?>" />
		<input type="hidden" name="modified" value="<?php echo date( 'Y-m-d H:i:s' ); ?>" />
		</form>
		<script type="text/javascript">
			window.addEvent("domready", function() {
				fromCSV('timelinefromcsv_save');
			});
		</script>
		<?php
	}
	
	function timelinefromsql_edit($option, &$row) {
		HTML_Timeline::setTimelineFromSQLToolbar();
		HTML_Timeline::includeResources();
		JHTML::_('behavior.calendar');
		$user =& JFactory::getUser();
		$db	=& JFactory::getDBO();
		?>
		<form action="index.php" method="post" name="adminForm">
		<div class="col100" id="editForm">
			<fieldset class="adminform">
			<table class="admintable">
				<tbody>
					<tr>
						<td width="20%" class="key" title="Name for timeline">
							<label for="name">Name</label>
						</td>
						<td>
							<input class="inputbox" type="text" name="name" id="name" size="40" maxlength="255" value="<?php echo $row->name; ?>" />
							<?php
								$db->setQuery("SELECT id, name from #__tl_timeline");
								$timeline_rows = $db->loadObjectList();
								if (count($timeline_rows) > 0) {
							?>
							&nbsp;Or select existing timeline 
							<select id="timeline_id" name="timeline_id">
								<option name="0" value="-1">---</option>
								<?php
									foreach($timeline_rows as $timeline_row) {
								?>
								<option name="0" value="<?php echo $timeline_row->id; ?>" <?php if ($timeline_row->id == $row->timeline_id) echo "selected='selected'"; ?> ><?php echo $timeline_row->name;?></option>
								<?php
									}
								?>
							</select>
							<?php } ?>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="SQL to create events from for new timeline. <br />Example: SELECT title, introtext as description, created as start_date, last_modified as end_date, image, link FROM #__mytable">
							<label for="sql"><u>SQL Query</u></label>
						</td>
						<td>
							<textarea class="inputbox" type="text" name="sql" id="sql" cols="28" rows="4"></textarea>
					</tr>
					<tr>
						<td width="20%" class="key" title="Should timeline be published or not">
							<label for="published">Published</label>
						</td>
						<td>
							<?php echo JHTML::_('select.booleanlist',  'published', '', $row->published ); ?>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Description for timeline">
							<label for="description">Description</label>
						</td>
						<td>
							<textarea class="inputbox" type="text" name="description" id="description" cols="28" rows="4"><?php echo $row->description; ?></textarea>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Date-Time format for timeline. Default value is iso8601">
							<label for="datetime_format">Date-Time Format</label>
						</td>
						<td>
							<?php
								$datetime_format = $row->id ? $row->datetime_format : 'iso8601';
							?>
							<input class="inputbox" type="text" name="datetime_format" id="datetime_format" size="40" maxlength="255" value="<?php echo $datetime_format; ?>" />
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Timeline theme. Default value is ClassicTheme">
							<label for="theme">Theme</label>
						</td>
						<td>
							<select id="theme" name="theme">
								<option name="ClassicTheme" value="ClassicTheme" <?php if ($row->theme == 'ClassicTheme') echo "selected='selected'"; ?> >ClassicTheme</option>
							</select>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Interval unit for timeline: from millisecond to millemium. Default value is Week">
							<label for="interval_unit">Interval Unit</label>
						</td>
						<td>
							<select id="interval_unit" name="interval_unit">
								<option name="0" value="0" <?php if ($row->interval_unit == '0') echo "selected='selected'"; ?> >Millisecond</option>
								<option name="1" value="1" <?php if ($row->interval_unit == '1') echo "selected='selected'"; ?> >Second</option>
								<option name="2" value="2" <?php if ($row->interval_unit == '2') echo "selected='selected'"; ?> >Minute</option>
								<option name="3" value="3" <?php if ($row->interval_unit == '3') echo "selected='selected'"; ?> >Hour</option>
								<option name="4" value="4" <?php if ($row->interval_unit == '4') echo "selected='selected'"; ?> >Day</option>
								<option name="5" value="5" <?php if ($row->interval_unit == '5' || !$row->interval_unit) echo "selected='selected'"; ?> >Week</option>
								<option name="6" value="6" <?php if ($row->interval_unit == '6') echo "selected='selected'"; ?> >Month</option>
								<option name="7" value="7" <?php if ($row->interval_unit == '7') echo "selected='selected'"; ?> >Year</option>
								<option name="8" value="8" <?php if ($row->interval_unit == '8') echo "selected='selected'"; ?> >Decade</option>
								<option name="9" value="9" <?php if ($row->interval_unit == '9') echo "selected='selected'"; ?> >Century</option>
								<option name="10" value="10" <?php if ($row->interval_unit == '10') echo "selected='selected'"; ?> >Millemium</option>
							</select>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="How many pixels for interval. Default value is 100">
							<label for="interval_pixel">Interval Pixels</label>
						</td>
						<td>
							<?php
								$interval_pixel = $row->id ? $row->interval_pixel : '100';
							?>
							<input class="inputbox" type="text" name="interval_pixel" id="interval_pixel" size="40" maxlength="255" value="<?php echo $interval_pixel; ?>" />
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Start date for timeline">
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
						<td width="20%" class="key" title="Width of timeline container. Example: 100 or 100%">
							<label for="width">Width</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="width" id="width" size="40" maxlength="255" value="<?php echo $row->width; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="width" id="width" size="40" maxlength="255" value="100%" />
							<?php } ?>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Direction of timeline">
							<label for="direction">Direction</label>
						</td>
						<td>
							<select id="direction" name="direction">
								<option name="VERTICAL" value="VERTICAL" <?php if ($row->direction == 'VERTICAL') echo "selected='selected'"; ?> >Vertical</option>
								<option name="HORIZONTAL" value="HORIZONTAL" <?php if ($row->direction == 'HORIZONTAL' || !$row->direction) echo "selected='selected'"; ?> >Horizontal</option>
							</select>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Width of event bubble">
							<label for="bubble_width">Bubble Width</label>
						</td>
						<td>
							<?php if ($row->id) { ?>
								<input class="inputbox" type="text" name="bubble_width" id="bubble_width" size="40" maxlength="255" value="<?php echo $row->bubble_width; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="bubble_width" id="bubble_width" size="40" maxlength="255" value="320" />
							<?php } ?>
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Height of event bubble">
							<label for="bubble_height">Bubble Height</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="bubble_height" id="bubble_height" size="40" maxlength="255" value="<?php echo $row->bubble_height; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="bubble_height" id="bubble_height" size="40" maxlength="255" value="120" />
							<?php } ?>
	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Image. Located in components/com_intotimeline/img folder">
							<label for="event_img">Event Image</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_img" id="event_img" size="40" maxlength="255" value="<?php echo $row->event_img; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_img" id="event_img" size="40" maxlength="255" value="dull-blue-circle.png" />
							<?php } ?>
	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Line Color">
							<label for="event_line_color">Event Line Color</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_line_color" id="event_line_color" size="40" maxlength="255" value="<?php echo $row->event_line_color; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_line_color" id="event_line_color" size="40" maxlength="255" value="#58A0DC" />
							<?php } ?>
	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Imprecise Color">
							<label for="event_imprecise_color">Event Imprecise Color</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_imprecise_color" id="event_imprecise_color" size="40" maxlength="255" value="<?php echo $row->event_imprecise_color; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_imprecise_color" id="event_imprecise_color" size="40" maxlength="255" value="#58A0DC" />
							<?php } ?>
	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Imprecise Opacity">
							<label for="event_imprecise_opacity">Event Imprecise Opacity</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_imprecise_opacity" id="event_imprecise_opacity" size="40" maxlength="255" value="<?php echo $row->event_imprecise_opacity; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_imprecise_opacity" id="event_imprecise_opacity" size="40" maxlength="255" value="20" />
							<?php } ?>
	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Duration Color">
							<label for="event_duration_color">Event Duration Color</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_duration_color" id="event_duration_color" size="40" maxlength="255" value="<?php echo $row->event_duration_color; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_duration_color" id="event_duration_color" size="40" maxlength="255" value="#58A0DC" />
							<?php } ?>
	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Duration Opacity">
							<label for="event_duration_opacity">Event Duration Opacity</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_duration_opacity" id="event_duration_opacity" size="40" maxlength="255" value="<?php echo $row->event_duration_opacity; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_duration_opacity" id="event_duration_opacity" size="40" maxlength="255" value="100" />
							<?php } ?>
	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Duration Imprecise Color">
							<label for="event_duration_imprecise_color">Event Duration Imprecise Color</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_duration_imprecise_color" id="event_duration_imprecise_color" size="40" maxlength="255" value="<?php echo $row->event_duration_imprecise_color; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_duration_imprecise_color" id="event_duration_imprecise_color" size="40" maxlength="255" value="#58A0DC" />
							<?php } ?>
	
						</td>
					</tr>
					<tr>
						<td width="20%" class="key" title="Event Duration Imprecise Opacity">
							<label for="event_duration_imprecise_opacity">Event Duration Imprecise Opacity</label>
						</td>
						<td>
							<?php if ($row->id) {?>
								<input class="inputbox" type="text" name="event_duration_imprecise_opacity" id="event_duration_imprecise_opacity" size="40" maxlength="255" value="<?php echo $row->event_duration_imprecise_opacity; ?>" />
							<?php } else { ?>
								<input class="inputbox" type="text" name="event_duration_imprecise_opacity" id="event_duration_imprecise_opacity" size="40" maxlength="255" value="20" />
							<?php } ?>
	
						</td>
					</tr>
				</tbody>
			</table>
			</fieldset>
		</div>
		
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="id" value="" />
		<input type="hidden" name="modifiedby" value="<?php echo $user->id; ?>" />
		<input type="hidden" name="modified" value="<?php echo date( 'Y-m-d H:i:s' ); ?>" />
		</form>
		<script type="text/javascript">
			window.addEvent("domready", function() {
				fromSQL('timelinefromsql_save');
			});
		</script>
		<?php
	}
	
	function setTimelineToolbar($id) {
		if ($id) {
			$newEdit = 'Edit';
		} else {
			$newEdit = 'New';
		}
		
		JToolBarHelper::title($newEdit . ' Timeline', 'addedit.png');
		JToolBarHelper::custom('timeline_save', 'save.png', 'default.png', 'Save Timeline', false);
		JToolBarHelper::cancel();
	}
	
	function setCategoryToolbar($id) {
		if ($id) {
			$newEdit = 'Edit';
		} else {
			$newEdit = 'New';
		}
		
		JToolBarHelper::title($newEdit . ' Category', 'addedit.png');
		JToolBarHelper::custom('category_save', 'save.png', 'default.png', 'Save Category', false);
		JToolBarHelper::custom('category_list', 'cancel.png', 'default.png', 'Cancel', false);
	}
	
	function setYearToolbar($id) {
		if ($id) {
			$newEdit = 'Edit';
		} else {
			$newEdit = 'New';
		}
		
		JToolBarHelper::title($newEdit . ' Year', 'addedit.png');
		JToolBarHelper::custom('year_save', 'save.png', 'default.png', 'Save Year', false);
		JToolBarHelper::custom('year_list', 'cancel.png', 'default.png', 'Cancel', false);
	}
	
	function setTimelineFromArticlesToolbar() {
		JToolBarHelper::title('New Timeline', 'addedit.png');
		JToolBarHelper::custom('timelinefromarticles_save', 'save.png', 'default.png', 'Save Timeline', false);
		JToolBarHelper::custom('settings', 'cancel.png', 'default.png', 'Cancel', false);
	}
	
	function setTimelineFromSQLToolbar() {
		JToolBarHelper::title('New Timeline', 'addedit.png');
		JToolBarHelper::custom('timelinefromsql_save', 'save.png', 'default.png', 'Save Timeline', false);
		JToolBarHelper::custom('settings', 'cancel.png', 'default.png', 'Cancel', false);
	}
	
	function setTimelineFromCSVToolbar() {
		JToolBarHelper::title('New Timeline', 'addedit.png');
		JToolBarHelper::custom('timelinefromcsv_save', 'save.png', 'default.png', 'Save Timeline', false);
		JToolBarHelper::custom('settings', 'cancel.png', 'default.png', 'Cancel', false);
	}
  
  function setTimelineFromk2Toolbar() {
		JToolBarHelper::title('New Timeline', 'addedit.png');
		JToolBarHelper::custom('timelinefromk2_save', 'save.png', 'default.png', 'Save Timeline', false);
		JToolBarHelper::custom('settings', 'cancel.png', 'default.png', 'Cancel', false);
	}
	
	function setTimelinesListToolbar() {
		JToolBarHelper::title('Timelines', 'categories.png');
		JToolBarHelper::custom('timeline_publish', 'publish.png', 'default.png', 'Publish', true);
		JToolBarHelper::custom('timeline_unpublish', 'unpublish.png', 'default.png', 'Unpublish', true);
		JToolBarHelper::addNew();
		JToolBarHelper::custom('timeline_edit', 'edit.png', 'default.png', 'Edit', true);
		JToolBarHelper::custom('timeline_remove', 'delete.png', 'default.png', 'Delete', true);
		JToolBarHelper::custom('timeline_generatejs', 'default.png', 'default.png', 'Generate Timelines', true);
	}
	
	function setCategoryListToolbar() {
		JToolBarHelper::title('Categories', 'categories.png');
		JToolBarHelper::custom('category_edit', 'new.png', 'default.png', 'New', false);
		JToolBarHelper::custom('category_edit', 'edit.png', 'default.png', 'Edit', true);
		JToolBarHelper::custom('category_remove', 'delete.png', 'default.png', 'Delete', true);
	}
	
	function setYearListToolbar() {
		JToolBarHelper::title('Years for jump-to drop-down', 'categories.png');
		JToolBarHelper::custom('year_edit', 'new.png', 'default.png', 'New', false);
		JToolBarHelper::custom('year_edit', 'edit.png', 'default.png', 'Edit', true);
		JToolBarHelper::custom('year_remove', 'delete.png', 'default.png', 'Delete', true);
	}
	
	function setEventToolbar($id) {
		if ($id) {
			$newEdit = 'Edit';
		} else {
			$newEdit = 'New';
		}
		
		JToolBarHelper::title($newEdit . ' Event', 'generic.png');
		JToolBarHelper::custom('event_save', 'save.png', 'default.png', 'Save Event', false);
		JToolBarHelper::custom('event_list', 'cancel.png', 'default.png', 'Cancel', false);
	}
  
  function setBandToolbar($id) {
		if ($id) {
			$newEdit = 'Edit';
		} else {
			$newEdit = 'New';
		}
		
		JToolBarHelper::title($newEdit . ' Event', 'generic.png');
		JToolBarHelper::custom('band_save', 'save.png', 'default.png', 'Save Band', false);
		JToolBarHelper::custom('band_list', 'cancel.png', 'default.png', 'Cancel', false);
	}
	
	function setEventsListToolbar() {
		JToolBarHelper::title('Events', 'categories.png');
		$db	=& JFactory::getDBO();
		$db->setQuery("SELECT id, name from #__tl_timeline");
		$timeline_rows = $db->loadObjectList();
		if (count($timeline_rows) > 0) {
			JToolBarHelper::custom('event_edit', 'new.png', 'default.png', 'New', false);
		}
		JToolBarHelper::custom('event_edit', 'edit.png', 'default.png', 'Edit', true);
		JToolBarHelper::custom('event_remove', 'delete.png', 'default.png', 'Delete', true);
	}
  
  function setBandListToolbar() {
		JToolBarHelper::title('Bands', 'categories.png');
		$db	=& JFactory::getDBO();
		$db->setQuery("SELECT id, name from #__tl_timeline");
		$timeline_rows = $db->loadObjectList();
		if (count($timeline_rows) > 0) {
			JToolBarHelper::custom('band_edit', 'new.png', 'default.png', 'New', false);
		}
		JToolBarHelper::custom('band_edit', 'edit.png', 'default.png', 'Edit', true);
		JToolBarHelper::custom('band_remove', 'delete.png', 'default.png', 'Delete', true);
	}
  
	function setHelpToolbar() {
		JToolBarHelper::title('Help', 'help_header.png');
	}
	
	function setSettingsToolbar() {
		JToolBarHelper::title('Settings', 'config.png');
		JToolBarHelper::custom('timelinefromarticles_edit', 'html.png', 'default.png', 'Create Timeline from Articles', false);
		JToolBarHelper::custom('timelinefromsql_edit', 'move.png', 'default.png', 'Create Timeline from SQL', false);
		JToolBarHelper::custom('timelinefromcsv_edit', 'move.png', 'default.png', 'Create Timeline from CSV', false);
    if (HTML_Timeline::isK2installed()) {
      JToolBarHelper::custom('timelinefromk2_edit', 'move.png', 'default.png', 'Create Timeline from K2', false);
    }
		JToolBarHelper::custom('settings_save', 'save.png', 'default.png', 'Save', false);
		JToolBarHelper::custom('timeline_list', 'cancel.png', 'default.png', 'Cancel', false);
	}
	
	function includeResources() {
		$document = &JFactory::getDocument();
		$componentPath = 'administrator/components/com_intotimeline/';
		$document->addScript( JURI::root() . $componentPath . '/js/livevalidation.js' ); 
		$document->addScript( JURI::root() . $componentPath . '/js/art_timeline.js' ); 
		$document->addStyleSheet( JURI::root() . $componentPath . '/css/art_timeline.css' ); 
	}
  
  function isK2installed() {
    return file_exists(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_k2' . DS . 'admin.k2.php');
  }
	
	function generateTimelineJS() {
		echo 'generating...';
	}
}


?>