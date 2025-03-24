<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class itemDelete extends Model
{
    protected $fillable = ['item_id', 'user_id', 'from_location_id'];

    public function item()
    {
        return $this->belongsTo(Item::class)->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function fromLocation()
    {
        return $this->belongsTo(Location::class, 'from_location_id');
    }
}
