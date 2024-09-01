<?php

namespace App\Events\Zoom\Courses;

use App\Models\ZoomCourses\ZoomCourse;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CourseStudentsUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected ZoomCourse $course;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ZoomCourse $course)
    {
        $this->course = $course;
    }

    public function getCourse(): ZoomCourse
    {
        return $this->course;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
