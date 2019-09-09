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
        $this->belongsToMany('app\models\Product', 'product_stock'
            ,'st_id', 'pr_id');
    }
    public function materials(){
        $this->belongsToMany('app\models\Material', 'material_stock'
            ,'st_id', 'ma_id');
    }
    public function tools(){
        $this->belongsToMany('app\models\Tool', 'stock_tool'
            ,'st_id', 'to_id');
    }
}
