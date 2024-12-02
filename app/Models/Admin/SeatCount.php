<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeatCount extends Model
{
    use HasFactory;
    protected $fillable = ['name','image'];

    public function seatPrices(){
        return $this->hasMany(SeatPrice::class);
    }

    public function seatPrice($coverId){
        return $this->seatPrices()->where('category_id',$coverId)->first()->price;
    }
    public function carModels()
    {
        return $this->hasMany(CarModel::class);
    }
}
