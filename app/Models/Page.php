<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'title', 'slug', 'type', 'content', 'excerpt', 'featured_image', 'status',
        'meta_title', 'meta_description', 'og_title', 'og_description',
        'og_image', 'canonical_url', 'focus_keyword', 'robots', 'structured_data',
    ];
}
