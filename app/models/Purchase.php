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
        return $this->belongsToMany('app\models\Material'
            , 'material_purchase'
            , 'pu_id'
            , 'ma_id');
    }
    public function products(){
        return $this->belongsToMany('app\models\Product'
            , 'material_purchase'
            , 'pu_id'
            , 'pr_id');
    }
    public function tools(){
        return $this->belongsToMany('app\models\Tool'
            , 'material_purchase'
            , 'pu_id'
            , 'to_id');
    }
    public function supplier(){
        $this->belongsTo('app\models\Supplier');
    }
}
