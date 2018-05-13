/*
 * v3.0 2018-05-13
 *
 */
ALTER TABLE `#__wsacarousel` 

ADD  `language` char(7) NOT NULL DEFAULT '',
ADD  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
ADD  `created_by` int(10) unsigned NOT NULL DEFAULT 0,
ADD  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
ADD  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
ADD  `modified_by` int(10) unsigned NOT NULL DEFAULT 0,
ADD  `access` int(10) unsigned NOT NULL DEFAULT 0,
ADD  `version` int(10) unsigned NOT NULL DEFAULT 1,
ADD  KEY `idx_access` (`access`),
ADD  KEY `idx_catid` (`catid`),
ADD  KEY `idx_language` (`language`);
 