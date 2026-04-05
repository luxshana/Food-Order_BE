<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function getImageAttribute($value)
    {
        if ($value && !filter_var($value, FILTER_VALIDATE_URL)) {
            return asset($value);
        }
        return $value;
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
