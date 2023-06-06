<?php

namespace App\Http\Requests\Icon;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class IconRequest extends FormRequest
{
    const SOURCE = 'source';
    const NAME = 'name';

    public function rules(): array
    {
        return [
            self::SOURCE => [
                'required',
                'mimes:svg,png',
            ],
            self::NAME => [
                'required',
                'string',
            ],
        ];
    }

    public function getSource(): string
    {
        $path = $this->source->store('public/images');

        return Storage::url($path);
    }

    public function getName(): string
    {
        return $this->get(self::NAME);
    }
}
