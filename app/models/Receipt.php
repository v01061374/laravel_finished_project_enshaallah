<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $table = 'receipts';
    protected $primaryKey = 'id';
    protected $guarded =[
        'id'
    ];
    public function sells(){
        return $this->hasMany('App\models\Sell');
    }

}
