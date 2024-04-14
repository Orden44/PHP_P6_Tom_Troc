-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : dim. 14 avr. 2024 à 09:19
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
  `picture` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `available` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `book`
--

INSERT INTO `book` (`id`, `title`, `author`, `picture`, `content`, `id_user`, `available`) VALUES
(1, 'Esther', 'Alabaster', 'public/img/books/Esther.png', '', 1, 1),
(2, 'The Kinfolk Table', 'Nathan Williams', 'public/img/books/Kinfolk.png', 'J\'ai récemment plongé dans les pages de \'The Kinfolk Table\' et j\'ai été enchanté par cette œuvre captivante. Ce livre va bien au-delà d\'une simple collection de recettes ; il célèbre l\'art de partager des moments authentiques autour de la table. \r\n\r\nLes photographies magnifiques et le ton chaleureux captivent dès le départ, transportant le lecteur dans un voyage à travers des recettes et des histoires qui mettent en avant la beauté de la simplicité et de la convivialité. \r\n\r\nChaque page est une invitation à ralentir, à savourer et à créer des souvenirs durables avec les êtres chers. \r\n\r\n\'The Kinfolk Table\' incarne parfaitement l\'esprit de la cuisine et de la camaraderie, et il est certain que ce livre trouvera une place spéciale dans le cœur de tout amoureux de la cuisine et des rencontres inspirantes.', 2, 1),
(3, 'Wabi Sabi', 'Beth Kempton', 'public/img/books/Wabi.png', '', 2, 1),
(4, 'Milk & honey', 'Rupi Kaur', 'public/img/books/Milk.png', '', 3, 1),
(5, 'Delight!', 'Justin Rossow', 'public/img/books/Delight.png', '', 4, 0),
(6, 'Milwaukee Mission', 'Cooper Low', 'public/img/books/Milwaukee.png', '', 5, 1),
(7, 'Minimalist Graphics', 'Julia Schonlau', 'public/img/books/Minimalist.png', '', 6, 1),
(8, 'Hygge', 'Meik Wiking', 'public/img/books/Hygge.png', '', 25, 0),
(9, 'Innovation', 'Matt Ridley', 'public/img/books/Innovation.png', '', 7, 1),
(10, 'Psalms', 'Alabaster', 'public/img/books/Psalms.png', '', 8, 1),
(11, 'Thinking, Fast & Slow', 'Daniel Kahneman', 'public/img/books/Thinking.png', '', 9, 0),
(12, 'A Book Full Of Hope', 'Rupi Kaur', 'public/img/books/Book.png', '', 10, 1),
(13, 'The Subtle Art Of...', 'Mark Manson', 'public/img/books/Art.png', '', 11, 1),
(14, 'Narnia', 'C.S Lewis', 'public/img/books/Narnia.png', '', 12, 0),
(15, 'Company Of One', 'Paul Jarvis', 'public/img/books/Company.png', '', 13, 1),
(16, 'The Two Towers', 'J.R.R Tolkien', 'public/img/books/Towers.webp', '', 14, 1),
(17, 'Le chemin dans la forêt', 'S. Coppeland', 'public/img/books/Minimalist.png', 'Ce livre décrit le parcours dans la forêt du centre en nuit d\'automne', 25, 1),
(22, 'Coins to get', 'J. Stewart', 'public/img/books/Milwaukee.png', 'J\'ai récemment plongé dans les pages de \'Coins to get\' et j\'ai été enchanté. \r\n\r\nLes photographies magnifiques de ce livre captivent dès le départ, transportant le lecteur dans un voyage à travers le temps sur des monnaies captivantes. \r\n\r\nChaque page est une invitation à ralentir, à savourer et à créer des souvenirs durables avec les êtres chers. ', 25, 0);

-- --------------------------------------------------------

--
-- Structure de la table `messaging`
--

