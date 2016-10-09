<?php
/**
 * Created by PhpStorm.
 * User: Ігор
 * Date: 09.10.2016
 * Time: 11:10
 */

namespace App\Traits;


use Illuminate\Http\Request;

trait FilterTrait
{

    protected function fillVariables(Request $request)
    {

        $keys = array_keys($this->rules);
        $variables = $request->only($keys);

        foreach ($variables as $key => $value) {
                @$this->$key = $value;
        }

    }

}