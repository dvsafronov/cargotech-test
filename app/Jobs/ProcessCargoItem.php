<?php

namespace App\Jobs;

use App\Models\Cargo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessCargoItem implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $item = [];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($item)
    {
        $this->item = [
            'status' => Cargo::STATUSES['ACTIVE'],
            'id' => $item['id'],
            'volume' => $item['volume'],
            'weight' => $item['weight'],
            'truck' => $item['truck'],
        ];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle($item)
    {
        $cargo = Cargo::updateOrCreate(['id' => $item['id']], $item);
        if ($cargo->wasChanged()) {
            CargoUpdatedEvent::dispatch((int)$cargo['id'])->delay(now()->addMinutes(5));
        } else {
            CargoCreatedEvent::dispatch((int)$cargo['id']);
        }
    }
}
