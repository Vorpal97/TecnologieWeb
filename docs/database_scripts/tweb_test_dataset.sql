--#############################################################################
--
-- TWEB DB SOURCE CODE
--
--   grp_10
--
--   Designed and written by Manuel Manelli on 25 of may 2019
--
--   Define schema
--
--#############################################################################

INSERT INTO Auto
  (targa,marca,modello,segmento,alimentazione,cilindrata,potenza,cavalli,prezzo,colore,n_posti,immagine)
VALUES
  ("FJ123XA", "Ferrari", "La Ferrari", "Supercar", "Benzina", 6200, 440, 800, 3000, "Rosso", 2, "laferrari.jpg"),
  ("FR456ZA", "Mercedes-Benz", "GT4", "Supercar", "Benzina", 4000, 360, 510, 2300, "Nero", 2, "gt4.jpg"),
  ("FN789FX", "Maserati", "Levante", "SUV", "Diesel", 3000, 257,350, 2000, "Blu notte", 5, "levante.jpg");

INSERT INTO Utente
  (nome, cognome, email, psw, nascita, autenticazione)
VALUES
  ("Mario", "Rossi", "m.rossi@gmail.com", "mrossi", STR_TO_DATE('1-01-1968', '%d-%m-%Y'),1),
  ("Luigi", "Verdi", "luigiv@ymail.com", "luve", STR_TO_DATE('14-09-1977', '%d-%m-%Y'),1),
  ("Admin", "Admin", "NA", "admin", STR_TO_DATE('1-01-1968', '%d-%m-%Y'),1);

INSERT INTO Prenotazione
  (id_utente,id_auto,data_inizio,data_fine)
VALUES
  (1,3,STR_TO_DATE('24-05-2019', '%d-%m-%Y'),STR_TO_DATE('27-05-2019', '%d-%m-%Y')),
  (2,1,STR_TO_DATE('20-05-2019', '%d-%m-%Y'),STR_TO_DATE('26-05-2019', '%d-%m-%Y'));

INSERT INTO Messaggio
  (id_mittente,id_destinatario,corpo)
VALUES
  (1,3,"Salve, avrei la necessità che la macchina sia dotata di pneumatici invernali"),
  (3,1,"Salve a lei, le nostre vetture sono al momento dotate tutte di pneumatici adatti alla stagione in corso");

INSERT INTO Faq
  (domanda,risposta)
VALUES
  ("Come funziona la questione carburante?","Le auto vengono fornite con il serbatoio pieno e vanno riconsegnate nelle medesime condizioni."),
  ("Se prendo una multa come devo comportarmi?","La somma della multa verrà addebitata automaticamente sulla carta di credito fornita in fase di prenotazione.");
  
