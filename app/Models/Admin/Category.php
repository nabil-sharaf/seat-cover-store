<?php

namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    use HasFactory;


    protected $fillable = ['name','description','parent_id','image'];

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('children');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function seatPrices()
    {
        return $this->hasMany(SeatPrice::class);
    }

    public function bagOption()
    {
        return $this->hasOne(BagOption::Class);
    }


}
