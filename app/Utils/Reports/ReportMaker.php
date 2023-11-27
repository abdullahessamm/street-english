<?php

namespace App\Utils\Reports;

use Intervention\Image\Gd\Font;
use Intervention\Image\Gd\Shapes\CircleShape;
use Intervention\Image\Image;

abstract class ReportMaker
{
    protected string $fontPath = '';
    protected int $mainColor = 0x18a674;
    protected int $secondColor = 0x1d2d4c;

    abstract protected function getImage(): Image;

    /**
     * @param string $studentName
     * @return void
     */
    protected function drawStudentName(string $studentName): void
    {
        $this->getImage()->text($studentName, 150, 780, function (Font $font) {
            $font->color($this->mainColor);
            $font->size(150);
            if ($this->fontPath)
                $font->file($this->fontPath);

        });
    }

    /**
     * @param string $course
     * @param string $date
     * @param string $level
     * @param string|null $session
     * @return void
     */
    protected function drawReportInfo(string $course, string $date, string $level, ?string $session = null): void
    {
        // course
        $this->getImage()->text("Course: $course", 300, 1055, function (Font $font) {
            $font->color($this->secondColor);
            $font->size(90);
            if ($this->fontPath)
                $font->file($this->fontPath);
        });

        // date
        $this->getImage()->text("Date: $date", 300, 1155, function (Font $font) {
            $font->color($this->secondColor);
            $font->size(90);
            if ($this->fontPath)
                $font->file($this->fontPath);
        });

        // level
        $this->getImage()->text("Level: $level", 300, 1255, function (Font $font) {
            $font->color($this->secondColor);
            $font->size(90);
            if ($this->fontPath)
                $font->file($this->fontPath);
        });

        // session
        if ($session) {
            $this->getImage()->text("Session: $session", 300, 1355, function (Font $font) {
                $font->color($this->secondColor);
                $font->size(90);
                if ($this->fontPath)
                    $font->file($this->fontPath);
            });
        }
    }

    /**
     * @param string|null $attendance
     * @param string|null $lateness
     * @param string|null $participation
     * @param string|null $didAssignment
     * @return void
     */
    protected function drawStudentInfo(?string $attendance, ?string $lateness, ?string $participation, ?string $didAssignment): void
    {
        // attendance
        $this->getImage()->text($attendance ?? 'N/A', 1080, 1555, function (Font $font) {
            $font->color($this->secondColor);
            $font->size(70);
            if ($this->fontPath)
                $font->file($this->fontPath);
        });

        // delay time
        $this->getImage()->text($lateness ?? 'N/A', 1080, 1675, function (Font $font) {
            $font->color($this->secondColor);
            $font->size(70);
            if ($this->fontPath)
                $font->file($this->fontPath);
        });

        // Participation
        $this->getImage()->text($participation ?? 'N/A', 1080, 1820, function (Font $font) {
            $font->color($this->secondColor);
            $font->size(70);
            if ($this->fontPath)
                $font->file($this->fontPath);
        });

        // Assignment
        $this->getImage()->text($didAssignment ?? 'N/A', 1080, 1955, function (Font $font) {
            $font->color($this->secondColor);
            $font->size(70);
            if ($this->fontPath)
                $font->file($this->fontPath);
        });
    }

    /**
     * @param array|null $points
     * @return void
     */
    protected function drawWeaknessPoints(?array $points = null): void
    {
        if (! $points) {
            $this->getImage()->text("No weakness points." , 500, 2410, function (Font $font) {
                $font->color(0xffffff);
                $font->size(70);
                if ($this->fontPath)
                    $font->file($this->fontPath);
            });
            return;
        }

        // points must be max of 3 elements
        $points = array_slice($points, 0, 3);
        // start position and line height
        $startPos = [250, 2300];
        $lineHeight = 90;

        foreach ($points as $i => $point)
            $this->makePoint($point, $startPos[0], $startPos[1] + ($lineHeight * $i));
    }

    /**
     * @param array|null $points
     * @return void
     */
    protected function drawStrengthPoints(?array $points = null): void
    {
        if (! $points) {
            $this->getImage()->text("No strength points." , 500, 2930, function (Font $font) {
                $font->color(0xffffff);
                $font->size(70);
                if ($this->fontPath)
                    $font->file($this->fontPath);
            });
            return;
        }

        // points must be max of 3 elements
        $points = array_slice($points, 0, 3);
        // start position and line height
        $startPos = [250, 2830];
        $lineHeight = 90;

        foreach ($points as $i => $point)
            $this->makePoint($point, $startPos[0], $startPos[1] + ($lineHeight * $i));
    }

    /**
     * @param string $sentence
     * @param int $x
     * @param int $y
     * @return void
     */
    private function makePoint(string $sentence, int $x, int $y): void
    {
        // sentence must be max 32 characters
        $sentence = substr($sentence, 0, 32);

        $this->getImage()->circle(40, $x, $y, function (CircleShape $circle) {
            $circle->background(0xffffff);
        });

        $this->getImage()->text($sentence , $x + 50, $y + 17, function (Font $font) {
            $font->color(0xffffff);
            $font->size(65);
            if ($this->fontPath)
                $font->file($this->fontPath);
        });
    }

    /**
     * @param string|null $notes
     * @return void
     */
    protected function drawNotes(?string $notes = null): void
    {
        $startPos = [1720, 1870];
        $lineHeight = 70;

        $lines = array_slice($this->wrap(trim($notes) ?? "", 24), 0, 12);

        foreach ($lines as $i => $line) {
            $this->getImage()->text($line , $startPos[0], $startPos[1] + ($lineHeight * $i), function (Font $font) {
                $font->color(0xffffff);
                $font->size(65);
                if ($this->fontPath)
                    $font->file($this->fontPath);
            });
        }
    }

    /**
     * @param string $paragraph
     * @param int $maxLineCharNum
     * @return string[] lines
     */
    private function wrap(string $paragraph, int $maxLineCharNum): array
    {
        $words = explode(' ', $paragraph);
        $lines = [''];
        $currentLineIndex = 0;

        foreach ($words as $i => $word) {
            if (strlen($word) >= $maxLineCharNum)
                $word = substr($word, 0, $maxLineCharNum - 3) . '...';

            if (strlen($lines[$currentLineIndex]) > 0)
                $word = ' ' . $word;

            if (strlen($lines[$currentLineIndex] . $word) < $maxLineCharNum)
                $lines[$currentLineIndex] .= $word;

            else if (strlen($lines[$currentLineIndex] . $word) === $maxLineCharNum) {
                $lines[$currentLineIndex] .= $word;
                $lines[$currentLineIndex] = trim($lines[$currentLineIndex]);
                $currentLineIndex++;
                $lines[] = '';
            }

            else if (strlen($lines[$currentLineIndex] . $word) > $maxLineCharNum) {
                $lines[$currentLineIndex] = trim($lines[$currentLineIndex]);
                $currentLineIndex++;
                $lines[] = '';
                $lines[$currentLineIndex] .= trim($word);
            }
        }
        return $lines;
    }
}
