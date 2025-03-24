<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'category_id', 'status_id', 'location_id', 'description', 'photo'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($item) {
            ItemDelete::create([
                'item_id' => $item->id,
                'user_id' => Auth::id(),
                'from_location_id' => $item->location_id,
            ]);
        });
    }
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

    public function movement()
    {
        return $this->hasMany(ItemMovement::class);
    }

    public function itemDelete()
    {
        return $this->hasMany(ItemDelete::class);
    }
}
