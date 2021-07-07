<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutContent extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function about_content_type(){
        return $this->belongsTo(AboutContentType::class);
    }
}
