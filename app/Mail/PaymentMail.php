<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentMail extends Mailable
{
    use Queueable, SerializesModels;

    // protected $email;
    protected $payment;
    protected $url;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($payment, $url)
    {
        $this->payment = $payment;
        $this->url= $url;
    }
    public function build(){
        return $this->view('admins.emails.index')->with(['payment' => $this->payment, 'url' => $this->url]);
    }
}
