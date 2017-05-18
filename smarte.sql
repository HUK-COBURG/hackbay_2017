-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 18. Mai 2017 um 07:47
-- Server Version: 5.5.54-0+deb8u1
-- PHP-Version: 5.6.30-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `smarte`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Schwellwerte`
--

CREATE TABLE IF NOT EXISTS `Schwellwerte` (
  `SensorID` varchar(100) NOT NULL,
  `MinWert` decimal(10,6) NOT NULL,
  `Maxwert` decimal(10,6) NOT NULL,
  `GültigVon` date NOT NULL,
  `GültigBis` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `Schwellwerte`
--

INSERT INTO `Schwellwerte` (`SensorID`, `MinWert`, `Maxwert`, `GültigVon`, `GültigBis`) VALUES
('smart-e1/bewegung', 0.000000, 1.000000, '2017-05-17', '2017-05-18'),
('smart-e1/relais', 0.000000, 1.000000, '2017-05-17', '2017-05-18'),
('smart-e1/temperatur', 25.000000, 78.000000, '2017-05-17', '2017-05-18'),
('smart-e1/wasserstand', 0.000000, 200.000000, '2017-05-17', '2017-05-18'),
('smart-e1/windstaerke', 0.000000, 10.000000, '2017-05-17', '2017-05-18');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `SensorDaten`
--

CREATE TABLE IF NOT EXISTS `SensorDaten` (
  `SensorZeit` int(11) NOT NULL,
  `SensorID` varchar(100) NOT NULL,
  `SensorWert` decimal(10,6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `SensorDaten`
--

INSERT INTO `SensorDaten` (`SensorZeit`, `SensorID`, `SensorWert`) VALUES
(1495058890, 'smart-e1/bewegung', 0.000000),
(1495058890, 'smart-e1/luftfeuchte', 47.000000),
(1495058890, 'smart-e1/relais', 0.000000),
(1495058890, 'smart-e1/temperatur', 23.000000),
(1495058890, 'smart-e1/wasserstand', 42.000000),
(1495058890, 'smart-e1/windstaerke', 14.000000),
(1495058900, 'smart-e1/bewegung', 0.000000),
(1495058900, 'smart-e1/luftfeuchte', 48.000000),
(1495058900, 'smart-e1/relais', 0.000000),
(1495058900, 'smart-e1/temperatur', 25.000000),
(1495058900, 'smart-e1/wasserstand', 43.000000),
(1495058900, 'smart-e1/windstaerke', 14.000000),
(1495058911, 'smart-e1/bewegung', 0.000000),
(1495058911, 'smart-e1/luftfeuchte', 49.000000),
(1495058911, 'smart-e1/relais', 0.000000),
(1495058911, 'smart-e1/temperatur', 24.000000),
(1495058911, 'smart-e1/wasserstand', 43.000000),
(1495058911, 'smart-e1/windstaerke', 14.000000),
(1495058921, 'smart-e1/bewegung', 0.000000),
(1495058921, 'smart-e1/luftfeuchte', 48.000000),
(1495058921, 'smart-e1/relais', 0.000000),
(1495058921, 'smart-e1/temperatur', 23.000000),
(1495058921, 'smart-e1/wasserstand', 43.000000),
(1495058921, 'smart-e1/windstaerke', 14.000000),
(1495058931, 'smart-e1/bewegung', 0.000000),
(1495058931, 'smart-e1/luftfeuchte', 70.000000),
(1495058931, 'smart-e1/relais', 0.000000),
(1495058931, 'smart-e1/temperatur', 25.000000),
(1495058931, 'smart-e1/wasserstand', 48.000000),
(1495058931, 'smart-e1/windstaerke', 14.000000),
(1495058941, 'smart-e1/bewegung', 0.000000),
(1495058941, 'smart-e1/luftfeuchte', 67.000000),
(1495058941, 'smart-e1/relais', 0.000000),
(1495058941, 'smart-e1/temperatur', 25.000000),
(1495058941, 'smart-e1/wasserstand', 48.000000),
(1495058941, 'smart-e1/windstaerke', 14.000000),
(1495058952, 'smart-e1/bewegung', 1.000000),
(1495058952, 'smart-e1/luftfeuchte', 79.000000),
(1495058952, 'smart-e1/relais', 0.000000),
(1495058952, 'smart-e1/temperatur', 24.000000),
(1495058952, 'smart-e1/wasserstand', 48.000000),
(1495058952, 'smart-e1/windstaerke', 14.000000),
(1495058962, 'smart-e1/bewegung', 1.000000),
(1495058962, 'smart-e1/luftfeuchte', 81.000000),
(1495058962, 'smart-e1/relais', 0.000000),
(1495058962, 'smart-e1/temperatur', 25.000000),
(1495058962, 'smart-e1/wasserstand', 48.000000),
(1495058962, 'smart-e1/windstaerke', 14.000000),
(1495058972, 'smart-e1/bewegung', 0.000000),
(1495058972, 'smart-e1/luftfeuchte', 68.000000),
(1495058972, 'smart-e1/relais', 0.000000),
(1495058972, 'smart-e1/temperatur', 25.000000),
(1495058972, 'smart-e1/wasserstand', 48.000000),
(1495058972, 'smart-e1/windstaerke', 14.000000),
(1495058982, 'smart-e1/bewegung', 0.000000),
(1495058982, 'smart-e1/luftfeuchte', 63.000000),
(1495058982, 'smart-e1/relais', 0.000000),
(1495058982, 'smart-e1/temperatur', 25.000000),
(1495058982, 'smart-e1/wasserstand', 48.000000),
(1495058982, 'smart-e1/windstaerke', 14.000000),
(1495058993, 'smart-e1/bewegung', 1.000000),
(1495058993, 'smart-e1/luftfeuchte', 61.000000),
(1495058993, 'smart-e1/relais', 0.000000),
(1495058993, 'smart-e1/temperatur', 25.000000),
(1495058993, 'smart-e1/wasserstand', 49.000000),
(1495058993, 'smart-e1/windstaerke', 14.000000),
(1495059003, 'smart-e1/bewegung', 1.000000),
(1495059003, 'smart-e1/luftfeuchte', 59.000000),
(1495059003, 'smart-e1/relais', 0.000000),
(1495059003, 'smart-e1/temperatur', 24.000000),
(1495059003, 'smart-e1/wasserstand', 48.000000),
(1495059003, 'smart-e1/windstaerke', 14.000000),
(1495059013, 'smart-e1/bewegung', 0.000000),
(1495059013, 'smart-e1/luftfeuchte', 56.000000),
(1495059013, 'smart-e1/relais', 0.000000),
(1495059013, 'smart-e1/temperatur', 25.000000),
(1495059013, 'smart-e1/wasserstand', 48.000000),
(1495059013, 'smart-e1/windstaerke', 14.000000),
(1495059024, 'smart-e1/bewegung', 0.000000),
(1495059024, 'smart-e1/luftfeuchte', 55.000000),
(1495059024, 'smart-e1/relais', 0.000000),
(1495059024, 'smart-e1/temperatur', 25.000000),
(1495059024, 'smart-e1/wasserstand', 49.000000),
(1495059024, 'smart-e1/windstaerke', 14.000000),
(1495093150, 'smart-e1/bewegung', 1.000000),
(1495093150, 'smart-e1/luftfeuchte', 48.000000),
(1495093150, 'smart-e1/relais', 0.000000),
(1495093150, 'smart-e1/temperatur', 23.000000),
(1495093150, 'smart-e1/wasserstand', 36.000000),
(1495093150, 'smart-e1/windstaerke', 11.000000),
(1495093160, 'smart-e1/bewegung', 0.000000),
(1495093160, 'smart-e1/luftfeuchte', 49.000000),
(1495093160, 'smart-e1/relais', 0.000000),
(1495093160, 'smart-e1/temperatur', 22.000000),
(1495093160, 'smart-e1/wasserstand', 36.000000),
(1495093160, 'smart-e1/windstaerke', 11.000000),
(1495093171, 'smart-e1/bewegung', 0.000000),
(1495093171, 'smart-e1/luftfeuchte', 49.000000),
(1495093171, 'smart-e1/relais', 0.000000),
(1495093171, 'smart-e1/temperatur', 22.000000),
(1495093171, 'smart-e1/wasserstand', 36.000000),
(1495093171, 'smart-e1/windstaerke', 10.000000),
(1495093181, 'smart-e1/bewegung', 0.000000),
(1495093181, 'smart-e1/luftfeuchte', 49.000000),
(1495093181, 'smart-e1/relais', 0.000000),
(1495093181, 'smart-e1/temperatur', 22.000000),
(1495093181, 'smart-e1/wasserstand', 36.000000),
(1495093181, 'smart-e1/windstaerke', 11.000000),
(1495093191, 'smart-e1/bewegung', 0.000000),
(1495093191, 'smart-e1/luftfeuchte', 49.000000),
(1495093191, 'smart-e1/relais', 0.000000),
(1495093191, 'smart-e1/temperatur', 23.000000),
(1495093191, 'smart-e1/wasserstand', 36.000000),
(1495093191, 'smart-e1/windstaerke', 10.000000),
(1495093201, 'smart-e1/bewegung', 1.000000),
(1495093201, 'smart-e1/luftfeuchte', 49.000000),
(1495093201, 'smart-e1/relais', 0.000000),
(1495093201, 'smart-e1/temperatur', 23.000000),
(1495093201, 'smart-e1/wasserstand', 36.000000),
(1495093201, 'smart-e1/windstaerke', 11.000000),
(1495093212, 'smart-e1/bewegung', 0.000000),
(1495093212, 'smart-e1/luftfeuchte', 48.000000),
(1495093212, 'smart-e1/relais', 0.000000),
(1495093212, 'smart-e1/temperatur', 23.000000),
(1495093212, 'smart-e1/wasserstand', 36.000000),
(1495093212, 'smart-e1/windstaerke', 10.000000),
(1495093222, 'smart-e1/bewegung', 0.000000),
(1495093222, 'smart-e1/luftfeuchte', 48.000000),
(1495093222, 'smart-e1/relais', 0.000000),
(1495093222, 'smart-e1/temperatur', 23.000000),
(1495093222, 'smart-e1/wasserstand', 36.000000),
(1495093222, 'smart-e1/windstaerke', 11.000000),
(1495093232, 'smart-e1/bewegung', 0.000000),
(1495093232, 'smart-e1/luftfeuchte', 48.000000),
(1495093232, 'smart-e1/relais', 0.000000),
(1495093232, 'smart-e1/temperatur', 23.000000),
(1495093232, 'smart-e1/wasserstand', 36.000000),
(1495093232, 'smart-e1/windstaerke', 10.000000),
(1495093242, 'smart-e1/bewegung', 0.000000),
(1495093242, 'smart-e1/wasserstand', 36.000000),
(1495093242, 'smart-e1/windstaerke', 10.000000),
(1495093243, 'smart-e1/luftfeuchte', 48.000000),
(1495093243, 'smart-e1/relais', 0.000000),
(1495093243, 'smart-e1/temperatur', 23.000000),
(1495093253, 'smart-e1/bewegung', 0.000000),
(1495093253, 'smart-e1/luftfeuchte', 48.000000),
(1495093253, 'smart-e1/relais', 0.000000),
(1495093253, 'smart-e1/temperatur', 23.000000),
(1495093253, 'smart-e1/wasserstand', 36.000000),
(1495093253, 'smart-e1/windstaerke', 10.000000),
(1495093263, 'smart-e1/bewegung', 0.000000),
(1495093263, 'smart-e1/luftfeuchte', 48.000000),
(1495093263, 'smart-e1/relais', 0.000000),
(1495093263, 'smart-e1/temperatur', 23.000000),
(1495093263, 'smart-e1/wasserstand', 36.000000),
(1495093263, 'smart-e1/windstaerke', 11.000000),
(1495093273, 'smart-e1/bewegung', 0.000000),
(1495093273, 'smart-e1/luftfeuchte', 49.000000),
(1495093273, 'smart-e1/relais', 0.000000),
(1495093273, 'smart-e1/temperatur', 22.000000),
(1495093273, 'smart-e1/wasserstand', 36.000000),
(1495093273, 'smart-e1/windstaerke', 10.000000),
(1495093284, 'smart-e1/bewegung', 0.000000),
(1495093284, 'smart-e1/luftfeuchte', 49.000000),
(1495093284, 'smart-e1/relais', 0.000000),
(1495093284, 'smart-e1/temperatur', 22.000000),
(1495093284, 'smart-e1/wasserstand', 36.000000),
(1495093284, 'smart-e1/windstaerke', 10.000000),
(1495093294, 'smart-e1/bewegung', 0.000000),
(1495093294, 'smart-e1/luftfeuchte', 49.000000),
(1495093294, 'smart-e1/relais', 0.000000),
(1495093294, 'smart-e1/temperatur', 23.000000),
(1495093294, 'smart-e1/wasserstand', 36.000000),
(1495093294, 'smart-e1/windstaerke', 10.000000),
(1495093304, 'smart-e1/bewegung', 0.000000),
(1495093304, 'smart-e1/luftfeuchte', 51.000000),
(1495093304, 'smart-e1/relais', 0.000000),
(1495093304, 'smart-e1/temperatur', 23.000000),
(1495093304, 'smart-e1/wasserstand', 36.000000),
(1495093304, 'smart-e1/windstaerke', 11.000000),
(1495093314, 'smart-e1/bewegung', 0.000000),
(1495093314, 'smart-e1/luftfeuchte', 53.000000),
(1495093314, 'smart-e1/relais', 0.000000),
(1495093314, 'smart-e1/temperatur', 23.000000),
(1495093314, 'smart-e1/wasserstand', 36.000000),
(1495093314, 'smart-e1/windstaerke', 10.000000),
(1495093325, 'smart-e1/bewegung', 0.000000),
(1495093325, 'smart-e1/luftfeuchte', 52.000000),
(1495093325, 'smart-e1/relais', 0.000000),
(1495093325, 'smart-e1/temperatur', 23.000000),
(1495093325, 'smart-e1/wasserstand', 36.000000),
(1495093325, 'smart-e1/windstaerke', 10.000000),
(1495093335, 'smart-e1/bewegung', 0.000000),
(1495093335, 'smart-e1/luftfeuchte', 51.000000),
(1495093335, 'smart-e1/relais', 0.000000),
(1495093335, 'smart-e1/temperatur', 23.000000),
(1495093335, 'smart-e1/wasserstand', 36.000000),
(1495093335, 'smart-e1/windstaerke', 10.000000),
(1495093345, 'smart-e1/bewegung', 0.000000),
(1495093345, 'smart-e1/luftfeuchte', 50.000000),
(1495093345, 'smart-e1/relais', 0.000000),
(1495093345, 'smart-e1/temperatur', 23.000000),
(1495093345, 'smart-e1/windstaerke', 10.000000),
(1495093356, 'smart-e1/bewegung', 0.000000),
(1495093356, 'smart-e1/luftfeuchte', 0.000000),
(1495093356, 'smart-e1/relais', 0.000000),
(1495093356, 'smart-e1/temperatur', 255.000000),
(1495093356, 'smart-e1/windstaerke', 10.000000),
(1495093366, 'smart-e1/bewegung', 0.000000),
(1495093366, 'smart-e1/luftfeuchte', 49.000000),
(1495093366, 'smart-e1/relais', 0.000000),
(1495093366, 'smart-e1/temperatur', 23.000000),
(1495093366, 'smart-e1/windstaerke', 10.000000),
(1495093376, 'smart-e1/bewegung', 0.000000),
(1495093376, 'smart-e1/luftfeuchte', 49.000000),
(1495093376, 'smart-e1/relais', 0.000000),
(1495093376, 'smart-e1/temperatur', 23.000000),
(1495093376, 'smart-e1/wasserstand', 36.000000),
(1495093376, 'smart-e1/windstaerke', 10.000000),
(1495093386, 'smart-e1/bewegung', 0.000000),
(1495093386, 'smart-e1/luftfeuchte', 48.000000),
(1495093386, 'smart-e1/relais', 0.000000),
(1495093386, 'smart-e1/temperatur', 23.000000),
(1495093386, 'smart-e1/windstaerke', 10.000000),
(1495093397, 'smart-e1/bewegung', 0.000000),
(1495093397, 'smart-e1/luftfeuchte', 48.000000),
(1495093397, 'smart-e1/relais', 0.000000),
(1495093397, 'smart-e1/temperatur', 23.000000),
(1495093397, 'smart-e1/windstaerke', 10.000000),
(1495093407, 'smart-e1/bewegung', 0.000000),
(1495093407, 'smart-e1/luftfeuchte', 48.000000),
(1495093407, 'smart-e1/relais', 0.000000),
(1495093407, 'smart-e1/temperatur', 23.000000),
(1495093407, 'smart-e1/windstaerke', 11.000000),
(1495093417, 'smart-e1/bewegung', 0.000000),
(1495093417, 'smart-e1/luftfeuchte', 48.000000),
(1495093417, 'smart-e1/relais', 0.000000),
(1495093417, 'smart-e1/temperatur', 23.000000),
(1495093417, 'smart-e1/wasserstand', 36.000000),
(1495093417, 'smart-e1/windstaerke', 10.000000),
(1495093428, 'smart-e1/bewegung', 0.000000),
(1495093428, 'smart-e1/luftfeuchte', 0.000000),
(1495093428, 'smart-e1/relais', 0.000000),
(1495093428, 'smart-e1/temperatur', 20.000000),
(1495093428, 'smart-e1/wasserstand', 36.000000),
(1495093428, 'smart-e1/windstaerke', 11.000000),
(1495093438, 'smart-e1/bewegung', 0.000000),
(1495093438, 'smart-e1/luftfeuchte', 49.000000),
(1495093438, 'smart-e1/relais', 0.000000),
(1495093438, 'smart-e1/temperatur', 23.000000),
(1495093438, 'smart-e1/wasserstand', 36.000000),
(1495093438, 'smart-e1/windstaerke', 11.000000),
(1495093448, 'smart-e1/bewegung', 0.000000),
(1495093448, 'smart-e1/luftfeuchte', 49.000000),
(1495093448, 'smart-e1/relais', 0.000000),
(1495093448, 'smart-e1/temperatur', 23.000000),
(1495093448, 'smart-e1/wasserstand', 36.000000),
(1495093448, 'smart-e1/windstaerke', 11.000000),
(1495093458, 'smart-e1/bewegung', 0.000000),
(1495093458, 'smart-e1/luftfeuchte', 49.000000),
(1495093458, 'smart-e1/relais', 0.000000),
(1495093458, 'smart-e1/temperatur', 23.000000),
(1495093458, 'smart-e1/wasserstand', 36.000000),
(1495093458, 'smart-e1/windstaerke', 11.000000),
(1495093469, 'smart-e1/bewegung', 0.000000),
(1495093469, 'smart-e1/luftfeuchte', 49.000000),
(1495093469, 'smart-e1/relais', 0.000000),
(1495093469, 'smart-e1/temperatur', 23.000000),
(1495093469, 'smart-e1/wasserstand', 36.000000),
(1495093469, 'smart-e1/windstaerke', 11.000000),
(1495093479, 'smart-e1/bewegung', 0.000000),
(1495093479, 'smart-e1/luftfeuchte', 49.000000),
(1495093479, 'smart-e1/relais', 0.000000),
(1495093479, 'smart-e1/temperatur', 23.000000),
(1495093479, 'smart-e1/wasserstand', 36.000000),
(1495093479, 'smart-e1/windstaerke', 11.000000),
(1495093489, 'smart-e1/bewegung', 0.000000),
(1495093489, 'smart-e1/luftfeuchte', 49.000000),
(1495093489, 'smart-e1/relais', 0.000000),
(1495093489, 'smart-e1/temperatur', 23.000000),
(1495093489, 'smart-e1/wasserstand', 36.000000),
(1495093489, 'smart-e1/windstaerke', 11.000000),
(1495093499, 'smart-e1/bewegung', 0.000000),
(1495093499, 'smart-e1/wasserstand', 36.000000),
(1495093499, 'smart-e1/windstaerke', 11.000000),
(1495093500, 'smart-e1/luftfeuchte', 49.000000),
(1495093500, 'smart-e1/relais', 0.000000),
(1495093500, 'smart-e1/temperatur', 23.000000),
(1495093510, 'smart-e1/bewegung', 0.000000),
(1495093510, 'smart-e1/luftfeuchte', 48.000000),
(1495093510, 'smart-e1/relais', 0.000000),
(1495093510, 'smart-e1/temperatur', 23.000000),
(1495093510, 'smart-e1/wasserstand', 35.000000),
(1495093510, 'smart-e1/windstaerke', 11.000000),
(1495093520, 'smart-e1/bewegung', 0.000000),
(1495093520, 'smart-e1/luftfeuchte', 48.000000),
(1495093520, 'smart-e1/relais', 0.000000),
(1495093520, 'smart-e1/temperatur', 23.000000),
(1495093520, 'smart-e1/wasserstand', 35.000000),
(1495093520, 'smart-e1/windstaerke', 11.000000),
(1495093530, 'smart-e1/bewegung', 0.000000),
(1495093530, 'smart-e1/luftfeuchte', 48.000000),
(1495093530, 'smart-e1/relais', 0.000000),
(1495093530, 'smart-e1/temperatur', 23.000000),
(1495093530, 'smart-e1/wasserstand', 35.000000),
(1495093530, 'smart-e1/windstaerke', 11.000000),
(1495093540, 'smart-e1/wasserstand', 35.000000),
(1495093541, 'smart-e1/bewegung', 0.000000),
(1495093541, 'smart-e1/luftfeuchte', 48.000000),
(1495093541, 'smart-e1/relais', 0.000000),
(1495093541, 'smart-e1/temperatur', 23.000000),
(1495093541, 'smart-e1/windstaerke', 11.000000),
(1495093551, 'smart-e1/bewegung', 0.000000),
(1495093551, 'smart-e1/luftfeuchte', 48.000000),
(1495093551, 'smart-e1/relais', 0.000000),
(1495093551, 'smart-e1/temperatur', 23.000000),
(1495093551, 'smart-e1/wasserstand', 35.000000),
(1495093551, 'smart-e1/windstaerke', 11.000000),
(1495093561, 'smart-e1/bewegung', 0.000000),
(1495093561, 'smart-e1/luftfeuchte', 48.000000),
(1495093561, 'smart-e1/relais', 0.000000),
(1495093561, 'smart-e1/temperatur', 23.000000),
(1495093561, 'smart-e1/wasserstand', 35.000000),
(1495093561, 'smart-e1/windstaerke', 11.000000),
(1495093571, 'smart-e1/bewegung', 0.000000),
(1495093571, 'smart-e1/luftfeuchte', 48.000000),
(1495093571, 'smart-e1/relais', 0.000000),
(1495093571, 'smart-e1/temperatur', 23.000000),
(1495093571, 'smart-e1/windstaerke', 11.000000),
(1495093582, 'smart-e1/bewegung', 0.000000),
(1495093582, 'smart-e1/luftfeuchte', 48.000000),
(1495093582, 'smart-e1/relais', 0.000000),
(1495093582, 'smart-e1/temperatur', 23.000000),
(1495093582, 'smart-e1/wasserstand', 35.000000),
(1495093582, 'smart-e1/windstaerke', 11.000000),
(1495093592, 'smart-e1/bewegung', 0.000000),
(1495093592, 'smart-e1/luftfeuchte', 48.000000),
(1495093592, 'smart-e1/relais', 0.000000),
(1495093592, 'smart-e1/temperatur', 23.000000),
(1495093592, 'smart-e1/wasserstand', 35.000000),
(1495093592, 'smart-e1/windstaerke', 11.000000),
(1495093602, 'smart-e1/bewegung', 0.000000),
(1495093602, 'smart-e1/luftfeuchte', 49.000000),
(1495093602, 'smart-e1/relais', 0.000000),
(1495093602, 'smart-e1/temperatur', 23.000000),
(1495093602, 'smart-e1/windstaerke', 11.000000),
(1495093613, 'smart-e1/bewegung', 0.000000),
(1495093613, 'smart-e1/luftfeuchte', 49.000000),
(1495093613, 'smart-e1/relais', 0.000000),
(1495093613, 'smart-e1/temperatur', 23.000000),
(1495093613, 'smart-e1/windstaerke', 11.000000),
(1495093623, 'smart-e1/bewegung', 0.000000),
(1495093623, 'smart-e1/luftfeuchte', 49.000000),
(1495093623, 'smart-e1/relais', 0.000000),
(1495093623, 'smart-e1/temperatur', 23.000000),
(1495093623, 'smart-e1/wasserstand', 35.000000),
(1495093623, 'smart-e1/windstaerke', 11.000000),
(1495093633, 'smart-e1/bewegung', 0.000000),
(1495093633, 'smart-e1/luftfeuchte', 49.000000),
(1495093633, 'smart-e1/relais', 0.000000),
(1495093633, 'smart-e1/temperatur', 23.000000),
(1495093633, 'smart-e1/wasserstand', 35.000000),
(1495093633, 'smart-e1/windstaerke', 11.000000),
(1495093643, 'smart-e1/bewegung', 0.000000),
(1495093643, 'smart-e1/luftfeuchte', 48.000000),
(1495093643, 'smart-e1/relais', 0.000000),
(1495093643, 'smart-e1/temperatur', 23.000000),
(1495093643, 'smart-e1/wasserstand', 35.000000),
(1495093643, 'smart-e1/windstaerke', 11.000000),
(1495093654, 'smart-e1/bewegung', 0.000000),
(1495093654, 'smart-e1/luftfeuchte', 48.000000),
(1495093654, 'smart-e1/relais', 0.000000),
(1495093654, 'smart-e1/temperatur', 23.000000),
(1495093654, 'smart-e1/wasserstand', 35.000000),
(1495093654, 'smart-e1/windstaerke', 11.000000),
(1495093664, 'smart-e1/bewegung', 0.000000),
(1495093664, 'smart-e1/luftfeuchte', 48.000000),
(1495093664, 'smart-e1/relais', 0.000000),
(1495093664, 'smart-e1/temperatur', 23.000000),
(1495093664, 'smart-e1/wasserstand', 35.000000),
(1495093664, 'smart-e1/windstaerke', 11.000000);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Sensoren`
--

