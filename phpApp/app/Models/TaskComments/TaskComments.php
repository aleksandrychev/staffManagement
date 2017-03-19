<?php

namespace App\Models\TaskComments;

use App\Models\Common\BaseEloquentModel;


/**
 * App\Models\TaskComments\TaskComments
 *
 * @property int $id
 * @property string $comment
 * @property int $task_id
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Users\User $user
 * @property-read \App\Models\Tasks\Tasks $task
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TaskComments\TaskComments whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TaskComments\TaskComments whereComment($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TaskComments\TaskComments whereTaskId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TaskComments\TaskComments whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TaskComments\TaskComments whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TaskComments\TaskComments whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
