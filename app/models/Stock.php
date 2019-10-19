<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stocks';
    protected $primaryKey = 'id';
    protected $guarded =[
        'id'
    ];
    public function products(){
        return $this->belongsToMany('App\models\Product', 'product_stock'
            ,'st_id', 'pr_id')->withTimestamps()->withPivot(['qty']);
    }
    public function materials(){
        return $this->belongsToMany('App\models\Material', 'material_stock'
            ,'st_id', 'ma_id')->withTimestamps();
    }
    public function tools(){
        return $this->belongsToMany('App\models\Tool', 'stock_tool'
            ,'st_id', 'to_id')->withTimestamps();
    }
}
