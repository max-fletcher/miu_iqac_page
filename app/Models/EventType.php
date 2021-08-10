<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class EventType extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function events(){
        return $this->hasMany(Event::class);
    }

    public function passed_events(){
        return $this->events()->where('event_date', '<', Carbon::now());
    }

    public function upcoming_events(){
        return $this->events()->where('event_date', '>', Carbon::now());
    }
    
}
