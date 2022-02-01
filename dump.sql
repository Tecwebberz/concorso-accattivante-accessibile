-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 01, 2022 at 07:32 PM
-- Server version: 10.3.32-MariaDB-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elpasqua`
--
CREATE DATABASE IF NOT EXISTS `elpasqua` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `elpasqua`;

-- --------------------------------------------------------

--
-- Table structure for table `Carousel`
--

CREATE TABLE `Carousel` (
  `image` int(11) NOT NULL,
  `bound_entity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Carousel`
--

INSERT INTO `Carousel` (`image`, `bound_entity`) VALUES
(2, 2),
(3, 1),
(5, 1),
(6, 1),
(6, 4),
(7, 1),
(7, 4),
(8, 2),
(8, 5),
(9, 2),
(9, 4),
(9, 6),
(10, 5),
(11, 5),
(12, 3),
(12, 5),
(13, 3),
(14, 3),
(14, 4),
(15, 3),
(15, 6),
(18, 2),
(18, 6),
(19, 6);

-- --------------------------------------------------------

--
-- Table structure for table `Course`
--

CREATE TABLE `Course` (
  `id_corso` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `cfu` tinyint(2) NOT NULL,
  `propedeutici` text NOT NULL,
  `anno` tinyint(1) NOT NULL,
  `periodo` tinyint(1) NOT NULL,
  `lingua` varchar(3) NOT NULL,
  `responsabile` varchar(255) NOT NULL,
  `email_resp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Course`
--

INSERT INTO `Course` (`id_corso`, `name`, `description`, `cfu`, `propedeutici`, `anno`, `periodo`, `lingua`, `responsabile`, `email_resp`) VALUES
(1, 'Programmazione', 'Corso base di programmazione in <abbr lang=\"en\" title=\"C plus plus\">C++</abbr>. Specificare un problema tramite pre e post condizioni e saperne dimostrare la correttezza.', 9, 'Nessuno', 1, 2, 'ITA', 'Giovanni Da San Martino', 'giovanni.dasanmartino@unipd.it'),
(2, 'Analisi Matematica', 'Il corso si propone di illustrare i concetti e gli strumenti dell’Analisi per funzioni di una variabile reale, dando particolare rilievo agli aspetti di base del calcolo integro-differenziale e ai suoi aspetti logico-deduttivi.', 12, 'Nessuno', 1, 1, 'ITA', 'Francescopaolo Montefalcone', 'francescopaolo.montefalcone@unipd.it'),
(3, 'Architettura degli Elaboratori', 'Conoscenze di base funzionali e tecnologiche riguardanti l’architettura degli elaboratori: struttura, gestione della memoria, dispositivi e gestione di <abbr lang=\"en\" title=\"Input Output\">I/O</abbr>', 8, 'Nessuno', 1, 1, 'ITA', 'Alessandro Sperduti', 'alessandro.sperduti@unipd.it'),
(4, 'Logica', 'Introduzione alla logica per esprimere un enunciato tramite una formula di un linguaggio formale e dimostrazione tramite derivazione in un sistema assiomatico', 6, 'Nessuno', 1, 1, 'ITA', 'Maria Emilia Maietti', 'mariaemilia.maietti@unipd.it'),
(5, 'Algebra e Matematica Discreta', 'Introduzione alle conoscenze di base riguardanti l’algebra, la geometria e la matematica discreta', 12, 'Nessuno', 1, 2, 'ITA', 'Gemma Parmeggiani', 'gemma.parmeggiani@unipd.it'),
(6, 'Sistemi Operativi', 'Introduzione alle funzionalità di base dei moderni sistemi operativi. Processi e <span lang=\"en\">thread</span>, sincronizzazione e ordinamento. Allocazione delle memoria e gestione dei <span lang=\"en\">file</span> e <span lang=\"en\">filesystem</span>', 9, 'Nessuno', 1, 2, 'ITA', 'Claudio Enrico Palazzi', 'claudio.palazzi@unipd.it'),
(7, 'Algoritmi e Strutture Dati', 'Introduzione agli algoritmi e alla loro analisi, alle strutture dati fondamentali alla base dello sviluppo di sistemi <span lang=\"en\">software</span>', 9, 'Nessuno', 2, 1, 'ITA', 'Paolo Baldan', 'paolo.baldan@unipd.it'),
(8, '<span lang=\"en\">Cybersecurity: Principles and Practice</span>', 'Concetti base di sicurezza e conoscenza di sicurezza di sistema in ambiente <span lang=\"en\">Linux, Windows e Android</span> di reti <span lang=\"en\">wireless e wired</span> e <span lang=\"en\">web-application security</span>', 6, 'Nessuno', 4, 1, 'ENG', 'Mauro Conti', 'mauro.conti@unipd.it'),
(9, 'Probabilità e Statistica', 'Introduzione agli strumenti di base del calcolo delle probabilità e della statistica inferenziale. Costruire semplici modelli probabilistici di fenomeni aleatori ed effettuare relativi calcoli', 6, 'Nessuno', 2, 1, 'ITA', 'Markus Fischer', 'markus.fischer@unipd.it'),
(10, 'Programmazione a Oggetti', 'Corso di programmazione orientata agli oggetti. Il linguaggio di riferimento rimane <abbr lang=\"en\" title=\"C plus plus\">C++</abbr>. Al termine del corso è richiesto lo sviluppo di un progetto <span lang=\"en\">software</span>.', 10, 'Programmazione', 2, 1, 'ITA', 'Francesco Ranzato', 'francesco.ranzato@unipd.it'),
(11, 'Reti di Calcolatori', 'Corso che intende offrire una panoramica a tutto tondo delle nozioni base che costituiscono il grande mondo delle reti, cercando di caprie non solo la loro struttura ma i motivi alla base del loro funzionamento.', 9, 'Nessuno', 2, 1, 'ITA', 'Massimo Marchiori', 'massimo.marchiori@unipd.it'),
(12, 'Automi e Linguaggi Formali', 'Fornisce i concetti fondamentali della teoria degli automi e dei linguaggi formali. Inoltre, introduce le nozioni di indecidibilità e intrattabilità.', 6, 'Nessuno', 2, 2, 'ITA', 'Davide Bresolin', 'davide.bresolin@unipd.it'),
(13, 'Basi di Dati', 'Conoscenze di base riguardanti le funzionalità dei <abbr lang=\"en\" title=\"Database Management Systems\">DBMS</abbr>, la progettazione delle basi di dati mediante l’uso di modelli concettuali, il progetto logico mediante il modello relazionale dei dati e l’uso del linguaggio <abbr lang=\"en\" title=\"Sequel\">SQL</abbr> per la definizione e la realizzazione di basi di dati', 9, 'Nessuno', 2, 2, 'ITA', 'Massimiliano De Leoni', 'massimiliano.deleoni@unipd.it'),
(14, 'Calcolo Numerico', 'Apprendere le basi del calcolo numerico in vista delle applicazioni in campo scientifico e tecnologico, con particolare attenzione ai concetti di errore, discretizzazione, approssimazione, convergenza, stabilità, costo computazionale.', 6, 'Analisi Matematica, Algebra e Matematica Discreta', 2, 2, 'ITA', 'Marco Vianello', 'marco.vianello@unipd.it'),
(15, 'Diritto, Informatica e Società', 'Il corso si propone di introdurre gli studenti di informatica agli aspetti giuridici legati alle professioni di riferimento. Diritti degli individui quali <span lang=\"en\">privacy</span>, auto-determinazione, integrità personale e come la valutazione del rischio di una violazione di questi. Verrà fornito un quadro generale in materia di <span lang=\"en\">governance</span>, responsabilità, ricerca e innovazione, <span lang=\"en\">privacy by design</span>, <abbr lang=\"en\" title=\"General Data Protection Regulation\">GDPR</abbr>.', 6, 'Nessuno', 4, 2, 'ITA', 'Andrea Sitzia', 'andrea.sitzia@unipd.it'),
(16, 'Introduzione all’Apprendimento Automatico', 'Il corso presenta i concetti e gli algoritmi fondamentali dell’Apprendimento Automatico, cioè quella classe di tecniche ed algoritmi che a partire dai dati consentono di acquisire nuova conoscenza. Questi sono particolarmente utili per tutti quei problemi per cui è impossibile, o molto difficile, pervenire ad una formalizzazione utilizzabile per la definizione di una soluzione algoritmica ad hoc.', 6, 'Nessuno', 4, 2, 'ITA', 'Lamberto Ballan', 'lamberto.ballan@unipd.it'),
(17, 'Metodi e Tecnologie per lo sviluppo <span lang=\"en\">software</span>', 'Corso che intende fornire agli studenti un bagaglio di esperienza base per la gestione tecnologica di un progetto <span lang=\"en\">software</span> e la definizione e l’implementazione di una <span lang=\"en\">continuous delivery pipeline</span>.', 6, 'Nessuno', 4, 2, 'ITA', 'Nicola Bertazzo', 'nicola.bertazzo@unipd.it'),
(18, 'Paradigmi di programmazione', 'Riconoscere le principali difficoltà legate alla costruzione di programmi e sistemi concorrenti e distribuiti; capire le limitazioni intrinseche dei vari approcci ed interpretare le garanzie fornite dai diversi strumenti in funzione dei requisiti del problema affrontato.', 6, 'Nessuno', 4, 2, 'ITA', 'Michele Mauro', 'michele.mauro@unipd.it'),
(19, 'Tecnologie <span lang=\"en\">web</span>', 'L’insegnamento intende presentare agli studenti il <span lang=\"en\">World-Wide Web</span> e le tecnologie informatiche che lo caratterizzano. Ha lo scopo di fornire le conoscenze necessarie per la progettazione e lo sviluppo di siti <span lang=\"en\">web</span> di qualità con l’uso delle tecnologie più avanzate. Gli studenti, oltre ad acquisire una conoscenza di alto livello dei vari tipi di tecnologie <span lang=\"en\">web</span> esistenti, verranno formati a divenire sviluppatori di siti <span lang=\"en\">web</span> basati sui i linguaggi <span lang=\"en\">standard<span>.', 9, 'Basi di Dati, Programmazione', 3, 1, 'ITA', 'Ombretta Gaggi', 'ombretta.gaggi@unipd.it'),
(20, 'Ingegneria del <span lang=\"en\">Software</span>', 'Corso che intende fornire agli studenti le conoscenze di base della progessione di <span lang=\"en\">software engineer</span> e confronta gli studenti con attività pratica esperienziale collaborativa tramite un sostazioso progetto didattico.', 13, 'Programmazione a Oggetti, Basi di Dati', 3, 1, 'ITA', 'Tullio Vardanega', 'tullio.vardanega@unipd.it'),
(21, 'Ricerca Operativa', 'Costruzione di modelli matematici per il supporto alle decisioni e relativi algoritmi, con particolare riferimento alla programmazione lineare nel continuo e nel discreto e all’ottimizzazione su grafi. Uso di pacchetti <span lang=\"en\">software</span> per la soluzione di problemi di ottimizzazione.', 7, 'Algebra e Matematica Discreta', 3, 1, 'ITA', 'Luigi De Giovanni', 'luigi.degiovanni@unipd.it'),
(22, 'Lingua Inglese B2 (Abilità Ricettive)', 'Corso che permette di ottenere una certificazione <abbr title=\"Test di Abilità Linguistica\">TAL</abbr> tramite il <abbr title=\"Centro Linguistico di Ateneo\">CLA</abbr>. Chi è già in possesso di una certificazione di livello B2 o superiore può chiederne il riconoscimento', 3, 'Nessuno', 1, 3, 'ENG', 'Massimo Marchiori', 'massimo.marchiori@unipd.it'),
(23, '<span lang=\"en\">Stage</span>', 'Attività di tirocinio obbligatorio, di durata equivalente a 8 settimane di lavoro a tempo pieno, da svolgersi presso una organizzazione esterna al corso di studio, sotto lo supervisione di un tutor dell`ente ospitante. La redazine di una relazione finale delle attività svolte in stage sostituisce la tesi di laurea da presentare all`esame finale. Per studenti lavoratori che abbiamo difficoltà con la logistica di un tirocinio canonico, viene previsto un tirocinio interno, un docente del corso di studi svolge il ruolo di tutor.', 3, 'Nessuno', 3, 2, 'ITA', 'Tullio Vardanega', 'tullio.vardanega@unipd.it'),
(24, 'Prova Finale', 'Il percorso di studi prevede la redazione di una relazione che riassume e discute in modo critico l’attività relativa allo <span lang=\"fr\">stage</span>. La prova finale consiste quindi nella presentazione e discussione di tale relazione di fronte alla Commissione per l’esame finale di Laurea.', 3, 'Nessuno', 3, 3, 'ITA', 'Nessuno', '');

-- --------------------------------------------------------

--
-- Table structure for table `Image`
--

CREATE TABLE `Image` (
  `id` int(11) NOT NULL,
  `path` varchar(50) NOT NULL,
  `alt` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Image`
