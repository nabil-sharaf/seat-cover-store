<?php

namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

  protected $fillable = ['name','path','imageable_type','imageable_id'];

    public function imageable()
    {
        return $this->morphTo();
    }
}

