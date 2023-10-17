<?php

namespace App\Http\Requests\Api\AdminDashboard\Courses\Zoom\Level;

use App\Models\ZoomCourses\ZoomCourse;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth('sanctum')->user()->can('update', ZoomCourse::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "title"                                 => ["string", "min:1", "max:255"],
            "description"                           => ["string", "min:1", "max:65000"],

            /*** Sessions ***/
            // Create sessions
            "sessions.create"                       => ["array"],
            "sessions.create.*.title"               => ["required", "string", "min:1", "max:255"],
            "sessions.create.*.description"         => ["nullable", "string", "min:1", "max:65000"],
            // Update sessions
            "sessions.update"                       => ["array"],
            "sessions.update.*.id"                  => ["required", "integer", "exists:zoom_course_sessions,id"],
            "sessions.update.*.title"               => ["string", "min:1", "max:255"],
            "sessions.update.*.description"         => ["nullable", "string", "min:1", "max:65000"],
            // Delete sessions
            "sessions.delete"                       => ["array"],
            "sessions.delete.*"                     => ["integer", "exists:zoom_course_sessions,id"],

            /*** Groups ***/
            // Create groups
            "groups.create"                         => ["array"],
            "groups.create.*.name"                  => ["required", "string", "min:1", "max:255"],
            "groups.create.*.instructor_id"         => ["required", "integer", "exists:coaches,id"],
            // update groups
            "groups.update"                         => ["array"],
            "groups.update.*.id"                    => ["required", "integer", "exists:zoom_course_level_groups,id"],
            "groups.update.*.name"                  => ["string", "min:1", "max:255"],
            // Delete groups
            "groups.delete"                       => ["array"],
            "groups.delete.*"                     => ["integer", "exists:zoom_course_level_groups,id"],

            /*** Privates ***/
            // Create privates
            "privates.create"                       => ["array"],
            "privates.create.*.instructor_id"       => ["required", "integer", "exists:coaches,id"],
            "privates.create.*.live_course_user_id" => ["required", "integer", "exists:live_course_users,id"],
            // delete privates
            "privates.delete"                       => ["array"],
            "privates.delete.*"                     => ["integer", "exists:zoom_course_level_privates,id"],

            /*** Exam ***/
            "exam.id"                               => ["integer", "exists:exams,id"],
            "exam.start_at"                         => ["required_with:exam.id", "date", "after:now"],
            "exam.student_can_start_until"          => ["required_with:exam.id", "date", "after:exam.start_at"],
            "exam.duration"                         => ["required_with:exam.id", 'integer', "max:255"]
        ];
    }
}
