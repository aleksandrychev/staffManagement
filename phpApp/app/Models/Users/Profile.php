<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 09.12.16
 * Time: 17:43
 */

namespace App\Models\Users;


use App\User;

class Profile extends User
{
    public $fillable = ['name', 'password'];

  
}