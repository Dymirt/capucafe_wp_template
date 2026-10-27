# Miniatura pralin na stronie płatności

Stan: poprawka **wyłącznie lokalna**, po wdrożonym PR #10. Nowa gałąź `codex/praline-checkout-thumbnail`; bez push, scalania i dodatkowego wdrożenia.

Podsumowanie płatności jest blokiem WooCommerce korzystającym ze Store API. Nie wywołuje filtra `woocommerce_cart_item_thumbnail`, na którym opiera się poprawka klasycznego i mini koszyka z PR #10. Dlatego zdjęcie zestawu nadal przedstawiało puste pudełko.

Dodano filtr `woocommerce_store_api_cart_item_images`. Zwraca on adres PNG 300×300 złożonego po stronie PHP z pudełka i wybranych smaków. Korzysta z walidacji rzeczywistego wariantu i konfiguracji oraz tych samych granic przegródek 6/12/16 co konfigurator. Czyta wyłącznie lokalne załączniki z uploadów, nie pobiera zewnętrznych URL. Nie zmienia oryginalnych fotografii, ich wpisów w bibliotece ani danych zamówienia. Nie dodaje JS ani nie ingeruje w React, checkout, płatności i formularz dostawy.

Podglądy są współdzielone dla identycznej konfiguracji, zależą od ilości smaków i wersji plików źródłowych, a nie od ilości pudełek, sesji lub danych klienta. Cache `uploads/ccafe-praline-previews/` ma limit około 200 wygenerowanych PNG (najstarsze są usuwane przy generowaniu kolejnego). Błędne konfiguracje, brak załączników lub GD zachowują obraz bazowy. GD potwierdzono w Local oraz odczytem na hostingu; na produkcji nowego kodu nie uruchamiano.

## Weryfikacja

- `npm run build` i składnia trzech zmienionych/nowych plików PHP na PHP 8.2 poprawne.
- `tests/praline-checkout-local-test.php`: 27 sprawdzeń, wszystkie 6/12/16 sztuk, prawidłowe PNG 300×300, kontrakt filtra Store API, pusty srcset, cache, różne smaki, ilość pudełek i bezpieczny fallback.
- Regresje: 22 sprawdzenia miniatur klasycznego koszyka, 109 reguł P1 i 32 testy HTTP — wszystkie zaliczone.
- Faktyczna strona `/platnosc/`: zimny cache wygenerował obraz dla istniejącego zestawu 12 sztuk. Przeglądarka załadowała PNG i pokazała wybrane praliny w pudełku. Zawartość i teksty wszystkich czterech pozycji podsumowania identyczne przed i po poprawce.
- Emulowane 375, 768 i 1440 px: `clientWidth = scrollWidth` (360/753/1425), widoczna miniatura 48×48 px, bez zmiany układu płatności. Zrzuty prywatne w `.local/contact-cart-fixes/checkout-pralines-*.png` i `checkout-praline-preview.png`.
- Bez zamówień, prób płatności, zaznaczania zgód i wysyłki wiadomości. Blokada integracji Local pozostaje aktywna.

Podczas testu zimnego cache wykryto zależność od niedostępnej na frontendzie funkcji `wp_tempnam`; zastąpiono ją natywnym `tempnam` i potwierdzono poprawny render rzeczywistej strony. To był błąd wyłącznie w lokalnej, niewdrożonej wersji roboczej.
