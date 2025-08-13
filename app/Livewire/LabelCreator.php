<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\LabelShape;
use App\Models\LabelMaterial;
use App\Models\LaminateOption;
use App\Models\PredefinedSize;
use App\Models\LabelProject;
use App\Services\PriceCalculationService;
use App\Services\GuestSessionService;
use Illuminate\Support\Facades\Storage;

class LabelCreator extends Component
{
    use WithFileUploads;

    // Selected options
    public $selectedShape = null;
    public $selectedMaterial = null;
    public $selectedLaminate = null;
    public $selectedSize = null;
    
    // Custom dimensions
    public $customWidth = null;
    public $customHeight = null;
    public $useCustomSize = false;
    
    // Order details
    public $quantity = 1;
    public $artworkFile = null;
    
    // Calculated values
    public $calculatedPrice = 0;
    public $isConfigurationValid = false;
    
    // Data collections
    public $shapes;
    public $materials;
    public $laminateOptions;
    public $availableSizes = [];

    protected $rules = [
        'selectedShape' => 'required|exists:label_shapes,id',
        'selectedMaterial' => 'required|exists:label_materials,id',
        'selectedLaminate' => 'nullable|exists:laminate_options,id',
        'selectedSize' => 'required_unless:useCustomSize,true|exists:predefined_sizes,id',
        'customWidth' => 'required_if:useCustomSize,true|integer|min:10|max:500',
        'customHeight' => 'required_if:useCustomSize,true|integer|min:10|max:500',
        'quantity' => 'required|integer|min:1|max:10000',
        'artworkFile' => 'nullable|file|mimes:jpg,jpeg,png,svg,pdf|max:10240', // 10MB max
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
        'artworkFile.mimes' => 'Dozwolone formaty: JPG, PNG, SVG, PDF.',
    ];

    public function mount()
    {
        $this->shapes = LabelShape::active()->get();
        $this->materials = LabelMaterial::active()->get();
        $this->laminateOptions = LaminateOption::active()->get();
    }

    public function updatedSelectedShape($value)
    {
        if ($value) {
            $this->availableSizes = PredefinedSize::where('label_shape_id', $value)
                ->active()
                ->get();
            
            // Reset size selection when shape changes
            $this->selectedSize = null;
            $this->useCustomSize = false;
        } else {
            $this->availableSizes = [];
        }
        
        $this->calculatePrice();
        $this->validateConfiguration();
    }

    public function updatedSelectedMaterial()
    {
        $this->calculatePrice();
        $this->validateConfiguration();
    }

    public function updatedSelectedLaminate()
    {
        $this->calculatePrice();
        $this->validateConfiguration();
    }

    public function updatedSelectedSize()
    {
        $this->calculatePrice();
        $this->validateConfiguration();
    }

    public function updatedUseCustomSize($value)
    {
        if ($value) {
            $this->selectedSize = null;
        } else {
            $this->customWidth = null;
            $this->customHeight = null;
        }
        
        $this->calculatePrice();
        $this->validateConfiguration();
    }

    public function updatedCustomWidth()
    {
        $this->calculatePrice();
        $this->validateConfiguration();
    }

    public function updatedCustomHeight()
    {
        $this->calculatePrice();
        $this->validateConfiguration();
    }

    public function updatedQuantity()
    {
        $this->calculatePrice();
    }

    private function calculatePrice()
    {
        $config = [
            'shape_id' => $this->selectedShape,
            'material_id' => $this->selectedMaterial,
            'laminate_id' => $this->selectedLaminate,
            'quantity' => $this->quantity,
        ];

        if ($this->useCustomSize) {
            $config['custom_width'] = $this->customWidth;
            $config['custom_height'] = $this->customHeight;
        } else {
            $config['predefined_size_id'] = $this->selectedSize;
        }

        $priceCalculator = new PriceCalculationService();
        $this->calculatedPrice = $priceCalculator->calculatePrice($config);
    }

    private function validateConfiguration()
    {
        $hasShape = !empty($this->selectedShape);
        $hasMaterial = !empty($this->selectedMaterial);
        $hasSize = !empty($this->selectedSize) || 
                   ($this->useCustomSize && !empty($this->customWidth) && !empty($this->customHeight));

        $this->isConfigurationValid = $hasShape && $hasMaterial && $hasSize;
    }

    public function saveProject()
    {
        $this->validate();

        $guestService = new GuestSessionService();
        $userIdentifier = $guestService->getUserIdentifier();

        // Handle file upload
        $artworkPath = null;
        $artworkName = null;
        $artworkSize = null;

        if ($this->artworkFile) {
            $artworkPath = $this->artworkFile->store('artwork', 'public');
            $artworkName = $this->artworkFile->getClientOriginalName();
            $artworkSize = $this->artworkFile->getSize();
        }

        $project = LabelProject::create([
            'user_id' => $userIdentifier['user_id'],
            'session_id' => $userIdentifier['session_id'],
            'label_shape_id' => $this->selectedShape,
            'label_material_id' => $this->selectedMaterial,
            'laminate_option_id' => $this->selectedLaminate,
            'predefined_size_id' => $this->useCustomSize ? null : $this->selectedSize,
            'custom_width_mm' => $this->useCustomSize ? $this->customWidth : null,
            'custom_height_mm' => $this->useCustomSize ? $this->customHeight : null,
            'quantity' => $this->quantity,
            'calculated_price' => $this->calculatedPrice,
            'artwork_file_path' => $artworkPath,
            'artwork_file_name' => $artworkName,
            'artwork_file_size' => $artworkSize,
            'status' => 'configured',
        ]);

        // Redirect to 3D preview page
        return redirect()->route('label.preview', ['uuid' => $project->uuid]);
    }

    public function render()
    {
        return view('livewire.label-creator');
    }
}