<?php

namespace App\Mail;


use App\Models\Kontak;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReplyToMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public $kontak;

    /**
     * Create a new message instance.
     */
    public function __construct(Kontak $kontak)
    {
        $this->kontak = $kontak;
    }

    public function build()
    {
        return $this->subject('Balasan untuk pesan Anda')
            ->view('emails.reply_message')
            ->with(['emailMessage' => $this->kontak->message]);
    }
}
