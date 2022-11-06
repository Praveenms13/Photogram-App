ALTER TABLE `auth` ADD `sec_email` varchar(256) NOT NULL;


CREATE TABLE `session` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `uid` int NOT NULL,
  `token` varchar(32) NOT NULL,
  `login_time` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `ip` varchar(20) NOT NULL,
  `useragent` varchar(256) NOT NULL,
  `active` int NOT NULL DEFAULT '1'
);