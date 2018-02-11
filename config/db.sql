CREATE DATABASE ConsumMeetupAPI_DB;
USE ConsumMeetupAPI_DB;

CREATE TABLE IF NOT EXISTS `groups` (
  `group_id` int(10) NOT NULL,
  `group_name` varchar(256) NOT NULL,
  `group_city` varchar(256) NOT NULL,
  `group_country` varchar(256) NOT NULL,
  `group_lon` varchar(256) NOT NULL,
  `group_lat` varchar(256) NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;


CREATE TABLE IF NOT EXISTS `events` (
  `event_id` int(10) NOT NULL,
  `event_name` varchar(256) NOT NULL,
  `event_url` varchar(256) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;
