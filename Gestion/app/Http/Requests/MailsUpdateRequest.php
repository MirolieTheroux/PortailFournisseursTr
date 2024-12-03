<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailsUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'object' => 'required|max:128',
            'headerBackgroundUrl' => 'nullable|max:512',
            'logoUrl' => 'nullable|max:512',
            'logoSize' => 'required|numeric|min:0|max:500',
            'titleText' => 'nullable|max:64',
            'titleSize' => 'required|numeric|min:0|max:50',
            'titleColor' => 'required|regex:/^#[0-9A-Fa-f]{6}$/',
            'buttonUrl' => 'nullable|max:512',
            'buttonText' => 'nullable|max:50',
            'buttonTextColor' => 'required|regex:/^#[0-9A-Fa-f]{6}$/',
            'buttonBackgroundColor' => 'required|regex:/^#[0-9A-Fa-f]{6}$/',
            'descriptionText' => 'nullable|max:100',
            'descriptionSize' => 'required|numeric|min:0|max:50',
            'descriptionColor' => 'required|regex:/^#[0-9A-Fa-f]{6}$/',
            'subtitleText' => 'nullable|max:50',
            'subtitleSize' => 'required|numeric|min:0|max:50',
            'subtitleColor' => 'required|regex:/^#[0-9A-Fa-f]{6}$/',
            'iconUrl' => 'nullable|max:512',
            'iconSize' => 'required|numeric|min:0|max:500',
            'importantInfoText' => 'nullable|max:50',
            'importantInfoSize' => 'required|numeric|min:0|max:50',
            'importantInfoColor' => 'required|regex:/^#[0-9A-Fa-f]{6}$/',
            'passwordResetButtonText' => 'nullable|max:50',
            'passwordResetButtonColor' => 'required|regex:/^#[0-9A-Fa-f]{6}$/',
            'passwordResetButtonBackgroundColor' => 'required|regex:/^#[0-9A-Fa-f]{6}$/',
            'messageText' => 'nullable',
            'messageSize' => 'required|numeric|min:0|max:50',
            'messageColor' => 'required|regex:/^#[0-9A-Fa-f]{6}$/',
            'footerText' => 'nullable|max:256',
            'footerSize' => 'required|numeric|min:0|max:50',
            'footerColor' => 'required|regex:/^#[0-9A-Fa-f]{6}$/',
            'footerBackgroundUrl' => 'nullable|max:512',
        ];
    }
}
