<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'summary',
        'description',
        'image',
        'technologies',
        'demo_url',
        'github_url',
        'is_featured',
        'order',
    ];

    protected $casts = [
        'technologies' => 'array',
        'is_featured' => 'boolean',
        'order' => 'integer',
    ];
}
