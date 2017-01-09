<?php
/**
 * Created by PhpStorm.
 * User: Ігор
 * Date: 09.10.2016
 * Time: 14:26
 */

namespace App\Models\Tasks;

use App\Helpers\SearchHelper;
use App\Models\Common\BaseSearchModel;

class TaskSearch extends BaseSearchModel
{
    public $orderBy = 'id';
    public $orderType = 'asc';

    protected $rules = array(
        'description' => 'string',
        'orderBy' => 'string',
        'orderType' => 'string',
        'implementer_id' => 'integer',
        'name' => 'string|max:75',
        'user_id' => 'integer',
        'account_id' => 'integer',
        'created_at' => 'string',
        'status' => 'in:' . Tasks::STATUS_CANCELED . ',' . Tasks::STATUS_FINISHED . ',' .Tasks::STATUS_IN_PROCESS. ',' .Tasks::STATUS_NEW
    );

    public function search()
    {
        $query = Tasks::query()->with('owner')->with('implementer');

        if (!$this->validate($this->request->all())) {
            $query->where('id', '=', 0);
            return $query;
        }
        $this->fillVariables($this->request);

        $query->orderBy($this->orderBy, $this->orderType);

        if ($this->name) {
            $query->where('name', 'like', SearchHelper::prepareLikeValue($this->name));
        }
        if ($this->description) {
            $query->where('description', 'like', SearchHelper::prepareLikeValue($this->description));
        }
        if ($this->user_id) {
            $query->where('user_id', '=', $this->user_id);
        }
        if ($this->implementer_id) {
            $query->where('implementer_id', '=', $this->implementer_id);
        }
        if ($this->created_at) {
            $query->where('created_at', '=', $this->created_at);
        }
        if ($this->status) {
            $query->where('status', 'like', $this->status);
        }
        $query->where('account_id', 'like', $this->request->user()->account_id);

        $query = $this->setOrder($query);

        return $query;
    }
}