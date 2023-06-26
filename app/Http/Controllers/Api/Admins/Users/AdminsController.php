<?php

namespace App\Http\Controllers\Api\Admins\Users;

use App\Admin;
use App\Exceptions\Authorization\UnauthorizedException;
use App\Exceptions\Models\NotFoundException;
use App\Exceptions\Validation\DataValidationException;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdminsController extends ApiController
{
    protected Admin $admin;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (auth('sanctum')->user()->can('index', Admin::class))
            return $this->apiSuccessResponse([
                'admins' => Admin::orderBy('created_at', 'DESC')->get()
            ]);

        throw new UnauthorizedException();
    }

    /**
     * create new admin user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // check permission
        if (! auth('sanctum')->user()->can('create', Admin::class))
            throw new UnauthorizedException();

        // validate data
        $validator = Validator::make($request->all(), [
            'f_name'        => 'required|regex:/^[a-zA-Z\x{0621}-\x{064A}]{2,20}$/u',
            'l_name'        => 'required|regex:/^[a-zA-Z\x{0621}-\x{064A}]{2,20}$/u',
            'email'         => 'required|email|max:50|unique:admin,email',
            'password'      => 'required|min:8|max:80|string',
            'gender'        => 'required|in:male,female',
            'abilities'     => 'required|array|min:1',
            'abilities.*'   => [Rule::in(Admin::ABILITIES_AVAILABLE)],
        ]);

        // throw exception if validator fails
        if ($validator->fails())
            throw new DataValidationException($validator->errors()->toArray());

        // save new admin
        $admin = new Admin();
        $admin->name     = $request->f_name . ' ' . $request->l_name;
        $admin->email    = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->gender   = $request->gender;
        foreach ($request->abilities as $ability) $admin->addAbility($ability);
        $admin->save();

        return $this->apiSuccessResponse(['user' => $admin]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (auth('sanctum')->user()->can('show', Admin::class))
            return $this->apiSuccessResponse(['admin'   => Admin::find($id)]);

        throw new UnauthorizedException();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (! auth('sanctum')->user()->can('update', Admin::class) || auth('sanctum')->user()->id == $id)
            throw new UnauthorizedException();

        // validate data
        $validator = Validator::make($request->all(), [
            'f_name'        => 'regex:/^[a-zA-Z\x{0621}-\x{064A}]{2,20}$/u',
            'l_name'        => 'regex:/^[a-zA-Z\x{0621}-\x{064A}]{2,20}$/u',
            'email'         => 'email|max:50|unique:admin,email',
            'password'      => 'min:8|max:80|string',
            'gender'        => 'in:male,female',
            'abilities'     => 'array|min:1',
            'abilities.*'   => [Rule::in(Admin::ABILITIES_AVAILABLE)],
        ]);

        // throw exception if validator fails
        if ($validator->fails())
            throw new DataValidationException($validator->errors()->toArray());

        $admin = Admin::find($id);
        // throw exception if admin not found
        if (! $admin)
            throw new NotFoundException(Admin::class, $id);

        $admin->updateName($request->f_name, $request->l_name); // update name if required
        $admin->email = $request->email ?? $admin->email;
        $admin->password = $request->password ? Hash::make($request->password) : $admin->password;
        $admin->gender = $request->gender ?? $admin->gender;
        $admin->setAbilities($request->abilities);
        // save changes
        $admin->save();

        return $this->apiSuccessResponse();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! auth('sanctum')->user()->can('delete', Admin::class) || auth('sanctum')->user()->id == $id)
            throw new UnauthorizedException();

        Admin::where('id', $id)->delete();

        return $this->apiSuccessResponse();
    }
}
