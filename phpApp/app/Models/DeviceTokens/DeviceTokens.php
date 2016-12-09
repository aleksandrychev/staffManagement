<?php

namespace App\Models\DeviceTokens;

use App\Models\Common\BaseEloquentModel;
/**
 * App\Models\Accounts\Accounts
 *
 * @property string $token
 * @property string $os
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
