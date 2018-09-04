-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2018 at 08:58 PM
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
  `price` int(11) NOT NULL,
  `seat_layout` int(11) NOT NULL,
  `travel_agency_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `travel_agency_id` (`travel_agency_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`id`, `type`, `total_seat`, `bus_number`, `price`, `seat_layout`, `travel_agency_id`) VALUES
(2, 'Micro', 15, 9808, 800, 1, 1),
(3, 'Mini', 20, 1245, 600, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `destination`
--

CREATE TABLE IF NOT EXISTS `destination` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `destination` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `destination`
--

INSERT INTO `destination` (`id`, `destination`) VALUES
(1, 'Kathmandu'),
(2, 'Pokhara'),
(3, 'Janakpur');

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
(1, '9 am', '2018-08-27', 'a1,a2,a3,c1,f2,d4', 2),
(2, '10pm', '2018-08-28', 'a2,a3', 3),
(3, '12 pm', '2018-08-27', 'a2,a3,a1', 2);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'role_admin'),
(2, 'role_user');

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
-- Table structure for table `tickets`
--

CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `seats` varchar(255) NOT NULL,
  `total_price` int(11) NOT NULL,
  `unique_id` varchar(255) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `bus_id` int(11) NOT NULL,
  `from` varchar(255) DEFAULT NULL,
  `to` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `first_name`, `last_name`, `address`, `contact`, `email`, `seats`, `total_price`, `unique_id`, `reservation_id`, `bus_id`, `from`, `to`) VALUES
(1, 'Vinaya', 'Dahal', 'Kathmandu', '982346569', 'vin@xyz.com', 'c1,f2,d4', 2400, 's7C7jR6eDl', 1, 2, 'Kathmandu', 'Pokhara'),
(2, 'Vivek', 'Dahal', 'Jorpati', '9813456786', 'viv@qwe.com', 'a1', 800, 'OLvuMVTTHU', 3, 2, NULL, NULL),
(3, 'Aweqwe', 'Zxczxczfjghjghj', 'Yuoioupu', '1233556456', 'asd@qwer.ghfhjf', 'd4', 800, 'UBsAyRdZ1i', 3, 2, 'Kathmandu', 'Pokhara'),
(4, 'Vinaha', 'Daahl', 'Q1qweqw', '13344566', 'adxxcvcv', '', 0, 'ZTnJ71r9Y2', 3, 2, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `travel_agency`
--

INSERT INTO `travel_agency` (`id`, `name`, `address`, `contact`, `email`) VALUES
(1, 'ABC Yatayat', 'Kalanki', 12313323, 'info@abc.com'),
(2, 'XYZ Bus', 'Koteshwor', 2323712, 'xyz@mail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `travel_agency_id` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `phone`, `address`, `created`, `role`, `username`, `password`, `travel_agency_id`) VALUES
(1, 'vinaya dahal', 'myemail@mail.com', '12312434234', 'country of mountains', '2017-11-14 19:24:23', 2, 'user', '12dea96fec20593566ab75692c9949596833adc9', 1),
(2, 'admin', 'admin@gmail.com', '12345', 'admin home', '2018-04-05 00:00:00', 1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1),
(3, 'Raj', 'raj@raj.com', '2334569', 'ram road', '2018-04-06 23:04:14', 2, 'raj', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1);

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
