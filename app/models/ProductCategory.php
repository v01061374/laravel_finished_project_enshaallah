<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'product_categories';
    protected $primaryKey = 'id';
    protected $guarded =[
        'id'
    ];
    public function products(){
        return $this->hasMany('app\models\Product');
    }
}
