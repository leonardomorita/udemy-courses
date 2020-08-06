<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = ['name', 'description', 'phone', 'mobile_phone', 'slug', 'logo'];

    public function user()
    {
        // Quem está recebendo a chave estrangeira, usa o belongsTo
        // A tabela 'Store' está recebendo a chave estrangeira da tabela 'User'
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
