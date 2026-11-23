<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'description',
        'tech_stack',
        'image_path',
        'demo_url',
        'github_url',
        'order',
    ];
}
