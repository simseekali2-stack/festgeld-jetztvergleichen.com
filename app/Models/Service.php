<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title', 'slug', 'content', 'excerpt', 'icon', 'color',
        'features', 'status', 'sort_order',
        'meta_title', 'meta_description', 'og_title', 'og_description',
        'og_image', 'canonical_url', 'focus_keyword', 'robots', 'structured_data',
    ];

    protected $casts = [
        'features' => 'array',
    ];
}
