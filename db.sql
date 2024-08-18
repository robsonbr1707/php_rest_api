CREATE TABLE IF NOT EXISTS `examples` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(210) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(210) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_title` varchar(210) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(210) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `examples` (`id`, `title`, `slug`, `sub_title`, `content`, `created_at`) VALUES
	(1, 'Exemplo 1', NULL, 'Sub - Exemplo 1', 'Conteúdo..', '2024-08-16 11:42:59'),
	(2, 'Exemplo 2', NULL, 'Sub - Exemplo 2', 'Conteúdo 2..', '2024-08-16 11:43:11'),
	(3, 'Exemplo 3', NULL, 'Sub - Exemplo 3', 'Conteúdo 3..', '2024-08-16 11:43:19'),