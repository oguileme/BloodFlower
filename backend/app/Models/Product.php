<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Order; // ← adiciona essa linha
use App\Models\Sizes;
use App\Models\User;


class Product extends Model
{
    protected $table = 'products';    

    protected $fillable = ['name', 'price', 'description', 'categorie_id'];

    //relaçao com a tabela n:n
    public function orders(): BelongsToMany{
        return $this->belongsToMany(Order::class, 'order_product' )
                    ->withPivot('quantity')
                    ->withTimestamps();
    }

    public function sizes(): BelongsToMany{
        return $this->belongsToMany(Sizes::class, 'sizes_product')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }

    public function users(): BelongsToMany{
        return $this->belongsToMany(User::class, 'cart')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }


}
