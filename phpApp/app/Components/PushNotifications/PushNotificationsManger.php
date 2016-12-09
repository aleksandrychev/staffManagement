<?php
namespace App\Components\PushNotifications;

use App\Components\PushNotifications\Implementations\Android;

/**
 * Created by PhpStorm.
 * User: igor
 * Date: 09.12.16
 * Time: 18:48
 */
class PushNotificationsManger
{
    /**
     * @param $os
     * @return IPushNotifications
     */
    public static function getImplementation($os)
    {
        switch ($os) {
            case 'android':
                return new Android();
                break;
        }
    }
}