<?php

namespace App\Http\Requests\Content;

use Illuminate\Foundation\Http\FormRequest;

class DragDropContentRequest extends FormRequest
{
    const ID = 'id';
    const OLD_PARENT_ID = 'oldParent';
    const PARENT_ID = 'parent';

    public function rules(): array
    {
        return [
            self::ID => [
                'string',
            ],
            self::OLD_PARENT_ID => [
                'string',
                'required'
            ]
        ];
    }

    public function getId(): string
    {
        return $this->route(self::ID);
    }

    public function getOldParentId(): string
    {
        return $this->get(self::OLD_PARENT_ID);
    }

    public function getParentId(): string
    {
        return $this->get(self::PARENT_ID);
    }
}
