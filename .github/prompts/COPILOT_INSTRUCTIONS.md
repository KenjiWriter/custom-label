---
mode: ask
---

# GitHub Copilot Instructions for Custom-Label Project (Laravel/Livewire)

## Purpose
Instrukcje optymalizacji pracy z GitHub Copilot (Claude Sonnet 3.7 thinking) w projekcie Custom-Label. Projekt wykorzystuje Laravel, Livewire, Alpine.js i będzie rozrastał się do dużych rozmiarów - te instrukcje zapewnią spójność i efektywność rozwoju.

## Architektura Projektu
```
custom-label/
├── app/
│   ├── Livewire/           # Komponenty Livewire (LabelCreator, OrderManager)
│   ├── Models/             # Modele Eloquent (LabelShape, LabelMaterial, Order)
│   ├── Http/Controllers/   # Kontrolery HTTP (API, Auth)
│   └── Services/           # Logika biznesowa (PriceCalculator, FileHandler)
├── resources/views/
│   ├── livewire/          # Blade templates dla komponentów Livewire
│   └── components/        # Reużywalne komponenty Blade
├── database/
│   ├── migrations/        # Migracje bazy danych
│   └── seeders/          # Seedery danych
└── public/images/         # Statyczne zasoby (kształty, materiały, laminaty)
```

## Konfiguracja Claude Sonnet 3.7

### VS Code Settings
```json
{
  "github.copilot.advanced": {
    "model": "claude-sonnet-3.7-thinking",
    "contextWindow": 8192,
    "temperature": 0.1
  },
  "github.copilot.largeFileSupport": true,
  "github.copilot.enable": {
    "php": true,
    "blade": true,
    "javascript": true
  }
}
```

## Strategie dla Dużych Plików

### 1. Chunking Context dla Livewire Components
```php
// PROMPT: "Analizuj ten chunk komponentu Livewire - co robi i jakie ma zależności?"
// Zaznacz 100-150 linii i poproś o analizę

/**
 * CONTEXT CHUNK: Metody walidacji i kalkulacji cen
 * Dependencies: LabelShape, LabelMaterial, LaminateOption
 * Purpose: Oblicza cenę na podstawie konfiguracji użytkownika
 */
```

### 2. Template Context Management
```blade
{{-- PROMPT: "Ten fragment Blade odpowiada za sekcję X, uwzględnij Alpine.js state" --}}
{{-- Dependencies: wire:model.live, x-data, x-show --}}
{{-- State: currentStep, selectedShape, useCustomSize --}}
```

### 3. Migration Context Tracking
```php
// PROMPT: "Ta migracja modyfikuje tabelę X, sprawdź relacje z innymi tabelami"
// Related: label_shapes, predefined_sizes, label_materials
// Impact: Może wymagać aktualizacji seedera LabelDataSeeder
```

## Prompt Patterns dla Custom-Label

### Livewire Components
```php
// CONTEXT: Komponent LabelCreator - zarządza konfiguratorem etykiet
// STATE: selectedShape, selectedMaterial, useCustomSize, calculatedPrice
// METHODS: calculatePrice(), checkConfiguration(), saveProject()
// TASK: [opisz zadanie]

// PRZYKŁAD:
// TASK: Dodaj walidację dla custom rozmiarów z limitami 10-500mm
```

### Models & Relationships
```php
// CONTEXT: Model LabelShape z relacjami
// RELATIONSHIPS: hasMany(PredefinedSize), belongsToMany(LabelMaterial)
// SCOPES: active(), byCategory()
// TASK: [opisz zadanie]

// PRZYKŁAD:
// TASK: Dodaj scope dla kształtów dostępnych dla materiału X
```

### Blade Templates
```blade
{{-- CONTEXT: Template kreatora etykiet, krok [numer] --}}
{{-- ALPINE STATE: currentStep, selectedOptions --}}
{{-- LIVEWIRE PROPS: $shapes, $materials, $availableSizes --}}
{{-- TASK: [opisz zadanie] --}}

{{-- PRZYKŁAD: --}}
{{-- TASK: Dodaj animacje przejść między krokami z Alpine.js --}}
```

### Database Operations
```php
// CONTEXT: Seeder dla danych etykiet
// TABLES: label_shapes, label_materials, predefined_sizes, laminate_options
// RELATIONSHIPS: Kształt -> Rozmiary, Materiał -> Ceny
// TASK: [opisz zadanie]

// PRZYKŁAD:
// TASK: Dodaj nowe kształty z predefiniowanymi rozmiarami
```

## Standardowe Prompty

### 1. Analiza Zależności
```
"Przeanalizuj zależności tego fragmentu kodu w kontekście projektu Custom-Label. 
Sprawdź relacje z modelami, komponentami Livewire i plikami Blade. 
Zwróć uwagę na: wire:model, Alpine.js state, Eloquent relationships."
```

### 2. Refaktoryzacja
```
"Zrefaktoryzuj ten kod zgodnie z patterns Laravel/Livewire:
- Wyodrębnij logikę biznesową do Service
- Optymalizuj queries Eloquent  
- Zachowaj reactivity Livewire
- Dodaj właściwą walidację"
```

