<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    const NAME = 'name';
    const SURNAME = 'surname';
    const USERNAME = 'username';
    const PASSWORD = 'password';

    public function rules()
    {
        return [
            self::NAME => [
                'required',
            ],

            self::SURNAME => [
                'required',
            ],

            self::USERNAME => [
                'required',
                'unique:users',
            ],

            self::PASSWORD => [
                'required',
                'string',
                'confirmed',
            ],
        ];
    }

    public function getName(): string
    {
        return $this->get(self::NAME);
    }

    public function getSurname(): string
    {
        return $this->get(self::SURNAME);
    }

    public function getUsername(): string
    {
        return $this->get(self::USERNAME);
    }

    public function getPassword(): string
    {
        return $this->get(self::PASSWORD);
    }
}
