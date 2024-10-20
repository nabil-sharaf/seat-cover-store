<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeatPrice extends Model
{
    use HasFactory;
    protected $fillable = ['category_id','seat_count_id','price'];

    public function seatCount()
    {
        return $this->belongsTo(SeatCount::class,'seat_count_id');
    }
    public function seatCover()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
