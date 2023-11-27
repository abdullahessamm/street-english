<?php

namespace App\Utils\Reports;

use Intervention\Image\Image;

interface ReportImageRenderable
{
    public function make(): Image;
}
