<?php
/**
 * Created by PhpStorm.
 * User: Ігор
 * Date: 08.10.2016
 * Time: 22:12
 */

namespace App\Models\Common;


use App\Traits\ValidationTrait;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Common\BaseEloquentModel
 *
 * @mixin \Eloquent
 */
class BaseEloquentModel extends Model
{
    use ValidationTrait;
    protected $rules = [];

}