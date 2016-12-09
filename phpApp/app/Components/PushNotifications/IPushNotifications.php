<?php
namespace App\Components\PushNotifications;
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 09.12.16
 * Time: 18:47
 */
interface IPushNotifications
{

    function send($token, $title, $body, $data);

}