--

INSERT INTO `Image` (`id`, `path`, `alt`) VALUES
(1, 'foto_aule/jappelli.webp', 'Tanti tavoli dove studiare al caldo e vicini ma in silenzio'),
(2, 'foto_aule/pollaio.webp', 'Un\'aula con tante prese di corrente e un\'uscita di emergenza comoda'),
(3, 'foto_aule/aula_studio00001.webp', 'In quest\'aula sono presenti tanti libri divisi in scaffali'),
(5, 'foto_aule/aula_studio00003.webp', 'sono disponibili libri antichi in esposizioni variegate'),
(6, 'foto_aule/aula_studio00004.webp', 'È presente un tavolo per organizzare meeting con il tuo gruppo di studio'),
(7, 'foto_aule/aula_studio00005.webp', 'È presente una libreria ordinata piena di libri utili'),
(8, 'foto_aule/aula_studio00006.webp', 'Un tavolo ampio e pulito per studiare in tranquillità'),
(9, 'foto_aule/aula_studio00007.webp', 'Tante sedie per organizzare convegni con i tuoi amici'),
(10, 'foto_aule/aula_studio00008.webp', 'Tanti libri da leggere'),
(11, 'foto_aule/aula_studio00009.webp', 'Un ufficio personale per studiare in assoluto silenzio'),
(12, 'foto_aule/aula_studio00010.webp', 'Sono disponibili degli scaffali in cui puoi trovare molti libri'),
(13, 'foto_aule/aula_studio00011.webp', 'Un accogliente sottoscala caldo e stracolmo di libri da sfogliare'),
(14, 'foto_aule/aula_studio00012.webp', 'Tanti busti di persone illustri nella biblioteca maggiore'),
(15, 'foto_aule/aula_studio00013.webp', 'Un\'aula studio con molti tavoli per studiare in compagnia'),
(18, 'foto_aule/aula_studio00014.webp', 'Tunnel di libri in cui perdersi pensando al futuro'),
(19, 'foto_aule/asta.webp', 'Sono disponibili tante prese, tanti tavoli e tante finestre.');

