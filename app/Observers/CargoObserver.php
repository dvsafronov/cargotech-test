<?php

namespace App\Observers;

use App\Models\Cargo;
use App\Models\Counter;
use Illuminate\Support\Facades\DB;

class CargoObserver
{
    public function created(Cargo $cargo)
    {
        Counter::updateOrCreate(['table' => Counter::TABLES['CARGO']])->increment('quantity');
    }

    public function deleted(Cargo $cargo)
    {
        Counter::where('table', Counter::TABLES['CARGO'])->decrement('quantity');
    }

    public function updated(Cargo $cargo)
    {
        if ($cargo->wasChanged('status')) {
            if ((int)$cargo->status === Cargo::STATUSES['DELETED']) {
                Counter::where('table', Counter::TABLES['CARGO'])->decrement('quantity');
            } else if ((int)$cargo->status === Cargo::STATUSES['ACTIVE']) {
                Counter::where('table', Counter::TABLES['CARGO'])->increment('quantity');
            }
        }
    }
}
