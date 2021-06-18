<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CargoCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $cargo_id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(int $cargo_id)
    {
        $this->cargo_id = $cargo_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.cargo-created', ['cargo_id' => $this->cargo_id])
            ->subject('Новая запись в Cargo.');
    }
}
