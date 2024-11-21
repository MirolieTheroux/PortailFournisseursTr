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
    public $destinator;

    public function __construct($destinator, $user, $mailModel)
    {
        $this->user = $destinator;
        $this->user = $user;
        $this->mailModel = $mailModel;
    }

    public function build()
    {
        return $this->subject($this->mailModel->object)->view('emails.mail');
    }
}
