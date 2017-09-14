-- Copiando estrutura para tabela prontuario2.administradores
CREATE TABLE IF NOT EXISTS `administradores` (
  `usuario_id` int(10) unsigned NOT NULL,
  UNIQUE KEY `administradores_usuario_id_unique` (`usuario_id`),
  CONSTRAINT `administradores_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela prontuario2.cabecalhos
CREATE TABLE IF NOT EXISTS `cabecalhos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `local` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `atendida` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela prontuario2.carga_horarias
CREATE TABLE IF NOT EXISTS `carga_horarias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intervalo` int(11) NOT NULL,
  `inicio` time NOT NULL,
  `fim` time NOT NULL,
  `medico_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `carga_horarias_medico_id_unique` (`medico_id`),
  CONSTRAINT `carga_horarias_medico_id_foreign` FOREIGN KEY (`medico_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela prontuario2.consultas
CREATE TABLE IF NOT EXISTS `consultas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `horario` datetime NOT NULL,
  `obs` text COLLATE utf8mb4_unicode_ci,
  `status` enum('Primeira','Retorno','Nova') COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuario_id` int(10) unsigned NOT NULL,
  `valor` decimal(8,2) DEFAULT NULL,
  `paciente_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `atendida` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `consultas_usuario_id_foreign` (`usuario_id`),
  KEY `consultas_paciente_id_foreign` (`paciente_id`),
  CONSTRAINT `consultas_paciente_id_foreign` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `consultas_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela prontuario2.dias
CREATE TABLE IF NOT EXISTS `dias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `medico_id` int(10) unsigned DEFAULT NULL,
  `domingo` tinyint(4) NOT NULL DEFAULT '0',
  `segunda` tinyint(4) NOT NULL DEFAULT '0',
  `terca` tinyint(4) NOT NULL DEFAULT '0',
  `quarta` tinyint(4) NOT NULL DEFAULT '0',
  `quinta` tinyint(4) NOT NULL DEFAULT '0',
  `sexta` tinyint(4) NOT NULL DEFAULT '0',
  `sabado` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `dias_medico_id_foreign` (`medico_id`),
  CONSTRAINT `dias_medico_id_foreign` FOREIGN KEY (`medico_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela prontuario2.equipamentos
CREATE TABLE IF NOT EXISTS `equipamentos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela prontuario2.evolucoes
CREATE TABLE IF NOT EXISTS `evolucoes` (
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

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela prontuario2.ferias
CREATE TABLE IF NOT EXISTS `ferias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `medico_id` int(10) unsigned DEFAULT NULL,
  `data` date NOT NULL,
  `dias` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ferias_medico_id_foreign` (`medico_id`),
  CONSTRAINT `ferias_medico_id_foreign` FOREIGN KEY (`medico_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela prontuario2.medicamentos
CREATE TABLE IF NOT EXISTS `medicamentos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela prontuario2.medicos
CREATE TABLE IF NOT EXISTS `medicos` (
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

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela prontuario2.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela prontuario2.nao_medicos
CREATE TABLE IF NOT EXISTS `nao_medicos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` int(10) unsigned NOT NULL,
  `conselho` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `especialidade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cargo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `historico` tinyint(4) NOT NULL DEFAULT '0',
  `ferias` tinyint(4) NOT NULL DEFAULT '0',
  `cabecalho_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nao_medicos_usuario_id_unique` (`usuario_id`),
  KEY `nao_medicos_cabecalho_id_foreign` (`cabecalho_id`),
  CONSTRAINT `nao_medicos_cabecalho_id_foreign` FOREIGN KEY (`cabecalho_id`) REFERENCES `cabecalhos` (`id`) ON DELETE SET NULL,
  CONSTRAINT `nao_medicos_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela prontuario2.pacientes
CREATE TABLE IF NOT EXISTS `pacientes` (
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

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela prontuario2.permissao_postos
CREATE TABLE IF NOT EXISTS `permissao_postos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` int(10) unsigned NOT NULL,
  `cabecalho_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `permissao_postos_usuario_id_foreign` (`usuario_id`),
  KEY `permissao_postos_cabecalho_id_foreign` (`cabecalho_id`),
  CONSTRAINT `permissao_postos_cabecalho_id_foreign` FOREIGN KEY (`cabecalho_id`) REFERENCES `cabecalhos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permissao_postos_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela prontuario2.pescricao_equipamentos
CREATE TABLE IF NOT EXISTS `pescricao_equipamentos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `prescricao_id` int(10) unsigned NOT NULL,
  `equipamento_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pescricao_equipamentos_prescricao_id_foreign` (`prescricao_id`),
  KEY `pescricao_equipamentos_equipamento_id_foreign` (`equipamento_id`),
  CONSTRAINT `pescricao_equipamentos_equipamento_id_foreign` FOREIGN KEY (`equipamento_id`) REFERENCES `equipamentos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pescricao_equipamentos_prescricao_id_foreign` FOREIGN KEY (`prescricao_id`) REFERENCES `prescricaos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela prontuario2.pescricao_medicacaos
CREATE TABLE IF NOT EXISTS `pescricao_medicacaos` (
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

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela prontuario2.prescricaos
CREATE TABLE IF NOT EXISTS `prescricaos` (
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

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela prontuario2.receituarios
CREATE TABLE IF NOT EXISTS `receituarios` (
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

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela prontuario2.secretarios
CREATE TABLE IF NOT EXISTS `secretarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` int(10) unsigned NOT NULL,
  `cargo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `secretarios_usuario_id_unique` (`usuario_id`),
  CONSTRAINT `secretarios_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela prontuario2.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
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