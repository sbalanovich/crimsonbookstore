--
-- Database: `crimsonbookstore`
--
 
CREATE DATABASE IF NOT EXISTS  `crimsonbookstore` ;
 
 
--
-- Table structure for table `users`
--
 
CREATE TABLE IF NOT EXISTS `crimsonbookstore`.`users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL, `lastname` varchar(255) NOT NULL, `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL, `email` varchar(255) NOT NULL, `hash` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`), `active` int(1) UNSIGNED
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;
 
--
-- Dumping data for table `project`.`users`
--
