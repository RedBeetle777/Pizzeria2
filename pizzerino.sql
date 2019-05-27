-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Czas generowania: 28 Maj 2019, 00:18
-- Wersja serwera: 10.1.38-MariaDB-0+deb9u1
-- Wersja PHP: 7.0.33-0+deb9u3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
(0, 'ser', 1, '0'),
(1, 'sos pomidorowy', 1, '0'),
(2, 'kiełbasa pepperoni', 0, '1'),
(3, 'bazylia', 1, '0'),
(4, 'papryka jalapenio', 1, '2'),
(5, 'sos chilli', 1, '2'),
(6, 'oregano', 1, '0');

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

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `kelner`
--
ALTER TABLE `kelner`
  ADD PRIMARY KEY (`idKelner`),
  ADD KEY `idUzytkownika` (`idUzytkownika`);

--
-- Indexes for table `kucharz`
--
ALTER TABLE `kucharz`
  ADD PRIMARY KEY (`idKucharz`),
  ADD KEY `idUzytkownika` (`idUzytkownika`);

--
-- Indexes for table `listanapojow`
--
ALTER TABLE `listanapojow`
  ADD KEY `idZamowienie` (`idZamowienie`),
  ADD KEY `idNapoju` (`idNapoju`);

--
-- Indexes for table `listapizz`
--
ALTER TABLE `listapizz`
  ADD KEY `idZamowienie` (`idZamowienie`),
  ADD KEY `idPizzy` (`idPizzy`);

--
-- Indexes for table `listaskladnikow`
--
ALTER TABLE `listaskladnikow`
  ADD KEY `idPizza` (`idPizza`),
  ADD KEY `idSkladnik` (`idSkladnik`);

--
-- Indexes for table `napoje`
--
ALTER TABLE `napoje`
  ADD PRIMARY KEY (`idNapoj`);

--
-- Indexes for table `pizze`
--
ALTER TABLE `pizze`
  ADD PRIMARY KEY (`idPizza`);

--
-- Indexes for table `skladniki`
--
ALTER TABLE `skladniki`
  ADD PRIMARY KEY (`idSkladniki`);

--
-- Indexes for table `uzytkownik`
--
ALTER TABLE `uzytkownik`
  ADD PRIMARY KEY (`idUzytkownik`);

--
-- Indexes for table `zamowienie`
--
ALTER TABLE `zamowienie`
  ADD PRIMARY KEY (`idZamowienie`),
  ADD KEY `idKelnera` (`idKelnera`),
  ADD KEY `idKucharza` (`idKucharza`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `skladniki`
--
ALTER TABLE `skladniki`
  MODIFY `idSkladniki` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=606;
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
