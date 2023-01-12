SET NAMES utf8;
    SET time_zone = '+00:00';
    SET foreign_key_checks = 0;
    SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';
    SET NAMES utf8mb4;
    DROP TABLE IF EXISTS `taskproject`;
    CREATE TABLE `taskproject` (
      `id` int(10) NOT NULL AUTO_INCREMENT,
      `description` varchar(140) NOT NULL,
      `owner` varchar(70) DEFAULT NULL,
      `status` varchar(20) NOT NULL,
      `created` date NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    INSERT INTO `taskproject` (`id`, `description`, `owner`, `status`, `created`) VALUES
    (1,	'Buy groceries',	'Markus',	'NOT_STARTED',	'2012-06-01'),
    (2,	'Start wkd job',	'Ville',	'ONGOING',	'2020-02-01');
