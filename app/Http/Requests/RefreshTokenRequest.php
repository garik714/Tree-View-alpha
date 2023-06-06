<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RefreshTokenRequest extends FormRequest
{
    const USER_ID = 'userId';
    const REFRESH_TOKEN = 'refreshToken';

    public function rules(): array
    {
        return [
            self::USER_ID => [
                'required',
            ],
            self::REFRESH_TOKEN => [
                'string',
                'required',
            ]
        ];
    }

    public function getUserId(): string
    {
        return $this->get(self::USER_ID);
    }

    public function getRefreshToken(): string
    {
        return $this->get(self::REFRESH_TOKEN);
    }
}
