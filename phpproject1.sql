-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 25 déc. 2024 à 22:38
-- Version du serveur : 5.7.33
-- Version de PHP : 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `phpproject1`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `poster` varchar(255) NOT NULL,
  `posting_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(255) DEFAULT 'Active',
  `modified_by_name` varchar(255) DEFAULT NULL,
  `modified_by_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `poster`, `posting_date`, `status`, `modified_by_name`, `modified_by_time`) VALUES
(1, 'Shoes', 'aaaa@gmail.com', '2024-11-18 12:31:25', 'Active', 'aaaa@gmail.com', '2024-12-11 18:25:44'),
(2, 'T-shirts', 'aaaa@gmail.com', '2024-11-18 12:31:52', 'Active', NULL, NULL),
(3, 'Hats', 'aaaa@gmail.com', '2024-11-18 17:00:01', 'Active', NULL, NULL),
(4, 'Testing', 'aaaa@gmail.com', '2024-12-25 22:20:32', 'Active', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `size` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `poster` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'pending',
  `posting_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id`, `product`, `size`, `color`, `poster`, `status`, `posting_date`, `quantity`) VALUES
(13, 26, '43', 'Grey', 'aaaa@gmail.com', 'Accepted', '2024-12-25 01:22:38', 4),
(14, 16, '42', 'Purple', 'aaaa@gmail.com', 'Accepted', '2024-12-25 01:23:59', 4),
(15, 25, '42', 'Purple', 'aaaa@gmail.com', 'confirmed', '2024-12-25 18:22:04', 8),
(16, 25, '42', 'Purple', 'aaaa@gmail.com', 'confirmed', '2024-12-25 18:22:21', 8),
(17, 15, '40', 'Orange', 'saifeddinebensalem22@gmail.com', 'confirmed', '2024-12-25 22:23:35', 4),
(18, 16, '42', 'White', 'saifeddinebensalem22@gmail.com', 'Accepted', '2024-12-25 22:23:50', 4),
(19, 15, '40', 'Orange', 'saifeddinebensalem22@gmail.com', 'Refused', '2024-12-25 22:29:16', 3);

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `posting_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `poster` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `promo` int(11) DEFAULT NULL,
  `sizes` varchar(255) DEFAULT NULL,
  `colors` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Active',
  `modified_by_name` varchar(255) DEFAULT NULL,
  `modified_by_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `posting_date`, `poster`, `photo`, `description`, `price`, `promo`, `sizes`, `colors`, `status`, `modified_by_name`, `modified_by_time`) VALUES
