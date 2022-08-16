<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    //
    protected $table = 'treatments';
    protected $fillable = ['code', 'description','note'];
}
