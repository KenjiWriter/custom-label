<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\UserProject;
use Illuminate\Support\Facades\Auth;

class ProjectsPopup extends Component
{
    public $projects = [];
    public $loading = false;

    public function mount()
    {
        $this->loadProjects();
    }

    public function loadProjects()
    {
        $this->loading = true;
        
        $this->projects = UserProject::where('user_id', Auth::id())
            ->orderBy('updated_at', 'desc')
            ->get();
            
        $this->loading = false;
    }

    public function editProject($projectId)
    {
        // Redirect to project editor
        return redirect()->route('project.editor', $projectId);
    }

    public function previewProject($projectId)
    {
        // Show project preview
        $this->dispatch('show-preview', projectId: $projectId);
    }

    public function duplicateProject($projectId)
    {
        $project = UserProject::find($projectId);
        if ($project) {
            $newProject = $project->replicate();
            $newProject->name = $project->name . ' (Kopia)';
            $newProject->status = 'draft';
            $newProject->save();
            
            $this->loadProjects();
            $this->dispatch('notify', message: 'Projekt został zduplikowany');
        }
    }

    public function render()
    {
        return view('livewire.projects-popup');
    }

    protected $listeners = ['close-projects' => 'close'];

    public function close()
    {
        $this->dispatch('close-projects');
    }
}