# Praca nad szablonem Capuccino Cafe

## Projekt i środowisko

To motyw potomny WordPress Storefront, z własnymi widokami i logiką WooCommerce. Przeczytaj [README.md](README.md) przed uruchamianiem środowiska lub wdrożeniem. Ustalenia audytu i priorytety napraw są w [docs/AUDIT-2026-10-27.md](docs/AUDIT-2026-10-27.md).

- Kod motywu jest w katalogu głównym repozytorium. Local uruchamia witrynę **Capuccino Dev** pod `http://capuccino-dev.local`.
- `.local/site/app/public/wp-content/themes/capucafe_wp_template` jest dowiązaniem do repozytorium. Nie kopiuj tam drugiej wersji szablonu.
- Node 22 z `.nvmrc`; PHP lokalnie 8.2 z Local; na serwerze sprawdzaj zgodność z `php82`. Nagłówek motywu deklaruje minimum PHP 8.1 — nie podnoś tego wymagania przypadkiem.
- `npm ci` instaluje zależności; `npm run dev` obserwuje JS, SCSS, PHP i źródła Tailwinda; `npm run build` wykonuje kompletny build i sprawdza wymagane pliki wynikowe.
- `npm run local:wp -- <polecenie>` korzysta z WP-CLI i bazy Local. Witryna musi działać; po pierwszej instalacji kliknij w Local **Site shell**.
- `.local/` zawiera bazę sklepu, dane klientów, media i klucze. Nie dodawaj tych plików, danych logowania, logów ani zrzutów prywatnych ekranów do Git lub raportów publicznych.
- Zachowaj lokalne blokady e-maili, płatności, webhooków, crona i zewnętrznych integracji. Ich brak działania w Local nie dowodzi awarii produkcji.

## Wymagany stos i dobór interakcji

**Docelowy stos to PHP i HTML renderowane na serwerze + Tailwind CSS + htmx. Własny JavaScript stosuj tylko wtedy, gdy danej funkcji nie da się sensownie wykonać natywnym HTML/CSS lub htmx.**

htmx **2.0.8** jest przypięty w npm i importowany przez `resources/js/cart.js` do lokalnego bundla frontendu. Mini koszyk używa formularzy htmx ze zwykłym POST jako fallbackiem. Most JS inicjalizuje htmx po podmianach WooCommerce i synchronizuje jego fragmenty oraz cache. Zachowaj blokadę kontrolek aż do zakończenia tej synchronizacji; sam koniec żądania htmx nie wystarcza. Pozostałe komponenty nadal zawierają własny JS, jQuery/WooCommerce i Tailwind Plus Elements. Nie zakładaj, że sam atrybut `hx-*` zapewnia walidację lub autoryzację.

Dobieraj rozwiązanie w tej kolejności:

1. Natywny HTML i CSS, gdy wystarczają: link, formularz, `details/summary`, CSS Grid, przewijanie lub prosty stan prezentacyjny.
2. **htmx dla interakcji z serwerem**: zmiana lokalizacji menu, filtrowanie, paginacja, wyszukiwanie, walidacja formularza, aktualizacja fragmentu koszyka. Preferuj deklaratywne `hx-get`/`hx-post`, `hx-target`, `hx-swap` i odpowiedź HTML z PHP zamiast nowego `fetch`, XHR, jQuery AJAX lub ręcznego `innerHTML`.
3. Mały moduł JavaScript tylko dla potrzeb klienta, których poprzednie rozwiązania nie obsługują dobrze: zarządzanie fokusem, API przeglądarki, interaktywna wizualizacja zestawu, pomiar/geometria przewijania albo most do istniejących zdarzeń WooCommerce. Krótko wyjaśnij powód w opisie zmiany.

Nie wysyłaj żądania do serwera tylko po to, aby rozwinąć już dostępny tekst lub otworzyć menu. Nie zastępuj bez potrzeby działającego JS WordPressa, WooCommerce, checkoutu ani integracji płatności. Migruj pojedynczy komponent z zachowaniem jego kontraktu i zachowania.

## Zasady htmx

