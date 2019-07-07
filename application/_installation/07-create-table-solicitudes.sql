CREATE TABLE IF NOT EXISTS `huge`.`solicitudes` (
 `solicitud_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
 `user_id` int(11) unsigned NOT NULL,
 `institucion_id` int(11) unsigned NOT NULL,
 `solicitud_nombre` text NOT NULL,
 `solicitud_rut` text NOT NULL,
 `solicitud_telefono` int(11) unsigned NOT NULL,
 `solicitud_fecha` date NOT NULL,
 `solicitud_eg_conocida` int(1) unsigned NOT NULL,
 `solicitud_eco_previa` int(1) unsigned NOT NULL,
 `solicitud_fum` date NOT NULL,
 `solicitud_egestacional` text NOT NULL,
 `solicitud_diagnostico` text NOT NULL,
 `solicitud_ciudad` text NOT NULL,
 `solicitud_lugar` text NOT NULL,
 PRIMARY KEY (`solicitud_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='solicitudes de interconsulta';
