<?php

namespace App\Models\Accounts;

use App\Models\Common\BaseEloquentModel;


/**
 * App\Models\Accounts\Accounts
 *
 * @property integer $id
 * @property string $name
 * @property string $status
 * @property string $contact_person_email
 * @property string $contact_person_name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Accounts\Accounts whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Accounts\Accounts whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Accounts\Accounts whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Accounts\Accounts whereContactPersonEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Accounts\Accounts whereContactPersonName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Accounts\Accounts whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Accounts\Accounts whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
