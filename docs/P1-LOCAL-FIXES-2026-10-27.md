# Lokalne naprawy P1 Capuccino Cafe — 27 października 2026

Zmiany dotyczą lokalnego motywu i nie zostały wdrożone ani wysłane do `main`. Środowisko: Local, PHP 8.2.29, WordPress 7.1.3, WooCommerce 10.3.8. Zdjęć, ich plików i rozmiarów transferu nie optymalizowano.

## Zmiany

- **`$register`:** odnośnik rejestracji używa istniejącego adresu konta WooCommerce. Usunięto źródło ostrzeżenia w nagłówku strony głównej.
- **Menu:** natywne `dialog` i `details/summary` zastępują wadliwy skrypt podmenu. Semantyczne przyciski, nazwy dostępności, Escape, Tab/Shift+Tab, powrót fokusu i blokada przewijania tła. Zamknięty dialog nie udostępnia linków klawiaturze. Nawigacja kompaktowa działa poniżej 1280 px; po rozszerzeniu okna modal się zamyka. Na homepage tylko aktualnie widoczny nagłówek jest aktywny dla klawiatury. Szerokość hero dopasowano do kontenera, usuwając jego przepełnienie o szerokość paska przewijania.
- **Koszyk:** wspólna część PHP obu nagłówków. Formularze htmx zwracają HTML, zachowują zwykły POST bez rozszerzenia i dotychczasową odpowiedź JSON dla klientów WooCommerce. Serwer sprawdza metodę, nonce związany z sesją WooCommerce, klucz bieżącego koszyka, typ i zakres ilości, produkt, limity, sprzedaż pojedynczą, wspólny zapas i walidatory wtyczek. Tylko jawne `0` usuwa pozycję. Błąd zachowuje stan, a sukces odświeża oba nagłówki oraz cache fragmentów WooCommerce. Kontrolki pozostają zablokowane do końca synchronizacji, aby kolejna operacja nie trafiła na poprzedni fragment. Obsługiwane są komunikaty 403/422, błędy żądania i ponowienie; żądanie htmx ma limit 15 sekund.
- **Praliny:** serwer sprawdza rzeczywisty wariant i jego pojemność 6/12/16, identyfikatory opublikowanych smaków, brak duplikatów oraz dodatnie całkowite ilości o dokładnej sumie. Nazwy i rozmiar zapisuje z katalogu, cena pozostaje własnością WooCommerce. Ochrona obejmuje formularz i bezpośrednie `WC_Cart::add_to_cart`, a konfiguracje w sesjach są ponownie sprawdzane przed zakupem. Dawne, nieprawidłowe konfiguracje wymagają usunięcia i ponownego wyboru; ich uszkodzone dane nie są renderowane jako prawidłowy zestaw.
- **Konfigurator UI:** przyciski rozmiarów działają klawiaturą, wszystkie trzy mieszczą się od 320 px; liczniki i cena odpowiadają wariantowi. Nazwy smaków nie są obcinane, kontrolki mają minimum 44×44 px. Stan gotowości i zmniejszenie pudełka mają komunikaty; zmniejszenie nadmiarowego zestawu wymaga ponownego obejrzenia zachowanych smaków. Dodano przycisk zakupu również po liście smaków. Lokalny szkic używa ID, ma osobny klucz produktu i jest ograniczany do dostępnej pojemności. Brak dostępu do localStorage nie blokuje działania.

htmx 2.0.8 jest przypięty i budowany lokalnie. JS pozostaje przy zarządzaniu fokusem i API przeglądarki, wizualnym składaniu pudełka oraz współpracy z oficjalnym mechanizmem fragmentów WooCommerce. Nie przepisano checkoutu ani płatności.

## Weryfikacja

Uruchomienie regresji na działającym Local, z katalogu repozytorium:

```sh
npm run local:wp -- eval-file "$PWD/tests/p1-local-test.php"
python3 tests/p1-http-test.py
npm run build
```

