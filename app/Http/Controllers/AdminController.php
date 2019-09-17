<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use JD\Cloudder\Facades\Cloudder;
use App\Http\Requests\Admin\UpdateAccountRequest;

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
            $image_name = request()->file('profile')->getRealPath();
            Cloudder::upload($image_name, null);
            $image_url = Cloudder::show(Cloudder::getPublicId(), ["width" => 150, "height"=> 150]);
            $admin->profile = $image_url;
        }
        
        $admin->name = $request->name;

        if (!is_null($request->password)) {
            $admin->password = $request->password;
        }
        $admin->save();

        return back()->with('success', 'Successfully update your account.');
    }
  
}
