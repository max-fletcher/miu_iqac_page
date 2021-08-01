<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicationTypeInfo extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function publications()
    {
        return $this->hasMany(Publication::class);
    }
}
