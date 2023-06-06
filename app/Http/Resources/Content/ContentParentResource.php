<?php

namespace App\Http\Resources\Content;

use Illuminate\Http\Resources\Json\JsonResource;

class ContentParentResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'parent' => $this->resource->parent_id,
            'icon' =>  $this->resource->icon,
            'droppable' => (bool) $this->resource->droppable,
            'isRoot' => (bool) $this->resource->is_root,
            'hasChild' => (bool) $this->resource->has_child,
            'text' => $this->resource->name,
            'value' => $this->resource->value,
            'sequence' => $this->resource->value
        ];
    }
}
