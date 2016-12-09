<?php

namespace App\Events;

use App\Models\Tasks\Tasks;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;


class AddTaskEvent
{
    use InteractsWithSockets, SerializesModels;

    public $task;

    public function __construct(Tasks $task)
    {
       $this->task = $task;
    }

}
