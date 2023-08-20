<?php

namespace App\Http\Livewire;

use App\Models\History;
use Livewire\Component;

class KnnDashboard extends Component
{
    public $processUuid = null;

    protected $listeners = ['setProcess'];

    public function render()
    {
        $process = History::where('uuid', $this->processUuid)->first();
        return view('livewire.knn-dashboard', ['process' => $process]);
    }

    public function setProcess($uuid)
    {
        $this->processUuid = $uuid;
    }
}
