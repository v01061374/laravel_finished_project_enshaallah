<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'materials';
    protected $primaryKey = 'id';
    protected $guarded =[
        'id'
    ];
    public function category(){
        return $this->belongsTo('app\models\MaterialCategory', 'category_id');
    }
    public function product(){
        return $this->belongsToMany('app\models\Product'
            ,'material_product', 'ma_id', 'pr_id');
    }
}
