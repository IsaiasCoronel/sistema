

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";






--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` int(11) NOT NULL,
  `rol` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Supervisor'),
(3, 'Vendedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `usuario` varchar(15) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `rol` int(11) DEFAULT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `correo`, `usuario`, `clave`, `rol`, `estatus`) VALUES
(1, 'Isaias', 'info@gmail.com', 'admin', '123456', 1, 1),
(2, 'Julio Estrada', 'julio@gmail.com', 'julio', '123', 2, 1),
(3, 'Carlos Hernández', 'carlos@gmail.com', 'carlos', '123', 3, 1),
(5, 'Marta Elena Franco', 'marta@gmail.com', 'marta', '123', 3, 1),
(7, 'Carol Cabrera', 'carol@gmail.com', 'carol', '123', 2, 0),
(8, 'Marvin Solares ', 'marvin@gmail.com', 'marvin', '123', 3, 1),
(9, 'Alan Melgar', 'alan@gmail.com', 'alan', '123', 2, 1),
(10, 'Efrain Gómez', 'efrain@gmail.com', 'efrain', '123', 2, 1),
(11, 'Fran Escobar', 'fran@gmail.com', 'fran', '123', 1, 1),
(12, 'Hana Montenegro', 'hana@gmail.com', 'hana', '123', 3, 1),
(13, 'Fredy Miranda', 'fredy@gmail.com', 'fredy', '123', 2, 1),
(14, 'Roberto Salazar', 'roberto@hotmail.com', 'roberto', '123', 3, 1),
(15, 'William Fernando PÃ©rez', 'william@hotmail.com', 'william', '123', 3, 1),
(16, 'Francisco Mora', 'frans@gmail.com', 'frans', '123', 3, 1),
(17, 'Ruben Guevara', 'ruben@hotmail.es', 'ruben', '123', 3, 1);



--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `rol` (`rol`);


--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;


--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE;

