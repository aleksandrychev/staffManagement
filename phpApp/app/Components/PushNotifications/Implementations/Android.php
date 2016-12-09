<?php
namespace App\Components\PushNotifications\Implementations;

use App\Components\PushNotifications\IPushNotifications;
use sngrl\PhpFirebaseCloudMessaging\Client;
use sngrl\PhpFirebaseCloudMessaging\Message;
use sngrl\PhpFirebaseCloudMessaging\Notification;
use sngrl\PhpFirebaseCloudMessaging\Recipient\Device;


/**
 * Created by PhpStorm.
 * User: igor
 * Date: 09.12.16
 * Time: 18:48
 */
class Android implements IPushNotifications
{
    function send($token, $title, $body, $data= [])
    {
        $server_key =  config('params.FirebaseToken');
        $client = new Client();
        $client->setApiKey($server_key);
        $client->injectGuzzleHttpClient(new \GuzzleHttp\Client());

        $message = new Message();
        $message->setPriority('high');
        $message->addRecipient(new Device($token));
        $notification = new Notification($title, $body);
        $notification->setSound('default');
        $message
            ->setNotification($notification)
            ->setData($data)
        ;

       $client->send($message);
    }

}