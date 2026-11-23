<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'degree',
        'title',
        'hero_subtitle',
        'about_summary',
        'email',
        'phone',
        'wa_link',
        'location',
        'avatar_path',
        'github_url',
        'linkedin_url',
    ];

    /**
     * Accessor untuk summary kompatibel dengan template portofolio
     */
    public function getSummaryAttribute()
    {
        return $this->hero_subtitle ?? $this->about_summary;
    }
}
