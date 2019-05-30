-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 30 Maj 2019, 10:42
-- Wersja serwera: 10.1.38-MariaDB
-- Wersja PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `mydb`
--

DELIMITER $$
--
-- Procedury
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `menu` (IN `id` INT)  READS SQL DATA
SELECT * from pizze, napoje$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kalkulator`
--

CREATE TABLE `kalkulator` (
  `a` double DEFAULT NULL,
  `b` double DEFAULT NULL,
  `c` double DEFAULT NULL,
  `d` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `total2` double DEFAULT NULL,
  `suma` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kelner`
--

CREATE TABLE `kelner` (
  `idKelner` int(11) NOT NULL,
  `idUzytkownika` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `kelner`
--

INSERT INTO `kelner` (`idKelner`, `idUzytkownika`) VALUES
(1, 4);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kucharz`
--

CREATE TABLE `kucharz` (
  `idKucharz` int(11) NOT NULL,
  `idUzytkownika` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `kucharz`
--

INSERT INTO `kucharz` (`idKucharz`, `idUzytkownika`) VALUES
(1, 2),
(0, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `listanapojow`
--

CREATE TABLE `listanapojow` (
  `id` int(11) NOT NULL,
  `idZamowienie` int(11) NOT NULL,
  `idNapoj` int(11) NOT NULL,
  `ilosc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `listanapojow`
--

INSERT INTO `listanapojow` (`id`, `idZamowienie`, `idNapoj`, `ilosc`) VALUES
(11, 61, 3, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `listapizz`
--

CREATE TABLE `listapizz` (
  `id` int(11) NOT NULL,
  `idZamowienie` int(11) NOT NULL,
  `idPizzy` int(11) DEFAULT NULL,
  `Ilosc` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `listapizz`
--

INSERT INTO `listapizz` (`id`, `idZamowienie`, `idPizzy`, `Ilosc`) VALUES
(19, 61, 7, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `listaskladnikow`
--

CREATE TABLE `listaskladnikow` (
  `id` int(11) NOT NULL,
  `idPizza` int(11) NOT NULL,
  `idSkladnik` int(11) DEFAULT NULL,
  `IloscJednostkowa` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `listaskladnikow`
--

INSERT INTO `listaskladnikow` (`id`, `idPizza`, `idSkladnik`, `IloscJednostkowa`) VALUES
(29, 6, 600, 1),
(30, 6, 601, 1),
(31, 6, 602, 1),
(32, 6, 603, 1),
(33, 7, 600, 1),
(34, 7, 601, 1),
(35, 7, 602, 1),
(36, 7, 603, 1),
(37, 8, 600, 1),
(38, 8, 601, 1),
(39, 8, 602, 1),
(40, 8, 603, 1),
(41, 0, 600, 1),
(42, 0, 601, 1),
(43, 0, 605, 1),
(44, 1, 600, 1),
(45, 1, 601, 1),
(46, 1, 605, 1),
(47, 2, 600, 1),
(48, 2, 601, 1),
(49, 2, 605, 1),
(50, 3, 600, 1),
(51, 3, 601, 1),
(52, 3, 606, 1),
(53, 3, 607, 1),
(54, 3, 608, 1),
(55, 3, 609, 1),
(56, 4, 600, 1),
(57, 4, 601, 1),
(58, 4, 606, 1),
(59, 4, 607, 1),
(60, 4, 608, 1),
(61, 4, 609, 1),
(62, 5, 600, 1),
(63, 5, 601, 1),
(64, 5, 606, 1),
(65, 5, 607, 1),
(66, 5, 608, 1),
(67, 5, 609, 1),
(68, 6, 600, 1),
(69, 6, 601, 1),
(70, 6, 602, 1),
(71, 6, 603, 1),
(72, 7, 600, 1),
(73, 7, 601, 1),
(74, 7, 602, 1),
(75, 7, 603, 1),
(76, 8, 600, 1),
(77, 8, 601, 1),
(78, 8, 602, 1),
(79, 8, 603, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `napoje`
--

CREATE TABLE `napoje` (
  `idNapoj` int(11) NOT NULL,
  `NazwaNapoju` varchar(45) DEFAULT NULL,
  `Pojemnosc` double DEFAULT NULL,
  `Cena` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `napoje`
--

INSERT INTO `napoje` (`idNapoj`, `NazwaNapoju`, `Pojemnosc`, `Cena`) VALUES
(1, 'Pepsi', 1, 10),
(2, 'Fanta', 0.5, 7),
(3, 'Fanta', 1, 10),
(4, 'Sprite', 0.3, 5),
(5, 'Sprite', 0.5, 7),
(6, 'Sprite', 1, 10);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pizze`
--

CREATE TABLE `pizze` (
  `idPizza` int(11) NOT NULL,
  `NazwaPizzy` varchar(45) DEFAULT NULL,
  `rozmiar` enum('mala','srednia','duza') DEFAULT NULL,
  `koszt` double DEFAULT NULL,
  `skladniki` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `pizze`
--

INSERT INTO `pizze` (`idPizza`, `NazwaPizzy`, `rozmiar`, `koszt`, `skladniki`) VALUES
(0, 'Margeritha', 'mala', 10, 'sos, ser, oregano'),
(1, 'Margeritha', 'srednia', 14, 'sos, ser, oregano'),
(2, 'Margeritha', 'duza', 23, 'sos, ser, oregano'),
(3, 'Wegetarianska', 'mala', 14, 'sos, ser, cebula, pieczarki, kukurydza, pom'),
(4, 'Wegetarianska', 'srednia', 19, 'sos, ser, cebula, pieczarki, kukurydza, pom'),
(5, 'Wegetarianska', 'duza', 31, 'sos, ser, cebula, pieczarki, kukurydza, pom'),
(6, 'Pepperoni', 'mala', 16, 'sos, ser, kiełbasa pepperoni, bazylia'),
(7, 'Pepperoni', 'srednia', 22, 'sos pomidorowy, kiełbasa pepperoni, bazylia'),
(8, 'Pepperoni', 'duza', 40, 'sos, ser, kiełbasa pepperoni, bazylia');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `skladniki`
--

CREATE TABLE `skladniki` (
  `idSkladniki` int(11) NOT NULL,
  `nazwa` varchar(45) DEFAULT NULL,
  `Vege` tinyint(4) DEFAULT NULL,
  `Ostrosc` enum('0','1','2') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `skladniki`
--

INSERT INTO `skladniki` (`idSkladniki`, `nazwa`, `Vege`, `Ostrosc`) VALUES
(600, 'ser', 1, '0'),
(601, 'sos pomidorowy', 1, '0'),
(602, 'kiełbasa pepperoni', 0, '1'),
(603, 'bazylia', 1, '0'),
(604, 'sos chilli', 1, '2'),
(605, 'oregano', 1, '0'),
(606, 'cebula', 1, '0'),
(607, 'pieczarki', 1, '0'),
(608, 'kukurydza', 1, '0'),
(609, 'pomidory', 1, '0'),
(610, 'papryka jalapenio', 1, '2');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownik`
--

CREATE TABLE `uzytkownik` (
  `idUzytkownik` int(11) NOT NULL,
  `haslo` varchar(45) NOT NULL,
  `imie` varchar(45) NOT NULL,
  `nazwisko` varchar(45) NOT NULL,
  `login` varchar(45) NOT NULL,
  `nr_personelu` int(11) NOT NULL,
  `stanowisko` enum('Manager','Kelner','Kucharz','Inne') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Inne',
  `typ` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `uzytkownik`
--

INSERT INTO `uzytkownik` (`idUzytkownik`, `haslo`, `imie`, `nazwisko`, `login`, `nr_personelu`, `stanowisko`, `typ`) VALUES
(1, '1234', 'Jan', 'Kowalski', 'janek', 27, 'Manager', '1'),
(2, '0000', 'Zbigniew', 'Mazur', 'mazurek', 5, 'Kucharz', '3'),
(3, '4321', 'Krzysztof', 'Pokraśko', 'pokrak', 67, 'Kucharz', '3'),
(4, '1234', 'Adam', 'Małysz', 'leć', 45, 'Kelner', '2');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienie`
--

CREATE TABLE `zamowienie` (
  `idZamowienie` int(11) NOT NULL,
  `CzasZamowienia` datetime DEFAULT CURRENT_TIMESTAMP,
  `idKelnera` int(11) NOT NULL,
  `idKucharza` int(11) NOT NULL,
  `KwotaZamowienia` double DEFAULT NULL,
  `SposobZaplaty` enum('gotowka','karta') DEFAULT NULL,
  `PotwierdzenieZaplaty` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `zamowienie`
--

INSERT INTO `zamowienie` (`idZamowienie`, `CzasZamowienia`, `idKelnera`, `idKucharza`, `KwotaZamowienia`, `SposobZaplaty`, `PotwierdzenieZaplaty`) VALUES
(61, '2019-05-30 10:38:46', 1, 2, 74, 'gotowka', NULL);

--
-- Wyzwalacze `zamowienie`
--
DELIMITER $$
CREATE TRIGGER `usunlistezam` BEFORE DELETE ON `zamowienie` FOR EACH ROW BEGIN
DELETE FROM listapizz WHERE listapizz.idZamowienie = OLD.idZamowienie;
DELETE FROM listanapojow WHERE listanapojow.idZamowienie = OLD.idZamowienie;
END
$$
DELIMITER ;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `kelner`
--
ALTER TABLE `kelner`
  ADD PRIMARY KEY (`idKelner`),
  ADD KEY `idUzytkownika` (`idUzytkownika`);

--
-- Indeksy dla tabeli `kucharz`
--
ALTER TABLE `kucharz`
  ADD PRIMARY KEY (`idKucharz`),
  ADD KEY `idUzytkownika` (`idUzytkownika`);

--
-- Indeksy dla tabeli `listanapojow`
--
ALTER TABLE `listanapojow`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idZamowienie` (`idZamowienie`),
  ADD KEY `idNapoj` (`idNapoj`);

--
-- Indeksy dla tabeli `listapizz`
--
ALTER TABLE `listapizz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idZamowienie` (`idZamowienie`),
  ADD KEY `idPizzy` (`idPizzy`);

--
-- Indeksy dla tabeli `listaskladnikow`
--
ALTER TABLE `listaskladnikow`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPizza` (`idPizza`),
  ADD KEY `idSkladnik` (`idSkladnik`),
  ADD KEY `idPizza_2` (`idPizza`),
  ADD KEY `idPizza_3` (`idPizza`),
  ADD KEY `idSkladnik_2` (`idSkladnik`),
  ADD KEY `idPizza_4` (`idPizza`),
  ADD KEY `idPizza_5` (`idPizza`,`idSkladnik`);

--
-- Indeksy dla tabeli `napoje`
--
ALTER TABLE `napoje`
  ADD PRIMARY KEY (`idNapoj`),
  ADD KEY `idNapoj` (`idNapoj`),
  ADD KEY `idNapoj_2` (`idNapoj`),
  ADD KEY `idNapoj_3` (`idNapoj`);

--
-- Indeksy dla tabeli `pizze`
--
ALTER TABLE `pizze`
  ADD PRIMARY KEY (`idPizza`),
  ADD KEY `idPizza` (`idPizza`);

--
-- Indeksy dla tabeli `skladniki`
--
ALTER TABLE `skladniki`
  ADD PRIMARY KEY (`idSkladniki`);

--
-- Indeksy dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  ADD PRIMARY KEY (`idUzytkownik`);

--
-- Indeksy dla tabeli `zamowienie`
--
ALTER TABLE `zamowienie`
  ADD PRIMARY KEY (`idZamowienie`),
  ADD KEY `idKelnera` (`idKelnera`),
  ADD KEY `idKucharza` (`idKucharza`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `listanapojow`
--
ALTER TABLE `listanapojow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT dla tabeli `listapizz`
--
ALTER TABLE `listapizz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT dla tabeli `listaskladnikow`
--
ALTER TABLE `listaskladnikow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT dla tabeli `napoje`
--
ALTER TABLE `napoje`
  MODIFY `idNapoj` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `skladniki`
--
ALTER TABLE `skladniki`
  MODIFY `idSkladniki` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=611;

--
-- AUTO_INCREMENT dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  MODIFY `idUzytkownik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `zamowienie`
--
ALTER TABLE `zamowienie`
  MODIFY `idZamowienie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `kelner`
--
ALTER TABLE `kelner`
  ADD CONSTRAINT `kelner_ibfk_1` FOREIGN KEY (`idUzytkownika`) REFERENCES `uzytkownik` (`idUzytkownik`);

--
-- Ograniczenia dla tabeli `kucharz`
--
ALTER TABLE `kucharz`
  ADD CONSTRAINT `kucharz_ibfk_1` FOREIGN KEY (`idUzytkownika`) REFERENCES `uzytkownik` (`idUzytkownik`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
