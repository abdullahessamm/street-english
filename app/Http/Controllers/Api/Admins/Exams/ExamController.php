<?php

namespace App\Http\Controllers\Api\Admins\Exams;

use App\Events\Exams\ExamCreated;
use App\Exceptions\Authorization\UnauthorizedException;
use App\Exceptions\Models\NotFoundException;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\AdminDashboard\Exams\CreateExamRequest;
use App\Http\Requests\Api\AdminDashboard\Exams\UpdateExamRequest;
use App\Http\Requests\PaginationRequest;
use App\Models\Exams\Exam;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExamController extends ApiController
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
            'exams' => Exam::with([
                'sections' => function (BelongsToMany $sectionsQuery) {
                    $sectionsQuery->orderByPivot('order');
                    $sectionsQuery->with([
                        'header',
                        'questions'
                    ]);
                },
            ])
            ->where('name', 'like', '%' . $paginateQueries->get('search') . '%')
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
    public function store(CreateExamRequest $request)
    {
        // authorize
        if (! auth('sanctum')->user()->can('create', Exam::class))
            throw new UnauthorizedException();

        $exam = Exam::create($request->validated());
        event(new ExamCreated($exam));
        
        return $this->apiSuccessResponse([
            'exam' => $exam,
        ]);
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

        try {
            $exam = Exam::with([
                'sections' => function (BelongsToMany $sectionsQuery) {
                    $sectionsQuery->orderByPivot('order');
                    $sectionsQuery->with([
                        'header',
                        'questions',
                    ]);
                },
            ])->findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw new NotFoundException(Exam::class, $id);
        }

        return $this->apiSuccessResponse([
            'exam' => $exam
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExamRequest $request, $id)
    {
        // authorize
        if (! auth('sanctum')->user()->can('update', Exam::class))
            throw new UnauthorizedException();
    
        $data = collect($request->validated());

        if (! $exam = Exam::find($id))
            throw new NotFoundException(Exam::class, $id);

        $exam->update($data->except('sections')->toArray()); // update exam info

        // update (sync) exam sections
        if ($data->has('sections')) {
            $sections = [];
            foreach ($data->get('sections') as $sec)
                $sections[$sec['id']] = ['order' => $sec['order']];
    
            $exam->sections()->sync($sections);
        }

        return $this->apiSuccessResponse();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // authorize
        if (! auth('sanctum')->user()->can('delete', Exam::class))
            throw new UnauthorizedException();

        Exam::where('id', $id)->delete();
        return $this->apiSuccessResponse();
    }
}
