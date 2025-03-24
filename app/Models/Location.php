<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['branch_name', 'building_name', 'floor', 'room'];

    public function getFullLocationAttribute()
    {
        return "{$this->branch_name} - {$this->building_name} - LT {$this->floor} - {$this->room}";
    }
}
