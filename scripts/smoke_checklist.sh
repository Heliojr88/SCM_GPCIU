#!/usr/bin/env bash
set -euo pipefail

# ALTERADO: Checklist executável de smoke test local para fase de validação.
echo "== Smoke checklist SCM =="

ROOT_DIR="$(cd "$(dirname "$0")/.." && pwd)"
cd "$ROOT_DIR"

echo "[1/5] Verificando sintaxe PHP dos arquivos críticos..."
php -l public_html/app/config.php >/dev/null
php -l public_html/app/pdo.php >/dev/null
php -l public_html/public/login.php >/dev/null
echo "  OK: sintaxe PHP"

echo "[2/5] Verificando presença das variáveis de ambiente de banco..."
missing=0
for var in SCM_DB_HOST SCM_DB_NAME SCM_DB_USER SCM_DB_PASS; do
  if [[ -z "${!var:-}" ]]; then
    echo "  WARN: variável ausente -> $var"
    missing=1
  fi
done
if [[ "$missing" -eq 0 ]]; then
  echo "  OK: variáveis de ambiente definidas"
else
  echo "  INFO: defina as variáveis para executar fluxos com banco."
fi

echo "  INFO: variáveis opcionais de segurança (auth/sessão):"
for var in SCM_AUTH_ALLOW_LEGACY_MD5 SCM_SESSION_TIMEOUT SCM_LOGIN_MAX_ATTEMPTS SCM_LOGIN_LOCK_SECONDS; do
  if [[ -z "${!var:-}" ]]; then
    echo "  WARN(opcional): variável ausente -> $var (usando default do sistema)"
  else
    echo "  OK(opcional): $var definido"
  fi
done

echo "[3/5] Checklist manual recomendado (login/cadastro/recuperação/tramitação):"
cat <<'EOF'
  - Login com usuário ativo.
  - Login com usuário legado (MD5) e confirmar migração de hash.
  - Cadastro de usuário novo.
  - Recuperação de senha.
  - Cadastro de material + itens.
  - Tramitação individual e coletiva.
EOF

echo "[4/5] Verificando scripts versionados alterados..."
git status --short

echo "[5/5] Smoke checklist finalizado."
