<?php

namespace App\Http\Requests;

use Afaqy\Core\Enums\AllowedFileExtensionsEnum;
use App\FakerUploadedInstanceGenerator\Enums\AllowedMimesForImports;
use Illuminate\Foundation\Http\FormRequest;

class ImportsUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'file' => [
                'required',
                'file',
                'max:1000', // in kilobytes.
                'mimes:xls,xlsx,txt',
            ]
        ];
    }
}
