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
            'licenceRbq' => 'size:12|regex:/^[0-9]{4}-[0-9]{4}-[0-9]{2}$/i|nullable',
            'statusRbq' => 'required_with:licenceRbq',
            'typeRbq' => 'required_with:licenceRbq',
            'rbqSubcategories' => 'required_with:licenceRbq',
            'contactDetailsCivicNumber' => 'required|alpha_num|max:8',
            'contactDetailsStreetName' => 'required|regex:/^[a-zA-Z0-9@#\-_À-ÿ ]+$/|max:64',
            'contactDetailsOfficeNumber' => 'nullable|alpha_num|max:8',
            'contactDetailsCitySelect' => 'required_if:contactDetailsPovince,Québec',
            'contactDetailsInputCity' => 'required_if:contactDetailsPovince,!Quebec|max:64',
            'contactDetailsPostalCode' => 'required|regex:/^(?!.*[DFIOQU])[A-VXY][0-9][A-Z] ?[0-9][A-Z][0-9]$/|max:7',
            'contactDetailsWebsite' => 'nullable|url|max:64',
            'contactDetailsPhoneNumber' => 'required|digits:10|regex:/^\d{3}-\d{3}-\d{4}$/',
            'contactDetailsPhoneExtension' => 'nullable|numeric|max:6',
            'contactFirstNames.*' => 'required|max:32|regex:/^[a-zA-ZÀ-ÿ\'\-]+$/',
            'contactLastNames.*' => 'required|max:32|regex:/^[a-zA-ZÀ-ÿ\'\-]+$/',
            'contactJobs.*' => 'required|max:32',
            'contactEmails.*' => 'required|email|max:64',
            'contactTelTypes1.*' => 'required',
            'contactTelNumbers1.*' => 'required|regex:/^[0-9]+$/i|size:10',
            'contactTelExtensions1.*' => 'regex:/^[0-9]+$/i|max:6|nullable',
            'contactTelNumbers2.*' => 'regex:/^[0-9]+$/i|size:10|nullable',
            'contactTelExtensions2.*' => 'regex:/^[0-9]+$/i|max:6|nullable',
        ];
    }

    public function messages(){
        return[
            'licenceRbq.regex' => __('form.rbqLicenceValidation'),
            'rbqSubcategories.required_with' => __('form.rbqCategoriesValidation'),
            'contactDetailsInputCity.required_if' => __('form.inputCityValidation'),
            'contactFirstNames.*.regex' => __('form.contactFirstNamesValidation'),
            'contactTelNumbers.*.regex' => __('form.contactsTelNumberValidation'),
            'contactTelExtensions.*.regex' => __('form.contactsTelExtensionValidation'),
        ];
    }
}
