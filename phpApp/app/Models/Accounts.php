<?php

namespace App\Models;

use App\Models\Common\BaseEloquentModel;


class Accounts extends BaseEloquentModel
{
    protected $table = 'accounts';

    public $fillable = ['name','contact_person_email','contact_person_name'];

    protected $rules = array(
        'contact_person_email' => 'required|email',
        'name' => 'required',
        'contact_person_name' => 'required',
    );

}
