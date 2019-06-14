-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Giu 13, 2019 alle 14:40
-- Versione del server: 5.7.25
-- Versione PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

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
(2, '2019-06-04 15:27:12', 'Se prendo una multa come devo comportarmi?', 'La somma della multa verr? addebitata automaticamente sulla carta di credito fornita in fase di prenotazione.'),
(14, '2019-06-12 18:00:35', 'fadsf', 'gsfdgsd');

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

--
-- Dump dei dati per la tabella `messaggio`
--

INSERT INTO `messaggio` (`id_messaggio`, `id_mittente`, `id_destinatario`, `corpo`, `time_stamp`) VALUES
(1, 7, 8, 'Salve, prova messaggio', '2019-06-13 08:44:09'),
(2, 14, 8, 'ihh ihh ihhhhhhhh', '2019-06-13 07:00:48'),
(3, 14, 8, 'salve a tutti', '2019-06-13 07:01:14');

-- --------------------------------------------------------

--
-- Struttura della tabella `prenotazione`
--

CREATE TABLE `prenotazione` (
  `id_prenotazione` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL,
  `id_auto` int(11) NOT NULL,
  `data_inizio` date NOT NULL,
  `data_fine` date NOT NULL,
  `costo` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `prenotazione`
--

INSERT INTO `prenotazione` (`id_prenotazione`, `id_utente`, `id_auto`, `data_inizio`, `data_fine`, `costo`) VALUES
(1, 7, 2, '2019-06-17', '2019-06-18', 960);

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `prospetto`
-- (Vedi sotto per la vista effettiva)
--
CREATE TABLE `prospetto` (
`mese` int(2)
,`num_auto` bigint(21)
);

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `prospettostaff`
-- (Vedi sotto per la vista effettiva)
--
CREATE TABLE `prospettostaff` (
`id_auto` int(11)
,`targa` varchar(10)
,`marca` varchar(30)
,`modello` varchar(30)
,`id_utente` int(11)
,`nome` varchar(30)
,`cognome` varchar(30)
,`id_prenotazione` int(11)
,`data_inizio` date
,`data_fine` date
);

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `sender`
-- (Vedi sotto per la vista effettiva)
--
CREATE TABLE `sender` (
`id_mittente` int(11)
,`username` varchar(30)
);

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `id_utente` int(11) NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `cognome` varchar(30) DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `psw` varchar(30) NOT NULL,
  `data` date DEFAULT NULL,
  `autenticazione` varchar(30) NOT NULL DEFAULT 'user',
  `residenza` varchar(30) DEFAULT NULL,
  `occupazione` varchar(30) DEFAULT NULL,
  `abilitato` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`id_utente`, `nome`, `cognome`, `username`, `email`, `psw`, `data`, `autenticazione`, `residenza`, `occupazione`, `abilitato`) VALUES
(7, 'simone', 'Cappella', 'ciao', 'ciao@ciao.it', 'ciaociao', '1997-11-21', 'user', 'SBT', 'altro', 1),
(8, NULL, NULL, 'admin', 'admin@admin.it', 'admin', NULL, 'admin', NULL, NULL, 1),
(11, 'manuel', 'Manelli', 'manuel', NULL, 'manuel', NULL, 'staff', NULL, NULL, 1),
(12, 'manuel', 'Manelli', 'manuel97', NULL, 'manuel', NULL, 'staff', NULL, NULL, 1),
(13, 'staff', 'staff', 'staff', NULL, 'staff', NULL, 'staff', NULL, NULL, 1),
(14, 'paolino', 'paperino', 'paolopap', 'pp@p.it', 'paolopap', '1987-04-12', 'user', 'Paradiso', 'altro', 1);

-- --------------------------------------------------------

--
-- Struttura per vista `prospetto`
--
DROP TABLE IF EXISTS `prospetto`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `prospetto`  AS  select month(`prenotazione`.`data_inizio`) AS `mese`,count(`prenotazione`.`id_auto`) AS `num_auto` from `prenotazione` where (year(`prenotazione`.`data_inizio`) = year(curdate())) group by month(`prenotazione`.`data_inizio`) order by month(`prenotazione`.`data_inizio`) ;

-- --------------------------------------------------------

--
-- Struttura per vista `prospettostaff`
--
DROP TABLE IF EXISTS `prospettostaff`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `prospettostaff`  AS  select `a`.`id_auto` AS `id_auto`,`a`.`targa` AS `targa`,`a`.`marca` AS `marca`,`a`.`modello` AS `modello`,`u`.`id_utente` AS `id_utente`,`u`.`nome` AS `nome`,`u`.`cognome` AS `cognome`,`p`.`id_prenotazione` AS `id_prenotazione`,`p`.`data_inizio` AS `data_inizio`,`p`.`data_fine` AS `data_fine` from ((`auto` `a` join `prenotazione` `p` on((`a`.`id_auto` = `p`.`id_auto`))) join `utente` `u` on((`p`.`id_utente` = `u`.`id_utente`))) ;

-- --------------------------------------------------------

--
-- Struttura per vista `sender`
--
DROP TABLE IF EXISTS `sender`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sender`  AS  select distinct `m`.`id_mittente` AS `id_mittente`,`u`.`username` AS `username` from (`messaggio` `m` join `utente` `u` on((`m`.`id_mittente` = `u`.`id_utente`))) ;

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
  MODIFY `id_faq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT per la tabella `messaggio`
--
ALTER TABLE `messaggio`
  MODIFY `id_messaggio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `prenotazione`
--
ALTER TABLE `prenotazione`
  MODIFY `id_prenotazione` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `id_utente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
