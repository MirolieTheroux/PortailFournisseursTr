<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\BuildMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Supplier;
use App\Models\EmailModel;
use App\Models\Setting;
use App\Http\Requests\SupplierDenialRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Blade;
use App\Http\Requests\MailsUpdateRequest;

class MailsController extends Controller
{
    public function fetch($name)
    {
        $mail = EmailModel::where('name', $name)->first();

        if (!$mail) {
            return response()->json(['error' => 'Mail model not found'], 404);
        }

        return response()->json($mail);
    }

    public function update(MailsUpdateRequest $request)
    {
        $mail = EmailModel::where('name', $request->input('selectedMail'))->first();

        $placeholders = [
            '{neq}' => '{{ $supplier->neq }}',
            '{nom}' => '{{ $supplier->name }}',
            '{email}' => '{{ $supplier->email }}',
            '{site}' => '{{ $supplier->site }}',
            '{ligne}' => '<br>',
        ];

        if ($request->input('selectedMail') === 'Fournisseur refusé avec raison') {
            $placeholders['{raison}'] = '{{ $raison }}';
        }

        $data = $request->validated();

        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $sanitizedValue = strip_tags($value);
                $data[$key] = str_replace(array_keys($placeholders), array_values($placeholders), $sanitizedValue);
            }
        }

        $mail->update($data);

        return redirect()->route('users.settings')->with('message',__('mail.mailModelModification'))->header('Location', route('users.settings') . '#emails-section');
    }

    public function sendStatusSupplierMail(Supplier $supplier, EmailModel $mailModel)
    {
        $newMailModel = $this->prepareMailModel($supplier, $mailModel, null);
        Mail::to($supplier->email)->send(new BuildMail($supplier, $newMailModel, null, null));
    }

    public function sendDeniedSupplierMail(Supplier $supplier, EmailModel $mailModel, string $reason)
    {
        $newMailModel = $this->prepareMailModel($supplier, $mailModel, $reason);
        Mail::to($supplier->email)->send(new BuildMail($supplier, $newMailModel, null, $reason));
    }

    public function sendToCheckResponsableMail(Supplier $supplier, EmailModel $mailModel)
    {
        $setting = Setting::where('id', 1)->first();
        $newMailModel = $this->prepareMailModel($supplier, $mailModel, null);
        Mail::to($setting->approbation_email)->send(new BuildMail($supplier, $newMailModel, null, null));
    }

    public function prepareMailModel($supplier, $mailModel, $reason){
        $newMailModel = new EmailModel();
        $newMailModel->id = $mailModel->id;
        $newMailModel->name = $mailModel->name;
        $newMailModel->object = Blade::render($mailModel->object, ['supplier' => $supplier, 'reason' => $reason]);
        $newMailModel->logoUrl = $mailModel->logoUrl;
        $newMailModel->logoSize = $mailModel->logoSize;
        $newMailModel->titleText = Blade::render($mailModel->titleText, ['supplier' => $supplier, 'reason' => $reason]);
        $newMailModel->titleSize = $mailModel->titleSize;
        $newMailModel->titleColor = $mailModel->titleColor;
        $newMailModel->buttonUrl = $mailModel->buttonUrl;
        $newMailModel->buttonText = Blade::render($mailModel->buttonText, ['supplier' => $supplier, 'reason' => $reason]);
        $newMailModel->buttonTextColor = $mailModel->buttonTextColor;
        $newMailModel->buttonBackgroundColor = $mailModel->buttonBackgroundColor;
        $newMailModel->descriptionText = Blade::render($mailModel->descriptionText, ['supplier' => $supplier, 'reason' => $reason]);
        $newMailModel->descriptionSize = $mailModel->descriptionSize;
        $newMailModel->descriptionColor = $mailModel->descriptionColor;
        $newMailModel->headerBackgroundUrl = $mailModel->headerBackgroundUrl;
        $newMailModel->subtitleText = Blade::render($mailModel->subtitleText, ['supplier' => $supplier, 'reason' => $reason]);
        $newMailModel->subtitleSize = $mailModel->subtitleSize;
        $newMailModel->subtitleColor = $mailModel->subtitleColor;
        $newMailModel->iconUrl = $mailModel->iconUrl;
        $newMailModel->iconSize = $mailModel->iconSize;
        $newMailModel->importantInfoText = Blade::render($mailModel->importantInfoText, ['supplier' => $supplier, 'reason' => $reason]);
        $newMailModel->importantInfoSize = $mailModel->importantInfoSize;
        $newMailModel->importantInfoColor = $mailModel->importantInfoColor;
        $newMailModel->passwordResetButtonText = Blade::render($mailModel->passwordResetButtonText, ['supplier' => $supplier, 'reason' => $reason]);
        $newMailModel->passwordResetButtonColor = $mailModel->passwordResetButtonColor;
        $newMailModel->passwordResetButtonBackgroundColor = $mailModel->passwordResetButtonBackgroundColor;
        $newMailModel->messageText = Blade::render($mailModel->messageText, ['supplier' => $supplier, 'reason' => $reason]);
        $newMailModel->messageSize = $mailModel->messageSize;
        $newMailModel->messageColor = $mailModel->messageColor;
        $newMailModel->backgroundColor = $mailModel->backgroundColor;
        $newMailModel->footerText = Blade::render($mailModel->footerText, ['supplier' => $supplier, 'reason' => $reason]);
        $newMailModel->footerSize = $mailModel->footerSize;
        $newMailModel->footerColor = $mailModel->footerColor;
        $newMailModel->footerBackgroundUrl = $mailModel->footerBackgroundUrl;
        return $newMailModel;
    }
}
