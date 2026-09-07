<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    protected $fillable = [
        'name',
        'position',
        'photo',
        'order_priority',
        'parent_id',
    ];

    public function parent()
    {
        return $this->belongsTo(Officer::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Officer::class, 'parent_id')->orderBy('order_priority', 'asc');
    }
}
