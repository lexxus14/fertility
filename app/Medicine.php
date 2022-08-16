<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    //
    protected $table = 'medicines';
    protected $fillable = ['code', 'description','price','note','prod_type'];
            
}
