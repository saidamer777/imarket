<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wholesales_bills extends Model
{
    use HasFactory;
    protected $table='wholesales_bills';
    protected $fillable=[
        'id',
        'wholesaler_id',
        'wholesales_bill_id',
        'marketplace_id',
        'delivery_cost',
        'products_count',
        'created_at',
        'updated_at'
        ];

    protected $hidden=[
        'updated_at',
        'marketplace_id',
        'pivot'
    ];
    public function scopeSelection($query){
        return $query->select('id','wholesaler_id','products_count');
    }

    public function wholesaler(){
        return $this->belongsTo('App\Models\Wholesalers','wholesaler_id','id');
    }
    public function wholesalesProductOrder(){
        return $this->belongsToMany('App\Models\Wholesales','wholesales_products_orders','wholesales_bill_id','wholesale_product_id')->withPivot(['products_count']);
    }
    public function notification(){
        $this->hasOne('App\Models\Wholesales_Notification','bill_id','id');
    }
    public function marketplace(){
        return $this->belongsTo('App\Models\MarketPlace','marketplace_id','id');
    }
}
