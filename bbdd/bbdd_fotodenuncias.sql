-- 
-- fotodenuncias bbdd
-- 

-- 
-- `comentarios`
-- 

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comentario` longtext COLLATE latin1_spanish_ci NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `id_denuncia` int(11) NOT NULL,
  `nick` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `email` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `ip` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=248 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=248 ;

-- --------------------------------------------------------

-- 
-- `denuncias`
-- 

CREATE TABLE `denuncias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `foto` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `descripcion` longtext COLLATE latin1_spanish_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `session_id` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `visitas` int(11) NOT NULL,
  `activa` tinyint(1) NOT NULL DEFAULT '0',
  `exif` text COLLATE latin1_spanish_ci NOT NULL,
  `android_id` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `coordenadas` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `lugar` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=974 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=974 ;

-- --------------------------------------------------------

-- 
-- `entradas`
-- 

CREATE TABLE `entradas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titular` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `contenido` longtext COLLATE latin1_spanish_ci NOT NULL,
  `imagen` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `video` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `visitas` int(11) NOT NULL,
  `game` int(1) NOT NULL DEFAULT '0',
  `infotecnica` longtext COLLATE latin1_spanish_ci NOT NULL,
  `links` longtext COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

-- 
-- `entradas_imagenes`
-- 

CREATE TABLE `entradas_imagenes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_entrada` int(11) NOT NULL,
  `imagen` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- `entradas_videos`
-- 

CREATE TABLE `entradas_videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_entrada` int(11) NOT NULL,
  `video` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- `gente_online`
-- 

CREATE TABLE `gente_online` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `navegador` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=131753 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=131753 ;

-- --------------------------------------------------------

-- 
-- `usuarios`
-- 

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `password` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `poblacion` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=1 ;