- Pierwszy render powinien zawierać użyteczną treść. Linki i formularze powinny mieć zwykłe `href`, `action` i `method`, zapewniające działanie bez htmx. Używaj tych samych części PHP przy pełnym renderze i odpowiedzi fragmentu.
- Endpoint ma zwracać właściwy fragment HTML i sensowny kod HTTP. Zapewnij stan ładowania, błędu, pustego wyniku i ponowienia; nie pokazuj sukcesu przed potwierdzeniem serwera.
- Stan biznesowy jest własnością PHP/WooCommerce. Cena, zapas, dostępność, wariant, limity, liczba pralin i terminy muszą być ponownie sprawdzane na serwerze.
- `HX-Request` nie uwierzytelnia i nie autoryzuje. Mutacje wymagają odpowiedniej metody, nonce/ochrony CSRF, walidacji oraz kontroli uprawnień lub własności bieżącej sesji. Publiczne odczyty publicznej treści nie wymagają automatycznie logowania ani nonce.
- Gdy jeden URL zwraca pełną stronę lub fragment zależnie od nagłówka, uwzględnij `Vary: HX-Request` i konfigurację przywracania historii zgodną z używaną wersją htmx. Koszyka, konta i odpowiedzi zawierających nonce nie zapisuj we wspólnym publicznym cache.
- Koordynuj szybkie zmiany ilości i filtrów, np. przez `hx-sync`, odpowiedni trigger i blokadę przycisku. Obsłuż spóźnione odpowiedzi i błędy. Przy błędzie przywróć poprzedni potwierdzony stan.
- Po podmianie fragmentu zachowaj sensowny fokus i komunikaty `aria-live`. Skrypty inicjalizuj idempotentnie; preferuj delegację zdarzeń. Nie dodawaj kolejnych listenerów przy każdym swapie.
- Nie umieszczaj wykonywalnych skryptów w zwracanych fragmentach. Escapuj zawartość CMS i dane użytkownika; nie dopuszczaj w nich niekontrolowanych atrybutów `hx-*`, `on*` ani dowolnych adresów żądań.
- Nie włączaj globalnego `hx-boost` na całej witrynie. Checkout, logowanie, płatności i widoki wtyczek wymagają osobnej weryfikacji zgodności. Ogranicz htmx do konkretnego obszaru.

## Organizacja kodu

- Widoki stron: `page-*.php`, `content-homepage.php`, `home.php`; nagłówki: `header.php` i `headers/`; nadpisania WooCommerce: `woocommerce/`; funkcje i endpointy: `inc/`.
- Nowej logiki biznesowej nie dopisuj do wielkiego `functions.php`. Umieszczaj ją w nazwanym module `inc/` i podłączaj raz. Zachowuj prefiks `capucafe_` lub istniejący `ccafe_`, aby nie kolidować z wtyczkami.
- Własny JS umieszczaj w `resources/js/`, style Tailwinda w `resources/css/tailwind.css` i konfiguracji, SCSS w `resources/scss/`. Nie dodawaj kolejnych dużych bloków `<script>` i `<style>` do widoków.
- Nie edytuj ręcznie `public/`, `node_modules`, rdzenia WordPressa, Storefront ani plików wtyczek. Pliki wynikowe odtwarza build.
- Zachowuj wymagany nagłówek motywu w `style.css`. Konsoliduj reguły ostrożnie, uwzględniając kolejność stylów Storefront i WooCommerce.
- Używaj kompletnych, statycznie wykrywalnych klas Tailwinda. Przy dynamicznych wariantach stosuj jawne mapy pełnych klas zamiast składania nazw. Skanowanie i watch nie mogą obejmować `.local/`, bazy, mediów, `node_modules` ani plików wynikowych.
- Wydzielaj wspólne części obu nagłówków i kart produktów, zamiast kopiować poprawki w kilku miejscach. Nie zostawiaj kopii `.back`/`.bak` w katalogu publikowanym przez serwer.

## PHP i WooCommerce

