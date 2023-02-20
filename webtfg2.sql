-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 11-02-2023 a las 14:58:50
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

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
-- Estructura de tabla para la tabla `entregable_student_grade`
--

CREATE TABLE `entregable_student_grade` (
  `problem_id` int(11) NOT NULL,
  `student_NIU` int(11) NOT NULL,
  `grade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_mail_id` varchar(50) NOT NULL,
  `outgoing_mail_id` varchar(50) NOT NULL,
  `session_id` int(11) NOT NULL,
  `problem_id` int(11) NOT NULL,
  `msg` varchar(400) NOT NULL,
  `date` varchar(15) NOT NULL,
  `viewed` tinyint(1) NOT NULL DEFAULT 0,
  `comun` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_mail_id`, `outgoing_mail_id`, `session_id`, `problem_id`, `msg`, `date`, `viewed`, `comun`) VALUES
(304, 'ernest@cvc.uab.cat', 'lluisgalante@gmail.com', 112, 279, 'Buenas, estoy atascado en la función operar de Operacions.cpp', '01/02 22:43', 1, 0),
(305, 'lluisgalante@gmail.com', 'ernest@cvc.uab.cat', 112, 279, 'De acuerdo, ahora lo miro', '01/02 22:44', 0, 0),
(306, 'ernest@cvc.uab.cat', 'lluisgalante@gmail.com', 112, 279, 'Genial, muchas gracias !', '01/02 22:44', 1, 0),
(307, 'lluisgalante@gmail.com', 'ernest@cvc.uab.cat', 112, 279, 'He comentado tu código anterior, lo que te he escrito ahora funciona correctamente. ', '01/02 22:45', 0, 0),
(308, 'ernest@cvc.uab.cat', 'lluisgalante@gmail.com', 112, 279, 'De acuerdo, ya te comentaré si tengo más dudas.', '01/02 22:45', 1, 0),
(329, 'ernest@cvc.uab.cat', 'lluisgalante@gmail.com', 202, 281, 'Hola, tinc un problema amb la funció operar() de l\'arxiu Racionals.cpp, em podries indicar que tinc malament?', '06/02 22:50', 1, 0),
(330, 'lluisgalante@gmail.com', 'ernest@cvc.uab.cat', 202, 281, 'Revisa el bucle for() de la línia 5, ahí es troba el problema.', '06/02 22:52', 0, 0),
(331, 'ernest@cvc.uab.cat', 'lluisgalante@gmail.com', 202, 281, 'D\'acord, gràcies, ara ho corregeix.', '06/02 22:52', 1, 0),
(337, 'ernest@cvc.uab.cat', 'lluisgalante@gmail.com', 202, 281, 'buenas', '06/02 23:37', 1, 0),
(338, 'lluisgalante@gmail.com', 'ernest@cvc.uab.cat', 203, 281, 'Hola a tots', '11/02 13:21:20', 0, 1),
(339, 'ernest@cvc.uab.cat', 'lluisgalante@gmail.com', 203, 281, 'Hola profe', '11/02 13:21', 1, 0),
(340, 'lluisgalante@gmail.com', 'ernest@cvc.uab.cat', 203, 281, 'Hola', '11/02 13:28:50', 0, 1),
(341, 'lluisgalante@gmail.com', 'ernest@cvc.uab.cat', 203, 281, 'hola de profe', '11/02 13:32', 0, 0),
(342, 'lluisgalante@gmail.com', 'ernest@cvc.uab.cat', 203, 281, 'hola', '11/02 13:37:00', 0, 1),
(343, 'ernest@cvc.uab.cat', 'lluisgalante@gmail.com', 203, 281, 'hola', '11/02 13:37', 1, 0),
(344, 'lluisgalante@gmail.com', 'ernest@cvc.uab.cat', 203, 281, 'Hola', '11/02 13:38', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `problem`
--

CREATE TABLE `problem` (
  `id` int(11) NOT NULL,
  `route` varchar(255) DEFAULT NULL,
  `route_solution` varchar(255) DEFAULT NULL,
  `solution_visibility` varchar(20) NOT NULL DEFAULT 'Private',
  `solution_lines` int(11) NOT NULL DEFAULT 0,
  `solution_quality` varchar(255) NOT NULL DEFAULT '0-0-0-0',
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `visibility` varchar(255) NOT NULL,
  `memory` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `language` varchar(50) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `entregable` varchar(3) NOT NULL DEFAULT 'off',
  `deadline` date DEFAULT NULL,
  `edited` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `problem`
--

INSERT INTO `problem` (`id`, `route`, `route_solution`, `solution_visibility`, `solution_lines`, `solution_quality`, `title`, `description`, `visibility`, `memory`, `time`, `language`, `subject_id`, `entregable`, `deadline`, `edited`) VALUES
(281, './../app/problemes/46/Racional', 'C:/xampp/htdocs/Controller/teacherSolution', 'Private', 338, '12-9-1-1', 'Racional', 'Exercici Racionals', 'private', '1', '1', 'C++', 46, 'off', NULL, 0);

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
(8, 'Ernest', 'Valveny', '$2y$10$M.H/utsdE7Ot6bhPXXq/a.UPhaGpdZvwhPJoNIBPACO131yuRSDye', 'ernest@cvc.uab.cat'),
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
  `class_group` varchar(11) NOT NULL,
  `status` varchar(11) NOT NULL,
  `professor_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `session`
--

INSERT INTO `session` (`id`, `name`, `class_group`, `status`, `professor_id`, `subject_id`) VALUES
(203, 'SP', '40', 'activated', 8, 46),
(204, 'SP', '42', 'activated', 8, 46);

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
(203, 281),
(204, 281);

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
(185, 'C:/xampp/htdocs/app/solucions/lluisgalante@gmail.com/46/Racional', 281, 46, 'lluisgalante@gmail.com', 0, 0),
(186, 'C:/xampp/htdocs/app/solucions/ferranlopez@gmail.com/46/Racional', 281, 46, 'ferranlopez@gmail.com', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `NIU` int(11) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `session_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `student`
--

INSERT INTO `student` (`id`, `name`, `surname`, `email`, `NIU`, `password`, `session_id`) VALUES
(33, 'Lluis', 'Galante', 'lluisgalante@gmail.com', 1525722, '$2y$10$tjdLTwPnU2Gp5DIyOW5Zt.LhklZreULb2i/e6j8Tbs5egD3dI1FES', 203),
(34, 'Marc', 'Izquierdo', 'marcizquierdo@gmail.com', 1525723, '$2y$10$qTbYZQmzoFwCS4VXrfNCBOtyZfcklwosGfgiWpCQpMNWPQS6y8TJe', NULL),
(36, 'Ferran', 'Galante', 'ferrangalante@gmail.com', 1525724, '$2y$10$rci8pqsrxVvFwwPjDoAQl.ikC3/fYi/WLcvzvYgTDR/6d5ITA/R9G', NULL),
(38, 'Irene', 'Conde', 'ireneconde@gmail.com', 1525725, '$2y$10$LZ2FPAUeLz/dDBl8kI8hdO2VAbcO8yc7lsA1Mcnwkb.8sqNd7aKPm', NULL),
(39, 'Eva', 'Causanilles', 'evacausanilles@gmail.com', 1525726, '$2y$10$iJ.GyykcRUsgzZ9kKoyt0OtYH2jk7rrlSc/E132C2wnuQjPTSGWZ2', NULL),
(40, 'Daniel', 'Saavedra', 'danielsaavedra@gmail.com', 1525727, '$2y$10$VGauc78g6xEpbEYt6YZfWuWWF/bvh6MbqgdMOGljDtHxsNQ.ZYgf6', NULL),
(46, 'Gerard', 'Garcia', 'gerardgarcia@gmail.com', 1234567, '$2y$10$YaSc/Nw6N8jKN1GEGvF4QOGrzuXuXweKyH29H0ppm7paILUvwmSM.', NULL),
(47, 'StudentTest', 'test', 'test@gmail.com', 16727272, '$2y$10$1qdm..D2w1eAQpkxQuLCmOEOCJS5Vhd/caFg2Dv.jeorlakgL8Q2a', NULL),
(48, 'Ferran', 'lopez', 'ferranlopez@gmail.com', 16727274, '$2y$10$R3SlbnfxlM2dTiazrqoQQ.Eu/biE89RcLUnRKxt4epjQSwfTojbLC', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `student_session_online`
--

CREATE TABLE `student_session_online` (
  `student_email` varchar(50) NOT NULL,
  `session_id` int(11) NOT NULL,
  `problem_id` int(11) NOT NULL,
  `output` varchar(10000) DEFAULT NULL,
  `number_lines_file` varchar(100) NOT NULL,
  `solution_quality` varchar(255) NOT NULL DEFAULT '0-0-0-0',
  `executed_times_count` int(11) NOT NULL,
  `teacher_executed_times_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `student_session_online`
--

INSERT INTO `student_session_online` (`student_email`, `session_id`, `problem_id`, `output`, `number_lines_file`, `solution_quality`, `executed_times_count`, `teacher_executed_times_count`) VALUES
('lluisgalante@gmail.com', 203, 281, '<pre>C:/xampp/htdocs/app/solucions/lluisgalante@gmail.com/46/Racional/Operacions.cpp: In function \'void operar(NombreRacional*, int, char, NombreRacional&, NombreRacional*)\':<br>C:/xampp/htdocs/app/solucions/lluisgalante@gmail.com/46/Racional/Operacions.cpp:5:5: error: \'code\' was not declared in this scope<br>    5 |     code Teacher<br>      |     ^~~~<br></pre>', '316', '11-8-0-0', 1, 0);

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
(46, 'MP', 'Assignatura promació c++\r\n', '1');

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
(122, '2d2163cb3f6cc890ca54c6121befb1223d94194e93acb202e12920787626fc01', 1),
(123, '06ac9083ba804ffac430e0851005fc574d837fa832459114bc7056f2174df62c', 0),
(124, 'cea55cdfec0eac40b9323a74811528d680546fef6d22601cda1006e9ad975634', 0),
(125, '8681f30e655e7bf56d53298f3478a4dc06bdf2ac40489f8e36cb5eb9d69f8530', 0),
(126, '5ff92563e56053eaa89256cd4c5c9d1bbdf5f53df68acf879f2b192934598483', 0),
(127, '9cfead69a0f55bfd593a81fbb2cd66d8702fda29e098cc447e6c5f2155048748', 0),
(128, '30fff4bc66f4a15a41c1915c9ebcfc33e7ae0c2127d46a9c4d43fd2aa281a6e8', 0),
(129, '223fdbcea083d5e530f21ceaa6124c220f36f5cb36223c845808d4ef312a7303', 0),
(130, '4d000719d37c97b2f5171d079239e01a42df8d369db7fbfc27ba919f108740ff', 0),
(131, 'a0d08ca84deecd7af0be97ea29008273fb2fb05963f9ad1cc7f7f767f578fc24', 0),
(132, 'fef19a1643f03c89606d96134aa776b07addaddc35ccafe7714645455db1ffae', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `entregable_student_grade`
--
ALTER TABLE `entregable_student_grade`
  ADD KEY `problem_id` (`problem_id`),
  ADD KEY `student_id` (`student_NIU`);

--
-- Indices de la tabla `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

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
  ADD KEY `student_ibfk_1` (`session_id`),
  ADD KEY `NIU` (`NIU`);

--
-- Indices de la tabla `student_session_online`
--
ALTER TABLE `student_session_online`
  ADD KEY `student_email` (`student_email`),
  ADD KEY `session_id` (`session_id`);

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
-- AUTO_INCREMENT de la tabla `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=345;

--
-- AUTO_INCREMENT de la tabla `problem`
--
ALTER TABLE `problem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=282;

--
-- AUTO_INCREMENT de la tabla `professor`
--
ALTER TABLE `professor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT de la tabla `solution`
--
ALTER TABLE `solution`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;

--
-- AUTO_INCREMENT de la tabla `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `entregable_student_grade`
--
ALTER TABLE `entregable_student_grade`
  ADD CONSTRAINT `entregable_student_grade_ibfk_1` FOREIGN KEY (`problem_id`) REFERENCES `problem` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `entregable_student_grade_ibfk_2` FOREIGN KEY (`student_NIU`) REFERENCES `student` (`NIU`) ON DELETE CASCADE ON UPDATE CASCADE;

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

--
-- Filtros para la tabla `student_session_online`
--
ALTER TABLE `student_session_online`
  ADD CONSTRAINT `student_session_online_ibfk_1` FOREIGN KEY (`student_email`) REFERENCES `student` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_session_online_ibfk_2` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
