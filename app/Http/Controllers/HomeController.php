<?php

namespace App\Http\Controllers;

use App\Models\LabelShape;
use App\Models\LabelMaterial;
use App\Models\LaminateOption;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page with label creator
     */
    public function index()
    {
        return view('home', [
            'shapes' => LabelShape::active()->get(),
            'materials' => LabelMaterial::active()->get(),
            'laminateOptions' => LaminateOption::active()->get(),
        ]);
    }
}