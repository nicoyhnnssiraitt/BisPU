<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $fillable = ['driver_id', 'plate_number', 'bus_type', 'capacity', 'status'];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}