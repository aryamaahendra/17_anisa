<?php

namespace App\Http\Livewire;

use App\Models\Testing;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class TestingTable extends BaseTable
{
    public function render()
    {
        return view('livewire.testing-table');
    }

    public function query(): Builder
    {
        return Testing::query();
    }

    public function setAsK($id)
    {
        $tests = Testing::where('isSet', true)->get();
        foreach ($tests as $test) {
            $test->isSet = false;
            $test->save();
        }

        $test = Testing::find($id);
        $test->isSet = true;
        $test->save();
    }
}
