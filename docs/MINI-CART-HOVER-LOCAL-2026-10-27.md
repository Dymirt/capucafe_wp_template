# Panel koszyka i czytelność licznika — lokalnie

Gałąź `codex/mini-cart-hover-bridge`, po scaleniu PR #11. Raport weryfikacji przed PR i wdrożeniem tych zmian.

Panel miał stałe położenie od 100 px, niezależne od ikony, której aktywny obszar kończył się około 64 px. Między nimi powstawała przerwa zamykająca hover. Panel jest teraz pozycjonowany względem wspólnego kontenera ikony; przezroczysty padding 36 px tworzy ciągły obszar interakcji. Kontener pozwala na wyświetlenie panelu poza własnymi wymiarami. Zachowano otwieranie przez fokus klawiatury i link do pełnego koszyka. Bez nowego JS lub htmx — wystarcza CSS.

Licznik powiększono z 10×10 do minimum 20×20 px, tekst z 6 do 12 px. Biały tekst na #b42318 ma kontrast około 6.57:1. Kapsuła rozszerza się z treścią; usunięto obcinanie jej przez link ikony. Oba pliki nagłówka mają ten sam markup.

Weryfikacja: pełny build poprawny, składnia obu nagłówków na PHP 8.2 poprawna, git diff --check poprawny. Na desktopie rzeczywiste przemieszczenie kursora od ikony, przez padding, do panelu zachowuje hover i widoczność, bez aktywnego focus-within. Wyjście zamyka panel, Tab otwiera go przez fokus. Pomiary panelu i licznika dla / i /koszyk/ przy 320/375/768/1440/1920 px: panel mieści się w obszarze widoku, licznik 20×20 px. Koszyk bez poziomego przepełnienia; pomiar homepage przy 320 px nadal pokazuje szerszą treść strony (327 wobec 305 px), poza zakresem tej korekty. Nie deklarujemy pełnej naprawy pozostałych komponentów strony głównej.

Dowody prywatne: `.local/contact-cart-fixes/mini-cart-hover-badge-fixed.png` i `hover-badge-metrics.json`. Nie zmieniano ilości, produktów, danych formularzy ani konfiguracji użytkownika.

Przed PR ponownie zaliczono pełny build, 190 sprawdzeń lokalnych (109 P1, 32 HTTP, 22 miniatur koszyka, 27 miniatur płatności), składnię 47 plików PHP na PHP 8.2 i 5 regresji kontroli odpowiedzi wdrożenia.
