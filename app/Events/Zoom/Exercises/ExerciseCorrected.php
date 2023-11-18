<?php

namespace App\Events\Zoom\Exercises;

use App\Models\ZoomCourses\ZoomCourseSessionStudentExercise;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ExerciseCorrected
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected ZoomCourseSessionStudentExercise $studentExercise;

    public function getStudentExercise(): ZoomCourseSessionStudentExercise
    {
        return $this->studentExercise;
    }

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ZoomCourseSessionStudentExercise $studentExercise)
    {
        $this->studentExercise = $studentExercise;
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
