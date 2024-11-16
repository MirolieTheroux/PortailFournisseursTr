<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierUpdateFinanceRequest extends FormRequest
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
            'financesTps' => 'required|regex:/^\d{9}RT\d{4}$/',
            'financesTvq' => [
                'required',
                'regex:/^\d{10}$|^\d{10}TQ\d{4}$|^NR\d{8}$/'
            ],
            'financesPaymentConditions' => 'required',
            'currency' => 'required',
            'communication_mode' => 'required',
        ];
    }
}
