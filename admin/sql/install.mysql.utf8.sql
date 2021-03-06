CREATE TABLE IF NOT EXISTS `#__tl_timeline` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `description` text,
  `published` tinyint(1),
  `access` int(11),
  `datetime_format` varchar(50) NOT NULL,
  `theme` varchar(255) NOT NULL,
  `interval_unit` int(3) NOT NULL,
  `interval_pixel` varchar(50) NOT NULL,
  `start_date` datetime NOT NULL,
  `width` varchar(10),
  `direction` varchar(11),
  `bubble_width` varchar(10),
  `bubble_height` varchar(10),
  `event_img` varchar(255),
  `event_line_color` varchar(10),
  `event_imprecise_color` varchar(10),
  `event_imprecise_opacity` varchar(10),
  `event_duration_color` varchar(10),
  `event_duration_opacity` varchar(10),
  `event_duration_imprecise_color` varchar(10),
  `event_duration_imprecise_opacity` varchar(10),
  `modified` datetime default NULL,
  `modifiedby` int(10) unsigned,
  `last_generated` datetime NOT NULL,
  `file` varchar(255),
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__tl_band` (
  `id` int(11) NOT NULL auto_increment,
  `timeline_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `interval_unit` int(3) NOT NULL,
  `interval_pixel` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__tl_event` (
  `id` int(11) NOT NULL auto_increment,
  `timeline_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `start_date` datetime,
  `end_date` datetime,
  `image` varchar(255),
  `link` varchar(255),
  `modified` datetime default NULL,
  `modifiedby` int(10) unsigned,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__tl_setting` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `autogenerate` tinyint(1) NOT NULL,
  `container_id` varchar(255) default NULL,
  `container_style` text,
  `title` varchar(255),
  `display_description` tinyint(1),
  `customJS` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__tl_category` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `event_img` varchar(255),
  `event_text_color` varchar(10),
  `event_duration_color` varchar(10),
  `event_duration_opacity` varchar(10),
  `enabled` tinyint(1),
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `#__tl_setting` (`id`, `autogenerate`, `container_id`, `container_style`, `title`, `display_description`, `customJS`) 
VALUES (1, 0, 'timeline_container', 'height: 250px; border: 1px solid #aaa', 'Timeline', 1, '')
ON DUPLICATE KEY UPDATE id=id;

ALTER TABLE `#__tl_event`
MODIFY COLUMN `start_date` varchar(255);

ALTER TABLE `#__tl_event`
MODIFY COLUMN `end_date` varchar(255);
