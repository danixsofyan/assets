<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    public function item()
    {
        return $this->hasMany(Item::class);
    }
    public function itemDelete()
    {
        return $this->hasMany(itemDelete::class);
    }
}
