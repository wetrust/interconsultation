CREATE TABLE IF NOT EXISTS `huge`.`roles` (
 `rol_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
 `rol_name` text NOT NULL,
 PRIMARY KEY (`rol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='roles de usuario';


INSERT INTO `huge`.`roles` (`rol_id`, `rol_name`) VALUES
  (1, "Invitado"),
  (2, "Mesa central"),
  (3, "Profesional Ecografista"),
  (4, "Jefe de institucion"),
  (5, "Vacio"),
  (6, "Vacio"),
  (7, "Administrador general");
