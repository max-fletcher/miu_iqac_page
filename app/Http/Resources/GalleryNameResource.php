<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GalleryNameResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'gallery_name' => $this->gallery_name,
            'gallery_cover_photo' => $this->gallery_cover_photo,
            'created_at' => $this->created_at,
            'gallery_photos' => GalleryPhotoResource::collection($this->gallery_photos)
        ];   

    }
}
