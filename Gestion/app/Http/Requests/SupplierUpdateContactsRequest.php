<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierUpdateContactsRequest extends FormRequest
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
            'contactFirstNames.*' => 'required|max:32|regex:/^[a-zA-ZÀ-ÿ\'\-]+$/',
            'contactLastNames.*' => 'required|max:32|regex:/^[a-zA-ZÀ-ÿ\'\-]+$/',
            'contactJobs.*' => 'required|max:32',
            'contactEmails.*' => 'required|email|max:64',
            'contactTelTypesA.*' => 'required',
            'contactTelNumbersA.*' => 'required|regex:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/',
            'contactTelExtensionsA.*' => 'regex:/^[0-9]+$/i|max:6|nullable',
            'contactTelNumbersB.*' => 'regex:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/|nullable',
            'contactTelExtensionsB.*' => 'regex:/^[0-9]+$/i|max:6|nullable',
        ];
    }

    public function messages(){
        return[
            'contactFirstNames.*.regex' => __('form.contactsFirstNamesValidationSymbols'),
            'contactTelNumbers.*.regex' => __('form.contactsTelNumberValidation'),
            'contactTelExtensions.*.regex' => __('form.contactsTelExtensionValidation'),
        ];
    }
}
