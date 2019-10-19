<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table = 'purchases';
    protected $primaryKey = 'id';
    protected $guarded =[
        'id'
    ];
    public function materials(){
        return $this->belongsToMany('App\models\Material'
            , 'material_purchase'
            , 'pu_id'
            , 'ma_id')->withTimestamps();
    }
    public function products(){
        return $this->belongsToMany('App\models\Product'
            , 'product_purchase'
            , 'pu_id'
            , 'pr_id')->withPivot(['unit_price', 'qty', 'stocked'])->withTimestamps();
    }
    public function unstocked_products(){
        return $this->belongsToMany('App\models\Product'
            , 'product_purchase'
            , 'pu_id'
            , 'pr_id')->withPivot(['unit_price', 'qty', 'stocked'])->withTimestamps()->wherePivot('stocked', '==', 0);
    }
    public function tools(){
        return $this->belongsToMany('App\models\Tool'
            , 'tool_purchase'
            , 'pu_id'
            , 'to_id')->withTimestamps();
    }
    public function supplier(){
        return $this->belongsTo('App\models\Supplier');
    }
}
