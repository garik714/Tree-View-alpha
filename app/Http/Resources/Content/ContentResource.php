<?php

namespace App\Http\Resources\Content;

use App\Http\Resources\Icon\IconResource;
use App\Http\Resources\Icon\RootIconResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ContentResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'parent' => $this->resource->parent_id ?? null,
            'icon' => new IconResource($this->resource->icon),
            'droppable' => (bool) $this->resource->droppable,
            'isRoot' => (bool) $this->resource->is_root,
            'hasChild' => (bool) $this->resource->has_child,
            'text' => $this->resource->name,
            'value' => $this->resource->value,
            'parentObject' => $this->getParentObject(),
            'sequence' => $this->resource->sequence,
            'children' => ContentResource::collection($this->resource->children) ?? null
        ];
    }

    private function getParentObject(): ContentParentResource|null
    {
        $parent = $this->resource->parent;

        if (is_null($parent)) {
            return null;
        }

        return new ContentParentResource($parent);
    }
}
