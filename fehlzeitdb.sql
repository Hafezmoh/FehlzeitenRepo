-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 08. Nov 2022 um 14:52
-- Server-Version: 10.4.19-MariaDB
-- PHP-Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `fehlzeitdb`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_grund`
--

CREATE TABLE `tbl_grund` (
  `gr_id` int(4) NOT NULL,
  `u_id` int(4) NOT NULL,
  `autor_id` int(4) NOT NULL,
  `grund` int(4) NOT NULL,
  `note` text NOT NULL,
  `von_datum` datetime NOT NULL,
  `bis_datum` datetime NOT NULL,
  `reg_datum` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(4) NOT NULL,
  `vorname` varchar(255) NOT NULL,
  `nachname` varchar(255) NOT NULL,
  `b_name` varchar(255) NOT NULL,
  `kennwort` varchar(255) NOT NULL,
  `role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `vorname`, `nachname`, `b_name`, `kennwort`, `role`) VALUES
(1, 'admin', 'admin', 'admin', 'c1bf0f05fd1c0940a35a019629bb77af3fb6b58a569b7d0353d01c0b2b74bc84a7cfb306a474052fa48a958fb6cc1137c5a8672156935823e09b3940f5291b8bTc9yvHHyoBRFDoFScX7kNnT7IFpcSC5mZnll5mv1A2k=', 1);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `tbl_grund`
--
ALTER TABLE `tbl_grund`
  ADD PRIMARY KEY (`gr_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indizes für die Tabelle `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `tbl_grund`
--
ALTER TABLE `tbl_grund`
  MODIFY `gr_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT für Tabelle `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
