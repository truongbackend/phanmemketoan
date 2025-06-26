<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Product extends Model
{
     protected $fillable = [
        'sku',
        'accounting_code',
        'product_name',
        'unit',
        'tax_rate',
        'product_user_id'
    ];
    use HasFactory;
    public function details(): HasMany
    {
        return $this->hasMany(ProductDetail::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'product_user_id');
    }

}
