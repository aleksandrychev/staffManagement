<?php

namespace App\Models\Accounts;

use App\Models\Common\BaseEloquentModel;


class Accounts extends BaseEloquentModel
{
    protected $table = 'accounts';

    public $fillable = ['name','contact_person_email','contact_person_name'];

    protected $rules = array(
        'id' => 'integer',
        'contact_person_email' => 'required|email',
        'name' => 'required',
        'contact_person_name' => 'required',
    );

}
