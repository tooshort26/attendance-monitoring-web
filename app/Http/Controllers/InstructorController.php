<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\UpdateAccountRequest;
use App\Instructor;
use Illuminate\Http\Request;
use JD\Cloudder\Facades\Cloudder;

class InstructorController extends Controller
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
        return redirect()->route('instructor.subject.index');
        // return view('instructor.dashboard');
    }

    public function edit()
    {
        return view('instructor.auth.edit');
    }

    public function update(UpdateAccountRequest $request, Instructor $instructor)
    {
        
        if ($request->hasFile('profile')) {
            $image_name = request()->file('profile')->getRealPath();
            Cloudder::upload($image_name, null);
            $image_url = Cloudder::show(Cloudder::getPublicId(), ["width" => 150, "height"=> 150]);
            $instructor->profile = $image_url;
        }
        
        $instructor->firstname  = $request->firstname;
        $instructor->lastname   = $request->lastname;
        $instructor->contact_no = $request->contact_no;

        if (!is_null($request->password)) {
            $instructor->password = $request->password;
        }
        $instructor->save();

        return back()->with('success', 'Successfully update your account.');
    }
}
