<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\EmailModel;

class BuildMail extends Mailable
{
    use Queueable, SerializesModels;

    public $supplier;
    public $mailModel;
    public $resetLink;
    public $reason;

    public function __construct($supplier, $mailModel, $resetLink, $reason)
    {
        $this->supplier = $supplier;
        $this->mailModel = $mailModel;
        $this->resetLink = $resetLink;
        $this->reason = $reason;
    }

    public function build()
    {
        return $this->subject($this->mailModel->object)->view('emails.mail');
    }
}
