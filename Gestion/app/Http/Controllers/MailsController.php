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
    public $destinator;
    public function sendMail(Supplier $supplier, EmailModel $mailModel)
    {
        if ($mailModel->destinator == "fournisseur"){
            $destinator = $supplier->email;
        }
        
        Mail::to($destinator)->send(new BuildMail($supplier, $mailModel));
    }
}
