<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemMovement extends Model
{
    protected $fillable = ['item_id', 'user_id', 'from_location_id', 'to_location_id', 'moved_at'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fromLocation()
    {
        return $this->belongsTo(Location::class, 'from_location_id');
    }

    public function toLocation()
    {
        return $this->belongsTo(Location::class, 'to_location_id');
    }
}
