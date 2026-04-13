<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Product;
class Sizes extends Model
{
    //
    protected $table = 'sizes';

    protected $fillable = ['name'];

    public function products(): BelongsToMany{
        return $this->belongsToMany(Product::class)
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}
