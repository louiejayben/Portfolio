<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Portfolio extends Model
{
    protected $fillable = [
        'public_token',
        'full_name',
        'photo_path',
        'email',
        'contact_number',
        'address',
        'about_me',
        'education',
        'skills',
        'project',
        'project_link',
        'company',
        'position',
        'work_description',
        'website',
        'facebook',
        'linkedin',
        'github',
        'template',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}