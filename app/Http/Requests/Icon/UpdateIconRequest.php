<?php

namespace App\Http\Requests\Icon;

class UpdateIconRequest extends IconRequest
{
    const ID = 'id';

    public function rules(): array
    {
        return  array_merge(parent::rules(), [
            self::ID => [
                'string',
            ],
        ]);
    }

    public function getId(): string
    {
        return $this->route(self::ID);
    }
}
