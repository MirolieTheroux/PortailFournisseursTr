<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierUpdateAttachmentsRequest extends FormRequest
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
            'fileNames.*' => 'nullable|alpha_num|max:32',
            'fileSizes.*' => 'nullable',
            'fileTypes.*' => 'nullable|mimetypes:application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf,image/jpeg,image/png,image/bmp,image/tiff,text/plain,application/rtf,application/vnd.oasis.opendocument.text,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'addedFileDates.*' => 'nullable|date_format:Y-m-d',
            'files.*' => 'nullable',
        ];
    }
}
