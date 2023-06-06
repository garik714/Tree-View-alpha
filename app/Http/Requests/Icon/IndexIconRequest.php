<?php

namespace App\Http\Requests\Icon;

use Illuminate\Foundation\Http\FormRequest;

class IndexIconRequest extends FormRequest
{
    const PAGE = 'page';
    const PER_PAGE = 'perPage';
    const Q = 'q';

    const DEFAULT_PAGE = 1;
    const DEFAULT_PER_PAGE = 10;

    public function rules(): array
    {
        return [
            self::PAGE => [
                'integer',
                'nullable',
            ],
            self::PER_PAGE => [
                'integer',
                'nullable',
            ],
            self::Q => [
                'string',
                'nullable',
            ],
        ];
    }

    public function getQ(): string | null
    {
        return $this->get(self::Q);
    }

    public function getPage(): int| null
    {
        return $this->get(self::PAGE) ?? self::DEFAULT_PAGE;
    }

    public function getPerPage(): int | null
    {
        return $this->get(self::PER_PAGE) ?? self::DEFAULT_PER_PAGE;
    }
}
