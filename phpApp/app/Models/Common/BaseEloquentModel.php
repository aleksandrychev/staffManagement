<?php
/**
 * Created by PhpStorm.
 * User: Ігор
 * Date: 08.10.2016
 * Time: 22:12
 */

namespace App\Models\Common;


use Illuminate\Database\Eloquent\Model;
use \Illuminate\Support\Facades\Validator;

class BaseEloquentModel extends Model
{
    protected $rules = [];

    protected $errors;

    public function validate($data)
    {
        // make a new validator object
        $v = Validator::make($data, $this->rules);

        // check for failure
        if ($v->fails())
        {
            // set errors and return false
            $this->errors = $v->errors();
            return false;
        }

        // validation pass
        return true;
    }

    public function errors()
    {
        return $this->errors;
    }
}