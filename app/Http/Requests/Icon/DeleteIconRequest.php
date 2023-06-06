<?php

namespace App\Http\Requests\Icon;

use Illuminate\Foundation\Http\FormRequest;

class DeleteIconRequest extends FormRequest
{
    const ID = 'id';

    public function rules(): array
    {
        return [
            self::ID => [
                'string',
            ],
        ];
    }

    public function getId(): string
    {
        return $this->route(self::ID);
    }
}
