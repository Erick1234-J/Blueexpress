<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Parcels;

class TrackingNumber extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $parcel;
    
    public function __construct(Parcels $parcel)
    {
        $this->parcel = $parcel;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
                     return $this->from('shopeasy@gmail.com', 'CEO')
                     ->view('emails.tracking');
    }
}
