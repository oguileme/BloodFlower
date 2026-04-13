<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Cart extends Model
{
    //
    protected $table = 'cart';
    
    protected $fillable = ['quantity']; 

    public function products(): BelongsTo{
        return $this->belongsTo(Product::class);
    }

    public function users(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
