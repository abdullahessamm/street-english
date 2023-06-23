<?php

namespace App\Http\Controllers\Auth\RecordedStudent;

use App\Events\Auth\RegisterEvent;
use App\Http\Controllers\Controller;
use App\Models\Students\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * register new user
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        // validate request
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['nullable', 'regex:/^(\+?[0-9]{16})?$/', 'unique:users'],
        ]);

        // filter data
        $data = $request->only(['name', 'email', 'password', 'phone']);
        $data['password'] = Hash::make($data['password']);
        
        // create student and fire event
        $student = Student::create($data);
        event(new RegisterEvent($student));
        
        // login user
        auth('web:recordedStudent')->login($student, true);

        return redirect()->route('recordedStudent.home');
    }
}
