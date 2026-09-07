<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspiration extends Model
{
    protected $fillable = [
        'tracking_code',
        'sender_name',
        'email',
        'category',
        'message',
        'status',
        'admin_response',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];
}
