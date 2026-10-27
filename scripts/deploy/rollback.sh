#!/usr/bin/env bash
set -euo pipefail
export PATH="/usr/local/bin:/usr/bin:/bin:$PATH"
BASE="$HOME/deploy/capucafe"
DOMAIN="$HOME/domains/capuccinocafe.pl"
RELEASES="$DOMAIN/.capucafe-releases"
LIVE="$DOMAIN/public_html/wp-content/themes/capucafe_wp_template"
if [[ "${CAPUCAFE_DEPLOY_LOCKED:-}" != 1 ]]; then
  exec lockf -t 0 "$BASE/deploy.lock" env CAPUCAFE_DEPLOY_LOCKED=1 bash "$0"
fi
PREVIOUS="$(cat "$BASE/previous-release")"
[[ "$PREVIOUS" == "$RELEASES/"* || "$PREVIOUS" == "$BASE/backups/"* ]]
[[ -d "$PREVIOUS" ]]
if [[ -L "$LIVE" ]]; then
  CURRENT="$(readlink "$LIVE")"
elif [[ -d "$LIVE" && "$PREVIOUS" == "$RELEASES/"* ]]; then
  [[ -z "$(git -C "$LIVE" status --porcelain)" ]]
  CURRENT="$BASE/backups/original-$(date -u +%Y%m%dT%H%M%SZ)"
  mv "$LIVE" "$CURRENT"
else
  echo 'Unexpected live theme state.' >&2; exit 1
fi
if [[ "$PREVIOUS" == "$BASE/backups/"* ]]; then
  mv "$LIVE" "$BASE/rollback-link-$(date -u +%Y%m%dT%H%M%SZ)"
  mv "$PREVIOUS" "$LIVE"
  RESTORED="$LIVE"
else
  ln -s "$PREVIOUS" "$LIVE.rollback"
  php82 -r 'if (!rename($argv[1], $argv[2])) exit(1);' "$LIVE.rollback" "$LIVE"
  RESTORED="$PREVIOUS"
fi
printf '%s\n' "$CURRENT" > "$BASE/previous-release"
if [[ -f "$RESTORED/.release-sha" ]]; then
  cp "$RESTORED/.release-sha" "$BASE/current-sha"
else
  git -C "$RESTORED" rev-parse HEAD > "$BASE/current-sha"
fi
response="$BASE/health-rollback-$(date -u +%Y%m%dT%H%M%SZ).html"
curl --fail --silent --show-error --location --max-time 60 "https://capuccinocafe.pl/?capucafe_rollback=$(date +%s)" > "$response"
php82 "$BASE/validate-response.php" "$response"
echo "Restored: $PREVIOUS"