(15, 'U SPHERICA EC14 A', '1', '2024-12-25 00:58:57', 'aaaa@gmail.com', 'u-spherica-ec14-a.jpg', 'Mocassins pour homme Ã  la forme enveloppante et protectrice, les Sphericaâ„¢ EC14 se distinguent par leur lÃ©gÃ¨retÃ©, leur amorti et leur respirabilitÃ©.', 490, NULL, '36,38,40,42', 'Brown,Orange', 'Active', NULL, '2024-12-25 00:58:57'),
(16, 'U SPHERICA ECUB', '1', '2024-12-25 01:01:24', 'aaaa@gmail.com', 'u-spherica-ecub.jpg', 'Les Sphericaâ„¢ ECUB-3 sont des sneakers basses pour homme dÂ´inspiration running au design contemporain, rÃ©alisÃ©es en cuir nappa souple.', 530, 510, '42', 'White,Purple,Orange', 'Active', NULL, '2024-12-25 01:01:24'),
(17, 'U SPHERICA ECUB', '1', '2024-12-25 01:03:18', 'aaaa@gmail.com', 'u-spherica-ecub (1).jpg', 'Respirantes et ultra-amorties, les Sphericaâ„¢ ECUB-1 sont des bottines pour homme au look hybride remis au goÃ»t du jour, nouveau modÃ¨le incontournable de la garde-robe hivernale.', 520, 400, '44,45', 'Blue', 'Active', NULL, '2024-12-25 01:03:18'),
(18, 'U SPHERICA ACTIF D', '1', '2024-12-25 01:04:35', 'aaaa@gmail.com', 'u-spherica-actif-d.jpg', 'Les Sphericaâ„¢ Actif sont des sneakers basses pour homme respirantes et amorties, qui assurent un effet rebond renforcÃ©.', 490, 300, '40,42,44', 'Brown,Orange', 'Active', NULL, '2024-12-25 01:04:35'),
(19, 'U SPHERICA EC14 A', '1', '2024-12-25 01:05:55', 'aaaa@gmail.com', 'u-spherica-ec14-a (1).jpg', 'Mocassins pour homme Ã  la forme enveloppante et protectrice, les Sphericaâ„¢ EC14 se distinguent par leur lÃ©gÃ¨retÃ©, leur amorti et leur respirabilitÃ©.', 490, 400, '39,40,41,42,43', 'Black,White,Blue', 'Active', NULL, '2024-12-25 01:05:55'),
(20, 'Nike Dunk Low', '1', '2024-12-25 01:07:38', 'aaaa@gmail.com', 'W+DUNK+LOW+NEXT+NATURE.png', 'Chaussure pour femme', 119, 79, '36,37,38,39,40,41,42,43,44,45', 'Grey,Purple,Brown', 'Active', NULL, '2024-12-25 01:07:38'),
(21, 'Nike Dunk Low Premium', '1', '2024-12-25 01:10:00', 'aaaa@gmail.com', 'W+NIKE+DUNK+LOW+PRM.png', 'Chaussure pour femme', 200, 100, '39', 'White', 'Active', NULL, '2024-12-25 01:10:00'),
(22, 'Nike Court Vision Low Next Nature', '1', '2024-12-25 01:13:51', 'aaaa@gmail.com', 'W+NIKE+DUNK+LOW+PRM.png', 'Chaussure pour femme', 500, NULL, '40', 'Grey', 'Active', NULL, '2024-12-25 01:13:51'),
(23, 'Men\'s T-Shirt Regular-Fit Short-Sleeve Crewneck, Pack of 2', '2', '2024-12-25 01:18:46', 'aaaa@gmail.com', '71n6siUqEvL._AC_SX679_.jpg', 'For men.', 30, NULL, '41', 'Red,Purple', 'Active', NULL, '2024-12-25 01:18:46'),
(24, 'Gildan Men\'s Crew T-Shirts, Multipack, Style G1100', '2', '2024-12-25 01:19:40', 'aaaa@gmail.com', '61C-skMeafL._AC_SX679_.jpg', 'For men.', 45, 30, '42,43', 'White,Green,Brown,Orange', 'Active', NULL, '2024-12-25 01:19:40'),
(25, 'Russell Athletic Men\'s Dri-Power Cotton Blend Short Sleeve Tees, Moisture Wicking, Odor Protection, UPF 30+, Sizes S-4x', '2', '2024-12-25 01:20:34', 'aaaa@gmail.com', '71F4P1t80EL._AC_SX679_.jpg', 'For men.', 20, 19, '41,42', 'Purple,Orange', 'Active', NULL, '2024-12-25 01:20:34'),
(26, 'NPQQUAN Original Classic Low Profile Baseball Cap Golf Dad Hat Adjustable Cotton Hats Men Women Unconstructed Plain Cap', '3', '2024-12-25 01:21:37', 'aaaa@gmail.com', '61roI+2nIWL._AC_SX679_.jpg', 'For men.', 30, 19, '43', 'Grey', 'Active', NULL, '2024-12-25 01:21:37'),
(27, 'Carhartt Men\'s Canvas Mesh-Back Logo Graphic Cap', '3', '2024-12-25 01:22:06', 'aaaa@gmail.com', '614DzapddaL._AC_SX569_.jpg', 'For men.', 30, NULL, '43', 'Purple,Green', 'Active', NULL, '2024-12-25 01:22:06'),
(28, 'Testing', '4', '2024-12-25 22:21:17', 'aaaa@gmail.com', 'I_test.jpg', 'Testing', 200, NULL, '42,43,44', 'Blue', 'Active', NULL, '2024-12-25 22:21:17'),
(29, 'TEST', '4', '2024-12-25 22:21:54', 'aaaa@gmail.com', 'J_test.jpg', 'Test', 200, 100, '40', 'Grey', 'Active', NULL, '2024-12-25 22:21:54');

