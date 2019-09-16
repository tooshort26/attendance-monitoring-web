<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\AddStudentSubjectRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use App\Student;
use App\Subject;
use DB;

class StudentSubjectController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Student $student)
    {
        return view('admin.studentsubject.create', compact('student'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddStudentSubjectRequest $request, Student $student)
    {
        if ($request->has('subjects')) {
            DB::transaction(function () use ($request, $student) {
                $names        = array_unique($request->subjects['name']);
                $descriptions = array_unique($request->subjects['description']);

                foreach ($names as $index => $name) {
                    $subjects[] = Subject::updateOrCreate(
                        [
                            'name'        => $name,
                            'description' => $descriptions[$index],
                            'level'       => $request->subjects['level'][$index],
                            'semester'    => $request->subjects['semester'][$index]
                        ]
                    )->id;
                }

                $student->subjects()->attach($subjects);    
            });
            return back()->with('success', 'Subjects successfully add.');
        } else {
            return back()->withErrors(['message' => 'Please add some fields click the plus(+) icon.']);
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
    public function edit(Student $student)
    {
        $subjects = $student->subjects()
                            ->orderBy('semester', 'ASC')
                            ->get()
                            ->groupBy(['level', 'semester'])
                            ->toArray();
        return view('admin.studentsubject.edit', compact('subjects', 'student'));
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
