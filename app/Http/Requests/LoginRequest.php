<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    const USERNAME = 'username';
    const PASSWORD = 'password';

    public function rules()
    {
        return [
            self::USERNAME => [
                'required',
                'email',
            ],
            self::PASSWORD => [
                'required',
            ],
        ];
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
