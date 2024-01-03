<?php

declare(strict_types=1);

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * GetDataStudentUpdate
 */
class GetDataStudentUpdate
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $student;
    public $student_situation;

    /**
     * Create a new event instance.
     */
    public function __construct($student,$student_situation)
    {
        $this->student = $student;
        $this->student_situation = $student_situation;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
