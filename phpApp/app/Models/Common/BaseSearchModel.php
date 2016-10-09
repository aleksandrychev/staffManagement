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
                if ($statement[1] == 'asc') {
                    $query->orderBy('id', 'asc');
                } elseif ($statement[1] == 'desc') {
                    $query->orderBy('id', 'desc');
                }
            }
        }

        return $query;
    }

}