<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeadAssessment extends Model
{
    //
    protected $table = 'lead_assessments';
    protected $fillable = ['date','staffid','patientid','reasonid','createdbyid','assessmentrate','FileLink','iscurrent','note'];
}
