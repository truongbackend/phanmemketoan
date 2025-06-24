<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class ProductDetail extends Model
{
      protected $fillable = [
        'product_id',
        'combo_detail_code',
        'detail_name',
        'unit',
        'quantity',
    ];
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
