<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Client;
use App\Models\InvoiceSummary;

class RenewalNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $client;
    public $invoiceSummary;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Client $client, InvoiceSummary $invoiceSummary)
    {
        $this->client = $client;
        $this->invoiceSummary = $invoiceSummary;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Alert For Renew Your Service')
                    ->view('emails.renewal_notification');
    }
}
