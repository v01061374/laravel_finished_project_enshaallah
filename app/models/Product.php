<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $guarded =[
        'id'
    ];
    public function category(){
        $this->belongsTo('app\models\Category', 'category_id');
    }
    public function subProduct(){
        return $this->belongsToMany('app\models\Product'
            ,'product_product', 'pr_id', 'spr_id');
    }
    public function material(){
        return $this->belongsToMany('app\models\Material'
            ,'material_product', 'pr_id', 'ma_id');
    }
    public function size(){
        $this->belongsTo('app\models\Size', 'size_id');
    }
    public function weight(){
        $this->belongsTo('app\models\Weight', 'weight_id');
    }
    public function stocks(){
        return $this->belongsToMany('app\models\Stock');
    }
    public function packages(){
        return $this->belongsToMany(
            'app\model\Package'
            , 'package_product'
            , 'pr_id', 'pa_id'
        );
    }
}
