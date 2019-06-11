-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Giu 06, 2019 alle 20:41
-- Versione del server: 10.1.38-MariaDB
-- Versione PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tweb_db`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `auto`
--

CREATE TABLE `auto` (
  `id_auto` int(11) NOT NULL,
  `targa` varchar(10) NOT NULL,
  `marca` varchar(30) NOT NULL,
  `modello` varchar(30) NOT NULL,
  `segmento` varchar(30) NOT NULL,
  `alimentazione` varchar(30) DEFAULT NULL,
  `cilindrata` int(11) DEFAULT NULL,
  `potenza` float NOT NULL,
  `cavalli` int(11) DEFAULT NULL,
  `prezzo` float DEFAULT NULL,
  `colore` varchar(30) DEFAULT NULL,
  `n_posti` int(11) DEFAULT NULL,
  `immagine` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `auto`
--

INSERT INTO `auto` (`id_auto`, `targa`, `marca`, `modello`, `segmento`, `alimentazione`, `cilindrata`, `potenza`, `cavalli`, `prezzo`, `colore`, `n_posti`, `immagine`) VALUES
(1, 'AL743OM', 'Alfa Romeo', 'Giulia', 'Berlina sportiva', 'Diesel', 2143, 110, 150, 30, 'Bianco', 5, 'giulia.jpg'),
(2, 'AL745TE', 'Alfa Romeo', 'Stelvio', 'SUV', 'Diesel', 2143, 154, 210, 45, 'Rosso', 5, 'stelvio.jpg'),
(3, 'FR471AM', 'Lamborghini', 'Huracan', 'Supercar', 'Benzina', 5204, 449, 610, 120, 'Nero', 2, 'huracan.jpg'),
(4, 'CD439FA', 'Chevrolet', 'Camaro', 'Musclecar', 'Benzina', 6200, 333, 453, 55, 'Nero', 4, 'camaro.jpg'),
(5, 'FV391EL', 'Ford', 'Mustang', 'Musclecar', 'Benzina', 2200, 233, 317, 47, 'Blu', 4, 'mustang.jpg'),
(6, 'FP256SR', 'Lamborghini', 'Gallardo', 'Supercar', 'Benzina', 5200, 412, 560, 100, 'Giallo', 2, 'gallardo.jpg'),
(7, 'CV796KA', 'Fiat', 'Punto', 'Utilitaria', 'Benzina', 1242, 51, 69, 12, 'Rosso', 5, 'punto.jpg'),
(8, 'EK758JP', 'Fiat', 'Panda', 'Utilitaria', 'Benzina', 1242, 51, 69, 9, 'Arancione', 5, 'panda.jpg'),
(9, 'DI064NE', 'Lamborghini', 'Urus', 'SUV', 'Benzina', 3996, 478, 650, 88, 'Giallo', 5, 'urus.jpg'),
(10, 'FJ123XA', 'Ferrari', 'La Ferrari', 'Supercar', 'Benzina', 6200, 440, 800, 3000, 'Rosso', 2, 'laferrari.jpg'),
(11, 'FR456ZA', 'Mercedes-Benz', 'GT4', 'Supercar', 'Benzina', 4000, 360, 510, 2300, 'Nero', 2, 'gt4.jpg'),
(12, 'FN789FX', 'Maserati', 'Levante', 'SUV', 'Diesel', 3000, 257, 350, 2000, 'Blu notte', 5, 'levante.jpg');

-- --------------------------------------------------------

--
-- Struttura della tabella `faq`
--

CREATE TABLE `faq` (
  `id_faq` int(11) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `domanda` varchar(255) NOT NULL,
  `risposta` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `faq`
--

INSERT INTO `faq` (`id_faq`, `time_stamp`, `domanda`, `risposta`) VALUES
(1, '2019-06-04 15:27:12', 'Come funziona la questione carburante?', 'Le auto vengono fornite con il serbatoio pieno e vanno riconsegnate nelle medesime condizioni.'),
(2, '2019-06-04 15:27:12', 'Se prendo una multa come devo comportarmi?', 'La somma della multa verr? addebitata automaticamente sulla carta di credito fornita in fase di prenotazione.');

-- --------------------------------------------------------

--
-- Struttura della tabella `messaggio`
--

CREATE TABLE `messaggio` (
  `id_messaggio` int(11) NOT NULL,
  `id_mittente` int(11) NOT NULL,
  `id_destinatario` int(11) NOT NULL,
  `corpo` varchar(255) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `prenotazione`
--

CREATE TABLE `prenotazione` (
  `id_prenotazione` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL,
  `id_auto` int(11) NOT NULL,
  `data_inizio` date NOT NULL,
  `data_fine` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `id_utente` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `cognome` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `psw` varchar(30) NOT NULL,
  `data` date NOT NULL,
  `autenticazione` varchar(30) NOT NULL DEFAULT 'user',
  `residenza` varchar(30) NOT NULL,
  `occupazione` varchar(30) NOT NULL,
  `abilitato` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`id_utente`, `nome`, `cognome`, `username`, `email`, `psw`, `data`, `autenticazione`, `residenza`, `occupazione`, `abilitato`) VALUES
(7, 'simone', 'Cappella', '', 'ciao@ciao.it', 'ciaociao', '1997-11-21', 'user', 'SBT', 'altro', 1),
(8, '', '', 'admin', 'admin@admin.it', 'admin', '0000-00-00', 'admin', '', '', 1);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `auto`
--
ALTER TABLE `auto`
  ADD PRIMARY KEY (`id_auto`);

--
-- Indici per le tabelle `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id_faq`);

--
-- Indici per le tabelle `messaggio`
--
ALTER TABLE `messaggio`
  ADD PRIMARY KEY (`id_messaggio`);

--
-- Indici per le tabelle `prenotazione`
--
ALTER TABLE `prenotazione`
  ADD PRIMARY KEY (`id_prenotazione`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`id_utente`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `auto`
--
ALTER TABLE `auto`
  MODIFY `id_auto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT per la tabella `faq`
--
ALTER TABLE `faq`
  MODIFY `id_faq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `messaggio`
--
ALTER TABLE `messaggio`
  MODIFY `id_messaggio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `prenotazione`
--
ALTER TABLE `prenotazione`
  MODIFY `id_prenotazione` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `id_utente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
