<?php

namespace App\Utils\Reports;

use App\Models\ZoomCourses\ZoomCourseLevelReport;
use Carbon\Exceptions\InvalidTimeZoneException;
use Intervention\Image\Facades\Image as ImageFacade;
use Intervention\Image\Image;

class LevelReportMaker extends ReportMaker implements ReportImageRenderable
{
    protected Image $image;
    private ZoomCourseLevelReport $report;

    public function __construct(ZoomCourseLevelReport $report)
    {
        $imagePath = $report->notes ? 'app/assets/images/reports/level_report_template.jpg' : 'app/assets/images/reports/level_report_without_notes_template.jpg';
        $this->image = ImageFacade::make(storage_path($imagePath));
        $this->fontPath = storage_path('app/assets/fonts/myriad_pro_bold.ttf');
        $this->report = $report;
    }

    /**
     * @return Image
     */
    protected function getImage(): Image
    {
        return $this->image;
    }

    public function make(): Image
    {
        $reportCreatedDate = $this->report->created_at->format('Y/m/d');

        if (request()->headers->has('X-Client-Timezone')) {
            try {
                $reportCreatedDate = $this->report->created_at->setTimeZone(request()->headers->get('X-Client-Timezone'))->format('Y/m/d');
            } catch (InvalidTimeZoneException $e) {}
        }

        $this->drawStudentName($this->report->student()->first(['id', 'name'])->name);
        $this->drawReportInfo(
            $this->report->level->course->title,
            $reportCreatedDate,
            explode(' ', $this->report->level->title)[1]
        );
        $this->drawStudentInfo(
            $this->report->attendance . '%',
            null,
            $this->report->participation ? round($this->report->participation) . '%' : null,
            null
        );
        $this->drawWeaknessPoints(json_decode($this->report->weakness_points));
        $this->drawStrengthPoints(json_decode($this->report->strength_points));

        if ($this->report->notes)
            $this->drawNotes($this->report->notes);

        return $this->image;
    }
}
