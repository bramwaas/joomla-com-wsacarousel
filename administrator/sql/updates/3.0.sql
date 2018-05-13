/*
 * 
 *
 */
ALTER TABLE `#__wsacarousel` 

--ADD  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
--ADD `state` tinyint(3) NOT NULL DEFAULT 0,
ADD  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
ADD  `created_by` int(10) unsigned NOT NULL DEFAULT 0,
ADD  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
ADD  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
ADD  `modified_by` int(10) unsigned NOT NULL DEFAULT 0,

ADD  `access` int(10) unsigned NOT NULL DEFAULT 0,
ADD  `version` int(10) unsigned NOT NULL DEFAULT 1,
ADD  KEY `idx_access` (`access`),
--ADD  KEY `idx_state` (`state`),
ADD  KEY `idx_metakey_prefix` (`metakey_prefix`(100)),
ADD  KEY `idx_catid` (`catid`),
ADD  KEY `idx_language` (`language`);
 