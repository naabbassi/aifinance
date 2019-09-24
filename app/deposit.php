<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class deposit extends Model
{
    //
    protected $table = "deposit";
    protected $fillable = [
        'uid', 'amount', 'title', 'description'
    ];
}
