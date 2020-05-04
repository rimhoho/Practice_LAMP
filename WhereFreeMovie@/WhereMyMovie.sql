-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 04, 2020 at 09:49 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `WhereMyMovie`
--

-- --------------------------------------------------------

--
-- Table structure for table `Movie`
--

CREATE TABLE `Movie` (
  `MovieId` char(9) NOT NULL,
  `MovieTitle` varchar(100) NOT NULL,
  `ReleaseYear` varchar(25) DEFAULT NULL,
  `Type` varchar(25) DEFAULT NULL,
  `PosterUrl` varchar(255) DEFAULT NULL,
  `Rating` float DEFAULT NULL,
  `TopRank` int(11) DEFAULT NULL,
  `RatingCount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Movie`
--

INSERT INTO `Movie` (`MovieId`, `MovieTitle`, `ReleaseYear`, `Type`, `PosterUrl`, `Rating`, `TopRank`, `RatingCount`) VALUES
('tt0111161', 'The Shawshank Redemption', '1994', 'movie', 'https://m.media-amazon.com/images/M/MV5BMDFkYTc0MGEtZmNhMC00ZDIzLWFmNTEtODM1ZmRlYWMwMWFmXkEyXkFqcGdeQXVyMTMxODk2OTU@._V1_SX300.jpg', 9.3, 1, 2231847),
('tt0112697', 'Clueless', '1995', 'movie', 'https://m.media-amazon.com/images/M/MV5BMzBmOGQ0NWItOTZjZC00ZDAxLTgyOTEtODJiYWQ2YWNiYWVjXkEyXkFqcGdeQXVyNTE1NjY5Mg@@._V1_SX300.jpg', 6.8, 2555, 168755),
('tt0120888', 'The Wedding Singer', '1998', 'movie', 'https://m.media-amazon.com/images/M/MV5BYjM5YTQ0ZGYtMWExZi00MTFmLTg0YjUtZDcyMGNiYzE5MmNmL2ltYWdlXkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SX300.jpg', 6.8, 2492, 130149),
('tt0137523', 'Fight Club', '1999', 'movie', 'https://m.media-amazon.com/images/M/MV5BMmEzNTkxYjQtZTc0MC00YTVjLTg5ZTEtZWMwOWVlYzY0NWIwXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_SX300.jpg', 8.8, 11, 1777387),
('tt0169547', 'American Beauty', '1999', 'movie', 'https://m.media-amazon.com/images/M/MV5BNTBmZWJkNjctNDhiNC00MGE2LWEwOTctZTk5OGVhMWMyNmVhXkEyXkFqcGdeQXVyMTMxODk2OTU@._V1_SX300.jpg', 8.3, 76, 1034743),
('tt0245429', 'Spirited Away', '2001', 'movie', 'https://m.media-amazon.com/images/M/MV5BNmU5OTQ0OWQtOTY0OS00Yjg4LWE1NDYtNDRhYWMxYWY4OTMwXkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_SX300.jpg', 8.6, 28, 607276),
('tt0311429', 'The League of Extraordinary Gentlemen', '2003', 'movie', 'https://m.media-amazon.com/images/M/MV5BZTFlOTdkMjEtNGVmMS00YTA3LThlNjQtMjAzZmFjZDAzNjllL2ltYWdlL2ltYWdlXkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SX300.jpg', 5.8, 4291, 162605),
('tt0367882', 'Indiana Jones and the Kingdom of the Crystal Skull', '2008', 'movie', 'https://m.media-amazon.com/images/M/MV5BMTIxNDUxNzcyMl5BMl5BanBnXkFtZTcwNTgwOTI3MQ@@._V1_SX300.jpg', 6.1, 3974, 411214),
('tt0468569', 'The Dark Knight', '2008', 'movie', 'https://m.media-amazon.com/images/M/MV5BMTMxNTMwODM0NF5BMl5BanBnXkFtZTcwODAyMTk2Mw@@._V1_SX300.jpg', 9, 4, 2204069),
('tt0810819', 'The Danish Girl', '2015', 'movie', 'https://m.media-amazon.com/images/M/MV5BMjA0NjA4NjE2Nl5BMl5BanBnXkFtZTgwNzIxNTY2NjE@._V1_SX300.jpg', 7.1, 1973, 156551),
('tt0816692', 'Interstellar', '2014', 'movie', 'https://m.media-amazon.com/images/M/MV5BZjdkOTU3MDktN2IxOS00OGEyLWFmMjktY2FiMmZkNWIyODZiXkEyXkFqcGdeQXVyMTMxODk2OTU@._V1_SX300.jpg', 8.6, 30, 1407843),
('tt0903747', 'Breaking Bad', '2008–2013', 'series', 'https://m.media-amazon.com/images/M/MV5BMjhiMzgxZTctNDc1Ni00OTIxLTlhMTYtZTA3ZWFkODRkNmE2XkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_SX300.jpg', 9.5, 250, 1345079),
('tt0944947', 'Game of Thrones', '2011–', 'series', 'https://m.media-amazon.com/images/M/MV5BMjA5NzA5NjMwNl5BMl5BanBnXkFtZTgwNjg2OTk2NzM@._V1_SX300.jpg', 9.3, 250, 1668725),
('tt1375666', 'Inception', '2010', 'movie', 'https://m.media-amazon.com/images/M/MV5BMjAxMzY3NjcxNF5BMl5BanBnXkFtZTcwNTI5OTM0Mw@@._V1_SX300.jpg', 8.8, 13, 1956812),
('tt1950186', 'Ford v Ferrari', '2019', 'movie', 'https://m.media-amazon.com/images/M/MV5BM2UwMDVmMDItM2I2Yi00NGZmLTk4ZTUtY2JjNTQ3OGQ5ZjM2XkEyXkFqcGdeQXVyMTA1OTYzOTUx._V1_SX300.jpg', 8.1, 191, 208664),
('tt2024544', '12 Years a Slave', '2013', 'movie', 'https://m.media-amazon.com/images/M/MV5BMjExMTEzODkyN15BMl5BanBnXkFtZTcwNTU4NTc4OQ@@._V1_SX300.jpg', 8.1, 200, 612398),
('tt2096673', 'Inside Out', '2015', 'movie', 'https://m.media-amazon.com/images/M/MV5BOTgxMDQwMDk0OF5BMl5BanBnXkFtZTgwNjU5OTg2NDE@._V1_SX300.jpg', 8.2, 157, 579221),
('tt2584384', 'Jojo Rabbit', '2019', 'movie', 'https://m.media-amazon.com/images/M/MV5BZjU0Yzk2MzEtMjAzYy00MzY0LTg2YmItM2RkNzdkY2ZhN2JkXkEyXkFqcGdeQXVyNDg4NjY5OTQ@._V1_SX300.jpg', 7.9, 433, 204814),
('tt4154796', 'Avengers: Endgame', '2019', 'movie', 'https://m.media-amazon.com/images/M/MV5BMTc5MDE2ODcwNV5BMl5BanBnXkFtZTgwMzI2NzQ2NzM@._V1_SX300.jpg', 8.4, 70, 708765),
('tt4574334', 'Stranger Things', '2016–', 'series', 'https://m.media-amazon.com/images/M/MV5BZGExYjQzNTQtNGNhMi00YmY1LTlhY2MtMTRjODg3MjU4YTAyXkEyXkFqcGdeQXVyMTkxNjUyNQ@@._V1_SX300.jpg', 8.8, 250, 733995),
('tt5095030', 'Ant-Man and the Wasp', '2018', 'movie', 'https://m.media-amazon.com/images/M/MV5BYjcyYTk0N2YtMzc4ZC00Y2E0LWFkNDgtNjE1MzZmMGE1YjY1XkEyXkFqcGdeQXVyMTMxODk2OTU@._V1_SX300.jpg', 7.1, 2044, 285043),
('tt6468322', 'Money Heist', '2017–', 'series', 'https://m.media-amazon.com/images/M/MV5BZDcxOGI0MDYtNTc5NS00NDUzLWFkOTItNDIxZjI0OTllNTljXkEyXkFqcGdeQXVyMTMxODk2OTU@._V1_SX300.jpg', 8.4, 250, 233970),
('tt6751668', 'Parasite', '2019', 'movie', 'https://m.media-amazon.com/images/M/MV5BYWZjMjk3ZTItODQ2ZC00NTY5LWE0ZDYtZTI3MjcwN2Q5NTVkXkEyXkFqcGdeQXVyODk4OTc3MTY@._V1_SX300.jpg', 8.6, 26, 390532),
('tt7131622', 'Once Upon a Time... in Hollywood', '2019', 'movie', 'https://m.media-amazon.com/images/M/MV5BOTg4ZTNkZmUtMzNlZi00YmFjLTk1MmUtNWQwNTM0YjcyNTNkXkEyXkFqcGdeQXVyNjg2NjQwMDQ@._V1_SX300.jpg', 7.7, 786, 454627),
('tt7286456', 'Joker', '2019', 'movie', 'https://m.media-amazon.com/images/M/MV5BNGVjNWI4ZGUtNzE0MS00YTJmLWE0ZDctN2ZiYTk2YmI3NTYyXkEyXkFqcGdeQXVyMTkxNjUyNQ@@._V1_SX300.jpg', 8.5, 50, 773842),
('tt7366338', 'Chernobyl', '2019', 'series', 'https://m.media-amazon.com/images/M/MV5BZGQ2YmMxZmEtYjI5OS00NzlkLTlkNTEtYWMyMzkyMzc2MDU5XkEyXkFqcGdeQXVyMzQ2MDI5NjU@._V1_SX300.jpg', 9.4, 250, 454960),
('tt7784604', 'Hereditary', '2018', 'movie', 'https://m.media-amazon.com/images/M/MV5BOTU5MDg3OGItZWQ1Ny00ZGVmLTg2YTUtMzBkYzQ1YWIwZjlhXkEyXkFqcGdeQXVyNTAzMTY4MDA@._V1_SX300.jpg', 7.3, 1511, 205611),
('tt8111088', 'The Mandalorian', '2019–', 'series', 'https://m.media-amazon.com/images/M/MV5BMWI0OTJlYTItNzMwZi00YzRiLWJhMjItMWRlMDNhZjNiMzJkXkEyXkFqcGdeQXVyMTkxNjUyNQ@@._V1_SX300.jpg', 8.7, 250, 162869),
('tt8228288', 'The Platform', '2019', 'movie', 'https://m.media-amazon.com/images/M/MV5BOTMyYTIyM2MtNjQ2ZC00MWFkLThhYjQtMjhjMGZiMjgwYjM2XkEyXkFqcGdeQXVyMTkxNjUyNQ@@._V1_SX300.jpg', 7, 2175, 109766),
('tt8398600', 'After Life', '2019–', 'series', 'https://m.media-amazon.com/images/M/MV5BZjdjOWIxMDgtYTgwNS00MjE4LTliZWYtZGI1NDhhZmIyYjM1XkEyXkFqcGdeQXVyMTkxNjUyNQ@@._V1_SX300.jpg', 8.5, 250, 61949),
('tt8579674', '1917', '2019', 'movie', 'https://m.media-amazon.com/images/M/MV5BOTdmNTFjNDEtNzg0My00ZjkxLTg1ZDAtZTdkMDc2ZmFiNWQ1XkEyXkFqcGdeQXVyNTAzNzgwNTg@._V1_SX300.jpg', 8.3, 80, 296623),
('tt8946378', 'Knives Out', '2019', 'movie', 'https://m.media-amazon.com/images/M/MV5BMGUwZjliMTAtNzAxZi00MWNiLWE2NzgtZGUxMGQxZjhhNDRiXkEyXkFqcGdeQXVyNjU1NzU3MzE@._V1_SX300.jpg', 7.9, 408, 289830),
('tt9815454', 'Unorthodox', '2020–', 'series', 'https://m.media-amazon.com/images/M/MV5BMGY4NzZlMDUtMzk2NC00OWEzLTkwMGUtYmFjN2E1YWZlNzRiXkEyXkFqcGdeQXVyMTMxODk2OTU@._V1_SX300.jpg', 8.1, 250, 29759);

-- --------------------------------------------------------

--
-- Table structure for table `MovieService`
--

CREATE TABLE `MovieService` (
  `MovieServiceId` int(11) NOT NULL,
  `RetailPrice` float NOT NULL,
  `RetailLink` varchar(255) NOT NULL,
  `RetailType` varchar(25) NOT NULL,
  `MovieId` varchar(25) NOT NULL,
  `ServiceId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Service`
--

CREATE TABLE `Service` (
  `ServiceId` int(11) NOT NULL,
  `ServiceName` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `UserId` int(11) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `UsrName` varchar(255) NOT NULL,
  `Passwords` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`UserId`, `FirstName`, `LastName`, `UsrName`, `Passwords`) VALUES
(1, 'Hyerim', 'Hwang', 'Rimhoho', 'e094f24d96aef534488de5761f0575e8'),
(2, 'You', 'tube', 'Youtube', '2c93c9efa03cc1088af5352d0fde0f71'),
(3, 'Insta', 'gram', 'Instagram', 'dad8fe228446d44ef3ed728b8dfb2022'),
(4, 'Blue', 'Bottle', 'BlueBottle', '31a05c8b9172bcaf86d1c7932480eedc');

-- --------------------------------------------------------

--
-- Table structure for table `Watchlist`
--

CREATE TABLE `Watchlist` (
  `WatchlistId` int(11) NOT NULL,
  `UserId` int(11) DEFAULT NULL,
  `MovieId` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Watchlist`
--

INSERT INTO `Watchlist` (`WatchlistId`, `UserId`, `MovieId`) VALUES
(1, 1, 'tt0137523'),
(2, 1, 'tt6751668'),
(4, 4, 'tt0111161');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Movie`
--
ALTER TABLE `Movie`
  ADD PRIMARY KEY (`MovieId`);

--
-- Indexes for table `MovieService`
--
ALTER TABLE `MovieService`
  ADD PRIMARY KEY (`MovieServiceId`),
  ADD KEY `FK_Movie_Service` (`MovieId`),
  ADD KEY `FK_Service` (`ServiceId`);

--
-- Indexes for table `Service`
--
ALTER TABLE `Service`
  ADD PRIMARY KEY (`ServiceId`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`UserId`),
  ADD UNIQUE KEY `UsrName` (`UsrName`),
  ADD UNIQUE KEY `UsrName_2` (`UsrName`),
  ADD UNIQUE KEY `UsrName_3` (`UsrName`);

--
-- Indexes for table `Watchlist`
--
ALTER TABLE `Watchlist`
  ADD PRIMARY KEY (`WatchlistId`),
  ADD KEY `FK_Movie_Watch` (`MovieId`),
  ADD KEY `FK_Users` (`UserId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `MovieService`
--
ALTER TABLE `MovieService`
  MODIFY `MovieServiceId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Service`
--
ALTER TABLE `Service`
  MODIFY `ServiceId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Watchlist`
--
ALTER TABLE `Watchlist`
  MODIFY `WatchlistId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `MovieService`
--
ALTER TABLE `MovieService`
  ADD CONSTRAINT `FK_Movie_Service` FOREIGN KEY (`MovieId`) REFERENCES `Movie` (`MovieId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Service` FOREIGN KEY (`ServiceId`) REFERENCES `Service` (`ServiceId`) ON UPDATE CASCADE;

--
-- Constraints for table `Watchlist`
--
ALTER TABLE `Watchlist`
  ADD CONSTRAINT `FK_Movie_Watch` FOREIGN KEY (`MovieId`) REFERENCES `Movie` (`MovieId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Users` FOREIGN KEY (`UserId`) REFERENCES `Users` (`UserId`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
