<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutContentType extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function about_contents(){
        return $this->hasMany(AboutContent::class);
    }
}