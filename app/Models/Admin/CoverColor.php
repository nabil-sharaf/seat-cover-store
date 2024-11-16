<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoverColor extends Model
{
    use HasFactory;
protected $table = 'cover_colors';
    protected $fillable = [
        'name',
        'category_id',
        'tatriz_color',
        'image',
        'status',
        'description'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}


