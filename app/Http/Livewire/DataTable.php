<?php

namespace App\Http\Livewire;

use App\Models\Data;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class DataTable extends BaseTable
{
    public $class = '';
    public $type = '';

    public function render()
    {
        return view('livewire.data-table');
    }

    public function query(): Builder
    {
        return Data::query()->when(
            $this->class != '',
            fn (Builder $query) => $query->where('class', $this->class)
        )->when(
            $this->type != '',
            fn (Builder $query) => $query->where('type', $this->type)
        );
    }
}
