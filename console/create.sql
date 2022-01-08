/*Create database if not exists `app`;*/
    CREATE DATABASE IF NOT EXISTS `app`;
    use `app`;

/* Create table admins */
    CREATE TABLE IF NOT EXISTS `admins` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `username` varchar(255) NOT NULL,
      `password` varchar(255) NOT NULL,
      `email` varchar(255) NOT NULL UNIQUE,
      'role' varchar(255) NOT NULL,
      'status' BOOLEAN NOT NULL DEFAULT 1,
      `created_at` datetime NOT NULL,
      `updated_at` datetime NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    CREATE TABLE IF NOT EXISTS `users` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `username` varchar(255) NOT NULL,
      `password` varchar(255) NOT NULL,
      `email` varchar(255) NOT NULL UNIQUE,
      'role' varchar(255) NOT NULL,
      'status' BOOLEAN NOT NULL DEFAULT 1,
      `created_at` datetime NOT NULL,
      `updated_at` datetime NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    /* create table products */
    CREATE TABLE IF NOT EXISTS `products` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `name` varchar(255) NOT NULL,
      `description` text NOT NULL,
      `price` int(11) NOT NULL,
      `image` varchar(255) NOT NULL,
      `created_at` datetime NOT NULL,
      `updated_at` datetime NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    /* create table categories */
    CREATE TABLE IF NOT EXISTS `categories` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `name` varchar(255) NOT NULL,
      `description` text NOT NULL,
      `created_at` datetime NOT NULL,
      `updated_at` datetime NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    /* create table categories_products */
    CREATE TABLE IF NOT EXISTS `categories_products` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `category_id` int(11) NOT NULL,
      `product_id` int(11) NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    /* create table orders */
    CREATE TABLE IF NOT EXISTS `orders` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `user_id` int(11) NOT NULL,
      `status` varchar(255) NOT NULL,
      `created_at` datetime NOT NULL,
      `updated_at` datetime NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    /* create table order_details */
    CREATE TABLE IF NOT EXISTS `order_details` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `order_id` int(11) NOT NULL,
      `product_id` int(11) NOT NULL,
      `quantity` int(11) NOT NULL,
      `price` int(11) NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    /* create table adress */
    CREATE TABLE IF NOT EXISTS `adress` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `user_id` int(11) NOT NULL,
      `name` varchar(255) NOT NULL,
      `phone` varchar(255) NOT NULL,
      `address` varchar(255) NOT NULL,
      `created_at` datetime NOT NULL,
      `updated_at` datetime NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;









