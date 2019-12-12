<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    //
    protected $table = 'tests';
    protected $fillable = ['email','name','id','title','msg'];
}
