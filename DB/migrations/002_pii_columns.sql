-- Colunas para armazenar SIAPE/CPF criptografados com lookup por HMAC.
--
-- Estrategia:
--   * <campo>_cipher     TEXT       -> ciphertext versionado (scm_encrypt)
--   * <campo>_hmac       CHAR(64)   -> hash_hmac('sha256', valor, key) em hex
--   * INDEX (<campo>_hmac)          -> permite buscas O(log n) sem decriptar
--
-- O plaintext original continua por enquanto na tabela para backfill incremental.
-- Apos validar a migracao completa, remover os campos em texto claro numa migration posterior.

ALTER TABLE `usuarios`
  ADD COLUMN `siape_cipher` TEXT NULL AFTER `Siape`,
  ADD COLUMN `siape_hmac`   CHAR(64) NULL AFTER `siape_cipher`,
  ADD COLUMN `cpf_cipher`   TEXT NULL AFTER `CPF`,
  ADD COLUMN `cpf_hmac`     CHAR(64) NULL AFTER `cpf_cipher`;

CREATE INDEX `idx_usuarios_siape_hmac` ON `usuarios` (`siape_hmac`);
CREATE INDEX `idx_usuarios_cpf_hmac`   ON `usuarios` (`cpf_hmac`);
