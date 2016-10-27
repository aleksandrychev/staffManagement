<?php
/**
 * Created by PhpStorm.
 * User: Ігор
 * Date: 09.10.2016
 * Time: 10:55
 */

namespace App\Models\Accounts;


use App\Helpers\SearchHelper;
use App\Models\Common\BaseSearchModel;


class AccountSearch extends BaseSearchModel
{

    protected $rules = [
        'id' => 'integer',
        'contact_person_email' => 'string',
        'name' => 'string',
        'contact_person_name' => 'string',
        'created_at' => 'string',
    ];

    public function search()
    {
        $query = Accounts::query();

        if (!$this->validate($this->request->all())) {
            $query->where('id', '=', 0);
            return $query;
        }
        $this->fillVariables($this->request);
        if ($this->name) {
            $query->where('name', 'like', SearchHelper::prepareLikeValue($this->name));
        }
        if ($this->contact_person_email) {
            $query->where('contact_person_email', 'like', SearchHelper::prepareLikeValue($this->contact_person_email));
        }
        if ($this->contact_person_name) {
            $query->where('contact_person_name', 'like', SearchHelper::prepareLikeValue($this->contact_person_name));
        }
        if ($this->id) {
            $query->where('id', '=', $this->id);
        }
        if ($this->created_at) {
            $query->where('created_at', '=', $this->created_at);
        }
        $query = $this->setOrder($query);

        return $query;
    }

}