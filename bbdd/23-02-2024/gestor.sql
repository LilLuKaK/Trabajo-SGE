-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-02-2024 a las 21:31:20
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestor`
--
CREATE DATABASE IF NOT EXISTS `gestor` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `gestor`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

DROP TABLE IF EXISTS `alumnos`;
CREATE TABLE IF NOT EXISTS `alumnos` (
  `ID_Alumno` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) NOT NULL,
  `Apellido1` varchar(50) NOT NULL,
  `Apellido2` varchar(50) NOT NULL,
  `DNI` varchar(9) NOT NULL,
  `N_Seg_social` varchar(12) NOT NULL,
  `Curriculum_Vitae` varchar(100) NOT NULL,
  `Fecha_Ultima_Activo` date DEFAULT NULL,
  `Activo` tinyint(1) NOT NULL,
  `Validez` tinyint(1) NOT NULL,
  `TELF_Alumno` varchar(9) NOT NULL,
  `EMAIL_Alumno` varchar(100) NOT NULL,
  `Direccion` varchar(100) NOT NULL,
  `Codigo_Postal` varchar(5) NOT NULL,
  PRIMARY KEY (`ID_Alumno`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`ID_Alumno`, `Nombre`, `Apellido1`, `Apellido2`, `DNI`, `N_Seg_social`, `Curriculum_Vitae`, `Fecha_Ultima_Activo`, `Activo`, `Validez`, `TELF_Alumno`, `EMAIL_Alumno`, `Direccion`, `Codigo_Postal`) VALUES
(1, 'Jose Piero', 'Lara', 'Cortez', '12345678A', '555-50-1234', 'CV_Mi_Nombre.docx', '2024-02-20', 1, 1, '659832654', 'miEmail@gmail.com', 'Mi casa s/n', '45986'),
(2, 'Nixon', 'Cruzado', 'Vázquez', '23456123B', '555501234', 'cv_Mi_Curriculum.pdf', '2023-02-01', 0, 1, '659874123', 'MI_Emai@gmail.com', 'Mi casa s/N', '23456'),
(3, 'Lucas', 'Bravo', '', '12345678Z', '123456789', 'fdwsdfsfdsdfs', NULL, 0, 0, '611425518', 'sdfds@hjsdfb.com', 'dasdasdas', '28922'),
(6, 'Lucas', 'Bravo', '', '12345678Z', '123242354', '312312231231', NULL, 1, 1, '611425518', 'dasdssdadas@fsdfafs.com', 'Los arces', '28922'),
(7, 'Lucas', 'Bravo', '', '23423431Z', '312312313', '312321123', NULL, 1, 1, '611425518', 'sdfds@fsdf.com', 'Los arces', '28922'),
(8, 'Lucas', 'Bravo', '', '23423431Z', '321321321', '321312312', NULL, 0, 0, '611425518', 'ssdfafsddfds@fsdf.com', 'Los arces', '28922'),
(9, 'Lucas', 'Bravo', '', '23423431Z', '421421442', 'fdsdfagsdfa', NULL, 0, 0, '611425518', 'svdfsavafds@fsdf.com', 'Los arces', '28922'),
(10, 'Lucas', 'Bravo', '', '23423431Z', '123123213', '312312312123', NULL, 1, 1, '611425518', 'svdfsavbfbfzfafds@fsdf.com', 'Los arces', '28922');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anexos`
--

