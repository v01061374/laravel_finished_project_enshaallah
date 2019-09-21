<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    protected $table = 'tools';
    protected $primaryKey = 'id';
    protected $guarded =[
        'id'
    ];
    public function stocks(){
        return $this->belongsToMany('App\models\Stock');
    }
}
