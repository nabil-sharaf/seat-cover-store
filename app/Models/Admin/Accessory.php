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
    public function discount()
    {
        return $this->hasOne(AccessoryDiscount::class)->where(function ($query) {
            $now = now();
            $query->where('start_date', '<=', $now)
                ->where('end_date', '>=', $now);
        });
    }


    public function getDiscountedPriceAttribute()
    {

        $price = $this->price;
        $discount = $this->discount;

        if ($discount) {
            if ($discount->discount_type === 'percentage') {
                return max($price - ($price * ($discount->discount_value / 100)) ,0) ;
            }
            elseif($discount->discount_type === 'fixed') {
                return max($price - $discount->discount_value, 0);
            }
        }

        return $price;
    }

}
