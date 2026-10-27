#!/usr/bin/env bash
set -euo pipefail
# The GitHub SSH key may only invoke this exact command, with no shell access.
if [[ "${SSH_ORIGINAL_COMMAND:-}" =~ ^deploy\ ([0-9a-f]{40})$ ]]; then
  exec /bin/bash "$HOME/deploy/capucafe/deploy.sh" "${BASH_REMATCH[1]}"
fi
echo 'Only deploy <40-character SHA> is permitted.' >&2
exit 2
