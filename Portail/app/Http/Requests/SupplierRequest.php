<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            // 'neq' => 'unique:suppliers|size:10',
            // 'name' => 'required',
            // 'email' => 'required|email',
            // 'password' => 'required|confirmed',
            // 'password_confirmation' => 'required',
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
        ];
    }

    public function messages(){
        return[
            'licenceRbq.regex' => __('form.rbqLicenceValidation'),
            'rbqSubcategories.required_with' => __('form.rbqCategoriesValidation'),
            'contactDetailsInputCity.required_if' => __('form.inputCityValidation'),
        ];
    }
}