DROP TABLE IF EXISTS `anexos`;
CREATE TABLE IF NOT EXISTS `anexos` (
  `ID_Anexo` int(11) NOT NULL AUTO_INCREMENT,
  `Version` int(11) NOT NULL,
  `Cuadrante` enum('Abril','Septiembre') NOT NULL,
  `Fecha_Inicio` date NOT NULL,
  `Fecha_Final` date NOT NULL,
  `Tutor_Empresa` varchar(100) NOT NULL,
  `Email_Tutor_Empresa` varchar(100) NOT NULL,
  `TELF_Tutor_Empresa` varchar(9) NOT NULL,
  `NombreArchivo` varchar(100) DEFAULT NULL,
  `Aprobado` tinyint(1) NOT NULL,
  `ID_Convenio` int(11) NOT NULL,
  PRIMARY KEY (`ID_Anexo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `anexos`
--

INSERT INTO `anexos` (`ID_Anexo`, `Version`, `Cuadrante`, `Fecha_Inicio`, `Fecha_Final`, `Tutor_Empresa`, `Email_Tutor_Empresa`, `TELF_Tutor_Empresa`, `NombreArchivo`, `Aprobado`, `ID_Convenio`) VALUES
(1, 1, 'Abril', '2024-03-20', '2024-09-20', 'MI_tutor_empresa', 'tutor_empresa@gmail.com', '915478451', 'JosePiero_Anexo_Genérico', 1, 0),
(2, 2, 'Septiembre', '2024-09-20', '2025-03-20', 'MI_Tutor_Practicas', 'tutor_otro@gmail.com', '602278845', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anexo_ciclo`
--

DROP TABLE IF EXISTS `anexo_ciclo`;
CREATE TABLE IF NOT EXISTS `anexo_ciclo` (
  `ID_Anexo_Ciclo` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Anexo` int(11) NOT NULL,
  `ID_Ciclo_Formativo` int(11) NOT NULL,
  PRIMARY KEY (`ID_Anexo_Ciclo`),
  KEY `FK_AnCic_Anexo` (`ID_Anexo`),
  KEY `FK_AnCic_Ciclo` (`ID_Ciclo_Formativo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `anexo_ciclo`
--

INSERT INTO `anexo_ciclo` (`ID_Anexo_Ciclo`, `ID_Anexo`, `ID_Ciclo_Formativo`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anyo_necesidad`
--

DROP TABLE IF EXISTS `anyo_necesidad`;
CREATE TABLE IF NOT EXISTS `anyo_necesidad` (
  `ID_Anyo_Necesidad` int(11) NOT NULL AUTO_INCREMENT,
  `Anyo` varchar(4) NOT NULL,
  PRIMARY KEY (`ID_Anyo_Necesidad`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `anyo_necesidad`
--

INSERT INTO `anyo_necesidad` (`ID_Anyo_Necesidad`, `Anyo`) VALUES
(1, '2024');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anyo_ventana`
--

DROP TABLE IF EXISTS `anyo_ventana`;
CREATE TABLE IF NOT EXISTS `anyo_ventana` (
  `ID_Anyo_Ventana` int(11) NOT NULL,
  `ID_Anyo_Necesidad` int(11) NOT NULL,
  `ID_Ventana_Necesidad` int(11) NOT NULL,
  KEY `FK_AnVen_Anyo` (`ID_Anyo_Necesidad`),
  KEY `FK_AnVen_Ventana` (`ID_Ventana_Necesidad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `anyo_ventana`
--

INSERT INTO `anyo_ventana` (`ID_Anyo_Ventana`, `ID_Anyo_Necesidad`, `ID_Ventana_Necesidad`) VALUES
(0, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bolsa_ciclo`
--

DROP TABLE IF EXISTS `bolsa_ciclo`;
CREATE TABLE IF NOT EXISTS `bolsa_ciclo` (
  `ID_Bolsa_Ciclo` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Bolsa_Trabajo` int(11) NOT NULL,
  `ID_Ciclo_Formativo` int(11) NOT NULL,
  PRIMARY KEY (`ID_Bolsa_Ciclo`),
  KEY `FK_BoCic_Bolsa` (`ID_Bolsa_Trabajo`),
  KEY `FK_BoCic_Ciclo` (`ID_Ciclo_Formativo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `bolsa_ciclo`
--

INSERT INTO `bolsa_ciclo` (`ID_Bolsa_Ciclo`, `ID_Bolsa_Trabajo`, `ID_Ciclo_Formativo`) VALUES
(5, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bolsa_trabajo`
--

DROP TABLE IF EXISTS `bolsa_trabajo`;
CREATE TABLE IF NOT EXISTS `bolsa_trabajo` (
  `ID_Bolsa_Trabajo` int(11) NOT NULL AUTO_INCREMENT,
  `Cantidad` int(11) NOT NULL,
  `Comentarios` varchar(500) NOT NULL,
  PRIMARY KEY (`ID_Bolsa_Trabajo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `bolsa_trabajo`
--

INSERT INTO `bolsa_trabajo` (`ID_Bolsa_Trabajo`, `Cantidad`, `Comentarios`) VALUES
(1, 3, 'Se necesitan 2 alumnos de DAm y uno de Marketing');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centro_alumno`
--

DROP TABLE IF EXISTS `centro_alumno`;
CREATE TABLE IF NOT EXISTS `centro_alumno` (
  `ID_Centro_Alumno` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Centro_Formativo` int(11) NOT NULL,
  `ID_Alumno` int(11) NOT NULL,
  PRIMARY KEY (`ID_Centro_Alumno`),
  KEY `FK_CenAl_Cen` (`ID_Centro_Formativo`),
  KEY `FK_CenAl_Al` (`ID_Alumno`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `centro_alumno`
--

INSERT INTO `centro_alumno` (`ID_Centro_Alumno`, `ID_Centro_Formativo`, `ID_Alumno`) VALUES
(1, 1, 9),
(2, 2, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centro_formativo`
--

DROP TABLE IF EXISTS `centro_formativo`;
CREATE TABLE IF NOT EXISTS `centro_formativo` (
  `ID_Centro_Formativo` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) NOT NULL,
  `CIF` varchar(9) NOT NULL,
  `DUENYO` varchar(200) NOT NULL,
  `Direccion` varchar(200) NOT NULL,
  `Telefono` varchar(9) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_Centro_Formativo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `centro_formativo`
--

INSERT INTO `centro_formativo` (`ID_Centro_Formativo`, `Nombre`, `CIF`, `DUENYO`, `Direccion`, `Telefono`, `EMAIL`) VALUES
(1, 'Centro Privado', 'D12345678', 'Dueño', 'Calle Nueva 123', '978845612', 'Correo@gmail.com'),
(2, 'Juan XXIII', '12345678Z', 'Yo Quese', 'Calle Nueva 2', '123456789', 'juanxxiii@juanxxiii.net');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciclos_formativos`
--

DROP TABLE IF EXISTS `ciclos_formativos`;
CREATE TABLE IF NOT EXISTS `ciclos_formativos` (
  `ID_Ciclo_Formativo` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Ciclo` varchar(80) NOT NULL,
  PRIMARY KEY (`ID_Ciclo_Formativo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `ciclos_formativos`
--

INSERT INTO `ciclos_formativos` (`ID_Ciclo_Formativo`, `Nombre_Ciclo`) VALUES
(1, 'DAM'),
(2, 'DAW');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciclo_alumno`
--

DROP TABLE IF EXISTS `ciclo_alumno`;
CREATE TABLE IF NOT EXISTS `ciclo_alumno` (
  `ID_Ciclo_Alumno` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Ciclo_Formativo` int(11) NOT NULL,
  `ID_Alumno` int(11) NOT NULL,
  PRIMARY KEY (`ID_Ciclo_Alumno`),
  KEY `FP_CA_Ciclo` (`ID_Ciclo_Formativo`),
  KEY `FK_CA_Alumno` (`ID_Alumno`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `ciclo_alumno`
--

INSERT INTO `ciclo_alumno` (`ID_Ciclo_Alumno`, `ID_Ciclo_Formativo`, `ID_Alumno`) VALUES
(5, 1, 1),
(6, 2, 3),
(10, 1, 7),
(12, 1, 9),
(13, 2, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto_control`
--

DROP TABLE IF EXISTS `contacto_control`;
CREATE TABLE IF NOT EXISTS `contacto_control` (
  `ID_Contacto_Control` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Control_Empresa` int(11) NOT NULL,
  `ID_Contacto_Empresa` int(11) NOT NULL,
  PRIMARY KEY (`ID_Contacto_Control`),
  KEY `FK_IDCONTROLEMPRESA` (`ID_Control_Empresa`),
  KEY `FK_IDContactoEmpresa` (`ID_Contacto_Empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `contacto_control`
--

INSERT INTO `contacto_control` (`ID_Contacto_Control`, `ID_Control_Empresa`, `ID_Contacto_Empresa`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto_empresa`
--

DROP TABLE IF EXISTS `contacto_empresa`;
CREATE TABLE IF NOT EXISTS `contacto_empresa` (
  `ID_Contacto_Empresa` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) NOT NULL,
  `EMAIL_Contacto_Empresa` varchar(100) NOT NULL,
  `TELF_Contacto_Empresa` varchar(9) NOT NULL,
  PRIMARY KEY (`ID_Contacto_Empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `contacto_empresa`
--

INSERT INTO `contacto_empresa` (`ID_Contacto_Empresa`, `Nombre`, `EMAIL_Contacto_Empresa`, `TELF_Contacto_Empresa`) VALUES
(1, 'Contacto_Nuevo', 'correo@gmail.com', '645789567');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control_convenios`
--

DROP TABLE IF EXISTS `control_convenios`;
CREATE TABLE IF NOT EXISTS `control_convenios` (
  `ID_Convenio` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Ministerio` int(11) NOT NULL COMMENT 'Es un elemento dado por la Comunidad de Madrid',
  `ID_Control_Empresa` int(11) NOT NULL,
  `ID_Centro_Formativo` int(11) NOT NULL,
  `Fecha_Inicio` date NOT NULL,
  PRIMARY KEY (`ID_Convenio`),
  KEY `FK_CEmpre_CConve` (`ID_Control_Empresa`) USING BTREE,
  KEY `FK_CConvenios_CForma` (`ID_Centro_Formativo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `control_convenios`
--

INSERT INTO `control_convenios` (`ID_Convenio`, `ID_Ministerio`, `ID_Control_Empresa`, `ID_Centro_Formativo`, `Fecha_Inicio`) VALUES
(1, 1234567891, 1, 1, '2024-03-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control_empresas`
--

DROP TABLE IF EXISTS `control_empresas`;
CREATE TABLE IF NOT EXISTS `control_empresas` (
  `ID_Control_Empresa` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) NOT NULL,
  `CIF` varchar(9) NOT NULL,
  `Duenyo` varchar(100) NOT NULL,
  `Firmante_Convenio` varchar(100) NOT NULL,
  `Direccion` varchar(200) NOT NULL,
  `EMAIL_Empresa` varchar(100) NOT NULL,
  `TELF_Empresa` varchar(9) NOT NULL,
  PRIMARY KEY (`ID_Control_Empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `control_empresas`
--

INSERT INTO `control_empresas` (`ID_Control_Empresa`, `Nombre`, `CIF`, `Duenyo`, `Firmante_Convenio`, `Direccion`, `EMAIL_Empresa`, `TELF_Empresa`) VALUES
(1, 'Mi Empresa 1', 'A12345678', 'Su Dueño', 'Otra Persona Que puede ser el Dueño', 'Esa Direccion donde está la empresa', 'empresa@gmail.com', '654567891'),
(2, 'Mi Empresa 2', 'A98765432', 'El Otro Dueño', 'La Otra otra Persona que firma el convenio', 'Mi direccion de la empresa S/N', 'email2@gmail.com', '789456123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control_practicas`
--

DROP TABLE IF EXISTS `control_practicas`;
CREATE TABLE IF NOT EXISTS `control_practicas` (
  `ID_Practica` int(11) NOT NULL AUTO_INCREMENT,
  `Tutor_CFP` varchar(100) NOT NULL,
  `Direccion_Prácticas` varchar(200) NOT NULL,
  PRIMARY KEY (`ID_Practica`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `control_practicas`
--

INSERT INTO `control_practicas` (`ID_Practica`, `Tutor_CFP`, `Direccion_Prácticas`) VALUES
(1, 'Tutor_Prácticas_Centro', 'Dirección empresa que no tiene que ser la  misma que la  dad en empresa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `convenio_anyo`
--

DROP TABLE IF EXISTS `convenio_anyo`;
CREATE TABLE IF NOT EXISTS `convenio_anyo` (
  `ID_Convenio_Anyo` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Convenio` int(11) NOT NULL,
  `ID_Anyo_Necesidad` int(11) NOT NULL,
  PRIMARY KEY (`ID_Convenio_Anyo`),
  KEY `FK_CAn_Convenio` (`ID_Convenio`),
  KEY `FK_CAn_Anyo` (`ID_Anyo_Necesidad`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `convenio_anyo`
--

INSERT INTO `convenio_anyo` (`ID_Convenio_Anyo`, `ID_Convenio`, `ID_Anyo_Necesidad`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa_bolsa`
--

DROP TABLE IF EXISTS `empresa_bolsa`;
CREATE TABLE IF NOT EXISTS `empresa_bolsa` (
  `ID_Empresa_Bolsa` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Empresa_Bolsa` varchar(50) NOT NULL,
  `TELF_Empresa_Bolsa` varchar(9) NOT NULL,
  `EMAIL_Empresa_Bolsa` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_Empresa_Bolsa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `empresa_bolsa`
--

INSERT INTO `empresa_bolsa` (`ID_Empresa_Bolsa`, `Nombre_Empresa_Bolsa`, `TELF_Empresa_Bolsa`, `EMAIL_Empresa_Bolsa`) VALUES
(1, 'Empresa en Bolsa', '200787542', 'corremoEmpresa@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa_bolsa_trabajo`
--

DROP TABLE IF EXISTS `empresa_bolsa_trabajo`;
CREATE TABLE IF NOT EXISTS `empresa_bolsa_trabajo` (
  `ID_Empresa_Bolsa_Trabajo` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Empresa_Bolsa` int(11) NOT NULL,
  `ID_Bolsa_Trabajo` int(11) NOT NULL,
  PRIMARY KEY (`ID_Empresa_Bolsa_Trabajo`),
  KEY `FK_EMBOTra_Empresa` (`ID_Empresa_Bolsa`),
  KEY `FK_EMBOTra_Bolsa` (`ID_Bolsa_Trabajo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `empresa_bolsa_trabajo`
--

INSERT INTO `empresa_bolsa_trabajo` (`ID_Empresa_Bolsa_Trabajo`, `ID_Empresa_Bolsa`, `ID_Bolsa_Trabajo`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

DROP TABLE IF EXISTS `notas`;
CREATE TABLE IF NOT EXISTS `notas` (
  `ID_Usuario` int(11) NOT NULL,
  `Media_Aritmetica` varchar(200) NOT NULL,
  PRIMARY KEY (`ID_Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`ID_Usuario`, `Media_Aritmetica`) VALUES
(1, 'Contrasenya'),
(2, '$2y$10$L478RUpdqvWsfrGXlGsEBOUeeAwgIRVFW9gEfrmffZTDzEi1wtSTu'),
(3, '$2y$10$TT7MsYkhc8h3.X9zlDoDjudMDnI3WT4EwZ5Pr4q4KQBYY7/Nh7XFG'),
(4, '$2y$10$.X3FLbozi12h06hWT8Yf4e7fVhm9xSEDivtsIMP0F7h.9mnyx5Lh6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `practicas_alumnos`
--

DROP TABLE IF EXISTS `practicas_alumnos`;
CREATE TABLE IF NOT EXISTS `practicas_alumnos` (
  `ID_Practica_Alumno` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Practica` int(11) NOT NULL,
  `ID_Alumno` int(11) NOT NULL,
  PRIMARY KEY (`ID_Practica_Alumno`),
  KEY `FK_PA_Practicas` (`ID_Practica`),
  KEY `FK_PA_Alumnos` (`ID_Alumno`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `practicas_alumnos`
--

INSERT INTO `practicas_alumnos` (`ID_Practica_Alumno`, `ID_Practica`, `ID_Alumno`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `ID_Usuario` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) NOT NULL,
  `Apellido1` varchar(50) NOT NULL,
  `Rol` varchar(50) NOT NULL,
  `EMAIL_Usuario` varchar(50) NOT NULL,
  `Primera_Conexion` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID_Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID_Usuario`, `Nombre`, `Apellido1`, `Rol`, `EMAIL_Usuario`, `Primera_Conexion`) VALUES
(1, 'Admin', 'Appellido', 'ADMIN', 'Usuario@admin.com', 0),
(2, 'Lucas', 'Bravo', '', 'lucas.bravo@juanxxiii.net', 0),
(3, 'Lucas', 'Bravo', 'TUTOR', 'lucas.bravo1@juanxxiii.net', 0),
(4, 'Lucas', 'Bravo', 'ALUMNO', 'lucas@lucas.com', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_centro`
--

DROP TABLE IF EXISTS `usuario_centro`;
CREATE TABLE IF NOT EXISTS `usuario_centro` (
  `ID_Usuario_Centro` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Usuario` int(11) NOT NULL,
  `ID_Centro_Formativo` int(11) NOT NULL,
  PRIMARY KEY (`ID_Usuario_Centro`),
  KEY `FK_UCen_Usuario` (`ID_Usuario`),
  KEY `FK_UCen_Centro` (`ID_Centro_Formativo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuario_centro`
--

INSERT INTO `usuario_centro` (`ID_Usuario_Centro`, `ID_Usuario`, `ID_Centro_Formativo`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 2),
(4, 4, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacantes`
--

DROP TABLE IF EXISTS `vacantes`;
CREATE TABLE IF NOT EXISTS `vacantes` (
  `ID_Vacantes` int(11) NOT NULL AUTO_INCREMENT,
  `Cantidad` int(11) NOT NULL,
  PRIMARY KEY (`ID_Vacantes`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `vacantes`
--

INSERT INTO `vacantes` (`ID_Vacantes`, `Cantidad`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacantes_ciclo`
--

DROP TABLE IF EXISTS `vacantes_ciclo`;
CREATE TABLE IF NOT EXISTS `vacantes_ciclo` (
  `ID_Vacantes_Ciclo` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Vacantes` int(11) NOT NULL,
  `ID_Ciclo_Formativo` int(11) NOT NULL,
  PRIMARY KEY (`ID_Vacantes_Ciclo`),
  KEY `FK_VacCic_Vacantes` (`ID_Vacantes`),
  KEY `FK_VacCic_Ciclo` (`ID_Ciclo_Formativo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `vacantes_ciclo`
--

INSERT INTO `vacantes_ciclo` (`ID_Vacantes_Ciclo`, `ID_Vacantes`, `ID_Ciclo_Formativo`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventana_necesidad`
--

DROP TABLE IF EXISTS `ventana_necesidad`;
CREATE TABLE IF NOT EXISTS `ventana_necesidad` (
  `ID_Ventana_Necesidad` int(11) NOT NULL AUTO_INCREMENT,
  `Cuadrante` enum('Abril','Septiembre') NOT NULL,
  PRIMARY KEY (`ID_Ventana_Necesidad`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `ventana_necesidad`
--

INSERT INTO `ventana_necesidad` (`ID_Ventana_Necesidad`, `Cuadrante`) VALUES
(1, 'Abril');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventana_vacantes`
--

DROP TABLE IF EXISTS `ventana_vacantes`;
CREATE TABLE IF NOT EXISTS `ventana_vacantes` (
  `ID_Ventana_Vacantes` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Ventana_Necesidad` int(11) NOT NULL,
  `ID_Vacantes` int(11) NOT NULL,
  PRIMARY KEY (`ID_Ventana_Vacantes`),
  KEY `FK_VenVac_Ventana` (`ID_Ventana_Necesidad`),
  KEY `FK_VenVac_Vacantes` (`ID_Vacantes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anexo_ciclo`
--
ALTER TABLE `anexo_ciclo`
  ADD CONSTRAINT `FK_AnCic_Anexo` FOREIGN KEY (`ID_Anexo`) REFERENCES `anexos` (`ID_Anexo`),
  ADD CONSTRAINT `FK_AnCic_Ciclo` FOREIGN KEY (`ID_Ciclo_Formativo`) REFERENCES `ciclos_formativos` (`ID_Ciclo_Formativo`);

--
-- Filtros para la tabla `anyo_ventana`
--
ALTER TABLE `anyo_ventana`
  ADD CONSTRAINT `FK_AnVen_Anyo` FOREIGN KEY (`ID_Anyo_Necesidad`) REFERENCES `anyo_necesidad` (`ID_Anyo_Necesidad`),
  ADD CONSTRAINT `FK_AnVen_Ventana` FOREIGN KEY (`ID_Ventana_Necesidad`) REFERENCES `ventana_necesidad` (`ID_Ventana_Necesidad`);

--
-- Filtros para la tabla `bolsa_ciclo`
--
ALTER TABLE `bolsa_ciclo`
  ADD CONSTRAINT `FK_BoCic_Bolsa` FOREIGN KEY (`ID_Bolsa_Trabajo`) REFERENCES `bolsa_trabajo` (`ID_Bolsa_Trabajo`),
  ADD CONSTRAINT `FK_BoCic_Ciclo` FOREIGN KEY (`ID_Ciclo_Formativo`) REFERENCES `ciclos_formativos` (`ID_Ciclo_Formativo`);

--
-- Filtros para la tabla `centro_alumno`
--
ALTER TABLE `centro_alumno`
  ADD CONSTRAINT `FK_CenAl_Al` FOREIGN KEY (`ID_Alumno`) REFERENCES `alumnos` (`ID_Alumno`),
  ADD CONSTRAINT `FK_CenAl_Cen` FOREIGN KEY (`ID_Centro_Formativo`) REFERENCES `centro_formativo` (`ID_Centro_Formativo`);

--
-- Filtros para la tabla `ciclo_alumno`
--
ALTER TABLE `ciclo_alumno`
  ADD CONSTRAINT `FK_CA_Alumno` FOREIGN KEY (`ID_Alumno`) REFERENCES `alumnos` (`ID_Alumno`),
  ADD CONSTRAINT `FP_CA_Ciclo` FOREIGN KEY (`ID_Ciclo_Formativo`) REFERENCES `ciclos_formativos` (`ID_Ciclo_Formativo`);

--
-- Filtros para la tabla `contacto_control`
--
ALTER TABLE `contacto_control`
  ADD CONSTRAINT `FK_IDCONTROLEMPRESA` FOREIGN KEY (`ID_Control_Empresa`) REFERENCES `control_empresas` (`ID_Control_Empresa`),
  ADD CONSTRAINT `FK_IDContactoEmpresa` FOREIGN KEY (`ID_Contacto_Empresa`) REFERENCES `contacto_empresa` (`ID_Contacto_Empresa`);

--
-- Filtros para la tabla `control_convenios`
--
ALTER TABLE `control_convenios`
  ADD CONSTRAINT `FK_CConvenios_CForma` FOREIGN KEY (`ID_Centro_Formativo`) REFERENCES `centro_formativo` (`ID_Centro_Formativo`),
  ADD CONSTRAINT `FK_CEmpre_CConve` FOREIGN KEY (`ID_Control_Empresa`) REFERENCES `control_empresas` (`ID_Control_Empresa`);

--
-- Filtros para la tabla `convenio_anyo`
--
ALTER TABLE `convenio_anyo`
  ADD CONSTRAINT `FK_CAn_Anyo` FOREIGN KEY (`ID_Anyo_Necesidad`) REFERENCES `anyo_necesidad` (`ID_Anyo_Necesidad`),
  ADD CONSTRAINT `FK_CAn_Convenio` FOREIGN KEY (`ID_Convenio`) REFERENCES `control_convenios` (`ID_Convenio`);

--
-- Filtros para la tabla `empresa_bolsa_trabajo`
--
ALTER TABLE `empresa_bolsa_trabajo`
  ADD CONSTRAINT `FK_EMBOTra_Bolsa` FOREIGN KEY (`ID_Bolsa_Trabajo`) REFERENCES `bolsa_trabajo` (`ID_Bolsa_Trabajo`),
  ADD CONSTRAINT `FK_EMBOTra_Empresa` FOREIGN KEY (`ID_Empresa_Bolsa`) REFERENCES `empresa_bolsa` (`ID_Empresa_Bolsa`);

--
-- Filtros para la tabla `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `FK_Notas_Usuario` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuario` (`ID_Usuario`);

--
-- Filtros para la tabla `practicas_alumnos`
--
ALTER TABLE `practicas_alumnos`
  ADD CONSTRAINT `FK_PA_Alumnos` FOREIGN KEY (`ID_Alumno`) REFERENCES `alumnos` (`ID_Alumno`),
  ADD CONSTRAINT `FK_PA_Practicas` FOREIGN KEY (`ID_Practica`) REFERENCES `control_practicas` (`ID_Practica`);

--
-- Filtros para la tabla `usuario_centro`
--
ALTER TABLE `usuario_centro`
  ADD CONSTRAINT `FK_UCen_Centro` FOREIGN KEY (`ID_Centro_Formativo`) REFERENCES `centro_formativo` (`ID_Centro_Formativo`),
  ADD CONSTRAINT `FK_UCen_Usuario` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuario` (`ID_Usuario`);

--
-- Filtros para la tabla `vacantes_ciclo`
--
ALTER TABLE `vacantes_ciclo`
  ADD CONSTRAINT `FK_VacCic_Ciclo` FOREIGN KEY (`ID_Ciclo_Formativo`) REFERENCES `ciclos_formativos` (`ID_Ciclo_Formativo`),
  ADD CONSTRAINT `FK_VacCic_Vacantes` FOREIGN KEY (`ID_Vacantes`) REFERENCES `vacantes` (`ID_Vacantes`);

--
-- Filtros para la tabla `ventana_vacantes`
--
ALTER TABLE `ventana_vacantes`
  ADD CONSTRAINT `FK_VenVac_Vacantes` FOREIGN KEY (`ID_Vacantes`) REFERENCES `vacantes` (`ID_Vacantes`),
  ADD CONSTRAINT `FK_VenVac_Ventana` FOREIGN KEY (`ID_Ventana_Necesidad`) REFERENCES `ventana_necesidad` (`ID_Ventana_Necesidad`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
