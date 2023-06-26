<?php

namespace App\Http\Controllers\Api\Admins\Courses;

use App\Exceptions\Authorization\UnauthorizedException;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\AdminDashboard\Courses\CategoryRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

abstract class CategoryController extends ApiController
{
    /**
     * category model instance.
     *
     * @var Model
     */
    protected Model $categoryModel;
    protected Model $policyModel;

    /**
     * get authentecatable user to chek authorization (policy)
     *
     * @return \Illuminate\Foundation\Auth\User
     */
    abstract public function getUser(): User;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->checkAbilities('index');

        return $this->apiSuccessResponse([
            'categories' => $this->categoryModel->orderBy('category_name', 'ASC')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Api\AdminDashboard\Courses\CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $this->checkAbilities('create');

        $this->categoryModel->create($request->validated());
        return $this->apiSuccessResponse();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->checkAbilities('index');

        return $this->apiSuccessResponse([
            'category' => $this->categoryModel->with('courses')->find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Api\AdminDashboard\Courses\CategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $this->checkAbilities('update');

        $category = $this->categoryModel->findOrFail($id);
        $category->update($request->validated());

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
        $this->checkAbilities('delete');
        
        $this->categoryModel->where('id', $id)->delete();
        return $this->apiSuccessResponse();
    }

    /**
     * check the access ability of specified method 
     * and throw \App\Exceptions\Authorization\UnauthorizedException
     * if ability set to false
     *
     * @param string $ability
     * @return void
     */
    private function checkAbilities(string $ability)
    {
        if (! $this->getUser()->can($ability, $this->policyModel))
            throw new UnauthorizedException();
    }
}
