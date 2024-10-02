<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class SupplierRequest extends FormRequest
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
            'neq' => [
                'unique:suppliers',
                'size:10',
                'regex:/^(11|22|33|88)[4-9].{7}$/',
            ],
            'name' => 'required',
            'email' => 'required|email',
            'password' => [
                'required',
                Password::min(6)->max(12)->mixedCase()->numbers()->symbols(),
                'confirmed',
            ],
            'password_confirmation' => 'required',
            'licenceRbq' => 'size:12|regex:/^[0-9]{4}-[0-9]{4}-[0-9]{2}$/i|nullable',
            'statusRbq' => 'required_with:licenceRbq',
            'typeRbq' => 'required_with:licenceRbq',
            'rbqSubcategories' => 'required_with:licenceRbq',
            'contactFirstNames.*' => 'required|max:32|regex:/^[a-zA-ZÀ-ÿ\'\-]+$/',
            'contactLastNames.*' => 'required|max:32|regex:/^[a-zA-ZÀ-ÿ\'\-]+$/',
            'contactJobs.*' => 'required|max:32',
            'contactEmails.*' => 'required|email|max:64',
            'contactTelTypes.*' => 'required',
            'contactTelNumbers.*' => 'required|size:12|regex:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/i',
            'contactTelExtensions.*' => 'max:6|regex:/^[0-9]+$/i|nullable',
        ];
    }

    public function messages(){
        return[
            'licenceRbq.regex' => __('form.rbqLicenceValidation'),
            'rbqSubcategories.required_with' => __('form.rbqCategoriesValidation'),
            'contactFirstNames.*.regex' => __('form.contactFirstNamesValidation'),
            'contactTelNumbers.*.regex' => __('form.contactsTelNumberValidation'),
            'contactTelExtensions.*.regex' => __('form.contactsTelExtensionValidation'),
        ];
    }
}
