<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SupplierUpdateIdentification extends FormRequest
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
        'unique:suppliers',
        'size:10',
        'regex:/^(11|22|33|88).{8}$/',
      ],
      'name' => 'required',
      'email' => [
        'required',
        'email',
        Rule::unique('suppliers')->where(function ($query) {
          return $query->where('neq', $this->neq);
        })
      ],
    ];
  }
}
