<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accessory extends Model
{
    use HasFactory;
    protected $table='accessories';
    protected $fillable =['name','images','description','category_id','price','quantity'];
    protected $casts=[
        'images'=>'array',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
