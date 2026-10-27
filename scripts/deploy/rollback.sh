#!/usr/bin/env bash
set -euo pipefail
export PATH="/usr/local/bin:/usr/bin:/bin:$PATH"
BASE="$HOME/deploy/capucafe"
LIVE="$HOME/domains/capuccinocafe.pl/public_html/wp-content/themes/capucafe_wp_template"
if [[ "${CAPUCAFE_DEPLOY_LOCKED:-}" != 1 ]]; then
  exec lockf -t 0 "$BASE/deploy.lock" env CAPUCAFE_DEPLOY_LOCKED=1 bash "$0"
fi
PREVIOUS="$(cat "$BASE/previous-release")"
[[ "$PREVIOUS" == "$BASE/releases/"* || "$PREVIOUS" == "$BASE/backups/"* ]]
[[ -d "$PREVIOUS" && -L "$LIVE" ]]
CURRENT="$(readlink "$LIVE")"
ln -s "$PREVIOUS" "$LIVE.rollback"
php82 -r 'if (!rename($argv[1], $argv[2])) exit(1);' "$LIVE.rollback" "$LIVE"
printf '%s\n' "$CURRENT" > "$BASE/previous-release"
if [[ -f "$PREVIOUS/.release-sha" ]]; then
  cp "$PREVIOUS/.release-sha" "$BASE/current-sha"
else
  git -C "$PREVIOUS" rev-parse HEAD > "$BASE/current-sha"
fi
curl --fail --silent --show-error --location --max-time 60 'https://capuccinocafe.pl/' > /dev/null
echo "Restored: $PREVIOUS"
