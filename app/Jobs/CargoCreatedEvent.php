<?php

namespace App\Jobs;

use App\Mail\CargoCreatedMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class CargoCreatedEvent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $cargo_id = 0;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $cargo_id)
    {
        $this->cargo_id = $cargo_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to(env('NOTIFY_EMAIL'))->send(new CargoCreatedMail($this->cargo_id));
    }
}
