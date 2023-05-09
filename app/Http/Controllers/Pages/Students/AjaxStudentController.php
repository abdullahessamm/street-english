<?php

namespace App\Http\Controllers\Pages\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use App\Models\Students\Student;

class AjaxStudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {

        $student = Student::query();

        return Datatables::of($student)
        ->editColumn('name', function ($student) {
            return '<a href="'.route('student.show', [$student->id]).'">'.$student->name.'</a>';
        })
        ->editColumn('delete_student', function ($student) {
            return '<button class="btn btn-danger btn-sm deleteStudent" data-student-id="'.$student->id.'">Delete student</button>';
        })
        ->editColumn('created_at', function ($student) {
            return date("Y-m-d h:i:s a", strtotime($student->created_at));
        })
        ->editColumn('updated_at', function ($student) {

            return $student->created_at < $student->updated_at ? '<span class="text-danger font-weight-bold">Updated at : '.date("Y-m-d h:i:s a", strtotime($student->updated_at)).'</span>' : '<span class="text-success font-weight-bold">This student hasn\'t been updated yet</span>';
        })
        ->rawColumns(['name', 'delete_student', 'updated_at'])
        ->make(true);
    }

    public function create(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $repass = $request->input('repass');
        $image = $request->hasFile('image') ? 'student.'.$request->file('image')->getClientOriginalExtension() : null;

        // check if password greater than 6 characters
        if(strlen($password) < 6)
        {
            echo $this->errorMsg("Password must be equal or greater than 6 characters");
            die();
        }

        // check if password doesn't matched
        if($password != $repass)
        {
            echo $this->errorMsg("Password doesn't match");
            die();
        }
        
        // check if image has valid extesnion
        if($image != null && !$this->isFileExtAllowed(['jpg', 'jpeg', 'png'], $request->file('image')->getClientOriginalExtension()))
        {
            echo $this->errorMsg("Student personal image extension not allowed");
            die();
        }
        
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'image' => $image,
        ];

        $student = Student::firstOrCreate(['email' => $email], $data);

        if($student)
        {
            $student_path = $this->getUniversalPath('public/images/students/'.$student->id);

            $image != null ? $request->file('image')->move($student_path, 'student.'.$request->file('image')->getClientOriginalExtension()) : false;

            echo $this->successMsg("Student : ".$name." has been added in our database");
            $this->redierctTo('student/show/'.$student->id);
        }
    }

    public function update(Request $request)
    {
        $student_id = $request->input('student_id');

        $student = Student::where('id', $student_id)->first();

        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $repass = $request->input('repass');
        $image = $request->hasFile('image') ? 'student.'.$request->file('image')->getClientOriginalExtension() : $student->image;
        
        // check if student's password will be updated
        if($password != null || $repass != null)
        {
            // check if password greater than 6 characters
            if(strlen($password) < 6)
            {
                echo $this->errorMsg("Password must be equal or greater than 6 characters");
                die();
            }

            // check if password greater than 6 characters
            if($password == null && strlen($password) < 6)
            {
                echo $this->errorMsg("Password must be equal or greater than 6 characters");
                die();
            }
    
            // check if password doesn't matched
            if($password != $repass)
            {
                echo $this->errorMsg("Password doesn't match");
                die();
            }

            $password = Hash::make($password);
        }
        else
        {
            $password = $student->password;
        }

        $student_path = $this->getUniversalPath('public/images/students/'.$student->id);

        Student::where('id', $student_id)->update([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'image' => $image,
        ]);

        $request->hasFile('image') ? $request->file('image')->move($student_path, 'student.'.$request->file('image')->getClientOriginalExtension()) : false;

        echo $this->successMsg("Student : ".$name." data has been updated");
        $this->reloadPage();
    }

    public function delete(Request $request)
    {
        $student_id = $request->input('student_id');

        $student_path = $this->getUniversalPath('public/images/students/'.$student_id);

        $student = Student::where('id', $student_id)->first();

        if($student->delete())
        {
            echo $this->successMsg("Student : '".$student->name."' has been removed from our database");
            
            file_exists($student_path) ? $this->deleteDir($student_path) : false;
        }
    }
}
