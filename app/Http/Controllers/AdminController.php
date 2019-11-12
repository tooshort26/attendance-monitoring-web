<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Course;
use App\Department;
use App\Http\Requests\Admin\UpdateAccountRequest;
use App\Instructor;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
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
        return view('admin.dashboard');
    }

    public function edit()
    {
        return view('admin.auth.edit');
    }

    public function update(UpdateAccountRequest $request, Admin $admin)
    {
        if ($request->hasFile('profile')) {
            File::deleteDirectory(public_path('/uploaded_images'));
            $imageName = time() .'.'. $request->profile->getClientOriginalExtension();
            $request->profile->move(public_path('/uploaded_images'), $imageName);
            $admin->profile = $imageName;
        }
        
        $admin->name = $request->name;

        if (!is_null($request->password)) {
            $admin->password = $request->password;
        }
        $admin->save();

        return back()->with('success', 'Successfully update your account.');
    }
  
}
