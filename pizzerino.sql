-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 15 Kwi 2019, 01:30
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

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

CREATE USER `chef`@`localhost`;
-- --------------------------------------------------------

DELIMITER $$
--
-- Procedury
--
 
CREATE DEFINER=`root`@`localhost` PROCEDURE `menu` (IN `id` INT)  READS SQL DATA
SELECT * from pizze, napoje$$
 
 DELIMITER ;



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
(1, 2),
(2, 3);

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
(1, 4);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `listanapojow`
--

CREATE TABLE `listanapojow` (
  `idZamowienie` int(11) NOT NULL,
  `idNapoju` int(11) DEFAULT NULL,
  `Ilosc` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `listanapojow`
--

INSERT INTO `listanapojow` (`idZamowienie`, `idNapoju`, `Ilosc`) VALUES
(1, 400, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `listapizz`
--

CREATE TABLE `listapizz` (
  `idZamowienie` int(11) NOT NULL,
  `idPizzy` int(11) DEFAULT NULL,
  `Ilosc` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `listapizz`
--

INSERT INTO `listapizz` (`idZamowienie`, `idPizzy`, `Ilosc`) VALUES
(1, 501, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `listaskladnikow`
--

CREATE TABLE `listaskladnikow` (
  `idPizza` int(11) NOT NULL,
  `idSkladnik` int(11) DEFAULT NULL,
  `IloscJednostkowa` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(400, 'Pepsi', 0.3, 5),
(401, 'Pepsi', 0.5, 7),
(402, 'Fanta', 0.3, 5);

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
(500, 'Pepperoni', 'mala', 19, 'sos pomidorowy, kiełbasa pepperoni, bazylia'),
(501, 'Pepperoni', 'duza', 23, 'sos pomidorowy, kiełbasa pepperoni, bazylia');

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
(600, 'sos pomidorowy', 1, '0'),
(601, 'kiełbasa pepperoni', 0, '1'),
(602, 'bazylia', 1, '0'),
(603, 'papryka jalapenio', 0, '2'),
(604, 'sos chilli', 1, '2');

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
  `typ` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `uzytkownik`
--

INSERT INTO `uzytkownik` (`idUzytkownik`, `haslo`, `imie`, `nazwisko`, `login`, `nr_personelu`, `typ`) VALUES
(1, '1234', 'Jan', 'Kowalski', 'janek', 27, 1),
(2, '0000', 'Zbigniew', 'Mazur', 'mazurek', 5, 3),
(3, '4321', 'Krzysztof', 'Pokraśko', 'pokrak', 67, 3),
(4, '1234', 'Adam', 'Małysz', 'leć', 45, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienie`
--

CREATE TABLE `zamowienie` (
  `idZamowienie` int(11) NOT NULL,
  `CzasZamowienia` varchar(45) DEFAULT NULL,
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
(1, '30', 2, 1, NULL, 'karta', 1);



INSERT INTO Kalkulator (a)
SELECT koszt FROM Pizze WHERE idPizza=501;

INSERT INTO Kalkulator (b)
SELECT ilosc FROM ListaPizz WHERE idZamowienie=1;

INSERT INTO Kalkulator (c)
SELECT Cena FROM Napoje WHERE idNapoj=400;

INSERT INTO Kalkulator (d)
SELECT ilosc FROM ListaNapojow WHERE idZamowienie=1;

-- INSERT INTO Kalkulator (total1)
-- SELECT a FROM Kalkulator,
-- SELECT b FROM Kalkulator;

-- SELECT FROM Kalkulator SUM
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
  ADD KEY `idZamowienie` (`idZamowienie`),
  ADD KEY `idNapoju` (`idNapoju`);

--
-- Indeksy dla tabeli `listapizz`
--
ALTER TABLE `listapizz`
  ADD KEY `idZamowienie` (`idZamowienie`),
  ADD KEY `idPizzy` (`idPizzy`);

--
-- Indeksy dla tabeli `listaskladnikow`
--
ALTER TABLE `listaskladnikow`
  ADD KEY `idPizza` (`idPizza`),
  ADD KEY `idSkladnik` (`idSkladnik`);

--
-- Indeksy dla tabeli `napoje`
--
ALTER TABLE `napoje`
  ADD PRIMARY KEY (`idNapoj`);

--
-- Indeksy dla tabeli `pizze`
--
ALTER TABLE `pizze`
  ADD PRIMARY KEY (`idPizza`);

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
-- AUTO_INCREMENT dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  MODIFY `idUzytkownik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `zamowienie`
--
ALTER TABLE `zamowienie`
  MODIFY `idZamowienie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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

--
-- Ograniczenia dla tabeli `listanapojow`
--
ALTER TABLE `listanapojow`
  ADD CONSTRAINT `listanapojow_ibfk_1` FOREIGN KEY (`idZamowienie`) REFERENCES `zamowienie` (`idZamowienie`),
  ADD CONSTRAINT `listanapojow_ibfk_2` FOREIGN KEY (`idNapoju`) REFERENCES `napoje` (`idNapoj`);

--
-- Ograniczenia dla tabeli `listapizz`
--
ALTER TABLE `listapizz`
  ADD CONSTRAINT `listapizz_ibfk_1` FOREIGN KEY (`idZamowienie`) REFERENCES `zamowienie` (`idZamowienie`),
  ADD CONSTRAINT `listapizz_ibfk_2` FOREIGN KEY (`idPizzy`) REFERENCES `pizze` (`idPizza`);

--
-- Ograniczenia dla tabeli `listaskladnikow`
--
ALTER TABLE `listaskladnikow`
  ADD CONSTRAINT `listaskladnikow_ibfk_1` FOREIGN KEY (`idSkladnik`) REFERENCES `skladniki` (`idSkladniki`),
  ADD CONSTRAINT `listaskladnikow_ibfk_2` FOREIGN KEY (`idPizza`) REFERENCES `pizze` (`idPizza`);

--
-- Ograniczenia dla tabeli `zamowienie`
--
ALTER TABLE `zamowienie`
  ADD CONSTRAINT `zamowienie_ibfk_1` FOREIGN KEY (`idKucharza`) REFERENCES `kucharz` (`idKucharz`),
  ADD CONSTRAINT `zamowienie_ibfk_2` FOREIGN KEY (`idKelnera`) REFERENCES `kelner` (`idKelner`);
COMMIT;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
