<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    protected $table = 'weights';
    protected $primaryKey = 'id';
    protected $guarded =[
        'id'
    ];
    public function products(){
        $this->hasMany('App\models\Product');
    }
}
