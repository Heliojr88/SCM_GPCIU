# Seguranca — SCM_GPCIU

Este documento resume as camadas de seguranca ativas no SCM_GPCIU e os
procedimentos operacionais exigidos.

## Variaveis de ambiente obrigatorias

| Variavel          | Descricao                                                                |
|-------------------|--------------------------------------------------------------------------|
| `APP_ENV`         | `production` (default) ou `development`. Controla exibicao de erros.     |
| `SCM_APP_KEY`     | Chave simetrica, 64 caracteres hex (32 bytes). Usada por `scm_encrypt` e `scm_hmac`. |
| `DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS` | Conexao PDO.                                  |

Gere a chave com:

```bash
php -r "echo bin2hex(random_bytes(32));"
```

Armazene em secret manager (cPanel env, Docker secret, Kubernetes secret).
Nunca comite a chave. A perda da chave torna os dados criptografados
irrecuperaveis.

## Testes automatizados

```bash
composer install
./vendor/bin/phpunit
```

A suite cobre: `e()`, `req_int/req_id/req_str`, rate limit, `scm_encrypt`/`scm_decrypt`/`scm_hmac`,
`upload_image` (com `SCM_UPLOAD_TEST_MODE`). O CI (`.github/workflows/ci.yml`) roda
lint, PHPStan nivel 3 e PHPUnit em cada push/PR.

## Criptografia de SIAPE/CPF

Estrategia: guardar em paralelo `<campo>_cipher` (ciphertext versionado
`v1:base64(nonce|cipher)` via libsodium secretbox) e `<campo>_hmac` (sha256 HMAC
deterministico, indexavel) para suportar buscas sem decriptar.

Roteiro:

1. Aplicar `DB/migrations/002_pii_columns.sql`.
2. Exportar `SCM_APP_KEY` no host.
3. Executar `php bin/backfill_pii.php --dry-run` para validar.
4. Executar `php bin/backfill_pii.php` em janela de baixo trafego.
5. Atualizar as camadas de leitura/escrita (ex.: modelo `Usuarios`) para:
   - gravar em `siape_cipher`/`siape_hmac` (idem CPF) em INSERT/UPDATE;
   - consultar por `siape_hmac = scm_hmac($input)`;
   - decriptar `siape_cipher` apenas no momento da exibicao autorizada.
6. Em uma migration posterior (`003_drop_plain_pii.sql`), remover as colunas
   `Siape` e `CPF` em texto claro.

## Rotacao de logs

O script `bin/rotate_logs.php` rotaciona `public_html/storage/logs/app.log`
para `app-YYYYMMDD-HHMMSS.log.gz`, mantendo os 14 arquivos mais recentes.

Cron sugerido:

```
0 3 * * * /usr/bin/php /caminho/SCM_GPCIU/bin/rotate_logs.php >> /var/log/scm-rotate.log 2>&1
```

Ajustes via env: `SCM_LOG_MAX_BYTES` (default 10 MiB), `SCM_LOG_KEEP` (default 14).

## Auditoria

Acoes sensiveis sao gravadas na tabela `audit_log` (migration `001_audit_log.sql`).
Em caso de indisponibilidade do banco, `audit_log()` faz fallback para o arquivo
de log via `scm_log('warning', ...)`. Nenhuma operacao de negocio quebra por
falha de auditoria.

Acoes rastreadas atualmente: `login.success`, `login.failure`, `user.create`,
`user.activate`, `user.deactivate`, `password.reset.request`, `password.reset`,
`material.create`, `material.update`, `material.baixa`, `material.ativa`,
`tramitacao.create`.

## Rate limiting

`rate_limit_hit()` usa arquivos JSON em `storage/ratelimit/` com `LOCK_EX`.
Limites atuais:

| Endpoint                  | Chave                            | Janela           |
|---------------------------|----------------------------------|------------------|
| `login.php`               | `login:<ip>`                     | 5 tentativas/5min|
| `form.php` (cadastro)     | `signup:<ip>`                    | 3 tentativas/1h  |
| `recuperaSenha.php`       | `passreset:<ip>`                 | 3 tentativas/1h  |

## Uploads

`upload_image()` valida:

- `UPLOAD_ERR_OK`
- `is_uploaded_file` (bypass apenas em `SCM_UPLOAD_TEST_MODE`)
- Tamanho maximo (default 2 MiB)
- MIME real via `finfo` (whitelist `image/jpeg`, `image/png`, `image/gif`)
- Nome gerado por `bin2hex(random_bytes(16))` + extensao do MIME

Arquivos aceitos sao gravados com `chmod 0644`.

## Controles no nivel do servidor

`public_html/public/.htaccess` bloqueia:

- Extensoes sensiveis: `*.sql`, `*.env`, `*.log`, `*.ini`, `*.bak`, `*.old`,
  `*.orig`, `*.swp`, `*.pem`, `*.key`
- Arquivos de teste: `teste.php`, `login2.php`
- Listagem de diretorios (`Options -Indexes`)
