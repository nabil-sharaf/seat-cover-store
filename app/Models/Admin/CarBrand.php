<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarBrand extends Model
{
    use HasFactory;
    protected $table = 'car_brands';
    protected $fillable = ['brand_name'];

    public function carModels()
    {
        return $this->hasMany(CarModel::class,'brand_id');
    }
}
