-- Audit log para registrar acoes sensiveis do sistema.
-- Executar uma vez no banco antes de ativar chamadas audit_log() no codigo.

CREATE TABLE IF NOT EXISTS `audit_log` (
  `id`        BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `occurred_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `siape`     VARCHAR(30) DEFAULT NULL,
  `action`    VARCHAR(80) NOT NULL,
  `target`    VARCHAR(120) DEFAULT NULL,
  `details`   TEXT DEFAULT NULL,
  `ip`        VARCHAR(45) DEFAULT NULL,
  `user_agent` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_audit_log_siape`  (`siape`),
  KEY `idx_audit_log_action` (`action`),
  KEY `idx_audit_log_time`   (`occurred_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
