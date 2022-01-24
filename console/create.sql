/* DROP DATABASE IF EXISTS `app`;*/

  DROP TABLE IF EXISTS `app`;


/*Create database if not exists `app`;*/
    CREATE DATABASE IF NOT EXISTS `app`;
    use `app`;

/* Create table admins */
    CREATE TABLE IF NOT EXISTS `admins` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `username` varchar(255) NOT NULL,
      `password` varchar(255) NOT NULL,
      `email` varchar(255) NOT NULL UNIQUE,
      `role`varchar(255) NOT NULL,
      `status` BOOLEAN NOT NULL DEFAULT 1,
      `created_at` datetime NOT NULL,
      `updated_at` datetime NOT NULL,
      PRIMARY KEY (id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    CREATE TABLE IF NOT EXISTS `users` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `username` varchar(255) NOT NULL,
      `password` varchar(255) NOT NULL,
      `email` varchar(255) NOT NULL UNIQUE,
      `role` varchar(255) NOT NULL,
      `status` BOOLEAN NOT NULL DEFAULT 1,
      `created_at` datetime NOT NULL,
      `updated_at` datetime NOT NULL,
      PRIMARY KEY (id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    /* create table products */
    CREATE TABLE IF NOT EXISTS `products` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `name` varchar(255) NOT NULL,
      `description` text NOT NULL,
      `price` int(11) NOT NULL,
      `image` varchar(255) NOT NULL,
      `category_id` int(11) NOT NULL,
      `created_at` datetime NOT NULL,
      `updated_at` datetime NOT NULL,
      PRIMARY KEY (id),
      UNIQUE KEY `name` (`name`)  
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    /* create table categories */
    CREATE TABLE IF NOT EXISTS `categories` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `name` varchar(255) NOT NULL,
      `description` text NOT NULL,
      `product_id` int(11) NOT NULL,
      `created_at` datetime NOT NULL,
      `updated_at` datetime NOT NULL,
      PRIMARY KEY (id),
      UNIQUE KEY `name` (`name`),
      FOREIGN KEY (`product_id`) REFERENCES `products`(id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    /* create table categories_products */
    CREATE TABLE IF NOT EXISTS `categories_products` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `category_id` int(11) NOT NULL,
      `product_id` int(11) NOT NULL,
      PRIMARY KEY (id),
      UNIQUE KEY `category_id_product_id` (`category_id`,`product_id`),
      FOREIGN KEY (category_id) REFERENCES `categories`(id),
      FOREIGN KEY (product_id) REFERENCES `products`(id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    /* create table orders */
    CREATE TABLE IF NOT EXISTS `orders` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `user_id` int(11) NOT NULL,
      `status` varchar(255) NOT NULL,
      `created_at` datetime NOT NULL,
      `updated_at` datetime NOT NULL,
      PRIMARY KEY (id),
      FOREIGN KEY (`user_id`) REFERENCES `users`(id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    /* create table order_details */
    CREATE TABLE IF NOT EXISTS `order_details` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `order_id` int(11) NOT NULL,
      `product_id` int(11) NOT NULL,
      `quantity` int(11) NOT NULL,
      `price` int(11) NOT NULL,
      PRIMARY KEY (id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    /* create table adress */
    CREATE TABLE IF NOT EXISTS `adress` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `user_id` int(11) NOT NULL,
      `name` varchar(255) NOT NULL,
      `phone` varchar(255) NOT NULL,
      `address` varchar(255) NOT NULL,
      `address_2` varchar(255) NOT NULL,
      `city` varchar(255) NOT NULL,
      `state` varchar(255) NOT NULL,
      `zip` varchar(255) NOT NULL,
      `country` varchar(255) NOT NULL,
      FOREIGN KEY (`user_id`) REFERENCES `users`(id),
      `created_at` datetime NOT NULL,
      `updated_at` datetime NOT NULL,
      PRIMARY KEY (id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
















