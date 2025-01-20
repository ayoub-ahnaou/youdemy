DROP DATABASE IF EXISTS youdemy_db;

CREATE DATABASE youdemy_db;

USE youdemy_db;

-- table role script
CREATE TABLE
  `roles` (
    `role_id` int (11) NOT NULL AUTO_INCREMENT,
    `role_name` varchar(20) NOT NULL,
    PRIMARY KEY (`role_id`)
  );

-- table users script
CREATE TABLE
  `users` (
    `user_id` int (11) NOT NULL AUTO_INCREMENT,
    `firstname` varchar(20) NOT NULL,
    `lastname` varchar(20) NOT NULL,
    `phone` varchar(15) NOT NULL,
    `email` varchar(100) NOT NULL,
    `password` varchar(255) NOT NULL,
    `isActive` tinyint (1) DEFAULT 1,
    `gender` varchar(25) DEFAULT NULL,
    `age` int (11) DEFAULT NULL,
    `address` text DEFAULT NULL,
    `cin` varchar(10) DEFAULT NULL,
    `specialite` varchar(50) DEFAULT NULL,
    `academic_level` varchar(100) DEFAULT NULL,
    `avatar` varchar(255) DEFAULT NULL,
    `isRequested` int (11) DEFAULT NULL,
    `role_id` int (11) DEFAULT 3,
    PRIMARY KEY (`user_id`),
    UNIQUE KEY `email` (`email`),
    KEY `role_id` (`role_id`),
    CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE SET NULL
  );

-- table categories script
CREATE TABLE
  `categories` (
    `category_id` int (11) NOT NULL AUTO_INCREMENT,
    `category_name` varchar(25) NOT NULL,
    `image` varchar(255) NOT NULL,
    PRIMARY KEY (`category_id`)
  );

-- table tags script
CREATE TABLE
  `tags` (
    `tag_id` int (11) NOT NULL AUTO_INCREMENT,
    `tag_name` varchar(25) NOT NULL,
    PRIMARY KEY (`tag_id`)
  );

-- table courses script
CREATE TABLE
  `courses` (
    `cours_id` int (11) NOT NULL AUTO_INCREMENT,
    `title` varchar(100) NOT NULL,
    `subtitle` varchar(100) NOT NULL,
    `description` text NOT NULL,
    `image` varchar(255) NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
    `updated_at` timestamp NULL DEFAULT NULL,
    `langues` enum ('english', 'frnech', 'arabe') NOT NULL,
    `type` enum ('video', 'document') NOT NULL,
    `category_id` int (11) DEFAULT NULL,
    `content` varchar(255) DEFAULT NULL,
    `user_id` int (11) NOT NULL,
    PRIMARY KEY (`cours_id`),
    KEY `category_id` (`category_id`),
    KEY `user_id` (`user_id`),
    CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE SET NULL,
    CONSTRAINT `courses_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
  );

-- table courses_tags script
CREATE TABLE
  `courses_tags` (
    `cours_id` int (11) NOT NULL,
    `tag_id` int (11) NOT NULL,
    PRIMARY KEY (`cours_id`, `tag_id`),
    KEY `tag_id` (`tag_id`),
    CONSTRAINT `courses_tags_ibfk_1` FOREIGN KEY (`cours_id`) REFERENCES `courses` (`cours_id`) ON DELETE CASCADE,
    CONSTRAINT `courses_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tag_id`) ON DELETE CASCADE
  );

-- table enrollements script
CREATE TABLE
  `enrollements` (
    `enroll_id` int (11) NOT NULL AUTO_INCREMENT,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
    `user_id` int (11) DEFAULT NULL,
    `cours_id` int (11) DEFAULT NULL,
    PRIMARY KEY (`enroll_id`),
    KEY `user_id` (`user_id`),
    KEY `cours_id` (`cours_id`),
    CONSTRAINT `enrollements_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL,
    CONSTRAINT `enrollements_ibfk_2` FOREIGN KEY (`cours_id`) REFERENCES `courses` (`cours_id`) ON DELETE SET NULL
  );

-- table requests script
CREATE TABLE
  `requests` (
    `request_id` int (11) NOT NULL AUTO_INCREMENT,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    `user_id` int (11) DEFAULT NULL,
    PRIMARY KEY (`request_id`),
    KEY `user_id` (`user_id`),
    CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL
  );