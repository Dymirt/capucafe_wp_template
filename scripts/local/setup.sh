#!/usr/bin/env bash
set -euo pipefail
ROOT="$(cd "$(dirname "$0")/../.." && pwd)"
PUBLIC="$ROOT/.local/site/app/public"
WP="$ROOT/scripts/local/wp.sh"
[[ -f "$PUBLIC/wp-config.php" ]] || { echo 'Import the site in Local first (see README.md).'; exit 1; }
mkdir -p "$PUBLIC/wp-content/mu-plugins"
cp "$ROOT/scripts/local/local-guard.php" "$PUBLIC/wp-content/mu-plugins/capucafe-local.php"
for setting in 'WP_ENVIRONMENT_TYPE local' 'WP_DEBUG true' 'WP_DEBUG_LOG true' 'WP_DEBUG_DISPLAY false' 'DISABLE_WP_CRON true' 'AUTOMATIC_UPDATER_DISABLED true'; do
  read -r key value <<< "$setting"
  if [[ "$value" == true || "$value" == false ]]; then
    bash "$WP" config set "$key" "$value" --raw
  else
    bash "$WP" config set "$key" "$value"
  fi
done
bash "$WP" --skip-plugins --skip-themes plugin deactivate mailin eparagony furgonetka global-payments-woocommerce woo-payu-payment-gateway google-site-kit health-check || exit 1
bash "$WP" --skip-plugins --skip-themes option update blog_public 0
bash "$WP" --skip-plugins --skip-themes search-replace 'https://capuccinocafe.pl' 'http://capuccino-dev.local' --all-tables-with-prefix --skip-columns=guid --precise --quiet
bash "$WP" --skip-plugins --skip-themes search-replace 'http://capuccinocafe.pl' 'http://capuccino-dev.local' --all-tables-with-prefix --skip-columns=guid --precise --quiet
bash "$WP" --skip-plugins --skip-themes option update home 'http://capuccino-dev.local'
bash "$WP" --skip-plugins --skip-themes option update siteurl 'http://capuccino-dev.local'
THEME="$PUBLIC/wp-content/themes/capucafe_wp_template"
if [[ ! -L "$THEME" ]]; then
  [[ ! -e "$THEME" ]] || mv "$THEME" "$ROOT/.local/backups/imported-theme-$(date +%Y%m%d%H%M%S)"
  ln -s "$ROOT" "$THEME"
fi
bash "$WP" --skip-plugins --skip-themes theme activate capucafe_wp_template
bash "$WP" rewrite flush
echo 'Local site ready: http://capuccino-dev.local — edit the theme in the repository.'
