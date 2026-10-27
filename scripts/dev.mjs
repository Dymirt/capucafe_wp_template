import { spawn } from 'node:child_process';

// Create a complete initial build before launching both development watchers.
const initial = spawn('npm', ['run', 'build'], { stdio: 'inherit' });
initial.on('exit', (code) => {
  if (code !== 0) process.exit(code || 1);
  const children = ['start', 'start:css'].map((name) => spawn('npm', ['run', name], { stdio: 'inherit' }));
  const stop = (code = 0) => {
    for (const child of children) child.kill('SIGTERM');
    process.exit(code);
  };
  for (const signal of ['SIGINT', 'SIGTERM']) process.on(signal, () => stop());
  for (const child of children) child.on('exit', (code) => stop(code || 0));
});
