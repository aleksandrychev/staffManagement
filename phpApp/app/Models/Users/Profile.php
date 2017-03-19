<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 09.12.16
 * Time: 17:43
 */

namespace App\Models\Users;


use App\User;

/**
 * App\Models\Users\Profile
 *
 * @property-read \App\Models\Accounts\Accounts $account
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DeviceTokens\DeviceTokens[] $deviceTokens
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $readNotifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $unreadNotifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\DCN\RBAC\Models\Role[] $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\DCN\RBAC\Models\Permission[] $userPermissions
 * @mixin \Eloquent
 */
class Profile extends User
{
    public $fillable = ['name', 'password'];

  
}