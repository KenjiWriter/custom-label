<?php

namespace App\Http\Controllers;

use App\Models\LabelProject;
use Illuminate\Http\Request;
use App\Services\GuestSessionService;

class LabelPreviewController extends Controller
{
    /**
     * Show 3D preview of the label
     */
    public function show($uuid)
    {
        $project = LabelProject::where('uuid', $uuid)
            ->with(['labelShape', 'labelMaterial', 'laminateOption', 'predefinedSize'])
            ->first();

        if (!$project) {
            abort(404, 'Projekt nie został znaleziony.');
        }
        //wykomentowalem dla testu
        // Check if user has access to this project
       /* if (auth()->check()) {
            if ($project->user_id !== auth()->id()) {
                abort(403, 'Nie masz uprawnień do tego projektu.');
            }
        } else {
            if ($project->session_id !== session()->getId()) {
                abort(403, 'Nie masz uprawnień do tego projektu.');
            }
        }
    */
        $dimensions = $project->getActualDimensions();

        return view('label.preview', compact('project', 'dimensions'));
    }
}
