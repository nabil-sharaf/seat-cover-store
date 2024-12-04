<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    public function accessory()
    {
        return $this->belongsTo(Accessory::class);
    }

    // العلاقة مع الكاتيجوريز باستخدام parent_id
    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // العلاقة مع الكاتيجوريز باستخدام category_id
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function coverColor()
    {
        return $this->belongsTo(CoverColor::class, 'color_id');
    }

    public function seatCount()
    {
        return $this->belongsTo(SeatCount::class, 'seat_count_id');
    }

    public function brand()
    {
        return $this->belongsTo(CarBrand::class, 'brand_id');
    }

    public function model()
    {
        return $this->belongsTo(CarModel::class, 'model_id');
    }
}
