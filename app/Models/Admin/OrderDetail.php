<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    public function accessory(){
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
}
