<?php
/**
 * Created by PhpStorm.
 * User: Ігор
 * Date: 09.10.2016
 * Time: 12:43
 */

namespace App\Models\Common;

use App\Traits\FilterTrait;
use App\Traits\ValidationTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BaseSearchModel
{
    use FilterTrait, ValidationTrait;
    protected $request;
    protected $rules = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    protected function setOrder(Builder $query)
    {
        if ($this->request->has('order')) {
            $orderStatements = explode(',', $this->request->get('order'));
            foreach ($orderStatements as $statement) {
                $statement = explode(':', $statement);
                if(!isset($this->rules[$statement[0]]) || !in_array($statement[1], ['asc','desc'])){
                    continue;
                }
                if ($statement[1] == 'asc') {
                    $query->orderBy($statement[0], 'asc');
                } elseif ($statement[1] == 'desc') {
                    $query->orderBy($statement[0], 'desc');
                }
            }
        }

        return $query;
    }

}