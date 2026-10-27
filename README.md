# Capuccino Cafe — szablon WordPress

Repozytorium zawiera motyw potomny Storefront. WordPress, baza, wtyczki, media i klucze są wyłącznie lokalnie w ignorowanym katalogu `.local/`. Nie dodawaj ich do GitHuba (repozytorium jest publiczne).

## Praca na tym Macu

1. W aplikacji **Local** wybierz **Capuccino Dev** i kliknij **Start site**.
2. Otwórz <http://capuccino-dev.local>. Panel: <http://capuccino-dev.local/wp-admin/>.
3. Lokalne dane logowania są w `.local/access.txt` (osobne konto `capucafe-dev`).
4. Otwórz terminal w tym repozytorium:

   ```sh
   nvm use # Node 22; przy pierwszym uruchomieniu: nvm install
   npm ci
   npm run dev
   ```

PHP i pliki szablonu edytuj bezpośrednio tutaj i odświeżaj przeglądarkę. `npm run dev` kompiluje i obserwuje JavaScript, SCSS oraz Tailwind. Gotowy build: `npm run build` (webpack + Tailwind + sprawdzenie plików wynikowych).

- PHP: pliki główne, `headers/`, `inc/`, `woocommerce/`.
- Tailwind: `resources/css/tailwind.css`, klasy w szablonach PHP i `tailwind.config.js`.
- SCSS: `resources/scss/`.
- JS: `resources/js/`.
- Wygenerowanych plików `public/` nie edytuj ręcznie.

Local przechowuje witrynę w `.local/site/`. Jej katalog `app/public/wp-content/themes/capucafe_wp_template` jest dowiązaniem do repozytorium. Motyw nadrzędny Storefront i WooCommerce są wymagane.

WP-CLI korzystający z PHP i MySQL Local:

```sh
npm run local:wp -- option get siteurl
npm run local:wp -- cache flush
```

Przy pierwszym użyciu nowej instalacji Local kliknij **Site shell**, aby Local wygenerował ustawienia środowiska. Witryna musi być uruchomiona.

Lokalne integracje wysyłające dane (Brevo, eParagony, Furgonetka, płatności, Site Kit) są nieaktywne. Lokalna wtyczka MU blokuje e-mail, zewnętrzne żądania HTTP WordPressa, webhooks i bramki płatnicze. Cron i automatyczne aktualizacje są wyłączone. Zrzut zawiera prawdziwe dane sklepu: przechowuj `.local/` prywatnie. Zachowane wtyczki umożliwiają pracę nad wyglądem sklepu; płatności na tej kopii są celowo niedostępne. Istniejące ostrzeżenia PHP trafiają do `.local/site/app/public/wp-content/debug.log`.

## Git i automatyczne wdrożenia

Pracuj na osobnych gałęziach i kieruj pull requesty do `main`:

```sh
git switch main
git pull --ff-only
git switch -c codex/nazwa-poprawki
# edycja plików
npm run build
git add <zmienione-pliki>
git commit -m "Opis poprawki"
git push -u origin HEAD
```

**Każdy push/merge do `main` wdraża motyw produkcyjny** na <https://capuccinocafe.pl>. Gałęzie i pull requesty uruchamiają CI bez wdrożenia. Workflow można też uruchomić ręcznie w GitHub Actions, wybierając `main`.

CI instaluje zależności przez `npm ci`, kompiluje JS/SCSS i Tailwind oraz sprawdza składnię PHP. Workflow wdrożenia ponownie sprawdza build, następnie łączy się przez dedykowany klucz SSH. Serwer:

1. Blokuje równoległe wdrożenia i pobiera aktualny `main` z GitHuba.
2. Sprawdza pełny SHA commita; odrzuca stare lub inne commity.
3. Tworzy osobny katalog wydania wewnątrz katalogu domeny (zgodnie z `open_basedir`), wykonuje `npm ci`, `npm run build` i sprawdza PHP 8.2 oraz odczyt plików przy ograniczeniu ścieżek.
4. Usuwa `node_modules` z gotowego wydania i przełącza dowiązanie aktywnego motywu.
5. Sprawdza HTTP strony głównej, sklepu i CSS. Odrzuca również odpowiedź HTTP 200 zawierającą błąd `open_basedir`/fatal error lub bez arkusza aktywnego szablonu; przy błędzie automatycznie przywraca poprzedni motyw.

