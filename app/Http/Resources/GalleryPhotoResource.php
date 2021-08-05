<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GalleryPhotoResource extends JsonResource
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
            'gallery_name_id' => $this->gallery_name_id,
            'title' => $this->photo_title,
            'src' => '/storage/photo_gallery_images/'.$this->photo_image,
            'created_at' => $this->created_at,            
        ];       
    }
}
