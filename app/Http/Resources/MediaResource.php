<?php

namespace app\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/** @mixin Media */
final class MediaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'name'            => $this->name,
            'mime_type'       => $this->mime_type,
            'collection_name' => $this->collection_name,
            'url'             => $this->getUrl(),
            'disk'            => $this->disk,
            'created_at'      => $this->created_at,
        ];
    }
}
