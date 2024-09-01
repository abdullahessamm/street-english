<?php

namespace App\Events\Zoom\Students;

use App\Models\ZoomCourses\ZoomCourse;
use App\Models\ZoomCourses\ZoomCourseUser;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StudentEnrolledToCourse
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $students;
    public ZoomCourse $course;

    /**
     * create new event instance
     *
     * @param ZoomCourseUser[] $students
     * @param ZoomCourse $course
     */
    public function __construct(array $students, ZoomCourse $course)
    {
        $this->students = $students;
        $this->course = $course;
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
