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

    public $user;
    public $mailModel;
    public $resetLink;
    public $supplierModification;

    public function __construct($user, $mailModel, $resetLink, $supplierModification)
    {
        $this->destinator = $user;
        $this->mailModel = $mailModel;
        $this->resetLink = $resetLink;
        $this->supplierModification = $supplierModification;
    }

    public function build()
    {
        return $this->subject($this->mailModel->object)->view('emails.mail');
    }
}
