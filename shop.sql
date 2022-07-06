-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Lug 06, 2022 alle 21:53
-- Versione del server: 10.1.36-MariaDB
-- Versione PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `addtobag`
--

CREATE TABLE `addtobag` (
  `username` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `addtobag`
--

INSERT INTO `addtobag` (`username`, `id`) VALUES
('Luca', 28),
('Luca', 37),
('Luca', 38);

-- --------------------------------------------------------

--
-- Struttura della tabella `ads`
--

CREATE TABLE `ads` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `descrizione` varchar(255) DEFAULT NULL,
  `prezzo` float DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `ads`
--

INSERT INTO `ads` (`id`, `username`, `nome`, `descrizione`, `prezzo`, `foto`) VALUES
(28, 'GiuliaVerdi', 'Tazza', 'Tazza bianca con etichetta \'coffee\' nera, capienza 100ml, ideale per caffè, cappuccino, ginseng. Come nuova!!!', 10, 'https://cdn.pixabay.com/photo/2015/06/24/01/15/coffee-819362_150.jpg'),
(37, 'mela', 'libro', 'wjdfjiwdnfojd ', 10, 'https://cdn.pixabay.com/photo/2016/11/29/07/22/bible-1868070_150.jpg'),
(38, 'mela', 'orologio', 'jzhdjfsjfnvosjdn', 20, 'https://cdn.pixabay.com/photo/2017/11/27/07/02/time-2980690_150.jpg');

-- --------------------------------------------------------

--
-- Struttura della tabella `favorites`
--

CREATE TABLE `favorites` (
  `username` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `favorites`
--

INSERT INTO `favorites` (`username`, `id`) VALUES
('gigi', 28),
('Luca', 28),
('Luca', 38),
('mela', 28);

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `nome` varchar(50) DEFAULT NULL,
  `cognome` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `data_di_nascita` date DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`nome`, `cognome`, `email`, `data_di_nascita`, `username`, `password`) VALUES
('Luigi', 'Marroni', 'luigimarroni@gmail.com', '2000-06-04', 'gigi', 'Password0'),
('Gino', 'CGino', 'gc@gmail.com', '1999-08-02', 'gino', 'Password1'),
('Giovanni', 'Arancioni', 'giovanniarancioni@gmail.com', '1956-06-04', 'gio', 'Password0'),
('Giulia', 'Verdi', 'GiuliaVerdi@gmail.com', '1999-06-02', 'GiuliaVerdi', 'Password0'),
('Luca', 'Gialli', 'lucagialli@gmail.com', '2000-06-03', 'Luca', 'Password0'),
('Mario', 'Rossi', 'mariorossi@gmail.com', '1999-06-04', 'Mario_9', 'Password0'),
('Carmela', 'Bianca', 'carmelabianca@gmail.com', '2000-08-02', 'mela', 'Password0'),
('Bianca', 'Carmela', 'carmela.bianca.02@gmail.com', '2000-01-01', 'melakk', 'pssmkmk000'),
('giuseppe', 'pisasale', 'giu@gmail.com', '2001-09-07', 'pino', 'Password1');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `addtobag`
--
ALTER TABLE `addtobag`
  ADD PRIMARY KEY (`username`,`id`),
  ADD KEY `id_u` (`username`),
  ADD KEY `id_a` (`id`);

--
-- Indici per le tabelle `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_u` (`username`);

--
-- Indici per le tabelle `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`username`,`id`),
  ADD KEY `id_u` (`username`),
  ADD KEY `id_a` (`id`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `addtobag`
--
ALTER TABLE `addtobag`
  ADD CONSTRAINT `addtobag_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `addtobag_ibfk_2` FOREIGN KEY (`id`) REFERENCES `ads` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `ads`
--
ALTER TABLE `ads`
  ADD CONSTRAINT `ads_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`id`) REFERENCES `ads` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
