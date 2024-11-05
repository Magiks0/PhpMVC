-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 05 nov. 2024 à 17:59
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `phpmvc`
--

-- --------------------------------------------------------

--
-- Structure de la table `albums`
--

CREATE TABLE `albums` (
  `id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `song_number` int(11) NOT NULL,
  `editor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `albums`
--

INSERT INTO `albums` (`id`, `media_id`, `song_number`, `editor`) VALUES
(1, 3, 9, 'Epic Records'),
(2, 1, 10, 'Capitol Records'),
(3, 2, 9, 'Columbia Records'),
(4, 3, 12, 'Warner Music Group'),
(5, 4, 8, 'RCA Records'),
(6, 5, 11, 'Atlantic Records'),
(7, 6, 7, 'Polygram'),
(8, 7, 15, 'EMI Records'),
(9, 8, 14, 'Sony Music'),
(10, 9, 13, 'Universal Music'),
(11, 10, 10, 'Interscope Records'),
(12, 11, 12, 'Island Records');

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `page_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `books`
--

INSERT INTO `books` (`id`, `media_id`, `page_number`) VALUES
(1, 1, 218),
(2, 1, 218),
(3, 2, 328),
(4, 3, 281),
(5, 4, 432),
(6, 5, 635),
(7, 6, 277),
(8, 7, 310),
(9, 8, 158),
(10, 9, 1225),
(11, 10, 254),
(12, 11, 368),
(13, 12, 208),
(14, 13, 423),
(15, 14, 507),
(16, 15, 430),
(17, 16, 430),
(18, 17, 400),
(19, 18, 500),
(20, 19, 350),
(21, 20, 455);

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `media`
--

INSERT INTO `media` (`id`, `title`, `author`, `available`) VALUES
(1, 'The Great Gatsby', 'F. Scott Fitzgerald', 1),
(2, 'Inception', 'Christopher Nolan', 0),
(3, 'Thriller', 'Michael Jackson', 1),
(4, 'The Great Gatsby', 'F. Scott Fitzgerald', 1),
(5, '1984', 'George Orwell', 1),
(6, 'To Kill a Mockingbird', 'Harper Lee', 1),
(7, 'Pride and Prejudice', 'Jane Austen', 1),
(8, 'Moby Dick', 'Herman Melville', 1),
(9, 'The Catcher in the Rye', 'J.D. Salinger', 0),
(10, 'The Hobbit', 'J.R.R. Tolkien', 1),
(11, 'Fahrenheit 451', 'Ray Bradbury', 1),
(12, 'War and Peace', 'Leo Tolstoy', 1),
(13, 'The Picture of Dorian Gray', 'Oscar Wilde', 1),
(14, 'Brave New World', 'Aldous Huxley', 0),
(15, 'The Alchemist', 'Paulo Coelho', 1),
(16, 'The Lord of the Rings', 'J.R.R. Tolkien', 1),
(17, 'Jane Eyre', 'Charlotte Brontë', 1),
(18, 'Crime and Punishment', 'Fyodor Dostoevsky', 1),
(19, 'The Brothers Karamazov', 'Fyodor Dostoevsky', 1),
(20, 'The Odyssey', 'Homer', 1),
(21, 'The Iliad', 'Homer', 1),
(22, 'Wuthering Heights', 'Emily Brontë', 1),
(23, 'The Grapes of Wrath', 'John Steinbeck', 1),
(24, 'The Road', 'Cormac McCarthy', 0),
(25, 'Dune', 'Frank Herbert', 1),
(26, 'The Hitchhiker\'s Guide to the Galaxy', 'Douglas Adams', 1),
(27, 'The Shining', 'Stephen King', 1),
(28, 'Gone with the Wind', 'Margaret Mitchell', 1),
(29, 'The Diary of a Young Girl', 'Anne Frank', 1),
(30, 'The Bell Jar', 'Sylvia Plath', 1),
(31, 'The Handmaid\'s Tale', 'Margaret Atwood', 0),
(32, 'The Perks of Being a Wallflower', 'Stephen Chbosky', 1),
(33, 'A Tale of Two Cities', 'Charles Dickens', 1),
(34, 'The Secret Garden', 'Frances Hodgson Burnett', 1),
(35, 'Little Women', 'Louisa May Alcott', 1),
(36, 'The Time Machine', 'H.G. Wells', 1),
(37, 'A Wrinkle in Time', 'Madeleine L\'Engle', 1),
(38, 'The Fault in Our Stars', 'John Green', 1),
(39, 'The Chronicles of Narnia', 'C.S. Lewis', 0),
(40, 'The Road Not Taken', 'Robert Frost', 1);

-- --------------------------------------------------------

--
-- Structure de la table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `duration` double NOT NULL,
  `genre` enum('Action','Comedy','Drama','Horror','Sci-Fi') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `movies`
--

INSERT INTO `movies` (`id`, `media_id`, `duration`, `genre`) VALUES
(1, 2, 148, 'Sci-Fi'),
(2, 21, 142, 'Drama'),
(3, 22, 110, 'Sci-Fi'),
(4, 23, 135, 'Drama'),
(5, 24, 180, ''),
(6, 25, 135, ''),
(7, 26, 119, 'Drama'),
(8, 27, 120, ''),
(9, 28, 132, ''),
(10, 29, 100, 'Comedy'),
(11, 30, 150, 'Action'),
(12, 31, 101, ''),
(13, 32, 130, 'Horror'),
(14, 33, 150, '');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `username`, `password`) VALUES
(1, 'test@test.com', 'Ldps', '$argon2id$v=19$m=65536,t=4,p=1$Z1ZiV1NLZGRZSmFlRWlZNw$ltnWHpM8GKJSLitktfMOHvAX2G2PsN6Qfo3uOrxb7rM');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_id` (`media_id`);

--
-- Index pour la table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_id` (`media_id`);

--
-- Index pour la table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_id` (`media_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Uniq` (`email`) USING HASH;

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `albums`
--
ALTER TABLE `albums`
  ADD CONSTRAINT `albums_ibfk_1` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_ibfk_1` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
