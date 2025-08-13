<?php

namespace App\Livewire;

use App\Models\LabelShape;
use App\Models\LabelMaterial;
use App\Models\LaminateOption;
use App\Models\PredefinedSize;
use App\Models\LabelProject;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

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

    // Computed properties
    public $calculatedPrice = 0;
    public $isConfigurationValid = false;

    protected $rules = [
        'selectedShape' => 'required|exists:label_shapes,id',
        'selectedMaterial' => 'required|exists:label_materials,id',
        'selectedLaminate' => 'nullable',
        'selectedSize' => 'required_unless:useCustomSize,true|nullable|exists:predefined_sizes,id',
        'customWidth' => 'required_if:useCustomSize,true|nullable|numeric|min:10|max:500',
        'customHeight' => 'required_if:useCustomSize,true|nullable|numeric|min:10|max:500',
        'quantity' => 'required|integer|min:1|max:10000',
        'artworkFile' => 'nullable|file|mimes:jpg,jpeg,png,svg,pdf|max:10240',
    ];

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

    public function mount()
    {
        $this->useCustomSize = false;
        $this->selectedLaminate = '';
        $this->calculatePrice();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
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
            // Dla standardowych rozmiarów - sprawdź czy są dostępne rozmiary dla wybranego kształtu
            $hasAvailableSizes = $this->availableSizes->count() > 0;
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
                'quantity' => $this->quantity,
                'calculatedPrice' => $this->calculatedPrice,
            ]);

            // Prepare data for project creation
            $projectData = [
                'uuid' => Str::uuid(),
                'label_shape_id' => $this->selectedShape,
                'label_material_id' => $this->selectedMaterial,
                'laminate_option_id' => $this->selectedLaminate ?: null,
                'predefined_size_id' => !$this->useCustomSize ? $this->selectedSize : null,
                'custom_width_mm' => $this->useCustomSize ? $this->customWidth : null,
                'custom_height_mm' => $this->useCustomSize ? $this->customHeight : null,
                'quantity' => $this->quantity,
                'calculated_price' => $this->calculatedPrice,
                'status' => 'draft',
            ];

            // Set user_id or session_id for guest users
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

            logger('Project created successfully:', ['uuid' => $project->uuid]);

            // Redirect to preview
            return redirect()->route('label.preview', $project->uuid);

        } catch (\Exception $e) {
            logger('Error saving project: ' . $e->getMessage());
            session()->flash('error', 'Wystąpił błąd podczas zapisywania projektu: ' . $e->getMessage());
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