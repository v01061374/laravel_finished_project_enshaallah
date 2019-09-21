<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class MaterialCategory extends Model
{
    protected $table = 'material_categories';
    protected $primaryKey = 'id';
    protected $guarded =[
        'id'
    ];
    public function materials(){
        return $this->hasMany('App\models\Material');
    }
}
