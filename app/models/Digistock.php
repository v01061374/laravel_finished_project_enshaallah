<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Digistock extends Model
{
    protected $table = 'digistocks';
    protected $primaryKey = 'id';
    protected $guarded =[
        'id'
    ];
    public function packages(){
        return $this->hasMany('App\models\Package');
    }
}
