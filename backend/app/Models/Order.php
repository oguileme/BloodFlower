<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Product; // ← adiciona essa linha


class Order extends Model
{
    //
    protected $table = 'orders';

    protected $fillable = ['user_id' , 'payment_status', 'order_status', 'payment_type', 'outstanding_portion', 'installment_paid', 'total'];

    public function product(): BelongsToMany{
        return $this->belongsToMany(Product::class)
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}
