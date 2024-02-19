-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-02-2024 a las 02:23:45
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `ID_Alumno` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Apellido1` varchar(50) NOT NULL,
  `Apellido2` varchar(50) NOT NULL,
  `DNI` varchar(9) NOT NULL,
  `N_Seg_social` varchar(12) NOT NULL,
  `Curriculum_Vitae` varchar(100) NOT NULL,
  `Fecha_Ultima_Validez` date NOT NULL,
  `Validez` tinyint(1) NOT NULL,
  `Activo` double NOT NULL,
  `TELF_Alumno` varchar(9) NOT NULL,
  `EMAIL_Alumno` varchar(100) NOT NULL,
  `Direccion` varchar(100) NOT NULL,
  `Codigo_Postal` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anexos`
--

CREATE TABLE `anexos` (
  `ID_Anexo` int(11) NOT NULL,
  `Version` int(11) NOT NULL,
  `Cuadrante` enum('Abril','Septiembre') NOT NULL,
  `Fecha_Inicio` date NOT NULL,
  `Fecha_Final` date NOT NULL,
  `Tutor_Empresa` varchar(100) NOT NULL,
  `Email_Tutor_Empresa` varchar(100) NOT NULL,
  `TELF_Tutor_Empresa` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anexo_ciclo`
--

CREATE TABLE `anexo_ciclo` (
  `ID_Anexo_Ciclo` int(11) NOT NULL,
  `ID_Anexo` int(11) NOT NULL,
  `ID_Ciclo_Formativo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anyo_necesidad`
--

CREATE TABLE `anyo_necesidad` (
  `ID_Anyo_Necesidad` int(11) NOT NULL,
  `Anyo` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anyo_ventana`
--

CREATE TABLE `anyo_ventana` (
  `ID_Anyo_Ventana` int(11) NOT NULL,
  `ID_Anyo_Necesidad` int(11) NOT NULL,
  `ID_Ventana_Necesidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bolsa_ciclo`
--

CREATE TABLE `bolsa_ciclo` (
  `ID_Bolsa_Ciclo` int(11) NOT NULL,
  `ID_Bolsa_Trabajo` int(11) NOT NULL,
  `ID_Ciclo_Formativo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bolsa_trabajo`
--

CREATE TABLE `bolsa_trabajo` (
  `ID_Bolsa_Trabajo` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Comentarios` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centro_formativo`
--

CREATE TABLE `centro_formativo` (
  `ID_Centro_Formativo` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `CIF` varchar(9) NOT NULL,
  `DUENYO` varchar(200) NOT NULL,
  `Direccion` varchar(200) NOT NULL,
  `Telefono` varchar(9) NOT NULL,
  `EMAIL` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciclos_formativos`
--

CREATE TABLE `ciclos_formativos` (
  `ID_Ciclo_Formativo` int(11) NOT NULL,
  `Nombre_Ciclo` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciclo_alumno`
--

CREATE TABLE `ciclo_alumno` (
  `ID_Ciclo_Alumno` int(11) NOT NULL,
  `ID_Ciclo_Formativo` int(11) NOT NULL,
  `ID_Alumno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto_control`
--

CREATE TABLE `contacto_control` (
  `ID_Contacto_Control` int(11) NOT NULL,
  `ID_Control_Empresa` int(11) NOT NULL,
  `ID_Contacto_Empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto_empresa`
--

CREATE TABLE `contacto_empresa` (
  `ID_Contacto_Empresa` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `EMAIL_Contacto_Empresa` varchar(100) NOT NULL,
  `TELF_Contacto_Empresa` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control_convenios`
--

CREATE TABLE `control_convenios` (
  `ID_Convenio` int(11) NOT NULL,
  `ID_Ministerio` int(11) NOT NULL COMMENT 'Es un elemento dado por la Comunidad de Madrid',
  `ID_Control_Empresa` int(11) NOT NULL,
  `ID_Centro_Formativo` int(11) NOT NULL,
  `Fecha_Inicio` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control_empresas`
--

CREATE TABLE `control_empresas` (
  `ID_Control_Empresa` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `CIF` varchar(9) NOT NULL,
  `Duenyo` varchar(100) NOT NULL,
  `Firmante_Convenio` varchar(100) NOT NULL,
  `Direccion` varchar(200) NOT NULL,
  `EMAIL_Empresa` varchar(100) NOT NULL,
  `TELF_Empresa` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control_practicas`
--

CREATE TABLE `control_practicas` (
  `ID_Practica` int(11) NOT NULL,
  `Tutor_CFP` varchar(100) NOT NULL,
  `Direccion_Prácticas` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `convenios_anexos`
--

CREATE TABLE `convenios_anexos` (
  `ID_Convenio_Anexo` int(11) NOT NULL,
  `ID_Convenio` int(11) NOT NULL,
  `ID_Anexo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `convenio_anyo`
--

CREATE TABLE `convenio_anyo` (
  `ID_Convenio_Anyo` int(11) NOT NULL,
  `ID_Convenio` int(11) NOT NULL,
  `ID_Anyo_Necesidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa_bolsa`
--

CREATE TABLE `empresa_bolsa` (
  `ID_Empresa_Bolsa` int(11) NOT NULL,
  `Nombre_Empresa_Bolsa` varchar(50) NOT NULL,
  `TELF_Empresa_Bolsa` varchar(9) NOT NULL,
  `EMAIL_Empresa_Bolsa` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa_bolsa_trabajo`
--

CREATE TABLE `empresa_bolsa_trabajo` (
  `ID_Empresa_Bolsa_Trabajo` int(11) NOT NULL,
  `ID_Empresa_Bolsa` int(11) NOT NULL,
  `ID_Bolsa_Trabajo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `ID_Notas` int(11) NOT NULL,
  `Media_Aritmetica` varchar(42) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `practicas_alumnos`
--

CREATE TABLE `practicas_alumnos` (
  `ID_Practica_Alumno` int(11) NOT NULL,
  `ID_Practica` int(11) NOT NULL,
  `ID_Alumno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `ID_Usuario` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Apellido1` varchar(50) NOT NULL,
  `Apellido2` varchar(50) NOT NULL,
  `EMAIL_Usuario` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_centro`
--

CREATE TABLE `usuario_centro` (
  `ID_Usuario_Centro` int(11) NOT NULL,
  `ID_Usuario` int(11) NOT NULL,
  `ID_Centro_Formativo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_notas`
--

CREATE TABLE `usuario_notas` (
  `ID_Usuario_Notas` int(11) NOT NULL,
  `ID_Usuario` int(11) NOT NULL,
  `ID_Notas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacantes`
--

CREATE TABLE `vacantes` (
  `ID_Vacantes` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacantes_ciclo`
--

CREATE TABLE `vacantes_ciclo` (
  `ID_Vacantes_Ciclo` int(11) NOT NULL,
  `ID_Vacantes` int(11) NOT NULL,
  `ID_Ciclo_Formativo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventana_necesidad`
--

CREATE TABLE `ventana_necesidad` (
  `ID_Ventana_Necesidad` int(11) NOT NULL,
  `Cuadrante` enum('Abril','Septiembre') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventana_vacantes`
--

CREATE TABLE `ventana_vacantes` (
  `ID_Ventana_Vacantes` int(11) NOT NULL,
  `ID_Ventana_Necesidad` int(11) NOT NULL,
  `ID_Vacantes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`ID_Alumno`);

--
-- Indices de la tabla `anexos`
--
ALTER TABLE `anexos`
  ADD PRIMARY KEY (`ID_Anexo`);

--
-- Indices de la tabla `anexo_ciclo`
--
ALTER TABLE `anexo_ciclo`
  ADD PRIMARY KEY (`ID_Anexo_Ciclo`),
  ADD KEY `FK_AnCic_Anexo` (`ID_Anexo`),
  ADD KEY `FK_AnCic_Ciclo` (`ID_Ciclo_Formativo`);

--
-- Indices de la tabla `anyo_necesidad`
--
ALTER TABLE `anyo_necesidad`
  ADD PRIMARY KEY (`ID_Anyo_Necesidad`);

--
-- Indices de la tabla `anyo_ventana`
--
ALTER TABLE `anyo_ventana`
  ADD KEY `FK_AnVen_Anyo` (`ID_Anyo_Necesidad`),
  ADD KEY `FK_AnVen_Ventana` (`ID_Ventana_Necesidad`);

--
-- Indices de la tabla `bolsa_ciclo`
--
ALTER TABLE `bolsa_ciclo`
  ADD PRIMARY KEY (`ID_Bolsa_Ciclo`),
  ADD KEY `FK_BoCic_Bolsa` (`ID_Bolsa_Trabajo`),
  ADD KEY `FK_BoCic_Ciclo` (`ID_Ciclo_Formativo`);

--
-- Indices de la tabla `bolsa_trabajo`
--
ALTER TABLE `bolsa_trabajo`
  ADD PRIMARY KEY (`ID_Bolsa_Trabajo`);

--
-- Indices de la tabla `centro_formativo`
--
ALTER TABLE `centro_formativo`
  ADD PRIMARY KEY (`ID_Centro_Formativo`);

--
-- Indices de la tabla `ciclos_formativos`
--
ALTER TABLE `ciclos_formativos`
  ADD PRIMARY KEY (`ID_Ciclo_Formativo`);

--
-- Indices de la tabla `ciclo_alumno`
--
ALTER TABLE `ciclo_alumno`
  ADD PRIMARY KEY (`ID_Ciclo_Alumno`),
  ADD KEY `FP_CA_Ciclo` (`ID_Ciclo_Formativo`),
  ADD KEY `FK_CA_Alumno` (`ID_Alumno`);

--
-- Indices de la tabla `contacto_control`
--
ALTER TABLE `contacto_control`
  ADD PRIMARY KEY (`ID_Contacto_Control`),
  ADD KEY `FK_IDCONTROLEMPRESA` (`ID_Control_Empresa`),
  ADD KEY `FK_IDContactoEmpresa` (`ID_Contacto_Empresa`);

--
-- Indices de la tabla `contacto_empresa`
--
ALTER TABLE `contacto_empresa`
  ADD PRIMARY KEY (`ID_Contacto_Empresa`);

--
-- Indices de la tabla `control_convenios`
--
ALTER TABLE `control_convenios`
  ADD PRIMARY KEY (`ID_Convenio`),
  ADD KEY `FK_CEmpre_CConve` (`ID_Control_Empresa`) USING BTREE,
  ADD KEY `FK_CConvenios_CForma` (`ID_Centro_Formativo`);

--
-- Indices de la tabla `control_empresas`
--
ALTER TABLE `control_empresas`
  ADD PRIMARY KEY (`ID_Control_Empresa`);

--
-- Indices de la tabla `control_practicas`
--
ALTER TABLE `control_practicas`
  ADD PRIMARY KEY (`ID_Practica`);

--
-- Indices de la tabla `convenios_anexos`
--
ALTER TABLE `convenios_anexos`
  ADD PRIMARY KEY (`ID_Convenio_Anexo`),
  ADD KEY `FK_CA_Convenio` (`ID_Convenio`),
  ADD KEY `FK_CA_Anexos` (`ID_Anexo`);

--
-- Indices de la tabla `convenio_anyo`
--
ALTER TABLE `convenio_anyo`
  ADD PRIMARY KEY (`ID_Convenio_Anyo`),
  ADD KEY `FK_CAn_Convenio` (`ID_Convenio`),
  ADD KEY `FK_CAn_Anyo` (`ID_Anyo_Necesidad`);

--
-- Indices de la tabla `empresa_bolsa`
--
ALTER TABLE `empresa_bolsa`
  ADD PRIMARY KEY (`ID_Empresa_Bolsa`);

--
-- Indices de la tabla `empresa_bolsa_trabajo`
--
ALTER TABLE `empresa_bolsa_trabajo`
  ADD PRIMARY KEY (`ID_Empresa_Bolsa_Trabajo`),
  ADD KEY `FK_EMBOTra_Empresa` (`ID_Empresa_Bolsa`),
  ADD KEY `FK_EMBOTra_Bolsa` (`ID_Bolsa_Trabajo`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`ID_Notas`);

--
-- Indices de la tabla `practicas_alumnos`
--
ALTER TABLE `practicas_alumnos`
  ADD PRIMARY KEY (`ID_Practica_Alumno`),
  ADD KEY `FK_PA_Practicas` (`ID_Practica`),
  ADD KEY `FK_PA_Alumnos` (`ID_Alumno`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID_Usuario`);

--
-- Indices de la tabla `usuario_centro`
--
ALTER TABLE `usuario_centro`
  ADD PRIMARY KEY (`ID_Usuario_Centro`),
  ADD KEY `FK_UCen_Usuario` (`ID_Usuario`),
  ADD KEY `FK_UCen_Centro` (`ID_Centro_Formativo`);

--
-- Indices de la tabla `usuario_notas`
--
ALTER TABLE `usuario_notas`
  ADD PRIMARY KEY (`ID_Usuario_Notas`),
  ADD KEY `FK_UsNot_Usuario` (`ID_Usuario`),
  ADD KEY `FK_UsNot_Notas` (`ID_Notas`);

--
-- Indices de la tabla `vacantes`
--
ALTER TABLE `vacantes`
  ADD PRIMARY KEY (`ID_Vacantes`);

--
-- Indices de la tabla `vacantes_ciclo`
--
ALTER TABLE `vacantes_ciclo`
  ADD PRIMARY KEY (`ID_Vacantes_Ciclo`),
  ADD KEY `FK_VacCic_Vacantes` (`ID_Vacantes`),
  ADD KEY `FK_VacCic_Ciclo` (`ID_Ciclo_Formativo`);

--
-- Indices de la tabla `ventana_necesidad`
--
ALTER TABLE `ventana_necesidad`
  ADD PRIMARY KEY (`ID_Ventana_Necesidad`);

--
-- Indices de la tabla `ventana_vacantes`
--
ALTER TABLE `ventana_vacantes`
  ADD PRIMARY KEY (`ID_Ventana_Vacantes`),
  ADD KEY `FK_VenVac_Ventana` (`ID_Ventana_Necesidad`),
  ADD KEY `FK_VenVac_Vacantes` (`ID_Vacantes`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `ID_Alumno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `anexos`
--
ALTER TABLE `anexos`
  MODIFY `ID_Anexo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `anexo_ciclo`
--
ALTER TABLE `anexo_ciclo`
  MODIFY `ID_Anexo_Ciclo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `anyo_necesidad`
--
ALTER TABLE `anyo_necesidad`
  MODIFY `ID_Anyo_Necesidad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bolsa_ciclo`
--
ALTER TABLE `bolsa_ciclo`
  MODIFY `ID_Bolsa_Ciclo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bolsa_trabajo`
--
ALTER TABLE `bolsa_trabajo`
  MODIFY `ID_Bolsa_Trabajo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `centro_formativo`
--
ALTER TABLE `centro_formativo`
  MODIFY `ID_Centro_Formativo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ciclos_formativos`
--
ALTER TABLE `ciclos_formativos`
  MODIFY `ID_Ciclo_Formativo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ciclo_alumno`
--
ALTER TABLE `ciclo_alumno`
  MODIFY `ID_Ciclo_Alumno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contacto_control`
--
ALTER TABLE `contacto_control`
  MODIFY `ID_Contacto_Control` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contacto_empresa`
--
ALTER TABLE `contacto_empresa`
  MODIFY `ID_Contacto_Empresa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `control_convenios`
--
ALTER TABLE `control_convenios`
  MODIFY `ID_Convenio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `control_empresas`
--
ALTER TABLE `control_empresas`
  MODIFY `ID_Control_Empresa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `control_practicas`
--
ALTER TABLE `control_practicas`
  MODIFY `ID_Practica` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `convenios_anexos`
--
ALTER TABLE `convenios_anexos`
  MODIFY `ID_Convenio_Anexo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `convenio_anyo`
--
ALTER TABLE `convenio_anyo`
  MODIFY `ID_Convenio_Anyo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresa_bolsa`
--
ALTER TABLE `empresa_bolsa`
  MODIFY `ID_Empresa_Bolsa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresa_bolsa_trabajo`
--
ALTER TABLE `empresa_bolsa_trabajo`
  MODIFY `ID_Empresa_Bolsa_Trabajo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `ID_Notas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `practicas_alumnos`
--
ALTER TABLE `practicas_alumnos`
  MODIFY `ID_Practica_Alumno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID_Usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario_centro`
--
ALTER TABLE `usuario_centro`
  MODIFY `ID_Usuario_Centro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario_notas`
--
ALTER TABLE `usuario_notas`
  MODIFY `ID_Usuario_Notas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `vacantes`
--
ALTER TABLE `vacantes`
  MODIFY `ID_Vacantes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `vacantes_ciclo`
--
ALTER TABLE `vacantes_ciclo`
  MODIFY `ID_Vacantes_Ciclo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ventana_necesidad`
--
ALTER TABLE `ventana_necesidad`
  MODIFY `ID_Ventana_Necesidad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ventana_vacantes`
--
ALTER TABLE `ventana_vacantes`
  MODIFY `ID_Ventana_Vacantes` int(11) NOT NULL AUTO_INCREMENT;

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
-- Filtros para la tabla `convenios_anexos`
--
ALTER TABLE `convenios_anexos`
  ADD CONSTRAINT `FK_CA_Anexos` FOREIGN KEY (`ID_Anexo`) REFERENCES `anexos` (`ID_Anexo`),
  ADD CONSTRAINT `FK_CA_Convenio` FOREIGN KEY (`ID_Convenio`) REFERENCES `control_convenios` (`ID_Convenio`);

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
-- Filtros para la tabla `usuario_notas`
--
ALTER TABLE `usuario_notas`
  ADD CONSTRAINT `FK_UsNot_Notas` FOREIGN KEY (`ID_Notas`) REFERENCES `notas` (`ID_Notas`),
  ADD CONSTRAINT `FK_UsNot_Usuario` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuario` (`ID_Usuario`);

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
