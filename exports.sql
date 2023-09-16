-- Adminer 4.8.1 MySQL 8.1.0 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `Likes`;
CREATE TABLE `Likes` (
  `id` varchar(32) NOT NULL,
  `user_id` int NOT NULL,
  `post_id` int NOT NULL,
  `like` int NOT NULL,
  `timestamp` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `post_id` (`post_id`),
  CONSTRAINT `Likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`),
  CONSTRAINT `Likes_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `Posts` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `PostImages`;
CREATE TABLE `PostImages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_id` int NOT NULL,
  `image_uri` varchar(2048) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  CONSTRAINT `PostImages_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `Posts` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `Posts`;
CREATE TABLE `Posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `author` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `author_id` int NOT NULL,
  `post_text` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `multi_image_uri` int NOT NULL DEFAULT '0',
  `image_uri` varchar(1024) CHARACTER SET utf32 COLLATE utf32_bin NOT NULL,
  `like_count` int NOT NULL,
  `uploaded_time` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `Sessions`;
CREATE TABLE `Sessions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uid` int NOT NULL,
  `token` varchar(256) NOT NULL,
  `login_time` timestamp NOT NULL,
  `ip` varchar(20) NOT NULL,
  `useragent` varchar(256) NOT NULL,
  `fingerPrintId` varchar(128) NOT NULL,
  `active` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  CONSTRAINT `Sessions_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `Users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1155 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `Users`;
CREATE TABLE `Users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `phone` (`phone`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=952 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- 2023-09-10 13:04:59
