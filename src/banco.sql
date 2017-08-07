-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;



DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cpf` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nascimento` date NOT NULL,
  `senha` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valido` tinyint(4) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `cabecalhos`;
CREATE TABLE `cabecalhos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `local` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `administradores`;
CREATE TABLE `administradores` (
  `usuario_id` int(10) unsigned NOT NULL,
  UNIQUE KEY `administradores_usuario_id_unique` (`usuario_id`),
  CONSTRAINT `administradores_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `secretarios`;
CREATE TABLE `secretarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` int(10) unsigned NOT NULL,
  `cargo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `secretarios_usuario_id_unique` (`usuario_id`),
  CONSTRAINT `secretarios_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `medicos`;
CREATE TABLE `medicos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` int(10) unsigned NOT NULL,
  `conselho` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `especialidade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cargo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ferias` tinyint(4) NOT NULL DEFAULT '0',
  `cabecalho_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `medicos_usuario_id_unique` (`usuario_id`),
  KEY `medicos_cabecalho_id_foreign` (`cabecalho_id`),
  CONSTRAINT `medicos_cabecalho_id_foreign` FOREIGN KEY (`cabecalho_id`) REFERENCES `cabecalhos` (`id`) ON DELETE SET NULL,
  CONSTRAINT `medicos_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



DROP TABLE IF EXISTS `nao_medicos`;
CREATE TABLE `nao_medicos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` int(10) unsigned NOT NULL,
  `conselho` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `especialidade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cargo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `historico` tinyint(4) NOT NULL DEFAULT '0',
  `cabecalho_id` int(10) unsigned DEFAULT NULL,
  `ferias` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nao_medicos_usuario_id_unique` (`usuario_id`),
  KEY `nao_medicos_cabecalho_id_foreign` (`cabecalho_id`),
  CONSTRAINT `nao_medicos_cabecalho_id_foreign` FOREIGN KEY (`cabecalho_id`) REFERENCES `cabecalhos` (`id`) ON DELETE SET NULL,
  CONSTRAINT `nao_medicos_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `pacientes`;
CREATE TABLE `pacientes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prontuario` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `leito` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nascimento` date NOT NULL,
  `convenio` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_convenio` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sexo` enum('Masculino','Feminino') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `civil` enum('Solteiro','Divorciado','Casado','Viúvo','Separado') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cor` enum('Preta','Branca','Parda','Indigena','Amarela','Não declarado') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `naturalidade` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grau` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cpf` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profissao` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `endereco` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bairro` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cidade` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cep` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uf` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `obs` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `carga_horarias`;
CREATE TABLE `carga_horarias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intervalo` int(11) NOT NULL,
  `inicio` time NOT NULL,
  `fim` time NOT NULL,
  `medico_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `carga_horarias_medico_id_unique` (`medico_id`),
  CONSTRAINT `carga_horarias_medico_id_foreign` FOREIGN KEY (`medico_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `consultas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `horario` datetime NOT NULL,
  `obs` text COLLATE utf8mb4_unicode_ci,
  `status` enum('Primeira','Retorno','Nova') COLLATE utf8mb4_unicode_ci NOT NULL,
  `medico_id` int(10) unsigned NOT NULL,
  `valor` decimal(8,2) DEFAULT NULL,
  `paciente_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `atendida` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `consultas_medico_id_foreign` (`medico_id`),
  KEY `consultas_paciente_id_foreign` (`paciente_id`),
  CONSTRAINT `consultas_medico_id_foreign` FOREIGN KEY (`medico_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  CONSTRAINT `consultas_paciente_id_foreign` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `equipamentos`;
CREATE TABLE `equipamentos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `evolucoes`;
CREATE TABLE `evolucoes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `evolucao` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cid` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paciente_id` int(10) unsigned NOT NULL,
  `autor_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cabecalho_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `evolucoes_paciente_id_foreign` (`paciente_id`),
  KEY `evolucoes_autor_id_foreign` (`autor_id`),
  KEY `evolucoes_cabecalho_id_foreign` (`cabecalho_id`),
  CONSTRAINT `evolucoes_autor_id_foreign` FOREIGN KEY (`autor_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  CONSTRAINT `evolucoes_cabecalho_id_foreign` FOREIGN KEY (`cabecalho_id`) REFERENCES `cabecalhos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `evolucoes_paciente_id_foreign` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `medicamentos`;
CREATE TABLE `medicamentos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;





DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2017_07_22_141402_create_usuarios_table',	1),
(2,	'2017_07_22_141535_create_administradors_table',	1),
(3,	'2017_07_24_005611_create_medicos_table',	1),
(4,	'2017_07_24_030920_create_nao_medicos_table',	1),
(5,	'2017_07_24_032527_create_secretarios_table',	1),
(6,	'2017_07_24_165400_create_carga_horarias_table',	1),
(7,	'2017_07_24_173843_create_pacientes_table',	1),
(8,	'2017_07_25_002031_create_consultas_table',	1),
(9,	'2017_07_25_141636_create_evolucaos_table',	1),
(10,	'2017_07_25_155841_create_equipamentos_table',	1),
(11,	'2017_07_25_161632_create_medicamentos_table',	1),
(12,	'2017_07_25_170718_create_receituarios_table',	1),
(13,	'2017_07_25_194619_create_prescricaos_table',	1),
(14,	'2017_07_25_214322_create_pescricao_medicacaos_table',	1),
(15,	'2017_07_25_224329_create_pescricao_equipamentos_table',	1),
(16,	'2017_07_29_224100_create_cabecalhos_table',	1),
(17,	'2017_07_29_224344_alter_medicos_table',	1),
(18,	'2017_07_30_231826_alter_nao_medicos_table',	1),
(19,	'2017_07_30_232048_alter_evolucoes_table',	1),
(20,	'2017_07_30_232100_alter_receituaris_table',	1),
(21,	'2017_07_30_232117_alter_prescricoes_table',	1),
(22,	'2017_07_30_234334_alter_consultas_table',	1),
(23,	'2017_07_30_234414_alter_nao_medicos_table2',	1);



DROP TABLE IF EXISTS `prescricaos`;
CREATE TABLE `prescricaos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paciente_id` int(10) unsigned NOT NULL,
  `autor_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cabecalho_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `prescricaos_paciente_id_foreign` (`paciente_id`),
  KEY `prescricaos_autor_id_foreign` (`autor_id`),
  KEY `prescricaos_cabecalho_id_foreign` (`cabecalho_id`),
  CONSTRAINT `prescricaos_autor_id_foreign` FOREIGN KEY (`autor_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  CONSTRAINT `prescricaos_cabecalho_id_foreign` FOREIGN KEY (`cabecalho_id`) REFERENCES `cabecalhos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `prescricaos_paciente_id_foreign` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



DROP TABLE IF EXISTS `pescricao_equipamentos`;
CREATE TABLE `pescricao_equipamentos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `prescricao_id` int(10) unsigned NOT NULL,
  `equipamento_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pescricao_equipamentos_prescricao_id_foreign` (`prescricao_id`),
  KEY `pescricao_equipamentos_equipamento_id_foreign` (`equipamento_id`),
  CONSTRAINT `pescricao_equipamentos_equipamento_id_foreign` FOREIGN KEY (`equipamento_id`) REFERENCES `equipamentos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pescricao_equipamentos_prescricao_id_foreign` FOREIGN KEY (`prescricao_id`) REFERENCES `prescricaos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `pescricao_medicacaos`;
CREATE TABLE `pescricao_medicacaos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dose` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `intervalo` int(11) NOT NULL,
  `tempo` int(11) NOT NULL,
  `prescricao_id` int(10) unsigned NOT NULL,
  `medicacao_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pescricao_medicacaos_prescricao_id_foreign` (`prescricao_id`),
  KEY `pescricao_medicacaos_medicacao_id_foreign` (`medicacao_id`),
  CONSTRAINT `pescricao_medicacaos_medicacao_id_foreign` FOREIGN KEY (`medicacao_id`) REFERENCES `medicamentos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pescricao_medicacaos_prescricao_id_foreign` FOREIGN KEY (`prescricao_id`) REFERENCES `prescricaos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



DROP TABLE IF EXISTS `receituarios`;
CREATE TABLE `receituarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `conteudo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `paciente_id` int(10) unsigned NOT NULL,
  `autor_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cabecalho_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `receituarios_paciente_id_foreign` (`paciente_id`),
  KEY `receituarios_autor_id_foreign` (`autor_id`),
  KEY `receituarios_cabecalho_id_foreign` (`cabecalho_id`),
  CONSTRAINT `receituarios_autor_id_foreign` FOREIGN KEY (`autor_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  CONSTRAINT `receituarios_cabecalho_id_foreign` FOREIGN KEY (`cabecalho_id`) REFERENCES `cabecalhos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `receituarios_paciente_id_foreign` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




-- 2017-07-31 03:47:15
