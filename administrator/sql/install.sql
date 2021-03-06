CREATE TABLE IF NOT EXISTS `#__wsacarousel` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `catid` int(10) unsigned NOT NULL default '0',
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL default '',
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `delay` int(10) unsigned NOT NULL DEFAULT 0;
  `ordering` int(11) NOT NULL default '0',
  `params` text NOT NULL,
  `language` char(7) NOT NULL DEFAULT '',
--  `state` tinyint(3) NOT NULL DEFAULT 0,
  `access` int(10) unsigned NOT NULL DEFAULT 0,
  `published` tinyint(1) NOT NULL default '0',
  `publish_up` datetime NOT NULL default '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL default '0000-00-00 00:00:00',
  `checked_out` int(10) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT 0,
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT 0,
  `version` int(10) unsigned NOT NULL DEFAULT 1,
  
  
  PRIMARY KEY  (`id`),
  KEY `idx_access` (`access`),
  KEY `catid` (`catid`,`published`)
--  KEY `idx_state` (`state`),
--  KEY `idx_metakey_prefix` (`metakey_prefix`(100)),
  KEY `idx_catid` (`catid`),
  KEY `idx_language` (`language`)
  
) DEFAULT CHARSET=utf8 DEFAULT COLLATE=utf8mb4_unicode_ci;
