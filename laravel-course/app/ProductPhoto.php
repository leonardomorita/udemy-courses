<?php

// Estuda: OK

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
    protected $fillable = ['image'];

    public function product()
    {
        $this->belongsTo(Product::class);
    }
}
