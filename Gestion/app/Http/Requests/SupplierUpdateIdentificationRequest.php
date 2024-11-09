<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SupplierUpdateIdentificationRequest extends FormRequest
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
      'nullable',
      'size:10',
      'regex:/^(11|22|33|88).{8}$/',
      ],
      'name' => 'required',
      'email' => [
        'required',
        'email',
      ],
    ];
  }
  public function withValidator($validator)
  {
    $validator->sometimes('neq', 'unique:suppliers', function ($input) {
      return !empty($input->neq) && $input->neq !== $this->supplier->neq;
    });

    $validator->sometimes('email', 'unique:suppliers', function ($input) {
      return !empty($input->email) && $input->email !== $this->supplier->email;
    });
  }
}
