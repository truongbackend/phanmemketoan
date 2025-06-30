<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    use HasFactory;
protected $fillable = [
    'customer_name', 'email', 'phone', 'discould', 'address', 'total_amount','package_id','order_user_id','stauts','companyTax','companyName','note'
];

public function package()
{
    return $this->belongsTo(Package::class , 'package_id');
}

public function user()
{
    return $this->belongsTo(User::class, 'order_user_id');
}
}
