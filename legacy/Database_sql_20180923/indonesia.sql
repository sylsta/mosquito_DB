-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 24 Wrz 2018, 20:04
-- Wersja serwera: 5.5.21-log
-- Wersja PHP: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `iwaw_plfeglwaw`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ind_batches`
--

CREATE TABLE IF NOT EXISTS `ind_batches` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `batch_code` varchar(150) NOT NULL,
  `id_observation` int(10) NOT NULL,
  `type_age` varchar(50) NOT NULL,
  `type_loc` varchar(50) NOT NULL,
  `type_con` varchar(50) NOT NULL,
  `mosquitoes_count_end` varchar(5) NOT NULL,
  `session` varchar(50) NOT NULL,
  `mosquitoes_count_start` varchar(5) NOT NULL,
  `close` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `batch_code` (`batch_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=17 ;

--
-- Zrzut danych tabeli `ind_batches`
--

INSERT INTO `ind_batches` (`id`, `batch_code`, `id_observation`, `type_age`, `type_loc`, `type_con`, `mosquitoes_count_end`, `session`, `mosquitoes_count_start`, `close`) VALUES
(1, 'INMTM001_O2_B1', 2, 'larvae', 'outside', '2', '5', '1dded898896e148249ce7160271166f5', '4', 1),
(2, 'INMTM001_O2_B2', 2, 'larvae', 'inside', '1', '', '1dded898896e148249ce7160271166f5', '3', 0),
(3, 'INMTM001_O2_B3', 2, 'larvae', 'inside', '2', '', '1dded898896e148249ce7160271166f5', '3', 0),
(4, 'INMTM001_O2_B4', 2, 'larvae', 'inside', '2', '', '1dded898896e148249ce7160271166f5', '3', 0),
(5, 'INMTM001_O2_B5', 2, 'adult', 'inside', 'undefined', '', '1dded898896e148249ce7160271166f5', '3', 0),
(6, 'INMTM001_O4_B1', 4, 'larvae', 'inside', '2', '', '2df9f2f006e0a97f45629cebd7978b8d', '12', 0),
(7, 'INMTM001_O4_B2', 4, 'adult', 'inside', 'undefined', '', '2df9f2f006e0a97f45629cebd7978b8d', '3', 0),
(8, 'INMTM001_O4_B4', 4, 'adult', 'inside', 'undefined', '', '2df9f2f006e0a97f45629cebd7978b8d', '3', 0),
(9, 'INMTM001_O4_B5', 4, 'larvae', 'outside', '2', '', '2df9f2f006e0a97f45629cebd7978b8d', '2', 0),
(10, 'INMTM001_O4_B6', 4, 'adult', 'outside', 'undefined', '', '2df9f2f006e0a97f45629cebd7978b8d', '3', 0),
(11, 'INMTM001_O4_B7', 4, 'larvae', 'outside', '2', '', '2df9f2f006e0a97f45629cebd7978b8d', '3', 0),
(12, 'INMTM001_O4_B8', 4, 'larvae', 'outside', '1', '', '2df9f2f006e0a97f45629cebd7978b8d', '2', 0),
(13, 'INMTM001_O4_B9', 4, 'larvae', 'inside', '2', '', '2df9f2f006e0a97f45629cebd7978b8d', '3', 0),
(14, 'INMTM001_O4_B10', 4, 'larvae', 'outside', '1', '', '2df9f2f006e0a97f45629cebd7978b8d', '3', 0),
(15, '123456_O6_B2', 6, 'adult', 'inside', 'undefined', '', 'a9fb11ba55ff690a584024f454d1b212', '22', 0),
(16, '123456_O6_B3', 6, 'larvae', 'inside', '2', '', 'a9fb11ba55ff690a584024f454d1b212', '1', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ind_containers`
--

CREATE TABLE IF NOT EXISTS `ind_containers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `container_type_id` int(5) NOT NULL,
  `id_observations` int(10) NOT NULL,
  `container_count` int(5) NOT NULL,
  `container_infected` int(5) NOT NULL,
  `type_loc` varchar(50) NOT NULL,
  `session` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=17 ;

--
-- Zrzut danych tabeli `ind_containers`
--

INSERT INTO `ind_containers` (`id`, `container_type_id`, `id_observations`, `container_count`, `container_infected`, `type_loc`, `session`) VALUES
(1, 2, 2, 4, 1, 'outside', '1dded898896e148249ce7160271166f5'),
(2, 1, 2, 0, 0, 'outside', '1dded898896e148249ce7160271166f5'),
(3, 2, 2, 2, 1, 'inside', '1dded898896e148249ce7160271166f5'),
(4, 1, 2, 2, 2, 'inside', '1dded898896e148249ce7160271166f5'),
(5, 2, 4, 3, 1, 'outside', '2df9f2f006e0a97f45629cebd7978b8d'),
(6, 1, 4, 3, 3, 'outside', '2df9f2f006e0a97f45629cebd7978b8d'),
(7, 2, 4, 4, 2, 'inside', '2df9f2f006e0a97f45629cebd7978b8d'),
(8, 1, 4, 1, 0, 'inside', '2df9f2f006e0a97f45629cebd7978b8d'),
(9, 2, 5, 3, 3, 'outside', '4b69182bcbe9700f4fa0ca53dbb066e3'),
(10, 1, 5, 3, 3, 'outside', '4b69182bcbe9700f4fa0ca53dbb066e3'),
(11, 2, 5, 3, 3, 'inside', '4b69182bcbe9700f4fa0ca53dbb066e3'),
(12, 1, 5, 3, 3, 'inside', '4b69182bcbe9700f4fa0ca53dbb066e3'),
(13, 2, 6, 0, 0, 'outside', 'a9fb11ba55ff690a584024f454d1b212'),
(14, 1, 6, 0, 0, 'outside', 'a9fb11ba55ff690a584024f454d1b212'),
(15, 2, 6, 1, 1, 'inside', 'a9fb11ba55ff690a584024f454d1b212'),
(16, 1, 6, 0, 0, 'inside', 'a9fb11ba55ff690a584024f454d1b212');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ind_containers_type`
--

CREATE TABLE IF NOT EXISTS `ind_containers_type` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `container_type` varchar(500) NOT NULL,
  `description` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `ind_containers_type`
--

INSERT INTO `ind_containers_type` (`id`, `container_type`, `description`) VALUES
(1, 'Pudełko', ''),
(2, 'Nocnik', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ind_genus`
--

CREATE TABLE IF NOT EXISTS `ind_genus` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `genus_name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=2 ;

--
-- Zrzut danych tabeli `ind_genus`
--

INSERT INTO `ind_genus` (`id`, `genus_name`) VALUES
(1, 'Jarnellius');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ind_logi`
--

CREATE TABLE IF NOT EXISTS `ind_logi` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `date` varchar(50) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `pole` varchar(1000) NOT NULL,
  `wartosc` varchar(1000) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=105 ;

--
-- Zrzut danych tabeli `ind_logi`
--

INSERT INTO `ind_logi` (`id`, `date`, `ip`, `pole`, `wartosc`, `status`) VALUES
(1, '2017-02-07 23:55:43', '212.87.13.78', 'b88614a0a43a3ab6384c1c2ecc4653c1', 'POINT code INMTM001 is correct', 'logowanie'),
(2, '2017-02-07 23:56:04', '212.87.13.78', 'b88614a0a43a3ab6384c1c2ecc4653c1', '1', 'dodanie_punktu'),
(3, '2017-02-08 00:05:26', '212.87.13.78', 'b88614a0a43a3ab6384c1c2ecc4653c1', '', 'anulowanie'),
(4, '2017-05-12 19:25:38', '94.254.227.218', '1dded898896e148249ce7160271166f5', 'POINT code INMTM001 is correct', 'logowanie'),
(5, '2017-05-12 19:35:37', '94.254.227.218', '1dded898896e148249ce7160271166f5', '1', 'dodanie_punktu'),
(6, '2017-05-12 19:48:22', '94.254.227.218', '1dded898896e148249ce7160271166f5', '', 'dodano_kontenery'),
(7, '2017-05-12 19:53:27', '94.254.227.218', '1dded898896e148249ce7160271166f5', '', 'dodano_komary'),
(8, '2017-05-12 19:53:32', '94.254.227.218', '1dded898896e148249ce7160271166f5', '', 'zakonczenie'),
(9, '2017-05-12 19:55:37', '94.254.227.218', 'ca0f97fef03518b519252abac3785309', 'Batch are not valid', 'logowanie'),
(10, '2017-05-12 19:56:29', '94.254.227.218', '3d39bba4eba8ab901b0389ff3cc65bdd', 'Admin is correct', 'logowanie'),
(11, '2017-05-12 19:59:25', '94.254.227.218', '3d39bba4eba8ab901b0389ff3cc65bdd', '', 'anulowanie'),
(12, '2017-05-12 19:59:35', '94.254.227.218', '6d2f942c33c4633c612bbe2786c112ff', 'BATCH code INMTM001_O2_B1 is correct', 'logowanie'),
(13, '2017-05-12 20:03:22', '94.254.227.218', '6d2f942c33c4633c612bbe2786c112ff', '', 'batch_dodano_komary'),
(14, '2017-05-12 20:04:53', '94.254.227.218', 'e901b91b1c7371389658ef88eaa32e77', 'Mosquito are not valid', 'logowanie'),
(15, '2017-05-12 20:05:08', '94.254.227.218', '382f05ad65f185f7147f8485378ab3d9', 'User data are not valid', 'logowanie'),
(16, '2017-05-12 20:05:30', '94.254.227.218', '96c7113336a5a1b15b54e7138fd03eec', 'Mosquito are not valid', 'logowanie'),
(17, '2017-05-12 20:05:56', '94.254.227.218', 'bed9b5b0b98268ffd038fb22b3d1fc2c', 'Mosquito are not valid', 'logowanie'),
(18, '2017-05-12 20:06:23', '94.254.227.218', 'f427ffb7d2a1fc8e616c15b964846689', 'Mosquito are not valid', 'logowanie'),
(19, '2017-05-12 20:11:13', '94.254.227.218', '500166a4e5a77f1f5150c4aa8fd04cd9', 'MOSQUITO code INMTM001_O2_B1_MLA4 is correct', 'logowanie'),
(20, '', '94.254.227.218', '500166a4e5a77f1f5150c4aa8fd04cd9', '', 'batch_dodano_wirusy'),
(21, '', '94.254.227.218', '500166a4e5a77f1f5150c4aa8fd04cd9', '', 'batch_opisano_wirusy'),
(22, '2017-05-12 20:12:30', '94.254.227.218', '500166a4e5a77f1f5150c4aa8fd04cd9', '', 'zakonczenie'),
(23, '2017-05-12 20:12:48', '94.254.227.218', '07c96ce41bc6408101b5761d095177d7', 'Admin is correct', 'logowanie'),
(24, '2017-05-24 14:01:56', '49.128.176.131', 'ccf157fb10319ab9f30cc78a8b0278dd', 'No data', 'logowanie'),
(25, '2017-06-01 12:37:49', '212.87.13.78', '336e07a48753b447be3daccf1799bb02', 'POINT code  is correct', 'logowanie'),
(26, '2017-06-01 12:37:59', '212.87.13.78', '6ef44b0a8821ba4035b1c1b77407aeed', 'POINT code INMTM001 is correct', 'logowanie'),
(27, '2017-06-06 15:54:58', '89.157.220.147', '1409c4944d8699f635bdf9e9111b90cf', 'No data', 'logowanie'),
(28, '2017-09-04 13:13:39', '212.87.13.78', '292c9c1d6736780647272936ce93fdec', 'POINT code INMTM001 is correct', 'logowanie'),
(29, '2017-09-08 05:35:18', '36.75.168.120', '2a23b0e74c032a57061751a00bfee202', 'User data are not valid', 'logowanie'),
(30, '2017-09-08 05:39:21', '36.75.168.120', 'cd076c0f5b79f68af091f88444417439', 'No data', 'logowanie'),
(31, '2017-09-08 05:39:38', '36.75.168.120', 'ffad21d5086e95baf7a3459861f2100c', 'No data', 'logowanie'),
(32, '2017-09-08 05:43:38', '36.75.168.120', '409c8de8577ba668182d149b0d4127a1', 'User data are not valid', 'logowanie'),
(33, '2017-09-08 05:44:51', '36.75.168.120', 'b48a6b21b612b983328a1e9747cbace6', 'No data', 'logowanie'),
(34, '2017-09-08 05:45:02', '36.75.168.120', 'c20f25e80987130802cefd0bd9bf7ecf', 'User data are not valid', 'logowanie'),
(35, '2017-09-08 05:54:29', '36.75.168.120', '2794265b5d30b89e27b3760777ff8d52', 'User data are not valid', 'logowanie'),
(36, '2017-09-08 05:54:56', '36.75.168.120', '1ae71fbd75980dcab424dbf9179c096c', 'User data are not valid', 'logowanie'),
(37, '2017-09-08 05:55:04', '36.75.168.120', '925473d38300ff991d7dbc472d01adec', 'Role or point are not valid', 'logowanie'),
(38, '2017-09-08 05:57:32', '36.75.168.120', '56e233ad666ca727fb60cf3ba40d73f2', 'No data', 'logowanie'),
(39, '2017-09-08 11:35:52', '36.75.168.120', '03e929a0f10c55f1b42068765ccff658', 'Role or point are not valid', 'logowanie'),
(40, '2017-09-08 11:36:03', '36.75.168.120', '37bd689bc0f914e10db4a56df6d01457', 'No data', 'logowanie'),
(41, '2017-09-08 11:51:09', '94.254.164.83', '0674987e467ffff9f707cfc113709149', 'Admin is correct', 'logowanie'),
(42, '2017-09-08 11:51:25', '36.75.168.120', '286be5029e8afe84b7c3712409a17a1f', 'Admin is correct', 'logowanie'),
(43, '2017-09-08 11:51:59', '94.254.164.83', 'a72d16979e0fadeee1e4bbb2adae9702', 'Admin is correct', 'logowanie'),
(44, '2017-09-08 11:52:08', '94.254.164.83', 'a72d16979e0fadeee1e4bbb2adae9702', '', 'anulowanie'),
(45, '2017-09-08 11:54:04', '36.75.168.120', 'ec371bf3a332c4034de7cc0a58e77037', 'POINT code  is correct', 'logowanie'),
(46, '2017-09-13 17:41:41', '43.252.159.209', 'bec133648ec6b51f15700bec176ffb79', 'Admin is correct', 'logowanie'),
(47, '2017-09-18 18:22:32', '36.67.95.95', '6ec27b62f20915aae6e231028a62af4f', 'Admin is correct', 'logowanie'),
(48, '2017-09-19 02:11:31', '114.125.151.246', 'e58b058e8a84f6b05bb1d2d1dd4fc914', 'Admin is correct', 'logowanie'),
(49, '2017-09-19 06:31:51', '114.125.151.224', '36a3b8634ee733fecc3b61d004ed7a5a', 'Admin is correct', 'logowanie'),
(50, '2017-09-30 17:45:32', '37.47.16.84', '4fc5ee353fa5984ffb058993161e3f06', 'Role or point are not valid', 'logowanie'),
(51, '2017-09-30 17:45:48', '37.47.16.84', '4f6581722a81b04f8f13d1d17976f3a9', 'Admin is correct', 'logowanie'),
(52, '2017-09-30 17:47:54', '37.47.16.84', '4f6581722a81b04f8f13d1d17976f3a9', '', 'anulowanie'),
(53, '2017-09-30 17:49:25', '37.47.16.84', 'dabc0b211e65e62432d9b2e956f11371', 'Admin is correct', 'logowanie'),
(54, '2017-09-30 17:49:49', '37.47.16.84', '6b79ff8c8957ea8244b3a8ff24920a60', 'POINT code  is correct', 'logowanie'),
(55, '2017-09-30 17:50:32', '37.47.16.84', 'b3ab7beb8f25ffc7a50c9ff5bba674a8', 'POINT code  is correct', 'logowanie'),
(56, '2017-09-30 17:50:53', '37.47.16.84', '71b1e4993b731368a6a4cab916f5e90d', 'POINT code  is correct', 'logowanie'),
(57, '2017-09-30 18:03:06', '37.47.16.84', '2714e3d208f5683e90e27bbd50aab73a', 'POINT code  is correct', 'logowanie'),
(58, '2017-09-30 18:09:14', '37.47.16.84', '644aeaa7c79f431239a1188d28367b16', 'POINT code INMTM001 is correct', 'logowanie'),
(59, '2017-09-30 18:14:48', '37.47.16.84', '644aeaa7c79f431239a1188d28367b16', '1', 'dodanie_punktu'),
(60, '2017-09-30 18:15:14', '37.47.16.84', '2df9f2f006e0a97f45629cebd7978b8d', 'POINT code INMTM001 is correct', 'logowanie'),
(61, '2017-09-30 18:16:11', '37.47.16.84', '2df9f2f006e0a97f45629cebd7978b8d', '1', 'dodanie_punktu'),
(62, '2017-09-30 18:17:09', '37.47.16.84', '2df9f2f006e0a97f45629cebd7978b8d', '', 'dodano_kontenery'),
(63, '2017-09-30 18:23:26', '37.47.16.84', '2df9f2f006e0a97f45629cebd7978b8d', '', 'dodano_komary'),
(64, '2017-09-30 18:23:42', '37.47.16.84', '2df9f2f006e0a97f45629cebd7978b8d', '', 'zakonczenie'),
(65, '2017-09-30 18:24:24', '37.47.16.84', '21cb8c1e39a8b310c9fdd9f81708e527', 'Batch are not valid', 'logowanie'),
(66, '2017-09-30 18:24:50', '37.47.16.84', 'ae6ca1e528d72794f05e61f9d23dced4', 'Role or point are not valid', 'logowanie'),
(67, '2017-09-30 18:26:31', '37.47.16.84', '4009bf455a4928138b44e851e3491f45', 'Batch are not valid', 'logowanie'),
(68, '2017-09-30 18:27:27', '37.47.16.84', 'be541da16ed68afd05351a0f73dfd555', 'Batch are not valid', 'logowanie'),
(69, '2017-09-30 18:27:51', '37.47.16.84', '1fe3f6c34427d62f7cfd8d32a8d64f99', 'Batch are not valid', 'logowanie'),
(70, '2017-09-30 18:28:15', '37.47.16.84', 'cd4359de98f3cfd1d610380df63a72cb', 'Batch are not valid', 'logowanie'),
(71, '2017-09-30 18:29:28', '37.47.16.84', '1c4f30290cb66e888334c5a604b49e1b', 'Batch are not valid', 'logowanie'),
(72, '2018-03-04 21:32:37', '212.87.13.77', 'b3fa9f75143f9a489aedc2e51c690b59', 'POINT code  is correct', 'logowanie'),
(73, '2018-03-04 21:33:27', '212.87.13.77', '9d788fc281f1da57bac9101776c9cd54', 'POINT code  is correct', 'logowanie'),
(74, '2018-03-04 21:33:33', '212.87.13.77', '04baca9e83f2ef7204882889389abb06', 'POINT code  is correct', 'logowanie'),
(75, '2018-03-04 21:33:44', '212.87.13.77', '05bec6a9c6817418182920022fb4dc6d', 'POINT code  is correct', 'logowanie'),
(76, '2018-03-04 21:38:03', '212.87.13.77', 'be80283f4880cd02205080827328ab8d', 'POINT code  is correct', 'logowanie'),
(77, '2018-03-04 21:38:21', '212.87.13.77', 'e06fd27f0f405d42117e64f737854251', 'POINT code  is correct', 'logowanie'),
(78, '2018-03-04 21:39:28', '212.87.13.77', 'ee0542c15799466c2bcc498cd90f3ad9', 'POINT code  is correct', 'logowanie'),
(79, '2018-03-04 21:40:19', '212.87.13.77', '5310a73d86cec346edb807279e3d887c', 'POINT code  is correct', 'logowanie'),
(80, '2018-03-04 21:40:51', '212.87.13.77', '70f9465ae1ed45035f81d98027d087ee', 'POINT code  is correct', 'logowanie'),
(81, '2018-03-04 21:51:27', '212.87.13.77', 'eeb26020b7063d74cd459d2f18142b9f', 'POINT code  is correct', 'logowanie'),
(82, '2018-03-04 21:52:13', '212.87.13.77', 'c2730c13a914abc1bf30d9322faf5a4e', 'POINT code  is correct', 'logowanie'),
(83, '2018-03-04 21:52:47', '212.87.13.77', '4b69182bcbe9700f4fa0ca53dbb066e3', 'POINT code 123456 is correct', 'logowanie'),
(84, '2018-03-04 21:53:49', '212.87.13.77', '4b69182bcbe9700f4fa0ca53dbb066e3', '2', 'dodanie_punktu'),
(85, '2018-03-04 21:54:03', '212.87.13.77', '4b69182bcbe9700f4fa0ca53dbb066e3', '', 'dodano_kontenery'),
(86, '2018-03-04 21:55:39', '212.87.13.77', '4b69182bcbe9700f4fa0ca53dbb066e3', '', 'anulowanie'),
(87, '2018-03-04 21:56:17', '212.87.13.77', 'a9fb11ba55ff690a584024f454d1b212', 'POINT code 123456 is correct', 'logowanie'),
(88, '2018-03-04 21:56:38', '212.87.13.77', 'a9fb11ba55ff690a584024f454d1b212', '2', 'dodanie_punktu'),
(89, '2018-03-04 21:57:16', '212.87.13.77', 'a9fb11ba55ff690a584024f454d1b212', '', 'dodano_kontenery'),
(90, '2018-03-04 21:57:53', '212.87.13.77', 'a9fb11ba55ff690a584024f454d1b212', '', 'dodano_komary'),
(91, '2018-03-04 22:04:06', '212.87.13.77', 'a9fb11ba55ff690a584024f454d1b212', '', 'dodano_komary'),
(92, '2018-03-04 22:04:57', '212.87.13.77', 'a9fb11ba55ff690a584024f454d1b212', '', 'dodano_komary'),
(93, '2018-03-04 22:05:23', '212.87.13.77', 'a9fb11ba55ff690a584024f454d1b212', '', 'dodano_komary'),
(94, '2018-03-04 22:05:46', '212.87.13.77', 'a9fb11ba55ff690a584024f454d1b212', '', 'dodano_komary'),
(95, '2018-03-04 22:07:21', '212.87.13.77', 'a9fb11ba55ff690a584024f454d1b212', '', 'dodano_komary'),
(96, '2018-03-04 22:08:00', '212.87.13.77', 'a9fb11ba55ff690a584024f454d1b212', '', 'dodano_komary'),
(97, '2018-03-04 22:08:28', '212.87.13.77', 'a9fb11ba55ff690a584024f454d1b212', '', 'dodano_komary'),
(98, '2018-03-04 22:08:48', '212.87.13.77', 'a9fb11ba55ff690a584024f454d1b212', '', 'dodano_komary'),
(99, '2018-03-04 22:09:09', '212.87.13.77', 'a9fb11ba55ff690a584024f454d1b212', '', 'zakonczenie'),
(100, '2018-03-04 22:09:15', '212.87.13.77', '2447f26868a099962647179a83b47de6', 'BATCH code 123456_O6_B2 is correct', 'logowanie'),
(101, '2018-03-04 22:35:22', '212.87.13.77', '5ceaccde98e686bafb54ab7cb5a87fb3', 'POINT code 123456 is correct', 'logowanie'),
(102, '2018-03-04 23:01:50', '212.87.13.77', 'bd8f22d6c6df8b3e0f2d1cec8bfd4121', 'POINT code 123456 is correct', 'logowanie'),
(103, '2018-03-04 23:02:21', '212.87.13.77', '6e0637bd3f0726ac9cab25522d493f6b', 'POINT code 123456 is correct', 'logowanie'),
(104, '2018-03-29 13:16:59', '212.87.13.77', '49f5da8de04770f85f0b68ee2379937e', 'POINT code 123456 is correct', 'logowanie');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ind_mosquitoes`
--

CREATE TABLE IF NOT EXISTS `ind_mosquitoes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `mosquitoes_code` varchar(150) NOT NULL,
  `id_batch` int(10) NOT NULL,
  `genus` mediumtext NOT NULL,
  `species` mediumtext NOT NULL,
  `genotype` mediumtext NOT NULL,
  `mosquitoes_sequence` mediumtext NOT NULL,
  `sex` varchar(50) NOT NULL,
  `infected` varchar(50) NOT NULL,
  `session` varchar(50) NOT NULL,
  `researcher` varchar(50) NOT NULL,
  `error` text NOT NULL,
  `close` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mosquitoes_code` (`mosquitoes_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=5 ;

--
-- Zrzut danych tabeli `ind_mosquitoes`
--

INSERT INTO `ind_mosquitoes` (`id`, `date`, `mosquitoes_code`, `id_batch`, `genus`, `species`, `genotype`, `mosquitoes_sequence`, `sex`, `infected`, `session`, `researcher`, `error`, `close`) VALUES
(1, '2017-05-12 20:03:22', 'INMTM001_O2_B1_Mla1', 1, 'Jarnellius', 'Lewnielsenius', 'hhj', 'hhjhj', '', 'no infected', '6d2f942c33c4633c612bbe2786c112ff', '1', '', 1),
(2, '2017-05-12 20:03:22', 'INMTM001_O2_B1_Mla2', 1, 'Jarnellius', 'Jarnellius', 'jj', 'hh', '', 'infected', '6d2f942c33c4633c612bbe2786c112ff', '1', '', 1),
(3, '2017-05-12 20:03:22', 'INMTM001_O2_B1_Mla3', 1, '', '', '', '', '', '', '6d2f942c33c4633c612bbe2786c112ff', '1', '', 1),
(4, '2017-05-12 20:03:22', 'INMTM001_O2_B1_Mla4', 1, 'Jarnellius', 'Jarnellius', 'huhu', 'jjhj', '', 'infected', '6d2f942c33c4633c612bbe2786c112ff', '1', '', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ind_observations`
--

CREATE TABLE IF NOT EXISTS `ind_observations` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `id_points` int(11) NOT NULL,
  `researcher` int(5) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `temperature` varchar(10) NOT NULL,
  `humidity` varchar(10) NOT NULL,
  `backyard` int(1) NOT NULL,
  `backyard_garden` int(1) NOT NULL,
  `backyard_trees` int(1) NOT NULL,
  `backyard_plants` int(1) NOT NULL,
  `backyard_animals` int(1) NOT NULL,
  `people` int(2) NOT NULL,
  `animals_inside` int(3) NOT NULL,
  `animals_outside` int(3) NOT NULL,
  `session` varchar(100) NOT NULL,
  `containers` int(1) NOT NULL,
  `mosquitoes` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=7 ;

--
-- Zrzut danych tabeli `ind_observations`
--

INSERT INTO `ind_observations` (`id`, `date_start`, `date_end`, `id_points`, `researcher`, `address`, `temperature`, `humidity`, `backyard`, `backyard_garden`, `backyard_trees`, `backyard_plants`, `backyard_animals`, `people`, `animals_inside`, `animals_outside`, `session`, `containers`, `mosquitoes`) VALUES
(1, '2017-02-07 23:55:43', '0000-00-00 00:00:00', 1, 1, 'gg', '33', '3', 0, 0, 0, 0, 0, 3, 3, 3, 'b88614a0a43a3ab6384c1c2ecc4653c1', 1, 1),
(2, '2017-05-12 19:25:38', '2017-05-12 19:53:27', 1, 1, 'gdf', '22', '22', 0, 0, 0, 0, 0, 242, 242, 424, '1dded898896e148249ce7160271166f5', 1, 1),
(3, '2017-09-30 18:09:14', '0000-00-00 00:00:00', 1, 2, 'Aritoga', '30', '78', 1, 1, 1, 1, 1, 4, 3, 3, '644aeaa7c79f431239a1188d28367b16', 1, 1),
(4, '2017-09-30 18:15:14', '2017-09-30 18:23:26', 1, 2, 'sfiVAB', '30', '78', 1, 0, 0, 0, 0, 3, 2, 4, '2df9f2f006e0a97f45629cebd7978b8d', 1, 1),
(5, '2018-03-04 21:52:47', '0000-00-00 00:00:00', 2, 1, 'dd', '3', '3', 0, 0, 0, 0, 0, 3, 3, 3, '4b69182bcbe9700f4fa0ca53dbb066e3', 1, 1),
(6, '2018-03-04 21:56:17', '2018-03-04 22:08:48', 2, 1, 'fdsf', '22', '222', 0, 0, 0, 0, 0, 22, 2, 2, 'a9fb11ba55ff690a584024f454d1b212', 1, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ind_points`
--

CREATE TABLE IF NOT EXISTS `ind_points` (
  `disabled` int(1) NOT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `x` double(10,6) NOT NULL,
  `y` double(10,6) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `verify_code` varchar(20) NOT NULL,
  `area_code` varchar(200) NOT NULL,
  `level1` varchar(200) NOT NULL,
  `level2` varchar(200) NOT NULL,
  `level3` varchar(200) NOT NULL,
  `level4` varchar(200) NOT NULL,
  `city` varchar(200) NOT NULL,
  `country` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `ind_points`
--

INSERT INTO `ind_points` (`disabled`, `id`, `x`, `y`, `name`, `verify_code`, `area_code`, `level1`, `level2`, `level3`, `level4`, `city`, `country`) VALUES
(0, 1, 21.015811, 52.170483, 'Alvin Risky Ramadani', 'INMTM001', 'RT 17/ RW 03', 'Balinis', 'Ricet', 'Gomong', 'Lombok', 'Mataram', 'Indonesia'),
(0, 2, 21.015811, 52.170483, 'Alvin Risky Ramadani', '123456', 'RT 17/ RW 03', 'Balinis', 'Ricet', 'Gomong', 'Lombok', 'Mataram', 'Indonesia');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ind_species`
--

CREATE TABLE IF NOT EXISTS `ind_species` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `species_name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `ind_species`
--

INSERT INTO `ind_species` (`id`, `species_name`) VALUES
(1, 'Jarnellius'),
(2, 'Lewnielsenius');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ind_users`
--

CREATE TABLE IF NOT EXISTS `ind_users` (
  `disabled` int(1) NOT NULL,
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `verify_user` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `role` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `verify_user` (`verify_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `ind_users`
--

INSERT INTO `ind_users` (`disabled`, `id`, `verify_user`, `name`, `surname`, `email`, `role`) VALUES
(0, 1, 'bzz', 'Bartłomiej', 'Iwańczak', 'b.iwanczak@uw.edu.pl', ',99,1,2,3,4,'),
(0, 2, 'akf', 'Aneta', 'Afelt', 'afelt.aneta@gmail.com', ',99,1,2,3,4,');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ind_viruses`
--

CREATE TABLE IF NOT EXISTS `ind_viruses` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `virus_code` varchar(150) NOT NULL,
  `id_mosquitoes` int(10) NOT NULL,
  `type` int(5) NOT NULL,
  `gene` mediumtext NOT NULL,
  `full_lenght` int(1) NOT NULL,
  `haplotype` text NOT NULL,
  `virus_sequence` varchar(500) NOT NULL,
  `id_batch` varchar(50) NOT NULL,
  `session` varchar(50) NOT NULL,
  `researcher` int(5) NOT NULL,
  `close` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `ind_viruses`
--

INSERT INTO `ind_viruses` (`id`, `virus_code`, `id_mosquitoes`, `type`, `gene`, `full_lenght`, `haplotype`, `virus_sequence`, `id_batch`, `session`, `researcher`, `close`) VALUES
(1, 'INMTM001_O2_B1_Mla4_1', 4, 1, 'jjhj', 1, '', 'hhghghh', '', '500166a4e5a77f1f5150c4aa8fd04cd9', 1, 0),
(2, 'INMTM001_O2_B1_Mla4_2', 4, 4, 'etet', 1, '', '35', '', '500166a4e5a77f1f5150c4aa8fd04cd9', 1, 0),
(3, 'INMTM001_O2_B1_Mla4_3', 4, 5, 'eter', 1, '', '3535', '', '500166a4e5a77f1f5150c4aa8fd04cd9', 1, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ind_viruses_type`
--

CREATE TABLE IF NOT EXISTS `ind_viruses_type` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `virus` varchar(50) NOT NULL,
  `haplotype` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=7 ;

--
-- Zrzut danych tabeli `ind_viruses_type`
--

INSERT INTO `ind_viruses_type` (`id`, `name`, `virus`, `haplotype`) VALUES
(1, 'Dengue D1', 'DENV1', 'D1_LLNNN'),
(2, 'Dengue D2', 'DENV2', 'D2_LLNNN'),
(3, 'Dengue D3', 'DENV3', 'D3_LLNNN'),
(4, 'Dengue D4', 'DENV4', 'D4_LLNNN'),
(5, 'Zika', 'ZIKV', 'Zk_LLNNN'),
(6, 'Chikungunya', 'CHIKV', 'Ck_LLNNN');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
