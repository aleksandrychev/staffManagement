<?php
/**
 * Created by PhpStorm.
 * User: Ігор
 * Date: 09.10.2016
 * Time: 15:14
 */

namespace App\Models\Users;


/**
 * App\Models\Users\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $api_token
 * @property int $account_id
 * @property string $status
 * @property string $role
 * @property string $phone
 * @property-read \App\Models\Accounts\Accounts $account
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DeviceTokens\DeviceTokens[] $deviceTokens
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $readNotifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $unreadNotifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\DCN\RBAC\Models\Role[] $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\DCN\RBAC\Models\Permission[] $userPermissions
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Users\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Users\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Users\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Users\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Users\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Users\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Users\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Users\User whereApiToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Users\User whereAccountId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Users\User whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Users\User whereRole($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Users\User wherePhone($value)
 * @mixin \Eloquent
 */
class User extends \App\User
{

}