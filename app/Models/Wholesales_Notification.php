<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wholesales_Notification extends Model
{
    use HasFactory;
    protected $table="wholesales_notifications";
    public $timestamps = true;
    protected $fillable = [
        'id',
        'wholesales_bill_id','confirmed','created_at','updated_at'
    ];
    public function order(){
        $this->belongsTo('App\Models\Wholesales_bills','wholesales_bill_id','id');
    }
}
