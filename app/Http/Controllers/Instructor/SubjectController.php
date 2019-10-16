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
use Illuminate\Database\QueryException;
use Exception;

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
        $instructor = Instructor::with(['subjects', 'subjects.students' => function ($query) 
        {
            $query->where('instructor_id', Auth::user()->id);
        }])->find(Auth::user()->id);
        return view('instructor.subjects.index', compact('instructor'));
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
        $subjects = Subject::with('department')->get();
        return view('instructor.subjects.create', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddSubjectRequest $request)
    {
        DB::beginTransaction();
        try {
             // Get the instructor.
            $instructor = Instructor::with('subjects')->find(Auth::user()->id);
        
            $subject = Subject::with('students')->find($request->subject_id);


            // Insert the subject for the instructor.
            $instructor->subjects()->attach($subject);

            // Insert all students for this subject.
            foreach ($request->students['ids'] as $index => $id) {
                $subject->students()->attach($id, ['instructor_id' => Auth::user()->id, 'remarks' => $request->students['remarks'][$index] ]);
            }

            DB::commit();
            return back()->with('success', 'Successfully add new subject named ' . $request->name . ' with ' . count($request->students['ids']) .' students');
          
        } catch (Exception $e) {
            // dd($e->getMessage());
            return back();
            DB::rollback();
        }
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
