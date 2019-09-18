<?php

namespace App\Http\Middleware\Instructor;

use Closure;
use Auth;
use App\Subject;
use App\Student;
use App\Instructor;

class SubjectEntryCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Refactor this code.
        $studentsAlreadyHaveThisSubject = [];

        // Checking for Intstructor subject to avoid duplicate subject with same attributes.
        $instructor = Instructor::whereHas('subjects', function ($query) use($request) {
            $query->where(['subject_id' => $request->subject_id, 'block' => $request->block]);
        })->find(Auth::user()->id);

        // Checking for student subjects.
        if (!is_null($request->students)) {
              foreach ($request->students['ids'] as $id) {
                $studentsAlreadyHaveThisSubject[] = Student::whereHas('subjects', function ($query) use($request, $id) {
                    $query->where(['student_id' => $id, 'subject_id' => $request->subject_id]);
                })->find($id, ['name', 'id_number']);
            }
        }
        
        if (!is_null($instructor)) {
          return back()->withInput($request->all())->withErrors(['message' => 'You already add this subject please check your subjects.']);  
        } else if(is_null($request->students)) {
            return back()->withInput($request->only('name', 'description', 'level', 'semester', 'block', 'subject_id'))
                                 ->withErrors(['message' => 'Please include your students to this subject.']);  
        } else if(count(array_filter($studentsAlreadyHaveThisSubject)) >= 1) {
            $studentNames = array_column($studentsAlreadyHaveThisSubject, 'name');
            return back()->withInput($request->all())->withErrors(['message' => implode(',', $studentNames) . ' already have this subject.']);  
        }  else {
            return $next($request);
        }
    }
}
