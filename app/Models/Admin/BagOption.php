<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BagOption extends Model
{
    use HasFactory;
    protected $fillable = [ 'category_id','bag_price'];

    public function seatCover()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
