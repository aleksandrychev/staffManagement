<?php

namespace App\Models\DeviceTokens;

use App\Models\Common\BaseEloquentModel;
/**
 * App\Models\Accounts\Accounts
 *
 * @property string $token
 * @property string $os
 * @property int $id
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Users\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DeviceTokens\DeviceTokens whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DeviceTokens\DeviceTokens whereToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DeviceTokens\DeviceTokens whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DeviceTokens\DeviceTokens whereOs($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DeviceTokens\DeviceTokens whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DeviceTokens\DeviceTokens whereUpdatedAt($value)
 * @mixin \Eloquent
 */

class DeviceTokens extends BaseEloquentModel
{
    protected $table = 'device_tokens';
    public $fillable = ['token', 'os'];

    protected $rules = array(
        'token' => 'required|string|unique:device_tokens|max:200',
        'os' =>    'required|in:android,ios',
    );

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\Users\User', 'id', 'user_id');
    }

}
