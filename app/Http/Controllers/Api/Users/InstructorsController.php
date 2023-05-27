<?php

namespace App\Http\Controllers\Api\Users;

use App\Admin;
use App\Exceptions\Authorization\UnauthorizedException;
use App\Exceptions\Models\NotFoundException;
use App\Exceptions\Validation\DataValidationException;
use App\Http\Controllers\Api\ApiController;
use App\Models\Coaches\Coach as Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class InstructorsController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth('sanctum')->user()->tokenCan(Admin::ABILITIES_USERS_INSTRUCTORS_INDEX))
            return $this->apiSuccessResponse([
                'instructors' => Instructor::with('info')->get()
            ]);

        throw new UnauthorizedException();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // check ability
        if (! auth('sanctum')->user()->tokenCan(Admin::ABILITIES_USERS_INSTRUCTORS_CREATE))
            throw new UnauthorizedException();

        // validate request
        $validator = Validator::make($request->all(), [
            'f_name'        => 'required|regex:/^[a-zA-Z\x{0621}-\x{064A}]{2,20}$/u',
            'l_name'        => 'required|regex:/^[a-zA-Z\x{0621}-\x{064A}]{2,20}$/u',
            'email'         => 'required|email|max:50|unique:coaches,email',
            'password'      => 'required|min:8|max:80|string',
            'gender'        => 'required|in:male,female',
            'phone'         => 'required|regex:/^[0-9]{7,16}$/|unique:coaches,phone',
            'title'         => 'required|string|min:2|max:50',
            'about'         => 'required|string|min:3|max:65535',
            'facebook'      => ['regex:/^(http:\/\/|https:\/\/)?(www\.)?(fb|facebook)\.com\/.+/', 'max:255'],
            'twitter'       => ['regex:/^(http:\/\/|https:\/\/)?(www\.)?twitter\.com\/.+/', 'max:255'],
            'linkedin'      => ['regex:/^(http:\/\/|https:\/\/)?(www\.)?linkedin\.com\/.+/', 'max:255'],
        ]);

        if ($validator->fails())
            throw new DataValidationException($validator->errors()->all());

        // create instructor
        $instructor = new Instructor($request->only([
            'email', 'gender', 'phone'
        ]));
        $instructor->updateName($request->f_name, $request->l_name);
        $instructor->password = Hash::make($request->password);
        $instructor->save();

        // create instructor info
        $instructorInfo = $instructor->info()->create($request->only([
            'title', 'about', 'facebook', 'twitter', 'linkedin'
        ]));

        $instructor->info = $instructorInfo; // assign info to instructor object
        
        return $this->apiSuccessResponse([
            'instructor' => $instructor
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
        if (auth('sanctum')->user()->tokenCan(Admin::ABILITIES_USERS_INSTRUCTORS_INDEX))
            return $this->apiSuccessResponse([
                'instructor' => Instructor::with([
                    'info', 'ieltsCourses', 'recordedCourses', 'zoomCourses'
                ])->find($id)
            ]);
        
        throw new UnauthorizedException();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // check ability
        if (! auth('sanctum')->user()->tokenCan(Admin::ABILITIES_USERS_INSTRUCTORS_UPDATE))
            throw new UnauthorizedException();

        // search for instructor and throw exception if not foud
        $instructor = Instructor::with('info')->find($id);
        if (! $instructor)
            throw new NotFoundException(Instructor::class, $id);

        // validate request
        $validator = Validator::make($request->all(), [
            'f_name'        => 'regex:/^[a-zA-Z\x{0621}-\x{064A}]{2,20}$/u',
            'l_name'        => 'regex:/^[a-zA-Z\x{0621}-\x{064A}]{2,20}$/u',
            'email'         => 'email|max:50|unique:coaches,email',
            'password'      => 'min:8|max:80|string',
            'gender'        => 'in:male,female',
            'phone'         => 'regex:/^[0-9]{7,16}$/|unique:coaches,phone',
            'title'         => 'string|min:2|max:50',
            'about'         => 'string|min:3|max:65535',
            'facebook'      => ['regex:/^(http:\/\/|https:\/\/)?(www\.)?(fb|facebook)\.com\/.+$/', 'max:255', 'nullable'],
            'twitter'       => ['regex:/^(http:\/\/|https:\/\/)?(www\.)?twitter\.com\/.+/', 'max:255', 'nullable'],
            'linkedin'      => ['regex:/^(http:\/\/|https:\/\/)?(www\.)?linkedin\.com\/.+/', 'max:255', 'nullable'],
        ]);

        if ($validator->fails())
            throw new DataValidationException($validator->errors()->all());

        // update instructor & his info
        $instructor->updateName($request->f_name, $request->l_name);
        $instructor->email = $request->email ?? $instructor->email;
        $instructor->password = $request->has('password') ? Hash::make($request->password) : $instructor->password;
        $instructor->gender = $request->gender ?? $instructor->gender;
        $instructor->phone = $request->phone ?? $instructor->phone;
        $instructor->info->title = $request->title ?? $instructor->info->title;
        $instructor->info->about = $request->about ?? $instructor->info->about;
        $instructor->info->facebook = $request->has('facebook') ? $request->facebook : $instructor->info->facebook;
        $instructor->info->twitter = $request->has('twitter') ? $request->twitter : $instructor->info->twitter;
        $instructor->info->linkedin = $request->has('linkedin') ? $request->linkedin : $instructor->info->linkedin;
        $instructor->push(); // update data

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
        // check ability
        if (! auth('sanctum')->user()->tokenCan(Admin::ABILITIES_USERS_INSTRUCTORS_DELETE))
            throw new UnauthorizedException();

        Instructor::where('id', $id)->delete(); // delete instructor
        return $this->apiSuccessResponse();
    }

    /**
     * Update the profile picture for instructor.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfilePic(Request $request, $id)
    {
        // check ability
        if (! auth('sanctum')->user()->tokenCan(Admin::ABILITIES_USERS_INSTRUCTORS_UPDATE))
            throw new UnauthorizedException();

        // search for instructor & throw NotfoundException if not found
        $instructor = Instructor::with('info')->find($id);
        if (! $instructor)
            throw new NotFoundException(Instructor::class, $id);

        // validate pic file
        $validator = Validator::make($request->all(), [
            'image' => 'file|mimes:jpg,jpeg,png,svg|max:' . config('media.max_image_size'),
        ]);

        if ($validator->fails())
            throw new DataValidationException($validator->errors()->all());

        // if request doesn't contain image and instructor doesn't have saved image
        // then return success response without doing any thing
        if (! $request->has('image') && ! $instructor->info->image)
        return $this->apiSuccessResponse();

        // default path to instructor image directory
        $pathToImageDir = $this->getUniversalPath('/public/images/instructors/' . $instructor->id);

        // delete current instructor image if exists
        if ($instructor->info->image) {
            File::delete($pathToImageDir.DIRECTORY_SEPARATOR.$instructor->info->image);
            $instructor->info->image = null;
        }

         // store the new image if image has been sent
        if ($request->has('image')) {
            $fileName = Str::random(50) . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($pathToImageDir, $fileName);
            $instructor->info->image = $fileName;
        }

        $instructor->info->save(); // save update to database.

        return $this->apiSuccessResponse();
    }

    /**
     * Update the bio video for instructor.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateBioVideo(Request $request, $id)
    {
        // check ability
        if (! auth('sanctum')->user()->tokenCan(Admin::ABILITIES_USERS_INSTRUCTORS_UPDATE))
            throw new UnauthorizedException();

        // search for instructor & throw NotfoundException if not found
        $instructor = Instructor::with('info')->find($id);
        if (! $instructor)
            throw new NotFoundException(Instructor::class, $id);

        // validate video file
        $validator = Validator::make($request->all(), [
            'video' => 'file|mimetypes:video/mpeg,video/mp4,video/webm|max:' . config('media.max_image_size'),
        ]);

        if ($validator->fails())
            throw new DataValidationException($validator->errors()->all());

        // if request doesn't contain video and instructor doesn't have saved video
        // then return success response without doing any thing
        if (! $request->has('video') && ! $instructor->info->bio_video)
            return $this->apiSuccessResponse();

        // default path to instructor video directory
        $pathToVideoDir = $this->getUniversalPath('/public/videos/instructors/' . $instructor->id);

        // delete current instructor video if exists
        if ($instructor->info->bio_video) {
            File::delete($pathToVideoDir.DIRECTORY_SEPARATOR.$instructor->info->bio_video);
            $instructor->info->bio_video = null;
        }
        
        // store the new video if video has been sent
        if ($request->has('video')) {
            $fileName = Str::random(50) . '.' . $request->file('video')->getClientOriginalExtension();
            $request->file('video')->move($pathToVideoDir, $fileName);
            $instructor->info->bio_video = $fileName;
        }

        $instructor->info->save(); //save update to database.

        return $this->apiSuccessResponse();
    }
}
