-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2024 at 10:39 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nick-burret-dj-web-app`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `Email` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `isAuthed` tinyint(1) NOT NULL,
  `songrequested` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `queue`
--

CREATE TABLE `queue` (
  `Requestee` varchar(255) NOT NULL,
  `RequesteeName` varchar(255) DEFAULT NULL,
  `Artist` varchar(255) DEFAULT NULL,
  `SongName` varchar(255) DEFAULT NULL,
  `Message` text DEFAULT NULL,
  `Playing` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `Songname` varchar(255) NOT NULL,
  `Artist` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`Songname`, `Artist`) VALUES
('A Change Is Gonna Come', 'Sam Cooke'),
('Angie', 'The Rolling Stones'),
('Billie Jean', 'Michael Jackson'),
('Bohemian Rhapsody', 'Queen'),
('Born to Run', 'Bruce Springsteen'),
('Bridge Over Troubled Water', 'Simon & Garfunkel'),
('Every Breath You Take', 'The Police'),
('God Save the Queen', 'The Sex Pistols'),
('Good Vibrations', 'The Beach Boys'),
('Hey Jude', 'The Beatles'),
('Hey Ya!', 'OutKast'),
('Hotel California', 'Eagles'),
('Hound Dog', 'Elvis Presley'),
('I Will Always Love You', 'Whitney Houston'),
('Imagine', 'John Lennon'),
('Johnny B. Goode', 'Chuck Berry'),
('Let It Be', 'The Beatles'),
('Lets Stay Together', 'Al Green'),
('Like a Rolling Stone', 'Bob Dylan'),
('London Calling', 'The Clash'),
('Lose Yourself', 'Eminem'),
('No Woman, No Cry', 'Bob Marley & The Wailers'),
('Purple Haze', 'Jimi Hendrix'),
('Smells Like Teen Spirit', 'Nirvana'),
('Stairway to Heaven', 'Led Zeppelin'),
('Stayin Alive', 'Bee Gees'),
('Superstition', 'Stevie Wonder'),
('Sweet Child o Mine', 'Guns N Roses'),
('Thriller', 'Michael Jackson'),
('Whatd I Say', 'Ray Charles'),
('Whats Going On', 'Marvin Gaye'),
('When Doves Cry', 'Prince'),
('Yesterday', 'The Beatles');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`Email`);

--
-- Indexes for table `queue`
--
ALTER TABLE `queue`
  ADD PRIMARY KEY (`Requestee`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`Songname`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
