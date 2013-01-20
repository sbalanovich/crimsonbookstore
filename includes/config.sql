--
-- Database: `project`
--
 
CREATE DATABASE IF NOT EXISTS  `project` ;
 
 
--
-- Table structure for table `users`
--
 
CREATE TABLE IF NOT EXISTS `project`.`users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;
 
--
-- Dumping data for table `project`.`users`
--
