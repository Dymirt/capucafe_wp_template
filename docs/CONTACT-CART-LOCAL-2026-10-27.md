# Kontakt, pełny koszyk i miniatury pralin — 27 października 2026

**Aktualizacja: wdrożone przez PR #10**, commit `1a961d2badaf123e5c63f876ffe63a3f548a3c2a`, workflow `40547564741` zakończony sukcesem. Poniższy raport opisuje testy lokalne przed tym wdrożeniem. Dalsza poprawka miniatur na stronie płatności WooCommerce Blocks jest osobnym, niewdrożonym zakresem opisanym w [raporcie checkoutu](CHECKOUT-PRALINE-LOCAL-2026-10-27.md).

## Zmiany

- Kontakt: przywrócono pierwotną kompozycję z ikonami, sekcjami „Adresy”, „Zadzwoń do nas”, „Napisz do nas” i tytułem Kontakt wewnątrz lewego panelu. Zachowano przylegające tła obu paneli, pierwotne odstępy i kolejność treści oraz sekcję Instagram. Układ dwóch kolumn od 768 px, poniżej jeden panel pod drugim. Usunięto sztywne minimalne szerokości; zachowano widoczne etykiety, czytelne zgody, responsywną siatkę pól, fokus, zawijane błędy i klikalne telefony/e-mail. Teksty zgód pozostają niezmienione. Wcześniejszy lokalny wariant z tytułem nad dwiema osobnymi kartami został wycofany na życzenie użytkownika.
- Odkryto dwa wymagane pola CF7 o identycznej nazwie `text-1101`: imię i temat. Adapter właściwości formularza KONTAKT nadaje tematowi osobną nazwę i dodaje go do treści wiadomości. Zachowuje dotychczasowy odbiornik, nadawcę, temat e-maila i mapowanie imienia; nie zapisuje konfiguracji w bazie. Zmiana dotyczy także walidacji REST, jest idempotentna i ograniczona do starej konfiguracji.
- Pełny koszyk: karty poniżej 1024 px i pełna tabela od 1024 px, ograniczone miniatury, zawijane nazwy, czytelne etykiety ceny/ilości/sumy, kontrolki dotykowe, responsywne pole kuponu i komunikat błędu oraz panel podsumowania. Usunięto regułę znoszącą ograniczenie szerokości zdjęć.
- Praliny w koszyku: serwer składa miniaturę pudełka i wybranych smaków z zapisanej, ponownie zwalidowanej konfiguracji. Wspólna siatka z konfiguratorem obsługuje 6/12/16 sztuk, zarówno w pełnym koszyku, jak i podglądzie nagłówka. Liczba kupowanych pudełek nie mnoży pralin w podglądzie jednego pudełka. Błędne stare konfiguracje zachowują bezpieczną miniaturę bazową i dotychczasowy wymóg ponownego wyboru. Zmieniono klucz cache fragmentów, aby odrzucić stare podglądy.

Zachowano natywne szablony i obsługę AJAX WooCommerce oraz Contact Form 7. Nie dodawano nowego JS ani nie przepisywano działających integracji na htmx. Nie zmieniano plików fotografii ani ich optymalizacji.

## Weryfikacja

- `npm run build`: sukces; pozostaje wcześniejszy komunikat o nieaktualnej bazie Browserslist.
- PHP 8.2: składnia zmienionych plików poprawna; `git diff --check` bez błędów.
- `npm run local:wp -- eval-file "$PWD/tests/p1-local-test.php"`: 109 sprawdzeń.
- `python3 tests/p1-http-test.py`: 32 sprawdzenia.
- `npm run local:wp -- eval-file "$PWD/tests/contact-form-local-test.php"`: 12 sprawdzeń, w tym rzeczywisty hook CF7, niezależne mapowanie imienia i tematu, idempotencja i zachowanie ustawień wysyłki.
- `npm run local:wp -- eval-file "$PWD/tests/praline-thumbnail-local-test.php"`: 22 sprawdzenia dla 6/12/16 sztuk, ilości pudełek 2, zwykłego produktu i nieprawidłowych danych.
- Dwa rzeczywiste, odrzucone żądania REST CF7 potwierdziły osobne wymaganie imienia i tematu. Nie zaznaczano zgód, nie wysyłano wiadomości ani nie składano zamówień.
- Kontakt: emulowane szerokości 320, 375, 640, 768, 1024, 1280, 1440 i 1920 px. Koszyk: dodatkowo granice 767/768 i 1023/1024 px. Wszędzie `scrollWidth = clientWidth`, brak przyciętych kontrolek i etykiet. Sprawdzono także poziomy telefon 812×375 px i długą treść pól.
- Oględziny zrzutów na telefonie, tablecie i desktopie, błędów formularza, kuponu i obu miniatur pralin. W przeglądarce sprawdzono zestaw 12 sztuk; wszystkie trzy pojemności pokrywają testy PHP.
- Koszyk: produkty proste i zestaw wariantowy, zmiana ilości 1→2 i przeliczenie sumy/licznika, niepoprawny kupon oraz usunięcie własnej pozycji testowej. Pusty koszyk sprawdzono jako render HTTP osobnej sesji gościa. Testy nie opróżniały koszyka użytkownika.

Przywrócono trzy oryginalne pozycje koszyka z pierwotnymi ilościami i kluczami oraz niedokończony wybór 10 z 12 pralin (4 Advocat, 6 Baileys). Lokalna blokada wysyłki, płatności i integracji pozostaje aktywna.

Dowody pozostają prywatnie w ignorowanym `.local/contact-cart-fixes/`: zrzuty 375/768/1440 px, `contact-preview.png`, pomiary JSON, odrzucone walidacje REST i HTML pustego koszyka. Testy wykorzystują emulację rozmiarów przeglądarki, nie fizyczne urządzenia. Nie wykonano pełnego audytu WCAG, transakcji ani testu dostarczenia e-maila. Pozostałe punkty audytu pozostają otwarte.

## Ponowna kontrola po przywróceniu wyglądu

Build oraz składnia `page-kontakt.php` na PHP 8.2 poprawne; 12 testów formularza zaliczonych ponownie. Nowe pomiary Kontakt przy 320, 375, 640, 767, 768, 1024, 1440 i 1920 px: wszędzie `clientWidth = scrollWidth`, wszystkie pięć pól ma powiązane etykiety i mieści się w widoku. Także 812×375 px bez przepełnienia. Obejrzano zrzuty telefonu 375 px, tabletu 768 px i desktopu 1440 px. Pusty formularz na telefonie wyświetla osobne błędy imienia, e-maila i tematu, bez zaznaczania zgód i bez wysyłania wiadomości; błędy nie powodują przepełnienia. Konsola bez błędów. Formularz po testach ponownie pusty.

Aktualne dowody: `contact-restored-375.png`, `contact-restored-768.png`, `contact-restored-1440.png`, `contact-restored-preview.png`, `contact-restored-errors-375.png` i `contact-restored-metrics.json` w prywatnym `.local/contact-cart-fixes/`. Starsze zrzuty `contact-*.png` dokumentują wycofaną kompozycję, a nie obecny wygląd. Koszyk i konfigurator nie były zmieniane w tej korekcie. Bez wdrożenia na produkcję.

## Weryfikacja przed PR

Ponownie zaliczono pełny build, 109 testów reguł P1, 32 testy HTTP, 12 testów formularza, 22 testy miniatur, 5 regresji kontroli odpowiedzi wdrożenia oraz składnię wszystkich 45 plików PHP na PHP 8.2. `git diff --check` poprawny. Nie wykonywano scalania ani wdrożenia.
