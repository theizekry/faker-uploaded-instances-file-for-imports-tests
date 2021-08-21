<?php

namespace App\FakerUploadedInstanceGenerator\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UsersImport implements ToModel, WithValidation, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {
        return new User([
            'name'     => $row['name'],
            'email'    => $row['email'],
            'password' => Hash::make($row['password']),
        ]);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            '*.name' => [
                'required',
                'string',
                'min:4',
            ],
            '*.email' => [
                'required',
                'email',
                'unique:users,email',
            ],
            '*.password' => [
                'required',
                'min:8',
            ],
        ];
    }
}