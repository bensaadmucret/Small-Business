/*Create database if not exists `app`;*/
    CREATE DATABASE IF NOT EXISTS `app`;


/* Create table admins */
    CREATE TABLE IF NOT EXISTS `admins` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `username` varchar(255) NOT NULL,
      `password` varchar(255) NOT NULL,
      `email` varchar(255) NOT NULL,
      `created_at` datetime NOT NULL,
      `updated_at` datetime NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;





