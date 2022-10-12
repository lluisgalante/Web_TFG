-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-06-2022 a las 09:20:44
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `webtfg`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `problem`
--

CREATE TABLE `problem` (
  `id` int(11) NOT NULL,
  `route` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `visibility` varchar(255) NOT NULL,
  `memory` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `language` varchar(50) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `edited` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `problem`
--

INSERT INTO `problem` (`id`, `route`, `title`, `description`, `visibility`, `memory`, `time`, `language`, `subject_id`, `edited`) VALUES
(46, '/../app/problemes/0/Progamació de classes i headers', 'Progamació de classes i headers', '', 'Public', '', '', 'C++', 0, 0),
(47, '/../app/problemes/0/Llibreria numpy', 'Llibreria numpy', 'NumPy es una librería de Python especializada en el cálculo numérico y el análisis de datos, especialmente para un gran volumen de datos. asuojkdhg\r\n\r\nIncorpora una nueva clase de objetos llamados arrays que permite representar colecciones de datos de un mismo tipo en varias dimensiones, y funciones muy eficientes para su manipulación.', 'Public', '50', '5', 'Python', 0, 0),
(48, '/../app/problemes/2/Classes de Python', 'Classes de Python', 'Creación de arrays\nPara crear un array se utiliza la siguiente función de NumPy\n\nnp.array(lista) : Crea un array a partir de la lista o tupla lista y devuelve una referencia a él. El número de dimensiones del array dependerá de las listas o tuplas anidadas en lista:\n\nPara una lista de valores se crea un array de una dimensión, también conocido como vector.\nPara una lista de listas de valores se crea un array de dos dimensiones, también conocido como matriz.\nPara una lista de listas de listas de valores se crea un array de tres dimensiones, también conocido como cubo.\nY así sucesivamente. No hay límite en el número de dimensiones del array más allá de la memoria disponible en el sistema.\n Los elementos de la lista o tupla deben ser del mismo tipo.', 'Public', '50', '5', 'Python', 2, 0),
(67, '/../app/problemes/0/Clearly a test good', 'Clearly a test good', 'Descipcion coeta', 'Public', '50', '5', 'Python', 0, 0),
(69, '/../app/problemes/6/problema de prova', 'problema de prova', 'Això és una provaasaaa', 'Public', '50', '52', 'Python', 6, 0),
(75, '/../app/problemes/0/Problema de ficheros en c++', 'Problema de ficheros en c++', 'Este es un test de ficheros de c++', 'Public', '50', '5', 'C++', 0, 0),
(130, '/../app/problemes/6/New problem', 'New problem', 'asda', 'Public', '12', '12', 'C++', 6, 0),
(137, '/../app/problemes/0/Problema buit', 'Problema buit', 'Problema amb un només un txt', 'Public', '1', '1', 'Python', 0, 0),
(139, '/../app/problemes/6/Jupyter', 'Jupyter', 'Jupyter', 'Public', '1', '1', 'Notebook', 6, 0),
(141, '/../app/problemes/6/Problema 6', 'Problema 6', 'Problema 6 ', 'Private', '1', '1', 'Python', 6, 0),
(142, '/../app/problemes/6/Problema 7', 'Problema 7', 'Pro7', 'Private', '1', '1', 'Python', 6, 0),
(145, '/../app/problemes/2/Clearly a test good', 'Clearly a test good', '', 'Private', '1', '1', 'Python', 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `professor`
--

CREATE TABLE `professor` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `professor`
--

INSERT INTO `professor` (`id`, `name`, `surname`, `password`, `email`) VALUES
(1, 'Pepe', 'Viyuela', '$2y$10$eNxpgdh1Qk5r5HQdo7DzeeF.lhNjJsEmPAwfnsPSTgt7wlc9xOfpy', 'punyetazo@gmail.com'),
(3, 'as', 'Youssef', '$2y$10$eNxpgdh1Qk5r5HQdo7DzeeF.lhNjJsEmPAwfnsPSTgt7wlc9xOfpy', 'punyetsazo@gmail.com'),
(4, 'Assbaghi', 'iksajklasd', '$2y$10$McYjqkQjFZMuwUNtVTZ4MO5Wxt3B4TF5N5ZlmryX4p7Uk0pg6rN.q', 'sermankerwe@gmail.com'),
(5, 'asAssbaghi', 'iksajklasd', '$2y$10$nOmfkPG4fN3r8uJeBaRlwe2qgLDOci/dqKJcTHF0mE2u3SagWJtBa', 'sermankersd@gmail.com'),
(6, 'Assbaghi', 'Youssef', '$2y$10$fNSN7nTZizXzI2rruJGqXO8I3QL1vqfE7K9ocrqNje2nhT8a7SI8e', 'punyetasdsdzo@gmail.com'),
(7, 'Ernest', 'Valveny', '$2y$10$P1H9Znk0rcyzHRceT1NL9u6oNMK0zmq6VNATm2BhSN78rixPYBmtC', 'ernest@cvc.uab.es'),
(8, 'Ernest', 'Valveny', '$2y$10$h6gIK9JRPlgt8dM7J39ox.bW0ErdRZeyFvHFNZjdCMcQBm.7btbKG', 'ernest@cvc.uab.cat'),
(9, 'Professor', 'Dalton', '$2y$10$g3ZhhsB/hC.ri71XKTe2s.5udaBIg12k9VAKZ4bsPPZuSSRzgxWiC', 'pd@gmail.com'),
(10, 'ProfeP', 'ProfeP', '$2y$10$FJ..KOio1MUDPz8e5R5QzOsAdmRL1Dffyv8o.EgYdDkwnNeyaVlrS', 'asdasdasdasd@gmail.com'),
(11, 'ProfeP', 'ProfeP', '$2y$10$vZQrZJhkPzuCCkKJlctB6.I0zyY6v50P8IdEOV08zOWdwm130YhJC', 'asdasdasdasd12@gmail.com'),
(12, 'asdmaksa', 'klamsdkla', '$2y$10$9BdLxhdJ15I5iWm5j3zTPuS6a1pYYyCmA1NJ2z75JtV1NAqXhAyTe', 'aklsmdlak@gmail.com'),
(18, 'asdasdas', 'asdasdas', '$2y$10$XCspAv4IHPovE1lmtChwpeHQuvRyA4cMcN8lfilJNtMx96oMlmPeq', 'asdasda@asdasdasdasda.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `professor_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `session`
--

INSERT INTO `session` (`id`, `name`, `professor_id`, `subject_id`) VALUES
(50, 'asdasd', 1, 6),
(51, 'Session', 1, 0),
(52, 'Session', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `session_problems`
--

CREATE TABLE `session_problems` (
  `session_id` int(11) NOT NULL,
  `problem_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `session_problems`
--

INSERT INTO `session_problems` (`session_id`, `problem_id`) VALUES
(50, 69),
(50, 130),
(51, 46),
(51, 47),
(51, 67),
(51, 75),
(51, 137),
(52, 46);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solution`
--

CREATE TABLE `solution` (
  `id` int(11) NOT NULL,
  `route` varchar(255) NOT NULL,
  `problem_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `editing` int(11) NOT NULL DEFAULT 0,
  `edited` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `solution`
--

INSERT INTO `solution` (`id`, `route`, `problem_id`, `subject_id`, `user`, `editing`, `edited`) VALUES
(107, 'D:/xampp/htdocs/app/solucions/namesurname@mail.com/6/problema de prova', 69, 6, 'namesurname@mail.com', 0, 0),
(109, 'D:/xampp/htdocs/app/solucions/namesurname@mail.com/0/Progamació de classes i headers', 46, 0, 'namesurname@mail.com', 0, 0),
(110, 'D:/xampp/htdocs/app/solucions/namesurname@mail.com/6/New problem', 130, 6, 'namesurname@mail.com', 0, 0),
(111, 'D:/xampp/htdocs/app/solucions/namesurname@mail.com/0/Llibreria numpy', 47, 0, 'namesurname@mail.com', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `session_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `student`
--

INSERT INTO `student` (`id`, `name`, `surname`, `email`, `password`, `session_id`) VALUES
(1, 'Assbaghi', 'iksajklasd', 'youssef.assbaghi@e-campus.uab.cat', '$2y$10$wmqxL/WbZ.VxpCBXnGUzHONRS63r0TGemZcxxqTx/7DRCURZhAxFu', NULL),
(3, 'Assbaghi', 'iksajklasd', 'sermanker@gmail.com', '$2y$10$v1kK859Ze00Cycf/ExLNzeBAZLkH49oWtHUrDpA/1bc8wa6/BnkLm', NULL),
(4, 'Juan', 'Perez', 'localhost@gmail.com', '$2y$10$YnMM19UwnDIF1JZBX4t7HeOB4pxdr7MSBMBkgkiizuJJ3hdOaW082', NULL),
(5, 'asAssbaghi', 'iksajklasd', 'asas@gmail.com', '$2y$10$MhmvoB2q7/k/K9jt8jsrveKXwZV7IOn1ELEn8SYyq1IVbgDdqKYtS', NULL),
(6, 'asAssbaghi', 'iksajklasd', 'asass@gmail.com', '$2y$10$Jt4Dla8Awfytyjpt9SEiyedF4J3zu9nRBQ0ac4/xC5EM68l10udnG', NULL),
(7, 'asdasd', 'asdasd', 'sermansker@gmail.com', '$2y$10$QhhDcNBAAh4lAqwZ5qI7g.nXJSnOeW5WCX6ZQyvNsp7SpasztF5.m', NULL),
(8, 'Assbaghi', 'iksajklasd', 'sermankasder@gmail.com', '$2y$10$705LiEPcbcwdBVLHWeAMROc/q1QkXpHiOFnZ/EIaEZfYC1IxXgKf6', NULL),
(9, 'hgh', 'hgfhfg', 'hgfhgf@gmail.com', '$2y$10$Dmcf6CyWhKasX3SGK.NeueL8w1I4mSd2F/3jYRQRNbzvDqPrDRWw6', NULL),
(10, 'Ernest', 'Valveny', 'Ernest.Valveny@uab.cat', '$2y$10$3ejx5cmcxA4Xr3vlKCelpu.LpB//GZidFR/O9qq2.i6yiQ7YnyrrW', NULL),
(11, 'Pepecito', 'Vinyuelita', 'mail@gmail.com', '$2y$10$eNxpgdh1Qk5r5HQdo7DzeeF.lhNjJsEmPAwfnsPSTgt7wlc9xOfpy', NULL),
(12, 'name', 'surname', 'namesurname@mail.com', '$2y$10$eNxpgdh1Qk5r5HQdo7DzeeF.lhNjJsEmPAwfnsPSTgt7wlc9xOfpy', 50),
(13, 'name', 'surname', 'n@mail.com', '$2y$10$VZ6a3kb2bJTRnqrCs/idnOWHZogXpbRbV6J1cw8APVga8aaOtCTva', NULL),
(14, 'ASdasd', 'asdasd', 'ar@as.co', '$2y$10$Z0IuQ.VTgV3n6tspiPlrHOWk4tdyIuX6hgvCr1tRYTuxaFIbnJIM.', NULL),
(15, 'asdasd', 'asdasd', 'asdasd@asdasd.com', '$2y$10$suanHleSpmV.gyKmS6rZ8Og9GWktPcbyVyFRNQwHzadMbVQNU.AtO', NULL),
(16, 'Professor', 'Dalton', 'pd@gmail.com', '$2y$10$g3ZhhsB/hC.ri71XKTe2s.5udaBIg12k9VAKZ4bsPPZuSSRzgxWiC', NULL),
(17, 'Nom', 'Cognom', 'mail@mail.mail', '$2y$10$LS4GfSh/DNF0TWIXwvLAh.VBH3gwPzeTm42YmjqUrN0lleFFJTj4.', NULL),
(18, 'Pepe', 'Martinez', 'pepe@mail.com', '$2y$10$xNbhUR5M0.QXCEZMg2A0RedDmu3zmROrx7JWFfdtLqTza78hAevtS', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `subject`
--

INSERT INTO `subject` (`id`, `title`, `description`, `course`) VALUES
(0, 'Laboratori de programació', 'Programacio interactiva per estudiants', '3'),
(2, 'Metodologia de la programació', 'Programacio interactiva per estudiants', '2'),
(6, 'assignatura nova', 'Aquesta és una assignatura de prova', '1'),
(27, 'Assignatura', 'A', '1'),
(28, 'Assignatura', 'a', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  `usage` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tokens`
--

INSERT INTO `tokens` (`id`, `value`, `usage`) VALUES
(113, '533d5c96ab02cb96877fa5812ecc2de400ef8eeeb79827ac0f7a5e3eca6c650c', 0),
(114, '88d66d145c62c8895f79ad519bf96002d9862b5fb212e0ce865a0428643a03b6', 0),
(115, 'cf5aa6b1e8e7558b219c351245f715ecd4adae0023a6df95ea53395b2a7a6caf', 0),
(116, '4d7173f76f02a675d2a113e47ff975ad892e15f8663bf100db5f5c7f37e3c00a', 0),
(117, 'ef26469493653098016864006b02c31490290feca8612f7c535726d7438aed7b', 0),
(118, 'fcb8098f369d4d1d5b21aac3691c06d53cd5b43d1689a9f1b2b692be488d0df4', 0),
(119, '7560b2d3d6afc6faaf398ad0917aacdaf89452bcf6e5a33b38d1f4f3e7bd5108', 0),
(120, '8401a33e9deecb740f3f7c9fd5ff635113f92a1e2f14783d8f6aad224a284ce5', 0),
(121, '264ea622737b5362a6d2edd595b56758309382d50066369f0b44922914934481', 0),
(122, '2d2163cb3f6cc890ca54c6121befb1223d94194e93acb202e12920787626fc01', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `problem`
--
ALTER TABLE `problem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `AsignaturaID` (`subject_id`);

--
-- Indices de la tabla `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Email` (`email`);

--
-- Indices de la tabla `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `professor_id` (`professor_id`),
  ADD KEY `session_ibfk_2` (`subject_id`);

--
-- Indices de la tabla `session_problems`
--
ALTER TABLE `session_problems`
  ADD KEY `session_problems_ibfk_1` (`session_id`),
  ADD KEY `session_problems_ibfk_2` (`problem_id`);

--
-- Indices de la tabla `solution`
--
ALTER TABLE `solution`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Id_asignatura` (`subject_id`),
  ADD KEY `Usuario` (`user`),
  ADD KEY `Id_problema` (`problem_id`) USING BTREE;

--
-- Indices de la tabla `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Email` (`email`),
  ADD KEY `student_ibfk_1` (`session_id`);

--
-- Indices de la tabla `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Valor` (`value`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `problem`
--
ALTER TABLE `problem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT de la tabla `professor`
--
ALTER TABLE `professor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `solution`
--
ALTER TABLE `solution`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT de la tabla `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `problem`
--
ALTER TABLE `problem`
  ADD CONSTRAINT `problem_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`);

--
-- Filtros para la tabla `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_ibfk_1` FOREIGN KEY (`professor_id`) REFERENCES `professor` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `session_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `session_problems`
--
ALTER TABLE `session_problems`
  ADD CONSTRAINT `session_problems_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `session_problems_ibfk_2` FOREIGN KEY (`problem_id`) REFERENCES `problem` (`id`);

--
-- Filtros para la tabla `solution`
--
ALTER TABLE `solution`
  ADD CONSTRAINT `solution_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`),
  ADD CONSTRAINT `solution_ibfk_2` FOREIGN KEY (`problem_id`) REFERENCES `problem` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `solution_ibfk_3` FOREIGN KEY (`user`) REFERENCES `student` (`email`);

--
-- Filtros para la tabla `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
