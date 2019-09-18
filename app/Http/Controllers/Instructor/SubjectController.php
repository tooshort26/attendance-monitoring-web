<?php

namespace App\Http\Controllers\Instructor;

use Illuminate\Http\Request;
use App\Http\Requests\Instructors\AddSubjectRequest;
use App\Http\Controllers\Controller;
use App\Student;
use App\Subject;
use App\Instructor;
use App\Department;
use DB;
use Auth;
use Freshbitsweb\Laratables\Laratables;

class SubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:instructor');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        return view('instructor.subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddSubjectRequest $request)
    {
        DB::transaction(function () use($request) {

            // Get the instructor.
            $instructor = Instructor::find(Auth::user()->id);

            // Create or find the subject.
            $subject = Subject::firstOrCreate([
                'name'        => $request->name,
                'description' => $request->description,
                'level'       => $request->level,
                'semester'    => $request->semester,
            ]);

            // Insert the subject for the instructor.
            $instructor->subjects()->attach($subject, ['block' => $request->block]);

            // Insert all students for this subject.
            foreach ($request->students['ids'] as $index => $id) {
                $subject->students()->attach($id, ['remarks' => $request->students['remarks'][$index] ]);
            }
        });
        return back()->with('success', 'Successfully add new subject named ' . $request->name . ' with ' . count($request->students['ids']) .' students');
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
    public function edit($id)
    {
        //
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
        //
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
