<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationProfile extends Model
{
    protected $fillable = [
        'org_name',
        'logo_path',
        'history',
        'vision',
        'mission',
        'email',
        'phone',
        'address',
        'instagram',
        'youtube',
        'linkedin',
        'github',
        'google_maps_embed',
    ];
}
