#!/usr/bin/env bash
set -euo pipefail
ROOT="$(cd "$(dirname "$0")/../.." && pwd)"
LOCAL_SUPPORT="$HOME/Library/Application Support/Local"
SITE_ID="$(node -e 'const fs=require("fs");const path=require("path");const sites=JSON.parse(fs.readFileSync(process.argv[1]));const site=Object.values(sites).find(s=>path.resolve(s.path.replace(/^~/,process.env.HOME))===process.argv[2]);if(!site)process.exit(1);process.stdout.write(site.id)' "$LOCAL_SUPPORT/sites.json" "$ROOT/.local/site")"
ENTRY="$LOCAL_SUPPORT/ssh-entry/$SITE_ID.sh"
# Read Local's generated exports without running its interactive shell.
[[ -f "$ENTRY" ]] || { echo "Open Site shell in Local once to generate $ENTRY" >&2; exit 1; }
eval "$(sed -n '/^export /p' "$ENTRY")"
cd "$ROOT/.local/site/app/public"
exec php /Applications/Local.app/Contents/Resources/extraResources/bin/wp-cli/wp-cli.phar "$@"
