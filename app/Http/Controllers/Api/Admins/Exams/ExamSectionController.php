<?php

namespace App\Http\Controllers\Api\Admins\Exams;

use App\Exceptions\Authorization\UnauthorizedException;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\AdminDashboard\Exams\Sections\CreateSectionRequest;
use App\Http\Requests\Api\AdminDashboard\Exams\Sections\UpdateSectionRequest;
use App\Http\Requests\PaginationRequest;
use App\Models\Exams\Exam;
use App\Models\Exams\ExamSection;
use App\Models\Exams\ExamSectionHeader;

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
        if (auth('sanctum')->user()->can('create', Exam::class))

        $data = collect($request->validated());
        //create section
        $sectionAttrs = $data->only(['title', 'score'])->toArray();
        $section = new ExamSection($sectionAttrs);
        $section->save();
        // create section's header
        $this->headerCreator($section, $request);

        return $this->apiSuccessResponse([
            'section' => $section
        ]);
    }

    private function headerCreator(ExamSection $section, CreateSectionRequest $request): void
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSectionRequest $request, $id)
    {
        /*
            {
                title: ....
                score: ....
                questions: [
                    {
                        title: ....
                        score: ....
                        type: ....
                        content: {
                            
                        }
                    }
                ]
            }
        */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