CREATE TABLE `messaging` (
  `id` int(11) NOT NULL,
  `id_sending_user` int(11) NOT NULL,
  `id_receiving_user` int(11) NOT NULL,
  `content` text NOT NULL,
  `date_creation` datetime NOT NULL,
  `consulted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messaging`
--

INSERT INTO `messaging` (`id`, `id_sending_user`, `id_receiving_user`, `content`, `date_creation`, `consulted`) VALUES
(1, 2, 25, 'Bonjour', '2024-03-31 11:45:37', 1),
(2, 25, 2, 'Bonjour Alex', '2024-03-31 11:46:47', 1),
(4, 2, 25, 'Des nouveaux livres ?', '2024-04-03 12:31:05', 1),
(6, 25, 2, 'Aucun pour le moment', '2024-04-03 12:46:32', 1),
(12, 2, 25, 'Dommage, j\'aime tes livres.', '2024-04-07 13:03:21', 1),
(13, 7, 25, 'Salut Orden', '2024-04-07 13:04:58', 0),
(14, 7, 25, 'Tu vas bien ?', '2024-04-07 13:06:28', 0),
(20, 13, 25, 'Bonjour Orden', '2024-04-10 10:14:46', 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `date_creation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `pseudo`, `password`, `mail`, `picture`, `date_creation`) VALUES
(1, 'CamilleClubLit', '$2y$10$.WLHESz8XrMH6qbpHreuU.18.4/oVCfEFlK49gJ0SlXFqtrx8Lini', 'camille@gmail.com', 'public/img/userpics/user1.png', '2024-02-22 10:18:05'),
(2, 'Alexlecture', '$2y$10$.NeD3CT1v8X.HJ2tlhHnDeM6ob5ilott9O5deLk8DlbumZ4XccBDy', 'alex.lecture@gmail.com', 'public/img/userpics/user2.png', '2024-02-22 10:19:57'),
(3, 'Hugo1990_12', '$2y$10$.WLHESz8XrMH6qbpHreuU.18.4/oVCfEFlK49gJ0SlXFqtrx8Lini', 'hugo@gmail.com', 'public/img/userpics/user2.png', '2024-02-22 10:20:42'),
(4, 'Juju1432', '$2y$10$.WLHESz8XrMH6qbpHreuU.18.4/oVCfEFlK49gJ0SlXFqtrx8Lini', 'juju@gmail.com', 'public/img/userpics/user1.png', '2024-02-22 10:21:38'),
(5, 'Christiane75014', '$2y$10$.WLHESz8XrMH6qbpHreuU.18.4/oVCfEFlK49gJ0SlXFqtrx8Lini', 'christiane@gmail.com', 'public/img/userpics/user2.png', '2024-02-22 10:22:11'),
(6, 'Hamzalecture', '$2y$10$.WLHESz8XrMH6qbpHreuU.18.4/oVCfEFlK49gJ0SlXFqtrx8Lini', 'hamza@gmail.com', 'public/img/userpics/user2.png', '2024-02-22 10:23:11'),
(7, 'Lou&Ben50', '$2y$10$.WLHESz8XrMH6qbpHreuU.18.4/oVCfEFlK49gJ0SlXFqtrx8Lini', 'louben@gmail.com', 'public/img/userpics/user1.png', '2024-02-22 10:24:24'),
(8, 'Lolobzh', '$2y$10$.WLHESz8XrMH6qbpHreuU.18.4/oVCfEFlK49gJ0SlXFqtrx8Lini', 'lolo@gmail.com', 'public/img/userpics/user2.png', '2024-02-22 10:30:59'),
(9, 'Sas634', '$2y$10$.WLHESz8XrMH6qbpHreuU.18.4/oVCfEFlK49gJ0SlXFqtrx8Lini', 'sas@gmail.com', 'public/img/userpics/user2.png', '2024-02-22 10:31:57'),
(10, 'ML95', '$2y$10$.WLHESz8XrMH6qbpHreuU.18.4/oVCfEFlK49gJ0SlXFqtrx8Lini', 'ml95@gmail.com', 'public/img/userpics/user1.png', '2024-02-22 10:32:20'),
(11, 'Verogo33', '$2y$10$.WLHESz8XrMH6qbpHreuU.18.4/oVCfEFlK49gJ0SlXFqtrx8Lini', 'verogo@gmail.com', 'public/img/userpics/user2.png', '2024-02-22 10:32:46'),
(12, 'AnnikaBrahms', '$2y$10$.WLHESz8XrMH6qbpHreuU.18.4/oVCfEFlK49gJ0SlXFqtrx8Lini', 'annika@gmail.com', 'public/img/userpics/user2.png', '2024-02-22 10:33:24'),
(13, 'Victoirefabr912', '$2y$10$.WLHESz8XrMH6qbpHreuU.18.4/oVCfEFlK49gJ0SlXFqtrx8Lini', 'victoire@gmail.com', 'public/img/userpics/user1.png', '2024-02-22 10:34:16'),
(14, 'Lotrfanclub67', '$2y$10$.WLHESz8XrMH6qbpHreuU.18.4/oVCfEFlK49gJ0SlXFqtrx8Lini', 'fanclub@gmail.com', 'public/img/userpics/user2.png', '2024-02-22 10:34:53'),
(25, 'Orden', '$2y$10$l1oogk0r7WBciymybEgzPezvm.gFM4oRJ4xAv60s2UH9QZyqfuqw.', 'orden@gmail.com', 'public/img/userpics/IMG_0522.jpeg', '2024-03-08 16:03:48'),
(34, 'Perubo', '$2y$10$f/ZcFTvyPd.wSBwRtGSX2uEFyJFhWeTi4ss1WAcg5ca92g.oEezO.', 'Perubo@actus.com', 'public/img/MaskGroup-4.pngpublic/img/userpics/user2.png', '2024-03-08 18:36:45');

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
-- Index pour la table `messaging`
--
ALTER TABLE `messaging`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_messaging_user` (`id_sending_user`),
  ADD KEY `fk_messaging_receiving_user` (`id_receiving_user`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `messaging`
--
ALTER TABLE `messaging`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `fk_book_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `messaging`
--
ALTER TABLE `messaging`
  ADD CONSTRAINT `fk_messaging_receiving_user` FOREIGN KEY (`id_receiving_user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `fk_messaging_sending_user` FOREIGN KEY (`id_sending_user`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
