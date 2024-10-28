<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteImage extends Model
{
    use HasFactory;
    protected $casts = [
        'sponsor_images' => 'array',
    ];
    protected $table = 'site_images';
    protected $fillable = ['logo','sponsor_images','about_us_image','footer_image'];

}
