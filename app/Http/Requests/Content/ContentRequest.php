<?php

namespace App\Http\Requests\Content;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class ContentRequest extends FormRequest
{
    const PARENT_ID = 'parent';
    const ICON_ID = 'iconId';
    const DROPPABLE = 'droppable';
    const IS_ROOT = 'isRoot';
    const HAS_CHILD = 'hasChild';
    const NAME = 'text';
    const VALUE = 'value';

    public function rules(): array
    {
        return [
            self::PARENT_ID => [
                'string',
                'nullable',
            ],
            self::ICON_ID => [
                'required',
                'string',
            ],
            self::DROPPABLE => [
                'required',
                'boolean',
            ],
            self::IS_ROOT => [
                'required',
                'boolean',
            ],
            self::HAS_CHILD => [
                'boolean',
            ],
            self::NAME => [
                'required',
                'string',
            ],
            self::VALUE => [
                'nullable',
            ],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            self::DROPPABLE => $this->toBoolean($this->droppable),
        ]);
        $this->merge([
            self::HAS_CHILD => $this->toBoolean($this->hasChild),
        ]);
        $this->merge([
            self::IS_ROOT => $this->toBoolean($this->isRoot),
        ]);
    }

    private function toBoolean($booleable)
    {
        return filter_var($booleable, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
    }

    public function getParentId(): string|null
    {
        return $this->get(self::PARENT_ID);
    }

    public function getIconId(): string
    {
        return $this->get(self::ICON_ID);
    }

    public function getDroppable(): bool
    {
        return $this->get(self::DROPPABLE) ?? false;
    }

    public function getIsRoot(): bool
    {
        return $this->get(self::IS_ROOT) ?? false;
    }

    public function getHasChild(): bool
    {
        return $this->get(self::HAS_CHILD) ?? false;
    }

    public function getName(): string
    {
        return $this->get(self::NAME);
    }

    public function getValue(): ?string
    {
        if (gettype($this->value) === 'object') {
            $path = $this->value->store('public/images');

            return env('APP_URL') . Storage::url($path);
        }

        return $this->get(self::VALUE);
    }
}
