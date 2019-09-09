<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';
    protected $primaryKey = 'id';
    protected $guarded =[
        'id'
    ];
    public function purchases(){
        $this->hasMany('app\models\Purchase');
    }
}
