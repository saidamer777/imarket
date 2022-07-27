<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table="addresses";
    protected $fillable=[
        'id',
        'region',
        'neighborhood',
        'lane',
        'building',
        'floor',
        'side',
        'details',
        'customer_id',
        'active',
        ];
    protected $hidden=[
        'created_at',
        'updated_at'
    ];

    public function customer(){
        return $this->belongsTo('App\Models\Customer','customer_id','id');
    }

    public function bills(){
        return  $this->hasMany('App\Models\Bills','address_id','id');
    }
}
