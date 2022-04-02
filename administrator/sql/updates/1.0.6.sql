--
-- This file will contain Table structure for `"__wsacarousel`
-- v 1.0.6 again try to DROP some  NULL constraint from `publish_down` and others
-- 2022 02 21
--
ALTER TABLE `#__wsacarousel` MODIFY `publish_up` datetime NULL;
ALTER TABLE `#__wsacarousel` MODIFY `publish_down` datetime NULL;
ALTER TABLE `#__wsacarousel` MODIFY `checked_out_time` datetime NULL;
ALTER TABLE `#__wsacarousel` MODIFY `checked_out` int(10) unsigned NULL;
ALTER TABLE `#__wsacarousel` MODIFY `modified` datetime NULL;