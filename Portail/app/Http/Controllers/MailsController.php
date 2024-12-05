<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\BuildMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Supplier;
use App\Models\EmailModel;
use Illuminate\Support\Facades\Blade;

class MailsController extends Controller
{
    public function sendInscriptionSupplierMail(Supplier $supplier, EmailModel $mailModel)
    {
        $newMailModel = $this->prepareMailModel($supplier, $mailModel);
        Mail::to($supplier->email)->send(new BuildMail($supplier, $newMailModel, null));
    }

    public function sendInscriptionNotificationResponsableMail(Supplier $supplier, EmailModel $mailModel)
    {
        $newMailModel = $this->prepareMailModel($supplier, $mailModel);
        Mail::to('faucher.jeremy2.0@gmail.com')->send(new BuildMail($supplier, $newMailModel, null));
    }

    public function sendResetPasswordSupplierMail(Supplier $supplier, EmailModel $mailModel, string $resetLink)
    {
        $newMailModel = $this->prepareMailModel($supplier, $mailModel);
        Mail::to($supplier->email)->send(new BuildMail($supplier, $newMailModel, $resetLink));
    }

    public function sendModificationResponsableMail(Supplier $supplier, EmailModel $mailModel)
    {
        $newMailModel = $this->prepareMailModel($supplier, $mailModel);
        Mail::to('faucher.jeremy2.0@gmail.com')->send(new BuildMail($supplier, $newMailModel, null));
    }

    public function prepareMailModel($supplier, $mailModel){
        $newMailModel = new EmailModel();
        $newMailModel->id = $mailModel->id;
        $newMailModel->name = $mailModel->name;
        $newMailModel->object = Blade::render($mailModel->object, ['supplier' => $supplier]);
        $newMailModel->logoUrl = $mailModel->logoUrl;
        $newMailModel->logoSize = $mailModel->logoSize;
        $newMailModel->titleText = Blade::render($mailModel->titleText, ['supplier' => $supplier]);
        $newMailModel->titleSize = $mailModel->titleSize;
        $newMailModel->titleColor = $mailModel->titleColor;
        $newMailModel->buttonUrl = $mailModel->buttonUrl;
        $newMailModel->buttonText = Blade::render($mailModel->buttonText, ['supplier' => $supplier]);
        $newMailModel->buttonTextColor = $mailModel->buttonTextColor;
        $newMailModel->buttonBackgroundColor = $mailModel->buttonBackgroundColor;
        $newMailModel->descriptionText = Blade::render($mailModel->descriptionText, ['supplier' => $supplier]);
        $newMailModel->descriptionSize = $mailModel->descriptionSize;
        $newMailModel->descriptionColor = $mailModel->descriptionColor;
        $newMailModel->headerBackgroundUrl = $mailModel->headerBackgroundUrl;
        $newMailModel->subtitleText = Blade::render($mailModel->subtitleText, ['supplier' => $supplier]);
        $newMailModel->subtitleSize = $mailModel->subtitleSize;
        $newMailModel->subtitleColor = $mailModel->subtitleColor;
        $newMailModel->iconUrl = $mailModel->iconUrl;
        $newMailModel->iconSize = $mailModel->iconSize;
        $newMailModel->importantInfoText = Blade::render($mailModel->importantInfoText, ['supplier' => $supplier]);
        $newMailModel->importantInfoSize = $mailModel->importantInfoSize;
        $newMailModel->importantInfoColor = $mailModel->importantInfoColor;
        $newMailModel->passwordResetButtonText = Blade::render($mailModel->passwordResetButtonText, ['supplier' => $supplier]);
        $newMailModel->passwordResetButtonColor = $mailModel->passwordResetButtonColor;
        $newMailModel->passwordResetButtonBackgroundColor = $mailModel->passwordResetButtonBackgroundColor;
        $newMailModel->messageText = Blade::render($mailModel->messageText, ['supplier' => $supplier]);
        $newMailModel->messageSize = $mailModel->messageSize;
        $newMailModel->messageColor = $mailModel->messageColor;
        $newMailModel->backgroundColor = $mailModel->backgroundColor;
        $newMailModel->footerText = Blade::render($mailModel->footerText, ['supplier' => $supplier]);
        $newMailModel->footerSize = $mailModel->footerSize;
        $newMailModel->footerColor = $mailModel->footerColor;
        $newMailModel->footerBackgroundUrl = $mailModel->footerBackgroundUrl;
        return $newMailModel;
    }
}
