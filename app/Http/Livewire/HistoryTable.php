<?php

namespace App\Http\Livewire;

use App\Models\History;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class HistoryTable extends BaseTable
{
    public $class = '';

    public function render()
    {
        return view('livewire.history-table');
    }

    public function query(): Builder
    {
        return History::query()->when(
            $this->class != '',
            fn (Builder $query) => $query->where('class', $this->class)
        );
    }
}
