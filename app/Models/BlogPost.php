<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $fillable = [
        'title', 'slug', 'content', 'excerpt', 'featured_image',
        'category', 'tags', 'author_name', 'status', 'featured',
        'published_at', 'reading_time',
        'meta_title', 'meta_description', 'og_title', 'og_description',
        'og_image', 'canonical_url', 'focus_keyword', 'robots', 'structured_data',
    ];

    protected $casts = [
        'tags'         => 'array',
        'featured'     => 'boolean',
        'published_at' => 'datetime',
    ];
}
