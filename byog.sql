CREATE DATABASE `byog`;

CREATE TABLE `byog`. `users` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `name` VARCHAR(50) NOT NULL,
  `password` VARCHAR(128) NOT NULL,
  `avatar_url` VARCHAR(50),
  `private_snippet` VARCHAR(200)
);

CREATE TABLE `byog`. `snippets` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `content` VARCHAR(200),
  `user_id` INT NOT NULL,
  FOREIGN KEY (`user_id`) REFERENCES USERS(`id`)
);