CREATE TABLE IF NOT EXISTS `Sensoren` (
  `SensorID` varchar(100) NOT NULL,
  `SensorBezeichnung` varchar(32) NOT NULL,
  `SensorAktiv` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `Sensoren`
--

INSERT INTO `Sensoren` (`SensorID`, `SensorBezeichnung`, `SensorAktiv`) VALUES
('smart-e1/bewegung', 'Bewegung', 1),
('smart-e1/erschuetterung', 'Erschütterung', 0),
('smart-e1/luftfeuchte', 'Luftfeuchtigkeit', 1),
('smart-e1/relais', 'Relais', 1),
('smart-e1/temperatur', 'Temperatur', 1),
('smart-e1/wasserstand', 'Wasserstand', 1),
('smart-e1/windstaerke', 'Windstaerke', 1);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `Schwellwerte`
--
ALTER TABLE `Schwellwerte`
 ADD PRIMARY KEY (`SensorID`);

--
-- Indizes für die Tabelle `SensorDaten`
--
ALTER TABLE `SensorDaten`
 ADD PRIMARY KEY (`SensorZeit`,`SensorID`), ADD KEY `SensorID` (`SensorID`);

--
-- Indizes für die Tabelle `Sensoren`
--
ALTER TABLE `Sensoren`
 ADD PRIMARY KEY (`SensorID`), ADD UNIQUE KEY `SensorBezeichnung` (`SensorBezeichnung`);

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `Schwellwerte`
--
ALTER TABLE `Schwellwerte`
ADD CONSTRAINT `Schwellwerte_ibfk_1` FOREIGN KEY (`SensorID`) REFERENCES `Sensoren` (`SensorID`);

--
-- Constraints der Tabelle `SensorDaten`
--
ALTER TABLE `SensorDaten`
ADD CONSTRAINT `SensorDaten_ibfk_1` FOREIGN KEY (`SensorID`) REFERENCES `Sensoren` (`SensorID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
