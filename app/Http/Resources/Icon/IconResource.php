<?php

namespace App\Http\Resources\Icon;

use Illuminate\Http\Resources\Json\JsonResource;

class IconResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'source' => $this->resource->source,
            'name' => $this->resource->name,
            'userId' => $this->resource->user_id,
        ];
    }
}
