<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class issue extends Model
{
    protected $keyType = 'string';
    protected $table="issues";
    public function messages(){
        return $this->hasMany('App\issue_message','issue_id');
    }

    public function isAsked(){
        return $this->messages()->orderBy('created_at','desc')->first()->type == 's';
    }
}
