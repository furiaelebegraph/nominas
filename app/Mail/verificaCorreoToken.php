<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Seller;

class verificaCorreoToken extends Mailable
{
    use Queueable, SerializesModels;
    public $seller;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Seller $seller)
    {
        $this->seller = $seller;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        return $this->markdown('email.verificaCorreoToken')->with(['seller', $this->seller]);;
    }
}