- Odczyty `$_POST`, `$_GET` i JSON traktuj jako niezaufane. Sprawdzaj typ, zakres, rozmiar i dozwolone wartości; stosuj `wp_unslash` i właściwą sanitację. Odrzucaj błędy zamiast bezgłośnie zamieniać je w poprawny stan.
- Escapuj przy wyjściu odpowiednio przez `esc_html`, `esc_attr`, `esc_url` lub ograniczone `wp_kses_post`. JSON w atrybucie HTML też musi być poprawnie escapowany. Używaj API WordPressa/WooCommerce i przygotowanych zapytań, jeśli SQL jest konieczny.
- Zapis metadanych wymaga właściwego nonce i `current_user_can('edit_post', $post_id)`, obsługi autosave/revisions oraz walidacji obiektu. Sam nonce nie zastępuje uprawnień.
- Modyfikując koszyk, sprawdzaj istnienie pozycji w bieżącej sesji, produkt, ilość, zapas, sprzedaż pojedynczą i walidatory WooCommerce. Samo `WC()->cart->set_quantity()` nie zastępuje całej walidacji formularza koszyka.
- Konfiguracja pralin powinna używać dozwolonych identyfikatorów smaków i rozmiarów. Suma dodatnich, całkowitych ilości musi odpowiadać wybranemu wariantowi. Nie ufaj nazwom, ilościom ani cenom wysłanym z przeglądarki.
- Karty produktów muszą respektować typ produktu i dostępność. Wariant lub produkt wymagający konfiguracji kieruj do wyboru opcji; korzystaj z API przycisków WooCommerce.
- Terminy licz w strefie WordPressa. Zmiany reguł odbioru sprawdzaj przed, w i po godzinie granicznej oraz dla piątku i weekendu. Nie przenoś walidacji wyłącznie do JS.
- Zmiany e-maili i statusów zamówień sprawdzaj pod kątem idempotencji, metod płatności i zamówień offline. Nie wysyłaj prawdziwych wiadomości podczas testów.
- Zachowuj hooki WooCommerce, notices, dane wariantów, dostępność i dane strukturalne. Przy nadpisaniach porównuj plik z wersją faktycznie zainstalowanej wtyczki; nie aktualizuj samego komentarza `@version`.
- Unikaj zapytań `limit => -1` w pętli kategorii. Stosuj paginację, zbiorcze obliczenia i cache z poprawnym unieważnianiem; nie cache'uj danych jednej sesji dla innych klientów.

## Design, dostępność i responsywność

- Zachowuj kierunek marki: ciepłe brązy i beże, zdjęcia produktów, Didot dla nagłówków i Mulish dla tekstu. Wprowadzaj wspólne tokeny kolorów, typografii, odstępów, kontenera i warstw zamiast kolejnych przypadkowych wartości i `!important`.
- Używaj Tailwinda w podejściu mobile first. Układ ma działać od 320 px. Dobieraj breakpoint nawigacji do miejsca na jej treść, nie tylko do nazwy urządzenia.
- Kontenery wewnętrzne powinny zwykle używać `w-full`, `min-w-0` i ograniczenia szerokości; nie `w-screen`/`100vw`. Nie maskuj błędów układu globalnym `overflow-x: hidden`.
- Uzgadniaj proporcje zdjęć kart, wysokości sekcji tytułu, ceny i CTA. Długie polskie nazwy, duże ceny i zawijanie tekstu nie mogą nakładać się na inne elementy. Nie ukrywaj ważnych informacji w stałej wysokości z `overflow-hidden`.
- Jeden widoczny nagłówek H1 opisuje główną treść; utrzymuj logiczne H2/H3 i jeden główny obszar `main`. Nie powielaj metadanych SEO jako ukrytych nagłówków.
- Używaj `button`, linków, pól i radiów zgodnie z ich funkcją. Zapewnij etykiety ikon, widoczny fokus, obsługę klawiatury, `aria-expanded` i powrót fokusu po zamknięciu nakładki. Menu zamknięte nie może pozostawać aktywne dla klawiatury.
- Dąż do obszaru dotykowego 44×44 px; dla mniejszych kontrolek zweryfikuj rozmiar i odstępy zgodnie z WCAG 2.2. Zapewnij kontrast tekstu minimum 4.5:1, a dużego tekstu 3:1. Kolor akcentu nie gwarantuje kontrastu białego napisu.
- Używaj `tel:` i `mailto:` tam, gdzie użytkownik ma zadzwonić lub napisać. Teksty, błędy i formaty cen w interfejsie powinny być po polsku i spójne z WooCommerce.

## Wydajność

