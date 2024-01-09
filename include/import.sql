SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE `kbo-enschede`;

USE DATABASE `kbo-enschede`;


CREATE TABLE `evenementen` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `titel` varchar(255) CHARACTER SET latin1 NOT NULL,
  `beschrijving` varchar(255) CHARACTER SET latin1 NOT NULL,
  `capiciteit` varchar(255) CHARACTER SET latin1 NOT NULL,
  `img` varchar(255) CHARACTER SET latin1 NOT NULL,
  `tijd` varchar(255) CHARACTER SET latin1 NOT NULL,
  `datum` varchar(255) CHARACTER SET latin1 NOT NULL,
  `soort` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `ingeschreven_voor_evenement` (
  `evenement` varchar(255) NOT NULL,
  `voornaam` varchar(255) NOT NULL,
  `tussenvoegsel` varchar(255) DEFAULT NULL,
  `achternaam` varchar(255) NOT NULL,
  `id` mediumint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `nieuws` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `titel` varchar(255) CHARACTER SET latin1 NOT NULL,
  `foto` varchar(255) CHARACTER SET latin1 NOT NULL,
  `link` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `beschrijving` text CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `sponsoren` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `sponsor_naam` varchar(255) CHARACTER SET latin1 NOT NULL,
  `sponsor_logo` varchar(255) CHARACTER SET latin1 NOT NULL,
  `link` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `sponsoren` (`sponsor_naam`, `sponsor_logo`, `link`)
VALUES ('accu twente', 'accutwente.jpg', 'https://www.accutwente.nl/'),
('broeksema', 'broeksema.jpg', 'https://www.broeksema.nl/'),
('novi', 'novi.png', 'https://www.novi-enschede.nl/'),
('nuweg', 'nuweg.jpg', 'https://nuwegexclusief.nl/');


CREATE TABLE `users` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `voornaam` varchar(255) NOT NULL,
  `tussenvoegsel` varchar(255) NOT NULL,
  `achternaam` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefoonnummer` varchar(255) NOT NULL,
  `geboortedatum` varchar(255) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL,
  `huisnummer` varchar(255) NOT NULL,
  `straatnaam` varchar(255) NOT NULL,
  `postcode` varchar(255) NOT NULL,
  `woonplaats` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
