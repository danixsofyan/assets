<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['name', 'category_id', 'status_id', 'location_id', 'description', 'photo'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function movements()
    {
        return $this->hasMany(ItemMovement::class);
    }
}
