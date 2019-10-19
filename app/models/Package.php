<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'packages';
    protected $primaryKey = 'id';
    protected $guarded =[
        'id'
    ];
    public function digi_stock(){
        return $this->belongsTo('App\models\DigiStock', 'stock_id');
    }
    public function products(){
        return $this->belongsToMany(
            'app\model\Product'
            , 'package_product'
            , 'pa_id', 'pr_id'
        )->withTimestamps();
    }
}
