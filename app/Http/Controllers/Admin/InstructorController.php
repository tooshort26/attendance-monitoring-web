<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\InstructorRepository;
use App\Http\Requests\Instructors\AddInstructorRequest;
use App\Http\Requests\Instructors\EditInstructorRequest;
use Freshbitsweb\Laratables\Laratables;
use App\Instructor;

class InstructorController extends Controller
{
    protected $instructorRepository;

    public function __construct(InstructorRepository $instructorRepo)
    {
        $this->middleware('auth:admin');
        $this->instructorRepository = $instructorRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.instructor.index');
    }

    public function instructors()
    {
        return Laratables::recordsOf(Instructor::class, function ($query) {
            return $query->where('active', 'yes');
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.instructor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddInstructorRequest $request)
    {
        $student = $this->instructorRepository
                        ->store($request->except('password_confirmation'));
        return back()->with('success', 'Successfully add the instructor.');
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
    public function edit(Instructor $instructor)
    {
        return view('admin.instructor.edit', compact('instructor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditInstructorRequest $request, $id)
    {
        $instructor = $this->instructorRepository
                        ->update($request->all());
        return back()->with('success', 'Successfully update the instructor information.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instructor $instructor)
    {
        $update = (bool) $instructor->update(['active' => 'no']);
        return response()->json(['success' => $update]);
    }
}
