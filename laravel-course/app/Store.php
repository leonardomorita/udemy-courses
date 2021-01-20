<?php

// Estuda: OK

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Store extends Model
{
    use HasSlug;

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

    public function orders()
    {
        return $this->belongsToMany(UserOrder::class, 'order_store', 'store_id', 'order_id');
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function notifyStoreOwners(array $storesId = [])
    {
        // Retorna todas as lojas referentes aos ids que estam dentro do array
        $stores = $this->whereIn('id', $storesId)->get();

        // Retorna somente os donos (users) da loja. E para cada dono, salva uma notificação no banco de dados
        $stores->map(function($store) {
            return $store->user;
        })->each->notify(new \App\Notifications\StoreReceiveNewOrder());
    }
}
