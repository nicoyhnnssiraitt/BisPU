<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = ['driver_name', 'phone', 'status'];

    public function buses()
    {
        return $this->hasMany(Bus::class);
    }
}