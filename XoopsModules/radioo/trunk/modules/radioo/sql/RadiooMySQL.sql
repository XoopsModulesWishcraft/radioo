
CREATE TABLE `radioo_iostores` (
	`id` MEDIUMINT(18) NOT NULL AUTO_INCREMENT,
	`created` INT(13) NOT NULL DEFAULT '0',
	`saved` INT(13) NOT NULL DEFAULT '0',
	`read` INT(13) NOT NULL DEFAULT '0',
	`dropped` INT(13) NOT NULL DEFAULT '0',
	`deleted` INT(13) NOT NULL DEFAULT '0',
	`bytes_data` INT(11) NOT NULL DEFAULT '0',
	`bytes_store` INT(11) NOT NULL DEFAULT '0',
	`md5_data`  VARCHAR(32) NOT NULL DEFAULT '',
	`md5_store`  VARCHAR(32) NOT NULL DEFAULT '',
	`method`  ENUM('json', 'xml', 'serial') NOT NULL DEFAULT 'json',
	`filename`  VARCHAR(128) NOT NULL DEFAULT '',
	`path`  VARCHAR(255) NOT NULL DEFAULT '',
	`token`  VARCHAR(44) NOT NULL DEFAULT '',
	`salt`  VARCHAR(18) NOT NULL DEFAULT '',
	PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8 COLLATE=utf8_generic;

CREATE TABLE `radioo_playlist` (
	`id` MEDIUMINT(18) NOT NULL AUTO_INCREMENT,
	`uid` INT(13) NOT NULL DEFAULT '0',
	`created` INT(13) NOT NULL DEFAULT '0',
	`accesss` INT(13) NOT NULL DEFAULT '0',
	`type`  ENUM('search', 'site', 'designer') NOT NULL DEFAULT 'site',
	`ioid` MEDIUMINT(18) NOT NULL DEFAULT '0',
	`token` VARCHAR(44) NOT NULL DEFAULT '',
	PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8 COLLATE=utf8_generic;

CREATE TABLE `radioo_genres` (
	`id` MEDIUMINT(18) NOT NULL AUTO_INCREMENT,
	`pid` MEDIUMINT(18) NOT NULL DEFAULT '0',
	`created` INT(13) NOT NULL DEFAULT '0',
	`type`  ENUM('primary', 'secondary') NOT NULL DEFAULT 'primary',
	`key` VARCHAR(128) NOT NULL DEFAULT '',
	`ioid` MEDIUMINT(18) NOT NULL DEFAULT '0',
	`polling` INT(13) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8 COLLATE=utf8_generic;

CREATE TABLE `radioo_authkeys` (
	`id` MEDIUMINT(18) NOT NULL AUTO_INCREMENT,
	`uid` INT(13) NOT NULL DEFAULT '0',
	`created` INT(13) NOT NULL DEFAULT '0',
	`accesss` INT(13) NOT NULL DEFAULT '0',
	`token` VARCHAR(44) NOT NULL DEFAULT '',
	PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8 COLLATE=utf8_generic;

CREATE TABLE `radioo_schedules` (
	`id` MEDIUMINT(18) NOT NULL AUTO_INCREMENT,
	`uid` INT(13) NOT NULL DEFAULT '0',
	`created` INT(13) NOT NULL DEFAULT '0',
	`accesss` INT(13) NOT NULL DEFAULT '0',
	`state`  ENUM('default', 'designer') NOT NULL DEFAULT 'default',
	`type`  ENUM('yearly', 'monthly', 'daily', 'day', 'hourly', 'any') NOT NULL DEFAULT 'any',
	`mode`  ENUM('genres', 'top500', 'search', 'random') NOT NULL DEFAULT 'random',
	`token` VARCHAR(44) NOT NULL DEFAULT '',
	`year_begin` INT(4) ZEROFILL NOT NULL DEFAULT '0',
	`year_ended` INT(4) ZEROFILL NOT NULL DEFAULT '0',
	`month_begin` INT(2) ZEROFILL NOT NULL DEFAULT '0',
	`month_ended` INT(2) ZEROFILL NOT NULL DEFAULT '0',
	`week_begin` INT(2) ZEROFILL NOT NULL DEFAULT '0',
	`week_ended` INT(2) ZEROFILL NOT NULL DEFAULT '0',
	`daily_begin` ENUM('---', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun') NOT NULL DEFAULT '---',
	`daily_ended` ENUM('---', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun') NOT NULL DEFAULT '---',
	`day_begin` INT(2) ZEROFILL NOT NULL DEFAULT '0',
	`day_ended` INT(2) ZEROFILL NOT NULL DEFAULT '0',
	`hour_begin` INT(2) ZEROFILL NOT NULL DEFAULT '0',
	`hour_ended` INT(2) ZEROFILL NOT NULL DEFAULT '0',
	`banning` MEDIUMTEXT,
	`metrics` TINYTEXT,
	PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8 COLLATE=utf8_generic;

INSERT INTO `radioo_schedules` (`uid`, `state`, `type`, `mode`, `token`) VALUES ('1', 'default', 'any', 'random', sha1(UNIX_TIMESTAMP()));
