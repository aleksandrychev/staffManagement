<?php

namespace App\Models\StaffLocations;

use App\Models\Common\BaseEloquentModel;

/**
 * App\Models\StaffLocations\StaffLocations
 *
 * @property int $id
 * @property int $task_id
 * @property int $user_id
 * @property float $lat
 * @property float $lon
 * @property int $speed
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StaffLocations\StaffLocations whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StaffLocations\StaffLocations whereTaskId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StaffLocations\StaffLocations whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StaffLocations\StaffLocations whereLat($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StaffLocations\StaffLocations whereLon($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StaffLocations\StaffLocations whereSpeed($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StaffLocations\StaffLocations whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StaffLocations\StaffLocations whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class StaffLocations extends BaseEloquentModel
{
    protected $table = 'staff_locations';
    public $fillable = ['lat', 'task_id', 'user_id', 'lon', 'speed'];

    protected $rules = array(
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
