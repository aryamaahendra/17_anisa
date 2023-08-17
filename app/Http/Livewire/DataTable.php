<?php

namespace App\Http\Livewire;

use App\Models\Data;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class DataTable extends BaseTable
{
    public function render()
    {
        return view('livewire.data-table');
    }

    public function query(): Builder
    {
        return Data::query();
    }
}
