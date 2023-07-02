<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'street',
        'city',
        'post_code',
        'order_price',
    ];


    public function menu()
    {
        return $this->belongsToMany(Menu::class, 'order_product')->withPivot('quantity');
    }
}
