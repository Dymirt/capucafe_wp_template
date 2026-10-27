#!/usr/bin/env bash
set -euo pipefail
export PATH="/usr/local/bin:/usr/bin:/bin:$PATH"
umask 022
BASE="$HOME/deploy/capucafe"
LIVE="$HOME/domains/capuccinocafe.pl/public_html/wp-content/themes/capucafe_wp_template"
WP_ROOT="$HOME/domains/capuccinocafe.pl/public_html"
REPO='git@github.com:Dymirt/capucafe_wp_template.git'
SHA="${1:-}"
[[ "$SHA" =~ ^[0-9a-f]{40}$ ]] || { echo 'Expected a full commit SHA.' >&2; exit 2; }
if [[ "${CAPUCAFE_DEPLOY_LOCKED:-}" != 1 ]]; then
  exec lockf -t 0 "$BASE/deploy.lock" env CAPUCAFE_DEPLOY_LOCKED=1 bash "$0" "$SHA"
fi
exec > >(tee -a "$BASE/deploy.log") 2>&1
echo "Deployment started: $(date -u) $SHA"
[[ "$(node --version)" == v22.* ]] || { echo 'Node 22 is required.'; exit 1; }
if [[ ! -d "$BASE/repository.git" ]]; then
  git clone --bare "$REPO" "$BASE/repository.git"
fi
git --git-dir="$BASE/repository.git" fetch --prune origin '+refs/heads/main:refs/heads/main'
[[ "$(git --git-dir="$BASE/repository.git" rev-parse refs/heads/main)" == "$SHA" ]] || {
  echo 'Commit is no longer the current main head. Refusing stale deployment.'; exit 1;
}
STAMP="$(date -u +%Y%m%dT%H%M%SZ)"
RELEASE="$BASE/releases/$STAMP-$SHA"
mkdir -p "$RELEASE"
git --git-dir="$BASE/repository.git" archive "$SHA" | tar -xf - -C "$RELEASE"
cd "$RELEASE"
npm ci --no-audit --no-fund
npm run build
while IFS= read -r file; do php82 -l "$file"; done < <(find . -path ./node_modules -prune -o -type f -name '*.php' -print) > "$BASE/php-lint-$STAMP.log"
rm -rf node_modules
printf '%s\n' "$SHA" > .release-sha
PREVIOUS=''
FIRST_BACKUP=''
SWITCHED=0
restore_previous() {
  code=$?
  trap - EXIT
  if [[ "$code" != 0 && "$SWITCHED" == 1 ]]; then
    echo 'Health check failed; restoring previous theme.'
    if [[ "$PREVIOUS" == "$BASE/backups/"* ]]; then
      mv "$LIVE" "$BASE/failed-link-$STAMP"
      mv "$PREVIOUS" "$LIVE"
    else
      ln -s "$PREVIOUS" "$LIVE.rollback"
      php82 -r 'if (!rename($argv[1], $argv[2])) exit(1);' "$LIVE.rollback" "$LIVE"
    fi
  elif [[ "$code" != 0 && -n "$FIRST_BACKUP" && ! -e "$LIVE" ]]; then
    mv "$FIRST_BACKUP" "$LIVE"
  fi
  exit "$code"
}
trap restore_previous EXIT
if [[ -L "$LIVE" ]]; then
  PREVIOUS="$(readlink "$LIVE")"
elif [[ -d "$LIVE" ]]; then
  # Refuse to replace uncommitted manual fixes on the original production theme.
  [[ -z "$(git -C "$LIVE" status --porcelain)" ]] || { echo 'Live theme has local changes; deployment stopped.'; exit 1; }
  FIRST_BACKUP="$BASE/backups/original-$STAMP"
  PREVIOUS="$FIRST_BACKUP"
else
  echo 'Live theme is missing; deployment stopped.'; exit 1
fi
NEXT="$LIVE.next"
[[ ! -e "$NEXT" && ! -L "$NEXT" ]] || { echo 'A pending theme switch exists; inspect it first.'; exit 1; }
ln -s "$RELEASE" "$NEXT"
if [[ -n "$FIRST_BACKUP" ]]; then mv "$LIVE" "$FIRST_BACKUP"; fi
php82 -r 'if (!rename($argv[1], $argv[2])) exit(1);' "$NEXT" "$LIVE"
SWITCHED=1
# Check the active theme and origin HTTP, bypassing stale intermediate caches.
[[ "$(wp --path="$WP_ROOT" --skip-plugins --skip-themes option get stylesheet)" == capucafe_wp_template ]]
curl --fail --silent --show-error --location --retry 2 --max-time 60 "https://capuccinocafe.pl/?capucafe_deploy=$SHA" > "$BASE/health-$STAMP.html"
! grep -Eqi 'Fatal error|There has been a critical error|W witrynie wystąpił krytyczny błąd' "$BASE/health-$STAMP.html"
curl --fail --silent --show-error --location --max-time 30 "https://capuccinocafe.pl/wp-content/themes/capucafe_wp_template/public/css/tailwind.css?deploy=$SHA" > /dev/null
printf '%s\n' "$PREVIOUS" > "$BASE/previous-release"
printf '%s\n' "$SHA" > "$BASE/current-sha"
trap - EXIT
echo "Deployment completed: $SHA"
