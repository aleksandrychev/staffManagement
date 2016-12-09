<?php

namespace App\Listeners;

use App\Components\PushNotifications\PushNotificationsManger;
use App\Events\AddTaskEvent;
use App\Models\DeviceTokens\DeviceTokens;
use App\Models\Tasks\Tasks;
use App\Models\Users\User;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddTaskListener implements ShouldQueue
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AddTaskEvent  $event
     * @return void
     */
    public function handle(AddTaskEvent $event)
    {
        /** @var Tasks $task */
        $task = $event->task;

        /** @var User $user */
        $user = $task->implementer()->first();

        $tokens = $user->deviceTokens()->get();

        if($tokens){
            foreach ($tokens as $token){
                /** @var DeviceTokens  $token */
                $pushManager = PushNotificationsManger::getImplementation($token->os);
                $pushManager->send($token->token, 'New Task', $task->name);
            }
        }
    }
}
