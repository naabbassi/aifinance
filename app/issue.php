<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class issue extends Model
{
    //
    protected $table="issues";
    public function messages(){
        return $this->hasMany('App\issue_message','issue_id');
    }
}
