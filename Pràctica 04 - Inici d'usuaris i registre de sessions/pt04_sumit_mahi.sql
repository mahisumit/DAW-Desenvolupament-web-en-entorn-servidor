-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-10-2024 a las 21:53:59
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
-- Base de datos: `pt04_sumit_mahi`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `bio` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `authors`
--

INSERT INTO `authors` (`id`, `name`, `bio`) VALUES
(1, 'George Orwell', 'English novelist and essayist, known for his criticisms of totalitarianism.'),
(2, 'J.K. Rowling', 'British author best known for the Harry Potter fantasy series.'),
(3, 'Harper Lee', 'American novelist widely known for her novel To Kill a Mockingbird.'),
(4, 'F. Scott Fitzgerald', 'American fiction writer, known for his novels depicting the Jazz Age.'),
(5, 'Aldous Huxley', 'English writer and philosopher, known for his novel Brave New World.'),
(6, 'Jane Austen', 'English novelist known for her romance novels set among the landed gentry.'),
(7, 'Andrew Hunt', 'Author and programmer, known for his contributions to software engineering practices.'),
(8, 'Robert C. Martin', 'Software engineer and author, recognized for his work in agile software development.'),
(9, 'Erich Gamma', 'Swiss computer scientist, one of the authors of the famous Design Patterns book.'),
(10, 'Martin Fowler', 'Software engineer and author, known for his work on software architecture and refactoring.'),
(11, 'Frederick P. Brooks Jr.', 'Computer scientist, best known for managing the development of IBM\'s System/360 family of computers.'),
(12, 'Thomas H. Cormen', 'American computer scientist, co-author of Introduction to Algorithms.'),
(13, 'Steve McConnell', 'Software engineer, author of Code Complete, known for software project management.'),
(14, 'Tom DeMarco', 'Software engineer, project manager, and author, known for Peopleware and software development methodologies.'),
(15, 'Jez Humble', 'Software developer and author, known for his work on Continuous Delivery.'),
(16, 'Eric Evans', 'Software engineer, known for promoting domain-driven design in software development.'),
(17, 'Michael Feathers', 'Software consultant and author, recognized for his work on legacy code refactoring.'),
(18, 'Donald E. Knuth', 'Computer scientist, author of The Art of Computer Programming, known for algorithms and programming techniques.'),
(19, 'Harold Abelson', 'Computer scientist and professor, co-author of Structure and Interpretation of Computer Programs.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  `publication_year` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `books`
--

INSERT INTO `books` (`id`, `title`, `author_id`, `publication_year`, `description`) VALUES
(1, '1984', 1, 1948, 'A dystopian novel set in a etotalitarian society.'),
(3, 'To Kill a Mockingbird', 2, 1960, 'A novel dealing with inequalityl.'),
(4, 'The Great Gatsby', 3, 1925, 'A novel about the American Dream set in the Roaring Twenties.'),
(5, 'Brave New World', 4, 1932, 'A dystopian novel envisioning a future, highly technological world.'),
(6, 'Pride and Prejudice', 5, 1813, 'A romantic novel of manners set in Georgian England.'),
(26, 'Refactoring', 6, 1999, 'Improving the design of existing code.'),
(38, 'The Pragmatic Programmer', 7, 1999, 'A book about software engineering best practices.'),
(39, 'Clean Code', 8, 2008, 'A handbook of agile software craftsmanship.'),
(40, 'Design Patterns', 9, 1994, 'Elements of reusable object-oriented software.'),
(41, 'Refactoring', 10, 1999, 'Improving the design of existing code.'),
(42, 'The Mythical Man-Month', 11, 1975, 'Essays on software engineering.'),
(43, 'Introduction to Algorithms', 12, 2009, 'A comprehensive textbook on algorithms.'),
(44, 'Code Complete', 13, 2004, 'A practical handbook of software construction.'),
(45, 'The Clean Coder', 14, 2011, 'A code of conduct for professional programmers.'),
(46, 'Peopleware', 15, 1987, 'Productive projects and teams.'),
(47, 'Continuous Delivery', 16, 2010, 'Reliable software releases through build, test, and deployment automation.'),
(48, 'Domain-Driven Design', 17, 2003, 'Tackling complexity in the heart of software.'),
(49, 'Patterns of Enterprise Application Architecture', 18, 2002, 'Architectural patterns for building enterprise applications.'),
(50, 'Working Effectively with Legacy Code', 19, 2004, 'Strategies for working with legacy software.'),
(51, 'The Art of Computer Programming', 14, 1968, 'A comprehensive monograph on computer programming algorithms and techniques.'),
(52, 'Structure and Interpretation of Computer Programs', 13, 1996, 'An introduction to computer science and programming principles.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `session_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `created_at`) VALUES
(5, 'p97h9c44', '$2y$10$oG4eufrwyNq6MOif0iQjOetMUyLIJufSKmvrX7y0z4aD7qN4ftFG2', 'mahi@gmail.com', '2024-10-17 14:35:29'),
(11, 'elon', '$2y$10$pXmXZIzfnaZH8Nv3.DA/9OAxm1Zejz37qNshYC8fLFrtdLVCjVJzO', 'musk@gmail.com', '2024-10-18 17:40:36');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`);

--
-- Filtros para la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD CONSTRAINT `password_resets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
