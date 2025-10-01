<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class HistoryPopup extends Component
{
    public $activeFilter = 'all';
    public $activities = [];
    public $loading = false;

    public function mount()
    {
        $this->loadActivities();
    }

    public function setFilter($filter)
    {
        $this->activeFilter = $filter;
        $this->loadActivities();
    }

    public function loadActivities()
    {
        $this->loading = true;
        
        $query = ActivityLog::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->limit(20);

        if ($this->activeFilter !== 'all') {
            $query->where('type', $this->activeFilter);
        }

        $this->activities = $query->get();
        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.history-popup');
    }

    protected $listeners = ['close-history' => 'close'];

    public function close()
    {
        $this->dispatch('close-history');
    }
}