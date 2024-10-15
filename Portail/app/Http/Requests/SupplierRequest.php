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
                Password::min(7)->max(12)->mixedCase()->numbers()->symbols(),
                'confirmed',
            ],
            'password_confirmation' => 'required',
            'licenceRbq' => 'regex:/^[0-9]+$/i|size:10|nullable',
            'statusRbq' => 'required_with:licenceRbq',
            'typeRbq' => 'required_with:licenceRbq',
            'rbqSubcategories' => 'required_with:licenceRbq',
            'contactDetailsCivicNumber' => 'required|alpha_num|max:8',
            'contactDetailsOfficeNumber' => 'nullable|alpha_num|max:8',
            'contactDetailsStreetName' => 'required|regex:/^[a-zA-Z0-9\'\,\-_À-ÿ ]+$/|max:64',
            'contactDetailsCitySelect' => 'required_if:contactDetailsProvince,Québec',
            'contactDetailsInputCity' => 'required_unless:contactDetailsProvince,Québec|max:64',
            'contactDetailsPostalCode' => 'required|regex:/^[A-Z][0-9][A-Z] ?[0-9][A-Z][0-9]$/i|max:6',
            'contactDetailsWebsite' => 'nullable|url|max:64',
            'phoneTypes.*' => 'required',
            'phoneNumbers.*' => 'required|regex:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/',
            'phoneNumbers' => 'required',
            'phoneExtensions.*' => 'nullable|numeric|max_digits:6',
            'phoneExtensions' => 'nullable|array',
            'contactFirstNames.*' => 'required|max:32|regex:/^[a-zA-ZÀ-ÿ\'\-]+$/',
            'contactLastNames.*' => 'required|max:32|regex:/^[a-zA-ZÀ-ÿ\'\-]+$/',
            'contactJobs.*' => 'required|max:32',
            'contactEmails.*' => 'required|email|max:64',
            'contactTelTypesA.*' => 'required',
            'contactTelNumbersA.*' => 'required|regex:/^[0-9]+$/i|size:10',
            'contactTelExtensionsA.*' => 'regex:/^[0-9]+$/i|max:6|nullable',
            'contactTelNumbersB.*' => 'regex:/^[0-9]+$/i|size:10|nullable',
            'contactTelExtensionsB.*' => 'regex:/^[0-9]+$/i|max:6|nullable',
        ];
    }

    public function messages(){
        return[
            'licenceRbq.regex' => __('form.rbqLicenceValidation'),
            'rbqSubcategories.required_with' => __('form.rbqCategoriesValidation'),
            'contactDetailsInputCity.required_unless' => __('form.inputCityValidation'),
            'phoneNumbers' => __('form.contactDetailsPhoneNumberValidation'),
            'contactFirstNames.*.regex' => __('form.contactsFirstNamesValidationSymbols'),
            'contactTelNumbers.*.regex' => __('form.contactsTelNumberValidation'),
            'contactTelExtensions.*.regex' => __('form.contactsTelExtensionValidation'),
        ];
    }
}