- Używaj obrazów dopasowanych do rozmiaru i urządzenia, WebP/AVIF gdzie uzasadnione, `srcset`/`sizes`, wymiarów lub `aspect-ratio`. Preferuj `wp_get_attachment_image` dla mediów CMS.
- Obrazu LCP nie ładuj leniwie. Zdjęcia poniżej pierwszego ekranu zwykle powinny mieć `loading="lazy"` i `decoding="async"`. Nie preloaduj wszystkich zdjęć.
- Dla nowych zoptymalizowanych zasobów przyjmij wstępny budżet: mobilny hero do 200 KB i miniatura karty do 100 KB, z oceną jakości. Odstępstwo uzasadnij; są to cele projektu, a nie obecne wyniki.
- Fonty rejestruj raz, ogranicz odmiany, stosuj WOFF2 i odpowiedni `font-display`. Ładuj zasoby komponentu tylko tam, gdzie są potrzebne. Nie dodawaj ruchomych wersji zależności z CDN.
- Wyników lokalnego serwera lub samego buildu nie przedstawiaj jako wyniku Core Web Vitals. Cele dla danych terenowych: LCP ≤2.5 s, INP ≤200 ms, CLS ≤0.1 przy 75. percentylu. Podaj warunki pomiaru i rozdzielaj pomiary od szacunków.

## Weryfikacja i wdrożenia

- Regresje P1 na uruchomionym Local: `npm run local:wp -- eval-file "$PWD/tests/p1-local-test.php"` oraz `python3 tests/p1-http-test.py`. Pierwszy test tworzy i usuwa własne produkty; drugi ma osobne sesje gościa i nie składa zamówień. Nie uruchamiaj ich na produkcji. Zakres ręcznych testów i ograniczenia są w `docs/P1-LOCAL-FIXES-2026-10-27.md`.
- Dla zmiany kodu uruchom `npm run build` i sprawdź składnię zmienionych plików PHP na obsługiwanej wersji. Dla samej dokumentacji wystarczy sprawdzić treść, odnośniki i diff.
- Zmiany układu sprawdzaj w przeglądarce przynajmniej przy 375, 768 i 1440 px; dodaj 320, 1024, 1920 px i wysokość poziomego telefonu, gdy zmiana dotyka tych zakresów. Porównuj `scrollWidth` z `clientWidth` po załadowaniu zasobów i żądań komponentu.
- Dla zmienionego komponentu sprawdź stan pusty, długą treść, klawiaturę, dotyk, ładowanie i błąd. Dla koszyka: produkt prosty, wariant, konfiguracja pralin, zmiana ilości, usunięcie ostatniej pozycji i zgodność licznika w obu nagłówkach.
- Dla htmx sprawdź pełny render i fragment, zwykły formularz bez rozszerzenia, Back/Forward, nonce, błędy walidacji, powtórne kliknięcia, utratę sieci i fokus po swapie. Testy automatyczne dodawaj dla istotnych reguł i regresji, nie dla samych szczegółów implementacji.
- Pracuj na gałęzi `codex/<opis>`. **Push lub merge do `main` automatycznie wdraża produkcję.** Audyt i dokumentacja same w sobie nie są poleceniem wdrożenia. Respektuj wyraźną zgodę użytkownika na konkretne wdrożenie; nie ponawiaj prośby, jeżeli już jej udzielił.
- Wdrożenie pobiera wskazany commit, buduje szablon na serwerze, przełącza wydanie i zachowuje poprzednie. Nie nadpisuj przy tym bazy, zamówień, uploadów ani wtyczek. Nie rozluźniaj ograniczeń klucza wdrożeniowego ani dostępu do kopii zapasowych.
- Na produkcji docelowe wydania muszą leżeć w `~/domains/capuccinocafe.pl/.capucafe-releases/`, zgodnie z `open_basedir`. Samo dowiązanie z dozwolonego katalogu do `~/deploy/` nie zapewnia PHP dostępu. Zachowaj ograniczenie i testuj również treść HTTP 200 pod kątem ostrzeżeń PHP oraz uruchomienia właściwego motywu (`php tests/deploy-health-test.php`).
- W podsumowaniu podaj zmianę, powód, sposób sprawdzenia oraz rzeczywiste ograniczenia. W audycie oddziel potwierdzony błąd od ryzyka z analizy kodu i od propozycji estetycznej.
