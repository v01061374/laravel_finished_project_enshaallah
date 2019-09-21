<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table = 'sizes';
    protected $primaryKey = 'id';
    protected $guarded =[
        'id'
    ];
    public function products(){
        $this->hasMany('App\models\Product');
    }
}
