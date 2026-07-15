#!/usr/bin/env bash
set -euo pipefail

SSH_HOST="212.85.6.236"
SSH_PORT="65002"
SSH_USER="u372181157"
REMOTE_APP_DIR="/home/u372181157/apps/emotion-prod/current"
REMOTE_PUBLIC_DIR="/home/u372181157/public_html"

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_ROOT="$(cd "$SCRIPT_DIR/.." && pwd)"

cd "$PROJECT_ROOT"

echo "[step] Composer install (prod deps only)"
composer install --no-dev --optimize-autoloader

echo "[step] Sync app files to production"
rsync -az --delete \
  --exclude '.git/' \
  --exclude '.github/' \
  --exclude '.env' \
  --exclude 'node_modules/' \
  --exclude 'tests/' \
  --exclude 'storage/' \
  -e "ssh -p ${SSH_PORT}" \
  ./ "${SSH_USER}@${SSH_HOST}:${REMOTE_APP_DIR}/"

echo "[step] Sync public assets to production docroot"
rsync -az --delete \
  -e "ssh -p ${SSH_PORT}" \
  ./public/assets/ "${SSH_USER}@${SSH_HOST}:${REMOTE_PUBLIC_DIR}/assets/"

echo "[step] Sync .htaccess to production docroot"
scp -P "${SSH_PORT}" ./public/.htaccess \
  "${SSH_USER}@${SSH_HOST}:${REMOTE_PUBLIC_DIR}/.htaccess"

echo "[step] Run post-update on production"
ssh -p "${SSH_PORT}" "${SSH_USER}@${SSH_HOST}" \
  "bash ${REMOTE_APP_DIR}/scripts/deploy-post-update.sh --project-root ${REMOTE_APP_DIR} --skip-chown"

echo "[ok  ] production deploy finalizado."
