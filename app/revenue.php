<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class revenue extends Model
{
    protected $keyType = 'string';
    protected $table = "revenue";
    public function items(){
        return $this->hasMany('App\revenue_items','rid');
    }
}