Pierwsze wdrożenie przenosi dotychczasowy katalog motywu (z historią Git i gotowymi zasobami) do prywatnej kopii zapasowej. Kolejne przełączenia dowiązania są atomowe. Baza produkcyjna, zamówienia, uploady, rdzeń i wtyczki nie są wdrażane z tego repozytorium.

### Konfiguracja serwera

- SSH: alias `cappucinocafe` na tym Macu.
- Katalog wdrożeń: `~/deploy/capucafe/`.
- Aktywny motyw: `~/domains/capuccinocafe.pl/public_html/wp-content/themes/capucafe_wp_template`.
- Wydania: `~/domains/capuccinocafe.pl/.capucafe-releases/` (poza `public_html`, wewnątrz dozwolonego drzewa domeny).
- Kopie zapasowe: `~/deploy/capucafe/backups/`.
- Log wdrożeń: `~/deploy/capucafe/deploy.log`.
- Wymagane: Node 22, npm, PHP 8.2 (`php82`), WP-CLI, Git, curl, FreeBSD `lockf`.

Sekrety GitHub Actions: `PRODUCTION_SSH_KEY` oraz `PRODUCTION_SSH_KNOWN_HOSTS`. Klucz wdrożeniowy ma wymuszone polecenie `dispatch.sh` oraz restrykcje SSH: nie udostępnia interaktywnej powłoki ani tuneli. Dostęp serwera do repozytorium korzysta z istniejącego klucza GitHub na serwerze. Klucze prywatne nie trafiają do repozytorium.

Skrypty bootstrapu są instalowane poza katalogiem publicznym. Po świadomej zmianie `scripts/deploy/` zaktualizuj je ręcznie z zaufanej kopii:

```sh
scp scripts/deploy/validate-response.php cappucinocafe:deploy/capucafe/
scp scripts/deploy/{deploy,dispatch,rollback}.sh cappucinocafe:deploy/capucafe/
ssh cappucinocafe 'chmod 700 ~/deploy/capucafe/*.sh ~/deploy/capucafe/validate-response.php'
```

Ręczne przywrócenie poprzedniej wersji:

```sh
ssh cappucinocafe 'bash ~/deploy/capucafe/rollback.sh'
```

Poprzednie wydania nie są automatycznie kasowane. Porządkuj je okresowo po potwierdzeniu poprawności wdrożeń, zachowując aktywne wydanie, poprzednie wydanie oraz oryginalną kopię motywu.

PHP na hostingu rozwiązuje dowiązania przed sprawdzeniem `open_basedir`. Docelowe pliki motywu muszą znajdować się wewnątrz `~/domains/capuccinocafe.pl/`; dowiązanie z `public_html` do `~/deploy/` nie spełnia tego warunku. Repozytorium Git, logi i prywatne kopie pozostają w `~/deploy/capucafe/`. Nie wyłączaj ani nie poszerzaj `open_basedir`, aby obejść błąd położenia wydania.

Regresję kontroli odpowiedzi HTTP można sprawdzić lokalnie: `php tests/deploy-health-test.php`. CI uruchamia ten test przed wdrożeniem. Obejmuje on ostrzeżenie `open_basedir` przy HTTP 200, błąd krytyczny oraz cichy powrót do Storefront.

## Odtworzenie lokalnej kopii

Z produkcji pobrano bazę przez `wp db export --single-transaction --quick --skip-lock-tables` oraz `wp-content` przez `rsync` (bez `.git`, `node_modules`, cache i katalogów aktualizacji). Media są pełną lokalną kopią.

Archiwum `.local/capuccino-local.zip` zawiera bazę, wtyczki, motywy i lokalną wtyczkę ochronną, bez mediów. W Local wybierz **File → Import site**, nazwę **Capuccino Dev**, domenę `capuccino-dev.local` i ścieżkę `<repo>/.local/site`. Po imporcie skopiuj media do `app/public/wp-content/uploads`, kliknij **Site shell** i uruchom:

```sh
npm ci
npm run build
npm run local:setup
```

`local:setup` wyłącza integracje, ustawia lokalne adresy z obsługą danych serializowanych i podłącza repozytorium jako aktywny szablon. Nie pobiera ani nie nadpisuje bazy. Ponowny import bazy wykonuj dopiero po zapisaniu potrzebnych lokalnych zmian.
