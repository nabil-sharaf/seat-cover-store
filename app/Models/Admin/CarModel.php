<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;

    protected $fillable = ['model_name', 'brand_id','made_year_from','made_year_to','seat_count_id'];

    // علاقة مع براند
    public function brand()
    {
        return $this->belongsTo(CarBrand::class);
    }
    // علاقة مع عدد المقاعد
    public function seatCount()
    {
        return $this->belongsTo(SeatCount::class,'seat_count_id');
    }

}
