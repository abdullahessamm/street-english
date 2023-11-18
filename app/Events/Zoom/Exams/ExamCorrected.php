<?php

namespace App\Events\Zoom\Exams;

use App\Models\ZoomCourses\ZoomCourseLevelStudentExam;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ExamCorrected
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected ZoomCourseLevelStudentExam $studentExam;

    public function getStudentExam(): ZoomCourseLevelStudentExam
    {
        return $this->studentExam;
    }

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ZoomCourseLevelStudentExam $studentExam)
    {
        $this->studentExam = $studentExam;
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
