<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\InscriptionMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Supplier;

class MailsController extends Controller
{
    public function sendInscriptionMail(Supplier $supplier)
    {
        Mail::to($supplier->email)->send(new InscriptionMail($supplier));
    }
}
