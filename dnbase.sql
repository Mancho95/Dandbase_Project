-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Mag 03, 2018 alle 17:08
-- Versione del server: 10.1.21-MariaDB
-- Versione PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dnbase`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `avventura`
--

CREATE TABLE `avventura` (
  `cod_avventura` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `descrizione` text NOT NULL,
  `versione` varchar(10) NOT NULL,
  `file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `avventura`
--

INSERT INTO `avventura` (`cod_avventura`, `username`, `nome`, `descrizione`, `versione`, `file`) VALUES
(8, 'admin', 'eeeer', 'reeeeeeeeeeeeeee', 'Pathfinder', 'Resource id #14'),
(9, 'admin', 'rererere', 'dadsacs', '3', 'Resource id #14'),
(10, 'mancho', 'Prova avventura', 'Questa avventura parla di un tempio  maledetto, ambientato nel medioevo', 'Pathfinder', 'Resource id #14');

-- --------------------------------------------------------

--
-- Struttura della tabella `commento`
--

CREATE TABLE `commento` (
  `cod_commento` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `cod_avventura` int(11) NOT NULL,
  `testo` text NOT NULL,
  `upvote` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `username` varchar(20) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `cognome` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabella contenente info sugli user';

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`username`, `nome`, `cognome`, `password`, `email`) VALUES
('admin', 'Paperino', 'Disney', 'pippo', ''),
('asdsada', 'dsdasads', 'dsaads', 'da', 'dsadas'),
('ciro', 'ciro', 'ciro', 'ciro', 'ciro'),
('lezzo', 'lezzo', 'lezzo', 'lezzo', 'lezzo'),
('mancho', 'francesco', 'mancini', 'vapor', 'ff');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `avventura`
--
ALTER TABLE `avventura`
  ADD PRIMARY KEY (`cod_avventura`);

--
-- Indici per le tabelle `commento`
--
ALTER TABLE `commento`
  ADD PRIMARY KEY (`cod_commento`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `avventura`
--
ALTER TABLE `avventura`
  MODIFY `cod_avventura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT per la tabella `commento`
--
ALTER TABLE `commento`
  MODIFY `cod_commento` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
