<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeadSource extends Model
{
    //
    protected $table = 'lead_sources';
    protected $fillable = ['code', 'description','note'];
}
