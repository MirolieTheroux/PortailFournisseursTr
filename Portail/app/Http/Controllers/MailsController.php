<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\BuildMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Supplier;
use App\Models\EmailModel;

class MailsController extends Controller
{
    public function sendMail(Supplier $supplier, EmailModel $mailModel)
    {
        if ($mailModel->destinator == 'fournisseur'){
            $destinator = $supplier->email;
        }
        /*else if ($mailModel->destinator == 'responsable'){
            $destinator = $supplier->email;
        }*/

        if ($mailModel->name == 'inscription'){
            Mail::to($destinator)->send(new BuildMail($supplier, $mailModel));
        }
    }
}
