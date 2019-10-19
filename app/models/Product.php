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
        return $this->belongsTo('App\models\ProductCategory', 'category_id');
    }
    public function subProduct(){
        return $this->belongsToMany('App\models\Product'
            ,'product_product', 'pr_id', 'spr_id')->withTimestamps();
    }
    public function material(){
        return $this->belongsToMany('App\models\Material'
            ,'material_product', 'pr_id', 'ma_id')->withTimestamps();
    }
    public function size(){
        $this->belongsTo('App\models\Size', 'size_id');
    }
    public function weight(){
        $this->belongsTo('App\models\Weight', 'weight_id');
    }
    public function stocks(){
        return $this->belongsToMany('App\models\Stock')->withTimestamps();
    }
    public function packages(){
        return $this->belongsToMany(
            'app\model\Package'
            , 'package_product'
            , 'pr_id', 'pa_id'
        );
    }
}
