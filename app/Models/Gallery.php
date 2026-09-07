<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'title',
        'description',
        'images',
        'event_id',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
