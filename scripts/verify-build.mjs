import { statSync } from 'node:fs';

for (const file of ['css/tailwind.css', 'css/screen.css', 'css/screen.asset.php', 'css/editor.css', 'js/frontend.js', 'js/frontend.asset.php', 'js/editor.asset.php']) {
  if (statSync(`public/${file}`).size === 0) throw new Error(`Empty build output: ${file}`);
}
console.log('Required theme assets exist.');
