-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Erstellungszeit: 19. Mrz 2019 um 17:45
-- Server-Version: 10.1.37-MariaDB-0+deb9u1
-- PHP-Version: 7.0.33-0+deb9u3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `smarte`
--
CREATE DATABASE IF NOT EXISTS `smarte` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `smarte`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `alerts`
--

CREATE TABLE `alerts` (
  `id` int(11) NOT NULL,
  `relation` enum('<','<=','=','!=','>=','>') NOT NULL,
  `value` decimal(10,6) NOT NULL,
  `type` enum('info','warning','danger','success') NOT NULL,
  `message` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `sensor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `alerts`
--

INSERT INTO `alerts` (`id`, `relation`, `value`, `type`, `message`, `active`, `sensor`) VALUES
(1, '>=', '1.000000', 'info', 'Daheim herrscht Bewegung.', 1, 1),
(2, '>', '0.000000', 'danger', 'Achtung, Wasser tritt aus!', 1, 4),
(3, '>', '50.000000', 'warning', 'Die Luftfeuchtigkeit ist höher als der Optimalwert. Durch Lüften können Sie Schimmel vermeiden.', 1, 3),
(4, '>', '1.000000', 'info', 'Das Licht ist an.', 1, 5),
(5, '>', '25.000000', 'warning', 'Die Raumtemperatur ist relativ hoch. Mit einer geringeren Raumtemperatur können Sie Heizkosten sparen.', 1, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `measurements`
--

CREATE TABLE `measurements` (
  `id` bigint(20) NOT NULL,
  `time` int(11) NOT NULL,
  `value` decimal(10,6) NOT NULL,
  `sensor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `picture`, `active`) VALUES
(1, 'Wohnzimmer', 'wohnzimmer.jpg', 1),
(2, 'Keller', 'keller.jpg', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sensors`
--

CREATE TABLE `sensors` (
  `id` int(11) NOT NULL,
  `topic` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `unit` varchar(10) DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `room` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `sensors`
--

INSERT INTO `sensors` (`id`, `topic`, `name`, `unit`, `active`, `room`) VALUES
(1, 'smart-e2/bewegung', 'Bewegung', NULL, 1, 1),
(2, 'smart-e2/temperatur', 'Temperatur', '°C', 1, 1),
(3, 'smart-e2/luftfeuchte', 'Luftfeuchtigkeit', '%', 1, 1),
(4, 'smart-e2/wasserstand', 'Wasserstand', 'cm', 1, 2),
(5, 'smart-e2/helligkeit', 'Helligkeit', 'lx', 1, 2);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `alerts`
--
ALTER TABLE `alerts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alerts_sensor` (`sensor`);

--
-- Indizes für die Tabelle `measurements`
--
ALTER TABLE `measurements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `measurements_sensor` (`sensor`);

--
-- Indizes für die Tabelle `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `sensors`
--
ALTER TABLE `sensors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sensor_topic` (`topic`),
  ADD KEY `sensors_room` (`room`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `alerts`
--
ALTER TABLE `alerts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT für Tabelle `measurements`
--
ALTER TABLE `measurements`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;
--
-- AUTO_INCREMENT für Tabelle `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT für Tabelle `sensors`
--
ALTER TABLE `sensors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `alerts`
--
ALTER TABLE `alerts`
  ADD CONSTRAINT `alerts_sensor` FOREIGN KEY (`sensor`) REFERENCES `sensors` (`id`);

--
-- Constraints der Tabelle `measurements`
--
ALTER TABLE `measurements`
  ADD CONSTRAINT `measurements_sensor` FOREIGN KEY (`sensor`) REFERENCES `sensors` (`id`);

--
-- Constraints der Tabelle `sensors`
--
ALTER TABLE `sensors`
  ADD CONSTRAINT `sensors_room` FOREIGN KEY (`room`) REFERENCES `rooms` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
