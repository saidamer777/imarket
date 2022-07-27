<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBills extends Model
{
    use HasFactory;
    protected $table='products_bills';
    public $timestamps=true;
    protected $fillable=[

        'id',
        'product_id',
        'bill_id',
        'products_count',
        'created_at',
        'updated_at',
    ];
}
