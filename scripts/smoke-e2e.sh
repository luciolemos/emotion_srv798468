#!/usr/bin/env bash
set -euo pipefail

BASE_URL="${1:-http://127.0.0.1:8000/}"
PLAYWRIGHT_BROWSER="${PLAYWRIGHT_BROWSER:-chromium}"

if [[ -z "${PLAYWRIGHT_INSTALL_DEPS:-}" ]]; then
  if [[ "${CI:-}" == "true" ]]; then
    PLAYWRIGHT_INSTALL_DEPS="false"
  else
    PLAYWRIGHT_INSTALL_DEPS="true"
  fi
fi

PROJECT_ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
cd "$PROJECT_ROOT"

echo "[step] Node dependencies"
if [[ ! -d node_modules/@playwright/test ]]; then
  npm install --no-audit --no-fund
else
  echo "[info] @playwright/test ja instalado em node_modules."
fi

echo "[step] Playwright browsers install"
INSTALL_ARGS=("$PLAYWRIGHT_BROWSER")
if [[ "$PLAYWRIGHT_INSTALL_DEPS" == "true" ]]; then
  INSTALL_ARGS=(--with-deps "${INSTALL_ARGS[@]}")
else
  echo "[info] Pulando dependencias de sistema do Playwright. Use PLAYWRIGHT_INSTALL_DEPS=true para habilitar."
fi
npx playwright install "${INSTALL_ARGS[@]}"

echo "[step] Playwright smoke e2e"
E2E_BASE_URL="$BASE_URL" npx playwright test --config=playwright.config.js

echo "[ok  ] smoke e2e passou."
