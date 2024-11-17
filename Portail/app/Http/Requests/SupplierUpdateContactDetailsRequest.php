<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierUpdateContactDetailsRequest extends FormRequest
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
            'contactDetailsCivicNumber' => 'required|alpha_num|max:8',
            'contactDetailsOfficeNumber' => 'nullable|alpha_num|max:8',
            'contactDetailsStreetName' => 'required|regex:/^[a-zA-Z0-9\'\,\-_À-ÿ ]+$/|max:64',
            'contactDetailsCitySelect' => 'required_if:contactDetailsProvince,Québec',
            'contactDetailsInputCity' => 'required_unless:contactDetailsProvince,Québec|max:64',
            'contactDetailsPostalCode' => 'required|regex:/^[A-Z][0-9][A-Z] ?[0-9][A-Z][0-9]$/i|max:7',
            'contactDetailsWebsite' => 'nullable|regex:/^(www\.)?([a-zA-Z0-9.-]+)(\.[a-zA-Z]{2,})(\/[^\s]*)?$/|max:64',
            'phoneTypes.*' => 'required',
            'phoneNumbers.*' => 'required|regex:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/',
            'phoneNumbers' => 'required',
            'phoneExtensions.*' => 'nullable|numeric|max_digits:6',
        ];
    }

    public function messages(){
      return[
       'contactDetailsInputCity.required_unless' => __('form.inputCityValidation'),
       'phoneNumbers' => __('form.contactDetailsPhoneNumberValidation'),
      ];
    }
}
