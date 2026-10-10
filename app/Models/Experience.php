<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'role',
        'company',
        'type',
        'start_date',
        'end_date',
        'description',
        'skills_used',
        'order',
    ];
}
