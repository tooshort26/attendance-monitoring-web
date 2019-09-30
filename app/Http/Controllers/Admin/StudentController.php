<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Course;
use App\Student;
use App\Subject;
use DB;
use App\Http\Requests\AddStudentRequest;
use App\Http\Requests\EditStudentRequest;
use App\Http\Controllers\Controller;
use App\Repositories\StudentRepository;
use Freshbitsweb\Laratables\Laratables;

class StudentController extends Controller
{
    protected $studenRepo;

    public function __construct(StudentRepository $studentRepo)
    {
        $this->middleware('auth:admin');
        $this->studentRepo = $studentRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.student.index');
    }

    public function students()
    {
        return Laratables::recordsOf(Student::class);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::get(['id', 'name']);
        return view('admin.student.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * AddStudentRequest
     */
    public function store(AddStudentRequest $request)
    {
        $student = $this->studentRepo->store($request->except('password_confirmation'));
        return back()->with('success', 'Successfully add the student with ID Number ' . $student->id_number . '.')->with('student_id', $student->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $courses = Course::all();
        $hasSubjects = $student->subjects->count();
        return view('admin.student.edit', compact('student', 'courses', 'hasSubjects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditStudentRequest $request, int $id)
    {
        $this->studentRepo->update($request->all());
        return back()->with('success', 'Successfully student information.');
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
