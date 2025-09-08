<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\LabelShape;
use App\Models\LabelMaterial;
use App\Models\PredefinedSize;
use App\Models\LaminateOption;
use App\Models\LabelProject;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class LabelCreator extends Component
{
    use WithFileUploads;

    // Public properties for form data
    public $selectedShape = null;
    public $selectedMaterial = null;
    public $selectedLaminate = '';
    public $selectedSize = null;
    public $useCustomSize = false;
    public $customWidth = null;
    public $customHeight = null;
    public $quantity = 100;
    public $artworkFile = null;
    public $tempArtworkPath = null;
    public $imagePositionX = 50; // Domyślnie wycentrowany w poziomie
    public $imagePositionY = 50; // Domyślnie wycentrowany w pionie
    public $imageScale = 100;    // Domyślnie 100% skala
    public $imageRotation = 0;   // Domyślnie bez rotacji

    // Computed properties
    public $calculatedPrice = 0;
    public $isConfigurationValid = false;

    // Nowa właściwość do śledzenia kroku kreatora
    public $currentStep = 1;

    protected function rules()
    {
        $rules = [
            'selectedShape' => 'required|exists:label_shapes,id',
            'selectedMaterial' => 'required|exists:label_materials,id',
            'selectedLaminate' => 'nullable',
            'selectedSize' => 'required_unless:useCustomSize,true|nullable|exists:predefined_sizes,id',
            'customWidth' => 'required_if:useCustomSize,true|nullable|numeric|min:10|max:500',
            'customHeight' => 'required_if:useCustomSize,true|nullable|numeric|min:10|max:500',
            'quantity' => 'required|integer|min:1|max:10000',
            'artworkFile' => 'nullable|image|max:10240', // max 10MB
        ];
        return $rules;
    }

    protected $messages = [
        'selectedShape.required' => 'Wybierz kształt etykiety.',
        'selectedMaterial.required' => 'Wybierz materiał etykiety.',
        'selectedSize.required_unless' => 'Wybierz rozmiar etykiety.',
        'customWidth.required_if' => 'Podaj szerokość etykiety.',
        'customWidth.min' => 'Minimalna szerokość to 10mm.',
        'customWidth.max' => 'Maksymalna szerokość to 500mm.',
        'customHeight.required_if' => 'Podaj wysokość etykiety.',
        'customHeight.min' => 'Minimalna wysokość to 10mm.',
        'customHeight.max' => 'Maksymalna wysokość to 500mm.',
        'quantity.min' => 'Minimalna ilość to 1 sztuka.',
        'quantity.max' => 'Maksymalna ilość to 10000 sztuk.',
        'artworkFile.max' => 'Maksymalny rozmiar pliku to 10MB.',
    ];

    /**
     * Mount komponentu - wywoływane przy inicjalizacji
     */
    public function mount(Request $request)
    {
        $this->useCustomSize = false;
        $this->selectedLaminate = '';

        // Sprawdź czy wracamy z podglądu 3D
        $fromPreview = $request->has('fromPreview') && $request->fromPreview === 'true';
        $returnToCreator = $request->has('returnToCreator') && $request->returnToCreator === 'true';

        // Jeśli mamy ID projektu w URL i wracamy z podglądu
        if ($request->has('project') && ($fromPreview || $returnToCreator)) {
            $projectId = $request->project;

            // Pobierz projekt z bazy danych
            $project = LabelProject::find($projectId);

            if ($project) {
                // Ustaw aktualny krok na 4 (finalizacja)
                $this->currentStep = 4;

                // Przypisz dane projektu do właściwości komponentu
                $this->selectedShape = $project->label_shape_id;
                $this->selectedMaterial = $project->label_material_id;
                $this->quantity = $project->quantity;

                // Obsługa rozmiaru
                if ($project->predefined_size_id) {
                    $this->useCustomSize = false;
                    $this->selectedSize = $project->predefined_size_id;
                } else {
                    $this->useCustomSize = true;
                    $this->customWidth = $project->custom_width_mm;
                    $this->customHeight = $project->custom_height_mm;
                }

                // Obsługa laminatu
                if ($project->laminate_option_id) {
                    $this->selectedLaminate = $project->laminate_option_id;
                }

                // Obsługa obrazka
                if ($project->artwork_file_path) {
                    $this->tempArtworkPath = $project->artwork_file_path;

                    // Jeśli mamy dane pozycjonowania obrazka
                    if ($project->image_position_x !== null) {
                        $this->imagePositionX = $project->image_position_x;
                        $this->imagePositionY = $project->image_position_y;
                        $this->imageScale = $project->image_scale;
                        $this->imageRotation = $project->image_rotation;
                    }
                }

                // Przelicz cenę na nowo
                $this->calculatePrice();
                $this->checkConfiguration();

                // Emituj zdarzenie, że formularz został zaktualizowany
                $this->dispatch('formUpdated');
            }
        } else {
            $this->calculatePrice();
        }
    }

    // Dodaj metodę obsługi pliku:
    public function updatedArtworkFile()
    {
        $this->validate([
            'artworkFile' => 'image|max:10240', // max 10MB
        ]);

        if ($this->artworkFile) {
            // Usuń stary plik jeśli istnieje
            if ($this->tempArtworkPath && Storage::disk('public')->exists($this->tempArtworkPath)) {
                Storage::disk('public')->delete($this->tempArtworkPath);
            }

            // ZMIANA: zapisuj na dysku 'public' z bezpośrednią ścieżką
            $this->tempArtworkPath = $this->artworkFile->store('temp/artworks', 'public');

            // Dodaj wiadomość o sukcesie
            session()->flash('message', 'Grafika została pomyślnie wczytana.');
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        $this->calculatePrice();
        $this->checkConfiguration();
    }

    public function updatedUseCustomSize($value)
    {
        // Konwertuj string na boolean
        $value = filter_var($value, FILTER_VALIDATE_BOOLEAN);

        // Resetuj odpowiednie pola przy zmianie typu rozmiaru
        if ($value) {
            // Przełączenie na custom size - resetuj selected size
            $this->selectedSize = null;
        } else {
            // Przełączenie na standardowe rozmiary - resetuj custom dimensions
            $this->customWidth = null;
            $this->customHeight = null;
        }

        $this->calculatePrice();
        $this->checkConfiguration();
    }

    public function setCustomSize($isCustom)
    {
        $this->useCustomSize = $isCustom;

        if ($isCustom) {
            // Przełączenie na custom size - resetuj selected size
            $this->selectedSize = null;
        } else {
            // Przełączenie na standardowe rozmiary - resetuj custom dimensions
            $this->customWidth = null;
            $this->customHeight = null;
            $this->selectedSize = null; // Reset aby użytkownik mógł wybrać ponownie
        }

        $this->calculatePrice();
        $this->checkConfiguration();
    }

    public function updatedSelectedSize($value)
    {
        // Gdy wybierasz standardowy rozmiar, upewnij się że custom size jest wyłączony
        if ($value && $this->useCustomSize) {
            $this->useCustomSize = false;
            $this->customWidth = null;
            $this->customHeight = null;
        }

        $this->calculatePrice();
        $this->checkConfiguration();
    }

    public function calculatePrice()
    {
        if (!$this->selectedShape || !$this->selectedMaterial || !$this->quantity) {
            $this->calculatedPrice = 0;
            return;
        }

        $shape = LabelShape::find($this->selectedShape);
        $material = LabelMaterial::find($this->selectedMaterial);

        if (!$shape || !$material) {
            $this->calculatedPrice = 0;
            return;
        }

        // Calculate area
        $areaCm2 = 0;
        if ($this->useCustomSize && $this->customWidth && $this->customHeight) {
            $areaCm2 = ($this->customWidth * $this->customHeight) / 100; // mm2 to cm2
        } elseif (!$this->useCustomSize && $this->selectedSize) {
            $size = PredefinedSize::find($this->selectedSize);
            if ($size) {
                $areaCm2 = $size->getAreaCm2();
            }
        }

        if ($areaCm2 <= 0) {
            $this->calculatedPrice = 0;
            return;
        }

        // Base price calculation
        $basePrice = $areaCm2 * $material->price_per_cm2 * $shape->base_price_multiplier;

        // Add laminate cost if selected
        if ($this->selectedLaminate) {
            $laminate = LaminateOption::find($this->selectedLaminate);
            if ($laminate) {
                $basePrice *= $laminate->price_multiplier;
            }
        }

        // Multiply by quantity
        $totalPrice = $basePrice * $this->quantity;

        // Add VAT (23%)
        $this->calculatedPrice = $totalPrice * 1.23;
    }

    public function checkConfiguration()
    {
        $isValid = $this->selectedShape &&
                   $this->selectedMaterial &&
                   $this->quantity > 0;

        if ($this->useCustomSize) {
            $isValid = $isValid && $this->customWidth > 0 && $this->customHeight > 0;
        } else {
            // POPRAWKA - bezpieczne sprawdzenie dostępnych rozmiarów
            $availableSizes = $this->getAvailableSizesProperty();
            $hasAvailableSizes = $availableSizes && $availableSizes->count() > 0;

            if ($hasAvailableSizes) {
                $isValid = $isValid && $this->selectedSize;
            } else {
                // Jeśli brak standardowych rozmiarów, wymusz custom size
                $this->useCustomSize = true;
                $isValid = $isValid && $this->customWidth > 0 && $this->customHeight > 0;
            }
        }

        $this->isConfigurationValid = $isValid;
    }

    public function getAvailableSizesProperty()
    {
        if (!$this->selectedShape) {
            return collect();
        }

        return PredefinedSize::where('label_shape_id', $this->selectedShape)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();
    }

    /**
     * Przywraca dane projektu po powrocie z podglądu 3D
     */
    public function restoreFromPreview()
    {
        // Pobierz ID projektu z URL
        $projectId = request()->query('project');

        if ($projectId) {
            // Pobierz projekt z bazy danych
            $project = LabelProject::find($projectId);

            if ($project) {
                // Ustaw aktualny krok na 4 (finalizacja)
                $this->currentStep = 4;

                // Przypisz dane projektu do właściwości komponentu
                $this->selectedShape = $project->label_shape_id;
                $this->selectedMaterial = $project->label_material_id;
                $this->quantity = $project->quantity;

                // Obsługa rozmiaru
                if ($project->predefined_size_id) {
                    $this->useCustomSize = false;
                    $this->selectedSize = $project->predefined_size_id;
                } else {
                    $this->useCustomSize = true;
                    $this->customWidth = $project->custom_width_mm;
                    $this->customHeight = $project->custom_height_mm;
                }

                // Obsługa laminatu
                if ($project->laminate_option_id) {
                    $this->selectedLaminate = $project->laminate_option_id;
                }

                // Obsługa obrazka
                if ($project->artwork_file_path) {
                    $this->tempArtworkPath = $project->artwork_file_path;

                    // Jeśli mamy dane pozycjonowania obrazka
                    if ($project->image_position_x !== null) {
                        $this->imagePositionX = $project->image_position_x;
                        $this->imagePositionY = $project->image_position_y;
                        $this->imageScale = $project->image_scale;
                        $this->imageRotation = $project->image_rotation;
                    }
                }

                // Przelicz cenę na nowo
                $this->calculatePrice();
                $this->checkConfiguration();

                // Emituj zdarzenie, że formularz został zaktualizowany
                $this->dispatch('formUpdated');
            }
        }
    }

    public function saveProject()
    {
        try {
            // Sprawdź konfigurację przed walidacją
            $this->checkConfiguration();

            if (!$this->isConfigurationValid) {
                session()->flash('error', 'Uzupełnij wszystkie wymagane pola konfiguracji.');
                return;
            }

            // Walidacja z dostosowanymi regułami
            $validatedData = $this->validate();

            // Debug info
            logger('Saving project with data:', [
                'selectedShape' => $this->selectedShape,
                'selectedMaterial' => $this->selectedMaterial,
                'useCustomSize' => $this->useCustomSize,
                'customWidth' => $this->customWidth,
                'customHeight' => $this->customHeight,
                'selectedSize' => $this->selectedSize,
                'selectedLaminate' => $this->selectedLaminate,
                'quantity' => $this->quantity,
                'calculatedPrice' => $this->calculatedPrice
            ]);

            // Prepare project data - POPRAWKA: dodajemy parametry pozycjonowania obrazka
            $projectData = [
                'uuid' => (string) \Illuminate\Support\Str::uuid(),
                'label_shape_id' => $this->selectedShape,
                'label_material_id' => $this->selectedMaterial,
                'quantity' => $this->quantity,
                'calculated_price' => $this->calculatedPrice,
                'status' => 'preview',
                'laminate_option_id' => $this->selectedLaminate ?: null,
                'predefined_size_id' => !$this->useCustomSize ? $this->selectedSize : null,
                'custom_width_mm' => $this->useCustomSize ? $this->customWidth : null,
                'custom_height_mm' => $this->useCustomSize ? $this->customHeight : null,
                'image_position_x' => $this->imagePositionX,
                'image_position_y' => $this->imagePositionY,
                'image_scale' => $this->imageScale,
                'image_rotation' => $this->imageRotation,
            ];

            // Sprawdź czy user jest zalogowany czy to gość
            if (auth()->check()) {
                $projectData['user_id'] = auth()->id();
            } else {
                $projectData['session_id'] = session()->getId();
            }

            // Create label project
            $project = LabelProject::create($projectData);

            // Handle file upload if present
            if ($this->artworkFile) {
                $path = $this->artworkFile->store('artwork', 'public');
                $project->update(['artwork_file_path' => $path]);
            }

            // Handle artwork from tempArtworkPath if exists
            if ($this->tempArtworkPath) {
                try {
                    // Sprawdź czy plik istnieje
                    if (!Storage::disk('public')->exists($this->tempArtworkPath)) {
                        logger('Ostrzeżenie: Plik nie istnieje:', ['path' => $this->tempArtworkPath]);
                    }

                    // Zapisz ścieżkę bez 'public/' na początku
                    $project->update(['artwork_file_path' => $this->tempArtworkPath]);

                    // Wyraźne logowanie dla debugowania
                    $fullUrl = Storage::url($this->tempArtworkPath);
                    logger('Zapisano ścieżkę do artwork:', [
                        'tempPath' => $this->tempArtworkPath,
                        'fullUrl' => $fullUrl,
                        'fileExists' => Storage::disk('public')->exists($this->tempArtworkPath)
                    ]);
                } catch (\Exception $e) {
                    logger('Błąd przy zapisie ścieżki do artwork:', ['error' => $e->getMessage()]);
                }

            }

            logger('Project created successfully:', ['uuid' => $project->uuid, 'id' => $project->id]);

            // Generate preview URL - upewnij się, że używasz właściwego parametru (uuid)
            $previewUrl = route('label.preview', ['uuid' => $project->uuid]);

            // Dodaj logowanie URL do debugowania
            logger('Preview URL:', ['url' => $previewUrl]);

            // Redirect to preview
            return redirect()->to($previewUrl);

        } catch (\Exception $e) {
            logger('Error saving project: ' . $e->getMessage());
            logger('Stack trace: ' . $e->getTraceAsString());
            session()->flash('error', 'Wystąpił błąd podczas zapisywania projektu: ' . $e->getMessage());
            return null;
        }
    }

    public function render()
    {
        return view('livewire.label-creator', [
            'shapes' => LabelShape::active()->orderBy('sort_order')->get(),
            'materials' => LabelMaterial::active()->orderBy('sort_order')->get(),
            'laminateOptions' => LaminateOption::active()->orderBy('sort_order')->get(),
            'availableSizes' => $this->availableSizes,
        ]);
    }
}
