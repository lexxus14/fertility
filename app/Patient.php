<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    //
    protected $table = 'patients';
    protected $fillable = ['FileNo','MainContactNo','MainEmail','MainContactPerson',
                            'WifeName','WifeLastName','WifeBirthDate','MarriedSince','WifeAddress','WifeEmailAddress','WifeContactNo','WifeNationalityId',
                            'IsIVF','IsHasChildren','IsMiscarriage',
                            'HusbandName','HusbandLastName','HusbandBirthDate','HusbandNationalityId','HusbandAddress','HusbandEmailAddress','HusbandContactNo',
                                'Notes','FileLink','IsPatient','createdbyid'];
}
