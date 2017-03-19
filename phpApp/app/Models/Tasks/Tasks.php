<?php

namespace App\Models\Tasks;

use App\Models\Common\BaseEloquentModel;


/**
 * App\Models\Tasks\Tasks
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $implementer_id
 * @property integer $user_id
 * @property integer $account_id
 * @property string $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tasks\Tasks whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tasks\Tasks whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tasks\Tasks whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tasks\Tasks whereImplementerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tasks\Tasks whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tasks\Tasks whereAccountId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tasks\Tasks whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tasks\Tasks whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tasks\Tasks whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Accounts\Accounts $account
 * @property-read \App\Models\Users\User $owner
 * @property-read \App\Models\Users\User $implementer
 */
class Tasks extends BaseEloquentModel
{
    const STATUS_NEW = 'new';
    const STATUS_IN_PROCESS = 'in_process';
    const STATUS_FINISHED = 'finished';
    const STATUS_CANCELED = 'canceled';

    public $statusList = [
        self::STATUS_NEW,
        self::STATUS_IN_PROCESS,
        self::STATUS_FINISHED,
        self::STATUS_CANCELED
    ];

    protected $table = 'tasks';

    public $fillable = ['name', 'description', 'implementer_id', 'user_id', 'status', 'account_id'];

    protected $rules = array(
        'description' => 'string|max:450',
        'implementer_id' => 'required|integer|exists:users,id',
        'name' => 'required|string|max:75',
        'user_id' => 'required|integer|exists:users,id',
        'account_id' => 'required|integer|exists:accounts,id',
        'status' => 'in:' . self::STATUS_CANCELED . ',' . self::STATUS_FINISHED . ',' . self::STATUS_IN_PROCESS . ',' . self::STATUS_NEW
    );

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function account()
    {
        return $this->hasOne('App\Models\Accounts\Accounts', 'id', 'account_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function owner()
    {
        return $this->hasOne('App\Models\Users\User', 'id', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function implementer()
    {
        return $this->hasOne('App\Models\Users\User', 'id', 'implementer_id');
    }
}
