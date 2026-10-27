import { watch } from 'node:fs';
import { spawn } from 'node:child_process';

// Watching the repository recursively would also watch Local's live database.
// Restrict events to actual template sources, including top-level PHP files.
let timer;
let running = false;
let pending = false;
function build() {
  if (running) { pending = true; return; }
  running = true;
  const child = spawn('npm', ['run', 'build:css'], { stdio: 'inherit' });
  child.on('exit', (code) => {
    running = false;
    if (code !== 0) process.exit(code || 1);
    if (pending) { pending = false; build(); }
  });
}
function changed(event, filename) {
  if (!filename || !/\.(php|js|css)$/.test(filename)) return;
  clearTimeout(timer);
  timer = setTimeout(build, 200);
}
watch('.', { recursive: false }, changed);
for (const directory of ['resources', 'headers', 'inc', 'woocommerce']) {
  watch(directory, { recursive: true }, changed);
}
build();
