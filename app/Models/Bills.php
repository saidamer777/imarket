<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bills extends Model
{
    use HasFactory;

    public $table = 'bills';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'customer_id',
        'bill_id',
        'address_id',
        'products_count',
        'delivery_cost',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'customer_id',
        'address_id',

        'updated_at','pivot'];

    public function scopeSelection($query){
        return $query->select('id','customer_id','products_count');
    }

    public function customer(){
        return $this->belongsTo('App\Models\Customer','customer_id','id');
    }
    public function productsOrder(){
        return $this->belongsToMany('App\Models\Products','products_bills','bill_id','product_id')->withPivot(['products_count']);
    }


    public function notification(){
        $this->hasOne('App\Models\Notification','bill_id','id');
    }
    public function address(){
        return $this->belongsTo('App\Models\Address','address_id','id');
    }
}
