<?php

namespace App\Utils\Reports;

use App\Models\ZoomCourses\ZoomCourseSessionReport;
use Carbon\Exceptions\InvalidTimeZoneException;
use Intervention\Image\Image;
use \Intervention\Image\Facades\Image as ImageFacade;

class SessionReportMaker extends ReportMaker implements ReportImageRenderable
{
    protected Image $image;
    private ZoomCourseSessionReport $report;

    public function __construct(ZoomCourseSessionReport $report)
    {
        $imagePath = $report->notes ? 'app/assets/images/reports/session_template.jpg' : 'app/assets/images/reports/session_report_without_notes.jpg';
        $this->image = ImageFacade::make(storage_path($imagePath));
        $this->fontPath = storage_path('app/assets/fonts/myriad_pro_bold.ttf');
        $this->report = $report;
    }

    protected function getImage(): Image
    {
        return $this->image;
    }

    public function make(): Image
    {
        $reportCreatedDate = $this->report->created_at->format('Y/m/d');
        $attendedAt = $this->report->attended_at?->format('h:i A');

        if (request()->headers->has('X-Client-Timezone')) {
            try {
                $reportCreatedDate = $this->report->created_at->setTimeZone(request()->headers->get('X-Client-Timezone'))->format('Y/m/d');
                $attendedAt = $this->report->attended_at?->setTimeZone(request()->headers->get('X-Client-Timezone'))->format('h:i A');
            } catch (InvalidTimeZoneException $e) {}
        }

        $this->drawStudentName($this->report->student()->first(['id', 'name'])->name);
        $this->drawReportInfo(
            $this->report->session->level->course->title,
            $reportCreatedDate,
            explode(' ', $this->report->session->level->title)[1],
            $this->report->session->title
        );
        $this->drawStudentInfo(
            $attendedAt,
            $this->report->lateness ? $this->report->lateness . ' minutes' : null,
            $this->report->participation ? $this->report->participation . '%' : null,
            isset($this->report->did_assignment) ? ($this->report->did_assignment ? 'Yes' : 'No') : (null)
        );
        $this->drawWeaknessPoints(json_decode($this->report->weakness_points));
        $this->drawStrengthPoints(json_decode($this->report->strength_points));

        if ($this->report->notes)
            $this->drawNotes($this->report->notes);

        return $this->image;
    }
}
