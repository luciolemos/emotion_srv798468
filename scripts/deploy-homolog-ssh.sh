#!/usr/bin/env bash
set -euo pipefail

SSH_HOST="45.152.44.77"
SSH_PORT="65002"
SSH_USER="u372181157"
REMOTE_APP_DIR="/home/u372181157/domains/homolog.jersikacarvalhopsicologa.com/public_html"
REMOTE_PUBLIC_DIR="/home/u372181157/domains/homolog.jersikacarvalhopsicologa.com/public_html"
EXPECTED_BRANCH="homolog"

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_ROOT="$(cd "$SCRIPT_DIR/.." && pwd)"

cd "$PROJECT_ROOT"

CURRENT_BRANCH="$(git rev-parse --abbrev-ref HEAD)"
if [[ "$CURRENT_BRANCH" != "$EXPECTED_BRANCH" ]]; then
  echo "[error] branch atual: ${CURRENT_BRANCH}. Para homologacao, use a branch ${EXPECTED_BRANCH} neste checkout." >&2
  echo "[hint ] git checkout ${EXPECTED_BRANCH} && git pull --ff-only" >&2
  exit 1
fi

echo "[step] Validando caminhos remotos de homolog"
ssh -p "${SSH_PORT}" "${SSH_USER}@${SSH_HOST}" \
  "test -d '${REMOTE_APP_DIR}' && test -d '${REMOTE_PUBLIC_DIR}'"

echo "[step] Composer install (prod deps only)"
composer install --no-dev --optimize-autoloader

echo "[step] Sync app files to homolog"
rsync -az --delete \
  --exclude '.git/' \
  --exclude '.github/' \
  --exclude '.env' \
  --exclude 'node_modules/' \
  --exclude 'tests/' \
  --exclude 'storage/' \
  -e "ssh -p ${SSH_PORT}" \
  ./ "${SSH_USER}@${SSH_HOST}:${REMOTE_APP_DIR}/"

echo "[step] Sync public assets to homolog docroot"
rsync -az --delete \
  -e "ssh -p ${SSH_PORT}" \
  ./public/assets/ "${SSH_USER}@${SSH_HOST}:${REMOTE_PUBLIC_DIR}/assets/"

echo "[step] Sync .htaccess to homolog docroot"
scp -P "${SSH_PORT}" ./public/.htaccess \
  "${SSH_USER}@${SSH_HOST}:${REMOTE_PUBLIC_DIR}/.htaccess"

echo "[step] Run post-update on homolog"
ssh -p "${SSH_PORT}" "${SSH_USER}@${SSH_HOST}" \
  "bash ${REMOTE_APP_DIR}/scripts/deploy-post-update.sh --project-root ${REMOTE_APP_DIR} --skip-chown"

echo "[ok  ] homolog deploy finalizado."
