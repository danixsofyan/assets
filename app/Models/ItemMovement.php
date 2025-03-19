<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemMovement extends Model
{
    protected $fillable = ['item_id', 'from_location_id', 'to_location_id', 'moved_at'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
