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



CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `product` (`name`, `description`, `price`, `created_at`, `updated_at`) VALUES
('Product 1', 'Product 1 description', '100.00', '2019-01-01 00:00:00', '2019-01-01 00:00:00'),
('Product 2', 'Product 2 description', '200.00', '2019-01-01 00:00:00', '2019-01-01 00:00:00'),
('Product 3', 'Product 3 description', '300.00', '2019-01-01 00:00:00', '2019-01-01 00:00:00');



