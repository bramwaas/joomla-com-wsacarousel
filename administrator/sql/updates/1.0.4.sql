--
-- This file will contain Table structure for `"__wsacarousel`
-- v 1.0.4 DROP some  NULL constraint from `publish_down`
-- 2022 01 07
--
ALTER TABLE `#__wsacarousel` MODIFY `publish_up` datetime;
ALTER TABLE `#__wsacarousel` MODIFY `publish_down` datetime;
ALTER TABLE `#__wsacarousel` MODIFY `checked_out_time` datetime;
ALTER TABLE `#__wsacarousel` MODIFY `checked_out` int(10) unsigned;

