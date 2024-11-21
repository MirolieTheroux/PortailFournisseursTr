<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\BuildMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Supplier;
use App\Models\EmailModel;
use Illuminate\Support\Facades\Log;

class MailsController extends Controller
{
    public function sendStatusSupplierMail(Supplier $supplier, EmailModel $mailModel)
    {
        Mail::to($supplier->email)->send(new BuildMail('Supplier', $supplier, $mailModel));
    }

    public function sendToCheckResponsableMail(Supplier $supplier, EmailModel $mailModel)
    {
        Mail::to(env('MAIL_RESPONSABLE'))->send(new BuildMail('Responsable', $supplier, $mailModel));
    }
}
