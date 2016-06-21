-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 21. Jun 2016 um 15:26
-- Server-Version: 10.1.13-MariaDB
-- PHP-Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `list_it`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `company`
--

CREATE TABLE `company` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `company`
--

INSERT INTO `company` (`ID`, `Name`) VALUES
(1, 'McDonald''s');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `company_shoplocation`
--

CREATE TABLE `company_shoplocation` (
  `ID` int(10) UNSIGNED NOT NULL,
  `CompanyID` int(10) UNSIGNED DEFAULT NULL,
  `ShoplocationID` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `company_shoplocation`
--

INSERT INTO `company_shoplocation` (`ID`, `CompanyID`, `ShoplocationID`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `country`
--

CREATE TABLE `country` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `country`
--

INSERT INTO `country` (`ID`, `Name`) VALUES
(1, 'Schweiz');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product`
--

CREATE TABLE `product` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `product`
--

INSERT INTO `product` (`ID`, `Name`) VALUES
(1, 'Menu M 9 McNuggets'),
(2, 'Hello Kitty Tasche');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `receipt`
--

CREATE TABLE `receipt` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Datum` datetime NOT NULL,
  `UserID` int(10) UNSIGNED NOT NULL,
  `CompanyShoplocationID` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `receipt`
--

INSERT INTO `receipt` (`ID`, `Datum`, `UserID`, `CompanyShoplocationID`) VALUES
(6, '2016-05-24 00:00:00', 1, 1),
(7, '2016-06-12 00:00:00', 10, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `receipt_product`
--

CREATE TABLE `receipt_product` (
  `ID` int(10) UNSIGNED NOT NULL,
  `ReceiptID` int(10) UNSIGNED NOT NULL,
  `ProductID` int(10) UNSIGNED NOT NULL,
  `Quantity` int(10) UNSIGNED NOT NULL,
  `TotalPrice` decimal(10,4) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `receipt_product`
--

INSERT INTO `receipt_product` (`ID`, `ReceiptID`, `ProductID`, `Quantity`, `TotalPrice`) VALUES
(3, 6, 1, 2, '30.0000'),
(4, 6, 2, 1, '200.0000'),
(7, 6, 2, 2, '3.0000');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `region`
--

CREATE TABLE `region` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Name` varchar(45) NOT NULL,
  `CountryID` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `region`
--

INSERT INTO `region` (`ID`, `Name`, `CountryID`) VALUES
(1, 'Baar', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `shoplocation`
--

CREATE TABLE `shoplocation` (
  `ID` int(10) UNSIGNED NOT NULL,
  `RegionID` int(10) UNSIGNED DEFAULT NULL,
  `StreetID` int(10) UNSIGNED DEFAULT NULL,
  `StreetNr` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `shoplocation`
--

INSERT INTO `shoplocation` (`ID`, `RegionID`, `StreetID`, `StreetNr`) VALUES
(1, 1, 1, '62');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `street`
--

CREATE TABLE `street` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `street`
--

INSERT INTO `street` (`ID`, `Name`) VALUES
(1, 'Zugerstrasse');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Name` varchar(45) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `EMail` varchar(100) NOT NULL,
  `APIToken` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`ID`, `Name`, `Password`, `EMail`, `APIToken`) VALUES
(1, 'lordnik22', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'receipt@hot.ch', NULL),
(2, 'michi', '$2y$10$n/iqpsDzlmakVbKziBVrAu4LSUwQ.pQ71SULvr6eHUxYPYXyZVXyC', 'm1ch1@michi.com', 'be1xt3F7QycLJBa8YXNRHAqhodqxbtGzmWpHEyplF7XHalSxOOVXmLX8vz6SwKVNL77yPXE4sxUzKH5ouX36UmwoF14yOBz3XglXxAkie76c4IAvgbVPNbHlXwz1IyqpUXxEQ4BjurlIw0foTZAQZQwlyniJBexRIMqEGBraeZJm1FeGYCjRYhWYSErr1aqZRXcMoAIoojWCzQUJBuCJCwNpnwINEim4WSYTS3pp4sr3UsyW510ZrDhDFgdyzPy'),
(3, 'm1ch1', '$2y$10$oWfJB2BbWh22M8bh7qMJXOwGSuKL/AWyEWA3gDTmpHO28M8D3YXcm', 'm1ch1@michi.michi', NULL),
(4, 'm2ch2', '$2y$10$CpPiBmfdzrs4bDq4HsXXA.OkB557ADrh8M3wVnFpQPKZF8Y9gb/t.', 'm2ch2@michi.michi', 'gVtC1aQSCfBTS4AZji6cfqjp6XtWuoEOCZgjBVnSnUZfHNdNAPp1ON56JmgmVnPYBWSD4pTPcvnxej8HcnqZDhgnyDlhzF6fj0wcCX1QyoNE8REsKd1MkkQzC3mMWvwz3RFXTto0a7d0rn6NsvbnFMpemc3zajHZCF5Ak72YmkjNOIpZP7F1T7KYgGegTCtVA87paveoeagPGn23q62c7XTkYW8n4tWO8zxCdRaFhgetN6KXhYG6'),
(5, 'reg', 'ger', 'ger', NULL),
(6, 'ri', 'ru', 'ra', NULL),
(7, 'rock', '', '', NULL),
(8, 'adasda', 'a', 'a', NULL),
(10, 'adasdaa', 'a', 'a', NULL),
(11, 'rolf', 'rofl', 'rolf@mofl.cofl', NULL),
(13, 'lolo', '$2y$10$7.7ttNOIiIWut6kd/MDr1.BriomAJdOBIwAfZ74GNstgaMryJVgfy', 'lolo', NULL),
(14, 'adsasa', '$2y$10$2OMoomY6Uipc1RVyyU6kr.AmJv672K3wG5nLKk8s4FYJnEjSN6h5i', 'sasasa', NULL),
(15, 'dsadsa', '$2y$10$yvA.GxXNSkrN7xmf5MYsLOBAiZyfHFN.T1di1vCsni1e9WUSoV1Ka', 'dsadsadsa', NULL),
(52, 'sdasadsadsadsa', '$2y$10$EtswS0RRUSn9uomtkkOAj.mrXnTuOhCU/2l6uu29n/j5FCF1Q8xAO', 'dsadsadsa', NULL),
(54, '12321313123', '$2y$10$nE.HASVh1fy57r.GAJtTAONMGaVJeR/sGmR4eYtKqu9/M0EQARRqe', 'dsadsadsa', NULL),
(57, 'dsfsdfsdafdsafdsaf', '$2y$10$GGPMGwlmFDTaZGfoDo4eAuQBJB.IxRwzjKeCzgpzasvbSBAPANHCS', 'dsadsadsa', NULL),
(59, 'hello', '$2y$10$.JxZTgdDWHih/LTaUyqfxuwhEjCF.bV1QhkHTny/XParAdxW6saR.', '12', NULL),
(61, 'hello2', '$2y$10$IwLYkmxusUrOtti2pbWmWuzmloETeX7imWc.4Ae0I5WUmBt/pWqFO', '12', NULL),
(62, 'asdasd', '$2y$10$ROaY4SCaToKS.RqqNLhOSOCXLqTZvmz8d5FDIs9puoxSfbfhyKTpK', 'asdasd', NULL),
(63, 'adasdaadsad', '$2y$10$8T5.5EpOP6nl8PphrQf5Ke87ytLgv8qY.T5Y5mhJeD79SU5.zXw2W', 'adwaaw', NULL),
(71, 'w', '$2y$10$vqFB/C5KQ7FYH/e/7Arp8uzQcREkPgnjvF0w9zHjcILugZxg3SLJC', 'b', NULL),
(72, 'q', '$2y$10$dMZE35/YkJnSBNo7zZkVx..qunGInJ0r27wn10SVlrb.BbR37Kx4i', 'b', '4T0A8NxoieUCE8M2rNZWtc1WjrhWHMW3sF0mezPe1XOYqMgXz0FTNa02dlRLOLlQEKGQkWuEkjAxYSmo7HYZgjFe3XuioHpnqyCFBS7fF1f4QwEkSqDd8TSycpvUPaVHMUqbIIsEr5nJV6dHJtS8eE3QbC5CHqINJIsev2rlpMWJJ0KfjiojITdPUhNDIa6RZ0Aujle33w733Ulsy7AZd2k0Mj5TTbkWrxIwNtNWs81LEWOxzQgnmtxEmWr3R0I'),
(73, 'beta', '$2y$10$MF/M872Ko643ufTaOstHOe5vWl9qZhdMiiZKVJJ5Ck.s/6gYrBpjG', 'your', 'axQLx5VFnx6wdcM4Dcb153HElY7wHYo3z0OibBiWN3d5Brk5bCPUBztiyqLjD3H3fIYT8qOVYCnJWvus1f8XLk6fH57wzO8pmj05Lwzr5vpvKCPrwGSFF2q8Y8sElH8FHmQJ1kr0v6YzRtOrXaVFZtEABxoFU5aaTrDIyN3E4jhpv34KbYyNWCgvwPO8OjIuaSR2wbXNmxPF18xDrgYkg0RLKxFUZlhFVkY2AsjChF4qMeLU3lLdNnn7GzNOtLM'),
(74, 'lool', '$2y$10$BWgRw.inOrsJMKiJfvr6Yu2s4lQmMTJG1a5aXJxDVOZA3jowLmaXO', '1234', NULL),
(75, 'hadkwd', '$2y$10$0dFUYTedPZpq/xZ3hLu6CekLQu4YLXllOHpZvGogavPfuFEKy5PZy', 'zztrashtrashzz@gmail.com', NULL),
(76, 'ologisch', '$2y$10$Jv9hPZE6zn3ypnb7Re7ZxucbUYxADfbOso2kt1vEM/AmUIs8Mpm.C', 'olighsc@gmail.com', NULL),
(77, 'asd', '$2y$10$Ayj/ucp87jizeQmYLma4juS48qkpM7fWmIThmx7DIATNZ.xBjS3CK', 'a.a@a.a', NULL),
(78, 'alpha', '$2y$10$LD.AbVrP91fRPIpb6rgd9OLGd.5xQN.63JtNWFPBtCrd3iU0FNMCK', 'romenion@gmail.com', 'nKtXu88vuzfCdeZHEnrhkYamqIT2eXaWsY03sqNGdfwbbLLJPkPtj4zg4j2edUyZl2laGAHAqTWJ8i2KS8sHWeVnQHMNKpMeij0T6Nd5aPPYXtKgTdVWf8WWLJ4DNBuXFQJIQRKzueFhoS12bLBEH5NqpELg7RINXVHLZyeCOEIhOI2RTdzt63cTM3dL0WIxNHNw2oYwHXlRi3VoTnMa5LRxNR7it5T3HaVkOh37MqZeFHPDCWabW7FeyFDyLKE'),
(79, 'roudlong', '$2y$10$I2MsW6YpludfWY1GkNN86Og9/hFXk7D8qFiEsV3J4sMLPVU/v1Zvy', 'roudlong@gmail.com', NULL),
(80, 'gorgi', '$2y$10$1ez2iDoKZLbAyaL7tIvJnOl0dcNLuJDu4miLlcX8GHsdOLr9.PO2G', 'gorgi@gmail.com', NULL),
(81, 'alp', '$2y$10$ZJl9jIipKAhu3GSCjHNMcup5csZcdGN/.bMtCGyWT8GlzpkkBBiVS', 'alp@gmail.com', NULL),
(82, 'add', '$2y$10$Gasdc.0GD1qdZEByvPh3OOdhsEMCNmZkIv5DK7e.BPFkJeOhAJ41K', 'add@gmail.com', NULL),
(83, 'adds', '$2y$10$z.QNscQlLEJcwa4ym3fGs.7S2txSqzloci5Qaw/gxfuGNfM6nRrV6', 'adds@gmail.com', NULL),
(84, 'lol', '$2y$10$n1E68CrbmNPuzXY2rtyrCezkNIrfG9uL5kODunHinnGQ4RxEmKIPq', 'lol@gmail.com', NULL),
(85, 'lol1', '$2y$10$DPiIKMbnCx4clmpkQncQXeurWFkoHZfIdwZi7m8/tIC4HbLBItOxS', 'lol1@gmail.com', NULL),
(86, 'road', '$2y$10$pu5xA8F2NMOGjAluk1nYSuI91tWPWUH1wJMiPKwI7iIQuk5iqB2bS', 'road@gmail.com', NULL),
(87, 'aha', '$2y$10$3khr5gpMEZmomWNSZoqbSOf2YkziJIRafeL5/t3eBohmXIU1CpYoW', 'aha@gmail.com', NULL);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `company_shoplocation`
--
ALTER TABLE `company_shoplocation`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `company_companyShoplocation_idx` (`CompanyID`),
  ADD KEY `shoplocation_companyShoplocation_idx` (`ShoplocationID`);

--
-- Indizes für die Tabelle `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_receipt_idx` (`UserID`),
  ADD KEY `user_companyShoplocation_idx` (`CompanyShoplocationID`);

--
-- Indizes für die Tabelle `receipt_product`
--
ALTER TABLE `receipt_product`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `product_receiptproduct_idx` (`ProductID`),
  ADD KEY `receipt_receiptproduct_idx` (`ReceiptID`);

--
-- Indizes für die Tabelle `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Name_UNIQUE` (`Name`),
  ADD KEY `country_region_idx` (`CountryID`);

--
-- Indizes für die Tabelle `shoplocation`
--
ALTER TABLE `shoplocation`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `region_shoplocation_idx` (`RegionID`),
  ADD KEY `street_shoplocation_idx` (`StreetID`);

--
-- Indizes für die Tabelle `street`
--
ALTER TABLE `street`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Name_UNIQUE` (`Name`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `company`
--
ALTER TABLE `company`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT für Tabelle `company_shoplocation`
--
ALTER TABLE `company_shoplocation`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT für Tabelle `country`
--
ALTER TABLE `country`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT für Tabelle `product`
--
ALTER TABLE `product`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT für Tabelle `receipt`
--
ALTER TABLE `receipt`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT für Tabelle `receipt_product`
--
ALTER TABLE `receipt_product`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT für Tabelle `region`
--
ALTER TABLE `region`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT für Tabelle `shoplocation`
--
ALTER TABLE `shoplocation`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT für Tabelle `street`
--
ALTER TABLE `street`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `company_shoplocation`
--
ALTER TABLE `company_shoplocation`
  ADD CONSTRAINT `company_companyShoplocation` FOREIGN KEY (`CompanyID`) REFERENCES `company` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `shoplocation_companyShoplocation` FOREIGN KEY (`ShoplocationID`) REFERENCES `shoplocation` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `receipt`
--
ALTER TABLE `receipt`
  ADD CONSTRAINT `user_companyShoplocation` FOREIGN KEY (`CompanyShoplocationID`) REFERENCES `company_shoplocation` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_receipt` FOREIGN KEY (`UserID`) REFERENCES `user` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `receipt_product`
--
ALTER TABLE `receipt_product`
  ADD CONSTRAINT `product_receiptproduct` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `receipt_receiptproduct` FOREIGN KEY (`ReceiptID`) REFERENCES `receipt` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `region`
--
ALTER TABLE `region`
  ADD CONSTRAINT `country_region` FOREIGN KEY (`CountryID`) REFERENCES `country` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `shoplocation`
--
ALTER TABLE `shoplocation`
  ADD CONSTRAINT `region_shoplocation` FOREIGN KEY (`RegionID`) REFERENCES `region` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `street_shoplocation` FOREIGN KEY (`StreetID`) REFERENCES `street` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