-- --------------------------------------------------------

--
-- Table structure for table `Iscrizioni_corsi`
--

CREATE TABLE `Iscrizioni_corsi` (
  `utente` varchar(255) NOT NULL,
  `corso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Openings`
--

CREATE TABLE `Openings` (
  `id_opening` int(11) NOT NULL,
  `opening_time` time NOT NULL,
  `opening_weekday` int(11) NOT NULL DEFAULT 1 COMMENT 'da 1 a 7',
  `closing_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Review_course`
--

CREATE TABLE `Review_course` (
  `id_recensione` int(11) NOT NULL,
  `utente_recensore` varchar(255) NOT NULL,
  `testo` text NOT NULL,
  `voto` int(1) NOT NULL,
  `course` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Review_course`
--

INSERT INTO `Review_course` (`id_recensione`, `utente_recensore`, `testo`, `voto`, `course`) VALUES
(37, 'user', 'Bel Corso!', 5, 19),
(38, 'alecsferra', 'Ho conosciuto Alessandro Massarenti proprio grazie a questo corso, ho detto tutto... Per&ograve; il prof &egrave; bravo dai!!', 4, 12),
(39, 'alecsferra', 'alert(&quot;XSS&quot;);', 5, 8),
(40, 'alecsferra', '&quot;; DROP DATABASE; --', 5, 8),
(41, 'alecsferra', 'Sono scivolato sulle lacrime degli studenti che hanno seguito questo corso!', 2, 2),
(42, 'alecsferra', '1 CFU per il laboratorio? 42 mila sarebbero pi&ugrave; adatii!', 2, 14),
(43, 'elpasqua', ':) :)', 5, 19),
(44, 'elpasqua', 'Difficilissimo', 1, 22),
(45, 'elpasqua', 'Dopo questo corso &egrave; tutta in discesa... rotolando', 1, 2),
(46, 'elpasqua', 'Va seguito con i giusti occhiali', 3, 11),
(48, 'elpasqua', 'Bellissimo matlab, credo sia il mio nuovo linguaggio preferito', 5, 14),
(49, 'elpasqua', 'Il corso &egrave; tenuto in tedesco', 5, 9);

-- --------------------------------------------------------

--
-- Table structure for table `Review_studyroom`
--

CREATE TABLE `Review_studyroom` (
  `id_recensione` int(11) NOT NULL,
  `utente_recensore` varchar(255) NOT NULL,
  `testo` text NOT NULL,
  `voto` int(1) NOT NULL,
  `study_room` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Review_studyroom`
--

INSERT INTO `Review_studyroom` (`id_recensione`, `utente_recensore`, `testo`, `voto`, `study_room`) VALUES
(18, 'user', 'Bah c\'&egrave; sempre molto baccano', 2, 4),
(19, 'alecsferra', 'Comoda sei dopo aver studiato vuoi prenderti un cappuccino alla menta!', 5, 6),
(20, 'elpasqua', ':\'(', 5, 6),
(21, 'elpasqua', 'Puzza', 1, 5),
(22, 'elpasqua', 'Mi manca', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `Study_room`
--

CREATE TABLE `Study_room` (
  `id_aula` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `seats` int(11) NOT NULL,
  `reservation_required` tinyint(1) NOT NULL,
  `position` point NOT NULL,
  `haswifi` tinyint(1) NOT NULL,
  `shordesc` text NOT NULL,
  `mainimage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Study_room`
--

INSERT INTO `Study_room` (`id_aula`, `name`, `description`, `address`, `seats`, `reservation_required`, `position`, `haswifi`, `shordesc`, `mainimage`) VALUES
(1, 'Jappelli', 'Aula grande e tranquilla dove è quasi sempre possibile trovare posto. Dotata di <span lang=\"en\">WiFi (eduroam)</span> e aria condizionata\r\n', 'Via Jappelli 9', 184, 1, 0x000000000101000000af708e0b45b4464048da074622c52740, 0, 'Aula grande e molto frequentata', 1),
(2, 'Lab Wifi', 'Conosciuta anche <em>Lab Wifi</em>, situata all\'interno del Lab104 del <abbr title=\"Dipartimento di Fisica e Astronomia\">DFA</abbr>. Al piano terra entrando da Via Belzoni, al secondo entrando da Via Paolotti. Dotata di <span lang=\"en\">WiFi (eduroam)</span> e prese di corrente.', 'Edificio Paolotti, Via Belzoni 7', 52, 0, 0x000000000101000000a943e8074ab446400a5387e1eec52740, 1, 'Piccolo e tranquillo laboratorio', 3),
(3, 'Serra', 'Parallela al Pollaio, la <em>Serra</em> è un\'aula sempre situata in Paolotti. Dotata di prese di corrente e copertura <span lang=\"en\">WiFi (eduroam)</span>, con aria condizionata.', 'Edificio Paolotti, Via Belzoni 7', 32, 0, 0x000000000101000000a943e8074ab446400a5387e1eec52740, 1, 'Aula laterale del Paolotti', 11),
(4, 'Pollaio/Acquario', 'Aula studio gestita dagli studenti. Si trova all\'interno del Paolotti. Divisa in due zona, <em>Pollaio</em> e <em>Acquario</em>, in quest\'ultima è possibile creare dei piccoli gruppi e parlare (rispettando gli altri presenti). Dotata di prese di corrente e copertura <span lang=\"en\">WiFi (eduroam)</span>, con aria condizionata e alcune lavagne in Acquario.', 'Edificio Paolotti, Via Belzoni 7', 100, 1, 0x000000000101000000a943e8074ab446400a5387e1eec52740, 1, 'Aule autogestite', 5),
(5, 'Ex Fiat', 'Aula grande e spaziosa, situata vicino alle aule del Dipartimento di Psicologia. Dotata di <span lang=\"en\">WiFi (eduroam)</span>\r\n', 'Via Venezia 13, Padova', 240, 0, 0x0000000001010000000e9ad6fdc1b44640df0af6fc1cca2740, 1, 'Punto di ritrovo per molti studenti', 9),
(6, '<abbr title=\"Aula Studio Torre Archimede\">ASTA</abbr>', 'Aula Studio di Torre Archimede, dotata di prese di corrente ad ogni banco, <span lang=\"en\">WiFi (eduroam)</span> e rete di dipartimento Studenti.Math.UniPD.it. Per l\'accesso è necessario richiedere l\'attivazione del badge tramite una mail all\'indirizzo <a href = \"mailto:asta@math.unipd.it\">asta@math.unipd.it</a> dal proprio account istituzionale indicando cognome, nome e matricola.', 'Torre Archimede, Via Trieste 63', 80, 1, 0x0000000001010000001b220157a6b4464071800b3a79c62740, 1, 'Aula di riferimento in Torre Archimede', 6);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `username` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cognome` varchar(255) NOT NULL,
  `anno_iscrizione` year(4) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`username`, `nome`, `cognome`, `anno_iscrizione`, `password`, `role`) VALUES
('admin', 'Utente', 'Amministratore', 2007, '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 1),
('alecsferra', 'Alessio', 'Ferrarini', 2019, '0545ab95476b8f4cd7f43941db50a9ead7306b02a6c9df40b4b9bcfd868f34ff', 0),
('elpasqua', 'Elia', 'Pasquali', 2019, 'b03ddf3ca2e714a6548e7495e2a03f5e824eaac9837cd7f159c67b90fb4b7342', 0),
('mrossi1678', 'Mario', 'Rossi', 2022, '8e48ae780722dcfcedcdc1a1a9ebb6adcef7bab1f8b2e4751efb20f385f8b07c', 0),
('user', 'Utente', 'Normale', 2018, '04f8996da763b7a969b1028ee3007569eaf3a635486ddab211d512c85b9df8fb', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Carousel`
--
ALTER TABLE `Carousel`
  ADD UNIQUE KEY `image` (`image`,`bound_entity`),
  ADD KEY `bound_carousel` (`bound_entity`);

--
-- Indexes for table `Course`
--
ALTER TABLE `Course`
  ADD PRIMARY KEY (`id_corso`);

--
-- Indexes for table `Image`
--
ALTER TABLE `Image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Iscrizioni_corsi`
--
ALTER TABLE `Iscrizioni_corsi`
  ADD UNIQUE KEY `utente` (`utente`,`corso`),
  ADD KEY `corso_id_corso_fk` (`corso`);

--
-- Indexes for table `Openings`
--
ALTER TABLE `Openings`
  ADD PRIMARY KEY (`id_opening`);

--
-- Indexes for table `Review_course`
--
ALTER TABLE `Review_course`
  ADD PRIMARY KEY (`id_recensione`),
  ADD KEY `course_review` (`course`),
  ADD KEY `user_review` (`utente_recensore`);

--
-- Indexes for table `Review_studyroom`
--
ALTER TABLE `Review_studyroom`
  ADD PRIMARY KEY (`id_recensione`),
  ADD KEY `review_studyroom` (`study_room`),
  ADD KEY `review_user` (`utente_recensore`);

--
-- Indexes for table `Study_room`
--
ALTER TABLE `Study_room`
  ADD PRIMARY KEY (`id_aula`),
  ADD KEY `mainimage` (`mainimage`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Image`
--
ALTER TABLE `Image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `Openings`
--
ALTER TABLE `Openings`
  MODIFY `id_opening` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Review_course`
--
ALTER TABLE `Review_course`
  MODIFY `id_recensione` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `Review_studyroom`
--
ALTER TABLE `Review_studyroom`
  MODIFY `id_recensione` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `Study_room`
--
ALTER TABLE `Study_room`
  MODIFY `id_aula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Carousel`
--
ALTER TABLE `Carousel`
  ADD CONSTRAINT `bound_carousel` FOREIGN KEY (`bound_entity`) REFERENCES `Study_room` (`id_aula`),
  ADD CONSTRAINT `img_carousel` FOREIGN KEY (`image`) REFERENCES `Image` (`id`);

--
-- Constraints for table `Iscrizioni_corsi`
--
ALTER TABLE `Iscrizioni_corsi`
  ADD CONSTRAINT `corso_id_corso_fk` FOREIGN KEY (`corso`) REFERENCES `Course` (`id_corso`),
  ADD CONSTRAINT `utente_e-mail_fk` FOREIGN KEY (`utente`) REFERENCES `User` (`username`);

--
-- Constraints for table `Review_course`
--
ALTER TABLE `Review_course`
  ADD CONSTRAINT `course_review` FOREIGN KEY (`course`) REFERENCES `Course` (`id_corso`),
  ADD CONSTRAINT `user_review` FOREIGN KEY (`utente_recensore`) REFERENCES `User` (`username`);

--
-- Constraints for table `Review_studyroom`
--
ALTER TABLE `Review_studyroom`
  ADD CONSTRAINT `review_studyroom` FOREIGN KEY (`study_room`) REFERENCES `Study_room` (`id_aula`),
  ADD CONSTRAINT `review_user` FOREIGN KEY (`utente_recensore`) REFERENCES `User` (`username`);

--
-- Constraints for table `Study_room`
--
ALTER TABLE `Study_room`
  ADD CONSTRAINT `Study_room_ibfk_1` FOREIGN KEY (`mainimage`) REFERENCES `Image` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
