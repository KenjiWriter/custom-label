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
    public function show(string $uuid)
    {
        $guestService = new GuestSessionService();
        $userIdentifier = $guestService->getUserIdentifier();

        $project = LabelProject::where('uuid', $uuid)
            ->when($userIdentifier['user_id'], function ($query, $userId) {
                return $query->where('user_id', $userId);
            })
            ->when($userIdentifier['session_id'], function ($query, $sessionId) {
                return $query->where('session_id', $sessionId);
            })
            ->with(['labelShape', 'labelMaterial', 'laminateOption', 'predefinedSize'])
            ->firstOrFail();

        if (!$project->isReadyForPreview()) {
            return redirect()->route('home')->with('error', 'Projekt nie jest gotowy do podglądu.');
        }

        return view('label.preview', compact('project'));
    }
}