-- --------------------------------------------------------

--
-- Structure de la table `sponsors`
--

CREATE TABLE `sponsors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `poster` varchar(255) NOT NULL,
  `posting_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `modified_by_name` varchar(255) DEFAULT NULL,
  `modified_by_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `sponsors`
--

INSERT INTO `sponsors` (`id`, `name`, `photo`, `poster`, `posting_date`, `status`, `modified_by_name`, `modified_by_time`) VALUES
(1, 'BMW1', '3.png', 'default_poster', '2024-12-04 15:06:49', 'Active', NULL, NULL),
(2, 'Testing', '1.png', 'aaaa@gmail.com', '2024-12-04 15:08:01', 'Active', NULL, NULL),
(3, 'Ibiza', '4.png', 'aaaa@gmail.com', '2024-12-04 15:13:01', 'Active', NULL, NULL),
(4, 'saifeddine', '2188043.png', 'aaaa@gmail.com', '2024-12-11 16:47:01', 'Archived', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `gender` varchar(255) DEFAULT NULL,
  `security_question` varchar(255) DEFAULT NULL,
  `security_answer` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT 'client',
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `birthday`, `created_at`, `gender`, `security_question`, `security_answer`, `role`, `photo`) VALUES
(1, 'a', 'b', 'saifeddinebensalem2@gmail.com', 'a', '2024-11-05', '2024-11-15 23:51:10', 'on', NULL, NULL, 'client', NULL),
(3, 'a', 'd', 'a@gmail.com', 'aa', '2024-11-06', '2024-11-15 23:55:52', 'on', NULL, NULL, 'client', NULL),
(4, 'a', 'b', 'aaaa@gmail.com', '$2y$10$C7mLT07aD9nUSv0UCC974ej6OOTmEzZBvPSg/EFHb7HjQySX9avxa', '2024-10-30', '2024-11-16 17:42:44', 'Male', 'aaaa', 'bbbhhhhhhhhh', 'admin', '4_71F4P1t80EL._AC_SX679_.jpg'),
(5, 'geag', 'geaa', 'c@gmail.com', '111', '2024-11-21', '2024-11-19 21:07:42', 'on', 'aaa', 'bbb', 'client', NULL),
(6, 'a', 'gaga', 'mohamedlaabidi123123@gmail.com111', '111', '2024-11-05', '2024-11-19 21:08:39', 'on', 'DA', 'DAA', 'client', NULL),
(7, 'saifeddine', 'ben salem', 'saifeddinebensalem21@gmail.com', 'saifeddine', '2024-10-31', '2024-11-23 10:18:32', 'on', 'aaa', 'bbb', 'client', NULL),
(8, 'John', 'Doe', 'johndoe@example.com', 'password123', '1990-01-01', '2024-12-06 21:44:33', 'Male', 'What is your petâ€™s name?', 'Fluffy', 'client', NULL),
(9, 'gea', 'gea', 'feaga@gea.ga', 'ga', '2024-11-05', '2024-12-06 21:46:24', 'on', 'gea', 'gea', 'client', NULL),
(11, 'fgez', 'kgeak', 'gea@gmail.comGA', 'KGEA', '2024-12-04', '2024-12-06 21:47:30', 'on', 'KEGA', 'KGEA', 'client', NULL),
(12, 'geaji', 'geijai', 'gaega@gealgae.KGEAJHJ', '$2y$10$pQXIFi81psewWlpZLJeymuMjWs7bBhkW2AaE/0nLQmqkDbMFm0qMK', '2024-12-04', '2024-12-06 22:28:44', 'on', 'gaega@gealgae.KGEAJHJ', 'gaega@gealgae.KGEAJHJ', 'client', NULL),
(14, 'saifeddine', 'Ben Salem', 'saifeddinebensalem22@gmail.com', '$2y$10$oacRkJ5uRqrwC5S/aPFUD.IN/8q5CcUYxZQALDplRfuPyz1F7.N9O', '2001-11-03', '2024-12-25 22:08:27', 'on', 'Testing', 'Testing', 'client', '14_61C-skMeafL._AC_SX679_.jpg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sponsors`
--
ALTER TABLE `sponsors`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `sponsors`
--
ALTER TABLE `sponsors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
