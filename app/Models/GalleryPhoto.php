<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryPhoto extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function gallery_name(){
        return $this->belongsTo(GalleryName::class);
    }  
}
