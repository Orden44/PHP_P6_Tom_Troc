-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 29 fév. 2024 à 12:50
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
-- Base de données : `tom_troc`
--

-- --------------------------------------------------------

--
-- Structure de la table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `available` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `book`
--

INSERT INTO `book` (`id`, `title`, `author`, `picture`, `content`, `id_user`, `available`) VALUES
(1, 'Esther', 'Alabaster', 'public/img/Esther.png', '', 1, 1),
(2, 'The Kinfolk Table', 'Nathan Williams', 'public/img/Kinfolk.png', 'J\'ai récemment plongé dans les pages de \'The Kinfolk Table\' et j\'ai été enchanté par cette œuvre captivante. Ce livre va bien au-delà d\'une simple collection de recettes ; il célèbre l\'art de partager des moments authentiques autour de la table. \r\n\r\nLes photographies magnifiques et le ton chaleureux captivent dès le départ, transportant le lecteur dans un voyage à travers des recettes et des histoires qui mettent en avant la beauté de la simplicité et de la convivialité. \r\n\r\nChaque page est une invitation à ralentir, à savourer et à créer des souvenirs durables avec les êtres chers. \r\n\r\n\'The Kinfolk Table\' incarne parfaitement l\'esprit de la cuisine et de la camaraderie, et il est certain que ce livre trouvera une place spéciale dans le cœur de tout amoureux de la cuisine et des rencontres inspirantes.', 2, 1),
(3, 'Wabi Sabi', 'Beth Kempton', 'public/img/Wabi.png', '', 2, 1),
(4, 'Milk & honey', 'Rupi Kaur', 'public/img/Milk.png', '', 3, 1),
(5, 'Delight!', 'Justin Rossow', 'public/img/Delight.png', '', 4, 0),
(6, 'Milwaukee Mission', 'Cooper Low', 'public/img/Milwaukee.png', '', 5, 1),
(7, 'Minimalist Graphics', 'Julia Schonlau', 'public/img/Minimalist.png', '', 6, 1),
(8, 'Hygge', 'Meik Wiking', 'public/img/Hygge.png', '', 3, 1),
(9, 'Innovation', 'Matt Ridley', 'public/img/Innovation.png', '', 7, 1),
(10, 'Psalms', 'Alabaster', 'public/img/Psalms.png', '', 8, 1),
(11, 'Thinking, Fast & Slow', 'Daniel Kahneman', 'public/img/Thinking.png', '', 9, 0),
(12, 'A Book Full Of Hope', 'Rupi Kaur', 'public/img/Book.png', '', 10, 1),
(13, 'The Subtle Art Of...', 'Mark Manson', 'public/img/Art.png', '', 11, 1),
(14, 'Narnia', 'C.S Lewis', 'public/img/Narnia.png', '', 12, 0),
(15, 'Company Of One', 'Paul Jarvis', 'public/img/Company.png', '', 13, 1),
(16, 'The Two Towers', 'J.R.R Tolkien', 'public/img/Towers.png', '', 14, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_book_user` (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `fk_book_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
