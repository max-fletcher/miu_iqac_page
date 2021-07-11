<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = ['event_date'];

    public function event_type(){
        return $this->belongsTo(EventType::class);
    }  
}
