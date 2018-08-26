-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2018 at 08:16 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `bus_reservation`
--

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE IF NOT EXISTS `bus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` text NOT NULL,
  `total_seat` int(11) NOT NULL,
  `bus_number` int(11) NOT NULL,
  `seat_layout` int(11) NOT NULL,
  `travel_agency_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `travel_agency_id` (`travel_agency_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`id`, `type`, `total_seat`, `bus_number`, `seat_layout`, `travel_agency_id`) VALUES
(2, 'Micro', 15, 23123123, 1, 1),
(3, 'Mini', 20, 12323, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `destination`
--

CREATE TABLE IF NOT EXISTS `destination` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `destination` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `destination`
--

INSERT INTO `destination` (`id`, `destination`) VALUES
(1, 'Kathmandu'),
(2, 'Pokhara');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `departure_time` varchar(255) NOT NULL,
  `departure_date` date NOT NULL,
  `reserved_seat` text NOT NULL,
  `bus_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bus_bus_id` (`bus_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `departure_time`, `departure_date`, `reserved_seat`, `bus_id`) VALUES
(1, '9 am', '2018-08-27', 'a1,a2,a3', 2),
(2, '10pm', '2018-08-28', 'a2,a3', 3),
(3, '12 pm', '2018-08-27', 'a2,a3', 2);

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE IF NOT EXISTS `route` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start_point` int(11) NOT NULL,
  `end_point` int(11) NOT NULL,
  `bus_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bus_id` (`bus_id`),
  KEY `end_point` (`end_point`),
  KEY `start_point` (`start_point`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`id`, `start_point`, `end_point`, `bus_id`) VALUES
(1, 1, 2, 2),
(2, 1, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `travel_agency`
--

CREATE TABLE IF NOT EXISTS `travel_agency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `address` text NOT NULL,
  `contact` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `travel_agency`
--

INSERT INTO `travel_agency` (`id`, `name`, `address`, `contact`, `email`) VALUES
(1, 'Agni Yatayat', 'Kalanki', 12313323, 'agni@abc.com');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bus`
--
ALTER TABLE `bus`
  ADD CONSTRAINT `bus_ibfk_1` FOREIGN KEY (`travel_agency_id`) REFERENCES `travel_agency` (`id`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `bus_bus_id` FOREIGN KEY (`bus_id`) REFERENCES `bus` (`id`);

--
-- Constraints for table `route`
--
ALTER TABLE `route`
  ADD CONSTRAINT `route_ibfk_1` FOREIGN KEY (`start_point`) REFERENCES `destination` (`id`),
  ADD CONSTRAINT `route_ibfk_2` FOREIGN KEY (`end_point`) REFERENCES `destination` (`id`),
  ADD CONSTRAINT `route_ibfk_3` FOREIGN KEY (`bus_id`) REFERENCES `bus` (`id`);
