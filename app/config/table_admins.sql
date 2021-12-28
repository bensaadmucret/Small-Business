/* CREATE DATABSE app if not exists */
CREATE DATABASE IF NOT EXISTS `app`;

/* DROP TABLE IF EXISTS */
DROP TABLE IF EXISTS `app`.`table_admins`;





/* CREATE A TABLE ADMINS */
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;