### 3. Dodawanie Funkcjonalności
```
"Dodaj funkcjonalność X uwzględniając:
- Istniejące state Livewire: [lista properties]
- Aktualne relacje modeli: [lista relacji]  
- Frontend state Alpine.js: [lista zmiennych]
- Zachowaj spójność z istniejącym UI/UX"
```

### 4. Debugging & Testing
```
"Dodaj debugging i error handling dla tego kodu:
- Logger::info() dla ważnych operacji
- Validation rules z custom messages
- Try-catch z user-friendly errors
- Livewire flash messages"
```

## Specyficzne Patterns Projektu

### Price Calculation Pattern
```php
// PATTERN: Kalkulacja cen w LabelCreator
// INPUT: shape, material, size/custom, laminate, quantity
// PROCESS: areaCm2 * material_price * shape_multiplier * laminate_multiplier * quantity * VAT
// OUTPUT: calculatedPrice (z 2 miejscami po przecinku)
```

### Validation Pattern
```php
// PATTERN: Walidacja w Livewire
// RULES: Dynamic rules based on useCustomSize
// MESSAGES: Polish language, user-friendly
// TIMING: Real-time with wire:model.live
```

### State Management Pattern
```php
// PATTERN: Alpine.js + Livewire state synchronization
// ALPINE: UI state (currentStep, animations, toggles)
// LIVEWIRE: Data state (selections, calculations, validation)
// SYNC: @entangle('property').live
```

## File-Specific Instructions

### LabelCreator.php (400+ lines)
```
"Ten komponent ma 4 główne sekcje:
1. Properties & Validation (linie 1-60)
2. Lifecycle Hooks (linie 61-120) 
3. Business Logic (linie 121-250)
4. Rendering & Data (linie 251+)

Przy modyfikacjach uwzględnij impact na calculatePrice() i checkConfiguration()."
```

### label-creator.blade.php (500+ lines)
```
"Template ma 4 kroki UI:
1. Shape Selection (linie 40-80)
2. Material Selection (linie 81-140)
3. Laminate & Size (linie 141-300)
4. Final Configuration (linie 301+)

Każdy krok ma własny Alpine.js state i Livewire wire:model bindings."
```

### LabelDataSeeder.php (300+ lines)
```
"Seeder ma 4 sekcje danych:
1. Shapes + icon paths (linie 15-50)
2. Materials + texture paths (linie 51-120)
3. Laminates + texture paths (linie 121-150)
4. Predefined Sizes per Shape (linie 151+)

Przy dodawaniu danych zachowaj konsystencję ścieżek w public/images/."
```

## Performance Guidelines

### Database Queries
```php
// PREFER: Eager loading z specific columns
$shapes = LabelShape::with('predefinedSizes:id,label_shape_id,name,width_mm,height_mm')
    ->select('id', 'name', 'slug', 'icon_path')
    ->active()
    ->get();

// AVOID: N+1 queries
foreach($shapes as $shape) {
    $shape->predefinedSizes; // N+1!
}
```

### Livewire Optimization
```php
// PREFER: Specific property updates
#[Reactive(['selectedShape'])]
public function updatedSelectedShape($value) { }

// AVOID: Heavy computations in render()
public function render() {
    return view('livewire.label-creator', [
        'expensiveData' => $this->getExpensiveData() // Avoid!
    ]);
}
```

## Troubleshooting Prompts

### Cache Issues
```
"Problem z cache w Laravel - sprawdź:
1. php artisan view:clear (Blade cache)
2. php artisan cache:clear (Application cache)  
3. Czy storage/framework/views/ ma stare pliki?
4. Czy asset() paths są poprawne?"
```

### Livewire Issues
```
"Problem z Livewire reactivity - sprawdź:
1. wire:model vs wire:model.live
2. Alpine.js @entangle() sync
3. Validation rules conflicts
4. JavaScript console errors"
```

### Image Loading Issues
```
"Obrazki się nie ładują - sprawdź:
1. Ścieżki w seederze (images/ nie storage/)
2. file_exists(public_path()) checks
3. Uprawnienia plików (chmod 644)
4. Browser Network tab dla 404s"
```

## Code Review Checklist

Przy każdej zmianie sprawdź:
- [ ] Czy zachowane są naming conventions Laravel?
- [ ] Czy Livewire properties mają proper wire:model?
- [ ] Czy Alpine.js state jest zsynchronizowany?
- [ ] Czy validation rules są aktualne?
- [ ] Czy calculatePrice() działa poprawnie?
- [ ] Czy obrazki się ładują (fallback icons)?
- [ ] Czy responsive design jest zachowany?
- [ ] Czy debug info jest usunięte z production?

## Maintenance Commands

```bash
# Przed każdą większą zmianą
php artisan view:clear
php artisan cache:clear
php artisan config:clear

# Po zmianach w seederach
php artisan db:seed --class=LabelDataSeeder

# Po zmianach w migrations
php artisan migrate:fresh --seed

# Test obrazków
curl http://127.0.0.1:8000/images/shapes/rectangle.png
```

---

**Uwaga**: Te instrukcje są living document - aktualizuj je wraz z rozwojem projektu!
