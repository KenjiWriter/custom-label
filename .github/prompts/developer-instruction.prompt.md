---
mode: ask
---
# GitHub Copilot — instrukcja dla projektu "Sklep z etykietami"

## Kontekst
Tworzymy aplikację sklepu internetowego z etykietami, które można personalizować.  
Projekt jest tworzony w **Laravel 12.\*** z użyciem:
- **Blade** jako system szablonów
- **Tailwind CSS** jako framework wizualny (pełne wsparcie klas responsywnych)
- **Alpine.js** jako wsparcie JS dla prostych interakcji UI
- **Laravel Livewire** do dynamicznego przekazywania danych w obu kierunkach bez API
- **routes/web.php** i kontrolery w `app/Http/Controllers` — bez korzystania z API
- Ewentualna wizualizacja 3D w kreatorze realizowana przy pomocy zewnętrznej biblioteki JS (np. Three.js)

## Główny widok aplikacji — Home Page
- Na stronie głównej znajduje się **kreator etykiet** z nowoczesnym i czytelnym UI (zgodnym z aktualnymi standardami UI/UX)
- UI musi być responsywne (desktop i mobile)
- Układ kreatora: **4 kolumny**:
  1. **Wybór kształtu** (okrągły, prostokątny, kwadratowy itp.)
  2. **Wybór materiału** (np. papier, folia, winyl)
  3. **Laminat** (opcja TAK/NIE)
  4. **Rozmiar** (wysokość/szerokość w mm lub wybór predefiniowanego rozmiaru)
- Pod kolumnami:  
  - **Ostatnia sekcja** z wyborem ilości i wyliczoną ceną (dynamicznie z Livewire)  
  - Pole do przesłania pliku graficznego, który znajdzie się na etykiecie

## Funkcjonalność kreatora
1. Użytkownik wypełnia wszystkie kroki kreatora
2. Po zatwierdzeniu — przenosimy go do **strony kreatora wizualizacji**:
   - Pokazuje **podgląd wybranej etykiety w 3D** (biblioteka JS, np. Three.js)
   - Możliwość obracania, powiększania i sprawdzania szczegółów etykiety
3. Po konfiguracji etykiety — przycisk **"Zapłać"**
   - Przenosi na stronę płatności

## Wymagania techniczne
- Laravel 12.20+
- Tailwind CSS — pełne użycie klas utility-first
- Alpine.js — interakcje UI
- Livewire — dynamiczne zmiany danych (np. cena, wizualizacja, wybory użytkownika)
- Responsywność: skalowanie i układ dostosowany zarówno do desktopa, jak i telefonu
- Kod w pełni zgodny z PSR-12 i zasadami czystego kodu w Laravel

## Motyw kolorystyczny
- **Główna paleta**: odcienie pomarańczowe, ciepłe, nowoczesne  
  - Główny kolor akcentu: `#FF7A00` (pomarańczowy intensywny)
  - Jaśniejszy akcent: `#FFA94D`
  - Ciemniejszy akcent: `#CC5E00`
- **Kolory tła**:
  - Jasne sekcje: `#FFF7F0` (bardzo jasny odcień pomarańczowego, pastelowy)
  - Ciemniejsze akcenty UI: `#332B25` (brązowo-pomarańczowy odcień dla kontrastu)
- Tekst:
  - Główny tekst: odcienie ciemnoszare (`#333333`)
  - Tekst na przyciskach akcentowych: zawsze biały (`#FFFFFF`)
- Styl przycisków:
  - Duże, wyraźne, zaokrąglone rogi (`rounded-xl`)
  - Hover: delikatne rozjaśnienie (`hover:bg-orange-400`) lub przyciemnienie w zależności od kontekstu
- Motyw powinien być spójny w całej aplikacji (przyciski, nagłówki, ikony, interaktywne elementy)

## Zasady generowania kodu
- Używaj komponentów Blade + Livewire
- Zwracaj uwagę na czytelność kodu i semantykę HTML
- Komentarze w kodzie powinny wyjaśniać kluczowe sekcje
- Stosuj nazewnictwo zmiennych i klas w języku angielskim (np. `LabelShape`, `MaterialOption`, `LabelPreview3D`)
- Zawsze zachowuj strukturę folderów Laravel
- Unikaj inline CSS — używaj klas Tailwind
- Dla animacji i efektów używaj Alpine.js lub dedykowanych bibliotek JS (np. do 3D)