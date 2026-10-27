# Stopka — lokalna poprawka responsywności, 27 października 2026

Raport opisuje lokalną weryfikację poprawki następnie scalonej w [PR #9](https://github.com/Dymirt/capucafe_wp_template/pull/9) i wdrożonej na produkcję jako `d3ec391`. Nową stopkę potwierdzono w świeżych odpowiedziach 7 stron. [Aktualny status audytu](AUDIT-2026-10-27.md). Nie zmieniano zdjęć ani konfiguracji pralin podczas naprawy stopki.

## Przyczyna i naprawa

Przy szerokości okna 768 px dokument miał `clientWidth=753` i `scrollWidth=772`. Menu stopki zawijało kolumny flex wewnątrz sztywnej wysokości 300 px, przy paddingu po 128 px. Linki wychodziły poza ekran i nakładały się na adresy oraz e-mail.

- Zewnętrzny układ to responsywny grid z ograniczoną szerokością i kolumnami, które mogą się zwężać. Menu ma naturalną wysokość i kolumny CSS bez dzielenia grup linków. Kontakt zajmuje osobny obszar.
- Na telefonie grupy linków używają natywnych `details/summary`; od 768 px są początkowo otwarte. Mały moduł JS obsługuje tylko zmianę breakpointu oraz przeniesienie fokusu na nagłówek, jeśli zmniejszenie okna zamknie aktualnie aktywną grupę. Linki i rozwijanie pozostają dostępne bez JS.
- Zachowano brązowe tło i logo. Poprawiono odstępy, kontrast nagłówków, zawijanie tekstu, widoczny fokus i pola dotykowe minimum 44 px wysokości. Telefony są linkami `tel:`, social media mają nazwy dostępności i `rel="noopener noreferrer"`.
- Zmienione źródła: `footer.php`, część stopki w `inc/functions/menu.php`, `resources/css/tailwind.css`, `resources/js/footer.js` i import w `resources/js/frontend.js`. Usunięto stary globalny skrypt rozwijania stopki; w pozostałych aktywnych źródłach nie ma jego wywołań.

## Weryfikacja

Przeglądarka aplikacji na Macu, emulowane szerokości; nie test na fizycznych telefonach. PHP 8.2.29 z Local. Pomiary po załadowaniu strony.

| Szerokość okna | clientWidth dokumentu | scrollWidth dokumentu | clientWidth / scrollWidth stopki |
| --- | --- | --- | --- |
| 320 | 305 | 305 | 305 / 305 |
| 375 | 360 | 360 | 360 / 360 |
| 640 | 625 | 625 | 625 / 625 |
| 767 | 752 | 752 | 752 / 752 |
| 768 | 753 | 753 | 753 / 753 |
| 820 | 805 | 805 | 805 / 805 |
| 1024 | 1009 | 1009 | 1009 / 1009 |
| 1280 | 1265 | 1265 | 1265 / 1265 |
| 1440 | 1425 | 1425 | 1425 / 1425 |
| 1920 | 1905 | 1905 | 1905 / 1905 |

Dla tych szerokości nie wykryto nakładania prostokątów widocznych linków i kontrolek ani wyjścia poza stopkę. Sprawdzono wygląd i zapisano pełne zrzuty stopki przy 375, 768 i 1440 px. Na telefonie przetestowano Enter/Space, wszystkie grupy otwarte jednocześnie oraz powrót fokusu do `summary` po przejściu 768→375 px. W stanie rozwiniętym przy 375 px `scrollWidth` nadal wynosił 360 px. Sprawdzono też otwarcie i zamknięcie menu nagłówka po zmianie wspólnego pliku walkerów.

Dodatkowy pomiar homepage i sklepu przy 768 px dał w obu przypadkach 753 / 753 dla dokumentu i stopki. Brak błędów w konsoli podczas końcowych testów. Pełny `npm run build`, składnia `footer.php` i `inc/functions/menu.php` na PHP 8.2 oraz `git diff --check` przeszły kontrolę. Nie wykonywano zamówień, połączeń telefonicznych ani wysyłki wiadomości.

Dowody pozostają w ignorowanym `.local/footer-fixes/`: `footer-375.png`, `footer-768.png`, `footer-1440.png`, `metrics.json` i `page-checks.json`.
