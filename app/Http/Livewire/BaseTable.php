<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

abstract class BaseTable extends Component
{
    use WithPagination;

    public $sortBy = 'created_at';

    public $sortDirection = 'desc';

    public $perPage = 10;

    public function render()
    {
        return view('livewire.base-table');
    }

    public abstract function query(): Builder;

    public function data()
    {
        return $this->query()
            ->when($this->sortBy !== '', function ($query) {
                $query->orderBy($this->sortBy, $this->sortDirection);
            })->paginate($this->perPage);
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }
}
