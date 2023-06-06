<?php

namespace App\Http\Requests\Content;

use Illuminate\Foundation\Http\FormRequest;

class ShowContentRequest extends FormRequest
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
