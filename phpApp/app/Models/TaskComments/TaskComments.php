<?php

namespace App\Models\TaskComments;

use App\Models\Common\BaseEloquentModel;


class TaskComments extends BaseEloquentModel
{
    protected $table = 'task_comments';
    public $fillable = ['comment', 'task_id', 'user_id'];

    protected $rules = array(
        'comment' => 'required|string|max:450',
        'task_id' => 'required|integer|exists:tasks,id',
        'user_id' => 'required|integer|exists:users,id'
    );

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\Users\User', 'id', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function task()
    {
        return $this->hasOne('App\Models\Tasks\Tasks', 'id', 'task_id');
    }

}
