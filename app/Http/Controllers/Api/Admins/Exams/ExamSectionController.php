<?php

namespace App\Http\Controllers\Api\Admins\Exams;

use App\Exceptions\Authorization\UnauthorizedException;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\AdminDashboard\Exams\Sections\CreateSectionRequest;
use App\Http\Requests\Api\AdminDashboard\Exams\Sections\SectionQuestionsRequest;
use App\Http\Requests\Api\AdminDashboard\Exams\Sections\UpdateSectionRequest;
use App\Http\Requests\PaginationRequest;
use App\Models\Exams\Exam;
use App\Models\Exams\ExamSection;
use App\Models\Exams\ExamSectionHeader;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ExamSectionController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PaginationRequest $request)
    {
        if (! auth('sanctum')->user()->can('index', Exam::class))
            throw new UnauthorizedException();

        $paginateQueries = collect($request->validated());

        return $this->apiSuccessResponse([
            'sections' => ExamSection::with([
                'questions',
                'header',
            ])
            ->orderBy('created_at', 'DESC')
            ->paginate($paginateQueries->get('per_page'), ['*'], null, $paginateQueries->get('page'))
            ->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSectionRequest $request)
    {
        if (auth('sanctum')->user()->can('update', Exam::class))

        $data = collect($request->validated());
        //create section
        $sectionAttrs = $data->only(['title', 'score'])->toArray();
        $section = new ExamSection($sectionAttrs);
        $section->save();

        // create section's header
        if ((bool) $data->get('has_header'))
            $this->createHeader($section, $request);

        return $this->apiSuccessResponse([
            'section' => $section
        ]);
    }

    private function createHeader(ExamSection $section, CreateSectionRequest|UpdateSectionRequest $request): void
    {
        $data = collect($request->validated())->only([
            'header_title',
            'header_type',
            'header_paragraph',
        ])->toArray();

        if (isset($data['header_title']))
            $data['title'] = $data['header_title']; unset($data['header_title']);

        if (isset($data['header_paragraph']))
            $data['paragraph'] = $data['header_paragraph']; unset($data['header_paragraph']);
        
        $data['type'] = $data['header_type']; unset($data['header_type']);

        if ($request->get('header_type') === ExamSectionHeader::TYPE_PICTURE)
            $data['picture'] = $this->storeStreamToGoogle('examHeadersMedia', $request->file('header_picture'));

        if ($request->get('header_type') === ExamSectionHeader::TYPE_VIDEO)
            $data['video'] = $this->storeStreamToGoogle('examHeadersMedia', $request->file('header_video'));

        if ($request->get('header_type') === ExamSectionHeader::TYPE_AUDIO)
            $data['audio'] = $this->storeStreamToGoogle('examHeadersMedia', $request->file('header_audio'));
        
        $section->header = $section->header()->create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! auth('sanctum')->user()->can('index', Exam::class))
            throw new UnauthorizedException();

        return $this->apiSuccessResponse([
            'section' => ExamSection::with([
                'questions',
                'header',
            ])->findOrFail($id)
        ]);
    }

    /**
     * download media of sections's header
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function downloadSectionHeaderMedia($id)
    {
        if (! auth('sanctum')->user()->can('index', Exam::class))
            throw new UnauthorizedException();

        $section = ExamSection::with('header')->findOrFail($id);

        $stream = null;

        switch ($section->header->type) {
            case ExamSectionHeader::TYPE_PICTURE:
                $stream = Storage::disk('google')->readStream($section->header->picture);
                break;
            
            case ExamSectionHeader::TYPE_AUDIO:
                $stream = Storage::disk('google')->readStream($section->header->audio);
                break;

            case ExamSectionHeader::TYPE_VIDEO:
                $stream = Storage::disk('google')->readStream($section->header->video);
                break;

            default:
                return response()->json([
                    'success' => false,
                    'message' => 'No media found.'
                ], Response::HTTP_NOT_FOUND);
        } // end of switch

        return response()->stream(function () use ($stream) {
            echo stream_get_contents($stream);
        }, 200, [
            'Content-Type' => 'application/octet-stream',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSectionRequest $request, $id)
    {
        if (! auth('sanctum')->user()->can('update', Exam::class))
            throw new UnauthorizedException();

        $data = collect($request->validated());
        // update section
        $section = ExamSection::with('header')->findOrFail($id);
        $section->update($data->only(['title', 'score'])->toArray());

        // handle header (update or create)
        if ((bool) $request->get('has_header'))
            $section->header ? $this->updateHeader($section->header, $request) :
            ($request->has('header_type') ? $this->createHeader($section, $request) : null);
        else
            $section->header ? $this->deleteHeader($section->header) : null;

        return $this->apiSuccessResponse();
    }

    /**
     * update section's header
     *
     * @param ExamSectionHeader $header
     * @param UpdateSectionRequest $request
     * @return void
     */
    private function updateHeader(ExamSectionHeader $header, UpdateSectionRequest $request)
    {
        $header->title = $request->has('header_title') ? $request->get('header_title') : $header->title;
        $header->type = $request->has('header_type') ? $request->get('header_type') : $header->type;
        
        if ($request->has('header_type')) {
            // reset media and paragraph
            $this->deleteHeaderMedia($header);
            $header->paragraph = null;

            switch ($request->get('header_type')) {
                case ExamSectionHeader::TYPE_PARAGRAPH:
                    $header->paragraph = $request->get('header_paragraph');
                    break;

                case ExamSectionHeader::TYPE_PICTURE:
                    $header->picture = $this->storeStreamToGoogle('examHeadersMedia', $request->file('header_picture'));
                    break;

                case ExamSectionHeader::TYPE_AUDIO:
                    $header->audio = $this->storeStreamToGoogle('examHeadersMedia', $request->file('header_audio'));
                    break;

                case ExamSectionHeader::TYPE_VIDEO:
                    $header->video = $this->storeStreamToGoogle('examHeadersMedia', $request->file('header_video'));
                    break;
            } // end of switch

            $header->save(); // save the update
        }
    }

    /**
     * update the questions of section
     *
     * @param SectionQuestionsRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function updateQuestions(SectionQuestionsRequest $request, $id)
    {
        if (! auth('sanctum')->user()->can('update', Exam::class))
            throw new UnauthorizedException();

        $reqQuestions = collect($request->validated()['questions']);
        // search for section
        $section = ExamSection::with('questions')->findOrFail($id);
        
        // group sent ids
        $existsIds = $reqQuestions->pluck('id')->toArray();
        // remove null values
        foreach ($existsIds as $i => $id) {
            if (! $id)
                unset($existsIds[$i]);
        }

        // delete questions that doesn't in request
        $section->questions()->whereNotIn('id', $existsIds)->delete();

        // update old questions
        $reqQuestions->whereNotNull('id')->each(function ($q) use ($section) {
            $section->questions()->where('id', $q['id'])->update($q);
        });

        // create new questions
        $section->questions()->createMany($reqQuestions->whereNull('id'));

        return $this->apiSuccessResponse([
            'questions' => $section->refresh()->questions,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! auth('sanctum')->user()->can('update', Exam::class))
            throw new UnauthorizedException();

        $section = ExamSection::with('header')->findOrFail($id);

        $this->deleteHeaderMedia($section->header);
        $section->delete();

        return $this->apiSuccessResponse();
    }

    /**
     * delete headers media from google
     *
     * @param ExamSectionHeader $header
     * @return void
     */
    private function deleteHeaderMedia(ExamSectionHeader $header)
    {
        try {
            $header->picture ? Storage::disk('google')->delete($header->picture) : null;
            $header->audio ? Storage::disk('google')->delete($header->audio) : null;
            $header->video ? Storage::disk('google')->delete($header->video) : null;
        } catch (Exception $e) {}

        $header->picture = null;
        $header->audio = null;
        $header->video = null;
    }

    /**
     * delete header
     *
     * @param ExamSectionHeader $header
     * @return void
     */
    private function deleteHeader(ExamSectionHeader $header)
    {
        $this->deleteHeaderMedia($header);
        $header->delete();
    }
}
