CREATE DATABASE IF NOT EXISTS tweb_db;

USE tweb_db;

DROP TABLE IF EXISTS utente;

CREATE TABLE utente(
  id_utente INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  nome VARCHAR(30) NOT NULL,
  cognome VARCHAR(30) NOT NULL,
  email VARCHAR(30),
  psw VARCHAR(30) NOT NULL,
  data DATE NOT NULL,
  autenticazione ENUM('1','2','3','4') NOT NULL DEFAULT '1',
  residenza VARCHAR(30) NOT NULL,
  occupazione VARCHAR(30) NOT NULL,
  abilitato BOOLEAN NOT NULL DEFAULT 1
);

DROP TABLE IF EXISTS auto;

CREATE TABLE auto(
  id_auto INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  targa VARCHAR(10) NOT NULL,
  marca VARCHAR(30) NOT NULL,
  modello VARCHAR(30) NOT NULL,
  segmento VARCHAR(30) NOT NULL,
  alimentazione VARCHAR(30),
  cilindrata INT,
  potenza FLOAT NOT NULL,
  cavalli INT,
  prezzo FLOAT,
  colore VARCHAR(30),
  n_posti INT,
  immagine VARCHAR(60)
);

DROP TABLE IF EXISTS prenotazione;

CREATE TABLE prenotazione(
  id_prenotazione INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  id_utente INT NOT NULL REFERENCES Utente(id_utente),
  id_auto INT NOT NULL REFERENCES Auto(id_auto),
  data_inizio DATE NOT NULL,
  data_fine DATE NOT NULL,
  time_stamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  note VARCHAR(255)
);

DROP TABLE IF EXISTS messaggio;

CREATE TABLE messaggio(
  id_messaggio INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  id_mittente INT NOT NULL REFERENCES Utente(id_utente),
  id_destinatario INT NOT NULL REFERENCES Utente(id_utente),
  corpo VARCHAR(255) NOT NULL,
  time_stamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS faq;

CREATE TABLE faq(
  id_faq INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  time_stamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  domanda VARCHAR(255) NOT NULL,
  risposta VARCHAR(255) NOT NULL
);
