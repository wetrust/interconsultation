CREATE TABLE IF NOT EXISTS `huge`.`instituciones` (
 `institucion_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
 `institucion_text` text NOT NULL,
 `user_id` int(11) unsigned NOT NULL,
 PRIMARY KEY (`institucion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Institucion';