- **109 sprawdzeń PHP:** poprawne pojemności, nazwy z CMS, fałszywe i powtórzone smaki, zły wariant, uszkodzony/za duży JSON, błędne liczby, nonce i bezpośrednie API koszyka, odczyt poprawnych i dawnych błędnych sesji, zwykły produkt, sprzedaż pojedyncza, zapas wspólny między pozycjami i wariantami, dozwolone zamówienia ponad stan.
- **32 sprawdzenia HTTP:** dodanie poprawnego zestawu, odrzucenie błędnych konfiguracji, brak `$register` w HTML, brak/ujemna/ułamkowa/tekstowa/tablicowa ilość, obcy klucz, niepoprawny nonce i nonce z innej sesji, zakaz mutacji GET, odpowiedzi 403/405/422, HTML z licznikiem, JSON WooCommerce, zwykły POST i usunięcie ostatniej pozycji.
- **Przeglądarka:** dodanie zestawów 6, 12 i 16 sztuk, cena i pozycje koszyka, przejście do mniejszego pudełka, czyszczenie, długi smak, przycisk na końcu konfiguratora, zachowanie szkicu oraz aktualizacja ilości i usunięcie ostatniej pozycji. Sprawdzono produkt prosty i warianty, zgodność obu nagłówków, odtworzenie stanu po nawigacji oraz fokus po podmianie. Lokalna symulacja odrzucenia przez wtyczkę i odpowiedzi 503 potwierdziła brak zmiany ilości i działające ponowienie; tymczasowy kod symulacji usunięto.
- **Responsywność:** konfigurator przy 320, 375, 768, 1024, 1440 i 1920 px; menu także przy 812×375 px. Wszystkie rozmiary pudełka są widoczne, nazwy mieszczą się, kontrolki mają deklarowane pole dotykowe, sam konfigurator nie wychodzi poza kontener. Menu nie ma poziomego przepełnienia; sprawdzono zamknięcie, podmenu, cykl fokusu i powrót do przycisku.
- **Build i PHP:** pełny build JS/CSS oraz kontrola wymaganych zasobów; składnia zmienionych PHP na PHP 8.2; istniejące testy odpowiedzi wdrożenia.

Zrzuty i pomiary są lokalne w ignorowanym `.local/p1-fixes/`: `config-preview.png`, `config-375.png`, `config-1440.png`, `config-controls-375.png`, `menu-375.png`, `responsive.json`, `menu-responsive.json`. Nie zawierają ekranów kont klientów.

## Ograniczenia i dalsze kroki

To weryfikacja w przeglądarce aplikacji na Macu, z emulowanymi szerokościami, bez testów na fizycznym iPhonie/Androidzie i bez czytnika ekranu. Symulowano błąd serwera; nie przedstawia się go jako testu odłączenia fizycznej sieci. Nie wykonano prawdziwej płatności, zamówienia ani wysyłki wiadomości. Lokalny guard integracji pozostaje aktywny.

W pomiarze przed osobną poprawką stopki przy 768 px dokument miał przepełnienie: `scrollWidth=772`, `clientWidth=753`. Konfigurator w tym pomiarze mieścił się w swoim kontenerze. Przepełnienie stopki zostało następnie usunięte lokalnie — zobacz [weryfikację stopki](FOOTER-LOCAL-FIX-2026-10-27.md). Pozostałe problemy P2, wcześniejsze notices WooCommerce i zależności narzędziowe nie są uznawane za naprawione. P1 dotyczący dużych zdjęć pozostaje odłożony. Kontrolę produkcji należy wykonać dopiero po osobno autoryzowanym wdrożeniu.

## Korekta ułożenia pralin po weryfikacji wizualnej

Siatka podglądu ma teraz stałe rzędy i kolumny, bez odstępów w pikselach. Jej granice dopasowano do przegródek na zdjęciach każdego pudełka (3×2, 4×3, 4×4), a obrazy smaków są centrowane z zachowaniem proporcji. Poprawka obejmuje także częściowo wypełnione pudełka. Sprawdzono 18 kombinacji rozmiaru pudełka i szerokości 320/375/768/1024/1440/1920 px; odchylenie centrów obrazów od centrów komórek było mniejsze niż 0,01 px. Wizualnie sprawdzono pełne pudełka i różne smaki. Build oraz składnia zmienionego PHP przeszły kontrolę. Nie zmieniano plików zdjęć ani produkcji. Dowody lokalne: `.local/p1-fixes/alignment-*.png` oraz `alignment-metrics.json`.
