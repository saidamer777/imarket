<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketPlace extends Model
{
    use HasFactory;
    protected $table='marketplaces';
    protected $fillable=[
        'region',
        'street',
        'description',
        'active',
    ];

    public function wholesaler(){
        return $this->belongsTo('App\Models\Wholesalers','wholesaler_id','id');
    }

    public function bills(){
        return  $this->hasMany('App\Models\Wholesales_bills','marketplace_id','id');
    }
}
