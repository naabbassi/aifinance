<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class revenue extends Model
{
    //
    protected $table = "revenue";
    protected $fillable = [
        'uid', 'amount', 'type', 'title', 'description'
    ];
}
