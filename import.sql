CREATE DATABASE `github_repo`;

CREATE TABLE IF NOT EXISTS `repositories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `stars` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `pushed` datetime NOT NULL,
  PRIMARY KEY (`id`)
);