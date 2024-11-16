<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessoryDiscount extends Model
{
    use HasFactory;
    protected $fillable = ['accessory_id', 'discount_value', 'discount_type', 'start_date', 'end_date'];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function isActive()
    {
        $now = now();
        return $this->start_date <= $now && $this->end_date >= $now;
    }

    public function accessory()
    {
        return $this->belongsTo(Accessory::class);
    }
}
