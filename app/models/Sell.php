<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    protected $table = 'sells';
    protected $primaryKey = 'id';
    protected $guarded =[
        'id'
    ];
    public function product(){
        return $this->belongsTo('App\models\Product', 'prod_id');
    }
    public function receipt(){
        return $this->belongsTo('App\models\Receipt');
    }
}
