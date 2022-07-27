<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WholesalesProductsBills extends Model
{
    use HasFactory;
    protected $table='wholesales_products_orders';
    public $timestamps=true;
    protected $fillable=[

        'id',
        'wholesale_product_id',
        'wholesales_bill_id',
        'products_count',
        'created_at',
        'updated_at',
    ];
}
